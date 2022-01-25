<?php
include "../conexion.php";

$uname = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);



if ($uname != "" && $password != "") {

    $sql_query = "SELECT id_nivel as cntUser, permiso FROM usuarios WHERE nombre='" . $uname . "' and password='" . $password . "'";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);

    $nivel = $row['cntUser'];
    $permiso = $row['permiso'];

    if ($nivel == 10 && $permiso == 1) {
        $_SESSION['uname'] = $uname;
        echo 1;
    } else if ($nivel == 10 && $permiso == 2) {
        $_SESSION['uname'] = $uname;
        echo 2;
    } else if ($nivel == 10 && $permiso == 3) {
        $_SESSION['uname'] = $uname;
        echo 3;
    } else {
        echo 0;
    }
}
