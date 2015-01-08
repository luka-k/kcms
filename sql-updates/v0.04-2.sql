CREATE TABLE IF NOT EXISTS `filials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `filials` (`id`, `name`, `phone`, `caption`) VALUES
(1, 'Санкт-Петербург', '+7 (812) 999 99 99', 'время работы: пн-пт 10:00 - 18:00'),
(2, 'Сингапур', '+7 (812) 999 99 98', '');