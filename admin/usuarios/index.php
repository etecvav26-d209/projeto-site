<?php

require_once '../../config/conexao.php';

include '../../includes/header.php';

$sql = "SELECT * FROM usuarios";

$stmt = $conexao->prepare($sql);

$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


