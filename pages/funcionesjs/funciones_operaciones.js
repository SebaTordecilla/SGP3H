//funcion mantenumiento camioneta
function disparo_nuevo() {
    var fecha = document.getElementById('fecha_disp').value;
    var turno = document.getElementById('disp_turno').value;
    var jornada = document.getElementById('disp_jornada').value;
    var id_perforo = document.getElementById('disp_id_perforo').value;
    var id_material = document.getElementById('disp_id_material').value;
    var id_ubicacion = document.getElementById('disp_id_mina').value;
    var id_manto = document.getElementById('disp_id_manto').value;
    var id_calle = document.getElementById('disp_id_calle').value;
    var id_labor = document.getElementById('disp_id_labor').value;
    var tiros = document.getElementById('disp_tiros').value;
    var longtiro = document.getElementById('disp_longtiros').value;
    var observaciones = document.getElementById('disp_observaciones').value;
    var usuario = document.getElementById('usuario').value;
    //window.alert(longtiros);
    if (fecha == "") {
        alert('Debe ingresar Fecha');
        return;
    } else {
        if (turno == "") {
            alert('Debe ingresar Turno');
            return;
        } else {
            if (jornada == "") {
                alert('Debe ingresar Jornada');
                return;
            } else {
                if (id_perforo == "") {
                    alert('Debe ingresar Perforista');
                    return;
                } else {
                    if (id_material == "") {
                        alert('Debe ingresar Tipo');
                        return;
                    } else {
                        if (id_ubicacion == "") {
                            alert('Debe ingresar Mina');
                            return;
                        } else {
                            if (id_manto == "") {
                                alert('Debe ingresar Manto');
                                return;
                            } else {
                                if (id_calle == "") {
                                    alert('Debe ingresar Calle');
                                    return;
                                } else {
                                    if (tiros == "") {
                                        alert('Debe ingresar N° de Tiros');
                                        return;
                                    } else {
                                        if (longtiro == "") {
                                            alert('Debe ingresar Longitud de Tiro');
                                            return;
                                        } else {
                                            if (confirm('Desea Ingresar Disparos?')) {
                                                $.ajax({
                                                    url: 'nuevo_disparo.php',
                                                    type: 'post',
                                                    data: {
                                                        fecha: fecha,
                                                        turno: turno,
                                                        jornada: jornada,
                                                        id_perforo: id_perforo,
                                                        id_material: id_material,
                                                        id_ubicacion: id_ubicacion,
                                                        id_manto: id_manto,
                                                        id_calle: id_calle,
                                                        id_labor: id_labor,
                                                        tiros: tiros,
                                                        longtiro: longtiro,
                                                        observaciones: observaciones,
                                                        usuario: usuario
                                                    },
                                                    success: function(response) {
                                                        if (response == 1) {
                                                            window.alert("Disparos Ingresados");
                                                            location.reload();
                                                        } else if (response == 3) {
                                                            window.alert("Error en Ingreso");
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
};

///
function confirmar_disparo(id_disparo) {
    var url = "confirmar_disparo.php";
    var id_disparo = id_disparo;
    if (confirm('Desea Confirmar Registro?')) {
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_disparo: id_disparo
            },
            success: function(response) {
                if (response == 1) {
                    window.alert("Registro Confirmado");
                    location.reload();
                } else if (response == 2) {
                    window.alert("Error");
                    return;
                } else {
                    window.alert("Error");
                    return;
                }
            }
        });
    }
}