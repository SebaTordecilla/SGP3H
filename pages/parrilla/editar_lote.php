<?php
include('../../conexion.php');

$num_lote = mysqli_real_escape_string($con, $_POST['num_lote']);
$id_emplot = mysqli_real_escape_string($con, $_POST['id_emplot']);
$mes = mysqli_real_escape_string($con, $_POST['mes']);
$ano = mysqli_real_escape_string($con, $_POST['ano']);
$id_lote = mysqli_real_escape_string($con, $_POST['id_lote0']);

if ($id_emplot > 0) {
    $sql_query = "UPDATE lotes SET num_lote = '" . $num_lote . "', id_emplot ='" . $id_emplot . "',mes='" . $mes . "',ano= '" . $ano . "' WHERE id_lote=" . $id_lote . ";";
    $result = mysqli_query($con, $sql_query);
    echo 1;
} else {
}
