<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Perfil do Vendedor</title>
    <?php
        include_once "php/autenticacao.php";
        include_once "php/conexao.php";

        $id = $_GET['id'];
        $_SESSION['mais'] = $id;
        $nome;
        $cpf;
        $tel;
        $email;
        $vendas;
        $valor_vendas;
        $data;

        try {
            $pesquisa = $conexao->prepare("SELECT * FROM vendedores WHERE id = :id");
            $pesquisa->execute(array(
                ':id'=>$id
            ));

            foreach ($pesquisa->fetchAll() as $row) {
                $nome = $row['nome'];
                $cpf = $row['cpf'];
                $tel = $row['telefone'];
                $email = $row['email'];
                $vendas = $row['vendas'];
                $valor_vendas = $row['valor_vendas'];
                $data = $row['data_admissao'];
            }
        } catch (PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    ?>
</head>
<body>
    <div>
        <div class="retornar">
            <button class="btn btn-primary" onclick="history.go(-1)">Retornar</button>
        </div>
        <div class="fotocenter">
            <img class="foto" src="imagens/foto.jpg" alt="foto de perfil">
            <h1><?php echo $nome ?></h1>
        </div>
        <div class="tabela">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="ambas">Informações</th>
                    </tr>
                </thead>
                <tr>
                    <td><strong>NOME: </strong><?php echo $nome ?></td>
                </tr>
                <tr>
                    <td><strong>CPF: </strong><?php echo $cpf ?></td>
                </tr>
                <tr>
                    <td><strong>TELEFONE: </strong><?php echo $tel ?></td>
                </tr>
                <tr>
                    <td><strong>EMAIL: </strong><?php echo $email ?></td>
                </tr>
                <tr>
                    <td><strong>VENDAS REALIZADAS: </strong><?php echo $vendas ?></td>
                </tr>
                <tr>
                    <td><strong>VALOR DE VENDAS: </strong>R$ <?php echo number_format($valor_vendas, 2, ',', '.') ?></td>
                </tr>
                <tr>
                    <td><strong>DATA DE ADMIÇÃO: </strong><?php echo date("d/m/Y", strtotime($data)) ?></td>
                </tr>
            </table>
            <div class="rodape">
                <div class="excluir">
                    <?php
                        echo "<button class='btn btn-danger' onclick=window.location.href='php/excluirVendedor.php?id=".$id."'>Excluir</button>";
                    ?>
                </div>
                <div class="editar">
                    <?php
                        echo "<button class='btn btn-primary' onclick=window.location.href='admin/formEditarVendedor.php?id=".$id."'>Editar</button>";
                    ?>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>