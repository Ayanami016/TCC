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

//Ativa o menu mobile
document.getElementById('menu-mobile').addEventListener('click', function() {
    var menupc = document.querySelector('#menu-pc');
    menupc.classList.toggle('active');
});