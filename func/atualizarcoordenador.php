<?php 
require_once '../config.php';
extract($_POST);

$delcoor = "UPDATE professor SET coordenador = 0 WHERE coordenador = 1 AND idCurso = ?";
$comdelcoor = $con->prepare($delcoor);
$comdelcoor->bindParam(1, $curso);
$comdelcoor->execute();

$sqlprof = "UPDATE professor SET coordenador = 1 WHERE idProfessor = ?";
$pdoprof = $con->prepare($sqlprof);
$pdoprof->bindParam(1, $professor);
$pdoprof->execute();
?>