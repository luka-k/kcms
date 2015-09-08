ALTER TABLE `collections` DROP `is_collection`;
ALTER TABLE `product2collection` ADD `is_collection` INT NOT NULL AFTER `is_main`;