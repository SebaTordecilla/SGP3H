/**
 * --------------------------------------------
 * Funciones Taller Mecanico
 * --------------------------------------------
 */
$(document).ready(function() {
    $('#tequipo').val(1);
    recargarLista();

    $('#tequipo').change(function() {
        recargarLista();
    });
});


function recargarLista() {
    $.ajax({
        type: "POST",
        url: "select_equipo.php",
        data: "tipo=" + $('#tequipo').val(),
        success: function(r) {
            $('#select2lista').html(r);
        }
    });
};


function abrir_mant() {
    $('#modal_matencion').modal('show');
};

function abrir_prog_mant() {
    $('#modal_prog_mant').modal('show');
};

function abrir2() {
    $('#modal_nuevo_equipo').modal('show');
};

function pdf_ft(num) {
    window.open('ficha_tecnica.php?id=' + num);
};

// funcion ajax
function ajax(url, method, params, container_id, loading_text) {
    try { // For: chrome, firefox, safari, opera, yandex, ...
        xhr = new XMLHttpRequest();
    } catch (e) {
        try { // for: IE6+
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e1) { // if not supported or disabled
            alert("Not supported!");
        }
    }
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) { // when result is ready
            document.getElementById(container_id).innerHTML = xhr.responseText;
        } else { // waiting for result 
            document.getElementById(container_id).innerHTML = loading_text;
        }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(params);
}

//ingresar nuevo equipo
function equipo_nuevo() {
    var sigla = document.getElementById('sigla').value;
    var nombre = document.getElementById('nombre').value;
    var id_tequipo = document.getElementById('id_tequipo').value;
    var marca = document.getElementById('marca').value;
    var num_serie = document.getElementById('num_serie').value;
    var anio = document.getElementById('anio').value;
    var fecha_ingreso = document.getElementById('fecha_ingreso').value;
    var frecuencia = document.getElementById('frecuencia').value;
    var observaciones = document.getElementById('observaciones').value;
    if (sigla == "") {
        alert('Debe ingresar Codigo');
        return;
    } else {
        if (nombre == "") {
            alert('Debe ingresar Modelo');
            return;
        } else {
            if (id_tequipo == "") {
                alert('Debe ingresar Tipo de equipo');
                return;
            } else {
                if (marca == "") {
                    alert('Debe ingresar Marca del Equipo');
                    return;
                } else {
                    if (num_serie == "") {
                        alert('Debe ingresar N° de Serie');
                        return;
                    } else {
                        if (anio == "") {
                            alert('Debe ingresar Año de Fabricación');
                            return;
                        } else {
                            if (fecha_ingreso == "") {
                                alert('Debe ingresar Fecha de Ingreso');
                                return;
                            } else {
                                if (frecuencia == "") {
                                    alert('Debe ingresar Frecuencia de Mantención');
                                    return;
                                } else {
                                    if (observaciones == "") {
                                        alert('Debe ingresar Observaciones');
                                        return;
                                    } else {
                                        if (confirm('Desea Ingresar Equipo?')) {

                                            var url = 'nuevo_equipo.php';
                                            var method = 'POST';
                                            var params = 'sigla=' + document.getElementById('sigla').value;
                                            params += '&nombre=' + document.getElementById('nombre').value;
                                            params += '&id_tequipo=' + document.getElementById('id_tequipo').value;
                                            params += '&marca=' + document.getElementById('marca').value;
                                            params += '&num_serie=' + document.getElementById('num_serie').value;
                                            params += '&anio=' + document.getElementById('anio').value;
                                            params += '&fecha_ingreso=' + document.getElementById('fecha_ingreso').value;
                                            params += '&frecuencia=' + document.getElementById('frecuencia').value;
                                            params += '&observaciones=' + document.getElementById('observaciones').value;

                                            var container_id = 'list_container';

                                            ajax(url, method, params, container_id);
                                            //window.alert(params);
                                            Swal.fire('Ingresado', "", "success");

                                            location.reload();

                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
};
// FIN INGRESAR EQUIPO

//  funcion abrir modal taller
function abrir_mod_taller(num) {
    var url = "lista_hist_equipos.php";
    var num = num;
    $.ajax({
        type: "POST",
        url: url,
        data: {
            num: num
        },
        success: function(datos) {
            $('#tabla_historica').html(datos);
            $('#modal_taller').modal('show');
        }
    });
};

//funcion obtener numero de equipo y agregarlo a la clase nombre
function getDetails(num) {
    $('.nombre_equipo').html('Equipo N°' + num);
    $('.cod_equipo').val(num);

};

// funcion agregar nuevo mantenimiento
function mant_nuevo() {
    var id_est_equipo = document.getElementById('id_est_equipo').value;
    var fecha_man = document.getElementById('fecha_man').value;
    var observaciones_man = document.getElementById('observaciones_man').value;
    if (id_est_equipo == "") {
        alert('Debe ingresar Estado');
        return;
    } else {
        if (fecha_man == "") {
            alert('Debe ingresar Fecha');
            return;
        } else {
            if (observaciones_man == "") {
                alert('Debe ingresar Observaciones');
                return;
            } else {
                if (confirm('Desea Ingresar Mantención?')) {

                    var url = 'nueva_mantencion.php';
                    var method = 'POST';
                    var params = 'id_equipo=' + document.getElementById('cod_equipo').value;
                    params += '&fecha_man=' + document.getElementById('fecha_man').value;
                    params += '&id_est_equipo=' + document.getElementById('id_est_equipo').value;
                    params += '&observaciones_man=' + document.getElementById('observaciones_man').value;

                    var container_id = 'list_container';

                    ajax(url, method, params, container_id);
                    Swal.fire('Ingresado', "", "success");

                    location.reload();

                }

            }
        }
    }
};

// funcion agregar nueva programacion
function prog_mant_nuevo() {
    var fecha_man_prog = document.getElementById('fecha_man_prog').value;
    if (fecha_man_prog == "") {
        alert('Debe ingresar Fecha de Programación');
        return;
    } else {

        if (confirm('Desea Ingresar Programación?')) {
            var url = 'nueva_programacion.php';
            var method = 'POST';
            var params = 'id_equipo=' + document.getElementById('cod_equipo').value;
            params += '&fecha_man_prog=' + document.getElementById('fecha_man_prog').value;
            var container_id = 'list_container';

            ajax(url, method, params, container_id);
            Swal.fire('Ingresado', "", "success");
            location.reload();

        }

    }
};