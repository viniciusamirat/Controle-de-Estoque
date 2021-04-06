<?php
    include_once "conexao.php";

    $vendedor = $_POST['vendedor'];
    $cliente = $_POST['cliente'];
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $data = $_POST['data'];
    $total = 0;

    try {
        //substituindo o cpf pelo id do vendedor
        $comando1 = $conexao->prepare("SELECT id FROM vendedores WHERE cpf = '$vendedor'");
        $comando1->execute();

        $resu1 = $comando1->fetchAll();

        foreach($resu1 as $row){
            $vendedor = $row['id'];
        }

        //substituindo o cpf pelo id do cliente
        $comando2 = $conexao->prepare("SELECT id FROM clientes WHERE cpf = '$cliente'");
        $comando2->execute();

        $resu2 = $comando2->fetchAll();

        foreach($resu2 as $row){
            $cliente = $row['id'];
        }

        //substituindo o nome do produto pelo id
        $comando3 = $conexao->prepare("SELECT id FROM produtos WHERE produto = '$produto'");
        $comando3->execute();

        $resu3 = $comando3->fetchAll();

        foreach($resu3 as $row){
            $produto = $row['id'];
        }

        //procurando a quantidade existente do produto
        $comando4 = $conexao->prepare("SELECT quantidade FROM produtos WHERE id = '$produto'");
        $comando4->execute();

        $resu4 = $comando4->fetchAll();

        foreach($resu4 as $row){
            $total = $row['quantidade'];
        }

        //Update na quantidade do produto
        $resto = $total - $quantidade;

        $update = $conexao->prepare("UPDATE produtos SET quantidade = '$resto' WHERE id = '$produto'");
        $update->execute();

        //inclusão
        $sql = $conexao->prepare("INSERT INTO vendas (id_vendedor, id_cliente, id_produto, quantidade, preco, data_venda) VALUES (:vendedor, :cliente, :produto, :quantidade, :preco, :data_venda);");
        $sql->execute(array(
            ':vendedor'=>$vendedor,
            ':cliente'=>$cliente,
            ':produto'=>$produto,
            ':quantidade'=>$quantidade,
            ':preco'=>$preco,
            ':data_venda'=>$data
        ));

        if ($sql->rowCount() == 1){
            echo "<script>alert('Gravado com sucesso!!');history.go(-1);</script>";
        } else {
            echo "<script>alert('Erro de gravação!!');history.go(-1);</script>;";
        }
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }

?>