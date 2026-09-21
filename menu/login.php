<?php

session_start();

require_once '../config/conexao.php';
include '../includes/header.php';

if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = :email";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        ':email' => $email
    ]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if($usuario && password_verify($senha, $usuario['senha'])) {

        $_SESSION['usuario_id'] = $usuario['id'];

        echo "<p>Login realizado com sucesso!</p>";

    } else {
        echo "<p>Email ou senha incorretos.</p>";
    }
}
?>
