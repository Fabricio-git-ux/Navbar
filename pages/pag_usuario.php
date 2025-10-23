<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "../configs/database.php";
include_once "../controller/usuarioController.php";
// Inicia a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se usuário está logado (normal ou Google)
if (!isset($_SESSION['id_usuario']) && !isset($_SESSION['usuarios_google'])) {
    header('Location: ../../Navbar/error/acesso.php');
    exit;
}

$controller = new usuarioController();

// GET: carregar sempre os dados do usuário logado
$u = $controller->localizarUsuario($_SESSION['id_usuario']);

// POST: atualizar dados do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'])) {
    $controller->atualizarUsuario($_POST['usuario']);
    // Redireciona após atualizar para evitar reenvio do formulário
    header("Location: pag_usuario.php?status=sucesso");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['excluir'])) {
    $controller->excluirUsuario($_GET['excluir']);
    header("Location: usuario.php");
    exit();
}

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Atualizar Usuário</title>

    <!-- Importa o CSS separado -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style/usuario.css">
</head>

<body>
    <nav class="menu-lateral">
        <div class="btn-expandir">
            <i class="bi bi-list" id="btn-exp"></i>
        </div>
        <ul>
            <li class="item-menu">
                <a href="../index.php">
                    <span class="icon"><i class="bi bi-house-door"></i></span>
                    <span class="txt-link">Home</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="/../Navbar/pages/tarefa.php">
                    <span class="icon"><i class="bi bi-card-checklist"></i></span>
                    <span class="txt-link">Tarefas</span>
                </a>
            </li>
            <li class="item-menu ativo">
                <a href="pag_usuario.php">
                    <span class="icon"><i class="bi bi-person-circle"></i></span>
                    <span class="txt-link">Conta</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="login.php">
                    <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                    <span class="txt-link">Saída</span>
                </a>
            </li>
        </ul>
    </nav>


    <div class="page">
        <main class="card" role="main" aria-labelledby="pageTitle">
            <h1 id="pageTitle">Atualizar dados do usuário</h1>
            <p class="subtitle">Altere seu nome, e-mail ou senha. Campos marcados com * são obrigatórios.</p>

            <!-- Ajuste o action conforme seu backend -->
            <form action="" method="POST" autocomplete="off" novalidate>
                <!-- Se precisar, inclua o ID do usuário -->
                <input type="hidden" name="usuario[id_usuario]"
                    value="<?= isset($u->id_usuario) ? htmlspecialchars($u->id_usuario) : '' ?>">

                <div class="field">
                    <label for="nome">Nome *</label>
                    <input
                        id="nome"
                        name="usuario[nome]"
                        type="text"
                        placeholder="Seu nome completo"
                        required
                        maxlength="120"
                        value="<?= isset($u->nome) ? htmlspecialchars($u->nome) : '' ?>">
                    <div class="hint">Ex.: João Silva</div>
                </div>

                <div class="field">
                    <label for="email">E-mail *</label>
                    <input
                        id="email"
                        name="usuario[email]"
                        type="email"
                        placeholder="seu@exemplo.com"
                        required
                        maxlength="180"
                        value="<?= isset($u->email) ? htmlspecialchars($u->email) : '' ?>">
                    <div class="hint">Use um e-mail válido (será usado para login).</div>
                </div>

                <div class="field">
                    <label for="senha">Senha</label>
                    <input
                        id="senha"
                        name="usuario[senha]"
                        type="password"
                        placeholder="Deixe em branco para manter a senha atual"
                        minlength="6"
                        maxlength="72"
                        value="">
                    <div class="hint">Mínimo 6 caracteres. Preencha apenas se quiser alterar a senha.</div>
                </div>

                <div class="actions">
                    <button type="submit" name="alterar" class="btn btn-primary" onclick="return confirm('Deseja realmente atualizar as informacoes')">Salvar alterações</button>
                    <a href="pag_usuario.php" class="btn btn-ghost" role="button">Cancelar</a>
                </div>
            </form>
        </main>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>