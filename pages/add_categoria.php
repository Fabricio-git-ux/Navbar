<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../../Navbar/error/acesso.php');
}

include_once(__DIR__ . '/../controller/categoriaController.php');

$controller = new categoriaController();

// Cadastrar categoria
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_categoria'])) {
    $controller->cadastrarCategoria(['nome_categoria' => $_POST['nome_categoria']]);
    header("Location: add_categoria.php");
    exit();
}

// Atualizar categoria (recebe POST de editar_categoria.php)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alterar'])) {
    $controller->atualizarCategoria([
        'id_categoria' => $_POST['id_categoria'],
        'nome_categoria' => $_POST['nome_categoria']
    ]);
    header("Location: add_categoria.php");
    exit();
}


// Deletar categoria
if (isset($_GET['excluir'])) {
    $id_categoria = intval($_GET['excluir']);
    $controller->excluirCategoria($id_categoria);
    header("Location: add_categoria.php");
    exit();
}

// Listar categorias existentes
$categorias = $controller->pesquisarCategoria("");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Gerenciar Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Gerenciar Categorias</h1>

        <!-- Formulário de cadastro -->
        <form action="" method="post" class="mb-4">
            <div class="mb-3">
                <label for="nome_categoria" class="form-label">Nome da Categoria</label>
                <input type="text" name="nome_categoria" id="nome_categoria" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="/../Navbar/pages/add_tarefa.php" class="btn btn-secondary">Voltar</a>
        </form>

        <!-- Tabela de categorias -->
        <h2>Categorias Cadastradas</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categorias)): ?>
                    <?php foreach ($categorias as $cat): ?>
                        <tr>
                            <td hidden><?= htmlspecialchars($cat->id_categoria) ?></td>
                            <td><?= htmlspecialchars($cat->nome_categoria) ?></td>
                            <td>
                                <a href="editar_categoria.php?id=<?= $cat->id_categoria ?>" class="btn btn-warning btn-sm">
                                    Editar
                                </a>


                                <a href="?excluir=<?= $cat->id_categoria ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir esta categoria?')">
                                    Deletar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center">Nenhuma categoria cadastrada</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>