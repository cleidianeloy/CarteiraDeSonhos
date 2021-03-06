<?php

class Metas
{
	public $id;
	public $nomeMeta;
	public $usuario;
	public $valorTotal;
	public $valorAtual;

	

	function receberDadosFormulario($conexao)
	{
		$nome 	= trim($conexao->escape_string($_POST["nome-meta"]));
		$valorTotal 	= trim($conexao->escape_string($_POST["valor-meta"]));
		$usuario = trim($conexao ->escape_string($_SESSION["email"]));

		$this->nomeMeta	= $nome;
		$this->usuario  = $usuario;
		$this->valorTotal = $valorTotal;
		$this->valorAtual = 0;

	}

	function cadastrar($conexao, $nomeDaTabela2)
	{
		$sql = "INSERT $nomeDaTabela2 VALUES(
		null,
		'$this->nomeMeta',
		'$this->usuario',
		'$this->valorTotal',
		'$this->valorAtual')";

		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
	function apagarMeta($conexao, $nomeDaTabela2){
		$idMeta = trim($conexao->escape_string($_GET['apagar']));
		$usuario = trim($conexao ->escape_string($_SESSION["email"]));
		$sql = "DELETE FROM $nomeDaTabela2 WHERE usuario = '$usuario' and id = '$idMeta'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
	function mostrarMetas($conexao, $nomeDaTabela2){
		$email 	= trim($conexao->escape_string($_SESSION["email"]));


		$sql = "SELECT * FROM $nomeDaTabela2 WHERE usuario = '$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		while($registro = $resultado->fetch_array())
		{
	// LEMBRE-SE: SEGUNRANÇA DA NOSSA APLICAÇÃO É IMPORTANTE: SEMPRE QUE VOCÊ FIZER O PHP RECEBER DADOS DO BANCO DE DADOS, CERTIFIQUE-SE DE UTILIZAR FILTRAGEM ADQUADA, IMPEDINDO QUE SUA APLICAÇÃO FUNCIONE COMO UMA FERRAMENTA DE INVASÃO DA MAQUINA CLIENTE(XSS)
		 $id = htmlentities($registro[0], ENT_QUOTES,"UTF-8");
		 $nome = htmlentities($registro[1], ENT_QUOTES,"UTF-8");//registro["nome"]
		 $valorTotal = htmlentities($registro[3],ENT_QUOTES,"UTF-8") ;
		 $valorAtual = htmlentities($registro[4],ENT_QUOTES,"UTF-8") ;	
		 $valorAtual = floatval($valorAtual);
		 $valorTotal = floatval($valorTotal);
		 $porcentagem = (100*$valorAtual)/$valorTotal; 

			echo "	
			<section class='metas'>
			<div class='titulo-meta'>
				<h2> $nome </h2>
			</div>
			<div class='conteuo-meta'> 
				<div class='texto-meta'>
					<p>Guardado: $valorAtual</p>
					<p>Meta Final: $valorTotal</p>
				</div>
				<div>
					<img src='../../midias/imagem/caneta.svg' alt='imgCaneta'>	
				</div>	
			</div>
			<span class='btn-cadastre'>
				<button class='historico' name='historico'><a href='historico.php?meta=$id'>História</a></button>
				<button class='apagar' name='apagar'><a href='paginaUsuario.php?apagar=$id'>Apagar</a></button>
				<button class='atualizar' name='atualizar'><a href='atualiza.php?atualizaValor=$id'>Atualizar</a></button>
			</span>
			</section>";
		}
	
	}
	function atualizaValorTotal($conexao, $nomeDaTabela2){
		$usuario  =  trim($conexao->escape_string($_SESSION["email"]));
		$valor 	  =  trim($conexao->escape_string($_POST['valor']));
		$idMeta =  trim($conexao->escape_string($_GET['atualizaValor']));

		$sql = "UPDATE metas SET valorTotal = $valor WHERE nomeMeta IN (
				SELECT m.nomeMeta 
				FROM (SELECT nomeMeta FROM metas) m
				WHERE id = '$idMeta' 
				AND email = '$usuario' )";
		$resultado = $conexao->query($sql) or exit($conexao->error);

	}
	function atualizaValorNome($conexao, $nomeDaTabela2){
		$usuario  =  trim($conexao->escape_string($_SESSION["email"]));
		$novoNome =  trim($conexao->escape_string($_POST['nomeMeta']));
		$idMeta =  trim($conexao->escape_string($_GET['atualizaValor']));

		$sql = "UPDATE metas SET nomeMeta = $novoNome WHERE nomeMeta IN (
				SELECT m.nomeMeta 
				FROM (SELECT nomeMeta FROM metas) m
				WHERE nomeMeta = '$idMeta' 
				AND email = '$usuario' )";

		$resultado = $conexao->query($sql) or exit($conexao->error);

	}

	function atualizaValorAtual($conexao, $nomeDaTabela2){
		$usuario = trim($conexao->escape_string($_SESSION["email"]));

		$sql = "SELECT id FROM metas WHERE usuario ='$usuario'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		while ($registro = $resultado->fetch_array()) {
			$idMeta = htmlentities($registro[0], ENT_QUOTES,"UTF-8");
			$sql = "UPDATE metas SET valorAtual = (select sum(historico.valor) from historico where historico.id = $idMeta) where metas.id IN (select id  from  historico where historico.id = $idMeta)";
			$sql = $conexao->query($sql) or exit($conexao->error);
		}

	}

}


?>
