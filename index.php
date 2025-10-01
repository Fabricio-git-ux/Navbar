<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/main.css">
    <title>NavBar</title>
</head>
<body>
    <div class="sidebar">
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
                    <a href="#">
                        <span class="icon"><i class="bi bi-columns-gap"></i></span>
                        <span class="txt-link">Deshboard</span>
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
            </ul>
        </nav>
    </div>

    <form action="" method="get">
        <div class="conteudo">
            <input type="text" name="search" class="search" placeholder="Pesquisar...">
        </div>
        <div class="pesq">
            <button class="pesquisa"><i class="bi bi-search"></i></button>
        </div>
        <div class="add">
            <button class="adicionar"><i class="bi bi-plus-circle"></i></button>
        </div>
    </form>


    <script src="js/script.js"></script>
</body>
</html>