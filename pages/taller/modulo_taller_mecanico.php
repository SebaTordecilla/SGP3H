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
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Equipos Operativos</strong>
                    </p>
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
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <!--<h5 class="card-title">Monthly Recap Report</h5>-->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <img src="../../dist/img/topo3H.png" style="max-width:60%;width:auto;height:auto;">
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <!--<h5 class="card-title">Monthly Recap Report</h5>-->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>

              <!--cuerpo de etiqueta-->
              <div class="table table-striped table-valign-middle">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Tipo</th>
                      <th>Penosa</th>
                      <th>Patricia</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    try {
                      $database = new Connection();
                      $db = $database->open();

                      for ($i = 1; $i < 7; $i++) {

                        $sql = "SELECT nombre,(SELECT COUNT(id_sal_equipo) FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo WHERE le.id_tequipo = " . $i . " AND se.fecha= CURDATE() AND id_ubicacion = 1) AS PENOSA,(SELECT COUNT(id_sal_equipo) FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo WHERE le.id_tequipo = " . $i . " AND se.fecha= CURDATE() AND id_ubicacion = 3) as PATRICIA FROM tipos_equipos WHERE id_tequipo = " . $i . ";";
                        foreach ($db->query($sql) as $row) {
                    ?>
                          <tr>
                            <td><b><?php echo $row['nombre']; ?></b></td>
                            <td><small class="text-success mr-1"><i class="fas fa-arrow-up"></i></small><?php echo $row['PENOSA']; ?></td>
                            <td><small class="text-success mr-1"><i class="fas fa-arrow-up"></i></small><?php echo $row['PATRICIA']; ?></td>
                          </tr>

                    <?php }
                      }
                    } catch (PDOException $e) {
                      echo "Existen problemas con la conexión: " . $e->getMessage();
                    } ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
          <!-- div row-->
        </div>

        <!--  nueva columna-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <!--<h5 class="card-title">Monthly Recap Report</h5>-->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!--cuerpo etiqueta-->

              <div class="table table-striped table-valign-middle">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th style="font-size:65%;">Equipo</th>
                      <th style="font-size:65%;">%Mes</th>
                      <?php
                      $sql = "SELECT DAY(CURDATE()) AS dia;";
                      $result = mysqli_query($con, $sql);
                      $row = mysqli_fetch_array($result);
                      $dia = $row['dia'] - 1;
                      for ($i = 1; $i <= $dia; $i++) { ?>
                        <th style="font-size:65%;"><?php echo $i ?></th>
                      <?php
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    try {
                      $sql = "SELECT id_equipo,sigla FROM lista_equipos WHERE id_tequipo = 1;";

                      foreach ($db->query($sql) as $row) {
                    ?>
                        <tr>
                          <td style="font-size:65%;"><b><?php echo $row['sigla']; ?></b></td>
                          <td style="font-size:65%;"><b></b>80%</td>
                          <?php
                          $id = $row['id_equipo'];
                          $sql = "SELECT YEAR(CURDATE()) AS ano,MONTH(CURDATE()) as mes ,DAY(CURDATE()) AS dia";
                          $result = mysqli_query($con, $sql);
                          $row = mysqli_fetch_array($result);
                          $dia1 = $row['dia'] - 1;
                          $mes = $row['mes'];
                          $ano = $row['ano'];
                          for ($j = 1; $j <= $dia1; $j++) {
                            $sql = "SELECT TIME_TO_SEC(IF(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))) is NULL,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))), SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(rt.hora_mec, rt.hora_ini)+rt.duraccion))),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_ini_col, hora_fin_col)),SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fin)))))))) as final 
                            FROM salida_equipos se INNER JOIN lista_equipos le on se.id_equipo = le.id_equipo INNER JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo INNER JOIN reparacion_terreno rt on rt.id_sal_equipo = se.id_sal_equipo WHERE se.id_estado_diario = 5 and rt.id_sal_equipo = (SELECT id_sal_equipo FROM salida_equipos WHERE id_equipo = " . $id . " and fecha = '" . $ano . "-" . $mes . "-" . $j . "') ORDER by se.fecha DESC;";
                            $result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_array($result);
                            $final = $row['final'];
                            $r = ($final / 36000) * 100;
                            $re = number_format($r, 0, ',', ' ');

                          ?>
                            <td style="font-size:65%;"><?php echo $re ?>%</td>
                          <?php
                          }
                          ?>
                        </tr>
                    <?php }
                    } catch (PDOException $e) {
                      echo "Existen problemas con la conexión: " . $e->getMessage();
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--  fin nueva columna-->

        </div>
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