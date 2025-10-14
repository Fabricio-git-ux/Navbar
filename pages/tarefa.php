<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


include_once "../controller/tarefaController.php";

$t = null;

$controller = new tarefaController();

// Criar ou editar (POST)
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['criar'])) {
        $controller->cadastrarTarefa($_POST['tarefa']);
        header("Location: add_tarefa.php");
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


// Listar todas as tarefas
$tarefa = $controller->pesquisarTarefa(""); // Aqui pode ser um método que retorna todas as tarefas




?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style/index.css">
    <title>Tarefas</title>
</head>

<body>

    <!--- Sidebar lateral --->
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
            <li class="item-menu ativo">
                <a href="#">
                    <span class="icon"><i class="bi bi-card-checklist"></i></i></span>
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

    <!--- Barra de pesquisa --->

    <div class="pesquisa">
        <form action="" method="POST">
            <div class="searchBox">

                <input class="searchInput" type="text" name="pesquisa" placeholder="Search something">
                <button class="searchButton">

                    <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                        <g clip-path="url(#clip0_2_17)">
                            <g filter="url(#filter0_d_2_17)">
                                <path d="M23.7953 23.9182L19.0585 19.1814M19.0585 19.1814C19.8188 18.4211 20.4219 17.5185 20.8333 16.5251C21.2448 15.5318 21.4566 14.4671 21.4566 13.3919C21.4566 12.3167 21.2448 11.252 20.8333 10.2587C20.4219 9.2653 19.8188 8.36271 19.0585 7.60242C18.2982 6.84214 17.3956 6.23905 16.4022 5.82759C15.4089 5.41612 14.3442 5.20435 13.269 5.20435C12.1938 5.20435 11.1291 5.41612 10.1358 5.82759C9.1424 6.23905 8.23981 6.84214 7.47953 7.60242C5.94407 9.13789 5.08145 11.2204 5.08145 13.3919C5.08145 15.5634 5.94407 17.6459 7.47953 19.1814C9.01499 20.7168 11.0975 21.5794 13.269 21.5794C15.4405 21.5794 17.523 20.7168 19.0585 19.1814Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" shape-rendering="crispEdges"></path>
                            </g>
                        </g>
                        <defs>
                            <filter id="filter0_d_2_17" x="-0.418549" y="3.70435" width="29.7139" height="29.7139" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                                <feOffset dy="4"></feOffset>
                                <feGaussianBlur stdDeviation="2"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="out"></feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_17"></feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_17" result="shape"></feBlend>
                            </filter>
                            <clipPath id="clip0_2_17">
                                <rect width="28.0702" height="28.0702" fill="white" transform="translate(0.403503 0.526367)"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </div>
            <div class="add_button">
                <a href="add_tarefa.php" name="criar" type="submit" style="border: none; background: #fff; color: #355cd0ff;">
                    <span class="add"><i class="bi-plus-circle"></i></span>
                </a>
            </div>

            <div id="pesquisa" style="color: black;">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['pesquisa']) && trim($_POST['pesquisa']) !== '') {
                        $t = $controller->pesquisarTarefa($_POST['pesquisa']);

                        if (empty($_POST['pesquisa']) === "") {
                            echo "Digite algo para pesquisar";
                        } elseif (empty($t)) {
                            echo "Nenhuma tarefa encontrada";
                        }
                    }
                }
                ?>
            </div>

        </form>
        <div class="conteudo">
            <!-- Conteúdo principal da página -->

            <table class="table table-hover table-striped table-bordered align-middle shadow-sm">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Data de Criação</th>
                        <th>Data de Alteração</th>
                        <th style="width: 140px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Definir lista base
                    $lista = $tarefa;

                    // Pesquisa
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pesquisa']) && trim($_POST['pesquisa']) !== '') {
                        $t = $controller->pesquisarTarefa($_POST['pesquisa']);
                        $lista = !empty($t) ? $t : [];
                    }
                    ?>

                    <?php if (!empty($lista)) : ?>
                        <?php foreach ($lista as $tarefas) : ?>
                            <tr>
                                <td hidden><?= htmlspecialchars($tarefas->id_tarefa) ?></td>
                                <td><strong><?= htmlspecialchars($tarefas->titulo) ?></strong></td>
                                <td><?= nl2br(htmlspecialchars($tarefas->descricao)) ?></td>
                                <td>
                                    <?php if ($tarefas->status === 'Concluída') : ?>
                                        <span class="badge bg-success"><?= htmlspecialchars($tarefas->status) ?></span>
                                    <?php elseif ($tarefas->status === 'Pendente') : ?>
                                        <span class="badge bg-warning text-dark"><?= htmlspecialchars($tarefas->status) ?></span>
                                    <?php else : ?>
                                        <span class="badge bg-secondary"><?= htmlspecialchars($tarefas->status) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($tarefas->data_criacao)) ?></td>
                                <td>
                                    <?= $tarefas->data_atualizacao
                                        ? date('d/m/Y H:i', strtotime($tarefas->data_atualizacao))
                                        : '<em>—</em>' ?>
                                </td>
                                <td class="text-center">
                                    <a href="editar_tarefa.php?alterar=<?= $tarefas->id_tarefa ?>"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="tarefa.php?excluir=<?= $tarefas->id_tarefa ?>"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Excluir"
                                        onclick="return confirm('Deseja realmente excluir esta tarefa?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Nenhuma tarefa encontrada.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>


        </div>
        </form>

    </div>

    <script src="../js/script.js"></script>
</body>

</html>