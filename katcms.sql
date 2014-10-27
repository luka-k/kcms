-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 27 2014 г., 13:48
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `katcms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `part_id` int(2) NOT NULL,
  `is_active` int(1) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci,
  `meta_description` text COLLATE utf8_unicode_ci,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `blog`
--

INSERT INTO `blog` (`id`, `part_id`, `is_active`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `short_description`, `description`, `autor`, `date`) VALUES
(2, 0, 1, 'Первая запись в блоге', 'Первая запись в блоге', '', '', 'pervaya-zapis-v-bloge', '<p>Текст первой записи в блоге</p>', '', '', '03.09.2014'),
(3, 0, 1, 'Вторая запись в блоге', '', '', '', 'vtoraja-zapis-v-bloge', '<p>Текст второй записи</p>', '', '', '20.07.2014'),
(4, 0, 1, 'Третья запись в блоге', '', '', '', 'tretja-zapis-v-bloge', '<p>Текст третьей записи в блоге</p>', '', '', '30.07.2014');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(5) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(4, 1, 0, 'Категория 3', '', '', '', '', 0, ''),
(7, 1, 0, 'Подкатегория 2_1', '', '', '', '', 15, ''),
(8, 1, 1, 'Подкатегория 2_2', '', '', '', '', 15, ''),
(9, 1, 2, 'Подкатегория 2_3', '', '', '', '', 15, ''),
(12, 1, 1, 'Подкатегория 2_1_1', '', '', '', '', 7, ''),
(13, 1, 0, 'Подкатегория 2_1_2', '', '', '', '', 7, ''),
(14, 0, 5, 'Категория 1', '', '', '', 'kategoriya-1', 0, '<p>Описание первой категории</p>'),
(15, 0, 4, 'Категория 2', '', '', '', 'kategoriya-2', 0, '<p>Описание второй категории</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('ab541a2f71abbeb384fdad9f342b0b4b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:32.0) Gecko/20100101 Firefox/32.0', 1414402829, 'a:4:{s:4:"role";s:5:"admin";s:7:"user_id";s:2:"27";s:9:"user_name";s:5:"admin";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `type`, `subject`, `description`) VALUES
(1, 'admin_order', 'Новый заказ', 'Кллиент  %user_name% оформил заказ № %order_id%.'),
(2, 'customer_order', 'Заказ %order_id% в интернет магазине', 'Менеджер свяжется с Вами %user_name%.'),
(3, 'change_order_status', 'Статус Вашего заказа изменен', 'Уважаемый %user_name%.\r\nСтатус Вашего заказа %order_id% изменен на %order_status%'),
(4, 'registration', 'Регистрация в магазине', '%user_name%, спасибо за регистрацию в нашем магазине. \r\nВаш логин %login%\r\nВаш пароль %password%'),
(5, 'change_password', 'Ваш пароль изменен', '%user_name%, Ваш пароль в интернет магазине изменен.\r\nНовые данный доступа\r\nВаш логин %login%\r\nВаш пароль %password%'),
(6, 'callback', 'Заказан обратный звонок', '');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `is_cover` int(1) NOT NULL DEFAULT '0',
  `object_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(2) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `url`) VALUES
(23, 1, 'products', 14, '/n/o/no-photo-available.png'),
(24, 1, 'products', 15, '/n/o/no-photo-available[1].png'),
(25, 1, 'products', 16, '/n/o/no-photo-available[2].png'),
(26, 1, 'products', 17, '/n/o/no-photo-available[3].png'),
(27, 1, 'products', 18, '/n/o/no-photo-available[4].png'),
(28, 1, 'products', 19, '/n/o/no-photo-available[5].png'),
(29, 1, 'products', 20, '/n/o/no-photo-available[6].png'),
(30, 1, 'products', 21, '/n/o/no-photo-available[7].png'),
(31, 0, 'products', 21, '/n/o/no-photo-available[8].png'),
(32, 1, 'products', 22, '/n/o/no-photo-available[9].png'),
(33, 1, 'products', 23, '/n/o/no-photo-available[10].png'),
(34, 1, 'products', 24, '/n/o/no-photo-available[11].png'),
(35, 1, 'products', 25, '/n/o/no-photo-available[12].png'),
(36, 1, 'products', 26, '/n/o/no-photo-available[13].png');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `part_id` int(2) NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL,
  `title` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci,
  `meta_description` text COLLATE utf8_unicode_ci,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `part_id`, `is_active`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `short_description`, `description`, `date`) VALUES
(1, 0, 1, 'Новость первая', '', ' ', ' ', 'novost-pervaja', '<p>Текст первой новости</p>', '', '20.07.2014'),
(2, 0, 1, 'Новость вторая', '', '', '', 'novost-vtoraya', '<p>Текст второй новости</p>', '', '05.08.2014'),
(3, 0, 1, 'Новость третья', '', '', '', 'novost-tretja', '<p>Текст третьей новости</p>', '', '28.07.2014'),
(4, 0, 1, 'Новость четвертая', '', '', '', 'novost-chetvertaja', '<p>Текст четвертой новости</p>', '', '28.07.2014'),
(5, 0, 1, 'Новость пятая', '', '', '', 'novost-pjataja', '<p>Текст пятой новости</p>', '', '28.07.2014'),
(6, 0, 1, 'Новость шестая', '', '', '', 'novost-shestaya', '<p>Текст шестой новости</p>', '', '05.08.2014');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_email` text COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` text COLLATE utf8_unicode_ci NOT NULL,
  `user_address` text COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=64 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `user_name`, `user_email`, `user_phone`, `user_address`, `total`, `delivery_id`, `payment_id`, `date`, `status_id`) VALUES
(61, '541f01199a053', '30', 'Павел', 'luka_bass@inbox.ru', '8-950-123-45-67', 'street 123-45-6', 121, 1, 1, '2014-09-21 00:00:00', 3),
(62, '541f012798fee', '30', 'Павел', 'luka_bass@inbox.ru', '8-950-123-45-67', 'street 123-45-6', 341, 4, 1, '2014-09-21 00:00:00', 1),
(63, '541f017a477b3', '30', 'Павел', 'luka_bass@inbox.ru', '8-950-123-45-67', 'street 123-45-6', 121, 1, 2, '2014-09-21 00:00:00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` text COLLATE utf8_unicode_ci NOT NULL,
  `product_price` text COLLATE utf8_unicode_ci NOT NULL,
  `order_qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `order_qty`) VALUES
(2, '5416af6567a16', 14, 'Товар 1 категории 1', '120.6', 1),
(3, '541743b1a99e7', 14, 'Товар 1 категории 1', '120.6', 50),
(4, '54174443e307d', 14, 'Товар 1 категории 1', '120.6', 10),
(5, '5417e385077c9', 14, 'Товар 1 категории 1', '120.6', 1),
(6, '5417e385077c9', 15, 'Товар 2 категории 1', '160.2', 1),
(7, '541db4347ed9d', 14, 'Товар 1 категории 1', '120.6', 1),
(8, '541dcc9292f95', 14, 'Товар 1 категории 1', '120.6', 1),
(9, '541dce0197e62', 14, 'Товар 1 категории 1', '120.6', 1),
(10, '541dd19d4515c', 15, 'Товар 2 категории 1', '160.2', 1),
(11, '541eed18ce6ef', 14, 'Товар 1 категории 1', '120.6', 1),
(12, '541eed18ce6ef', 15, 'Товар 2 категории 1', '160.2', 1),
(13, '541eed2b7fbb2', 16, 'Товар 3 категории 1', '220.3', 1),
(14, '541eed2b7fbb2', 14, 'Товар 1 категории 1', '120.6', 1),
(15, '541eee4ca8f9a', 14, 'Товар 1 категории 1', '120.6', 1),
(16, '541eee70bece9', 15, 'Товар 2 категории 1', '160.2', 1),
(17, '541eee8e0e4c8', 15, 'Товар 2 категории 1', '160.2', 1),
(18, '541eee8e0e4c8', 16, 'Товар 3 категории 1', '220.3', 1),
(19, '541eefe819c1b', 14, 'Товар 1 категории 1', '120.6', 2),
(20, '541ef1c191852', 14, 'Товар 1 категории 1', '120.6', 1),
(21, '541ef1c191852', 15, 'Товар 2 категории 1', '160.2', 1),
(22, '541efb86b559e', 14, 'Товар 1 категории 1', '120.6', 1),
(23, '541efc0c7ed8c', 14, 'Товар 1 категории 1', '120.6', 1),
(24, '541efd07db45e', 14, 'Товар 1 категории 1', '120.6', 1),
(25, '541f01199a053', 14, 'Товар 1 категории 1', '120.6', 1),
(26, '541f012798fee', 14, 'Товар 1 категории 1', '120.6', 1),
(27, '541f012798fee', 16, 'Товар 3 категории 1', '220.3', 1),
(28, '541f017a477b3', 14, 'Товар 1 категории 1', '120.6', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `parts`
--

CREATE TABLE IF NOT EXISTS `parts` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `is_active` int(1) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci,
  `meta_description` text COLLATE utf8_unicode_ci,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(5) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `parts`
--

INSERT INTO `parts` (`id`, `is_active`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(1, 1, 'Блог', 'Блог', '', '', 'blog', 0, ''),
(2, 1, 'Новости', 'Новости', '', '', 'news', 0, '<p>Новости нашей компании.</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `publish_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `sort`, `title`, `price`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `description`, `publish_date`) VALUES
(17, 12, 1, 3, 'Товар 1 подкатегории 2_1_1', 0, '', '', '', '', '', 0),
(18, 12, 1, 4, 'Товар 2 подкатегории 2_1_1', 0, '', '', '', '', '', 0),
(19, 12, 1, 0, 'Товар 3 подкатегории 2_1_1', 0, '', '', '', '', '', 0),
(20, 12, 1, 1, 'Товар 4 подкатегории 2_1_1', 0, '', '', '', '', '', 0),
(21, 8, 1, 0, 'Товар 1 подкатегории 2_2', 0, '', '', '', '', '', 0),
(22, 12, 1, 2, 'Товар 5 подкатегории 2_1_1', 0, '', '', '', '', '', 0),
(23, 8, 1, 1, 'Товар 2 подкатегории 2_2', 0, '', '', '', '', '', 0),
(24, 12, 1, 5, 'Товар 6 подкатегории 2_1_1', 0, '', '', '', '', '', 0),
(25, 12, 1, 6, 'Товар 7 подкатегории 2_1_1', 0, '', '', '', '', '', 0),
(26, 12, 1, 7, 'Товар 8 подкатегории 2_1_1', 0, '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_offline` int(11) DEFAULT '0',
  `offline_text` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `main_page_type` int(11) NOT NULL DEFAULT '1',
  `main_page_id` int(11) NOT NULL,
  `main_page_cat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `site_description`, `site_keywords`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`) VALUES
(1, 'Пробный сайт', 'admin@admin.ru', 'admin', 'Описание пробного сайта', 'сайт, пробный сайт', 0, '', 2, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `address`, `role`, `secret`) VALUES
(27, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '', '', 'admin', 'd41d8cd98f00b204e9800998ecf8427e'),
(30, 'Павел', 'fae0b27c451c728867a567e8c1bb4e53', 'luka_bass@inbox.ru', '8-950-123-45-67', 'street 123-45-6', 'customer', 'd41d8cd98f00b204e9800998ecf8427e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
