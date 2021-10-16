<?php
	require_once "../config.php";
	extract($_POST);

	$sql = "UPDATE professor SET senha = ? WHERE idProfessor = ?";
	$comando = $con->prepare($sql);
	$comando->bindParam(1, $senha);
	$comando->bindParam(2, $id);
	$comando->execute();
?>