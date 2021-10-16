<?php
session_start();
$emailSessao = $_SESSION["email"]; 
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: text/html; charset=utf-8");

	require_once ("../config.php");

	extract($_GET);
	extract($_POST);

	if ($tipo == "exibir") {
		if ($emailSessao == "admin@etec") {
			$sql = "SELECT * FROM admin WHERE id = ?";
			$comando = $con->prepare($sql);
			$comando->bindParam(1, $codigo);
			$comando->execute();
			$dados = $comando->fetch();
			echo json_encode($dados, JSON_UNESCAPED_UNICODE);
		}
		else{
			$sql = "SELECT * FROM professor WHERE idProfessor = ?";
			$comando = $con->prepare($sql);
			$comando->bindParam(1, $codigo);
			$comando->execute();
			$dados = $comando->fetch();
			echo json_encode($dados, JSON_UNESCAPED_UNICODE);
		}
	}
	if ($tipo == "logar"){
		$acesso = null;

		if ($email == "admin@etec") {
			$sql = $con->prepare("SELECT * FROM admin WHERE senha = ?");
			$sql->bindParam(1, $senha);
			$sql->execute();
	
			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC); //Função que percorre todo o vetor onde a cláusula está inclusa
			if (count($resultado) == 1) { //Função que conta o número de tuplas retornadas, se for apenas uma irá logar
				echo $acesso = 1;
			}
			else{
				echo $acesso = 0;
			}
		}
	
		else{
			$sql = $con->prepare("SELECT * FROM professor WHERE email = ? AND senha = ?");
			$sql->bindParam(1, $email);
			$sql->bindParam(2, $senha);
			$sql->execute();

			$resultado = $sql->fetchAll(PDO::FETCH_ASSOC); //Função que percorre todo o vetor onde a cláusula está inclusa
			if (count($resultado) == 1) { //Função que conta o número de tuplas retornadas, se for apenas uma irá logar
				echo $acesso = 1;
			}
			else{
				echo $acesso = 0;
			}
		}
	}
	if ($tipo == "editar") {
		$edt = null;
		if ($emailSessao != "admin@etec") {
			$up = $con->prepare("UPDATE professor SET senha = ? WHERE idProfessor = ?");
			$up->bindParam(1, $senha);
			$up->bindParam(2, $codigo);
			$up->execute();
			echo $edt = 1;
		}
		else{
			$up = $con->prepare("UPDATE admin SET senha = ? WHERE id = ?");
			$up->bindParam(1, $senha);
			$up->bindParam(2, $codigo);
			$up->execute();
			echo $edt = 1;	
		}
	}
?>