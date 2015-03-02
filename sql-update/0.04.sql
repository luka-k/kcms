ALTER TABLE users_groups ADD COLUMN is_edit INT(1) NOT NULL default 1;

UPDATE `users_groups` SET `is_edit` = '0' WHERE `users_groups`.`id` =1;
UPDATE `users_groups` SET `is_edit` = '0' WHERE `users_groups`.`id` =2;

ALTER TABLE users_groups ADD is_delete TINYINT(1) NOT NULL default '1';

UPDATE `users_groups` SET `is_delete` = '0' WHERE `users_groups`.`id` =1;
UPDATE `users_groups` SET `is_delete` = '0' WHERE `users_groups`.`id` =2;

INSERT INTO `users_groups` (`name`, `is_edit`, `is_deleted`) VALUES ('subscribers', '0', '0');