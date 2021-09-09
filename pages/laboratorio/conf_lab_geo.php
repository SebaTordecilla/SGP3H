<?php
include('../../conexion.php');


$id_geom = mysqli_real_escape_string($con, $_POST['id_geom']);
$usuario = mysqli_real_escape_string($con, $_POST['usuario']);

$sql_query = "SELECT id_nivel,permiso FROM usuarios WHERE nombre ='".$usuario."'";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);

$id_nivel = $row['id_nivel'];
$permiso = $row['permiso'];

$sql_query2 = "SELECT cutlab,cuslab FROM muestras_geologia WHERE id_geom =" . $id_geom . "";
$result2 = mysqli_query($con, $sql_query2);
$row2 = mysqli_fetch_array($result2);
$cutlab0 = $row2['cutlab'];
$cuslab0 = $row2['cuslab'];

if($id_nivel==5){
    if ($cutlab0>0 && $cuslab0>0) {
        $sql_query2 = "UPDATE muestras_geologia SET estado=3,laboratorio=CONCAT('" . $usuario . " - ', NOW()) WHERE id_geom =".$id_geom."";
        $result2 = mysqli_query($con, $sql_query2);
        echo 1;
    } else {
        echo 2;
    }
}
else{
    echo 3;
}
?>