<?php
include('../../conexion.php');

$pdo = connect();

try {
	$sql = "INSERT INTO lista_equipos( sigla, nombre, id_tequipo, marca, num_serie, anio, fecha_ingreso, frecuencia, observaciones) VALUES (:sigla, :nombre, :id_tequipo, :marca, :num_serie, :anio, :fecha_ingreso, :frecuencia, :observaciones)";
	$query = $pdo->prepare($sql);
	$query->bindParam(':sigla', $_POST['sigla'], PDO::PARAM_STR);
    $query->bindParam(':nombre', $_POST['nombre'], PDO::PARAM_STR);
	$query->bindParam(':id_tequipo', $_POST['id_tequipo'], PDO::PARAM_INT);
	$query->bindParam(':marca', $_POST['marca'], PDO::PARAM_STR);
    $query->bindParam(':num_serie', $_POST['num_serie'], PDO::PARAM_STR);
    $query->bindParam(':anio', $_POST['anio'], PDO::PARAM_INT);
    $query->bindParam(':fecha_ingreso', $_POST['fecha_ingreso'], PDO::PARAM_STR);
    $query->bindParam(':frecuencia', $_POST['frecuencia'], PDO::PARAM_STR);
    $query->bindParam(':observaciones', $_POST['observaciones'], PDO::PARAM_STR);
    $query->execute();
} catch (PDOException $e) {
	echo 'PDOException : '.  $e->getMessage();
}

try{
    $sql = "INSERT INTO mant_equipos( id_equipo, fecha, id_est_equipo, observaciones) 
    SELECT MAX(id_equipo),CURDATE(),1,'EQUIPO INGRESADO RECIENTEMENTE' from lista_equipos";
	$query = $pdo->prepare($sql);
    $query->execute();

} catch (PDOException $e) {
	echo 'PDOException : '.  $e->getMessage();
}

?>