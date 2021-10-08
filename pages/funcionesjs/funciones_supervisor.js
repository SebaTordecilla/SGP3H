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


/* funcion reparacion en terreno */
$(document).ready(function() {
    $('#fecha_repa').val(1);
    recargarListaEquiposRep();

    $('#fecha_repa').change(function() {
        recargarListaEquiposRep();
    });

});

function recargarListaEquiposRep() {
    var url = "tabla_reparacion_diaria.php";
    var fecha = $('#fecha_repa').val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            fecha: fecha,
        },
        success: function(datos) {
            $('#tabla_reparacion_diaria').html(datos);

        }
    });
};
/* fin*/

function getDetails2(id) {
    $('.id_salida').val(id);
};

function sol_mecanico() {
    $('#solicitud_mecanico').modal('show');
};


function solicitud_mecanico() {
    var id_ubicacion = document.getElementById('rep_id_mina').value;
    var hora_ini = document.getElementById('hora_ini').value;
    var id_salida = document.getElementById('id_salida').value;

    if (id_ubicacion == "") {
        alert('Debe ingresar Mina');
        return;
    } else if (hora_ini == "") {
        alert('Debe ingresar Hora');
        return;
    } else {
        if (confirm('Desea Solicitar Mecánico?')) {
            $.ajax({
                url: 'nuevo_mecanico.php',
                type: 'post',
                data: {
                    id_ubicacion: id_ubicacion,
                    hora_ini: hora_ini,
                    id_salida: id_salida,
                },
                success: function(response) {
                    if (response == 1) {
                        window.alert("Mecánico ya fue solicitado");
                        return;
                    } else if (response == 2) {
                        window.alert("Solicitud de Mecánico Ingresada");
                        location.reload();
                    } else if (response == 3) {
                        window.alert("Error");
                        return;
                    } else if (response == 4) {
                        window.alert("Equipo ya finalizo su Jornada");
                        return;
                    }
                }
            });
        }
    }
};