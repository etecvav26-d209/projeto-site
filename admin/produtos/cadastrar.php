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

    <select name="categoria" required>

        <option value="">
            Selecione a categoria
        </option>

        <option value="Doces Franceses">
            Doces Franceses
        </option>

        <option value="Doces Tradicionais">
            Doces Tradicionais
        </option>

        <option value="Docinhos para Eventos">
            Docinhos para Eventos
        </option>

        <option value="Bolos para Eventos">
            Bolos para Eventos
        </option>

        <option value="Kits para Eventos">
            Kits para Eventos
        </option>

        <option value="Bebidas">
            Bebidas
        </option>

    </select>

    <br><br>

    <select name="disponivel" required>

        <option value="1">
            Disponível
        </option>

        <option value="0">
            Indisponível
        </option>

    </select>

    <br><br>

 <button type="submit">
        Cadastrar
    </button>

</form>

<?php

include '../../includes/footer.php';

?>


