<?php
    include_once "conexao.php";

    $fornecedor = $_POST['fornecedor'];
    $produtos = $_POST['produtos'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $data = $_POST['data'];

    try {
        //Pesquisa se o fornecedor já é cadastrado
        $pesquisaForn = $conexao->prepare("SELECT * FROM fornecedores WHERE nome = :fornecedor");
        $pesquisaForn->execute(array(
            ':fornecedor'=>$fornecedor
        ));

        if ($pesquisaForn->rowCount() == 1){
            echo "<script>alert('O fornecedor já é registrado!');history.go(-1);</script>";
        } else {
            $insert = $conexao->prepare("INSERT INTO fornecedores (nome, produtos, email, telefone, data_cadastro) VALUES (:nome, :produtos, :email, :tel, :data_cadastro)");
            $insert->execute(array(
                ':nome'=>$fornecedor,
                ':produtos'=>$produtos,
                ':email'=>$email,
                ':tel'=>$tel,
                ':data_cadastro'=>$data
            ));
    
            if ($insert->rowCount() == 1){
                echo "<script>alert('Gravado com sucesso!!');history.go(-2);</script>";
            } else {
                echo "<script>alert('Erro de gravação!!');history.go(-2);</script>;";
            }
        }
    } catch (PDOException $e){
        echo "Error: ".$e->getMessage();
    }

?>