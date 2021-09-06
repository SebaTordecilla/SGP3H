<?php
include "../../conexion.php";

$patente = mysqli_real_escape_string($con, $_POST['patente']);
$marca = mysqli_real_escape_string($con, $_POST['marca']);
$modelo = mysqli_real_escape_string($con, $_POST['modelo']);
$chofer = mysqli_real_escape_string($con, $_POST['chofer']);
$calidad = mysqli_real_escape_string($con, $_POST['calidad']);
$anio = mysqli_real_escape_string($con, $_POST['anio']);
$fecha_ingreso = mysqli_real_escape_string($con, $_POST['fecha_ingreso']);

$sql_query2 = "INSERT INTO camionetas3h (patente,marca,modelo,anio,fecha_ingreso,calidad,chofer,estado) VALUES('".$patente."','".$marca."','".$modelo."',".$anio.",'".$fecha_ingreso."','".$calidad."','".$chofer."',1);";
$result2 = mysqli_query($con, $sql_query2);

echo 1;

?>