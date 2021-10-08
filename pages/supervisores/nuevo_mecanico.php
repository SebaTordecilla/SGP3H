<?php
include('../../conexion.php');

$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);
$hora_ini = mysqli_real_escape_string($con, $_POST['hora_ini']);
$id_salida = mysqli_real_escape_string($con, $_POST['id_salida']);


$sql_query = "SELECT COUNT(rt.id_sal_equipo) as contador, se.id_estado_diario as estado FROM reparacion_terreno rt INNER JOIN salida_equipos se on rt.id_sal_equipo = se.id_sal_equipo WHERE rt.id_sal_equipo = " . $id_salida . " and rt.id_est_equipo <> 10;";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$cont = $row['contador'];
$estado = $row['estado'];

if ($estado == 5) {
    echo 4; // equipo ya cerro 

} else {
    if ($cont > 0) {
        // mecanico ya fue solicitado
        echo 1;
    } else if ($cont == 0) {
        $sql_query2 = "INSERT INTO reparacion_terreno(id_sal_equipo, hora_ini, id_ubicacion, id_est_equipo) VALUES (" . $id_salida . ",'" . $hora_ini . "'," . $id_ubicacion . ",8)";
        $result2 = mysqli_query($con, $sql_query2);

        echo 2;
    } else {
        echo 3;
    }
}
