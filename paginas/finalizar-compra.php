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

include('../src/script/session_carrinho.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="../src/script/style.css">
    <link rel="stylesheet" href="../src/script/responsivo.css">
    <link rel="shortcut icon" href="../src/favicon/android-chrome-512x512.png" type="image/x-icon">
    <style>
        <?php if (!empty($primeiroNome)): ?>
        nav a.link-menupc {padding: 5vh 19px 4.4vh 19px;}

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
                <a href="pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25pulseira%25" class="link-menupc">Pulseiras</a>
                <a href="colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=Colar%2C+Index" class="link-menupc">Colares</a>
                <a href="brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25brinco%25" class="link-menupc">Brincos</a>
                <a href="conjunto.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25conjunto%25" class="link-menupc">Conjuntos</a>
            </span>


            <!--Menu Mobile-->
            <span class="alterna-botoes">
                <!-- Suporte -->
                <button class="btnmenu-mobile">
                    <ion-icon name="chatbubbles-outline" class="iconsuporte" color="light"></ion-icon>
                    <div class="listamenu btnsuporte">
                        <a href="https://www.instagram.com/bellaacessoriosreal/profilecard/" target="_blank" class="link-listamenu"><ion-icon name="logo-instagram"></ion-icon> @bellaacessoriosreal</a>
                        
                    </div>
                </button>
                
                <!-- Conta -->
                <button class="btnmenu-mobile">
                    <ion-icon name="person-circle-outline" class="iconconta" color="light"></ion-icon>
                    <div class="listamenu btnconta">
                        <?php if (!empty($primeiroNome)) : ?>
                        <!-- Logado -->
                        <a href="minha-conta.php" class="link-listamenu">Minha Conta</a>
                        <a href="historico.php" class="link-listamenu">Histórico</a>
                        <a href="../src/script/destroy_session.php" class="link-listamenu">Encessar Sessão</a>
                        <?php else: ?>
                        <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <?php endif; ?>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-pc">
                    <ion-icon name="bag-handle-outline" class="iconbtn"></ion-icon><br>Sacola
                    <div class="listamenu">
                        <a href="#" class="link-listamenu mostrarsacola">Ver Sacola</a>
                        <?php if (!isset($_SESSION['id_usuario'])): ?>
                        <a href="login.php" class="link-listamenu">Checkout</a>
                        <?php else: ?>
                        <a href="checkout.php" class="link-listamenu">Checkout</a>
                        <?php endif; ?>
                    </div>
                </button>
            </span>

            <!--Menu PC-->
            <span id="botoes-pc">
                <!-- Suporte -->
                <button class="btnmenu-pc">
                    <ion-icon name="chatbubbles-outline" class="iconbtn"></ion-icon><br>Suporte
                    <div class="listamenu">
                        <a href="https://www.instagram.com/bellaacessoriosreal/profilecard/" target="_blank" class="link-listamenu"><ion-icon name="logo-instagram"></ion-icon> @bellaacessoriosreal</a>
                        
                    </div>
                </button>
                
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

                    <div class="listamenu">
                        <?php if (!empty($primeiroNome)): ?>
                            <!-- Itens do menu para usuários logados -->
                            <a href="minha-conta.php" class="link-listamenu">Minha Conta</a>
                            <a href="historico.php" class="link-listamenu">Histórico</a>
                            <a href="../src/script/destroy_session.php" class="link-listamenu">Encerrar Sessão</a>
                        <?php else: ?>
                            <!-- Itens do menu para usuários não logados -->
                            <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                            <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <?php endif; ?>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-pc">
                    <ion-icon name="bag-handle-outline" class="iconbtn"></ion-icon><br>Sacola
                    <div class="listamenu">
                        <a href="#" class="link-listamenu mostrarsacola">Ver Sacola</a>
                        <?php if (!isset($_SESSION['id_usuario'])): ?>
                        <a href="login.php" class="link-listamenu">Checkout</a>
                        <?php else: ?>
                        <a href="checkout.php" class="link-listamenu">Checkout</a>
                        <?php endif; ?>
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
            if (!isset($_SESSION['id_usuario'])) {
               echo "<div>
                    <ion-icon name='person-circle-outline'></ion-icon>
                    <p>É necessário fazer login para acessar sua sacola!</p> <br>
                    <a style='color: var(--cor4);' href='login.php'>Entrar em sua Conta</a> <br><br>
                    <a id='fecharcarrinho'>Voltar</a>
               </div>";
            } else {
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
                        <a href='checkout.php'><button>Finalizar Compra</button></a>
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
            }
        ?>
    </aside>

    <!-- FINALIZAR COMPRA -->
    <div id="checkout" style="margin: 18vh 0 10vh 0;">
        <form action="../src/script/processar_pedido.php" method="post">
            <div class="itens-checkout">
                <h1 style="margin-bottom: 20px;"><ion-icon name="bag-check-outline"></ion-icon> Finalizar Compra</h1>
                <!-- Lista de Itens -->
                <div class="containers-finalizar-compra">
                    <h2>Lista de Itens</h2>
                    <?php
                        $subtotal = 0;
                        $frete = 0;
                        $preco_final = 0;
                            foreach ($_SESSION['carrinho'] as $id_produto => $item) {
                                // Calcula o preço total
                                $subtotal += $item['preco'] * $item['quantidade'];
                                $frete = $subtotal * 0.25; // O frete é calculado pegando 25% do valor
            
                                echo "
                                    <div class='prod-checkout'>
                                        <img src='{$item['imagem']}' alt='{$item['nome']}'>
                                        <div class='txt-prod-checkout nome-checkout'>
                                            <p>{$item['nome']}</p>
                                            <p><strong>Cor: </strong>{$item['cor']}</p>
                                        </div>
                                        <div class='txt-prod-checkout'>
                                            <p class='preco-prod-checkout'>R&#36;" . number_format($item['preco'], 2, '.', ',') . "</p>
                                        </div>
                                        <div class='txt-prod-checkout'>
                                            <p>Quantidade: {$item['quantidade']}</p>
                                        </div>
                                        <a href='?action=delete&id={$item['id']}&cor={$item['cor']}'>
                                            <ion-icon name='trash-outline' style='color: var(--cor3); font-size: 1.5em;'></ion-icon>
                                        </a>
                                    </div>";
                            }
                        $preco_final = $subtotal + $frete;
                    ?>

                    <!-- Inputs dos valores de pedido e produto -->
                    <input type="hidden" name="subtotal" value="<?echo $subtotal; ?>">
                    <input type="hidden" name="frete" value="<?php echo $frete; ?>">
                    <input type="hidden" name="valor-pedido" value="<?php echo $preco_final; ?>">

                </div>
                <!-- Dados para Entrega -->
                <div class="containers-finalizar-compra">
                    <h2>Dados para Entrega</h2>
                    <span>
                        <label for="cep">CEP: </label>
                        <input type="text" name="cep" id="cep" style="width: 120px" placeholder="CEP*" maxlength="9" onblur="buscarCEP(this.value)" required>
                        <label for="rua">Rua: </label>
                        <input type="text" name="rua" id="rua" placeholder="Rua*" required>
                    </span>
                    <span>
                        <label for="bairro">Bairro: </label>
                        <input type="text" name="bairro" id="bairro" style="width: 200px;" placeholder="Bairro*" required>
                        <label for="cidade">Cidade: </label>
                        <input type="text" name="cidade" id="cidade" placeholder="Cidade*" style="width: 200px;" required>
                        <label for="estado">Estado: </label>
                        <select name="uf" id="uf" required>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
                    </span>
                    <span>
                        <label for="num">Número: </label>
                        <input type="text" name="num" id="num" style="width: 100px" placeholder="Número*" required>
                        <label for="complemento">Complemento: </label>
                        <input type="text" name="complemento" id="complemento" placeholder="Complemento">
                    </span>
                </div>
                <!-- Método de Pagamento -->
                <div class="containers-finalizar-compra">
                    <h2>Método de Pagamento</h2>
                    <select name="pagamento" id="pagamento" onchange="metodoPagamento()">
                        <option value="">A escolher</option>
                        <option value="PIX">PIX</option>
                        <option value="CARTÃO">Cartão de Crédito</option>
                        <option value="BOLETO">Boleto</option>
                    </select>
                    <div id="pix" style="margin: 10px; display: none;">
                        <p>&#x1F537 Ao gerar o Código Pix do pedido você pode pagar escaneando o <strong>QR Code</strong> ou <strong>Copiar e Colar</strong>.</p>
                    </div>
                    <div id="info_cartao" style="display: none;">
                        <span>
                            <label>Número do Cartão:</label>
                            <input type="text" name="numero-cartao" maxlength="16" style="width: 70%;"> <br>
                        </span>
                        <span>
                            <label>Nome no Cartão:</label>
                            <input type="text" name="nome-cartao" style="width: 70%;"> <br>
                        </span>
                        <span>
                            <label>MM/AA:</label>
                            <input type="text" name="validade-cartao" maxlength="5" style="width: 20%;"> <br>
                            <label>CVV:</label>
                            <input type="text" name="cvv" maxlength="3" style="width: 20%;">
                        </span>
                    </div>
                    <div id="boleto" style="margin: 10px; display: none;">
                        <p><ion-icon name="barcode-outline"></ion-icon> Ao gerar o Boleto você pode pagar escaneando o <strong>código de barras</strong> ou <strong>Copiar e Colar</strong>.</p>
                    </div>
                </div>
            </div>
            <div class="preco-checkout preco-checkout-fixo">
            <h1>Resumo da Compra</h1>
                <?php
                    // Subtotal e Frete
                    echo "
                        <span class='info-preco-checkout'>
                            <h2>Subtotal:</h2>
                            <p><strong>R&#36;" . number_format($subtotal, 2, '.', ',') . "</strong></p>
                        </span>
                        <span class='info-preco-checkout'>
                            <h2>Frete:</h2>
                            <p><strong>R&#36;" . number_format($frete, 2, '.', ',') . "</strong></p>
                        </span>
                    ";
                    // Valor Final
                    echo "
                    <span class='info-preco-checkout' style='border-bottom: 2px solid var(--cor3);'>
                        <h2 style='color: bvar(--cor2); font-size: 1.6em;'>Total:</h2>
                        <p style='color: var(--cor2);'><strong>R&#36;" . number_format($preco_final, 2, '.', ',') . "</strong></p>
                    </span>";
                ?>
                <input type="submit" value="Confirmar Pedido" class="finalizar-checkout">
                <a href="pesquisa.php?min=&max=&preco-ordem=&material=&tamanho=&categoria="><button class="continuar-checkout">Continuar Comprando</button></a>
            </div>
        </form>
    </div>

    <!-- RODAPÉ -->
    <footer id="rodape">
        <!-- Categorias -->
       <span>
            <h1>Categorias</h1>
            <ul>
                <li><a href="pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=pulseira">Pulseiras</a></li>
                <li><a href="colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=Colar%2C+Index">Colares</a></li>
                <li><a href="brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=brinco">Brincos</a></li>
                <li class="ultimo"><a href="conjunto.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=conjunto">Conjuntos</a></li>
            </ul>
        </span>

        <!-- Minha Conta -->
        <span>
            <h1>Conta</h1>
            <ul>
                <?php if(!isset($_SESSION['id_usuario'])): ?>
                <li><a href="login.php">Iniciar Sessão</a></li>
                <li class="ultimo"><a href="cadastro.php">Criar Conta</a></li>
                <?php else: ?>
                <li><a href="minha-conta.php">Minha Conta</a></li>
                <li><a href="#">Histórico</a></li>
                <li class="ultimo"><a href="../src/script/destroy_session.php">Encerrar Sessão</a></li>
                <?php endif; ?>
            </ul>
        </span>

        <!-- Contato -->
        <span>
            <h1>Entre em Contato</h1>
            <ul>
                <li class="ultimo"><a href="https://www.instagram.com/bellaacessoriosreal/profilecard/" target="_blank"><ion-icon style="font-size: 1.25em;" name="logo-instagram"></ion-icon> @bellaacessoriosreal</a></li>
            </ul>
        </span>

        <!-- Brands -->
        <span>
            <a href="https://github.com/Ayanami016/TCC" target="_blank"><ion-icon name="logo-github"></ion-icon></a>
            <a href="https://www.instagram.com/bellaacessoriosreal/profilecard/" target="_blank"><ion-icon name="logo-instagram"></ion-icon></a>
        </span>
    </footer>

    <!--JAVASCRIPT-->
    <script src="../src/script/javascript.js" type="text/javascript"></script>
        <!-- Ícones -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
         
</body>
</html>