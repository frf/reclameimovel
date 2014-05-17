ALTER TABLE `usuario` ADD `cpf` CHAR( 11 ) NULL ,
ADD `dadosImovel` INT( 250 ) NOT NULL ,
ADD `telCelular` VARCHAR( 15 ) NULL ,
ADD `telResidencial` INT( 15 ) NULL ,
ADD `telContato` INT( 15 ) NULL ,
ADD UNIQUE (
`cpf`
);