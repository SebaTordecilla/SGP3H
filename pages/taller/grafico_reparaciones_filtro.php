<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$mes = mysqli_real_escape_string($con, $_POST['mes_equipo']);
$ano = mysqli_real_escape_string($con, $_POST['ano_equipo']);
$id = mysqli_real_escape_string($con, $_POST['id_equipo']);


$cadena = "";
for ($i = 1; $i <= 5; $i++) {

    $sql = "SELECT count(rt.id_falla) as cantidad from reparacion_terreno rt 
    inner join salida_equipos se on rt.id_sal_equipo = se.id_sal_equipo  
    left join fallas_mecanicas fm on fm.id_falla = rt.id_falla
    left join categorias_fallas cf on cf.id_categoria = fm.categoria
    where month(se.fecha)= " . $mes . " and year(se.fecha)=" . $ano . " and cf.id_categoria= " . $i . " and se.id_equipo = " . $id . ";";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $Prueba = $row['cantidad'];

    $cadena = $cadena . $Prueba . ",";
}

$tabla = "<input type=\"hidden\" class=\"form-control\" id=\"cantidad_repa\" name=\"cantidad_repa\" value=" . substr($cadena, 0, -1) . ">";
$tabla .= "<div class=\"card card\"><div class=\"card-header\">    <h3 class=\"card-title\">Gráfico Reparaciones</h3></div><div class=\"card-body\" style=\"height: 300px;\">    <div class=\"chart\">        <canvas id=\"areaPie\" style=\"min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;\"></canvas>    </div></div></div>";

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
                'Neumáticos', 'Eléctricas', 'Motor', 'Carrocería', 'Otras'
            ],
            datasets: [{
                data: [list2[0], list2[1], list2[2], list2[3], list2[4]],
                // data: [5, 3, 4, 6, 1],
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