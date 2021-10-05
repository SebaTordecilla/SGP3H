<!--./ Modal cierre diario-->
<div class="modal fade" id="modal_cierre_diario">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cierre Equipo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" class="form-control num_equipo" id="num_equipo" name="num_equipo">
                        <input type="hidden" class="form-control codigo" id="codigo" name="codigo">
                        <input type="hidden" class="form-control fecha_dia" id="fecha_dia" name="fecha_dia">
                        <input type="time" class="form-control" id="hora_fin" name="hora_fin">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="button" class="btn btn-user btn-block naranjo" value="Cerrar Equipo" name="cierre_diario" id="cierre_diario">
            </div>
        </div>
    </div>
</div>





<!--./ Modal Nueva Mantencion-->
<div class="modal fade" id="modal_matencion">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva Mantención de Equipos</h4>
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
                                <input type="date" class="form-control" id="fecha_taller" name="fecha_taller">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Tipo de Equipo</label>
                                <select class="form-control" id="tequipo" name="tequipo">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM tipos_equipos");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_tequipo] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div id="select2lista">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control" id="id_est_equipo" name="id_est_equipo">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM estado_equipos where id_est_equipo in (1,2)");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_est_equipo] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!---->
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group"><label for="state_id" class="control-label">Checklist</label></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="CAceiteM" id="CAceiteM" value="C.Aceite Motor">
                                    <label class="form-check-label">Cambio Aceite Motor</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="CFiltroAceite" id="CFiltroAceite" value="C.Filtro Aceite">
                                    <label class="form-check-label">Cambio Filtro de Aceite</label>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="CFiltroComb" id="CFiltroComb" value="C.Filtro Combustible">
                                    <label class="form-check-label">Cambio Filtro de Combustible</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="CFiltroAire" id="CFiltroAire" value="C.Filtro Aire">
                                    <label class="form-check-label">Cambio Filtro de Aire</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ChequeoD" id="ChequeoD" value="Cheq.Diferencial">
                                    <label class="form-check-label">Chequeo Diferencial</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="Lavado" id="Lavado" value="Lavado">
                                    <label class="form-check-label">Lavado de Equipo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Observaciones</label>
                                <textarea class="form-control" rows="2" id="observaciones_man" name="observaciones_man" placeholder="Escriba aquí..."></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="mant_nuevo()">
            </div>
        </div>

    </div>
</div>


<!--./ Modal Nueva Programacion-->
<div class="modal fade" id="modal_prog_mant">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva Programación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <div style="width: 20%; border: 5px ; float: left;">
                            <label for="state_id" class="control-label">Cod.</label>
                            <input type="text" class="form-control cod_equipo" id="cod_equipo" name="cod_equipo" disabled>
                        </div>
                        <div style="width: 80%; border: 5px ; float: left;">
                            <label for="state_id" class="control-label">Fecha Ingreso</label>
                            <input type="date" class="form-control" id="fecha_man_prog" name="fecha_man_prog">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="prog_mant_nuevo()">
            </div>
        </div>
    </div>
</div>


<!-- /.modal historial-->
<div class="modal fade" id="modal_taller">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Histórico de Mantenciones</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <h4 class="text-center nombre_equipo" id="num" name="num"></h4>
                </center>
                <div id="tabla_historica" style="padding-top:10px;"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal fin historial-->

<!-- /.modal nuevo equipo-->
<div class="modal fade" id="modal_nuevo_equipo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Equipo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Codigo</label>
                                <input type="text" class="form-control" id="sigla" name="sigla">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Modelo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Tipo de Equipo</label>
                                <select class="form-control" id="id_tequipo" name="id_tequipo">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM tipos_equipos WHERE id_tequipo <>7");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_tequipo] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">N° Serie</label>
                                <input type="text" class="form-control" id="num_serie" name="num_serie">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Año</label>
                                <select class="form-control" id="anio" name="anio">
                                    <option value=""></option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha Ingreso</label>
                                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Frec. Mant</label>
                                <select class="form-control" id="frecuencia" name="frecuencia">
                                    <option value=""></option>
                                    <option value="MENSUAL">MENSUAL</option>
                                    <option value="10.000 KM">10.000 KM</option>
                                    <option value="250 Hrs">250 Hrs</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Observaciones</label>
                                <input type="text" class="form-control" id="observaciones" name="observaciones">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="equipo_nuevo()">
            </div>
        </div>
    </div>
</div>
<!-- /.modal fin nuevo equipo-->

<!-- /.modal reparacion terreno-->
<div class="modal fade" id="modal_reparacion_terreno">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Enviar a Terreno</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <center>
                        <h4 class="text-center nombre_equipo" id="num" name="num"></h4>
                    </center>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Mecanico</label>
                                <select class="form-control" id="id_mecanico" name="id_mecanico">
                                    <option value=""></option>
                                    <option value="1">Juanito Perez</option>
                                    <option value="2">Pedro Piedra</option>
                                </select>
                                <input type="hidden" class="form-control salida_equipo" id="salida_equipo" name="salida_equipo">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                <input type="button" class="btn naranjo" value="Enviar" onclick="enviar_mecanico()">
            </div>
        </div>
    </div>
</div>


<!-- /.modal cerrar reparacion terreno-->
<div class="modal fade" id="modal_cerrar_reparacion_terreno">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cerrar Reparación en Terreno</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <center>
                        <h4 class="text-center nombre_equipo" id="num" name="num"></h4>
                    </center>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora</label>
                                <input type="time" class="form-control" id="hora1" name="hora1">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Observaciones</label>
                                <textarea class="form-control" rows="3" id="observaciones1" name="observaciones1" placeholder="Escriba aquí..."></textarea>
                                <input type="hidden" class="form-control salida_equipo" id="salida_equipo" name="salida_equipo">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                <input type="button" class="btn naranjo" value="Enviar" onclick="cerrar_mecanico()">
            </div>
        </div>
    </div>
</div>


<!-- /.modal nueva camioneta-->
<div class="modal fade" id="modal_nueva_camioneta">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva Camioneta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Patente</label>
                                <input type="text" class="form-control" id="patente" name="patente">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Marca</label>
                                <select class="form-control" id="marca_c" name="marca_c">
                                    <option value=""></option>
                                    <option value="Mitsubishi">Mitsubishi</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Chevrolet">Chevrolet</option>
                                    <option value="Nissan">Nissan</option>
                                    <option value="Ford">Ford</option>
                                    <option value="Maxus">Maxus</option>
                                    <option value="Volkswagen">Volkswagen</option>
                                    <option value="Mazda">Mazda</option>
                                    <option value="FAW">FAW</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Modelo</label>
                                <input type="text" class="form-control" id="modelo_c" name="modelo_c">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Chofer Asignado</label>
                                <input type="text" class="form-control" id="chofer" name="chofer">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Calidad</label>
                                <select class="form-control" id="calidad" name="calidad">
                                    <option value=""></option>
                                    <option value="PROPIA">PROPIA</option>
                                    <option value="ARRENDADA">ARRENDADA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Año</label>
                                <select class="form-control" id="anio_c" name="anio_c">
                                    <option value=""></option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha Ingreso</label>
                                <input type="date" class="form-control" id="fecha_ingreso_c" name="fecha_ingreso_c">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="camioneta_nueva()">
            </div>
        </div>
    </div>
</div>
<!-- /.modal fin nueva camioneta-->

<!--./ Modal permiso circulacion-->
<div class="modal fade" id="modal_permiso_circulacion">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Permiso de Circulación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Patente</label>
                                <select class="form-control" id="patente_pc" name="patente_pc">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT id_camioneta,patente FROM camionetas3h");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_camioneta] . '">' . $valores[patente] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha Ingreso</label>
                                <input type="date" class="form-control" id="fecha_ingreso_pc" name="fecha_ingreso_pc">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha Termino</label>
                                <input type="date" class="form-control" id="fecha_termino_pc" name="fecha_termino_pc">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer center-content-between">
                <input type="button" class="btn naranjo" value="Ingresar" onclick="permiso_circulacion()">
            </div>
        </div>
    </div>
</div>

<!--./ Modal seguro-->
<div class="modal fade" id="modal_seguro_camioneta">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seguro Camioneta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Patente</label>
                                <select class="form-control" id="patente_seg" name="patente_seg">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT id_camioneta,patente FROM camionetas3h");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_camioneta] . '">' . $valores[patente] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha Ingreso</label>
                                <input type="date" class="form-control" id="fecha_ingreso_seg" name="fecha_ingreso_seg">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha Termino</label>
                                <input type="date" class="form-control" id="fecha_termino_seg" name="fecha_termino_seg">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer center-content-between">
                <input type="button" class="btn naranjo" value="Ingresar" onclick="seguro_camioneta()">
            </div>
        </div>
    </div>
</div>


<!--./ Modal Revsión Tecnica-->
<div class="modal fade" id="modal_revision_tecnica">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Revisión Técnica</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Patente</label>
                                <select class="form-control" id="patente_rt" name="patente_rt">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT id_camioneta,patente FROM camionetas3h");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_camioneta] . '">' . $valores[patente] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha Ingreso</label>
                                <input type="date" class="form-control" id="fecha_ingreso_rt" name="fecha_ingreso_rt">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha Termino</label>
                                <input type="date" class="form-control" id="fecha_termino_rt" name="fecha_termino_rt">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer center-content-between">
                <input type="button" class="btn naranjo" value="Ingresar" onclick="revision_tecnica()">
            </div>
        </div>
    </div>
</div>



<!--./ Check List Camioneta -->

<div class="modal fade" id="modal_check_camionetas">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Check Camionetas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Patente</label>
                                <select class="form-control" id="id_pat_check" name="id_pat_check">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT id_camioneta,patente FROM camionetas3h");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_camioneta] . '">' . $valores[patente] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Fecha </label>
                                <input type="date" class="form-control" id="fecha_check" name="fecha_check">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Kilometraje</label>
                                <input type="text" class="form-control" id="km_check" name="km_check">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Mecanico</label>
                                <select class="form-control" id="mec_check" name="mec_check ">
                                    <option value=""></option>
                                    <option value="1">Juanito Perez</option>
                                    <option value="2">Pedro Piedra</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Nivel Combustible</label>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary ">
                                        <input type="radio" name="options" id="option_b1" value="1" autocomplete="off"> Bajo
                                    </label>
                                    <label class="btn btn-secondary active">
                                        <input type="radio" name="options" id="option_b2" value="2" autocomplete="off" checked> Medio
                                    </label>
                                    <label class="btn btn-secondary">
                                        <input type="radio" name="options" id="option_b3" value="3" autocomplete="off"> Alto
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">N.Aceite Motor</label>
                                <select class="form-control" id="acmot_check" name="acmot_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">N.Refrig.Motor</label>
                                <select class="form-control" id="refmot_check" name="refmot_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">N.Aceite Hidráulico</label>
                                <select class="form-control" id="achid_check" name="achid_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">N.Liq.Frenos</label>
                                <select class="form-control" id="liq_frenos_check" name="liq_frenos_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Rev.Filtro Aire</label>
                                <select class="form-control" id="faire_check" name="faire_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Partida en frio</label>
                                <select class="form-control" id="part_frio_check" name="part_frio_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Rev.Indicadores</label>
                                <select class="form-control" id="revind_check" name="revind_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Corta Corriente</label>
                                <select class="form-control" id="ccorriente_check" name="ccorriente_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Est.Butacas y Asientos</label>
                                <select class="form-control" id="butasi_check" name="butasi_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Luces</label>
                                <select class="form-control" id="luces_check" name="luces_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Est.Presión Neumát.</label>
                                <select class="form-control" id="presneu_check" name="presneu_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Antivuelco Interior</label>
                                <select class="form-control" id="antint_check" name="antint_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!---->
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Antivuelco Exterior</label>
                                <select class="form-control" id="antext_check" name="antext_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Freno de Mano</label>
                                <select class="form-control" id="frmano_check" name="frmano_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Rueda Repuesto</label>
                                <select class="form-control" id="rurep_check" name="">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Gata</label>
                                <select class="form-control" id="gata_check" name="gata_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Triangulo o Cono</label>
                                <select class="form-control" id="tria_check" name="tria_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Chaleco Reflectante</label>
                                <select class="form-control" id="chalrefl_check" name="chalrefl_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Revisón Documentos</label>
                                <select class="form-control" id="revdocs_check" name="revdocs_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Extintor</label>
                                <select class="form-control" id="extintor_check" name="extintor_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Baliza</label>
                                <select class="form-control" id="baliza_check" name="baliza_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Alarma Retroceso</label>
                                <select class="form-control" id="alarret_check" name="alarret_check">
                                    <option value=""></option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Observaciones</label>
                                <input type="text" class="form-control" id="obs_check" name="obs_check">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="check_camionetas()">
            </div>
        </div>

    </div>
</div>


<!--./ Modal Nueva Mantencion Camioneta-->
<div class="modal fade" id="modal_matencion_camioneta">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva Mantención Camioneta</h4>
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
                                <input type="date" class="form-control" id="fecha_mant_cam" name="fecha_mant_cam">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Patente</label>
                                <select class="form-control" id="patente_mant_cam" name="patente_mant_cam">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT id_camioneta,patente FROM camionetas3h");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_camioneta] . '">' . $valores[patente] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control" id="id_est_equipo_mant_cam" name="id_est_equipo_mant_cam">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM estado_equipos where id_est_equipo in (1,2)");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_est_equipo] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Kilometraje</label>
                                <input type="text" class="form-control" id="km_mant_cam" name="km_mant_cam">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group"><label for="state_id" class="control-label">Checklist</label></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="CAceiteM_mant_cam" id="CAceiteM_mant_cam" value="C.Aceite Motor">
                                    <label class="form-check-label">Cambio Aceite Motor</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="CFiltroAceite_mant_cam" id="CFiltroAceite_mant_cam" value="C.Filtro Aceite">
                                    <label class="form-check-label">Cambio Filtro de Aceite</label>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="CFiltroComb_mant_cam" id="CFiltroComb_mant_cam" value="C.Filtro Combustible">
                                    <label class="form-check-label">Cambio Filtro de Combustible</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="CFiltroAire_mant_cam" id="CFiltroAire_mant_cam" value="C.Filtro Aire">
                                    <label class="form-check-label">Cambio Filtro de Aire</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ChequeoD_mant_cam" id="ChequeoD_mant_cam" value="Cheq.Diferencial">
                                    <label class="form-check-label">Chequeo Diferencial</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="cambiofpolen_mant_cam" id="cambiofpolen_mant_cam" value="C.Filtro Polen">
                                    <label class="form-check-label">Cambio Filtro Polen</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Observaciones</label>
                                <textarea class="form-control" rows="2" id="observaciones_man_cam" name="observaciones_man_cam" placeholder="Escriba aquí..."></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="mant_cam_nuevo()">
            </div>
        </div>

    </div>
</div>