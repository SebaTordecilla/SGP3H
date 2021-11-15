<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();
/*
$id_equipo = mysqli_real_escape_string($con, $_POST['id_equipo']);
$mes_informe = mysqli_real_escape_string($con, $_POST['mes_equipo']);
$ano_informe = mysqli_real_escape_string($con, $_POST['ano_equipo']);

$sql = "SELECT DAYOFMONTH(LAST_DAY('2021-10-01')) as dias;";
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
}*/

?>
<!--<input type="hidden" class="form-control" id="lista_equipos" name="lista_equipos" value="<?php echo substr($cadena, 0, -1) ?>">
<input type="hidden" class="form-control" id="lista_equipos3" name="lista_equipos3" value="<?php echo substr($cadena2, 0, -1) ?>">-->



<div class="card card">
    <div class="card-header">
        <h3 class="card-title">Gráfico Reparaciones</h3>
    </div>
    <div class="card-body" style="height: 300px;">
        <div class="chart">
            <canvas id="areaPie" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>





<script src="../../plugins/chart.js/Chart.min.js"></script>
<script src="../../dist/js/demo.js"></script>

<script>
    $(function() {

        var areaChartCanvas = $('#areaPie').get(0).getContext('2d')
        var areaChartData = {

            labels: [
                'Neumáticos', 'Electricas', 'Motor', 'Carroceria', 'Frenos', 'Cables'
            ],
            datasets: [{
                data: [5, 3, 4, 6, 1, 7],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]

        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: false,
            legend: {
                display: true
            }
        }

        // This will get the first returned node in the jQuery collection.
        new Chart(areaChartCanvas, {
            type: 'pie',
            data: areaChartData,
            options: areaChartOptions
        })

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
        var lineChartOptions = $.extend(true, {}, areaChartOptions)
        var lineChartData = $.extend(true, {}, areaChartData)
        lineChartData.datasets[0].fill = false;
        //lineChartData.datasets[1].fill = false;
        lineChartOptions.datasetFill = false


        var lineChart = new Chart(lineChartCanvas, {
            type: 'pie',
            data: lineChartData,
            options: lineChartOptions
        })
    })
</script>