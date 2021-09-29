<?php
include "../../conexion.php";

$id_equipo = mysqli_real_escape_string($con, $_POST['id_equipo']);
$id_est_equipo = mysqli_real_escape_string($con, $_POST['id_est_equipo']);
$hora_inicio = mysqli_real_escape_string($con, $_POST['hora_inicio']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);

$v_HorasPartes = explode(":", $hora_inicio);
$seg_totales = ($v_HorasPartes[0] * 3600) + ($v_HorasPartes[1] * 60);

$sql_query = "SELECT TIME_TO_SEC(hora_inicio)as hora_inicio,IF(TIME_TO_SEC(hora_ini_col)=0,1,TIME_TO_SEC(hora_ini_col)) as hora_ini_col,IF(TIME_TO_SEC(hora_fin_col)=0,1,TIME_TO_SEC(hora_fin_col)) as hora_fin_col,IF(TIME_TO_SEC(hora_ini_mec)=0,1,TIME_TO_SEC(hora_ini_mec)) as hora_ini_mec FROM salida_equipos WHERE id_equipo =" . $id_equipo . " AND fecha = '" . $fecha . "';";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);

$h_ini = $row['hora_inicio'];
$h_ini_col = $row['hora_ini_col'];
$h_fin_col = $row['hora_fin_col'];
$h_ini_mec = $row['hora_ini_mec'];
$h_ini2 = (float)$h_ini;
$h_ini_col2 = (float)$h_ini_col;
$h_fin_col2 = (float)$h_fin_col;
$h_ini_mec2 = (float)$h_ini_mec;

if ($h_ini == "") {
    echo 1;
} else if ($h_ini != "") {
    if ($h_ini_mec2 != 1) {
        echo 12;
    } else {
        if ($seg_totales > $h_ini2) {
            $sql_query = "UPDATE salida_equipos set id_estado_diario = 8, hora_ini_mec ='" . $hora_inicio . "' WHERE id_equipo = " . $id_equipo . " and fecha ='" . $fecha . "';";
            $result = mysqli_query($con, $sql_query);

            $sql_query = "INSERT INTO reparacion_terreno(id_sal_equipo, id_ubicacion, id_est_equipo) VALUES ((SELECT id_sal_equipo FROM salida_equipos where id_equipo =" . $id_equipo . " and fecha ='" . $fecha . "')," . $id_ubicacion . ",8)";
            $result = mysqli_query($con, $sql_query);
            echo 11;
        } else {
            echo 10;
        }
    }
}
