<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();
    try {
        $sql0 = "SELECT oc.id_oc, oc.num_oc,oc.id_empresa,oc.id_proveedor, upper(ei.nombre) as empresa, upper(pr.nombre) as proveedor, oc.fecha , upper(oc.pago) as pago, oc.cotizacion, oc.id_pedido FROM ordenes_compras oc left join empresas_internas ei on oc.id_empresa = ei.id_empresa left join proveedores pr 
        on pr.id_proveedor = oc.id_proveedor where oc.estado = 2 order by num_oc desc  ;";
        foreach ($db->query($sql0) as $row0) {

            $sql = "SELECT oc.id_oc, oc.num_oc,oc.id_empresa,oc.id_proveedor, upper(ei.nombre) as empresa, upper(pr.nombre) as proveedor, oc.fecha , upper(oc.pago) as pago, oc.cotizacion, oc.id_pedido
            ,(select round(sum(neto*cantidad)*1.19) from articulos_oc where id_oc = " . $row0['id_oc'] . ") as total
            FROM ordenes_compras oc left join empresas_internas ei on oc.id_empresa = ei.id_empresa left join proveedores pr 
                    on pr.id_proveedor = oc.id_proveedor left join articulos_oc aoc on oc.id_pedido = aoc.id_pedido
                    where oc.estado = 2 and oc.id_oc=" . $row0['id_oc'] . " limit 1 ;";
            foreach ($db->query($sql) as $row) {
    ?>
                <tr>
                    <td><?php echo $row['num_oc']; ?></td>
                    <td><?php echo $row['empresa']; ?></td>
                    <td><?php echo $row['proveedor']; ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row['fecha'])); ?></td>
                    <td><?php echo $row['pago']; ?></td>
                    <td><?php echo $row['id_pedido']; ?></td>
                    <td><?php echo number_format($row['total'], 0, ",", "."); ?></td>
                    <td align="center">
                        <a href="#" onclick="pdf_oc2('<?php echo $row['id_oc']; ?>')"><small class="badge badge-danger">pdf</small></a>
                    </td>
                    <td align="center">
                        <a href="#" onclick="doc_oc('<?php echo $row['id_oc']; ?>','<?php echo $row['num_oc']; ?>')"><small class="badge badge-success">doc</small></a>
                    </td>
                    <td align="center">
                        <a href="#" onclick="cerrar_oc('<?php echo $row['id_oc']; ?>')"><small class="badge badge-warning">cerrar</small></a>
                    </td>
                </tr>
    <?php
            }
        }
    } catch (PDOException $e) {
        echo "Existen problemas con la conexión: " . $e->getMessage();
    }


    //close connection
    $database->close();

    ?>


</tbody>