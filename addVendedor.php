<?php
include_once "conexao.php";

$nome = $_POST['vendedor'];
$cpf = $_POST['cpf'];
$tel = $_POST['tel'];

try {
    $comando = $conexao->prepare("INSERT INTO vendedores (nome, cpf, telefone) VALUES (:nome, :cpf, :tel);");
    $comando->execute(array(
        ':nome'=>$nome,
        ':cpf'=>$cpf,
        ':tel'=>$tel
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