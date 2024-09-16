<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../src/script/style.css">
    <link rel="stylesheet" href="../src/script/responsivo.css">
    <link rel="shortcut icon" href="../src/favicon/android-chrome-512x512.png" type="image/x-icon">
</head>
<body>
    <!--MENU-->
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
                <a href="pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25pulseira%25" class="link-menupc">Pulseiras</a>
                <a href="colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=Colar%2C+Index" class="link-menupc">Colares</a>
                <a href="brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25brinco%25" class="link-menupc">Brincos</a>
                <a href="conjunto.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25conjunto%25" class="link-menupc">Conjuntos</a>
            </span>


            <!--Menu Mobile-->
            <span class="alterna-botoes">
                <!-- Conta -->
                <button class="btnmenu-mobile">
                    <ion-icon name="person-circle-outline" class="iconconta" color="light"></ion-icon>
                    <div class="listamenu">
                        <?php if (!empty($primeiroNome)) : ?>
                        <!-- Logado -->
                        <a href="minha-conta.php" class="link-listamenu">Minha Conta</a>
                        <a href="#" class="link-listamenu">Histórico</a>
                        <a href="../src/script/destroy_session.php" class="link-listamenu">Encessar Sessão</a>
                        <?php else: ?>
                        <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <?php endif; ?>
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
                    <ion-icon name="bag-handle-outline" class="iconsacola" color="light"></ion-icon>
                    <div class="listamenu">
<a href="#" class="link-listamenu mostrarsacola">Ver Sacola</a>
                        <a href="#" class="link-listamenu">Checkout</a>
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
                    <ion-icon name="bag-handle-outline" class="iconbtn"></ion-icon><br>Sacola
                    <div class="listamenu btncarrinho">
<a href="#" class="link-listamenu mostrarsacola">Ver Sacola</a>
                        <a href="#" class="link-listamenu">Checkout</a>
                    </div>
                </button>
            </span>
        </nav>
    </header>

    <span class="menu-pesquisa-mobile">
        <form action="pesquisa.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=" method="post">
            <input type="search" name="pesquisa" id="pesquisa" placeholder="Buscar">
        </form>
    </span>
        <span class="menu-pc-mobile">
        <a href="pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25pulseira%25">Pulseiras</a>
        <a href="colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=Colar%2C+Index">Colares</a>
        <a href="brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25brinco%25">Brincos</a>
        <a href="conjunto.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25onjunto%25">Conjuntos</a>
    </span>

    <!-- BARRA LATERAL - SACOLA -->
    <aside id="carrinho" style="display: none;">
        <?php
            if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
                $preco_total = 0;
                echo "<div>"; // Para conter todos os produtos para o space-around do #carrinho aplicar corretamente
                foreach ($_SESSION['carrinho'] as $id_produto => $item) {
                    // Calcula o preço total
                    $subtotal = $item['preco'] * $item['quantidade'];
                    $preco_total += $subtotal;

                    echo "
                    <div class='prod-carrinho'>
                        <a href='?action=delete&id={$item['id']}&cor={$item['cor']}'>
                            <ion-icon name='close-outline' style='color: var(--cor3); font-size: 1.5em;'></ion-icon>
                        </a>
                        <img src='{$item['imagem']}' alt='{$item['nome']}'>
                        <div class='txt-prod-carrinho'>
                            <p>{$item['nome']}</p>
                            <p class='preco-prod-carrinho'>R&#36;{$item['preco']}.00</p>
                            <p>{$item['cor']}</p>
                            <p>Quantidade: {$item['quantidade']}</p>
                        </div>
                    </div>";
                }
                // Preço Total
                echo "<h1 style='margin-top: 5px; font-size: 2em; color: var(--cor2);'>Total: R$" . number_format($preco_total, 2, '.', '.') . "</h1>";
                echo "</div>";
                echo "
                <div>
                    <a id='fecharcarrinho'>Voltar</a> <br>
                    <a href='checkout.php'><button>Ir para o checkout</button></a>
                </div>";
            } else {
                echo " 
                <div>
                    <ion-icon name='bag-handle-outline'></ion-icon>
                        <h1>Sua sacola está vazia!</h1> <br>
                        <p>Escolha algum produto e adicione à sacola para realizar sua compra!</p> <br>
                        <a id='fecharcarrinho'>Voltar</a>
                </div>";
            }
        ?>
    </aside>

    <!--CADASTRO-->
    <!--Nome, email, cpf, telefone e senha-->
    <div id="caixa" class="cadastro">
        <div class="form-box">
            <h1>&#x1F48E Crie sua conta!</h1>
            <form action="../src/script/script_cad.php" method="post" id="form-cad">
                <!--Nome-->
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                    </span>
                    <input type="text" name="nome" id="nome" required>
                    <label for="nome">Nome</label>
                </div>

                <!--Email-->
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-outline"></ion-icon>
                    </span>
                    <input type="email" name="email" id="email" required>
                    <label for="email">Email</label>
                </div>

                <!--CPF-->
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="terminal-outline"></ion-icon>
                    </span>
                    <input type="text" name="cpf" id="cpf" class="cpf" maxlength="14" required>
                    <label for="cpf">CPF</label>
                </div>

                <!--Telefone-->
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="call-outline"></ion-icon>
                    </span>
                    <input type="text" name="tel" id="tel" class="tel" maxlength="14" required>
                    <label for="tel">Telefone</label>
                </div>

                <!--Senha-->
                <div class="input-box">
                    <span class="icon-relevarsenha" onclick="Mostrar_Senha()">
                        <ion-icon name="eye-off-outline" id="iconsenha" onclick="Mudar_IconSenha()"></ion-icon>
                    </span>
                    <input type="password" name="senha" id="senha" required>
                    <label for="senha">Senha</label>
                </div>

                <!--Confirmar Senha-->
                <div class="input-box">
                    <span class="icon-relevarsenha" onclick="Mostrar_ConfirmarSenha()">
                        <ion-icon name="eye-off-outline" id="iconconfirmarsenha" onclick="Mudar_IconConfirmarSenha()"></ion-icon>
                    </span>
                    <input type="password" name="confirmarsenha" id="confirmarsenha" required>
                    <label for="confirmarsenha">Confirmar Senha</label>
                </div>

                <!--Cadastrar-->
                <input type="submit" class="btn-form" value="CADASTRAR" onclick="clickNome(),clickCpf(),clickTell(),clickSenha(),confirmacao()"></input>
                <div class="cad-login">
                    <p>Já possui uma conta? <a href="login.php">Entre aqui!</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Escuro -->
    <div id="escuro" style="display: none;"></div>

    <!--JAVASCRIPT-->
    <script src="../src/script/javascript.js" type="text/javascript"></script>
        <!-- Ícones -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>