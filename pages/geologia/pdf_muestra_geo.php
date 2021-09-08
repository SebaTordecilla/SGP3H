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
	$this->Image('../../dist/img/logo3hgris.png',12,8,35);
    // Arial bold 15
    $this->SetFont('Arial','U',25);
    // Movernos a la derecha
    $this->Cell(83);
    // Título
    $this->Cell(28,10,utf8_decode(''),0,2,'C');
	//$this->Cell(28,10,utf8_decode('CHECK CAMIONETAS'),0,0,'C');
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
    $this->SetFont('Arial','I',10);
    // Número de página
    $this->Cell(0,10,utf8_decode('Sociedad Minera 3H Ltda.'),0,0,'C');
    //$this->Cell(0,10,utf8_decode('Pág ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF('P','mm',array(100,100));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->setFillColor(232, 232, 232);
$pdf->setFont('Arial', 'B', 12);




//LOGO CAMIONETA
//$pdf->Image('../../dist/img/Mazda.png',70,217,80);

$pdf->Output();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Etiqueta Muestra Geologia</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../funcionesjs/qrcode.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="../../dist/css/estilos.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>

<body>
  <form>
    <div class="row">
        <label>Geologia</label>
        <div class="col-sm-3">
          <img src="../../dist/img/logo3Hgris.png" style="width:100px; height:100px; margin-top:15px;">
        </div>
        <div class="col-sm-3">
          <input id="text" type="hidden" value="http://www.ribosomatic.com">
          <div id="qrcode" style="width:100px; height:100px; margin-top:15px;"></div>
        </div>
    </div>

  </form>


  <script type="text/javascript">
    // Genera el objeto qrcode
    var qrcode = new QRCode(document.getElementById("qrcode"), {
      width: 100,
      height: 100
    });

    // Funcion para crear el codigo
    function makeCode() {
      var elText = document.getElementById("text");

      if (!elText.value) {
        alert("Ingresa un texto");
        elText.focus();
        return;
      }

      qrcode.makeCode(elText.value);
    }

    // Al cargar crear el qr inicial
    makeCode();

    // Al pulsar teclar Enter, genera en QR
    $("#text").
    on("blur", function() {
      makeCode();
    }).
    on("keydown", function(e) {
      if (e.keyCode == 13) {
        makeCode();
      }
    });
  </script>
</body>

</html>