<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$mes = mysqli_real_escape_string($con, $_POST['mes']);
$ano = mysqli_real_escape_string($con, $_POST['ano']);

if ($mes == "") {
    echo "Sin Información ";
} else {
    $tabla = "
    <div class=\"card\">
    <div class=\"card-header\">
      <h5 class=\"card-title\">Tabla SCOOPS</h5>
    </div>
    <div class=\"card-body table-responsive p-0\" style=\"height: 400px;\">
    <table id=\"\" class=\"table table-bordered table-striped\">";
    $tabla .= "<thead><tr><th>Equipo</th><th>%Mes</th>";
    //$sql = "SELECT DAY(CURDATE()) AS dia;";
    $sql = "SELECT YEAR('" . $ano . "-" . $mes . "-01') AS ano,MONTH('" . $ano . "-" . $mes . "-01') as mes ,DAY('" . $ano . "-" . $mes . "-01') AS dia, DAYOFMONTH(LAST_DAY('" . $ano . "-" . $mes . "-01')) AS dias ";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $dia = $row['dias'];
    for ($i = 1; $i <= $dia; $i++) {
        $tabla .= "<th>" . $i . "</th>";
    }
    $tabla .= "</tr></thead>";
    //$tabla .= "</table>";

    //cuerpo de tabla
    $sql = "SELECT id_equipo,sigla FROM lista_equipos WHERE id_tequipo = 1 and id_est_equipo=1;";
    foreach ($db->query($sql) as $row) {
        $id0 = $row['id_equipo'];
        //$sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
        $sql0 = "SELECT YEAR('" . $ano . "-" . $mes . "-01') AS ano,MONTH('" . $ano . "-" . $mes . "-01') as mes ,DAY('" . $ano . "-" . $mes . "-01') AS dia, DAYOFMONTH(LAST_DAY('" . $ano . "-" . $mes . "-01')) AS dias ";

        $result0 = mysqli_query($con, $sql0);
        $row0 = mysqli_fetch_array($result0);
        $dia0 = $row0['dias'];
        $mes0 = $row0['mes'];
        $ano0 = $row0['ano'];

        $sql1 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(hora_total))) FROM salida_equipos where id_equipo = " . $id0 . " AND fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_equipo = " . $id0 . ";";
        $result1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_array($result1);
        $segundos = $row1['segundos'];
        $totalmes = $dia0 * 36000;
        $porcentajemes = number_format(($segundos / $totalmes) * 100, 0, ',', ' ');

        $tabla .= "<td><b>" . $row['sigla'] . "</b></td>";
        $tabla .= "<td><b>" . $porcentajemes . "%</b></td>";


        $id = $row['id_equipo'];
        //$sql = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
        $sql = "SELECT YEAR('" . $ano . "-" . $mes . "-01') AS ano,MONTH('" . $ano . "-" . $mes . "-01') as mes ,DAY('" . $ano . "-" . $mes . "-01') AS dia, DAYOFMONTH(LAST_DAY('" . $ano . "-" . $mes . "-01')) AS dias ";

        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $dia1 = $row['dias'];
        $mes = $row['mes'];
        $ano = $row['ano'];


        for ($j = 1; $j <= $dia1; $j++) {
            // $sql = "SELECT TIME_TO_SEC(IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))))))) as final
            // FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_estado_diario = 5 and rt.id_sal_equipo = (SELECT id_sal_equipo FROM salida_equipos WHERE id_equipo = " . $id . " and fecha = '" . $ano . "-" . $mes . "-" . $j . "') ORDER by se.fecha DESC;";
            $sql = "SELECT time_to_sec(hora_total) as final FROM salida_equipos where id_equipo = " . $id . " and fecha = '" . $ano . "-" . $mes . "-" . $j . "'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $final = $row['final'];
            $r = ($final / 36000) * 100;
            $re = number_format($r, 0, ',', ' ');

            if ($re > 80) {
                $tabla .= "<td style=\"color: green\">" . $re . "%</td>";
            } else if ($re <= 80 && $re > 0) {
                $tabla .= "<td style=\"color: blue\">" . $re . "%</td>";
            } else if ($re == 0) {
                $tabla .= "<td style=\"color: red\">" . $re . "%</td>";
            }
        }
        $tabla .= "</tr>";
        $tabla .= "</tbody>";
    }

    $tabla .= "<tfoot><tr><th>Operativos</th>";

    //$sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
    $sql00 = "SELECT YEAR('" . $ano . "-" . $mes . "-01') AS ano,MONTH('" . $ano . "-" . $mes . "-01') as mes ,DAY('" . $ano . "-" . $mes . "-01') AS dia, DAYOFMONTH(LAST_DAY('" . $ano . "-" . $mes . "-01')) AS dias ";
    $result00 = mysqli_query($con, $sql00);
    $row00 = mysqli_fetch_array($result00);
    $dia00 = $row00['dias'];
    $mes00 = $row00['mes'];
    $ano00 = $row00['ano'];
    $sql11 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and se.fecha between '" . $ano00 . "-" . $mes00 . "-01' and '" . $ano00 . "-" . $mes00 . "-" . $dia00 . "'";
    $result11 = mysqli_query($con, $sql11);
    $row11 = mysqli_fetch_array($result11);
    $cantidad = $row11['cantidad'];
    $promedioflota = number_format(($cantidad / $dia0), 1, ',', '');

    $tabla .= "<td><b>" . $promedioflota . "</b></td>";

    //$sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
    $sql0 = "SELECT YEAR('" . $ano . "-" . $mes . "-01') AS ano,MONTH('" . $ano . "-" . $mes . "-01') as mes ,DAY('" . $ano . "-" . $mes . "-01') AS dia, DAYOFMONTH(LAST_DAY('" . $ano . "-" . $mes . "-01')) AS dias ";

    $result0 = mysqli_query($con, $sql0);
    $row0 = mysqli_fetch_array($result0);
    $dia0 = $row0['dias'];
    $mes0 = $row0['mes'];
    $ano0 = $row0['ano'];

    for ($i = 1; $i <= $dia0; $i++) {
        $sql1 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and se.fecha = '" . $ano0 . "-" . $mes0 . "-" . $i . "'";
        $result1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_array($result1);
        $cantidad = $row1['cantidad'];
        $tabla .= "<td><b>" . $cantidad . "</b></td>";
    }
    $tabla .= "</tr>";
    $tabla .= "</tfoot>";
    $tabla .= "<tfoot><tr><th>%Promedio</th>";


    $sql0 = "SELECT YEAR('" . $ano . "-" . $mes . "-01') AS ano,MONTH('" . $ano . "-" . $mes . "-01') as mes ,DAY('" . $ano . "-" . $mes . "-01') AS dia, DAYOFMONTH(LAST_DAY('" . $ano . "-" . $mes . "-01')) AS dias ";
    $result0 = mysqli_query($con, $sql0);
    $row0 = mysqli_fetch_array($result0);
    $dia0 = $row0['dias'];
    $mes0 = $row0['mes'];
    $ano0 = $row0['ano'];

    $sql22 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and le.id_est_equipo = 1 AND se.fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 1 and le.id_est_equipo = 1";
    $result22 = mysqli_query($con, $sql22);
    $row22 = mysqli_fetch_array($result22);
    $segtotalmes = $row22['segundos'];
    $cantidadtotal = $row22['total'];

    $segmestotal = 10 * 3600 * $dia0 * $cantidadtotal;

    $porcentajeflota = number_format(($segtotalmes / $segmestotal) * 100, 0, ',', '');
    $tabla .= "<td><b>" . $porcentajeflota . "%</b></td>";

    $sql0 = "SELECT YEAR('" . $ano . "-" . $mes . "-01') AS ano,MONTH('" . $ano . "-" . $mes . "-01') as mes ,DAY('" . $ano . "-" . $mes . "-01') AS dia, DAYOFMONTH(LAST_DAY('" . $ano . "-" . $mes . "-01')) AS dias ";
    $result0 = mysqli_query($con, $sql0);
    $row0 = mysqli_fetch_array($result0);
    $dia0 = $row0['dias'];
    $mes0 = $row0['mes'];
    $ano0 = $row0['ano'];

    for ($i = 1; $i <= $dia0; $i++) {
        $sql33 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and le.id_est_equipo = 1 AND se.fecha = '" . $ano0 . "-" . $mes0 . "-" . $i . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
        INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 1 and le.id_est_equipo = 1 ";
        $result33 = mysqli_query($con, $sql33);
        $row33 = mysqli_fetch_array($result33);
        $cantequipos = $row33['total'];
        $segdiarios = $row33['segundos'];
        $segmestotal2 = 10 * 3600 * $cantequipos;

        $porcentajediarioflota = number_format(($segdiarios / $segmestotal2) * 100, 0, ',', '');

        $tabla .= "<td><b>" . $porcentajediarioflota . "%</b></td>";
    }
    $tabla .= "</tr>";
    $tabla .= "</tfoot>";
    $tabla .= "</table> </div></div>";
    echo $tabla;
}


?>
<script>
    $(function() {
        $("#example3").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "pdf", "colvis"]
        }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
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