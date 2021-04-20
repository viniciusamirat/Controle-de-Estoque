<?php
include_once "conexao.php";

$produto = $_POST['produto'];
$marca = $_POST['marca'];
$preco = $_POST['preco'];
$quantiade = $_POST['quantidade'];

try {
    $pesquisa = $conexao->prepare("SELECT produto FROM produtos WHERE produto = :produto");
    $pesquisa->execute(array(
        ':produto'=>$produto
    ));

    if ($pesquisa->rowCount() > 0){
        echo "<script>alert('Insira o nome de um produto que não exista!');history.go(-1);</script>";

    } else {
        $comando = $conexao->prepare("INSERT INTO produtos (produto, marca, preco, quantidade) VALUES (:produto, :marca, :preco, :quantidade);");
        $comando->execute(array(
            ':produto'=>$produto,
            ':marca'=>$marca,
            ':preco'=>$preco,
            ':quantidade'=>$quantiade
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