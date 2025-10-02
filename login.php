<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once "configs/database.php";
include_once "php/usuario.php";
include_once "controller/usuarioController.php";


if($_SERVER['REQUEST_METHOD'] === "POST"){
    $controller = new usuarioController();

    if(isset($_POST['Cadastrar'])){
        $controller->cadastrarUsuario($_POST['usuario']);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Teste de cadastrado</h1>
    
    <form action="" method="post">
        <label for="">Nome</label>
        <input type="text" name="nome">

        <label for="">E-mail</label>
        <input type="email" name="email">

        <label for="">Senha</label>
        <input type="password" name="senha">

        <label for="">Tel</label>
        <input type="tel" name="telefone">

        <button type="submit" name="Cadastrar">Cadastrar</button>

    </form>
</body>
</html>