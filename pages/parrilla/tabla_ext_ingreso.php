<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    try {
        $sql = "SELECT em.id_extmin, em.fecha,um.nombre as id_ubicacion1,le.sigla as id_equipo1, upper(o.nombre) as id_op1, 
        if(em.id_labor=0, concat(m.coordenada,' ',c.coordenada),concat(m.coordenada,' ',c.coordenada, ' ',l.coordenada)) as coordenada, mn.nombre as tipo, osm.nombre as observaciones
        ,if(em.hora1='00:00:00',0,1) as h1,if(em.hora2='00:00:00',0,1)as h2,if(em.hora3='00:00:00',0,1)as h3,if(em.hora4='00:00:00',0,1)as h4,if(em.hora5='00:00:00',0,1)as h5
        ,em.id_ubicacion,em.id_manto,em.id_calle,em.id_labor,em.id_equipo,em.id_op,	em.id_mineral,em.id_obs_min,em.hora1,em.hora2,em.hora3,	em.hora4,em.hora5
        FROM extraccion_mineral em inner join lista_equipos le on em.id_equipo= le.id_equipo inner join ubicaciones_minas um on em.id_ubicacion = um.id_ubicacion
        inner join operadores o on em.id_op = o.id_op inner join mantos m on m.id_manto = em.id_manto inner join calles c on c.id_calle = em.id_calle left join levantes l on l.id_levante = em.id_labor
        inner join minerales mn on mn.id_mineral = em.id_mineral left join observaciones_minerales osm on em.id_obs_min = osm.id_obs_min where em.estado =1";
        foreach ($db->query($sql) as $row) {

            $cantidad = $row['h1'] + $row['h2'] + $row['h3'] + $row['h4'] + $row['h5'];
    ?>
            <tr>

                <td><?php echo date("d-m-Y", strtotime($row['fecha'])); ?></td>
                <td><?php echo $row['id_ubicacion1']; ?></td>
                <td><?php echo $row['id_equipo1']; ?></td>
                <td><?php echo $row['id_op1']; ?></td>
                <td><?php echo $row['coordenada']; ?></td>
                <td><?php echo $row['tipo']; ?></td>
                <td><?php echo $row['observaciones']; ?></td>
                <td align="center">
                    <a href="#" onclick="editar_extmin('<?php echo $row['id_extmin']; ?>','<?php echo $row['id_ubicacion']; ?>','<?php echo $row['id_manto']; ?>','<?php echo $row['id_calle']; ?>','<?php echo $row['id_labor']; ?>','<?php echo $row['fecha']; ?>','<?php echo $row['id_equipo']; ?>','<?php echo $row['id_op']; ?>','<?php echo $row['id_mineral']; ?>','<?php echo $row['id_obs_min']; ?>','<?php echo $row['hora1']; ?>','<?php echo $row['hora2']; ?>','<?php echo $row['hora3']; ?>','<?php echo $row['hora4']; ?>','<?php echo $row['hora5']; ?>')"><small class="badge badge-info">Edit</small></a>
                    <a><small class="badge badge-success"><?php echo $cantidad ?></small></a>
                </td>
                <td align="center">
                    <a href="#" onclick="cerrar_extmin('<?php echo $row['id_extmin']; ?>')"><small class="badge badge-danger">Conf.</small></a>
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