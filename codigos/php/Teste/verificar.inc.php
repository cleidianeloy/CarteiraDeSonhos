<?php
require_once "criar-classe-banco-de-dados.inc.php";
require_once "classe-usuario.inc.php";
//require_once "criar-classe-metas.inc.php";

$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");

$conexao = $banco->criarConexao();

$banco->criarBanco($conexao);

$banco->abrirBanco($conexao);

$banco->definirCharset($conexao);

$banco->criarTabelas($conexao);

$usuario   = new Usuario();



if(isset($_POST["login"]))
{
	$email = $_POST["email"];
    $senha = $_POST["senha"];
	$usuario->login($conexao, $banco->nomeDaTabela1, $email, $senha);
	header("Location: paginaUsuario.php");
}
$banco->desconectar($conexao);