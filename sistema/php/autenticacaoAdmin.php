<?php
    session_start();
    if((isset($_SESSION['usuarioAdmin']) == false) and (isset($_SESSION['senhaAdmin']) == false)){
        unset($_SESSION['usuarioAdmin']);
        unset($_SESSION['senhaAdmin']);
        
        //header('location:./index.html');
        echo "<script>alert('Você não é o administrador!');history.go(-1);</script>;";
    }
?>
