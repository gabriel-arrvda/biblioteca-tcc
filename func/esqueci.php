<?php 
require_once "../config.php";

extract($_POST);

$data = date("Y-m-d H:i:s"); 

$bytes = openssl_random_pseudo_bytes(25, $cstrong);
$token = bin2hex($bytes);

	$sql = "SELECT * FROM professor WHERE email = ?";
	$comando = $con->prepare($sql);
	$comando->bindParam(1, $email);
	$comando->execute();
	$prof = $comando->rowCount();
	$professor = $comando->fetch(PDO::FETCH_OBJ);

	if ($prof == 1) {
		$sql = "INSERT INTO token VALUES(?,?,?)";
		$comando = $con->prepare($sql);
		$comando->bindParam(1, $token);
		$comando->bindParam(2, $email);
		$comando->bindParam(3, $data);
		$comando->execute();

		$to = $email;
		$subject = 'Recuperação de Senha';
		$message = 'Olá, '.$professor->nome.'. <br> Foi constatado que o Sr(a). fez uma requisição para alterar o seu email, caso não tenha sido vossa senhoria apenas ignore a mensagem.<br> <a href="https://trabalhos.etecsalesgomes.com.br/recuperar.php?token='.$token.'&email='.$email.'&data='.$data.'">Acesse aqui para recuperar sua senha</a>';
		$headers = 
		'From: etecsg@etec.sp.gov.br' . "\r\n" .
    	'Reply-To: webmaster@example.com' . "\r\n" .
    	'Content-Type: text/html; charset="UTF-8";' .
    	'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	}

	echo $prof;
 ?>