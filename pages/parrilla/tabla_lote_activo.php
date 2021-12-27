<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();
    try {
        $sql1 = "SELECT id_lote FROM lotes";
        foreach ($db->query($sql1) as $row1) {
            $num = $row1['id_lote'];
            $sql = "SELECT lo.id_lote, lo.num_lote, lo.id_emplot, lo.mes, lo.ano,el.nombre as empresa , sum(if(gc.id_ubicacion =1,1,0)) as penosa,sum(if(gc.id_ubicacion =3,1,0)) as patricia, sum(if(gc.id_ubicacion =5,1,0)) as cajon, sum(gc.tonelaje) as tonelaje, FORMAT(avg(gc.leyvis),2) as promedio FROM lotes lo 
            inner join empresas_lotes el on lo.id_emplot = el.id_emplot left join guias_camiones gc on
            lo.id_lote = gc.id_lote where lo.id_lote = " . $num . " and lo.estado = 1 group by lo.id_lote ;";
            foreach ($db->query($sql) as $row) {
    ?>
                <tr>
                    <td><?php echo $row['num_lote']; ?></td>
                    <td><?php echo $row['empresa']; ?></td>
                    <td><?php echo $row['penosa']; ?></td>
                    <td><?php echo $row['patricia']; ?></td>
                    <td><?php echo $row['cajon']; ?></td>
                    <td><?php echo number_format($row['tonelaje'], 0, ",", "."); ?></td>
                    <td><?php echo $row['promedio']; ?></td>
                    <td align="center">
                        <a href="#" onclick="edit_lote('<?php echo $row['id_lote']; ?>','<?php echo $row['num_lote']; ?>','<?php echo $row['id_emplot']; ?>','<?php echo $row['mes']; ?>','<?php echo $row['ano']; ?>')"><small class="badge badge-success">Edit</small></a>
                    </td>
                    <td align="center">
                        <a href="#" onclick="guias_lote('<?php echo $row['id_lote']; ?>')"><small class="badge badge-info">Guias</small></a>
                    </td>
                    <td align="center">
                        <a href="#" onclick="cerrar_lote('<?php echo $row['id_lote']; ?>')"><small class="badge badge-danger">Conf.</small></a>
                    </td>
                </tr>
    <?php
            }
        }
    } catch (PDOException $e) {
        echo "Existen problemas con la conexión: " . $e->getMessage();
    }


    //close connection
    $database->close();

    ?>


</tbody>

</table>