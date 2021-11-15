<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$id_equipo = mysqli_real_escape_string($con, $_POST['id_equipo']);
$mes_informe = mysqli_real_escape_string($con, $_POST['mes_equipo']);
$ano_informe = mysqli_real_escape_string($con, $_POST['ano_equipo']);

if ($ano_informe == "") {
    echo "Sin Información ";
} else {
    $tabla = "<div class=\"col-12\"><div class=\"card card\"><div class=\"card-header\"><h3 class=\"card-title\">Tabla Mensual</h3></div><div class=\"card-body\">";
    $tabla .= "<table id=\"example1\" class=\"table table-head-fixed text-nowrap\">";
    $tabla .= "<thead><tr><th>Fecha</th><th>Ini.Jor</th><th>Fin.Jor</th><th>Hrs.Total</th><th>Hrs.Col</th><th>Hrs.Mec</th><th>Final</th></tr></thead>";
    $maxsql = "SELECT id_sal_equipo FROM salida_equipos WHERE id_equipo = " . $id_equipo . " and MONTH(fecha) = " . $mes_informe . " AND YEAR(fecha) = " . $ano_informe . " and id_estado_diario= 5;";
    foreach ($db->query($maxsql) as $row) {
        $valores = $row['id_sal_equipo'];

        $sql = "SELECT DATE_FORMAT(se.fecha,'%d-%m-%Y') AS fecha ,le.sigla,te.nombre,se.hora_inicio as In_Jor,se.hora_fin as Fin_Jor,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)) as hrs_total,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)) hrs_col,
        IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini))+TIME_TO_SEC(rt.duraccion))) is NULL,' ',SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini))+TIME_TO_SEC(rt.duraccion)))) as hor_mec,IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini))+TIME_TO_SEC(rt.duraccion))) is NULL,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini))+TIME_TO_SEC(rt.duraccion))),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin))))))) as final 
        FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo 
        INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo 
        WHERE se.id_estado_diario = 5 and se.id_sal_equipo = " . $valores . " ORDER by se.fecha DESC;";
        foreach ($db->query($sql) as $row) {
            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['fecha'] . "</td>";
            $tabla .= "<td>" . $row['In_Jor'] . "</td>";
            $tabla .= "<td>" . $row['Fin_Jor'] . "</td>";
            $tabla .= "<td>" . $row['hrs_total'] . "</td>";
            $tabla .= "<td>" . $row['hrs_col'] . "</td>";
            $tabla .= "<td>" . $row['hor_mec'] . "</td>";
            $tabla .= "<td>" . $row['final'] . "</td>";
            $tabla .= "</tr>";
        }
    }
    $tabla .= "</table>";
    $tabla .= "</div></div>";
    echo $tabla;
}


?>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>