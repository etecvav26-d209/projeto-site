<?php

require_once 'config/conexao.php';
include 'includes/header.php';
$produtosSelecionados = $_POST['produtos'] ?? array();

?>

<h1>Meu Carrinho</h1>

<p>
    Confira os produtos que você adicionou ao carrinho.
</p>

<p>
    Nenhum produto foi adicionado ao carrinho.
</p>

<?php

include 'includes/footer.php';

?>