<?php
    session_start();
    if((isset($_SESSION['usuario']) == false) and (isset($_SESSION['senha']) == false)){
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        
        header('location:./index.html');
    }
?>