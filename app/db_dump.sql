-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: condominio
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `condominio`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `condominio` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `condominio`;

--
-- Table structure for table `empreendimento`
--

DROP TABLE IF EXISTS `empreendimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empreendimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `idnome` varchar(200) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  `uf` char(2) DEFAULT NULL,
  `cidade` varchar(200) DEFAULT NULL,
  `ide` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`),
  UNIQUE KEY `idnome` (`idnome`),
  KEY `fk_empresa` (`ide`),
  CONSTRAINT `fk_empresa` FOREIGN KEY (`ide`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empreendimento`
--

LOCK TABLES `empreendimento` WRITE;
/*!40000 ALTER TABLE `empreendimento` DISABLE KEYS */;
INSERT INTO `empreendimento` (`id`, `nome`, `idnome`, `bairro`, `uf`, `cidade`, `ide`) VALUES (1,'Park Reality','mrv-park-reality','CAMPO GRANDE','RJ','RIO DE JANEIRO',1),(2,'Park Renovare','mrv-park-renovare','CAMPO GRANDE','RJ','RIO DE JANEIRO',1);
/*!40000 ALTER TABLE `empreendimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `uf` char(2) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`id`, `nome`, `login`, `senha`, `uf`, `cidade`) VALUES (1,'MRV Engenharia','mrv','123','MG','BELO HORIZONTE');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reclamacao`
--

DROP TABLE IF EXISTS `reclamacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reclamacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` bigint(20) NOT NULL,
  `ide` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descricao` text,
  `dt_cadastro` datetime DEFAULT NULL,
  `idassunto` int(11) DEFAULT NULL,
  `dados` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`,`idu`,`ide`),
  KEY `idu` (`idu`),
  KEY `ide` (`ide`),
  CONSTRAINT `reclamacao_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `usuario` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reclamacao_ibfk_2` FOREIGN KEY (`ide`) REFERENCES `empreendimento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reclamacao`
--

LOCK TABLES `reclamacao` WRITE;
/*!40000 ALTER TABLE `reclamacao` DISABLE KEYS */;
INSERT INTO `reclamacao` (`id`, `idu`, `ide`, `titulo`, `descricao`, `dt_cadastro`, `idassunto`, `dados`) VALUES (8,1,1,'Minhas Chaves','Ninguem me da um retorno sobre prazo de entrega das chaves, cada vez mais esta dificil falar com a emrpesa.\r\n\r\nJa faz mais de 4 anos com tudo pago e nada de resolverem.\r\n\r\nQuero saber prazos, um empreendimento tem prazo de inicio e fim, e nÃ£o Ã© dado por morador e sim pelo todo, pois afinal tem um projeto avaliado pela prefeitura e caixa economica.\r\n\r\nQual o prazo para entrega dos imoveis, fiz a vistoria e atÃ© agora nada, ninguem liga, ninguem fala nada.\r\n\r\nREsolvam logo isso pois ja esta ficando chato, vamos juntar todos os moradores para ir a MG saber de mais informaÃ§Ãµes e acampar no escritÃ³rio da MRV caso nÃ£o tomem providencia.','2014-05-07 02:16:22',1,'BLoco 2 AP 303'),(9,1,1,'aaaaaaaaa','ccccccccc','2014-05-07 04:04:33',4,'bbbbbbbbbb');
/*!40000 ALTER TABLE `reclamacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idu` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `dt_cadastro` datetime NOT NULL,
  `dt_last_login` datetime NOT NULL,
  PRIMARY KEY (`idu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idu`, `name`, `email`, `role`, `dt_cadastro`, `dt_last_login`) VALUES (1,'XXXXX','','ROLE_USER','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-07  1:09:18
