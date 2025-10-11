<?php

// Ativa exibição de erros (desenvolvimento)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once(__DIR__ . '/../controller/tarefaController.php');
include_once(__DIR__ . '/../controller/categoriaController.php');


$controller = new tarefaController();
$categoriaController = new categoriaController();


if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['alterar'])) {
    $t = $controller->localizarTarefa($_GET['alterar']);
} elseif ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['tarefa'])) {
    $controller->atualizarTarefa($_POST['tarefa']);
    header("Location: tarefa.php");
    exit;
} else {
    header("Location: tarefa.php");
    exit;
}




?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4">Editar Tarefa</h1>

    <!-- Formulário de edição -->
    <form action="editar_tarefa.php" method="POST" class="mb-4 bg-white p-4 rounded shadow-sm">

        <!-- ID da tarefa escondido para o POST -->
        <input type="hidden" name="tarefa[id_tarefa]" id="id_tarefa" value="<?= $t->id_tarefa  ?? '' ?>">
        
        <!-- Título -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="tarefa[titulo]" 
                   value="<?= htmlspecialchars($t->titulo ?? '') ?>" required>
        </div>

        <!-- Descrição -->
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="tarefa[descricao]" rows="6" required><?= htmlspecialchars($t->descricao ?? '') ?></textarea>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="tarefa[status]" required>
                <!--Verifica se existe o status e depois verifica se ele possui algum valor-->
                <option value="pendente" <?= isset($t->status) && $t->status === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="em andamento" <?= isset($t->status) && $t->status === 'em andamento' ? 'selected' : '' ?>>Em andamento</option>
                <option value="concluído" <?= isset($t->status) && $t->status == 'concluído' ? 'selected' : ''  ?>>Concluído</option>
            </select>
        </div>

        <!-- Categoria -->
        <div class="mb-3 d-flex align-items-end">
            <div class="flex-grow-1 me-2">
                <label for="id_categoria" class="form-label">Categoria</label>
                <select class="form-select" id="id_categoria" name="tarefa[nome_categoria]">
                    <option value="">Nenhuma categoria</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat->nome_categoria ?>" <?= ($t->nome_categoria == $cat->nome_categoria) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat->nome_categoria ?? '') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Botão para adicionar/editar categorias -->
            <a href="../pages/add_categoria.php" class="btn btn-success">Editar Categoria</a>
        </div>

        <!-- Botão salvar -->
        <button type="submit" class="btn btn-primary mt-3">Salvar Alterações</button>

    </form>
</div>

</body>
</html>
