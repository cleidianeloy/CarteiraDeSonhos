<?php 
//pagina do usuario 
session_start();//sessão rodando
require_once "criar-classe-banco-de-dados.inc.php";
require_once "classe-usuario.inc.php";

$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");
$conexao = $banco->criarConexao();
$banco->abrirBanco($conexao);
$banco->definirCharset($conexao);
$usuario  = new Usuario();
	
if($_SESSION['email']){//se sessão (preenchida no cadastroLogin) não estiver vazia faça:
	$email =  $_SESSION['email'];//pegando o email guardado em cadastroLogin
    $nome = $usuario->retornaNome($conexao, $banco->nomeDaTabela1, $email);//pegando o nome do usuario pelo email
    if($nome == false){
		header("Location: cadastroLogin.php"); //se o nome não existir ele volta pra pagina de login
    }else
    {
    	echo ("<h1>Bem vindo, $nome</h1>"); //se existir funciona normalmente
    }
	
?>
<form method= "post" action="paginaUsuario">
	<button type="submit" name="sair">sair</button>
</form>

<?php
}else
{ //se session estiver vazia no email volta para pagina de login
	header("Location: cadastroLogin.php");
}
if(isset($_POST["sair"])){ //se o botão sair for clicado ele:
	session_destroy(); //destroi a sessão
	header("Location: cadastroLogin.php"); //vai pra pagina de login
}



?>
