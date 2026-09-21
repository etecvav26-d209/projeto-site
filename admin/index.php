<?php
session_start();

if(!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] != 'admin') {

    echo "<h1>Acesso restrito</h1>";

    echo "<p>Você precisa estar logado como administrador para acessar esta página.</p>";

    echo "<a href='login.php'>Fazer login</a>";

    exit;
}

require_once "../includes/header.php";

?>

<section class="admin-painel">

    <h1>Painel Administrativo</h1>

    <p>
        Selecione uma opção.
    </p>

     <div class="admin-menu">

        <a href="usuarios/cadastrar.php">
            Usuários
        </a>

        <a href="produtos/cadastrar.php">
            Produtos
        </a>

        <a href="pedidos/visualizar.php">
            Pedidos
        </a>

    </div>

</section>

<?php

require_once "../includes/footer.php";

?>