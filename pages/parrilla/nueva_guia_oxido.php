<?php
include('../../conexion.php');

$id_lote = mysqli_real_escape_string($con, $_POST['id_lote']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$hora = mysqli_real_escape_string($con, $_POST['hora']);
$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);
$num_guia = mysqli_real_escape_string($con, $_POST['num_guia']);
$id_chofer = mysqli_real_escape_string($con, $_POST['id_chofer']);
$id_patente = mysqli_real_escape_string($con, $_POST['id_patente']);
$tonelaje = mysqli_real_escape_string($con, $_POST['tonelaje']);
$leyvis = mysqli_real_escape_string($con, $_POST['leyvis']);
$usuario = mysqli_real_escape_string($con, $_POST['usuario']);


if ($id_lote > 0) {
    $sql_query = "INSERT INTO guias_camiones(id_lote, num_guia, id_ubicacion, fecha, hora, id_patente, id_chofer, tonelaje, leyvis, registro) 
    VALUES ('" . $id_lote . "', '" . $num_guia . "', '" . $id_ubicacion . "', '" . $fecha . "', '" . $hora . "', '" . $id_patente . "', '" . $id_chofer . "', '" . $tonelaje . "', '" . $leyvis . "', '" . $usuario . "')";
    $result = mysqli_query($con, $sql_query);

    echo 1;
} else {
}
