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

<h1>Criar Conta</h1>

<p>
    Preencha os dados abaixo para criar sua conta.
</p>

<form method="POST" action="../admin/usuarios/cadastro.php">

    <label>
        Nome:
    </label>

    <input type="text" name="nome" required>

    <br><br>

    <label>
        Email:
    </label>

    <input type="email" name="email" required>

    <br><br>

    <label>
        Senha:
    </label>

    <input type="password" name="senha" required>

    <br><br>

    <button type="submit" name="cadastrar">
        Criar conta
    </button>
</form>

<p>
    Já possui uma conta?
    <a href="login.php">
        Fazer login
    </a>
</p>

<?php
include '../includes/footer.php';
?>

