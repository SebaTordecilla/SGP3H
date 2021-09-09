<?php
include "../../conexion.php";
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGP3H</title>

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
            <?php include("lateral_laboratorio.php") ?>
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
                        <h1><img src="../../dist/img/laboratorio.png" width="60" height="60"> Laboratorio | Recepción de Muestras</h1>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                            </div>


                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Area</th>
                                                <th>ID Muestra</th>
                                                <th>Mina</th>
                                                <th>Ubicación</th>
                                                <th>Fecha</th>
                                                <th>Tipo</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $database = new Connection();
                                            $db = $database->open();
                                            $usuario = $_SESSION['uname'];
                                            try {
                                                $sql = "SELECT mg.id_geom as id,um.nombre as mina,IF(mg.id_calle>0,IF(mg.id_labor>0,CONCAT(man.coordenada,' ',cal.coordenada,' ',lev.coordenada),CONCAT(man.coordenada,' ',cal.coordenada)),CONCAT(man.coordenada)) as ubicacion, mg.fecha,mg.cutvisual,mg.cusvisual,mg.frente,mg.tipo,mg.observaciones from muestras_geologia mg INNER JOIN ubicaciones_minas um on mg.id_ubicacion=um.id_ubicacion LEFT JOIN mantos man on man.id_manto = mg.id_manto LEFT JOIN calles cal on cal.id_calle= mg.id_calle LEFT JOIN levantes lev on lev.id_levante = mg.id_labor where mg.estado = 1 and mg.id_geom=" . $id . ";";
                                                foreach ($db->query($sql) as $row) {
                                            ?>
                                                    <tr>
                                                        <td>GEOLOGIA</td>
                                                        <td>P-00<?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['mina']; ?></td>
                                                        <td><?php echo $row['ubicacion']; ?></td>
                                                        <td><?php echo date("d-m-Y", strtotime($row['fecha'])); ?></td>
                                                        <td><?php echo strtoupper( $row['tipo']); ?></td>
                                                        <td align="center"><a href="#" onclick="recepcion_geo('<?php echo $row['id']; ?>','<?php echo $usuario ?>')"><button class="btn naranjo"> Recepcionar</button></a></td>
                                                    </tr>
                                            <?php
                                                }
                                            } catch (PDOException $e) {
                                                echo "Existen problemas con la conexión: " . $e->getMessage();
                                            }


                                            //close connection
                                            $database->close();

                                            ?>


                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- Main content -->

            <!-- /.container-fluid -->

            <!--Se debe incluir modales-->
            <?php include('modal_laboratorio.php'); ?>

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
    <script src="../funcionesjs/funciones_laboratorio.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    if (aData[4] > 0 && aData[4] < 0.50) //
                    {
                        $('td:eq(4)', nRow).css('background-color', '#DDFBFE');
                    } else if (aData[4] >= 0.50 && aData[4] < 1.00) //
                    {
                        $('td:eq(4)', nRow).css('background-color', '#FEFEDC');
                    } else if (aData[4] >= 1.00 && aData[4] < 1.50) //
                    {
                        $('td:eq(4)', nRow).css('background-color', '#FEE5DC');
                    } else if (aData[4] >= 1.50 && aData[4] < 2.00) //
                    {
                        $('td:eq(4)', nRow).css('background-color', '#FFCBCB');
                    } else if (aData[4] >= 2.00) //
                    {
                        $('td:eq(4)', nRow).css('background-color', '#F2CEFF');
                    }
                    //columna5
                    if (aData[5] > 0 && aData[5] < 0.50) //
                    {
                        $('td:eq(5)', nRow).css('background-color', '#DDFBFE');
                    } else if (aData[5] >= 0.50 && aData[5] < 1.00) //
                    {
                        $('td:eq(5)', nRow).css('background-color', '#FEFEDC');
                    } else if (aData[5] >= 1.00 && aData[5] < 1.50) //
                    {
                        $('td:eq(5)', nRow).css('background-color', '#FEE5DC');
                    } else if (aData[5] >= 1.50 && aData[5] < 2.00) //
                    {
                        $('td:eq(5)', nRow).css('background-color', '#FFCBCB');
                    } else if (aData[5] >= 2.00) //
                    {
                        $('td:eq(5)', nRow).css('background-color', '#F2CEFF');
                    }
                    //columna6
                    if (aData[6] > 0 && aData[6] < 0.50) //
                    {
                        $('td:eq(6)', nRow).css('background-color', '#DDFBFE');
                    } else if (aData[6] >= 0.50 && aData[6] < 1.00) //
                    {
                        $('td:eq(6)', nRow).css('background-color', '#FEFEDC');
                    } else if (aData[6] >= 1.00 && aData[6] < 1.50) //
                    {
                        $('td:eq(6)', nRow).css('background-color', '#FEE5DC');
                    } else if (aData[6] >= 1.50 && aData[6] < 2.00) //
                    {
                        $('td:eq(6)', nRow).css('background-color', '#FFCBCB');
                    } else if (aData[6] >= 2.00) //
                    {
                        $('td:eq(6)', nRow).css('background-color', '#F2CEFF');
                    }
                },
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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

        /*$(function() {
          $("table tr").dblclick(function() {
            alert(this.rowIndex);
          });

        });*/
    </script>
</body>

</html>