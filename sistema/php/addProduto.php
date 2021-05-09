<?php
include_once "autenticacaoAdmin.php";
include_once "conexao.php";

$produto = $_POST['produto'];
$marca = $_POST['marca'];
$fornecedor = $_POST['fornecedor'];
$preco_compra = $_POST['preco_compra'];
$preco = $_POST['preco'];
$quantidade = $_POST['quantidade'];

try {
    $pesquisa = $conexao->prepare("SELECT produto FROM produtos WHERE produto = :produto");
    $pesquisa->execute(array(
        ':produto'=>$produto
    ));

    if ($pesquisa->rowCount() > 0){
        echo "<script>alert('Insira o nome de um produto que não exista!');history.go(-1);</script>";

    } else {
        //Pesquisa o id do fornecedor
        $pesquisaFornecedor = $conexao->prepare("SELECT id FROM fornecedores WHERE nome = :nome");
        $pesquisaFornecedor->execute(array(
            ':nome'=>$fornecedor
        ));

        foreach ($pesquisaFornecedor->fetchAll() as $row){
            $fornecedor = $row['id'];
        }

        //Grava a venda
        $comando = $conexao->prepare("INSERT INTO produtos (produto, marca, fornecedor, preco_compra, preco, quantidade) VALUES (:produto, :marca,:fornecedor, :preco_compra, :preco, :quantidade);");
        $comando->execute(array(
            ':produto'=>$produto,
            ':marca'=>$marca,
            ':fornecedor'=>$fornecedor,
            ':preco_compra'=>$preco_compra,
            ':preco'=>$preco,
            ':quantidade'=>$quantidade
        ));

        if ($comando->rowCount() == 1){
            echo "<script>alert('Gravado com sucesso!!');history.go(-2);</script>";
        } else {
            echo "<script>alert('Erro de gravação!!');history.go(-2);</script>;";
        }
    }

    
} catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
?>