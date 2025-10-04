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
<html lang="pr-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>teste de login</title>
  <link rel="stylesheet" href="../style/login.css">
  <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script>
      function handleCredentialResponse(response){
        console.log("Token JWT:", response.credential);
        alert("Login realizado com sucesso");
      }

      window.onload =  function(){
        google.accounts.id.initialize({
          client_id: "312183358933-0b757uv9gunqjt8jmchpplos7n048hop.apps.googleusercontent.com",
          callback: handleCredentialResponse
        });

        google.accounts.id.renderButton(
          document.getElementById("g_id_signin"),
          { theme: "outline", size: "large", width: "250"}
        );

        google.accounts.id.prompt();
      }
    </script>
</head>
<body>

  <!-- From Uiverse.io by mahiatlinux -->
  <form class="form" method="POST" action="login.php">
    <div class="flex-column">
      <label>Email </label>
    </div>
    <div class="inputForm">
      <svg
        height="20"
        viewBox="0 0 32 32"
        width="20"
        xmlns="http://www.w3.org/2000/svg">
        <g id="Layer_3" data-name="Layer 3">
          <path
            d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
        </g>
      </svg>
      <input type="text" class="input" name="email" id="senha" placeholder="Enter your Email" />
    </div>

    <div class="flex-column">
      <label>Password </label>
    </div>
    <div class="inputForm">
      <svg
        height="20"
        viewBox="-64 0 512 512"
        width="20"
        xmlns="http://www.w3.org/2000/svg">
        <path
          d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path>
        <path
          d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
      </svg>
      <input type="password" class="input" name="senha" id="senha" placeholder="Enter your Password" />
    </div>

    <div class="flex-row">
      <div>
        <input type="radio" />
        <label>Remember me </label>
      </div>
      <span class="span"><a href="recuperar.php"></a>Forgot password?</span>
    </div>
    <button class="button-submit">Sign In</button>
    <p class="p">Don't have an account? <span class="span"><a href="cadastro.php" class="sing">Sign Up</a></span></p>
    <p class="p line">Or With</p>

      <div class="btn google" id="g_id_signin"></div>

      <button class="btn apple">
        <svg
          version="1.1"
          height="20"
          width="20"
          id="Capa_1"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          x="0px"
          y="0px"
          viewBox="0 0 22.773 22.773"
          style="enable-background:new 0 0 22.773 22.773;"
          xml:space="preserve">
          <g>
            <g>
              <path
                d="M15.769,0c0.053,0,0.106,0,0.162,0c0.13,1.606-0.483,2.806-1.228,3.675c-0.731,0.863-1.732,1.7-3.351,1.573 c-0.108-1.583,0.506-2.694,1.25-3.561C13.292,0.879,14.557,0.16,15.769,0z"></path>
              <path
                d="M20.67,16.716c0,0.016,0,0.03,0,0.045c-0.455,1.378-1.104,2.559-1.896,3.655c-0.723,0.995-1.609,2.334-3.191,2.334 c-1.367,0-2.275-0.879-3.676-0.903c-1.482-0.024-2.297,0.735-3.652,0.926c-0.155,0-0.31,0-0.462,0 c-0.995-0.144-1.798-0.932-2.383-1.642c-1.725-2.098-3.058-4.808-3.306-8.276c0-0.34,0-0.679,0-1.019 c0.105-2.482,1.311-4.5,2.914-5.478c0.846-0.52,2.009-0.963,3.304-0.765c0.555,0.086,1.122,0.276,1.619,0.464 c0.471,0.181,1.06,0.502,1.618,0.485c0.378-0.011,0.754-0.208,1.135-0.347c1.116-0.403,2.21-0.865,3.652-0.648 c1.733,0.262,2.963,1.032,3.723,2.22c-1.466,0.933-2.625,2.339-2.427,4.74C17.818,14.688,19.086,15.964,20.67,16.716z"></path>
            </g>
          </g>
        </svg>

        Apple
      </button>
    </div>
  </form>


</body>

</html>