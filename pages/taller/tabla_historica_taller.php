<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    try {
        $sql = "SELECT DATE_FORMAT(me.fecha,'%d-%m-%Y') AS fecha,le.sigla as cod,le.nombre as modelo, te.nombre as tipo, ee.nombre as estado, me.check_list, UPPER(me.observaciones) as observaciones  FROM mant_equipos me INNER JOIN  lista_equipos le on le.id_equipo = me.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo= te.id_tequipo INNER JOIN estado_equipos ee on me.id_est_equipo = ee.id_est_equipo  WHERE me.observaciones <> 'EQUIPO INGRESADO RECIENTEMENTE' ORDER BY me.fecha DESC;";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>

                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['cod']; ?></td>
                <td><?php echo $row['tipo']; ?></td>
                <td><?php echo $row['estado']; ?></td>
                <td><?php echo $row['check_list']; ?></td>
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