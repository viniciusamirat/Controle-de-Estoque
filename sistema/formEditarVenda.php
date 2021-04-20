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
    <title>Editar Venda</title>
    <?php
        include_once "php/autenticacao.php";

        include_once "php/conexao.php";

        $id = $_GET['id'];
        $_SESSION['venda'] = $id;
        $cpfVendedor;
        $cpfCliente;
        $nomeProduto;
        $quantidade;
        $preco;

        try{
            $idVendedor = 0;
            $idCliente = 0;
            $idProduto = 0;

            //Pesquisas para as opções de input
            $vendedores = $conexao->prepare("SELECT cpf FROM vendedores");
            $vendedores->execute();

            $resuVendedor = $vendedores->fetchAll();


            $clientes = $conexao->prepare("SELECT cpf FROM clientes");
            $clientes->execute();

            $resuCliente = $clientes->fetchAll();


            $produtos = $conexao->prepare("SELECT produto FROM produtos");
            $produtos->execute();

            $resuProduto = $produtos->fetchAll();

            
            //Pesquisas que colocam os valores que vão ser editados no input

            //Pegando o cpf do vendedor
            $pesquisaIdVendedor = $conexao->prepare("SELECT id_vendedor FROM vendas WHERE id = :id");
            $pesquisaIdVendedor->execute(array(
                ':id'=>$id
            ));

            foreach ($pesquisaIdVendedor->fetchAll() as $row){
                $idVendedor = $row['id_vendedor'];//Econtra o id do vendedor
            }

            $pesquisaCpfVendedor = $conexao->prepare("SELECT cpf FROM vendedores WHERE id = :id");
            $pesquisaCpfVendedor->execute(array(
                ':id'=>$idVendedor
            ));

            foreach ($pesquisaCpfVendedor->fetchAll() as $row){
                $cpfVendedor = $row['cpf'];//Encontra o cpf do vendedor
            }

            //Pegando o cpf do cliente
            $pesquisaIdCliente = $conexao->prepare("SELECT id_cliente FROM vendas WHERE id = :id");
            $pesquisaIdCliente->execute(array(
                ':id'=>$id
            ));

            foreach ($pesquisaIdCliente->fetchAll() as $row){
                $idCliente = $row['id_cliente'];//Econtra o id do cliente
            }

            $pesquisaCpfcliente = $conexao->prepare("SELECT cpf FROM clientes WHERE id = :id");
            $pesquisaCpfcliente->execute(array(
                ':id'=>$idCliente
            ));

            foreach ($pesquisaCpfcliente->fetchAll() as $row){
                $cpfCliente = $row['cpf'];//Encontra o cpf do cliente
            }

            //Pegando o nome do produto
            $pesquisaIdProduto = $conexao->prepare("SELECT id_produto FROM vendas WHERE id = :id");
            $pesquisaIdProduto->execute(array(
                ':id'=>$id
            ));

            foreach ($pesquisaIdProduto->fetchAll() as $row){
                $idProduto = $row['id_produto'];//Econtra o id do produto
            }

            $pesquisaNomeProduto = $conexao->prepare("SELECT produto FROM produtos WHERE id = :id");
            $pesquisaNomeProduto->execute(array(
                ':id'=>$idProduto
            ));

            foreach ($pesquisaNomeProduto->fetchAll() as $row){
                $nomeProduto = $row['produto'];//Encontra o nome do produto
            }

            //Pesquisa a quantidade do produto registrada na venda
            $pesquisaQuantidade = $conexao->prepare("SELECT quantidade FROM vendas WHERE id = :id");
            $pesquisaQuantidade->execute(array(
                ':id'=>$id
            ));

            foreach($pesquisaQuantidade->fetchAll() as $row){
                $quantidade = $row['quantidade'];
            }

            //Pesquisa o preço registrado na venda
            $pesquisaPreco = $conexao->prepare("SELECT preco FROM vendas WHERE id = :id");
            $pesquisaPreco->execute(array(
                ':id'=>$id
            ));

            foreach($pesquisaPreco->fetchAll() as $row){
                $preco = $row['preco'];
            }
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    ?>
</head>
<body>
    <div>
        <div class="container-fluid centralizar cabecalho">
            <h1>Editar Venda</h1>
        </div>
        <div class="container-fluid centralizar">
            <button type="button" class="btn btn-success" onclick="window.location.href='estoque.php'" name="estoque">Estoque</button>
            <button type="button" class="btn btn-success" onclick="window.location.href='vendas.php'" name="vendas">Vendas</button>
            <button type="button" class="btn btn-success" onclick="window.location.href='vendedores.php'" name="vendedores">Vendedores</button>
            <button type="button" class="btn btn-success" onclick="window.location.href='clientes.php'" name="clientes">Clientes</button>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn btn-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Mais
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="formProdutos.php">Adicionar Produto</a>
                  <a class="dropdown-item" href="formVendas.php">Adicionar Venda</a>
                  <a class="dropdown-item" href="formVendedores.php">Adicionar Vendedor</a>
                  <a class="dropdown-item" href="formClientes.php">Adicionar Cliente</a>
                </div>
            </div>
            <button type="button" class="btn btn-danger" onclick="window.location.href='php/sair.php'" name="clientes">Sair</button>
        </div>
        <div class="formulario">
            <form method="POST" action="php/updateVenda.php">
                <input class="input-group" list="browsers1" name="vendedor" <?php echo "value='$cpfVendedor'"?> placeholder="CPF do Vendedor" required><br>
                    <datalist id="browsers1">
                        <?php
                            foreach ($resuVendedor as $row){
                                echo "<option value='".$row['cpf']."'>";
                            }
                        ?>
                    </datalist>
                <input class="input-group" list="browsers2" name="cliente" <?php echo "value='$cpfCliente'"?> placeholder="CPF do Cliente" required><br>
                    <datalist id="browsers2">
                        <?php
                            foreach ($resuCliente as $row){
                                echo "<option value='".$row['cpf']."'>";
                            }
                        ?>
                    </datalist>
                <input class="input-group" list="browsers3" name="produto" <?php echo "value='$nomeProduto'"?> placeholder="Produto" required><br>
                    <datalist id="browsers3">
                         <?php
                            foreach ($resuProduto as $row){
                                echo "<option value='".$row['produto']."'>";
                            }
                        ?>
                    </datalist>
                
                <input class="input-group" type="number" name="quantidade" min=1 <?php echo "value='$quantidade'"?> placeholder="Quantidade" required><br>
                <input class="input-group" type="number" step="0.01" min=0 name="preco" <?php echo "value='$preco'"?> placeholder="Preço" required><br>
                <input type="button" onclick="window.location.href='vendas.php'" value="Cancelar" class="btn btn-danger">
                <input type="submit" value="Aplicar mudanças" class="btn btn-success">
            </form>
        </div>
    </div>
</body>
</html>