<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    try {
        $sql = "SELECT c3.patente,c3.modelo,c3.marca,mc.fecha,mc.kilometraje,mc.check_list,mc.observaciones FROM mant_camionetas mc INNER JOIN camionetas3h c3 on mc.id_camioneta=c3.id_camioneta order by mc.fecha DESC;";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td><?php echo date("d-m-Y", strtotime($row['fecha'])); ?></td>
                <td color="red"><?php echo $row['patente']; ?></td>
                <td><?php echo $row['modelo']; ?></td>
                <td><?php echo $row['marca']; ?></td>
                <td><?php echo number_format($row['kilometraje'], 0, ',', '.'); ?></td>
                <td><?php echo $row['check_list']; ?></td>
                <td><?php echo strtoupper($row['observaciones']); ?></td>
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