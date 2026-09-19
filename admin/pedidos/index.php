<?php 
require_once '../../config/conexao.php';
include '../../includes/header.php';

$sql = "SELECT pedidos.*, usuarios.nome
        FROM pedidos
        INNER JOIN usuarios
        ON pedidos.usuario_id = usuarios.id
        ORDER BY pedidos.id DESC";

$stmt = $conexao->prepare($sql);
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

 <h1>Pedidos</h1>

<?php if (count($pedidos) > 0): ?>

    <?php foreach ($pedidos as $pedido): ?>

        <div>

            <h2>Pedido #<?= $pedido['id'] ?></h2>

            <p>
                <strong>Cliente:</strong>
                <?= $pedido['nome'] ?>
            </p>

            <p>
                <strong>Total:</strong>
                R$ <?= number_format($pedido['total'], 2, ',', '.') ?>
            </p>

            <p>
                <strong>Status:</strong>
                <?= $pedido['status'] ?>
            </p>

            <form method="POST" action="visualizar.php">

                <input type="hidden" name="id" value="<?= $pedido['id'] ?>">

                <button type="submit">
                    Visualizar
                </button>

            </form>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <p>Nenhum pedido encontrado.</p>

<?php endif; ?>

<?php

include '../../includes/footer.php';

?>