<?php
include "../../conexion.php";

$id_oc = mysqli_real_escape_string($con, $_POST['id_oc']);
$id_pedido = mysqli_real_escape_string($con, $_POST['id_pedido']);
$descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
$cantidad = mysqli_real_escape_string($con, $_POST['cantidad']);
$neto = mysqli_real_escape_string($con, $_POST['neto']);
$id_artsol = mysqli_real_escape_string($con, $_POST['id_artsol']);


$sql_query = "SELECT count(id_artoc) as contador FROM articulos_oc where id_artsol = " . $id_artsol . "";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$contador = $row['contador'];
if ($contador > 0) {
    echo -1;
} else {
    $sql_query = "INSERT INTO articulos_oc(id_oc, id_pedido, descripcion, cantidad, neto, id_artsol) 
    VALUES ('" . $id_oc . "', '" . $id_pedido . "', '" . $descripcion . "','" . $cantidad . "', '" . $neto . "', '" . $id_artsol . "')";
    $result = mysqli_query($con, $sql_query);
    echo $id_oc;
}
