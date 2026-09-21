<?php

require_once "config/conexao.php";
include 'includes/header.php';

$sql = "SELECT * FROM produtos WHERE disponivel = 1";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$categorias = [
    'Doces Franceses',
    'Doces Tradicionais',
    'Docinhos para Eventos',
    'Bolos para Eventos',
    'Kits para Eventos',
    'Bebidas'
];

?>

<div class="sanfona">
    <input type="checkbox" id="sanfona-toggle" class="sanfona-toggle">
    <label for="sanfona-toggle" class="btn-sanfonado" aria-controls="sanfona-menu">
        <span>Menu</span>
        <span class="sanfona-icone">+</span>
    </label>

    <div id="sanfona-menu" class="sanfona-content">
        <ul class="sanfona-list">
            <li><a href="menu/ajuda.php">Ajuda</a></li>
            <li><a href="menu/loja.php">Loja</a></li>
            <li><a href="menu/sobre.php">Sobre</a></li>
        </ul>
    </div>
</div>

<section id="inicio" class="hero">

    <img src="imagens/fundo.jpeg" alt="Delícias da Noir & Sugar">

    <div class="hero-overlay"></div>

    <div class="hero-conteudo">
        <span class="hero-tag">CONFEITARIA ARTESANAL</span>

        <h1>Bem-vindo ao <strong>Noir & Sugar</strong></h1>

        <p>Cada mordida é uma experiência.</p>

        <a class="hero-botao" href="#cardapio">Conheça nosso cardápio</a>
    </div>

</section>

<section id="galeria" class="galeria">

    <div class="secao-cabecalho">
        <span class="mini-titulo">FEITO COM CARINHO</span>
        <h2>Nosso trabalho</h2>
        <p>Doces preparados para transformar momentos simples em lembranças especiais.</p>
    </div>

    <div class="galeria-imagens">

        <figure>
            <img src="imagens/doces/galeria1.jpeg" alt="Doce artesanal Noir & Sugar">
        </figure>

        <figure>
            <img src="imagens/doces/galeria2.jpeg" alt="Doce artesanal Noir & Sugar">
        </figure>

        <figure>
            <img src="imagens/doces/galeria3.jpeg" alt="Doce artesanal Noir & Sugar">
        </figure>

        <figure>
            <img src="imagens/doces/galeria4.jpeg" alt="Doce artesanal Noir & Sugar">
        </figure>

        <figure>
            <img src="imagens/doces/galeria5.jpeg" alt="Doce artesanal Noir & Sugar">
        </figure>

        <figure>
            <img src="imagens/doces/galeria6.jpeg" alt="Doce artesanal Noir & Sugar">
        </figure>

        <figure>
            <img src="imagens/doces/galeria7.jpeg" alt="Doce artesanal Noir & Sugar">
        </figure>

    </div>

</section>

<section id="cardapio" class="cardapio">

    <div class="secao-cabecalho">
        <span class="mini-titulo">ESCOLHA SEU FAVORITO</span>
        <h2>Nosso cardápio</h2>
        <p>Selecione os produtos que deseja adicionar ao seu pedido.</p>
    </div>

    <form method="POST" action="encomendas.php">

        <?php foreach ($categorias as $categoria): ?>

            <?php
            $produtosCategoria = array_filter($produtos, function ($produto) use ($categoria) {
                return $produto['categoria'] === $categoria;
            });
            ?>

            <div class="categoria-card">

                <div class="categoria-titulo">
                    <span></span>
                    <h3><?php echo htmlspecialchars($categoria); ?></h3>
                    <span></span>
                </div>

                <?php if (!empty($produtosCategoria)): ?>

                    <div class="produtos-grid">

                        <?php foreach ($produtosCategoria as $produto): ?>

                            <article class="produto">

                                <?php if (!empty($produto['imagem'])): ?>
                                    <div class="produto-imagem">
                                        <img
                                            src="<?php echo htmlspecialchars($produto['imagem']); ?>"
                                            alt="<?php echo htmlspecialchars($produto['nome']); ?>"
                                        >
                                    </div>
                                <?php else: ?>
                                    <div class="produto-imagem produto-sem-imagem">
                                        <span>✦</span>
                                    </div>
                                <?php endif; ?>

                                <div class="produto-info">

                                    <div class="produto-topo">
                                        <h4><?php echo htmlspecialchars($produto['nome']); ?></h4>

                                        <label class="produto-selecao">
                                            <input
                                                type="checkbox"
                                                name="produtos[]"
                                                value="<?php echo (int) $produto['id']; ?>"
                                            >
                                            <span>Selecionar</span>
                                        </label>
                                    </div>

                                    <p class="produto-descricao">
                                        <?php echo htmlspecialchars($produto['descricao']); ?>
                                    </p>

                                    <strong class="produto-preco">
                                        R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                                    </strong>

                                </div>

                            </article>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <p class="sem-produtos">Nenhum produto disponível nesta categoria.</p>

                <?php endif; ?>

            </div>

        <?php endforeach; ?>

        <div class="pedido-acao">
            <p>Já escolheu seus favoritos?</p>

            <button class="botao-carrinho" type="submit">
                Adicionar ao carrinho
                <span>→</span>
            </button>
        </div>

    </form>

</section>

<?php
include 'includes/footer.php';
?>
