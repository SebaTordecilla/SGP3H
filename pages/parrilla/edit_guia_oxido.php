<?php
include('../../conexion.php');

$id_guia = mysqli_real_escape_string($con, $_POST['id_guia']);
$id_lote = mysqli_real_escape_string($con, $_POST['id_lote']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$hora = mysqli_real_escape_string($con, $_POST['hora']);
$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);
$num_guia = mysqli_real_escape_string($con, $_POST['num_guia']);
$id_chofer = mysqli_real_escape_string($con, $_POST['id_chofer']);
$id_patente = mysqli_real_escape_string($con, $_POST['id_patente']);
$tonelaje = mysqli_real_escape_string($con, $_POST['tonelaje']);
$leyvis = mysqli_real_escape_string($con, $_POST['leyvis']);


if ($id_lote > 0) {
    $sql_query = "UPDATE guias_camiones SET num_guia ='" . $num_guia . "',id_ubicacion='" . $id_ubicacion . "',fecha='" . $fecha . "',hora='" . $hora . "',id_patente='" . $id_patente . "',id_chofer='" . $id_chofer . "',tonelaje='" . $tonelaje . "',leyvis='" . $leyvis . "' WHERE id_guia ='" . $id_guia . "'";
    $result = mysqli_query($con, $sql_query);

    echo 1;
} else {
}
