<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    try {
        $sql = "SELECT DISTINCT le.id_equipo as num ,le.sigla as ID, UPPER(le.nombre) as modelo,te.nombre as tipo,IF(MAX(me.fecha)is NULL,'SIN MANTENCIÓN',MAX(DATE_FORMAT(me.fecha,'%d-%m-%Y'))) as fecha,IF(le.id_est_equipo =1,'OPERATIVO','NO OPERATIVO') AS estado ,'POR CONFIRMAR' as proxman FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo LEFT JOIN estado_equipos ee on ee.id_est_equipo = me.id_est_equipo GROUP by le.id_equipo;";
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
                    <a href="#" onclick="abrir_mod_taller('<?php echo $row['num']; ?>','<?php echo $row['ID']; ?>');getDetails('<?php echo $row['ID']; ?>','<?php echo $row['num']; ?>','<?php echo $row['modelo']; ?>','<?php echo $row['tipo']; ?>') "><small class="badge badge-warning">Detalle</small></a>
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


    //close connection
    $database->close();

    ?>


</tbody>

</table>