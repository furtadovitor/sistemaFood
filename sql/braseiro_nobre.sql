-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Nov-2022 às 02:29
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `braseiro_nobre`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairros`
--

CREATE TABLE `bairros` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `cidade` varchar(40) NOT NULL DEFAULT 'Rio de Janeiro',
  `valor_entrega` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bairros`
--

INSERT INTO `bairros` (`id`, `nome`, `slug`, `cidade`, `valor_entrega`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Vila da Penha', 'vila-da-penha', 'Rio de Janeiro', '5.00', 1, '2022-11-04 10:15:21', '2022-11-04 10:15:35', NULL),
(2, 'Cordovil', 'cordovil', 'Rio de Janeiro', '7.00', 1, '2022-11-04 10:15:45', '2022-11-04 10:15:45', NULL),
(3, 'Vista Alegre', 'vista-alegre', 'Rio de Janeiro', '7.00', 1, '2022-11-04 10:16:13', '2022-11-04 10:16:13', NULL),
(4, 'Irajá', 'iraja', 'Rio de Janeiro', '7.00', 1, '2022-11-04 10:16:45', '2022-11-04 10:16:45', NULL),
(5, 'Olaria', 'olaria', 'Rio de Janeiro', '10.00', 1, '2022-11-04 10:17:16', '2022-11-04 10:17:16', NULL),
(6, 'Ramos', 'ramos', 'Rio de Janeiro', '10.00', 1, '2022-11-04 10:17:34', '2022-11-04 10:17:34', NULL),
(7, 'Vila Kosmos', 'vila-kosmos', 'Rio de Janeiro', '3.00', 1, '2022-11-04 10:17:54', '2022-11-04 10:17:54', NULL),
(8, 'Penha Circular', 'penha-circular', 'Rio de Janeiro', '5.00', 1, '2022-11-04 10:18:15', '2022-11-04 10:18:15', NULL),
(9, 'Penha', 'penha', 'Rio de Janeiro', '6.00', 1, '2022-11-04 10:18:58', '2022-11-04 10:18:58', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `slug`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Churrasco', 'churrasco', 1, '2022-11-04 10:12:18', '2022-11-04 10:12:18', NULL),
(2, 'Bebidas', 'bebidas', 1, '2022-11-04 10:12:27', '2022-11-04 10:12:27', NULL),
(3, 'Drinks', 'drinks', 1, '2022-11-04 10:12:34', '2022-11-04 10:12:34', NULL),
(4, 'Petiscos', 'petiscos', 1, '2022-11-04 10:12:42', '2022-11-04 10:12:42', NULL),
(5, 'Pratos Executivos', 'pratos-executivos', 1, '2022-11-04 10:13:00', '2022-11-04 10:13:00', NULL),
(6, 'Para galera', 'para-galera', 1, '2022-11-04 10:13:12', '2022-11-04 10:13:12', NULL),
(7, 'Galetos', 'galetos', 1, '2022-11-04 10:13:20', '2022-11-04 10:13:20', NULL),
(8, 'Costela', 'costela', 1, '2022-11-04 10:13:30', '2022-11-04 10:13:30', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregadores`
--

CREATE TABLE `entregadores` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `cnh` varchar(20) NOT NULL,
  `email` varchar(120) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(250) NOT NULL,
  `imagem` varchar(250) DEFAULT NULL,
  `veiculo` varchar(250) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entregadores`
--

INSERT INTO `entregadores` (`id`, `nome`, `cpf`, `cnh`, `email`, `telefone`, `endereco`, `imagem`, `veiculo`, `placa`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Fernando Xarba', '788.270.530-69', '23873560280', 'fernando@gmail.com', '(21) 33415-0051', 'Rua sem casa, ap 105 - Cordovil - RJ', '1667953386_cbbf155a28d273b363e3.jpg', 'Fazer Preta', 'LLB-8888', 1, '2022-11-08 21:22:19', '2022-11-08 21:23:06', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `expediente`
--

CREATE TABLE `expediente` (
  `id` int(5) UNSIGNED NOT NULL,
  `dia` int(5) NOT NULL,
  `dia_descricao` varchar(50) NOT NULL,
  `abertura_hora` time DEFAULT NULL,
  `fechamento_hora` time DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `expediente`
--

INSERT INTO `expediente` (`id`, `dia`, `dia_descricao`, `abertura_hora`, `fechamento_hora`, `situacao`) VALUES
(1, 0, 'Domingo', '18:00:00', '23:00:00', 1),
(2, 1, 'Segunda-Feira', '18:00:00', '23:00:00', 1),
(3, 2, 'Terça-Feira', '18:00:00', '23:00:00', 1),
(4, 3, 'Quarta-Feira', '18:00:00', '23:00:00', 0),
(5, 4, 'Quinta-Feira', '18:00:00', '23:00:00', 1),
(6, 5, 'Sexta-Feira', '18:00:00', '23:00:00', 1),
(7, 6, 'Sábado', '18:00:00', '23:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `extras`
--

CREATE TABLE `extras` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `extras`
--

INSERT INTO `extras` (`id`, `nome`, `slug`, `preco`, `descricao`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Alho frito ', 'alho-frito', '3.00', '', 1, '2022-11-08 21:44:59', '2022-11-08 21:44:59', NULL),
(2, 'Vinagrete', 'vinagrete', '3.00', '', 1, '2022-11-08 21:45:21', '2022-11-08 21:45:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pagamento`
--

CREATE TABLE `formas_pagamento` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formas_pagamento`
--

INSERT INTO `formas_pagamento` (`id`, `nome`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Dinheiro', 1, '2022-11-04 10:53:23', '2022-11-04 10:53:26', NULL),
(2, 'Cartão de Crédito', 1, '2022-11-04 10:53:43', '2022-11-04 10:53:44', NULL),
(3, 'Alelo Refeição', 1, '2022-11-04 10:53:59', '2022-11-04 10:53:59', NULL),
(4, 'Cartão de débito', 1, '2022-11-04 10:54:10', '2022-11-04 10:54:12', NULL),
(5, 'Tícket Refeição', 1, '2022-11-04 10:56:52', '2022-11-04 10:56:53', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medidas`
--

CREATE TABLE `medidas` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medidas`
--

INSERT INTO `medidas` (`id`, `nome`, `descricao`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, '100 gramas', '', 1, '2022-11-04 10:29:39', '2022-11-04 10:29:39', NULL),
(2, '200 gramas', '', 1, '2022-11-04 10:29:47', '2022-11-04 10:29:47', NULL),
(3, '300 gramas', '', 1, '2022-11-04 10:29:53', '2022-11-04 10:29:53', NULL),
(4, '400 gramas', '', 1, '2022-11-04 10:30:01', '2022-11-04 10:30:01', NULL),
(5, '500 gramas', '', 1, '2022-11-04 10:30:07', '2022-11-04 10:30:07', NULL),
(6, '600 gramas', '', 1, '2022-11-04 10:30:13', '2022-11-04 10:30:13', NULL),
(7, 'Unitário', '', 1, '2022-11-07 15:54:47', '2022-11-07 15:54:47', NULL),
(8, 'Latinha - 269ML', '', 1, '2022-11-07 16:06:23', '2022-11-07 16:06:23', NULL),
(9, 'Lata - 350ML', '', 1, '2022-11-07 16:06:31', '2022-11-07 16:06:31', NULL),
(10, 'Garrafa - 600ML', '', 1, '2022-11-07 16:06:49', '2022-11-07 16:06:49', NULL),
(11, 'Garrafa - 1L', '', 1, '2022-11-07 16:06:59', '2022-11-07 16:06:59', NULL),
(12, 'Garrafa - 2L', '', 1, '2022-11-07 16:07:07', '2022-11-07 16:07:07', NULL),
(13, 'Cachaça', '', 1, '2022-11-07 16:16:58', '2022-11-07 16:17:07', '2022-11-07 16:17:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-08-29-174956', 'App\\Database\\Migrations\\CriaTabelaUsuarios', 'default', 'App', 1667868919, 1),
(2, '2022-09-09-165831', 'App\\Database\\Migrations\\CriaTabelaCategorias', 'default', 'App', 1667868919, 1),
(3, '2022-09-12-142614', 'App\\Database\\Migrations\\CriaTabelaExtras', 'default', 'App', 1667868919, 1),
(4, '2022-09-13-124007', 'App\\Database\\Migrations\\CriaTabelaMedidas', 'default', 'App', 1667868919, 1),
(5, '2022-09-13-140946', 'App\\Database\\Migrations\\CriaTabelaProdutos', 'default', 'App', 1667868920, 1),
(6, '2022-09-15-173926', 'App\\Database\\Migrations\\CriaTabelaProdutosExtras', 'default', 'App', 1667868920, 1),
(7, '2022-09-16-183525', 'App\\Database\\Migrations\\CriaTabelaProdutosEspecificacoes', 'default', 'App', 1667868920, 1),
(8, '2022-09-21-180914', 'App\\Database\\Migrations\\CriaTabelaFormasPagamento', 'default', 'App', 1667868921, 1),
(9, '2022-09-27-171606', 'App\\Database\\Migrations\\CriaTabelaEntregadores', 'default', 'App', 1667868921, 1),
(10, '2022-09-28-190246', 'App\\Database\\Migrations\\CriaTabelaBairros', 'default', 'App', 1667868921, 1),
(11, '2022-09-30-143958', 'App\\Database\\Migrations\\CriaTabelaExpediente', 'default', 'App', 1667868921, 1),
(12, '2022-11-03-180901', 'App\\Database\\Migrations\\CriaTabelaPedidos', 'default', 'App', 1667868922, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(5) UNSIGNED NOT NULL,
  `usuario_id` int(5) UNSIGNED NOT NULL,
  `entregador_id` int(5) UNSIGNED DEFAULT NULL,
  `codigo` varchar(10) NOT NULL,
  `forma_pagamento` varchar(50) NOT NULL,
  `situacao` tinyint(1) NOT NULL DEFAULT 0,
  `produtos` text NOT NULL,
  `valor_produtos` decimal(10,2) NOT NULL,
  `valor_entrega` decimal(10,2) NOT NULL,
  `valor_pedido` decimal(10,2) NOT NULL,
  `endereco_entrega` varchar(255) NOT NULL,
  `observacoes` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `entregador_id`, `codigo`, `forma_pagamento`, `situacao`, `produtos`, `valor_produtos`, `valor_entrega`, `valor_pedido`, `endereco_entrega`, `observacoes`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 2, NULL, '83504617', 'Alelo Refeição', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:19:\"Picanha 200 gramas \";s:4:\"slug\";s:18:\"picanha-200-gramas\";s:5:\"preco\";s:5:\"35.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:10:\"200 gramas\";}}', '35.00', '7.00', '42.00', 'Cordovil - Rio de Janeiro - Rua Ministro Ribeiro da Costa - 21250-200 - RJ  </span>- Número 124', '', '2022-11-04 11:46:53', '2022-11-04 11:46:53', NULL),
(2, 2, NULL, '18045793', 'Alelo Refeição', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:19:\"Picanha 200 gramas \";s:4:\"slug\";s:18:\"picanha-200-gramas\";s:5:\"preco\";s:5:\"35.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:10:\"200 gramas\";}}', '35.00', '7.00', '42.00', 'Cordovil - Rio de Janeiro - Rua Ministro Ribeiro da Costa - 21250-200 - RJ  </span>- Número 124', '', '2022-11-04 11:47:53', '2022-11-04 11:47:53', NULL),
(3, 2, NULL, '51674930', 'Tícket Refeição', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:19:\"Picanha 200 gramas \";s:4:\"slug\";s:18:\"picanha-200-gramas\";s:5:\"preco\";s:5:\"35.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:10:\"200 gramas\";}}', '35.00', '7.00', '42.00', 'Cordovil - Rio de Janeiro - Rua Ministro Ribeiro da Costa - 21250-200 - RJ  </span>- Número 214', 'Complemento e ponto de referência: ap 100 - Número: 214', '2022-11-04 11:53:52', '2022-11-04 11:53:52', NULL),
(4, 2, NULL, '96241538', 'Cartão de Crédito', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:19:\"Picanha 200 gramas \";s:4:\"slug\";s:18:\"picanha-200-gramas\";s:5:\"preco\";s:5:\"35.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:10:\"200 gramas\";}}', '35.00', '5.00', '40.00', 'Vila da Penha - Rio de Janeiro - Rua Carlos Chambelland - 21210-090 - RJ  </span>- Número 214', 'Complemento e ponto de referência: ap 100 - Número: 214', '2022-11-04 11:54:14', '2022-11-04 11:54:14', NULL),
(5, 2, NULL, '02198356', 'Cartão de débito', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:19:\"Picanha 200 gramas \";s:4:\"slug\";s:18:\"picanha-200-gramas\";s:5:\"preco\";s:5:\"35.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:10:\"200 gramas\";}}', '35.00', '7.00', '42.00', 'Cordovil - Rio de Janeiro - Rua Ministro Ribeiro da Costa - 21250-200 - RJ  </span>- Número 124', 'Complemento e ponto de referência: ap 102  - Número: 124', '2022-11-04 13:28:52', '2022-11-04 13:28:52', NULL),
(6, 2, NULL, '04596137', 'Cartão de débito', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:19:\"Picanha 200 gramas \";s:4:\"slug\";s:18:\"picanha-200-gramas\";s:5:\"preco\";s:5:\"35.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:10:\"200 gramas\";}}', '35.00', '7.00', '42.00', 'Cordovil - Rio de Janeiro - Rua Ministro Ribeiro da Costa - 21250-200 - RJ  </span>- Número 124', 'Complemento e ponto de referência: ap 102  - Número: 124', '2022-11-04 13:38:47', '2022-11-04 13:38:47', NULL),
(7, 2, NULL, '19354620', 'Cartão de Crédito', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:19:\"Picanha 200 gramas \";s:4:\"slug\";s:18:\"picanha-200-gramas\";s:5:\"preco\";s:5:\"35.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:10:\"200 gramas\";}}', '35.00', '7.00', '42.00', 'Cordovil - Rio de Janeiro - Rua Ministro Ribeiro da Costa - 21250-200 - RJ  </span>- Número 11', 'Complemento e ponto de referência: ap 100 - Número: 11', '2022-11-04 13:40:44', '2022-11-04 13:40:44', NULL),
(8, 2, NULL, '02935674', 'Cartão de débito', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:19:\"Picanha 100 gramas \";s:4:\"slug\";s:18:\"picanha-100-gramas\";s:5:\"preco\";s:5:\"18.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:10:\"100 gramas\";}}', '18.00', '7.00', '25.00', 'Irajá - Rio de Janeiro - Rua Iandu - 21220-340 - RJ  </span>- Número 122', 'Complemento e ponto de referência: wqwq - Número: 122', '2022-11-04 13:41:14', '2022-11-04 13:41:14', NULL),
(9, 1, NULL, '53601897', 'Cartão de débito', 0, 'a:2:{i:0;a:6:{s:2:\"id\";s:1:\"9\";s:4:\"nome\";s:26:\"Coca-Cola Garrafa - 600ML \";s:4:\"slug\";s:23:\"coca-cola-garrafa-600ml\";s:5:\"preco\";s:4:\"8.00\";s:10:\"quantidade\";i:5;s:7:\"tamanho\";s:15:\"Garrafa - 600ML\";}i:1;a:6:{s:2:\"id\";s:1:\"5\";s:4:\"nome\";s:23:\"Pão de alho Unitário \";s:4:\"slug\";s:20:\"pao-de-alho-unitario\";s:5:\"preco\";s:4:\"5.00\";s:10:\"quantidade\";i:3;s:7:\"tamanho\";s:9:\"Unitário\";}}', '55.00', '5.00', '60.00', 'Vila da Penha - Rio de Janeiro - Rua Carlos Chambelland - 21210-090 - RJ- Número 22', 'Complemento e ponto de referência: 40 Bloco 2 Apt 402 - Número: 22', '2022-11-08 20:47:35', '2022-11-08 20:47:35', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(5) UNSIGNED NOT NULL,
  `categoria_id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `ingredientes` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `imagem` varchar(200) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `categoria_id`, `nome`, `slug`, `ingredientes`, `ativo`, `imagem`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 1, 'Picanha', 'picanha', 'Picanha suculenta ', 1, '1667846368_8d8b767b3f4f1d1a94a0.jpg', '2022-11-04 10:23:04', '2022-11-07 15:39:28', NULL),
(2, 1, 'Alcatra', 'alcatra', 'Alcatra suculenta e muito macia', 1, '1667846413_e2a842ff1bdb20d10a6e.jpg', '2022-11-04 10:24:03', '2022-11-07 15:40:13', NULL),
(3, 1, 'Linguiça de porco', 'linguica-de-porco', 'Linguiça de porco totalmente saborosa com o temperinho da casa', 1, '1667846486_460d0ce2df263c8c83c9.jpg', '2022-11-04 10:24:32', '2022-11-07 15:41:26', NULL),
(4, 1, 'Linguiça mineira', 'linguica-mineira', 'Linguicinha mineira picante', 1, '1667846629_422d802f76aebd09f78d.jpg', '2022-11-04 10:25:58', '2022-11-07 15:43:49', NULL),
(5, 1, 'Pão de alho', 'pao-de-alho', 'Pão de alho artesanal', 1, '1667846738_a9231e6a45bd4450bd76.jpg', '2022-11-04 10:26:30', '2022-11-07 15:45:38', NULL),
(6, 1, 'Frango tulipinha', 'frango-tulipinha', 'Metade da asa do frango ', 1, '1667846772_97f6e4716ea55bae7be7.png', '2022-11-04 10:28:12', '2022-11-07 15:46:12', NULL),
(7, 1, 'Asa de frango', 'asa-de-frango', 'Asa de frango temperada caseiramente', 1, '1667846802_c2888dd71da3a07e57ee.jpg', '2022-11-04 10:28:37', '2022-11-07 15:46:42', NULL),
(8, 1, 'Sobrecoxa', 'sobrecoxa', 'Sobrecoxa temperada caseiramente deliciosa', 1, '1667846863_798e63b1315fec7c6429.jpg', '2022-11-04 10:29:10', '2022-11-07 15:47:43', NULL),
(9, 2, 'Coca-Cola', 'coca-cola', 'Cola cola super gelada e saborosa :)', 1, '1667847652_7d7eff95843d04922a40.png', '2022-11-07 16:00:25', '2022-11-07 16:00:52', NULL),
(10, 2, 'Pepsi', 'pepsi', 'Pepsi gelada e saborosa :)', 1, '1667847814_251f097c21228dfe1221.png', '2022-11-07 16:01:49', '2022-11-07 16:05:51', NULL),
(11, 2, 'Guaraná Antarctica ', 'guarana-antarctica', 'Guaraná  super gelado e saboroso :)', 1, '1667847933_307c150cab1bf033b2eb.jpg', '2022-11-07 16:05:27', '2022-11-07 16:10:40', NULL),
(12, 3, 'Moscow Mule', 'moscow-mule', 'É um cocktail feito com vodka, cerveja de gengibre picante, e suco de limão.', 1, '1667848395_f7c61c72bcadedf491a1.jpg', '2022-11-07 16:13:08', '2022-11-07 16:13:15', NULL),
(13, 3, 'Caipirinha', 'caipirinha', 'Caipirinha mais tradicional da Vila da Penha', 1, '1667848477_e6b5cd7cede67be89280.jpg', '2022-11-07 16:14:32', '2022-11-07 16:14:37', NULL),
(14, 3, 'Mojito', 'mojito', 'É Feito com rum branco, hortelã, club soda (ou água com gás), suco de limão e açúcar.', 1, '1667848585_210006aaf1390d66e180.jpg', '2022-11-07 16:16:20', '2022-11-07 16:16:25', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_especificacoes`
--

CREATE TABLE `produtos_especificacoes` (
  `id` int(5) UNSIGNED NOT NULL,
  `produto_id` int(5) UNSIGNED NOT NULL,
  `medida_id` int(5) UNSIGNED NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `customizavel` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos_especificacoes`
--

INSERT INTO `produtos_especificacoes` (`id`, `produto_id`, `medida_id`, `preco`, `customizavel`) VALUES
(1, 1, 1, '18.00', 0),
(2, 1, 2, '35.00', 0),
(3, 2, 1, '10.00', 0),
(8, 2, 2, '20.00', 0),
(9, 2, 3, '30.00', 0),
(10, 2, 4, '40.00', 0),
(11, 2, 5, '50.00', 0),
(12, 2, 6, '60.00', 0),
(13, 3, 1, '8.00', 0),
(14, 3, 2, '16.00', 0),
(15, 4, 1, '8.00', 0),
(16, 4, 2, '16.00', 0),
(17, 5, 7, '5.00', 0),
(18, 6, 1, '8.00', 0),
(19, 6, 2, '16.00', 0),
(20, 7, 1, '8.00', 0),
(21, 7, 2, '16.00', 0),
(22, 8, 1, '8.00', 0),
(23, 8, 2, '16.00', 0),
(24, 9, 10, '8.00', 0),
(25, 9, 9, '6.00', 0),
(26, 9, 8, '5.00', 0),
(27, 9, 11, '10.00', 0),
(28, 9, 12, '13.00', 0),
(29, 10, 11, '10.00', 0),
(30, 11, 9, '6.00', 0),
(31, 14, 7, '20.00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_extras`
--

CREATE TABLE `produtos_extras` (
  `id` int(5) UNSIGNED NOT NULL,
  `produto_id` int(5) UNSIGNED NOT NULL,
  `extra_id` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 0,
  `password_hash` varchar(64) NOT NULL,
  `ativacao_hash` varchar(255) DEFAULT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_expira_em` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `is_admin`, `ativo`, `password_hash`, `ativacao_hash`, `reset_hash`, `reset_expira_em`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Vitor Hugo Furtado Pereira', 'vitor.furtadopereira@gmail.com', '167.075.047-70', '', 1, 1, '$2y$10$2HcFXQTfs/qDUvaqs5vpau/1ssbPI58JV/gtICZA3jUtO5lWXg8jG', NULL, NULL, NULL, '2022-11-04 10:08:38', '2022-11-04 10:09:28', NULL),
(2, 'Liliana Rocha Fonseca', 'yobena8693@hempyl.com', '182.718.670-40', '(21) 99999-9999', 0, 1, '$2y$10$VzYe6/g1CadQtTpo28ZaJuYR3m0I5VQh6tfgJsjCtzk0B185S.asi', NULL, NULL, NULL, '2022-11-04 10:51:58', '2022-11-04 10:51:58', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `entregadores`
--
ALTER TABLE `entregadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `cnh` (`cnh`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- Índices para tabela `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_usuario_id_foreign` (`usuario_id`),
  ADD KEY `pedidos_entregador_id_foreign` (`entregador_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `produtos_categoria_id_foreign` (`categoria_id`);

--
-- Índices para tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_especificacoes_produto_id_foreign` (`produto_id`),
  ADD KEY `produtos_especificacoes_medida_id_foreign` (`medida_id`);

--
-- Índices para tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_extras_produto_id_foreign` (`produto_id`),
  ADD KEY `produtos_extras_extra_id_foreign` (`extra_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `ativacao_hash` (`ativacao_hash`),
  ADD UNIQUE KEY `reset_hash` (`reset_hash`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `entregadores`
--
ALTER TABLE `entregadores`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `expediente`
--
ALTER TABLE `expediente`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_entregador_id_foreign` FOREIGN KEY (`entregador_id`) REFERENCES `entregadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Limitadores para a tabela `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  ADD CONSTRAINT `produtos_especificacoes_medida_id_foreign` FOREIGN KEY (`medida_id`) REFERENCES `medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_especificacoes_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtos_extras`
--
ALTER TABLE `produtos_extras`
  ADD CONSTRAINT `produtos_extras_extra_id_foreign` FOREIGN KEY (`extra_id`) REFERENCES `extras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_extras_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
