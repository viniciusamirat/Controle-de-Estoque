<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Editar Produto</title>
    <?php
        include_once "php/autenticacao.php";

        include_once "php/conexao.php";

        $id = $_GET['id'];
        $_SESSION['produto'] = $id;
        $produto;
        $marca;
        $fornecedorId;
        $fornecedorNome;
        $preco_compra;
        $preco;
        $quantidade;

        try{
            //Pequisa dos nomes de vendedores para as opções de input
            $pesquisa = $conexao->prepare("SELECT nome FROM fornecedores");
            $pesquisa->execute();

            $resuPesquisa = $pesquisa->fetchAll();

            //Pesquisas que colocam os valores que vão ser editados no input

            //Pesquisa o nome do produto
            $pesquisaProduto = $conexao->prepare("SELECT produto FROM produtos WHERE id = :id");
            $pesquisaProduto->execute(array(
                ':id'=>$id
            ));

            foreach($pesquisaProduto->fetchAll() as $row){
                $produto = $row['produto'];
            }

            //Pesquisa a marca do produto
            $pesquisaMarca = $conexao->prepare("SELECT marca FROM produtos WHERE id = :id");
            $pesquisaMarca->execute(array(
                ':id'=>$id
            ));

            foreach($pesquisaMarca->fetchAll() as $row){
                $marca = $row['marca'];
            }

            //pesquisa o id do fornecedor
            $pesquisaFornecedorId = $conexao->prepare("SELECT fornecedor FROM produtos WHERE id = :id");
            $pesquisaFornecedorId->execute(array(
                ':id'=>$id
            ));

            foreach($pesquisaFornecedorId->fetchAll() as $row){
                $fornecedorId = $row['fornecedor'];
            }

            //pesquisa o nome do fornecedor
            $pesquisaFornecedorNome = $conexao->prepare("SELECT nome FROM fornecedores WHERE id = :id");
            $pesquisaFornecedorNome->execute(array(
                ':id'=>$fornecedorId
            ));

            foreach ($pesquisaFornecedorNome->fetchAll() as $row){
                $fornecedorNome = $row['nome'];
            }
            //Pesquisa o preço da compra
            $pesquisaCompra = $conexao->prepare("SELECT preco_compra FROM produtos WHERE id = :id");
            $pesquisaCompra->execute(array(
                ':id'=>$id
            ));

            foreach($pesquisaCompra->fetchAll() as $row){
                $preco_compra = $row['preco_compra'];
            }

            //Pesquisa o preço de venda do produto
            $pesquisaPreco = $conexao->prepare("SELECT preco FROM produtos WHERE id = :id");
            $pesquisaPreco->execute(array(
                ':id'=>$id
            ));

            foreach($pesquisaPreco->fetchAll() as $row){
                $preco = $row['preco'];
            }

            //Pesquisa a quantidade em estoque do produto
            $pesquisaQuantidade = $conexao->prepare("SELECT quantidade FROM produtos WHERE id = :id");
            $pesquisaQuantidade->execute(array(
                ':id'=>$id
            ));

            foreach($pesquisaQuantidade->fetchAll() as $row){
                $quantidade = $row['quantidade'];
            }
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    ?>
</head>
<body>
    <div>
        <div class="right">
            <button type="button" class="btn btn-danger" onclick="window.location.href='php/sair.php'" name="clientes">Sair</button>
        </div>
        <div class="container-fluid centralizar cabecalho">
            <h1>Editar Produto</h1>
        </div>
        <div class="container-fluid centralizar">
            <button type="button" class="btn btn-primary" onclick="window.location.href='estoque.php'" name="estoque">Estoque</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='vendas.php'" name="vendas">Vendas</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='vendedores.php'" name="vendedores">Vendedores</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='clientes.php'" name="clientes">Clientes</button>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Mais
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="formProdutos.php">Adicionar Produto</a>
                  <a class="dropdown-item" href="formVendas.php">Adicionar Venda</a>
                  <a class="dropdown-item" href="formVendedores.php">Adicionar Vendedor</a>
                  <a class="dropdown-item" href="formClientes.php">Adicionar Cliente</a>
                </div>
            </div>
        </div>
        <div class="formulario">
        <form action="php/updateProduto.php" method="POST">
                <input class="input-group" type="text" name="produto" <?php echo "value='$produto'"?> placeholder="Nome do Produto" maxlength="100" required><br>
                <input class="input-group" type="text" name="marca" <?php echo "value='$marca'"?> placeholder="Marca" maxlength="50" required><br>
                <input class="input-group" list="lista" type="text" name="fornecedor "<?php echo "value='$fornecedorNome'"?> placeholder="Fornecedor" maxlength="100" required><br>
                    <datalist id="lista">
                        <?php
                            foreach ($resuPesquisa as $row){
                                echo "<option value='".$row['nome']."'>";
                            }
                        ?>
                    </datalist>
                <input class="input-group" type="number" step="0.01" name="preco_compra" <?php echo "value='$preco_compra'"?> placeholder="Preço da compra" required><br>
                <input class="input-group" type="number" step="0.01" name="preco" <?php echo "value='$preco'"?> min=0 placeholder="Preço de venda" required><br>
                <input class="input-group" type="number" name="quantidade" <?php echo "value='$quantidade'"?> min=1 placeholder="Quantidade em estoque" required><br>
                <input type="button" onclick="window.location.href='estoque.php'" value="Cancelar" class="btn btn-danger">
                <input type="submit" value="Aplicar mudanças" class="btn btn-primary">
            </form>
        </div>
    </div>
</body>
</html>