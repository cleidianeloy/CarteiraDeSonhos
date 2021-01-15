<?php

class Metas
{
	public $nomeMeta;
	public $email;
	public $valor;
	

	function receberDadosFormulario($conexao)
	{
		$nome 	= trim($conexao->escape_string($_POST["nome-meta"]));
		$email 	= trim($conexao->escape_string($_SESSION["email"]));
		$valor 	= trim($conexao->escape_string($_POST["valor-meta"]));

		$this->nomeMeta	 = $nome;
		$this->email 	 = $email;
		$this->valor 	 = $valor;
	}

	function cadastrarMeta($conexao, $nomeDaTabela2)
	{
		$sql = "INSERT $nomeDaTabela2 VALUES(
		
		'$this->nomeMeta',
		'$this->email',
		'$this->valor')";
		//nomeMeta estava como nome 
		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
	function mostrarMetas($conexao, $nomeDaTabela2){
		$email = trim($conexao->escape_string($_SESSION["email"]));
		$sql = "SELECT * FROM $nomeDaTabela2 WHERE email='$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);

		echo "<table>
		     <caption> Dados das metas cadastradas</caption>
		     <tr>
				<th>Nome Meta</th>
				<th>E-mail</th>
				<th>Valor</th>
		     </tr>";

		while($registro = $resultado->fetch_array())
		{
// LEMBRE-SE: SEGUNRANÇA DA NOSSA APLICAÇÃO É IMPORTANTE: SEMPRE QUE VOCÊ FIZER O PHP RECEBER DADOS DO BANCO DE DADOS, CERTIFIQUE-SE DE UTILIZAR FILTRAGEM ADQUADA, IMPEDINDO QUE SUA APLICAÇÃO FUNCIONE COMO UMA FERRAMENTA DE INVASÃO DA MAQUINA CLIENTE(XSS)
		 $nome = htmlentities($registro[0], ENT_QUOTES,"UTF-8");
		 $email = htmlentities($registro[1], ENT_QUOTES,"UTF-8");//registro["nome"]
		 $valor = htmlentities($registro[2],ENT_QUOTES,"UTF-8") ;
		 $valor = number_format($valor, 2, ',', '.');
			echo "<tr>
			       <td> $nome  </td>
			       <td> $email </td>
			       <td> $valor </td>
			      </tr>";
		}
		echo "</table>";
	}

}


?>