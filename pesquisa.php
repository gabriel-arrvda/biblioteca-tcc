<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: text/html; charset=utf-8");
	require_once("config.php");
	extract($_GET);

	$sqlprojeto = "SELECT c.nome as 'ncurso', p.nome, p.alunos, p.ano, p.arquivo, p.favorito FROM curso c inner join projeto p ON c.idcurso = p.idcurso WHERE p.verificado = 1 AND p.nome LIKE '%$pesquisanome%' AND p.ano LIKE '%$pesquisaano%' AND p.idCurso LIKE '%$pesquisacurso%' ORDER BY p.favorito DESC";
  	$pdoprojeto = $con->prepare($sqlprojeto);
  	$pdoprojeto->execute();
  	$count = $pdoprojeto->rowCount();
  	$dados = $pdoprojeto->fetchAll();
	echo json_encode($dados, JSON_UNESCAPED_UNICODE);
?>