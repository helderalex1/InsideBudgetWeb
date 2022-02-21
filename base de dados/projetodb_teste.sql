-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 21-Fev-2022 às 06:52
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetodb_teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assunto`
--

DROP TABLE IF EXISTS `assunto`;
CREATE TABLE IF NOT EXISTS `assunto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assunto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `assunto`
--

INSERT INTO `assunto` (`id`, `assunto`) VALUES
(1, 'Problema nos produtos'),
(2, 'Dúvidas de manuseamento website'),
(3, 'Problema nas categorias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '2', 1644777809),
('fornecedor', '11', 1645050655),
('fornecedor', '12', 1645050748),
('fornecedor', '13', 1645050820),
('fornecedor', '8', 1644959944),
('instalador', '1', 1644777809),
('instalador', '10', 1645050394),
('instalador', '14', 1645233844),
('instalador', '9', 1645050293);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'admin', NULL, NULL, NULL, NULL),
('fornecedor', 1, 'fornecedor', NULL, NULL, NULL, NULL),
('instalador', 1, 'instalador', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('admin', NULL, NULL, NULL),
('fornecedor', NULL, NULL, NULL),
('instalador', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `nif` int(11) NOT NULL,
  `telefone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `empresa`, `morada`, `nif`, `telefone`, `email`, `user_id`) VALUES
(91, 'Elda', 'Mar', 'Mg', 12345, 9876, 'Sgauxjek', 1),
(92, 'slvnlk', 'nlvk', 'n lv', 12, 12, 'scd@sda.co', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dadospessoais`
--

DROP TABLE IF EXISTS `dadospessoais`;
CREATE TABLE IF NOT EXISTS `dadospessoais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomecompleto` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `telefone` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_2` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dadospessoais`
--

INSERT INTO `dadospessoais` (`id`, `nomecompleto`, `empresa`, `pais`, `cidade`, `morada`, `telefone`, `user_id`) VALUES
(1, 'afa', 'jkjkbj', 'bkjbkjbkj', 'bkjbjkb', 'kbjkbbjk', 12, 1),
(2, 'fornecedor', 'ssvd', 'bjbjk', 'kjb', 'lknkj', 12, 8),
(4, 'admin', 'ssvd', 'bjbjk', 'kjb', 'lknkj', 12, 2),
(5, 'nlknlknl', 'klnlk', 'nlknlkn', 'lknlkn', 'nlknl', 12, 9),
(6, 'instalador 1', 'jsjms', 'jzjzk', 'bznsk', 'znm', 646, 10),
(7, 'JJka', 'sjzja', 'ak', 'zjsm', 'ajakka', 4646, 11),
(8, 'kjb', 'kn', 'jkb', 'kbkj', 'bkjb', 12, 12),
(9, 'kjb', 'kn', 'jkb', 'kbkj', 'bkjb', 12, 13),
(10, 'xjjzjzsm', 'jdjskz', 'Polónia', 'zjjs', 'sjsksk', 4644, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1641417020),
('m130524_201442_init', 1641417022),
('m190124_110200_add_verification_token_column_to_user_table', 1641417022),
('m140506_102106_rbac_init', 1641417428),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1641417428),
('m180523_151638_rbac_updates_indexes_without_prefix', 1641417428),
('m200409_110543_rbac_update_mssql_trigger', 1641417429);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

DROP TABLE IF EXISTS `orcamento`;
CREATE TABLE IF NOT EXISTS `orcamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  `data` datetime DEFAULT NULL,
  `uid` varchar(255) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `randomString` (`uid`),
  KEY `cliente_id` (`cliente_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`id`, `nome`, `descricao`, `total`, `data`, `uid`, `cliente_id`, `user_id`) VALUES
(1, 'mnvskbj', 'vdf\r\n', 4440000, '2022-02-18 11:28:26', 'rUQtKvJk2SU8', 91, 1),
(2, 'mnlkn', 'lnlk\r\n', 1212, '2022-02-19 02:53:23', 'SQCMF3eYBZFN', 92, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento_produto`
--

DROP TABLE IF EXISTS `orcamento_produto`;
CREATE TABLE IF NOT EXISTS `orcamento_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orcamento_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_id` (`produto_id`),
  KEY `orcamento_id` (`orcamento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orcamento_produto`
--

INSERT INTO `orcamento_produto` (`id`, `orcamento_id`, `produto_id`, `quantidade`) VALUES
(150, 1, 14, 170000),
(151, 1, 15, 100000),
(155, 2, 15, 1),
(156, 2, 14, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` float NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `tipologia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-produto-fornecedor_id` (`fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `referencia`, `descricao`, `preco`, `fornecedor_id`, `tipologia_id`) VALUES
(14, 'fdslkn', 'lknfk', 'lnnlkf', 12, 8, 3),
(15, 'fdslkn', 'lknfk', 'lnnlkf', 12, 8, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

DROP TABLE IF EXISTS `questao`;
CREATE TABLE IF NOT EXISTS `questao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assunto_id` int(11) NOT NULL,
  `mensagem` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `respondida` tinyint(2) DEFAULT '0',
  `concluida` tinyint(2) NOT NULL,
  `data` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-contacto-assunto` (`assunto_id`),
  KEY `idx-contacto-utilizador` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `questao`
--

INSERT INTO `questao` (`id`, `assunto_id`, `mensagem`, `email`, `respondida`, `concluida`, `data`, `user_id`) VALUES
(3, 1, 'as', 'instalador@dsasa.com', NULL, 0, '2022-02-16 18:45:39', 1),
(4, 1, 'a', 'instalador@dsasa.com', 0, 0, '2022-02-16 18:46:05', 1),
(5, 1, 'fs', 'instalador@dsasa.com', 0, 0, '2022-02-16 19:32:43', 1),
(6, 1, 'fs', 'instalador@dsasa.com', 0, 0, '2022-02-16 20:17:39', 1),
(7, 1, 'fa', 'instalador@dsasa.com', 0, 0, '2022-02-16 20:19:36', 1),
(8, 1, 'fa', 'instalador@dsasa.com', 0, 0, '2022-02-16 20:19:47', 1),
(9, 1, 'fa', 'instalador@dsasa.com', 0, 0, '2022-02-16 20:20:34', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

DROP TABLE IF EXISTS `resposta`;
CREATE TABLE IF NOT EXISTS `resposta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questao_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `texto` varchar(250) NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-resposta-contacto` (`questao_id`) USING BTREE,
  KEY `idx-resposta-user` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `resposta`
--

INSERT INTO `resposta` (`id`, `questao_id`, `user_id`, `texto`, `data`) VALUES
(22, 4, 1, 'a', '2022-02-16 18:51:52'),
(23, 4, 1, 'fas', '2022-02-16 18:51:56'),
(24, 9, 1, 'asf', '2022-02-16 20:23:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipologia`
--

DROP TABLE IF EXISTS `tipologia`;
CREATE TABLE IF NOT EXISTS `tipologia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipologia`
--

INSERT INTO `tipologia` (`id`, `nome`) VALUES
(1, 'Selecionar tipo'),
(2, 'Canalização'),
(3, 'Eletrônica'),
(4, 'Hidráulica'),
(5, 'Pneumática'),
(6, 'Eletricidade');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'instalador', 'uixk3ZjGUVok-bAigVqr7Dui_APpHHSW', '$2y$13$aJl5QH20R8VHRepSDNehQ.ATycN2dAWN5VPiyoXiiJHRotWY9go56', 'cNq0xBS6FY1zMzjnJxjGgWSBP7HYbLdN_1644777809', 'instalador@dsasa.com', 10, 1644777809, 1645231677, 'xugxEEsXwKdlYMJ_aN9kYMKUfgWM0zRt_1644777809'),
(2, 'admin', '-NA5TQ21OBKWwc1-BTR6l-EKKe1ABp9p', '$2y$13$XdLpn505snsy2REMEaWv3eqTMIpmldyrU2aCM/7n4pyTmlc0Nca4q', 'sShz3kYtzzmlRZkus8gYCX19pb2eRRgn_1644952030', 'admin@sd.cj', 10, 1644952030, 1645231643, 'C-RW_t3uFWF-fmwqDGrsVbntHvmri7u6_1644952030'),
(8, 'fornecedor', 'mbKqambfORlqTKdQnIKORef95hUDaf4x', '$2y$13$8UiVar0os1Qw/TRZpWm8qOws1wX3HOg8gESCl88j/ocg1rMLTO0.O', 'rnRoRpGZmqK90Mcjq-2CSCvgBzWwUEDA_1644959944', 'fornecep@fksd.co', 10, 1644959944, 1645231591, 'Kovw-wATnJU8Sc8JM2w3OgN-B1yAMOCx_1644959944'),
(9, 'sdklkdsnlk', 'ZLUbsstE3aZRPf7-1LTm51slOMtQfKDz', '$2y$13$tbcAi9b1waFxGE4QpYEg6eq92r1eaxvCdWx2tO9nww4TkOtckZnFG', 'JvpsFUCYNigmY2MMpLP-PRiQvpGLXR65_1645050293', 'helderalex@live.com.ptSD', 10, 1645050293, 1645231687, 'JiqyxCVgS-5X6EgbB2uIEhq4cCZfq_1g_1645050293'),
(10, 'instalador 1', 'EQAL9uq7U5MX6Mar3v2MRFtRfwVWKSAI', '$2y$13$lysEiluUivW0tqlCwhW0/u77SQC9uWWVdCMAFUMNIaIkSHPvBBpvO', 'VNzgCvaGEeMDOJzo9SoUjd3s-rww5JX__1645050394', 'helderalex@live.com.ptkhio', 10, 1645050394, 1645231675, 'ZttSGtaLqJ3M2pe5IjPhmuB8r7xjGtqg_1645050394'),
(13, 'kfnsdvds', '_TwneEdLKwS9lozs_Jq8BIvu6tHMnzmO', '$2y$13$V9mF3w5Xc3c0I.luXEg6quDRfwdddDyo9QvMIaH.AzdZ3MMvHFoJK', 'hc1Tm-EFfIx6po7vu45Qacu9gZlcgh6R_1645050820', 'helderalex@live.com.pta', 10, 1645050820, 1645231147, 'd-JooDHj4MP9jPz-LqlaDxgrdpA8BrMi_1645050820'),
(14, 'helderalez', 'ag0DEg7miQcfiiyLZlFW1BIH_ZAmygJi', '$2y$13$5wfEgSo7WYFTdmRsCr/TvOEOn.EZjKqmhlPaWXeCNX9Koe93Dkjca', NULL, 'helderalex@live.com.pt', 10, 1645233844, 1645234202, 'lZt2hPeHSx1Hof9O8A6JqB8TS17xNRfJ_1645233844');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk-cliente-id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `orcamento`
--
ALTER TABLE `orcamento`
  ADD CONSTRAINT `fk-orcamento-cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
