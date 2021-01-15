<?php
session_start();//sessão rodando/ ela precisa ficar rodando pra a função reconhecer lá no banco o email 
require_once "funcoes.inc.php"; //aqui precisa se direto da pasta se não ele vai fazer de outra maneira
require_once "classe-usuario.inc.php";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Metas</title>
	<link rel="stylesheet" type="text/css" href="../css/">
</head>

<body>
	<h1>Nova Meta:</h1>
	<form method="post" action="cadastroMetas.php">
		<label>Nome:</label>
		<input type="text" name="nome-meta" required ><br>

		<label>Objetivo guardado:</label>
		<input type="number" name="valor-meta" min="0"  step="any" required ><br>

	<button type="submit" name="cadastrar-meta">Salvo Meta</button> <br><br>
	
	
</form>
<?php 
		if(isset($_POST["cadastrar-meta"])){
			//$nomeMeta = $_POST["nome-meta"];
			// 	$valor= $_POST["valor-meta"];
		
			cadastrarMeta();
		 
		} 
	


		
?>

</body>
</html>