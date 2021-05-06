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
        <div class="botoes">
            <div class="voltar">
                <button class="btn btn-primary" onclick="history.go(-1)">Retornar</button>
            </div>
            <div class="sair">
                <button type="button" class="btn btn-danger" onclick="window.location.href='php/sair.php'" name="clientes">Sair</button>
            </div>
        </div>
        <div class="container-fluid centralizar cabecalho">
            <h1>Adicionar Venda</h1>
        </div>
        <div class="container-fluid centralizar">
            <button type="button" class="btn btn-primary" onclick="window.location.href='estoque.php'" name="estoque">Estoque</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='vendas.php'" name="vendas">Vendas</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='vendedores.php'" name="vendedores">Vendedores</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='clientes.php'" name="clientes">Clientes</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='fornecedores.php'" name="fornecedores">Fornecedores</button>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Mais
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="formProdutos.php">Adicionar Produto</a>
                  <a class="dropdown-item" href="formVendas.php">Adicionar Venda</a>
                  <a class="dropdown-item" href="formVendedores.php">Adicionar Vendedor</a>
                  <a class="dropdown-item" href="formClientes.php">Adicionar Cliente</a>
                  <a class="dropdown-item" href="formFornecedores.php">Adicionar Fornecedor</a>
                </div>
            </div>
        </div>
        <div class="formulario">
            <form method="POST" action="php/addVenda.php">
                <label class="rotulo" for="vendedor"><strong>CPF do vendedor:</strong></label>
                <input class="input-group" id="vendedor" list="browsers1" name="vendedor" required autofocus><br>
                    <datalist id="browsers1">
                        <?php
                            foreach ($resuVendedor as $row){
                                echo "<option value='".$row['cpf']."'>";
                            }
                        ?>
                    </datalist>
                <label class="rotulo" for="cliente"><strong>CPF do cliente:</strong></label>
                <input class="input-group" id="cliente" list="browsers2" name="cliente" required><br>
                    <datalist id="browsers2">
                        <?php
                            foreach ($resuCliente as $row){
                                echo "<option value='".$row['cpf']."'>";
                            }
                        ?>
                    </datalist>
                <label class="rotulo" for="produto"><strong>Produto:</strong></label>
                <input class="input-group" id="produto" list="browsers3" name="produto" required><br>
                    <datalist id="browsers3">
                         <?php
                            foreach ($resuProduto as $row){
                                echo "<option value='".$row['produto']."'>";
                            }
                        ?>
                    </datalist>
                
                <label class="rotulo" for="quantidade"><strong>Quantidade:</strong></label>
                <input class="input-group" id="quantidade" type="number" name="quantidade" min=1 required><br>
                <label class="rotulo" for="preco"><strong>Preço:</strong></label>
                <input class="input-group" id="preco" type="number" step="0.01" min=0 name="preco" required><br>
                <label class="rotulo" for="data"><strong>Data da venda:</strong></label>
                <input class="input-group" id="data" type="date" name="data" required><br>
                <div class="rodape">
                    <div class="limpar">
                        <input type="reset" value="Limpar" class="btn btn-danger">
                    </div>
                    <div class="adicionar">
                        <input type="submit" value="Adicionar" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>