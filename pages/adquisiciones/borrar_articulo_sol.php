<?php
include "../../conexion.php";

$id_artsol = mysqli_real_escape_string($con, $_POST['id_artsol']);
$id_pedido = mysqli_real_escape_string($con, $_POST['id_pedido']);

$sql_query = "DELETE FROM articulos_solicitados WHERE id_artsol =" . $id_artsol . "";
$result = mysqli_query($con, $sql_query);

echo $id_pedido;
