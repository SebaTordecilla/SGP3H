<?php
include('../../conexion.php');

$id_sulf = mysqli_real_escape_string($con, $_POST['id_sulf']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$hora = mysqli_real_escape_string($con, $_POST['hora']);
$id_responsable = mysqli_real_escape_string($con, $_POST['id_responsable']);
$num_guia = mysqli_real_escape_string($con, $_POST['num_guia']);
$id_chofer = mysqli_real_escape_string($con, $_POST['id_chofer']);
$id_patente = mysqli_real_escape_string($con, $_POST['id_patente']);
$tonelaje = mysqli_real_escape_string($con, $_POST['tonelaje']);
$sector = mysqli_real_escape_string($con, $_POST['sector']);
$usuario = mysqli_real_escape_string($con, $_POST['usuario']);



$sql_query = "SELECT num FROM viajes_sulfuro where month(fecha) = month('" . $fecha . "')  and year(fecha) = year('" . $fecha . "') order by num desc limit 1";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$num0 = $row['num'];
$num = $num0 + 1;

if ($num0 != "") {
    $sql_query = "INSERT INTO viajes_sulfuro(num, fecha, num_guia, id_responsable, id_patente, id_chofer, sector, hora, tonelaje, registro, estado) 
    VALUES ('" . $num . "', '" . $fecha . "', '" . $num_guia . "', '" . $id_responsable . "', '" . $id_patente . "', '" . $id_chofer . "', '" . $sector . "', '" . $hora . "', '" . $tonelaje . "', '" . $usuario . "', 1)";
    $result = mysqli_query($con, $sql_query);
    echo 1;
} else {
    $sql_query = "INSERT INTO viajes_sulfuro(num, fecha, num_guia, id_responsable, id_patente, id_chofer, sector, hora, tonelaje, registro, estado) 
    VALUES (1, '" . $fecha . "', '" . $num_guia . "', '" . $id_responsable . "', '" . $id_patente . "', '" . $id_chofer . "', '" . $sector . "', '" . $hora . "', '" . $tonelaje . "', '" . $usuario . "', 1)";
    $result = mysqli_query($con, $sql_query);
    echo 1;
}
