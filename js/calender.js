// Add REservacion Calender 
function addReserCalender(estado) {
    // get values
    var num_habi = $("#c_num_habi").html();
    var nvo_nombre      =   $("#nvo_nombre").val();
    var nvo_apellidos   =   $("#nvo_apellidos").val();
    var nvo_telefono    =   $("#nvo_telefono").val();
    var nom_hues = $("#c_nom_hues").val();
    var dia_inn = $("#c_dia_inn").html();
    var mes_inn = $("#c_mes_inn").html();
    var ano_inn = $("#c_ano_inn").html();
    var dia_out = $("#c_dia_out").val();
    var mes_out = $("#c_mes_out").val();
    var ano_out = $("#c_ano_out").val();
    var personex = $("#c_personex").val();
    var precio_habi = $("#c_precio_habi").val();
    var control_1 = 0;
    if($("#c_control_1").is(':checked')) {  
            control_1 = 1;  
        }
    var control_2 = 0;
    if($("#c_control_2").is(':checked')) {  
            control_2 = 1;  
        }
    var estado = estado;
    var recepcionista = $("#c_recepcionista").val();
    var observaciones = $("#c_observaciones").val();
     //Comparamos las fechas
     if (estado != 2) {
        personex = 0;
        precio_habi = 0;
        control_1 = 0;
        control_2 = 0;
     }
    
    if (nom_hues == 0) {
        var conf = confirm("Esta un huesped no registrado, desea continua?");
        if (conf == true) {
            
            // Agregamos la reservacion
            $.post("ajax/reservaciones/addRecord.php", {
                num_habi: num_habi,
                nom_hues: nom_hues,
                nvo_nombre: nvo_nombre,
                nvo_apellidos: nvo_apellidos,
                nvo_telefono: nvo_telefono,
                dia_inn: dia_inn,
                mes_inn: mes_inn,
                ano_inn: ano_inn,
                dia_out: dia_out,
                personex: personex,
                mes_out: mes_out,
                ano_out: ano_out,
                precio_habi: precio_habi,
                control_1: control_1,
                control_2: control_2,
                estado: estado,
                recepcionista: recepcionista,
                observaciones: observaciones
            }, function (data, status) {
                // close the popup
                $("#add_res_modal").modal("hide");

                // read records again
                readCalender();

                
            });
        }
    }else{
        $.post("ajax/reservaciones/addRecord.php", {
                num_habi: num_habi,
                nom_hues: nom_hues,
                nvo_nombre: nvo_nombre,
                nvo_apellidos: nvo_apellidos,
                nvo_telefono: nvo_telefono,
                dia_inn: dia_inn,
                mes_inn: mes_inn,
                ano_inn: ano_inn,
                dia_out: dia_out,
                personex: personex,
                mes_out: mes_out,
                ano_out: ano_out,
                precio_habi: precio_habi,
                control_1: control_1,
                control_2: control_2,
                estado: estado,
                recepcionista: recepcionista,
                observaciones: observaciones
            }, function (data, status) {
                // close the popup
                $("#add_res_modal").modal("hide");

                // read records again
                readCalender();
            });
    }
    // clear fields from the popup
        $("#num_habi").val("");
        $("#nom_hues").val("");
        $("#observaciones").val("");
    
}