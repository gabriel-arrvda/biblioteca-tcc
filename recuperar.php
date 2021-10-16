<?php 

  require_once "config.php";
  extract($_GET);

  $dataAtual = date("Y-m-d H:i:s");

  $sql = "SELECT * FROM token WHERE token = ? AND email = ?";
  $comando = $con->prepare($sql);
  $comando->bindParam(1, $token);
  $comando->bindParam(2, $email);
  $comando->execute();
  $var = $comando->rowCount();

  $sql2 = "SELECT * FROM professor WHERE email = ?";
  $comando2 = $con->prepare($sql2);
  $comando2->bindParam(1, $email);
  $comando2->execute();
  $professor = $comando2->fetch(PDO::FETCH_OBJ);

  if ($var != 1) {
  ?>
  <script>
    alert("Tempo limite de recuperação esgotado, por favor solicite novamente");
  </script>
  <meta http-equiv="refresh" content="0;url=index.php">
  <?php
    header("Location: index.php");
  }
  else{
    $dataFuturo = strtotime("$data + 30 minutes");
    $dataFormatada = date("Y-m-d H:i:s",$dataFuturo);

    if ($dataAtual >= $dataFormatada) {
      ?>
  <script>
    alert("Tempo limite de recuperação esgotado, por favor solicite novamente");
  </script>
  <meta http-equiv="refresh" content="0;url=index.php">
  <?php
    }
  }
?>
<!DOCTYPE html>
<html class="h-100">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="icon.png">
  <title>Biblioteca Virtual</title>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/requisicao.js"></script>
  <script src="js/edit.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<body class="d-flex flex-column h-100">
<div id="page-content">
<?php 
  require "grid/nav.php";
?>
<h1 class="titulos mx-5 mt-5">Recuperar a senha:</h1>
<div class="pb-3 text-black flex-shrink-0">
    <div class="container">
      <div class="row p-2">
        <div id="form" class="col-xl">
  <div class="form-row">
  <input type="hidden" name="cadid" id="cadid" value="<?php echo $professor->idProfessor?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-12 textos">
      <label for="cadsenha">Digite sua nova senha</label>
      <input type="password" class="form-control" id="cadsenha" name="cadsenha" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12 textos">
      <label for="cadconfirma">Confirme a senha</label>
      <input type="password" class="form-control" id="cadconfirma" name="cadconfirma" required>
    </div>
  </div>
  <button type="button" class="btn etec btn-lg textos" id="btnatt" style="float: right;">Atualizar</button>
</div>
<label id="sucesso" class="mt-3" style="display: none;">
         Atualização concluída! Você será redirecionado ao login
</label>
</div>
</div>
      </div>
</body>
</html>