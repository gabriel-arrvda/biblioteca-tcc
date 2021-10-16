<?php 
  function msg(){
 
   if(date("H") < 12){
 
     return "Bom dia, ";
 
   }elseif(date("H") > 11 && date("H") < 18){
 
     return "Boa tarde, ";
 
   }elseif(date("H") > 17){
 
     return "Boa noite, ";
 
   }
} 
?>
<div class="modal fade" id="perfil" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header etec">
        <h5 class="modal-title" id="titulomodal"><?php echo msg().$_SESSION["nome"]?></h5>      
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" id="apagar">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body">
      <h3 class="titulos">Editar Senha:</h3>
      <br>
      <input type="hidden" value="0" id="idPerfil">
        <div class="form-group">
          <label for="email">E-mail:</label>
          <input type="text" class="form-control" id="editEmail" placeholder="E-mail do professor" required disabled>
        </div>

        <div class="form-group">
          <label for="senha">Senha Atual:</label>
          <input type="password" class="form-control" id="editSenha" name="editSenha" placeholder="Senha atual">
        </div>
        <div class="form-group" style="display: none;" id="group-senha">
          <label for="senha">Senha Nova:</label>
          <input type="password" class="form-control" id="editSenhaNova" name="editSenhaNova" placeholder="Senha nova">
        </div>
        <label id="fracassoEdit" style="display: none; margin-top: 60px;">
         Preencha os dados corretamente!
        </label>
        <label id="sucessoEdit" style="display: none;">
         Atualização concluída! Você será redirecionado ao login
        </label>
      </div>
      <div class="modal-footer">
        <a href="func/logout.php" class="btn btn-outline-dark" style="float: left;">Finalizar sessão</a>
        <button type="reset" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-outline-primary" id="btneditar">Atualizar</button>
      </div>
</form>
</div>
</div>
</div>