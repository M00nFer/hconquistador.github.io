// Add Record
function addRecord() {
    // get values
    var numhabi = $("#numhabi").val();
    var prehabi = $("#prehabi").val();
    var tipohabi = $("#tipohabi").val();

    // Add record
    $.post("ajax/addRecord.php", {
        numhabi: numhabi,
        prehabi: prehabi,
		tipohabi: tipohabi
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#numhabi").val("");
        $("#prehabi").val("");
        $("#tipohabi").val("");
    });
}

// READ records
function readRecords() {
    $.get("ajax/readRecord.php", {}, function (data, status) {
        $("#records_content").html(data);
    });
}

// READ Huesped
function readHues() {
    $.get("ajax/huesped/readHuesped.php", {}, function (data, status) {
        $("#records_content_hues").html(data);
    });
}

function DeleteUser(id) {
    var conf = confirm("¿Está seguro, realmente desea eliminar el registro?");
    if (conf == true) {
        $.post("ajax/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}

function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_habi_id").val(id);
    $.post("ajax/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_numhabi").val(user.num);
            $("#update_prehabi").val(user.precio);
            $("#update_tipohabi").val(user.tipo);
        }
    );
    // Open modal popup
    $("#update_habi_modal").modal("show");
}

function UpdateUserDetails() {
    // get values
    var numhabi = $("#update_numhabi").val();
    var prehabi = $("#update_prehabi").val();
    var tipohabi = $("#update_tipohabi").val();

    // get hidden field value
    var id = $("#hidden_habi_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
            id: id,
            numhabi: numhabi,
            prehabi: prehabi,
            tipohabi: tipohabi
        },
        function (data, status) {
            // hide modal popup
            $("#update_habi_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}

$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function

});