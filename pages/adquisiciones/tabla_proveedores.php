<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();
    try {

        $sql = "SELECT id_proveedor,upper(nombre) as nombre, upper(direccion) as direccion, rut FROM proveedores";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td><?php echo $row['rut']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['direccion']; ?></td>
                <td align="center">
                    <a href="#" onclick="edit_proveedor('<?php echo $row['id_proveedor']; ?>','<?php echo $row['rut']; ?>','<?php echo $row['nombre']; ?>','<?php echo $row['direccion']; ?>')"><small class="badge badge-success">Edit</small></a>
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