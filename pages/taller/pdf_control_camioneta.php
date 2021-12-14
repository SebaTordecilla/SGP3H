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
	$this->Cell(28,10,utf8_decode('CHECK CAMIONETAS'),0,0,'C');
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


$query ="SELECT c3.patente,c3.modelo,c3.marca,cc.fecha,cc.kilometraje,cc.id_mecanico FROM control_camionetas cc INNER JOIN camionetas3h c3 on cc.id_camioneta = c3.id_camioneta WHERE cc.id_csc = $id";
$resultado = $mysqli->query($query);
while ($fila = $resultado->fetch_array()) {

    $pdf->Cell(150, 0, utf8_decode(''), 0, 2, 'C', 0);

    $pdf->setFont('Arial', 'B', 13);
    $pdf->Cell(5, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(25, 8, utf8_decode('PATENTE: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 13);
	$pdf->Cell(35, 8, utf8_decode($fila['patente']), 0, 0, 'L');

    $pdf->setFont('Arial', 'B', 13);
	$pdf->Cell(1, 8, utf8_decode('MARCA: '), 0, 0, 'L');
    $pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->setFont('Arial', '', 13);
	$pdf->Cell(35, 8, utf8_decode($fila['marca']), 0, 0, 'L');

    $pdf->setFont('Arial', 'B', 13);
    $pdf->Cell(1, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(28, 8, utf8_decode('MODELO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 13);
	$pdf->Cell(0, 8, utf8_decode($fila['modelo']), 0, 1, 'L');
//LINEA2
    $pdf->setFont('Arial', 'B', 13);
    $pdf->Cell(5, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(25, 8, utf8_decode('FECHA: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 13);
	$pdf->Cell(35, 8, date("d/m/Y", strtotime($fila['fecha'])), 0, 0, 'L');

    $pdf->setFont('Arial', 'B', 13);
	$pdf->Cell(1, 8, utf8_decode('KM: '), 0, 0, 'L');
    $pdf->Cell(20, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->setFont('Arial', '', 13);
	$pdf->Cell(35, 8, number_format($fila['kilometraje'], 0, ',', '.'), 0, 0, 'L');
   

    $pdf->setFont('Arial', 'B', 13);
    $pdf->Cell(1, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(28, 8, utf8_decode('MECÁNICO: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 13);
	$pdf->Cell(0, 8, utf8_decode($fila['id_mecanico']), 0, 1, 'L');

    $pdf->Ln(3);

}



// Consulta
$query = "SELECT 'NIVEL DE ACEITE DE MOTOR' AS nombre,IF(aceite_motor=1,'X','') as Bueno,IF(aceite_motor=2,'X','') as Regular,IF(aceite_motor=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);

$pdf->setFont('Arial', 'B', 11);
$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
$pdf->Cell(113, 6, 'Elemento a Revisar', 1, 0, 'L', 1);
$pdf->Cell(25, 6, 'Bueno', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Regular', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Malo', 1, 1, 'C', 1);

while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'NIVEL REFRIGERANTE MOTOR' AS nombre,IF(ref_motor=1,'X','') as Bueno,IF(ref_motor=2,'X','') as Regular,IF(ref_motor=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'NIVEL ACEITE HIDRÁULICO (dirección)' AS nombre,IF(aceite_hidr=1,'X','') as Bueno,IF(aceite_hidr=2,'X','') as Regular,IF(aceite_hidr=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'NIVEL LIQUIDO DE FRENOS' AS nombre,IF(liq_frenos=1,'X','') as Bueno,IF(liq_frenos=2,'X','') as Regular,IF(liq_frenos=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'REVISIÓN FILTRO DE AIRE' AS nombre,IF(filtro_aire=1,'X','') as Bueno,IF(filtro_aire=2,'X','') as Regular,IF(filtro_aire=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'PARTIDA EN FRIO' AS nombre,IF(part_frio=1,'X','') as Bueno,IF(part_frio=2,'X','') as Regular,IF(part_frio=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'REVISIÓN INDICADORES' AS nombre,IF(rev_indicadores=1,'X','') as Bueno,IF(rev_indicadores=2,'X','') as Regular,IF(rev_indicadores=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'CORTA CORRIENTE' AS nombre,IF(corta_corriente=1,'X','') as Bueno,IF(corta_corriente=2,'X','') as Regular,IF(corta_corriente=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'ESTADO DE BUTACAS Y ASIENTOS' AS nombre,IF(but_asientos=1,'X','') as Bueno,IF(but_asientos=2,'X','') as Regular,IF(but_asientos=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'LUCES' AS nombre,IF(luces=1,'X','') as Bueno,IF(luces=2,'X','') as Regular,IF(luces=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'ESTADO PRESIÓN NEUMÁTICOS' AS nombre,IF(presion_neum=1,'X','') as Bueno,IF(presion_neum=2,'X','') as Regular,IF(presion_neum=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'ANTIVUELCO INTERIOR' AS nombre,IF(ant_interior=1,'X','') as Bueno,IF(ant_interior=2,'X','') as Regular,IF(ant_interior=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'ANTIVUELCO EXTERIOR' AS nombre,IF(ant_exterior=1,'X','') as Bueno,IF(ant_exterior=2,'X','') as Regular,IF(ant_exterior=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'FRENO DE MANO' AS nombre,IF(freno_mano=1,'X','') as Bueno,IF(freno_mano=2,'X','') as Regular,IF(freno_mano=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'RUEDA DE REPUESTO' AS nombre,IF(rueda_repuesto=1,'X','') as Bueno,IF(rueda_repuesto=2,'X','') as Regular,IF(rueda_repuesto=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'GATA' AS nombre,IF(gata=1,'X','') as Bueno,IF(gata=2,'X','') as Regular,IF(gata=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'TRIÁNGULO O CONO' AS nombre,IF(triang_cono=1,'X','') as Bueno,IF(triang_cono=2,'X','') as Regular,IF(triang_cono=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'CHALECO REFLECTANTE' AS nombre,IF(chaleco_refl=1,'X','') as Bueno,IF(chaleco_refl=2,'X','') as Regular,IF(chaleco_refl=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'REVISIÓN DOCUMENTOS' AS nombre,IF(rev_documentos=1,'X','') as Bueno,IF(rev_documentos=2,'X','') as Regular,IF(rev_documentos=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'EXTINTOR' AS nombre,IF(extintor=1,'X','') as Bueno,IF(extintor=2,'X','') as Regular,IF(extintor=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'BALIZA' AS nombre,IF(baliza=1,'X','') as Bueno,IF(baliza=2,'X','') as Regular,IF(baliza=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}

$query = "SELECT 'ALARMA RETROCESO' AS nombre,IF(alarm_retroceso=1,'X','') as Bueno,IF(alarm_retroceso=2,'X','') as Regular,IF(alarm_retroceso=3,'X','') as Malo FROM control_camionetas WHERE id_csc= $id";
$resultado = $mysqli->query($query);
while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(113, 6, utf8_decode($fila['nombre']), 1, 0, 'L');
	$pdf->Cell(25, 6, utf8_decode($fila['Bueno']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Regular']), 1, 0, 'C');
	$pdf->Cell(25, 6, utf8_decode($fila['Malo']), 1, 1, 'C');
}
$pdf->Ln(2);
//OBSERVACIONES
$query ="SELECT IF(observaciones='','SIN OBSERVACIONES',observaciones) as observaciones FROM control_camionetas WHERE id_csc = $id";
$resultado = $mysqli->query($query);
while ($fila = $resultado->fetch_array()) {

    $pdf->Cell(150, 0, utf8_decode(''), 0, 2, 'C', 0);

    $pdf->setFont('Arial', 'B', 13);
    $pdf->Cell(4, 8, utf8_decode(''), 0, 0, 'L');
	$pdf->Cell(45, 8, utf8_decode('OBSERVACIONES: '), 0, 0, 'L');
	$pdf->setFont('Arial', '', 13);
	$pdf->MultiCell(150, 8,utf8_decode(($fila['observaciones'])));

}

$pdf->Image('../../dist/img/logo3H.png', 15, 5, 25);
//LOGO CAMIONETA
//$pdf->Image('../../dist/img/Mazda.png',70,217,80);

$pdf->Output();

?>