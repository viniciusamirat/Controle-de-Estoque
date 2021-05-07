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