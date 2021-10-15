<?php
include('../../conexion.php');
$id = $_POST['num'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$resultado=$mysqli->query("SELECT DATE_FORMAT(se.fecha,'%d-%m-%Y') AS fecha ,se.hora_inicio as In_Jor,se.hora_fin as Fin_Jor,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)) as hrs_total,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)) hrs_col,IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,' ',SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion)))) as hor_mec,IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin))))))) as final 
FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_estado_diario = 5 and le.id_equipo = ".$id." and se.fecha BETWEEN '".$desde."' and '".$hasta."' GROUP BY rt.id_sal_equipo;");

$total=$resultado->num_rows;

if($total>0){
$tabla="<table id=\"example1\" class=\"table table-bordered table-hover\" cellspacing=\"0\" cellpadding=\"0\">";
$tabla.="<thead><tr><th>Fecha</th><th>Hr.Inicio</th><th>Hr.Fin</th><th>Hr.total</th><th>Hr.Col</th><th>Hr.Mec</th><th>Hr.Final</th></tr></thead>";
while($row=$resultado->fetch_assoc()){
    $tabla.="<tr>" ;
    $tabla.="<td>".$row['fecha']."</td>";
    $tabla.="<td>".$row['In_Jor']."</td>";
    $tabla.="<td>".$row['Fin_Jor']."</td>";
    $tabla.="<td>".$row['hrs_total']."</td>";
    $tabla.="<td>".$row['hrs_col']."</td>";
    $tabla.="<td>".$row['hor_mec']."</td>";
    $tabla.="<td>".$row['final']."</td>";
    $tabla.="</tr>" ; 
}
    $tabla.="</table>" ;
    echo $tabla;
}
else{
     echo "Sin Información";
}
