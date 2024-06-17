//VALIDAÇÃO DOS CAMPOS

document.addEventListener("DOMContentLoaded", () => {
    let campoNome = document.getElementById("nome");
    let campoEmail = document.getElementById("email");
    let campoCPF = document.getElementById("cpf")
    let campoTelefone = document.getElementById("tel");
    let campoSenha = document.getElementById("senha");
    let campoConfirmarSenha = document.getElementById("confirmarSenha");

    //NOME
        //Validação
    function validarNome(nome) {
        const validacao = /^[a-zA-Zà-úÀ-Ú'\-\s]+$/;
        return validacao.test(nome) && nome.length > 1;
    }

    //EMAIL
        //Validação
    function validarEmail(email) {
        const validacao = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return validacao.test(email);
    }

    //CPF
        //Formatação
    campoCPF.addEventListener("input", () => {
        let cpf = campoCPF.value.replace(/\D/g, '');
        if (cpf.length > 11) cpf = cpf.substring(0, 11);
        
        let cpfFormatado = cpf.replace(/(\d{3})(\d)/, "$1.$2").replace(/(\d{3})(\d)/, "$1.$2").replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    
        campoCPF.value = cpfFormatado;
    });
        //Validação
     function validarCPF(cpf) {
        if (cpf.length !== 14) {
            return false;
        }
        cpf = cpf.replace(/[^\d]+/g, '');
        if (/^(\d)\1+$/.test(cpf)) {
            return false;
        }
        return true;
    }

    //TELEFONE
        //Formatação
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
        //Validação
     function validarTelefone(telefone) {
        const regex = /^\(\d{2}\) \d{4,5}-\d{4}$/;
        return regex.test(telefone);
    }

    //CONFIRMAR SENHA
        //Validação
    function validarConfirmacaoSenha(senha, confirmarSenha) {
        return senha === confirmarSenha;
    }

    //FORMULÁRIO
    formulario.addEventListener("submit", (event) => {
        event.preventDefault();

        let formValido = true;
        //Nome
        if (!validarNome(campoNome.value)) {
            formValido = false;
            campoNome.classList.add("invalido");
        } else {
            erroNome.textContent = "";
            campoNome.classList.add("valido");
        }

        //Email
        if (!validarEmail(campoEmail.value)) {
            erroEmail.textContent = "Email inválido.";
            formValido = false;
        } else {
            erroEmail.textContent = "";
        }

        //CPF
        if (!validarCPF(campoCPF.value)) {
            erroCPF.textContent = "CPF inválido.";
            formValido = false;
        } else {
            erroCPF.textContent = "";
        }

        //Telefone
        if (!validarTelefone(campoTelefone.value)) {
            erroTelefone.textContent = "Telefone inválido.";
            formValido = false;
        } else {
            erroTelefone.textContent = "";
        }

        //Confirmar Senha
        if (!validarConfirmacaoSenha(campoSenha.value, campoConfirmarSenha.value)) {
            erroConfirmarSenha.textContent = "As senhas não coincidem.";
            formValido = false;
        } else {
            erroConfirmarSenha.textContent = "";
        }

        if (formValido) {
            alert("Formulário enviado com sucesso!");
        }
    });
})


//Todos os "vômitos de caracteres" são expressões regulares (regex) para validação dos campos

// //Nome
// function validarNome(nome) {
//     const verificar = /^[a-zA-Zà-úÀ-Ú'\-\s]+$/;
//     return verificar.test(nome);
// }
// //Email
// function validarEmail(email) {
//     const verificar = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     return verificar.test(email);
// }
// //CPF
// //Apenas validamos a quantia de caracteres
// function validarCPF(cpf) {
//     //Deve ter 14 caracteres
//     if (cpf.length === 14) {return false;};
//     //Deve ter caracteres diferentes
    
//     if (/^(\d)\1+$/.test(cpf)) {return false;};

//     return true;
// }
// //Telefone
// function validarTelefone(tel) {
//     const verificar = /^\(\d{2}\) \d{4,5}-\d{4}$/;
//     return verificar.test(tel);
// }
// //Confirmar Senha
// function validarSenha() {
//     let senha = document.getElementById("senha");
//     let confirmarsenha = document.getElementById("");

//     let senhaValor = senha.value.trim();
//     let confirmarSenhaValor = confirmarSenha.value.trim();

//     if (senhaValor === confirmarSenhaValor) {
//         console.log("correto")
//     } else {
//         console.log("incoreto")
//     }
// }