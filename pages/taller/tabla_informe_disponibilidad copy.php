<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$desde = mysqli_real_escape_string($con, $_POST['desde']);
$hasta = mysqli_real_escape_string($con, $_POST['hasta']);

if ($desde == "") {
    echo "Sin Información ";
} else {
    $tabla = "<table id=\"example1\" class=\"table table-bordered table-striped\">";
    $tabla .= "<thead><tr><th>TiCod.po</th><th>Modelo</th><th>Tipo</th><th>Dias</th><th>Hrs.</th><th>D.trab</th><th>Rep</th><th>Hrs.Totales </th><th> % </th><th>  </th></tr></thead>";
    $maxsql = "SELECT DISTINCT(id_equipo) FROM salida_equipos where fecha BETWEEN '" . $desde . "' and '" . $hasta . "';";
    foreach ($db->query($maxsql) as $row) {
        $valores = $row['id_equipo'];

        $sql = "SELECT DISTINCT le.id_equipo as num ,le.sigla as ID, UPPER(le.nombre) as modelo,te.nombre as tipo ,TIMESTAMPDIFF(DAY, '" . $desde . "', '" . $hasta . "')+1 AS dias_trab, (SELECT COUNT(rt.id_rep_ter) as repa FROM reparacion_terreno rt INNER JOIN salida_equipos se on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_equipo =" . $valores . " and se.fecha BETWEEN '" . $desde . "' AND '" . $hasta . "' ) as repa, (SELECT COUNT(id_sal_equipo) as repa FROM salida_equipos WHERE id_equipo = " . $valores . " AND fecha BETWEEN '" . $desde . "' AND '" . $hasta . "') as salidas, (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(hora_total))) FROM salida_equipos where id_equipo = " . $valores . " AND fecha BETWEEN '" . $desde . "' AND '" . $hasta . "') as horas, (SELECT (SUM(TIME_TO_SEC(hora_total))) FROM salida_equipos where id_equipo = " . $valores . " AND fecha BETWEEN '" . $desde . "' AND '" . $hasta . "') as segundos, '" . $desde . "' as desde, '" . $hasta . "' as hasta FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_equipo = " . $valores . ";";
        foreach ($db->query($sql) as $row) {
            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['ID'] . "</td>";
            $tabla .= "<td>" . $row['modelo'] . "</td>";
            $tabla .= "<td>" . $row['tipo'] . "</td>";
            $tabla .= "<td>" . $row['dias_trab'] . "</td>";
            $tabla .= "<td>" . $row['dias_trab'] * 10 . ":00:00</td>";
            $tabla .= "<td>" . $row['salidas'] . "</td>";
            $tabla .= "<td>" . $row['repa'] . "</td>";
            $tabla .= "<td>" . $row['horas'] . "</td>";

            $total = $row['segundos'];
            $esperado = $row['dias_trab'] * 3600 * 10;
            $calculo = ($total / $esperado) * 100;
            $porcentaje = number_format($calculo, 2, '.', '');

            $tabla .= "<td>" . $porcentaje . "%</td>";
            $tabla .= "<td align=\"center\"><a href=\"#\" style=\"color:black\" onclick=\"  detalles_informe('" . $row['num'] . "','" . $row['desde'] . "','" . $row['hasta'] . "','" . $row['ID'] . "','" . $row['modelo'] . "','" . $row['tipo'] . "');modal_informe()\"><small class=\"badge badge-danger\"> Detalles</small></a></td>";


            $tabla .= "</tr>";
        }
    }

    $tabla .= "</table>";
    echo $tabla;
}


?>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "pdf", "colvis"]
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