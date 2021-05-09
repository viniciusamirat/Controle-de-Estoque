<?php
    include_once "autenticacaoAdmin.php";
    include_once "conexao.php";

    session_start();
    $idProduto = $_SESSION['produto'];
    $produto = $_POST['produto'];
    $marca = $_POST['marca'];
    $fornecedorNome = $_POST['fornecedor'];
    $preco_compra = $_POST['preco_compra'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $fornecedorId;

    try {
        //Pesquisa o id do fornecedor
        $pesquisa = $conexao->prepare("SELECT id FROM fornecedores WHERE nome = :nome");
        $pesquisa->execute(array(
            ':nome'=>$fornecedorNome
        ));

        foreach ($pesquisa->fetchAll() as $row){
            $fornecedorId = $row['id'];
        }

        //Update do produto
        $update1 = $conexao->prepare("UPDATE produtos SET produto = :produto, marca = :marca, fornecedor = :fornecedor, preco_compra = :preco_compra, preco = :preco, quantidade = :quant WHERE id = :idProduto");
        $update1->execute(array(
            ':produto'=>$produto,
            ':marca'=>$marca,
            ':fornecedor'=>$fornecedorId,
            ':preco_compra'=>$preco_compra,
            ':preco'=>$preco,
            ':quant'=>$quantidade,
            ':idProduto'=>$idProduto
        ));

        if ($update1->rowCount() == 1){
            echo "<script>alert('Editado com sucesso!!');history.go(-2);</script>";
        } else {
            echo "<script>alert('Erro ao editar!!');history.go(-2);</script>;";
        }
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }

?>