<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    $maxsql = "SELECT max(id_sal_equipo) as maxim,min(id_sal_equipo) as mini FROM salida_equipos;";
    foreach ($db->query($maxsql) as $row) {
        $max = $row['maxim'];
        $min = $row['mini'];
    }

    for ($i = $min; $i <= $max; $i++) {
        try {
            $sql = "SELECT DATE_FORMAT(se.fecha,'%d-%m-%Y') AS fecha ,le.sigla,te.nombre,se.hora_inicio as In_Jor,se.hora_fin as Fin_Jor,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)) as hrs_total,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)) hrs_col,IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,' ',SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion)))) as hor_mec,IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin))))))) as final 
            FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_estado_diario = 5 and rt.id_sal_equipo = ".$i." ORDER by se.fecha DESC;";


            foreach ($db->query($sql) as $row) {

    ?>
                <tr>
                    <td><?php echo $row['fecha']; ?></td>
                    <td><?php echo $row['sigla']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['In_Jor']; ?></td>
                    <td><?php echo $row['Fin_Jor']; ?></td>
                    <td><?php echo $row['hrs_total']; ?></td>
                    <td><?php echo $row['hrs_col']; ?></td>
                    <td><?php echo $row['hor_mec']; ?></td>
                    <td><?php echo $row['final']; ?></td>
                </tr>
    <?php
            }
        } catch (PDOException $e) {
            echo "Existen problemas con la conexión: " . $e->getMessage();
        }
    }


    //close connection
    $database->close();

    ?>


</tbody>

</table>