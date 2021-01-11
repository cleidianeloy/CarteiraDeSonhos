<?php

class Metas
{
	public $nomeMeta;
	public $usuario;
	public $valor;

	

	function receberDadosFormulario($conexao)
	{
		$nome 	= trim($conexao->escape_string($_POST["nome-meta"]));
		$valor 	= trim($conexao->escape_string($_POST["valor-meta"]));
		$usuario = trim($conexao ->escape_string($_SESSION["email"]));

		$this->nomeMeta	= $nome;
		$this->usuario  = $usuario;
		$this->valor 	= $valor;

	}

	function cadastrar($conexao, $nomeDaTabela2)
	{
		$sql = "INSERT $nomeDaTabela2 VALUES(
		
		'$this->nomeMeta',
		'$this->usuario',
		'$this->valor')";

		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
	function apagarMeta($conexao, $nomeDaTabela2, $nomeMeta){
		$usuario = trim($conexao ->escape_string($_SESSION["email"]));
		$sql = "DELETE FROM $nomeDaTabela2 WHERE usuario = $usuario and nomeMeta = $nomeMeta";
		$resultado = $conexao->query($sql) or exit($conexao->error);
	}

}


?>
