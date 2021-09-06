<?php
include('../../conexion.php');
$id = $_POST['num'];

$resultado=$mysqli->query("SELECT le.sigla as codigo, le.nombre,DATE_FORMAT(me.fecha,'%d-%m-%Y') AS fecha, ee.nombre as estado,me.observaciones,me.check_list FROM mant_equipos me RIGHT JOIN lista_equipos le on me.id_equipo = le.id_equipo INNER JOIN estado_equipos ee ON ee.id_est_equipo = me.id_est_equipo WHERE le.id_equipo ='$id' ORDER BY me.fecha DESC");

$total=$resultado->num_rows;

if($total>0){
$tabla="<table id=\"example1\" class=\"table table-bordered table-hover\" cellspacing=\"0\" cellpadding=\"0\">";
$tabla.="<thead><tr><th>Fecha</th><th>Estado</th><th>Observaciones</th><th>Acciones</th></tr></thead>";
while($row=$resultado->fetch_assoc()){
    $tabla.="<tr>" ;
    $tabla.="<td>".$row['fecha']."</td>";
    $tabla.="<td>".$row['estado']."</td>";
    $tabla.="<td>".$row['observaciones']."</td>";
    $tabla.="<td>".$row['check_list']."</td>";
    $tabla.="</tr>" ; 
}
    $tabla.="</table>" ;
    echo $tabla;
}
else{
     echo "Sin Mantenciones";
}

?>

