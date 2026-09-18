<?php require_once '../../config/conexao.php';
include '../../includes/header.php';

if (!isset($_POST['id'])) { 
    echo "ID do pedido não informado."; 
    exit; 
} 

$id = $_POST['id'];
?>
