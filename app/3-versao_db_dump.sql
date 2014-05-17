ALTER TABLE `usuario` ADD `cpf` CHAR( 14 ) NULL ,
ADD `dadosImovel` VARCHAR( 250 ) NOT NULL ,
ADD `telCelular` VARCHAR( 15 ) NULL ,
ADD `telResidencial` VARCHAR( 15 ) NULL ,
ADD `telContato` VARCHAR( 15 ) NULL ,
ADD UNIQUE (
`cpf`
);
