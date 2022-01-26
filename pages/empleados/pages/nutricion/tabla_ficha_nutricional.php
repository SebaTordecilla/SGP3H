<tbody>
    <?php
    include "../../conexion.php";

    $database = new Connection();
    $db = $database->open();

    try {
        $sql = "SELECT e.id_empleado,e.rut, upper(concat(e.nombres,' ',ap_paterno,' ',ap_materno))as nombre,fn.peso,fn.talla,fn.imc,fn.grasa_corporal,fn.grasa_muscular,fn.grasa_visceral,fn.est_nutricional, fn.enfermedades, fn.habitos, fn.medicamentos, fn.alergias, fn.act_fisica  FROM ficha_nutricional fn inner join empleados e on fn.id_empleado = e.id_empleado ";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td><?php echo $row['rut']; ?></td>
                <td><?php echo strtoupper($row['nombre']); ?></td>
                <td><?php echo strtoupper($row['peso']); ?></td>
                <td><?php echo strtoupper($row['talla']); ?></td>
                <td><?php echo strtoupper($row['imc']); ?></td>
                <td><?php echo strtoupper($row['grasa_corporal']); ?></td>
                <td><?php echo strtoupper($row['grasa_muscular']); ?></td>
                <td><?php echo strtoupper($row['grasa_visceral']); ?></td>
                <td align="center">
                    <a href="#" onclick="editar_ficha('<?php echo $row['id_empleado']; ?>',	'<?php echo $row['peso']; ?>',	'<?php echo $row['talla']; ?>',	'<?php echo $row['imc']; ?>',	'<?php echo $row['grasa_corporal']; ?>',	'<?php echo $row['grasa_muscular']; ?>',	'<?php echo $row['grasa_visceral']; ?>',	'<?php echo $row['est_nutricional']; ?>',	'<?php echo $row['enfermedades']; ?>',	'<?php echo $row['habitos']; ?>',	'<?php echo $row['medicamentos']; ?>',	'<?php echo $row['alergias']; ?>',	'<?php echo $row['act_fisica']; ?>')"><small class="badge badge-success">Editar</small></a>
                    <a href="#" onclick="pdf_nutri('<?php echo $row['id_empleado']; ?>')"><small class="badge badge-danger">Pdf</small></a>
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