<?php

require_once 'config/conexao.php';
include 'includes/header.php';
$produtosSelecionados = $_POST['produtos'] ?? array();
$quantidades = $_POST['quantidade'] ?? array();

if(empty($produtosSelecionados)) {
    echo "<p>Nenhum produto foi selecionado.</p>";
} else {
     $total = 0;
?>

    <form method="POST" action="encomendas.php">

        <?php

        foreach($produtosSelecionados as $id) {

            $sql = "SELECT * FROM produtos WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            if($produto) {

                $quantidade = $quantidades[$id] ?? 1;
                $subtotal = $produto['preco'] * $quantidade;
                $total = $total + $subtotal;

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

                    <input type="number" name="quantidade[<?php echo $produto['id']; ?>]" value="1" min="1" >
                </div>
                <hr>

        <?php
            }
        }
        ?>

        <h2>
            Total:
            R$
            <?php echo number_format($total, 2, ',', '.'); ?>
        </h2>

        <?php
        foreach($produtosSelecionados as $id) {
        ?>
            <input type="hidden" name="produtos[]" value="<?php echo $id; ?>">
        <?php
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
