<?php

require_once '../../config/conexao.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {

 $id = $_POST['id'];

 $sql = "DELETE FROM usuarios WHERE id = :id";

    $stmt = $conexao->prepare($sql);

    try {

        $stmt->execute([

            ':id' => $id

        ]);

        echo "Usuário excluído com sucesso!";

    } catch(PDOException $erro) {

        echo "Não foi possível excluir o usuário.";

    }

}
?>
