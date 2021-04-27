<?php
    include_once "conexao.php";

    $fornecedor = $_POST['fornecedor'];
    $produtos = $_POST['produtos'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    try {
        $insert = $conexao->prepare("INSERT INTO fornecedores (nome, produtos, email, telefone) VALUES (:nome, :produtos, :email, :tel)");
        $insert->execute(array(
            ':nome'=>$fornecedor,
            ':produtos'=>$produtos,
            ':email'=>$email,
            ':tel'=>$tel
        ));

        if ($insert->rowCount() == 1){
            echo "<script>alert('Gravado com sucesso!!');history.go(-2);</script>";
        } else {
            echo "<script>alert('Erro de gravação!!');history.go(-2);</script>;";
        }
    } catch (PDOException $e){
        echo "Error: ".$e->getMessage();
    }

?>