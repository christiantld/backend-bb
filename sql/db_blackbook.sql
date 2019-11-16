-- MySQL Script generated by MySQL Workbench
-- Sat Nov  9 00:49:21 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS
, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS
, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE
, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_blackbook2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_blackbook2
-- -----------------------------------------------------
CREATE SCHEMA
IF NOT EXISTS `db_blackbook2` DEFAULT CHARACTER
SET utf8
COLLATE utf8_general_mysql500_ci ;
USE `db_blackbook2`
;

-- -----------------------------------------------------
-- Table `db_blackbook2`.`tb_cargo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_blackbook2`.`tb_cargo` ;

CREATE TABLE
IF NOT EXISTS `db_blackbook2`.`tb_cargo`
(
  `pk_cargo` INT
(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_cargo` VARCHAR
(60) NOT NULL,
  PRIMARY KEY
(`pk_cargo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_blackbook2`.`tb_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_blackbook2`.`tb_usuario` ;

CREATE TABLE
IF NOT EXISTS `db_blackbook2`.`tb_usuario`
(
  `pk_usuario` INT
(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_usuario` VARCHAR
(60) NOT NULL,
  `nu_cpf` BIGINT
(11) UNSIGNED ZEROFILL NOT NULL,
  `email` VARCHAR
(45) NOT NULL,
  `telefone` BIGINT
(11) UNSIGNED NOT NULL,
  `senha` VARCHAR
(255) NOT NULL,
  `fk_cargo` INT
(2) UNSIGNED NOT NULL,
  PRIMARY KEY
(`pk_usuario`),
  CONSTRAINT `fk_tb_funcionario_tb_cargo1`
    FOREIGN KEY
(`fk_cargo`)
    REFERENCES `db_blackbook2`.`tb_cargo`
(`pk_cargo`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nu_cpf_UNIQUE` ON `db_blackbook2`.`tb_usuario`
(`nu_cpf`);

CREATE INDEX `fk_tb_funcionario_tb_cargo1_idx` ON `db_blackbook2`.`tb_usuario`
(`fk_cargo`);


-- -----------------------------------------------------
-- Table `db_blackbook2`.`tb_fornecedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_blackbook2`.`tb_fornecedor` ;

CREATE TABLE
IF NOT EXISTS `db_blackbook2`.`tb_fornecedor`
(
  `pk_fornecedor` INT
(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_fornecedor` VARCHAR
(45) NOT NULL,
  `email` VARCHAR
(45) NULL,
  `telefone` INT
(14) NULL,
  PRIMARY KEY
(`pk_fornecedor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_blackbook2`.`tb_categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_blackbook2`.`tb_categoria` ;

CREATE TABLE
IF NOT EXISTS `db_blackbook2`.`tb_categoria`
(
  `pk_categoria` INT
(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_categoria` VARCHAR
(45) NOT NULL,
  PRIMARY KEY
(`pk_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_blackbook2`.`tb_produto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_blackbook2`.`tb_produto` ;

CREATE TABLE
IF NOT EXISTS `db_blackbook2`.`tb_produto`
(
  `pk_produto` INT
(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_produto` VARCHAR
(60) NOT NULL,
  `marca` VARCHAR
(60) NOT NULL,
  `descricao` VARCHAR
(45) NULL,
  `qtd_minima` INT
(4) UNSIGNED NOT NULL,
  `qtd_max` INT
(4) UNSIGNED NOT NULL,
  `qtd_total` INT
(4) UNSIGNED NOT NULL,
  `fk_categoria` INT
(2) UNSIGNED NOT NULL,
  PRIMARY KEY
(`pk_produto`),
  CONSTRAINT `fk_tb_produto_tb_categoria`
    FOREIGN KEY
(`fk_categoria`)
    REFERENCES `db_blackbook2`.`tb_categoria`
(`pk_categoria`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_tb_produto_tb_categoria_idx` ON `db_blackbook2`.`tb_produto`
(`fk_categoria`);


-- -----------------------------------------------------
-- Table `db_blackbook2`.`tb_entrada`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_blackbook2`.`tb_entrada` ;

CREATE TABLE
IF NOT EXISTS `db_blackbook2`.`tb_entrada`
(
  `pk_entrada` INT
(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_entrada` DATETIME NOT NULL,
  `qtd_item` INT
(4) UNSIGNED NOT NULL,
  `valor_item` DECIMAL
(8,2) UNSIGNED NOT NULL,
  `fk_produto` INT
(8) UNSIGNED NOT NULL,
  `fk_usuario` INT
(3) UNSIGNED NOT NULL,
  `fk_fornecedor` INT
(8) UNSIGNED NOT NULL,
  PRIMARY KEY
(`pk_entrada`),
  CONSTRAINT `fk_tb_item_compra_tb_produto1`
    FOREIGN KEY
(`fk_produto`)
    REFERENCES `db_blackbook2`.`tb_produto`
(`pk_produto`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION,
  CONSTRAINT `fk_tb_entrada_tb_funcionario1`
    FOREIGN KEY
(`fk_usuario`)
    REFERENCES `db_blackbook2`.`tb_usuario`
(`pk_usuario`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION,
  CONSTRAINT `fk_tb_entrada_tb_fornecedor1`
    FOREIGN KEY
(`fk_fornecedor`)
    REFERENCES `db_blackbook2`.`tb_fornecedor`
(`pk_fornecedor`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_tb_item_compra_tb_produto1_idx` ON `db_blackbook2`.`tb_entrada`
(`fk_produto`);

CREATE INDEX `fk_tb_entrada_tb_funcionario1_idx` ON `db_blackbook2`.`tb_entrada`
(`fk_usuario`);

CREATE INDEX `fk_tb_entrada_tb_fornecedor1_idx` ON `db_blackbook2`.`tb_entrada`
(`fk_fornecedor`);


-- -----------------------------------------------------
-- Table `db_blackbook2`.`tb_saida`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_blackbook2`.`tb_saida` ;

CREATE TABLE
IF NOT EXISTS `db_blackbook2`.`tb_saida`
(
  `pk_saida` INT
(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `qtd_item` INT
(4) UNSIGNED NOT NULL,
  `data_saida` DATETIME NOT NULL,
  `fk_produto` INT
(8) UNSIGNED NOT NULL,
  `fk_usuario` INT
(3) UNSIGNED NOT NULL,
  PRIMARY KEY
(`pk_saida`),
  CONSTRAINT `fk_tb_item_requisicao_tb_produto1`
    FOREIGN KEY
(`fk_produto`)
    REFERENCES `db_blackbook2`.`tb_produto`
(`pk_produto`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION,
  CONSTRAINT `fk_tb_item_requisicao_tb_funcionario1`
    FOREIGN KEY
(`fk_usuario`)
    REFERENCES `db_blackbook2`.`tb_usuario`
(`pk_usuario`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_tb_item_requisicao_tb_produto1_idx` ON `db_blackbook2`.`tb_saida`
(`fk_produto`);

CREATE INDEX `fk_tb_item_requisicao_tb_funcionario1_idx` ON `db_blackbook2`.`tb_saida`
(`fk_usuario`);


-- -----------------------------------------------------
-- Table `db_blackbook2`.`tb_lote`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_blackbook2`.`tb_lote` ;

CREATE TABLE
IF NOT EXISTS `db_blackbook2`.`tb_lote`
(
  `pk_lote` INT
(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_fabricacao` DATE NOT NULL,
  `lote` VARCHAR
(20) NOT NULL,
  `data_validade` DATE NOT NULL,
  `fk_produto` INT
(8) UNSIGNED NOT NULL,
  PRIMARY KEY
(`pk_lote`),
  CONSTRAINT `fk_tb_lote_tb_produto1`
    FOREIGN KEY
(`fk_produto`)
    REFERENCES `db_blackbook2`.`tb_produto`
(`pk_produto`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_tb_lote_tb_produto1_idx` ON `db_blackbook2`.`tb_lote`
(`fk_produto`);


-- -----------------------------------------------------
-- Table `db_blackbook2`.`tb_token`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_blackbook2`.`tb_token` ;

CREATE TABLE
IF NOT EXISTS `db_blackbook2`.`tb_token`
(
  `pk_token` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `token` VARCHAR
(1000) NOT NULL,
  `refresh_token` VARCHAR
(1000) NOT NULL,
  `expire_at` DATETIME NOT NULL,
  `active` TINYINT
(1) UNSIGNED NOT NULL DEFAULT 1,
  `fk_usuario` INT UNSIGNED NOT NULL,
  PRIMARY KEY
(`pk_token`),
  CONSTRAINT `fk_tb_token_tb_funcionario`
    FOREIGN KEY
(`fk_usuario`)
    REFERENCES `db_blackbook2`.`tb_usuario`
(`pk_usuario`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `pk_funcionario_idx` ON `db_blackbook2`.`tb_token`
(`fk_usuario`);


-- -----------------------------------------------------
-- Table `db_blackbook2`.`tb_produto_fornecedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_blackbook2`.`tb_produto_fornecedor` ;

CREATE TABLE
IF NOT EXISTS `db_blackbook2`.`tb_produto_fornecedor`
(
  `pk_produto_fornecedor` INT
(8) UNSIGNED NOT NULL,
  `fk_produto` INT
(8) UNSIGNED NOT NULL,
  `fk_fornecedor` INT
(8) UNSIGNED NOT NULL,
  PRIMARY KEY
(`pk_produto_fornecedor`),
  CONSTRAINT `fk_table1_tb_produto1`
    FOREIGN KEY
(`fk_produto`)
    REFERENCES `db_blackbook2`.`tb_produto`
(`pk_produto`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION,
  CONSTRAINT `fk_table1_tb_fornecedor1`
    FOREIGN KEY
(`fk_fornecedor`)
    REFERENCES `db_blackbook2`.`tb_fornecedor`
(`pk_fornecedor`)
    ON
DELETE NO ACTION
    ON
UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_table1_tb_produto1_idx` ON `db_blackbook2`.`tb_produto_fornecedor`
(`fk_produto`);

CREATE INDEX `fk_table1_tb_fornecedor1_idx` ON `db_blackbook2`.`tb_produto_fornecedor`
(`fk_fornecedor`);

INSERT INTO tb_cargo
  (no_cargo)
VALUES('administrador');
INSERT INTO tb_cargo
  (no_cargo)
VALUES('dentista');
INSERT INTO tb_cargo
  (no_cargo)
VALUES('auxilar');
INSERT INTO tb_cargo
  (no_cargo)
VALUES('funcionario');


SET SQL_MODE
=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS
=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS
=@OLD_UNIQUE_CHECKS;
