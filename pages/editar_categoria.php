<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once(__DIR__ . '/../controller/categoriaController.php');
include_once(__DIR__ . '/../php/categoria.php');

$controller = new categoriaController();

// Verifica se foi passado o ID pela URL
if (!isset($_GET['id_categoria']) || empty($_GET['id_categoria'])) {
    die("ID da categoria inválido.");
}

$id = (int) $_GET['id_categoria'];

// Busca a categoria atual
$categoria = $controller->localizarCategoriaPorID($id);
if (!$categoria) {
    die("Categoria não encontrada.");
}

// Se enviou o formulário, atualiza
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_categoria'])) {
    $novoNome = trim($_POST['nome_categoria']);
    if ($novoNome !== '') {
        $controller->atualizarCategoria([
            'id_categoria' => $id,
            'nome_categoria' => $novoNome
        ]);
        header("Location: categorias.php"); // redireciona para a lista
        exit();
    } else {
        $erro = "O nome da categoria não pode estar vazio.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">Editar Categoria</h1>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form action="" method="POST" class="bg-white p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="nome_categoria" class="form-label">Nome da Categoria</label>
                <input type="text" class="form-control" id="nome_categoria" name="nome_categoria"
                       value="<?= htmlspecialchars($categoria->nome_categoria) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="categorias.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>

</html>
