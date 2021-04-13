<?php
    include_once "conexao.php";

    session_start();
    $idProduto = $_SESSION['produto'];
    $produto = $_POST['produto'];
    $marca = $_POST['marca'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    try {
        //Update do produto
        $update1 = $conexao->prepare("UPDATE produtos SET produto = '$produto', marca = '$marca', preco = $preco, quantidade = $quantidade WHERE id = $idProduto");
        $update1->execute();

        if ($update1->rowCount() == 1){
            echo "<script>alert('Gravado com sucesso!!');history.go(-2);</script>";
        } else {
            echo "<script>alert('Erro de gravação!!');history.go(-2);</script>;";
        }
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }

?>