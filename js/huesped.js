
// Add Huesped
function addHuesped() {
    // get values
    
    var nombre = $("#nombre").val();
    if(nombre.val().length < 1) {  
        alert("El nombre es obligatorio");  
        return false;  
    } 
    var apellidos = $("#apellidos").val();
    var sexo = $("#sexo").val();
    var email = $("#email").val();
    var dia_in = $("#dia_in").val();
    var mes_in = $("#mes_in").val();
    var ano_in = $("#ano_in").val();


    // Add Huesped
    $.post("ajax/huesped/addRecord.php", {
        nombre: nombre,
        apellidos: apellidos,
        sexo: sexo,
        email: email,
        dia_in: dia_in,
        mes_in: mes_in,
        ano_in: ano_in
    }, function (data, status) {
        // close the popup
        $("#add_new_hues_modal").modal("hide");

        // read records again
        readHues();

        // clear fields from the popup
        $("#nombre").val("");
        $("#apellidos").val("");
        $("#sexo").val("");
        $("#email").val("");
    });
}

// READ Huesped
function readHues() {
    $.get("ajax/huesped/readHuesped.php", {}, function (data, status) {
        $("#records_content_hues").html(data);
    });
}

function DeleteHuesped(id) {
    var conf = confirm("¿Está seguro, realmente desea eliminar el Huesped?");
    if (conf == true) {
        $.post("ajax/huesped/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readHues();
                readHues();
            }
        );
    }
}

function GetHueDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_hues_id").val(id);
    $.post("ajax/huesped/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_nombre").val(user.nombre);
            $("#update_apellidos").val(user.apellidos);
            $("#update_sexo").val(user.sexo);
            $("#update_email").val(user.email);
            $("#update_fecha_n").val(user.fecha_n);
        }
    );
    // Open modal popup
    $("#update_hues_modal").modal("show");
}

function UpdateHueDetails() {
    // get values
    var nombre = $("#update_nombre").val();
    var apellidos = $("#update_apellidos").val();
    var sexo = $("#update_sexo").val();
    var email = $("#update_email").val();
    var fecha_n = $("#update_fecha_n").val();

    // get hidden field value
    var id = $("#hidden_hues_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/huesped/updateUserDetails.php", {
            id: id,
            nombre: nombre,
            apellidos: apellidos,
            sexo: sexo,
            email: email,
            fecha_n: fecha_n
        },
        function (data, status) {
            // hide modal popup
            $("#update_hues_modal").modal("hide");
            // reload Users by using readRecords();
            readHues();
        }
    );
}

$(document).ready(function () {
    // READ recods on page load
    

    readHues(); //Callin Function Huespedes
});