<?php

require_once '../../config/conexao.php';

include '../../includes/header.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $disponivel = $_POST['disponivel'];

    $imagem = $_FILES['imagem'];

    $nomeImagem = $imagem['name'];

    $caminho = '../../img/produtos/' . $nomeImagem;

    $caminhoBanco = 'img/produtos/' . $nomeImagem;

}
?>
