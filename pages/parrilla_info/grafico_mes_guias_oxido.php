<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();


$mes = mysqli_real_escape_string($con, $_POST['mes']);
$ano = mysqli_real_escape_string($con, $_POST['ano']);


$sql = "SELECT sum(tonelaje) as tonelaje, count(num_guia) as guias,day((select max(fecha) from guias_camiones where month(fecha)= " . $mes . " and year(fecha)= " . $ano . ")) as mayor from guias_camiones where month(fecha)= " . $mes . " and year(fecha)= " . $ano . " group by month(fecha)";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$tonelaje = $row['tonelaje'];
$guias = $row['guias'];

$mayor = $row['mayor'];
if ($mayor == "") {
    $tabla = "
<div class=\"info-box mb-3 bg-info\">
  <div class=\"info-box-content\">
    <span class=\"info-box-text\">TONELADAS</span>
    <span class=\"info-box-number\">" . number_format($tonelaje, 0, ",", ".") . " Kg.</span>
  </div>
</div>
<div class=\"info-box mb-3 bg-info\">
  <div class=\"info-box-content\">
    <span class=\"info-box-text\">VIAJES</span>
    <span class=\"info-box-number\">" . $guias . "</span>
  </div>
</div>
<div class=\"info-box mb-3 bg-info\">
  <div class=\"info-box-content\">
    <span class=\"info-box-text\">PROM. TONELADAS DIARIO</span>
    <span class=\"info-box-number\">" . number_format(0, 0, ",", ".") . " Kg.</span>
  </div>
</div>
<div class=\"info-box mb-3 bg-info\">
  <div class=\"info-box-content\">
    <span class=\"info-box-text\">PROM. VIAJES DIARIO</span>
    <span class=\"info-box-number\">" . number_format(0, 1, ",", ".") . "</span>
  </div>
</div>";
    echo $tabla;
} else {
    $promedioton = $tonelaje / $mayor;
    $promedioguia = $guias / $mayor;
    $tabla = "
<div class=\"info-box mb-3 bg-info\">
  <div class=\"info-box-content\">
    <span class=\"info-box-text\">TONELADAS</span>
    <span class=\"info-box-number\">" . number_format($tonelaje, 0, ",", ".") . " Kg.</span>
  </div>
</div>
<div class=\"info-box mb-3 bg-info\">
  <div class=\"info-box-content\">
    <span class=\"info-box-text\">VIAJES</span>
    <span class=\"info-box-number\">" . $guias . "</span>
  </div>
</div>
<div class=\"info-box mb-3 bg-info\">
  <div class=\"info-box-content\">
    <span class=\"info-box-text\">PROM. TONELADAS DIARIO</span>
    <span class=\"info-box-number\">" . number_format($promedioton, 0, ",", ".") . " Kg.</span>
  </div>
</div>
<div class=\"info-box mb-3 bg-info\">
  <div class=\"info-box-content\">
    <span class=\"info-box-text\">PROM. VIAJES DIARIO</span>
    <span class=\"info-box-number\">" . number_format($promedioguia, 1, ",", ".") . "</span>
  </div>
</div>";
    echo $tabla;
}






?>

<script src="../../plugins/chart.js/Chart.min.js"></script>
<script src="../../dist/js/demo.js"></script>

<script>
    $(function() {
        var lista = document.getElementById("lista_equipos00").value;
        var list2 = lista.split(',');
        var lista4 = document.getElementById("lista_equipos44").value;
        var list4 = lista4.split(',');
        var diasmes = document.getElementById("diasmes2").value;
        var areaChartCanvas = $('#areaChart2').get(0).getContext('2d')

        if (diasmes == 30) {
            var areaChartData = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27], list2[28], list2[29]],
                datasets: [{
                    label: 'Viajes',
                    backgroundColor: 'rgba(220, 118, 51, 1)',
                    borderColor: 'rgba(220, 118, 51, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(220, 118, 51 , 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220, 118, 51,1)',
                    data: [list4[0], list4[1], list4[2], list4[3], list4[4], list4[5], list4[6], list4[7], list4[8], list4[9], list4[10], list4[11], list4[12], list4[13], list4[14], list4[15], list4[16], list4[17], list4[18], list4[19], list4[20], list4[21], list4[22], list4[23], list4[24], list4[25], list4[26], list4[27], list4[28], list4[29]]
                }, ]
            }


        } else if (diasmes == 31) {
            var areaChartData = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27], list2[28], list2[29], list2[30]],
                datasets: [{
                    label: 'Viajes',
                    backgroundColor: 'rgba(220, 118, 51, 1)',
                    borderColor: 'rgba(220, 118, 51, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(220, 118, 51 , 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220, 118, 51,1)',
                    data: [list4[0], list4[1], list4[2], list4[3], list4[4], list4[5], list4[6], list4[7], list4[8], list4[9], list4[10], list4[11], list4[12], list4[13], list4[14], list4[15], list4[16], list4[17], list4[18], list4[19], list4[20], list4[21], list4[22], list4[23], list4[24], list4[25], list4[26], list4[27], list4[28], list4[29], list4[30]]
                }, ]
            }

        } else if (diasmes == 28) {
            var areaChartData = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27]],
                datasets: [{
                    label: 'Viajes',
                    backgroundColor: 'rgba(220, 118, 51, 1)',
                    borderColor: 'rgba(220, 118, 51, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(220, 118, 51 , 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220, 118, 51,1)',
                    data: [list4[0], list4[1], list4[2], list4[3], list4[4], list4[5], list4[6], list4[7], list4[8], list4[9], list4[10], list4[11], list4[12], list4[13], list4[14], list4[15], list4[16], list4[17], list4[18], list4[19], list4[20], list4[21], list4[22], list4[23], list4[24], list4[25], list4[26], list4[27]]
                }, ]
            }


        } else if (diasmes == 29) {
            var areaChartData = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27], list2[28]],
                datasets: [{
                    label: 'Viajes',
                    backgroundColor: 'rgba(220, 118, 51, 1)',
                    borderColor: 'rgba(220, 118, 51, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(220, 118, 51 , 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220, 118, 51,1)',
                    data: [list4[0], list4[1], list4[2], list4[3], list4[4], list4[5], list4[6], list4[7], list4[8], list4[9], list4[10], list4[11], list4[12], list4[13], list4[14], list4[15], list4[16], list4[17], list4[18], list4[19], list4[20], list4[21], list4[22], list4[23], list4[24], list4[25], list4[26], list4[27], list4[28]]
                }, ]
            }

        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true
            },
            scales: {
                xAxes: [{
                    //stacked: true, //barra montada
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    //stacked: true,
                    gridLines: {
                        display: true,
                    }
                }]
            }
        }

        new Chart(areaChartCanvas, {
            type: 'bar',
            data: areaChartData,
            options: areaChartOptions
        })


    })
</script>