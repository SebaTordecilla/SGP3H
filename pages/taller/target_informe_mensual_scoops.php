<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$mes = mysqli_real_escape_string($con, $_POST['mes']);
$ano = mysqli_real_escape_string($con, $_POST['ano']);

$sql_query = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo 
where le.id_tequipo = 1 and le.id_est_equipo = 1 AND month(se.fecha)= " . $mes . " and year(se.fecha)= " . $ano . ") as segundos, (SELECT DAYOFMONTH(LAST_DAY('" . $ano . "-" . $mes . "-01'))) as dias,count(le.id_tequipo) as total 
FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 1 and le.id_est_equipo = 1";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);

$segtotalmes = $row['segundos'];
$cantidadtotal = $row['total'];
$dias = $row['dias'];

$segmestotal = 10 * 3600 * $dias * $cantidadtotal;

$porcentajeflota = number_format(($segtotalmes / $segmestotal) * 100, 0, ',', '');


$sql11 = "SELECT count(se.id_sal_equipo) as cantidad,(select porcentaje from programa_mensual where mes = " . $mes . " and ano = " . $ano . ") as programa FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and month(se.fecha) = " . $mes . " and year(se.fecha) = " . $ano . ";";
$result11 = mysqli_query($con, $sql11);
$row11 = mysqli_fetch_array($result11);
$cantidad = $row11['cantidad'];
$programa = $row11['programa'];
$promedioflota = number_format(($cantidad / $dias), 1, ',', '');

$tabla = "
<div class=\"small-box bg-\">
<div class=\"inner\">
<h3>SCOOPS</h3>
<p>% Programa: " . $programa . "%</p>
<p>% Mensual Flota: " . $porcentajeflota . "%</p>
<p> Prom.Operativos: " . $promedioflota . "</p>
</div>
<div class=\"icon\">
<i class=\"ion ion-bag\"></i>
</div>
</div>
";

echo $tabla;
