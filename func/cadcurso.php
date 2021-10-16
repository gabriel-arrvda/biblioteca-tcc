<meta charset="utf-8">
<?php
include_once "../config.php";
extract($_POST);

$inse = $con->prepare("INSERT INTO curso VALUES(0,?)");

$inse->bindParam(1,$nomecurso);
$inse->execute();
?>

?>
