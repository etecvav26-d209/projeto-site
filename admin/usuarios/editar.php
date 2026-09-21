<?php 

session_start();

if(!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] != 'admin') {

    echo "<h1>Acesso restrito</h1>";

    echo "<p>Você precisa estar logado como administrador para acessar esta página.</p>";

    echo "<a href='login.php'>Fazer login</a>";

    exit;
}
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

    $stmt = $conexao->prepare($sql);

try {

        $stmt->execute([

            ':nome' => $nome,
            ':email' => $email,
            ':tipo' => $tipo,
            ':id' => $id

        ]);

        echo "Usuário atualizado com sucesso!";

    } catch(PDOException $erro) {

        echo "Não foi possível atualizar o usuário.";

    }

}
?>

<h2>Editar Usuário</h2>

<form method="POST">

    <input
        type="hidden"
        name="id"
        value="<?php echo $usuario['id']; ?>"
    >

    <input
        type="text"
        name="nome"
        value="<?php echo $usuario['nome']; ?>"
        required
    >

    <br><br>

    <input
        type="email"
        name="email"
        value="<?php echo $usuario['email']; ?>"
        required
    >

    <br><br>

     <select name="tipo" required>

        <option
            value="cliente"
            <?php
            if($usuario['tipo'] == 'cliente') {
                echo 'selected';
            }
            ?>
        >
            Cliente
        </option>

        <option
            value="admin"
            <?php
            if($usuario['tipo'] == 'admin') {
                echo 'selected';
            }
            ?>
        >
            Administrador
        </option>

    </select>

     <br><br>

    <button type="submit">
        
        Salvar

    </button>

</form>

<br>

<a href="index.php">

    <button type="button">
        Voltar ao painel
    </button>

</a>


<?php

include '../../includes/footer.php';

?>
