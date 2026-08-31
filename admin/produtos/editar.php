
<?php

require_once '../../config/conexao.php';

include '../../includes/header.php';

if(isset($_POST['id'])) {

    $id = $_POST['id'];

}

$sql = "SELECT * FROM produtos WHERE id = :id";

$stmt = $conexao->prepare($sql);

$stmt->execute([

    ':id' => $id

]);

$produto = $stmt->fetch(PDO::FETCH_ASSOC);


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'])) {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $disponivel = $_POST['disponivel'];


    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {

        $nomeImagem = $_FILES['imagem']['name'];

        $caminho = '../../img/produtos/' . $nomeImagem;

        $caminhoBanco = 'img/produtos/' . $nomeImagem;

        move_uploaded_file(
            $_FILES['imagem']['tmp_name'],
            $caminho
        );

        $imagem = $caminhoBanco;

    } else {

        $imagem = $produto['imagem'];

    }


    $sql = "UPDATE produtos SET

        nome = :nome,
        descricao = :descricao,
        preco = :preco,
        imagem = :imagem,
        categoria = :categoria,
        disponivel = :disponivel

        WHERE id = :id";


    $stmt = $conexao->prepare($sql);


    $stmt->execute([

        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':imagem' => $imagem,
        ':categoria' => $categoria,
        ':disponivel' => $disponivel,
        ':id' => $id

    ]);


    echo "Produto atualizado com sucesso!";


    $sql = "SELECT * FROM produtos WHERE id = :id";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([

        ':id' => $id

    ]);

    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>


<h2>Editar Produto</h2>

<form method="POST" enctype="multipart/form-data">

</form>