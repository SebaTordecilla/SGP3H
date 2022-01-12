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
    const id_oc = document.getElementById('id_oc').value;

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
                            if (id_oc > 0) {
                                if (confirm('Desea Editar OC?')) {
                                    $.ajax({
                                        url: 'nueva_oc.php',
                                        type: 'post',
                                        data: {
                                            id_empresa: id_empresa,
                                            id_proveedor: id_proveedor,
                                            fecha: fecha,
                                            pago: pago,
                                            cotizacion: cotizacion,
                                            id_pedido: id_pedido,
                                            id_oc: id_oc
                                        },
                                        success: function(response) {
                                            if (response == 1) {
                                                window.alert("OC Ingresada");
                                                location.reload();
                                            } else if (response == 2) {
                                                window.alert("OC Editada");
                                                location.reload();
                                            } else {
                                                window.alert("Error");
                                                return;
                                            }
                                        }
                                    });
                                }

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
                                            } else if (response == 2) {
                                                window.alert("OC Editada");
                                                location.reload();
                                            } else {
                                                window.alert("OC Ingresada");
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

function edit_oc(id_oc, id_empresa, id_proveedor, fecha, pago, cotizacion, id_pedido) {
    $('#id_oc').val(id_oc);
    $('#adq_id_empresa').val(id_empresa);
    $('#adq_id_proveedor').val(id_proveedor);
    $('#adq_fecha').val(fecha);
    $('#adq_pago').val(pago);
    $('#adq_cotizacion').val(cotizacion);
    $('#adq_id_pedido').val(id_pedido);

    $('#modal_nueva_oc').modal('show');


}

function pdf_oc(id_oc) {
    window.open('pdf_oc.php?id_oc=' + id_oc);
};



function modal_nueva_solicitud() {
    $('#modal_nueva_solicitud').modal('show');
}

function nueva_solicitud() {
    const id_solicitud = document.getElementById('id_solicitud').value;
    const solicitado = document.getElementById('sol_solicitado').value;
    const hora = document.getElementById('sol_hora').value;
    const fecha = document.getElementById('sol_fecha').value;
    const area = document.getElementById('sol_area').value;
    const prioridad = document.getElementById('sol_prioridad').value;
    const justificacion = document.getElementById('sol_justificacion').value;
    if (solicitado == "") {
        alert('Debe ingresar Solicitado por');
        return;
    } else {
        if (hora == "") {
            alert('Debe ingresar Hora');
            return;
        } else {
            if (fecha == "") {
                alert('Debe ingresar Fecha');
                return;
            } else {
                if (area == "") {
                    alert('Debe ingresar Área');
                    return;
                } else {
                    if (prioridad == "") {
                        alert('Debe ingresar Prioridad');
                        return;
                    } else {
                        if (justificacion == "") {
                            alert('Debe ingresar Justificación');
                            return;
                        } else {
                            if (confirm('Desea crear Solicitud de Compra?')) {
                                $.ajax({
                                    url: 'nueva_solicitud.php',
                                    type: 'post',
                                    data: {
                                        solicitado: solicitado,
                                        hora: hora,
                                        fecha: fecha,
                                        area: area,
                                        prioridad: prioridad,
                                        justificacion: justificacion,
                                        id_solicitud: id_solicitud
                                    },
                                    success: function(response) {
                                        if (response == 1) {
                                            window.alert("Solicitud Ingresada");
                                            location.reload();
                                        } else if (response == 2) {
                                            window.alert("Solicitud Editada");
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

function articulos_sol(id_pedido) {
    var id_pedido = id_pedido;

    $('#id_pedido').val(id_pedido);
    $('#articulos_sol').modal('show');
    $.ajax({
        url: 'tabla_solicitud_sol.php',
        type: 'post',
        data: {
            id_pedido: id_pedido
        },
        success: function(datos) {
            $('#tabla_solicitud_sol').html(datos);

        }
    });
}

function agregar_art_sol() {
    const descripcion = document.getElementById('sol_descripcion').value;
    const cantidad = document.getElementById('sol_cantidad').value;
    const stock = document.getElementById('sol_stock').value;
    const proveedor = document.getElementById('sol_proveedor').value;
    const id_pedido = document.getElementById('id_pedido').value;

    if (descripcion == "") {
        alert('Debe ingresar Descripcion');
        return;
    } else {
        if (cantidad == "") {
            alert('Debe ingresar Cantidad');
            return;
        } else {
            $.ajax({
                url: 'ingresar_articulos_sol.php',
                type: 'post',
                data: {
                    id_pedido: id_pedido,
                    descripcion: descripcion,
                    stock: stock,
                    proveedor: proveedor,
                    cantidad: cantidad
                },
                success: function(datos) {
                    var id_pedido = datos;

                    $.ajax({
                        url: 'tabla_solicitud_sol.php',
                        type: 'post',
                        data: {
                            id_pedido: id_pedido,
                        },
                        success: function(datos) {
                            $('#tabla_solicitud_sol').html(datos);
                        }
                    });
                }
            });
        }
    }
}

function del_art_sol(id_artsol, id_pedido) {
    var id_artsol = id_artsol;
    var id_pedido = id_pedido;
    $.ajax({
        url: 'borrar_articulo_sol.php',
        type: 'post',
        data: {
            id_artsol: id_artsol,
            id_pedido: id_pedido
        },
        success: function(datos) {
            var id_pedido = datos;
            $.ajax({
                url: 'tabla_solicitud_sol.php',
                type: 'post',
                data: {
                    id_pedido: id_pedido,
                },
                success: function(datos) {
                    $('#tabla_solicitud_sol').html(datos);
                }
            });
        }
    });
}

function pdf_sol(id_pedido) {
    window.open('pdf_sol.php?id_pedido=' + id_pedido);
};

function modal_nuevo_proveedor() {
    $('#nuevo_proveedor').modal('show');
}

function nuevo_proveedor() {
    const rut = document.getElementById('prov_rut').value;
    const nombre = document.getElementById('prov_nombre').value;
    const direccion = document.getElementById('prov_direccion').value;
    const id_proveedor = document.getElementById('id_proveedor').value;

    if (rut == "") {
        alert('Debe ingresar Rut');
        return;
    } else {
        if (nombre == "") {
            alert('Debe ingresar Nombre');
            return;
        } else {
            if (direccion == "") {
                alert('Debe ingresar Dirección');
                return;
            } else {
                if (confirm('Desea crear Proveedor?')) {
                    $.ajax({
                        url: 'nuevo_proveedor.php',
                        type: 'post',
                        data: {
                            rut: rut,
                            nombre: nombre,
                            direccion: direccion,
                            id_proveedor: id_proveedor
                        },
                        success: function(response) {
                            if (response == 1) {
                                window.alert("Proveedor Ingresado");
                                location.reload();
                            } else if (response == 2) {
                                window.alert("Proveedor Editado");
                                location.reload();
                            } else if (response == 3) {
                                window.alert("Proveedor ya se encuentra en Base de Datos");
                                return;
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

function edit_proveedor(id_proveedor, rut, nombre, direccion) {
    $('#id_proveedor').val(id_proveedor);
    $('#prov_rut').val(rut);
    $('#prov_nombre').val(nombre);
    $('#prov_direccion').val(direccion);

    $('#nuevo_proveedor').modal('show');
}

function confirmar_oc(id_oc) {
    var id_oc = id_oc;
    if (confirm('Desea Confirmar OC?')) {
        $.ajax({
            url: 'confirmar_oc.php',
            type: 'post',
            data: {
                id_oc: id_oc,
            },
            success: function(response) {
                if (response == 1) {
                    window.alert("OC Confirmada");
                    location.reload();
                } else {
                    window.alert("Error");
                    return;
                }
            }
        });
    }
}

function pdf_oc2(id_oc) {
    window.open('pdf_oc2.php?id_oc=' + id_oc);
};

function doc_oc(id_oc, num_oc) {
    var id_oc = id_oc;
    document.getElementById('num_oc').innerHTML = 'OC ' + num_oc;
    $('#doc_id_oc').val(id_oc);
    $('#doc_oc').modal('show');
    $.ajax({
        url: 'tabla_doc_oc.php',
        type: 'post',
        data: {
            id_oc: id_oc,
        },
        success: function(datos) {
            $('#tabla_doc_oc').html(datos);
        }
    });
}


function agregar_documento() {
    const id_oc = document.getElementById('doc_id_oc').value;
    const fecha = document.getElementById('doc_fecha').value;
    const numero = document.getElementById('doc_numero').value;
    const tipo = document.getElementById('doc_tipo').value;
    if (fecha == "") {
        alert('Debe ingresar Fecha');
        return;
    } else {
        if (numero == "") {
            alert('Debe ingresar NUmero de Documento');
            return;
        } else {
            if (tipo == "") {
                alert('Debe ingresar Tipo de Documento');
                return;
            } else {
                $.ajax({
                    url: 'nuevo_doc_oc.php',
                    type: 'post',
                    data: {
                        id_oc: id_oc,
                        fecha: fecha,
                        numero: numero,
                        tipo: tipo
                    },
                    success: function(datos) {
                        var id_oc = datos;
                        $.ajax({
                            url: 'tabla_doc_oc.php',
                            type: 'post',
                            data: {
                                id_oc: id_oc,
                            },
                            success: function(datos) {
                                $('#tabla_doc_oc').html(datos);
                            }
                        });
                    }
                });
            }
        }
    }
}