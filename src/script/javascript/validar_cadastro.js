//VALIDAÇÃO DOS CAMPOS
//Todos os "vômitos de caracteres" são expressões regulares (regex) para validação dos campos
    //Nome
    function validarNome(nome) {
        const verificar = /^[a-zA-Zà-úÀ-Ú'\-\s]+$/;
        return verificar.test(nome);
    }
    //Email
    function validarEmail(email) {
        const verificar = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return verificar.test(email);
    }
    //CPF
    //Apenas validamos a quantia de caracteres
    function validarCPF(cpf) {
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