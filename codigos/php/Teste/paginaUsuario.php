<?php 
//pagina do usuario 
session_start();//sessão rodando
require_once "criar-classe-banco-de-dados.inc.php";
require_once "classe-usuario.inc.php";
if($_SESSION){//se sessão (preenchida no cadastroLogin) não estiver vazia faça:
	$email =  $_SESSION['email'];//pegando o email guardado em cadastroLogin

	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");
	$conexao = $banco->criarConexao();
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$usuario  = new Usuario();

	$nome = $usuario->nome($conexao, $banco->nomeDaTabela1, $email); //pegando o nome do usuario pelo email
	echo ("<h1>Bem vindo, $nome</h1>");

}else
{ //se session estiver vazia volta para pagina de login
	header("Location: cadastroLogin.php");
}



?>
