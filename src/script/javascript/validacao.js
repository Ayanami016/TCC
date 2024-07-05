//declaração de varaveis que seram usadas ao decorrer do codigo
var nunCpf = 0, nunNome = 0, nunSenha = 0, nunTell = 0, campos = 0

//Nome
function clickNome() {
    let texto = document.getElementById("nome").value
    nomeSobrenome = /\b[A-Za-zÀ-ú][A-Za-zÀ-ú]+,?\s[A-Za-zÀ-ú][A-Za-zÀ-ú]{2,19}\b/gi;    
    if(!(nomeSobrenome.test(texto))){
         nunNome = 0
            alert ('NOME Inválido ' + nunNome);          
        }else{
            //campo valido
         nunNome = 1
            alert ('NOME Válido ' + nunNome);}
}

//Cpf
function clickCpf(){
    let cpf = document.getElementById("cpf").value
    let tamanho = cpf.length
    if(tamanho === 14){
        //campo valido
     nunCpf = 1
        alert ("CPF valido " + nunCpf)
    }else{
        nunCpf = 0
        alert("CPF invalido " + nunCpf)}
}

//telefone
function clickTell(){
    let tell = document.getElementById("tel").value
    let size = tell.length
    if(size === 14){
        //campo valido
        nunTell = 1  
        alert ("Tel valido "+ nunTell) 
    }else{
        nunTell = 0 
    alert("Tel invalido " + nunTell)}
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
        alert("SENHA TA CERTA " + nunSenha)       
    }else{
        alert("SENHA TA ERRADA " + nunSenha)}
        nunSenha = 0
    }  else{
        nunSenha = 0
    alert("senha prescisa ser maior " + nunSenha)}
}

//função de confirmação
function confirmacao(){
    //soma de todos os campos considerados validos
    var campos = nunCpf + nunNome + nunSenha + nunTell
alert ("teste de mesa: " + campos)

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
    }, 5000); // 5000 milissegundos = 5 segundos possivel mudar 
})
}
} 