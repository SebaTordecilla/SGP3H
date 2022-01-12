<?php
include "../../conexion.php";

$id_pedido = mysqli_real_escape_string($con, $_POST['id_pedido']);
$descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
$cantidad = mysqli_real_escape_string($con, $_POST['cantidad']);
$stock = mysqli_real_escape_string($con, $_POST['stock']);
$proveedor = mysqli_real_escape_string($con, $_POST['proveedor']);



$sql_query = "INSERT INTO articulos_solicitados(id_pedido, descripcion, cantidad, stock, proveedor) 
VALUES ('" . $id_pedido . "', '" . $descripcion . "', '" . $cantidad . "', '" . $stock . "', '" . $proveedor . "')";
$result = mysqli_query($con, $sql_query);
echo $id_pedido;
