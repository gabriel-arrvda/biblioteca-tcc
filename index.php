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
  <script type="text/javascript">
    $(document).ready(function(){
      $("#pesquisa").click(function(){
        $("#displayHome").slideUp('fast', function(){
          $("#voltar").show('slow');
          $("#displaySearch").show('fast');
          var pesquisanome = "";
          var pesquisaano = "";
          var pesquisacurso = "";

    $.ajax({
      url: "pesquisa.php",
      method: "GET",
      data:{
        "pesquisacurso": pesquisacurso,
        "pesquisaano": pesquisaano,
        "pesquisanome": pesquisanome
      },
      success: function(retorno){
      $("#resultados").html("");
      var json = $.parseJSON(retorno);
      var projetos = "";
      var todos = "";
      if (json.length == 0) {
        $("#erro").show();
        $("#Ptitulo").hide();
      }
      for (var i = 0; i < 6; i++) {
        $("#erro").hide();
        $("#Ptitulo").show();
        projetos ='<a href="upload/'+json[i].arquivo+'" style="color: black !important">';
        projetos +='<div class="card flex-shrink-0 my-4 text-center" id="link">';
        projetos +='<div class="card-header text-black textos teste">'+json[i].ncurso+'</div>';
        projetos +='<div class="card-body" style="min-height: 205px;">';
        projetos +='<h5 class="card-title font-weight-bold titulos" style="font-size: 24px; text-transform: uppercase;">'+json[i].nome+'</h5>';
        projetos +='<p class="card-text textos">'+json[i].alunos+'</p>';
        projetos +='</div>';
        projetos +='<div class="card-footer text-black textos teste">'+json[i].ano+'</div>';
        projetos +='</div>';
        projetos += '</a>';
        $("#resultados").append(projetos);
      }
    },
    timeout: 3000,
    error: function(){
      alert("Erro ao mandar para o servidor");
    } 
    })
        });
      });

      $("#logar").click(function(){
        $("#displayHome").slideUp('fast', function(){
          $("#voltar").show('slow');
          $("#displayLog").show('slow');
        });
      });
      $("#voltar").click(function(){
        $("#voltar").hide('slow');
        $("#pesquisacurso").val("");
        $("#pesquisaano").val("");
        $("#pesquisanome").val("");
        $("#displaySearch").slideUp('fast', function(){
          $("#displayLog").slideUp('fast', function(){
            $("#displayHome").show('slow');
        });
        });
      });
    })
  </script>   
  </head>
<body class="d-flex flex-column h-100">
<div id="page-content">
<?php 
  require "grid/nav.php";
?>
  <button type="button" class="btn btn-outline ml-3 mt-4 textos" id="voltar" style="display: none; width: 25%; font-size: 20px;">Voltar</button>
  <!-- Tela inicial -->
  <div class="pt-4 text-black flex-shrink-0 mt-5" id="displayHome">
    <div class="container">
      <div class="row">
        <div class="col">
         	<div class="jumbotron pt-2 pb-3 mt-5 text-justify" style="color: black !important; background-color: white !important; border: solid 3px black; min-height: 300px">
          <center>
         		<h1 class="titulos">Visitantes</h1>
          </center>
            <p class="textos">Nesta área, todos terão acesso à parte escrita do projeto</p> 
            <p class="textos">O intuito é: o usuário saber se algum tema de TCC já foi usado. Caso tenha já tenha sido, dar a possibilidade de alguma melhoria no mesmo.</p>
          <center>
            <button type="button" class="btn btn-outline textos mt-4" id="pesquisa">CONSULTAR</button>
         	</center>	

         	</div>
        </div>

        <div class="col">
         	<div class="jumbotron pt-2 pb-3 mt-5 text-justify" style="color: black !important; background-color: white !important; border: solid 3px black; min-height: 300px">
         		<center>
            <h1 class="titulos">Professores</h1>
          </center>
            <p class="textos">Nesta área, os professores poderão cadastrar novos projetos.</p>
            <p class="textos">O intuito é de que o professor e a escola consiga consultar os projetos de anos anteriores para fins didáticos. Além disso, serve como mecanismo de armazenagem virtual dos trabalhos.</p>
          <center>
            <button type="button" class="btn btn-outline textos" id="logar">LOGAR</a>
          </center> 
         		
         	</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tela de pesquisa -->
  <div class="py-3 text-black flex-shrink-0 mt-3 mb-5" id="displaySearch" style="display: none;">
    <div class="container">
      <div class="row p-2" style="border: solid 2px black;">
        <div id="form" class="col-xl">
        <h3 class="titulos">Pesquisa de Projetos</h3>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNome">Pesquisa pelo nome do projeto</label>
      <input type="text" class="form-control" name="pesquisanome" id="pesquisanome">
    </div>
    <div class="form-group col-md-4">
      <label for="inputCurso">Curso</label>
      <select id="pesquisacurso" class="form-control" name="pesquisacurso">
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
      <select id="pesquisaano" class="form-control" name="pesquisaano">
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
  <button type="button" class="btn btn-outline btn-lg" id="pesquisar" style="float: right;">Pesquisar</button>
</form>
</div>
</div>
</div>
    <h3 class="display-4 ml-5 my-4" id="Ptitulo">Projetos</h3>
    <center>
      <div class="alert alert-danger ml-3 mt-3" role="alert" style="display: none; width: 60%;" id="erro">Nenhum resultado encontrado na pesquisa!</div>
    </center>
      <div class="card-columns mx-5 my-1 flex-shrink-0" style="font-size: 16px;" id="resultados">
 
    </div>
</div>
      <!-- Tela de login professor -->
      <div class="py-3 text-black flex-shrink-0 my-3" id="displayLog" style="display: none;">
    <div class="container">
      <div class="row p-2" style="border: solid 2px black;">
        <div id="form" class="col-xl">
        <h2 class="titulos">Login de Professor e de Coordenador</h2>
<form action="func/logar.php" class="textos" method="POST">
  <div class="form-row">
    <div class="form-group col-md-12 textos">
      <label for="cademail">Email:</label>
      <input type="email" class="form-control" id="cademail" name="cademail" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12 textos">
      <label for="cadsenha">Senha</label>
      <input type="password" class="form-control" id="cadsenha" name="cadsenha" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12 textos">
      <div class="checkbox-nice">
        <input class="form-check-input-inline" type="checkbox" name="coordena" id="coordena" value="valida">
        <label class="form-check-label" for="coordena">Coordenador</label>
      </div>
    </div>
  </div>
  <button type="button" class="btn btn-outline btn-lg textos" id="btnlogar" style="float: right;">Logar</button>
</form>
<label id="fracasso" style="display: none; margin-top: 60px;">
         Preencha os dados corretamente!
        </label>
</div>
</div>
<br>
<button type="button" class="btn btn-outline" data-toggle="modal" data-target="#modalsenha">Esqueci minha senha</button>
</div>
      </div>
      </div>

  <div class="modal fade" id="modalsenha" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="titulomodal">Atualizar senha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form>
      <div class="modal-body">
        <div class="form-group">
        <label>E-mail</label>
        <input type="text" class="form-control" id="emailesqueci" name="emailesqueci" placeholder="Digite seu e-mail" required>
      </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-outline-primary" id="btnEdit">Confirmar</button>
  </div>
</div>
  <label id="sucesso" style="display: none;">
    Requisição enviada para o seu email
  </label>
  <label id="fracassoRecupera" style="display: none;">
    Email não existe
  </label>
</div>
</div>
<?php 
  require "grid/footer.php";
?>
</body>
</html>