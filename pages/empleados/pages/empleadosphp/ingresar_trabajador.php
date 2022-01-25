<?php
include "../../conexion.php";

$rut = mysqli_real_escape_string($con, $_POST['rut']);
$nombres = mysqli_real_escape_string($con, $_POST['nombres']);
$ap_paterno = mysqli_real_escape_string($con, $_POST['ap_paterno']);
$ap_materno = mysqli_real_escape_string($con, $_POST['ap_materno']);
$fecha_nac = mysqli_real_escape_string($con, $_POST['fecha_nac']);
$nacionalidad = mysqli_real_escape_string($con, $_POST['nacionalidad']);
$sexo = mysqli_real_escape_string($con, $_POST['sexo']);
$est_civil = mysqli_real_escape_string($con, $_POST['est_civil']);
$cargo = mysqli_real_escape_string($con, $_POST['cargo']);
$fecha_ing = mysqli_real_escape_string($con, $_POST['fecha_ing']);
$correo = mysqli_real_escape_string($con, $_POST['correo']);
$telefono = mysqli_real_escape_string($con, $_POST['telefono']);
$tipo_contrato = mysqli_real_escape_string($con, $_POST['tipo_contrato']);
$contacto_emergencia = mysqli_real_escape_string($con, $_POST['contacto_emergencia']);
$titulo = mysqli_real_escape_string($con, $_POST['titulo']);
$nivel_estudios = mysqli_real_escape_string($con, $_POST['nivel_estudios']);
$fecha_matrimonio = mysqli_real_escape_string($con, $_POST['fecha_matrimonio']);
$enfermedad_cronica = mysqli_real_escape_string($con, $_POST['enfermedad_cronica']);
$rsh = mysqli_real_escape_string($con, $_POST['rsh']);
$tratamiento = mysqli_real_escape_string($con, $_POST['tratamiento']);
$discapacidad = mysqli_real_escape_string($con, $_POST['discapacidad']);
$tipo_discapacidad = mysqli_real_escape_string($con, $_POST['tipo_discapacidad']);
$prog_interv = mysqli_real_escape_string($con, $_POST['prog_interv']);
$estado = mysqli_real_escape_string($con, $_POST['estado']);

$id_empleado = mysqli_real_escape_string($con, $_POST['id_empleado']);

if ($id_empleado > 0) {

    $sql_query = "UPDATE empleados SET rut='" . $rut . "',	nombres='" . $nombres . "',	ap_paterno='" . $ap_paterno . "',	ap_materno='" . $ap_materno . "',	fecha_nac='" . $fecha_nac . "',	nacionalidad='" . $nacionalidad . "',	sexo='" . $sexo . "',	est_civil='" . $est_civil . "',	cargo='" . $cargo . "',	fecha_ing='" . $fecha_ing . "',	correo='" . $correo . "',	telefono='" . $telefono . "',	tipo_contrato='" . $tipo_contrato . "',	contacto_emergencia='" . $contacto_emergencia . "',	titulo='" . $titulo . "',	nivel_estudios='" . $nivel_estudios . "',	fecha_matrimonio='" . $fecha_matrimonio . "',	enfermedad_cronica='" . $enfermedad_cronica . "',	rsh='" . $rsh . "',	tratamiento='" . $tratamiento . "',	discapacidad='" . $discapacidad . "',	tipo_discapacidad='" . $tipo_discapacidad . "',	prog_interv='" . $prog_interv . "',	estado='" . $estado . "' WHERE id_empleado =" . $id_empleado . "";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    echo 3;
} else {
    $sql_query = "SELECT count(rut) as contador FROM empleados where rut = '" . $rut . "'";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);

    $contador = $row['contador'];

    if ($contador > 0) {
        echo 1; //rut ya se encuentra ingresado
    } else {
        $sql_query = "INSERT INTO empleados( rut, nombres,  ap_paterno ,  ap_materno ,  fecha_nac ,  nacionalidad ,  sexo ,  est_civil ,  cargo ,  fecha_ing ,  correo ,  telefono ,  tipo_contrato ,  contacto_emergencia ,  titulo ,  nivel_estudios ,  fecha_matrimonio ,  enfermedad_cronica ,  rsh ,  tratamiento ,  discapacidad ,  tipo_discapacidad ,  prog_interv ,  estado ) 
        VALUES ('" . $rut . "', '" . $nombres . "',  '" . $ap_paterno . "' ,  '" . $ap_materno . "' ,  '" . $fecha_nac . "' ,  '" . $nacionalidad . "' ,  '" . $sexo . "' ,  '" . $est_civil . "' ,  '" . $cargo . "' ,  '" . $fecha_ing . "' ,  '" . $correo . "' ,  '" . $telefono . "' ,  '" . $tipo_contrato . "' ,  '" . $contacto_emergencia . "' ,  '" . $titulo . "' ,  '" . $nivel_estudios . "' ,  '" . $fecha_matrimonio . "' ,  '" . $enfermedad_cronica . "' ,  '" . $rsh . "' ,  '" . $tratamiento . "' ,  '" . $discapacidad . "' ,  '" . $tipo_discapacidad . "' ,  '" . $prog_interv . "' ,  '" . $estado . "')";
        $result = mysqli_query($con, $sql_query);
        $row = mysqli_fetch_array($result);
        echo 2;
    }
}
