<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$mes = $_POST['mes'];
$ano = $_POST['ano'];


$tabla = "";
$tabla = "<table id=\"example1\" class=\"table table-bordered table-striped\"><thead>    <tr>        <th>N°</th>        <th>Fecha</th>        <th>N°Guía</th>        <th>Responsable</th>        <th>Patente</th>        <th>Chofer</th>        <th>Sector</th>   <th>Hora</th>     <th>Tonelaje</th>    </tr></thead><tbody>";



try {

    $sql = "SELECT vf.id_sulf, vf.num, vf.fecha, vf.num_guia, vf.id_responsable, vf.id_patente, vf.id_chofer, vf.sector, vf.hora, vf.tonelaje, c.patente, ch.nombre as chofer, upper(o.nombre) as responsable
    FROM viajes_sulfuro vf left join camiones c on vf.id_patente = c.id_camion left join choferes ch on ch.id_chofer = vf.id_chofer left join operadores o on vf.id_responsable = o.id_op
    where vf.estado in (1,2) and month(vf.fecha) = " . $mes . " and year(vf.fecha) = " . $ano . " order by vf.num asc";
    foreach ($db->query($sql) as $row) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . $row['num'] . "</td>";
        $tabla .= "<td>" . date("d-m-Y", strtotime($row['fecha']))  . "</td>";
        $tabla .= "<td>" . $row['num_guia'] . "</td>";
        $tabla .= "<td>" . $row['responsable'] . "</td>";
        $tabla .= "<td>" . $row['patente'] . "</td>";
        $tabla .= "<td>" . $row['chofer'] . "</td>";
        $tabla .= "<td>" . $row['sector'] . "</td>";
        $tabla .= "<td>" . $row['hora'] . "</td>";
        $tabla .= "<td>" . number_format($row['tonelaje'], 0, ",", ".") . "</td>";
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