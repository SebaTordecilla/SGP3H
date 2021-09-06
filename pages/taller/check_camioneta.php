<?php
include "../../conexion.php";

$id_camioneta = mysqli_real_escape_string($con, $_POST['id_patente']);
$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
$kilometraje = mysqli_real_escape_string($con, $_POST['kilometraje']);
$id_mecanico = mysqli_real_escape_string($con, $_POST['id_mecanico']);
$aceite_motor = mysqli_real_escape_string($con, $_POST['aceite_motor']);
$ref_motor = mysqli_real_escape_string($con, $_POST['ref_motor']);
$aceite_hidr = mysqli_real_escape_string($con, $_POST['aceite_hidr']);
$liq_frenos = mysqli_real_escape_string($con, $_POST['liq_frenos']);
$nivel_comb = mysqli_real_escape_string($con, $_POST['nivel_comb']);
$filtro_aire = mysqli_real_escape_string($con, $_POST['filtro_aire']);
$part_frio = mysqli_real_escape_string($con, $_POST['part_frio']);
$rev_indicadores = mysqli_real_escape_string($con, $_POST['rev_indicadores']);
$corta_corriente = mysqli_real_escape_string($con, $_POST['corta_corriente']);
$but_asientos = mysqli_real_escape_string($con, $_POST['but_asientos']);
$luces = mysqli_real_escape_string($con, $_POST['luces']);
$presion_neum = mysqli_real_escape_string($con, $_POST['presion_neum']);
$ant_interior = mysqli_real_escape_string($con, $_POST['ant_interior']);
$ant_exterior = mysqli_real_escape_string($con, $_POST['ant_exterior']);
$freno_mano = mysqli_real_escape_string($con, $_POST['freno_mano']);
$rueda_repuesto = mysqli_real_escape_string($con, $_POST['rueda_repuesto']);
$gata = mysqli_real_escape_string($con, $_POST['gata']);
$triang_cono = mysqli_real_escape_string($con, $_POST['triang_cono']);
$chaleco_refl = mysqli_real_escape_string($con, $_POST['chaleco_refl']);
$rev_documentos = mysqli_real_escape_string($con, $_POST['rev_documentos']);
$extintor = mysqli_real_escape_string($con, $_POST['extintor']);
$baliza = mysqli_real_escape_string($con, $_POST['baliza']);
$alarm_retroceso = mysqli_real_escape_string($con, $_POST['alarm_retroceso']);
$observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);

$sql_query = "SELECT MAX(kilometraje) AS kilometraje FROM control_camionetas WHERE id_camioneta =" . $id_camioneta . ";";
$result = mysqli_query($con, $sql_query);
$row = mysqli_fetch_array($result);
$km = $row['kilometraje'];
if ($kilometraje > $km) {
    $sql_query2 = "INSERT INTO control_camionetas (id_camioneta, fecha, kilometraje, id_mecanico, aceite_motor, ref_motor, aceite_hidr, liq_frenos, nivel_comb, filtro_aire, part_frio, rev_indicadores, corta_corriente, but_asientos, luces, presion_neum, ant_interior, ant_exterior, freno_mano, rueda_repuesto, gata, triang_cono, chaleco_refl, rev_documentos, extintor, baliza,alarm_retroceso, observaciones) VALUES (" . $id_camioneta . ",'" . $fecha . "'," . $kilometraje . "," . $id_mecanico . "," . $aceite_motor . "," . $ref_motor . "," . $aceite_hidr . "," . $liq_frenos . "," . $nivel_comb . "," . $filtro_aire . "," . $part_frio . "," . $rev_indicadores . "," . $corta_corriente . "," . $but_asientos . "," . $luces . "," . $presion_neum . "," . $ant_interior . "," . $ant_exterior . "," . $freno_mano . "," . $rueda_repuesto . "," . $gata . "," . $triang_cono . "," . $chaleco_refl . "," . $rev_documentos . "," . $extintor . "," . $baliza . "," . $alarm_retroceso . ",'" . $observaciones . "');";
    $result2 = mysqli_query($con, $sql_query2);
    echo 1;
} else {
    echo 3;
}
?>