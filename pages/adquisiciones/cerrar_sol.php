<?php
include "../../conexion.php";

$id_solicitud = mysqli_real_escape_string($con, $_POST['id_solicitud']);


$sql_query = "UPDATE solicitudes_compra SET estado=3 WHERE id_solicitud =" . $id_solicitud . ";";
$result = mysqli_query($con, $sql_query);

echo 1;
