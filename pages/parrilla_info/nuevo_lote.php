<?php
include('../../conexion.php');

$num_lote = mysqli_real_escape_string($con, $_POST['num_lote']);
$id_emplot = mysqli_real_escape_string($con, $_POST['id_emplot']);
$mes = mysqli_real_escape_string($con, $_POST['mes']);
$ano = mysqli_real_escape_string($con, $_POST['ano']);





if ($id_emplot > 0) {
    $sql_query = "INSERT INTO lotes(num_lote, id_emplot, mes, ano, estado) VALUES ('" . $num_lote . "', '" . $id_emplot . "','" . $mes . "', '" . $ano . "', 1)";
    $result = mysqli_query($con, $sql_query);
    echo 1;
} else {
}
