<!--./ Modal leyes lab-->
<div class="modal fade" id="ingreso_muestras_geo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Muestras Geologia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!--./Linea1-->
                    <div class="row">
                        <input type="hidden" class="form-control id_geo" id="id_geo" name="id_geo">
                        <input type="hidden" class="form-control usuario" id="usuario" name="usuario" value="<?php echo $_SESSION['uname']; ?>">

                        <div class="col-sm-6">
                            <div class="form-group"><label for="state_id" class="control-label">CutLab</label>
                                <input type="number" step="0.01" min="0" max="10" class="form-control" id="geo_labCutVisual" name="geo_labCutVisual">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group"><label for="state_id" class="control-label">CusLab</label>
                                <input type="number" step="0.01" min="0" max="10" class="form-control" id="geo_labCusVisual" name="geo_labCusVisual">

                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="button" class="btn naranjo" value="Ingresar" onclick="muestra_geo_lab()">
            </div>
        </div>

    </div>
</div>