ALTER TABLE `hackaton`.`commits` DROP FOREIGN KEY `fk_commits_members1` ;

ALTER TABLE `hackaton`.`commits` ADD COLUMN `url` VARCHAR(450) NULL DEFAULT NULL  AFTER `date` , CHANGE COLUMN `member_id` `member_id` INT(11) NULL DEFAULT NULL  , CHANGE COLUMN `hash` `hash` VARCHAR(450) NULL DEFAULT NULL  , 
  ADD CONSTRAINT `fk_commits_members1`
  FOREIGN KEY (`member_id` )
  REFERENCES `hackaton`.`members` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `hackaton`.`commits` ADD COLUMN `commiter_login` VARCHAR(450) NULL DEFAULT NULL  AFTER `url` ;


