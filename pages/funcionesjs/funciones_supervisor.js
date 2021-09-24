/* funciones fecha dinamico */
$(document).ready(function() {
    $('#fecha_colacion').val(1);
    recargarLista();

    $('#fecha_colacion').change(function() {
        recargarLista();
    });

});

function recargarLista() {
    var url = "tabla_colacion_diaria.php";
    var fecha = $('#fecha_colacion').val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            fecha: fecha
        },
        success: function(datos) {
            $('#tabla_colacion_diaria').html(datos);

        }
    });
};

function getDetails(id_ubicacion, fecha) {
    $('.col_ubicacion').val(id_ubicacion);
    $('.col_fecha').val(fecha);

    var fecha = fecha;
    var id_ubicacion = id_ubicacion;
    $.ajax({
        data: {
            "fecha": fecha,
            "id_ubicacion": id_ubicacion
        },
        url: "revision_hora.php",
        type: "post",
        success: function(datos) {
            $('#input_hora_ini').html(datos);
            $('#modal_colacion_diaria').modal('show');
        }
    });

};

/*function horario_colacion() {
    $('#modal_colacion_diaria').modal('show');
}
*/
function Ingresar_colacion() {
    var col_ubicacion = document.getElementById('col_ubicacion').value;
    var col_fecha = document.getElementById('col_fecha').value;
    var usuario = document.getElementById('usuario').value;
    var hora_ini_col = document.getElementById('hora_ini_col').value;
    var hora_fin_col = document.getElementById('hora_fin_col').value;
    if (hora_ini_col == "") {
        alert('Debe ingresar Hora de Inicio');
        return;
    } else {
        if (confirm('Desea Ingresar Horario de Inicio?')) {
            $.ajax({
                url: 'nueva_colacion.php',
                type: 'post',
                data: {
                    col_ubicacion: col_ubicacion,
                    col_fecha: col_fecha,
                    usuario: usuario,
                    hora_ini_col: hora_ini_col,
                    hora_fin_col: hora_fin_col
                },
                success: function(response) {
                    if (response == 1) {
                        window.alert("Colación Ingresada en esta fecha");
                        return;
                    } else if (response == 2) {
                        window.alert("Inicio de Colación Ingresada");
                        location.reload();
                    } else if (response == 3) {
                        window.alert("Fin de Colación Ingresada");
                        location.reload();
                    } else if (response == 4) {
                        window.alert("hora de inicio no puede ser menor a hora de inicio de jornada");
                        return;
                    } else if (response == 5) {
                        window.alert("hora de fin no puede ser menor a hora de inicio de colación");
                        return;
                    } else {
                        window.alert("Error");
                        return;
                    }
                }
            });
        }
    }
};


/* funciones fecha y ubicacion dinamico */
$(document).ready(function() {
    $('#fecha_equipo').val(1);
    recargarListaEquipos();

    $('#id_ub_equipo').val(0);
    recargarListaEquipos();

    $('#id_ub_equipo').change(function() {
        recargarListaEquipos();
    });

});

function recargarListaEquipos() {
    var url = "tabla_equipos_diaria.php";
    var fecha = $('#fecha_equipo').val();
    var id_ubicacion = $('#id_ub_equipo').val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            fecha: fecha,
            id_ubicacion: id_ubicacion
        },
        success: function(datos) {
            $('#tabla_equipos_diaria').html(datos);

        }
    });
};