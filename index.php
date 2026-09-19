<?php

require_once "config/conexao.php";
include 'includes/header.php';

$sql = "SELECT * FROM produtos WHERE disponivel = 1";

$stmt = $conexao->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Bem-vindo ao Noir & Sugar</h1>

<p>
    Cada mordida é uma experiência.
</p>
