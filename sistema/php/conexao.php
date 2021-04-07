<?php
$servidor = "localhost";
$banco = "informatica";
$usuario = "root";
$senha = "";

try {
    $conexao = new PDO ("mysql:host=$servidor;dbname=$banco",$usuario,$senha);
} catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}

?>