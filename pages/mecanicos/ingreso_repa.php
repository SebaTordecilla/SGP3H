<?php
include('../../conexion.php');

$id_falla = mysqli_real_escape_string($con, $_POST['id_falla']);
$hora_mec = mysqli_real_escape_string($con, $_POST['hora_mec']);
$duracion = mysqli_real_escape_string($con, $_POST['duracion']);
$observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);
$id_salida = mysqli_real_escape_string($con, $_POST['id_salida']);

$sql_query2 = "SELECT hora_ini FROM reparacion_terreno WHERE id_rep_ter =" . $id_salida . ";";
$result2 = mysqli_query($con, $sql_query2);
$row = mysqli_fetch_array($result2);
$hora_ini = $row['hora_ini'];

$hora_mec2 = explode(":", $hora_mec);
$hora_mec3 = ($hora_mec2[0] * 3600) + $hora_mec2[1] * 60;

$hora_ini2 = explode(":", $hora_ini);
$hora_ini3 = ($hora_ini2[0] * 3600) + $hora_ini2[1] * 60;


if ($hora_mec3 > $hora_ini3) {

    $sql_query = "UPDATE reparacion_terreno SET hora_mec='" . $hora_mec . "',id_falla='" . $id_falla . "',duraccion='" . $duracion . "',observaciones='" . $observaciones . "',id_est_equipo=10 WHERE id_rep_ter =" . $id_salida . ";";
    $result = mysqli_query($con, $sql_query);

    echo 2;
} else {

    echo 1; //hora de llegada no puede ser menor a hora de solicitud
}
