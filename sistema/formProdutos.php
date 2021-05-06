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
    <title>Adicionar Produto</title>
    <?php
        include_once "php/autenticacao.php";
        include_once "php/conexao.php";

        try {
            //Pesquisa o nome dos fornecedores
            $fornecedor = $conexao->prepare("SELECT nome FROM fornecedores");
            $fornecedor->execute();
            $resultado = $fornecedor->fetchAll();
        } catch (PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    ?>
</head>
<body>
    <div>
        <div class="topo">
            <div class="botoes">
                <div class="voltar">
                    <button class="btn btn-primary" onclick="history.go(-1)">Retornar</button>
                </div>
                <div class="sair">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='php/sair.php'" name="clientes">Sair</button>
                </div>
            </div>
            <div class="container-fluid centralizar cabecalho">
                <h1>Adicionar Produto</h1>
            </div>
        </div>
        <div class="formulario">
            <form action="php/addProduto.php" method="POST">
                <label class="rotulo" for="produto"><strong>Nome do produto:</strong></label>
                <input class="input-group" id="produto" type="text" name="produto" maxlength="100" required autofocus><br>
                <label class="rotulo" for="marca"><strong>Marca:</strong></label>
                <input class="input-group" id="marca" type="text" name="marca" maxlength="50" required><br>
                <label class="rotulo" for="fornecedor"><strong>Fornecedor:</strong></label>
                <input class="input-group" id="fornecedor" type="text" list="lista" name="fornecedor" required><br>
                    <datalist id="lista">
                        <?php
                            foreach ($resultado as $row){
                                echo "<option value='".$row['nome']."'>";
                            }

                        ?>
                    </datalist>
                <label class="rotulo" for="preco_compra"><strong>Preço de compra:</strong></label>
                <input class="input-group" id="preco_compra" type="number" step="0.01" name="preco_compra" min=0 required><br>
                <label class="rotulo" for="preco"><strong>Preço de venda:</strong></label>
                <input class="input-group" id="preco" type="number" step="0.01" name="preco" min=0 required><br>
                <label class="rotulo" for="quantidade"><strong>Quantidade em estoque:</strong></label>
                <input class="input-group" id="quantidade" type="number" name="quantidade" min=1 required><br>
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