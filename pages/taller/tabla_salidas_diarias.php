<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

  

        try {
            $sql = "SELECT sal.id_sal_equipo, le.id_equipo, le.sigla as ID,te.nombre as Equipo,um.nombre as Ubicacion,DATE_FORMAT(sal.fecha,'%d-%m-%Y') as Fecha,sal.hora_inicio as Hora,ee.nombre as Estado, CASE sal.hora_fin when sal.hora_fin ='00:00:01' THEN 'S/Cierre' else sal.hora_fin end as hora_fin2 ,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, sal.hora_inicio, CASE sal.hora_fin when sal.hora_fin ='00:00:01' THEN time (NOW()) else hora_fin end)) horas_tr FROM salida_equipos sal INNER JOIN lista_equipos le on sal.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo=te.id_tequipo INNER JOIN ubicaciones_minas um on sal.id_ubicacion = um.id_ubicacion INNER JOIN estado_equipos ee on ee.id_est_equipo = sal.id_estado_diario WHERE sal.id_estado_diario in (1,6,7,8,9)";
            foreach ($db->query($sql) as $row) {
    ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['Equipo']; ?></td>
                    <td><?php echo $row['Ubicacion']; ?></td>
                    <td><?php echo $row['Fecha']; ?></td>
                    <td><?php echo $row['Hora']; ?></td>
                    <td><?php echo $row['hora_fin2']; ?></td>
                    <td><?php echo $row['Estado']; ?></td>
                    <td><?php echo $row['horas_tr']; ?></td>
                    <td><a href="#" onclick="abrir_mant_cierre();getDetails2('<?php echo $row['ID']; ?>','<?php echo $row['Fecha']; ?>','<?php echo $row['id_sal_equipo']; ?>')"><small class="badge badge-primary">Cierre</small></a> </td>
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