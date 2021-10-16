$(document).ready(function(){
$("#abrirmodalprof").click(function(){
      $("#modalprof").show();
      $("#modalprojeto").hide();
      $("#modalcurso").hide();
      $("#abrirmodalprof").addClass("active");
      $("#abrirmodalprojeto").removeClass("active");
      $("#abrirmodalcurso").removeClass("active");

    });
    $("#abrirmodalprojeto").click(function(){
      $("#modalprojeto").show();
      $("#modalprof").hide();
      $("#modalcurso").hide();
      $("#abrirmodalprojeto").addClass("active");
      $("#abrirmodalprof").removeClass("active");
      $("#abrirmodalcurso").removeClass("active");

    });
    $("#abrirmodalcurso").click(function(){
      $("#modalcurso").show();
      $("#modalprojeto").hide();
      $("#modalprof").hide();
      $("#abrirmodalcurso").addClass("active");
      $("#abrirmodalprojeto").removeClass("active");
      $("#abrirmodalprof").removeClass("active");

    });
$("#btngerarsenha").click(function(){
	$.ajax({
		url: "func/gerar_senha.php",
		method: "GET",
		data:{
			"tipo": "gera"
		},
		success: function(retorno){
			$("#gerarsenha").val(retorno);
			$("#aviso").html("Senha gerada!");
		},
		timeout: 3000,
		error: function(){
			alert("Erro ao mandar para o servidor");
		}
	});
});

$("#editNome").click(function(){
		$("#displayEdit").slideDown('slow');
});

$("#btnlogar").click(function(){
		var cademail = $("#cademail").val();
		var cadsenha = $("#cadsenha").val();
		var coordena = $("#coordena").is(":checked");
		var coordenador = 0;

		if (coordena == true) {
			coordenador = 1;
		}
		else{
			coordenador = "";
		}

		if (cademail != "" && cadsenha != "") {
	$.ajax({
		url: "func/logar.php",
		method: "POST",
		data:{
			"cademail": cademail,
			"cadsenha": cadsenha,
			"coordenador": coordenador
		},
		success: function(retorno){
		if (retorno == 1) {
			if (cademail == "admin@etec") {
					$(location).attr('href', 'admin.php?var=0');
			}
			else{
				if (coordenador == 1) {
					$(location).attr('href', 'home_coordenador.php?var=0');
				}
				else{
					$(location).attr('href', 'home_professor.php?var=0');
				}
		}
	}
		else{
			$("#fracasso").slideDown("slow",function(){
				 	setTimeout(function(){
				 		$("#fracasso").slideUp("slow");
				 	},2000);
				 });
		}
		},
		timeout: 3000,
		error: function(){
			alert("Erro ao mandar para o servidor");
		}
	});
}
else{
	$("#fracasso").slideDown("slow",function(){
				 	setTimeout(function(){
				 		$("#fracasso").slideUp("slow");
				 	},2000);
				 });
}
});


$("#btncadcurso").click(function(){
		var nomecurso = $("#nomecurso").val();
		if (nomecurso != "") {
	$.ajax({
		url: "func/cadcurso.php",
		method: "POST",
		data:{
			"nomecurso": nomecurso
		},
		success: function(retorno){
			$("#sucesso").slideDown("slow",function(){
				 	setTimeout(function(){
				 		$("#sucesso").slideUp("slow");
				 	},2000);
				 });
		},
		timeout: 3000,
		error: function(){
			alert("Erro ao mandar para o servidor");
		}
	});
	}
	else{
		$("#fracasso").slideDown("slow",function(){
				 	setTimeout(function(){
				 		$("#fracasso").slideUp("slow");
				 	},2000);
				 });
	}
});

$("#btncadprof").click(function(){
		var nomeprof = $("#nomeprof").val();
		var gerarsenha = $("#gerarsenha").val();
		var coordenador = $("#coordenador").is(":checked");

		if (coordenador == true) {
			coordenador = 1;
		}
		else{
			coordenador = 0;
		}

		var email = $("#email").val();
		var idCurso = $("#idCurso").val();

		if (nomeprof != "" && gerarsenha != "" && email != "" && email != "admin@etec") {
	$.ajax({
		url: "func/cadprofessor.php",
		method: "POST",
		data:{
			"nomeprof": nomeprof,
			"gerarsenha": gerarsenha,
			"coordenador": coordenador,
			"email": email,
			"idCurso": idCurso
		},
		success: function(retorno){
			$("#gerarsenha").val("");
			$("#nomeprof").val("");
			$("#email").val("");
			$("#sucesso").slideDown("slow",function(){
				 	setTimeout(function(){
				 		$("#sucesso").slideUp("slow");
				 	},2000);
				 });
			$("#aviso").html("Email redirecionado ao professor!");
		},
		timeout: 3000,
		error: function(){
			alert("Erro ao mandar para o servidor");
		}
	});
}
else{
	$("#fracasso").slideDown("slow",function(){
				 	setTimeout(function(){
				 		$("#fracasso").slideUp("slow");
				 	},2000);
				 });
}
});


	$("#pesquisar").click(function(){
		var pesquisanome = $("#pesquisanome").val();
		var pesquisaano = $("#pesquisaano").val();
		var pesquisacurso = $("#pesquisacurso").val();

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
			if (json.length == 0) {
				$("#erro").show();
				$("#Ptitulo").hide();
			}
			for (var i = 0; i < json.length; i++) {
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

	$("#cursoprof").click(function(){
	var curso = $("#cursoprof option:selected").val();
		$.ajax({
			url: "func/selectprof.php",
			method: "POST",
			data:{
				"curso": curso
			},
			success: function(retorno){
				
			$("#professores").html("");
			var json = $.parseJSON(retorno);
			var professores = "";
			for (var i = 0; i < json.length; i++) {
		professores = '<option value="'+json[i].idProfessor+'">'+json[i].nome+'</option>';
        $("#professores").append(professores);
			}
		},
		timeout: 9000,
		error: function(){
			alert("Erro ao mandar para o servidor");
		}	
		})

	});
	var curso = 1;
	$.ajax({
			url: "func/selectprof.php",
			method: "POST",
			data:{
				"curso": curso
			},
			success: function(retorno){
				
			$("#professores").html("");
			var json = $.parseJSON(retorno);
			var professores = "";
			for (var i = 0; i < json.length; i++) {
		professores = '<option value="'+json[i].idProfessor+'">'+json[i].nome+'</option>';
        $("#professores").append(professores);
			}
		},
		timeout: 9000,
		error: function(){
			alert("Erro ao mandar para o servidor");
		}	
		})

	$("#btnatualizarcoordenador").click(function(){
	var prof = $("#professores option:selected").val();
	var curso = $("#cursoprof option:selected").val();
		$.ajax({
			url: "func/atualizarcoordenador.php",
			method: "POST",
			data:{
				"professor": prof,
				"curso": curso
			},
			success: function(retorno){
		$("#sucessocoor").slideDown("slow",function(){
				 	setTimeout(function(){
				 		$("#sucessocoor").slideUp("slow");
				 	},2000);
				 });
		},
		timeout: 9000,
		error: function(){
			alert("Erro ao mandar para o servidor");
		}	
		})

	});
});