<?php
session_cache_expire(60);
session_start();

require_once "funcoes/funcoes.inc.php"; 
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Esqueci minha senha</title>
	
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<header class="menu">
			 <div id="menu" class="container">
				<div class="logo">
					<img  src="../../midias/imagem/logo.svg" alt="logo">
				</div>
				<div class="links">
					<a class="topico" href="#conheça">Conheça</a>
					<a class="topico" href="#contato">Contato</a> 
					<a class="topico" href="#cadastro-login">Login/Cadastre-se</a>
				</div> 
			 </div>
</header>
<div class="esqueci">
	<div>
		<img src="../../midias/imagem/16.png" alt="Menina subindo a escada">
	</div>
	<div class="form">	
		<h1>Esqueceu sua senha</h1>
		<h4>Digite o seu email abaixo para nos enviarmos uma nova senha </h4>
		<label> <span> Email:</span> <input type="email" name="email" required=""></label>
		<span> <button>Esqueci minha senha</button></span>
	</div>
</div>
</body>
</html>


