<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<!DOCTYPE html>
    <link rel="stylesheet" href="../src/script/style.css">
    <link rel="stylesheet" href="../src/script/responsivo.css">
    <link rel="shortcut icon" href="../src/favicon/android-chrome-512x512.png" type="image/x-icon">
</head>
<body>
    <!--MENU-->
    <header>
        <span>
            <a href="index.html"><img src="../src/img/Bella Logo com Fundo.png" alt="Logo" class="logo"></a>
        </span>

        <form action="pesquisa.php" method="post">
            <input type="search" name="pesquisa" id="pesquisa" class="menu-pesquisa" placeholder="Buscar">
        </form>

        <nav>
            <!--Menu Mobile-->
            <span class="alterna-menu" id="menu-mobile">
                <ion-icon name="menu" class="iconmenu" color="light"></ion-icon>
            </span>

            <!--Menu PC-->
            <span id="menu-pc">
                <a href="#" class="link-menupc">Pulseiras</a>
                <a href="#" class="link-menupc">Anéis</a>
                <a href="#" class="link-menupc">Colares</a>
                <a href="#" class="link-menupc">Brincos</a>
            </span>

            <!--Menu Mobile-->
            <span class="alterna-botoes">
                <!-- Conta -->
                <button class="btnmenu-mobile">
                    <ion-icon name="person-circle-outline" class="iconconta" color="light"></ion-icon>
                    <div class="listamenu">
                        <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <a href="minha-conta.html" class="link-listamenu">Minha Conta</a>
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
                <button class="btnmenu-pc">
                    <ion-icon name="person-outline" class="iconbtn"></ion-icon><br>Conta
                    <div class="listamenu btnconta">
                        <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <a href="minha-conta.html" class="link-listamenu">Minha Conta</a>
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
        <a href="#">Pulseiras</a>
        <a href="#">Anéis</a>
        <a href="#">Colares</a>
        <a href="#">Brincos</a>
    </span>

    <!-- BARRA LATERAL - HISTÓRICO -->
    <aside id="carrinho" style="display: none;">
        <ion-icon name="cart-outline"></ion-icon>
        <h1>Seu carrinho está vazio!</h1> <br>
        <p>Escolha algum produto e adicione ao carrinho para realizar sua compra!</p> <br>
        <a id="fecharcarrinho">Voltar</a>
    </aside>

    <!--LOGIN-->
    <div id="caixa" class="login">
        <div class="form-box">
            <h1>&#x1F44B Iniciar Sessão</h1>
            <form action="#">
                <!--Email-->
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-outline"></ion-icon>
                    </span>
                    <input type="email" name="email" id="email" required>
                    <label for="email">Email</label>
                </div>
                <!--Senha-->
                <div class="input-box">
                    <span class="icon-relevarsenha" onclick="Mostrar_Senha()">
                        <ion-icon name="eye-off-outline" id="iconsenha" onclick="Mudar_IconSenha()"></ion-icon>
                    </span>
                    <input type="password" name="senha" id="senha" required>
                    <label for="senha">Senha</label>
                </div>
                <!--Esqueceu a Senha-->
                <div class="remember-forgot">
                    <a href="#">Esqueceu a Senha?</a>
                </div>
                <!--Iniciar Sessão-->
                <input type="submit" class="btn-form" value="INICIAR SESSÃO"></input>
                <div class="cad-login">
                    <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Escuro -->
    <div id="escuro" style="display: none;"></div>

    <!--JAVASCRIPT-->
    <script src="../src/script/javascript.js" type="text/javascript"></script>
        <!--Ícones-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>