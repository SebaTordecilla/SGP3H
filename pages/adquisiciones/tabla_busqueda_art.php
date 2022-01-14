<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

/*$buscar = $_POST['buscar'];
$tipo = $_POST['tipo'];

$tabla = "";
$tabla = "<table id=\"example1\" class=\"table table-bordered table-striped\"><thead><tr><th>N°OC</th><th>Empresa</th><th>Proveedor</th><th>Fecha</th><th>N°Pedido</th><th>Total</th><th>Estado</th><th></th></tr></thead><tbody>";



$sql = "SELECT oc.id_oc, oc.num_oc,oc.id_empresa,oc.id_proveedor, upper(ei.nombre) as empresa, upper(pr.nombre) as proveedor, oc.fecha , upper(oc.pago) as pago, oc.cotizacion, oc.id_pedido, if(oc.estado =3,'CERRADO','ABIERTO') AS statusi
FROM ordenes_compras oc left join empresas_internas ei on oc.id_empresa = ei.id_empresa left join proveedores pr 
on pr.id_proveedor = oc.id_proveedor left join articulos_oc aoc on oc.id_pedido = aoc.id_pedido
where oc.estado in (1,2,3) and aoc.descripcion like '%" . $buscar . "%' group by num_oc";
foreach ($db->query($sql) as $row) {

    $tabla .= "<td>" . $row['num_oc'] . "</td>";
    $tabla .= "<td>" . $row['empresa'] . "</td>";
    $tabla .= "<td>" . $row['proveedor'] . "</td>";
    $tabla .= "<td>" .  date("d/m/Y", strtotime($row['fecha']))  . "</td>";
    $tabla .= "<td>" . $row['id_pedido'] . "</td>";
    $tabla .= "<td>" . number_format($row['total'], 0, ",", ".") . "</td>";
    if ($row['statusi'] == 'CERRADO') {
        $tabla .= "<td style=\"color:#B31C1C\">" . $row['statusi'] . "</td>";
    } else {
        $tabla .= "<td style=\"color:#188B0E \">" . $row['statusi'] . "</td>";
    }
    $tabla .= "<td align=\"center\"><a href=\"#\" onclick=\"pdf_oc2('" . $row['id_oc'] . "')\"><small class=\"badge badge-danger\">pdf</small></a>
            <a href=\"#\" onclick=\"doc_oc2('" . $row['id_oc'] . "','" . $row['num_oc'] . "')\"><small class=\"badge badge-success\">doc</small></a></td>";
    $tabla .= "</tr>";
}*/
$buscar = $_POST['buscar'];
$tipo = $_POST['tipo'];

$tabla = "";
$tabla = "<table id=\"example1\" class=\"table table-bordered table-striped\"><thead><tr><th>N°OC</th><th>Empresa</th><th>Proveedor</th><th>Fecha</th><th>N°Pedido</th><th>Estado</th><th></th></tr></thead><tbody>";
if ($tipo == 1) {
    try {
        $sql = "SELECT oc.id_oc, oc.num_oc,oc.id_empresa,oc.id_proveedor, upper(ei.nombre) as empresa, upper(p.nombre) as proveedor, oc.fecha ,  oc.id_pedido, if(oc.estado =3,'CERRADO','ABIERTO') AS statusi
        FROM articulos_oc aoc inner join ordenes_compras oc on oc.id_oc = aoc.id_oc left join empresas_internas ei on oc.id_empresa = ei.id_empresa left join proveedores p on oc.id_proveedor = p.id_proveedor    
        where oc.estado in (1,2,3) and aoc.descripcion like '%" . $buscar . "%' group by num_oc ;";
        foreach ($db->query($sql) as $row) {
            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['num_oc'] . "</td>";
            $tabla .= "<td>" . $row['empresa'] . "</td>";
            $tabla .= "<td>" . $row['proveedor'] . "</td>";
            $tabla .= "<td>" .  date("d/m/Y", strtotime($row['fecha']))  . "</td>";
            $tabla .= "<td>" . $row['id_pedido'] . "</td>";
            if ($row['statusi'] == 'CERRADO') {
                $tabla .= "<td style=\"color:#B31C1C\">" . $row['statusi'] . "</td>";
            } else {
                $tabla .= "<td style=\"color:#188B0E \">" . $row['statusi'] . "</td>";
            }
            $tabla .= "<td align=\"center\"><a href=\"#\" onclick=\"pdf_oc2('" . $row['id_oc'] . "')\"><small class=\"badge badge-danger\">pdf</small></a>
                    <a href=\"#\" onclick=\"doc_oc2('" . $row['id_oc'] . "','" . $row['num_oc'] . "')\"><small class=\"badge badge-success\">doc</small></a></td>";
        }
    } catch (PDOException $e) {
        echo "Existen problemas con la conexión: " . $e->getMessage();
    }
} else if ($tipo == 2) {
    try {
        $sql = "SELECT oc.id_oc, oc.num_oc,oc.id_empresa,oc.id_proveedor, upper(ei.nombre) as empresa, upper(p.nombre) as proveedor, oc.fecha ,  oc.id_pedido, if(oc.estado =3,'CERRADO','ABIERTO') AS statusi
        FROM articulos_oc aoc inner join ordenes_compras oc on oc.id_oc = aoc.id_oc left join empresas_internas ei on oc.id_empresa = ei.id_empresa left join proveedores p on oc.id_proveedor = p.id_proveedor    
        where oc.estado in (1,2,3) and p.nombre like '%" . $buscar . "%' group by num_oc ;";
        foreach ($db->query($sql) as $row) {
            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['num_oc'] . "</td>";
            $tabla .= "<td>" . $row['empresa'] . "</td>";
            $tabla .= "<td>" . $row['proveedor'] . "</td>";
            $tabla .= "<td>" .  date("d/m/Y", strtotime($row['fecha']))  . "</td>";
            $tabla .= "<td>" . $row['id_pedido'] . "</td>";
            if ($row['statusi'] == 'CERRADO') {
                $tabla .= "<td style=\"color:#B31C1C\">" . $row['statusi'] . "</td>";
            } else {
                $tabla .= "<td style=\"color:#188B0E \">" . $row['statusi'] . "</td>";
            }
            $tabla .= "<td align=\"center\"><a href=\"#\" onclick=\"pdf_oc2('" . $row['id_oc'] . "')\"><small class=\"badge badge-danger\">pdf</small></a>
                    <a href=\"#\" onclick=\"doc_oc2('" . $row['id_oc'] . "','" . $row['num_oc'] . "')\"><small class=\"badge badge-success\">doc</small></a></td>";
        }
    } catch (PDOException $e) {
        echo "Existen problemas con la conexión: " . $e->getMessage();
    }
} else if ($tipo == 3) {
    try {
        $sql = "SELECT oc.id_oc, oc.num_oc,oc.id_empresa,oc.id_proveedor, upper(ei.nombre) as empresa, upper(p.nombre) as proveedor, oc.fecha ,  oc.id_pedido, if(oc.estado =3,'CERRADO','ABIERTO') AS statusi
        FROM articulos_oc aoc inner join ordenes_compras oc on oc.id_oc = aoc.id_oc left join empresas_internas ei on oc.id_empresa = ei.id_empresa left join proveedores p on oc.id_proveedor = p.id_proveedor left join solicitudes_compra sc on oc.id_pedido = sc.id_pedido
        left join areas3h ah on ah.id_area = sc.area   
        where oc.estado in (1,2,3) and ah.nombre like '%" . $buscar . "%' group by num_oc ;";
        foreach ($db->query($sql) as $row) {
            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['num_oc'] . "</td>";
            $tabla .= "<td>" . $row['empresa'] . "</td>";
            $tabla .= "<td>" . $row['proveedor'] . "</td>";
            $tabla .= "<td>" .  date("d/m/Y", strtotime($row['fecha']))  . "</td>";
            $tabla .= "<td>" . $row['id_pedido'] . "</td>";
            if ($row['statusi'] == 'CERRADO') {
                $tabla .= "<td style=\"color:#B31C1C\">" . $row['statusi'] . "</td>";
            } else {
                $tabla .= "<td style=\"color:#188B0E \">" . $row['statusi'] . "</td>";
            }
            $tabla .= "<td align=\"center\"><a href=\"#\" onclick=\"pdf_oc2('" . $row['id_oc'] . "')\"><small class=\"badge badge-danger\">pdf</small></a>
                    <a href=\"#\" onclick=\"doc_oc2('" . $row['id_oc'] . "','" . $row['num_oc'] . "')\"><small class=\"badge badge-success\">doc</small></a></td>";
        }
    } catch (PDOException $e) {
        echo "Existen problemas con la conexión: " . $e->getMessage();
    }
}


$tabla .= "</tbody></table>";

echo $tabla;

//close connection
$database->close();




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