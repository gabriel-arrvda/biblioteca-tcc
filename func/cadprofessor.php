<meta charset="utf-8">
<?php
include_once "../config.php";
extract($_POST);
session_start();

function msg(){
 
   if(date("H") < 12){
 
     return "Bom dia, ";
 
   }elseif(date("H") > 11 && date("H") < 18){
 
     return "Boa tarde, ";
 
   }elseif(date("H") > 17){
 
     return "Boa noite, ";
 
   }
} 

if ($nomeprof != "" && $gerarsenha != "" && $email != "" && $email != "admin@etec") {

if ($_SESSION["email"] == "admin@etec") {
	//Se não for o admin, então o curso será preenchido automaticamente

	$inse = $con->prepare("INSERT INTO professor VALUES(0,?,?,?,?,?)");

	$inse->bindParam(1,$nomeprof);
	$inse->bindParam(2,$gerarsenha);
	$inse->bindParam(3,$coordenador);
	$inse->bindParam(4,$email);
	$inse->bindParam(5,$idCurso);
	$inse->execute();

}
else{
	$idCurso = $_SESSION["idCurso"];

	$inse = $con->prepare("INSERT INTO professor VALUES(0,?,?,0,?,?)");

	$inse->bindParam(1,$nomeprof);
	$inse->bindParam(2,$gerarsenha);
	$inse->bindParam(3,$email);
	$inse->bindParam(4,$idCurso);
	$inse->execute();
}
$to = $email;
$subject = 'Confirmação de cadastro';
$message = msg().$nomeprof.'. <br> Sua senha de primeiro acesso da Biblioteca Virtual de TCCs da ETEC Sales Gomes é esta: <b>'.$gerarsenha.'</b><br><br> <a href="https://trabalhos.etecsalesgomes.com.br/index.php">Acesse o site para confirmar seu login</a>';
$headers = 
	'From: etecsg@etec.sp.gov.br' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'Content-Type: text/html; charset="UTF-8";' .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
}
?>
