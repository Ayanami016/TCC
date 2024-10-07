//Mostra a senha ao clicar no icon
function Mostrar_Senha() {
    var x = document.getElementById("senha")
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function Mostrar_ConfirmarSenha() {
    var x = document.getElementById("confirmarsenha")
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

//Muda o icon ao clicar para revelar a senha
function Mudar_IconSenha() {
    var icon_senha = document.getElementById('iconsenha')
    if (icon_senha.name === 'eye-off-outline') {
        icon_senha.name = 'eye-outline';
    } else {
        icon_senha.name = 'eye-off-outline';
    }
}
function Mudar_IconConfirmarSenha() {
    var icon_confirmarsenha = document.getElementById('iconconfirmarsenha')
    if (icon_confirmarsenha.name === 'eye-off-outline') {
        icon_confirmarsenha.name = 'eye-outline';
    } else {
        icon_confirmarsenha.name = 'eye-off-outline';
    }
}

//Ativa o menu mobile
document.getElementById('menu-mobile').addEventListener('click', function() {
    var menupc = document.querySelector('.menu-pc-mobile');
    menupc.classList.toggle('active');
});

//Ativa as Listas do Menu ao passar o mouse em cima (válido em conta, suporte e carrinho)
document.addEventListener("DOMContentLoaded", () => {
    const botao_menupc = document.querySelectorAll(".btnmenu-pc");

    botao_menupc.forEach(botao_menupc => {
        botao_menupc.addEventListener("mouseenter", () => {
            const listamenu = botao_menupc.querySelector(".listamenu");
            if (listamenu) {
                listamenu.style = "display: block; animation: surge-listamenu 0.3s;";
            }
        });

        botao_menupc.addEventListener("mouseleave", () => {
            const listamenu = botao_menupc.querySelector(".listamenu");
            if (listamenu) {
                listamenu.style = "display: none; animation: some-listamenu 0.3s;";
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", () => {
    const botao_menumobile = document.querySelectorAll(".btnmenu-mobile");

    botao_menumobile.forEach(botao_menumobile => {
        botao_menumobile.addEventListener("click", () => {
            const listamenu = botao_menumobile.querySelector(".listamenu");
            if (listamenu) {
                listamenu.style = "display: block; position: absolute; animation: surge-listamenu 0.3s; z-index: 3;";
            }
        });

        botao_menumobile.addEventListener("mouseleave", () => {
            const listamenu = botao_menumobile.querySelector(".listamenu");
            if (listamenu) {
                listamenu.style = "display: none; position: absolute; animation: some-listamenu 0.3s; z-index: 3;";
            }
        });
    });
});

//Ativa a barra lateral do carrinho
//Ao ser ativado, o fundo ficará escuro
document.addEventListener('DOMContentLoaded', function() {
    const mostrarsacola = document.querySelectorAll('.mostrarsacola');
    const carrinho = document.getElementById("carrinho");
    const fecharCarrinho = document.getElementById("fecharcarrinho");
    const pedrismo = document.getElementById("escuro");

    mostrarsacola.forEach (function(link) {
        link.addEventListener('click', function (mostrarAba) {
            mostrarAba.preventDefault();
            carrinho.style.display = "flex";
            pedrismo.style = "display: block; z-index: 4; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: #00000082;";
        });
    });

    fecharCarrinho.addEventListener('click', function() {
        carrinho.style = "display: none;";
        pedrismo.style = "display: none;";
    });
    
    //Fechar carrinho ao clicar na div escura
    pedrismo.addEventListener('click', function() {
        carrinho.style = "display: none;";
        pedrismo.style = "display: none;";
    });
});

//Ativa o filtro mobile
document.addEventListener('DOMContentLoaded', function () {
    const icon_filtro = document.getElementById("filtro-mobile");
    const filtro = document.getElementById("aba-filtro-mobile");
    const pedrismo = document.getElementById("escuro");

    icon_filtro.addEventListener('click', function(mostrarFiltro) {
        mostrarFiltro.preventDefault();
        filtro.style = "position: fixed; display: flex; z-index: 5; justify-content: center; align-items: center; left: 10%; right: 10%;";
        pedrismo.style = "display: block; z-index: 4; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: #00000082;";
    });

    pedrismo.addEventListener('click', function() {
        filtro.style = "display: none;";
        pedrismo.style = "display: none;";
    });
});

//Formata o campo CPF para adicionar . e -
let campoCPF = document.querySelector(".cpf");

campoCPF.addEventListener("keypress", ()=> {
    let tamCampoCPF = campoCPF.value.length;

    if (tamCampoCPF == 3 || tamCampoCPF == 7) {
        campoCPF.value += ".";
    } else if(tamCampoCPF == 11) {
        campoCPF.value += "-";
    }
})

// Formata o campo telefone para adicionar () e -
let campoTel = document.querySelector(".tel")

campoTel.addEventListener("keypress", ()=>{
    let tamCampoTel = campoTel.value.length;

    if (tamCampoTel == 0) {
        campoTel.value += "(";
    } else if (tamCampoTel == 3) {
        campoTel.value += ")";
    } else if (tamCampoTel == 9) {
        campoTel.value += "-";
    }
})

let campoEditarTel = document.querySelector(".Editartel")

campoEditarTel.addEventListener("keypress", ()=>{
    let tamCampoEditarTel = campoEditarTel.value.length;

    if (tamCampoEditarTel == 0) {
        campoEditarTel.value += "(";
    } else if (tamCampoEditarTel == 3) {
        campoEditarTel.value += ")";
    } else if (tamCampoEditarTel == 9) {
        campoEditarTel.value += "-";
    }
})

// Alterando imagem principal na página específica do produto
function trocarImagem(novaImagem) {
    document.getElementById('img-principal').src = novaImagem;
}

// Função para pegar a cor selecionada e atualizá-la no campo hidden
const radioButtons = document.querySelectorAll('input[name="cores[]"]');
const corSelecionadaInput = document.getElementById('cor_selecionada');

radioButtons.forEach(radio => {
    radio.addEventListener('change', function() {
        corSelecionadaInput.value = this.value;
    });
});

// Apenas uma função de capturar a cor selecionada no produto
// Criada para atualizar o input:hiden em produto.php
function selecionarCor(cor) {
    document.getElementById('cor_selecionada').value = cor;
}

// Verifica se na adição do produto ao carrinho uma cor está selecionada
function verificarCorSelecionada() {
    const corSelecionada = document.querySelector('input[name="cor_prod"]:checked');

    if (!corSelecionada) {
        alert('Por favor, selecione uma cor antes de adicionar o produto na sacola.');
        return false;
    }

    document.getElementById('cor_selecionada').value = corSelecionada.value;
    return true;
}

// ViaCEP
function buscarCEP(cep) {
    cep = cep.replace(/\D/g, '');  // Remove caracteres não numéricos
    
    // Verifica se o CEP tem 8 dígitos
    if (cep.length === 8) {
        document.getElementById('loading').style.display = 'block';
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('loading').style.display = 'none';
                if (!data.erro) {
                    document.getElementById('rua').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                } else {
                    alert("CEP não encontrado.");
                }
            })
            .catch(error => {
                document.getElementById('loading').style.display = 'none';
                alert("Erro ao buscar CEP. Tente novamente.");
                console.error("Erro ao buscar CEP:", error);
            });
    } else {
        alert("Formato de CEP inválido.");
    }
}

// Métodos de Pagamento
function metodoPagamento() {
    const select = document.getElementById('pagamento')
    const valor = select.value

    var infoCartao = document.getElementById('info_cartao');
    var pix = document.getElementById('pix');
    var boleto = document.getElementById('boleto');

    infoCartao.style.display = 'none';
    pix.style.display = 'none';
    boleto.style.display = 'none';

    if (valor === 'cartao') {
        infoCartao.style.display = 'flex';
        console.log("cartao selecionado")
    } else if (valor === 'pix') {
        pix.style.display = 'inherit';
        console.log("pix selecionado")
    } else if (valor === 'boleto') {
        boleto.style.display = 'flex';
        console.log("boleto selecionado")
    }
}
