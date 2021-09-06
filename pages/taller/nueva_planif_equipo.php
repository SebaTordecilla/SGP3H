<?php
include('../../conexion.php');

$pdo = connect();

try {
	$sql = "INSERT INTO salida_equipos(id_equipo, id_operador, id_supervisor, id_ubicacion, fecha, hora_inicio, id_estado_diario) VALUES (:id_equipo, :id_operador, :id_supervisor, :id_ubicacion, :fecha, :hora_inicio, 1)";
	$query = $pdo->prepare($sql);
	$query->bindParam(':id_equipo', $_POST['lista2'], PDO::PARAM_INT);
    $query->bindParam(':id_operador', $_POST['id_operador'], PDO::PARAM_INT);
	$query->bindParam(':id_supervisor', $_POST['id_supervisor'], PDO::PARAM_INT);
	$query->bindParam(':id_ubicacion', $_POST['id_ubicacion'], PDO::PARAM_INT);
    $query->bindParam(':fecha', $_POST['fecha'], PDO::PARAM_STR);
    $query->bindParam(':hora_inicio', $_POST['hora'], PDO::PARAM_STR);
    $query->execute();
} catch (PDOException $e) {
	echo 'PDOException : '.  $e->getMessage();
}


?>