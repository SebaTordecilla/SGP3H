<?php
include('../../conexion.php');

$id_ubicacion = mysqli_real_escape_string($con, $_POST['col_ubicacion']);
$fecha = mysqli_real_escape_string($con, $_POST['col_fecha']);
$usuario = mysqli_real_escape_string($con, $_POST['usuario']);
$hora_ini_col_nueva = mysqli_real_escape_string($con, $_POST['hora_ini_col']);
$hora_fin_col_nueva = mysqli_real_escape_string($con, $_POST['hora_fin_col']);

$hicn = explode(":", $hora_ini_col_nueva);
$seg_ini_nuevo = ($hicn[0] * 3600) + $hicn[1] * 60;

$hfcn = explode(":", $hora_fin_col_nueva);
$seg_fin_nuevo = ($hfcn[0] * 3600) + $hfcn[1] * 60;

$sql_query = "SELECT hora_inicio,IF(TIME_TO_SEC(hora_inicio)=0,1,TIME_TO_SEC(hora_inicio)) as hora_inicio_s,IF(TIME_TO_SEC(hora_ini_col)=0,1,TIME_TO_SEC(hora_ini_col)) as hora_ini_col_s,hora_ini_col,hora_fin_col FROM salida_equipos WHERE fecha = '" . $fecha . "' and id_ubicacion =" . $id_ubicacion . " GROUP by hora_ini_col limit 1";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$hora_ini_col = $row['hora_ini_col'];
$hora_fin_col = $row['hora_fin_col'];
$hora_inicio = $row['hora_inicio'];

$hora_inicio_s = $row['hora_inicio_s'];
$h_ini_final = (float)$hora_inicio_s;

$hora_ini_col_s = $row['hora_ini_col_s'];
$h_inicol_final = (float)$hora_ini_col_s;

if ($hora_ini_col != '00:00:00' && $hora_fin_col != '00:00:00') {
    // colacion ya ingresada
    echo 1;
} else if ($hora_ini_col == '00:00:00' && $hora_fin_col == '00:00:00') {
    if ($seg_ini_nuevo > $h_ini_final) {
        $sql_query2 = "UPDATE salida_equipos SET hora_ini_col = '" . $hora_ini_col_nueva . "' WHERE id_ubicacion = " . $id_ubicacion . " and fecha = '" . $fecha . "' ;";
        $result2 = mysqli_query($con, $sql_query2);
        // inicio colacion ingresada
        echo 2;
    } else {
        echo 4; //hora de inicio no puede ser menor a hora de inicio de jornada
    }
} else if ($hora_ini_col != '00:00:00' && $hora_fin_col == '00:00:00') {
    if ($seg_fin_nuevo > $h_inicol_final) {
        $sql_query2 = "UPDATE salida_equipos SET hora_fin_col = '" . $hora_fin_col_nueva . "' WHERE id_ubicacion = " . $id_ubicacion . " and fecha = '" . $fecha . "' ;";
        $result2 = mysqli_query($con, $sql_query2);
        // fin colacion ingresada
        echo 3;
    } else {
        echo 5; //hora de fin no puede ser menor a hora de inicio de colación
    }
}
