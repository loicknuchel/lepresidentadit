SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `lkws_politique` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `lkws_politique`;

-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_interventionType`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_interventionType` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_interventionType` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_intervention`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_intervention` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_intervention` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `interventionType` INT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_intervention_interventionType` (`interventionType` ASC) ,
  CONSTRAINT `fk_intervention_interventionType`
    FOREIGN KEY (`interventionType` )
    REFERENCES `lkws_politique`.`LPAD_interventionType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_engagementCategory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_engagementCategory` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_engagementCategory` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_engagement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_engagement` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_engagement` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `propositionCategory` INT NULL ,
  `content` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_proposition_propositionCategory` (`propositionCategory` ASC) ,
  CONSTRAINT `fk_proposition_propositionCategory`
    FOREIGN KEY (`propositionCategory` )
    REFERENCES `lkws_politique`.`LPAD_engagementCategory` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_interventionHasEngagement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_interventionHasEngagement` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_interventionHasEngagement` (
  `interventionId` INT NOT NULL ,
  `engagementId` INT NOT NULL ,
  `originalText` TEXT NOT NULL ,
  `interventionPos` VARCHAR(45) NULL ,
  PRIMARY KEY (`interventionId`, `engagementId`) ,
  INDEX `fk_intervention_has_proposition_intervention` (`interventionId` ASC) ,
  INDEX `fk_intervention_has_proposition_proposition` (`engagementId` ASC) ,
  CONSTRAINT `fk_intervention_has_proposition_intervention`
    FOREIGN KEY (`interventionId` )
    REFERENCES `lkws_politique`.`LPAD_intervention` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_intervention_has_proposition_proposition`
    FOREIGN KEY (`engagementId` )
    REFERENCES `lkws_politique`.`LPAD_engagement` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_sourceType`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_sourceType` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_sourceType` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_source`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_source` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_source` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `intervention` INT NULL ,
  `sourceType` INT NULL ,
  `link` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_source_intervention` (`intervention` ASC) ,
  INDEX `fk_source_sourceType` (`sourceType` ASC) ,
  CONSTRAINT `fk_source_intervention`
    FOREIGN KEY (`intervention` )
    REFERENCES `lkws_politique`.`LPAD_intervention` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_source_sourceType`
    FOREIGN KEY (`sourceType` )
    REFERENCES `lkws_politique`.`LPAD_sourceType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `lkws_politique`;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_interventionType`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_interventionType` (`id`, `name`) VALUES (1, 'Interview télévisée');
INSERT INTO `LPAD_interventionType` (`id`, `name`) VALUES (2, 'Meeting');
INSERT INTO `LPAD_interventionType` (`id`, `name`) VALUES (3, 'Programme officel');
INSERT INTO `LPAD_interventionType` (`id`, `name`) VALUES (4, 'tract');

COMMIT;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_sourceType`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_sourceType` (`id`, `name`) VALUES (1, 'YouTube');
INSERT INTO `LPAD_sourceType` (`id`, `name`) VALUES (2, 'DailyMotion');
INSERT INTO `LPAD_sourceType` (`id`, `name`) VALUES (3, 'Autre vidéo');
INSERT INTO `LPAD_sourceType` (`id`, `name`) VALUES (4, 'Site de campagne');
INSERT INTO `LPAD_sourceType` (`id`, `name`) VALUES (5, 'Article');
INSERT INTO `LPAD_sourceType` (`id`, `name`) VALUES (6, 'Tract');
INSERT INTO `LPAD_sourceType` (`id`, `name`) VALUES (7, 'Image');

COMMIT;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
