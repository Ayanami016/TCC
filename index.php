<?php
    include('src/script/conexao.php');
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
    <title>Bella Acessórios - Página Inicial</title>
    <link rel="stylesheet" href="src/script/style.css">
    <link rel="stylesheet" href="src/script/responsivo.css">
    <link rel="shortcut icon" href="src/favicon/android-chrome-512x512.png" type="image/x-icon">
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
            <a href="index.php"><img src="src/img/Bella Logo com Fundo.png" alt="Logo" class="logo"></a>
        </span>

        <form action="paginas/pesquisa.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=" method="post">
            <input type="search" name="pesquisa" id="pesquisa" class="menu-pesquisa" placeholder="Buscar">
        </form>

        <nav>
            <!--Menu Mobile-->
            <span class="alterna-menu" id="menu-mobile">
                <ion-icon name="menu" class="iconmenu" color="light"></ion-icon>
            </span>

            <!--Menu PC-->
            <span id="menu-pc">
                <a href="paginas/pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25pulseira%25" class="link-menupc">Pulseiras</a>
                <a href="paginas/colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=Colar%2C+Index" class="link-menupc">Colares</a>
                <a href="paginas/brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25brinco%25" class="link-menupc">Brincos</a>
                <a href="paginas/conjunto.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25conjunto%25" class="link-menupc">Conjuntos</a>
            </span>


            <!--Menu Mobile-->
            <span class="alterna-botoes">
                <!-- Conta -->
                <button class="btnmenu-mobile">
                    <ion-icon name="person-circle-outline" class="iconconta" color="light"></ion-icon>
                    <div class="listamenu btnconta">
                        <?php if (!empty($primeiroNome)) : ?>
                        <!-- Logado -->
                        <a href="paginas/minha-conta.php" class="link-listamenu">Minha Conta</a>
                        <a href="#" class="link-listamenu">Histórico</a>
                        <a href="src/script/destroy_session.php" class="link-listamenu">Encessar Sessão</a>
                        <?php else: ?>
                        <a href="paginas/login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="paginas/cadastro.php" class="link-listamenu">Criar Conta</a>
                        <?php endif; ?>
                    </div>
                </button>

                <!-- Suporte -->
                <button class="btnmenu-mobile">
                    <ion-icon name="chatbubbles-outline" class="iconsuporte" color="light"></ion-icon>
                    <div class="listamenu btnsuporte">
                        <a href="#" class="link-listamenu">Contato</a>
                        <a href="paginas/faq.html" class="link-listamenu">FAQ</a>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-mobile">
                    <ion-icon name="bag-handle-outline" class="iconsacola" color="light"></ion-icon>
                    <div class="listamenu btnsacola">
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

                    <div class="listamenu">
                        <?php if (!empty($primeiroNome)): ?>
                            <!-- Itens do menu para usuários logados -->
                            <a href="paginas/minha-conta.php" class="link-listamenu">Minha Conta</a>
                            <a href="#" class="link-listamenu">Histórico</a>
                            <a href="src/script/destroy_session.php" class="link-listamenu">Encerrar Sessão</a>
                        <?php else: ?>
                            <!-- Itens do menu para usuários não logados -->
                            <a href="paginas/login.php" class="link-listamenu">Iniciar Sessão</a>
                            <a href="paginas/cadastro.php" class="link-listamenu">Criar Conta</a>
                        <?php endif; ?>
                    </div>
                </button>

                <!-- Suporte -->
                <button class="btnmenu-pc">
                    <ion-icon name="chatbubbles-outline" class="iconbtn"></ion-icon><br>Suporte
                    <div class="listamenu">
                        <a href="#" class="link-listamenu">Contato</a>
                        <a href="#" class="link-listamenu">FAQ</a>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-pc">
                    <ion-icon name="bag-handle-outline" class="iconbtn"></ion-icon><br>Sacola
                    <div class="listamenu">
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
        <a href="paginas/pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25pulseira%25">Pulseiras</a>
        <a href="paginas/colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=Colar%2C+Index">Colares</a>
        <a href="paginas/brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25brinco%25">Brincos</a>
        <a href="paginas/conjunto.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25onjunto%25">Conjuntos</a>
    </span>

    <!-- BARRA LATERAL - HISTÓRICO -->
    <aside id="carrinho" style="display: none;">
        <ion-icon name="bag-handle-outline"></ion-icon>
        <h1>Seu carrinho está vazio!</h1> <br>
        <p>Escolha algum produto e adicione ao carrinho para realizar sua compra!</p> <br>
        <a id="fecharcarrinho">Voltar</a>
    </aside>

    <!-- Link âncora para voltar ao topo da página -->
    <a name="topo"></a>

    <!-- CATÁLOGO -->   
    <article id="catalogo">
        <!-- Min-width maior para o menor -->
        <picture>
            <source media="(min-width: 1063px)" srcset="src/img/catalogo-pc.jpeg">
            <source media="(min-width: 530px)" srcset="src/img/catalogo-tablet.jpeg">
            <source media="(min-width: 0px)" srcset="src/img/catalogo-mobile.jpeg">
            <img src="src/img/ph-catalogo-pc.jpg" alt="Imagem de Catálogo">
        </picture>
    </article>

    <!-- SOBRE A LOJA -->
    <article class="sobre-loja">
        <h1>Sobre a Loja</h1>
        <p>Somos uma empresa do ramo de acessórios. Nossos produtos são brincos, colares e pulseiras de aço inoxidável folheadas a prata. Todos os nossos produtos são prateados e visamos boa qualidade, custo-benefício e  atendimento de excelência.</p>
        <a href="#"><button class="btn-saibamais" btn-placeholder="Saiba Mais"></button></a>
    </article>

    <!-- MAIS VENDIDOS -->
    <article class="produtos-index">
        <h1>Mais Vendidos</h1>
        <?php
            echo "<span class='produtos-conteudo'>";

            $maisvendidos = "SELECT * FROM produto WHERE tipo_prod like '%Mais Vendidos%';";
            $resultado = mysqli_query($conexao, $maisvendidos);

            while ($row_produtos = mysqli_fetch_array($resultado)) {
                $id = $row_produtos['id_prod'];
                $nome_img = "src/img/produto" . $id . ".png";
                echo
                "<div class='produto' style='margin-top: 0px;'>
                    <a href='paginas/produto.php?id=$id'>
                        <img src='$nome_img' alt='Produto'>
                    </a>
                    <div class='info-prod-mobile'>
                        <div class='info-txt'>
                            <p>" . $row_produtos['nome_prod'] . "</p>
                            <p class='preco'> R$" . $row_produtos['preco'] . 
                            "</p><p class='descricao-prod'>" . $row_produtos['descricao_prod'] . "</p>
                        </div>
                        <div class='botoes-produto'>
                        <a href='paginas/produto.php?id=$id'>
                            <button class='btn-compra' btn-placeholder='Comprar'></button>
                        </a>
                            <ion-icon name='add-outline'></ion-icon>
                            <ion-icon name='bag-check-outline' class='icon-mobile-compra'></ion-icon>
                        </div>
                    </div>
                </div>";
            }
            echo "</span>";
        ?>
        <!-- <span class="produtos-conteudo">
            <div class="produto">
                <img src="../src/img/ph-produto-anel.jpg" alt="Produto">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit</p>
                <p class="preco">R$900,00</p>
                <div class="botoes-produto">
                    <button class="btn-compra" btn-placeholder="Comprar"></button>
                    <ion-icon name="add-outline"></ion-icon>
                </div>
            </div>
            <div class="produto">
                <img src="../src/img/ph-produto-brinco.jpg" alt="Produto"  >
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit</p>
                <p class="preco">R$900,00</p>
                <div class="botoes-produto">
                    <button class="btn-compra" btn-placeholder="Comprar"></button>
                    <ion-icon name="add-outline"></ion-icon>
                </div>
            </div>
            
            <div class="produto">
                <img src="../src/img/ph-produto-colar.jpg" alt="Produto"  >
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit</p>
                <p class="preco">R$900,00</p>
                <div class="botoes-produto">
                    <button class="btn-compra" btn-placeholder="Comprar"></button>
                    <ion-icon name="add-outline"></ion-icon>
                </div>
            </div>
            <div class="produto">
                <img src="../src/img/ph-produto-pulseira.jpg" alt="Produto"  >
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit</p>
                <p class="preco">R$900,00</p>
                <div class="botoes-produto">
                    <button class="btn-compra" btn-placeholder="Comprar"></button>
                    <ion-icon name="add-outline"></ion-icon>
                </div>
            </div>
        </span> -->
    </article>

    <!-- CONHEÇA NOSSOS PRODUTOS -->
     <article class="conheca-produtos">
        <h1>Conheça nossos Produtos</h1>
        <span class="conheca-conteudo">
            <div class="conhecaproduto">
                <a href="#pulseira"><img src="src/img/produto1.png" alt="Conheça Pulseiras">Pulseira</a>
            </div>
            <div class="conhecaproduto">
                <a href="#colar"><img src="src/img/produto7.png" alt="Conheça Colares">Colar</a>
            </div>
            <div class="conhecaproduto">
                <a href="#brinco"><img src="src/img/produto36.png" alt="Conheça Brincos">Brinco</a>
            </div>
            <div class="conhecaproduto">
                <a href="#conjunto"><img src="src/img/produto13.png" alt="Conheça Conjuntos">Conjunto</a>
            </div>
        </span>    
     </article>

    <!-- PRODUTOS -->
        <!-- Pulseira -->
    <a name="pulseira"></a>
    <article class="prod-destaque-esquerda">
        <img src="src/img/destaque-pulseira.png" alt="Pulseira em Destaque">
        <div class="pdd-texto">
            <h1>Pulseiras</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est perspiciatis consequatur veritatis temporibus nesciunt eum quasi veniam ipsa recusandae porro voluptas tempore dolorem eveniet quae, odio omnis natus aliquam atque!</p>
            <a href="paginas/pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25pulseira%25"><button class="btn-saibamais" btn-placeholder="Saiba Mais"></button></a>
        </div>
    </article>

    <article class="produtos-index">
        <span class="produtos-conteudo">
            <?php
                $pulseiras = "SELECT * FROM produto WHERE tipo_prod like 'Pulseira, Index';";
                $resultado = mysqli_query($conexao, $pulseiras);

                while ($row_produtos = mysqli_fetch_array($resultado)) {
                    $id = $row_produtos['id_prod'];
                    $nome_img = "src/img/produto" . $id . ".png";
                    echo
                    "<div class='produto' style='margin-top: 0px;'>
                        <a href='paginas/produto.php?id=$id'>
                            <img src='$nome_img' alt='Produto'>
                        </a>
                        <div class='info-prod-mobile'>
                            <div class='info-txt'>
                                <p>" . $row_produtos['nome_prod'] . "</p>
                                <p class='preco'> R$" . $row_produtos['preco'] . 
                                "</p><p class='descricao-prod'>" . $row_produtos['descricao_prod'] . "</p>
                            </div>
                            <div class='botoes-produto'>
                            <a href='paginas/produto.php?id=$id'>
                                <button class='btn-compra' btn-placeholder='Comprar'></button>
                            </a>
                                <ion-icon name='add-outline'></ion-icon>
                                <ion-icon name='bag-check-outline' class='icon-mobile-compra'></ion-icon>
                            </div>
                        </div>
                    </div>";
                }
            ?>
            </div>
        </span>
    </article>

        <!-- Colar -->
    <a name="colar"></a>
    <article class="prod-destaque-direita">
        <div class="pdd-texto">
            <h1>Colares</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est perspiciatis consequatur veritatis temporibus nesciunt eum quasi veniam ipsa recusandae porro voluptas tempore dolorem eveniet quae, odio omnis natus aliquam atque!</p>
            <a href="paginas/colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=Colar%2C+Index"><button class="btn-saibamais" btn-placeholder="Saiba Mais"></button></a>
        </div>
        <img src="src/img/destaque-colar.png" alt="Colar em Destaque">
    </article>

    <article class="produtos-index">
        <span class="produtos-conteudo">
            <?php
                $colares = "SELECT * FROM produto WHERE tipo_prod like 'Colar, Index';";
                $resultado = mysqli_query($conexao, $colares);

                while ($row_produtos = mysqli_fetch_array($resultado)) {
                    $id = $row_produtos['id_prod'];
                    $nome_img = "src/img/produto" . $id . ".png";
                    echo
                    "<div class='produto' style='margin-top: 0px;'>
                        <a href='paginas/produto.php?id=$id'>
                            <img src='$nome_img' alt='Produto'>
                        </a>
                        <div class='info-prod-mobile'>
                            <div class='info-txt'>
                                <p>" . $row_produtos['nome_prod'] . "</p>
                                <p class='preco'> R$" . $row_produtos['preco'] . 
                                "</p><p class='descricao-prod'>" . $row_produtos['descricao_prod'] . "</p>
                            </div>
                            <div class='botoes-produto'>
                            <a href='paginas/produto.php?id=$id'>
                                <button class='btn-compra' btn-placeholder='Comprar'></button>
                            </a>
                                <ion-icon name='add-outline'></ion-icon>
                                <ion-icon name='bag-check-outline' class='icon-mobile-compra'></ion-icon>
                            </div>
                        </div>
                    </div>";
                }
            ?>
        </span>
    </article>
    
        <!-- Brinco -->
    <a name="brinco"></a>
    <article class="prod-destaque-esquerda">
        <img src="src/img/destaque-brinco.png" alt="Brinco em Destaque">
        <div class="pdd-texto">
            <h1>Brincos</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est perspiciatis consequatur veritatis temporibus nesciunt eum quasi veniam ipsa recusandae porro voluptas tempore dolorem eveniet quae, odio omnis natus aliquam atque!</p>
            <a href="paginas/brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25brinco%25"><button class="btn-saibamais" btn-placeholder="Saiba Mais"></button></a>
        </div>
    </article>
    
    <article class="produtos-index">
        <span class="produtos-conteudo">
        <?php
            $brincos = "SELECT * FROM produto WHERE tipo_prod like 'Brinco, Index';";
            $resultado = mysqli_query($conexao, $brincos);

            while ($row_produtos = mysqli_fetch_array($resultado)) {
                $id = $row_produtos['id_prod'];
                $nome_img = "src/img/produto" . $id . ".png";
                echo
                "<div class='produto' style='margin-top: 0px;'>
                    <a href='paginas/produto.php?id=$id'>
                        <img src='$nome_img' alt='Produto'>
                    </a>
                    <div class='info-prod-mobile'>
                        <div class='info-txt'>
                            <p>" . $row_produtos['nome_prod'] . "</p>
                            <p class='preco'> R$" . $row_produtos['preco'] . 
                            "</p><p class='descricao-prod'>" . $row_produtos['descricao_prod'] . "</p>
                        </div>
                        <div class='botoes-produto'>
                        <a href='paginas/produto.php?id=$id'>
                            <button class='btn-compra' btn-placeholder='Comprar'></button>
                        </a>
                            <ion-icon name='add-outline'></ion-icon>
                            <ion-icon name='bag-check-outline' class='icon-mobile-compra'></ion-icon>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </span>
    </article>

     <!-- Conjunto -->
     <a name="conjunto"></a>
    <article class="prod-destaque-direita">
        <div class="pdd-texto">
            <h1>Conjuntos</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est perspiciatis consequatur veritatis temporibus nesciunt eum quasi veniam ipsa recusandae porro voluptas tempore dolorem eveniet quae, odio omnis natus aliquam atque!</p>
            <a href="paginas/conjunto.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25onjunto%25"><button class="btn-saibamais" btn-placeholder="Saiba Mais"></button></a>
        </div>
        <img src="src/img/destaque-conjunto.png" alt="Conjunto em Destaque">
    </article>

    <article class="produtos-index">
        <span class="produtos-conteudo">
            <?php
                $colares = "SELECT * FROM produto WHERE tipo_prod like '%Conjunto%';";
                $resultado = mysqli_query($conexao, $colares);

                while ($row_produtos = mysqli_fetch_array($resultado)) {
                    $id = $row_produtos['id_prod'];
                    $nome_img = "src/img/produto" . $id . ".png";
                    echo
                    "<div class='produto' style='margin-top: 0px;'>
                        <a href='paginas/produto.php?id=$id'>
                            <img src='$nome_img' alt='Produto'>
                        </a>
                        <div class='info-prod-mobile'>
                            <div class='info-txt'>
                                <p>" . $row_produtos['nome_prod'] . "</p>
                                <p class='preco'> R$" . $row_produtos['preco'] . 
                                "</p><p class='descricao-prod'>" . $row_produtos['descricao_prod'] . "</p>
                            </div>
                            <div class='botoes-produto'>
                            <a href='paginas/produto.php?id=$id'>
                                <button class='btn-compra' btn-placeholder='Comprar'></button>
                            </a>
                                <ion-icon name='add-outline'></ion-icon>
                                <ion-icon name='bag-check-outline' class='icon-mobile-compra'></ion-icon>
                            </div>
                        </div>
                    </div>";
                }
            ?>
        </span>
    </article>
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
            <a href="https://github.com/Ayanami016/TCC" target="_blank"><i class="fab fa-github fa-lg"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
        </span>
    </footer>

    <!--JAVASCRIPT-->
    <script src="src/script/javascript.js" type="text/javascript"></script>
        <!-- Ícones -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <!-- Font Awesome - usado para o rodapé -->
    <script src="https://kit.fontawesome.com/750ae9b6a4.js" crossorigin="anonymous"></script>
</body>
</html>