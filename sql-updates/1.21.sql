ALTER TABLE `manufacturers` ADD `is_ranging` TINYINT NOT NULL AFTER `is_active` ;
ALTER TABLE `products` ADD `ranging` INT NOT NULL AFTER `sort` ;

UPDATE `manufacturers` SET `is_ranging` = '1' WHERE `manufacturers`.`id` =6;
UPDATE `manufacturers` SET `is_ranging` = '1' WHERE `manufacturers`.`id` =12;
UPDATE `manufacturers` SET `is_ranging` = '1' WHERE `manufacturers`.`id` =17;
UPDATE `manufacturers` SET `is_ranging` = '1' WHERE `manufacturers`.`id` =23;
UPDATE `manufacturers` SET `is_ranging` = '1' WHERE `manufacturers`.`id` =24;
UPDATE `manufacturers` SET `is_ranging` = '1' WHERE `manufacturers`.`id` =28;
UPDATE `manufacturers` SET `is_ranging` = '1' WHERE `manufacturers`.`id` =75;