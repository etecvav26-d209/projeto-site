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

    $caminho = '../../imagens/doces/' . $nomeImagem;

    $caminhoBanco = 'imagens/doces/' . $nomeImagem;

      if(move_uploaded_file($imagem['tmp_name'], $caminho)) {

        $sql = "INSERT INTO produtos
            (nome, descricao, preco, imagem, categoria, disponivel)
            VALUES
            (:nome, :descricao, :preco, :imagem, :categoria, :disponivel)";

        $stmt = $conexao->prepare($sql);

        try {

            $stmt->execute([

                ':nome' => $nome,
                ':descricao' => $descricao,
                ':preco' => $preco,
                ':imagem' => $caminhoBanco,
                ':categoria' => $categoria,
                ':disponivel' => $disponivel

            ]);

            $id = $conexao->lastInsertId();

            if($id) {

                echo "Produto cadastrado com sucesso! ID: " . $id;

            }

        } catch(PDOException $erro) {

            echo "Não foi possível cadastrar o produto.";

        }

    } else {

        echo "Não foi possível enviar a imagem.";

    }

}

?>

<h2>Cadastrar Produto</h2>

<form method="POST" enctype="multipart/form-data">

  <input
        type="text"
        name="nome"
        placeholder="Nome do produto"
        required
    >

    <br><br>

    <textarea
        name="descricao"
        placeholder="Descrição do produto"
        required
    ></textarea>

    <br><br>

     <input
        type="number"
        step="0.01"
        name="preco"
        placeholder="Preço"
        required
    >

    <br><br>

    <input
        type="file"
        name="imagem"
        accept="image/*"
        required
    >

    <br><br>

</form>


