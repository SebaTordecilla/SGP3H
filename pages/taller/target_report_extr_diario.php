<?php
include_once('../../conexion.php');

$database = new Connection();
$db = $database->open();

$fecha = mysqli_real_escape_string($con, $_POST['fecha']);

if ($fecha == '') {
  $sql = "SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) as total,
(SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) FROM extraccion_mineral where fecha = CURDATE() and estado = 2 and id_ubicacion = 1) as penosa,
(SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) FROM extraccion_mineral where fecha = CURDATE() and estado = 2 and id_ubicacion = 3) as patricia,
(SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) FROM extraccion_mineral where fecha = CURDATE() and estado = 2 and id_ubicacion = 5) as cajon,
(SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) FROM extraccion_mineral where fecha = CURDATE() and estado = 2 and id_mineral = 1) as oxido,
(SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) FROM extraccion_mineral where fecha = CURDATE() and estado = 2 and id_mineral = 2) as sulfuro
FROM extraccion_mineral where fecha = CURDATE() and estado = 2";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $total = $row['total'];
  $penosa = $row['penosa'];
  $patricia = $row['patricia'];
  $cajon = $row['cajon'];
  $oxido = $row['oxido'];
  $sulfuro = $row['sulfuro'];

  $target = "
        <div class=\"row\">
          <div class=\"col-4\">
            <div class=\"card card\">
              <div class=\"card-body\">
            
              <h3><p>Penosa: <b>" . $penosa . "</b></p></h3>
              <h3><p>??xido: <b>" . $oxido . "</b></p></h3>
 
              </div>
            </div>
          </div>
          <div class=\"col-4\">
          <div class=\"card card\">
            <div class=\"card-body\">
          
            <h3><p>Patricia: <b>" . $patricia . "</b></p></h3>
            <h3><p>Sulfuro: <b>" . $sulfuro . "</b></p></h3>

            </div>
          </div>
        </div>
        <div class=\"col-4\">
        <div class=\"card card\">
          <div class=\"card-body\">
        
          <h3><p>Caj??n: <b>" . $cajon . "</b></p></h3>
          <h3><p>Total: <b>" . $total . "</b></p></h3>

          </div>
        </div>
      </div>
        </div>
          

";

  echo $target;
} else {

  $sql = "SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) as total,
  (SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) FROM extraccion_mineral where fecha = '" . $fecha . "' and estado = 2 and id_ubicacion = 1) as penosa,
  (SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) FROM extraccion_mineral where fecha = '" . $fecha . "' and estado = 2 and id_ubicacion = 3) as patricia,
  (SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) FROM extraccion_mineral where fecha = '" . $fecha . "' and estado = 2 and id_ubicacion = 5) as cajon,
  (SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) FROM extraccion_mineral where fecha = '" . $fecha . "' and estado = 2 and id_mineral = 1) as oxido,
  (SELECT sum(if(hora1 = '00:00:00',0,1)+ if(hora2 = '00:00:00',0,1) +if(hora3 = '00:00:00',0,1) +if(hora4 = '00:00:00',0,1) +if(hora5 = '00:00:00',0,1)) FROM extraccion_mineral where fecha = '" . $fecha . "' and estado = 2 and id_mineral = 2) as sulfuro
  FROM extraccion_mineral where fecha = '" . $fecha . "' and estado = 2";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $total = $row['total'];
  $penosa = $row['penosa'];
  $patricia = $row['patricia'];
  $cajon = $row['cajon'];
  $oxido = $row['oxido'];
  $sulfuro = $row['sulfuro'];

  $target = "
        <div class=\"row\">
          <div class=\"col-4\">
            <div class=\"card card\">
              <div class=\"card-body\">
            
              <h3><p>Penosa: <b>" . $penosa . "</b></p></h3>
              <h3><p>??xido: <b>" . $oxido . "</b></p></h3>
 
              </div>
            </div>
          </div>
          <div class=\"col-4\">
          <div class=\"card card\">
            <div class=\"card-body\">
          
            <h3><p>Patricia: <b>" . $patricia . "</b></p></h3>
            <h3><p>Sulfuro: <b>" . $sulfuro . "</b></p></h3>

            </div>
          </div>
        </div>
        <div class=\"col-4\">
        <div class=\"card card\">
          <div class=\"card-body\">
        
          <h3><p>Caj??n: <b>" . $cajon . "</b></p></h3>
          <h3><p>Total: <b>" . $total . "</b></p></h3>

          </div>
        </div>
      </div>
        </div>
          

";

  echo $target;
}
