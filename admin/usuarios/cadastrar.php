<?php

require_once "../../config/conexao.php";
require_once "../../includes/header.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
}
?>
