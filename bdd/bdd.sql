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
  `ordre` INT NOT NULL ,
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
  `date` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_LPAD_intervention_LPAD_interventionType` (`interventionType` ASC) ,
  CONSTRAINT `fk_LPAD_intervention_LPAD_interventionType`
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
  `ordre` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_engagement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_engagement` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_engagement` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `engagementCategory` INT NOT NULL ,
  `title` VARCHAR(256) NOT NULL ,
  `content` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_LPAD_engagement_LPAD_engagementCategory` (`engagementCategory` ASC) ,
  CONSTRAINT `fk_LPAD_engagement_LPAD_engagementCategory`
    FOREIGN KEY (`engagementCategory` )
    REFERENCES `lkws_politique`.`LPAD_engagementCategory` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_interventionHasEngagement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_interventionHasEngagement` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_interventionHasEngagement` (
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
  `ordre` INT NOT NULL ,
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
  `title` VARCHAR(45) NOT NULL ,
  `link` TEXT NOT NULL ,
  `ordre` INT NULL ,
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


-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_citationCategory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_citationCategory` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_citationCategory` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `ordre` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lkws_politique`.`LPAD_citation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lkws_politique`.`LPAD_citation` ;

CREATE  TABLE IF NOT EXISTS `lkws_politique`.`LPAD_citation` (
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
    REFERENCES `lkws_politique`.`LPAD_citationCategory` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LPAD_citation_LPAD_intervention`
    FOREIGN KEY (`intervention` )
    REFERENCES `lkws_politique`.`LPAD_intervention` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `lkws_politique`;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_intervention`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_intervention` (`id`, `interventionType`, `name`, `date`) VALUES (1, 2, 'Des paroles et des actes', '2012-05-01 00:00:00');
INSERT INTO `LPAD_intervention` (`id`, `interventionType`, `name`, `date`) VALUES (2, 1, 'Soir du premier tour', '2012-05-02 00:00:00');
INSERT INTO `LPAD_intervention` (`id`, `interventionType`, `name`, `date`) VALUES (3, 3, 'Premier meeting', '2012-05-03 00:00:00');
INSERT INTO `LPAD_intervention` (`id`, `interventionType`, `name`, `date`) VALUES (4, 5, 'Medias', '2012-05-04 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_interventionType`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_interventionType` (`id`, `name`, `ordre`) VALUES (1, 'Interview télévisée', 1);
INSERT INTO `LPAD_interventionType` (`id`, `name`, `ordre`) VALUES (2, 'Meeting', 2);
INSERT INTO `LPAD_interventionType` (`id`, `name`, `ordre`) VALUES (3, 'Programme officel', 3);
INSERT INTO `LPAD_interventionType` (`id`, `name`, `ordre`) VALUES (4, 'tract', 4);
INSERT INTO `LPAD_interventionType` (`id`, `name`, `ordre`) VALUES (5, 'twitter officiel', 5);
INSERT INTO `LPAD_interventionType` (`id`, `name`, `ordre`) VALUES (6, 'débat', 6);

COMMIT;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_engagement`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_engagement` (`id`, `engagementCategory`, `title`, `content`) VALUES (1, 4, 'Droit à l\'avortement', 'C\'est nécessaire pour moi !');
INSERT INTO `LPAD_engagement` (`id`, `engagementCategory`, `title`, `content`) VALUES (2, 2, 'réformer les institutions', 'Parce qu\'elle ne nous représentent plus !');

COMMIT;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_interventionHasEngagement`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_interventionHasEngagement` (`id`, `interventionId`, `engagementId`, `originalText`, `interventionPos`, `specificLink`) VALUES (1, 1, 1, 'Je m\'engage à donner le droit d\'avorter à toutes les demmes', 'début du discours', NULL);
INSERT INTO `LPAD_interventionHasEngagement` (`id`, `interventionId`, `engagementId`, `originalText`, `interventionPos`, `specificLink`) VALUES (2, 1, 2, 'Notre pays doit immédiatement réformer ses pratiques', 'milieu du discours', NULL);
INSERT INTO `LPAD_interventionHasEngagement` (`id`, `interventionId`, `engagementId`, `originalText`, `interventionPos`, `specificLink`) VALUES (3, 2, 1, 'Il faut que les femmes puissent avorter', 'à 00:23:04', 'https://twitter.com/#!/');

COMMIT;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_engagementCategory`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (1, 'Economie et Emploi', 1);
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (2, 'Education et Recherche', 2);
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (3, 'Europe', 3);
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (4, 'Environnement et agriculture', 4);
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (5, 'Services publics et Territoires', 5);
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (6, 'Constitution et Institutions', 6);
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (7, 'Politique Etrangère', 7);
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (8, 'Numérique, Culture et Médias', 8);
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (9, 'Justice, Sécurité et Défense', 9);
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (10, 'Société, Immigration et Famille', 10);
INSERT INTO `LPAD_engagementCategory` (`id`, `name`, `ordre`) VALUES (11, 'Solidarité, Santé et Logement', 11);

COMMIT;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_source`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_source` (`id`, `intervention`, `sourceType`, `title`, `link`, `ordre`) VALUES (1, 1, 2, 'dailymotion', 'http://twitter.github.com/bootstrap/javascript.html#modals', 1);
INSERT INTO `LPAD_source` (`id`, `intervention`, `sourceType`, `title`, `link`, `ordre`) VALUES (2, 1, 4, 'france 2', 'https://github.com/loicknuchel/lepresidentadit', 2);
INSERT INTO `LPAD_source` (`id`, `intervention`, `sourceType`, `title`, `link`, `ordre`) VALUES (3, 2, 1, 'youtube', 'http://www.youtube.com/user/PomfEtThud', 1);
INSERT INTO `LPAD_source` (`id`, `intervention`, `sourceType`, `title`, `link`, `ordre`) VALUES (4, 3, 3, 'test', 'https://twitter.com/#!/', 1);
INSERT INTO `LPAD_source` (`id`, `intervention`, `sourceType`, `title`, `link`, `ordre`) VALUES (5, 4, 2, 'Sarko -3m', 'http://www.dailymotion.com/video/xqjth0_le-debat-hollande-sarkozy-en-moins-de-3-minutes_news', 1);
INSERT INTO `LPAD_source` (`id`, `intervention`, `sourceType`, `title`, `link`, `ordre`) VALUES (6, 4, 1, 'débat', 'http://www.youtube.com/watch?v=veWXj88VvZM', 2);
INSERT INTO `LPAD_source` (`id`, `intervention`, `sourceType`, `title`, `link`, `ordre`) VALUES (7, 4, 7, 'photo', 'http://cache.20minutes.fr/img/photos/20mn/2012-05/2012-05-03/article_hollande-crop.jpg', 3);

COMMIT;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_sourceType`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_sourceType` (`id`, `name`, `ordre`) VALUES (1, 'YouTube', 1);
INSERT INTO `LPAD_sourceType` (`id`, `name`, `ordre`) VALUES (2, 'DailyMotion', 2);
INSERT INTO `LPAD_sourceType` (`id`, `name`, `ordre`) VALUES (3, 'Autre vidéo', 3);
INSERT INTO `LPAD_sourceType` (`id`, `name`, `ordre`) VALUES (4, 'Site de campagne', 4);
INSERT INTO `LPAD_sourceType` (`id`, `name`, `ordre`) VALUES (5, 'Article', 5);
INSERT INTO `LPAD_sourceType` (`id`, `name`, `ordre`) VALUES (6, 'Tract', 6);
INSERT INTO `LPAD_sourceType` (`id`, `name`, `ordre`) VALUES (7, 'Image', 7);

COMMIT;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_citation`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_citation` (`id`, `intervention`, `citationCategory`, `content`, `citationPos`, `specificLink`) VALUES (1, 3, 2, 'trop top ce meeting', 'milieu', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `lkws_politique`.`LPAD_citationCategory`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO `LPAD_citationCategory` (`id`, `name`, `ordre`) VALUES (1, 'attaque candidat', 1);
INSERT INTO `LPAD_citationCategory` (`id`, `name`, `ordre`) VALUES (2, 'stupidités', 2);
INSERT INTO `LPAD_citationCategory` (`id`, `name`, `ordre`) VALUES (3, 'propositions', 3);

COMMIT;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
