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



$sql_query = "UPDATE viajes_sulfuro SET fecha='" . $fecha . "',num_guia='" . $num_guia . "',id_responsable='" . $id_responsable . "',id_patente='" . $id_patente . "',id_chofer='" . $id_chofer . "',sector='" . $sector . "',hora='" . $hora . "',tonelaje='" . $tonelaje . "' WHERE id_sulf = " . $id_sulf . "";
$result = mysqli_query($con, $sql_query);

echo 1;
