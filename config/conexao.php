<?php

$servidor = "localhost";
$banco = "confeitaria";
$usuario = "root";
$senha = "";

try {

    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$banco",
        $usuario,
        $senha
    );

    echo "Conexão realizada com sucesso!";

} catch(PDOException $erro) {

    echo "Erro na conexão: " . $erro->getMessage();

}

?>