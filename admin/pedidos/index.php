<?php 
require_once '../../config/conexao.php';
include '../../includes/header.php';

$sql = "SELECT pedidos.*, usuarios.nome
        FROM pedidos
        INNER JOIN usuarios
        ON pedidos.usuario_id = usuarios.id
        ORDER BY pedidos.id DESC";

?>
