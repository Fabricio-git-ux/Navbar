<?php

include_once "../controller/usuarioController.php";
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST["email"]) && isset($_POST["senha"])){
        $controller = new usuarioController();
        $controller->login($_POST["email"], $_POST["senha"]);
    }
} 


?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teste de login</title>
</head>
<body>

    <form method="POST" action="login.php">
        <label for="Nome">E-mail de login</label>
        <input type="email" name="usuario[email]" id="email" required>

        <label for="senha">Senha</label>
        <input type="password" name="usuario[senha]" id="senha" required>

        <button>Entrar</button>
    </form>

    <?php 
    if(isset($_SESSION['erro'])) {
        echo $_SESSION['erro'];
    } elseif(isset($_SESSION['erros'])) {
        echo $_SESSION['erros'];
    }
    ?>

    <p>Clique aqui para cadastrar <a href="cadastro.php">Cadastrar</a></p>
    
</body>
</html>