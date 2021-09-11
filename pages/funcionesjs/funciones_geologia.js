//nueva muestra
function muestra_geo_nueva() {
    var id_ubicacion = document.getElementById('geo_id_mina').value;
    var id_manto = document.getElementById('geo_id_manto').value;
    var id_calle = document.getElementById('geo_id_calle').value;
    var id_labor = document.getElementById('geo_id_labor').value;
    var fecha = document.getElementById('fecha_geo_muestra').value;
    var CutVisual = document.getElementById('geo_CutVisual').value;
    var CusVisual = document.getElementById('geo_CusVisual').value;
    var frente = document.getElementById('geo_frente').value;
    var observaciones = document.getElementById('geo_observaciones').value;
    var tipo = document.getElementById('geo_tipo').value;
    var usuario = document.getElementById('usuario').value;

    if (id_ubicacion == "") {
        alert('Debe ingresar Mina');
        return;
    } else {
        if (id_manto == "") {
            alert('Debe ingresar Manto');
            return;
        } else {
            if (id_calle == "" && id_labor != "") {
                alert('Debe ingresar Calle');
                return;
            } else {
                if (fecha == "") {
                    alert('Debe ingresar Fecha');
                    return;
                } else {
                    if (CutVisual == "") {
                        alert('Debe ingresar CutVisual');
                        return;
                    } else {
                        if (CusVisual == "") {
                            alert('Debe ingresar CusVisual');
                            return;
                        } else {
                            if (frente == "") {
                                alert('Debe ingresar Porcentaje de Frente');
                                return;
                            } else {
                                if (tipo == "") {
                                    alert('Debe ingresar ');
                                    return;
                                } else {
                                    if (confirm('Desea Ingresar Muestra?')) {
                                        $.ajax({
                                            url: 'nuevo_muestra_geo.php',
                                            type: 'post',
                                            data: {
                                                fecha: fecha,
                                                id_ubicacion: id_ubicacion,
                                                id_manto: id_manto,
                                                id_calle: id_calle,
                                                id_labor: id_labor,
                                                CutVisual: CutVisual,
                                                CusVisual: CusVisual,
                                                frente: frente,
                                                observaciones: observaciones,
                                                tipo: tipo,
                                                usuario: usuario
                                            },
                                            success: function(response) {
                                                if (response == 1) {
                                                    window.alert("Muestra de Geologia Ingresada");
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

    }

};

// funcion etiqueta QR
function etiqueta_muestra_geo(id) {
    window.open('codeqr.php?id=' + id);
};

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

//Nueva coordenada
function nueva_coordenada() {
    var tipo = document.getElementById('tipo_coordenada').value;
    var id_ubicacion = document.getElementById('coordenada_mina').value;
    var coordenada = document.getElementById('coordenada_nueva').value;
    var usuario = document.getElementById('usuario').value;

    if (tipo == "") {
        alert('Debe ingresar Tipo');
        return;
    } else {
        if (coordenada == "") {
            alert('Debe ingresar Coordenada');
            return;
        } else {
            if (confirm('Desea Ingresar Coordenada?')) {
                $.ajax({
                    url: 'nueva_coordenada.php',
                    type: 'post',
                    data: {
                        tipo: tipo,
                        id_ubicacion: id_ubicacion,
                        coordenada: coordenada,
                        usuario: usuario
                    },
                    success: function(response) {
                        if (response == 1) {
                            window.alert("Debe ingresar Mina");
                            return;
                        } else if (response == 2) {
                            window.alert("Coordenada Ingresada");
                            location.reload();
                        } else if (response == 3) {
                            window.alert("Coordenada ya existe");
                            return;
                        } else if (response == 4) {
                            window.alert("Este usuario no tiene permitido realizar esta acción");
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
};



function getDetails(id, ubicacion) {
    $('.id_geo').val(id);
    $('.cod_ubicacion').html(ubicacion);
};

function ingresar_xyz() {
    $('#ingreso_xyz').modal('show');
};