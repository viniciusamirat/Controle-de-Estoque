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
    <title>Adicionar Fornecedor</title>
    <?php
        include_once "php/autenticacao.php";
    ?>
</head>
<body>
    <div>
        <div class="right">
            <button type="button" class="btn btn-danger" onclick="window.location.href='php/sair.php'" name="clientes">Sair</button>
        </div>
        <div class="container-fluid centralizar cabecalho">
            <h1>Adicionar Fornecedor</h1>
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
            <form action="php/addFornecedor.php" method="POST">
                <label class="rotulo" for="fornecedor"><strong>Nome do fornecedor:</strong></label>
                <input class="input-group" type="text" id="fornecedor" name="fornecedor" maxlength="100" required autofocus><br>
                <label class="rotulo" for="produtos"><strong>Produtos fornecidos:</strong></label>
                <input class="input-group" type="text" id="produtos" name="produtos" maxlength="1000" required><br>
                <label class="rotulo" for="email"><strong>Email do fornecedor:</strong></label>
                <input class="input-group" type="text" id="email" name="email" maxlength="100" required><br>
                <label class="rotulo" for="tel"><strong>Telefone do fornecedor:</strong></label>
                <input class="input-group" type="text" id="tel" name="tel" maxlength="15" required><br>
                <label class="rotulo" for="data"><strong>Data de cadastro:</strong></label>
                <input class="input-group" type="date" id="data" name="data" required><br>
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