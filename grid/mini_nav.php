  <nav class="navbar navbar-expand navbar-light cinza" style="height: 40px;">
  	<a href="comousar.php" target="comousar" class="btn etec" style="position: relative; float: left; margin-left: 5px;"><i class="fas fa-info-circle fa-lg"></i> Ajuda</a>
	<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent" style="padding-right: 50px;">
		<ul class="navbar-nav">
			<li class="nav-item text-uppercase textos" style="font-size: 18px; padding-top: 17.5px;">
				<p><?php echo $_SESSION['nome']?> <a href="javascript:editPerfil(<?php echo $_SESSION['id']?>)" style="color: black !important"><i class='fas fa-user-cog' style="color: #B20000; font-size: 24px;"></i></a>
			</li>
		</ul>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</nav>