<!--./menu lateral taller-->
<?php
$user = $_SESSION['uname'];

$sql_query = "SELECT id_nivel,permiso FROM usuarios WHERE nombre ='" . $user . "'";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$id_nivel = $row['id_nivel'];

if ($id_nivel != 8) {
    header("Location: ../../login.php");
}

?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <a href="modulo_adquisiciones.php" class="nav-link">
            <li class="nav-header">ADQUISICIONES</li>
        </a>
         <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon far fa-bookmark"></i>
                <p>
                    Solicitudes de Compra
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="solicitudes_compra.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nuevo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="solicitudes_activas.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Activas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="informe_solicitudes.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Informe</p>
                    </a>
                </li> 

            </ul>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon far fa-bookmark"></i>
                <p>
                    Ordenes de Compra
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="modulo_adquisiciones.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nuevo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="oc_activas.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Activas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reporte_guias_sulf.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Informe</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon far fa-bookmark"></i>
                <p>
                    Proveedores
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="proveedores.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
            </ul>
        </li>

    </ul>



</nav>