$(document).ready(function(){
	$("#btnatt").prop('disabled', true);
	$("#btnEdit").click(function(){
		var email = $("#emailesqueci").val();

		$.ajax({
			url: "func/esqueci.php",
			method: "POST",
			data:{
				"email": email
			},
			success: function(retorno){
				if (retorno == 1) {
					$("#sucesso").slideDown("slow",function(){
				  		setTimeout(function(){
				  			$("#sucesso").slideUp("slow");
				 		},2000);
				 	});
				}
				else{
				 	$("#fracassoRecupera").slideDown("slow",function(){
				  		setTimeout(function(){
				  			$("#fracassoRecupera").slideUp("slow");
				 		},2000);
				 	});
				 }
			},
			timeout: 3000,
			error: function(){
				alert("Erro ao mandar para o servidor");
			}
		});
	})
	$("#cadconfirma").keyup(function(){
		var confirma = $("#cadconfirma").val();
		var senha = $("#cadsenha").val();

		if (confirma == senha) {
			$("#btnatt").prop('disabled', false);
		}
		else{
			$("#btnatt").prop('disabled', true);
		}
	});
	$("#btnatt").click(function(){
		var id = $("#cadid").val();
		var confirma = $("#cadconfirma").val();

		$.ajax({
			url: "func/update.php",
			method: "POST",
			data:{
				"id": id,
				"senha": confirma
			},
			success: function(retorno){
				$("#sucesso").slideDown();
					setTimeout(function(){
						$("#sucesso").slideUp();
						setTimeout(function(){
							$(location).attr('href', 'index.php');
						}, 500);
					}, 1500);
			},
			timeout: 3000,
			error: function(){
				alert("Erro ao mandar para o servidor");
			}
		});
	})
});