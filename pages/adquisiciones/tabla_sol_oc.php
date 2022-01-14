<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$id_pedido = $_POST['id_pedido'];


$tabla = "";
$tabla = "<table id=\"example1\" class=\"table table-bordered table-striped\"><thead>    <tr>        <th>N°OC</th><th>Empresa</th> <th>Proveedor</th> <th>Fecha</th> <th></th>     </tr></thead><tbody>";

try {
    $sql = "SELECT oc.id_oc, oc.num_oc,oc.id_empresa,oc.id_proveedor, upper(ei.nombre) as empresa, upper(pr.nombre) as proveedor, oc.fecha , upper(oc.pago) as pago, upper(oc.cotizacion) as cotizacion, oc.id_pedido FROM ordenes_compras oc left join empresas_internas ei on oc.id_empresa = ei.id_empresa left join proveedores pr 
    on pr.id_proveedor = oc.id_proveedor where id_pedido = " . $id_pedido . ";";
    foreach ($db->query($sql) as $row) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . $row['num_oc'] . "</td>";
        $tabla .= "<td>" . $row['empresa'] . "</td>";
        $tabla .= "<td>" . $row['proveedor'] . "</td>";
        $tabla .= "<td>" . date("d/m/Y", strtotime($row['fecha'])) . "</td>";
        $tabla .= "<td align=\"center\"><a href=\"#\" onclick=\"pdf_oc2('" . $row['id_oc'] . "')\"><small class=\"badge badge-danger\">pdf</small></a></td>";
    }
} catch (PDOException $e) {
    echo "Existen problemas con la conexión: " . $e->getMessage();
}

$tabla .= "</tbody></table>";

echo $tabla;

//close connection
$database->close();
