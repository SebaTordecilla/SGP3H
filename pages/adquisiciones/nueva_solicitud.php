<?php
include "../../conexion.php";

$solicitado = mysqli_real_escape_string($con, $_POST['solicitado']);
$hora = mysqli_real_escape_string($con, $_POST['hora']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$area = mysqli_real_escape_string($con, $_POST['area']);
$prioridad = mysqli_real_escape_string($con, $_POST['prioridad']);
$justificacion = mysqli_real_escape_string($con, $_POST['justificacion']);
$id_solicitud = mysqli_real_escape_string($con, $_POST['id_solicitud']);



if ($id_solicitud > 0) {
    $sql_query = "UPDATE ordenes_compras SET id_empresa='" . $id_empresa . "',id_proveedor='" . $id_proveedor . "',pago='" . $pago . "',cotizacion='" . $cotizacion . "',id_pedido='" . $id_pedido . "',fecha='" . $fecha . "' where id_oc ='" . $id_oc . "'";
    $result = mysqli_query($con, $sql_query);
    echo 2;
} else {
    $sql_query0 = "SELECT MAX(id_pedido)+1 AS max from solicitudes_compra";
    $result0 = mysqli_query($con, $sql_query0);
    $row = mysqli_fetch_array($result0);
    $max = $row['max'];

    $sql_query = "INSERT INTO solicitudes_compra(id_pedido, solicitado, hora, fecha, area, prioridad, justificacion, estado) 
    VALUES ('" . $max . "',' " . $solicitado . "', '" . $hora . "', '" . $fecha . "', '" . $area . "', '" . $prioridad . "', '" . $justificacion . "', 1)";
    $result = mysqli_query($con, $sql_query);
    echo 1;
}
