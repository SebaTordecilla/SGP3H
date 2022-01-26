<?php
require('../../../../fpdf/fpdf.php');
include "../../conexion.php";
$id = $_GET['id'];
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    
    $this->SetFont('Arial','I',20);
    // Movernos a la derecha
    $this->Cell(83);
    // Título
    $this->Cell(28,10,utf8_decode(''),0,2,'C');
	$this->Cell(28,10,utf8_decode('Ficha Nutricional'),0,0,'C');
	$this->Cell(65,10,utf8_decode(''),0,0,'C');
    // Salto de línea
    $this->Ln(30);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',12);
    // Número de página
    $this->Cell(0,10,utf8_decode('Sociedad Minera 3H Ltda.'),0,0,'C');
    //$this->Cell(0,10,utf8_decode('Pág ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF('P','mm','Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->setFillColor(232, 232, 232);
$pdf->setFont('Arial', 'B', 12);


$query ="SELECT e.id_empleado,e.rut, upper(concat(e.nombres,' ',ap_paterno,' ',ap_materno))as nombre,fn.peso,fn.talla,fn.imc,fn.grasa_corporal,fn.grasa_muscular,fn.grasa_visceral,fn.est_nutricional, fn.enfermedades, fn.habitos, fn.medicamentos, fn.alergias, fn.act_fisica, TIMESTAMPDIFF(YEAR,e.fecha_nac,CURDATE()) AS edad, e.sexo
FROM ficha_nutricional fn inner join empleados e on fn.id_empleado = e.id_empleado WHERE e.id_empleado = $id";
$resultado = $mysqli->query($query);
while ($fila = $resultado->fetch_array()) {

    $pdf->Cell(150, 0, utf8_decode(''), 0, 2, 'C', 0);





    $pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(25, 8, utf8_decode('NOMBRE: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['nombre'])), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(25, 8, utf8_decode('EDAD: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['edad'])), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(18, 8, utf8_decode('SEXO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['sexo'])), 0, 1, 'L');
	$pdf->Cell(20, 8, utf8_decode(''), 0, 1, 'L');

	$pdf->setFont('Arial', 'U', 12);
    $pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('DATOS ANTROPOMÉTRICOS'), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(25, 8, utf8_decode('PESO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['peso']).' Kg'), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(50, 8, utf8_decode('%GRASA CORPORAL: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['grasa_corporal'].' %')), 0, 1, 'L');


	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(25, 8, utf8_decode('TALLA: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['talla']).''), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(50, 8, utf8_decode('%GRASA MUSCULAR: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['grasa_muscular'].' %')), 0, 1, 'L');


	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(25, 8, utf8_decode('IMC: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['imc']).''), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(50, 8, utf8_decode('%GRASA VISCERAL: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['grasa_visceral'].' %')), 0, 1, 'L');


	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode('ESTADO NUTRICIONAL: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['est_nutricional']).''), 0, 1, 'L');
	$pdf->Cell(35, 8, '', 0, 1, 'L');


	$pdf->setFont('Arial', 'U', 12);
    $pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('ANTECEDENTES CLÍNICOS'), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode('ENFERMEDADES: '), 0, 1, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode(strtoupper($fila['enfermedades']).''), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode('HÁBITOS: ¿FUMADOR / ALCOHOL / DROGAS? '), 0, 1, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode(strtoupper($fila['habitos']).''), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode('MEDICAMENTOS:  '), 0, 1, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode(strtoupper($fila['medicamentos']).''), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode('ALERGIAS / ALERGIAS ALIMENTARIA:  '), 0, 1, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode(strtoupper($fila['alergias']).''), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode('ACTIVIDAD FÍSICA:  '), 0, 1, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(52, 8, utf8_decode(strtoupper($fila['act_fisica']).''), 0, 1, 'L');
	$pdf->Cell(20, 18, utf8_decode(''), 0, 1, 'L');


	$pdf->setFont('Arial', 'B', 12);
	$pdf->Cell(35, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('_____________________'), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('_____________________'), 0, 1, 'L');
	
	
	$pdf->Cell(43, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('NUTRICIONISTA'), 0, 0, 'L');
	$pdf->Cell(42, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('TRABAJADOR'), 0, 1, 'L');


    
    $pdf->Ln(3);

}




$pdf->Image('../../../../dist/img/logo3H.png', 15, 5, 25);

$pdf->Output();
