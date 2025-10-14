<?php
session_start(); // obrigatório para acessar o usuário logado

// Verifica se usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    die("Você precisa estar logado para acessar esta página.");
}

include_once "controller/tarefaController.php";

$controller = new tarefaController();

// Buscar tarefas do usuário logado
$listaTarefas = $controller->pesquisarTarefa($_SESSION['id_usuario']);
?>


<!DOCTYPE html>
<html lang="pt-br">

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
                <a href="#">
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
            <!-- <div class="add_button">
                <button class="add"><i class="bi-plus-circle"></i></button>
            </div> -->
        </form>
        <div class="conteudo">
            <!-- Conteúdo principal da página -->
            <h1>Tarefas</h1>
            <!-- From Uiverse.io by ashwin_5681 -->
            <div
                class="slider"
                style="--width: 200px;
    --height: 200px;
    --quantity: 9;">
                <div class="list">
                    <div class="item" style="--position: 1">
                        <div
                            class="card"
                            style="background: linear-gradient(to right, #ff7e5f, #feb47b)">
                            <p>HELLO THERE</p>
                            <p>Am Ashwin.A</p>
                        </div>
                    </div>
                    <div class="item" style="--position: 2">
                        <div
                            class="card"
                            style="background: linear-gradient(to right, #6a11cb, #2575fc)">
                            <p>Do follow on Insta</p>
                            <p>ashwin_ambar_</p>
                        </div>
                    </div>
                    <div class="item" style="--position: 3">
                        <div
                            class="card"
                            style="background: linear-gradient(to right, #00c6ff, #0072ff)">
                            <p>Replace cards with images</p>
                            <p>for a image slider</p>
                        </div>
                    </div>
                    <div class="item" style="--position: 4">
                        <div
                            class="card"
                            style="background: linear-gradient(to right, #ff512f, #dd2476)">
                            <p>Html css only</p>
                            <p>Hover to stop the slides</p>
                        </div>
                    </div>
                    <div class="item" style="--position: 5">
                        <div
                            class="card"
                            style="background: linear-gradient(to right, #ffb6c1, #ff69b4)">
                            <p>Card 5</p>
                            <p>Content for card 5</p>
                        </div>
                    </div>
                    <div class="item" style="--position: 6">
                        <div
                            class="card"
                            style="background: linear-gradient(to right, #ff9a8b, #ffc3a0)">
                            <p>Card 6</p>
                            <p>Content for card 6</p>
                        </div>
                    </div>
                    <div class="item" style="--position: 7">
                        <div
                            class="card"
                            style="background: linear-gradient(to right, #a1c4fd, #c2e9fb)">
                            <p>Card 7</p>
                            <p>Modify it and use</p>
                        </div>
                    </div>
                    <div class="item" style="--position: 8">
                        <div
                            class="card"
                            style="background: linear-gradient(to right, #fbc2eb, #a18cd1)">
                            <p>Card 8</p>
                            <p>Content for card 8</p>
                        </div>
                    </div>
                    <div class="item" style="--position: 9">
                        <div
                            class="card"
                            style="background: linear-gradient(to right, #84fab0, #8fd3f4)">
                            <p>card 9</p>
                            <p>Content for card 9</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>