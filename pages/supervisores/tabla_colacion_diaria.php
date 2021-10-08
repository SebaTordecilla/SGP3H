<?php
include('../../conexion.php');
$fecha = $_POST['fecha'];

if ($fecha == "") {

    $resultado = $mysqli->query("SELECT se.id_ubicacion,um.nombre,se.fecha ,COUNT(id_equipo) as cantidad, IF(se.hora_ini_col ='00:00:00' and se.hora_fin_col ='00:00:00','SIN REGISTRO', IF(se.hora_ini_col != '00:00:00' and se.hora_fin_col ='00:00:00','EN COLACIÓN',IF(se.hora_ini_col != '00:00:00' and se.hora_fin_col is not null,'RETORNO A FAENA','ERROR'))) as estado, se.hora_ini_col,se.hora_fin_col FROM salida_equipos se INNER JOIN ubicaciones_minas um on se.id_ubicacion = um.id_ubicacion WHERE fecha = CURDATE() GROUP by se.id_ubicacion;");

    $total = $resultado->num_rows;

    if ($total > 0) {
        $tabla = "<table id=\"example1\" class=\"table table-sm\">";
        $tabla .= "<thead><tr><th>Mina</th><th>Estado</th></tr></thead>";

        while ($row = $resultado->fetch_assoc()) {
            $estado = $row['estado'];
            if ($estado == 'RETORNO A FAENA') {
                $tabla .= "<tr>";
                $tabla .= "<td>" . $row['nombre'] . "  <span class=\"badge bg-success\">" . $row['cantidad'] . "</span></td>";
                $tabla .= "<td align=\"center\"><a href=\"#\" style=\"color:black\" onclick=\"  getDetails('" . $row['id_ubicacion'] . "','" . $row['fecha'] . "');horario_colacion()\"><small class=\"badge badge-secondary\"> " . $row['estado'] . "</small></a></td>";
                $tabla .= "</tr>";
            } else if ($estado == 'EN COLACIÓN') {
                $tabla .= "<tr>";
                $tabla .= "<td>" . $row['nombre'] . "  <span class=\"badge bg-success\">" . $row['cantidad'] . "</span></td>";
                $tabla .= "<td align=\"center\"><a href=\"#\" style=\"color:black\" onclick=\"  getDetails('" . $row['id_ubicacion'] . "','" . $row['fecha'] . "');horario_colacion()\"><small class=\"badge badge-success\"> " . $row['estado'] . "</small></a></td>";
                $tabla .= "</tr>";
            } else if ($estado == 'SIN REGISTRO') {
                $tabla .= "<tr>";
                $tabla .= "<td>" . $row['nombre'] . "  <span class=\"badge bg-success\">" . $row['cantidad'] . "</span></td>";
                $tabla .= "<td align=\"center\"><a href=\"#\" style=\"color:black\" onclick=\"  getDetails('" . $row['id_ubicacion'] . "','" . $row['fecha'] . "');horario_colacion()\"><small class=\"badge badge-info\"> " . $row['estado'] . "</small></a></td>";
                $tabla .= "</tr>";
            } else {
                $tabla .= "<tr>";
                $tabla .= "<td>" . $row['nombre'] . "  <span class=\"badge bg-success\">" . $row['cantidad'] . "</span></td>";
                $tabla .= "<td align=\"center\"><a href=\"#\" style=\"color:black\" onclick=\"  getDetails('" . $row['id_ubicacion'] . "','" . $row['fecha'] . "');horario_colacion()\"><small class=\"badge badge-danger\"> " . $row['estado'] . "</small></a></td>";
                $tabla .= "</tr>";
            }
        }
        $tabla .= "</table>";
        echo $tabla;
    } else {
        echo "Sin Información";
    }
} else {

    $resultado = $mysqli->query("SELECT se.id_ubicacion,um.nombre,se.fecha ,COUNT(id_equipo) as cantidad, IF(se.hora_ini_col ='00:00:00' and se.hora_fin_col ='00:00:00','SIN REGISTRO', IF(se.hora_ini_col != '00:00:00' and se.hora_fin_col ='00:00:00','EN COLACIÓN',IF(se.hora_ini_col != '00:00:00' and se.hora_fin_col is not null,'RETORNO A FAENA','ERROR'))) as estado, se.hora_ini_col,se.hora_fin_col FROM salida_equipos se INNER JOIN ubicaciones_minas um on se.id_ubicacion = um.id_ubicacion WHERE fecha = '" . $fecha . "' GROUP by se.id_ubicacion;");

    $total = $resultado->num_rows;

    if ($total > 0) {
        $tabla = "<table id=\"example1\" class=\"table table-sm\">";
        $tabla .= "<thead><tr><th>Mina</th><th>Estado</th></tr></thead>";

        while ($row = $resultado->fetch_assoc()) {
            $estado = $row['estado'];
            if ($estado == 'RETORNO A FAENA') {
                $tabla .= "<tr>";
                $tabla .= "<td>" . $row['nombre'] . "  <span class=\"badge bg-success\">" . $row['cantidad'] . "</span></td>";
                $tabla .= "<td align=\"center\"><a href=\"#\" style=\"color:black\" onclick=\"  getDetails('" . $row['id_ubicacion'] . "','" . $row['fecha'] . "');horario_colacion()\"><small class=\"badge badge-secondary\"> " . $row['estado'] . "</small></a></td>";
                $tabla .= "</tr>";
            } else if ($estado == 'EN COLACIÓN') {
                $tabla .= "<tr>";
                $tabla .= "<td>" . $row['nombre'] . "  <span class=\"badge bg-success\">" . $row['cantidad'] . "</span></td>";
                $tabla .= "<td align=\"center\"><a href=\"#\" style=\"color:black\" onclick=\"  getDetails('" . $row['id_ubicacion'] . "','" . $row['fecha'] . "');horario_colacion()\"><small class=\"badge badge-success\"> " . $row['estado'] . "</small></a></td>";
                $tabla .= "</tr>";
            } else if ($estado == 'SIN REGISTRO') {
                $tabla .= "<tr>";
                $tabla .= "<td>" . $row['nombre'] . "  <span class=\"badge bg-success\">" . $row['cantidad'] . "</span></td>";
                $tabla .= "<td align=\"center\"><a href=\"#\" style=\"color:black\" onclick=\"  getDetails('" . $row['id_ubicacion'] . "','" . $row['fecha'] . "');horario_colacion()\"><small class=\"badge badge-info\"> " . $row['estado'] . "</small></a></td>";
                $tabla .= "</tr>";
            } else {
                $tabla .= "<tr>";
                $tabla .= "<td>" . $row['nombre'] . "  <span class=\"badge bg-success\">" . $row['cantidad'] . "</span></td>";
                $tabla .= "<td align=\"center\"><a href=\"#\" style=\"color:black\" onclick=\"  getDetails('" . $row['id_ubicacion'] . "','" . $row['fecha'] . "');horario_colacion()\"><small class=\"badge badge-danger\"> " . $row['estado'] . "</small></a></td>";
                $tabla .= "</tr>";
            }
        }
        $tabla .= "</table>";
        echo $tabla;
    } else {
        echo "Sin Información";
    }
}
