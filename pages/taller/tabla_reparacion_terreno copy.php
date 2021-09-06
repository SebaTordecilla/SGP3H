<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

  

        try {
            $sql = "SELECT se.id_sal_equipo,le.sigla as codigo,se.fecha as fecha,um.nombre as ubicacion,se.hora_ini_mec,se.hora_mec,se.hora_fin_mec, ee.nombre as estado FROM reparacion_terreno rp INNER JOIN salida_equipos se on rp.id_sal_equipo= se.id_sal_equipo INNER JOIN ubicaciones_minas um on rp.id_ubicacion = um.id_ubicacion INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN estado_equipos ee on se.id_estado_diario = ee.id_est_equipo WHERE rp.id_est_equipo in (8,9);";
            foreach ($db->query($sql) as $row) {
    ?>
                <tr>
                    <td><?php echo $row['codigo']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                    <td><?php echo $row['ubicacion']; ?></td>
                    <td><?php echo $row['hora_ini_mec']; ?></td>
                    <td><a href="#" onclick="abrir_reparacion_terreno();getDetails3('<?php echo $row['id_sal_equipo']; ?>')" ><i class="nav-icon far fa-plus-square fondo_icono"></i></a> <?php echo $row['hora_mec']; ?></td>
                    <td><a href="#" onclick="cerrar_reparacion_terreno();getDetails3('<?php echo $row['id_sal_equipo']; ?>')" ><i class="nav-icon far fa-plus-square fondo_icono"></i></a> <?php echo $row['hora_fin_mec']; ?></td>
                    <td><?php echo $row['estado']; ?></td>
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