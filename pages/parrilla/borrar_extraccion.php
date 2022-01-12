<?php
include('../../conexion.php');

$id_extmin = mysqli_real_escape_string($con, $_POST['id_extmin']);

if ($id_extmin > 0) {
    $sql_query = "DELETE FROM extraccion_mineral WHERE  id_extmin=" . $id_extmin . ";";
    $result = mysqli_query($con, $sql_query);
    echo 1;
} else {
}
