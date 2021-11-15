<?php
include "../../conexion.php";

$id_sal_equipo = mysqli_real_escape_string($con, $_POST['id_sal_equipo']);
$hora_ini = mysqli_real_escape_string($con, $_POST['hora_ini']);
$hora_mec = mysqli_real_escape_string($con, $_POST['hora_mec']);
$id_falla = mysqli_real_escape_string($con, $_POST['id_falla']);
$duraccion = mysqli_real_escape_string($con, $_POST['duraccion']);
$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);
$observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);


$v_HorasPartes = explode(":", $hora_ini);
$seg_ini = ($v_HorasPartes[0] * 3600) + ($v_HorasPartes[1] * 60);

$v_HorasPartes2 = explode(":", $hora_mec);
$seg_mec = ($v_HorasPartes2[0] * 3600) + ($v_HorasPartes2[1] * 60);

if ($id_sal_equipo > 0) {

    $sql_query3 = "SELECT TIME_TO_SEC(hora_inicio) as seg_ini_sal,TIME_TO_SEC(hora_fin) as seg_fin_sal from salida_equipos where id_sal_equipo = " . $id_sal_equipo . ";";
    $result3 = mysqli_query($con, $sql_query3);
    $row = mysqli_fetch_array($result3);

    $seg_ini_sal = $row['seg_ini_sal'];
    $seg_fin_sal = $row['seg_fin_sal'];

    $seg_ini_sal2 = (float)$seg_ini_sal;
    $seg_fin_sal2 = (float)$seg_fin_sal;

    if ($seg_ini_sal2 < $seg_ini) {
        if ($seg_fin_sal2 > $seg_mec) {
            if ($seg_mec > $seg_ini) {

                $sql_query = "INSERT INTO reparacion_terreno(id_sal_equipo, hora_ini, hora_mec, id_falla, duraccion, id_ubicacion, id_mecanico, observaciones, id_est_equipo) VALUES ('" . $id_sal_equipo . "','" . $hora_ini . "','" . $hora_mec . "','" . $id_falla . "','" . $duraccion . "','" . $id_ubicacion . "','1','" . $observaciones . "','10')";
                $result = mysqli_query($con, $sql_query);

                $sql_query4 = "UPDATE salida_equipos SET hora_total=(SELECT IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini))+TIME_TO_SEC(rt.duraccion))) is NULL,
                SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), 
                SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini))+TIME_TO_SEC(rt.duraccion))),
                SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin))))))) FROM salida_equipos se 
                INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_estado_diario = 5 
                and rt.id_sal_equipo = " . $id_sal_equipo . " ORDER by se.fecha DESC) WHERE id_sal_equipo = " . $id_sal_equipo . ";";
                $result4 = mysqli_query($con, $sql_query4);
                echo 4;
                // Reparación Ingresada
            } else {
                echo 3;
                //hora de solicitud de mecanico no puede ser mayor a hora de llegada de mecanico
            }
        } else {
            echo 2;
            //hora de mecanico no puede ser mayor a la hora de termino de la jornada
        }
    } else {
        echo 1;
        //hora de inicio de mecanico no puede ser mayor a hora de inicio de jornada
    }
} else {
    echo 5;
}
