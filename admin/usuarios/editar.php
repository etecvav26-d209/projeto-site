<?php 

require_once '../../config/conexao.php'; 
require_once '../../includes/header.php';

if(isset($_POST['id'])) {

    $id = $_POST['id'];

}

$sql = "SELECT * FROM usuarios WHERE id = :id";

$stmt = $conexao->prepare($sql);

$stmt->execute([

    ':id' => $id

]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'])) {

$nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];

    $sql = "UPDATE usuarios SET

    nome = :nome,
    email = :email,
    tipo = :tipo

    WHERE id = :id";

}
?>
