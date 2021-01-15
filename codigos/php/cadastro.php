<?php
require_once "funcoes/funcoes.inc.php"; 
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Cadastro</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	
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
					<a class="topico" href="#cadastro-login">Login/Cadastre-se</a>
				</div> 
			 </div>
</header>
<section class="cadastro">
	<div id="login">
		<form action="cadastro.php" method="post">
			<label>Email:</label>
			<input type="email" name="email" required="">
			<label>Senha:</label>
			<input type="password" name="senha" required="">
			<button type="submit" name="login" >Login</button>
		</form>
		<?php
			if(isset($_POST["login"])){
				login();
			}
		?>
		<a href="cadastro.php">	Clique aqui caso não tenha cadastro</a>
		<a href="esqueciSenha.php">	Esqueci minha senha</a>
	</div>
	<div class="formulario">
		<div>
		<img src="../../midias/imagem/16.png" alt="menina subindo a escada">
		</div>
		<div class="form">
			<h1>Cadastro</h1>
			<form method="post" action="cadastro.php">
				<label> <span> Nome:</span>
				<input type="text" name="nome-usuario" required> </label>
				<label><span> Email: </span>
				<input type="email" name="email-usuario"required></label>
				<label><span> Senha: </span>
				<input type="password" name="senha-usuario" required></label>
				<label><span> Confirmação de Senha: </span>
				<input type="password" name="senhaConfirmação" required></label>

			<span><button type="submit" name="cadastrar-usuario">Cadastrar</button></span>
			</form>
			<?php 
				if(isset($_POST["cadastrar-usuario"])){
					$senha = $_POST["senha-usuario"];
					$confirma = $_POST["senhaConfirmação"];
					if($senha == $confirma){
						cadastrar();
					}else
					{
						echo("senha não é igual a confirmação");
					}

				} 
			?>
		</div>	
	</div>
</section>
</body>
</html>

