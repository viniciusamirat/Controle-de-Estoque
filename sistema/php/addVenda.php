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
        $comando1 = $conexao->prepare("SELECT id FROM vendedores WHERE cpf = :cpf");
        $comando1->execute(array(
            ':cpf'=>$vendedor
        ));

        //$resu1 = $comando1->fetchAll();

        foreach($comando1->fetchAll() as $row){
            $vendedor = $row['id'];
        }

        //substituindo o cpf pelo id do cliente
        $comando2 = $conexao->prepare("SELECT id FROM clientes WHERE cpf = :cpf");
        $comando2->execute(array(
            ':cpf'=>$cliente
        ));

        //$resu2 = $comando2->fetchAll();

        foreach($comando2->fetchAll() as $row){
            $cliente = $row['id'];
        }

        //substituindo o nome do produto pelo id
        $comando3 = $conexao->prepare("SELECT id FROM produtos WHERE produto = :nome");
        $comando3->execute(array(
            ':nome'=>$produto
        ));

        //$resu3 = $comando3->fetchAll();

        foreach($comando3->fetchAll() as $row){
            $produto = $row['id'];
        }

        //procurando a quantidade existente do produto
        $comando4 = $conexao->prepare("SELECT quantidade FROM produtos WHERE id = :id");
        $comando4->execute(array(
            ':id'=>$produto
        ));

        //$resu4 = $comando4->fetchAll();

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