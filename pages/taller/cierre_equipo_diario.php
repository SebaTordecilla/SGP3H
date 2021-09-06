<?php
include "../../conexion.php";

$id_sal_equipo = mysqli_real_escape_string($con, $_POST['num_equipo']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha_dia']);
$hora_fin = mysqli_real_escape_string($con, $_POST['hora_fin']);

$v_HorasPartes = explode(":", $hora_fin);
$seg_totales = ($v_HorasPartes[0] * 3600) + ($v_HorasPartes[1] * 60);


if ($seg_totales !=1) {
    $sql_query = "SELECT IF(TIME_TO_SEC(hora_inicio)=0,1,TIME_TO_SEC(hora_inicio)) as hora_inicio ,IF(TIME_TO_SEC(hora_ini_col)=0,1,TIME_TO_SEC(hora_ini_col)) as hora_ini_col, IF(TIME_TO_SEC(hora_fin_col)=0,1,TIME_TO_SEC(hora_fin_col)) as hora_fin_col, IF(TIME_TO_SEC(hora_ini_mec)=0,1,TIME_TO_SEC(hora_ini_mec)) as hora_ini_mec, IF(TIME_TO_SEC(hora_mec)=0,1,TIME_TO_SEC(hora_mec)) as hora_mec, IF(TIME_TO_SEC(hora_fin_mec)=0,1,TIME_TO_SEC(hora_fin_mec)) as hora_fin_mec FROM salida_equipos WHERE id_sal_equipo =" . $id_sal_equipo . ";";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);

    $h_ini = $row['hora_inicio'];
    $h_ini_col = $row['hora_ini_col'];
    $h_fin_col = $row['hora_fin_col'];
    $h_ini_mec = $row['hora_ini_mec'];
    $h_mec = $row['hora_mec'];
    $h_fin_mec = $row['hora_fin_mec'];

    $h_ini2 = (float)$h_ini;
    $h_ini_col2 = (float)$h_ini_col;
    $h_fin_col2 = (float)$h_fin_col;
    $h_ini_mec2 = (float)$h_ini_mec;
    $h_mec2 = (float)$h_mec;
    $h_fin_mec2 = (float)$h_fin_mec;

    if($h_ini2!=1){
        //echo 1;
        if ($h_ini_col2 != 1 && $h_fin_col2 == 1) {
            //debe cerrar colación
            echo 1;
        } else if ($h_ini_mec2 != 1 && $h_mec2 == 1) {
            //debe enviar mecánico y cerrar proceso
            echo 2;
        } else if ($h_mec2 != 1 && $h_fin_mec2 == 1) {
            //debe cerrar visita de mecanico
            echo 3;
        } else {
            if ($seg_totales < $h_ini2) {
                //hora de cierre no puede ser menor a inicio
                echo 4;
            } else if ($seg_totales < $h_ini_col2) {
                //hora de cierre no puede ser menor a inicio de colación
                echo 5;
            } else if ($seg_totales < $h_fin_col2) {
                //hora de cierre no puede ser menor a fin de colación
                echo 6;
            } else if ($seg_totales < $h_ini_mec2) {
                //hora de cierre no puede ser menor a hora de Solicitud de Mecánico
                echo 7;
            } else if ($seg_totales < $h_mec2) {
                //hora de cierre no puede ser menor a hora de llegada de Mecánico
                echo 8;
            } else if ($seg_totales < $h_fin_mec2) {
                //hora de cierre no puede ser menor a hora de Fin de Mecánico
                echo 9;
            } else if ($seg_totales > $h_fin_mec2) {
                $sql_query = "UPDATE salida_equipos SET hora_fin ='".$hora_fin." ',id_estado_diario = 5 WHERE id_sal_equipo = " . $id_sal_equipo . ";";
                $result = mysqli_query($con, $sql_query);
                echo 10;
            } else{
                echo 4;
            }
        } 
    }
} else if($seg_totales >1){
    //echo 3;
}else{
    //echo 4;
}
?>