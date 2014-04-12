
ALTER TABLE `hackaton`.`users` ADD COLUMN `vk_token` VARCHAR(450) NULL DEFAULT NULL  AFTER `salt` ;

ALTER TABLE `hackaton`.`projects` ADD COLUMN `git_url` VARCHAR(450) NULL DEFAULT NULL  AFTER `description` ;

ALTER TABLE `hackaton`.`members` DROP FOREIGN KEY `fk_members_users` ;

ALTER TABLE `hackaton`.`members` CHANGE COLUMN `user_id` `user_id` INT(11) NULL DEFAULT NULL  , 
  ADD CONSTRAINT `fk_members_users`
  FOREIGN KEY (`user_id` )
  REFERENCES `hackaton`.`users` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

