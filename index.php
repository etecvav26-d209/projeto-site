<?php

require_once "config/conexao.php";
include 'includes/header.php';

$sql = "SELECT * FROM produtos WHERE disponivel = 1";
?>