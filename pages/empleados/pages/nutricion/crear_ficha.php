<?php
include "../../conexion.php";

$id_empleado = mysqli_real_escape_string($con, $_POST['id_empleado']);
$peso = mysqli_real_escape_string($con, $_POST['peso']);
$talla = mysqli_real_escape_string($con, $_POST['talla']);
$imc = mysqli_real_escape_string($con, $_POST['imc']);
$grasa_corporal = mysqli_real_escape_string($con, $_POST['grasa_corporal']);
$grasa_muscular = mysqli_real_escape_string($con, $_POST['grasa_muscular']);
$grasa_visceral = mysqli_real_escape_string($con, $_POST['grasa_visceral']);
$est_nutricional = mysqli_real_escape_string($con, $_POST['est_nutricional']);
$enfermedades = mysqli_real_escape_string($con, $_POST['enfermedades']);
$habitos = mysqli_real_escape_string($con, $_POST['habitos']);
$medicamentos = mysqli_real_escape_string($con, $_POST['medicamentos']);
$alergias = mysqli_real_escape_string($con, $_POST['alergias']);
$act_fisica = mysqli_real_escape_string($con, $_POST['act_fisica']);


$sql_query = "SELECT count(id_empleado) as contador FROM ficha_nutricional WHERE id_empleado = " . $id_empleado . ";";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$contador = $row['contador'];

if ($contador > 0) {

    echo 1; // trabajador ya tiene creada su ficha 

} else {

    $sql_query = "INSERT INTO ficha_nutricional(id_empleado,peso,talla,imc,grasa_corporal,grasa_muscular,grasa_visceral,est_nutricional,enfermedades,habitos,medicamentos,alergias,act_fisica) 
    VALUES	('" . $id_empleado . "','" . $peso . "','" . $talla . "','" . $imc . "','" . $grasa_corporal . "','" . $grasa_muscular . "','" . $grasa_visceral . "','" . $est_nutricional . "','" . $enfermedades . "','" . $habitos . "','" . $medicamentos . "','" . $alergias . "','" . $act_fisica . "')";
    $result = mysqli_query($con, $sql_query);
    echo 2; //ficha ingresada
}
