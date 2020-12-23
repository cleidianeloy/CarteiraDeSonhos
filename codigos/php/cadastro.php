<?php
require_once "funcoes/funcoes.inc.php"; 
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Cadastro</title>
	<link rel="stylesheet" type="text/css" href="../css/">
	
</head>
<body>
	
	<img src="../../midias/imagem/logo.png" alt="logo">
	<a href="">Conheça</a>
	<a href="">Contato</a>
	<a href="">Login/Cadastra-se</a>
	
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
	<img src="../../midias/imagem/16.png" alt="menina subindo a escada">
	<h1>Cadastro</h1>
	<form method="post" action="cadastro.php">
		<label>Nome:</label>
		<input type="text" name="nome-usuario" required>
		<label>Email:</label>
		<input type="email" name="email-usuario"required>
		<label>Senha:</label>
		<input type="password" name="senha-usuario" required>
		<label>Confirmação de Senha:</label>
		<input type="password" name="senhaConfirmação" required>

	<button type="submit" name="cadastrar-usuario">Cadastrar</button>
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

</body>
</html>

