<?php
class BancoDeDados
{   
	public $servidor;
	public $usuario;
	public $senha;
	public $nomeDoBanco;
	public $nomeDaTabela1;


# 2° CONSTRUTOR DA CLASSE. 
#OBS: CONFIRMAR SEMPRE A QTD DOS PARAMENTROS.
	function __construct( $servidorBanco, $usuarioBanco, $senhaAcesso, $nomeBanco, $nomeDaTabela1 )
	{
		$this->servidor 	= $servidorBanco;
		$this->usuario		= $usuarioBanco;
		$this->senha 		= $senhaAcesso;
		$this->nomeDoBanco	= $nomeBanco;
		$this->nomeDaTabela1 = $nomeDaTabela1;
		
	}
# 3° CRIAR O MÉTODO QUE ESTABELECE  A LIGAÇÃO ENTRE O NOSSO CÓDIGO PHP E O MYSQL.
	function criarConexao()
	{
		$conexao = new mysqli($this->servidor, $this->usuario, $this->senha) or exit($conexao->error);
		return $conexao;
	}
# 4° MÉTODO PARA CRIAÇÃO FÍSICA DO BANCO DE DADOS NO SERVIDOR.
	function criarBanco($conexao)
	{								     #USE PARA ABRIR O BANCO DE DADOS.
		$sql = "CREATE DATABASE IF NOT EXISTS $this->nomeDoBanco";                 
							 #CONSULTA.
		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
# 5° MÉTODO P/ SELECIONAR O BANCO DE DADOS.
	function abrirBanco($conexao)
	{
		$conexao->select_db($this->nomeDoBanco);
	}
# 6° MÉTODO P/ DEFINIR NO BANCO DE DADOS, O UTF-8 COMO O CONJUNTO DE CARACTERES-PADRÃO.
	function definirCharset($conexao)
	{
		$conexao->set_charset("utf8");
	}	
# 7° MÉTODO P/ CRIAR AS TABELAS NO BANCO DE DADOS.
	function criarTabelas($conexao)
	{	#OBS: EVITAR CARACTERES ACENTUADO P/  MONTAR AS TABELAS .
		//CRIANDO A 1ª TABELA USUARIO.
		$sql = "CREATE TABLE IF NOT EXISTS $this->nomeDaTabela1(
				email VARCHAR(70) PRIMARY KEY,
				nome VARCHAR(300),
			    senha VARCHAR(8)) ENGINE=innoDB";

		$resultado = $conexao->query($sql) or exit($conexao->error);


	}
# MÉTODO P/ FINALIZAR A CONEXÃO.
	function desconectar($conexao)
	{
		$conexao->close();
	}

}

?>