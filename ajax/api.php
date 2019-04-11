<?php
error_reporting(-1);
ini_set('display_errors', 'On');

include '../includes/class.database.php';

$conn = new class_db();
$dbConn = $conn->conn;

?>
<pre><?php var_dump($dbConn);?></pre>
<?php

$action = $_GET['action'];
if(empty($action))
	$action = $_POST['action'];

if($action == "clients"){
	$result = $dbConn->query("SELECT cliente.id, cliente.dni, cliente.localidad, cliente.name, localidad.name AS name_loc FROM cliente INNER JOIN localidad ON localidad.id = cliente.localidad ORDER BY cliente.name");

	if ($result) {
		$items = array();
		while ($row = $result->fetch_assoc()){
			array_push($items, $row);
		}
		$res['data'] = $items;
		$res['error'] = false;
	}
	else{
		$res['error'] = true;
	}
}

else if($action == "cities"){
	$result = $dbConn->query("SELECT * FROM localidad");

	if ($result) {
		$items = array();
		while ($row = $result->fetch_assoc()){
			array_push($items, $row);
		}
		$res['data'] = $items;
		$res['error'] = false;
	}
	else{
		$res['error'] = true;
	}
}

else if($action == "addClient"){
	$name = $_POST['name'];
	$dni = $_POST['dni'];
	$loc = $_POST['loc'];

	$result = $dbConn->query("INSERT INTO `cliente` (`name`, `dni`, `localidad`) VALUES ('$name', '$dni', '$loc')");
	
	if ($result) {
		$res['message'] = "Client Added successfully";
		$res['error'] = false;
	} else{
		$res['error'] = true;
		$res['message'] = "User Add failed";
	}
}

else if($action == "nameClients"){
	$result = $dbConn->query("SELECT id,name FROM cliente ORDER BY name");
	
	if ($result) {
		$items = array();
		while ($row = $result->fetch_assoc()){
			array_push($items, $row);
		}
		$res['data'] = $items;
		$res['error'] = false;

		$first = $items[0]['id'];
		$result = $dbConn->query("SELECT name, dni,localidad FROM cliente WHERE cliente.id=$first");
		$res['infoClient'] = $result->fetch_assoc();
	}
	else{
		$res['error'] = true;
		$res['message'] = "Name Clients failed";
	}
}

else if($action == "infoClient"){
	$idClient = $_GET['id'];
	$result = $dbConn->query("SELECT dni, localidad, cliente.name, localidad.name AS name_loc FROM cliente INNER JOIN localidad ON localidad.id=cliente.localidad WHERE cliente.id  = $idClient");
	
	if ($result) {
		$items = array();
		while ($row = $result->fetch_assoc()){
			array_push($items, $row);
		}
		$res['data'] = $items[0];
		$res['error'] = false;
	}
	else{
		$res['error'] = true;
		$res['message'] = "Info Client failed";
	}
}

else if($action == "editClient"){
	$idClient = $_POST['idClient'];
	$name = $_POST['name'];
	$dni = $_POST['dni'];
	$loc = $_POST['loc'];

	$result = $dbConn->query("UPDATE `cliente` SET `name`='$name', `dni`='$dni', `localidad`='$loc' WHERE `id` = '$idClient'");
	
	if ($result) {
		$res['message'] = "Update Client successfully";
		$res['error'] = false;
		$res['post'] = $_POST;
	} else{
		$res['error'] = true;
		$res['message'] = "Update Client failed";
	}
}

echo json_encode($res);
?>