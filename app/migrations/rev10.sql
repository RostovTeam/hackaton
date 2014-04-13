ALTER TABLE `hackaton`.`users` CHANGE COLUMN `login` `login` VARCHAR(45) NULL DEFAULT NULL  , CHANGE COLUMN `password` `password` VARCHAR(400) NULL DEFAULT NULL  , CHANGE COLUMN `salt` `salt` VARCHAR(400) NULL DEFAULT NULL  , CHANGE COLUMN `vk_token` `vk_token` VARCHAR(450) NULL DEFAULT NULL  ;

ALTER TABLE `hackaton`.`events` CHANGE COLUMN `name` `name` VARCHAR(45) NULL DEFAULT NULL  ;

ALTER TABLE `hackaton`.`members` CHANGE COLUMN `full_name` `full_name` VARCHAR(450) NULL DEFAULT NULL  , CHANGE COLUMN `email` `email` VARCHAR(200) NULL DEFAULT NULL  , CHANGE COLUMN `phone` `phone` VARCHAR(20) NULL DEFAULT NULL  , CHANGE COLUMN `git_nickname` `git_nickname` VARCHAR(50) NULL DEFAULT NULL  , CHANGE COLUMN `vk_link` `vk_link` VARCHAR(100) NULL DEFAULT NULL  ;

ALTER TABLE `hackaton`.`projects` CHANGE COLUMN `name` `name` VARCHAR(500) NULL DEFAULT NULL  , CHANGE COLUMN `description` `description` TEXT NULL DEFAULT NULL  , CHANGE COLUMN `git_url` `git_url` VARCHAR(450) NULL DEFAULT NULL  ;

ALTER TABLE `hackaton`.`commits` CHANGE COLUMN `hash` `hash` VARCHAR(450) NULL DEFAULT NULL  , CHANGE COLUMN `url` `url` VARCHAR(450) NULL DEFAULT NULL  , CHANGE COLUMN `commiter_login` `commiter_login` VARCHAR(450) NULL DEFAULT NULL  ;

ALTER TABLE `hackaton`.`criterias` CHANGE COLUMN `name` `name` VARCHAR(45) NULL DEFAULT NULL  ;

ALTER TABLE `hackaton`.`experts` CHANGE COLUMN `full_name` `full_name` VARCHAR(400) NULL DEFAULT NULL  , CHANGE COLUMN `phone` `phone` VARCHAR(45) NULL DEFAULT NULL  ;

ALTER TABLE `hackaton`.`authitemchild` COLLATE = latin1_swedish_ci ;

ALTER TABLE `hackaton`.`authitem` COLLATE = latin1_swedish_ci ;

ALTER TABLE `hackaton`.`authassignment` COLLATE = latin1_swedish_ci ;

ALTER TABLE `hackaton`.`criteria_values` COLLATE = latin1_swedish_ci , CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT  ;

ALTER TABLE `hackaton`.`criterias` ADD COLUMN `criteria_type` INT(2) NULL DEFAULT NULL  AFTER `max_value` ;

ALTER TABLE `hackaton`.`authitemchild` COLLATE = latin1_swedish_ci ;

ALTER TABLE `hackaton`.`authitem` COLLATE = latin1_swedish_ci ;

ALTER TABLE `hackaton`.`authassignment` COLLATE = latin1_swedish_ci ;

ALTER TABLE `hackaton`.`criteria_values` COLLATE = latin1_swedish_ci , CHANGE COLUMN `max_value` `value` INT(11) NOT NULL DEFAULT '10'  ;

