<?php
include('../../conexion.php');

$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$turno = mysqli_real_escape_string($con, $_POST['turno']);
$jornada = mysqli_real_escape_string($con, $_POST['jornada']);
$id_perforo = mysqli_real_escape_string($con, $_POST['id_perforo']);
$id_material = mysqli_real_escape_string($con, $_POST['id_material']);
$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);
$id_manto = mysqli_real_escape_string($con, $_POST['id_manto']);
$id_calle = mysqli_real_escape_string($con, $_POST['id_calle']);
$id_labor = mysqli_real_escape_string($con, $_POST['id_labor']);
$tiros = mysqli_real_escape_string($con, $_POST['tiros']);
$longtiro = mysqli_real_escape_string($con, $_POST['longtiro']);
$observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);
$usuario = mysqli_real_escape_string($con, $_POST['usuario']);

if ($id_labor >1) {
    $sql_query2 = "INSERT INTO disparos(fecha, turno, jornada, id_perforo, id_material, id_ubicacion, id_manto, id_calle, id_labor, tiros, longtiro, observaciones, estado, registro) VALUES ('".$fecha."', '".$turno."', '".$jornada."', ".$id_perforo.", ".$id_material.", ".$id_ubicacion.", ".$id_manto.", ".$id_calle.", ".$id_labor.", ".$tiros.", '".$longtiro."', '".$observaciones."', 1, CONCAT('".$usuario." - ', NOW()))";
    $result2 = mysqli_query($con, $sql_query2);
    echo 1;
} else {
    $sql_query2 = "INSERT INTO disparos(fecha, turno, jornada, id_perforo, id_material, id_ubicacion, id_manto, id_calle, tiros, longtiro, observaciones, estado, registro) VALUES ('".$fecha."', '".$turno."', '".$jornada."', ".$id_perforo.", ".$id_material.", ".$id_ubicacion.", ".$id_manto.", ".$id_calle.", ".$tiros.", '".$longtiro."', '".$observaciones."', 1, CONCAT('".$usuario." - ', NOW()))";
    $result2 = mysqli_query($con, $sql_query2);
    echo 1;
}


?>