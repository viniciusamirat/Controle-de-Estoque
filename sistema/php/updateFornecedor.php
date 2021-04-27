<?php
    include_once "conexao.php";

    session_start();
    $id = $_SESSION['editar'];

    $fornecedor = $_POST['fornecedor'];
    $produtos = $_POST['produtos'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    try {
        //Fazendo update no regitro do fornecedor
        $update = $conexao->prepare("UPDATE fornecedores SET nome = :nome, produtos = :produtos, email = :email, telefone = :tel WHERE id = :id");
        $update->execute(array(
            ':nome'=>$fornecedor,
            ':produtos'=>$produtos,
            ':email'=>$email,
            ':tel'=>$tel,
            ':id'=>$id
        ));

        if ($update->rowCount() == 1){
            echo "<script>alert('Gravado com sucesso!!');history.go(-2);</script>";
        } else {
            echo "<script>alert('Erro de gravação!!');history.go(-2);</script>;";
        }
    } catch (PDOException $e){
        echo "Error: ".$e->getMessage();
    }
?>