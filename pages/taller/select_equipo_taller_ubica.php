<?php
include('../../conexion.php');
$fecha = $_POST['fecha'];

$sql = "SELECT se.id_sal_equipo, le.sigla FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo WHERE se.fecha ='" . $fecha . "';";

$result = mysqli_query($con, $sql);

$cadena = "<label for=\"state_id\" class=\"control-label\">Codigo de Equipo </label> 
			<select class='form-control' id='lista2' name='lista2'>";

while ($ver = mysqli_fetch_row($result)) {
	$cadena = $cadena . '<option value=' . $ver[0] . '>' . utf8_encode($ver[1]) . '</option>';
}

echo  $cadena . "</select>";

?>