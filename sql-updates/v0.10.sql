ALTER TABLE users_groups ADD COLUMN is_edit INT(1) NOT NULL default 1;

/*По идее id групп у нас должны совпасть*/
UPDATE `red_btr`.`users_groups` SET `is_edit` = '0' WHERE `users_groups`.`id` =1;
UPDATE `red_btr`.`users_groups` SET `is_edit` = '0' WHERE `users_groups`.`id` =2;