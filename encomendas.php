<?php

require_once 'config/conexao.php';
include 'includes/header.php';
$produtosSelecionados = $_POST['produtos'] ?? array();

if(empty($produtosSelecionados)) {
    echo "<p>Nenhum produto foi selecionado.</p>";
} else {
?>

    <form method="POST" action="encomendas.php">

        <?php
        $total = 0;

        foreach($produtosSelecionados as $id) {

            $sql = "SELECT * FROM produtos WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            if($produto) {
        ?>

                <div class="produto">
                    <h3>
                        <?php echo $produto['nome']; ?>
                    </h3>

                    <p>
                        <?php echo $produto['descricao']; ?>
                    </p>

                    <p>
                        Preço:
                        R$
                        <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                    </p>

                    <label>
                        Quantidade:
                    </label>

                    <input ype="number" name="quantidade[<?php echo $produto['id']; ?>]" value="1" min="1" >
                </div>
                <hr>

        <?php
            }
        }
        ?>


        <button type="submit">
            Atualizar carrinho
        </button>
    </form>

<?php
}
include 'includes/footer.php';
?>
