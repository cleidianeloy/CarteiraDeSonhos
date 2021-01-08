<?php
require_once (__DIR__.'/../banco/criar-classe-banco-de-dados.inc.php');
require_once (__DIR__.'/../banco/classe-usuario.inc.php');
require_once(__DIR__.'/../banco/classe-metas.inc.php');

function login(){

$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");

$conexao = $banco->criarConexao();

$banco->criarBanco($conexao);

$banco->abrirBanco($conexao);

$banco->definirCharset($conexao);

$banco->criarTabelas($conexao);

$usuario  = new Usuario();
	session_start();
		$email = $_POST["email"]; //recebe email do formulario
	    $senha = $_POST["senha"]; // recebe senha do formulario
		$teste = $usuario->login($conexao, $banco->nomeDaTabela1, $email, $senha); //verifica se login é permitido
		if($teste){
			$_SESSION["email"] = $email; 
			header("Location: paginaUsuario.php");
		}else
		{
			echo("algo deu errado, tente de novo<br>");
		}
	$banco->desconectar($conexao); //desconecta do banco
}
function cadastrar(){

$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");

$conexao = $banco->criarConexao();

$banco->criarBanco($conexao);

$banco->abrirBanco($conexao);

$banco->definirCharset($conexao);

$banco->criarTabelas($conexao);

$usuario  = new Usuario();
		$usuario->receberDadosFormulario($conexao);
		$usuario->cadastrar($conexao, $banco->nomeDaTabela1);
		echo"<p> Dados do usuario cadastrado com sucesso no banco de dados.</p>";
	$banco->desconectar($conexao);
}

function nome($email){
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");
	$conexao = $banco->criarConexao();
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$usuario  = new Usuario();

	$nome = $usuario->retornaNome($conexao, $banco->nomeDaTabela1, $email);
	return $nome;
}
function email($email){
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");
	$conexao = $banco->criarConexao();
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$usuario  = new Usuario();

	$email = $usuario->retornaEmail($conexao, $banco->nomeDaTabela1, $email);
	return $email;
}
function senha($email){
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");
	$conexao = $banco->criarConexao();
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$usuario  = new Usuario();

	$senha = $usuario->retornaSenha($conexao, $banco->nomeDaTabela1, $email);
	return $senha;
}
function testeUsuario($email){
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");
	$conexao = $banco->criarConexao();
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$usuario  = new Usuario();
	
	if($email){//se sessão (preenchida no cadastroLogin) não estiver vazia faça:
		//$email =  $email;//pegando o email guardado em cadastroLogin
    	$nome = $usuario->retornaNome($conexao, $banco->nomeDaTabela1, $email);//pegando o nome do usuario pelo email
    	
    	if($nome == false){
		//header("Location: home.php"); //se o nome não existir ele volta pra pagina de login
    		return false;
    	}else
    	{
    		return true;
   		}
    }

	
}
function cadastrarMeta($usuario){
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");
    $conexao = $banco->criarConexao();
    $banco->criarBanco($conexao);
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$banco->criarTabelas($conexao);

	$meta  = new Metas();
		$meta->receberDadosFormulario($conexao,$usuario);
		$meta->cadastrar($conexao, $banco->nomeDaTabela2);
		echo"<p> Dados cadastrado com sucesso no banco de dados.</p>";
	$banco->desconectar($conexao);
}




?>