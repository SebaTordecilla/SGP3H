<?php
include "../../conexion.php";

$id_oc = mysqli_real_escape_string($con, $_POST['id_oc']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$numero = mysqli_real_escape_string($con, $_POST['numero']);
$tipo = mysqli_real_escape_string($con, $_POST['tipo']);




$sql_query = "INSERT INTO documentos_oc (id_oc, fecha, numero, tipo) 
    VALUES ('" . $id_oc . "', '" . $fecha . "', '" . $numero . "', '" . $tipo . "');";
$result = mysqli_query($con, $sql_query);

echo $id_oc;
