<?php require_once '../../config/conexao.php';

if (!isset($_POST['id'])) {
    echo "ID do pedido não informado.";
    exit;
}

$id = $_POST['id'];

$sql = "SELECT * FROM pedidos WHERE id = :id"; 

$stmt = $conexao->prepare($sql); 

$stmt->execute([':id' => $id]);

$pedido = $stmt->fetch(PDO::FETCH_ASSOC);
?>

