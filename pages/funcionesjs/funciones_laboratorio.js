function recepcion_geo(id, usuario) {
    var url = "conf_recep_geo.php";
    var id = id;
    var usuario = usuario;
    if (confirm('Desea Confirmar Recepción?')) {
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id: id,
                usuario: usuario
            },
            success: function(response) {
                if (response == 1) {
                    window.alert("Registro Confirmado");
                    location.reload();
                } else if (response == 2) {
                    window.alert("Error");
                    return;
                } else if (response == 3) {
                    window.alert("Este usuario no tiene permiso para realizar esta acción");
                    return;
                } else {
                    window.alert("Error");
                    return;
                }
            }
        });
    }
}

// ingresar datos geo muestras
function getDetails(id) {
    $('.id_geo').val(id);
};

function ingresar_datos_geo() {
    $('#ingreso_muestras_geo').modal('show');
};


// ingresar datos laborataorio geologia
function muestra_geo_lab() {
    var id_geom = document.getElementById('id_geo').value;
    var cutlab = document.getElementById('geo_labCutVisual').value;
    var cuslab = document.getElementById('geo_labCusVisual').value;
    var usuario = document.getElementById('usuario').value;
    if (cutlab == "") {
        alert('Debe ingresar CutLab');
        return;
    } else {
        if (cuslab == "") {
            alert('Debe ingresar CusLab');
            return;
        } else {
            if (confirm('Desea Ingresar Datos?')) {
                $.ajax({
                    url: 'lab_geo_datos.php',
                    type: 'post',
                    data: {
                        id_geom: id_geom,
                        cutlab: cutlab,
                        cuslab: cuslab,
                        usuario: usuario
                    },
                    success: function(response) {
                        if (response == 1) {
                            window.alert("Datos Ingresados");
                            location.reload();
                        } else if (response == 2) {
                            window.alert("Este usuario no tiene permitido modificar este dato una vez fue ingresado");
                            return;
                        } else {
                            window.alert("error");
                            location.reload();
                            msg = "";
                        }
                    }
                });
            }

        }
    }
}

///

function confirmar_datos_geo(id) {
    var id_geom = id;
    var usuario = document.getElementById('usuario').value;
    //window.alert(usuario + id_geom);
    if (confirm('Desea Confirmar Datos?')) {
        $.ajax({
            url: 'conf_lab_geo.php',
            type: 'post',
            data: {
                id_geom: id_geom,
                usuario: usuario
            },
            success: function(response) {
                if (response == 1) {
                    window.alert("Datos Confirmados");
                    location.reload();
                } else if (response == 2) {
                    window.alert("Debe ingresar CutLab o CusLab faltantes");
                    return;
                } else if (response == 3) {
                    window.alert("Este usuario no tiene permitido realizar esta acción");
                    return;
                } else {
                    window.alert("error");
                    location.reload();
                    msg = "";
                }
            }
        });
    }
}