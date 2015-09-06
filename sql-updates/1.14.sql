ALTER TABLE `collections` ADD `is_collection` TINYINT NOT NULL AFTER `parent_id`,
ADD `manufacturer_id` INT NOT NULL AFTER `is_collection`;