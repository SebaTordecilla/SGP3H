<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$id_equipo = mysqli_real_escape_string($con, $_POST['id_equipo']);
$mes_informe = mysqli_real_escape_string($con, $_POST['mes_equipo']);
$ano_informe = mysqli_real_escape_string($con, $_POST['ano_equipo']);

$sql = "SELECT DAYOFMONTH(LAST_DAY('" . $ano_informe . "-" . $mes_informe . "-01')) as dias;";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$totaldias = $row['dias'];
$cadena = "";
$cadena2 = "";
for ($i = 1; $i <= $totaldias; $i++) {

    $cadena = $cadena . $i . ",";

    $sql = "SELECT TIME_TO_SEC(hora_total) as final FROM salida_equipos WHERE id_equipo = " . $id_equipo . " and fecha = '" . $ano_informe . "-" . $mes_informe . "-" . $i . "';";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $Prueba = number_format($row['final'] / 3600, 2, '.', '');

    if ($Prueba == '') {
        $cadena2 = $cadena2 . "0,";
    } else {
        $cadena2 = $cadena2 . $Prueba . ",";
    }
}

?>
<input type="hidden" class="form-control" id="lista_equipos" name="lista_equipos" value="<?php echo substr($cadena, 0, -1) ?>">
<input type="hidden" class="form-control" id="lista_equipos3" name="lista_equipos3" value="<?php echo substr($cadena2, 0, -1) ?>">



<div class="card card">
    <div class="card-header">
        <h3 class="card-title">Gráfico Mensual Horas Trabajadas</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            <!--<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>-->

        </div>
    </div>
</div>





<script src="../../plugins/chart.js/Chart.min.js"></script>
<script src="../../dist/js/demo.js"></script>

<script>
    $(function() {
        var lista = document.getElementById("lista_equipos").value;
        var list2 = lista.split(',');

        var lista3 = document.getElementById("lista_equipos3").value;
        var list3 = lista3.split(',');


        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
        var areaChartData = {
            labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27], list2[28], list2[29], list2[30]],

            datasets: [{
                label: 'Activo',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [list3[0], list3[1], list3[2], list3[3], list3[4], list3[5], list3[6], list3[7], list3[8], list3[9], list3[10], list3[11], list3[12], list3[13], list3[14], list3[15], list3[16], list3[17], list3[18], list3[19], list3[20], list3[21], list3[22], list3[23], list3[24], list3[25], list3[26], list3[27], list3[28], list3[29], list3[30]]
            }, {
                label: '',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
            }, ]
        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: true,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: true,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        new Chart(areaChartCanvas, {
            type: 'bar',
            data: areaChartData,
            options: areaChartOptions
        })




    })
</script>