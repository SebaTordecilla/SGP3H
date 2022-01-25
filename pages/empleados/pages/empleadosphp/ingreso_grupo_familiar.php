<?php
include "../../conexion.php";

$id_empleado = mysqli_real_escape_string($con, $_POST['id_empleado']);
$nombre = mysqli_real_escape_string($con, $_POST['nombre']);
$rut = mysqli_real_escape_string($con, $_POST['rut']);
$edad = mysqli_real_escape_string($con, $_POST['edad']);
$nivel_edu = mysqli_real_escape_string($con, $_POST['nivel_edu']);
$ocupacion = mysqli_real_escape_string($con, $_POST['ocupacion']);
$parentesco = mysqli_real_escape_string($con, $_POST['parentesco']);

$sql_query = "INSERT INTO grupo_familiar (id_empleado,nombre,rut,edad,nivel_edu,ocupacion,parentesco)
VALUES ('" . $id_empleado . "','" . $nombre . "','" . $rut . "','" . $edad . "','" . $nivel_edu . "','" . $ocupacion . "','" . $parentesco . "')";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);

echo $id_empleado;
