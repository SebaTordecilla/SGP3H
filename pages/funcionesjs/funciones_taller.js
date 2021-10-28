/**
 * --------------------------------------------
 * Funciones Taller Mecanico
 * --------------------------------------------
 */



// colacion equipo

$(document).ready(function() {
    $("#colacion_equipos").click(function() {
        var id_equipo = $("#lista2").val().trim();
        var id_est_equipo = $("#id_est_equipo").val().trim();
        var id_ubicacion = $("#id_ubicacion").val().trim();
        var hora_inicio = $("#hora_inicio").val().trim();
        var fecha = $("#fecha_taller").val().trim();
        window.alert('id_equipo:' + id_equipo + ',id_estado:' + id_est_equipo + ',id_ubicacion:' + id_ubicacion + ',hora_inicio:' + hora_inicio + ',fecha:' + fecha);
        if (confirm('Desea Ingresar Acción?')) {
            $.ajax({
                url: 'colacion_equipos.php',
                type: 'post',
                data: {
                    id_equipo: id_equipo,
                    id_est_equipo: id_est_equipo,
                    id_ubicacion: id_ubicacion,
                    hora_inicio: hora_inicio,
                    fecha: fecha
                },
                success: function(response) {
                    if (response == 0) {
                        window.alert("Error contactar a desarrollo");
                        return;
                    } else if (response == 1) {
                        window.alert("Equipo sin Actividad en esa fecha");
                        return;
                    } else if (response == 2) {
                        window.alert("Equipo ya se encuentra en colación");
                        return;
                    } else if (response == 3) {
                        window.alert("Equipo Inicia Colación");
                        location.reload();
                    } else if (response == 4) {
                        window.alert("Hora de Colación debe ser Mayor a Hora de Inicio Jornada");
                        return;
                    } else if (response == 5) {
                        window.alert("Equipo no ha iniciado Colación");
                        return;
                    } else if (response == 6) {
                        window.alert("Equipo ya regreso de Colación");
                        return;
                    } else if (response == 7) {
                        window.alert("Hora de termino de colación no puede ser menor a hora de inicio de Colación");
                        return;
                    } else if (response == 8) {
                        window.alert("Equipo Regresa de Colación");
                        location.reload();
                    } else if (response == 9) {
                        window.alert("Debe cerrar Colación antes de pedir Mecánico");
                        return;
                    } else if (response == 10) {
                        window.alert("Hora de solicitud Mecánico debe ser mayor a hora de Inicio Jornada");
                        return;
                    } else if (response == 11) {
                        window.alert("Se solicita Mecánico");
                        location.reload();
                    } else if (response == 12) {
                        window.alert("Mecánico ya fue Solicitado");
                        return;
                    }
                }
            });
        }

    });
});



//cierre diario
$(document).ready(function() {
    $("#cierre_diario").click(function() {
        var num_equipo = $("#num_equipo").val().trim();
        var fecha_dia = $("#fecha_dia").val().trim();
        var hora_fin = $("#hora_fin").val().trim();

        if (hora_fin == "") {
            alert('Debe ingresar Hora');
            return;
        } else {
            if (confirm('Desea Cerrar Equipo?')) {
                $.ajax({
                    url: 'cierre_equipo_diario.php',
                    type: 'post',
                    data: {
                        num_equipo: num_equipo,
                        fecha_dia: fecha_dia,
                        hora_fin: hora_fin
                    },
                    success: function(response) {
                        if (response == 1) {
                            window.alert("Debe cerrar colación");
                            return;
                            //location.reload();
                        } else if (response == 2) {
                            window.alert("Debe enviar mecánico y cerrar proceso");
                            return;
                        } else if (response == 3) {
                            window.alert("Debe cerrar visita de mecanico");
                            return;
                        } else if (response == 4) {
                            window.alert("Hora de cierre no puede ser menor a inicio");
                            return;
                        } else if (response == 5) {
                            window.alert("Hora de cierre no puede ser menor a inicio de colación");
                            return;
                        } else if (response == 6) {
                            window.alert("Hora de cierre no puede ser menor a fin de colación");
                            return;
                        } else if (response == 7) {
                            window.alert("Hora de cierre no puede ser menor a hora de Solicitud de Mecánico");
                            return;
                        } else if (response == 8) {
                            window.alert("Hora de cierre no puede ser menor a hora de llegada de Mecánico");
                            return;
                        } else if (response == 9) {
                            window.alert("Hora de cierre no puede ser menor a hora de Fin de Mecánico");
                            return;
                        } else if (response == 10) {
                            window.alert("Equipo Finaliza su jornada");
                            location.reload();
                        }
                    }
                });
            }
        }
    });
});







// funcion planificacion diaria
$(document).ready(function() {
    $("#planificar").click(function() {
        var id_equipo = $("#lista2").val().trim();
        var id_operador = $("#id_operador").val().trim();
        var id_supervisor = $("#id_supervisor").val().trim();
        var id_ubicacion = $("#id_ubicacion").val().trim();
        var turno = $("#turno").val().trim();
        var fecha = $("#fecha").val().trim();
        var hora_inicio = $("#hora_inicio").val().trim();
        if (fecha == "") {
            alert('Debe ingresar Fecha');
            return;
        } else {
            if (hora_inicio == "") {
                alert('Debe ingresar Hora');
                return;
            } else {
                if (id_ubicacion == "") {
                    alert('Debe ingresar Ubicación');
                    return;
                } else {
                    if (id_operador == "") {
                        alert('Debe ingresar Operador');
                        return;
                    } else {
                        if (id_supervisor == "") {
                            alert('Debe ingresar Supervisor');
                            return;
                        } else {
                            if (turno == "") {
                                alert('Debe ingresar turno');
                                return;
                            } else {
                                if (confirm('Desea Cargar Equipo?')) {
                                    if (id_equipo != "" && id_operador != "" && id_supervisor != "" && id_ubicacion != "" && turno != "" && fecha != "" && hora_inicio != "") {
                                        $.ajax({
                                            url: 'planficacion_2.php',
                                            type: 'post',
                                            data: {
                                                id_equipo: id_equipo,
                                                id_operador: id_operador,
                                                id_supervisor: id_supervisor,
                                                id_ubicacion: id_ubicacion,
                                                turno: turno,
                                                fecha: fecha,
                                                hora_inicio: hora_inicio
                                            },
                                            success: function(response) {
                                                if (response == 1) {
                                                    Swal.fire();
                                                    window.alert("Equipo Ingresado");
                                                    location.reload();
                                                } else if (response == 3) {
                                                    window.alert("Equipo Ya Ingresado");
                                                    return;
                                                } else {
                                                    window.alert("No Ingresado");
                                                    msg = "";
                                                }
                                            }
                                        });
                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

    });

});

/* funciones fecha dinamico prueba*/
$(document).ready(function() {
    $('#fecha_man').val(1);
    recargarLista2();

    $('#fecha_man').change(function() {
        recargarLista2();
    });
});

$(document).ready(function() {
    $('#fecha_man').val(1);
    recargarLista3();

    $('#fecha_man').change(function() {
        recargarLista3();
    });
});


function recargarLista2() {
    $.ajax({
        type: "POST",
        url: "select_equipo_taller.php",
        data: "fecha=" + $('#fecha_man').val(),
        success: function(r) {
            $('#lista_minas').html(r);

        }
    });
};

function recargarLista3() {
    $.ajax({
        type: "POST",
        url: "select_equipo_taller_ubica.php",
        data: "fecha=" + $('#fecha_man').val(),
        success: function(r) {
            $('#lista2').html(r);
        }
    });
};

//



// fin fecha dinamico prueba//


/* funciones select dinamico */
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
// fin select dinamico//

function abrir_mant_cierre() {
    $('#modal_cierre_diario').modal('show');
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

function pdf_control_camioneta(num) {
    window.open('pdf_control_camioneta.php?id=' + num);
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

                                            $.ajax({
                                                url: 'nuevo_equipo.php',
                                                type: 'post',
                                                data: {
                                                    sigla: sigla,
                                                    nombre: nombre,
                                                    id_tequipo: id_tequipo,
                                                    marca: marca,
                                                    num_serie: num_serie,
                                                    anio: anio,
                                                    fecha_ingreso: fecha_ingreso,
                                                    frecuencia: frecuencia,
                                                    observaciones: observaciones
                                                },
                                                success: function(response) {
                                                    if (response == 1) {
                                                        window.alert("Codigo de equipo ya se encuentra ingresado, cambiar codigo de equipo");
                                                        return;
                                                    } else if (response == 2) {
                                                        window.alert("Equipo Ingresado");
                                                        location.reload();

                                                    }
                                                }
                                            });
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

//  funcion abrir modal reparacion terreno
function cerrar_reparacion_terreno() {
    $('#modal_cerrar_reparacion_terreno').modal('show');
};
//  funcion abrir modal reparacion terreno
function abrir_reparacion_terreno() {
    $('#modal_reparacion_terreno').modal('show');
};

//funcion obtener numero de equipo y agregarlo a la clase nombre
function getDetails(num, ID, modelo, tipo) {
    $('.nombre_equipo').html(num + ' - ' + modelo + ' - ' + tipo);
    $('.cod_equipo').val(num);

};

function getDetails2(ID, Fecha, id_sal_equipo) {
    $('.codigo').val(ID);
    $('.fecha_dia').val(Fecha);
    $('.num_equipo').val(id_sal_equipo);
};

function getDetails3(id_sal_equipo) {
    $('.salida_equipo').val(id_sal_equipo);
};

// funcion agregar nuevo mantenimiento
function mant_nuevo() {
    //checkbox
    var selected = '';
    $('input[type=checkbox]').each(function() {
        if (this.checked) {
            selected += $(this).val() + ' - ';
        }
    });
    //arreglo checkbox
    var selected2 = selected.substring(0, selected.length - 10);
    var fecha = document.getElementById('fecha_taller').value;
    var tequipo = document.getElementById('tequipo').value;
    var id_equipo = document.getElementById('lista2').value;
    var id_est_equipo = document.getElementById('id_est_equipo').value;
    var observaciones_man = document.getElementById('observaciones_man').value;

    //window.alert(selected);
    //window.alert(selected2);
    //window.alert(selected2 + ',' + fecha + ',' + tequipo + ',' + id_equipo + ',' + id_est_equipo + ',' + observaciones_man);

    if (fecha == "") {
        alert('Debe ingresar Fecha');
        return;
    } else {
        if (tequipo == "") {
            alert('Debe ingresar Tipo de Equipo');
            return;
        } else {
            if (id_equipo == "") {
                alert('Debe ingresar Equipo');
                return;
            } else {
                if (id_est_equipo == "") {
                    alert('Debe ingresar Estado');
                    return;
                } else {
                    if (confirm('Desea Ingresar Mantención?')) {
                        $.ajax({
                            url: 'nueva_mantencion.php',
                            type: 'post',
                            data: {
                                selected2: selected2,
                                fecha: fecha,
                                id_equipo: id_equipo,
                                id_est_equipo: id_est_equipo,
                                observaciones_man: observaciones_man
                            },
                            success: function(response) {
                                if (response == 1) {
                                    window.alert("Mantención Ingresada");
                                    location.reload();
                                } else if (response == 2) {
                                    window.alert("Error ");

                                } else {
                                    window.alert("Error");
                                    return;
                                }
                            }
                        });
                    }
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


// funcion enviar mecanico
function enviar_mecanico() {
    var salida_equipo = document.getElementById('salida_equipo').value;
    var hora = document.getElementById('hora').value;
    var id_mecanico = document.getElementById('id_mecanico').value;

    if (hora == "") {
        alert('Debe ingresar Hora');
        return;
    } else {
        if (id_mecanico == "") {
            alert('Debe ingresar Mecánico');
            return;
        } else {
            if (confirm('Desea Enviar Mecánico?')) {
                $.ajax({
                    url: 'enviar_mecanico.php',
                    type: 'post',
                    data: {
                        salida_equipo: salida_equipo,
                        hora: hora,
                        id_mecanico: id_mecanico

                    },
                    success: function(response) {
                        if (response == 1) {
                            window.alert("Mecanico ya fue enviado");
                            return;
                        } else if (response == 2) {
                            window.alert("Mecanico enviado");
                            location.reload();
                        } else if (response == 3) {
                            window.alert("Hora de Solicitud debe ser mayor a Hora de inicio Jornada");
                            return;
                        }
                    }
                });

            }
        }
    }
};

// funcion cerrar mecanico
function cerrar_mecanico() {
    var salida_equipo = document.getElementById('salida_equipo').value;
    var hora = document.getElementById('hora1').value;
    var observaciones = document.getElementById('observaciones1').value;
    window.alert(observaciones);
    if (hora == "") {
        alert('Debe ingresar Hora');
        return;
    } else {
        if (observaciones == "") {
            alert('Debe ingresar Observaciones');
            return;
        } else {
            if (confirm('Desea Cerrar Reparación?')) {
                $.ajax({
                    url: 'cerrar_mecanico.php',
                    type: 'post',
                    data: {
                        salida_equipo: salida_equipo,
                        hora: hora,
                        observaciones: observaciones

                    },
                    success: function(response) {
                        if (response == 1) {
                            window.alert("Reparación ya fue Cerrada");
                            return;
                        } else if (response == 2) {
                            window.alert("Se debe enviar Mecánico a Terreno");
                            return;
                        } else if (response == 3) {
                            window.alert("Reparación Cerrada");
                            location.reload();
                        } else if (response == 4) {
                            window.alert("Hora de cierre no puede ser menor a hora de envío Mecánico");
                            return;
                        }
                    }
                });

            }
        }
    }
};

// funcion nueva camioneta
function camioneta_nueva() {
    var patente = document.getElementById('patente').value;
    var marca = document.getElementById('marca_c').value;
    var modelo = document.getElementById('modelo_c').value;
    var chofer = document.getElementById('chofer').value;
    var calidad = document.getElementById('calidad').value;
    var anio = document.getElementById('anio_c').value;
    var fecha_ingreso = document.getElementById('fecha_ingreso_c').value;

    if (patente == "") {
        alert('Debe ingresar Patente');
        return;
    } else {
        if (marca == "") {
            alert('Debe ingresar Marca');
            return;
        } else {
            if (modelo == "") {
                alert('Debe ingresar Modelo');
                return;
            } else {
                if (chofer == "") {
                    alert('Debe ingresar Chofer Asignado');
                    return;
                } else {
                    if (calidad == "") {
                        alert('Debe ingresar Calidad de Vehículo');
                        return;
                    } else {
                        if (anio == "") {
                            alert('Debe ingresar Año');
                            return;
                        } else {
                            if (fecha_ingreso == "") {
                                alert('Debe ingresar Fecha de Ingreso');
                                return;
                            } else {
                                if (confirm('Desea Ingresar Nueva Camioneta?')) {

                                    $.ajax({
                                        url: 'camioneta_nueva.php',
                                        type: 'post',
                                        data: {
                                            patente: patente,
                                            marca: marca,
                                            modelo: modelo,
                                            chofer: chofer,
                                            calidad: calidad,
                                            anio: anio,
                                            fecha_ingreso: fecha_ingreso
                                        },
                                        success: function(response) {
                                            if (response == 1) {
                                                window.alert("Camioneta Ingresada");
                                                location.reload();
                                            } else {
                                                window.alert("Error en Ingreso");
                                                return;
                                            }
                                        }
                                    });
                                }

                            }

                        }

                    }

                }

            }

        }
    }
};


///permiso de circulacion
function permiso_circulacion() {
    var patente = document.getElementById('patente_pc').value;
    var fecha_ini = document.getElementById('fecha_ingreso_pc').value;
    var fecha_fin = document.getElementById('fecha_termino_pc').value;
    if (patente == "") {
        alert('Debe ingresar Patente');
        return;
    } else {
        if (fecha_ini == "") {
            alert('Debe ingresar Fecha de Inicio');
            return;
        } else {
            if (fecha_fin == "") {
                alert('Debe ingresar Fecha de Termino');
                return;
            } else {
                if (confirm('Desea Ingresar Nuevo Permiso de Circulación?')) {
                    $.ajax({
                        url: 'permiso_circulacion.php',
                        type: 'post',
                        data: {
                            patente: patente,
                            fecha_ini: fecha_ini,
                            fecha_fin: fecha_fin
                        },
                        success: function(response) {
                            if (response == 1) {
                                window.alert("Permiso de Circulación Ingresado");
                                location.reload();
                            } else {
                                window.alert("Error en Ingreso");
                                return;
                            }
                        }
                    });
                }

            }
        }
    }
}

///seguro camioneta
function seguro_camioneta() {
    var patente = document.getElementById('patente_seg').value;
    var fecha_ini = document.getElementById('fecha_ingreso_seg').value;
    var fecha_fin = document.getElementById('fecha_termino_seg').value;
    if (patente == "") {
        alert('Debe ingresar Patente');
        return;
    } else {
        if (fecha_ini == "") {
            alert('Debe ingresar Fecha de Inicio');
            return;
        } else {
            if (fecha_fin == "") {
                alert('Debe ingresar Fecha de Termino');
                return;
            } else {
                if (confirm('Desea Ingresar Nuevo Seguro?')) {
                    $.ajax({
                        url: 'seguro_camioneta.php',
                        type: 'post',
                        data: {
                            patente: patente,
                            fecha_ini: fecha_ini,
                            fecha_fin: fecha_fin
                        },
                        success: function(response) {
                            if (response == 1) {
                                window.alert("Seguro Ingresado");
                                location.reload();
                            } else {
                                window.alert("Error en Ingreso");
                                return;
                            }
                        }
                    });
                }

            }
        }
    }
}


///revision tecnica
function revision_tecnica() {
    var patente = document.getElementById('patente_rt').value;
    var fecha_ini = document.getElementById('fecha_ingreso_rt').value;
    var fecha_fin = document.getElementById('fecha_termino_rt').value;
    if (patente == "") {
        alert('Debe ingresar Patente');
        return;
    } else {
        if (fecha_ini == "") {
            alert('Debe ingresar Fecha de Inicio');
            return;
        } else {
            if (fecha_fin == "") {
                alert('Debe ingresar Fecha de Termino');
                return;
            } else {
                if (confirm('Desea Revisión Técnica?')) {
                    $.ajax({
                        url: 'revision_tecnica.php',
                        type: 'post',
                        data: {
                            patente: patente,
                            fecha_ini: fecha_ini,
                            fecha_fin: fecha_fin
                        },
                        success: function(response) {
                            if (response == 1) {
                                window.alert("Revisión Técnica Ingresada");
                                location.reload();
                            } else {
                                window.alert("Error en Ingreso");
                                return;
                            }
                        }
                    });
                }

            }
        }
    }
}

//funcion checklist camioneta

function check_camionetas() {
    var nivel_comb = '';
    $('input[type=radio]').each(function() {
        if (this.checked) {
            nivel_comb += $(this).val();
        }
    });
    //window.alert(nivel_comb);
    var id_patente = document.getElementById('id_pat_check').value;
    var fecha = document.getElementById('fecha_check').value;
    var kilometraje = document.getElementById('km_check').value;
    var id_mecanico = document.getElementById('mec_check').value;
    var aceite_motor = document.getElementById('acmot_check').value;
    var ref_motor = document.getElementById('refmot_check').value;
    var aceite_hidr = document.getElementById('achid_check').value;
    var liq_frenos = document.getElementById('liq_frenos_check').value;
    var filtro_aire = document.getElementById('faire_check').value;
    var part_frio = document.getElementById('part_frio_check').value;
    var rev_indicadores = document.getElementById('revind_check').value;
    var corta_corriente = document.getElementById('ccorriente_check').value;
    var but_asientos = document.getElementById('butasi_check').value;
    var luces = document.getElementById('luces_check').value;
    var presion_neum = document.getElementById('presneu_check').value;
    var ant_interior = document.getElementById('antint_check').value;
    var ant_exterior = document.getElementById('antext_check').value;
    var freno_mano = document.getElementById('frmano_check').value;
    var rueda_repuesto = document.getElementById('rurep_check').value;
    var gata = document.getElementById('gata_check').value;
    var triang_cono = document.getElementById('tria_check').value;
    var chaleco_refl = document.getElementById('chalrefl_check').value;
    var rev_documentos = document.getElementById('revdocs_check').value;
    var extintor = document.getElementById('extintor_check').value;
    var baliza = document.getElementById('baliza_check').value;
    var alarm_retroceso = document.getElementById('alarret_check').value;
    var observaciones = document.getElementById('obs_check').value;

    //window.alert('id_patente:' + id_patente + ',' + 'fecha:' + fecha + ',' + 'kilometraje:' + kilometraje + ',' + 'id_mecanico:' + id_mecanico + ',' + 'aceite_motor:' + aceite_motor + ',' + 'ref_motor:' + ref_motor + ',' + 'aceite_hidr:' + aceite_hidr + ',' + 'liq_frenos:' + liq_frenos + ',' + 'nivel_comb:' + nivel_comb + ',' + 'filtro_aire:' + filtro_aire + ',' + 'part_frio:' + part_frio + ',' + 'rev_indicadores:' + rev_indicadores + ',' + 'corta_corriente:' + corta_corriente + ',' + 'but_asientos:' + but_asientos + ',' + 'luces:' + luces + ',' + 'presion_neum:' + presion_neum + ',' + 'ant_interior:' + ant_interior + ',' + 'ant_exterior:' + ant_exterior + ',' + 'freno_mano:' + freno_mano + ',' + 'rueda_repuesto:' + rueda_repuesto + ',' + 'gata:' + gata + ',' + 'triang_cono:' + triang_cono + ',' + 'chaleco_refl:' + chaleco_refl + ',' + 'rev_documentos:' + rev_documentos + ',' + 'extintor:' + extintor + ',' + 'baliza:' + baliza + ',' + 'alarm_retroceso:' + alarm_retroceso + ',' + 'observaciones:' + observaciones)


    if (id_patente == "") {
        alert('Debe ingresar Patente');
        return;
    } else {
        if (fecha == "") {
            alert('Debe ingresar Fecha');
            return;
        } else {
            if (kilometraje == "") {
                alert('Debe ingresar Kilometraje');
                return;
            } else {
                if (id_mecanico == "") {
                    alert('Debe ingresar Mecanico');
                    return;
                } else {
                    if (aceite_motor == "") {
                        alert('Debe ingresar Nivel Aceite Motor');
                        return;
                    } else {
                        if (ref_motor == "") {
                            alert('Debe ingresar Nivel Refrigeración de Motor');
                            return;
                        } else {
                            if (aceite_hidr == "") {
                                alert('Debe ingresar Nivel Acite Hidraulico');
                                return;
                            } else {
                                if (liq_frenos == "") {
                                    alert('Debe ingresar Nivel de Liquidos de Freno');
                                    return;
                                } else {
                                    if (filtro_aire == "") {
                                        alert('Debe ingresar Revisión de Filtros de Aire');
                                        return;
                                    } else {
                                        if (part_frio == "") {
                                            alert('Debe ingresar Partida en frio');
                                            return;
                                        } else {
                                            if (rev_indicadores == "") {
                                                alert('Debe ingresar Revisión de Indicadores');
                                                return;
                                            } else {
                                                if (corta_corriente == "") {
                                                    alert('Debe ingresar Corta Corriente');
                                                    return;
                                                } else {
                                                    if (but_asientos == "") {
                                                        alert('Debe ingresar Estado de Butacas y Asientos');
                                                        return;
                                                    } else {
                                                        if (luces == "") {
                                                            alert('Debe ingresar Estado de Luces');
                                                            return;
                                                        } else {
                                                            if (presion_neum == "") {
                                                                alert('Debe ingresar Estado de Presión Neumática');
                                                                return;
                                                            } else {
                                                                if (ant_interior == "") {
                                                                    alert('Debe ingresar Antivuelco Interior');
                                                                    return;
                                                                } else {
                                                                    if (ant_exterior == "") {
                                                                        alert('Debe ingresar Antivuelco Exterior');
                                                                        return;
                                                                    } else {
                                                                        if (freno_mano == "") {
                                                                            alert('Debe ingresar Freno de Mano');
                                                                            return;
                                                                        } else {
                                                                            if (rueda_repuesto == "") {
                                                                                alert('Debe ingresar Rueda de Repuesto');
                                                                                return;
                                                                            } else {
                                                                                if (gata == "") {
                                                                                    alert('Debe ingresar Gata');
                                                                                    return;
                                                                                } else {
                                                                                    if (triang_cono == "") {
                                                                                        alert('Debe ingresar Triangulo o Cono');
                                                                                        return;
                                                                                    } else {
                                                                                        if (chaleco_refl == "") {
                                                                                            alert('Debe ingresar Estado de Chaleco Reflectante');
                                                                                            return;
                                                                                        } else {
                                                                                            if (rev_documentos == "") {
                                                                                                alert('Debe ingresar Estado de Documentación');
                                                                                                return;
                                                                                            } else {
                                                                                                if (extintor == "") {
                                                                                                    alert('Debe ingresar Estado de Extintor');
                                                                                                    return;
                                                                                                } else {
                                                                                                    if (baliza == "") {
                                                                                                        alert('Debe ingresar Estado de Baliza');
                                                                                                        return;
                                                                                                    } else {
                                                                                                        if (alarm_retroceso == "") {
                                                                                                            alert('Debe ingresar Estado de Alarma de Retroceso');
                                                                                                            return;
                                                                                                        } else {
                                                                                                            if (confirm('Desea Ingresar Check?')) {
                                                                                                                $.ajax({
                                                                                                                    url: 'check_camioneta.php',
                                                                                                                    type: 'post',
                                                                                                                    data: {
                                                                                                                        id_patente: id_patente,
                                                                                                                        fecha: fecha,
                                                                                                                        kilometraje: kilometraje,
                                                                                                                        id_mecanico: id_mecanico,
                                                                                                                        aceite_motor: aceite_motor,
                                                                                                                        ref_motor: ref_motor,
                                                                                                                        aceite_hidr: aceite_hidr,
                                                                                                                        liq_frenos: liq_frenos,
                                                                                                                        nivel_comb: nivel_comb,
                                                                                                                        filtro_aire: filtro_aire,
                                                                                                                        part_frio: part_frio,
                                                                                                                        rev_indicadores: rev_indicadores,
                                                                                                                        corta_corriente: corta_corriente,
                                                                                                                        but_asientos: but_asientos,
                                                                                                                        luces: luces,
                                                                                                                        presion_neum: presion_neum,
                                                                                                                        ant_interior: ant_interior,
                                                                                                                        ant_exterior: ant_exterior,
                                                                                                                        freno_mano: freno_mano,
                                                                                                                        rueda_repuesto: rueda_repuesto,
                                                                                                                        gata: gata,
                                                                                                                        triang_cono: triang_cono,
                                                                                                                        chaleco_refl: chaleco_refl,
                                                                                                                        rev_documentos: rev_documentos,
                                                                                                                        extintor: extintor,
                                                                                                                        baliza: baliza,
                                                                                                                        alarm_retroceso: alarm_retroceso,
                                                                                                                        observaciones: observaciones
                                                                                                                    },
                                                                                                                    success: function(response) {
                                                                                                                        if (response == 1) {
                                                                                                                            window.alert("Control Semanal de Camioneta Ingresado");
                                                                                                                            location.reload();
                                                                                                                        } else if (response == 3) {
                                                                                                                            window.alert("Kilometraje no debe ser menor al ultimo registro");
                                                                                                                            return;
                                                                                                                        } else {
                                                                                                                            window.alert("Error en Ingreso");
                                                                                                                            return;
                                                                                                                        }
                                                                                                                    }
                                                                                                                });

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
                            }
                        }
                    }
                }
            }
        }
    }
};


//funcion mantenumiento camioneta
function mant_cam_nuevo() {
    var selected = '';
    $('input[type=checkbox]').each(function() {
        if (this.checked) {
            selected += $(this).val() + ' - ';
        }
    });

    var selected2 = selected.substring(0, selected.length - 10);
    var fecha = document.getElementById('fecha_mant_cam').value;
    var id_camioneta = document.getElementById('patente_mant_cam').value;
    var id_est_equipo = document.getElementById('id_est_equipo_mant_cam').value;
    var observaciones = document.getElementById('observaciones_man_cam').value;
    var kilometraje = document.getElementById('km_mant_cam').value;

    //window.alert('prueba: ' + selected2 + ',' + fecha + ',' + id_camioneta + ',' + observaciones + ',' + kilometraje);

    if (fecha == "") {
        alert('Debe ingresar Fecha');
        return;
    } else {
        if (id_camioneta == "") {
            alert('Debe ingresar Patente');
            return;
        } else {
            if (id_est_equipo == "") {
                alert('Debe ingresar Estado de Camioneta');
                return;
            } else {
                if (kilometraje == "") {
                    alert('Debe ingresar Estado de Camioneta');
                    return;
                } else {
                    if (confirm('Desea Ingresar Mantención de Camioneta?')) {
                        $.ajax({
                            url: 'nueva_mant_camioneta.php',
                            type: 'post',
                            data: {
                                selected2: selected2,
                                fecha: fecha,
                                id_camioneta: id_camioneta,
                                id_est_equipo: id_est_equipo,
                                observaciones: observaciones,
                                kilometraje: kilometraje
                            },
                            success: function(response) {
                                if (response == 1) {
                                    window.alert("Mantención de Camioneta Ingresada");
                                    location.reload();
                                } else if (response == 3) {
                                    window.alert("Kilometraje ingresado no puede ser menor al ultimo Kilometraje registrado");
                                    return;
                                } else {
                                    window.alert("Error en Ingreso");
                                    return;
                                }
                            }
                        });
                    }
                }
            }
        }
    }
};



///// funcion informe disponibilidad

function Informe_disponibilidad() {
    var desde = document.getElementById('desde').value;
    var hasta = document.getElementById('hasta').value;

    if (desde == "") {
        alert('Debe ingresar Fecha Desde');
        return;
    } else {
        if (hasta == "") {
            alert('Debe ingresar Fecha Hasta');
            return;
        } else {
            if (confirm('Desea crear Informe?')) {
                $.ajax({
                    url: 'tabla_informe_disponibilidad.php',
                    type: 'post',
                    data: {
                        desde: desde,
                        hasta: hasta

                    },
                    success: function(datos) {
                        $('#tabla_informe_disponibilidad').html(datos);
                    }
                });

            }
        }
    }
};

////
function detalles_informe(num, desde, hasta, ID, modelo, tipo) {
    $('.cod_equipo_informe').html(num);
    $('.fecha_desde').val(desde);
    $('.fecha_hasta').val(hasta);
    $('.cod_ID').html(ID + ' - ' + modelo + ' - ' + tipo);

    var url = "detalle_informe_disp.php";
    var num = num;
    var desde = desde;
    var hasta = hasta;
    $.ajax({
        type: "POST",
        url: url,
        data: {
            num: num,
            desde: desde,
            hasta: hasta
        },
        success: function(datos) {
            $('#tabla_detalle_informe').html(datos);
            $('#modal_informe_disp').modal('show');
        }
    });
};

function modal_informe() {
    $('#modal_informe_disp').modal('show');
}

/////////////////

$(document).ready(function() {
    $('#tequipo_informe').val(1);
    recargarLista_informe();

    $('#tequipo_informe').change(function() {
        recargarLista_informe();
    });
});

function recargarLista_informe() {
    $.ajax({
        type: "POST",
        url: "select_equipo_informe.php",
        data: "tipo=" + $('#tequipo_informe').val(),
        success: function(r) {
            $('#selectlistainforme').html(r);
        }
    });
};

//////////////////////


function Informe_Equipo() {
    var tequipo = document.getElementById('tequipo').value;
    var id_equipo = document.getElementById('id_equipo_informe').value;
    var mes_equipo = document.getElementById('mes_equipo').value;
    var ano_equipo = document.getElementById('ano_equipo').value;

    if (tequipo == "") {
        alert('Debe ingresar Tipo');
        return;
    } else {
        if (id_equipo == "") {
            alert('Debe ingresar Codigo');
            return;
        } else {
            if (mes_equipo == "") {
                alert('Debe ingresar Mes');
                return;
            } else {
                if (ano_equipo == "") {
                    alert('Debe ingresar Año');
                    return;
                } else {
                    if (confirm('Desea crear Informe?')) {
                        $.ajax({
                            url: 'tabla_informe_equipo_.php',
                            type: 'post',
                            data: {
                                id_equipo: id_equipo,
                                mes_equipo: mes_equipo,
                                ano_equipo: ano_equipo
                            },
                            success: function(datos) {
                                $('#tabla_informe_equipo_').html(datos);
                            }
                        });

                    }
                }

            }

        }
    }
};

function Cajas_Equipo() {
    var id_equipo = document.getElementById('id_equipo_informe').value;
    var mes_equipo = document.getElementById('mes_equipo').value;
    var ano_equipo = document.getElementById('ano_equipo').value;
    //window.alert(id_equipo);
    $.ajax({
        url: 'cajas_informe_equipo.php',
        type: 'post',
        data: {
            id_equipo: id_equipo,
            mes_equipo: mes_equipo,
            ano_equipo: ano_equipo
        },
        success: function(datos) {
            $('#cajas_informe_equipo').html(datos);
        }
    });
};

function Grafico_Equipo() {
    var id_equipo = document.getElementById('id_equipo_informe').value;
    var mes_equipo = document.getElementById('mes_equipo').value;
    var ano_equipo = document.getElementById('ano_equipo').value;
    //window.alert(id_equipo);
    $.ajax({
        url: 'grafico_equipo.php',
        type: 'post',
        data: {
            id_equipo: id_equipo,
            mes_equipo: mes_equipo,
            ano_equipo: ano_equipo
        },
        success: function(datos) {
            $('#grafico_equipo').html(datos);
        }
    });
};


function Grafico_Reparaciones() {
    var id_equipo = document.getElementById('id_equipo_informe').value;
    var mes_equipo = document.getElementById('mes_equipo').value;
    var ano_equipo = document.getElementById('ano_equipo').value;
    $.ajax({
        url: 'grafico_reparaciones.php',
        type: 'post',
        data: {
            id_equipo: id_equipo,
            mes_equipo: mes_equipo,
            ano_equipo: ano_equipo
        },
        success: function(datos) {
            $('#grafico_reparaciones').html(datos);
        }
    });
};