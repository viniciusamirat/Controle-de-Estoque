<?php
    include_once "conexao.php";

    session_start();
    $id = $_SESSION['editar'];
    $nome = $_POST['cliente'];
    $cpf = $_POST['cpf'];
    $tel = $_POST['tel'];

    try {
        $comando = $conexao->prepare("UPDATE clientes SET nome = :nome, cpf = :cpf, telefone = :tel WHERE id = :id");
        $comando->execute(array(
            ':nome'=>$nome,
            ':cpf'=>$cpf,
            ':tel'=>$tel,
            ':id'=>$id
        ));

        if ($comando->rowCount() == 1){
            echo "<script>alert('Gravado com sucesso!!');history.go(-2);</script>";
        } else {
            echo "<script>alert('Erro de gravação!!');history.go(-2);</script>;";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>