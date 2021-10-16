<?php 
	session_start();
	include_once "../config.php"; //Inclui um arquivo de configuração no bloco de ações
	extract($_POST);
	$email = $_POST["cademail"];
	$senha = $_POST["cadsenha"];
	$acesso = null;

	if ($email == "admin@etec") {
		$sql = $con->prepare("SELECT * FROM admin WHERE senha = ? AND email = ?");
		$sql->bindParam(1, $senha);
		$sql->bindParam(2, $email);
		$sql->execute();

		$resultado = $sql->fetchAll(PDO::FETCH_ASSOC); //Função que percorre todo o vetor onde a cláusula está inclusa
		if (count($resultado) == 1) { //Função que conta o número de tuplas retornadas, se for apenas uma irá logar
			$resultado =  $resultado[0];
			$_SESSION["nome"] = $resultado['nome'];
			$_SESSION["id"] = $resultado['id'];
			$_SESSION["email"] = $resultado['email'];
			$_SESSION["senha"] = $resultado['senha'];
			echo $acesso = 1;
		}
		else{
			echo $acesso = 0;
		}
	}

	else{
	
	if ($coordenador == 1) {
		$sql = $con->prepare("SELECT * FROM professor WHERE email = ? AND senha = ? AND coordenador = 1");
		$sql->bindParam(1, $email);
		$sql->bindParam(2, $senha);
		$sql->execute();

		$resultado = $sql->fetchAll(PDO::FETCH_ASSOC); //Função que percorre todo o vetor onde a cláusula está inclusa
		if (count($resultado) == 1) { //Função que conta o número de tuplas retornadas, se for apenas uma irá logar
			$resultado =  $resultado[0];
			$_SESSION["nome"] = $resultado['nome'];
			$_SESSION["id"] = $resultado['idProfessor'];
			$_SESSION["idCurso"] = $resultado['idCurso'];
			$_SESSION["coordenador"] = $resultado['coordenador'];
			$_SESSION["email"] = $resultado['email'];	
			$_SESSION["senha"] = $resultado['senha'];
			echo $acesso = 1;
		}
		else{
			echo $acesso = 0;
		}
	} else if($coordenador == 0){
		$sql = $con->prepare("SELECT * FROM professor WHERE email = ? AND senha = ? AND coordenador = 0");
		$sql->bindParam(1, $email);
		$sql->bindParam(2, $senha);
		$sql->execute();

		$resultado = $sql->fetchAll(PDO::FETCH_ASSOC); //Função que percorre todo o vetor onde a cláusula está inclusa
		if (count($resultado) == 1) { //Função que conta o número de tuplas retornadas, se for apenas uma irá logar
			$resultado =  $resultado[0];
			$_SESSION["nome"] = $resultado['nome'];
			$_SESSION["id"] = $resultado['idProfessor'];
			$_SESSION["idCurso"] = $resultado['idCurso'];
			$_SESSION["email"] = $resultado['email'];
			$_SESSION["senha"] = $resultado['senha'];	
			echo $acesso = 1;
		}
		else{
			echo $acesso = 0;
		}
	}
}
?>
	