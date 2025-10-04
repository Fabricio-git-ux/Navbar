<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "../controller/usuarioController.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  if (isset($_POST['email']) && isset($_POST['senha'])) {
    $controller = new usuarioController();
    $controller->login($_POST['email'], $_POST['senha']);
  }
}


?>

<!DOCTYPE html>
<html lang="pt-BR"> <!-- Corrigido de 'pr-BR' para 'pt-BR' -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>teste de login</title>
  <link rel="stylesheet" href="../style/login.css">
  <!-- Google Identity Services -->
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <script>
    function handleCredentialResponse(response) {
      console.log("Token JWT:", response.credential);
      alert("Login com Google realizado!");

      // Aqui você pode enviar o token para o backend via fetch/AJAX
      // Exemplo:
      /*
      fetch('login_google.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ token: response.credential })
      })
      .then(res => res.json())
      .then(data => {
        console.log(data);
      });
      */
    }

    window.onload = function () {
      google.accounts.id.initialize({
        client_id: "SEU_CLIENT_ID_AQUI", // <--- substitua pelo seu CLIENT ID
        callback: handleCredentialResponse
      });

      google.accounts.id.renderButton(
        document.getElementById("g_id_signin"),
        { theme: "outline", size: "large", width: "250" }
      );

      google.accounts.id.prompt(); // Exibe o pop-up de login, se possível
    }
  </script>
</head>

<body>

  <form class="form" method="POST" action="login.php">
    <div class="flex-column">
      <label>Email </label>
    </div>
    <div class="inputForm">
      <!-- seu campo de email -->
      <input type="text" class="input" name="email" placeholder="Enter your Email" />
    </div>

    <div class="flex-column">
      <label>Password </label>
    </div>
    <div class="inputForm">
      <!-- seu campo de senha -->
      <input type="password" class="input" name="senha" placeholder="Enter your Password" />
    </div>

    <div class="flex-row">
      <div>
        <input type="radio" />
        <label>Remember me </label>
      </div>
      <span class="span"><a href="recuperar.php">Forgot password?</a></span>
    </div>

    <button class="button-submit">Sign In</button>
    <p class="p">Don't have an account? <span class="span"><a href="cadastro.php" class="sing">Sign Up</a></span></p>
    <p class="p line">Ou entre com</p>

    <!-- Aqui é onde o botão do Google será renderizado -->
    <div id="g_id_signin" class="flex-row"></div>
  </form>

</body>

</html>
