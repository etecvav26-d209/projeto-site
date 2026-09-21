-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/09/2026 às 01:22
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `confeitaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `observa` text DEFAULT NULL,
  `status` enum('carrinho','pendente','em preparo','pronto','entregue') NOT NULL DEFAULT 'carrinho',
  `data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `categoria` varchar(100) NOT NULL,
  `disponivel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `imagem`, `categoria`, `disponivel`) VALUES
(3, 'Macaron de Chocolate', 'Delicado e sofisticado, com casquinha levemente crocante e interior macio, recheado com um creme intenso de chocolate.', 8.00, 'imagens/doces/macaronchoc.jpeg', 'Doces Franceses', 1),
(4, 'Macaron de Pistache', 'Casquinha delicada com sabor marcante de pistache, combinada a um recheio cremoso e equilibrado.', 8.00, 'imagens/doces/macaronpistache.jpeg', 'Doces Franceses', 1),
(5, 'Macaron de Framboesa', 'Uma combinação delicada entre a textura característica do macaron e o sabor levemente ácido e frutado da framboesa.', 8.00, 'imagens/doces/macaronframbo.jpeg', 'Doces Franceses', 1),
(6, 'Macaron de Baunilha', 'Suave e aromático, com delicado sabor de baunilha e recheio cremoso que proporciona um equilíbrio elegante.', 8.00, 'imagens/doces/macaronbaunilha.jpeg', 'Doces Franceses', 1),
(7, 'Macaron de Limão Siciliano', 'Uma opção refrescante, unindo a delicadeza do macaron ao sabor cítrico e aromático do limão-siciliano.', 8.00, 'imagens/doces/macaronlimao.jpeg', 'Doces Franceses', 1),
(8, 'Éclair Sortida', 'Clássico da pâtisserie francesa preparado com massa choux leve e delicada, recheada com creme e finalizada com uma cobertura especial.', 14.00, 'imagens/doces/eclair.jpeg', 'Doces Franceses', 1),
(9, 'Crème Brûlée', 'Creme delicado de baunilha com textura aveludada, finalizado com uma fina camada de açúcar caramelizado.', 18.00, 'imagens/doces/cremebrulee.jpeg', 'Doces Franceses', 1),
(10, 'Madeleine', 'Tradicional bolinho francês de formato característico, com massa amanteigada, textura macia e aroma delicado.', 6.00, 'imagens/doces/madeleine.jpeg', 'Doces Franceses', 1),
(11, 'Canelé', 'Doce tradicional de Bordeaux, com exterior caramelizado e crocante e interior macio, aromático e delicadamente cremoso.', 10.00, 'imagens/doces/canele.jpeg', 'Doces Franceses', 1),
(12, 'Tartelette', 'Pequena torta artesanal inspirada na pâtisserie francesa, preparada com base delicada e recheio cremoso para uma experiência sofisticada.', 16.00, 'imagens/doces/tartelette.jpeg', 'Doces Franceses', 1),
(13, 'Mousse au Chocolat', 'Mousse de chocolate de textura leve e cremosa, com sabor intenso e acabamento delicado para os amantes de chocolate.', 15.00, 'imagens/doces/mousse.jpeg', 'Doces Franceses', 1),
(14, 'Bolo de Chocolate - Fatia', 'Bolo macio e saboroso de chocolate, perfeito para quem busca uma sobremesa clássica e reconfortante.', 15.00, 'imagens/doces/chocolate.jpeg', 'Doces Tradicionais', 1),
(15, 'Red Velvet - fatia', 'Bolo de textura macia e delicada, com sabor equilibrado e acabamento cremoso inspirado no clássico americano.', 16.00, 'imagens/doces/redvelvet.jpeg', 'Doces Tradicionais', 1),
(16, 'Ninho com Morango - fatia', 'Massa macia combinada com creme de leite Ninho e pedaços de morango, criando uma sobremesa delicada e cremosa.', 17.00, 'imagens/doces/boloninho.jpeg', 'Doces Tradicionais', 1),
(17, 'Bolo de Cenoura - fatia', 'Massa fofinha e aromática de cenoura, perfeita para acompanhar uma cobertura cremosa de chocolate.', 14.00, 'imagens/doces/cenoura.jpeg', 'Doces Tradicionais', 1),
(18, 'Cheesecake de Frutas Vermelhas - fatia', 'Cheesecake cremoso com textura delicada, finalizado com uma cobertura frutada de frutas vermelhas.', 18.00, 'imagens/doces/cheesecake.jpeg', 'Doces Tradicionais', 1),
(19, 'Torta de Limão - fatia', 'Base delicada combinada com creme de limão equilibrado entre o doce e o cítrico, finalizada de forma leve e elegante.', 15.00, 'imagens/doces/tortalimao.jpeg', 'Doces Tradicionais', 1),
(20, 'Pudim de Leite - fatia', 'Clássico pudim de textura lisa e cremosa, acompanhado por uma calda delicada de caramelo.', 12.00, 'imagens/doces/pudim.jpeg', 'Doces Tradicionais', 1),
(21, 'Banoffee - fatia', 'Sobremesa composta por base crocante, doce de leite cremoso, banana e uma camada suave de creme, formando uma combinação irresistível.', 18.00, 'imagens/doces/banoffe.jpeg', 'Doces Tradicionais', 1),
(22, 'Brigadeiro', 'Clássico brigadeiro artesanal, preparado com chocolate e leite condensado, com textura cremosa e sabor intenso.', 4.50, 'imagens/doces/brigadeiro.jpeg', 'Doces Tradicionais', 1),
(23, 'Beijinho', 'Doce delicado à base de coco e leite condensado, com textura macia e sabor tradicional.', 4.50, 'imagens/doces/beijinho.jpeg', 'Doces Tradicionais', 1),
(24, 'Cajuzinho', 'Doce tradicional de textura macia, com sabor marcante de amendoim e acabamento delicado.', 4.50, 'imagens/doces/cajuzinho.jpeg', 'Doces Tradicionais', 1),
(25, 'Bicho de Pé', 'Doce delicado de sabor frutado, com textura cremosa e acabamento suave.', 4.50, 'imagens/doces/bicho.jpeg', 'Doces Tradicionais', 1),
(26, 'Brigadeiro de Ninho', 'Brigadeiro cremoso preparado com leite Ninho, oferecendo um sabor suave, delicado e marcante.', 5.00, 'imagens/doces/ninho.jpeg', 'Doces Tradicionais', 1),
(27, 'Pistache', 'Docinho sofisticado com sabor delicado e marcante de pistache, ideal para composições elegantes.', 6.00, 'imagens/doces/pistache.jpeg', 'Docinhos para Eventos', 1),
(28, 'Chocolate Belga', 'Preparado com chocolate de sabor intenso e textura cremosa, perfeito para uma experiência mais sofisticada.', 6.00, 'imagens/doces/belga.jpeg', 'Docinhos para Eventos', 1),
(29, 'Caramelo Salgado', 'Equilíbrio entre o dulçor do caramelo e um toque sutil de sal, criando uma combinação sofisticada.', 6.00, 'imagens/doces/caramelo.jpeg', 'Docinhos para Eventos', 1),
(30, 'Frutas Vermelhas', 'Combinação delicada entre a cremosidade do doce e o sabor levemente ácido e frutado das frutas vermelhas.', 6.00, 'imagens/doces/frutas.jpeg', 'Docinhos para Eventos', 1),
(31, 'Limão Siciliano', 'Docinho refrescante e aromático, com o sabor cítrico característico do limão-siciliano.', 6.00, 'imagens/doces/limaosiciliano.jpeg', 'Docinhos para Eventos', 1),
(32, 'Coco Queimado', 'Docinho cremoso de coco com um toque tostado, proporcionando aroma e sabor mais intensos.', 6.00, 'imagens/doces/coco.jpeg', 'Docinhos para Eventos', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('cliente','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES
(11, 'user principal', 'noirandsugar@gmail.com', '$2y$10$AaZAWOi2tZDhT1qItuvHYuXcMgAie/3V7l6lEXQuvPAI345qeF6a2', 'admin'),
(13, 'laura', 'dduartelaureta@gmail.com', '$2y$10$1Y8JHE8Byaygo.Mnd6dLc.seqovuKTpgVf9Ru/KhQ44Fd9DuaEOlC', 'cliente');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_itens_pedidos` (`pedido_id`),
  ADD KEY `fk_itens_usuarios` (`produto_id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedidos_usuarios` (`usuario_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens`
--
ALTER TABLE `itens`
  ADD CONSTRAINT `fk_itens_pedidos` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_itens_usuarios` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
