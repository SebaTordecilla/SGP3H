<?php
include('../../conexion.php');
$fecha = $_POST['fecha'];
$id_ubicacion = $_POST['id_ubicacion'];
if ($fecha != "" && $id_ubicacion != "") {
    $resultado = $mysqli->query("SELECT le.sigla as codigo, se.hora_inicio FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo WHERE se.fecha = '" . $fecha . "' and se.id_ubicacion = " . $id_ubicacion . ";");

    $total = $resultado->num_rows;

    if ($total > 0) {
        $tabla = "<table id=\"example1\" class=\"table table-sm\">";
        $tabla .= "<thead><tr><th>Mina</th><th>Hora_inicio</th></tr></thead>";
        while ($row = $resultado->fetch_assoc()) {
            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['codigo'] . "  <span class=\"badge bg-success\">" . "</span></td>";
            $tabla .= "<td><a href=\"#\"  onclick=\"  getDetails2('" . $row['codigo'] . "','" . $row['hora_inicio'] . "');horario_colacion()\">" . $row['hora_inicio'] . "</a></td>";
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
        echo $tabla;
    } else {
        echo "Sin Información";
    }
} else {
    echo "Sin Información";
}
