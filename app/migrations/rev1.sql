
ALTER TABLE `hackaton`.`users` ADD COLUMN `vk_token` VARCHAR(450) NULL DEFAULT NULL  AFTER `salt` ;

ALTER TABLE `hackaton`.`projects` ADD COLUMN `git_url` VARCHAR(450) NULL DEFAULT NULL  AFTER `description` ;

