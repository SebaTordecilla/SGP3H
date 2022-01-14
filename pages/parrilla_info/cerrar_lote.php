<?php
include('../../conexion.php');

$id_lote = mysqli_real_escape_string($con, $_POST['id_lote']);

if ($id_lote > 0) {
    $sql_query = "UPDATE lotes SET estado = 2 WHERE id_lote=" . $id_lote . ";";
    $result = mysqli_query($con, $sql_query);
    echo 1;
} else {
}
