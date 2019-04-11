<!DOCTYPE html>
<html>
<head>
    <title>Titulo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <button id="btn-addClient">Agregar Cliente</button>
        <button id="btn-editClient">Editar Cliente</button>
        <button id="btn-showClients">Tabla de Clientes</button>
    </nav>

    <div id="formAdd" class="div-info">
        <h1>Agregar Cliente</h1>
        <button id="addClient">Agregar</button>
        <form>
            <div class="form-group">
                <label for="name">Nombre: </label>
                <input name="name" type="text">
            </div>

            <div class="form-group">
                <label for="dni">DNI: </label>
                <input name="dni" type="number">
            </div>

            <div class="form-group">
                <label for="loc">Localidad: </label>
                <select name="loc">
                </select>
            </div>
        </form>
    </div>

    <div id="formEdit" class="div-info">
        <h1>Editar Cliente</h1>
        
        <label for="select-client">Cliente</label>
        <select name="select-client"></select>
        <button id="editClient">Editar</button>
        <form>
            <div class="form-group">
                <label for="name">Nombre: </label>
                <input name="name" type="text">
            </div>

            <div class="form-group">
                <label for="dni">DNI: </label>
                <input name="dni" type="number">
            </div>

            <div class="form-group">
                <label for="loc">Localidad: </label>
                <select name="loc">
                </select>
            </div>
        </form>
    </div>

    <div id="div-tabla" class="div-info">
        <h1>Tabla Clientes</h1>
        <table id="table-clients">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Localidad</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script type="text/javascript" src="js/functions.js"></script>
</body>
</html> 