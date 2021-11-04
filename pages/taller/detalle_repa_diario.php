<?php
include('../../conexion.php');
$id = $_POST['id_sal_equipo'];

$resultado = $mysqli->query("SELECT DATE_FORMAT(se.fecha,'%d-%m-%Y') as fecha,le.sigla as codigo,te.nombre as equipo,um.nombre as mina,rt.hora_ini,rt.hora_mec,rt.duraccion,SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) as hor_inactivo, fe.nombre as falla 
FROM reparacion_terreno rt INNER JOIN salida_equipos se on rt.id_sal_equipo = se.id_sal_equipo INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN fallas_mecanicas fe on rt.id_falla = fe.id_falla INNER JOIN ubicaciones_minas um on se.id_ubicacion = um.id_ubicacion 
WHERE rt.id_est_equipo = 10  and rt.id_sal_equipo = " . $id . " 
GROUP by id_rep_ter ORDER by se.fecha DESC;");

$total = $resultado->num_rows;

if ($total > 0) {
    $tabla = "<table id=\"example1\" class=\"table table-bordered table-hover\" cellspacing=\"0\" cellpadding=\"0\">";
    $tabla .= "<thead><tr><th>Fecha</th><th>Codigo</th><th>Hr.Inicio</th><th>Hr.Mec</th><th>Duración</th><th>Hr.Inactivo</th><th>Falla</th></tr></thead>";
    while ($row = $resultado->fetch_assoc()) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . $row['fecha'] . "</td>";
        $tabla .= "<td>" . $row['codigo'] . "</td>";
        $tabla .= "<td>" . $row['hora_ini'] . "</td>";
        $tabla .= "<td>" . $row['hora_mec'] . "</td>";
        $tabla .= "<td>" . $row['duraccion'] . "</td>";
        $tabla .= "<td>" . $row['hor_inactivo'] . "</td>";
        $tabla .= "<td>" . $row['falla'] . "</td>";
        $tabla .= "</tr>";
    }
    $tabla .= "</table>";
    echo $tabla;
} else {
    echo "Sin Información";
}
