<?php

class Metas
{
	public $nomeMeta;
	public $usuario;
	public $valor;

	

	function receberDadosFormulario($conexao, $usuario)
	{
		$nome 	= trim($conexao->escape_string($_POST["nome-meta"]));
		$valor 	= trim($conexao->escape_string($_POST["valor-meta"]));
		//$usuario = trim($conexao ->escape_string($_POST["email-usuario"]));

		$this->nomeMeta	 = $nome;
		$this->usuario = $usuario;
		$this->valor 	 = $valor;

	}

	function cadastrar($conexao, $nomeDaTabela2)
	{
		$sql = "INSERT $nomeDaTabela2 VALUES(
		
		'$this->nomeMeta',
		'$this->usuario',
		'$this->valor')";

		$resultado = $conexao->query($sql) or exit($conexao->error);
	}


}


?>
