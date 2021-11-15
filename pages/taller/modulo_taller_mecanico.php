<?php
include "../../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Minera 3H</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="../../dist/css/estilos.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small" id=login name=login>
              <?php echo $_SESSION['uname']; ?>
            </span>
          </a>
          <!-- modal salir -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Salir
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a class="brand-link">

        <img src="../../dist/img/logo3H.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">

        <span class="brand-text font-weight-light">SGP3H</span>
      </a>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Buscar">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php include("lateral_taller.php") ?>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  </aside>

  <!-- Contenido tablas-->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><img src="../../dist/img/equipos.png" width="60" height="50"> Taller Mecánico </h1>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!--dashboard-->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Equipos Operativos</h3>

              </div>
              <!-- -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <?php
                    for ($i = 1; $i < 7; $i++) {
                      $sql_query = "SELECT te.id_tequipo as id, te.nombre, COUNT(le.id_tequipo) as total, CASE te.id_tequipo when 1 then 'danger' when 2 then 'success' when 3 then 'warning' when 4 then 'info' when 5 then 'primary' when 6 then 'secondary'end as color FROM lista_equipos le INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo WHERE te.id_tequipo = " . $i . " GROUP BY le.id_tequipo";
                      $result = mysqli_query($con, $sql_query);
                      $row = mysqli_fetch_array($result);
                      $nombre = $row['nombre'];
                      $color = $row['color'];

                      $sql_query2 = "SELECT id_tequipo, COUNT(id_equipo) total,SUM(IF(id_est_equipo=1,1,0)) as activos FROM lista_equipos WHERE id_tequipo =" . $i . " GROUP by id_tequipo;";
                      $result2 = mysqli_query($con, $sql_query2);
                      $row2 = mysqli_fetch_array($result2);
                      $total = $row2['total'];
                      $activos = $row2['activos'];
                      $porcentaje = ($activos / $total) * 100;
                    ?>

                      <div class="progress-group">
                        <?php echo $nombre ?>
                        <span class="float-right"><b><?php echo $activos ?></b>/<?php echo $total ?></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-<?php echo $color ?>" style="width: <?php echo $porcentaje ?>%"></div>
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-7">
            <div class="card">
              <?php
              $sql_query0 = "SET lc_time_names = 'es_ES'";
              $result0 = mysqli_query($con, $sql_query0);
              $sql_query = "SELECT MONTHNAME(curdate()) AS mes";
              $result = mysqli_query($con, $sql_query);
              $row = mysqli_fetch_array($result);
              $mes = $row['mes'];

              ?>
              <div class="card-header">
                <h3 class="card-title">Gráfico Mensual Equipos Faena - <?php echo ucwords($mes) ?></h3>
              </div>
              <?php include "grafico_mes_actual.php" ?>
            </div>
          </div>

          <div class="col-md-3">
            <?php include "grafico_reparaciones.php" ?>
          </div>
        </div>
      </div>

      <!--  nueva columna tabla scoop-->
      <div class="row">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Tabla SCOOPS</h5>
            </div>
            <!--cuerpo etiqueta-->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table id="" class="table table-head-fixed text-nowrap">
                <!-- <table id="example2" class="table table-head-fixed text-nowrap"> -->

                <thead>
                  <tr>
                    <th>Equipo</th>
                    <th>%Mes</th>
                    <?php
                    $sql = "SELECT DAY(CURDATE()) AS dia;";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    $dia = $row['dia'] - 1;
                    for ($i = 1; $i <= $dia; $i++) { ?>
                      <th><?php echo $i ?></th>
                    <?php
                    }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = "SELECT id_equipo,sigla FROM lista_equipos WHERE id_tequipo = 1 and id_est_equipo=1;";

                    foreach ($db->query($sql) as $row) {
                  ?>
                      <tr>
                        <?php
                        $id0 = $row['id_equipo'];
                        $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                        $result0 = mysqli_query($con, $sql0);
                        $row0 = mysqli_fetch_array($result0);
                        $dia0 = $row0['dia'] - 1;
                        $mes0 = $row0['mes'];
                        $ano0 = $row0['ano'];

                        $sql1 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(hora_total))) FROM salida_equipos where id_equipo = " . $id0 . " AND fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_equipo = " . $id0 . ";";
                        $result1 = mysqli_query($con, $sql1);
                        $row1 = mysqli_fetch_array($result1);
                        $segundos = $row1['segundos'];
                        $totalmes = $dia0 * 36000;
                        $porcentajemes = number_format(($segundos / $totalmes) * 100, 0, ',', ' ');
                        /*poner color de texto*/
                        ?>
                        <td><b><?php echo $row['sigla']; ?></b></td>
                        <td><b></b><?php echo $porcentajemes ?>%</td>
                        <?php
                        $id = $row['id_equipo'];
                        $sql = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $dia1 = $row['dia'] - 1;
                        $mes = $row['mes'];
                        $ano = $row['ano'];

                        ?>

                        <?php
                        for ($j = 1; $j <= $dia1; $j++) {
                          // $sql = "SELECT TIME_TO_SEC(IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))))))) as final 
                          //   FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_estado_diario = 5 and rt.id_sal_equipo = (SELECT id_sal_equipo FROM salida_equipos WHERE id_equipo = " . $id . " and fecha = '" . $ano . "-" . $mes . "-" . $j . "') ORDER by se.fecha DESC;";
                          $sql = "SELECT time_to_sec(hora_total) as final FROM salida_equipos where id_equipo = " . $id . " and fecha = '" . $ano . "-" . $mes . "-" . $j . "'";
                          $result = mysqli_query($con, $sql);
                          $row = mysqli_fetch_array($result);
                          $final = $row['final'];
                          $r = ($final / 36000) * 100;
                          $re = number_format($r, 0, ',', ' ');

                          if ($re > 80) {
                        ?>
                            <td style="color: green"><?php echo $re ?>%</td>
                          <?php

                          } else {

                          ?>
                            <td style="color: red"><?php echo $re ?>%</td>
                        <?php
                          }
                        }
                        ?>
                      </tr>
                  <?php }
                  } catch (PDOException $e) {
                    echo "Existen problemas con la conexión: " . $e->getMessage();
                  } ?>
                </tbody>

                <tfoot>
                  <tr>
                    <th>Scoop Operativos</th>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];
                    $sql11 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and se.fecha between '" . $ano0 . "-" . $mes0 . "-01' and '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "'";
                    $result11 = mysqli_query($con, $sql11);
                    $row11 = mysqli_fetch_array($result11);
                    $cantidad = $row11['cantidad'];
                    $promedioflota = number_format(($cantidad / $dia0), 1, ',', '');

                    ?>
                    <td><b><?php echo $promedioflota ?></b></td>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];

                    for ($i = 1; $i <= $dia0; $i++) {
                      $sql1 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and se.fecha = '" . $ano0 . "-" . $mes0 . "-" . $i . "'";
                      $result1 = mysqli_query($con, $sql1);
                      $row1 = mysqli_fetch_array($result1);
                      $cantidad = $row1['cantidad'];

                    ?>
                      <td><b><?php echo $cantidad ?></b></td>
                    <?php
                    }
                    ?>
                  </tr>
                </tfoot>
                <tfoot>
                  <tr>
                    <th>Promedio FLota</th>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];

                    $sql22 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and le.id_est_equipo = 1 
                      AND se.fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
                      INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 1 and le.id_est_equipo = 1";
                    $result22 = mysqli_query($con, $sql22);
                    $row22 = mysqli_fetch_array($result22);
                    $segtotalmes = $row22['segundos'];
                    $cantidadtotal = $row22['total'];

                    $segmestotal = 10 * 3600 * $dia0 * $cantidadtotal;

                    $porcentajeflota = number_format(($segtotalmes / $segmestotal) * 100, 0, ',', '');

                    ?>

                    <td><b><?php echo $porcentajeflota ?>%</b></td>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];

                    for ($i = 1; $i <= $dia0; $i++) {
                      $sql33 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and le.id_est_equipo = 1 AND se.fecha = '" . $ano0 . "-" . $mes0 . "-" . $i . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
                        INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 1 and le.id_est_equipo = 1 ";
                      $result33 = mysqli_query($con, $sql33);
                      $row33 = mysqli_fetch_array($result33);
                      $cantequipos = $row33['total'];
                      $segdiarios = $row33['segundos'];
                      $segmestotal2 = 10 * 3600 * $cantequipos;

                      $porcentajediarioflota = number_format(($segdiarios / $segmestotal2) * 100, 0, ',', '');

                    ?>
                      <td><b><?php echo $porcentajediarioflota ?>%</b></td>
                    <?php
                    }
                    ?>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>


        <div class="col-md-2">
          <div class="card card">
            <div class="card-header">
              <h3 class="card-title">SCOOPS</h3>
            </div>
            <div class="card-body">
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-success">
                <div class="info-box-content">
                  <span class="info-box-text">Promedio Flota</span>
                  <?php
                  $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                  $result0 = mysqli_query($con, $sql0);
                  $row0 = mysqli_fetch_array($result0);
                  $dia0 = $row0['dia'] - 1;
                  $mes0 = $row0['mes'];
                  $ano0 = $row0['ano'];

                  $sql22 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and le.id_est_equipo = 1 
                      AND se.fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
                      INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 1 and le.id_est_equipo = 1";
                  $result22 = mysqli_query($con, $sql22);
                  $row22 = mysqli_fetch_array($result22);
                  $segtotalmes = $row22['segundos'];
                  $cantidadtotal = $row22['total'];

                  $segmestotal = 10 * 3600 * $dia0 * $cantidadtotal;

                  $porcentajeflota = number_format(($segtotalmes / $segmestotal) * 100, 0, ',', '');

                  ?>
                  <span class="info-box-number"><?php echo $porcentajeflota ?> %</span>
                </div>
              </div>
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-info">
                <div class="info-box-content">
                  <span class="info-box-text">Scoops Operativos</span>
                  <?php
                  $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                  $result0 = mysqli_query($con, $sql0);
                  $row0 = mysqli_fetch_array($result0);
                  $dia0 = $row0['dia'] - 1;
                  $mes0 = $row0['mes'];
                  $ano0 = $row0['ano'];
                  $sql11 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 1 and se.fecha between '" . $ano0 . "-" . $mes0 . "-01' and '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "'";
                  $result11 = mysqli_query($con, $sql11);
                  $row11 = mysqli_fetch_array($result11);
                  $cantidad = $row11['cantidad'];
                  $promedioflota = number_format(($cantidad / $dia0), 1, ',', '');

                  ?>
                  <span class="info-box-number"><?php echo $promedioflota ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--  fin nueva columna-->
      </div>


      <!--  nueva columna tabla cargador-->
      <div class="row">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Tabla CARGADORES</h5>
            </div>
            <!--cuerpo etiqueta-->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <!-- <table id="example3" class="table table-head-fixed text-nowrap"> -->
              <table id="" class="table table-head-fixed text-nowrap">

                <thead>
                  <tr>
                    <th>Equipo</th>
                    <th>%Mes</th>
                    <?php
                    $sql = "SELECT DAY(CURDATE()) AS dia;";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    $dia = $row['dia'] - 1;
                    for ($i = 1; $i <= $dia; $i++) { ?>
                      <th><?php echo $i ?></th>
                    <?php
                    }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = "SELECT id_equipo,sigla FROM lista_equipos WHERE id_tequipo = 2 and id_est_equipo=1;";

                    foreach ($db->query($sql) as $row) {
                  ?>
                      <tr>
                        <?php
                        $id0 = $row['id_equipo'];
                        $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                        $result0 = mysqli_query($con, $sql0);
                        $row0 = mysqli_fetch_array($result0);
                        $dia0 = $row0['dia'] - 1;
                        $mes0 = $row0['mes'];
                        $ano0 = $row0['ano'];

                        $sql1 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(hora_total))) FROM salida_equipos where id_equipo = " . $id0 . " AND fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_equipo = " . $id0 . ";";
                        $result1 = mysqli_query($con, $sql1);
                        $row1 = mysqli_fetch_array($result1);
                        $segundos = $row1['segundos'];
                        $totalmes = $dia0 * 36000;
                        $porcentajemes = number_format(($segundos / $totalmes) * 100, 0, ',', ' ');
                        /*poner color de texto*/
                        ?>
                        <td><b><?php echo $row['sigla']; ?></b></td>
                        <td><b></b><?php echo $porcentajemes ?>%</td>
                        <?php
                        $id = $row['id_equipo'];
                        $sql = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $dia1 = $row['dia'] - 1;
                        $mes = $row['mes'];
                        $ano = $row['ano'];

                        ?>

                        <?php
                        for ($j = 1; $j <= $dia1; $j++) {
                          // $sql = "SELECT TIME_TO_SEC(IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))))))) as final 
                          //   FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_estado_diario = 5 and rt.id_sal_equipo = (SELECT id_sal_equipo FROM salida_equipos WHERE id_equipo = " . $id . " and fecha = '" . $ano . "-" . $mes . "-" . $j . "') ORDER by se.fecha DESC;";
                          $sql = "SELECT time_to_sec(hora_total) as final FROM salida_equipos where id_equipo = " . $id . " and fecha = '" . $ano . "-" . $mes . "-" . $j . "'";

                          $result = mysqli_query($con, $sql);
                          $row = mysqli_fetch_array($result);
                          $final = $row['final'];
                          $r = ($final / 36000) * 100;
                          $re = number_format($r, 0, ',', ' ');

                          if ($re > 80) {
                        ?>
                            <td style="color: green"><?php echo $re ?>%</td>
                          <?php

                          } else {

                          ?>
                            <td style="color: red"><?php echo $re ?>%</td>
                        <?php
                          }
                        }
                        ?>
                      </tr>
                  <?php }
                  } catch (PDOException $e) {
                    echo "Existen problemas con la conexión: " . $e->getMessage();
                  } ?>
                </tbody>

                <tfoot>
                  <tr>
                    <th>Cargadores Operativos</th>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];
                    $sql11 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 2 and se.fecha between '" . $ano0 . "-" . $mes0 . "-01' and '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "'";
                    $result11 = mysqli_query($con, $sql11);
                    $row11 = mysqli_fetch_array($result11);
                    $cantidad = $row11['cantidad'];
                    $promedioflota = number_format(($cantidad / $dia0), 1, ',', '');

                    ?>
                    <td><b><?php echo $promedioflota ?></b></td>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];

                    for ($i = 1; $i <= $dia0; $i++) {
                      $sql1 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 2 and le.id_est_equipo = 1 and se.fecha = '" . $ano0 . "-" . $mes0 . "-" . $i . "'";
                      $result1 = mysqli_query($con, $sql1);
                      $row1 = mysqli_fetch_array($result1);
                      $cantidad = $row1['cantidad'];

                    ?>
                      <td><b><?php echo $cantidad ?></b></td>
                    <?php
                    }
                    ?>
                  </tr>
                </tfoot>
                <tfoot>
                  <tr>
                    <th>Promedio FLota</th>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];

                    $sql22 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 2 and le.id_est_equipo = 1 
                      AND se.fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
                      INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 2 and le.id_est_equipo = 1";
                    $result22 = mysqli_query($con, $sql22);
                    $row22 = mysqli_fetch_array($result22);
                    $segtotalmes = $row22['segundos'];
                    $cantidadtotal = $row22['total'];

                    $segmestotal = 10 * 3600 * $dia0 * $cantidadtotal;

                    $porcentajeflota = number_format(($segtotalmes / $segmestotal) * 100, 0, ',', '');

                    ?>

                    <td><b><?php echo $porcentajeflota ?>%</b></td>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];

                    for ($i = 1; $i <= $dia0; $i++) {
                      $sql33 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 2 and le.id_est_equipo = 1 AND se.fecha = '" . $ano0 . "-" . $mes0 . "-" . $i . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
                        INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 2 and le.id_est_equipo = 1 ";
                      $result33 = mysqli_query($con, $sql33);
                      $row33 = mysqli_fetch_array($result33);
                      $cantequipos = $row33['total'] - 2;
                      $segdiarios = $row33['segundos'];
                      $segmestotal2 = 10 * 3600 * $cantequipos;

                      $porcentajediarioflota = number_format(($segdiarios / $segmestotal2) * 100, 0, ',', '');

                    ?>
                      <td><b><?php echo $porcentajediarioflota ?>%</b></td>
                    <?php
                    }
                    ?>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="card card">
            <div class="card-header">
              <h3 class="card-title">CARGADORES</h3>
            </div>
            <div class="card-body">
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-success">
                <div class="info-box-content">
                  <span class="info-box-text">Promedio Flota</span>
                  <?php
                  $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                  $result0 = mysqli_query($con, $sql0);
                  $row0 = mysqli_fetch_array($result0);
                  $dia0 = $row0['dia'] - 1;
                  $mes0 = $row0['mes'];
                  $ano0 = $row0['ano'];

                  $sql22 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 2 and le.id_est_equipo = 1 
                      AND se.fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
                      INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 2 and le.id_est_equipo = 1";
                  $result22 = mysqli_query($con, $sql22);
                  $row22 = mysqli_fetch_array($result22);
                  $segtotalmes = $row22['segundos'];
                  $cantidadtotal = $row22['total'];

                  $segmestotal = 10 * 3600 * $dia0 * $cantidadtotal;

                  $porcentajeflota = number_format(($segtotalmes / $segmestotal) * 100, 0, ',', '');

                  ?>
                  <span class="info-box-number"><?php echo $porcentajeflota ?> %</span>
                </div>
              </div>
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-info">
                <div class="info-box-content">
                  <span class="info-box-text">Carg. Operativos</span>
                  <?php
                  $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                  $result0 = mysqli_query($con, $sql0);
                  $row0 = mysqli_fetch_array($result0);
                  $dia0 = $row0['dia'] - 1;
                  $mes0 = $row0['mes'];
                  $ano0 = $row0['ano'];
                  $sql11 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 2 and se.fecha between '" . $ano0 . "-" . $mes0 . "-01' and '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "'";
                  $result11 = mysqli_query($con, $sql11);
                  $row11 = mysqli_fetch_array($result11);
                  $cantidad = $row11['cantidad'];
                  $promedioflota = number_format(($cantidad / $dia0), 1, ',', '');

                  ?>
                  <span class="info-box-number"><?php echo $promedioflota ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  fin nueva columna-->



      <!--  nueva columna tabla dumper-->
      <div class="row">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Tabla DUMPERS</h5>
            </div>
            <!--cuerpo etiqueta-->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <!-- <table id="example4" class="table table-head-fixed text-nowrap"> -->
              <table id="" class="table table-head-fixed text-nowrap">

                <thead>
                  <tr>
                    <th>Equipo</th>
                    <th>%Mes</th>
                    <?php
                    $sql = "SELECT DAY(CURDATE()) AS dia;";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    $dia = $row['dia'] - 1;
                    for ($i = 1; $i <= $dia; $i++) { ?>
                      <th><?php echo $i ?></th>
                    <?php
                    }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = "SELECT id_equipo,sigla FROM lista_equipos WHERE id_tequipo = 5 and id_est_equipo=1;";

                    foreach ($db->query($sql) as $row) {
                  ?>
                      <tr>
                        <?php
                        $id0 = $row['id_equipo'];
                        $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                        $result0 = mysqli_query($con, $sql0);
                        $row0 = mysqli_fetch_array($result0);
                        $dia0 = $row0['dia'] - 1;
                        $mes0 = $row0['mes'];
                        $ano0 = $row0['ano'];

                        $sql1 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(hora_total))) FROM salida_equipos where id_equipo = " . $id0 . " AND fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_equipo = " . $id0 . ";";
                        $result1 = mysqli_query($con, $sql1);
                        $row1 = mysqli_fetch_array($result1);
                        $segundos = $row1['segundos'];
                        $totalmes = $dia0 * 36000;
                        $porcentajemes = number_format(($segundos / $totalmes) * 100, 0, ',', ' ');
                        /*poner color de texto*/
                        ?>
                        <td><b><?php echo $row['sigla']; ?></b></td>
                        <td><b></b><?php echo $porcentajemes ?>%</td>
                        <?php
                        $id = $row['id_equipo'];
                        $sql = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $dia1 = $row['dia'] - 1;
                        $mes = $row['mes'];
                        $ano = $row['ano'];

                        ?>

                        <?php
                        for ($j = 1; $j <= $dia1; $j++) {
                          // $sql = "SELECT TIME_TO_SEC(IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))))))) as final 
                          //   FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_estado_diario = 5 and rt.id_sal_equipo = (SELECT id_sal_equipo FROM salida_equipos WHERE id_equipo = " . $id . " and fecha = '" . $ano . "-" . $mes . "-" . $j . "') ORDER by se.fecha DESC;";
                          $sql = "SELECT time_to_sec(hora_total) as final FROM salida_equipos where id_equipo = " . $id . " and fecha = '" . $ano . "-" . $mes . "-" . $j . "'";

                          $result = mysqli_query($con, $sql);
                          $row = mysqli_fetch_array($result);
                          $final = $row['final'];
                          $r = ($final / 36000) * 100;
                          $re = number_format($r, 0, ',', ' ');

                          if ($re > 80) {
                        ?>
                            <td style="color: green"><?php echo $re ?>%</td>
                          <?php

                          } else {

                          ?>
                            <td style="color: red"><?php echo $re ?>%</td>
                        <?php
                          }
                        }
                        ?>
                      </tr>
                  <?php }
                  } catch (PDOException $e) {
                    echo "Existen problemas con la conexión: " . $e->getMessage();
                  } ?>
                </tbody>

                <tfoot>
                  <tr>
                    <th>Dumpers Operativos</th>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];
                    $sql11 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 5 and se.fecha between '" . $ano0 . "-" . $mes0 . "-01' and '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "'";
                    $result11 = mysqli_query($con, $sql11);
                    $row11 = mysqli_fetch_array($result11);
                    $cantidad = $row11['cantidad'];
                    $promedioflota = number_format(($cantidad / $dia0), 1, ',', '');

                    ?>
                    <td><b><?php echo $promedioflota ?></b></td>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];

                    for ($i = 1; $i <= $dia0; $i++) {
                      $sql1 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 5 and le.id_est_equipo = 1 and se.fecha = '" . $ano0 . "-" . $mes0 . "-" . $i . "'";
                      $result1 = mysqli_query($con, $sql1);
                      $row1 = mysqli_fetch_array($result1);
                      $cantidad = $row1['cantidad'];

                    ?>
                      <td><b><?php echo $cantidad ?></b></td>
                    <?php
                    }
                    ?>
                  </tr>
                </tfoot>
                <tfoot>
                  <tr>
                    <th>Promedio FLota</th>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];

                    $sql22 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 5 and le.id_est_equipo = 1 
                      AND se.fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
                      INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 5 and le.id_est_equipo = 1";
                    $result22 = mysqli_query($con, $sql22);
                    $row22 = mysqli_fetch_array($result22);
                    $segtotalmes = $row22['segundos'];
                    $cantidadtotal = $row22['total'];

                    $segmestotal = 10 * 3600 * $dia0 * $cantidadtotal;

                    $porcentajeflota = number_format(($segtotalmes / $segmestotal) * 100, 0, ',', '');

                    ?>

                    <td><b><?php echo $porcentajeflota ?>%</b></td>
                    <?php
                    $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                    $result0 = mysqli_query($con, $sql0);
                    $row0 = mysqli_fetch_array($result0);
                    $dia0 = $row0['dia'] - 1;
                    $mes0 = $row0['mes'];
                    $ano0 = $row0['ano'];

                    for ($i = 1; $i <= $dia0; $i++) {
                      $sql33 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 5 and le.id_est_equipo = 1 AND se.fecha = '" . $ano0 . "-" . $mes0 . "-" . $i . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
                        INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 5 and le.id_est_equipo = 1 ";
                      $result33 = mysqli_query($con, $sql33);
                      $row33 = mysqli_fetch_array($result33);
                      $cantequipos = $row33['total'] - 2;
                      $segdiarios = $row33['segundos'];
                      $segmestotal2 = 10 * 3600 * $cantequipos;

                      $porcentajediarioflota = number_format(($segdiarios / $segmestotal2) * 100, 0, ',', '');

                    ?>
                      <td><b><?php echo $porcentajediarioflota ?>%</b></td>
                    <?php
                    }
                    ?>
                  </tr>
                </tfoot>

              </table>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="card card">
            <div class="card-header">
              <h3 class="card-title">DUMPERS</h3>
            </div>
            <div class="card-body">
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-success">
                <div class="info-box-content">
                  <span class="info-box-text">Promedio Flota</span>
                  <?php
                  $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                  $result0 = mysqli_query($con, $sql0);
                  $row0 = mysqli_fetch_array($result0);
                  $dia0 = $row0['dia'] - 1;
                  $mes0 = $row0['mes'];
                  $ano0 = $row0['ano'];

                  $sql22 = "SELECT DISTINCT (SELECT (SUM(TIME_TO_SEC(se.hora_total))) FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 5 and le.id_est_equipo = 1 
                      AND se.fecha BETWEEN '" . $ano0 . "-" . $mes0 . "-01' AND '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "') as segundos, count(le.id_tequipo) as total FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo 
                      INNER JOIN estado_equipos ee on ee.id_est_equipo = le.id_est_equipo WHERE le.id_tequipo = 5 and le.id_est_equipo = 1";
                  $result22 = mysqli_query($con, $sql22);
                  $row22 = mysqli_fetch_array($result22);
                  $segtotalmes = $row22['segundos'];
                  $cantidadtotal = $row22['total'];

                  $segmestotal = 10 * 3600 * $dia0 * $cantidadtotal;

                  $porcentajeflota = number_format(($segtotalmes / $segmestotal) * 100, 0, ',', '');

                  ?>
                  <span class="info-box-number"><?php echo $porcentajeflota ?> %</span>
                </div>
              </div>
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-info">
                <div class="info-box-content">
                  <span class="info-box-text">Dumpers Operativos</span>
                  <?php
                  $sql0 = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                  $result0 = mysqli_query($con, $sql0);
                  $row0 = mysqli_fetch_array($result0);
                  $dia0 = $row0['dia'] - 1;
                  $mes0 = $row0['mes'];
                  $ano0 = $row0['ano'];
                  $sql11 = "SELECT count(se.id_sal_equipo) as cantidad FROM salida_equipos se inner join lista_equipos le on se.id_equipo = le.id_equipo where le.id_tequipo = 5 and se.fecha between '" . $ano0 . "-" . $mes0 . "-01' and '" . $ano0 . "-" . $mes0 . "-" . $dia0 . "'";
                  $result11 = mysqli_query($con, $sql11);
                  $row11 = mysqli_fetch_array($result11);
                  $cantidad = $row11['cantidad'];
                  $promedioflota = number_format(($cantidad / $dia0), 1, ',', '');

                  ?>
                  <span class="info-box-number"><?php echo $promedioflota ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  fin nueva columna-->
    </section>

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!--Footer sin nada-->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Seguro quieres Salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <a class="btn btn-primary naranjo" href="../logout.php">Salir</a>
        </div>
      </div>
    </div>
  </div>



  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script src="../funcionesjs/funciones_taller.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</body>

</html>

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false, //cambiar cantidad de datos visibles
      "autoWidth": true,
      "buttons": ["excel", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
    $('#example4').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>