<?php
include('../../conexion.php');

$tipo = mysqli_real_escape_string($con, $_POST['tipo']);
$coordenada = mysqli_real_escape_string($con, $_POST['coordenada']);
$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);

if ($tipo == 1) {
    $sql_query = "SELECT count(id_manto) as contador FROM mantos where coordenada='" . $coordenada . "';";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    $contador = $row['contador'];
    if ($contador == 0) {
        $sql_query = "INSERT INTO mantos(coordenada, id_ubicacion) VALUES ('" . $coordenada . "','" . $id_ubicacion . "')";
        $result = mysqli_query($con, $sql_query);
        //coordenada creada
        echo 2;
    } else {
        //coordenada ya existe
        echo 1;
    }
} else if ($tipo == 2) {
    $sql_query = "SELECT count(id_calle) as contador FROM calles where coordenada = '" . $coordenada . "';";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    $contador = $row['contador'];
    if ($contador == 0) {
        $sql_query = "INSERT INTO calles(coordenada) VALUES ('" . $coordenada . "')";
        $result = mysqli_query($con, $sql_query);
        //coordenada creada
        echo 2;
    } else {
        //coordenada ya existe
        echo 1;
    }
} else if ($tipo == 3) {
    $sql_query = "SELECT count(id_levante) as levantes FROM calles where coordenada = '" . $coordenada . "';";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    $contador = $row['contador'];
    if ($contador == 0) {
        $sql_query = "INSERT INTO levantes(coordenada) VALUES ('" . $coordenada . "')";
        $result = mysqli_query($con, $sql_query);
        //coordenada creada
        echo 2;
    } else {
        //coordenada ya existe
        echo 1;
    }
}
