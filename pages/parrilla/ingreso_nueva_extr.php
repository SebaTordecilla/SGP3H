<?php
include('../../conexion.php');

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
$usuario = mysqli_real_escape_string($con, $_POST['usuario']);


if ($id_ubicacion > 0) {
    $sql_query = "INSERT INTO extraccion_mineral(id_ubicacion, id_manto, id_calle, id_labor, fecha, id_equipo, id_op, id_mineral, id_obs_min, hora1, hora2, hora3, hora4, hora5, estado, registro) 
    VALUES (" . $id_ubicacion . ", " . $id_manto . ", " . $id_calle . ", '" . $id_labor . "', '" . $fecha . "', " . $id_equipo . ", " . $id_op . ", '" . $tipo . "','" . $id_obs_min . "' ,'" . $hora1 . "', '" . $hora2 . "', '" . $hora3 . "', '" . $hora4 . "', '" . $hora5 . "', 1,  CONCAT('" . $usuario . " - ', NOW()))";
    $result = mysqli_query($con, $sql_query);
    echo 1;
} else {
}
