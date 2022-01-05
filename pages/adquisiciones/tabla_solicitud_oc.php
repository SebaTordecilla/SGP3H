<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$id_oc = $_POST['id_oc'];
$id_pedido = $_POST['id_pedido'];


$tabla = "";
$tabla = "<table id=\"example1\" class=\"table table-bordered table-striped\"><thead>    <tr>        <th>Descripción</th><th>Cantidad</th> <th>Stock</th> <th>Proveedor</th> <th></th>     </tr></thead><tbody>";

try {
    $sql = "SELECT id_artsol, upper(descripcion) as descripcion, cantidad, stock, upper(proveedor) as proveedor," . $id_oc . " as id_oc FROM articulos_solicitados where id_pedido = " . $id_pedido . ";";
    foreach ($db->query($sql) as $row) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . $row['descripcion'] . "</td>";
        $tabla .= "<td>" . $row['cantidad'] . "</td>";
        $tabla .= "<td>" . $row['stock'] . "</td>";
        $tabla .= "<td>" . $row['proveedor'] . "</td>";
        $tabla .= "<td align=\"center\"><a href=\"#\" onclick=\"add_oc('" . $row['descripcion'] . "','" . $row['cantidad'] . "','" . $row['id_artsol'] . "')\"><small class=\"badge badge-success\">+</small></a></td>";
    }
} catch (PDOException $e) {
    echo "Existen problemas con la conexión: " . $e->getMessage();
}

$tabla .= "</tbody></table>";

echo $tabla;

//close connection
$database->close();
