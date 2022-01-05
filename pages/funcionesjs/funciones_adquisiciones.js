function modal_nueva_oc() {
    $('#modal_nueva_oc').modal('show');
}

function nueva_oc() {
    const id_empresa = document.getElementById('adq_id_empresa').value;
    const id_proveedor = document.getElementById('adq_id_proveedor').value;
    const fecha = document.getElementById('adq_fecha').value;
    const pago = document.getElementById('adq_pago').value;
    const cotizacion = document.getElementById('adq_cotizacion').value;
    const id_pedido = document.getElementById('adq_id_pedido').value;

    if (id_empresa == "") {
        alert('Debe ingresar Empresa');
        return;
    } else {
        if (id_proveedor == "") {
            alert('Debe ingresar Proveedor');
            return;
        } else {
            if (fecha == "") {
                alert('Debe ingresar Fecha');
                return;
            } else {
                if (pago == "") {
                    alert('Debe ingresar Condición de Pago');
                    return;
                } else {
                    if (cotizacion == "") {
                        alert('Debe ingresar N° de Cotización');
                        return;
                    } else {
                        if (id_pedido == "") {
                            alert('Debe ingresar N° de pedido');
                            return;
                        } else {
                            if (confirm('Desea Ingresar OC?')) {
                                $.ajax({
                                    url: 'nueva_oc.php',
                                    type: 'post',
                                    data: {
                                        id_empresa: id_empresa,
                                        id_proveedor: id_proveedor,
                                        fecha: fecha,
                                        pago: pago,
                                        cotizacion: cotizacion,
                                        id_pedido: id_pedido

                                    },
                                    success: function(response) {
                                        if (response == 1) {
                                            window.alert("OC Ingresada");
                                            location.reload();
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
        }
    }
}


function articulos_oc(id_oc, id_pedido) {
    var id_oc = id_oc;
    var id_pedido = id_pedido;

    $('#id_oc').val(id_oc);
    $('#id_pedido').val(id_pedido);
    $('#articulos_oc').modal('show');
    $.ajax({
        url: 'tabla_solicitud_oc.php',
        type: 'post',
        data: {
            id_oc: id_oc,
            id_pedido: id_pedido
        },
        success: function(datos) {
            $('#tabla_solicitud_oc').html(datos);
        }
    });
    $.ajax({
        url: 'tabla_articulos_oc.php',
        type: 'post',
        data: {
            id_oc: id_oc,
        },
        success: function(datos) {
            $('#tabla_articulos_oc').html(datos);
        }
    });
}

function add_oc(descripcion, cantidad, id_artsol) {

    var descripcion = descripcion;
    var cantidad = cantidad;
    var id_artsol = id_artsol;

    $('#oc_descripcion').val(descripcion);
    $('#oc_cantidad').val(cantidad);
    $('#id_artsol').val(id_artsol);
}

function agregar_art_oc() {
    const id_oc = document.getElementById('id_oc').value;
    const id_pedido = document.getElementById('id_pedido').value;
    const descripcion = document.getElementById('oc_descripcion').value;
    const cantidad = document.getElementById('oc_cantidad').value;
    const neto = document.getElementById('oc_neto').value;
    const id_artsol = document.getElementById('id_artsol').value;
    $.ajax({
        url: 'ingresar_articulos_oc.php',
        type: 'post',
        data: {
            id_oc: id_oc,
            id_pedido: id_pedido,
            descripcion: descripcion,
            cantidad: cantidad,
            neto: neto,
            id_artsol: id_artsol
        },
        success: function(datos) {
            var id_oc = datos;
            if (id_oc == -1) {
                window.alert("articulo ya fue ingresado");
                return;

            } else {
                $.ajax({
                    url: 'tabla_articulos_oc.php',
                    type: 'post',
                    data: {
                        id_oc: id_oc,
                    },
                    success: function(datos) {
                        $('#tabla_articulos_oc').html(datos);
                    }
                });
            }
        }
    });

}

function del_oc(id_artoc, id_oc) {
    var id_artoc = id_artoc;
    var id_oc = id_oc;
    $.ajax({
        url: 'borrar_articulo_oc.php',
        type: 'post',
        data: {
            id_artoc: id_artoc,
            id_oc: id_oc
        },
        success: function(datos) {
            var id_oc = datos;
            $.ajax({
                url: 'tabla_articulos_oc.php',
                type: 'post',
                data: {
                    id_oc: id_oc,
                },
                success: function(datos) {
                    $('#tabla_articulos_oc').html(datos);
                }
            });
        }
    });
}