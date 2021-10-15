<?php
include "../../conexion.php";

$id_sal_equipo = mysqli_real_escape_string($con, $_POST['num_equipo']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha_dia']);
$hora_fin = mysqli_real_escape_string($con, $_POST['hora_fin']);

$v_HorasPartes = explode(":", $hora_fin);
$seg_totales = ($v_HorasPartes[0] * 3600) + ($v_HorasPartes[1] * 60);


if ($seg_totales != 1) {
    //$sql_query = "SELECT IF(TIME_TO_SEC(hora_inicio)=0,1,TIME_TO_SEC(hora_inicio)) as hora_inicio ,IF(TIME_TO_SEC(hora_ini_col)=0,1,TIME_TO_SEC(hora_ini_col)) as hora_ini_col, IF(TIME_TO_SEC(hora_fin_col)=0,1,TIME_TO_SEC(hora_fin_col)) as hora_fin_col, IF(TIME_TO_SEC(hora_ini_mec)=0,1,TIME_TO_SEC(hora_ini_mec)) as hora_ini_mec, IF(TIME_TO_SEC(hora_mec)=0,1,TIME_TO_SEC(hora_mec)) as hora_mec, IF(TIME_TO_SEC(hora_fin_mec)=0,1,TIME_TO_SEC(hora_fin_mec)) as hora_fin_mec FROM salida_equipos WHERE id_sal_equipo =" . $id_sal_equipo . ";";
    $sql_query = "SELECT IF(TIME_TO_SEC(hora_inicio)=0,1,TIME_TO_SEC(hora_inicio)) as hora_inicio ,IF(TIME_TO_SEC(hora_ini_col)=0,1,TIME_TO_SEC(hora_ini_col)) as hora_ini_col, IF(TIME_TO_SEC(hora_fin_col)=0,1,TIME_TO_SEC(hora_fin_col)) as hora_fin_col FROM salida_equipos WHERE id_sal_equipo  =" . $id_sal_equipo . ";";

    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);

    $h_ini = $row['hora_inicio'];
    $h_ini_col = $row['hora_ini_col'];
    $h_fin_col = $row['hora_fin_col'];

    $h_ini2 = (float)$h_ini;
    $h_ini_col2 = (float)$h_ini_col;
    $h_fin_col2 = (float)$h_fin_col;


    if ($h_ini2 != 1) {
        //echo 1;
        if ($h_ini_col2 != 1 && $h_fin_col2 == 1) {
            //debe cerrar colación
            echo 1;
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
            } else if ($seg_totales > $h_fin_col2) {
                $sql_query = "UPDATE salida_equipos SET hora_fin ='" . $hora_fin . " ',id_estado_diario = 5 WHERE id_sal_equipo = " . $id_sal_equipo . ";";
                /*$sql_query = "UPDATE salida_equipos SET hora_fin ='" . $hora_fin . " ', id_estado_diario = 5, hora_total=(SELECT IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin))))))) 
                FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_estado_diario = 5 and rt.id_sal_equipo = " . $id_sal_equipo . " ORDER by se.fecha DESC) WHERE id_sal_equipo = " . $id_sal_equipo . ";";
*/

                $result = mysqli_query($con, $sql_query);

                $sql_query2 = "UPDATE salida_equipos SET hora_total=(SELECT IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin))))))) FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_estado_diario = 5 and rt.id_sal_equipo = " . $id_sal_equipo . " ORDER by se.fecha DESC) WHERE id_sal_equipo = " . $id_sal_equipo . ";";
                $result2 = mysqli_query($con, $sql_query2);

                echo 10;
            } else {
                echo 4;
            }
        }
    }
} else if ($seg_totales > 1) {
    //echo 3;
} else {
    //echo 4;
}
