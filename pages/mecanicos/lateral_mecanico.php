<!--./menu lateral taller-->
<?php
$user = $_SESSION['uname'];

$sql_query = "SELECT id_nivel,permiso FROM usuarios WHERE nombre ='" . $user . "'";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$id_nivel = $row['id_nivel'];

if ($id_nivel != 7) {
    //header("Location: ../../login.php");
}

?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!--<li class="nav-header">TALLER</li>-->
        <a href="modulo_supervisor.php" class="nav-link">
            <li class="nav-header">TERRENO</li>
        </a>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon far fa-bookmark"></i>
                <p>
                    Acciones
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="equipos_super.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Equipos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="colacion_diaria.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Colación</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reparacion_terreno.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Reparación</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="incidentes_mina.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Incidentes</p>
                    </a>
                </li>

            </ul>
        </li>

    </ul>

</nav>