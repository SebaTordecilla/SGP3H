<?php 
//$conexion=mysqli_connect('localhost','root','','db_minera3H');
include('../../conexion.php');
$fecha=$_POST['fecha'];

	$sql="SELECT um.id_ubicacion,um.nombre FROM salida_equipos se INNER JOIN ubicaciones_minas um on se.id_ubicacion=um.id_ubicacion 
	WHERE se.fecha = '".$fecha."' group by um.id_ubicacion;";

	$result=mysqli_query($con,$sql);

	$cadena="<label for=\"state_id\" class=\"control-label\">Ubicación</label> 
			<select class='form-control' id='lista_minas' name='lista_minas'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
	}

	echo  $cadena."</select>";
	

?>