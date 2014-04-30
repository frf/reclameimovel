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
  `bairro` varchar(200) NOT NULL,
  `ide` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`),
  KEY `fk_empresa` (`ide`),
  CONSTRAINT `fk_empresa` FOREIGN KEY (`ide`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empreendimento`
--

LOCK TABLES `empreendimento` WRITE;
/*!40000 ALTER TABLE `empreendimento` DISABLE KEYS */;
INSERT INTO `empreendimento` VALUES (1,'Park Reality','CAMPO GRANDE',1),(2,'Park Renovare','CAMPO GRANDE',1);
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
INSERT INTO `empresa` VALUES (1,'MRV','mrv','123','RJ','RIO DE JANEIRO');
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
  `idu` int(11) NOT NULL,
  `ide` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descricao` text,
  `dt_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`idu`,`ide`),
  KEY `idu` (`idu`),
  KEY `ide` (`ide`),
  CONSTRAINT `reclamacao_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reclamacao_ibfk_2` FOREIGN KEY (`ide`) REFERENCES `empreendimento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reclamacao`
--

LOCK TABLES `reclamacao` WRITE;
/*!40000 ALTER TABLE `reclamacao` DISABLE KEYS */;
INSERT INTO `reclamacao` VALUES (1,1,1,'aa','TESTE 1','2014-04-30 00:00:00'),(2,1,1,'bb','XXXXXXXXXXXXXXXXX','2014-04-29 00:00:00'),(3,1,1,'ccc','XXXXXXXXXXXXXXXXX','2014-04-29 00:00:00'),(4,1,1,'dd','BBBBBBBBBBBBXXXXXXXXXXXXXXXXX','2014-04-29 00:00:00'),(5,1,1,'eee','CCCCCCCCCCCCBBBBBBBBBBBBXXXXXXXXXXXXXXXXX','2014-04-29 00:00:00');
/*!40000 ALTER TABLE `reclamacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `login` varchar(40) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `idface` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Fabio Rocha','fabio','123','');
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

-- Dump completed on 2014-04-30 20:03:04
