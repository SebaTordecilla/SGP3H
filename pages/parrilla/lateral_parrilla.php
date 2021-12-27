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
        <a href="modulo_parrilla.php" class="nav-link">
            <li class="nav-header">PARRILLA</li>
        </a>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon far fa-bookmark"></i>
                <p>
                    Extracción Mineral
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="nueva_extraccion.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nuevo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reporte_diario.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Reporte</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="informe_extraccion_mensual.php" class="nav-link">
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
                    Viajes Sulfuro
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="nueva_ingreso_oxido.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nuevo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="historico_hallazgos.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Activos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="historico_hallazgos_final.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Histórico</p>
                    </a>
                </li>

            </ul>
        </li>

        <!-- dos -->
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon far fa-bookmark"></i>
                <p>
                    Viajes Óxido
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="nueva_ingreso_oxido.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nuevo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reporte_lotes_oxido.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Reporte</p>
                    </a>
                </li>

            </ul>
        </li>

    </ul>



</nav>