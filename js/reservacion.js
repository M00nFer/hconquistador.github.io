//Disminuir personas
function totalApagar() {
    var diain = $("#c_dia_inn").val();
    var mesin = $("#c_mes_inn").val();
    var anoin = $("#c_ano_inn").val();

    var diaout = $("#c_dia_out").val();
    var mesout = $("#c_mes_out").val();
    var anout  = $("#c_ano_out").val();

    var fechainn = anoin +"-"+ mesin +"-"+ diain;
    var fechaout = anout +"-"+ mesout +"-"+ diaout;
    alert(fechaout);
}


//metodo para regresar los dias anteriores
function SetDias(ann,mes,dia) {
    var ann = ann;
    var mes = mes;
    var dia = dia;
    var op = 3;
    // mandamos un valor a calender.php
    $.post("ajax/calender_m.php", {
        ann: ann,
        mes : mes,
        dia : dia,
        op : op
    }, function (data, status) {
        // leemos calendario otra vez
        readCalender();
    });
}

//metodo para aumentar los dias proximos
function DiasVistos(year,mes,dia) {
    var year = year;
    var mes = mes;
    var dia = dia;
    var op = 1;
    // mandamos un valor a calender.php
    $.post("ajax/calender_m.php", {
        year: year,
        mes : mes,
        dia : dia,
        op : op
    }, function (data, status) {
        // leemos calendario otra vez
        readCalender();
    });
}

//metodo para aumentar los dias anteriores
function DiasPorVer(ann,mes,dia) {
    var ann = ann;
    var mes = mes;
    var dia = dia;
    var op = 2;
    // mandamos un valor a calender.php
    $.post("ajax/calender_m.php", {
        ann: ann,
        mes : mes,
        dia : dia,
        op : op
    }, function (data, status) {
        // leemos calendario otra vez
        readCalender();
    });
}

var precio_mod = 0;
// Add Huesped
function addReservacion() {
    // get values
    var num_habi = $("#num_habi").val();
    var nom_hues = $("#nom_hues").val();
    var dia_inn = $("#dia_inn").val();
    var mes_inn = $("#mes_inn").val();
    var ano_inn = $("#ano_inn").val();
    var dia_out = $("#dia_out").val();
    var mes_out = $("#mes_out").val();
    var ano_out = $("#ano_out").val();
    var personex = $("#personex").val();
    var precio_habi = $("#precio_habi").val();
    var control_1 = 0;
    if($("#control_1").is(':checked')) {  
            control_1 = 1;  
        }
    var control_2 = 0;
    if($("#control_2").is(':checked')) {  
            control_2 = 1;  
        }

    var recepcionista = $("#recepcionista").val();
    var observaciones = $("#observaciones").val();

    // Agregamos la reservacion
    $.post("ajax/reservaciones/addRecord.php", {
        num_habi: num_habi,
        nom_hues: nom_hues,
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
        recepcionista: recepcionista,
        observaciones: observaciones
    }, function (data, status) {
        // close the popup
        $("#add_new_res_modal").modal("hide");

        // read records again
        readReservacion();

        // clear fields from the popup
        $("#num_habi").val("");
        $("#nom_hues").val("");
        $("#dia_inn").val("");
        $("#mes_inn").val("");
        $("#ano_inn").val("");
        $("#dia_out").val("");
        $("#mes_out").val("");
        $("#ano_out").val("");
        $("#personextra").val("");
        $("#precio_habi").val("");
        $("#control_1").val("");
        $("#control_2").val("");
        $("#recepcionista").val("");
        $("#observaciones").val("");
    });
}

//Aumentar Personas
function masPersona() {
    var total_p = $("#c_personex").val();
    total = parseInt(total_p) + 1;
    var precio_final = parseInt(precio_mod) + (total * 100);
    $("#c_personex").val(total);
    $("#c_precio_habi").val(precio_final);
    $("#add_res_modal").modal("show");
}
//Disminuir personas
function menPersona() {
    var total_p = $("#c_personex").val();
    total_p = parseInt(total_p);
    var total_dis = $("#c_precio_habi").val();
    if (tota_p = 0) { alert("no se puede Disminuir")}else{
        total = parseInt(total_p) - 1;
        var precio_final = parseInt(total_dis) - 100;
        $("#c_personex").val(total);
        $("#c_precio_habi").val(precio_final);
        $("#add_res_modal").modal("show");
    }
}

//Ver reservacion segun fecha
function verReservacion(num, ano, mes, dia){
    var fecha = ano  + '-' + mes + '-' + dia;
    $.post("ajax/reservaciones/reservacionVer.php", {
            num: num,
            fecha: fecha
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#nombre_de").html(user.nombre_hues);
            $("#ver_num").val(user.num_habi);
            $("#ver_entrada").val(user.entrada);
            $("#ver_salida").val(user.salida);
            $("#ver_pago").val(user.precio_habi);
            $("#ver_id").val(user.id);
            $("#ver_admin").val(user.recepcionista);
            $("#ver_observaciones").val(user.observaciones);
        }
    );
    // Open modal popup
    $("#ver_res_modal").modal("show");
}

//Ver modal para Agregar Reservacion
function addReservacionFecha(num, ano, mes, dia, precio ){
    var diain = dia;
    var mesin = mes;
    var anoin = ano;

    var fecha_in = mesin +"-"+ diain +"-"+  anoin;
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    if(month < 10){
        month += 1;
      month = "0"+month;
    }
    var year = date.getFullYear();

    var dateinn = month +"-"+ day +"-"+ year;


    if ((Date.parse(fecha_in) > Date.parse(dateinn))||(Date.parse(fecha_in) == Date.parse(dateinn))){
        $("#add_res_modal").modal("show");
            readResHabi();
            readResHues();
            $("#c_num_habi").html(num);
            $("#c_dia_inn").html(dia);
            $("#c_mes_inn").html(mes);
            $("#c_ano_inn").html(ano);
            $("#c_dia_out").val(dia+1);
            $("#c_mes_out").val(mes);
            $("#c_ano_out").val(ano);
            $("#c_personex").val("0"); 
            $("#c_precio_habi").html(precio);
    }else{
        alert("+ "+fecha_in+"\n >"+dateinn+"\nEsta fecha es pasada, NO se puede reservar");
    }
    
    var fechainn = anoin +"-"+ mesin +"-"+ diain;
    //var fechaout = anout +"-"+ mesout +"-"+ diaout;
    console.log(fechainn);
    //console.log(fechaout);

    var fechainn = moment(fechainn);
    //var fechaout = moment(fechaout);



    //console.log(fechaout.diff(fechainn, 'days'), ' dias de diferencia');

    $("#c_precio_habi").val(precio);
    precio_mod = precio;

}
//Ver Calendario
function readCalender() {
    $.get("ajax/calender.php", {}, function (data, status) {
        $("#records_calender").html(data);
    });
}

// READ Reservacion
function readReservacion() {
    $.get("ajax/reservaciones/readReservacion.php", {}, function (data, status) {
        $("#records_content_res").html(data);
    });
}
// READ Reservacion-Habitacion
function readResHabi() {
    $.get("ajax/reservaciones/readResHabi.php", {}, function (data, status) {
        $("#num_habi").html(data);
    });
}

// READ Reservacion-Habitacion
function readResHues() {
    $.get("ajax/reservaciones/readResHues.php", {}, function (data, status) {
        $("#nom_hues").html(data);
        $("#c_nom_hues").html(data);
    });
}
//Eliminar Reservacion
function DeleteReservacion(id) {
    var conf = confirm("¿Está seguro, realmente desea eliminar?");
    if (conf == true) {
        $.post("ajax/reservaciones/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readHues();
                readReservacion();
                readCalender();
            }
        );
    }
}
//Eliminar Reservacion desde el calener
function EliminarReservacion() {
    var id = $("#ver_id").val();
    var conf = confirm("¿Está seguro, realmente desea eliminar?");
    if (conf == true) {
        $.post("ajax/reservaciones/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readHues();
                readCalender();
                //cerramos modal
                $("#ver_res_modal").modal(hide);
            }
        );
    }
}


$(document).ready(function () {
    // READ recods on page load
    readReservacion(); //Callin Function Huespedes

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
  
    readCalender(); // calling function
    console.log($('#c_dia_out').val());

});