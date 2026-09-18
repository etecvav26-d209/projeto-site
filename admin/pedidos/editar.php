<?php require_once '../../config/conexao.php';
include '../../includes/header.php';

if (!isset($_POST['id'])) {
    echo "ID do pedido não informado.";
    exit;
}

$id = $_POST['id'];

$sql = "SELECT * FROM pedidos WHERE id = :id"; 

$stmt = $conexao->prepare($sql); 

$stmt->execute([':id' => $id]);

$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pedido) { echo "Pedido não encontrado."; 
exit; 
}

if (isset($_POST['salvar'])) {

$status = $_POST['status']; 
$observacoes = $_POST['observacoes'];

$sql = "UPDATE pedidos SET status = :status, 
observacoes = :observacoes 
WHERE id = :id"; 

$stmt = $conexao->prepare($sql); 
$stmt->execute([ 
    ':status' => $status, 
    ':observacoes' => $observacoes, 
    ':id' => $id 
    ]); 
echo "Pedido atualizado com sucesso."; 

$pedido['status'] = $status; 
$pedido['observacoes'] = $observacoes;
}

?>

<h1>Editar Pedido #<?= $pedido['id'] ?></h1> 

<form method="POST" action="editar.php"> 
    
<input type="hidden" name="id" value="<?= $pedido['id'] ?>" >

<label>Status:</label> 

<select name="status">

    <option value="pendente" <?= $pedido['status'] == 'pendente' ? 'selected' : '' ?>> 
        Pendente 
    </option> 
    
    <option value="em preparo" <?= $pedido['status'] == 'em preparo' ? 'selected' : '' ?>> 
        Em preparo 
    </option> 
    
    <option value="pronto" <?= $pedido['status'] == 'pronto' ? 'selected' : '' ?>> 
            Pronto 
    </option> 
    
    <option value="entregue" <?= $pedido['status'] == 'entregue' ? 'selected' : '' ?>> 
        Entregue 
    </option> 
</select>

<br><br> 

<label>Observações:</label> 

<textarea name="observacoes">
    <?= $pedido['observacoes'] ?>
</textarea> 

<br><br>

<input type="hidden" name="salvar" value="1"> 

<button type="submit"> 
    Salvar alterações 
</button>

</form>

<form method="POST" action="visualizar.php"> 
    
<input type="hidden" name="id" value="<?= $pedido['id'] ?>" >

<button type="submit"> 
    Voltar para o pedido
 </button>

</form>

