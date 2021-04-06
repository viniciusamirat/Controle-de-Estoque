<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Vendas</title>
    <?php
        include_once "autenticacao.php";

        include_once "conexao.php";
        $venda = $conexao->prepare("SELECT * FROM vendas");
        $venda->execute();

        $resultado1 = $venda->fetchAll();

        $vendedor = $conexao->prepare("SELECT nome FROM vendas INNER JOIN vendedores ON vendas.id_vendedor = vendedores.id;");
        $vendedor->execute();

        $resultado2 = $vendedor->fetchAll();

        $cliente = $conexao->prepare("SELECT nome FROM vendas INNER JOIN clientes ON vendas.id_vendedor = clientes.id;");
        $cliente->execute();

        $resultado3 = $cliente->fetchAll();

        $produto = $conexao->prepare("SELECT produto FROM vendas INNER JOIN produtos ON vendas.id_vendedor = produtos.id;");
        $produto->execute();

        $resultado4 = $produto->fetchAll();
    ?>
</head>
<body>
    <div>
        <div class="container-fluid centralizar cabecalho">
            <h1>Vendas</h1>
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
                  <a class="dropdown-item" href="formProdutos.php">Adicionar Produtos</a>
                  <a class="dropdown-item" href="formVendas.php">Adicionar Vendas</a>
                  <a class="dropdown-item" href="formVendedores.php">Adicionar Vendedores</a>
                  <a class="dropdown-item" href="formClientes.php">Adicionar Clientes</a>
                </div>
            </div>
            <button type="button" class="btn btn-danger" onclick="window.location.href='sair.php'" name="clientes">Sair</button>
        </div>
        <div class="tabela">
            <table  class="table table-hover">
                <thead>
                    <tr>
                        <th>Vendedor</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preco</th>
                        <th>Data</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                     if ($venda->rowCount() > 0){
                        for ($c = 0;$c < count($resultado1);$c++){
                            echo "<tr>
                                    <td>".$resultado2[$c]['nome']."</td>
                                    <td>".$resultado3[$c]['nome']."</td>
                                    <td>".$resultado4[$c]['produto']."</td>
                                    <td>".$resultado1[$c]['quantidade']."</td>
                                    <td>R$ ".$resultado1[$c]['preco']."</td>
                                    <td>".$resultado1[$c]['data_venda']."</td>
                                    <td><a href='excluirVenda.php?id=".$resultado1[$c]['id']."'>Excluir</a></td>
                                </tr>";
                        }
                    }



/*
                    if ($venda->rowCount() > 0){
                        foreach ($resultado1 as $row){
                            echo "<tr>
                                    <td>".$row['id_vendedor']."</td>
                                    <td>".$row['id_cliente']."</td>
                                    <td>".$row['id_produto']."</td>
                                    <td>".$row['quantidade']."</td>
                                    <td>R$ ".$row['preco']."</td>
                                    <td>".$row['data_venda']."</td>
                                </tr>";
                        }
                    }*/
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>