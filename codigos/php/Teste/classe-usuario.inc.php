<?php

class Usuario
{
	public $email;
	public $nome;
	public $senha;

	function receberDadosFormulario($conexao)
	{
		$email 	= trim($conexao->escape_string($_POST["email-usuario"]));
		$nome 	= trim($conexao->escape_string($_POST["nome-usuario"]));
		$senha 	= trim($conexao->escape_string($_POST["senha-usuario"]));

		$this->nome 	 = $nome;
		$this->email 	 = $email;
		$this->senha	 = $senha;
	}

	function cadastrar($conexao, $nomeDaTabela1)
	{
		$sql = "INSERT $nomeDaTabela1 VALUES(
		
		'$this->email',
		'$this->nome',
		'$this->senha')";

		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
	function login($conexao, $nomeDaTabela1,$email,$senha)
	{
		$sql ="SELECT email from $nomeDaTabela1 WHERE email = '$email' AND senha='$senha'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if($conexao->affected_rows == 0)
			{

				exit("<p>algo deu errado</p>");
				session_destroy();
			}
	}
	function nome($conexao, $nomeDaTabela1, $email){
		$sql ="SELECT nome from $nomeDaTabela1 WHERE email = '$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if($conexao->affected_rows == 0)
		{

				return false;
		}else
		{
				//usuario foi encontrado
				$registro = $resultado->fetch_array();
				$nome = $registro[0];
				$nome = htmlentities($nome, ENT_QUOTES,"UTF-8");
				return $nome;
		}

	}

}


?>
