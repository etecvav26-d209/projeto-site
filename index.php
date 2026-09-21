<?php

require_once "config/conexao.php";
include 'includes/header.php';

$sql = "SELECT * FROM produtos WHERE disponivel = 1";

$stmt = $conexao->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="sanfona">
    <input type="checkbox" id="sanfona-toggle" class="sanfona-toggle" aria-hidden="true">
    <label for="sanfona-toggle" class="btn-sanfonado" aria-controls="sanfona-menu">Abrir Menu</label>
    <div id="sanfona-menu" class="sanfona-content" aria-hidden="true">
        <ul class="sanfona-list">
            <li><a href="menu/ajuda.php">Ajuda</a></li>
            <li><a href="menu/loja.php">Loja</a></li>
            <li><a href="menu/sobre.php">Sobre</a></li>
        </ul>
    </div>
</div>

<section id="inicio" class="banner-inicial">

    <img src="imagens\fundo.jpeg" alt="Imagem inicial">

    <div class="banner-conteudo">

        <h1>Bem-vindo ao Noir & Sugar</h1>

        <p>
            Cada mordida é uma experiência.
        </p>

    </div>

</section>

<section id="galeria" class="galeria">

    <h2>Nosso Trabalho</h2>

    <div class="galeria-imagens">

        <img src="imagens\doces\galeria1.jpeg" alt="Nosso trabalho">
        <img src="imagens\doces\galeria2.jpeg" alt="Nosso trabalho">
        <img src="imagens\doces\galeria3.jpeg" alt="Nosso trabalho">
        <img src="imagens\doces\galeria4.jpeg" alt="Nosso trabalho">
        <img src="imagens\doces\galeria5.jpeg" alt="Nosso trabalho">
        <img src="imagens\doces\galeria6.jpeg" alt="Nosso trabalho">
        <img src="imagens\doces\galeria7.jpeg" alt="Nosso trabalho">

    </div>

</section>

<section id="cardapio">

    <h2>Nosso Cardápio</h2>

    <form method="POST" action="encomendas.php">
    <!-- DOCES FRANCESES -->
    <h3>Doces Franceses</h3>

    <?php

    $temproduto = false;

    foreach ($produtos as $produto) {
        if ($produto['categoria'] == 'Doces Franceses') {
            $temproduto = true;

    ?>

            <div class="produto">
                <label>
                    <input type="checkbox" name="produtos[]" value="<?php echo $produto['id']; ?>">
                        Selecionar
                </label>
                <h4>
                    <?php echo $produto['nome']; ?>
                </h4>

                <p>
                    <?php echo $produto['descricao']; ?>
                </p>

                <p>
                    R$
                    <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                </p>
            </div>
    <?php
        }
    } 
    if ($temproduto == false) {
        echo "<p>Nenhum produto disponível nesta categoria.</p>";
    }
    ?>

     <!-- DOCES TRADICIONAIS -->
    <h3>Doces Tradicionais</h3>

    <?php

    $temproduto = false;

    foreach ($produtos as $produto) {
        if ($produto['categoria'] == 'Doces Tradicionais') {
            $temproduto = true;

    ?>

            <div class="produto">
                <label>
                    <input type="checkbox" name="produtos[]" value="<?php echo $produto['id']; ?>">
                        Selecionar
                </label>

                <h4>
                    <?php echo $produto['nome']; ?>
                </h4>

                <p>
                    <?php echo $produto['descricao']; ?>
                </p>

                <p>
                    R$
                    <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                </p>
            </div>

    <?php
        }
    }
    if ($temproduto == false) {
        echo "<p>Nenhum produto disponível nesta categoria.</p>";
    }
    ?>

 <!-- DOCES PARA EVENTOS -->
    <h3>Doces para Eventos</h3>

    <?php

    $temproduto = false;

    foreach ($produtos as $produto) {
        if ($produto['categoria'] == 'Docinhos para Eventos') {
            $temproduto = true;

    ?>

            <div class="produto">

                <label>
                    <input type="checkbox" name="produtos[]" value="<?php echo $produto['id']; ?>">
                        Selecionar
                </label>

                <h4>
                    <?php echo $produto['nome']; ?>
                </h4>

                <p>
                    <?php echo $produto['descricao']; ?>
                </p>

                <p>
                    R$
                    <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                </p>
            </div>

    <?php

        }
    }

    if ($temproduto == false) {
        echo "<p>Nenhum produto disponível nesta categoria.</p>";
    }
    ?>

    <!-- BOLOS PARA EVENTOS -->
    <h3>Bolos para Eventos</h3>

    <?php

    $temproduto = false;

    foreach ($produtos as $produto) {
        if ($produto['categoria'] == 'Bolos para Eventos') {
            $temproduto = true;

    ?>

            <div class="produto">
                <label>
                    <input type="checkbox" name="produtos[]" value="<?php echo $produto['id']; ?>">
                        Selecionar
                </label>

                <h4>
                    <?php echo $produto['nome']; ?>
                </h4>

                <p>
                    <?php echo $produto['descricao']; ?>
                </p>

                <p>
                    R$
                    <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                </p>
            </div>

    <?php

        }
    }

    if ($temproduto == false) {
        echo "<p>Nenhum produto disponível nesta categoria.</p>";
    }
    ?>

 <!-- KITS PARA EVENTOS -->
    <h3>Kits para Eventos</h3>

    <?php

    $temproduto = false;

    foreach ($produtos as $produto) {
        if ($produto['categoria'] == 'Kits para Eventos') {
            $temproduto = true;
    ?>

            <div class="produto">
                <label>
                    <input type="checkbox" name="produtos[]" value="<?php echo $produto['id']; ?>">
                        Selecionar
                </label>

                <h4>
                    <?php echo $produto['nome']; ?>
                </h4>

                <p>
                    <?php echo $produto['descricao']; ?>
                </p>

                <p>
                    R$
                    <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                </p>
            </div>

    <?php

        }
    }

    if ($temproduto == false) {
        echo "<p>Nenhum produto disponível nesta categoria.</p>";
    }
    ?>

    <!-- BEBIDAS -->
    <h3>Bebidas</h3>

    <?php

    $temproduto = false;

    foreach ($produtos as $produto) {
        if ($produto['categoria'] == 'Bebidas') {
            $temproduto = true;
    ?>

            <div class="produto">
                <label>
                    <input type="checkbox" name="produtos[]" value="<?php echo $produto['id']; ?>">
                        Selecionar
                </label>

                <h4>
                    <?php echo $produto['nome']; ?>
                </h4>

                <p>
                    <?php echo $produto['descricao']; ?>
                </p>

                <p>
                    R$
                    <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                </p>
            </div>

    <?php
        }
    }

    if ($temproduto == false) {
        echo "<p>Nenhum produto disponível nesta categoria.</p>";
    }
    ?>

        <button type="submit">
            Adicionar ao carrinho
        </button>
    </form>
</section>

<?php
include 'includes/footer.php';
?>