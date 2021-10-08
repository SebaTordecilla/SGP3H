<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();
    try {
        //$sql = "SELECT DATE_FORMAT(se.fecha,'%d-%m-%Y') as fecha,le.sigla as codigo,te.nombre as tipo,um.nombre as ubicacion ,se.hora_ini_mec,se.hora_mec,se.hora_fin_mec,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, se.hora_ini_mec, se.hora_mec)) as mecanico,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, se.hora_ini_mec, se.hora_fin_mec)) as final ,rt.observaciones FROM reparacion_terreno rt INNER JOIN salida_equipos se on se.id_sal_equipo = rt.id_sal_equipo INNER JOIN lista_equipos le on le.id_equipo = se.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN ubicaciones_minas um on um.id_ubicacion = rt.id_ubicacion;";
        $sql = "SELECT DATE_FORMAT(se.fecha,'%d-%m-%Y') as fecha,le.sigla as codigo,te.nombre as equipo,um.nombre as mina,rt.hora_ini,rt.hora_mec,rt.duraccion,SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) as hor_inactivo, fe.nombre as falla FROM reparacion_terreno rt INNER JOIN salida_equipos se on rt.id_sal_equipo = se.id_sal_equipo INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN fallas_mecanicas fe on rt.id_falla = fe.id_falla INNER JOIN ubicaciones_minas um on se.id_ubicacion = um.id_ubicacion WHERE rt.id_est_equipo = 10 GROUP by id_rep_ter ORDER by se.fecha DESC;";
        foreach ($db->query($sql) as $row) {

    ?>
            <tr>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['codigo']; ?></td>
                <td><?php echo $row['equipo']; ?></td>
                <td><?php echo $row['mina']; ?></td>
                <td><?php echo $row['hora_ini']; ?></td>
                <td><?php echo $row['hora_mec']; ?></td>
                <td><?php echo $row['duraccion']; ?></td>
                <td><?php echo $row['hor_inactivo']; ?></td>
                <td><?php echo $row['falla']; ?></td>
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