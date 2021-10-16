<?php 
require_once '../config.php';
session_start();
$email = $_SESSION["email"];
$id = (int)$_GET["id"];

$up = $con->prepare("UPDATE projeto SET verificado = 1 WHERE idProjeto = $id");
$up->execute();

 ?>
 <script type="text/javascript">alert("Projeto verificado com sucesso!");</script>
 <?php 
 if($email == "admin@etec") {
?>
<meta http-equiv="refresh" content="0;url=../admin.php?var=0">
<?php
 }
 else{
 	?>
<meta http-equiv="refresh" content="0;url=../home_coordenador.php?var=0">
 	<?php
 } ?>