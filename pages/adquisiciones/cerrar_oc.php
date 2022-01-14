<?php
include "../../conexion.php";

$id_oc = mysqli_real_escape_string($con, $_POST['id_oc']);


$sql_query0 = "SELECT count(id_oc)as contador FROM documentos_oc where id_oc = " . $id_oc . ";";
$result0 = mysqli_query($con, $sql_query0);
$row = mysqli_fetch_array($result0);
$contador = $row['contador'];
if ($contador > 0) {
    $sql_query = "UPDATE ordenes_compras SET estado=3 WHERE id_oc =" . $id_oc . ";";
    $result = mysqli_query($con, $sql_query);

    echo 1;
} else {
    echo 2;
}
