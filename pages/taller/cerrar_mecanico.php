<?php
include "../../conexion.php";

$salida_equipo = mysqli_real_escape_string($con, $_POST['salida_equipo']);
$hora = mysqli_real_escape_string($con, $_POST['hora']);
$observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);

$v_HorasPartes = explode(":", $hora);
$seg_totales = ($v_HorasPartes[0] * 3600) + ($v_HorasPartes[1] * 60);

$sql_query3 = "SELECT TIME_TO_SEC(hora_ini_mec) as hora_ini_mec,TIME_TO_SEC(IF(hora_mec = '00:00:00',1,hora_mec)) as hora_mec,TIME_TO_SEC(IF(hora_fin_mec = '00:00:00',1,hora_fin_mec)) as hora_fin_mec  FROM salida_equipos where id_sal_equipo=" . $salida_equipo . ";";
$result3 = mysqli_query($con, $sql_query3);
$row = mysqli_fetch_array($result3);

$hora_ini_mec = $row['hora_ini_mec'];
$hora_mec = $row['hora_mec'];
$hora_fin_mec = $row['hora_fin_mec'];
$hora_ini_mec2 = (float)$hora_ini_mec;
$hora_mec2 = (float)$hora_mec;
$hora_fin_mec2 = (float)$hora_fin_mec;

if ($hora_fin_mec2 == 1) {
    if ($hora_mec2 == 1) {
        echo 2;
    } else {
        if ($seg_totales > $hora_mec2) {
            $sql_query2 = "UPDATE salida_equipos SET hora_fin_mec = '" . $hora . "' WHERE id_sal_equipo =" . $salida_equipo . ";";
            $result2 = mysqli_query($con, $sql_query2);

            $sql_query = "UPDATE reparacion_terreno SET id_est_equipo = 10, observaciones='".$observaciones."' WHERE id_sal_equipo =" . $salida_equipo . " ;";
            $result = mysqli_query($con, $sql_query);
            echo 3;
        } else {
            echo 4;
        }
    }
} else {
    echo 1;
}

?>