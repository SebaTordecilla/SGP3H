<!--./ Modal Nueva Extraccion-->
<div class="modal fade" id="modal_nueva_extraccion">
    <div class="modal-dialog modal-xl">
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


<!--./ Modal editar Extraccion-->
<div class="modal fade" id="editar_extraccion">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Extracción Mineral</h4>
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
                                <select class="form-control" id="edit_id_ubicacion" name="edit_id_ubicacion">
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
                                <select class="form-control" id="edit_id_manto" name="edit_id_manto">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM mantos");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_manto] . '">' . $valores[coordenada] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Calle</label>
                                <select class="form-control" id="edit_id_calle" name="edit_id_calle">
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
                                <select class="form-control" id="edit_id_labor" name="edit_id_labor">
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
                                <input type="date" class="form-control" id="edit_fecha" name="edit_fecha">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group"><label for="state_id" class="control-label">Operador</label>
                                <select class="form-control" id="edit_id_op" name="edit_id_op">
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
                                <select class="form-control" id="edit_id_equipo" name="edit_id_equipo">
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
                                <select class="form-control" id="edit_id_mineral" name="edit_id_mineral">
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
                                <select class="form-control" id="edit_id_obs_min" name="edit_id_obs_min">
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
                        <input type="hidden" class="form-control" id="edit_id_extmin" name="edit_id_extmin">
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora1</label>
                                <input type="time" class="form-control" id="edit_hora1" name="edit_hora1">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora2</label>
                                <input type="time" class="form-control" id="edit_hora2" name="edit_hora2">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora3</label>
                                <input type="time" class="form-control" id="edit_hora3" name="edit_hora3">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora4</label>
                                <input type="time" class="form-control" id="edit_hora4" name="edit_hora4">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora5</label>
                                <input type="time" class="form-control" id="edit_hora5" name="edit_hora5">
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="update_extraccion()">
            </div>
        </div>

    </div>
</div>


<!--./ Modal Nueva Lote Oxido-->
<div class="modal fade" id="modal_nuevo_lote">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Lote</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" class="form-control" id="id_lote0" name="id_lote0">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="state_id" class="control-label">N°Lote</label>
                                <input type="text" class="form-control" id="num_lote" name="num_lote">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group"><label for="state_id" class="control-label">Empresa</label>
                                <select class="form-control" id="id_emplot" name="id_emplot">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM empresas_lotes;");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_emplot] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="state_id" class="control-label">Mes</label>
                                <select class="form-control" id="mes" name="mes">
                                    <option value=""></option>
                                    <option value="1">ENERO</option>
                                    <option value="2">FEBRERO</option>
                                    <option value="3">MARZO</option>
                                    <option value="4">ABRIL</option>
                                    <option value="5">MAYO</option>
                                    <option value="6">JUNIO</option>
                                    <option value="7">JULIO</option>
                                    <option value="8">AGOSTO</option>
                                    <option value="9">SEPTIEMBRE</option>
                                    <option value="10">OCTUBRE</option>
                                    <option value="11">NOVIEMBRE</option>
                                    <option value="12">DICIEMBRE</option>
                                </select>

                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="state_id" class="control-label">Año</label>
                                <select class="form-control" id="ano" name="ano">
                                    <option value=""></option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2024">2025</option>
                                    <option value="2024">2026</option>
                                    <option value="2024">2027</option>
                                </select>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="nuevo_lote()">
            </div>
        </div>

    </div>
</div>



<!-- Modal Guias Lotes Oxido -->

<!--./ Modal editar Extraccion-->
<div class="modal fade" id="guias_lote">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Guias de Despacho</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" class="form-control" id="id_lote" name="id_lote">
                    <input type="hidden" class="form-control" id="id_guia" name="id_guia">
                    <input type="hidden" class="form-control salida_equipo" id="usuario" name="usuario" value="<?php echo $_SESSION['uname']; ?>">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha</label>
                                <input type="date" class="form-control" id="guia_fecha" name="guia_fecha">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora</label>
                                <input type="time" class="form-control" id="guia_hora" name="guia_hora">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Mina</label>
                                <select class="form-control" id="guia_mina" name="guia_mina">
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
                                <label for="state_id" class="control-label">N°Guía</label>
                                <input type="number" class="form-control" id="num_guia" name="num_guia">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Patente</label>
                                <select class="form-control" id="guia_patente" name="guia_patente">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM camiones order by patente asc");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_camion] . '">' . $valores[patente] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Chofer</label>
                                <select class="form-control" id="guia_chofer" name="guia_chofer">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM choferes order by nombre asc");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_chofer] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Tonelaje</label>
                                <input type="number" class="form-control" id="guia_tonelaje" name="guia_tonelaje">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">LeyVisual</label>
                                <input type="text" class="form-control" id="guia_ley" name="guia_ley">
                            </div>
                        </div>
                    </div>
                </form>


                <div id="tablaguiasoxido" style="padding-top:10px;"></div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="guia_oxido()">
            </div>

        </div>

    </div>
</div>


<!-- guias lotes mensual -->

<div class="modal fade" id="guias_lote_mensual">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Guias de Despacho Óxido</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="tablaguiasoxidomensual" style="padding-top:10px;"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="guia_oxido()">
            </div>

        </div>

    </div>
</div>


<!-- guias sulfuro -->

<div class="modal fade" id="guias_sulfuro">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Guias de Despacho Sulfuro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" class="form-control" id="id_sulf" name="id_sulf">
                    <input type="hidden" class="form-control" id="numero" name="numero">
                    <input type="hidden" class="form-control" id="usuario" name="usuario" value="<?php echo $_SESSION['uname']; ?>">

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha</label>
                                <input type="date" class="form-control" id="sulf_fecha" name="sulf_fecha">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora</label>
                                <input type="time" class="form-control" id="sulf_hora" name="sulf_hora">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">N°Guía</label>
                                <input type="num" class="form-control" id="sulf_guia" name="sulf_guia">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-group"><label for="state_id" class="control-label">Responsable</label>
                                    <select class="form-control" id="sulf_responsable" name="sulf_responsable">
                                        <option value=""></option>
                                        <?php
                                        $query = $con->query("SELECT id_op, UPPER(nombre) as nombre FROM operadores where rango = 3");
                                        while ($valores = mysqli_fetch_array($query)) {
                                            echo '<option value="' . $valores[id_op] . '">' . $valores[nombre] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group"><label for="state_id" class="control-label">Patente</label>
                                    <select class="form-control" id="sulf_patente" name="sulf_patente">
                                        <option value=""></option>
                                        <?php
                                        $query = $con->query("SELECT * FROM camiones order by patente asc");
                                        while ($valores = mysqli_fetch_array($query)) {
                                            echo '<option value="' . $valores[id_camion] . '">' . $valores[patente] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group"><label for="state_id" class="control-label">Chofer</label>
                                    <select class="form-control" id="sulf_chofer" name="sulf_chofer">
                                        <option value=""></option>
                                        <?php
                                        $query = $con->query("SELECT * FROM choferes order by nombre asc");
                                        while ($valores = mysqli_fetch_array($query)) {
                                            echo '<option value="' . $valores[id_chofer] . '">' . $valores[nombre] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="state_id" class="control-label">Sector</label>
                                    <input type="number" class="form-control" id="sulf_sector" name="sulf_sector">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="state_id" class="control-label">Tonelaje</label>
                                    <input type="number" class="form-control" id="sulf_tonelaje" name="sulf_tonelaje">
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="guia_sulfuro()">
            </div>

        </div>

    </div>
</div>