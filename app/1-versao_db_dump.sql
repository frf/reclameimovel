ALTER TABLE `reclamacao` ADD `visita` INT NOT NULL ;

CREATE TABLE IF NOT EXISTS `status_rec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `status_rec`
--

INSERT INTO `status_rec` (`id`, `nome`) VALUES
(1, 'Pendente'),
(2, 'Respondida');