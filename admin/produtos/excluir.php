<?php

require_once '../../config/conexao.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM produtos WHERE id = :id";

    $stmt = $conexao->prepare($sql);

    try {

        $stmt->execute([

            ':id' => $id

        ]);

        echo "Produto excluído com sucesso!";

    } catch(PDOException $erro) {

        echo "Não foi possível excluir o produto.";

    }

}

?> 

