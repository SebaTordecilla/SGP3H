<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$id_oc = $_POST['id_oc'];


$tabla = "";
$tabla = "<table id=\"example\" class=\"table table-bordered table-striped\"><thead>    <tr>        <th>Fecha</th><th>NumeroDoC</th> <th>Tipo</th>     </tr></thead><tbody>";

try {
    $sql = "SELECT * FROM documentos_oc where id_oc = " . $id_oc . ";";
    foreach ($db->query($sql) as $row) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . date("d/m/Y", strtotime($row['fecha'])) . "</td>";
        $tabla .= "<td>" . $row['numero'] . "</td>";
        $tabla .= "<td>" . $row['tipo'] . "</td>";
    }
} catch (PDOException $e) {
    echo "Existen problemas con la conexión: " . $e->getMessage();
}

$tabla .= "</tbody></table>";

echo $tabla;

//close connection
$database->close();
