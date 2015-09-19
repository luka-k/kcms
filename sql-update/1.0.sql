ALTER TABLE `menus_items` ADD `is_manager` INT NOT NULL AFTER `url`;

UPDATE `menus_items` SET `is_manager` = '1' WHERE `menus_items`.`id` =7;

UPDATE `menus_items` SET `is_manager` = '1' WHERE `menus_items`.`id` =8;

UPDATE `menus_items` SET `is_manager` = '1' WHERE `menus_items`.`id` =9;

UPDATE `menus_items` SET `is_manager` = '1' WHERE `menus_items`.`id` =11;

UPDATE `menus_items` SET `is_manager` = '1' WHERE `menus_items`.`id` =36;

UPDATE `menus_items` SET `is_manager` = '1' WHERE `menus_items`.`id` =38;