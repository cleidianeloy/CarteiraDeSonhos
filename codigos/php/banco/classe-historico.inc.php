<?php 
class Historico
{
	public $nomeMeta;
	public $data;
	public $valor;

	function receberDadosFormulario($conexao)
	{
		$nome 	= trim($conexao->escape_string($_POST["nome-meta"]));
		$valor 	= trim($conexao->escape_string($_POST["valor-depositado"]));


		$this->nomeMeta	 = $nome;
		//$this->data 	 = $data;
		$this->valor 	 = $valor;
	}

	function cadastrar($conexao, $nomeDaTabela3, $data)
	{
		$sql = "INSERT $nomeDaTabela3 VALUES(
					null,
		'$this->nomeMeta',
		'$data',
		'$this->valor')";

		$resultado = $conexao->query($sql) or exit($conexao->error);
	}

	function mostrar($conexao){
		$email = trim($conexao->escape_string($_SESSION["email"]));
		$metaNome = trim($conexao->escape_string($_GET['meta']));

		$sql = "SELECT * FROM historico,metas WHERE  email = '$email' and metas.nomeMeta = '$metaNome' and historico.nomeMeta = metas.nomeMeta";
		$resultado = $conexao->query($sql) or exit($conexao->error);

		echo "<table>
		     <caption> Dados das metas cadastradas</caption>
		     <tr>
				<th>Nome Meta</th>
				<th>Data </th>
				<th>Valor</th>
		     </tr>";
		while($registro = $resultado->fetch_array())
		{

		 $id = htmlentities($registro[0], ENT_QUOTES,"UTF-8");
		 $nomeMeta = htmlentities($registro[1], ENT_QUOTES,"UTF-8");//registro["nome"]
		 $data = htmlentities($registro[2],ENT_QUOTES,"UTF-8") ;
		 $valor = htmlentities($registro[3],ENT_QUOTES,"UTF-8") ;
			echo "<tr>
			       <td> $nomeMeta  </td>
			       <td> $data  </td>
			       <td> $valor  </td>
			      </tr>";
		}
		echo "</table>";
	}

}
?>