<?php
include_once "conexao.php";

$nome = $_POST['cliente'];
$cpf = $_POST['cpf'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$foto = $_FILES['foto']['name'];
$foto1 = $cpf."_".$foto;
$data = $_POST['data'];
try {
    $pesquisaCpf = $conexao->prepare("SELECT * FROM clientes WHERE cpf = :cpf");
    $pesquisaCpf->execute(array(
        ':cpf'=>$cpf
    ));

    if ($pesquisaCpf->rowCount() == 1){
        echo "<script>alert('Este CPF já é cadastrado!');history.go(-1);</script>";
    } else {
        $comando = $conexao->prepare("INSERT INTO clientes (nome, cpf, telefone, email, foto, data_cadastro) VALUES (:nome, :cpf, :tel, :email, :foto, :data_cadastro);");
        $comando->execute(array(
            ':nome'=>$nome,
            ':cpf'=>$cpf,
            ':tel'=>$tel,
            ':email'=>$email,
            ':foto'=>$foto1,
            ':data_cadastro'=>$data
        ));

        //Upload da foto
        $uploaddir = "../imagens/";
        $uploadfile = $uploaddir . basename($foto1);
        move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);

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