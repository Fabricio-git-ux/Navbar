<?php
session_start(); // obrigatório para acessar o usuário logado

// Inicia a sessão se ainda não estiver iniciada
//PHP_SESSION_NONE é uma constante do PHP usada para verificar o status da sessão.
//Ela indica que: Nenhuma sessão existe no momento.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se usuário está logado (normal ou Google)
if (!isset($_SESSION['id_usuario']) && !isset($_SESSION['usuarios_google'])) {
    header('Location: ../Navbar/error/acesso.php');
    exit();
}

// Instanciar os controllers
require_once 'controller/tarefaController.php';
require_once 'controller/categoriaController.php';

$tarefaController = new tarefaController();
$categoriaController = new categoriaController();


// Metodos de contagem
$totalTarefas = $tarefaController->contarTarefas();
$totalConcluidas = $tarefaController->contarTarefasConcluidas();
$totalPendentes = $tarefaController->contarTarefasPendente();
$totalEmAndamento = $tarefaController->contarTarefasEmAndamento();
/*$totalCategorias = $categoriaController->contarCategorias();*/


// Exemplo de conexão e busca (ajuste conforme seu projeto)
include_once "../controller/tarefaController.php";


include_once "controller/tarefaController.php";

$controller = new tarefaController();

// Buscar tarefas do usuário logado
$listaTarefas = $controller->pesquisarTarefa($_SESSION['id_usuario']);
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style/index.css">
    <title>Conteudo</title>
</head>

<body>
    <nav class="menu-lateral">
        <div class="btn-expandir">
            <i class="bi bi-list" id="btn-exp"></i>
        </div>
        <ul>
            <li class="item-menu ativo">
                <a href="index.php">
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
            <li class="item-menu">
                <a href="pages/pag_usuario.php">
                    <span class="icon"><i class="bi bi-person-circle"></i></span>
                    <span class="txt-link">Conta</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="pages/login.php">
                    <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                    <span class="txt-link">Saída</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="pesquisa">
        <form action="" method="post">
            <div class="searchBox">

                <input class="searchInput" type="text" name="" placeholder="Search something">
                <button class="searchButton" href="#">

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

            <!-- Conteudo do index -->
        </form>
        <div class="conteudo">
            <h1 class="titulo">Total de tarefas feitas</h1>

            <main class="tarefas">
                <div class="card">
                    <div class="content">
                        <div class="front">
                            <h3 class="title">Total de tarefas</h3>
                        </div>

                        <div class="back">
                            <p class="description">
                                tarefas realizadas:
                                <?= $totalTarefas ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div class="front">
                            <h3 class="title">Concluidas</h3>
                        </div>

                        <div class="back">
                            <p class="description">
                                tarefas concluidas:
                                <?= $totalConcluidas ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div class="front">
                            <h3 class="title">Pendentes</h3>
                        </div>

                        <div class="back">
                            <p class="description">
                                tarefas pendentes:
                                <?= $totalPendentes ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div class="front">
                            <h3 class="title" id="titulo">Andamento</h3>
                        </div>

                        <div class="back">
                            <p class="description" id="descricao">
                                Em Andamento:
                                <?= $totalEmAndamento ?>
                            </p>
                        </div>
                    </div>
                </div>

            </main>
        </div>

        <script src="js/script.js"></script>
</body>

</html>