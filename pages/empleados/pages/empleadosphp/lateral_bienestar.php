<!--./menu lateral taller-->
<?php
$user = $_SESSION['uname'];

$sql_query = "SELECT id_nivel,permiso FROM usuarios WHERE nombre ='" . $user . "'";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$id_nivel = $row['id_nivel'];

if ($id_nivel != 10) {
    header("Location: ../../index.php");
}

?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <a href="modulo_bienestar.php" class="nav-link">
            <li class="nav-header">BIENESTAR</li>
        </a>
        <!--<li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon far fa-bookmark"></i>
                <p>
                    Muestras
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="modulo_geologia.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ingreso</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="hist_muestras_geo.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Hist. Muestras</p>
                    </a>
                </li>
            </ul>
        </li>
      
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon far fa-bookmark"></i>
                <p>
                    Coordenadas
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="modulo_geologia.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ingreso</p>
                    </a>
                </li>
            </ul>
        </li>-->
    </ul>
</nav>