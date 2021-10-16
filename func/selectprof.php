<?php 
require_once '../config.php';
extract($_POST);

$sqlprof = "SELECT * FROM professor WHERE idcurso = ?";
$pdoprof = $con->prepare($sqlprof);
$pdoprof->bindParam(1, $curso);
$pdoprof->execute();
$dados = $pdoprof->fetchAll();
echo json_encode($dados, JSON_UNESCAPED_UNICODE);
?>