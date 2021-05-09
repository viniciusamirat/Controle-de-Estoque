<?php
    include_once "autenticacaoAdmin.php";
    include_once "conexao.php";

    $id = $_GET['id'];

    try{
        //exclusão do resgistro de venda
        $excluir = $conexao->prepare("DELETE FROM vendas WHERE id = :id");
        $excluir->execute(array(
            ':id'=>$id
        ));

        if ($excluir->rowCount() == 1){
            echo "<script>alert('Excluido com sucesso!');history.go(-2);</script>";
        } else {
            echo "<script>alert('Erro ao excluir registro!');history.go(-1);</script>";
        }
    } catch (PDOException $e){
        echo "Error: ". $e->getMessage();
    }

?>