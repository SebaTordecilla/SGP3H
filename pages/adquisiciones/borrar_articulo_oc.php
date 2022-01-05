<?php
include "../../conexion.php";

$id_artoc = mysqli_real_escape_string($con, $_POST['id_artoc']);
$id_oc = mysqli_real_escape_string($con, $_POST['id_oc']);

$sql_query = "DELETE FROM articulos_oc WHERE id_artoc =" . $id_artoc . "";
$result = mysqli_query($con, $sql_query);

echo $id_oc;
