<?php
include "../../conexion.php";

$id_extmin = mysqli_real_escape_string($con, $_POST['id_extmin']);

$sql_query = "UPDATE extraccion_mineral SET estado = 2 WHERE id_extmin='" . $id_extmin . "';";
$result = mysqli_query($con, $sql_query);

if ($id_extmin > 0) {

    $sql_query = "SELECT * FROM extraccion_mineral WHERE id_extmin='" . $id_extmin . "';";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    $estado = $row['estado'];
    if ($estado == 2) {
        echo 1;
        //Extraccion confirmada
    } else {
        echo 2;
    }
}
