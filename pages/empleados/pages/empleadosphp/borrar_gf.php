<?php
include "../../conexion.php";


$id_grupo = mysqli_real_escape_string($con, $_POST['id_grupo']);


$sql_query = "DELETE FROM grupo_familiar WHERE  id_grupo =" . $id_grupo . "";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
