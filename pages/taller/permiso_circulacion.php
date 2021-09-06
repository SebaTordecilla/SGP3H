<?php
include "../../conexion.php";

$patente = mysqli_real_escape_string($con, $_POST['patente']);
$fecha_ini = mysqli_real_escape_string($con, $_POST['fecha_ini']);
$fecha_fin = mysqli_real_escape_string($con, $_POST['fecha_fin']);


$sql_query2 = "INSERT INTO p_circulacion (id_camioneta, fecha_ini, fecha_fin) VALUES (".$patente.",'".$fecha_ini."','".$fecha_fin."');";
$result2 = mysqli_query($con, $sql_query2);

echo 1;

?>