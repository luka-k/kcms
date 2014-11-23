-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 12 2014 г., 22:51
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
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `parent_id`, `name`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`) VALUES
(1, 0, 'Блог', 0, '', '', '', '', 'blog'),
(3, 0, 'Новости', 0, '', '', '', '', 'novosti'),
(4, 3, 'Первая новость', 0, '', '', '', '', 'pervaya-novost');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(5) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(7, 1, 0, 'Подкатегория 2_1', '', '', '', 'podkategoriya-2-1', 15, ''),
(8, 1, 1, 'Подкатегория 2_2', '', '', '', 'podkategoriya-2-2', 15, '<p>Описание второй категории</p>\r\n<p>В два ряда</p>'),
(9, 1, 2, 'Подкатегория 2_3', '', '', '', '', 15, ''),
(12, 1, 0, 'Подкатегория 2_1_1', '', '', '', 'podkategoria', 7, ''),
(13, 1, 1, 'Подкатегория 2_1_2', '', '', '', 'podkat', 7, ''),
(14, 1, 5, 'Категория 1', '', '', '', 'kategoriya-1', 0, '<p>Описание первой категории.</p>\r\n<p>Описание первой категории.</p>'),
(15, 0, 4, 'Категория 2', '', '', '', 'kategoriya-2', 0, '&lt;p&gt;Описание второй категории&lt;/p&gt;'),
(22, 1, 0, 'Категория 3', '', '', '', 'kategoriya-3', 0, '');

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
('b99dfab377b737da0de66e16f37ec52b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:33.0) Gecko/20100101 Firefox/33.0', 1415817933, 'a:5:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"27";s:9:"user_name";s:5:"admin";s:4:"role";s:5:"admin";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Структура таблицы `dynamic_menus`
--

CREATE TABLE IF NOT EXISTS `dynamic_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `dynamic_menus`
--

INSERT INTO `dynamic_menus` (`id`, `name`, `description`) VALUES
(4, 'Верхнее меню', '');

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
  `object_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(2) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

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
(36, 1, 'products', 26, '/n/o/no-photo-available[13].png'),
(38, 1, 'categories', 15, '/n/o/no-photo-available[14].png'),
(44, 1, 'categories', 16, '/n/o/no-photo-available[18].png'),
(47, 1, 'categories', 4, '/n/o/no-photo-available[15].png'),
(51, 1, 'categories', 20, '/n/o/no-photo-available[17].png'),
(52, 1, 'products', 29, '/n/o/no-photo-available[19].png'),
(55, 1, 'categories', 7, '/n/o/no-photo-available[16].png'),
(56, 1, 'categories', 8, '/n/o/no-photo-available[20].png'),
(58, 1, 'categories', 12, '/n/o/no-photo-available[21].png');

-- --------------------------------------------------------

--
-- Структура таблицы `menus_items`
--

CREATE TABLE IF NOT EXISTS `menus_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `description`, `link`) VALUES
(1, 4, 'item-1', 0, 'описание-2', 'про-2'),
(2, 4, 'item-2', 0, 'описание', 'про'),
(3, 4, 'item-1-1', 1, 'описание', 'про'),
(4, 4, 'item-1-2', 1, 'bla', 'bla_bla');

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
(62, '541f012798fee', '30', 'Павел', 'luka_bass@inbox.ru', '8-950-123-45-67', 'street 123-45-6', 341, 4, 1, '2014-09-21 00:00:00', 2),
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
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `discount` int(2) NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `sort`, `name`, `price`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `description`) VALUES
(17, 12, 1, 3, 'Товар 1 подкатегории 2_1_1', 0, 0, '', '', '', 'tovar-1-podkategorii-2-1-1', ''),
(18, 12, 1, 4, 'Товар 2 подкатегории 2_1_1', 0, 0, '', '', '', 'tovar-2-podkategorii-2-1-1', ''),
(19, 12, 1, 0, 'Товар 3 подкатегории 2_1_1', 0, 0, '', '', '', 'tovar-3-podkategorii-2-1-1', ''),
(20, 12, 1, 1, 'Товар 4 подкатегории 2_1_1', 0, 0, '', '', '', '', ''),
(21, 8, 1, 0, 'Товар 1 подкатегории 2_2', 2000, 10, '', '', '', 'tovar-1-podkategorii-2-2', ''),
(22, 12, 1, 2, 'Товар 5 подкатегории 2_1_1', 0, 0, '', '', '', '', ''),
(23, 8, 1, 1, 'Товар 2 подкатегории 2_2', 0, 0, '', '', '', 'tovar-2-podkategorii-2-2', ''),
(24, 12, 1, 5, 'Товар 6 подкатегории 2_1_1', 0, 0, '', '', '', '', ''),
(25, 12, 1, 6, 'Товар 7 подкатегории 2_1_1', 0, 0, '', '', '', '', ''),
(26, 12, 1, 7, 'Товар 8 подкатегории 2_1_1', 0, 0, '', '', '', '', '');

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
(1, 'Пробный сайт', 'admin@admin.ru', 'admin', '', '', 0, '', 2, 6, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `address`, `role`, `secret`) VALUES
(27, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '', '', 'admin', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;