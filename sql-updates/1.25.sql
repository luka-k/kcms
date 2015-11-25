ALTER TABLE `settings` ADD `status` VARCHAR( 255 ) NOT NULL AFTER `id` ;

UPDATE `settings` SET `status` = 'operating' WHERE `settings`.`id` =1;