<?php
include('../../conexion.php');
$fecha = $_POST['fecha'];
if ($fecha == "") {

    $resultado = $mysqli->query("SELECT se.id_sal_equipo as id,DATE_FORMAT(se.fecha,'%d/%m/%Y') as fecha, IF(se.id_estado_diario=1,IF(rt.id_est_equipo=8,'MECANICO','OPERATIVO'),'CERRADO') as estado ,le.sigla as codigo, te.nombre as equipo FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo=te.id_tequipo LEFT JOIN reparacion_terreno rt on se.id_sal_equipo = rt.id_sal_equipo WHERE se.fecha = CURDATE();");

    $total = $resultado->num_rows;

    if ($total > 0) {
        $tabla = "<table id=\"example1\" class=\"table table-sm\">";
        $tabla .= "<thead><tr><th>Codigo</th><th>Tipo</th><th>Estado</th></tr></thead>";
        while ($row = $resultado->fetch_assoc()) {
            
            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['codigo'] . "</td>";
            $tabla .= "<td>" . $row['equipo'] . "</td>";
            $tabla .= "<td>" . $row['estado'] . "</td>";
            $tabla .= "<td><a href=\"#\"  onclick=\"  getDetails2('" . $row['id'] . "');sol_mecanico()\"><small class=\"badge badge-danger\">Sol. Mecánico</small></a></td>";
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
        echo $tabla;
    } else {
        echo "Sin Información";
    }
} else if ($fecha != "") {
    //echo "Sin Información";
    $resultado = $mysqli->query("SELECT se.id_sal_equipo as id,DATE_FORMAT(se.fecha,'%d/%m/%Y') as fecha, IF(se.id_estado_diario=1,IF(rt.id_est_equipo=8,'MECANICO','OPERATIVO'),'CERRADO') as estado ,le.sigla as codigo, te.nombre as equipo FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo=te.id_tequipo LEFT JOIN reparacion_terreno rt on se.id_sal_equipo = rt.id_sal_equipo WHERE se.fecha = '" . $fecha . "';");

    $total = $resultado->num_rows;

    if ($total > 0) {
        $tabla = "<table id=\"example1\" class=\"table table-sm\">";
        $tabla .= "<thead><tr><th>Codigo</th><th>Tipo</th><th>Estado</th></tr></thead>";
        while ($row = $resultado->fetch_assoc()) {
            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['codigo'] . "</td>";
            $tabla .= "<td>" . $row['equipo'] . "</td>";
            $tabla .= "<td>" . $row['estado'] . "</td>";
            $tabla .= "<td><a href=\"#\"  onclick=\"  getDetails2('" . $row['id'] . "');sol_mecanico()\"><small class=\"badge badge-danger\">Sol. Mecánico</small></a></td>";
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
        echo $tabla;
    } else {
        echo "Sin Información";
    }
}
