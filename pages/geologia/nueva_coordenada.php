<?php
include('../../conexion.php');

$tipo = mysqli_real_escape_string($con, $_POST['tipo']);
$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);
$coordenada = mysqli_real_escape_string($con, $_POST['coordenada']);
$usuario = mysqli_real_escape_string($con, $_POST['usuario']);

$sql_query = "SELECT id_nivel,permiso FROM usuarios WHERE nombre ='" . $usuario . "'";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);

$id_nivel = $row['id_nivel'];
$permiso = $row['permiso'];

if ($id_nivel == 4 && $permiso == 2) {
    if ($tipo == 1) {
        $sql_query2 = "SELECT COUNT(coordenada) as count FROM mantos WHERE coordenada ='" . $coordenada . "';";
        $result2 = mysqli_query($con, $sql_query2);
        $row = mysqli_fetch_array($result2);
        $count1 = $row['count'];

        if ($id_ubicacion == "") {
            echo 1;
        } else {
            if ($count1 > 0) {
                echo 3;
            } else {
                $sql_query2 = "INSERT INTO mantos(coordenada, id_ubicacion) VALUES ('" . $coordenada . "', " . $id_ubicacion . ")";
                $result2 = mysqli_query($con, $sql_query2);
                echo 2;
            }
        }
    } else if ($tipo == 2) {
        $sql_query3 = "SELECT COUNT(coordenada) as contador FROM calles WHERE coordenada = '" . $coordenada . "';";
        $result3 = mysqli_query($con, $sql_query3);
        $row = mysqli_fetch_array($result3);
        $contador = $row['contador'];
        if ($contador > 0) {
            echo 3;
        } else {
            $sql_query2 = "INSERT INTO calles(coordenada) VALUES ('" . $coordenada . "')";
            $result2 = mysqli_query($con, $sql_query2);
            echo 2;
        }
    } else if ($tipo == 3) {
        $sql_query2 = "SELECT COUNT(coordenada) as count FROM levantes WHERE coordenada ='" . $coordenada . "';";
        $result2 = mysqli_query($con, $sql_query2);
        $row = mysqli_fetch_array($result2);
        $count3 = $row['count'];
        if ($count3 > 0) {
            echo 3;
        } else {
            $sql_query2 = "INSERT INTO levantes(coordenada) VALUES ('" . $coordenada . "')";
            $result2 = mysqli_query($con, $sql_query2);
            echo 2;
        }
    }
} else {
    echo 4;
}
