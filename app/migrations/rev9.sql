
CREATE  TABLE IF NOT EXISTS `hackaton`.`criteria_values` (
  `id` INT(11) NOT NULL ,
  `criteria_id` INT(11) NOT NULL ,
  `max_value` INT(11) NOT NULL  DEFAULT 10,
  `label` varchar(100),
  PRIMARY KEY (`id`) ,
  INDEX `fk_criterias_values_criterias1` (`criteria_id` ASC) 
 )
ENGINE = InnoDB;


ALTER SCHEMA `hackaton`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci ;

USE `hackaton`;

ALTER TABLE `hackaton`.`users` CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `hackaton`.`events` CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `hackaton`.`members` CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `hackaton`.`projects` CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `hackaton`.`event_members` CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `hackaton`.`teams` CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `hackaton`.`team_members` CHARACTER SET = utf8 , COLLATE = utf8_general_ci , DROP FOREIGN KEY `fk_team_has_members_team1` ;

ALTER TABLE `hackaton`.`team_members` 
  ADD CONSTRAINT `fk_team_has_members_team1`
  FOREIGN KEY (`team_id` )
  REFERENCES `hackaton`.`teams` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `hackaton`.`commits` CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `hackaton`.`criterias` CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `hackaton`.`project_criterias` CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `hackaton`.`experts` CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

