<?php
include "../../conexion.php";

$id_empresa = mysqli_real_escape_string($con, $_POST['id_empresa']);
$id_proveedor = mysqli_real_escape_string($con, $_POST['id_proveedor']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$pago = mysqli_real_escape_string($con, $_POST['pago']);
$cotizacion = mysqli_real_escape_string($con, $_POST['cotizacion']);
$id_pedido = mysqli_real_escape_string($con, $_POST['id_pedido']);
$id_oc = mysqli_real_escape_string($con, $_POST['id_oc']);

if ($id_oc > 0) {
    $sql_query = "UPDATE ordenes_compras SET id_empresa='" . $id_empresa . "',id_proveedor='" . $id_proveedor . "',pago='" . $pago . "',cotizacion='" . $cotizacion . "',id_pedido='" . $id_pedido . "',fecha='" . $fecha . "' where id_oc ='" . $id_oc . "'";
    $result = mysqli_query($con, $sql_query);
    echo 2;
} else {
    $sql_query = "INSERT INTO ordenes_compras(id_empresa, id_proveedor, pago, cotizacion, id_pedido, fecha, estado) 
    VALUES ('" . $id_empresa . "', '" . $id_proveedor . "', '" . $pago . "', '" . $cotizacion . "', '" . $id_pedido . "', '" . $fecha . "', 1);";
    $result = mysqli_query($con, $sql_query);
    echo 1;
}
