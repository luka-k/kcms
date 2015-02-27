CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users2users_groups` (
  `group_parent_id` int(11) NOT NULL,
  `child_id` varchar(255) NOT NULL
)DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'customer');

INSERT INTO `users2users_groups` (`group_parent_id`, `child_id`) VALUES
(1, 27);

ALTER TABLE `users` DROP `role`;



ALTER TABLE `emails` ADD COLUMN name varchar(200);

ALTER TABLE `emails` MODIFY `type` TINYINT(1) NOT NULL default 2;

UPDATE `emails` SET `type` = '1' WHERE `emails`.`id` = 1;
UPDATE `emails` SET `type` = '1' WHERE `emails`.`id` = 2;
UPDATE `emails` SET `type` = '1' WHERE `emails`.`id` = 3;
UPDATE `emails` SET `type` = '1' WHERE `emails`.`id` = 4;
UPDATE `emails` SET `type` = '1' WHERE `emails`.`id` = 5;
UPDATE `emails` SET `type` = '1' WHERE `emails`.`id` = 6;

UPDATE `emails` SET `name` = 'Администратору при заказе' WHERE `emails`.`id` =1;
UPDATE `emails` SET `name` = 'Клиенту при заказе' WHERE `emails`.`id` =2;
UPDATE `emails` SET `name` = 'Клиенту при изменении статуса заказа' WHERE `emails`.`id` =3;
UPDATE `emails` SET `name` = 'При регистрации' WHERE `emails`.`id` =4;
UPDATE `emails` SET `name` = 'При изменении пароля' WHERE `emails`.`id` =5;
UPDATE `emails` SET `name` = 'Обратный звонок' WHERE `emails`.`id` =6;


CREATE TABLE IF NOT EXISTS `mailouts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`template_id` int(11),
	`users_ids` varchar(300),
	`mailouts_date` date,
	`success` int(11),
	`no_success` int(11),
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8;