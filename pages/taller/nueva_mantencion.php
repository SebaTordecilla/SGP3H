<?php
include('../../conexion.php');

$check_list = mysqli_real_escape_string($con, $_POST['selected2']);
$id_est_equipo = mysqli_real_escape_string($con, $_POST['id_est_equipo']);
$id_equipo = mysqli_real_escape_string($con, $_POST['id_equipo']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$observaciones = mysqli_real_escape_string($con, $_POST['observaciones_man']);


if ($id_equipo > 0) {
    $sql_query2 = "INSERT INTO mant_equipos(id_equipo, fecha, id_est_equipo, observaciones, check_list) VALUES (" . $id_equipo . ", '" . $fecha . "', " . $id_est_equipo . ", '" . $observaciones . "','" . $check_list . "');";
    $result2 = mysqli_query($con, $sql_query2);


    $sql_query = "UPDATE lista_equipos SET id_est_equipo =" . $id_est_equipo . " WHERE id_equipo =" . $id_equipo . ";";
    $result = mysqli_query($con, $sql_query);

    echo 1;
} else {
    echo 2;
}
