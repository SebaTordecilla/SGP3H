<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();
    try {
        $sql = "SELECT DATE_FORMAT(se.fecha,'%d-%m-%Y') as fecha,le.sigla as codigo,te.nombre as tipo,um.nombre as ubicacion ,se.hora_ini_mec,se.hora_mec,se.hora_fin_mec,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, se.hora_ini_mec, se.hora_mec)) as mecanico,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, se.hora_ini_mec, se.hora_fin_mec)) as final ,rt.observaciones FROM reparacion_terreno rt INNER JOIN salida_equipos se on se.id_sal_equipo = rt.id_sal_equipo INNER JOIN lista_equipos le on le.id_equipo = se.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN ubicaciones_minas um on um.id_ubicacion = rt.id_ubicacion;";
        foreach ($db->query($sql) as $row) {

    ?>
            <tr>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['codigo']; ?></td>
                <td><?php echo $row['tipo']; ?></td>
                <td><?php echo $row['ubicacion']; ?></td>
                <td><?php echo $row['hora_ini_mec']; ?></td>
                <td><?php echo $row['hora_mec']; ?></td>
                <td><?php echo $row['hora_fin_mec']; ?></td>
                <td><?php echo $row['observaciones']; ?></td>
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