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


////////////////
function horario_colacion(id_ubicacion, fecha) {
    window.alert(id_ubicacion, fecha);
    var url = "lista_hist_equipos.php";
    var id_ubicacion = id_ubicacion;
    var fecha = fecha;
    $.ajax({
        type: "POST",
        url: url,
        data: {
            num: num
        },
        success: function() {
            $('#modal_taller').modal('show');
        }
    });

}