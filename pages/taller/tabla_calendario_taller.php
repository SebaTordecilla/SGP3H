<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    $maxsql = "SELECT MAX(id_equipo) as maxim from lista_equipos";
    foreach ($db->query($maxsql) as $row) {
        $max = $row['maxim'];
    }

    for ($i = 1; $i <= $max; $i++) {

        try {
            $sql_query3 = "SELECT MAX(fecha) as ultfecha FROM mant_equipos WHERE id_equipo =".$i." and id_est_equipo = 1;";
            $result3 = mysqli_query($con, $sql_query3);
            $row = mysqli_fetch_array($result3);
            $ultfecha = $row['ultfecha'];

            //$sql = "SELECT DISTINCT le.id_equipo as num ,le.sigla as ID, UPPER(le.nombre) as modelo,te.nombre as tipo,IF(MAX(me.fecha)is NULL,'SIN MANTENCIÓN',MAX(DATE_FORMAT(me.fecha,'%d-%m-%Y'))) as fecha,IF(le.id_est_equipo =1,'OPERATIVO','NO OPERATIVO') AS estado ,'POR CONFIRMAR' as proxman FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo LEFT JOIN estado_equipos ee on ee.id_est_equipo = me.id_est_equipo GROUP by le.id_equipo;";
            $sql = "SELECT DISTINCT le.id_equipo as num ,le.sigla as ID, UPPER(le.nombre) as modelo,te.nombre as tipo, DATE_FORMAT((SELECT fecha FROM mant_equipos where id_equipo = ".$i." order by fecha desc limit 1),'%d-%m-%Y') as fecha,ee.nombre as estado, (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin))))))) FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN mant_equipos man on man.id_equipo = le.id_equipo WHERE se.id_estado_diario = 5 and le.id_equipo=".$i." AND se.fecha BETWEEN '".$ultfecha."' AND CURDATE()  ORDER by se.fecha DESC) as proxman  FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_equipo = ".$i.";";
            foreach ($db->query($sql) as $row) {
    ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['modelo']; ?></td>
                    <td><?php echo $row['tipo']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                    <td><?php echo $row['estado']; ?></td>
                    <td> <?php echo $row['proxman']; ?></td>
                    <td align="center">
                        <a href="#" onclick="abrir_mod_taller('<?php echo $row['num']; ?>','<?php echo $row['ID']; ?>');getDetails('<?php echo $row['ID']; ?>','<?php echo $row['num']; ?>','<?php echo $row['modelo']; ?>','<?php echo $row['tipo']; ?>') "><small class="badge badge-warning">Mant.</small></a>
                    </td>
                    <td align="center">
                        <a href="#" onclick="pdf_ft('<?php echo $row['num']; ?>')"><small class="badge badge-primary">Ficha</small></a>
                    </td>
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