<?php
    include_once "conexao.php";

    $vendedor = $_POST['vendedor'];
    $cliente = $_POST['cliente'];
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $data = $_POST['data'];
    $total = 0;
    $vendas;
    $valor_vendas;
    $compras;
    $valor_compras;

    try {
        //substituindo o cpf pelo id do vendedor
        $comando1 = $conexao->prepare("SELECT id FROM vendedores WHERE cpf = :cpf");
        $comando1->execute(array(
            ':cpf'=>$vendedor
        ));


        foreach($comando1->fetchAll() as $row){
            $vendedor = $row['id'];
        }

        //Pesquisando a quantidade de vendas do vendedor
        $pesquisaVenda = $conexao->prepare("SELECT vendas FROM vendedores WHERE id = :id");
        $pesquisaVenda->execute(array(
            ':id'=>$vendedor
        ));

        foreach ($pesquisaVenda->fetchAll() as $row){
            $vendas = $row['vendas'];
        }

        //Pesquisa o valor total de vendas do vendedor
        $pesquisaValor = $conexao->prepare("SELECT valor_vendas FROM vendedores WHERE id = :id");
        $pesquisaValor->execute(array(
            ':id'=>$vendedor
        ));

        foreach ($pesquisaValor->fetchAll() as $row){
            $valor_vendas = $row['valor_vendas'];
        }

        //substituindo o cpf pelo id do cliente
        $comando2 = $conexao->prepare("SELECT id FROM clientes WHERE cpf = :cpf");
        $comando2->execute(array(
            ':cpf'=>$cliente
        ));

        foreach($comando2->fetchAll() as $row){
            $cliente = $row['id'];
        }

        //Pesquisando a quantidade de compras do cliente
        $pesquisaCompras = $conexao->prepare("SELECT compras FROM clientes WHERE id = :id");
        $pesquisaCompras->execute(array(
            ':id'=>$cliente
        ));

        foreach ($pesquisaCompras->fetchAll() as $row){
            $compras = $row['compras'];
        }

        //Pesquisando o valor total de compras do cliente
        $pesquisaValCom = $conexao->prepare("SELECT valor_compras FROM clientes WHERE id = :id");
        $pesquisaValCom->execute(array(
            ':id'=>$cliente
        ));

        foreach ($pesquisaValCom->fetchAll() as $row){
            $valor_compras = $row['valor_compras'];
        }

        //substituindo o nome do produto pelo id
        $comando3 = $conexao->prepare("SELECT id FROM produtos WHERE produto = :nome");
        $comando3->execute(array(
            ':nome'=>$produto
        ));


        foreach($comando3->fetchAll() as $row){
            $produto = $row['id'];
        }

        //procurando a quantidade existente do produto
        $comando4 = $conexao->prepare("SELECT quantidade FROM produtos WHERE id = :id");
        $comando4->execute(array(
            ':id'=>$produto
        ));


        foreach($comando4->fetchAll() as $row){
            $total = $row['quantidade'];
        }

        //Verificando se a quantidade inserida existe no estoque
        if ($quantidade > $total){
            echo "<script>alert('A quantidade inserida é maior do que a quantidade existente no estoque!');history.go(-1);</script>";
        } else {
            //Update na quantidade do produto
            $resto = $total - $quantidade;

            $update = $conexao->prepare("UPDATE produtos SET quantidade = :resto WHERE id = :id");
            $update->execute(array(
                ':resto'=>$resto,
                ':id'=>$produto
            ));

            //Update na quantidade e valor total de vendas do vendedor
            $upVendas = $conexao->prepare("UPDATE vendedores SET vendas = :vendas, valor_vendas = :valor WHERE id = :idVend");
            $upVendas->execute(array(
                ':vendas'=>$vendas + 1,
                ':valor'=>$preco + $valor_vendas,
                'idVend'=>$vendedor
            ));

            //Update na quantidade e valor total de compras do cliente
            $upCompras = $conexao->prepare("UPDATE clientes SET compras = :compras, valor_compras = :valor_compras WHERE id = :idCli");
            $upCompras->execute(array(
                ':compras'=>$compras + 1,
                ':valor_compras'=>$preco + $valor_compras,
                'idCli'=>$cliente
            ));

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
                echo "<script>alert('Gravado com sucesso!!');history.go(-2);</script>";
            } else {
                echo "<script>alert('Erro de gravação!!');history.go(-2);</script>;";
            }
        }

        
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }

?>