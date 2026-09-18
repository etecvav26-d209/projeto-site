<?php

require_once '../../config/conexao.php';
include '../../includes/header.php';

if (!isset($_POST['id'])) {
    echo "ID do pedido não informado.";
    exit;
}

$_POST['id']

$sql = "SELECT pedidos.*, usuarios.nome, usuarios.email
        FROM pedidos
        INNER JOIN usuarios
        ON pedidos.usuario_id = usuarios.id
        WHERE pedidos.id = :id";

        $stmt_itens = $conexao->prepare($sql_itens);
        $stmt_itens->execute([':pedido_id' => $id]);

?>

<h1>Pedido #<?= $pedido['id'] ?></h1> 

<h2>Informações do pedido</h2> 

    <p> 
        <strong>Cliente:</strong> <?= $pedido['nome'] ?> 
    </p> 
    
    <p> 
        <strong>E-mail:</strong> <?= $pedido['email'] ?> 
    </p> 
    
    <p> 
        <strong>Data:</strong> <?= $pedido['data'] ?> 
    </p> 
    
    <p> 
        <strong>Status:</strong> <?= $pedido['status'] ?> 
    </p> 
    
    <p> 
        <strong>Observações:</strong> <?= $pedido['observacoes'] ?> 
    </p> 
    
    <p> 
        <strong>Total:</strong> R$ <?= number_format($pedido['total'], 2, ',', '.') ?> 
    </p>

<h2>Produtos do pedido</h2> 

<?php if (count($itens) > 0): ?> 
    
    <?php foreach ($itens as $item): ?> 
        
        <?php $subtotal = $item['quantidade'] * $item['preco']; ?> 
        
        <div> 
            <p> 
                <strong>Produto:</strong> <?= $item['nome'] ?> 
            </p> 
            
            <p> 
                <strong>Quantidade:</strong> <?= $item['quantidade'] ?> 
            </p> 
            
            <p> 
                <strong>Preço:</strong> R$ <?= number_format($item['preco'], 2, ',', '.') ?> 
            </p> 
            
            <p> 
                <strong>Subtotal:</strong> R$ <?= number_format($subtotal, 2, ',', '.') ?> 
            </p> 
            
        </div>
        
        <?php endforeach; ?> 
        
            <?php else: ?> 
                <p>Este pedido não possui produtos.</p> 
            <?php endif; ?>

<a href="index.php">Voltar</a>

<form method="POST" action="editar.php">

    <input type="hidden" name="id" value="<?= $pedido['id'] ?>" >
        <button type="submit">
            Editar pedido
        </button>
</form>

<form method="POST" action="excluir.php">

    <input type="hidden" name="id" value="<?= $pedido['id'] ?>">
        <button type="submit">
            Excluir pedido
        </button>
</form>



<?php

include '../../includes/footer.php';

?>
