function recepcion_geo(id, usuario) {
    //window.alert(usuario);
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