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
?>

 <br>

    <form method="POST" action="encomendas.php">
        <?php

        foreach($produtosSelecionados as $id) {

            $quantidade = $quantidades[$id] ?? 1;
        ?>

            <input type="hidden" name="produtos[]" value="<?php echo $id; ?>">

            <input type="hidden" name="quantidade[<?php echo $id; ?>]" value="<?php echo $quantidade; ?>>

        <?php
        }
        ?>

        <input type="hidden" name="finalizar" value="1">

        <button type="submit">
            Finalizar pedido
        </button>

    </form>


<?php
if(isset($_POST['finalizar'])) {

    if(!isset($_SESSION['usuario_id'])) {

        echo "<p>Você precisa estar logado para finalizar o pedido.</p>";

    } else {

        $usuarioId = $_SESSION['usuario_id'];

        try {
            $conexao->beginTransaction();
            $sql = "INSERT INTO pedidos
                    (usuario_id, total, observa, status)
                    VALUES
                    (:usuario_id, :total, :observa, 'carrinho')";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                ':usuario_id' => $usuarioId,
                ':total' => $total,
                ':observa' => null
            ]);
            $pedidoId = $conexao->lastInsertId();


            foreach($produtosSelecionados as $id) {

                $quantidade = $quantidades[$id] ?? 1;
                $sql = "SELECT preco
                        FROM produtos
                        WHERE id = :id";
                $stmt = $conexao->prepare($sql);
                $stmt->execute([
                    ':id' => $id
                ]);
                $produto = $stmt->fetch(PDO::FETCH_ASSOC);

                if($produto) {

                    $sql = "INSERT INTO itens
                            (pedido_id, produto_id, quantidade, preco)
                            VALUES
                            (:pedido_id, :produto_id, :quantidade, :preco)";
                    $stmt = $conexao->prepare($sql);
                    $stmt->execute([
                        ':pedido_id' => $pedidoId,
                        ':produto_id' => $id,
                        ':quantidade' => $quantidade,
                        ':preco' => $produto['preco']
                    ]);
                }
            }

            $conexao->commit();

            echo "<p>Pedido adicionado ao carrinho com sucesso!</p>";

            echo "<p>Número do pedido: " . $pedidoId . "</p>";

        } catch(PDOException $erro) {

            $conexao->rollBack();

            echo "<p>Não foi possível salvar o pedido.</p>";
        }
    }
}

include 'includes/footer.php';
?>
