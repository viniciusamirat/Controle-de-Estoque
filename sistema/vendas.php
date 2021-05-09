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
    <title>Vendas</title>
    <?php
        include_once "php/autenticacao.php";

        include_once "php/conexao.php";
        $venda = $conexao->prepare("SELECT * FROM vendas");
        $venda->execute();

        $resultado1 = $venda->fetchAll();

        $vendedor = $conexao->prepare("SELECT nome, vendedores.id FROM vendedores INNER JOIN vendas ON vendedores.id = vendas.id_vendedor ORDER BY vendas.id;");
        $vendedor->execute();

        $resultado2 = $vendedor->fetchAll();

        $cliente = $conexao->prepare("SELECT nome, clientes.id FROM clientes INNER JOIN vendas ON clientes.id = vendas.id_cliente ORDER BY vendas.id;");
        $cliente->execute();

        $resultado3 = $cliente->fetchAll();

        $produto = $conexao->prepare("SELECT produto FROM produtos INNER JOIN vendas ON produtos.id = vendas.id_produto ORDER BY vendas.id;");
        $produto->execute();

        $resultado4 = $produto->fetchAll();
    ?>
</head>
<body>
    <div class="fundo">
        <div class="topo">
            <div class="right">
                <button type="button" class="btn btn-danger" onclick="window.location.href='php/sair.php'" name="clientes">Sair</button>
            </div>
            <div class="container-fluid centralizar cabecalho">
                <h1>Vendas</h1>
            </div>
            <div class="container-fluid centralizar menu">
                <button type="button" class="btn btn-success" onclick="window.location.href='formVendas.php'" name="vendas">Vender</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='vendas.php'" name="vendas">Vendas</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='clientes.php'" name="clientes">Clientes</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='estoque.php'" name="estoque">Estoque</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='fornecedores.php'" name="fornecedores">Fornecedores</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='vendedores.php'" name="vendedores">Vendedores</button>
            </div>
        </div>
        
        <div class="tabela">
            <table  class="table table-hover">
                <thead>
                    <tr>
                        <th class="esquerda">Vendedor</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preco</th>
                        <th>Data</th>
                        <th class="direita"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                     if ($venda->rowCount() > 0){
                        for ($c = count($resultado1)-1;$c >= 0;$c--){
                            echo "<tr>
                                    <td><a class='nome' href='perfilVendedor.php?id=".$resultado2[$c]['id']."'>".$resultado2[$c]['nome']."</a></td>
                                    <td><a class='nome' href='perfilCliente.php?id=".$resultado3[$c]['id']."'>".$resultado3[$c]['nome']."</a></td>
                                    <td>".$resultado4[$c]['produto']."</td>
                                    <td>".$resultado1[$c]['quantidade']."</td>
                                    <td>R$ ".number_format($resultado1[$c]['preco'], 2, ',', '.')."</td>
                                    <td>".date('d/m/Y', strtotime($resultado1[$c]['data_venda']))."</td>
                                    <td><button class='btn btn-primary btn-sm' ".$_SESSION['btn']." onclick=window.location.href='admin/formEditarVenda.php?id=".$resultado1[$c]['id']."'>Editar</button></td>
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