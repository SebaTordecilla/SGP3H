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

    if ($nivel == 2) {
        $_SESSION['uname'] = $uname;
        echo 2;
    } else if ($nivel == 3) {
        $_SESSION['uname'] = $uname;
        echo 3;
    } else if ($nivel == 4) {
        $_SESSION['uname'] = $uname;
        echo 4;
    } else if ($nivel == 5) {
        $_SESSION['uname'] = $uname;
        echo 5;
    } else if ($nivel == 6) {
        $_SESSION['uname'] = $uname;
        echo 6;
    } else if ($nivel == 7) {
        $_SESSION['uname'] = $uname;
        echo 7;
    } else if ($nivel == 8 && $permiso == 1) {
        $_SESSION['uname'] = $uname;
        echo 8;
    } else if ($nivel == 8 && $permiso == 2) {
        $_SESSION['uname'] = $uname;
        echo 9;
    } else if ($nivel == 10 && $permiso == 1) {
        $_SESSION['uname'] = $uname;
        echo 10;
    } else if ($nivel == 10 && $permiso == 2) {
        $_SESSION['uname'] = $uname;
        echo 11;
    } else if ($nivel == 10 && $permiso == 3) {
        $_SESSION['uname'] = $uname;
        echo 12;
    } else {
        echo 0;
    }
}
