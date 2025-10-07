<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "../controller/usuarioController.php";


if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['usuario'])){
    $controller = new usuarioController();
    
    if(isset($_POST['usuario'])){
        $controller->cadastrarUsuario($_POST['usuario']);
        header('Location: /Navbar/index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="../style/cadastro.css">
</head>
<body class="container">

    <!-- From Uiverse.io by ammarsaa --> 
<form class="form" method="POST">
    <p class="title">Cadastrar </p>
    <p class="message">Inscreva-se. </p>
        <div class="flex">
        <label>
            <input class="input" id="input" name="usuario[nome]" type="text" required="">
            <span>Digite seu nome</span>
        </label>
    </div>  
            
    <label>
        <input class="input" type="email" name="usuario[email]" required="">
        <span>E-mail</span>
    </label> 
        
    <label>
        <input class="input" type="password" name="usuario[senha]" required="">
        <span>Senha</span>
    </label>
    <label>
        <input class="input" type="password" name="usuario[telefone]" required="">
        <span>Telefone</span>
    </label>
    <button class="submit" type="submit">Cadastrar</button>
    <p class="signin">Já tem uma conta? <a href="login.php">Signin</a> </p>
</form>

</body>
</html>