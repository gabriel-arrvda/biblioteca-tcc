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
<div class="pt-4 text-black flex-shrink-0 mt-1" id="displayHome">
    <div class="container">
    <h2 class="text-center">MANUAL DO SITE:</h2>
  <div id="carouselComousar" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="manual/m1.png" alt="First slide">
      <div class="carousel-caption d-none d-md-block text-dark">
      <br>
    <h5>Tela inicial. Logar como professor ou entrar como visitante.</h5>
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="manual/m2.png" alt="Second slide">
       <div class="carousel-caption d-none d-md-block text-dark">
      <br>
    <h5>Tela de login. Inserir os dados para acessar o site.</h5>
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="manual/m3.png" alt="Third slide">
       <div class="carousel-caption d-none d-md-block text-dark">
      <br>
    <h5>Interface do professor. O mesmo poderá entrar na tela de cadastro, acessar o perfil (devidamente indicado) e consultar TCCS.</h5>
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="manual/m4.png" alt="Forth slide">
       <div class="carousel-caption d-none d-md-block text-dark">
    <h5>Tela de cadastro. Alternar entre cadastrar professores ou projetos.</h5>
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="manual/m5.png" alt="fifth slide">
       <div class="carousel-caption d-none d-md-block text-dark">
      <br>
    <h5>Tela de perfil. Aqui será possível trocar de senha.</h5>
  </div>
    </div>

  </div>
  <a class="carousel-control-prev" href="#carouselComousar" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon bg-dark" style="width: 30px; height: 30px;" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselComousar" role="button" data-slide="next">
    <span class="carousel-control-next-icon bg-dark" style="width: 30px; height: 30px;" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
</div>
</div>
 <?php 
  require "grid/footer.php";
?>
</body>
</html>