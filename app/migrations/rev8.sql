
ALTER TABLE `hackaton`.`project_criterias` DROP FOREIGN KEY `fk_criterias_has_projects_criterias1` , DROP FOREIGN KEY `fk_criterias_has_projects_projects1` ;

ALTER TABLE `hackaton`.`project_criterias` CHANGE COLUMN `criterias_id` `criteria_id` INT(11) NOT NULL  , CHANGE COLUMN `projects_id` `project_id` INT(11) NOT NULL  , 
  ADD CONSTRAINT `fk_criterias_has_projects_criterias1`
  FOREIGN KEY (`criteria_id` )
  REFERENCES `hackaton`.`criterias` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION, 
  ADD CONSTRAINT `fk_criterias_has_projects_projects1`
  FOREIGN KEY (`project_id` )
  REFERENCES `hackaton`.`projects` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
