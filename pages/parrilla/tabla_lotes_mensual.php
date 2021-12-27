<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$mes = $_POST['mes'];
$ano = $_POST['ano'];


$tabla = "";
$tabla = "<table id=\"example1\" class=\"table table-bordered table-striped\"><thead>    <tr>        <th>Lote</th>        <th>Empresa</th>        <th>Penosa</th>        <th>Patricia</th>        <th>Cajon</th>        <th>Tonelaje</th>        <th>LeyVisual</th>   <th>Estado</th>     <th></th>    </tr></thead><tbody>";



try {
    $sql1 = "SELECT id_lote FROM lotes where  mes = " . $mes . " and ano = " . $ano . ";";
    foreach ($db->query($sql1) as $row1) {
        $num = $row1['id_lote'];
        $sql = "SELECT lo.id_lote, lo.num_lote, lo.id_emplot, lo.mes, lo.ano,el.nombre as empresa , sum(if(gc.id_ubicacion =1,1,0)) as penosa,sum(if(gc.id_ubicacion =3,1,0)) as patricia, sum(if(gc.id_ubicacion =5,1,0)) as cajon, sum(gc.tonelaje) as tonelaje, FORMAT(avg(gc.leyvis),2) as promedio, if(lo.estado = 1,'ABIERTO','CERRADO') as estado FROM lotes lo 
            inner join empresas_lotes el on lo.id_emplot = el.id_emplot left join guias_camiones gc on
            lo.id_lote = gc.id_lote where lo.id_lote = " . $num . " group by lo.id_lote ;";
        foreach ($db->query($sql) as $row) {
            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['num_lote'] . "</td>";
            $tabla .= "<td>" . $row['empresa'] . "</td>";
            $tabla .= "<td>" . $row['penosa'] . "</td>";
            $tabla .= "<td>" . $row['patricia'] . "</td>";
            $tabla .= "<td>" . $row['cajon'] . "</td>";
            $tabla .= "<td>" . number_format($row['tonelaje'], 0, ",", ".") . "</td>";
            $tabla .= "<td>" . $row['promedio'] . "</td>";
            $tabla .= "<td>" . $row['estado'] . "</td>";
            $tabla .= "<td align=\"center\"><a href=\"#\" onclick=\"guias_lote_mensual('" . $row['id_lote'] . "')\"><small class=\"badge badge-info\">Guias</small></a></td>";
        }
    }
} catch (PDOException $e) {
    echo "Existen problemas con la conexión: " . $e->getMessage();
}

$tabla .= "</tbody></table>";

echo $tabla;

//close connection
$database->close();

?>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>