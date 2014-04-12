SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `hackaton` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;

USE `hackaton`;

CREATE  TABLE IF NOT EXISTS `hackaton`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(45) NULL DEFAULT NULL ,
  `password` VARCHAR(400) NULL DEFAULT NULL ,
  `salt` VARCHAR(400) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`events` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL DEFAULT NULL ,
  `start_date` DATETIME NULL DEFAULT NULL ,
  `end_date` DATETIME NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`members` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `full_name` VARCHAR(450) NULL DEFAULT NULL ,
  `email` VARCHAR(200) NULL DEFAULT NULL ,
  `phone` VARCHAR(20) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `git_nickname` VARCHAR(50) NULL DEFAULT NULL ,
  `vk_link` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_members_users` (`user_id` ASC) ,
  CONSTRAINT `fk_members_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `hackaton`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`projects` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `event_id` INT(11) NOT NULL ,
  `owner_id` INT(11) NOT NULL ,
  `name` VARCHAR(500) NULL DEFAULT NULL ,
  `description` TEXT NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_project_event1` (`event_id` ASC) ,
  INDEX `fk_project_members1` (`owner_id` ASC) ,
  CONSTRAINT `fk_project_event1`
    FOREIGN KEY (`event_id` )
    REFERENCES `hackaton`.`events` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_members1`
    FOREIGN KEY (`owner_id` )
    REFERENCES `hackaton`.`members` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`event_members` (
  `event_id` INT(11) NOT NULL ,
  `members_id` INT(11) NOT NULL ,
  `status` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`event_id`, `members_id`) ,
  INDEX `fk_event_has_members_members1` (`members_id` ASC) ,
  INDEX `fk_event_has_members_event1` (`event_id` ASC) ,
  CONSTRAINT `fk_event_has_members_event1`
    FOREIGN KEY (`event_id` )
    REFERENCES `hackaton`.`events` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_has_members_members1`
    FOREIGN KEY (`members_id` )
    REFERENCES `hackaton`.`members` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`teams` (
  `id` INT(11) NOT NULL ,
  `project_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_team_project1` (`project_id` ASC) ,
  CONSTRAINT `fk_team_project1`
    FOREIGN KEY (`project_id` )
    REFERENCES `hackaton`.`projects` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`team_members` (
  `team_id` INT(11) NOT NULL ,
  `members_id` INT(11) NOT NULL ,
  PRIMARY KEY (`team_id`, `members_id`) ,
  INDEX `fk_team_has_members_members1` (`members_id` ASC) ,
  INDEX `fk_team_has_members_team1` (`team_id` ASC) ,
  CONSTRAINT `fk_team_has_members_team1`
    FOREIGN KEY (`team_id` )
    REFERENCES `hackaton`.`teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_team_has_members_members1`
    FOREIGN KEY (`members_id` )
    REFERENCES `hackaton`.`members` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`commits` (
  `id` INT(11) NOT NULL ,
  `member_id` INT(11) NOT NULL ,
  `project_id` INT(11) NOT NULL ,
  `hash` VARCHAR(45) NULL DEFAULT NULL ,
  `date` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_commits_members1` (`member_id` ASC) ,
  INDEX `fk_commits_project1` (`project_id` ASC) ,
  CONSTRAINT `fk_commits_members1`
    FOREIGN KEY (`member_id` )
    REFERENCES `hackaton`.`members` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commits_project1`
    FOREIGN KEY (`project_id` )
    REFERENCES `hackaton`.`projects` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`criterias` (
  `id` INT(11) NOT NULL ,
  `name` VARCHAR(45) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`criteria_values` (
  `id` INT(11) NOT NULL ,
  `criteria_id` INT(11) NOT NULL ,
  `max_value` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_criterias_values_criterias1` (`criteria_id` ASC) ,
  CONSTRAINT `fk_criterias_values_criterias1`
    FOREIGN KEY (`criteria_id` )
    REFERENCES `hackaton`.`criterias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`project_criterias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `criterias_id` INT(11) NOT NULL ,
  `projects_id` INT(11) NOT NULL ,
  `value` INT(11) NULL DEFAULT NULL ,
  `expert_id` INT(11) NOT NULL ,
  INDEX `fk_criterias_has_projects_projects1` (`projects_id` ASC) ,
  INDEX `fk_criterias_has_projects_criterias1` (`criterias_id` ASC) ,
  INDEX `fk_project_criterias_experts1` (`expert_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_criterias_has_projects_criterias1`
    FOREIGN KEY (`criterias_id` )
    REFERENCES `hackaton`.`criterias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_criterias_has_projects_projects1`
    FOREIGN KEY (`projects_id` )
    REFERENCES `hackaton`.`projects` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_criterias_experts1`
    FOREIGN KEY (`expert_id` )
    REFERENCES `hackaton`.`experts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `hackaton`.`experts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `full_name` VARCHAR(400) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
