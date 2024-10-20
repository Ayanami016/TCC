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

// Inicializa a sessão carrinho
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

// Verifica se um produto foi adicionado
if (isset($_GET['id']) && isset($_GET['nome_img']) && isset($_GET['nome_prod']) && isset($_GET['preco']) && isset($_GET['cor_prod'])) {
    $id_produto = (int) $_GET['id'];
    $nome_img = $_GET['nome_img'];
    $nome_prod = $_GET['nome_prod'];
    $preco = (float) $_GET['preco'];
    $cor_prod = $_GET['cor_prod'];

    // Verifica se o produto com a mesma cor já está no carrinho
    $produtoExiste = false;
    foreach ($_SESSION['carrinho'] as $key => $produto) {
        if ($produto['id'] == $id_produto && $produto['cor'] == $cor_prod) {
            $_SESSION['carrinho'][$key]['quantidade']++;
            $produtoExiste = true;
            break;
        }
    }

    // Se não estiver, adiciona!
    if (!$produtoExiste) {
        $_SESSION['carrinho'][] = array(
            'id' => $id_produto,
            'imagem' => $nome_img,
            'nome' => $nome_prod,
            'cor' => $cor_prod,
            'preco' => $preco,
            'quantidade' => 1
        );
    }

    // Evita o reenvio do formulário afim de evitar quantidade++ (1 => 3)
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Deletando o produto do carrinho
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id_produto = (int)$_GET['id'];
    $cor_prod = $_GET['cor'];

    // Procura o produto no carrinho e o remove
    foreach ($_SESSION['carrinho'] as $key => $produto) {
        if ($produto['id'] == $id_produto && $produto['cor'] == $cor_prod) {
            unset($_SESSION['carrinho'][$key]);
            // Reindexa o array para evitar buracos
            $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
            break;
        }
    }

    // Redireciona para a mesma página para evitar reenvio de formulários
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colares</title>
    <link rel="stylesheet" href="../src/script/style.css">
    <link rel="stylesheet" href="../src/script/responsivo.css">
    <link rel="shortcut icon" href="../src/favicon/android-chrome-512x512.png" type="image/x-icon">
</head>
<body>
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
                        <a href="#" class="link-listamenu">Histórico</a>
                        <a href="../src/script/destroy_session.php" class="link-listamenu">Encessar Sessão</a>
                        <?php else: ?>
                        <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <?php endif; ?>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-mobile">
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
                    <div class="listamenu btnsuporte">
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

    <!-- Link âncora para voltar ao topo da página -->
    <a name="topo"></a>

    <article id="catalogo">
        <!-- Imagens (por enquanto placeholders, eles são originais do index) -->
        <picture>
            <source media="(min-width: 1063px)" srcset="../src/img/catalogo-pc.jpeg">
            <source media="(min-width: 530px)" srcset="../src/img/catalogo-tablet.jpeg">
            <source media="(min-width: 0px)" srcset="../src/img/catalogo-mobile.jpeg">
            <img src="../src/img/ph-catalogo-pc.jpg" alt="Imagem de Catálogo">
        </picture>
    </article>
<?php
    include("../src/script/conexao.php");

    if ($conexao->connect_error) {
        die("Há uma falha no banco de dados!" . $conexao->connect_error);
    }

    // Pesquisa - Menu method post
    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';

    // Filtro method get
    $preco_ordem = $_GET['preco-ordem'];
    $precomin = $_GET['min'];
    $precomax = $_GET['max'];
    $mat = $_GET['material'];
    $tam = $_GET['tamanho'];
    $cat = $_GET['categoria'];
    // Adendo: cor não entra em filtro, apenas na pesquisa!

    //      ___
    //  _.-|   |          |\__/,|   (`\
    // {   |   |          |o o  |__ _) )
    //  "-.|___|        _.( T   )  `  /
    //   .--'-`-.     _((_ `^--' /_<  \
    // .+|______|__.-||__)`-'(((/  (((/ MIAU MIAU MIAU

    // Consulta inicial básica para o condicional funcionar
    $result_pesquisa = "select * from produto where 1=1";

    // Condicionais do filtro
        // Preço Min e Máx - Campos de Texto
    if (!empty($precomin)) {$result_pesquisa .= " and preco >= $precomin";}
    if (!empty($precomax)) {$result_pesquisa .= " and preco <= $precomax";}

    // Adição da pesquisa
    $result_pesquisa .= " and (
        descricao_prod like '%$pesquisa%' or
        nome_prod like '%$pesquisa%' or
        tipo_prod like '%$pesquisa%' or
        cor_prod like '%$pesquisa%' or
        material_prod like '%$pesquisa%' or
        tamanho_prod like '%$pesquisa%'
    )";
       
        // Material, Tamanho e Categoria
    if (!empty($mat)) {$result_pesquisa .= " and material_prod like '$mat'";}
    if (!empty($tam)) {$result_pesquisa .= " and tamanho_prod like '$tam'";}
    if (!empty($cat)) {$result_pesquisa .= " and tipo_prod like '$cat'";}

        // Preço Ordenado
    if (!empty($preco_ordem)) {
        if ($preco_ordem == 'asc') {
            $result_pesquisa .= " order by preco asc";
        } elseif ($preco_ordem == 'desc') {
            $result_pesquisa .= " order by preco desc";
        }
    }

    // Resultado Final
    $resultados = mysqli_query($conexao, $result_pesquisa);

    // Contagem de Resultados para exibição
    $quantia_results = mysqli_num_rows($resultados);

    echo "<div id='container-produtos' style='margin-top: 0;'>";
    // pesquisa maior que 0
    if ($pesquisa != '' && mysqli_num_rows($resultados) > 0) {
        echo "<h1>EXIBINDO RESULTADOS PARA &#34;" . strtoupper(htmlspecialchars($pesquisa)) . "&#34;</h1>";
        echo "<p>Resultado: " . $quantia_results . " produto(s)</p>";
    // pesquisa igual a 0
    } else if ($pesquisa != '' && mysqli_num_rows($resultados) == 0) {
        echo "<h1>NENHUM RESULTADO ENCONTRADO PARA &#34;" . strtoupper(htmlspecialchars($pesquisa)) . "&#34;</h1>";
    // pesquisa relacionada ao filtro, pois não terá termo definido na $pesquisa
    } else {
        if (mysqli_num_rows($resultados) == 0) {
            echo "<h1>NENHUM RESULTADO ENCONTRADO :( </h1>";
        } else {
            echo "<h1>EXIBINDO RESULTADOS</h1>";
            echo "<p>Resultado: " . $quantia_results . " produto(s)</p>";
        }
    }

    //FILTRO MOBILE
    echo "<span id='filtro-mobile' class='ajuste-filtro-mobile'><ion-icon name='options-outline'></ion-icon></span>";
    echo 
    "<div id='aba-filtro-mobile' class='ajustar-aba-filtro'>    
        <form action='pesquisa.php' method='get' name='pesquisa-filtro' id='pesquisa-filtro'>
        
        <!-- PREÇO -->
        <h1>Preço</h1>
            <span class='filtrar-preco'>
                <input type='text' class='txt-preco' name='min' id='min' placeholder='Min.'>
                <input type='text' class='txt-preco' name='max' id='max' placeholder='Máx.'>
            </span>
            <br>

        <label for='preco'>Ordenar por:</label>
        <select name='preco-ordem' id='preco-ordem'>
            <option value=''>A escolher</option>
            <option value='desc'>Maiores preços</option>
            <option value='asc'>Menores preços</option>
        </select>

        <!-- MATERIAL -->
        <h1>Material</h1>
        <select name='material' id='material'>
            <option value=''>A escolher</option>
            <option value='%Prata%'>Prata</option>
            <option value='%Joia%'>Pedras</option>
            <option value='%Aço Inoxidável%'>Aço inoxidável</option>
        </select>

        <!-- TAMANHO -->
        <h1>Tamanho</h1>
        <select name='tamanho' id='tamanho'>
            <option value=''>A escolher</option>
            <option value='pequeno'>Pequeno</option>
            <option value='médio'>Médio</option>
            <option value='grande'>Grande</option>
            <option value='ajustavel'>Ajustável</option>
        </select>

        <!-- TIPO - CATEGORIA -->
        <h1>Categoria</h1>
        <select name='categoria' id='categoria'>
            <option value=''>A escolher</option>
            <option value='%pulseira%'>Pulseiras</option>
            <option value='%colar%'>Colares</option>
            <option value='%brinco%'>Brincos</option>
            <option value='%conjunto%'>Conjuntos</option>
        </select>

        <!-- BOTÃO FILTRAR -->
        <input type='submit' value='Filtrar' class='btn-filtrar'>
        </form>
    </div>";
    
    // Div que agrupa filtros e produtos mostrados
    echo "<div id='pesquisa-prod'>";
    // FILTRO
    echo 
    "<div id='filtro'>    
        <form action='pesquisa.php' method='get' name='pesquisa-filtro' id='pesquisa-filtro'>
        
        <!-- PREÇO -->
        <h1>Preço</h1>
            <span class='filtrar-preco'>
                <input type='text' class='txt-preco' name='min' id='min' placeholder='Min.'>
                <input type='text' class='txt-preco' name='max' id='max' placeholder='Máx.'>
            </span>
            <br>

        <label for='preco'>Ordenar por:</label>
        <select name='preco-ordem' id='preco-ordem'>
            <option value=''>A escolher</option>
            <option value='desc'>Maiores preços</option>
            <option value='asc'>Menores preços</option>
        </select>

        <!-- MATERIAL -->
        <h1>Material</h1>
        <select name='material' id='material'>
            <option value=''>A escolher</option>
            <option value='%Prata%'>Prata</option>
            <option value='%Joia%'>Pedras</option>
            <option value='%Aço Inoxidável%'>Aço inoxidável</option>
        </select>

        <!-- TAMANHO -->
        <h1>Tamanho</h1>
        <select name='tamanho' id='tamanho'>
            <option value=''>A escolher</option>
            <option value='pequeno'>Pequeno</option>
            <option value='médio'>Médio</option>
            <option value='grande'>Grande</option>
            <option value='ajustavel'>Ajustável</option>
        </select>

        <!-- TIPO - CATEGORIA -->
        <h1>Categoria</h1>
        <select name='categoria' id='categoria'>
            <option value=''>A escolher</option>
            <option value='%pulseira%'>Pulseiras</option>
            <option value='%colar%'>Colares</option>
            <option value='%brinco%'>Brincos</option>
            <option value='%conjunto%'>Conjuntos</option>
        </select>

        <!-- BOTÃO FILTRAR -->
        <input type='submit' value='Filtrar' class='btn-filtrar'>
        </form>
    </div>";

    // Div Produtos
    echo "<div id='produtos-resultado'>";

    // Listando Resultados
    while ($row_produtos = mysqli_fetch_array($resultados)) {
        $id = $row_produtos['id_prod'];
        $nome_img = "../src/img/produto" . $id . ".png";
        echo
        "<div class='produto' style='margin-top: 0px;'>
            <a href='produto.php?id=$id'>
                <img src='$nome_img' alt='Produto'>
            </a>
            <div class='info-prod-mobile'>
                <div class='info-txt'>
                    <p>" . $row_produtos['nome_prod'] . "</p>
                    <p class='preco'> R$" . $row_produtos['preco'] . 
                    "</p><p class='descricao-prod'>" . $row_produtos['descricao_prod'] . "</p>
                </div>
                <div class='botoes-produto'>
                <a href='produto.php?id=$id'>
                    <button class='btn-compra' btn-placeholder='Comprar'></button>
                </a>
                    <ion-icon name='bag-check-outline' class='icon-mobile-compra'></ion-icon>
                </div>
            </div>
        </div>";
    }

    //Fim DIVs
    echo "</div></div></div>";

    mysqli_close($conexao);
?>

    <!-- Escuro -->
    <div id="escuro" style="display: none;"></div>

    <!-- VOLTAR AO TOPO -->
    <div class="voltar-topo">
        <a href="#topo">Voltar ao Topo <ion-icon name="chevron-up-outline"></ion-icon></a>
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