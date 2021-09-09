<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    try {
        $sql = "SELECT d.id_disparo, d.fecha,d.turno,d.jornada,d.id_perforo,mi.nombre as id_material,ub.nombre,IF(d.id_calle>0,IF(d.id_labor>0,CONCAT(man.coordenada,' ',cal.coordenada,' ',lev.coordenada),CONCAT(man.coordenada,' ',cal.coordenada)),CONCAT(man.coordenada)) as ubicacion,d.tiros,d.longtiro,d.observaciones FROM disparos d INNER JOIN ubicaciones_minas ub on d.id_ubicacion = ub.id_ubicacion INNER JOIN minerales mi on mi.id_mineral=d.id_material LEFT JOIN mantos man on man.id_manto = d.id_manto LEFT JOIN calles cal on cal.id_calle = d.id_calle LEFT JOIN levantes lev on lev.id_levante = d.id_labor WHERE estado = 1;";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td><?php echo date("d-m-Y", strtotime($row['fecha'])); ?></td>
                <td><?php echo $row['turno']; ?></td>
                <td><?php echo $row['jornada']; ?></td>
                <td><?php echo $row['id_perforo']; ?></td>
                <td><?php echo $row['id_material']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['ubicacion']; ?></td>
                <td><?php echo $row['tiros']; ?></td>
                <td><?php echo $row['longtiro']; ?></td>
                <td><?php echo strtoupper($row['observaciones']); ?></td>
                <td align="center"><a href="#" onclick="confirmar_disparo('<?php echo $row['id_disparo']; ?>')"><small class="badge badge-primary">Confirmar</small></a></td>
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