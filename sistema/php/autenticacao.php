<?php
    session_start();
    if(((isset($_SESSION['usuario']) == false) and (isset($_SESSION['senha']) == false))){
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        
        if (((isset($_SESSION['usuarioAdmin']) == false) and (isset($_SESSION['senhaAdmin']) == false))){
            unset($_SESSION['usuarioAdmin']);
            unset($_SESSION['senhaAdmin']);

            header('location:./index.html');
        }
    }
?>