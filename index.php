<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/estilos.css">

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img src="dist/img/logo3H.png" width="200" height="200"">
      <br>
      <a><b>Sociedad Minera </b>3H</a>
    </div>
    <!-- /.login-logo -->
    <div class=" card">
      <div class="card-body login-card-body">
        <form action="../../index3.html" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Usuario" id="txt_uname" name="txt_uname">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Contraseña" id="txt_pwd" name="txt_pwd">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Recuerdame
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <input type="button" class="btn btn-user btn-block naranjo" value="ingresa" name="but_submit" id="but_submit">
              <!-- <input type="button" class="btn btn-user btn-block naranjo" value="Ingresar" onclick="ingresar()"> -->

            </div>
            <!-- /.col -->
          </div>
          <div id="message"></div>

        </form>
        <!--
      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>-->
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script src="pages/funcionesjs/funciones.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
      //Login
      $(document).ready(function() {

        $("#but_submit").click(function() {
          var username = $("#txt_uname").val().trim();
          var password = $("#txt_pwd").val().trim();

          if (username != "" && password != "") {
            $.ajax({
              url: 'pages/checkUser.php',
              type: 'post',
              data: {
                username: username,
                password: password
              },
              success: function(response) {
                var msg = "";
                if (response == 2) {
                  window.location = "pages/taller/modulo_taller_mecanico.php";
                } else if (response == 3) {
                  window.location = "pages/supervisores/modulo_supervisor.php";
                } else if (response == 4) {
                  window.location = "pages/geologia/modulo_geologia.php";
                } else if (response == 5) {
                  window.location = "pages/laboratorio/modulo_laboratorio.php";
                } else if (response == 6) {
                  window.location = "pages/operaciones/modulo_operaciones.php";
                } else if (response == 7) {
                  window.location = "pages/mecanicos/modulo_mecanicos.php";
                } else if (response == 8) {
                  window.location = "pages/parrilla/modulo_parrilla.php";
                } else if (response == 9) {
                  window.location = "pages/parrilla_info/modulo_parrilla.php";
                } else {
                  window.alert("nombre o contraseña inválida");
                  return;
                }

              }
            });
          }
        });

      });
    </script>
</body>

</html>