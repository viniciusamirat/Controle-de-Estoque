let btn

function label(){
    btn = window.document.getElementById("btn")
    btn.innerHTML = "Carregando"
    btn.style.background = "rgb(219, 217, 217)"
    btn.style.color = "black"
}

function validar(){
    let foto = window.document.getElementById("foto")

    if (foto.value != false){
        btn.innerHTML = "Com foto"
        btn.style.background = "green"
        btn.style.color = "white"
    } else {
        btn.innerHTML = "Adicionar foto"
        btn.style.background = "rgb(219, 217, 217)"
        btn.style.color = "black"
    }
}

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