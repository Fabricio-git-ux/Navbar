<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once(__DIR__ . '/../controller/tarefaController.php');
include_once(__DIR__ . '/../controller/categoriaController.php');

// Instancia os controllers
$tarefaController = new tarefaController();
$categoriaController = new categoriaController();

// Busca todas as categorias para popular o <select>
$categorias = $categoriaController->pesquisarCategoria(""); // ou use um método listarTodosCategorias()

// Cadastrar tarefa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tarefa'])) {
    $tarefaController->cadastrarTarefa($_POST['tarefa']);
    header("Location: /../tarefa.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">Cadastro de Tarefas</h1>

        <form action="" method="post" class="mb-4 bg-white p-4 rounded shadow-sm">

            <!-- TÍTULO -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="tarefa[titulo]" required>
            </div>

            <!-- DESCRIÇÃO -->
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="tarefa[descricao]" rows="6" required></textarea>
            </div>

            <!-- STATUS -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="tarefa[status]" required>
                    <option value="pendente">Pendente</option>
                    <option value="em andamento">Em andamento</option>
                    <option value="concluído">Concluído</option>
                </select>
            </div>

            <!-- CATEGORIA -->
            <div class="mb-3 d-flex align-items-end">
                <div class="flex-grow-1 me-2">
                    <label for="id_categoria" class="form-label">Categoria</label>
                    <select class="form-select" id="id_categoria" name="tarefa[id_categoria]">
                        <option value="">Nenhuma categoria</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= $cat['id_categoria'] ?>">
                                <?= htmlspecialchars($cat['nome_categoria']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <!-- Botão criar categoria -->
                    <a href="/pages/add_categoria.php" class="btn-success">Criar Categoria</a>
                </div>
            </div>

            <button type="submit" class="btn-primary">Cadastrar</button>

        </form>
    </div>
</body>

</html>