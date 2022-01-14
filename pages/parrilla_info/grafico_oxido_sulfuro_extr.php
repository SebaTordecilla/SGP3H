<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$mes = mysqli_real_escape_string($con, $_POST['mes']);
$ano = mysqli_real_escape_string($con, $_POST['ano']);


$cadena = "";
for ($i = 1; $i <= 3; $i++) {

    $sql = "SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) as tipo FROM extraccion_mineral where month(fecha) = " . $mes . " and year(fecha)=" . $ano . "   and estado = 2 and id_mineral = " . $i . " ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $Prueba = $row['tipo'];

    $cadena = $cadena . $Prueba . ",";
}

$tabla = "<input type=\"hidden\" class=\"form-control\" id=\"cantidad_repa\" name=\"cantidad_repa\" value=" . substr($cadena, 0, -1) . ">";
$tabla .= "<div class=\"card card\"><div class=\"card-header\">    <h3 class=\"card-title\"><b>Óxido y Sulfuro</b></h3></div><div class=\"card-body\" style=\"height: 300px;\">    <div class=\"chart\">        <canvas id=\"areaPie\" style=\"min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;\"></canvas>    </div></div></div>";

echo $tabla;

?>


<script src="../../plugins/chart.js/Chart.min.js"></script>
<script src="../../dist/js/demo.js"></script>

<script>
    $(function() {
        var lista = document.getElementById("cantidad_repa").value;
        var list2 = lista.split(',');

        var areaChartCanvas = $('#areaPie').get(0).getContext('2d')
        var areaChartData = {

            labels: [
                'Óxido', 'Sulfuro','Esteril'
            ],
            datasets: [{
                data: [list2[0], list2[1], list2[2]],
                // data: [5, 3, 4, 6, 1],
                backgroundColor: ['#00a65a', '#f56954', '#A9B3B4'],
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