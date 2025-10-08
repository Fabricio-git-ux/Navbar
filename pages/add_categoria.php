<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once(__DIR__ . '/../controller/categoriaController.php');

$controller = new categoriaController();

// Cadastrar categoria
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_categoria'])) {
    $controller->cadastrarCategoria($_POST);
    header("Location: pag_categoria.php");
    exit();
}

// Listar categorias existentes
$categorias = $controller->pesquisarCategoria("");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h1>Gerenciar Categorias</h1>

    <!-- Formulário de cadastro -->
    <form action="" method="post" class="mb-4">
        <div class="mb-3">
            <label for="nome_categoria" class="form-label">Nome da Categoria</label>
            <input type="text" name="nome_categoria" id="nome_categoria" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

    <!-- Tabela de categorias -->
    <h2>Categorias Cadastradas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $cat): ?>
                <tr>
                    <td><?= htmlspecialchars($cat->id_categoria) ?></td>
                    <td><?= htmlspecialchars($cat->nome_categoria) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
