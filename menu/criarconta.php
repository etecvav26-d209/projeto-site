<?php

require_once '../config/conexao.php';
include '../includes/header.php';

if(isset($_POST['cadastrar'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $senha = password_hash($senha, PASSWORD_DEFAULT);

    try {

        $sql = "INSERT INTO usuarios
                (nome, email, senha, tipo)
                VALUES
                (:nome, :email, :senha, 'cliente')";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha
        ]);

        echo "<p>Conta criada com sucesso!</p>";

        echo "<p><a href='login.php'>Ir para o login</a></p>";

    } catch(PDOException $erro) {
        echo "<p>Email já cadastrado.</p>";
    }
}
?>
