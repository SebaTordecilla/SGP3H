<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();



    try {
        $sql = "SELECT DATE_FORMAT(se.fecha,'%d-%m-%Y') AS fecha ,le.sigla,te.nombre,se.hora_inicio as In_Jor,se.hora_fin as Fin_Jor,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)) as hrs_total,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)) hrs_col,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_mec, hora_fin_mec)) as hrs_mec, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_mec, hora_fin_mec)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))))) as final FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo WHERE se.id_estado_diario = 5 ORDER by se.fecha DESC;";


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
                <td><?php echo $row['hrs_mec']; ?></td>
                <td><?php echo $row['final']; ?></td>
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