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

<br><br>


<?php foreach($produtos as $produto) { ?>

    <div>

        <h3>
            <?php echo $produto['nome']; ?>
        </h3>

        <p>
            <?php echo $produto['descricao']; ?>
        </p>

        <p>
            Preço: R$
            <?php echo $produto['preco']; ?>
        </p>

        <p>
            Categoria:
            <?php echo $produto['categoria']; ?>
        </p>

        <p>
            Disponibilidade:

            <?php

            if($produto['disponivel'] == 1) {

                echo "Disponível";

            } else {

                echo "Indisponível";

            }

            ?>

        </p>

        <img
            src="../../<?php echo $produto['imagem']; ?>"
            width="150"
        >

        <br><br>

        
