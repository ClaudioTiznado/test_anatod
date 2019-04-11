$(function() {
  getCities();
});

$("#formAdd").hide();
$("#formEdit").hide();
$("#div-tabla").hide();

$("#btn-addClient").click(() => {
  $("#formAdd").show();
  $("#formEdit").hide();
  $("#div-tabla").hide();
});

$("#btn-editClient").click(() => {
  $("#formAdd").hide();
  $("#formEdit").show();
  $("#div-tabla").hide();
});

$("#btn-showClients").click(() => {
  $("#formAdd").hide();
  $("#formEdit").hide();
  $("#div-tabla").show();

  getClients();
});

var server = "/anatod/ajax/api.php";

function getClients() {
  var action = "clients";

  $.ajax({
    url: server,
    method: "GET",
    data: { action },
    dataType: "json",
    success: response => {
      if (!response.error) {
        var str = "";

        response.data.forEach(element => {
          str +=
            "<tr id='" +
            element.id +
            "'><td>" +
            element.id +
            "</td><td>" +
            element.name +
            "</td><td>" +
            element.dni +
            "</td><td>" +
            element.name_loc +
            "</td></tr>";
        });

        $("#table-clients tbody").html(str);
      }
    },
    error: response => {
      console.log(response);
    }
  });
}

function getCities() {
  var action = "cities";

  $.ajax({
    url: server,
    method: "GET",
    data: { action },
    dataType: "json",
    success: response => {
      if (!response.error) {
        var str = "";

        response.data.forEach(element => {
          str +=
            "<option value='" + element.id + "'>" + element.name + "</option>";
        });

        $("select[name='loc']").html(str);
      }
    },
    error: response => {
      console.log(response);
    }
  });
}

$("#addClient").click(() => {
  var name = $("#formAdd form input[name='name']").val();
  var dni = $("#formAdd form input[name='dni']").val();
  var loc = $("#formAdd form select[name='loc']").val();
  var action = "addClient";

  $.ajax({
    url: server,
    method: "POST",
    dataType: "json",
    data: { name, dni, loc, action },
    success: response => {
      if (!response.error) alert("Se ha agregado un nuevo cliente");
      else alert("No se pudo agregar el cliente.");
    },
    error: response => {
      console.log(response);
    }
  });
});

$("#btn-editClient").click(() => {
  var action = "nameClients";

  $.ajax({
    url: server,
    method: "GET",
    dataType: "json",
    data: { action },
    success: response => {
      if (!response.error) {
        var str = "";
        response.data.forEach(element => {
          str +=
            "<option value='" + element.id + "'>" + element.name + "</option>";
        });

        $("select[name='select-client']").html(str);
        $("#formEdit input[name='name']").val(response.infoClient.name);
        $("#formEdit input[name='dni']").val(response.infoClient.dni);
        $("#formEdit select[name='loc']").val(response.infoClient.localidad);
      }
    },
    error: response => {
      console.log(response);
    }
  });
});

$("select[name='select-client']").on("change", () => {
  var id = $("select[name='select-client']").val();
  var action = "infoClient";
  console.log(id);

  $.ajax({
    url: server,
    method: "GET",
    data: { id, action },
    dataType: "json",
    success: response => {
      console.log(response);
      if (!response.error) {
        $("#formEdit input[name='name']").val(response.data.name);
        $("#formEdit input[name='dni']").val(response.data.dni);
        $("#formEdit select[name='loc']").val(response.data.localidad);
      }
    },
    error: response => {
      console.log(response);
    }
  });
});

$("#editClient").click(() => {
  var name = $("#formEdit form input[name='name']").val();
  var dni = $("#formEdit form input[name='dni']").val();
  var loc = $("#formEdit form select[name='loc']").val();
  var idClient = $("#formEdit select[name='select-client']").val();
  var action = "editClient";

  $.ajax({
    url: server,
    method: "POST",
    dataType: "json",
    data: { name, dni, loc, action, idClient },
    success: response => {
      if (!response.error) alert("El cliente ha sido modificado");
      else alert("No se pudo modificar el cliente.");
    },
    error: response => {
      console.log(response);
    }
  });
});
