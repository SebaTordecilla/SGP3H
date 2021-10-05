<?php
include "../../conexion.php";

$sigla = mysqli_real_escape_string($con, $_POST['sigla']);
$nombre = mysqli_real_escape_string($con, $_POST['nombre']);
$id_tequipo = mysqli_real_escape_string($con, $_POST['id_tequipo']);
$marca = mysqli_real_escape_string($con, $_POST['marca']);
$num_serie = mysqli_real_escape_string($con, $_POST['num_serie']);
$anio = mysqli_real_escape_string($con, $_POST['anio']);
$fecha_ingreso = mysqli_real_escape_string($con, $_POST['fecha_ingreso']);
$frecuencia = mysqli_real_escape_string($con, $_POST['frecuencia']);
$observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);

$sql_query = "SELECT id_equipo FROM lista_equipos WHERE sigla ='" . $sigla . "'";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$id_equipo = $row['id_equipo'];
if ($id_equipo > 0) {
    echo 1; //nombre de equipo ya utilizado
} else {
    $sql_query2 = "INSERT INTO lista_equipos(sigla, nombre, id_tequipo, marca, num_serie, anio, fecha_ingreso, frecuencia, observaciones,id_est_equipo) VALUES ('" . $sigla . "', '" . $nombre . "', '" . $id_tequipo . "', '" . $marca . "', '" . $num_serie . "', '" . $anio . "', '" . $fecha_ingreso . "', '" . $frecuencia . "', '" . $observaciones . "',1)";
    $result2 = mysqli_query($con, $sql_query2);

    $sql_query3 = "INSERT INTO mant_equipos( id_equipo, fecha, id_est_equipo, observaciones) 
    SELECT MAX(id_equipo),CURDATE(),1,'EQUIPO INGRESADO RECIENTEMENTE' from lista_equipos";
    $result3 = mysqli_query($con, $sql_query3);

    echo 2;//EQUIPO INGRESADO 
}
