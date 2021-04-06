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
        //substituindo o cpf pelo id
        $comando1 = $conexao->prepare("SELECT id FROM vendedores WHERE cpf = '$vendedor'");
        $comando1->execute();

        echo $comando1->rowCount();

        foreach($comando1 as $row){
            $vendedor = $row['id'];
        }

        //substituindo o cpf pelo id
        $comando2 = $conexao->prepare("SELECT id FROM clientes WHERE cpf = '$cliente'");
        $comando2->execute();

        echo $comando2->rowCount();

        foreach($comando2 as $row){
            $cliente = $row['id'];
        }

        //substituindo o nome do produto pelo id
        $comando3 = $conexao->prepare("SELECT id, quantidade FROM produtos WHERE produto = '$produto'");
        $comando3->execute();

        echo $comando3->rowCount();

        foreach($comando3 as $row){
            $produto = $row['id'];
            $total = $row['quantidade']
        }

        //$quantidade = $total - $quantidade;

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

        //Update na quantidade do produto
        //$update = $conexao->prepare("UPDATE")
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }

?>