<?php 
  session_start();
  if (empty($_SESSION["nome"])) {
    header("Location: index.php");
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
  <script src="js/edit_perfil.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css" type="text/css">  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<body class="d-flex flex-column h-100">
<div id="page-content">
<?php 
  require "grid/nav.php";
?>
<?php 
  require "grid/mini_nav.php";
?>
  <!-- Tela inicial -->
<?php
        $var = $_GET["var"];
        if(isset($var) && $var == 1){
          $x = 1;     
        }
        else{
          $x = 0;
        }
  ?>
  <div class="pt-4 text-black flex-shrink-0" id="displayHome">
    <div class="container">
      <div class="row p-2" style="border: solid 2px black;">
        <div id="form" class="col-xl">
        <h3 class="titulos">Pesquisa de Projetos</h3>
<form class="textos" action="home_professor.php" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNome">Pesquisa pelo nome do projeto</label>
      <input type="text" class="form-control" name="pesquisanome" id="inputNome">
    </div>
    <div class="form-group col-md-4">
      <label for="inputCurso">Curso</label>
      <select id="inputCurso" class="form-control" name="pesquisacurso">
      <option selected value="">Escolha..</option>        
        <?php 
        require 'config.php';
        $pesquisaano = "";
        $pesquisanome = "";
        $pesquisacurso = "";
        $sqlcurso = "SELECT * FROM curso";
        $pdocurso = $con->prepare($sqlcurso);
        $pdocurso->execute();

        while($curso = $pdocurso->fetch(PDO::FETCH_OBJ)){
         ?>
        <option value="<?php echo $curso->idCurso?>"><?php echo $curso->nome ?></option>
        <?php
      }
      ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputAno">Ano</label>
      <select id="inputAno" class="form-control" name="pesquisaano">
      <?php
        $sqlano = "SELECT * FROM projeto GROUP BY ano ORDER BY ano desc";
        $pdoano = $con->prepare($sqlano);
        $pdoano->execute();
        ?>
        <option selected value="">Escolha..</option>
        <?php
        while($ano = $pdoano->fetch(PDO::FETCH_OBJ)){
         ?>
        <option value="<?php echo $ano->ano ?>"><?php echo $ano->ano ?></option>
        <?php
      }
      ?>
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-outline btn-lg" style="float: right;">Pesquisar</button>
</form>
 <?php 
extract($_POST);
?>
</div>
</div>
      <div class="row">
        <button class="btn btn-cad ml-3 mt-4 textos" data-toggle="modal" data-target="#cadastrar">+Cadastrar projeto</button>
      </div>
    </div>
  </div>

  <div class="pt-4 text-black col-xl" id="displayHome">
   <table class="table table-bordered table-hover table-responsive" id="resultados">
  <thead class="cinza">
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Alunos</th>
      <th scope="col">Arquivo</th>
    </tr>
  </thead>
  <tbody class="table">

  <?php

  $sqlprojeto = "SELECT * FROM projeto WHERE verificado = 1 AND nome LIKE '%$pesquisanome%' AND ano LIKE '%$pesquisaano%' AND idCurso LIKE '%$pesquisacurso%'";
  $pdoprojeto = $con->prepare($sqlprojeto);
  $pdoprojeto->execute();
  $count = $pdoprojeto->rowCount();
  if ($count > 0) {
  while($projeto = $pdoprojeto->fetch(PDO::FETCH_OBJ)){
   ?>
    <tr class="justify-content-center">
      <td>
      <?php echo $projeto->nome.' ('.$projeto->ano.')';
      if($projeto->favorito == 1) {
        ?>
        <i class="fa fa-star" style="color: #E8C61C;"></i></td>
      <?php
      }
      ?></td>
      <td><?php echo $projeto->alunos?></td>
      <td style="width: 4%;"><?php echo '<a href ="upload/'.$projeto->arquivo.'" class="btn btn-outline ml-2"><i class="fa fa-file-pdf-o"></i></a>'; ?></td>
    </tr>
    <?php
    }
}
else{
      ?>
      <div class="alert alert-danger" role="alert">
  Nenhum resultado encontrado na pesquisa!
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#resultados").hide();
  })
</script>

      <?php
    }
    ?>
  </tbody>
</table>
</div>

  <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="titulomodal">Cadastrar TCC</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="func/cadprojeto.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nomeprojeto" placeholder="Nome do projeto" maxlength="50" required>
      </div>

        <div class="form-group">
        <label for="alunos">Alunos</label>
        <input type="text" class="form-control" id="alunos" name="alunos" placeholder="Nome dos alunos por extenso" maxlength="250" required>
      </div>

      <div class="form-group">
        <label for="nome">Ano</label>
        <select class="form-control" id="ano" name="ano">
          <?php 
            $ano = date('Y');
            $limite = $ano - 30;
  
            for ($i=$ano; $i >= $limite; $i--) { 
          ?>  
              <option value="<?php echo $i?>"><?php echo $i ?></option>
          <?php
            }
          ?>  
        </select>
      </div> 


      <div class="custom-file">
      <input type="file" name="arquivo" id="arquivo" accept="application/pdf">
      <div class="text-danger">Somente formato PDF.</div>
      </div>
      <br>

        <div class="pretty p-svg p-curve ml-3 mt-3 mb-4">
        <input type="checkbox" name="favorito" id="favorito">
        <div class="state p-success">
            <!-- svg path -->
            <svg class="svg svg-icon" viewBox="0 0 20 20">
                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
            </svg>

            <label> Destaque</label>
        </div>
    </div>

      <div class="modal-footer">
        <button type="reset" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-outline-primary" id="btnsalvar">Cadastrar</button>
      </div>
    </div>
  </div>
</div>
</div>
<?php 
  require "grid/perfil.php";
?>
<?php 

  require "grid/footer.php";
?>
</body>
</html>