<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Estoque</title>
    <?php
        include_once "php/autenticacao.php";

        include_once "php/conexao.php";
        //Pesquisa o registro do produto
        $estoque = $conexao->prepare("SELECT * FROM produtos");
        $estoque->execute();

        $resultado1 = $estoque->fetchAll();

        //Pesquisa o nome do fornecedor
        $fornecedor = $conexao->prepare("SELECT nome FROM fornecedores INNER JOIN produtos ON fornecedores.id = produtos.fornecedor ORDER BY produtos.id");
        $fornecedor->execute();

        $resultado2 = $fornecedor->fetchAll();
    ?>
</head>
<body>
    <div>
        <div class="right">
            Logado como <strong><?php echo $_SESSION['usuario']?></strong>
            
            <button type="button" class="btn btn-danger" onclick="window.location.href='php/sair.php'" name="clientes">Sair</button>
        </div>
        <div class="container-fluid centralizar cabecalho">
            <h1>Estoque</h1>
        </div>
        <div class="container-fluid centralizar">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='estoque.php'" name="estoque">Estoque</button>
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

        <div class="tabela">
            <table  class="table table-hover">
                <thead>
                    <tr>
                        <th class="esquerda">Produto</th>
                        <th>Marca</th>
                        <th>Preço</th>
                        <th>Fornecedor</th>
                        <th>Quantidade em estoque</th>
                        <th></th>
                        <th class="direita"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($estoque->rowCount() > 0){
                        for ($c = count($resultado1)-1; $c >= 0; $c--){
                            echo "<tr>
                                    <td>".$resultado1[$c]['produto']."</td>
                                    <td>".$resultado1[$c]['marca']."</td>
                                    <td>R$ ".$resultado1[$c]['preco']."</td>
                                    <td>".$resultado2[$c]['nome']."</td>
                                    <td>".$resultado1[$c]['quantidade']."</td>
                                    <td><a href='formEditarProduto.php?id=".$resultado1[$c]['id']."'>Editar</a></td>
                                    <td><a href='php/excluirProduto.php?id=".$resultado1[$c]['id']."'>Excluir</a></td>
                                </tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>