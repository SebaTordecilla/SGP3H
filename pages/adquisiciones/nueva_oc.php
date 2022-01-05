<?php
include "../../conexion.php";

$id_empresa = mysqli_real_escape_string($con, $_POST['id_empresa']);
$id_proveedor = mysqli_real_escape_string($con, $_POST['id_proveedor']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$pago = mysqli_real_escape_string($con, $_POST['pago']);
$cotizacion = mysqli_real_escape_string($con, $_POST['cotizacion']);
$id_pedido = mysqli_real_escape_string($con, $_POST['id_pedido']);



$sql_query = "INSERT INTO ordenes_compras(id_empresa, id_proveedor, pago, cotizacion, id_pedido, fecha, estado) 
VALUES ('" . $id_empresa . "', '" . $id_proveedor . "', '" . $pago . "', '" . $cotizacion . "', '" . $id_pedido . "', '" . $fecha . "', 1);";
$result = mysqli_query($con, $sql_query);


echo 1;


?>