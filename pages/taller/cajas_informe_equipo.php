<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$id_equipo = mysqli_real_escape_string($con, $_POST['id_equipo']);
$mes_informe = mysqli_real_escape_string($con, $_POST['mes_equipo']);
$ano_informe = mysqli_real_escape_string($con, $_POST['ano_equipo']);

$sql_query3 = "SELECT ee.nombre, (SELECT COUNT(rt.id_rep_ter) as repa FROM reparacion_terreno rt INNER JOIN salida_equipos se on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_equipo =" . $id_equipo . " and MONTH(se.fecha) = " . $mes_informe . " AND YEAR(se.fecha)=" . $ano_informe . ") as repa,(SELECT COUNT(id_sal_equipo) FROM salida_equipos WHERE id_equipo = " . $id_equipo . " AND MONTH(fecha)= " . $mes_informe . " AND YEAR(fecha)= " . $ano_informe . ") as salidas FROM lista_equipos le INNER JOIN estado_equipos ee on le.id_est_equipo= ee.id_est_equipo WHERE le.id_equipo = " . $id_equipo . ";";
$result3 = mysqli_query($con, $sql_query3);
$row = mysqli_fetch_array($result3);

$estado = $row['nombre'];
$repa = $row['repa'];
$salidas = $row['salidas'];

$sql_query2 = "SELECT DISTINCT (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(hora_total))) FROM salida_equipos where id_equipo = " . $id_equipo . " AND MONTH(fecha)= " . $mes_informe . " AND YEAR(fecha)= " . $ano_informe . ") as horas, (SELECT (SUM(TIME_TO_SEC(hora_total))) FROM salida_equipos where id_equipo = " . $id_equipo . " AND MONTH(fecha)= " . $mes_informe . " AND YEAR(fecha)= " . $ano_informe . ") as segundos FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_equipo = " . $id_equipo . ";";
$result2 = mysqli_query($con, $sql_query2);
$row2 = mysqli_fetch_array($result2);
$horas = $row2['horas'];
$segundos = $row2['segundos'];

/*if ($ano_informe == "") {
    echo "Sin Información ";
} else {
    $sql = "SELECT id_sal_equipo FROM salida_equipos WHERE id_equipo = " . $id_equipo . " and MONTH(fecha) = " . $mes_informe . " AND YEAR(fecha) = " . $ano_informe . " and id_estado_diario= 5;";
    foreach ($db->query($sql) as $row) {
        $valores = $row['id_sal_equipo'];
        $tabla = "<div class=\"info-box mb-3 bg-warning\">";
        $tabla .= "<div class=\"info-box-content\">";
        $tabla .= "<span class=\"info-box-text\">Estado de Equipo</span>";
        $tabla .= "<span class=\"info-box-number\">Operativo</span>";
        $tabla .= "</div>";
        $tabla .= "</div>";
    }

    echo $tabla;
}

*/
?>
<div class="card card">
    <div class="card-header">
        <h3 class="card-title">KPI</h3>
    </div>
    <div class="card-body">
        <!-- /.info-box -->
        <div class="info-box mb-3 bg-success">
            <div class="info-box-content">
                <span class="info-box-text">Horas Totales</span>
                <span class="info-box-number"><?php echo $horas ?> </span>
            </div>
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 bg-info">
            <div class="info-box-content">
                <span class="info-box-text">Dias Trabajados</span>
                <span class="info-box-number"><?php echo $salidas ?></span>
            </div>
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 bg-danger">
            <div class="info-box-content">
                <span class="info-box-text">Reparaciones</span>
                <span class="info-box-number"><?php echo $repa ?></span>
            </div>
        </div>
    </div>
</div>