function editPerfil(codigo){
	$.ajax({
		url: "func/perfil.php",
			method: "GET",
			data:{
				"tipo": "exibir",
				"codigo": codigo
			},
			success: function(retorno){
				var json = $.parseJSON(retorno);

				$("#editEmail").val(json.email);
				if (json.email == "admin@etec") {
					$("#idPerfil").val(json.id);
				}
				else{
					$("#idPerfil").val(json.idProfessor);
				}

				$("#perfil").modal('show');
			},
			timeout: 3000,
			error: function(){
				alert("Erro ao mandar para o servidor");
			}
		});
}

function logar(senha){
	var email = $("#editEmail").val();
	$.ajax({
		url: "func/perfil.php",
		method: "POST",
		data:{
			"tipo": "logar",
			"email": email,
			"senha": senha
		},
		success: function(retorno){
			if (retorno == 1) {
				$("#group-senha").slideDown();
			}
			else{
				$("#group-senha").slideUp();
			}
		},
		timeout: 3000,
		error: function(){
			alert("Erro ao mandar para o servidor");
		}
	});
}

$(document).ready(function(){
	$("#editSenha").keyup(function(){
		var senha = $("#editSenha").val();
		logar(senha);
	})

	$("#btneditar").click(function(){
		var senha = $("#editSenhaNova").val();
		var id = $("#idPerfil").val();
		$.ajax({
			url: "func/perfil.php",
			method: "POST",
			data:{
				"tipo": "editar",
				"senha": senha,
				"codigo": id
			},
			success: function(retorno){
				if (retorno == 1) {
					$("#sucessoEdit").slideDown();
					setTimeout(function(){
						 $("#sucessoEdit").slideUp();
						 setTimeout(function(){
							 $(location).attr('href', 'func/logout.php');
						}, 500);
					}, 1500);
				}
				else{
					$("#fracassoEdit").slideDown();
					$("#fracassoEdit").slideUp();
				}
			},
			timeout: 6000,
			error: function(){
				alert("Erro ao mandar para o servidor");
			}
		});
		})
})	