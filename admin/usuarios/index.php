<?php

require_once '../../config/conexao.php';

include '../../includes/header.php';

$sql = "SELECT * FROM usuarios";

$stmt = $conexao->prepare($sql);

$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h2>Lista de Usuários</h2>

<a href="cadastrar.php">
    Cadastrar Usuário
</a>

<table border="1">

    <tr>

        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Tipo</th>
        <th>Ações</th>

    </tr>


    <?php foreach($usuarios as $usuario) { ?>

        <tr>

            <td>
                <?php echo $usuario['id']; ?>
            </td>

            <td>
                <?php echo $usuario['nome']; ?>
            </td>

            <td>
                <?php echo $usuario['email']; ?>
            </td>

            <td>
                <?php echo $usuario['tipo']; ?>
            </td>

            <td>

<?php } ?>
