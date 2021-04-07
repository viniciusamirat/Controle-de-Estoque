<?php
include_once "conexao.php";

$produto = $_POST['produto'];
$marca = $_POST['marca'];
$preco = $_POST['preco'];
$quantiade = $_POST['quantidade'];

try {
    $comando = $conexao->prepare("INSERT INTO produtos (produto, marca, preco, quantidade) VALUES (:produto, :marca, :preco, :quantidade);");
    $comando->execute(array(
        ':produto'=>$produto,
        ':marca'=>$marca,
        ':preco'=>$preco,
        ':quantidade'=>$quantiade
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