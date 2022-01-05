<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$mes = mysqli_real_escape_string($con, $_POST['mes']);
$ano = mysqli_real_escape_string($con, $_POST['ano']);

$sql = "select	count(num_guia) as guias, sum(tonelaje) as tonelaje, (SELECT count(num_lote) FROM lotes where mes = " . $mes . " and ano = " . $ano . ") as lotes from guias_camiones where month(fecha)= " . $mes . " and year(fecha) = " . $ano . " ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$guias = $row['guias'];
$tonelaje = number_format($row['tonelaje'], 0, ",", ".");
$lotes = $row['lotes'];


$target = "
        <div class=\"row\">
        <div class=\"col-4\">
          <div class=\"info-box mb-3 \">
            <div class=\"info-box-content\">
              <span class=\"info-box-text\">TONELAJE</span>
              <span class=\"info-box-number\">" . $tonelaje . " Kg </span>
            </div>
          </div>

        </div>
      
        <div class=\"col-4\">
        <div class=\"info-box mb-3 \">
        <div class=\"info-box-content\">
            <span class=\"info-box-text\">N°DE GUÍAS</span>
            <span class=\"info-box-number\">" . number_format($guias, 0, ",", ".") . " </span>
          </div>
        </div>

      </div>
      
      <div class=\"col-4\">
      <div class=\"info-box mb-3 \">
      <div class=\"info-box-content\">
          <span class=\"info-box-text\">N°DE LOTES</span>
          <span class=\"info-box-number\">" . number_format($lotes, 0, ",", ".") . " </span>
        </div>
      </div>

      </div>
      </div>
          

";

echo $target;
