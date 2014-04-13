
ALTER TABLE `hackaton`.`criteria_values`  , CHANGE 
COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT  ;

ALTER TABLE `hackaton`.`criterias` ADD COLUMN `criteria_type` INT(2) NULL DEFAULT NULL  AFTER `max_value` ;


ALTER TABLE `hackaton`.`criteria_values`  , CHANGE COLUMN `max_value` `value` INT(11) NOT NULL DEFAULT '10'  ;

