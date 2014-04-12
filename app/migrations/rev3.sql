
ALTER TABLE `hackaton`.`criterias` ADD COLUMN `max_value` INT(11) NULL DEFAULT NULL  AFTER `created` ;

DROP TABLE IF EXISTS `hackaton`.`criteria_values` ;
