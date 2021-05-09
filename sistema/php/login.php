<?php
session_start();
include_once "conexao.php";

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

try {
    //Pesquisa se é o administrador que está tentando entrar
    $admin = $conexao->prepare("SELECT * FROM administrador WHERE nome = :nome and senha = :senha;");
    $admin->execute(array(
        ':nome'=>$usuario,
        ':senha'=>$senha
    ));

    //Pesquisa se é um usuário normal
    $comando = $conexao->prepare("SELECT * FROM usuarios WHERE nome = :nome and senha = :senha;");
    $comando->execute(array(
        ':nome'=>$usuario,
        ':senha'=>$senha
    ));

    if ($admin->rowCount() == 1){

        $_SESSION['usuarioAdmin'] = $usuario;
        $_SESSION['senhaAdmin'] = $senha;

        $_SESSION['btn'] = "active";

        header('location:../estoque.php');
    } else {
        if ($comando->rowCount() == 1){
            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha;

            $_SESSION['btn'] = "disabled";

            header('location:../estoque.php');
        } else {
            header('location:../index.html');
        }
    }
} catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}

?>