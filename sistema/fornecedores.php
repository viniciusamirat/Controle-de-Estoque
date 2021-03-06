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
    <title>Fornecedores</title>
    <?php
        include_once "php/autenticacao.php";

        include_once "php/conexao.php";

        $comando = $conexao->prepare("SELECT * FROM fornecedores;");
        $comando->execute();

        $resultado = $comando->fetchAll();

    ?>
</head>
<body>
    <div class="fundo">
        <div class="topo">
            <div class="right">
                <button type="button" class="btn btn-danger" onclick="window.location.href='php/sair.php'" name="clientes">Sair</button>
            </div>
            <div class="container-fluid centralizar cabecalho">
                <h1>Fornecedores</h1>
            </div>
            <div class="container-fluid centralizar menu">
                <button type="button" class="btn btn-success" onclick="window.location.href='formVendas.php'" name="vendas">Vender</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='vendas.php'" name="vendas">Vendas</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='clientes.php'" name="clientes">Clientes</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='estoque.php'" name="estoque">Estoque</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='fornecedores.php'" name="fornecedores">Fornecedores</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='vendedores.php'" name="vendedores">Vendedores</button>
            </div>
        </div>
        
        <div class="tabela">
            <table  class="table table-hover">
                <thead>
                    <tr>
                        <th class="esquerda">Nome</th>
                        <th>Produtos</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Cadastro</th>
                        <th class="direita"><button class="btn btn-light btn-sm" <?php echo $_SESSION['btn']; ?> onclick="window.location.href='formFornecedores.php'">Novo+</button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($comando->rowCount() > 0){
                            for ($c = count($resultado)-1; $c >= 0; $c--){
                                echo "<tr>
                                        <td>".$resultado[$c]['nome']."</td>
                                        <td>".$resultado[$c]['produtos']."</td>
                                        <td>".$resultado[$c]['email']."</td>
                                        <td>".$resultado[$c]['telefone']."</td>
                                        <td>".date('d/m/Y', strtotime($resultado[$c]['data_cadastro']))."</td>
                                        <td><button class='btn btn-primary btn-sm' onclick=window.location.href='perfilFornecedor.php?id=".$resultado[$c]['id']."'>Mais</button></td>
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