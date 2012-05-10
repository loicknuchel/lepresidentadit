SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `lkws_politique` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `lkws_politique`;

-- -----------------------------------------------------
-- Table `lkws_dev`.`LPAD_interventionType`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lkws_dev`.`LPAD_interventionType` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `ordre` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_dev`.`LPAD_intervention`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lkws_dev`.`LPAD_intervention` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `interventionType` INT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `date` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_LPAD_intervention_LPAD_interventionType` (`interventionType` ASC) ,
  CONSTRAINT `fk_LPAD_intervention_LPAD_interventionType`
    FOREIGN KEY (`interventionType` )
    REFERENCES `lkws_dev`.`LPAD_interventionType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_dev`.`LPAD_engagementCategory`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lkws_dev`.`LPAD_engagementCategory` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `ordre` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_dev`.`LPAD_engagement`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lkws_dev`.`LPAD_engagement` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `engagementCategory` INT NOT NULL ,
  `title` VARCHAR(256) NOT NULL ,
  `content` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_LPAD_engagement_LPAD_engagementCategory` (`engagementCategory` ASC) ,
  CONSTRAINT `fk_LPAD_engagement_LPAD_engagementCategory`
    FOREIGN KEY (`engagementCategory` )
    REFERENCES `lkws_dev`.`LPAD_engagementCategory` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_dev`.`LPAD_interventionHasEngagement`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lkws_dev`.`LPAD_interventionHasEngagement` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `interventionId` INT NOT NULL ,
  `engagementId` INT NOT NULL ,
  `originalText` TEXT NOT NULL ,
  `interventionPos` VARCHAR(45) NULL ,
  `specificLink` TEXT NULL ,
  INDEX `fk_intervention_has_proposition_intervention` (`interventionId` ASC) ,
  INDEX `fk_intervention_has_proposition_proposition` (`engagementId` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_intervention_has_proposition_intervention`
    FOREIGN KEY (`interventionId` )
    REFERENCES `lkws_dev`.`LPAD_intervention` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_intervention_has_proposition_proposition`
    FOREIGN KEY (`engagementId` )
    REFERENCES `lkws_dev`.`LPAD_engagement` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `lkws_dev`.`LPAD_sourceType`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lkws_dev`.`LPAD_sourceType` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `ordre` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_dev`.`LPAD_source`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lkws_dev`.`LPAD_source` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `intervention` INT NULL ,
  `sourceType` INT NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `link` TEXT NOT NULL ,
  `ordre` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_source_intervention` (`intervention` ASC) ,
  INDEX `fk_source_sourceType` (`sourceType` ASC) ,
  CONSTRAINT `fk_source_intervention`
    FOREIGN KEY (`intervention` )
    REFERENCES `lkws_dev`.`LPAD_intervention` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_source_sourceType`
    FOREIGN KEY (`sourceType` )
    REFERENCES `lkws_dev`.`LPAD_sourceType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_dev`.`LPAD_citationCategory`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lkws_dev`.`LPAD_citationCategory` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `ordre` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_dev`.`LPAD_citation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lkws_dev`.`LPAD_citation` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `intervention` INT NOT NULL ,
  `citationCategory` INT NULL ,
  `content` TEXT NOT NULL ,
  `citationPos` VARCHAR(45) NULL ,
  `specificLink` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_LPAD_citation_LPAD_citationCategory` (`citationCategory` ASC) ,
  INDEX `fk_LPAD_citation_LPAD_intervention` (`intervention` ASC) ,
  CONSTRAINT `fk_LPAD_citation_LPAD_citationCategory`
    FOREIGN KEY (`citationCategory` )
    REFERENCES `lkws_dev`.`LPAD_citationCategory` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LPAD_citation_LPAD_intervention`
    FOREIGN KEY (`intervention` )
    REFERENCES `lkws_dev`.`LPAD_intervention` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
