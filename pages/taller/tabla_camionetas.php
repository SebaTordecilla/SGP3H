<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    $maxsql = "SELECT MAX(id_camioneta) as maxim from camionetas3h";
    foreach ($db->query($maxsql) as $row) {
        $max = $row['maxim'];
    }

    for ($i = 1; $i <= $max; $i++) {

        try {
            $sql = "SELECT cc.patente,cc.modelo,cc.anio,cc.calidad,cc.chofer,ee.nombre as estado,MAX(c.kilometraje) as kilometraje,MAX(mc.kilometraje)+8000 as ProxMant, MAX(pc.fecha_fin) as pcir, MAX(sc.fecha_fin) as seguro , MAX(rt.fecha_fin) as revtc FROM camionetas3h cc LEFT JOIN mant_camionetas mc on cc.id_camioneta=mc.id_camioneta LEFT JOIN control_camionetas c on cc.id_camioneta = c.id_camioneta INNER JOIN estado_equipos ee on ee.id_est_equipo = cc.estado LEFT JOIN p_circulacion pc on cc.id_camioneta= pc.id_camioneta LEFT JOIN seguro_camionetas sc on sc.id_camioneta= cc.id_camioneta LEFT JOIN revision_tecnica rt on rt.id_camioneta = cc.id_camioneta WHERE cc.id_camioneta  = ".$i.";";
            foreach ($db->query($sql) as $row) {
    ?>
                <tr>
                    <td><?php echo $row['patente']; ?></td>
                    <td><?php echo strtoupper($row['modelo']); ?></td>        
                    <td> <?php echo $row['calidad']; ?></td>
                    <td> <?php echo strtoupper($row['chofer']); ?></td>
                    <td> <?php echo $row['estado']; ?></td>
                    <td> <?php echo  number_format($row['kilometraje'],0, ',', '.'); ?></td>
                    <td> <?php echo  number_format($row['ProxMant'],0, ',', '.'); ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row['pcir'])); ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row['seguro'])); ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row['revtc'])); ?></td>
                
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