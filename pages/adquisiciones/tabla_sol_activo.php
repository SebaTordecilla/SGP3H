<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();
    try {

        $sql = "SELECT sc.id_pedido, upper(sc.solicitado) as solicitado, sc.hora, sc.fecha, a.nombre as area, sc.prioridad, sc.justificacion FROM solicitudes_compra sc inner join areas3h a on sc.area = a.id_area where estado = 1";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td><?php echo $row['id_pedido']; ?></td>
                <td><?php echo $row['solicitado']; ?></td>
                <td><?php echo $row['hora']; ?></td>
                <td><?php echo date("d/m/Y", strtotime($row['fecha'])); ?></td>
                <td><?php echo $row['area']; ?></td>
                <td><?php echo $row['prioridad']; ?></td>
                <td align="center">
                    <a href="#" onclick="edit_sol('')"><small class="badge badge-success">Edit</small></a>
                </td>
                <td align="center">
                    <a href="#" onclick="articulos_sol('<?php echo $row['id_pedido']; ?>')"><small class="badge badge-info">Art.</small></a>
                </td>
                <td align="center">
                    <a href="#" onclick="cerrar_lote('')"><small class="badge badge-warning">Conf.</small></a>
                    <a href="#" onclick="pdf_sol('<?php echo $row['id_pedido']; ?>')"><small class="badge badge-danger">pdf</small></a>
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