// Funções que redirecionam a outras páginas ao clicar nos
// botões "minha conta" e "login"
function redirecMinhaConta() {window.location.href = '#'}
function redirecLogin() {window.location.href = 'login.html'}

//Mostra a senha ao clicar no icon
function Mostrar_Senha() {
    var x = document.getElementById("senha")
    if (x.type === "password") {
        x.type = "text"
    } else {
        x.type = "password"
    }
}
function Mostrar_ConfirmarSenha() {
    var x = document.getElementById("confirmarsenha")
    if (x.type === "password") {
        x.type = "text"
    } else {
        x.type = "password"
    }
}

//Muda o icon ao clicar para revelar a senha
function Mudar_IconSenha() {
    var icon_senha = document.getElementById('iconsenha')
    if (icon_senha.name === 'eye-off-outline') {
        icon_senha.name = 'eye-outline'
    } else {
        icon_senha.name = 'eye-off-outline'
    }
}
function Mudar_IconConfirmarSenha() {
    var icon_confirmarsenha = document.getElementById('iconconfirmarsenha')
    if (icon_confirmarsenha.name === 'eye-off-outline') {
        icon_confirmarsenha.name = 'eye-outline'
    } else {
        icon_confirmarsenha.name = 'eye-off-outline'
    }
}

//Formata o campo CPF para adicionar . e -
let campoCPF = document.querySelector(".cpf")

campoCPF.addEventListener("keypress", ()=>{
    let tamCampoCPF = campoCPF.value.length

    if (tamCampoCPF == 3 || tamCampoCPF == 7) {
        campoCPF.value += "."
    } else if(tamCampoCPF == 11) {
        campoCPF.value += "-"
    }
})

//Formata o campo telefone para adicionar () e -
let campoTel = document.querySelector(".tel")

campoTel.addEventListener("keypress", ()=>{
    let tamCampoTel = campoTel.value.length

    if (tamCampoTel == 0) {
        campoTel.value += "("
    } else if (tamCampoTel == 3) {
        campoTel.value += ")"
    } else if (tamCampoTel == 9) {
        campoTel.value += "-"
    }
})

//VALIDAÇÃO DOS CAMPOS
//Todos os "vômitos de caracretes" são expressões regulares (regex) para validação dos campos
    //Nome
    function validarNome(nome) {
        const verificar = /^[a-zA-Zà-úÀ-Ú'\-\s]+$/;
        return verificar.test(nome);
    }
    //Email
    function validarEmail(email) {
        // Define a expressão regular para validação de email
        const verificar = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return verificar.test(email);
    }
    //CPF
    //Apenas validamos a quantia de caracteres
    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');

        //Deve ter 14 caracteres
        if (cpf.length === 14) {return false;};
        //Deve ter caracteres diferentes
        if (/^(\d)\1+$/.test(cpf)) {return false;};

        return true;
    }
    //Telefone
    function validarTelefone(tel) {
        const verificar = /^\(\d{2}\) \d{4,5}-\d{4}$/;
        return verificar.test(tel);
    }
    //Confirmar Senha
    function validarSenha() {
        let senha = document.getElementById("senha");
        let confirmarsenha = document.getElementById("");

        let senhaValor = senha.value.trim();
        let confirmarSenhaValor = confirmarSenha.value.trim();

        if (senhaValor === confirmarSenhaValor) {
            console.log("correto")
        } else {
            console.log("incoreto")
        }
    }

//Ativa o menu mobile
document.getElementById('menu-mobile').addEventListener('click', function() {
    var menupc = document.querySelector('#menu-pc')
    menupc.classList.toggle('active')
});