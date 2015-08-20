DELETE FROM `brightbild`.`emails` WHERE `emails`.`id` = 1;
DELETE FROM `brightbild`.`emails` WHERE `emails`.`id` = 2;

INSERT INTO `emails` (`id`, `type`, `subject`, `description`, `name`) VALUES
(1, 1, 'Новый заказ', '<p>Клиент %user_name% оформил заказ № %order_code%.</p>\r\n\r\n<p>%products%</p>\r\n', 'Администратору при заказе'),
(2, 1, 'Заказ %order_code% в интернет магазине', '<p>Менеджер свяжется с Вами %user_name%.</p>\r\n\r\n<p>%products%</p>\r\n', 'Клиенту при заказе');