


ALTER TABLE `hackaton`.`commits` CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT  ;

ALTER TABLE `hackaton`.`criterias` CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT  ;

ALTER TABLE `hackaton`.`criterias` ADD COLUMN `max_value` INT(11) NULL DEFAULT NULL  AFTER `created` ;

DROP TABLE IF EXISTS `hackaton`.`criteria_values` ;
