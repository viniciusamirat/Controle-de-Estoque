<?php
    include_once "conexao.php";

    session_start();
    $idVenda = $_SESSION['venda'];
    $vendedor = $_POST['vendedor'];
    $cliente = $_POST['cliente'];
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $total = 0;

    try {
        //substituindo o cpf pelo id do vendedor
        $comando1 = $conexao->prepare("SELECT id FROM vendedores WHERE cpf = '$vendedor'");
        $comando1->execute();

        foreach($comando1->fetchAll() as $row){
            $vendedor = $row['id'];
        }

        //substituindo o cpf pelo id do cliente
        $comando2 = $conexao->prepare("SELECT id FROM clientes WHERE cpf = '$cliente'");
        $comando2->execute();

        foreach($comando2->fetchAll() as $row){
            $cliente = $row['id'];
        }

        //substituindo o nome do produto pelo id
        $comando3 = $conexao->prepare("SELECT id FROM produtos WHERE produto = '$produto'");
        $comando3->execute();

        foreach($comando3->fetchAll() as $row){
            $produto = $row['id'];
        }

        //procurando a quantidade existente do produto
        $comando4 = $conexao->prepare("SELECT quantidade FROM produtos WHERE id = '$produto'");
        $comando4->execute();

        foreach($comando4->fetchAll() as $row){
            $total = $row['quantidade'];
        }

        //Procurando a quantidade da venda do resgistro existente
        $comando5 = $conexao->prepare("SELECT quantidade FROM vendas WHERE id = $idVenda");
        $comando5->execute();

        foreach($comando5->fetchAll() as $row){
            $quantidadeVenda = $row['quantidade'];
        }

        //Update da venda
        $update1 = $conexao->prepare("UPDATE vendas SET id_vendedor = $vendedor, id_cliente = $cliente, id_produto = $produto, quantidade = $quantidade, preco = $preco WHERE id = $idVenda");
        $update1->execute();

        //Update na quantidade do produto do estoque
        $novaQuantidade = ($total + $quantidadeVenda) - $quantidade;

        $update2 = $conexao->prepare("UPDATE produtos SET quantidade = $novaQuantidade WHERE id = $produto");
        $update2->execute();

        if ($update1->rowCount() == 1){
            echo "<script>alert('Gravado com sucesso!!');history.go(-2);</script>";
        } else {
            echo "<script>alert('Erro de gravação!!');history.go(-2);</script>;";
        }
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }

?>