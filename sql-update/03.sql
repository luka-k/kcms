ALTER TABLE `products` DROP `has_cover`;
ALTER TABLE `products` ADD `cover` VARCHAR( 255 ) NOT NULL DEFAULT 'book';
UPDATE `products` SET cover='cd' WHERE name LIKE "% CD %" OR name LIKE "% CDs %";

ALTER TABLE `products` ADD `height` INT( 11 ) NOT NULL AFTER `amount` ,
ADD `width` INT( 11 ) NOT NULL AFTER `height` ,
ADD `depth` INT( 11 ) NOT NULL AFTER `width` ;