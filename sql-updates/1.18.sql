ALTER TABLE `categories` ADD `in_catalog` INT NOT NULL AFTER `is_active`;

-- Это что бы все отображались добавленные сейчас. ну хотя бы для проверки
UPDATE `categories` SET `in_catalog` =1 WHERE `in_catalog` =0