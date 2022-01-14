<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$mes = $_POST['mes'];
$ano = $_POST['ano'];

$tabla = "";
$tabla = "<table id=\"example1\" class=\"table table-bordered table-striped\"><thead><tr><th>N°SOL.</th><th>SOLICITADO</th><th>FECHA</th><th>ÁREA</th><th>PRIORIDAD</th><th>Art.Sol</th><th>Art.OC</th><th>Estado</th><th>%</th><th></th></tr></thead><tbody>";

$sql = "SELECT id_pedido FROM solicitudes_compra where estado in(1,2,3) and month(fecha)= '" . $mes . "' and year(fecha)='" . $ano . "';";
foreach ($db->query($sql) as $row) {

    $tabla .= "<td>" . $row['id_pedido'] . "</td>";
    $sql = "SELECT sc.id_solicitud,sc.area ,sc.id_pedido, upper(sc.solicitado) as solicitado, sc.hora, sc.fecha, a.nombre as area1, sc.prioridad, sc.justificacion,if(sc.estado =3,'CERRADO','ABIERTO') AS statusi 
            , count(oc.id_oc) as num_oc,(SELECT sum(a.cantidad)  FROM solicitudes_compra sc left join articulos_solicitados a on sc.id_pedido = a.id_pedido where sc.id_pedido = " . $row['id_pedido'] . ") as cant_sol,
            (SELECT sum(aoc.cantidad) FROM solicitudes_compra sc left join articulos_oc aoc on sc.id_pedido = aoc.id_pedido where sc.id_pedido = " . $row['id_pedido'] . ") as cant_oc
            FROM solicitudes_compra sc inner join areas3h a on sc.area = a.id_area left join ordenes_compras oc on sc.id_pedido = oc.id_pedido
            where sc.estado in(1,2,3) and sc.id_pedido = " . $row['id_pedido'] . ";";
    foreach ($db->query($sql) as $row) {

        $tabla .= "<td>" . $row['solicitado'] . "</td>";
        $tabla .= "<td>" .  date("d/m/Y", strtotime($row['fecha']))  . "</td>";
        $tabla .= "<td>" . $row['area1'] . "</td>";
        $tabla .= "<td>" . $row['prioridad'] . "</td>";
        $tabla .= "<td>" . $row['cant_sol'] . "</td>";
        $tabla .= "<td>" . $row['cant_oc'] . "</td>";
        if ($row['statusi'] == 'CERRADO') {
            $tabla .= "<td style=\"color:#B31C1C\">" . $row['statusi'] . "</td>";
        } else {
            $tabla .= "<td style=\"color:#188B0E \">" . $row['statusi'] . "</td>";
        }
        if ($row['cant_sol'] == '') {
            $tabla .= "<td>" . number_format((($row['cant_oc']) / 1) * 100, 0, ",", ".") . "%</td>";
        } else {
            $tabla .= "<td>" . number_format((($row['cant_oc']) / ($row['cant_sol'])) * 100, 0, ",", ".") . "%</td>";
        }
        $tabla .= "<td align=\"center\"><a href=\"#\" onclick=\"pdf_sol('" . $row['id_pedido'] . "')\"><small class=\"badge badge-danger\">pdf</small></a>
            <a href=\"#\" onclick=\"oc_sol('" . $row['id_pedido'] . "')\"><small class=\"badge badge-success\">OC</small></a></td>";
        $tabla .= "</tr>";
    }
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