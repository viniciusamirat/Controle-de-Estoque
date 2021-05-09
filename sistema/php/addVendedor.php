<?php
include_once "autenticacaoAdmin.php";
include_once "conexao.php";

$nome = $_POST['vendedor'];
$cpf = $_POST['cpf'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$foto = $_FILES['foto']['name'];
if ($foto == null){
    $foto1 = "foto.jpg";
} else {
    $foto1 = $cpf."_".$foto;
}
$data = $_POST['data'];



try {
    $pesquisaCpf = $conexao->prepare("SELECT * FROM vendedores WHERE cpf = :cpf");
    $pesquisaCpf->execute(array(
        ':cpf'=>$cpf
    ));

    if ($pesquisaCpf->rowCount() == 1){
        echo "<script>alert('Este CPF já é cadastrado!');history.go(-1);</script>";
    } else {
        $comando = $conexao->prepare("INSERT INTO vendedores (nome, cpf, telefone, email, foto, data_admissao) VALUES (:nome, :cpf, :tel, :email, :foto, :data_admissao);");
        $comando->execute(array(
            ':nome'=>$nome,
            ':cpf'=>$cpf,
            ':tel'=>$tel,
            ':email'=>$email,
            ':foto'=>$foto1,
            ':data_admissao'=>$data
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