<div class="modal fade" id="modal_ficha_nutri">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ficha Nutricional</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-11">
                        <div class="form-group"><label for="state_id" class="control-label">Trabajador</label>
                            <select class="select2 select2" id="fn_id_empleado" name="fn_id_empleado">
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
                            <label for="state_id" class="control-label">Peso</label>
                            <input type="number" class="form-control" id="fn_peso" name="fn_peso">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Talla</label>
                            <input type="number" class="form-control" id="fn_talla" name="fn_talla">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">IMC</label>
                            <input type="number" class="form-control" id="fn_imc" name="fn_imc">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">%G.Corporal</label>
                            <input type="number" class="form-control" id="fn_gcorporal" name="fn_gcorporal">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">%G.Muscular</label>
                            <input type="number" class="form-control" id="fn_gmuscular" name="fn_gmuscular">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">%G.Visceral</label>
                            <input type="number" class="form-control" id="fn_gvisceral" name="fn_gvisceral">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Estado Nutricional</label>
                            <input type="text" class="form-control" id="fn_estnutri" name="fn_estnutri">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Enfermedades</label>
                            <input type="text" class="form-control" id="fn_enfermedades" name="fn_enfermedades">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Hábitos: ¿Fumador/Alcohol/Drogas?</label>
                            <input type="text" class="form-control" id="fn_habitos" name="fn_habitos">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Medicamentos</label>
                            <input type="text" class="form-control" id="fn_medicamentos" name="fn_medicamentos">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Alergias/Alergias Alimentarias</label>
                            <input type="text" class="form-control" id="fn_alergias" name="fn_alergias">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Actividad Fisica</label>
                            <input type="text" class="form-control" id="fn_actividadf" name="fn_actividadf">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="ficha_nutricional()">
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->

<div class="modal fade" id="modal_ficha_nutri_edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ficha Nutricional</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group"><label for="state_id" class="control-label">Trabajador</label>
                            <select class="form-control" id="efn_id_empleado" name="efn_id_empleado" disabled>
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
                            <label for="state_id" class="control-label">Peso</label>
                            <input type="number" class="form-control" id="efn_peso" name="efn_peso">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Talla</label>
                            <input type="number" class="form-control" id="efn_talla" name="efn_talla">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">IMC</label>
                            <input type="number" class="form-control" id="efn_imc" name="efn_imc">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">%G.Corporal</label>
                            <input type="number" class="form-control" id="efn_gcorporal" name="efn_gcorporal">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">%G.Muscular</label>
                            <input type="number" class="form-control" id="efn_gmuscular" name="efn_gmuscular">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state_id" class="control-label">%G.Visceral</label>
                            <input type="number" class="form-control" id="efn_gvisceral" name="efn_gvisceral">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Estado Nutricional</label>
                            <input type="text" class="form-control" id="efn_estnutri" name="efn_estnutri">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Enfermedades</label>
                            <input type="text" class="form-control" id="efn_enfermedades" name="efn_enfermedades">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Hábitos: ¿Fumador/Alcohol/Drogas?</label>
                            <input type="text" class="form-control" id="efn_habitos" name="efn_habitos">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Medicamentos</label>
                            <input type="text" class="form-control" id="efn_medicamentos" name="efn_medicamentos">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Alergias/Alergias Alimentarias</label>
                            <input type="text" class="form-control" id="efn_alergias" name="efn_alergias">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="state_id" class="control-label">Actividad Fisica</label>
                            <input type="text" class="form-control" id="efn_actividadf" name="efn_actividadf">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Editar" onclick="edit_ficha_nutricional()">
            </div>
        </div>
    </div>
</div>