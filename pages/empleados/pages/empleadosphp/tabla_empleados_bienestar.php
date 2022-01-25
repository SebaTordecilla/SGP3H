<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    try {
        $sql = "SELECT * from empleados ";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td><?php echo $row['rut']; ?></td>
                <td><?php echo strtoupper($row['nombres']); ?></td>
                <td><?php echo strtoupper($row['ap_paterno']); ?></td>
                <td><?php echo strtoupper($row['ap_materno']); ?></td>
                <td><?php echo date("d/m/Y", strtotime($row['fecha_nac'])); ?></td>
                <td><?php echo strtoupper($row['cargo']); ?></td>
                <td align="center">
                    <a href="#" onclick="editar_trabajador('<?php echo $row['id_empleado']; ?>','<?php echo $row['rut']; ?>','<?php echo $row['nombres']; ?>','<?php echo $row['ap_paterno']; ?>',	'<?php echo $row['ap_materno']; ?>',	'<?php echo $row['fecha_nac']; ?>',	'<?php echo $row['nacionalidad']; ?>',	'<?php echo $row['sexo']; ?>',	'<?php echo $row['est_civil']; ?>',	'<?php echo $row['cargo']; ?>',	'<?php echo $row['fecha_ing']; ?>',	'<?php echo $row['correo']; ?>',	'<?php echo $row['telefono']; ?>',	'<?php echo $row['tipo_contrato']; ?>',	'<?php echo $row['contacto_emergencia']; ?>',	'<?php echo $row['titulo']; ?>',	'<?php echo $row['nivel_estudios']; ?>',	'<?php echo $row['fecha_matrimonio']; ?>',	'<?php echo $row['enfermedad_cronica']; ?>',	'<?php echo $row['rsh']; ?>',	'<?php echo $row['tratamiento']; ?>',	'<?php echo $row['discapacidad']; ?>',	'<?php echo $row['tipo_discapacidad']; ?>',	'<?php echo $row['prog_interv']; ?>',	'<?php echo $row['estado']; ?>')"><small class="badge badge-success">Editar</small></a>
                    <a href="#" onclick="pdf_bienestar('<?php echo $row['id_empleado']; ?>')"><small class="badge badge-danger">Pdf</small></a>
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