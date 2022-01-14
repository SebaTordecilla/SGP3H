<?php
include "../../conexion.php";

$id_oc = mysqli_real_escape_string($con, $_POST['id_oc']);

$sql_query1 = "SELECT count(id_oc) as contador from articulos_oc where id_oc = " . $id_oc . " ";
$result1 = mysqli_query($con, $sql_query1);
$row = mysqli_fetch_array($result1);
$contador = $row['contador'];
if ($contador > 0) {
    $sql_query0 = "SELECT max(num_oc)+1 as max FROM ordenes_compras ";
    $result0 = mysqli_query($con, $sql_query0);
    $row = mysqli_fetch_array($result0);
    $max = $row['max'];

    if ($max > 0) {
        $sql_query = "UPDATE ordenes_compras SET num_oc='" . $max . "',estado='2' WHERE id_oc =" . $id_oc . "";
        $result = mysqli_query($con, $sql_query);
        echo 1;
    }
} else {
    echo 2;
    // OC no tiene articulos
}
