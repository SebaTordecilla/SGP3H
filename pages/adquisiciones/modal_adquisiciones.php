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
                                    $query = $con->query("SELECT id_empresa, upper(nombre) as nombre FROM empresas_internas");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_empresa] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group"><label for="state_id" class="control-label">Proveedor</label>
                                <select class="form-control" id="adq_id_proveedor" name="adq_id_proveedor">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * from proveedores");
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
                            <div class="form-group">
                                <label for="state_id" class="control-label">N°Nota de Pedido</label>
                                <input type="text" class="form-control " id="adq_id_pedido" name="adq_id_pedido">
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

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="nueva_oc()">
            </div>
        </div>

    </div>
</div>