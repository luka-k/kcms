DELETE FROM `brightbild`.`emails` WHERE `emails`.`id` = 1;
DELETE FROM `brightbild`.`emails` WHERE `emails`.`id` = 2;

INSERT INTO `emails` (`id`, `type`, `subject`, `description`, `name`) VALUES
(1, 1, 'Новый заказ', '<p>Клиент %user_name% оформил заказ № %order_code%.</p>\r\n\r\n<p>%products%</p>\r\n', 'Администратору при заказе'),
(2, 1, 'Заказ %order_code% в интернет магазине', '<p>Менеджер свяжется с Вами %user_name%.</p>\r\n\r\n<p>%products%</p>\r\n', 'Клиенту при заказе');

ALTER TABLE characteristics DROP COLUMN object_id;
ALTER TABLE characteristics ADD COLUMN parent_id INT(11) NOT NULL;

CREATE TABLE IF NOT EXISTS `characteristic2product` (
  `product_id` int(11) NOT NULL,
  `characteristic_id` int(11) NOT NULL,
  KEY `product_id` (`product_id`),
  KEY `characteristic_id` (`characteristic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;