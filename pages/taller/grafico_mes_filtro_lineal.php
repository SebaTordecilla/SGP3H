<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();


$mes = mysqli_real_escape_string($con, $_POST['mes']);
$ano = mysqli_real_escape_string($con, $_POST['ano']);

$sql = "SELECT YEAR('" . $ano . "-" . $mes . "-01') AS ano,MONTH('" . $ano . "-" . $mes . "-01') as mes ,DAY('" . $ano . "-" . $mes . "-01') AS dia, DAYOFMONTH(LAST_DAY('" . $ano . "-" . $mes . "-01')) AS dias , (SELECT porcentaje from programa_mensual where mes = " . $mes . " and ano = " . $ano . ") as porcentaje;";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$dia = $row['dias'];
$mes = $row['mes'];
$ano = $row['ano'];
$diasmes = $row['dias'];
$porcentaje = $row['porcentaje'];

$totaldias = "";
$syc = "";
$dump = "";
$porce_mes_dia = "";
//$tabla = "";

for ($j = 1; $j <= $diasmes; $j++) {
    $totaldias = $totaldias . "" . $j . "/" . $mes . ",";
    //$totaldias = $totaldias . $j . ",";
    $porce_mes_dia = $porce_mes_dia . $porcentaje . ",";
}

for ($i = 1; $i <= $dia; $i++) {

    $sql = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo 
    where le.id_tequipo in (1,2) and le.id_est_equipo = 1 AND se.fecha = '" . $ano . "-" . $mes . "-" . $i . "') as segundos, 
    (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo 
    where le.id_tequipo in (5) and le.id_est_equipo = 1 AND se.fecha = '" . $ano . "-" . $mes . "-" . $i . "') as segundosdumper,
    (select count(le.id_tequipo) as totaldump FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
    INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo in (5) and le.id_est_equipo = 1 ) as totaldumper,
    count(le.id_tequipo) as total , 67 as programa
    FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
    INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo in (1,2) and le.id_est_equipo = 1 ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    // $totalsyc = $row['syc'] * 10;
    // $totaldump = $row['dump'] * 10;



    $cantequipos = $row['total'] - 2;
    $segdiarios = $row['segundos'];
    // $segmestotal2 = 10 * 3600 * $cantequipos;
    $segmestotal2 = 10 * 3600 * $cantequipos;

    $porcentajediarioflota = number_format(($segdiarios / $segmestotal2) * 100, 0, ',', '');

    $cantequiposdumper = $row['totaldumper'];
    $segdiariosdumper = $row['segundosdumper'];
    // $segmestotal2dumper = 10 * 3600 * $cantequiposdumper;
    $segmestotal2dumper = 10 * 3600 * $cantequiposdumper;
    $porcentajediarioflotadumper = number_format(($segdiariosdumper / $segmestotal2dumper) * 100, 0, ',', '');

    $syc = $syc . $porcentajediarioflota . ",";
    $dump = $dump . $porcentajediarioflotadumper . ",";
}
$tabla = "<div class=\"card\"><div class=\"card-header\">  <h5 class=\"card-title\">Gráfico Disponibilidad Mensual</h5></div><div class=\"card-body\" style=\height: 300px;\">  <div class=\"chart\">
<input type=\"hidden\" class=\"form-control\" id=\"lista_equipos\" name=\"lista_equipos\" value=\"" . substr($totaldias, 0, -1) . "\"><input type=\"hidden\" class=\"form-control\" id=\"lista_equipos3\" name=\"lista_equipos3\" value=\"" . substr($syc, 0, -1) . "\"><input type=\"hidden\" class=\"form-control\" id=\"lista_equipos4\" name=\"lista_equipos4\" value=\"" . substr($dump, 0, -1) . "\">
<input type=\"hidden\" class=\"form-control\" id=\"diasmes\" name=\"diasmes\" value=\"" . $diasmes . "\"><input type=\"hidden\" class=\"form-control\" id=\"lista_equipos99\" name=\"lista_equipos99\" value=\"" . substr($porce_mes_dia, 0, -1) . "\">";
$tabla .= "<canvas id=\"areaChart\" style=\"min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;\"></canvas>";
$tabla .= "</div></div></div>";
echo $tabla;
?>

<script src="../../plugins/chart.js/Chart.min.js"></script>
<script src="../../dist/js/demo.js"></script>

<script>
    $(function() {
        var lista = document.getElementById("lista_equipos").value;
        var list2 = lista.split(',');
        var lista3 = document.getElementById("lista_equipos3").value;
        var list3 = lista3.split(',');
        var lista4 = document.getElementById("lista_equipos4").value;
        var list4 = lista4.split(',');
        var lista5 = document.getElementById("lista_equipos99").value;
        var list5 = lista5.split(',');

        var diasmes = document.getElementById("diasmes").value;
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')


        if (diasmes == 30) {
            var areaChartData2 = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27], list2[28], list2[29]],
                datasets: [{
                        label: 'Flota LHD y Cargadores',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [list3[0], list3[1], list3[2], list3[3], list3[4], list3[5], list3[6], list3[7], list3[8], list3[9], list3[10], list3[11], list3[12], list3[13], list3[14], list3[15], list3[16], list3[17], list3[18], list3[19], list3[20], list3[21], list3[22], list3[23], list3[24], list3[25], list3[26], list3[27], list3[28], list3[29]]
                    }, {
                        label: 'Flota Dumpers',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [list4[0], list4[1], list4[2], list4[3], list4[4], list4[5], list4[6], list4[7], list4[8], list4[9], list4[10], list4[11], list4[12], list4[13], list4[14], list4[15], list4[16], list4[17], list4[18], list4[19], list4[20], list4[21], list4[22], list4[23], list4[24], list4[25], list4[26], list4[27], list4[28], list4[29]]
                    },
                    {
                        label: 'Programa',
                        backgroundColor: 'rgba(255, 0, 0, 1)',
                        borderColor: 'rgba(255, 0, 0, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(255, 0, 0, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(255, 0, 0, 1)',
                        data: [list5[0], list5[1], list5[2], list5[3], list5[4], list5[5], list5[6], list5[7], list5[8], list5[9], list5[10], list5[11], list5[12], list5[13], list5[14], list5[15], list5[16], list5[17], list5[18], list5[19], list5[20], list5[21], list5[22], list5[23], list5[24], list5[25], list5[26], list5[27], list5[28], list5[29]]
                    },
                ]
            }


        } else if (diasmes == 31) {

            var areaChartData2 = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27], list2[28], list2[29], list2[30]],
                datasets: [{
                        label: 'Flota LHD y Cargadores',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [list3[0], list3[1], list3[2], list3[3], list3[4], list3[5], list3[6], list3[7], list3[8], list3[9], list3[10], list3[11], list3[12], list3[13], list3[14], list3[15], list3[16], list3[17], list3[18], list3[19], list3[20], list3[21], list3[22], list3[23], list3[24], list3[25], list3[26], list3[27], list3[28], list3[29], list3[30]]
                    }, {
                        label: 'Flota Dumpers',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [list4[0], list4[1], list4[2], list4[3], list4[4], list4[5], list4[6], list4[7], list4[8], list4[9], list4[10], list4[11], list4[12], list4[13], list4[14], list4[15], list4[16], list4[17], list4[18], list4[19], list4[20], list4[21], list4[22], list4[23], list4[24], list4[25], list4[26], list4[27], list4[28], list4[29], list4[30]]
                    },
                    {
                        label: 'Programa',
                        backgroundColor: 'rgba(255, 0, 0, 1)',
                        borderColor: 'rgba(255, 0, 0, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(255, 0, 0, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(255, 0, 0, 1)',
                        data: [list5[0], list5[1], list5[2], list5[3], list5[4], list5[5], list5[6], list5[7], list5[8], list5[9], list5[10], list5[11], list5[12], list5[13], list5[14], list5[15], list5[16], list5[17], list5[18], list5[19], list5[20], list5[21], list5[22], list5[23], list5[24], list5[25], list5[26], list5[27], list5[28], list5[29], list5[30]]
                    },
                ]
            }

        } else if (diasmes == 29) {
            var areaChartData2 = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27], list2[28]],
                datasets: [{
                        label: 'Flota LHD y Cargadores',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [list3[0], list3[1], list3[2], list3[3], list3[4], list3[5], list3[6], list3[7], list3[8], list3[9], list3[10], list3[11], list3[12], list3[13], list3[14], list3[15], list3[16], list3[17], list3[18], list3[19], list3[20], list3[21], list3[22], list3[23], list3[24], list3[25], list3[26], list3[27], list3[28]]
                    }, {
                        label: 'Flota Dumpers',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [list4[0], list4[1], list4[2], list4[3], list4[4], list4[5], list4[6], list4[7], list4[8], list4[9], list4[10], list4[11], list4[12], list4[13], list4[14], list4[15], list4[16], list4[17], list4[18], list4[19], list4[20], list4[21], list4[22], list4[23], list4[24], list4[25], list4[26], list4[27], list4[28]]
                    },
                    {
                        label: 'Programa',
                        backgroundColor: 'rgba(255, 0, 0, 1)',
                        borderColor: 'rgba(255, 0, 0, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(255, 0, 0, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(255, 0, 0, 1)',
                        data: [list5[0], list5[1], list5[2], list5[3], list5[4], list5[5], list5[6], list5[7], list5[8], list5[9], list5[10], list5[11], list5[12], list5[13], list5[14], list5[15], list5[16], list5[17], list5[18], list5[19], list5[20], list5[21], list5[22], list5[23], list5[24], list5[25], list5[26], list5[27], list5[28]]
                    },
                ]
            }


        } else if (diasmes == 28) {
            var areaChartData2 = {
                labels: [list2[0], list2[1], list2[2], list2[3], list2[4], list2[5], list2[6], list2[7], list2[8], list2[9], list2[10], list2[11], list2[12], list2[13], list2[14], list2[15], list2[16], list2[17], list2[18], list2[19], list2[20], list2[21], list2[22], list2[23], list2[24], list2[25], list2[26], list2[27]],
                datasets: [{
                        label: 'Flota LHD y Cargadores',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [list3[0], list3[1], list3[2], list3[3], list3[4], list3[5], list3[6], list3[7], list3[8], list3[9], list3[10], list3[11], list3[12], list3[13], list3[14], list3[15], list3[16], list3[17], list3[18], list3[19], list3[20], list3[21], list3[22], list3[23], list3[24], list3[25], list3[26], list3[27]]
                    }, {
                        label: 'Flota Dumpers',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [list4[0], list4[1], list4[2], list4[3], list4[4], list4[5], list4[6], list4[7], list4[8], list4[9], list4[10], list4[11], list4[12], list4[13], list4[14], list4[15], list4[16], list4[17], list4[18], list4[19], list4[20], list4[21], list4[22], list4[23], list4[24], list4[25], list4[26], list4[27]]
                    },
                    {
                        label: 'Programa',
                        backgroundColor: 'rgba(255, 0, 0, 1)',
                        borderColor: 'rgba(255, 0, 0, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(255, 0, 0, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(255, 0, 0, 1)',
                        data: [list5[0], list5[1], list5[2], list5[3], list5[4], list5[5], list5[6], list5[7], list5[8], list5[9], list5[10], list5[11], list5[12], list5[13], list5[14], list5[15], list5[16], list5[17], list5[18], list5[19], list5[20], list5[21], list5[22], list5[23], list5[24], list5[25], list5[26], list5[27]]
                    },
                ]
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


        var areaChartOptions = $.extend(true, {}, areaChartOptions)
        var areaChartData2 = $.extend(true, {}, areaChartData2)
        areaChartData2.datasets[0].fill = false;
        areaChartData2.datasets[1].fill = false;
        areaChartData2.datasets[2].fill = false;
        areaChartOptions.datasetFill = false

        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData2,
            options: areaChartOptions
        })


    })
</script>