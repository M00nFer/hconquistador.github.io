$(document).on('ready',function(){
  var precio = 0;
  $('#num_habi').on('change',function(){
    var id = $("#num_habi").val();
    $.post("ajax/reservaciones/readPrecioHab.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#precio_habi").val(user.precio);
            precio = user.precio;
        }
    );
    // Open modal popup
    $("#add_new_res_modal").modal("show");
  });

  $('#personex').on('change',function(){
    var habi = precio;
    var personex = $("#personex").val();
    total = (parseInt(personex)*100) + parseInt(habi);
    $("#precio_habi").val(total);
    // Open modal popup
    $("#add_new_res_modal").modal("show");
  });

});