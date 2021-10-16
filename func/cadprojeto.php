<?php
session_start();
$email = $_SESSION["email"];
$id = $_SESSION["id"];
if (isset($_SESSION["idCurso"])) {
	$idCurso = $_SESSION["idCurso"];
}

if (isset($_SESSION["coordenador"])) {
	$coordenador = $_SESSION["coordenador"];
}
$arquivo = $_FILES["arquivo"]["name"];
$upload["pasta"] = '../upload/';
$upload["tamanho"] = 1024*1024*10;
$upload["extensoes"] = array('pdf');
$upload["renomeia"] = false;
$upload["sqlite_error_string(error_code)"][0] = "Não houve erros";
$upload["erros"][1] = "O arquivo de upload é maior do que o limite do PHP";
$upload["erros"][2] = "O arquivo ultrapassa o limite de tamanho especificado";
$upload["erros"][3] = "O upload do arquivo foi feito parcialmente";
$upload["erros"][4] = "Não foi feito o upload do arquivo"; 

if ($upload["tamanho"] <= $_FILES["arquivo"]["size"]) {
	?> <script type="text/javascript">alert("Arquivo enviado maior que 10 MB");</script><?php 
	if($email == "admin@etec"){
?>
<meta http-equiv="refresh" content="0;url=../admin.php?var=0">
<?php
 }
 else{
 	if ($coordenador == 1) {
 ?>
	<meta http-equiv="refresh" content="0;url=../home_coordenador.php?var=0">
 <?php
 	} 
 	else {
 ?>
 	<meta http-equiv="refresh" content="0;url=../home_professor.php?var=0">
 <?php
 	}
 }
	exit;
}

if ($_FILES["arquivo"]["error"] != 0) {
	?><script type="text/javascript">alert("Erro ao enviar arquivo.");</script>
	<?php 
 if($email == "admin@etec") {
?>
<meta http-equiv="refresh" content="0;url=../admin.php?var=0">
<?php
 }
 else{
 	if ($coordenador == 1) {
 ?>
	<meta http-equiv="refresh" content="0;url=../home_coordenador.php?var=0">
 <?php
 	} 
 	else {
 ?>
 	<meta http-equiv="refresh" content="0;url=../home_professor.php?var=0">
 <?php
 	}
 }
	exit;
}

$extensao = pathinfo($arquivo, PATHINFO_EXTENSION);

if (array_search($extensao, $upload["extensoes"]) === false) {
	?>
	<script type="text/javascript">alert("Erro: Enviar somente arquivos em formato PDF");</script>
	 <?php 
 if($email == "admin@etec") {
?>
<meta http-equiv="refresh" content="0;url=../admin.php?var=0">
<?php
 }
 else{
 	if ($coordenador == 1) {
 ?>
	<meta http-equiv="refresh" content="0;url=../home_coordenador.php?var=0">
 <?php
 	} 
 	else {
 ?>
 	<meta http-equiv="refresh" content="0;url=../home_professor.php?var=0">
 <?php
 	}
 }
	exit;
}

if ($upload["renomeia"] === true) {
	$nome_final = time().'.'.$extensao;
} else {
	$nome_final = time().'.'.$extensao;
}

if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $upload["pasta"].$nome_final)) {
	/*echo "Upload efeituado com sucesso!<br/>";
	echo '<a href ="'.$upload["pasta"].$nome_final.'">Clique aqui para acessar o arquivo</a><br/>';*/
} else {
	echo "Não foi possível enviar o arquivo";
}


include_once "../config.php";
extract($_POST);

if ($email == "admin@etec" || $coordenador == 1) {
$verificado  = 1;
}
else{
$verificado = 0;
}

if(isset($_POST['favorito'])){
	$fav = 1;
}
else{
	$fav = 0;
}

$inse = $con->prepare("INSERT INTO projeto VALUES(0,?,?,?,?,?,?,?)");

$inse->bindParam(1,$nomeprojeto);
$inse->bindParam(2,$alunos);
$inse->bindParam(3,$nome_final);
$inse->bindParam(4,$fav);
$inse->bindParam(5,$verificado);
$inse->bindParam(6,$ano);
$inse->bindParam(7,$idCurso);
$inse->execute();
?>
<script>alert("Projeto cadastrado com sucesso!");</script>
 <?php 
 if($email == "admin@etec") {
?>
<meta http-equiv="refresh" content="0;url=../admin.php?var=0">
<?php
 }
 else{
 	if ($coordenador == 1) {
 ?>
	<meta http-equiv="refresh" content="0;url=../home_coordenador.php?var=0">
 <?php
 	} 
 	else {
 ?>
 	<meta http-equiv="refresh" content="0;url=../home_professor.php?var=0">
 <?php
 	}
 }
?>