<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Negado</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ícones (Bootstrap Icons) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="acesso.css">
</head>
<body>

    <div class="error-card">
        <i class="bi bi-exclamation-triangle-fill error-icon"></i>
        <h2>Acesso Negado</h2>
        <p>Você precisa estar logado para acessar esta página.</p>
        <a href="../pages/login.php" class="btn btn-custom mt-2">
            <i class="bi bi-box-arrow-in-right me-1"></i> Ir para o Login
        </a>
    </div>

    <footer>
        &copy; Seu Sistema — Todos os direitos reservados
    </footer>

</body>
</html>
