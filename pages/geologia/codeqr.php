<?php
$id = $_GET['id'];
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
  <div style="margin: 10px" >
    <section class="col-lg-2 connectedSortable ui-sortable" style="border: 2px solid black">
      <form>
        <div class="row">
          <div class="col-sm-5">
            <input id="text" type="hidden" value="http://www.ribosomatic.com?id=<?php $id ?>">
            <div id="qrcode" style="width:100px; height:100px; margin-top:15px;"></div>
          </div>
          <div class="col-sm-6">
            <img src="../../dist/img/logo3Hgris.png" style="width:130px; height:120px; margin-top:10px;">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12" style="text-align:center;">
            <h2>Geologia</h2>
          </div>

        </div>

      </form>


    </section>
  </div>




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