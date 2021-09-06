<?php
include "../../conexion.php";

$id_equipo = mysqli_real_escape_string($con, $_POST['id_equipo']);
$id_operador = mysqli_real_escape_string($con, $_POST['id_operador']);
$id_supervisor = mysqli_real_escape_string($con, $_POST['id_supervisor']);
$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);
$turno = mysqli_real_escape_string($con, $_POST['turno']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$hora_inicio = mysqli_real_escape_string($con, $_POST['hora_inicio']);

if ($id_equipo != "") {
    $sql_query2 = "SELECT COUNT(*) cntUser FROM salida_equipos WHERE id_equipo =" . $id_equipo . " and fecha='" . $fecha . "';";
    $result2 = mysqli_query($con, $sql_query2);
    $row = mysqli_fetch_array($result2);

    $count = $row['cntUser'];

    if ($count > 0) {
        echo 3;
    } else {
        if ($id_equipo != "" && $id_operador != "" && $id_supervisor != "" && $fecha != "" && $id_ubicacion != "" && $turno != "" && $hora_inicio != "") {
            $sql_query = "INSERT INTO salida_equipos(id_equipo, id_operador, id_supervisor, id_ubicacion, turno, fecha, hora_inicio,id_estado_diario) VALUES (" . $id_equipo . "," . $id_operador . "," . $id_supervisor . "," . $id_ubicacion . ",'" . $turno . "','" . $fecha . "','" . $hora_inicio . "',1);";
            $result = mysqli_query($con, $sql_query);

            $sql_query2 = "SELECT COUNT(*) cntUser FROM salida_equipos WHERE id_equipo =" . $id_equipo . " and fecha='" . $fecha . "' and hora_inicio='" . $hora_inicio . "';";
            $result2 = mysqli_query($con, $sql_query2);
            $row = mysqli_fetch_array($result2);

            $count = $row['cntUser'];

            if ($count > 0) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }
}
