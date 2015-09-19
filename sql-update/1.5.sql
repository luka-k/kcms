ALTER TABLE `settings` ADD `per_page` INT NOT NULL AFTER `order_string`;

UPDATE `settings` SET `per_page` = '3' WHERE `settings`.`id` =1;