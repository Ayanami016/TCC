function mostrarSenha() {
    var x = document.getElementById("senha")
    if (x.type === "password") {
        x.type = "text"
    } else {
        x.type = "password"
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