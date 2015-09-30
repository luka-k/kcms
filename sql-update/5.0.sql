ALTER TABLE `child_users` ADD `has_image` TINYINT NOT NULL DEFAULT '0' AFTER `image` ;

-- Если у тебя для тестов та же база
UPDATE `child_users` SET `has_image` = '1' WHERE `id` =6;
UPDATE `child_users` SET `has_image` = '1' WHERE `id` =7;
UPDATE `child_users` SET `has_image` = '1' WHERE `id` =14;
UPDATE `child_users` SET `has_image` = '1' WHERE `id` =28;

-- Адекватные номера для тестов
UPDATE `child_users` SET `card_number` = '1111' WHERE `id` =6;
UPDATE `child_users` SET `card_number` = '2222' WHERE `id` =7;
UPDATE `child_users` SET `card_number` = '3333' WHERE `id` =14;
UPDATE `child_users` SET `card_number` = '4444' WHERE `id` =28;

UPDATE `cards` SET `card_number` = '3333' WHERE `id` =1;
UPDATE `cards` SET `card_number` = '1111' WHERE `id` =2;
UPDATE `cards` SET `card_number` = '2222' WHERE `id` =3;
UPDATE `cards` SET `card_number` = '4444' WHERE `id` =4;