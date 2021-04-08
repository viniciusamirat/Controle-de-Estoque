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
    <title>Adicionar Cliente</title>
    <?php
        include_once "php/autenticacao.php";
    ?>
</head>
<body>
    <div>
        <div class="container-fluid centralizar cabecalho">
            <h1>Adicionar Cliente</h1>
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
        <div class="formulario">
            <form action="addCliente.php" method="POST">
                <input class="input-group" type="text" name="cliente" placeholder="Nome do Cliente" maxlength="100" required><br>
                <input class="input-group" type="text" name="cpf" placeholder="CPF" maxlength="14" required><br>
                <input class="input-group" type="text" name="tel" placeholder="Telefone" maxlength="15" required><br>
                <input type="reset" value="Limpar" class="btn btn-danger">
                <input type="submit" value="Adicionar" class="btn btn-success">
            </form>
        </div>
    </div>
</body>
</html>