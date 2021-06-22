<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles-global.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/categorias.css">
    <title>iCatalogo</title>
</head>

<body>
    <?php
    if (isset($_SESSION["mensagem"])) {
    ?>
        <div id="mensagens" class="mensagens">
            <?= $_SESSION["mensagem"]; ?>
        </div>
        <script lang="pt-br">
            setTimeout(() => document.getElementById("mensagens").style.display = "none", 4000);
        </script>
    <?php
        unset($_SESSION["mensagem"]);
    }
    ?>
    <header class="header">
        <figure>
            <a href="/produtos">
                <img src="/imgs/logo.png" alt="logo">
            </a>
        </figure>
        <form method="GET" action="/produtos/index.php">
            <input type="text" value="<?= isset($_GET["search"]) ? $_GET["search"] : "" ?>" name="search" id="pesquisar" placeholder="Pesquisar" />
            <button <?= isset($_GET["search"]) && $_GET["search"] != "" ? "onClick='limparFiltro()'" : "" ?>>
                <?php
                if (isset($_GET["search"]) && $_GET["search"] != "") {
                ?>
                    <img style="width: 15px" src="/imgs/cancel.svg" />
                <?php
                } else {
                ?>
                    <img src="/imgs/lupa.svg" />
                <?php
                }
                ?>
            </button>
        </form>
        <?php
        if (!isset($_SESSION["usuarioId"])) {
        ?>
            <nav>
                <ul>
                    <a id="menu-admin">Administrar</a>
                </ul>
            </nav>
            <div id="container-login" class="container-login">
                <h1>Fazer Login</h1>
                <form method="POST" action="/componentes/header/acoesLogin.php">
                    <input type="hidden" name="acao" value="login" />
                    <input type="text" name="usuario" placeholder="Usuário" />
                    <input type="password" name="senha" placeholder="Senha" />
                    <button>Entrar</button>
                </form>
            </div>
        <?php
        } else {
        ?>
            <nav>
                <ul>
                    <a id="menu-admin" onclick="logout();">Sair</a>
                </ul>
            </nav>
            <form id="form-logout" style="display:none" method="POST" action="/componentes/header/acoesLogin.php">
                <input type="hidden" name="acao" value="logout" />
            </form>
        <?php
        }
        ?>
    </header>

    <script lang="javascript">
        document.querySelector("#menu-admin").addEventListener("click", toggleLogin);

        const logout = () => document.getElementById("form-logout").submit();

        function toggleLogin() {
            let containerLogin = document.querySelector("#container-login");
            //se estiver oculto, mostra 
            if (containerLogin.style.opacity == 0) {
                containerLogin.style.opacity = 1;
                containerLogin.style.height = "200px";
                //se não, oculta
            } else {
                containerLogin.style.opacity = 0;
                containerLogin.style.height = "0px";
            }
        }

        const limparFiltro = () => {
            document.querySelector("#pesquisar").value = "";
        }
    </script>

    <div class="content">
        <section class="produtos-container">
            <?php
            //Autorização

            //se o usuário estiver logado, mostrar os botões
            if (isset($_SESSION["usuarioId"])) {
            ?>
                <header>
                    <button onclick="javascript:window.location.href ='./novo/'">Novo Produto</button>
                    <button onclick="javascript:window.location.href ='../categorias'">Adicionar Categoria</button>
                </header>
            <?php
            }
            ?>

            <main>
                <?php require_once "../App/Views/" . $view . ".php"; ?>
            </main>
        </section>
    </div>

    <footer>
        SENAI 2021 - Todos os direitos reservados
    </footer>
</body>

</html>