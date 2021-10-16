<?php 
  include "../config.php";
  
  $tipo = $_GET["tipo"];

  if ($tipo == "gera") {
    $senha = "";
    $maiu = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
    $minu = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
    $nume = "0123456789"; // $nu contem os números 
    // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
    $senha .= str_shuffle($maiu);
    // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
    $senha .= str_shuffle($minu);
    $senha .= str_shuffle($nume);
    echo substr(str_shuffle($senha),0,8);  
  }
?>
