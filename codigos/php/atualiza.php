<?php session_cache_expire(60);
session_start();

require_once "funcoes/funcoes.inc.php"; 
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Histórico</title>
	<link rel="stylesheet" href="../css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!--carrega o jQuery-->
	<script src="../javascript/jquery-maskmoney-master/src/jquery.maskMoney.js"></script> <!--carrega o plugin da máscara. Estou enviando o pacote em anexo-->
</head>
<body>
			<header class="menu">
			 <div id="menu" class="container">
				<div class="logo">
					<img  src="../../midias/imagem/logo.svg" alt="logo">
				</div>
				<div class="links">
					<a class="topico" href="paginaUsuario.php">Pagina Usuario</a>
					<a class="topico" href="?sair=true">Sair</a>
				</div> 
				</div> 
				<?php
					if(isset($_GET['sair'])){ //se existe o sair 
						session_destroy(); //destroi a sessão
						header("Location: home.php"); 
					 }
?>
			 </div>
		</header>

		<section class="atualizar">
		<p>Para alterar o valor guardado cliquei em Adicionar ou Remover,Para adicionar basta clicar em adicionar e escreve o valor no campo abaixo do valor, para remover clique em remover e escreve o valor abaixo do campo com o sinal de negativo.</p>
			<div class="atualizar-valores"> 
				 <form method="POST">
					<div>
						<label>Adicionar</label>
						<input onclick="trocaMin()" type="radio" name="tipoValor" id="adicionar" value="adicionar" checked="">
						<label>Remover</label>
						<input onclick="trocaMax()" type="radio" name="tipoValor" id="remover" value="remover">
					</div>
					<div>
						<label>Valor</label>
						<input type="number" id="valor-depositado" name="valor-depositado">
						<button type="submit" name="atualizar-meta">Atualizar</button>
					</div>
				 </form>
				 <script src="../javascript/formata-moeda.js"></script>	
				 <script type="text/javascript">
				 	function trocaMin(){
				 		var x = document.getElementById("valor-depositado");
				 		x.setAttribute("min",0);
				 		x.setAttribute("max",999999999999999);
				 	}
				 	function trocaMax(){
				 		var x = document.getElementById("valor-depositado");
				 		x.setAttribute("max",0);
				 		x.setAttribute("min", -999999999999999);
				 	} 
				 </script>
				 <?php
				 	if(isset($_POST["atualizar-meta"])){
				 		cadastrarHistorico();
				 	}
				 ?>
			</div>
		</section>

		<section class="footer">
			<div  class="container">
				<h3>Contato</h3>
				<div class="contato">
					<div>
						<p>Email:  email@email.com</p>
						<p>Telefone:   (00) 0000-0000 </p>
					</div>
					<div>
						<img src="../../midias/imagem/icone-instagram.svg" alt="icone-instagram">
						<img src="../../midias/imagem/icone-facebook.svg" alt="icone-facebook">
					</div>
				</div>
			</div>
		</section>
</body>
</html>