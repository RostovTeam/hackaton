ALTER TABLE `hackaton`.`criterias` ADD COLUMN `weight` FLOAT(11) NULL DEFAULT NULL  AFTER `type` , CHANGE COLUMN `criteria_type` `type` INT(2) NULL DEFAULT NULL  ;
