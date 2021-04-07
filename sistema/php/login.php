<?php
session_start();
include_once "conexao.php";

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

try {
    $comando = $conexao->prepare("SELECT * FROM usuarios WHERE nome = :nome and senha = :senha;");
    $comando->execute(array(
        ':nome'=>$usuario,
        ':senha'=>$senha
    ));

    if ($comando->rowCount() == 1){

        $_SESSION['usuario'] = $usuario;
        $_SESSION['senha'] = $senha;

        header('location:../estoque.php');
    } else {
        echo "Error: Usuário não encontrado";
        header('location:./index.html');
    }
} catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}

?>