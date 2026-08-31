<?php

require_once '../../config/conexao.php';

include '../../includes/header.php';

$sql = "SELECT * FROM produtos";

$stmt = $conexao->prepare($sql);

$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Produtos</h2>

<a href="cadastrar.php">
    Cadastrar Produto
</a>
