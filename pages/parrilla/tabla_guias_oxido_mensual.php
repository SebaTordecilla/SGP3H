<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();
$id_lote = $_POST['id_lote'];
$resultado = $mysqli->query("SELECT gc.id_guia, gc.id_lote, gc.num_guia, gc.id_ubicacion,gc.fecha, gc.hora, gc.id_patente, gc.id_chofer, gc.tonelaje, gc.leyvis, um.nombre as mina, c.patente as patente, ch.nombre as chofer 
FROM guias_camiones  gc left join ubicaciones_minas um on gc.id_ubicacion= um.id_ubicacion left join camiones c on gc.id_patente = c.id_camion left join choferes ch on gc.id_chofer = ch.id_chofer where gc.id_lote = " . $id_lote . ";");
$total = $resultado->num_rows;
$tabla = "";
if ($total > 0) {
    $tabla = "<table id=\"example1\" class=\"table table-sm\">";
    $tabla .= "<thead><tr><th>N°Guía</th><th>Fecha</th><th>Hora</th><th>Mina</th><th>Patente</th><th>Chofer</th><th>Tonelaje</th><th>LeyVis</th></tr></thead>";
    while ($row = $resultado->fetch_assoc()) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . $row['num_guia'] . "</td>";
        $tabla .= "<td>" . date("d-m-Y", strtotime($row['fecha'])) . "</td>";
        $tabla .= "<td>" . $row['hora'] . "</td>";
        $tabla .= "<td>" . $row['mina'] . "</td>";
        $tabla .= "<td>" . $row['patente'] . "</td>";
        $tabla .= "<td>" . $row['chofer'] . "</td>";
        $tabla .= "<td>" . number_format($row['tonelaje'], 0, ",", ".") . "</td>";
        $tabla .= "<td>" . $row['leyvis'] . "</td>";
        $tabla .= "</tr>";
    }

    $sql_query = "SELECT sum(gc.tonelaje) as tonelaje, FORMAT(avg(gc.leyvis),2) as promedio FROM lotes lo 
    inner join empresas_lotes el on lo.id_emplot = el.id_emplot left join guias_camiones gc on
    lo.id_lote = gc.id_lote where lo.id_lote = " . $id_lote . " and lo.estado in (1,2) group by lo.id_lote";
    $result = mysqli_query($con, $sql_query);
    $row0 = mysqli_fetch_array($result);
    $ton_total = number_format($row0['tonelaje'], 0, ",", ".");
    $promedio = $row0['promedio'];

    $tabla .= "<tfoot><tr><th></th><th></th><th></th><th></th><th></th><th></th><th>" . $ton_total . "</th><th>" . $promedio . "</th></tr></tfoot>";
    $tabla .= "</table>";
    echo $tabla;
}
