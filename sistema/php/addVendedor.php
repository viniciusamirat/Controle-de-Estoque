<?php
include_once "conexao.php";

$nome = $_POST['vendedor'];
$cpf = $_POST['cpf'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$data = $_POST['data'];

try {
    $pesquisaCpf = $conexao->prepare("SELECT * FROM vendedores WHERE cpf = :cpf");
    $pesquisaCpf->execute(array(
        ':cpf'=>$cpf
    ));

    if ($pesquisaCpf->rowCount() == 1){
        echo "<script>alert('Este CPF já é cadastrado!');history.go(-1);</script>";
    } else {
        $comando = $conexao->prepare("INSERT INTO vendedores (nome, cpf, telefone, email, data_admissao) VALUES (:nome, :cpf, :tel, :email, :data_admissao);");
        $comando->execute(array(
            ':nome'=>$nome,
            ':cpf'=>$cpf,
            ':tel'=>$tel,
            ':email'=>$email,
            ':data_admissao'=>$data
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