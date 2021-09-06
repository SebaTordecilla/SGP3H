<?php
include('../../conexion.php');
$id_disparo = $_POST['id_disparo'];

if ($id_disparo >0) {
    $sql_query2 = "UPDATE disparos SET estado = 2 WHERE id_disparo =".$id_disparo."";
    $result2 = mysqli_query($con, $sql_query2);
    echo 1;
} else {
    echo 2;
}
?>
