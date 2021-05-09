<?php
session_start();

unset($_SESSION['usuario']);
unset($_SESSION['senha']);

unset($_SESSION['usuarioAdmin']);
unset($_SESSION['senhaAdmin']);

header('location:../index.html');
?>