<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$fecha = mysqli_real_escape_string($con, $_POST['fecha']);


if ($fecha == "") {
    echo "Sin Información ";
} else {
    $tabla = "<div class=\"col-12\"><div class=\"card card\"><div class=\"card-header\"><h3 class=\"card-title\">Tabla Diaria</h3></div><div class=\"card-body\">";
    $tabla .= "<table id=\"example1\" class=\"table table-head-fixed text-nowrap\">";
    $tabla .= "<thead><tr><th>Cod.</th><th>Tipo</th><th>I.Jornada</th><th>F.Jornada</th><th>N°Rep</th><th> </th> <th> </th></tr></thead>";


    $sql = "SELECT se.id_equipo,se.id_sal_equipo,le.sigla as cod, te.nombre as tipo, se.fecha, se.hora_inicio, se.hora_fin, count(rt.id_rep_ter) as repa
    from salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo inner join tipos_equipos te on le.id_tequipo = te.id_tequipo
    left join reparacion_terreno rt on se.id_sal_equipo = rt.id_sal_equipo
    where se.fecha = '" . $fecha . "' group by se.id_sal_equipo";
    foreach ($db->query($sql) as $row) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . $row['cod'] . "</td>";
        $tabla .= "<td>" . $row['tipo'] . "</td>";
        $tabla .= "<td>" . $row['hora_inicio'] . "</td>";
        $tabla .= "<td>" . $row['hora_fin'] . "</td>";
        $tabla .= "<td>" . $row['repa'] . "</td>";
        $tabla .= "<td><a href=\"#\"  onclick=\"  getRepa('" . $row['id_sal_equipo'] . "');modal_repa_diario()\"><small class=\"badge badge-danger\">Detalles</small></td>";
        $tabla .= "<td><a href=\"#\"  onclick=\"  getRepa_ingreso('" . $row['id_sal_equipo'] . "')\"><small class=\"badge badge-primary\">Ingresar</small></td>";
        $tabla .= "</tr>";
    }


    $tabla .= "</table>";
    $tabla .= "</div></div>";
    echo $tabla;
}

?>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            //"buttons": ["excel"]
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