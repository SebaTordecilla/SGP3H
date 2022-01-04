<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();
    try {

        $sql = "SELECT vf.id_sulf, vf.num, vf.fecha, vf.num_guia, vf.id_responsable, vf.id_patente, vf.id_chofer, vf.sector, vf.hora, vf.tonelaje, c.patente, ch.nombre as chofer, upper(o.nombre) as responsable
        FROM viajes_sulfuro vf left join camiones c on vf.id_patente = c.id_camion left join choferes ch on ch.id_chofer = vf.id_chofer left join operadores o on vf.id_responsable = o.id_op
        where vf.estado = 1";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td><?php echo $row['num']; ?></td>
                <td><?php echo date("d-m-Y", strtotime($row['fecha'])) ; ?></td>
                <td><?php echo $row['num_guia']; ?></td>
                <td><?php echo $row['responsable']; ?></td>
                <td><?php echo $row['patente']; ?></td>
                <td><?php echo $row['chofer']; ?></td>
                <td><?php echo $row['sector']; ?></td>
                <td><?php echo $row['hora']; ?></td>
                <td><?php echo number_format($row['tonelaje'], 0, ",", "."); ?></td>
                <td align="center">
                    <a href="#" onclick="edit_sulfuro('<?php echo $row['id_sulf']; ?>','<?php echo $row['num']; ?>','<?php echo $row['fecha']; ?>','<?php echo $row['num_guia']; ?>','<?php echo $row['id_responsable']; ?>','<?php echo $row['id_patente']; ?>','<?php echo $row['id_chofer']; ?>','<?php echo $row['sector']; ?>','<?php echo $row['hora']; ?>','<?php echo $row['tonelaje']; ?>')"><small class="badge badge-success">Edit</small></a>
                </td>
                <td align="center">
                    <a href="#" onclick="cerrar_guia_sulfuro('<?php echo $row['id_sulf']; ?>')"><small class="badge badge-danger">Conf.</small></a>
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