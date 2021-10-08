function getDetails3(idr) {
    $('.id_salida').val(idr);
};

function modal_repa() {
    $('#reparaciones_').modal('show');
};



function reparacion() {
    var id_falla = document.getElementById('id_falla').value;
    var hora_mec = document.getElementById('hora_mec').value;
    var duracion = document.getElementById('duracion').value;
    var observaciones = document.getElementById('observaciones').value;
    var id_salida = document.getElementById('id_salida').value;
    //window.alert(id_salida)
    if (id_falla == "") {
        alert('Debe ingresar Falla');
        return;
    } else {
        if (hora_mec == "") {
            alert('Debe ingresar Hora de LLegada');
            return;
        } else {
            if (duracion == "") {
                alert('Debe ingresar Duracción');
                return;
            } else {
                if (confirm('Desea Registrar Reparación?')) {
                    $.ajax({
                        url: 'ingreso_repa.php',
                        type: 'post',
                        data: {
                            id_falla: id_falla,
                            hora_mec: hora_mec,
                            duracion: duracion,
                            observaciones: observaciones,
                            id_salida: id_salida
                        },
                        success: function(response) {
                            if (response == 1) {
                                window.alert("hora de llegada no puede ser menor a hora de solicitud");
                                return;
                            } else if (response == 2) {
                                window.alert("Reparación ingresada con éxito");
                                location.reload();
                            }
                        }
                    });
                }
            }
        }
    }
};