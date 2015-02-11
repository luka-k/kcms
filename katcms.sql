-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 11 2015 г., 14:39
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
  `date` date NOT NULL,
  `sort` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `parent_id`, `name`, `date`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`) VALUES
(1, 0, 'Блог', '0000-00-00', 0, '', '', '', '', 'blog'),
(3, 0, 'Новости', '0000-00-00', 0, '', '', '', '', 'novosti'),
(4, 5, 'Первая новость о компании', '0000-00-00', 0, '', '', '', '', 'pervaya-novost'),
(5, 3, 'Новости компании', '2015-01-01', 0, '', '', '', '', 'novosti-kompanii'),
(6, 3, 'Новости о товарах', '0000-00-00', 0, '', '', '', '', 'novosti-o-tovarah'),
(7, 5, 'Вторая новость о компании', '0000-00-00', 0, '', '', '', '', 'vtoraya-novost-o-kompanii'),
(8, 0, 'Контакты', '0000-00-00', 0, '', '', '', '', 'kontakty');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(7, 1, 0, 'Подкатегория 2_1', '', '', '', 'podkategoriya-2-1', 15, ''),
(8, 1, 1, 'Подкатегория 2_2', '', '', '', 'podkategoriya-2-2', 15, '<p>Описание второй категории</p>\r\n<p>В два ряда</p>'),
(9, 1, 2, 'Подкатегория 2_3', '', '', '', 'kategory_2_3', 15, ''),
(12, 1, 0, 'Подкатегория 2_1_1', '', '', '', 'podkategoria', 7, ''),
(13, 1, 1, 'Подкатегория 2_1_2', '', '', '', 'podkat', 7, ''),
(14, 1, 5, 'Категория 1', '', '', '', 'kategoriya-1', 0, '<p>Описание первой категории.</p>\r\n<p>Описание первой категории.</p>'),
(15, 0, 4, 'Категория 2', '', '', '', 'kategoriya-2', 0, '&lt;p&gt;Описание второй категории&lt;/p&gt;'),
(22, 1, 0, 'Категория 3', '', '', '', 'kategoriya-3', 0, ''),
(23, 1, 0, 'Подкатегория 2_2_1', '', '', '', 'podkategoriya-2-2-1', 8, '');

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics`
--

CREATE TABLE IF NOT EXISTS `characteristics` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `object_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`id`, `type`, `value`, `object_type`, `object_id`) VALUES
(6, 'manufacturer', 'Hansa', 'products', 23),
(47, 'manufacturer', 'Ariston', 'products', 19),
(49, 'color', 'green', 'products', 21),
(50, 'manufacturer', 'Hansa', 'products', 21),
(51, 'color', 'red', 'products', 20);

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
('35304c9461c2f5c0eae13744ac701333', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423650834, 'a:4:{s:9:"user_data";s:0:"";s:4:"user";O:8:"stdClass":7:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}');

-- --------------------------------------------------------

--
-- Структура таблицы `dynamic_menus`
--

CREATE TABLE IF NOT EXISTS `dynamic_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `dynamic_menus`
--

INSERT INTO `dynamic_menus` (`id`, `name`, `description`) VALUES
(1, 'Меню админ панели', ''),
(4, 'Верхнее меню', '');

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '2',
  `subject` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `type`, `subject`, `description`, `name`) VALUES
(1, 1, 'Новый заказ', 'Кллиент  %user_name% оформил заказ № %order_id%.', 'Администратору при заказе'),
(2, 1, 'Заказ %order_id% в интернет магазине', 'Менеджер свяжется с Вами %user_name%.', 'Клиенту при заказе'),
(3, 1, 'Статус Вашего заказа изменен', 'Уважаемый %user_name%.\r\nСтатус Вашего заказа %order_id% изменен на %order_status%', 'Клиенту при изменении статуса заказа'),
(4, 1, 'Регистрация в магазине', '%user_name%, спасибо за регистрацию в нашем магазине. \r\nВаш логин %login%\r\nВаш пароль %password%', 'При регистрации'),
(5, 1, 'Ваш пароль изменен', '%user_name%, Ваш пароль в интернет магазине изменен.\r\nНовые данный доступа\r\nВаш логин %login%\r\nВаш пароль %password%', 'При изменении пароля'),
(6, 1, 'Заказан обратный звонок', '', 'Обратный звонок'),
(7, 2, 'Пробное письмо', '<p>Уважаемый, здравствуйте</p>\r\n', 'Пробный шаблон рассылки');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `url`) VALUES
(1, 1, 'settings', 1, '/n/o/no-photo-available.png');

-- --------------------------------------------------------

--
-- Структура таблицы `mailouts`
--

CREATE TABLE IF NOT EXISTS `mailouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `users_ids` varchar(300) DEFAULT NULL,
  `mailouts_date` date DEFAULT NULL,
  `success` int(11) DEFAULT NULL,
  `no_success` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `mailouts`
--

INSERT INTO `mailouts` (`id`, `template_id`, `users_ids`, `mailouts_date`, `success`, `no_success`) VALUES
(1, 7, '1', '2015-01-31', 1, 0),
(2, 7, '1', '2015-01-31', 1, 0),
(3, 7, '1', '2015-01-31', 1, 0),
(4, 7, '1', '2015-01-31', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `menus_items`
--

CREATE TABLE IF NOT EXISTS `menus_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sort` int(3) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `item_type` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(1, 4, 'Блог', 0, 1, '', 'articles', 'blog'),
(2, 4, 'Новости', 0, 0, '', 'articles', 'novosti'),
(3, 4, 'Новости компании', 2, 1, '', 'articles', 'novosti-kompanii'),
(4, 1, '<i class=icon-home></i>', 0, 2, '', 'link', '/admin/'),
(5, 1, 'Статьи', 0, 3, '', 'link', '#'),
(6, 1, 'Каталог', 0, 4, '', 'link', '#'),
(7, 1, 'Заказы', 0, 5, '', 'link', '/admin/admin_orders'),
(8, 1, 'Настройки', 0, 6, '', 'link', '#'),
(9, 1, 'Рассылки', 0, 7, '', 'link', '#'),
(10, 1, 'Меню', 0, 8, '', 'link', '/admin/menu_module/menus'),
(11, 1, 'Пользователи', 0, 9, '', 'link', '#'),
(12, 1, 'Все статьи', 5, 1, '', 'link', '/admin/content/items/articles'),
(13, 1, 'Категории', 6, 1, '', 'link', '/admin/content/items/categories'),
(14, 1, 'Создать категорию', 6, 2, '', 'link', '/admin/content/item/edit/categories'),
(15, 1, 'Товары', 6, 3, '', 'link', '/admin/content/items/products'),
(16, 1, 'Создать товар', 6, 4, '', 'link', '/admin/content/item/edit/products'),
(17, 1, 'Настройки сайта', 8, 10, '', 'link', '/admin/content/item/edit/settings/1'),
(19, 1, 'Шаблоны', 9, 1, '', 'link', '/admin/content/items/emails/2'),
(20, 1, 'Рассылки', 9, 2, '', 'link', '/admin/mailouts_module'),
(21, 1, 'Системные письма', 9, 3, '', 'link', '/admin/content/items/emails/1'),
(22, 1, 'Пользователи', 11, 1, '', 'link', '/admin/users_module'),
(23, 1, 'Группы пользователей', 11, 2, '', 'link', '/admin/content/items/users_groups');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `user_name`, `user_email`, `user_phone`, `user_address`, `total`, `delivery_id`, `payment_id`, `date`, `status_id`) VALUES
(61, '541f01199a053', '30', 'Павел', 'luka_bass@inbox.ru', '8-950-123-45-67', 'street 123-45-6', 121, 1, 1, '2014-09-21 00:00:00', 3),
(62, '541f012798fee', '30', 'Павел', 'luka_bass@inbox.ru', '8-950-123-45-67', 'street 123-45-6', 341, 4, 1, '2014-09-21 00:00:00', 2),
(63, '541f017a477b3', '30', 'Павел', 'luka_bass@inbox.ru', '8-950-123-45-67', 'street 123-45-6', 121, 1, 1, '2014-09-21 00:00:00', 1),
(64, '546c8f19227b3', '', 'Павел', 'luka_bass_king@inbox.ru', '8-950-65-65', 'rudneva', 1800, 1, 3, '2014-11-19 00:00:00', 1),
(65, '546c8f5ec26dd', '', 'Павел', 'luka_bass_king@inbox.ru', '8-950-65-65', 'rudneva', 1800, 1, 3, '2014-11-19 00:00:00', 1),
(66, '546c906451bf7', '', 'Gfgfg', 'luka_bass_king@inbox.ru', '8-950-123-45-67', 'rudneva', 1800, 1, 2, '2014-11-19 00:00:00', 1),
(67, '546ce23617866', '', 'Павел', 'luka_bass_king@inbox.ru', '8-950-123-45-67', 'rudneva', 1800, 1, 2, '2014-11-19 00:00:00', 1),
(68, '54705f72adfa3', '27', 'admin', 'admin@admin.ru', '', '', 1300, 2, 1, '2014-11-22 00:00:00', 1),
(69, '54ce6eeb6ffc4', '', 'вася', 'vasja-2@loh.ru', '555555', 'SESEFSEF', 1300, 1, 1, '2015-02-01 00:00:00', 1),
(70, '54ce716fc62d4', '', 'Петя', 'fgfg@ddf.ru', '8888', 'уауауауввввв', 1300, 1, 1, '2015-02-01 00:00:00', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

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
(28, '541f017a477b3', 14, 'Товар 1 категории 1', '120.6', 1),
(29, '546c8f5ec26dd', 21, 'Товар 1 подкатегории 2_2', '1800', 1),
(30, '546c906451bf7', 21, 'Товар 1 подкатегории 2_2', '1800', 1),
(31, '546ce23617866', 21, 'Товар 1 подкатегории 2_2', '1800', 1),
(32, '54705f72adfa3', 23, 'Товар 2 подкатегории 2_2', '1300', 1),
(33, '54ce6eeb6ffc4', 23, 'Товар 2 подкатегории 2_2', '1300', 1),
(34, '54ce716fc62d4', 23, 'Товар 2 подкатегории 2_2', '1300', 1);

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
  `article` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `discount` int(2) NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_new` int(1) DEFAULT NULL,
  `is_special` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `sort`, `name`, `article`, `price`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `description`, `is_new`, `is_special`) VALUES
(18, 14, 1, 3, 'Товар 5', '12123', 1000, 0, '', '', '', 'tovar-2-podkategorii-2-1-1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 0, 0),
(19, 14, 1, 1, 'Товар 3', '123', 1110, 0, '', '', '', 'tovar-3-podkategorii-2-1-1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 0, 0),
(20, 14, 1, 0, 'Товар 4', '344', 1000, 0, '', '', '', 'super-tovar-4-podkategorii-2-1-1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, 0),
(21, 8, 1, 1, 'Товар 1', '321', 2000, 10, '', '', '', 'tovar-1-podkategorii-2-2', '', 0, 0),
(23, 14, 1, 0, 'Товар 2', '123', 1300, 0, '', '', '', 'tovar-2-podkategorii-2-2', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 0, 0),
(24, 14, 1, 4, 'Товар 6', '12223', 1000, 0, '', '', '', 'tovar-6', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `order_string` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `order_string`, `site_description`, `site_keywords`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`) VALUES
(1, 'Пробный сайт', 'admin@admin.ru', 'admin', 'Ваш заказ оформлен', '', '', 0, '', 2, 6, 1);

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
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `address`, `secret`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '8-950-123-45', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users2users_groups`
--

CREATE TABLE IF NOT EXISTS `users2users_groups` (
  `group_parent_id` int(11) NOT NULL,
  `child_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users2users_groups`
--

INSERT INTO `users2users_groups` (`group_parent_id`, `child_id`) VALUES
(1, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_edit` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`, `is_edit`) VALUES
(1, 'admin', 0),
(2, 'customer', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
