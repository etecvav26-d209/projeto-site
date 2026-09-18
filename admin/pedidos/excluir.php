<?php require_once '../../config/conexao.php';
include '../../includes/header.php';

if (!isset($_POST['id'])) { 
    echo "ID do pedido não informado."; 
    exit; 
} 

$id = $_POST['id'];

if (isset($_POST['confirmar'])) { 
    $sql_itens = "DELETE FROM itens_pedido 
        WHERE pedido_id = :pedido_id"; 
        
    $stmt_itens = $conexao->prepare($sql_itens); 
    $stmt_itens->execute([ ':pedido_id' => $id ]); 
    $sql = "DELETE FROM pedidos WHERE id = :id";
    $stmt = $conexao->prepare($sql); 
    $stmt->execute([ ':id' => $id ]); 
        echo "Pedido excluído com sucesso."; 
    exit; 
}
?>

<h1>Excluir Pedido</h1> 

    <p> 
        Tem certeza que deseja excluir o pedido #<?= $id ?>? 
    </p>

<form method="POST" action="excluir.php"> 
    <input type="hidden" name="id" value="<?= $id ?>" > 
    <input type="hidden" name="confirmar" value="1" > 
        <button type="submit"> 
            Sim, excluir 
        </button>
</form>

<form method="POST" action="visualizar.php"> 
    <input type="hidden" name="id" value="<?= $id ?>" >
     <button type="submit"> 
        Não, voltar 
    </button> 
</form>

<?php 
include '../../includes/footer.php'; 
?>
