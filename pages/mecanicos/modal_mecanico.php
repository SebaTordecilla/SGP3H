<div class="modal fade" id="reparaciones_">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reparación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!--./Linea1-->
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group"><label for="state_id" class="control-label">Tipo de Falla</label>
                                <select class="form-control" id="id_falla" name="id_falla">
                                    <option value=""></option>
                                    <?php
                                    $query = $con->query("SELECT * FROM fallas_mecanicas");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores[id_falla] . '">' . $valores[nombre] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Hora de Llegada</label>
                                <input type="time" class="form-control " id="hora_mec" name="hora_mec">
                                <input type="hidden" class="form-control id_salida" id="id_salida" name="id_salida">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Duracción</label>
                                <select class="form-control" id="duracion" name="duracion">
                                    <option value=""></option>
                                    <option value="00:30">00:30</option>
                                    <option value="01:00">01:00</option>
                                    <option value="01:30">01:30</option>
                                    <option value="02:00">02:00</option>
                                    <option value="03:00">03:00</option>
                                    <option value="04:00">04:00</option>
  
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="state_id" class="control-label">Observaciones</label>
                                <textarea class="form-control" rows="3" id="observaciones" name="observaciones" placeholder="Escriba aquí ..."></textarea>
                              
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="reparacion()">
            </div>
        </div>

    </div>
</div>