<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$id_oc = $_POST['id_oc'];


$tabla = "";
$tabla = "<table id=\"example1\" class=\"table table-bordered table-striped\"><thead>    <tr>        <th>Descripción</th><th>Cantidad</th> <th>Neto</th> <th>Total</th><th></th>     </tr></thead><tbody>";

try {
    $sql = "SELECT * FROM articulos_oc where id_oc = " . $id_oc . ";";
    foreach ($db->query($sql) as $row) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . $row['descripcion'] . "</td>";
        $tabla .= "<td>" . $row['cantidad'] . "</td>";
        $tabla .= "<td>" . $row['neto'] . "</td>";
        $tabla .= "<td>" . $row['neto'] * $row['cantidad'] . "</td>";

        $tabla .= "<td align=\"center\"><a href=\"#\" onclick=\"del_oc('" . $row['id_artoc'] . "','" . $id_oc . "')\"><small class=\"badge badge-danger\">-</small></a></td>";
    }
} catch (PDOException $e) {
    echo "Existen problemas con la conexión: " . $e->getMessage();
}

$tabla .= "</tbody></table>";

echo $tabla;

//close connection
$database->close();
