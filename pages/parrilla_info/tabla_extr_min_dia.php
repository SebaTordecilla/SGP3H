<?php
include('../../conexion.php');
$fecha = $_POST['fecha'];
if ($fecha == "") {

    $resultado = $mysqli->query("SELECT em.id_extmin, em.fecha,um.nombre as id_ubicacion1,le.sigla as id_equipo1, upper(o.nombre) as id_op1, 
    if(em.id_labor=0, concat(m.coordenada,' ',c.coordenada),concat(m.coordenada,' ',c.coordenada, ' ',l.coordenada)) as coordenada, mn.nombre as tipo, osm.nombre as observaciones
    ,if(em.hora1='00:00:00',0,1) as h1,if(em.hora2='00:00:00',0,1)as h2,if(em.hora3='00:00:00',0,1)as h3,if(em.hora4='00:00:00',0,1)as h4,if(em.hora5='00:00:00',0,1)as h5
    ,em.id_ubicacion,em.id_manto,em.id_calle,em.id_labor,em.id_equipo,em.id_op,	em.id_mineral,em.id_obs_min,
    if(em.hora1='00:00:00',' ',em.hora1) as hora1,if(em.hora2='00:00:00',' ',em.hora2) as hora2,if(em.hora3='00:00:00',' ',em.hora3) as hora3,	if(em.hora4='00:00:00',' ',em.hora4) as hora4,
    if(em.hora5='00:00:00',' ',em.hora5) as hora5 FROM extraccion_mineral em inner join lista_equipos le on em.id_equipo= le.id_equipo inner join ubicaciones_minas um on em.id_ubicacion = um.id_ubicacion
    inner join operadores o on em.id_op = o.id_op inner join mantos m on m.id_manto = em.id_manto inner join calles c on c.id_calle = em.id_calle left join levantes l on l.id_levante = em.id_labor
    inner join minerales mn on mn.id_mineral = em.id_mineral left join observaciones_minerales osm on em.id_obs_min = osm.id_obs_min where em.estado =2 and fecha = CURDATE();");

    $total = $resultado->num_rows;

    if ($total > 0) {
        $tabla = "<table id=\"example1\" class=\"table table-sm\">";
        $tabla .= "<thead><tr><th>Mina</th><th>Dumper</th><th>Operador</th><th>Coordenada</th><th>Tipo</th><th>Observaciones</th><th>Hora1</th><th>Hora2</th><th>Hora3</th><th>Hora4</th><th>Hora5</th></tr></thead>";
        while ($row = $resultado->fetch_assoc()) {

            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['id_ubicacion1'] . "</td>";
            $tabla .= "<td>" . $row['id_equipo1'] . "</td>";
            $tabla .= "<td>" . $row['id_op1'] . "</td>";
            $tabla .= "<td>" . $row['coordenada'] . "</td>";
            $tabla .= "<td>" . $row['tipo'] . "</td>";
            $tabla .= "<td>" . $row['observaciones'] . "</td>";
            $tabla .= "<td>" . $row['hora1'] . "</td>";
            $tabla .= "<td>" . $row['hora2'] . "</td>";
            $tabla .= "<td>" . $row['hora3'] . "</td>";
            $tabla .= "<td>" . $row['hora4'] . "</td>";
            $tabla .= "<td>" . $row['hora5'] . "</td>";
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
        echo $tabla;
    } else {
        echo "Sin Información";
    }
} else if ($fecha != "") {
    //echo "Sin Información";
    $resultado = $mysqli->query("SELECT em.id_extmin, em.fecha,um.nombre as id_ubicacion1,le.sigla as id_equipo1, upper(o.nombre) as id_op1, 
    if(em.id_labor=0, concat(m.coordenada,' ',c.coordenada),concat(m.coordenada,' ',c.coordenada, ' ',l.coordenada)) as coordenada, mn.nombre as tipo, osm.nombre as observaciones
    ,if(em.hora1='00:00:00',0,1) as h1,if(em.hora2='00:00:00',0,1)as h2,if(em.hora3='00:00:00',0,1)as h3,if(em.hora4='00:00:00',0,1)as h4,if(em.hora5='00:00:00',0,1)as h5
    ,em.id_ubicacion,em.id_manto,em.id_calle,em.id_labor,em.id_equipo,em.id_op,	em.id_mineral,em.id_obs_min,
    if(em.hora1='00:00:00',' ',em.hora1) as hora1,if(em.hora2='00:00:00',' ',em.hora2) as hora2,if(em.hora3='00:00:00',' ',em.hora3) as hora3,	if(em.hora4='00:00:00',' ',em.hora4) as hora4,
    if(em.hora5='00:00:00',' ',em.hora5) as hora5 FROM extraccion_mineral em inner join lista_equipos le on em.id_equipo= le.id_equipo inner join ubicaciones_minas um on em.id_ubicacion = um.id_ubicacion
    inner join operadores o on em.id_op = o.id_op inner join mantos m on m.id_manto = em.id_manto LEFT join calles c on c.id_calle = em.id_calle left join levantes l on l.id_levante = em.id_labor
    inner join minerales mn on mn.id_mineral = em.id_mineral left join observaciones_minerales osm on em.id_obs_min = osm.id_obs_min where em.estado =2 and fecha = '" . $fecha . "';");

    $total = $resultado->num_rows;

    if ($total > 0) {
        $tabla = "<table id=\"example1\" class=\"table table-sm\">";
        $tabla .= "<thead><tr><th>Mina</th><th>Dumper</th><th>Operador</th><th>Coordenada</th><th>Tipo</th><th>Observaciones</th><th>Hora1</th><th>Hora2</th><th>Hora3</th><th>Hora4</th><th>Hora5</th></tr></thead>";
        while ($row = $resultado->fetch_assoc()) {

            $tabla .= "<tr>";
            $tabla .= "<td>" . $row['id_ubicacion1'] . "</td>";
            $tabla .= "<td>" . $row['id_equipo1'] . "</td>";
            $tabla .= "<td>" . $row['id_op1'] . "</td>";
            $tabla .= "<td>" . $row['coordenada'] . "</td>";
            $tabla .= "<td>" . $row['tipo'] . "</td>";
            $tabla .= "<td>" . $row['observaciones'] . "</td>";
            $tabla .= "<td>" . $row['hora1'] . "</td>";
            $tabla .= "<td>" . $row['hora2'] . "</td>";
            $tabla .= "<td>" . $row['hora3'] . "</td>";
            $tabla .= "<td>" . $row['hora4'] . "</td>";
            $tabla .= "<td>" . $row['hora5'] . "</td>";
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
        echo $tabla;
    } else {
        echo "Sin Información";
    }
}

?>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>