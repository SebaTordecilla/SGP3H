<?php
require('../../../../fpdf/fpdf.php');
include('../../conexion.php');
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
	$this->Cell(28,10,utf8_decode('Departamento de Bienestar'),0,0,'C');
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


$query ="SELECT *, TIMESTAMPDIFF(YEAR,fecha_nac,CURDATE()) AS edad FROM empleados WHERE id_empleado = $id";
$resultado = $mysqli->query($query);
while ($fila = $resultado->fetch_array()) {

    $pdf->Cell(150, 0, utf8_decode(''), 0, 2, 'C', 0);


    $pdf->setFont('Arial', 'U', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('ANTECENTES TRABAJADOR'), 0, 1, 'L');
	$pdf->Cell(10, 8, utf8_decode(''), 0, 1, 'L');


    $pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('NOMBRE: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, utf8_decode(strtoupper($fila['nombres'].' '.$fila['ap_paterno'].' '.$fila['ap_materno'])), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('FECHA DE NAC: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, date("d/m/Y", strtotime($fila['fecha_nac'])), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(35, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(20, 8, utf8_decode('EDAD: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, $fila['edad'], 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('RUT: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, $fila['rut'], 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(35, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(20, 8, utf8_decode('TEL: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, $fila['telefono'], 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('C.EMERGENCIA: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtolower($fila['contacto_emergencia']), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(35, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(20, 8, utf8_decode('F.INGR: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, date("d/m/Y", strtotime($fila['fecha_ing'])), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('CORREO: '), 0, 0, 'L');
	$pdf->setFont('Arial', 'I', 12);
	$pdf->Cell(35, 8, strtolower($fila['correo']), 0, 1, 'L');
	
	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('CARGO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['cargo']), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(35, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(20, 8, utf8_decode('N.EST: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['nivel_estudios']), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('TíTULO/OFICIO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['titulo']), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(35, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(20, 8, utf8_decode('E.CIVIL: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['est_civil']), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('T.CONTRATO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['tipo_contrato']), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(35, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(20, 8, utf8_decode('F.MAT: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	if($fila['fecha_matrimonio']==''){
		$pdf->Cell(35, 8, '', 0, 1, 'L');
	}else if($fila['fecha_matrimonio']=='0000-00-00'){
		$pdf->Cell(35, 8, '', 0, 1, 'L');
	}else{
		$pdf->Cell(35, 8, date("d/m/Y", strtotime($fila['fecha_matrimonio'])), 0, 1, 'L');
	}

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('ENF.CRÓNICA: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['enfermedad_cronica']), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(35, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(20, 8, utf8_decode('TTO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['tratamiento']), 0, 1, 'L');

	
	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('P.INTERVENCIÓN: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['prog_interv']), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(35, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(20, 8, utf8_decode('RSH: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['rsh']).'%', 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('DISCAPACIDAD: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['discapacidad']), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 12);
    $pdf->Cell(35, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(20, 8, utf8_decode('T.DISC: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 12);
	$pdf->Cell(35, 8, strtoupper($fila['tipo_discapacidad']), 0, 1, 'L');

	$pdf->Cell(35, 8, '', 0, 1, 'L');
    $pdf->setFont('Arial', 'U', 12);
    $pdf->Cell(10, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(40, 8, utf8_decode('GRUPO FAMILIAR'), 0, 1, 'L');
	$pdf->Cell(40, 8, utf8_decode(''), 0, 1, 'L');




	$pdf->setFont('Arial', 'B', 10);
	$pdf->Cell(55, 8, utf8_decode('NOMBRE'), 1, 0, 'C',1);
	$pdf->Cell(30, 8, utf8_decode('RUT'), 1, 0, 'C',1);
	$pdf->Cell(20, 8, utf8_decode('EDAD'), 1, 0, 'C',1);
	$pdf->Cell(30, 8, utf8_decode('N.ESTUDIOS'), 1, 0, 'C',1);
	$pdf->Cell(30, 8, utf8_decode('OCUPACIÓN'), 1, 0, 'C',1);
	$pdf->Cell(30, 8, utf8_decode('PARENTESCO'), 1, 1, 'C',1);

	$pdf->setFont('Arial', '', 9);
	$query ="SELECT * FROM grupo_familiar WHERE id_empleado = $id";
	$resultado = $mysqli->query($query);
	while ($fila = $resultado->fetch_array()) {

		$pdf->Cell(55, 8, utf8_decode(strtoupper($fila['nombre'])), 1, 0, 'C');
		$pdf->Cell(30, 8, utf8_decode($fila['rut']), 1, 0, 'C');
		$pdf->Cell(20, 8, utf8_decode($fila['edad']), 1, 0, 'C');
		$pdf->Cell(30, 8, utf8_decode(strtoupper($fila['nivel_edu'])), 1, 0, 'C');
		$pdf->Cell(30, 8, utf8_decode(strtoupper($fila['ocupacion'])), 1, 0, 'C');
		$pdf->Cell(30, 8, utf8_decode(strtoupper($fila['parentesco'])), 1, 1, 'C');
	}
    
    $pdf->Ln(3);

}




$pdf->Image('../../../../dist/img/logo3H.png', 15, 5, 25);

$pdf->Output();
