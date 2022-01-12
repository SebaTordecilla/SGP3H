<?php
require('../../fpdf/fpdf.php');
include('../../conexion.php');
$id_pedido = $_GET['id_pedido'];


class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		// Salto de línea
		$this->Ln(-5);
	}

	// Pie de página
	function Footer()
	{

		$this->SetY(-40);
		$this->Cell(420, 6, utf8_decode('____________________________________________'), 0, 1, 'C', 0);
		$this->Cell(420, 6, utf8_decode('NOMBRE Y FIRMA DE RESPONSABLE DE ÁREA'), 0, 1, 'C', 0);
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial', 'I', 12);
		// Número de página
		$this->Cell(0, 10, utf8_decode('Sociedad Minera 3H Ltda.'), 0, 0, 'C');
		//$this->Cell(0,10,utf8_decode('Pág ').$this->PageNo().'/{nb}',0,0,'C');
	}
}


$pdf = new PDF('L', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->setFillColor(232, 232, 232);
$pdf->setFont('Arial', 'B', 5);


$pdf->SetFont('Arial', 'B', 25);
$pdf->Cell(65, 10, utf8_decode(''), 0, 1, 'C');
$pdf->Cell(83);
$pdf->Cell(95, 10, utf8_decode('SOLICITUD DE COMPRA'), 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(250, 10, utf8_decode('N°' . utf8_decode($id_pedido)), 0, 0, 'R');
$pdf->Cell(65, 10, utf8_decode(''), 0, 1, 'C');
$pdf->Cell(65, 10, utf8_decode(''), 0, 1, 'C');




$query = "SELECT sc.id_pedido, upper(sc.solicitado) as solicitado, sc.hora, sc.fecha, a.nombre as area, sc.prioridad, upper(sc.justificacion) as justificacion FROM solicitudes_compra sc inner join areas3h a on sc.area = a.id_area where id_pedido =  $id_pedido";
$resultado = $mysqli->query($query);
while ($fila = $resultado->fetch_array()) {

	$pdf->setFont('Arial', 'B', 11);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(35, 6, utf8_decode('SOLICITADO POR: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 11);
	$pdf->Cell(50, 6, utf8_decode($fila['solicitado']), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 11);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(13, 6, utf8_decode('HORA: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 11);
	$pdf->Cell(13, 6, utf8_decode($fila['hora']), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 11);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(15, 6, utf8_decode('FECHA: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 11);
	$pdf->Cell(18, 6, date("d/m/Y", strtotime($fila['fecha'])), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 11);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(14, 6, utf8_decode('ÁREA: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 11);
	$pdf->Cell(35, 6, utf8_decode($fila['area']), 0, 0, 'L');

	$pdf->setFont('Arial', 'B', 11);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode('PRIORIDAD: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 11);
	$pdf->Cell(30, 6, utf8_decode($fila['prioridad']), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 11);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(50, 6, utf8_decode('JUSTIFIQUE SOLICITUD: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 11);
	$pdf->Cell(120, 6, utf8_decode($fila['justificacion']), 0, 1, 'L');
	$pdf->Cell(120, 6, '', 0, 1, 'L');
}



//cuerpo de oc

$pdf->setFont('Arial', 'B', 11);
$pdf->Cell(20, 6, utf8_decode('N°'), 1, 0, 'C', 1);
$pdf->Cell(90, 6, utf8_decode('DESCRIPCIÓN'), 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'CANT.', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'STOCK', 1, 0, 'C', 1);
$pdf->Cell(90, 6, 'PROVEEDOR SUGERIDO', 1, 1, 'C', 1);

$query = "SET @num = 0";
$resultado = $mysqli->query($query);

$query = "SELECT @num:=@num+1 as num,id_artsol, upper(descripcion) as descripcion, cantidad, stock, upper(proveedor) as proveedor FROM articulos_solicitados where id_pedido =  $id_pedido";
$resultado = $mysqli->query($query);
$pdf->setFont('Arial', '', 10);
while ($fila = $resultado->fetch_array()) {
	$pdf->Cell(20, 6, utf8_decode($fila['num']), 1, 0, 'C', 0);
	$pdf->Cell(90, 6, $fila['descripcion'], 1, 0, 'C', 0);
	$pdf->Cell(30, 6, utf8_decode($fila['cantidad']), 1, 0, 'C', 0);
	$pdf->Cell(30, 6, number_format($fila['stock'], 0, '.', '.'), 1, 0, 'C', 0);
	$pdf->Cell(90, 6, utf8_decode($fila['proveedor']), 1, 1, 'C', 0);
}




$pdf->Ln(3);





$pdf->Image('../../dist/img/logo3H.png', 15, 6, 25);
//$pdf->Cell('hola', 180, 6, 25);



$pdf->Output();
