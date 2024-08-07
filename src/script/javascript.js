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
        botao_menumobile.addEventListener("mouseenter", () => {
            const listamenu = botao_menumobile.querySelector(".listamenu");
            if (listamenu) {
                listamenu.style = "display: block; animation: surge-listamenu 0.3s; z-index: 3;";
            }
        });

        botao_menumobile.addEventListener("mouseleave", () => {
            const listamenu = botao_menumobile.querySelector(".listamenu");
            if (listamenu) {
                listamenu.style = "display: none; animation: some-listamenu 0.3s; z-index: 3;";
            }
        });
    });
});

//Ativa a barra lateral do carrinho
//Ao ser ativado, o fundo ficará escuro
document.addEventListener('DOMContentLoaded', function() {
    const mostrarCarrinho = document.querySelectorAll('.mostrarcarrinho');
    const carrinho = document.getElementById("carrinho");
    const fecharCarrinho = document.getElementById("fecharcarrinho");
    const pedrismo = document.getElementById("escuro");

    mostrarCarrinho.forEach (function(link) {
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