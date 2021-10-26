<?php 
include('../../conexion.php');
$tipo=$_POST['tipo'];

	$sql="SELECT id_equipo,sigla from lista_equipos where id_tequipo ='$tipo'";

	$result=mysqli_query($con,$sql);

	$cadena="<label for=\"state_id\" class=\"control-label\">Codigo de Equipo </label> 
			<select class='form-control' id='id_equipo_informe' name='id_equipo_informe'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
	}

	echo  $cadena."</select>";
	

?>