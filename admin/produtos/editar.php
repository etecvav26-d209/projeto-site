
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

 <input
        type="hidden"
        name="id"
        value="<?php echo $produto['id']; ?>"
    >

    <input
        type="text"
        name="nome"
        value="<?php echo $produto['nome']; ?>"
        required
    >

    <br><br>

    <textarea
        name="descricao"
        required
    ><?php echo $produto['descricao']; ?></textarea>

    <br><br>

    <input
        type="number"
        step="0.01"
        name="preco"
        value="<?php echo $produto['preco']; ?>"
        required
    >

    <br><br>

<p>Imagem atual:</p>

    <img
        src="../../<?php echo $produto['imagem']; ?>"
        width="150"
    >

    <br><br>

    <input
        type="file"
        name="imagem"
        accept="image/*"
    >

    <br><br>

    <select name="categoria" required>

        <option value="Doces Franceses"
            <?php if($produto['categoria'] == 'Doces Franceses') echo 'selected'; ?>>
            Doces Franceses
        </option>

        <option value="Doces Tradicionais"
            <?php if($produto['categoria'] == 'Doces Tradicionais') echo 'selected'; ?>>
            Doces Tradicionais
        </option>

        <option value="Docinhos para Eventos"
            <?php if($produto['categoria'] == 'Docinhos para Eventos') echo 'selected'; ?>>
            Docinhos para Eventos
        </option>

        <option value="Bolos para Eventos"
            <?php if($produto['categoria'] == 'Bolos para Eventos') echo 'selected'; ?>>
            Bolos para Eventos
        </option>

        <option value="Kits para Eventos"
            <?php if($produto['categoria'] == 'Kits para Eventos') echo 'selected'; ?>>
            Kits para Eventos
        </option>

        <option value="Bebidas"
            <?php if($produto['categoria'] == 'Bebidas') echo 'selected'; ?>>
            Bebidas
        </option>

    </select>

    <br><br>

    <select name="disponivel" required>

        <option value="1"
            <?php if($produto['disponivel'] == 1) echo 'selected'; ?>>
            Disponível
        </option>

        <option value="0"
            <?php if($produto['disponivel'] == 0) echo 'selected'; ?>>
            Indisponível
        </option>

    </select>

    <br><br>

    <button type="submit">
        Salvar
    </button>

</form>

<?php

include '../../includes/footer.php';

?>