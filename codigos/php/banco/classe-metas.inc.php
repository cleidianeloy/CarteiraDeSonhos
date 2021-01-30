<?php

class Metas
{
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
		
		'$this->nomeMeta',
		'$this->usuario',
		'$this->valorTotal',
		'$this->valorAtual')";

		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
	function apagarMeta($conexao, $nomeDaTabela2){
		$nomeMeta = trim($conexao->escape_string($_GET['apagar']));
		$usuario = trim($conexao ->escape_string($_SESSION["email"]));
		$sql = "DELETE FROM $nomeDaTabela2 WHERE email = '$usuario' and nomeMeta = '$nomeMeta'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
	function mostrarMetas($conexao, $nomeDaTabela2){
		$email 	= trim($conexao->escape_string($_SESSION["email"]));


		$sql = "SELECT * FROM $nomeDaTabela2 WHERE email = '$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);

		while($registro = $resultado->fetch_array())
		{
// LEMBRE-SE: SEGUNRANÇA DA NOSSA APLICAÇÃO É IMPORTANTE: SEMPRE QUE VOCÊ FIZER O PHP RECEBER DADOS DO BANCO DE DADOS, CERTIFIQUE-SE DE UTILIZAR FILTRAGEM ADQUADA, IMPEDINDO QUE SUA APLICAÇÃO FUNCIONE COMO UMA FERRAMENTA DE INVASÃO DA MAQUINA CLIENTE(XSS)
		 $nome = htmlentities($registro[0], ENT_QUOTES,"UTF-8");
		 $email = htmlentities($registro[1], ENT_QUOTES,"UTF-8");//registro["nome"]
		 $valorTotal = htmlentities($registro[2],ENT_QUOTES,"UTF-8") ;
		 $valorAtual = htmlentities($registro[3],ENT_QUOTES,"UTF-8") ;	
		 $valorAtual = floatval($valorAtual);
		 $valorTotal = floatval($valorTotal);
		 $porcentagem = (100*$valorAtual)/$valorTotal; 

			echo "
				
		
			<section class='metas'>
			<div> 

				<div>
					<canvas id='graficoAnimacao' width='600' height='400'></canvas>
					<script type='text/javascript'> desenhaCirculo(80, 50, 50, 'yellow', $porcentagem);</script>
				</div>
					
			</div>
		</section>	
			<section class='metas'>

					<h2> $nome </h2>
					<div> 
				<div>
					<img src='../../midias/imagem/caneta.svg' alt='imgCaneta'>	
				</div>

					<p>Guardado: $valorAtual</p>
					<p>Meta Final: $valorTotal</p>
				</div>
				<span class='btn-cadastre'>
					<button name='historico'><a href='historico.php?meta=$nome'>História</a></button>
					<button name='apagar'><a href='paginaUsuario.php?apagar=$nome'>Apagar</a></button>
					<button name='atualizar'><a href='paginaUsuario.php?atualizaValor=$nome'>Atualizar</a></button>
				</span>

		</section>";
		}
	
	}

	function atualizaValor($conexao, $nomeDaTabela2){
		$usuario = trim($conexao->escape_string($_SESSION["email"]));


		$sql = "SELECT nomeMeta FROM metas WHERE email='$usuario'";
		$resultado = $conexao->query($sql) or exit($conexao->error);

		while($registro = $resultado->fetch_array()){
			$nomeMeta = htmlentities($registro[0], ENT_QUOTES,"UTF-8");

			$sql = "UPDATE $nomeDaTabela2 SET valorAtual = (SELECT SUM(historico.valor) from historico where nomeMeta = '$nomeMeta' and email = '$usuario') where
			nomeMeta ='$nomeMeta' and email = '$usuario'";
			$sql = $conexao->query($sql) or exit($conexao->error);
		}


	}

}


?>
