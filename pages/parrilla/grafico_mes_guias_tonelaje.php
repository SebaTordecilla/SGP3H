<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();


$mes = mysqli_real_escape_string($con, $_POST['mes']);
$ano = mysqli_real_escape_string($con, $_POST['ano']);

$sql = "SELECT YEAR('" . $ano . "-" . $mes . "-01') AS ano,MONTH('" . $ano . "-" . $mes . "-01') as mes ,DAY('" . $ano . "-" . $mes . "-01') AS dia, DAYOFMONTH(LAST_DAY('" . $ano . "-" . $mes . "-01')) AS dias ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$dia = $row['dias'];
$mes = $row['mes'];
$ano = $row['ano'];
$diasmes = $row['dias'];

$totaldias = "";
$tonelaje = "";
$guias = "";

//$tabla = "";

for ($j = 1; $j <= $diasmes; $j++) {
    $totaldias = $totaldias . "" . $j . "/" . $mes . ",";
    //$totaldias = $totaldias . $j . ",";
}

for ($i = 1; $i <= $dia; $i++) {

    $sql = "SELECT sum(tonelaje) as tonelaje, count(num_guia) as guias,fecha from guias_camiones where month(fecha) = " . $mes . " and year(fecha)=" . $ano . " and day(fecha)= " . $i . ";";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $totaltonelaje = $row['tonelaje'];
    $totalguias = $row['guias'];



    $tonelaje = $tonelaje . $totaltonelaje . ",";
    $guias = $guias . $totalguias . ",";
}

$tabla = "<div class=\"card\">
<div class=\"card-header\">
  <h5 class=\"card-title\"><b>Gráfico Tonelaje Diario</b></h5>
</div>
<div class=\"card-body\" style=\"height: 300px;\">
  <div class=\"chart\">


<input type=\"hidden\" class=\"form-control\" id=\"lista_equipos00\" name=\"lista_equipos00\" value=\"" . substr($totaldias, 0, -1) . "\">
<input type=\"hidden\" class=\"form-control\" id=\"lista_equipos33\" name=\"lista_equipos33\" value=\"" . substr($tonelaje, 0, -1) . "\">
<input type=\"hidden\" class=\"form-control\" id=\"diasmes2\" name=\"diasmes2\" value=\"" . $diasmes . "\">";
$tabla .= "<canvas id=\"areaChart2\" style=\"min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;\"></canvas>";
$tabla .= "  </div></div></div>";
echo $tabla;
?>

<script src="../../plugins/chart.js/Chart.min.js"></script>
<script src="../../dist/js/demo.js"></script>

<script>
    $(function() {
        var lista = document.getElementById("lista_equipos00").value;
        var list2 = lista.split(',');
        var lista3 = document.getElementById("lista_equipos33").value;
        var list3 = lista3.split(',');
        var diasmes = document.getElementById("diasmes2").value;
        var areaChartCanvas = $('#areaChart2').get(0).getContext('2d')

        if (diasmes == 30) {
            var areaChartData = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27], list2[28], list2[29]],
                datasets: [{
                    label: 'Tonelaje',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [list3[0], list3[1], list3[2], list3[3], list3[4], list3[5], list3[6], list3[7], list3[8], list3[9], list3[10], list3[11], list3[12], list3[13], list3[14], list3[15], list3[16], list3[17], list3[18], list3[19], list3[20], list3[21], list3[22], list3[23], list3[24], list3[25], list3[26], list3[27], list3[28], list3[29]]
                }, ]
            }


        } else if (diasmes == 31) {
            var areaChartData = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27], list2[28], list2[29], list2[30]],
                datasets: [{
                    label: 'Tonelaje',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [list3[0], list3[1], list3[2], list3[3], list3[4], list3[5], list3[6], list3[7], list3[8], list3[9], list3[10], list3[11], list3[12], list3[13], list3[14], list3[15], list3[16], list3[17], list3[18], list3[19], list3[20], list3[21], list3[22], list3[23], list3[24], list3[25], list3[26], list3[27], list3[28], list3[29], list3[30]]
                }, ]
            }

        } else if (diasmes == 28) {
            var areaChartData = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27]],
                datasets: [{
                    label: 'Tonelaje',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [list3[0], list3[1], list3[2], list3[3], list3[4], list3[5], list3[6], list3[7], list3[8], list3[9], list3[10], list3[11], list3[12], list3[13], list3[14], list3[15], list3[16], list3[17], list3[18], list3[19], list3[20], list3[21], list3[22], list3[23], list3[24], list3[25], list3[26], list3[27]]
                }, ]
            }


        } else if (diasmes == 29) {
            var areaChartData = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27], list2[28]],
                datasets: [{
                    label: 'Tonelaje',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [list3[0], list3[1], list3[2], list3[3], list3[4], list3[5], list3[6], list3[7], list3[8], list3[9], list3[10], list3[11], list3[12], list3[13], list3[14], list3[15], list3[16], list3[17], list3[18], list3[19], list3[20], list3[21], list3[22], list3[23], list3[24], list3[25], list3[26], list3[27], list3[28]]
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