<!--./menu lateral taller-->
<?php
$user = $_SESSION['uname'];

$sql_query = "SELECT id_nivel,permiso FROM usuarios WHERE nombre ='" . $user . "'";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$id_nivel = $row['id_nivel'];

if ($id_nivel != 5) {
    header("Location: ../../login.php");
}

?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <a href="modulo_laboratorio.php" class="nav-link">
            <li class="nav-header">LABORATORIO</li>
        </a>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon far fa-bookmark"></i>
                <p>
                    Muestras
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="muestras_geo.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Geologia</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="muestras_mina.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Mina</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="muestras_lotes.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lotes</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>