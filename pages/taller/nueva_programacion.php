<?php
include('../../conexion.php');

$pdo = connect();

try {
	$sql = "INSERT INTO prog_equipos(id_equipo, fecha) VALUES (:id_equipo, :fecha_man_prog)";
	$query = $pdo->prepare($sql);
	$query->bindParam(':id_equipo', $_POST['id_equipo'], PDO::PARAM_INT);
    $query->bindParam(':fecha_man_prog', $_POST['fecha_man_prog'], PDO::PARAM_STR);
    $query->execute();
} catch (PDOException $e) {
	echo 'PDOException : '.  $e->getMessage();
}

?>