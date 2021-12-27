<!--./ Modal Nueva -->
<div class="modal fade" id="modal_nuevo_disparo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ingresar Muestra Geología</h4>
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
                                <select class="form-control" id="geo_id_mina" name="geo_id_mina">
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
                            <div class="form-group">
                                <div id="select_manto"></div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Calle</label>
                                <select class="form-control" id="geo_id_calle" name="geo_id_calle">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * from calles order BY coordenada ASC;");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_calle] . '">' . $valores[coordenada] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Labor</label>
                                <select class="form-control" id="geo_id_labor" name="geo_id_labor">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * from levantes order BY coordenada ASC;");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_calle] . '">' . $valores[coordenada] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha_geo_muestra" name="fecha_geo_muestra">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">CutVisual</label>
                                <input type="number" step="0.01" min="0" max="10" class="form-control" id="geo_CutVisual" name="geo_CutVisual">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">CusVisual</label>
                                <input type="number" step="0.01" min="0" max="10" class="form-control" id="geo_CusVisual" name="geo_CusVisual">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">%Frente</label>
                                <input type="number" step="0.01" min="0" max="100" class="form-control" id="geo_frente" name="geo_frente">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Observaciones</label>
                                <select class="form-control" id="geo_observaciones" name="geo_observaciones">
                                    <option value=""></option>
                                    <option value="Manto">Manto</option>
                                    <option value="Frente">Frente</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Tipo</label>
                                <select class="form-control" id="geo_tipo" name="geo_tipo">
                                    <option value=""></option>
                                    <option value="Sondaje">Sondaje</option>
                                    <option value="Mina">Mina</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" class="form-control salida_equipo" id="usuario" name="usuario" value="<?php echo $_SESSION['uname']; ?>">
                    </div>

                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="muestra_geo_nueva()">
            </div>
        </div>

    </div>
</div>

<!--./NUEVA COORDENADA-->

<div class="modal fade" id="modal_nueva_coordenada">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ingresar Coordenada</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!--./Linea1-->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group"><label for="state_id" class="control-label">Tipo</label>
                                <select class="form-control" id="tipo_coordenada" name="tipo_coordenada">
                                    <option value=""></option>
                                    <option value="1">MANTO</option>
                                    <option value="2">CALLE</option>
                                    <option value="3">LEVANTE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="state_id" class="control-label">Mina</label>
                                <select class="form-control" id="coordenada_mina" name="coordenada_mina" disabled>
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
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Coordenada</label>
                                <input type="text" class="form-control" id="coordenada_nueva" name="coordenada_nueva">
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="nueva_coordenada()">
            </div>
        </div>

    </div>
</div>

<!-- modal ingreso coordenadas XYZ-->
<div class="modal fade" id="ingreso_xyz">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Coordenadas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <h4 class="text-center cod_ubicacion" id="cod_ubicacion" name="cod_ubicacion"></h4>
                    <br>
                </center>
                <form>
                    <!--./Linea1-->
                    <div class="row">
                        <input type="hidden" class="form-control id_geo" id="id_geo" name="id_geo">
                        <input type="hidden" class="form-control usuario" id="usuario" name="usuario" value="<?php echo $_SESSION['uname']; ?>">

                        <div class="col-sm-4">
                            <div class="form-group"><label for="state_id" class="control-label">Eje X</label>
                                <input type="number" step="0.01" min="0" max="100000000" class="form-control" id="geo_labCutVisual" name="geo_labCutVisual">

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="state_id" class="control-label">Eje Y</label>
                                <input type="number" step="0.01" min="0" max="100000000" class="form-control" id="geo_labCusVisual" name="geo_labCusVisual">

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="state_id" class="control-label">Eje Z</label>
                                <input type="number" step="0.01" min="0" max="100000000" class="form-control" id="geo_labCusVisual" name="geo_labCusVisual">

                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control " id="usuario" name="usuario" value="<?php echo $_SESSION['uname']; ?>">
                    <input type="hidden" class="form-control " id="id_geo" name="id_geo" value="id_geo">
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="muestra_geo_lab()">
            </div>
        </div>

    </div>
</div>