<?php
session_start();
session_destroy(); //destroi tudo que tinha na sessão recomeça de novo quando a pagina é acessada
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Cadastro-Login</title>
</head>
<body> 
	<h1>Cadastro - Login</h1>
	<form action="cadastroLogin.php" method="post">
		<fieldset>
			<legend>Já possui Cadastro?</legend>
			<label>E-mail:</label>
			<input type="text" name="email"><br><br>

			<label>Senha:</label>
			<input type="password" name="senha"><br><br>

			<a href="paginaUsuario.php"><button type="submit" name="login">Login</button></a><br><br>

			<a  href="cadastrar.php">Clique aqui caso não tenha cadastro</a></li> 

			
		</fieldset>
	</form>
<?php
session_start();

require_once "criar-classe-banco-de-dados.inc.php";
require_once "classe-usuario.inc.php";

$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");

$conexao = $banco->criarConexao();

$banco->abrirBanco($conexao);

$banco->definirCharset($conexao);

$usuario  = new Usuario();


if(isset($_POST["login"]))
{
	$email = $_POST["email"]; //recebe email do formulario
    $senha = $_POST["senha"]; // recebe senha do formulario
    $_SESSION["email"] = $email; //pega o email recebido e coloca na sessão
	$usuario->login($conexao, $banco->nomeDaTabela1, $email, $senha); //verifica se login é permitido
	header("Location: paginaUsuario.php"); //se sim, vai para pagina do usuario
}
$banco->desconectar($conexao); //desconecta do banco

?>
</body>
</html>