<?php
	session_start();
	$email = $_SESSION["email"];
	require_once "funcoes/funcoes.inc.php"; 
	testeUsuario($email);
	$nome = nome($email);
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Pagina - Usuario</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
		<header class="menu">
			 <div id="menu" class="container">
				<div class="logo">
					<img  src="../../midias/imagem/logo.svg" alt="logo">
				</div>
				<div class="links">
					<a class="topico" href="#conheça">Conheça</a>
					<a class="topico" href="#contato">Contato</a> 
					<a class="topico" href="#cadastro-login"><?php echo "$nome";?></a>
				</div> 
			 </div>
		</header>

		<section id="login" class="container">
			<div>
				<form action="paginaUsuario.php" method="post">
					<label>Email:</label>
					<input type="email" name="email"><br>
					<label>Senha:</label>
					<input type="password" name="senha"><br>
		
					<button type="submit" name="login" >Login</button>
				</form>
				<a href="cadastro.html">Clique aqui caso não tenha cadastro</a><br>
				<a href="esqueciSenha.html">	Esqueci minha senha</a>
			</div>
		</section>	
		
		<section class="id">
			<div> 

				<div>
					<img src="../../midias/imagem/caneta.svg" alt="imgCaneta">	
				</div>			
					<h2>Nome usuario: <?php echo "$nome";?><br>  
					 	 E-mail: <?php echo "$email";?> </h2> 
			</div>
		</section>	

		<section class="novaMeta">
			<div> 
							
					<h2> Nova meta + </h2> 

			</div>
		</section>	
		
		<section class="metas1">
			<div> 

				<div>
					<img src="../../midias/imagem/" alt="imgGrafico">	
				</div>
					
			</div>
		</section>	

		<section class="metas1">

					<h2> Meta 1: </h2>
			<div> 
				<div>
					<img src="../../midias/imagem/caneta.svg" alt="imgCaneta">	
				</div>

					<p>Guardado:</p>
					<p>Meta Final:</p>
				</div>
				<span class="btn-cadastre">
					<button><a href="historico.html">História</a></button>
				</span>

		</section>	
			
		

		<section class="footer">
			<div  class="container">
				<h1>Contato</h1>
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
</html>

