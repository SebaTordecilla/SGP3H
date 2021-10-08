<!--./ Modal colacion-->
<div class="modal fade" id="modal_colacion_diaria">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Colación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!--./Linea1-->
                    <div class="row">
                        <input type="hidden" class="form-control col_fecha" id="col_fecha" name="col_fecha">
                        <input type="hidden" class="form-control col_ubicacion" id="col_ubicacion" name="col_ubicacion">
                        <input type="hidden" class="form-control usuario" id="usuario" name="usuario" value="<?php echo $_SESSION['uname']; ?>">

                        <div id="input_hora_ini" style="padding-top:10px;"></div>

                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="Ingresar_colacion()">
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="solicitud_mecanico">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Solicitud Mecánico</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!--./Linea1-->
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Mina</label>
                                <select class="form-control" id="rep_id_mina" name="rep_id_mina">
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
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora de Solicitud</label>
                                <input type="time" class="form-control " id="hora_ini" name="hora_ini">
                                <input type="hidden" class="form-control id_salida" id="id_salida" name="id_salida">
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="solicitud_mecanico()">
            </div>
        </div>

    </div>
</div>