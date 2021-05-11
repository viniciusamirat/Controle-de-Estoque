//Funções do botão de adicionar foto
let btn
let bandeira = false

function label(){
    bandeira = true
    validar()
}

function inFoto(){
    if (!bandeira){
        btn = window.document.getElementById("btn")
        btn.innerHTML = "Adicionar foto"
        btn.style.background = "rgb(167, 164, 164)"
        btn.style.color = "black"
    }
}

function outFoto(){
    if (!bandeira){
        btn = window.document.getElementById("btn")
        btn.innerHTML = "Adicionar foto"
        btn.style.background = "rgb(219, 217, 217)"
        btn.style.color = "black"
    }
}

function validar(){
    let foto = window.document.getElementById("foto")
    let nameFoto = window.document.getElementById("nameFoto")
    
    if (foto.value != false){
        btn.innerHTML = "Com foto"
        btn.style.background = "green"
        btn.style.color = "white"
        bandeira = true
        
        nameFoto.innerHTML = foto.value
    } else {
        btn.innerHTML = "Adicionar foto"
        btn.style.background = "rgb(219, 217, 217)"
        btn.style.color = "black"
        bandeira = false

        nameFoto.innerHTML = null
    }
 
}

//Funções dos inputs de cpf e telefone
function mascaraCpf(i){
   
    var v = i.value;
    
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
       i.value = v.substring(0, v.length-1);
       return;
    }
    
    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) i.value += ".";
    if (v.length == 11) i.value += "-";
 
}

function mascaraTel(i){
   
    var v = i.value;
    
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
       i.value = v.substring(0, v.length-1);
       return;
    }
    
    i.setAttribute("maxlength", "14");
    if (v.length == 1) i.value = "(";
    if (v.length == 3) i.value += ")";
    if (v.length == 9) i.value += "-";
 
}
/*
function mascaraName(i){
   
    var v = i.value;
    
    if(!isNaN(v[v.length-1])){ // impede entrar outro caractere que seja número
       i.value = v.substring(0, v.length-1);
       return;
    }
}*/