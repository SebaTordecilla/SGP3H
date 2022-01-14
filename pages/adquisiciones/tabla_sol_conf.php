<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();
    try {
        $sql = "SELECT id_pedido FROM solicitudes_compra where estado = 2";
        foreach ($db->query($sql) as $row) {

            $sql = "SELECT sc.id_solicitud,sc.area ,sc.id_pedido, upper(sc.solicitado) as solicitado, sc.hora, sc.fecha, a.nombre as area1, sc.prioridad, sc.justificacion 
            , count(oc.id_oc) as num_oc,(SELECT sum(a.cantidad)  FROM solicitudes_compra sc left join articulos_solicitados a on sc.id_pedido = a.id_pedido where sc.id_pedido = " . $row['id_pedido'] . ") as cant_sol,
            (SELECT sum(aoc.cantidad) FROM solicitudes_compra sc left join articulos_oc aoc on sc.id_pedido = aoc.id_pedido where sc.id_pedido = " . $row['id_pedido'] . ") as cant_oc
            FROM solicitudes_compra sc inner join areas3h a on sc.area = a.id_area left join ordenes_compras oc on sc.id_pedido = oc.id_pedido
            where sc.estado = 2 and sc.id_pedido = " . $row['id_pedido'] . "";
            foreach ($db->query($sql) as $row) {
    ?>
                <tr>
                    <td><?php echo $row['id_pedido']; ?></td>
                    <td><?php echo $row['solicitado']; ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row['fecha'])); ?></td>
                    <td><?php echo $row['area1']; ?></td>
                    <td><?php echo $row['prioridad']; ?></td>
                    <td><?php echo $row['cant_sol']; ?></td>
                    <td><?php echo $row['cant_oc']; ?></td>
                    <td><?php echo number_format((($row['cant_oc']) / ($row['cant_sol'])) * 100, 0, ",", "."); ?>%</td>

                    <td align="center">
                        <a href="#" onclick="pdf_sol('<?php echo $row['id_pedido']; ?>')"><small class="badge badge-danger">pdf</small></a>
                        <a href="#" onclick="oc_sol('<?php echo $row['id_pedido']; ?>')"><small class="badge badge-success">OC</small></a>
                        <a href="#" onclick="cerrar_sol('<?php echo $row['id_solicitud']; ?>')"><small class="badge badge-warning">Cerrar</small></a>

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