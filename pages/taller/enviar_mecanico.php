<?php
include "../../conexion.php";

$salida_equipo = mysqli_real_escape_string($con, $_POST['salida_equipo']);
$hora = mysqli_real_escape_string($con, $_POST['hora']);
$id_mecanico = mysqli_real_escape_string($con, $_POST['id_mecanico']);

$v_HorasPartes = explode(":", $hora);
$seg_totales = ($v_HorasPartes[0] * 3600) + ($v_HorasPartes[1] * 60);

$sql_query3 = "SELECT TIME_TO_SEC(hora_ini_mec) as hora_ini_mec,TIME_TO_SEC(IF(hora_mec = '00:00:00',1,hora_mec)) as hora_mec FROM salida_equipos where id_sal_equipo=" . $salida_equipo . ";";
$result3 = mysqli_query($con, $sql_query3);
$row = mysqli_fetch_array($result3);

$hora_ini_mec = $row['hora_ini_mec'];
$hora_mec = $row['hora_mec'];
$hora_ini_mec2 = (float)$hora_ini_mec;
$hora_mec2 = (float)$hora_mec;

if ($hora_mec2 == 1) {
    if ($hora_ini_mec2 != 1) {
        if ($seg_totales > $hora_ini_mec2) {
            $sql_query2 = "UPDATE salida_equipos SET hora_mec = '" . $hora . "' where id_sal_equipo =" . $salida_equipo . ";";
            $result2 = mysqli_query($con, $sql_query2);

            $sql_query = "UPDATE reparacion_terreno SET id_est_equipo = 9, id_mecanico =" . $id_mecanico . " WHERE id_sal_equipo =" . $salida_equipo . " ;";
            $result = mysqli_query($con, $sql_query);
            echo 2;
        } else {
            echo 3;
        }
    }
} else {
    echo 1;
}
