<?php
include "../conexion.php";

$uname = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);

if ($uname != "" && $password != ""){

    $sql_query = "SELECT id_nivel as cntUser FROM usuarios WHERE nombre='".$uname."' and password='".$password."'";
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);

    $nivel = $row['cntUser'];

    if($nivel == 2){
        $_SESSION['uname'] = $uname;
        echo 2;
    }
    else if($nivel ==3){
        $_SESSION['uname'] = $uname;
        echo 3;
    }
    else if($nivel ==4){
        $_SESSION['uname'] = $uname;
        echo 4;
    }
    else{
        echo 0;
    }




}