<?php
require('../../fpdf/fpdf.php');
include('../../conexion.php');
$id = $_GET['id'];
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
	//$this->Image('../../dist/img/topo3H.png',170,8,30);
	//$this->Image('../../dist/img/logo3h.png',12,8,35);
    // Arial bold 15
    $this->SetFont('Arial','U',25);
    // Movernos a la derecha
    $this->Cell(83);
    // Título
    $this->Cell(28,10,utf8_decode(''),0,2,'C');
	$this->Cell(28,10,utf8_decode('FICHA TÉCNICA'),0,0,'C');
	$this->Cell(65,10,utf8_decode(''),0,0,'C');
    // Salto de línea
    $this->Ln(15);
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

$pdf->Image('../../dist/img/maquinas.png',5,70,200);

$query ="SELECT le.sigla, le.nombre AS modelo, te.nombre, le.marca,le.num_serie, le.anio,DATE_FORMAT(le.fecha_ingreso,'%d-%m-%Y') as fecha_ingreso,le.observaciones , DATE_FORMAT(me.fecha,'%d-%m-%Y') as UltMant, DATE_FORMAT(pe.fecha,'%d-%m-%Y') as Prog FROM lista_equipos le INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo LEFT JOIN prog_equipos pe on le.id_equipo = pe.id_equipo WHERE le.id_equipo = '$id' ORDER BY me.fecha DESC limit 1";
$resultado = $mysqli->query($query);
while ($fila = $resultado->fetch_array()) {

    $pdf->Cell(150, 30, utf8_decode(''), 0, 5, 'C', 0);

    $pdf->setFont('Arial', 'B', 15);
    $pdf->Cell(30, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(70, 8, utf8_decode('CÓDIGO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 15);
	$pdf->Cell(0, 8, utf8_decode($fila['sigla']), 0, 1, 'L');

    $pdf->setFont('Arial', 'B', 15);
    $pdf->Cell(30, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(70, 8, utf8_decode('MODELO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 15);
	$pdf->Cell(0, 8, utf8_decode($fila['modelo']), 0, 1, 'L');

    $pdf->setFont('Arial', 'B', 15);
    $pdf->Cell(30, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(70, 8, utf8_decode('TIPO DE EQUIPO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 15);
	$pdf->Cell(0, 8, utf8_decode($fila['nombre']), 0, 1, 'L');

    $pdf->setFont('Arial', 'B', 15);
    $pdf->Cell(30, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(70, 8, utf8_decode('MARCA: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 15);
	$pdf->Cell(0, 8, utf8_decode($fila['marca']), 0, 1, 'L');

    $pdf->setFont('Arial', 'B', 15);
    $pdf->Cell(30, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(70, 8, utf8_decode('N° DE SERIE: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 15);
	$pdf->Cell(0, 8, utf8_decode($fila['num_serie']), 0, 1, 'L');

    $pdf->setFont('Arial', 'B', 15);
    $pdf->Cell(30, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(70, 8, utf8_decode('AÑO DE FABRICACIÓN: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 15);
	$pdf->Cell(0, 8, utf8_decode($fila['anio']), 0, 1, 'L');

    $pdf->setFont('Arial', 'B', 15);
    $pdf->Cell(30, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(70, 8, utf8_decode('FECHA INGRESO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 15);
	$pdf->Cell(0, 8, utf8_decode($fila['fecha_ingreso']), 0, 1, 'L');

    $pdf->setFont('Arial', 'B', 15);
    $pdf->Cell(30, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(70, 8, utf8_decode('OBSERVACIONES: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 15);
	$pdf->Cell(0, 8, utf8_decode($fila['observaciones']), 0, 1, 'L');

    $pdf->setFont('Arial', 'B', 15);
    $pdf->Cell(30, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(70, 8, utf8_decode('ULTIMA MANTENCIÓN: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 15);
	$pdf->Cell(0, 8, utf8_decode($fila['UltMant']), 0, 1, 'L');

    $pdf->setFont('Arial', 'B', 15);
    $pdf->Cell(30, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(70, 8, utf8_decode('PROXIMA MANTENCIÓN: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 15);
	$pdf->Cell(0, 8, utf8_decode($fila['Prog']), 0, 1, 'L');


}

$pdf->Image('../../dist/img/logo3H.png', 15, 5, 25);


$pdf->Output();

?>