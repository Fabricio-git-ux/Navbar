<?php
session_start(); // Inicia a sessão

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "../controller/tarefaController.php";
include_once "../controller/categoriaController.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    die("Você precisa estar logado para acessar esta página.");
} else {
}

$controller = new tarefaController();
$categoriaController = new categoriaController();

// Listar todas as tarefas
$tarefa = $controller->pesquisarTarefa("");

// Criar ou editar (POST)
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['criar'])) {
        // Adiciona o ID do usuário logado aos dados da tarefa
        $_POST['tarefa']['id_usuario'] = $_SESSION['id_usuario'];
        $controller->cadastrarTarefa($_POST['tarefa']);
        header("Location: tarefa.php");
        exit();
    } elseif (isset($_POST['editar'])) {
        $controller->atualizarTarefa($_POST['tarefa']);
        unset($_SESSION['tarefas']);
        header("Location: editar_tarefa.php");
        exit();
    }
}

// Excluir (GET)
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['excluir'])) {
    $controller->excluirTarefa($_GET['excluir']);
    header("Location: tarefa.php");
    exit();
}

// Buscar tarefas
$t = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pesquisa']) && trim($_POST['pesquisa']) !== '') {
    $t = $controller->pesquisarTarefa($_POST['pesquisa']);
    $tarefa = !empty($t) ? $t : [];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style/nav.css">
</head>

<body>

    <!-- Sidebar lateral -->
    <nav class="menu-lateral">
        <div class="btn-expandir">
            <i class="bi bi-list" id="btn-exp"></i>
        </div>
        <ul>
            <li class="item-menu">
                <a href="/../Navbar/index.php">
                    <span class="icon"><i class="bi bi-house-door"></i></span>
                    <span class="txt-link">Home</span>
                </a>
            </li>
            <li class="item-menu ativo">
                <a href="/../Navbar/pages/tarefa.php">
                    <span class="icon"><i class="bi bi-card-checklist"></i></span>
                    <span class="txt-link">Tarefas</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-calendar"></i></span>
                    <span class="txt-link">Agenda</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-gear"></i></span>
                    <span class="txt-link">Configuração</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-person-circle"></i></span>
                    <span class="txt-link">Conta</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                    <span class="txt-link">Saída</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Barra de pesquisa e adicionar tarefa -->
    <!-- 🔍 Pesquisa -->
    <form action="" method="POST" class="mb-4 d-flex gap-2">
        <input class="form-control" type="text" name="pesquisa" placeholder="Pesquisar tarefa...">
        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
    </form>

    <!-- ➕ Adicionar tarefa -->
    <form action="" method="POST" class="mb-4">
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="titulo" class="form-control" placeholder="Título" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="descricao" class="form-control" placeholder="Descrição">
            </div>
            <div class="col-md-2">
                <select name="id_categoria" class="form-select">
                    <option value="0">Sem categoria</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat->id_categoria ?>"><?= htmlspecialchars($cat->nome_categoria) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="Pendente">Pendente</option>
                    <option value="Concluída">Concluída</option>
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <button name="criar" type="submit" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- 📋 Tabela de tarefas -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Data de Criação</th>
                <th>Data de Alteração</th>
                <th style="width: 150px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tarefas)): ?>
                <?php foreach ($tarefas as $t): ?>
                    <tr>
                        <td><?= htmlspecialchars($t->titulo) ?></td>
                        <td><?= htmlspecialchars($t->descricao) ?></td>
                        <td><?= htmlspecialchars($t->status) ?></td>
                        <td><?= htmlspecialchars($t->data_criacao) ?></td>
                        <td><?= htmlspecialchars($t->data_atualizacao ?? '') ?></td>
                        <td>
                            <a href="editar_tarefa.php?id=<?= $t->id_tarefa ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="tarefa.php?excluir=<?= $t->id_tarefa ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Deseja realmente excluir?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Nenhuma tarefa encontrada</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>



    <script src="../js/script.js"></script>
</body>

</html>