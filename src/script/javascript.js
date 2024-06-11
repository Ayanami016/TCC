// Funções que redirecionam a outras páginas ao clicar nos
// botões "minha conta" e "login"
function redirecMinhaConta() {window.location.href = '#'}
function redirecLogin() {window.location.href = 'login.html'}

//Mostra a senha ao clicar no icon
function mostrarSenha() {
    var x = document.getElementById("senha")
    if (x.type === "password") {
        x.type = "text"
    } else {
        x.type = "password"
    }
}

//Muda o icon ao clicar para revelar a senha
function mudaricon() {
    var icon = document.getElementById('iconsenha');
    if (icon.name === 'eye-off-outline') {
        icon.name = 'eye-outline';
    } else {
        icon.name = 'eye-off-outline';
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
document.getElementById('mobile-menu').addEventListener('click', function() {
    var nav = document.querySelector('.nav');
    nav.classList.toggle('active');
});