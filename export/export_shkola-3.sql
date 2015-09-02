--
-- Структура таблицы 'cards'
--

CREATE TABLE IF NOT EXISTS `cards` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`card_number` text COLLATE utf8_unicode_ci  NOT NULL,
`card_day_limit` int(11) DEFAULT '500',
`card_credit_limit` int(11) NOT NULL,
`card_balance` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Структура таблицы 'orders'
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`card_number` text COLLATE utf8_unicode_ci  NOT NULL,
`date` date NOT NULL,
`summ` float NOT NULL,
`operation` int(11) NOT NULL,
`info` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Структура таблицы 'order2products'
--

CREATE TABLE IF NOT EXISTS `order2products` (
`order_id` int(11) NOT NULL,
`product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Структура таблицы 'child_users'
--

CREATE TABLE IF NOT EXISTS `child_users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`parent_id` int(11) NOT NULL,
`school_id` int(11) NOT NULL,
`class` varchar(255) COLLATE utf8_unicode_ci  NOT NULL,
`card_number` text COLLATE utf8_unicode_ci  NOT NULL,
`first_name` varchar(255) COLLATE utf8_unicode_ci  NOT NULL,
`last_name` varchar(255) COLLATE utf8_unicode_ci  NOT NULL,
`middle_name` varchar(255) COLLATE utf8_unicode_ci  NOT NULL,
`birthday` date NOT NULL,
`phone` varchar(255) COLLATE utf8_unicode_ci  NOT NULL,
`dinner_sms_enabled` int(11) NOT NULL,
`dinner_sms_enabled_date` date NOT NULL,
`visit_sms_enabled` int(11) NOT NULL,
`visit_sms_enabled_date` date NOT NULL,
`menu_id` int(11) NOT NULL,
`image_blob` blob NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Структура таблицы 'child2products'
--

CREATE TABLE IF NOT EXISTS `child2products` (
`child_id` int(11) NOT NULL,
`product_id` int(11) NOT NULL,
`disabled` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Структура таблицы 'categories'
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`menu_id` int(1) NOT NULL,
`sort` int(11) NOT NULL,
`name` varchar(255) COLLATE utf8_unicode_ci  NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Структура таблицы 'products'
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`parent_id` int(11) NOT NULL,
`sort` int(11) NOT NULL,
`name` varchar(255) COLLATE utf8_unicode_ci  NOT NULL,
`weight` varchar(255) COLLATE utf8_unicode_ci  NOT NULL,
`price` float NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


