<?php
    include_once "conexao.php";

    session_start();
    $id = $_SESSION['mais'];
    $nome = $_POST['vendedor'];
    $cpf = $_POST['cpf'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];

    try {
        $comando = $conexao->prepare("UPDATE vendedores SET nome = :nome, cpf = :cpf, telefone = :tel, email = :email WHERE id = :id");
        $comando->execute(array(
            ':nome'=>$nome,
            ':cpf'=>$cpf,
            ':tel'=>$tel,
            ':email'=>$email,
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