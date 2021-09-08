<?php
include('../../conexion.php');

$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$id_ubicacion = mysqli_real_escape_string($con, $_POST['id_ubicacion']);
$id_manto = mysqli_real_escape_string($con, $_POST['id_manto']);
$id_calle = mysqli_real_escape_string($con, $_POST['id_calle']);
$id_labor = mysqli_real_escape_string($con, $_POST['id_labor']);
$CutVisual = mysqli_real_escape_string($con, $_POST['CutVisual']);
$CusVisual = mysqli_real_escape_string($con, $_POST['CusVisual']);
$frente = mysqli_real_escape_string($con, $_POST['frente']);
$observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);
$tipo = mysqli_real_escape_string($con, $_POST['tipo']);
$usuario = mysqli_real_escape_string($con, $_POST['usuario']);

if($id_calle>0){

    if ($id_labor > 0) {
        $sql_query2 = "INSERT INTO muestras_geologia(id_ubicacion, id_manto, id_calle, id_labor, fecha, cutvisual, cusvisual, frente, observaciones, tipo, estado, registro) VALUES (" . $id_ubicacion . ", " . $id_manto . ", " . $id_calle . ", " . $id_labor . ", '" . $fecha . "', '" . $CutVisual . "', '" . $CusVisual . "', '" . $frente . "', '" . $observaciones . "', '" . $tipo . "', 1, CONCAT('" . $usuario . " - ', NOW()))";
        $result2 = mysqli_query($con, $sql_query2);
        echo 1;
    } else {
        $sql_query2 = "INSERT INTO muestras_geologia(id_ubicacion, id_manto, id_calle, fecha, cutvisual, cusvisual, frente, observaciones, tipo, estado, registro) VALUES (" . $id_ubicacion . ", " . $id_manto . ", " . $id_calle . ",'" . $fecha . "', '" . $CutVisual . "', '" . $CusVisual . "', '" . $frente . "', '" . $observaciones . "', '" . $tipo . "', 1, CONCAT('" . $usuario . " - ', NOW()))";
        $result2 = mysqli_query($con, $sql_query2);
        echo 1;
    }

}

 else {
    $sql_query2 = "INSERT INTO muestras_geologia(id_ubicacion, id_manto, fecha, cutvisual, cusvisual, frente, observaciones, tipo, estado, registro) VALUES (" . $id_ubicacion . ", " . $id_manto . ", '" . $fecha . "', '" . $CutVisual . "', '" . $CusVisual . "', '" . $frente . "', '" . $observaciones . "', '" . $tipo . "', 1, CONCAT('" . $usuario . " - ', NOW()))";
    $result2 = mysqli_query($con, $sql_query2);
    echo 1;
}
