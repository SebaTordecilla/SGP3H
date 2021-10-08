<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    try {
        $sql = "SELECT rt.id_rep_ter idr, rt.id_sal_equipo as id, le.sigla as codigo, te.nombre as equipo, rt.hora_ini as hora FROM reparacion_terreno rt INNER JOIN salida_equipos se on rt.id_sal_equipo = se.id_sal_equipo INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo WHERE rt.id_est_equipo in (8,9);";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td><?php echo $row['codigo']; ?></td>
                <td><?php echo $row['equipo']; ?></td>
                <td><?php echo $row['hora']; ?></td>
                <td><a href="#"  onclick="  getDetails3('<?php echo $row['idr'] ?>');modal_repa()"><small class="badge badge-success">Reparación</small></a></td>
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