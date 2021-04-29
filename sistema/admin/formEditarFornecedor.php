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
    <title>Editar Fornecedor</title>
    <?php
        include_once "php/autenticacao.php";

        include_once "php/conexao.php";

        $id = $_GET['id'];
        $_SESSION['editar'] = $id;
        $nome;
        $produtos;
        $email;
        $tel;

        try{
            //Pesquisa as informações da pessoa para colocar os valores no input
            $comando = $conexao->prepare("SELECT * FROM fornecedores WHERE id = :id");
            $comando->execute(array(
                ':id'=>$id
            ));

            foreach ($comando->fetchAll() as $row){
                $nome = $row['nome'];
                $produtos = $row['produtos'];
                $email = $row['email'];
                $tel = $row['telefone'];
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
            <h1>Editar Fornecedor</h1>
        </div>
        <div class="container-fluid centralizar">
            <button type="button" class="btn btn-primary" onclick="window.location.href='estoque.php'" name="estoque">Estoque</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='vendas.php'" name="vendas">Vendas</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='vendedores.php'" name="vendedores">Vendedores</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='clientes.php'" name="clientes">Clientes</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='fornecedores.php'" name="fornecedores">Fornecedores</button>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <form action="php/updateFornecedor.php" method="POST">
                <label class="rotulo" for="fornecedor"><strong>Nome do fornecedor:</strong></label>
                <input class="input-group" type="text" id="fornecedor" name="fornecedor" <?php echo "value='$nome'"?> maxlength="100" required autofocus><br>
                <label class="rotulo" for="produtos"><strong>Produtos fornecidos:</strong></label>
                <input class="input-group" type="text" id="produtos" name="produtos" <?php echo "value='$produtos'"?> maxlength="1000" required><br>
                <label class="rotulo" for="email"><strong>Email do fornecedor:</strong></label>
                <input class="input-group" type="text" id="email" name="email" <?php echo "value='$email'"?> maxlength="100" required><br>
                <label class="rotulo" for="tel"><strong>Telefone do fornecedor:</strong></label>
                <input class="input-group" type="text" id="tel" name="tel" <?php echo "value='$tel'"?> maxlength="15" required><br>
                <input type="button" onclick="window.location.href='fornecedores.php'" value="Cancelar" class="btn btn-danger">
                <input type="submit" value="Aplicar mudanças" class="btn btn-primary">
            </form>
        </div>
    </div>
</body>
</html>