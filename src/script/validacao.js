//declaração de varaveis que seram usadas ao decorrer do codigo
var nunCpf = 0, nunNome = 0, nunSenha = 0, nunTell = 0, campos = 0

//Nome
function clickNome() {
    let texto = document.getElementById("nome").value
    nomeSobrenome = /\b[A-Za-zÀ-ú][A-Za-zÀ-ú]+,?\s[A-Za-zÀ-ú][A-Za-zÀ-ú]{2,19}\b/gi;    
    if(!(nomeSobrenome.test(texto))){
         nunNome = 0
                     
        }else{
            //campo valido
         nunNome = 1
            }
}

//Cpf
function clickCpf(){
    let cpf = document.getElementById("cpf").value
    let tamanho = cpf.length
    if(tamanho === 14){
        //campo valido
     nunCpf = 1
       
    }else{
        nunCpf = 0
        }
}

//telefone
function clickTell(){
    let tell = document.getElementById("tel").value
    let size = tell.length
    if(size === 14){
        //campo valido
        nunTell = 1  
       
    }else{
        nunTell = 0 
   }
}

//senha
function clickSenha(){
    let presenha = document.getElementById("senha").value
    let tamanhosenha = presenha.length

if(tamanhosenha >= 8){

    let senha1 = document.getElementById("senha").value
    let senha2 = document.getElementById("confirmarsenha").value
    if(senha1 == senha2){
        //campo valido
        nunSenha = 1
               
    }else{
       }
        nunSenha = 0
    }  else{
        nunSenha = 0
    }
}

//função de confirmação
function confirmacao(){
    //soma de todos os campos considerados validos
    var campos = nunCpf + nunNome + nunSenha + nunTell

if(campos === 3 ){
    //se for considerado valido ira conectar no banco e inserir os dados logo apos levar a outra pagina (obs: ainda fazer)
 alert("Dados cadastrados com Sucesso")
}else{
    //função erro
    //mensagem temporaria aparece na tela
document.getElementById("btn").addEventListener('click', function errado() {
    var img = document.getElementById('image')
    img.style.display = 'block'
    setTimeout(function errado() {
        img.style.display = 'none'
    }, 6000); // 5000 milissegundos = 5 segundos possivel mudar 
})
}
} 