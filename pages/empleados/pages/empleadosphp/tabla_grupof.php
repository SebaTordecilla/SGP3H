<?php
include('../../conexion.php');
$id_empleado = $_POST['id_empleado'];


$resultado = $mysqli->query("SELECT * FROM grupo_familiar where id_empleado = " . $id_empleado . ";");

$total = $resultado->num_rows;

if ($total > 0) {
    $tabla = "<table id=\"example2\" class=\"table table-sm\">";
    $tabla .= "<thead><tr><th>Nombre</th><th>Rut</th><th>Edad</th><th>N.Estudios</th><th>Ocupación</th><th>Parentesco</th><th></th></tr></thead>";
    while ($row = $resultado->fetch_assoc()) {

        $tabla .= "<tr>";
        $tabla .= "<td>" . strtoupper($row['nombre']) . "</td>";
        $tabla .= "<td>" . $row['rut'] . "</td>";
        $tabla .= "<td>" . $row['edad'] . "</td>";
        $tabla .= "<td>" . strtoupper($row['nivel_edu']) . "</td>";
        $tabla .= "<td>" . strtoupper($row['ocupacion']) . "</td>";
        $tabla .= "<td>" . strtoupper($row['parentesco']) . "</td>";
        $tabla .= "<td><a href=\"#\" onclick=\"borrar_gf('" . $row['id_empleado'] . "','" . $row['id_grupo'] . "')\"><small class=\"badge badge-danger\">Borrar</small></a></td>";
        $tabla .= "</tr>";
    }
    $tabla .= "</table>";
    echo $tabla;
} else {
    echo "Sin Información";
}


?>
