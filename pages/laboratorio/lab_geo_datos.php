<?php
include('../../conexion.php');

$id_geom = mysqli_real_escape_string($con, $_POST['id_geom']);
$cutlab = mysqli_real_escape_string($con, $_POST['cutlab']);
$cuslab = mysqli_real_escape_string($con, $_POST['cuslab']);
$usuario = mysqli_real_escape_string($con, $_POST['usuario']);

$sql_query = "SELECT * FROM usuarios WHERE nombre='" . $usuario . "'";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$id_nivel = $row['id_nivel'];
$permiso = $row['permiso'];

$sql_query2 = "SELECT cutlab,cuslab FROM muestras_geologia WHERE id_geom =" . $id_geom . "";
$result2 = mysqli_query($con, $sql_query2);
$row2 = mysqli_fetch_array($result2);
$cutlab0 = $row2['cutlab'];
$cuslab0 = $row2['cuslab'];

if ($cutlab0 > 0 || $cuslab0 > 0) {
    if ($id_nivel == 5 && $permiso == 2) {
        $sql_query3 = "UPDATE muestras_geologia SET cutlab = '" . $cutlab . "', cuslab='" . $cuslab . "' WHERE id_geom =" . $id_geom . ";";
        $result3 = mysqli_query($con, $sql_query3);
        echo 1;
    } else {
        echo 2;
    }
} else {
    $sql_query3 = "UPDATE muestras_geologia SET cutlab = '" . $cutlab . "', cuslab='" . $cuslab . "' WHERE id_geom =" . $id_geom . ";";
    $result3 = mysqli_query($con, $sql_query3);
    echo 1;
}
?>
