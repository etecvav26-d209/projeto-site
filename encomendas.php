<?php

require_once 'config/conexao.php';
include 'includes/header.php';
$produtosSelecionados = $_POST['produtos'] ?? array();

if(empty($produtosSelecionados)) {
    echo "<p>Nenhum produto foi selecionado.</p>";
}
?>

<h1>Meu Carrinho</h1>

<p>
    Confira os produtos que você adicionou ao carrinho.
</p>


<?php

include 'includes/footer.php';

?>