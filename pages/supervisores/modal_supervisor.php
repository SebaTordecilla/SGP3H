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