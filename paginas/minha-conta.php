<?php

// Verifica se usuário está logado
session_start();
if (isset($_SESSION['nome_exibir'])) {
    // Divida o nome completo em partes
    $nomeCompleto = $_SESSION['nome_exibir'];
    $partesNome = explode(' ', $nomeCompleto);
    $primeiroNome = $partesNome[0];
} else {
    $primeiroNome = '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
    <link rel="stylesheet" href="../src/script/style.css">
    <link rel="stylesheet" href="../src/script/responsivo.css">
    <link rel="shortcut icon" href="../src/favicon/android-chrome-512x512.png" type="image/x-icon">
    <style>
        <?php if (!empty($primeiroNome)): ?>
        nav a.link-menupc {padding: 5vh 19px 4.8vh 19px;}

        nav .ajusteconta {width: 105px;}
        <?php endif; ?>
    </style>
</head>
<body>
    <!-- MENU -->
    <header>
        <span>
            <a href="index.php"><img src="../src/img/Bella Logo com Fundo.png" alt="Logo" class="logo"></a>
        </span>

        <form action="pesquisa.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=" method="post">
            <input type="search" name="pesquisa" id="pesquisa" class="menu-pesquisa" placeholder="Buscar">
        </form>

        <nav>
            <!--Menu Mobile-->
            <span class="alterna-menu" id="menu-mobile">
                <ion-icon name="menu" class="iconmenu" color="light"></ion-icon>
            </span>

            <!--Menu PC-->
            <span id="menu-pc">
                <a href="pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=pulseira" class="link-menupc">Pulseiras</a>
                <a href="anel.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=anel" class="link-menupc">Anéis</a>
                <a href="colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=colar" class="link-menupc">Colares</a>
                <a href="brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=brinco" class="link-menupc">Brincos</a>
            </span>

            <!--Menu Mobile-->
            <span class="alterna-botoes">
                <!-- Conta -->
                <button class="btnmenu-mobile">
                    <ion-icon name="person-circle-outline" class="iconconta" color="light"></ion-icon>
                    <div class="listamenu">
                        <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <a href="minha-conta.php" class="link-listamenu">Minha Conta</a>
                    </div>
                </button>

                <!-- Suporte -->
                <button class="btnmenu-mobile">
                    <ion-icon name="chatbubbles-outline" class="iconsuporte" color="light"></ion-icon>
                    <div class="listamenu">
                        <a href="#" class="link-listamenu">Contato</a>
                        <a href="faq.html" class="link-listamenu">FAQ</a>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-mobile">
                    <ion-icon name="cart-outline" class="iconcarrinho" color="light"></ion-icon>
                    <div class="listamenu">
                        <a href="#" class="link-listamenu mostrarcarrinho">Ver Carrinho</a>
                        <a href="#" class="link-listamenu">Checkout</a>
                        <a href="#" class="link-listamenu">Histórico</a>
                    </div>
                </button>
            </span>

            <!--Menu PC-->
            <span id="botoes-pc">
                <!-- Conta -->
                <button class="btnmenu-pc ajusteconta">
                    <ion-icon name="person-outline" class="iconbtn"></ion-icon><br>
                    <?php if (!empty($primeiroNome)): ?>
                        <!-- Se logado, exibe o primeiro nome do usuário -->
                        Olá, <?php echo htmlspecialchars($primeiroNome); ?>!
                    <?php else: ?>
                        <!-- Se não estiver logado, exibe "Conta" -->
                        Conta
                    <?php endif; ?>

                    <div class="listamenu btnconta">
                        <?php if (!empty($primeiroNome)): ?>
                            <!-- Itens do menu para usuários logados -->
                            <a href="minha-conta.php" class="link-listamenu">Minha Conta</a>
                            <a href="#" class="link-listamenu">Histórico</a>
                            <a href="../src/script/destroy_session.php" class="link-listamenu">Encerrar Sessão</a>
                        <?php else: ?>
                            <!-- Itens do menu para usuários não logados -->
                            <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                            <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <?php endif; ?>
                    </div>
                </button>

                <!-- Suporte -->
                <button class="btnmenu-pc">
                    <ion-icon name="chatbubbles-outline" class="iconbtn"></ion-icon><br>Suporte
                    <div class="listamenu btnsuporte">
                        <a href="#" class="link-listamenu">Contato</a>
                        <a href="#" class="link-listamenu">FAQ</a>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-pc">
                    <ion-icon name="cart-outline" class="iconbtn"></ion-icon><br>Carrinho
                    <div class="listamenu btncarrinho">
                        <a href="#" class="link-listamenu mostrarcarrinho">Ver Carrinho</a>
                        <a href="#" class="link-listamenu">Checkout</a>
                        <a href="#" class="link-listamenu">Histórico</a>
                    </div>
                </button>
            </span>
        </nav>
    </header>

    <span class="menu-pesquisa-mobile">
        <input type="search" name="pesquisa" id="pesquisa" placeholder="Buscar">
    </span>
        <span class="menu-pc-mobile">
        <a href="pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=pulseira">Pulseiras</a>
        <a href="anel.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=anel">Anéis</a>
        <a href="colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=colar">Colares</a>
        <a href="brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=brinco">Brincos</a>
    </span>

    <!-- BARRA LATERAL - HISTÓRICO -->
    <aside id="carrinho" style="display: none;">
        <ion-icon name="cart-outline"></ion-icon>
        <h1>Seu carrinho está vazio!</h1> <br>
        <p>Escolha algum produto e adicione ao carrinho para realizar sua compra!</p> <br>
        <a id="fecharcarrinho">Voltar</a>
    </aside>

    <!-- MINHA CONTA -->
    <article id="minha-conta">
        <h1>Minha Conta</h1>
        <!-- Minha Conta -->
        <div class="caixa-minha-conta">
            <h2>Dados Pessoais</h2>
            <div class="conteudo-minhaconta">
                <strong style="font-size: 1.3em;"><?php echo $_SESSION['nome_exibir']; ?></strong>
                <p><?php echo $_SESSION['email_exibir']; ?></p>
                <p><?php echo $_SESSION['tell_exibir']; ?></p>
                <a href="#"><button class="btn-minhaconta" btn-placeholder="Editar Dados"></button></a>
            </div>
        </div>
        <!-- Realizar Compra -->
        <div class="caixa-compra">
            <ion-icon name="cart-outline"></ion-icon>
            <p>Realize a sua primeira compra!</p>
            <a href="index.php"><button class="btn-index" btn-placeholder="Ir para Loja"></button></a>
        </div>
    </article>

    <!-- Escuro -->
    <div id="escuro" style="display: none;"></div>

    <!-- RODAPÉ -->
     <footer id="rodape">
        <!-- Categorias -->
       <span>
            <h1>Categorias</h1>
            <ul>
                <li><a href="#">Pulseiras</a></li>
                <li><a href="#">Anéis</a></li>
                <li><a href="#">Colares</a></li>
                <li class="ultimo"><a href="#">Brincos</a></li>
            </ul>
        </span>

        <!-- Minha Conta -->
        <span>
            <h1>Conta</h1>
            <ul>
                <li><a href="login.php">Iniciar Sessão</a></li>
                <li class="ultimo"><a href="cadastro.php">Criar Conta</a></li>
            </ul>
        </span>

        <!-- Contato -->
        <span>
            <h1>Entre em Contato</h1>
            <ul>
                <li><a href="#">Número de Telefone</a></li>
                <li class="ultimo"><a href="#">E-mail</a></li>
            </ul>
        </span>

        <!-- Brands -->
        <span>
            <a href="https://github.com/Ayanami016/TCC" target="_blank"><i class="fab fa-github fa-lg"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
        </span>
     </footer>

    <!--JAVASCRIPT-->
    <script src="../src/script/javascript.js" type="text/javascript"></script>
        <!--Ícones-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <!-- Font Awesome - usado para o rodapé -->
    <script src="https://kit.fontawesome.com/750ae9b6a4.js" crossorigin="anonymous"></script>
</body>
</html>