<!--./menu lateral taller-->
<?php
$user = $_SESSION['uname'];

$sql_query = "SELECT id_nivel,permiso FROM usuarios WHERE nombre ='" . $user . "'";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$id_nivel = $row['id_nivel'];

if ($id_nivel != 2) {
    header("Location: ../../login.php");
}

?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!--<li class="nav-header">TALLER</li>-->
        <a href="modulo_taller_mecanico.php" class="nav-link">
            <li class="nav-header">TALLER</li>
        </a>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon far fa-bookmark"></i>
                <p>
                    Equipos
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="equipos_taller.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista Equipos</p>
                    </a>
                </li>

        </li>
        <li class="nav-item">
            <a href="historial_mantenciones.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Mant.Equipos</p>
            </a>
        </li>
    </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-bookmark"></i>
            <!--<i class="nav-icon far fa-edit"></i>-->
            <p>
                Reparaciones
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="reparacion_terreno.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Terreno</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="historial_rep_terreno.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Hist. Reparaciones</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-bookmark"></i>
            <!--<i class="nav-icon far fa-edit"></i>-->
            <p>
                Planificación
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="planificacion.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Salidas Diarias</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="historial_salida_equipos.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Hist. Salidas</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-bookmark"></i>
            <!--<i class="nav-icon far fa-edit"></i>-->
            <p>
                Informes
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="disponibilidad.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Disponibilidad</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="informe_equipo.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Equipos</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-bookmark"></i>
            <p>
                Camionetas
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="camionetas.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista Camionetas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="control_semanal_camionetas.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Control Semanal</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="mantenciones_camionetas.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mant.Camionetas</p>
                </a>
            </li>
        </ul>
    </li>
    </ul>
</nav>