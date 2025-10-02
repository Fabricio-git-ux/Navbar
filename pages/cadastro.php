<?php

include_once "../configs/database.php";
include_once "../controller/usuarioController.php";

//var_dump("oi");
//die();
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['usuario'])){
    $controller = new usuarioController();
    
   // if(isset($_POST['usuario'])){
        $controller->cadastrarUsuario($_POST['usuario']);
//}
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
    
    <form action="" method="POST">
        <label for="">Nome</label>
        <input type="text" name="usuario[nome]">

        <label for="">E-mail</label>
        <input type="email" name="usuario[email]">

        <label for="">Senha</label>
        <input type="password" name="usuario[senha]">

        <label for="">Tel</label>
        <input type="tel" name="usuario[telefone]">

        <button type="submit">Registrar</button>

    </form>
</body>
</html>