<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    try {
        $sql = "SELECT mg.id_geom as id,um.nombre as mina,CONCAT(mg.id_manto,' ',mg.id_calle,' ',mg.id_labor) as ubicacion, mg.fecha,mg.cutlab,mg.cuslab,mg.tipo from muestras_geologia mg INNER JOIN ubicaciones_minas um on mg.id_ubicacion=um.id_ubicacion where mg.estado = 2;";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td>P-00<?php echo $row['id']; ?></td>
                <td><?php echo $row['mina']; ?></td>
                <td><?php echo $row['ubicacion']; ?></td>
                <td><?php echo date("d-m-Y", strtotime($row['fecha'])); ?></td>
                <td><?php echo $row['cutlab']; ?></td>
                <td><?php echo $row['cuslab']; ?></td>
                <td><?php echo $row['tipo']; ?></td>
                <td align="center">
                    <a href="#" onclick="etiqueta_muestra_geo('<?php echo $row['id']; ?>')"><small class="badge badge-warning">Ingresar</small></a>
                    <a href="#" onclick="etiqueta_muestra_geo('<?php echo $row['id']; ?>')"><small class="badge badge-primary">Confirmar</small></a>
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

</table>