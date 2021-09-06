<!--./ Modal Nueva Mantencion Camioneta-->
<div class="modal fade" id="modal_nuevo_disparo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ingresar Disparos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha_disp" name="fecha_disp">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Turno</label>
                                <select class="form-control" id="disp_turno" name="disp_turno">
                                    <option value=""></option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Jornada</label>
                                <select class="form-control" id="disp_jornada" name="disp_jornada">
                                    <option value=""></option>
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Perforista</label>
                                <select class="form-control" id="disp_id_perforo" name="disp_id_perforo">
                                    <option value=""></option>
                                    <option value="1">Juanito</option>
                                    <option value="2">Pedrito</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Tipo</label>
                                <select class="form-control" id="disp_id_material" name="disp_id_material">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM minerales");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_mineral] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--./Linea2-->
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Mina</label>
                                <select class="form-control" id="disp_id_mina" name="disp_id_mina">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM ubicaciones_minas");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_ubicacion] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Manto</label>
                                <select class="form-control" id="disp_id_manto" name="disp_id_manto">
                                    <option value=""></option>
                                    <option value="1">Z8</option>
                                    <option value="2">Z8 1/2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Calle</label>
                                <select class="form-control" id="disp_id_calle" name="disp_id_calle">
                                    <option value=""></option>
                                    <option value="1">12N</option>
                                    <option value="2">12S</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Labor</label>
                                <select class="form-control" id="disp_id_labor" name="disp_id_labor">
                                    <option value=""></option>
                                    <option value="1">L12</option>
                                    <option value="2">L13</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Tiros</label>
                                <input type="number" min="0" step="2" class="form-control" id="disp_tiros" name="disp_tiros">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Long.Tiro</label>
                                <select class="form-control" id="disp_longtiros" name="disp_longtiros">
                                    <option value=""></option>
                                    <option value="1.3">1.3</option>
                                    <option value="1.6">1.6</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Observaciones</label>
                                <textarea class="form-control" rows="2" id="disp_observaciones" name="disp_observaciones" placeholder="Escriba aquí..."></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control salida_equipo" id="usuario" name="usuario" value="<?php echo $_SESSION['uname']; ?>">
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="disparo_nuevo()">
            </div>
        </div>

    </div>
</div>