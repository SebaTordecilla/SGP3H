<?php
include "../../conexion.php";

$rut = mysqli_real_escape_string($con, $_POST['rut']);
$nombre = mysqli_real_escape_string($con, $_POST['nombre']);
$direccion = mysqli_real_escape_string($con, $_POST['direccion']);
$id_proveedor = mysqli_real_escape_string($con, $_POST['id_proveedor']);


if ($id_proveedor == '') {
    $sql_query = "SELECT count(id_proveedor) as contador FROM proveedores where rut = '" . $rut . "'";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    $contador = $row['contador'];
    if ($contador > 0) {
        echo 3;
    } else {
        $sql_query = "INSERT INTO proveedores(rut, nombre, direccion) VALUES ('" . $rut . "', '" . $nombre . "', '" . $direccion . "')";
        $result = mysqli_query($con, $sql_query);
        echo 1;
    }
} else {
    $sql_query = "UPDATE proveedores SET rut ='" . $rut . "', nombre='" . $nombre . "', direccion ='" . $direccion . "' where id_proveedor = '" . $id_proveedor . "'";
    $result = mysqli_query($con, $sql_query);
    echo 2;
}
