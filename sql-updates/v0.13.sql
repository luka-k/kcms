ALTER TABLE users_groups ADD is_delete TINYINT(1) NOT NULL default '1';

UPDATE `red_btr`.`users_groups` SET `is_delete` = '0' WHERE `users_groups`.`id` =1;
UPDATE `red_btr`.`users_groups` SET `is_delete` = '0' WHERE `users_groups`.`id` =2;

ALTER TABLE emails ADD is_delete TINYINT(1) NOT NULL default '1';

UPDATE `red_btr`.`emails` SET `is_delete` = '0' WHERE `id` =1;
UPDATE `red_btr`.`emails` SET `is_delete` = '0' WHERE `id` =2;
UPDATE `red_btr`.`emails` SET `is_delete` = '0' WHERE `id` =3;
UPDATE `red_btr`.`emails` SET `is_delete` = '0' WHERE `id` =4;
UPDATE `red_btr`.`emails` SET `is_delete` = '0' WHERE `id` =5;
UPDATE `red_btr`.`emails` SET `is_delete` = '0' WHERE `id` =6;