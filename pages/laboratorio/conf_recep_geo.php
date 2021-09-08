<?php
include('../../conexion.php');
$id = $_POST['id'];
$usuario = $_POST['usuario'];

$sql_query = "SELECT id_nivel,permiso FROM usuarios WHERE nombre ='".$usuario."'";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);

$id_nivel = $row['id_nivel'];
$permiso = $row['permiso'];

if($id_nivel==5){
    if ($id>0) {
        $sql_query2 = "UPDATE muestras_geologia SET estado=2,recepcion=CONCAT('" . $usuario . " - ', NOW()) WHERE id_geom =".$id."";
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