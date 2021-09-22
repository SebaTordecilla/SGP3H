<?php
include('../../conexion.php');
$fecha = $_POST['fecha'];

$resultado=$mysqli->query("SELECT se.id_ubicacion,um.nombre,se.fecha ,COUNT(id_equipo) as cantidad, IF(se.hora_ini_col ='00:00:00' and se.hora_fin_col ='00:00:00','Sin Registro', IF(se.hora_ini_col != '00:00:00' and se.hora_fin_col ='00:00:00','En Colación',IF(se.hora_ini_col != '00:00:00' and se.hora_fin_col is not null,'Retorno Faena','Error'))) as estado, se.hora_ini_col,se.hora_fin_col FROM salida_equipos se INNER JOIN ubicaciones_minas um on se.id_ubicacion = um.id_ubicacion WHERE fecha = '".$fecha."' GROUP by se.id_ubicacion;");

$total=$resultado->num_rows;

if($total>0){
$tabla="<table id=\"example1\" class=\"table table-sm\">";
$tabla.="<thead><tr><th>Mina</th><th>Estado</th></tr></thead>";
while($row=$resultado->fetch_assoc()){
    $tabla.="<tr>" ;
    $tabla.="<td>".$row['nombre']."  <span class=\"badge bg-success\">".$row['cantidad']."</span></td>";
    $tabla.="<td><a href=\"#\" style=\"color:black\" onclick=\"horario_colacion('".$row['id_ubicacion'].",".$row['fecha']."')\">".$row['estado']."</a></td>";
    $tabla.="</tr>" ; 



}
    $tabla.="</table>" ;
    echo $tabla;
}
else{
     echo "Sin Información";
}
