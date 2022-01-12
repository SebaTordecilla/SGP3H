<?php
require('../../fpdf/fpdf.php');
include('../../conexion.php');
$id_oc = $_GET['id_oc'];


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

		$this->SetY(-50);
		$this->Cell(70, 6, utf8_decode('_______________________________'), 0, 1, 'C', 0);
		$this->Cell(70, 6, utf8_decode('CARLOS ASTUDILLO ORLANDINI'), 0, 1, 'C', 0);
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial', 'I', 12);
		// Número de página
		//$this->Cell(0, 10, utf8_decode('Sociedad Minera 3H Ltda.'), 0, 0, 'C');
		//$this->Cell(0,10,utf8_decode('Pág ').$this->PageNo().'/{nb}',0,0,'C');
	}
}


$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->setFillColor(232, 232, 232);
$pdf->setFont('Arial', 'B', 5);

$sql_query = "SELECT oc.id_oc, oc.num_oc,oc.id_empresa,oc.id_proveedor, upper(ei.nombre) as empresa, upper(pr.nombre) as proveedor, oc.fecha , upper(oc.pago) as pago, oc.cotizacion, oc.id_pedido, pr.rut, pr.direccion, ei.rut as rut_e, upper(ei.direccion) as direccion_e, ei.telefono
FROM ordenes_compras oc left join empresas_internas ei on oc.id_empresa = ei.id_empresa left join proveedores pr 
on pr.id_proveedor = oc.id_proveedor where oc.id_oc =  $id_oc";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$empresa = $row['empresa'];
$rut_e = $row['rut_e'];
$direccion_e = $row['direccion_e'];
$telefono = $row['telefono'];
$num_oc = $row['num_oc'];

$pdf->setFont('Arial', 'I', 10);
$pdf->Cell(180, 6, utf8_decode($empresa), 0, 1, 'R');
$pdf->Cell(180, 6, utf8_decode($rut_e), 0, 1, 'R');
$pdf->Cell(180, 6, utf8_decode($direccion_e), 0, 1, 'R');
$pdf->setFont('Arial', 'I', 9);
$pdf->Cell(180, 6, utf8_decode('www.3h.cl - Teléfono: ' . $telefono), 0, 1, 'R');
$pdf->Cell(180, 6, utf8_decode(''), 0, 1, 'R');


$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(83);
$pdf->Cell(28, 10, utf8_decode('ORDEN DE COMPRA'), 0, 1, 'C');
$pdf->Cell(83);
$pdf->Cell(28, 10, utf8_decode('N°'.$num_oc), 0, 0, 'C');
$pdf->Cell(65, 10, utf8_decode(''), 0, 1, 'C');
$pdf->Cell(65, 10, utf8_decode(''), 0, 1, 'C');




$query = "SELECT oc.id_oc, oc.num_oc,oc.id_empresa,oc.id_proveedor, upper(ei.nombre) as empresa, upper(pr.nombre) as proveedor, oc.fecha , upper(oc.pago) as pago, oc.cotizacion, oc.id_pedido, pr.rut, pr.direccion, ei.rut as rut_e, upper(ei.direccion) as direccion_e, ei.telefono
FROM ordenes_compras oc left join empresas_internas ei on oc.id_empresa = ei.id_empresa left join proveedores pr 
on pr.id_proveedor = oc.id_proveedor where oc.id_oc =  $id_oc";
$resultado = $mysqli->query($query);
while ($fila = $resultado->fetch_array()) {

	$pdf->setFont('Arial', 'B', 10);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(45, 6, utf8_decode('PROVEEDOR: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 10);
	$pdf->Cell(45, 6, utf8_decode($fila['proveedor']), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 10);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(45, 6, utf8_decode('RUT: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 10);
	$pdf->Cell(45, 6, utf8_decode($fila['rut']), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 10);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(45, 6, utf8_decode('DIRECCIÓN: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 10);
	$pdf->Cell(45, 6, utf8_decode($fila['direccion']), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 10);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(45, 6, utf8_decode('FECHA: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 10);
	$pdf->Cell(45, 6, date("d/m/Y", strtotime($fila['fecha'])), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 10);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(45, 6, utf8_decode('CONDICIÓN DE PAGO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 10);
	$pdf->Cell(45, 6, utf8_decode($fila['pago']), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 10);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(45, 6, utf8_decode('N° DE COTIZACIÓN: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 10);
	$pdf->Cell(45, 6, utf8_decode($fila['cotizacion']), 0, 1, 'L');

	$pdf->setFont('Arial', 'B', 10);
	$pdf->Cell(5, 6, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(45, 6, utf8_decode('N° NOTA PEDIDO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 10);
	$pdf->Cell(45, 6, utf8_decode($fila['id_pedido']), 0, 1, 'L');
	$pdf->Cell(45, 6, utf8_decode(''), 0, 1, 'L');



	//cuerpo de oc

	$pdf->setFont('Arial', 'B', 10);
	$pdf->Cell(20, 6, utf8_decode('CÓDIGO'), 1, 0, 'C', 1);
	$pdf->Cell(20, 6, 'CANT.', 1, 0, 'C', 1);
	$pdf->Cell(95, 6, utf8_decode('DESCRIPCIÓN'), 1, 0, 'C', 1);
	$pdf->Cell(30, 6, 'NETO', 1, 0, 'C', 1);
	$pdf->Cell(30, 6, 'TOTAL', 1, 1, 'C', 1);

	$query = "SET @num = 0";
	$resultado = $mysqli->query($query);

	$query = "SELECT @num:=@num+1 as num,cantidad, descripcion, neto, neto*cantidad as total, (select sum(neto*cantidad) from articulos_oc where id_oc = $id_oc) as suma FROM articulos_oc where id_oc =  $id_oc";
	$resultado = $mysqli->query($query);
	$pdf->setFont('Arial', '', 9);
	while ($fila = $resultado->fetch_array()) {
		$pdf->Cell(20, 6, utf8_decode($fila['num']), 1, 0, 'C', 0);
		$pdf->Cell(20, 6, $fila['cantidad'], 1, 0, 'C', 0);
		$pdf->Cell(95, 6, utf8_decode($fila['descripcion']), 1, 0, 'C', 0);
		$pdf->Cell(30, 6, number_format($fila['neto'], 0, '.', '.'), 1, 0, 'C', 0);
		$pdf->Cell(30, 6, number_format($fila['total'], 0, '.', '.'), 1, 1, 'C', 0);
	}

	$query = "SELECT sum(neto*cantidad) AS total from articulos_oc where id_oc = $id_oc";
	$resultado = $mysqli->query($query);
	$pdf->setFont('Arial', '', 9);
	while ($fila = $resultado->fetch_array()) {
		$pdf->setFont('Arial', 'B', 9);
		$pdf->Cell(135, 6, '', 0, 0, 'C', 0);
		$pdf->Cell(30, 6, 'TOTAL NETO', 0, 0, 'C', 0);
		$pdf->Cell(30, 6, number_format($fila['total'], 0, '.', '.'), 1, 1, 'C', 0);

		$pdf->Cell(135, 6, '', 0, 0, 'C', 0);
		$pdf->Cell(30, 6, 'IVA', 0, 0, 'C', 0);
		$pdf->Cell(30, 6, number_format($fila['total'] * 0.19, 0, '.', '.'), 1, 1, 'C', 0);

		$pdf->Cell(135, 6, '', 0, 0, 'C', 0);
		$pdf->Cell(30, 6, 'TOTAL', 0, 0, 'C', 0);
		$pdf->Cell(30, 6, number_format($fila['total'] + $fila['total'] * .19, 0, '.', '.'), 1, 1, 'C', 0);
	}


	$pdf->Ln(3);
}




$pdf->Image('../../dist/img/logo3H.png', 15, 6, 25);
//$pdf->Cell('hola', 180, 6, 25);



$pdf->Output();
