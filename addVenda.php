<?php
    include_once "conexao.php";

    $vendedor = $_POST['vendedor'];
    $cliente = $_POST['cliente'];
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $data = $_POST['data'];

    try {
        $comando = $conexao->prepare("INSERT INTO vendas (id_vendedor, id_cliente, id_produto, quantidade, preco, data_venda) VALUES (:vendedor, :cliente, :produto, :quantidade, :preco, :data_venda);");
        $comando->execute(array(
            ':vendedor'=>$vendedor,
            ':cliente'=>$cliente,
            ':produto'=>$produto,
            ':quantidade'=>$quantidade,
            ':preco'=>$preco,
            ':data_venda'=>$data
        ));

        if ($comando->rowCount() == 1){
            echo "<script>alert('Gravado com sucesso!!');history.go(-1);</script>";
        } else {
            echo "<script>alert('Erro de gravação!!');history.go(-1);</script>;";
        }
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }


?>