-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 13, 2014 at 07:46 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `condominio`
--
CREATE DATABASE IF NOT EXISTS `condominio` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `condominio`;

-- --------------------------------------------------------

--
-- Table structure for table `empreendimento`
--

DROP TABLE IF EXISTS `empreendimento`;
CREATE TABLE IF NOT EXISTS `empreendimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `idnome` varchar(200) CHARACTER SET latin1 NOT NULL,
  `bairro` varchar(200) CHARACTER SET latin1 NOT NULL,
  `uf` char(2) CHARACTER SET latin1 DEFAULT NULL,
  `cidade` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `ide` int(11) NOT NULL,
  `visita` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`),
  UNIQUE KEY `idnome` (`idnome`),
  KEY `fk_empresa` (`ide`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=129 ;

--
-- Dumping data for table `empreendimento`
--

INSERT INTO `empreendimento` (`id`, `nome`, `idnome`, `bairro`, `uf`, `cidade`, `ide`, `visita`) VALUES
(1, 'Park Reality', 'mrv-park-reality', 'CAMPO GRANDE', 'RJ', 'RIO DE JANEIRO', 1, 30),
(2, 'Park Renovare', 'mrv-park-renovare', 'CAMPO GRANDE', 'RJ', 'RIO DE JANEIRO', 1, 3),
(87, 'Park Belo Campo', 'mrv-park-belo-campo', 'VILA MADALENA', 'RJ', 'BELFORD ROXO', 1, 0),
(88, 'Parque Guarani', 'mrv-parque-guarani', 'JOKEY', 'RJ', 'CAMPOS DOS GOYTACAZES', 1, 0),
(89, 'Parque Goytacazes', 'mrv-parque-goytacazes', 'JOKEY', 'RJ', 'CAMPOS DOS GOYTACAZES', 1, 0),
(90, 'Parque Cassis', 'mrv-cassis', 'PARQUE VARANDA DO VISCONDE', 'RJ', 'CAMPOS DOS GOYTACAZES', 1, 0),
(91, 'Reserva dos Cristais – Água Marinha', 'mrv-agua-marinha', 'PARQUE RODOVIARIO', 'RJ', 'CAMPOS DOS GOYTACAZES', 1, 0),
(92, 'Reserva dos Cristais – Parque ônix', 'mrv-parque-onix', 'PARQUE RODOVIARIO', 'RJ', 'CAMPOS DOS GOYTACAZES', 1, 0),
(93, 'reserva dos Cristais – Parque Âmbar', 'mrv-parque-ambar', 'PARQUE RODOVIARIO', 'RJ', 'CAMPOS DOS GOYTACAZES', 1, 0),
(94, 'Parque Duque do Rosario', 'mrv-parque-duque-rosario', 'JARDIM PRIMAVERA', 'RJ', 'DUQUE DE CAXIAS', 1, 0),
(95, 'Mar da Geórgia', 'mrv-mar-georgia', 'BARRETO', 'RJ', 'MACAÉ', 1, 2),
(96, 'Parque Mar Báltico', 'mrv-parque-báltico', 'BARRETO', 'RJ', 'MACAÉ', 1, 0),
(97, 'Parque Mar do Caribe', 'mrv-parque-mar-caribe', 'BARRETO', 'RJ', 'MACAÉ', 1, 0),
(98, 'Spazio Mistral', 'mrv-spazio-mistral', 'BARRETO', 'RJ', 'MACAÉ', 1, 0),
(99, 'Mar de Gales', 'mrv-mar-gales', 'BARRETO', 'RJ', 'MACAÉ', 1, 0),
(100, 'Mar do Atlântico', 'Mrv-mar-atlantico', 'BARRETO', 'RJ', 'MACAÉ', 1, 0),
(101, 'Mar de Irlanda', 'mrv-mar-irlanda', 'BARRETO', 'RJ', 'MACAÉ', 1, 0),
(102, 'Mar de Flórida', 'mrv-mar-florida', 'BARRETO', 'RJ', 'MACAÉ', 1, 0),
(103, 'Mare Verdi', 'mrv-mare-verdi', 'MARILÉIA', 'RJ', 'RIO DAS OSTRAS', 1, 0),
(104, 'Mare Doro', 'mrv-mare-doro', 'NOVA CIDADE', 'RJ', 'RIO DAS OSTRAS', 1, 0),
(105, 'Parque Santa Cruz', 'mrv-parque-santa-cruz', 'MARILÉIA', 'RJ', 'RIO DAS OSTRAS', 1, 0),
(106, 'Parque Recreio da Gávea', 'mrv-parque-recreio-gavea', 'GUADALUPE', 'RJ', 'RIO DE JANEIRO', 1, 0),
(107, 'Spazio Reserva Imperial', 'mrv-spazio-reserva-imperial', 'TAQUARA', 'RJ', 'JACAREPAGUA', 1, 0),
(108, 'Recanto dos passaros – Beija Flor', 'mrv-recanto-passaros-beija-flor', 'HONÓRIO GURGEL', 'RJ', 'RIO DE JANEIRO', 1, 0),
(109, 'Recanto dos passaros – Andorinhas', 'mrv-recanto-passaros-andorinhas', 'HONÓRIO GURGEL', 'RJ', 'RIO DE JANEIRO', 1, 0),
(110, 'Park Ritz', 'mrv-park-ritz', 'CAMPO GRANDE', 'RJ', 'RIO DE JANEIRO', 1, 0),
(111, 'Spazio Riverside', 'mrv-spazio-riverside', 'ABOLIÇÃO', 'RJ', 'RIO DE JANEIRO', 1, 0),
(112, 'Rio Star Condominio Resort', 'mrv-rio-star-condominio-resort', 'JACAREPAGUA', 'RJ', 'RIO DE JANEIRO', 1, 0),
(113, 'Richmond Condomínio Resort', 'mrv-richmond-condominio-resort', 'JACAREPAGUA', 'RJ', 'RIO DE JANEIRO', 1, 0),
(114, 'Park Rivera da Costa', 'mrv-park-rivera-costa', 'CAMPO GRANDE', 'RJ', 'RIO DE JANEIRO', 1, 0),
(115, 'Park Riviera do Sol', 'Mrv-park-riviera-sol', 'CAMPO GRANDE', 'RJ', 'RIO DE JANEIRO', 1, 0),
(116, 'Park Riviera do Campo', 'mrv-park-riviera-campo', 'BANGU', 'RJ', 'RIO DE JANEIRO', 1, 0),
(117, 'Park Riversul', 'mrv-park-riversul', 'CAMPO GRANDE', 'RJ', 'RIO DE JANEIRO', 1, 0),
(118, 'Royal Palms', 'mrv-royal-palms', 'RIO COMPRIDO', 'RJ', 'RIO DE JANEIRO', 1, 0),
(119, 'Parque Recreio do Pontal', 'mrv-parque-recreio-pontal', 'GUADALUPE', 'RJ', 'RIO DE JANEIRO', 1, 0),
(120, 'Spazio Recriart', 'mrv-spazio-recriart', 'PECHINCHA', 'RJ', 'RIO DE JANEIRO', 1, 0),
(121, 'Retiro das Rosas', 'mrv-retiro-rosas', 'CORDOVIL', 'RJ', 'RIO DE JANEIRO', 1, 0),
(122, 'Spazio Recoleta', 'mrv-spazio-recoleta', 'IRAJA', 'RJ', 'RIO DE JANEIRO', 1, 0),
(123, 'Parque Recanto Verde', 'mrv-parque-recanto-verde', 'SANTA CRUZ', 'RJ', 'RIO DE JANEIRO', 1, 0),
(124, 'Parque Retiro da Serra', 'mrv-retiro-serra', 'CORDOVIL', 'RJ', 'RIO DE JANEIRO', 1, 0),
(125, 'Recanto do Tingui', 'mrv-recanto-tingui', 'CAMPO GRANDE', 'RJ', 'RIO DE JANEIRO', 1, 0),
(126, 'Parque Recreio dos Bandeirantes', 'mrv-parque-recreio-bandeirantes', 'GUADALUPE', 'RJ', 'RIO DE JANEIRO', 1, 0),
(127, 'Retiro dos Pinheirais', 'mrv-retiro-pinheirais', 'CORDOVIL', 'RJ', 'RIO DE JANEIRO', 1, 0),
(128, 'Parque Recanto da Serra', 'mrv-parque-recanto-serra', 'SANTA CRUZ', 'RJ', 'RIO DE JANEIRO', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) CHARACTER SET latin1 NOT NULL,
  `login` varchar(100) CHARACTER SET latin1 NOT NULL,
  `senha` varchar(20) CHARACTER SET latin1 NOT NULL,
  `uf` char(2) CHARACTER SET latin1 NOT NULL,
  `cidade` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`id`, `nome`, `login`, `senha`, `uf`, `cidade`) VALUES
(1, 'MRV Engenharia', 'mrv', '123', 'MG', 'BELO HORIZONTE'),
(2, 'Real Nobile', 'realnobile', '123', 'RJ', 'Rio de Janeiro');

-- --------------------------------------------------------

--
-- Table structure for table `imagem`
--

DROP TABLE IF EXISTS `imagem`;
CREATE TABLE IF NOT EXISTS `imagem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idr` int(11) NOT NULL,
  `file` varchar(200) NOT NULL,
  PRIMARY KEY (`id`,`idr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `imagem`
--

INSERT INTO `imagem` (`id`, `idr`, `file`) VALUES
(5, 23, 'b2a38b1e11af66f6551f27c7019389d7.jpeg'),
(6, 23, 'b2a38b1e11af66f6551f27c7019389d7.jpeg'),
(7, 23, 'b2a38b1e11af66f6551f27c7019389d7.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `reclamacao`
--

DROP TABLE IF EXISTS `reclamacao`;
CREATE TABLE IF NOT EXISTS `reclamacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` bigint(20) NOT NULL,
  `ide` int(11) NOT NULL,
  `titulo` varchar(250) CHARACTER SET latin1 NOT NULL,
  `descricao` text CHARACTER SET latin1,
  `dt_cadastro` datetime DEFAULT NULL,
  `idassunto` int(11) DEFAULT NULL,
  `dados` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `visita` int(11) NOT NULL DEFAULT '0',
  `solucao` tinyint(1) NOT NULL DEFAULT '0',
  `youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`idu`,`ide`),
  KEY `idu` (`idu`),
  KEY `ide` (`ide`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `reclamacao`
--

INSERT INTO `reclamacao` (`id`, `idu`, `ide`, `titulo`, `descricao`, `dt_cadastro`, `idassunto`, `dados`, `visita`, `solucao`, `youtube`) VALUES
(8, 1, 1, 'Minhas Chaves', 'Ninguem me da um retorno sobre prazo de entrega das chaves, cada vez mais esta dificil falar com a emrpesa.\r\n\r\nJa faz mais de 4 anos com tudo pago e nada de resolverem.\r\n\r\nQuero saber prazos, um empreendimento tem prazo de inicio e fim, e nÃ£o Ã© dado por morador e sim pelo todo, pois afinal tem um projeto avaliado pela prefeitura e caixa economica.\r\n\r\nQual o prazo para entrega dos imoveis, fiz a vistoria e atÃ© agora nada, ninguem liga, ninguem fala nada.\r\n\r\nREsolvam logo isso pois ja esta ficando chato, vamos juntar todos os moradores para ir a MG saber de mais informaÃ§Ãµes e acampar no escritÃ³rio da MRV caso nÃ£o tomem providencia.', '2014-05-07 02:16:22', 1, 'BLoco 2 AP 303', 25, 0, NULL),
(9, 1, 1, 'aaaaaaaaa', 'ccccccccc', '2014-05-07 04:04:33', 4, 'bbbbbbbbbb', 0, 0, NULL),
(10, 708311732540249, 1, 'TESTE + 1', 'MAIS UM PROBLEMA\r\nAGORA OBSERVANDO O CONTEUDO DESTE TEXTO\r\nQUEBRA DE LINHA\r\nMAIS UMA QUEBRA', '2014-05-13 06:34:22', 1, 'BLoco 2 AP 303', 7, 0, NULL),
(11, 1, 1, 'xxxxxxxxxx', 'xxxxxxxxxxxxx', '2014-05-13 22:27:13', 1, 'xxxxxxxxxxxxxxx', 0, 0, NULL),
(12, 1, 1, 'xxxxxxxxxx', 'xxxxxxxxxxxxx', '2014-05-13 22:38:17', 1, 'xxxxxxxxxxxxxxx', 0, 0, NULL),
(13, 1, 1, 'xxxxxxxxxx', 'xxxxxxxxxxxxx', '2014-05-13 22:40:13', 1, 'xxxxxxxxxxxxxxx', 0, 0, NULL),
(14, 1, 1, 'xxxxxxxxxx', 'xxxxxxxxxxxxx', '2014-05-13 23:00:12', 1, 'xxxxxxxxxxxxxxx', 0, 0, NULL),
(15, 1, 1, 'bbbbbbbbbbbb', 'wwwwwwwwwwww', '2014-05-13 23:13:07', 1, 'eeeeeeeeeeeeeee', 1, 0, NULL),
(16, 1, 1, 'bbbbbbbbbbbb', 'wwwwwwwwwwww', '2014-05-13 23:22:47', 1, 'eeeeeeeeeeeeeee', 1, 0, NULL),
(17, 1, 1, 'VVVVVVVVVVVVVVVVVv', 'wwwwwwwwwwww', '2014-05-13 23:23:32', 1, 'eeeeeeeeeeeeeee', 1, 0, NULL),
(18, 1, 1, 'VVVVVVVVVVVVVVVVVv', 'wwwwwwwwwwww', '2014-05-13 23:24:50', 1, 'eeeeeeeeeeeeeee', 0, 0, NULL),
(19, 1, 1, 'VVVVVVVVVVVVVVVVVv', 'wwwwwwwwwwww', '2014-05-13 23:26:32', 1, 'eeeeeeeeeeeeeee', 0, 0, NULL),
(20, 1, 1, 'VVVVVVVVVVVVVVVVVv', 'wwwwwwwwwwww', '2014-05-13 23:26:57', 1, 'eeeeeeeeeeeeeee', 0, 0, NULL),
(21, 1, 1, 'VVVVVVVVVVVVVVVVVv', 'wwwwwwwwwwww', '2014-05-13 23:27:09', 1, 'eeeeeeeeeeeeeee', 1, 0, NULL),
(22, 1, 1, 'VVVVVVVVVVVVVVVVVv', 'wwwwwwwwwwww', '2014-05-13 23:27:33', 1, 'eeeeeeeeeeeeeee', 40, 0, NULL),
(23, 1, 1, 'VVVVVVVVVVVVVVVVVv', 'wwwwwwwwwwww', '2014-05-14 00:19:43', 1, 'eeeeeeeeeeeeeee', 31, 0, 'W0k7UIpDwKI');

-- --------------------------------------------------------

--
-- Table structure for table `status_rec`
--

DROP TABLE IF EXISTS `status_rec`;
CREATE TABLE IF NOT EXISTS `status_rec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `status_rec`
--

INSERT INTO `status_rec` (`id`, `nome`) VALUES
(1, 'Pendente'),
(2, 'Respondida');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idu` bigint(20) NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `email` varchar(200) CHARACTER SET latin1 NOT NULL,
  `role` varchar(200) CHARACTER SET latin1 NOT NULL,
  `dt_cadastro` datetime NOT NULL,
  `dt_last_login` datetime NOT NULL,
  PRIMARY KEY (`idu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idu`, `name`, `email`, `role`, `dt_cadastro`, `dt_last_login`) VALUES
(1, 'XXXXX', '', 'ROLE_USER', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(655736731140492, 'Marcelo Pereira', 'ps1.marcelo@gmail.com', 'ROLE_USER', '2014-05-07 21:13:51', '2014-05-07 21:13:51'),
(708311732540249, 'Fabio Rocha de Farias', 'fabio@fabiofarias.com.br', 'ROLE_USER', '2014-05-07 19:46:11', '2014-05-07 19:46:11');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `empreendimento`
--
ALTER TABLE `empreendimento`
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`ide`) REFERENCES `empresa` (`id`);

--
-- Constraints for table `reclamacao`
--
ALTER TABLE `reclamacao`
  ADD CONSTRAINT `reclamacao_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `usuario` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reclamacao_ibfk_2` FOREIGN KEY (`ide`) REFERENCES `empreendimento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
