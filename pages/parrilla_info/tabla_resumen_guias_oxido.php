<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$mes = $_POST['mes'];
$ano = $_POST['ano'];


$tabla = "";
$tabla = "<table id=\"example1\" class=\"table table-bordered table-striped\"><thead>    <tr>        <th>N°Guía</th> <th>Lote</th>        <th>Fecha</th>        <th>Mina</th>         <th>Patente</th>        <th>Chofer</th>         <th>Hora</th>     <th>Tonelaje</th>    </tr></thead><tbody>";



try {

    $sql = "SELECT gc.id_guia, gc.id_lote, gc.num_guia, gc.id_ubicacion,gc.fecha, gc.hora, gc.id_patente, gc.id_chofer, gc.tonelaje, gc.leyvis, um.nombre as mina, c.patente as patente, ch.nombre as chofer, l.num_lote 
    FROM guias_camiones  gc left join ubicaciones_minas um on gc.id_ubicacion= um.id_ubicacion left join camiones c on gc.id_patente = c.id_camion left join choferes ch on gc.id_chofer = ch.id_chofer inner join lotes l on gc.id_lote = l.id_lote where month(gc.fecha)= " . $mes . " and year(gc.fecha)=" . $ano . ";";
    foreach ($db->query($sql) as $row) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . $row['num_guia'] . "</td>";
        $tabla .= "<td>" . $row['num_lote'] . "</td>";
        $tabla .= "<td>" . date("d-m-Y", strtotime($row['fecha']))  . "</td>";
        $tabla .= "<td>" . $row['mina'] . "</td>";
        $tabla .= "<td>" . $row['patente'] . "</td>";
        $tabla .= "<td>" . $row['chofer'] . "</td>";
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