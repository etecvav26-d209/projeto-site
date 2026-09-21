<?php
session_start();

require_once 'config/conexao.php';

$produtosSelecionados = $_POST['produtos'] ?? array();
$quantidades = $_POST['quantidade'] ?? array();
$itensCarrinho = array();
$total = 0;
$mensagem = '';
$pedidoFinalizado = false;

foreach ($produtosSelecionados as $id) {

    $id = (int) $id;

    if ($id <= 0) {
        continue;
    }

    $sql = "SELECT * FROM produtos
            WHERE id = :id
            AND disponivel = 1";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);

    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {

        $quantidade = $quantidades[$id] ?? 1;
        $quantidade = (int) $quantidade;

        if ($quantidade < 1) {
            $quantidade = 1;
        }

        $subtotal = $produto['preco'] * $quantidade;
        $total = $total + $subtotal;
        $itensCarrinho[] = [
            'id' => $produto['id'],
            'nome' => $produto['nome'],
            'descricao' => $produto['descricao'],
            'preco' => $produto['preco'],
            'quantidade' => $quantidade,
            'subtotal' => $subtotal
        ];
    }
}

if (isset($_POST['finalizar'])) {

    if (empty($itensCarrinho)) {

        $mensagem = 'Nenhum produto válido foi encontrado no carrinho.';

    } elseif (!isset($_SESSION['usuario_id'])) {

        $mensagem = 'Você precisa estar logado para finalizar o pedido.';

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
            foreach ($itensCarrinho as $item) {

                $sql = "INSERT INTO itens
                        (pedido_id, produto_id, quantidade, preco)
                        VALUES
                        (:pedido_id, :produto_id, :quantidade, :preco)";

                $stmt = $conexao->prepare($sql);
                $stmt->execute([
                    ':pedido_id' => $pedidoId,
                    ':produto_id' => $item['id'],
                    ':quantidade' => $item['quantidade'],
                    ':preco' => $item['preco']
                ]);
            }

            $conexao->commit();
            $mensagem = 'Pedido adicionado ao carrinho com sucesso! Número do pedido: ' . $pedidoId;
            $pedidoFinalizado = true;

        } catch (PDOException $erro) {

            $conexao->rollBack();
            $mensagem = 'Não foi possível salvar o pedido.';
        }
    }
}

include 'includes/header.php';

?>

<section class="carrinho">

    <h1>Seu carrinho</h1>

    <?php if ($mensagem != ''): ?>

        <p>
            <?php echo htmlspecialchars($mensagem); ?>
        </p>

    <?php endif; ?>

    <?php if ($pedidoFinalizado): ?>

        <a href="index.php">
            Voltar ao cardápio
        </a>

    <?php elseif (empty($itensCarrinho)): ?>

        <p>Nenhum produto foi selecionado.</p>

        <a href="index.php#cardapio">
            Voltar ao cardápio
        </a>

    <?php else: ?>

        <form method="POST" action="encomendas.php">

            <?php foreach ($itensCarrinho as $item): ?>

                <div class="produto">

                    <h2>
                        <?php echo htmlspecialchars($item['nome']); ?>
                    </h2>

                    <p>
                        <?php echo htmlspecialchars($item['descricao']); ?>
                    </p>

                    <p>
                        Preço: R$
                        <?php echo number_format($item['preco'], 2, ',', '.'); ?>
                    </p>

                    <label>
                        Quantidade:
                    </label>

                    <input
                        type="number"
                        name="quantidade[<?php echo $item['id']; ?>]"
                        value="<?php echo $item['quantidade']; ?>"
                        min="1"
                    >

                    <p>
                        Subtotal: R$
                        <?php echo number_format($item['subtotal'], 2, ',', '.'); ?>
                    </p>

                    <input
                        type="hidden"
                        name="produtos[]"
                        value="<?php echo $item['id']; ?>"
                    >

                </div>

                <hr>

            <?php endforeach; ?>

            <h2>
                Total: R$
                <?php echo number_format($total, 2, ',', '.'); ?>
            </h2>

            <button type="submit">
                Atualizar carrinho
            </button>

        </form>

        <br>

        <form method="POST" action="encomendas.php">

            <?php foreach ($itensCarrinho as $item): ?>

                <input
                    type="hidden"
                    name="produtos[]"
                    value="<?php echo $item['id']; ?>"
                >

                <input
                    type="hidden"
                    name="quantidade[<?php echo $item['id']; ?>]"
                    value="<?php echo $item['quantidade']; ?>"
                >

            <?php endforeach; ?>

            <input type="hidden" name="finalizar" value="1">

            <button type="submit">
                Finalizar pedido
            </button>

        </form>

    <?php endif; ?>

</section>

<?php

include 'includes/footer.php';

?>