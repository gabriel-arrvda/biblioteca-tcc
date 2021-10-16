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
<form class="textos" action="home_coordenador.php?var=<?php echo $x?>" method="POST">
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
        <button class="btn btn-cad ml-3 mt-4 textos" data-toggle="modal" data-target="#cadastros">+Cadastrar</button>
    </div>
  </div>
</div>

  <div class="pt-4 text-black col-xl" id="displayHome">

  <?php

  $estilopendente = "";
  $estiloverificado = "";

  if(isset($_GET["var"]) && $_GET["var"] == 1){
    $estiloverificado = "active";     
  }
  else{
    $estilopendente = "active";
  }

  ?>
  <a href="home_coordenador.php?var=0" class="btn btn-outline <?= $estilopendente ?>" id="btnpendente">Pendentes</a>
  <a href="home_coordenador.php?var=1" class="btn btn-outline <?= $estiloverificado ?>" id="btnverificado">Verificados</a>
</div>

  <?php 
  $tabelapendente = "";
  $tabelaverificado = "";

  if(isset($_GET["var"]) && $_GET["var"] == 0){
    $tabelapendente = '<th scope="col">Nome</th>
      <th scope="col">Alunos</th>
      <th scope="col">Arquivo</th>
      <th scope="col">Permitir</th>
      <th scope="col">Negar</th';     
  }
  else{
    $tabelaverificado = '<th scope="col">Nome</th>
      <th scope="col">Alunos</th>
      <th scope="col">Arquivo</th>';
  }
  ?>

   <table class="table table-bordered table-hover table-responsive mt-2" id="resultado">
  <thead class="cinza">
    <tr>
      <?php 
        echo $tabelapendente.$tabelaverificado;
      ?>
    </tr>
  </thead>
  <tbody class="table">

  <?php
  if ($var == 1) {
    $sqlprojeto = "SELECT * FROM projeto WHERE verificado = 1 AND nome LIKE '%$pesquisanome%' AND ano LIKE '%$pesquisaano%' AND idCurso LIKE '%$pesquisacurso%'";
  }
  else{
     $sqlprojeto = "SELECT * FROM projeto WHERE verificado = 0 AND nome LIKE '%$pesquisanome%' AND ano LIKE '%$pesquisaano%' AND idCurso LIKE '%$pesquisacurso%'";
  }
  $pdoprojeto = $con->prepare($sqlprojeto);
  $pdoprojeto->execute();
  $count = $pdoprojeto->rowCount();
  if ($count > 0) {
  while($projeto = $pdoprojeto->fetch(PDO::FETCH_OBJ)){
   ?>
    <tr class="justify-content-center">
    <?php 
      if ($var == 1) {
    ?>
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
    <?php
      } else{
    ?>
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
      <td style="width: 8%;" class="pl-5"><a href="func/permitir.php?id=<?php echo $projeto->idProjeto ?>" class="btn btn-outline-success"><i class="far fa-thumbs-up"></i></a></td>
      <td style="width: 8%;" class="pl-5"><a href="func/negar.php?id=<?php echo $projeto->idProjeto ?>" class="btn btn-outline-danger" onclick="return  confirm('Deseja realmente excluir o projeto selecionado?')"><i class="far fa-thumbs-down"></i></a></td>
    <?php
      }
    ?>
      
    </tr>
    <?php
    }
}
else{
      ?>
      <div class="alert alert-danger m-3" role="alert">
  Nenhum resultado encontrado na pesquisa!
</div>
<script>
$(document).ready(function(){
    $("#resultado").hide();
})
</script>

      <?php
    }
    ?>
  </tbody>
</table>

<!-- MODAL PARA PROFESSORES -->
<div class="modal fade" id="cadastros" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="titulomodal">Escolha: 
          <button type="button" class="btn btn-outline active" id="abrirmodalprof" name="abrirmodalprof">Professor</button>
          <button type="button" class="btn btn-outline" id="abrirmodalprojeto" name="abrirmodalprojeto">Projeto</button>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" id="apagar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modalprof">
      <form>
      <div class="modal-body">
        <div class="form-group">
        <label for="nomeprof">Nome</label>
        <input type="text" class="form-control" id="nomeprof" name="nomeprof" placeholder="Nome do professor" maxlength="70" required>
      </div>

        <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail do professor" maxlength="70" required>
      </div>

      <div class="form-group">
        <label for="senha">Gerar Senha</label>
        <br>
        <button type="button" class="btn btn-outline my-1 btn-lg" id="btngerarsenha"><i class="fas fa-key"></i></button>
        <input type="hidden" class="form-control" id="gerarsenha" name="gerarsenha" placeholder="Senha do professor" required>
        <br>
        <label id="aviso" style="color: green;"></label>
      </div>

    </div>

      <div class="modal-footer">
        <button type="reset" class="btn btn-outline" data-dismiss="modal" id="btnsair">Cancelar</button>
        <button type="button" class="btn btn-outline-primary" id="btncadprof">Cadastrar</button>
      </div>
</form>
</div>
<div id="modalprojeto" style="display: none;">
  <form action="func/cadprojeto.php" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="form-group">
        <label for="nomeprojeto">Nome</label>
        <input type="text" class="form-control" id="nomeprojeto" name="nomeprojeto" placeholder="Nome do projeto" maxlength="50" required>
      </div>

        <div class="form-group">
        <label for="alunos">Alunos</label>
        <input type="text" class="form-control" id="alunos" name="alunos" placeholder="Nome dos alunos por extenso" maxlength="255" required>
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

            <label>Destaque</label>
        </div>
    </div>

  </div>
  <div class="modal-footer">
        <button type="reset" class="btn btn-outline" data-dismiss="modal" id="btnsair">Cancelar</button>
        <button type="submit" class="btn btn-outline-primary" id="btncadprojeto">Cadastrar</button>
      </div>
</form>
</div>
        <label id="sucesso" style="display: none;">
         Cadastro concluído!
        </label>
        <label id="fracasso" style="display: none;">
         Preencha os dados corretamente!
        </label>

  </div>
</div>
</div>
<?php 
  require "grid/perfil.php";
?>
</div>
<?php 

  require "grid/footer.php";
?>
</body>
</html>