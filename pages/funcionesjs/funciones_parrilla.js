/* select dinamico */
$(document).ready(function() {
    $('#geo_id_mina').val(1);
    recargarLista();

    $('#geo_id_mina').change(function() {
        recargarLista();
    });
});

function recargarLista() {
    $.ajax({
        type: "POST",
        url: "select_manto_dinamico.php",
        data: "tipo=" + $('#geo_id_mina').val(),
        success: function(r) {
            $('#select_manto').html(r);
        }
    });
};

// ingreso extracción de mineral
function nueva_ext_min() {
    var id_ubicacion = document.getElementById('geo_id_mina').value;
    var id_manto = document.getElementById('geo_id_manto').value;
    var id_calle = document.getElementById('geo_id_calle').value;
    var id_labor = document.getElementById('geo_id_labor').value;
    var fecha = document.getElementById('fecha_geo_muestra').value;
    var id_op = document.getElementById('ext_operador').value;
    var id_equipo = document.getElementById('ext_dumper').value;
    var tipo = document.getElementById('ext_tipo').value;
    var id_obs_min = document.getElementById('ext_obs').value;
    var hora1 = document.getElementById('ext_hora1').value;
    var hora2 = document.getElementById('ext_hora2').value;
    var hora3 = document.getElementById('ext_hora3').value;
    var hora4 = document.getElementById('ext_hora4').value;
    var hora5 = document.getElementById('ext_hora5').value;
    var usuario = document.getElementById('usuario').value;

    if (id_ubicacion == "") {
        alert('Debe ingresar Mina');
        return;
    } else {
        if (id_manto == "") {
            alert('Debe ingresar Manto');
            return;
        } else {

            if (fecha == "") {
                alert('Debe ingresar Fecha');
                return;
            } else {
                if (id_op == "") {
                    alert('Debe ingresar Operador');
                    return;
                } else {
                    if (id_equipo == "") {
                        alert('Debe ingresar N° de Dumper');
                        return;
                    } else {
                        if (tipo == "") {
                            alert('Debe ingresar Tipo');
                            return;
                        } else {
                            if (hora1 == "") {
                                alert('Debe ingresar Hora');
                                return;
                            } else {
                                if (confirm('Desea Ingresar Registro de Extracción de Mineral?')) {
                                    $.ajax({
                                        url: 'ingreso_nueva_extr.php',
                                        type: 'post',
                                        data: {
                                            id_ubicacion: id_ubicacion,
                                            id_manto: id_manto,
                                            id_calle: id_calle,
                                            id_labor: id_labor,
                                            fecha: fecha,
                                            id_op: id_op,
                                            id_equipo: id_equipo,
                                            tipo: tipo,
                                            id_obs_min: id_obs_min,
                                            hora1: hora1,
                                            hora2: hora2,
                                            hora3: hora3,
                                            hora4: hora4,
                                            hora5: hora5,
                                            usuario: usuario
                                        },
                                        success: function(response) {
                                            if (response == 1) {
                                                window.alert("Registro Extracción Mineral Ingresado");
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


// cambiar estado extracción de mineral
function cerrar_extmin(id_extmin) {
    if (confirm('Desea Confirmar Extracción?')) {
        $.ajax({
            url: 'confirmar_extraccion.php',
            type: 'post',
            data: {
                id_extmin: id_extmin,
            },
            success: function(response) {
                if (response == 1) {
                    window.alert("Extracción de Mineral Confirmada");
                    location.reload()
                } else if (response == 2) {
                    window.alert("Error");
                    return;

                }
            }
        });
    }

}

function editar_extmin(id_extmin, id_ubicacion, id_manto, id_calle, id_labor, fecha, id_equipo, id_op, id_mineral, id_obs_min, hora1, hora2, hora3, hora4, hora5) {
    $('#edit_id_extmin').val(id_extmin);
    $('#edit_id_ubicacion').val(id_ubicacion);
    $('#edit_id_manto').val(id_manto);
    $('#edit_id_calle').val(id_calle);
    $('#edit_id_labor').val(id_labor);
    $('#edit_fecha').val(fecha);
    $('#edit_id_equipo').val(id_equipo);
    $('#edit_id_op').val(id_op);
    $('#edit_id_mineral').val(id_mineral);
    $('#edit_id_obs_min').val(id_obs_min);
    $('#edit_hora1').val(hora1);
    $('#edit_hora2').val(hora2);
    $('#edit_hora3').val(hora3);
    $('#edit_hora4').val(hora4);
    $('#edit_hora5').val(hora5);
    $('#editar_extraccion').modal('show');
}

function update_extraccion() {
    var id_extmin = document.getElementById('edit_id_extmin').value;
    var id_ubicacion = document.getElementById('edit_id_ubicacion').value;
    var id_manto = document.getElementById('edit_id_manto').value;
    var id_calle = document.getElementById('edit_id_calle').value;
    var id_labor = document.getElementById('edit_id_labor').value;
    var fecha = document.getElementById('edit_fecha').value;
    var id_op = document.getElementById('edit_id_op').value;
    var id_equipo = document.getElementById('edit_id_equipo').value;
    var tipo = document.getElementById('edit_id_mineral').value;
    var id_obs_min = document.getElementById('edit_id_obs_min').value;
    var hora1 = document.getElementById('edit_hora1').value;
    var hora2 = document.getElementById('edit_hora2').value;
    var hora3 = document.getElementById('edit_hora3').value;
    var hora4 = document.getElementById('edit_hora4').value;
    var hora5 = document.getElementById('edit_hora5').value;
    if (confirm('Desea Editar Registro de Extracción de Mineral?')) {
        $.ajax({
            url: 'update_extraccion.php',
            type: 'post',
            data: {
                id_extmin: id_extmin,
                id_ubicacion: id_ubicacion,
                id_manto: id_manto,
                id_calle: id_calle,
                id_labor: id_labor,
                fecha: fecha,
                id_op: id_op,
                id_equipo: id_equipo,
                tipo: tipo,
                id_obs_min: id_obs_min,
                hora1: hora1,
                hora2: hora2,
                hora3: hora3,
                hora4: hora4,
                hora5: hora5,
            },
            success: function(response) {
                if (response == 1) {
                    window.alert("Registro Extracción Mineral Editado");
                    location.reload();

                } else {
                    window.alert("Error en Ingreso");
                    return;
                }
            }
        });
    }

}


$(document).ready(function() {
    $('#report_fecha').val(1);
    recargarExtrMin();

    $('#report_fecha').change(function() {
        recargarExtrMin();
    });

});

function recargarExtrMin() {
    var fecha = $('#report_fecha').val();
    $.ajax({
        url: 'tabla_extr_min_dia.php',
        type: 'post',
        data: {
            fecha: fecha,
        },
        success: function(datos) {
            $('#tabla_report_extr_diaria').html(datos);

        }
    });
    $.ajax({
        url: 'target_report_extr_diario.php',
        type: 'post',
        data: {
            fecha: fecha,
        },
        success: function(datos) {
            $('#target_report_extr_diario').html(datos);

        }
    });
};

function informe_extraccion_mensual() {
    var mes = document.getElementById('mes_equipo_informe').value;
    var ano = document.getElementById('ano_equipo_informe').value;
    if (confirm('Desea crear Informe?')) {
        $.ajax({
            url: 'tabla_extr_min_mensual.php',
            type: 'post',
            data: {
                mes: mes,
                ano: ano
            },
            success: function(datos) {
                $('#tabla_report_extr_mensual').html(datos);

            }
        });
        $.ajax({
            url: 'target_report_extr_mensual.php',
            type: 'post',
            data: {
                mes: mes,
                ano: ano
            },
            success: function(datos) {
                $('#target_report_extr_mensual').html(datos);

            }
        });
        $.ajax({
            url: 'grafico_mes_extr.php',
            type: 'post',
            data: {
                mes: mes,
                ano: ano
            },
            success: function(datos) {
                $('#grafico_mes_extr').html(datos);

            }
        });
        $.ajax({
            url: 'grafico_oxido_sulfuro_extr.php',
            type: 'post',
            data: {
                mes: mes,
                ano: ano
            },
            success: function(datos) {
                $('#grafico_oxido_sulfuro_extr').html(datos);

            }
        });

    }

}

function nuevo_lote() {
    var num_lote = document.getElementById('num_lote').value;
    var id_emplot = document.getElementById('id_emplot').value;
    var mes = document.getElementById('mes').value;
    var ano = document.getElementById('ano').value;
    var id_lote0 = document.getElementById('id_lote0').value;

    if (id_emplot == "") {
        alert('Debe ingresar Empresa');
        return;
    } else {
        if (mes == "") {
            alert('Debe ingresar Mes');
            return;
        } else {
            if (ano == "") {
                alert('Debe ingresar Año');
                return;
            } else {
                if (id_lote0 == "") {
                    if (confirm('Desea Ingresar Lote?')) {
                        $.ajax({
                            url: 'nuevo_lote.php',
                            type: 'post',
                            data: {
                                num_lote: num_lote,
                                id_emplot: id_emplot,
                                mes: mes,
                                ano: ano
                            },
                            success: function(response) {
                                if (response == 1) {
                                    window.alert("Lote Ingresado");
                                    location.reload();

                                } else {
                                    window.alert("Error en Ingreso");
                                    return;
                                }
                            }
                        });
                    }
                } else {
                    if (confirm('Desea Editar Lote?')) {
                        $.ajax({
                            url: 'editar_lote.php',
                            type: 'post',
                            data: {
                                num_lote: num_lote,
                                id_emplot: id_emplot,
                                mes: mes,
                                ano: ano,
                                id_lote0: id_lote0
                            },
                            success: function(response) {
                                if (response == 1) {
                                    window.alert("Lote Editado");
                                    location.reload();

                                } else {
                                    window.alert("Error en Edición");
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

function guias_lote(id_lote) {
    var id_lote = id_lote;
    $('#id_lote').val(id_lote);
    $('#guias_lote').modal('show');
    $.ajax({
        url: 'tabla_guias_oxido.php',
        type: 'post',
        data: {
            id_lote: id_lote
        },
        success: function(datos) {
            $('#tablaguiasoxido').html(datos);
        }
    });

}

function guia_oxido() {
    var id_guia = document.getElementById('id_guia').value;
    var id_lote = document.getElementById('id_lote').value;
    var fecha = document.getElementById('guia_fecha').value;
    var hora = document.getElementById('guia_hora').value;
    var id_ubicacion = document.getElementById('guia_mina').value;
    var num_guia = document.getElementById('num_guia').value;
    var id_patente = document.getElementById('guia_patente').value;
    var id_chofer = document.getElementById('guia_chofer').value;
    var tonelaje = document.getElementById('guia_tonelaje').value;
    var leyvis = document.getElementById('guia_ley').value;
    var usuario = document.getElementById('usuario').value;


    if (fecha == "") {
        alert('Debe ingresar Fecha');
        return;
    } else {
        if (hora == "") {
            alert('Debe ingresar Hora');
            return;
        } else {
            if (id_ubicacion == "") {
                alert('Debe ingresar Mina');
                return;
            } else {
                if (num_guia == "") {
                    alert('Debe ingresar N° de Guía');
                    return;
                } else {
                    if (id_patente == "") {
                        alert('Debe ingresar Patente');
                        return;
                    } else {
                        if (id_chofer == "") {
                            alert('Debe ingresar Chofer');
                            return;
                        } else {
                            if (id_guia == "") {
                                if (confirm('Desea Ingresar Guía?')) {
                                    $.ajax({
                                        url: 'nueva_guia_oxido.php',
                                        type: 'post',
                                        data: {
                                            id_lote: id_lote,
                                            fecha: fecha,
                                            hora: hora,
                                            id_ubicacion: id_ubicacion,
                                            num_guia: num_guia,
                                            id_patente: id_patente,
                                            id_chofer: id_chofer,
                                            tonelaje: tonelaje,
                                            leyvis: leyvis,
                                            usuario: usuario
                                        },
                                        success: function(response) {
                                            if (response == 1) {
                                                window.alert("Guía Ingresado");
                                                location.reload();
                                            } else {
                                                window.alert("Error en Ingreso");
                                                return;
                                            }
                                        }
                                    });
                                }

                            } else {

                                if (confirm('Desea Editar Guía?')) {
                                    $.ajax({
                                        url: 'edit_guia_oxido.php',
                                        type: 'post',
                                        data: {
                                            id_guia: id_guia,
                                            id_lote: id_lote,
                                            fecha: fecha,
                                            hora: hora,
                                            id_ubicacion: id_ubicacion,
                                            num_guia: num_guia,
                                            id_patente: id_patente,
                                            id_chofer: id_chofer,
                                            tonelaje: tonelaje,
                                            leyvis: leyvis,
                                        },
                                        success: function(response) {
                                            if (response == 1) {
                                                window.alert("Guía Editaada");
                                                location.reload();
                                            } else {
                                                window.alert("Error en Edición");
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

function edit_guia_oxido(id_lote, id_guia, fecha, hora, id_ubicacion, num_guia, id_patente, id_chofer, tonelaje, leyvis) {
    $('#id_lote').val(id_lote);
    $('#id_guia').val(id_guia);
    $('#guia_fecha').val(fecha);
    $('#guia_hora').val(hora);
    $('#guia_mina').val(id_ubicacion);
    $('#num_guia').val(num_guia);
    $('#guia_patente').val(id_patente);
    $('#guia_chofer').val(id_chofer);
    $('#guia_tonelaje').val(tonelaje);
    $('#guia_ley').val(leyvis);



}

function edit_lote(id_lote, num_lote, id_emplot, mes, ano) {
    $('#id_lote0').val(id_lote);
    $('#num_lote').val(num_lote);
    $('#id_emplot').val(id_emplot);
    $('#mes').val(mes);
    $('#ano').val(ano);
    $('#modal_nuevo_lote').modal('show');

}

function cerrar_lote(id_lote) {
    var id_lote = id_lote;
    if (confirm('Desea Cerrar Lote?')) {
        $.ajax({
            url: 'cerrar_lote.php',
            type: 'post',
            data: {
                id_lote: id_lote
            },
            success: function(response) {
                if (response == 1) {
                    window.alert("Lote Cerrado");
                    location.reload();
                } else {
                    window.alert("Error en Edición");
                    return;
                }
            }
        });
    }
}

function guias_lote_mensual(id_lote) {
    var id_lote = id_lote;
    $('#id_lote').val(id_lote);
    $('#guias_lote_mensual').modal('show');
    $.ajax({
        url: 'tabla_guias_oxido_mensual.php',
        type: 'post',
        data: {
            id_lote: id_lote
        },
        success: function(datos) {
            $('#tablaguiasoxidomensual').html(datos);
        }
    });

}

function reporte_mensual_lotes() {
    var mes = document.getElementById('mes_report_lote').value;
    var ano = document.getElementById('ano_report_lote').value;
    $.ajax({
        url: 'tabla_lotes_mensual.php',
        type: 'post',
        data: {
            mes: mes,
            ano: ano
        },
        success: function(datos) {
            $('#tabla_lotes_mensual').html(datos);
        }
    });

}

function nuevo_lote_modal() {
    $('#modal_nuevo_lote').modal('show');
}