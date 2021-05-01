<?php
    include_once "conexao.php";

    $id = $_GET['id'];

    try{ 
        $comando = $conexao->prepare("DELETE FROM vendedores WHERE id = :id;");
        $comando->execute(array(
            ':id'=>$id
        ));

        if ($comando->rowCount() == 1){
            echo "<script>alert('Excluido com sucesso!');history.go(-2);</script>";
        } else {
            echo "<script>alert('Erro ao excluir registro!');history.go(-1);</script>";
        }
    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }


?>