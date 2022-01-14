<?php
include('../../conexion.php');

$id_sulf = mysqli_real_escape_string($con, $_POST['id_sulf']);

if ($id_sulf > 0) {
    $sql_query = "UPDATE viajes_sulfuro SET estado = 2 WHERE id_sulf=" . $id_sulf . ";";
    $result = mysqli_query($con, $sql_query);
    echo 1;
} else {
}
