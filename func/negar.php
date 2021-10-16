<?php 
require_once '../config.php';
session_start();
$email = $_SESSION["email"];
$id = (int)$_GET["id"];

$up = $con->prepare("DELETE FROM projeto WHERE idProjeto = $id");
$up->execute();

 ?>
 <script type="text/javascript">alert("Projeto excluído!");</script>
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