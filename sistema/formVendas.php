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
    <title>Adicionar Venda</title>
    <?php
        include_once "php/autenticacao.php";

        include_once "php/conexao.php";

        try{
            //Pesquisas para serem listadas no input

            //Pesquisa o cpf dos vendedores
            $vendedores = $conexao->prepare("SELECT cpf FROM vendedores");
            $vendedores->execute();

            $resuVendedor = $vendedores->fetchAll();

            //Pesquisa o cpf dos clientes
            $clientes = $conexao->prepare("SELECT cpf FROM clientes");
            $clientes->execute();

            $resuCliente = $clientes->fetchAll();

            //Pesquisa o nome dos produtos
            $produtos = $conexao->prepare("SELECT produto FROM produtos");
            $produtos->execute();

            $resuProduto = $produtos->fetchAll();
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
            <h1>Adicionar Venda</h1>
        </div>
        <div class="container-fluid centralizar">
            <button type="button" class="btn btn-primary" onclick="window.location.href='estoque.php'" name="estoque">Estoque</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='vendas.php'" name="vendas">Vendas</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='vendedores.php'" name="vendedores">Vendedores</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='clientes.php'" name="clientes">Clientes</button>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <form method="POST" action="php/addVenda.php">
                <input class="input-group" list="browsers1" name="vendedor" placeholder="CPF do Vendedor" required autofocus><br>
                    <datalist id="browsers1">
                        <?php
                            foreach ($resuVendedor as $row){
                                echo "<option value='".$row['cpf']."'>";
                            }
                        ?>
                    </datalist>
                <input class="input-group" list="browsers2" name="cliente" placeholder="CPF do Cliente" required><br>
                    <datalist id="browsers2">
                        <?php
                            foreach ($resuCliente as $row){
                                echo "<option value='".$row['cpf']."'>";
                            }
                        ?>
                    </datalist>
                <input class="input-group" list="browsers3" name="produto" placeholder="Produto" required><br>
                    <datalist id="browsers3">
                         <?php
                            foreach ($resuProduto as $row){
                                echo "<option value='".$row['produto']."'>";
                            }
                        ?>
                    </datalist>
                
                <input class="input-group" type="number" name="quantidade" min=1 placeholder="Quantidade" required><br>
                <input class="input-group" type="number" step="0.01" min=0 name="preco" placeholder="Preço" required><br>
                <input class="input-group" type="date" name="data" placeholder="Data da venda" required><br>
                <input type="reset" value="Limpar" class="btn btn-danger">
                <input type="submit" value="Adicionar" class="btn btn-primary">
            </form>
        </div>
    </div>
</body>
</html>