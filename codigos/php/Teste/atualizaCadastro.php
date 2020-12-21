<?php 
//pagina do usuario 
session_start();//sessão rodando
require_once "criar-classe-banco-de-dados.inc.php";
require_once "classe-usuario.inc.php";

$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas");
$conexao = $banco->criarConexao();
$banco->abrirBanco($conexao);
$banco->definirCharset($conexao);
$usuario  = new Usuario();
	
if($_SESSION['email']){//se sessão (preenchida no cadastroLogin) não estiver vazia faça:
	$email =  $_SESSION['email'];//pegando o email guardado em cadastroLogin
    $nome = $usuario->retornaNome($conexao, $banco->nomeDaTabela1, $email);//pegando o nome do usuario pelo email
    $email = $usuario->retornaEmail($conexao, $banco->nomeDaTabela1, $email); //pegando o email do usuario
    $senha =  $usuario->retornaSenha($conexao, $banco->nomeDaTabela1, $email); //pegando o email do usuario
    if($nome == false){
		header("Location: cadastroLogin.php"); //se o nome não existir ele volta pra pagina de login
    }
?>
    <form action="atualizaCadastro.php" method="POST">
        <label>Atualiza nome:</label>
        <input type="text" name="novoNome">
        <button type="submit" name="botaonome"> atualiza</button>
    </form>
    <form action="atualizaCadastro.php" method="POST">
        <label>Atualiza email:</label>
        <input type="email" name="novoEmail">
        <button type="submit" name="botaoemail"> atualiza</button>
    </form>
    <form action="atualizaCadastro.php" method="POST">
        <label>Atualiza senha:</label>
        <input type="password" name="novaSenha">
        <button type="submit" name="botaosenha"> atualiza</button>
    </form>
<?php
}else
{ //se session estiver vazia no email volta para pagina de login
    header("Location: cadastroLogin.php");
}

if(isset($_POST["botaonome"])){ 
    $usuario->atualizaNome($conexao,$banco->nomeDaTabela1, $email);
}else
if(isset($_POST["botaoemail"])){ 
    $usuario->atualizaEmail($conexao, $banco->nomeDaTabela1, $email);
}else
if(isset($_POST["botaosenha"])){
    $usuario->atualizaSenha($conexao, $banco->nomeDaTabela1, $email);
}
