<?php
include('../../conexion.php');

$id_extmin = mysqli_real_escape_string($con, $_POST['id_extmin']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);
$id_manto = mysqli_real_escape_string($con, $_POST['id_manto']);
$id_calle = mysqli_real_escape_string($con, $_POST['id_calle']);
$id_labor = mysqli_real_escape_string($con, $_POST['id_labor']);
$id_op = mysqli_real_escape_string($con, $_POST['id_op']);
$id_equipo = mysqli_real_escape_string($con, $_POST['id_equipo']);
$tipo = mysqli_real_escape_string($con, $_POST['tipo']);
$id_obs_min = mysqli_real_escape_string($con, $_POST['id_obs_min']);
$hora1 = mysqli_real_escape_string($con, $_POST['hora1']);
$hora2 = mysqli_real_escape_string($con, $_POST['hora2']);
$hora3 = mysqli_real_escape_string($con, $_POST['hora3']);
$hora4 = mysqli_real_escape_string($con, $_POST['hora4']);
$hora5 = mysqli_real_escape_string($con, $_POST['hora5']);


if ($id_ubicacion > 0) {
    $sql_query = "UPDATE extraccion_mineral SET id_ubicacion ='" . $id_ubicacion . "',id_manto='" . $id_manto . "',id_calle='" . $id_calle . "',id_labor='" . $id_labor . "',fecha='" . $fecha . "',id_equipo='" . $id_equipo . "',id_op='" . $id_op . "',id_mineral='" . $tipo . "',id_obs_min='" . $id_obs_min . "',hora1='" . $hora1 . "',hora2='" . $hora2 . "',hora3='" . $hora3 . "',hora4='" . $hora4 . "',hora5='" . $hora5 . "' WHERE id_extmin =" . $id_extmin . ";";
    $result = mysqli_query($con, $sql_query);
    echo 1;
} else {
}
