<?php

require_once "../../config/conexao.php";
require_once "../../includes/header.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];

     $sql = "INSERT INTO usuarios
        (nome, email, senha, tipo)
        VALUES
        (:nome, :email, :senha, :tipo)";

 $stmt = $conexao->prepare($sql);
 
    try {

    $stmt->execute([

        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senha,
        ':tipo' => $tipo

    ]);

      $id = $conexao->lastInsertId();

    if($id) {

        echo "Usuário cadastrado com sucesso! ID: " . $id;

    }

    }catch(PDOException $erro) { 
        
    echo "Este e-mail já está cadastrado."; 
    
    }

}

?>


<h2>Cadastrar Usuário</h2>

<form method="POST">

    <input
        type="text"
        name="nome"
        placeholder="Nome do usuário"
        required
    >

    <br><br>

    <input
        type="email"
        name="email"
        placeholder="E-mail"
        required
    >

    <br><br>

    <input
        type="password"
        name="senha"
        placeholder="Senha"
        required
    >

     <br><br>

    <select name="tipo" required>

        <option value="">Selecione o tipo</option>

        <option value="cliente">
            Cliente
        </option>

        <option value="admin">
            Administrador
        </option>

    </select>

    <br><br>

    <button type="submit">
        Cadastrar
    </button>

</form>

<?php

include '../../includes/footer.php';

?>
