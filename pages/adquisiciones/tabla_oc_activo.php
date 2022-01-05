<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();
    try {

        $sql = "SELECT oc.id_oc, oc.num_oc,upper(ei.nombre) as empresa, upper(pr.nombre) as proveedor, oc.fecha , upper(oc.pago) as pago, oc.cotizacion, oc.id_pedido FROM ordenes_compras oc left join empresas_internas ei on oc.id_empresa = ei.id_empresa left join proveedores pr 
        on pr.id_proveedor = oc.id_proveedor where oc.estado = 1  ;";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td><?php echo $row['num_oc']; ?></td>
                <td><?php echo $row['empresa']; ?></td>
                <td><?php echo $row['proveedor']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['pago']; ?></td>
                <td><?php echo $row['cotizacion']; ?></td>
                <td><?php echo $row['id_pedido']; ?></td>
                <td align="center">
                    <a href="#" onclick="edit_lote()"><small class="badge badge-success">Edit</small></a>
                </td>
                <td align="center">
                    <a href="#" onclick="articulos_oc('<?php echo $row['id_oc']; ?>','<?php echo $row['id_pedido']; ?>')"><small class="badge badge-info">Art.</small></a>
                </td>
                <td align="center">
                    <a href="#" onclick="cerrar_lote('')"><small class="badge badge-danger">Conf.</small></a>
                </td>
            </tr>
    <?php
        }
    } catch (PDOException $e) {
        echo "Existen problemas con la conexión: " . $e->getMessage();
    }


    //close connection
    $database->close();

    ?>


</tbody>