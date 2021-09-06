<?php
include('../../conexion.php');

$check_list = mysqli_real_escape_string($con, $_POST['selected2']);
$id_est_equipo = mysqli_real_escape_string($con, $_POST['id_est_equipo']);
$id_camioneta = mysqli_real_escape_string($con, $_POST['id_camioneta']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);
$kilometraje = mysqli_real_escape_string($con, $_POST['kilometraje']);


$sql_query = "SELECT MAX(kilometraje) AS kilometraje FROM mant_camionetas WHERE id_camioneta =" . $id_camioneta . ";";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$km = $row['kilometraje'];
if ($kilometraje > $km) {
    $sql_query2 = "INSERT INTO mant_camionetas(id_camioneta, fecha, kilometraje, check_list, id_est_equipo, observaciones) VALUES (".$id_camioneta.",'".$fecha."',".$kilometraje.",'".$check_list."',".$id_est_equipo.",'".$observaciones."');";
    $result2 = mysqli_query($con, $sql_query2);
    echo 1;
} else {
    echo 3;
}


?>