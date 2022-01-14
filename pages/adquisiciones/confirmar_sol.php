<?php
include "../../conexion.php";

$id_solicitud = mysqli_real_escape_string($con, $_POST['id_solicitud']);


$sql_query1 = "SELECT count(sc.id_pedido) as contador FROM articulos_solicitados ac inner join solicitudes_compra sc on ac.id_pedido = sc.id_pedido where sc.id_solicitud = " . $id_solicitud . " ";
$result1 = mysqli_query($con, $sql_query1);
$row = mysqli_fetch_array($result1);
$contador = $row['contador'];

if ($contador > 0) {

    $sql_query = "UPDATE solicitudes_compra SET estado=2 WHERE id_solicitud =" . $id_solicitud . ";";
    $result = mysqli_query($con, $sql_query);

    echo 1;
} else {
    echo 2;
}
