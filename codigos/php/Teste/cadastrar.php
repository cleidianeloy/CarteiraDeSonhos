
<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar usuário</title>
</head>
<body>
	<h1>Cadastrar usuário:</h1>
	<form action="cadastrar.php" method="post" >
		<fieldset>

			<label>Digite seu E-mail:</label>
			<input type="text" name="email-usuario"><br><br>

			<label>Digite seu Nome:</label>
			<input type="text" name="nome-usuario"><br><br>

			<label>Cadastre uma senha:</label>
			<input type="password" name="senha-usuario"><br><br>

			<button type="submit" name="cadastrar-usuario">Cadastrar usuário</button>


		</fieldset>
		
	</form>
<?php
require_once "criar-classe-banco-de-dados.inc.php";
require_once "classe-usuario.inc.php";


$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");

$conexao = $banco->criarConexao();

$banco->criarBanco($conexao);

$banco->abrirBanco($conexao);

$banco->definirCharset($conexao);

$banco->criarTabelas($conexao);

$usuario   = new Usuario();


if(isset($_POST["cadastrar-usuario"]))
{
	$usuario->receberDadosFormulario($conexao);
	$usuario->cadastrar($conexao, $banco->nomeDaTabela1 );
	echo"<p> Dados do usuario cadastrado com sucesso no banco de dados.</p>";
}
$banco->desconectar($conexao);

/*tudo isso pode ser substituido por 
require_once "funcoes.inc.php"; 
if(isset($_POST["cadastrar-usuario"]))
{
	cadastrar();
}
//porque está usando o arquivo de funções onde já esta escrito tudo isso 
*/
?>

</body>
</html>