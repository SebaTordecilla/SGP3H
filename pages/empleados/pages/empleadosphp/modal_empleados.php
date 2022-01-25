<!--./ Modal Nueva -->
<div class="modal fade" id="modal_nuevo_empleado">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Trabajador</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- linea 1 -->
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Rut(*)</label>
                                <input type="text" class="form-control" id="emple_rut" name="emple_rut" placeholder="sin puntos y guión">
                                <input type="hidden" class="form-control" id="emple_id_empleado" name="emple_id_empleado">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Nombres(*)</label>
                                <input type="text" class="form-control" id="emple_nombres" name="emple_nombres">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Ap.Paterno(*)</label>
                                <input type="text" class="form-control" id="emple_appaterno" name="emple_appaterno">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Ap.MAterno(*)</label>
                                <input type="text" class="form-control" id="emple_apmaterno" name="emple_apmaterno">
                            </div>
                        </div>
                    </div>

                    <!-- linea 2 -->
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">F.Nacimiento(*)</label>
                                <input type="date" class="form-control" id="emple_fnac" name="emple_fnac">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Correo</label>
                                <input type="email" class="form-control" id="emple_correo" name="emple_correo">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Telefono</label>
                                <input type="text" class="form-control" id="emple_telefono" name="emple_telefono">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Sexo</label>
                                <select class="form-control" id="emple_sexo" name="emple_sexo">
                                    <option value=""></option>
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">F.Ingreso</label>
                                <input type="date" class="form-control" id="emple_fing" name="emple_fing">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Cargo</label>
                                <input type="text" class="form-control" id="emple_cargo" name="emple_cargo">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-group"><label for="state_id" class="control-label">Nacionalidad</label>
                                    <select class="form-control" id="emple_nacionalidad" name="emple_nacionalidad">
                                        <option value=""></option>
                                        <option value="Chilena">Chilena</option>
                                        <option value="Venezolana">Venezolana</option>
                                        <option value="Peruana">Peruana</option>
                                        <option value="Haitiana">Haitiana</option>
                                        <option value="Cubana">Cubana</option>
                                        <option value="Argentina">Argentina</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-group"><label for="state_id" class="control-label">Est. Civil</label>
                                    <select class="form-control" id="emple_estciv" name="emple_estciv">
                                        <option value=""></option>
                                        <option value="soltero">Soltero/a</option>
                                        <option value="casado">Casado/a</option>
                                        <option value="union libre">Unión libre o unión de hecho</option>
                                        <option value="separado">Separado/a</option>
                                        <option value="divorciado">Divorciado/a</option>
                                        <option value="viudo">Viudo/a.</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">F. Matrimonio</label>
                                <input type="date" class="form-control" id="emple_fmatri" name="emple_fmatri">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-group"><label for="state_id" class="control-label">Contrato</label>
                                    <select class="form-control" id="emple_tcontra" name="emple_tcontra">
                                        <option value=""></option>
                                        <option value="Indefinido">Indefinido</option>
                                        <option value="Plazo Fijo">Plazo Fijo</option>
                                        <option value="Por obra o faena">Por obra o faena</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Contacto Emergencia</label>
                                <input type="text" class="form-control" id="emple_emergencia" name="emple_emergencia">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Titulo u Oficio</label>
                                <input type="text" class="form-control" id="emple_titulo" name="emple_titulo">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Nivel de Estudios</label>
                                <select class="form-control" id="emple_nvlestu" name="emple_nvlestu">
                                    <option value=""></option>
                                    <option value="Ninguno">Ninguno</option>
                                    <option value="Pre Básica">Pre Básica</option>
                                    <option value="Básica">Básica</option>
                                    <option value="Media">Media</option>
                                    <option value="Técnica">Técnica</option>
                                    <option value="Universitario">Universitario</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="state_id" class="control-label">RSH</label>
                                <input type="number" class="form-control" id="emple_rsh" name="emple_rsh">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Enfermedad Cronica</label>
                                <input type="text" class="form-control" id="emple_enfercro" name="emple_enfercro">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Tratamiento</label>
                                <input type="text" class="form-control" id="emple_tratam" name="emple_tratam">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Discapacidad</label>
                                <input type="text" class="form-control" id="emple_discap" name="emple_discap">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Tipo Discapacidad</label>
                                <input type="text" class="form-control" id="emple_tipdisca" name="emple_tipdisca">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Programa de Intervención</label>
                                <input type="text" class="form-control" id="emple_progint" name="emple_progint">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label for="state_id" class="control-label">Estado(*)</label>
                                <select class="form-control" id="emple_estado" name="emple_estado">
                                    <option value=""></option>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="Ingresar_Empleado()">
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_grupo_familiar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Grupo Familiar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-11">
                        <div class="form-group"><label for="state_id" class="control-label">Trabajador</label>
                            <select class="select2 select2" id="gf_id_empleado" name="gf_id_empleado">
                                <option value=""></option>
                                <option value=""></option>
                                <?php
                                $query = $con->query("SELECT id_empleado,upper(concat(nombres,' ',ap_paterno,' ',ap_materno)) as nombre_completo FROM empleados;");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores[id_empleado] . '">' . $valores[nombre_completo] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="gf_nombre" name="gf_nombre">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Rut</label>
                            <input type="text" class="form-control" id="gf_rut" name="gf_rut">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Edad</label>
                            <input type="number" class="form-control" id="gf_edad" name="gf_edad">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group"><label for="state_id" class="control-label">Nivel de Estudios</label>
                            <select class="form-control" id="gf_nvlestu" name="gf_nvlestu">
                                <option value=""></option>
                                <option value="Ninguno">Ninguno</option>
                                <option value="Pre Básica">Pre Básica</option>
                                <option value="Básica">Básica</option>
                                <option value="Media">Media</option>
                                <option value="Técnica">Técnica</option>
                                <option value="Universitario">Universitario</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Ocupación</label>
                            <input type="text" class="form-control" id="gf_ocupacion" name="gf_ocupacion">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group"><label for="state_id" class="control-label">Parentesco</label>
                            <select class="form-control" id="gf_parentesco" name="gf_parentesco">
                                <option value=""></option>
                                <option value="PADRE">PADRE</option>
                                <option value="MADRE">MADRE</option>
                                <option value="SUEGRO/A">SUEGRO/A</option>
                                <option value="HIJO/A">HIJO/A</option>
                                <option value="YERNO">YERNO</option>
                                <option value="NUERA">NUERA</option>
                                <option value="ABUELO/A">ABUELO/A</option>
                                <option value="NIETO/A">NIETO/A</option>
                                <option value="HERMANO/A">HERMANO/A</option>
                                <option value="CUÑADO/A">CUÑADO/A</option>
                                <option value="BISABUELO/A">BISABUELO/A</option>
                                <option value="BIZNIETO/A">BIZNIETO/A</option>
                                <option value="TIO/A">TIO/A</option>
                                <option value="SOBRINO/A">SOBRINO/A</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="state_id" class="control-label">add</label>
                            <br>
                            <input type="button" class="btn naranjo" value="+" onclick="agregar_grupof()">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="tabla_grupof" style="padding-top:10px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>