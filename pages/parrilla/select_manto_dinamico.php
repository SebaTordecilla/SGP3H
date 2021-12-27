<?php 
include('../../conexion.php');
$tipo=$_POST['tipo'];

	$sql="SELECT id_manto,coordenada from mantos where id_ubicacion ='$tipo'";

	$result=mysqli_query($con,$sql);

	$cadena="<label for=\"state_id\" class=\"control-label\"> Manto </label> 
			<select class='form-control' id='geo_id_manto' name='geo_id_manto'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
	}

	echo  $cadena."</select>";
	

?>