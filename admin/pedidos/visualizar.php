<?php

require_once '../../config/conexao.php';

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
