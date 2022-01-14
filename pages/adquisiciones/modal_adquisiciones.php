<div class="modal fade" id="modal_nueva_oc">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva OC</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!--./Linea1-->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group"><label for="state_id" class="control-label">Empresa</label>
                                <select class="form-control" id="adq_id_empresa" name="adq_id_empresa">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT id_empresa, upper(nombre) as nombre FROM empresas_internas order by nombre asc");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_empresa] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group"><label for="state_id" class="control-label">Proveedor</label>
                                <select class="select2 select2" id="adq_id_proveedor" name="adq_id_proveedor">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * from proveedores ORDER BY nombre ASC");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_proveedor] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha</label>
                                <input type="date" class="form-control " id="adq_fecha" name="adq_fecha">
                                <input type="hidden" class="form-control " id="id_oc" name="id_oc">

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Condición de Pago</label>
                                <select class="form-control" id="adq_pago" name="adq_pago">
                                    <option value=""></option>
                                    <option value="OC 30 DÍAS">OC 30 DÍAS</option>
                                    <option value="EFECTIVO">EFECTIVO</option>
                                    <option value="CHEQUE">CHEQUE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">N°Cotización</label>
                                <input type="text" class="form-control " id="adq_cotizacion" name="adq_cotizacion">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="state_id" class="control-label">N°Nota de Pedido</label>
                                <select class="form-control" id="adq_id_pedido" name="adq_id_proveedor">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT id_pedido FROM solicitudes_compra where estado =2 order by id_pedido desc");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_pedido] . '">' . $valores[id_pedido] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>

                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="nueva_oc()">
            </div>
        </div>

    </div>
</div>



<div class="modal fade" id="articulos_oc">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Articulos OC</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" class="form-control " id="id_oc" name="id_oc">
                <input type="hidden" class="form-control " id="id_pedido" name="id_pedido">

                <div id="tabla_solicitud_oc" style="padding-top:10px;"></div>

                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Descripción</label>
                            <input type="text" class="form-control " id="oc_descripcion" name="oc_descripcion">
                            <input type="hidden" class="form-control " id="id_artsol" name="id_artsol">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Cant.</label>
                            <input type="number" class="form-control " id="oc_cantidad" name="oc_cantidad">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Neto</label>
                            <input type="number" class="form-control " id="oc_neto" name="oc_neto">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="state_id" class="control-label">add</label>
                            <input type="button" class="btn naranjo" value="+" onclick="agregar_art_oc()">
                        </div>
                    </div>
                </div>

                <div id="tabla_articulos_oc" style="padding-top:10px;"></div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal_nueva_solicitud">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva Solicitud</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!--./Linea1-->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Solicitado por:</label>
                                <input type="text" class="form-control " id="sol_solicitado" name="sol_solicitado">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora:</label>
                                <input type="time" class="form-control " id="sol_hora" name="sol_hora">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha:</label>
                                <input type="date" class="form-control " id="sol_fecha" name="sol_fecha">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Área</label>
                                <select class="form-control" id="sol_area" name="sol_area">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM areas3h");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_area] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Prioridad</label>
                                <select class="form-control" id="sol_prioridad" name="sol_prioridad">
                                    <option value=""></option>
                                    <option value="ALTA">ALTA</option>
                                    <option value="MEDIA">MEDIA</option>
                                    <option value="BAJA">BAJA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Justifique Solicitud:</label>
                                <input type="text" class="form-control " id="sol_justificacion" name="sol_justificacion">
                                <input type="hidden" class="form-control " id="id_solicitud" name="id_solicitud">
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="nueva_solicitud()">
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="articulos_sol">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Articulos OC</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control " id="id_pedido" name="id_pedido">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Descripción</label>
                            <input type="text" class="form-control " id="sol_descripcion" name="sol_descripcion">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Cant.</label>
                            <input type="number" class="form-control " id="sol_cantidad" name="sol_cantidad">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Stock Actual</label>
                            <input type="number" class="form-control " id="sol_stock" name="sol_stock">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Proveedor Sugerido</label>
                            <input type="text" class="form-control " id="sol_proveedor" name="sol_proveedor">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="state_id" class="control-label">add</label>
                            <input type="button" class="btn naranjo" value="+" onclick="agregar_art_sol()">
                        </div>
                    </div>
                </div>

                <div id="tabla_solicitud_sol" style="padding-top:10px;"></div>

            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="nueva_oc()">
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="nuevo_proveedor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control " id="id_proveedor" name="id_proveedor">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Rut</label>
                            <input type="text" class="form-control " id="prov_rut" name="prov_rut" placeholder="con puntos y guión">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Nombre</label>
                            <input type="text" class="form-control " id="prov_nombre" name="prov_nombre">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Dirección</label>
                            <input type="text" class="form-control " id="prov_direccion" name="prov_direccion">
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="nuevo_proveedor()">
            </div>
        </div>

    </div>
</div>



<div class="modal fade" id="doc_oc">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Documentos
                    <label id="num_oc"></label>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Fecha</label>
                            <input type="date" class="form-control " id="doc_fecha" name="doc_fecha">
                            <input type="hidden" class="form-control " id="doc_id_oc" name="doc_id_oc">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Numero</label>
                            <input type="text" class="form-control " id="doc_numero" name="doc_numero">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="state_id" class="control-label">Tipo</label>
                        <select class="form-control" id="doc_tipo" name="doc_tipo">
                            <option value=""></option>
                            <option value="BOLETA">BOLETA</option>
                            <option value="FACTURA">FACTURA</option>
                            <option value="GUÍA">GUÍA</option>
                            <option value="NOTA CRÉDITO">NOTA CRÉDITO</option>
                            <option value="NOTA DEBITO">NOTA DEBITO</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="state_id" class="control-label">add</label>
                            <input type="button" class="btn naranjo" value="+" onclick="agregar_documento()">
                        </div>
                    </div>
                </div>
                <div id="tabla_doc_oc" style="padding-top:10px;"></div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="oc_sol">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ordenes de Compra
                    <label id="num_id_sol"></label>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="tabla_sol_oc" style="padding-top:10px;"></div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="doc_oc2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Documentos
                    <label id="num_oc2"></label>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="tabla_doc_oc2" style="padding-top:10px;"></div>
            </div>
        </div>

    </div>
</div>