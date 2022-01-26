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


$sql_query = "UPDATE ficha_nutricional SET peso='" . $peso . "',talla='" . $talla . "',imc='" . $imc . "',grasa_corporal='" . $grasa_corporal . "',grasa_muscular='" . $grasa_muscular . "',grasa_visceral='" . $grasa_visceral . "',est_nutricional='" . $est_nutricional . "',enfermedades='" . $enfermedades . "',habitos='" . $habitos . "',medicamentos='" . $medicamentos . "',alergias='" . $alergias . "',act_fisica='" . $act_fisica . "' WHERE id_empleado = " . $id_empleado . ";";
$result = mysqli_query($con, $sql_query);

echo 1;
