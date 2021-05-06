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
    <div class="fundo">
        <div class="topo">
            <div class="botoes">
                <div class="voltar">
                    <button class="btn btn-primary" onclick="history.go(-1)">Retornar</button>
                </div>
                <div class="meio">
                    <div class="container-fluid centralizar cabecalho">
                        <h1>Adicionar Cliente</h1>
                    </div>
                </div>
                <div class="sair">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='php/sair.php'" name="clientes">Sair</button>
                </div>
            </div>
            
        </div>
        <div class="formulario">
            <form action="php/addCliente.php" method="POST" enctype="multipart/form-data">
                <label class="rotulo" for="cliente"><strong>Nome do cliente:</strong></label>
                <input class="input-group" type="text" id="cliente" name="cliente" maxlength="100" required autofocus><br>
                <label for="cpf"><strong>CPF do cliente:</strong></label>
                <input class="input-group" type="text" id="cpf" name="cpf" maxlength="14" required><br>
                <label for="tel"><strong>Telefone do cliente:</strong></label>
                <input class="input-group" type="text" id="tel" name="tel"  maxlength="15" required><br>
                <label for="email"><strong>Email do cliente:</strong></label>
                <input class="input-group" type="text" id="email" name="email" maxlength="100" required><br>
                <label class="rotulo btn-foto" for="foto">Adicionar foto</label>
                <input class="form-control-file" type="file" id="foto" name="foto"><br>
                <label for="data"><strong>Data de cadastro:</strong></label>
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