<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();





    try {
        $sql = "SELECT cc.id_csc as num,c3.patente,c3.modelo,cc.fecha,cc.kilometraje, CASE cc.nivel_comb when 1 then 'Bajo' when 2 then 'Medio' when 3 then 'Alto'end as NivelComb, if(cc.observaciones = '','Sin Observaciones',cc.observaciones) as observaciones  FROM control_camionetas cc INNER JOIN camionetas3h c3 on cc.id_camioneta = c3.id_camioneta ORDER BY cc.fecha DESC;";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>

                <td><?php echo $row['patente']; ?></td>
                <td><?php echo strtoupper($row['modelo']); ?></td>
                <td><?php echo date("d/m/Y", strtotime($row['fecha'])); ?></td>
                <td><?php echo number_format($row['kilometraje'], 0, ',', '.'); ?></td>
                <td><?php echo strtoupper($row['NivelComb']); ?></td>
                <td><?php echo strtoupper($row['observaciones']); ?></td>
                <td align="center">
                    <a href="#" onclick="pdf_control_camioneta('<?php echo $row['num']; ?>')"><i class="nav-icon fas fa-file fondo_icono"></i></a>
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