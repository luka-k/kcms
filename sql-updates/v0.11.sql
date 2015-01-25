ALTER TABLE `emails` ADD COLUMN name varchar(200);

ALTER TABLE `emails` MODIFY `type` TINYINT(1) NOT NULL default(2);

UPDATE `red_btr`.`emails` SET `type` = '1' WHERE `emails`.`id` =1;
UPDATE `red_btr`.`emails` SET `type` = '1' WHERE `emails`.`id` =2;
UPDATE `red_btr`.`emails` SET `type` = '1' WHERE `emails`.`id` =3;
UPDATE `red_btr`.`emails` SET `type` = '1' WHERE `emails`.`id` =4;
UPDATE `red_btr`.`emails` SET `type` = '1' WHERE `emails`.`id` =5;
UPDATE `red_btr`.`emails` SET `type` = '1' WHERE `emails`.`id` =6;

UPDATE `red_btr`.`emails` SET `name` = 'Администратору при заказе' WHERE `emails`.`id` =1;
UPDATE `red_btr`.`emails` SET `name` = 'Клиенту при заказе' WHERE `emails`.`id` =2;
UPDATE `red_btr`.`emails` SET `name` = 'Клиенту при изменении статуса заказа' WHERE `emails`.`id` =3;
UPDATE `red_btr`.`emails` SET `name` = 'При регистрации' WHERE `emails`.`id` =4;
UPDATE `red_btr`.`emails` SET `name` = 'При изменении пароля' WHERE `emails`.`id` =5;
UPDATE `red_btr`.`emails` SET `name` = 'Обратный звонок' WHERE `emails`.`id` =6;


CREATE TABLE IF NOT EXISTS `mailouts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`template_id` int(11),
	`users_ids` varchar(300),
	`mailouts_date` date,
	`success` int(11),
	`no_success` int(11),
	PRIMARY KEY (`id`)
)DEFAULT CHARSET=utf8;