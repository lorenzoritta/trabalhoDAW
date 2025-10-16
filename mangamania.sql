-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/09/2025 às 23:00
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
-- Banco de dados: `mangamania`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome`) VALUES
(1, 'aventura'),
(2, 'romance');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(1000) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `email`, `senha`, `endereco`, `usuario`) VALUES
(1, 'lorenzo', 'tidenit552@ahvin.com', '1234', NULL, NULL),
(7, 'gabriel', 'xaxigaj249@poesd.com', 'be9c38b1424440266193f4251d0dcd0b', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem`
--

CREATE TABLE `imagem` (
  `idimagem` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `id_manga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imagem`
--

INSERT INTO `imagem` (`idimagem`, `nome`, `id_manga`) VALUES
(2, 'hori.webp', 2),
(3, 'dbz.webp', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mangas`
--

CREATE TABLE `mangas` (
  `id_manga` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `editora` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL,
  `pais_origem` varchar(50) DEFAULT NULL,
  `num_volumes` int(11) DEFAULT NULL,
  `ofertar` tinyint(1) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mangas`
--

INSERT INTO `mangas` (`id_manga`, `nome`, `editora`, `descricao`, `autor`, `preco`, `data_lancamento`, `pais_origem`, `num_volumes`, `ofertar`, `id_categoria`) VALUES
(2, 'horimiya', 'Square Enix', 'aaaaaaaaa', 'Hiroki Adachi', 99.00, '2008-10-22', 'japao', 99, 0, 2),
(3, 'dragon ball z', 'Weekly Shōnen Jump ', 'aaaaaaaaa', 'akira toriyama', 99.00, '1989-04-26', 'japao', 15, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mangas_has_vendas`
--

CREATE TABLE `mangas_has_vendas` (
  `id_mangas` int(11) NOT NULL,
  `id_vendas` int(11) NOT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mangas_has_vendas`
--

INSERT INTO `mangas_has_vendas` (`id_mangas`, `id_vendas`, `preco`, `quantidade`) VALUES
(3, 77, 99.00, 1),
(3, 78, 99.00, 1),
(3, 79, 99.00, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id_vendas` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `status_venda` varchar(50) DEFAULT NULL,
  `forma_pagamento` varchar(50) DEFAULT NULL,
  `data_venda` date DEFAULT NULL,
  `entrega` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id_vendas`, `id_cliente`, `status_venda`, `forma_pagamento`, `data_venda`, `entrega`) VALUES
(79, 1, 'Processando', 'PIX', '2025-08-21', 'Rodovia Raposo Tavares');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Índices de tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`idimagem`),
  ADD KEY `id_manga` (`id_manga`);

--
-- Índices de tabela `mangas`
--
ALTER TABLE `mangas`
  ADD PRIMARY KEY (`id_manga`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `mangas_has_vendas`
--
ALTER TABLE `mangas_has_vendas`
  ADD PRIMARY KEY (`id_mangas`,`id_vendas`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id_vendas`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `idimagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `mangas`
--
ALTER TABLE `mangas`
  MODIFY `id_manga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id_vendas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`id_manga`) REFERENCES `mangas` (`id_manga`);

--
-- Restrições para tabelas `mangas`
--
ALTER TABLE `mangas`
  ADD CONSTRAINT `mangas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Restrições para tabelas `mangas_has_vendas`
--
ALTER TABLE `mangas_has_vendas`
  ADD CONSTRAINT `mangas_has_vendas_ibfk_1` FOREIGN KEY (`id_mangas`) REFERENCES `mangas` (`id_manga`);

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
