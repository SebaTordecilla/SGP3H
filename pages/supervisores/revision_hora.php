<?php
include('../../conexion.php');
$fecha = $_POST['fecha'];
$id_ubicacion = $_POST['id_ubicacion'];

$sql_query = "SELECT hora_ini_col,hora_fin_col FROM salida_equipos WHERE fecha = '" . $fecha . "' and id_ubicacion =" . $id_ubicacion . " GROUP by hora_ini_col limit 1";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);

$hora_ini_col = $row['hora_ini_col'];
$hora_fin_col = $row['hora_fin_col'];

if ($hora_ini_col != '00:00:00' && $hora_fin_col == '00:00:00') {
    $datos = "<div class=\"col-sm-12\">";
    $datos .= "<div class=\"form-group\">";
    $datos .= "<label for=\"state_id\" class=\"control-label\">Hora Inicio</label>";
    $datos .= "<input type=\"time\" class=\"form-control\" id=\"hora_ini_col\" name=\"hora_ini_col\" value=" . $hora_ini_col . " disabled >";
    $datos .= "</div>";
    $datos .= "</div>";
    $datos .= "<div class=\"col-sm-12\">";
    $datos .= "<div class=\"form-group\">";
    $datos .= "<label for=\"state_id\" class=\"control-label\">Hora Fin</label>";
    $datos .= "<input type=\"time\" class=\"form-control\" id=\"hora_fin_col\" name=\"hora_fin_col\" >";
    $datos .= "</div>";
    $datos .= "</div>";
    echo $datos;
} else if ($hora_ini_col != '00:00:00' && $hora_fin_col != '00:00:00') {
    $datos = "<div class=\"col-sm-12\">";
    $datos .= "<div class=\"form-group\">";
    $datos .= "<label for=\"state_id\" class=\"control-label\">Hora Inicio</label>";
    $datos .= "<input type=\"time\" class=\"form-control\" id=\"hora_ini_col\" name=\"hora_ini_col\" value=" . $hora_ini_col . " disabled >";
    $datos .= "</div>";
    $datos .= "</div>";
    $datos .= "<div class=\"col-sm-12\">";
    $datos .= "<div class=\"form-group\">";
    $datos .= "<label for=\"state_id\" class=\"control-label\">Hora Fin</label>";
    $datos .= "<input type=\"time\" class=\"form-control\" id=\"hora_fin_col\" name=\"hora_fin_col\" value=" . $hora_fin_col . " disabled  >";
    $datos .= "</div>";
    $datos .= "</div>";
    echo $datos;
} else {
    $datos = "<div class=\"col-sm-12\">";
    $datos .= "<div class=\"form-group\">";
    $datos .= "<label for=\"state_id\" class=\"control-label\">Hora Inicio</label>";
    $datos .= "<input type=\"time\" class=\"form-control\" id=\"hora_ini_col\" name=\"hora_ini_col\" >";
    $datos .= "</div>";
    $datos .= "</div>";
    $datos .= "<div class=\"col-sm-12\">";
    $datos .= "<div class=\"form-group\">";
    $datos .= "<label for=\"state_id\" class=\"control-label\">Hora Fin</label>";
    $datos .= "<input type=\"time\" class=\"form-control\" id=\"hora_fin_col\" name=\"hora_fin_col\" disabled  >";
    $datos .= "</div>";
    $datos .= "</div>";
    echo $datos;
}
