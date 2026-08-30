<?php

require_once "../../config/conexao.php";
require_once "../../includes/header.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];

     $sql = "INSERT INTO usuarios
        (nome, email, senha, tipo)
        VALUES
        (:nome, :email, :senha, :tipo)";

 $stmt = $conexao->prepare($sql);

    $stmt->execute([

        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senha,
        ':tipo' => $tipo

    ]);

}
?>
