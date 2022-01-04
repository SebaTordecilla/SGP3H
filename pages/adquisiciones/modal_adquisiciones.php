<div class="modal fade" id="modal_nueva_oc">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registro Extracción Mineral</h4>
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
                                        echo '<option value="' . $valores[id_levante] . '">' . $valores[coordenada] . '</option>';
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
                        <div class="col-sm-4">
                            <div class="form-group"><label for="state_id" class="control-label">Operador</label>
                                <select class="form-control" id="ext_operador" name="ext_operador">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT id_op, upper(nombre) as nombre FROM operadores where estado = 1 and rango = 1 order by nombre asc");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_op] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Dumper</label>
                                <select class="form-control" id="ext_dumper" name="ext_dumper">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM lista_equipos where id_tequipo = 5");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_equipo] . '">' . $valores[sigla] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Tipo</label>
                                <select class="form-control" id="ext_tipo" name="ext_tipo">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM minerales;");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_mineral] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Observaciones</label>
                                <select class="form-control" id="ext_obs" name="ext_obs">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM observaciones_minerales;");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_obs_min] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <input type="hidden" class="form-control salida_equipo" id="usuario" name="usuario" value="<?php echo $_SESSION['uname']; ?>">
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora1</label>
                                <input type="time" class="form-control" id="ext_hora1" name="ext_hora1">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora2</label>
                                <input type="time" class="form-control" id="ext_hora2" name="ext_hora2">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora3</label>
                                <input type="time" class="form-control" id="ext_hora3" name="ext_hora3">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora4</label>
                                <input type="time" class="form-control" id="ext_hora4" name="ext_hora4">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora5</label>
                                <input type="time" class="form-control" id="ext_hora5" name="ext_hora5">
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="nueva_ext_min()">
            </div>
        </div>

    </div>
</div>