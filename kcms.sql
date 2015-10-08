-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 08 2015 г., 22:24
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kcms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `sort` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastmod` date NOT NULL,
  `changefreq` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `parent_id`, `name`, `date`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`, `lastmod`, `changefreq`, `priority`) VALUES
(1, 0, 'Новости', '2015-10-07', 0, '', '', '', '', 'novosti', '2015-10-07', '', '0.1'),
(2, 1, 'Первая новость', '2015-10-07', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '', '', '', 'pervaya-novost', '2015-10-07', '', '0.1'),
(3, 1, 'Вторая новость', '2015-10-07', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '', '', '', 'vtoraya-novost', '2015-10-07', '', '0.1'),
(4, 1, 'Третья новость', '2015-10-07', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '', '', '', 'tretya-novost', '2015-10-07', '', '0.1'),
(5, 1, 'Четвертая новость', '2015-10-07', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '', '', '', 'chetvertaya-novost', '2015-10-07', '', '0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastmod` date NOT NULL,
  `changefreq` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `parent_id`, `description`) VALUES
(1, 1, 0, 'Букеты', '', '', '', 'bukety', '2015-09-16', '', '0.5', 0, ''),
(2, 1, 0, 'Композиционные корзины', '', '', '', 'kompozicionnye-korziny', '2015-09-16', '', '0.1', 0, ''),
(3, 1, 0, 'Композиции', '', '', '', 'kompozicii', '2015-09-16', '', '0.5', 0, ''),
(4, 1, 0, 'Цветы', '', '', '', 'cvety', '2015-09-16', '', '0.5', 0, ''),
(5, 1, 0, 'Розы', '', '', '', 'rozy', '2015-09-16', '', '0.1', 4, ''),
(6, 1, 0, 'Гвоздики', '', '', '', 'gvozdiki', '2015-09-16', '', '0.1', 4, ''),
(7, 1, 0, 'Хризантемы', '', '', '', 'hrizantemy', '2015-09-16', '', '0.1', 4, ''),
(8, 1, 0, 'Герберы', '', '', '', 'gerbery', '2015-09-16', '', '0.1', 4, ''),
(9, 1, 0, 'Лилии', '', '', '', 'lilii', '2015-09-16', '', '0.1', 4, '');

-- --------------------------------------------------------

--
-- Структура таблицы `characteristic2product`
--

CREATE TABLE IF NOT EXISTS `characteristic2product` (
  `product_id` int(11) NOT NULL,
  `characteristic_id` int(11) NOT NULL,
  KEY `product_id` (`product_id`),
  KEY `characteristic_id` (`characteristic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics`
--

CREATE TABLE IF NOT EXISTS `characteristics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `object_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_value` (`type`,`value`),
  KEY `object_type` (`object_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics_type`
--

CREATE TABLE IF NOT EXISTS `characteristics_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` int(11) NOT NULL DEFAULT '0',
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `view_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `characteristics_type`
--

INSERT INTO `characteristics_type` (`id`, `name`, `category`, `url`, `view_type`) VALUES
(1, 'Длина', 0, 'dlina', 'multy'),
(2, 'Состав', 0, 'sostav', 'multy');

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
('9d5f2c441edd75070a54206a83fcf2ff', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0', 1444332075, 'a:5:{s:9:"user_data";s:0:"";s:13:"cart_contents";a:3:{s:5:"items";a:1:{s:32:"c4ca4238a0b923820dcc509a6f75849b";a:7:{s:2:"id";s:1:"1";s:9:"parent_id";s:1:"3";s:4:"name";s:35:"Композиция Даниэла";s:3:"url";s:18:"kompoziciya-lyubov";s:5:"price";s:4:"8000";s:3:"qty";i:1;s:10:"item_total";i:8000;}}s:9:"total_qty";i:1;s:10:"cart_total";i:8000;}s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:0:"";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}');

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
(5, 'Верхнее меню сайта', '');

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '2',
  `subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `type`, `subject`, `description`, `name`) VALUES
(1, 1, 'Новый заказ', '<p>Клиент %user_name% оформил заказ № %order_code%.</p><p>Контакные данные:</p><p>email: %email%</p><p>телефон: %phone%</p><p>адрес: %address%</p><p>%products%</p>', 'Администратору при заказе'),
(2, 1, 'Заказ %order_id% в интернет магазине', '<p>Менеджер свяжется с Вами %user_name%.</p>\r\n\r\n<p>%products%</p>\r\n', 'Клиенту при заказе'),
(3, 1, 'Статус Вашего заказа изменен', 'Уважаемый %user_name%.\r\nСтатус Вашего заказа %order_id% изменен на %order_status%', 'Клиенту при изменении статуса заказа'),
(4, 1, 'Регистрация в магазине', '<p>%user_name%, спасибо за регистрацию в нашем магазине. Ваш логин %login% Ваш пароль %password%</p>\r\n', 'При регистрации'),
(5, 1, 'Ваш пароль изменен', '<p>%user_name%, Ваш пароль в интернет магазине изменен.</p>\r\n\r\n<p>Новые данные доступа:</p>\r\n\r\n<p>Ваш логин %login%</p>\r\n\r\n<p>Ваш пароль %password%</p>\r\n', 'При изменении пароля'),
(6, 1, 'Заказан обратный звонок', '<p>Клиент %user_name%, оставил номер телефона - %user_phone%</p>\r\n', 'Обратный звонок'),
(7, 1, 'Востановление пароля', '<p>Для изменения пароля перейдите по <a href="%base_url%admin/registration/new_password?email=%user_email%&amp;secret=%secret%">ссылке</a></p>\r\n', 'Востановление пароля');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `is_cover` tinyint(1) NOT NULL DEFAULT '0',
  `object_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(11) NOT NULL,
  `image_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_type_object_id` (`object_type`,`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `sort`, `name`, `is_cover`, `object_type`, `object_id`, `image_type`, `url`) VALUES
(1, 0, '1165', 1, 'products', 1, '', '/1/1/1165.jpg'),
(2, 0, '1145', 1, 'products', 2, '', '/1/1/1145.jpg'),
(3, 0, '1294', 1, 'products', 3, '', '/1/2/1294.jpg'),
(4, 0, '1178', 1, 'products', 4, '', '/1/1/1178.jpg'),
(5, 0, '1214', 1, 'products', 5, '', '/1/2/1214.jpg'),
(6, 0, '1008', 1, 'products', 6, '', '/1/0/1008.jpg'),
(7, 0, '1316', 1, 'products', 7, '', '/1/3/1316.jpg'),
(8, 0, '1040', 1, 'products', 8, '', '/1/0/1040.jpg'),
(9, 0, '1284', 1, 'products', 9, '', '/1/2/1284.jpg'),
(10, 0, '1283', 1, 'products', 10, '', '/1/2/1283.jpg'),
(12, 0, '2255', 1, 'products', 11, '', '/2/2/2255.jpg'),
(13, 0, 'akva', 1, 'products', 12, '', '/a/k/akva.jpg'),
(14, 0, 'wh-roses-2', 1, 'products', 13, '', '/w/h/wh-roses-2.jpg'),
(15, 0, 'gvozdika-1', 1, 'products', 14, '', '/g/v/gvozdika-1.jpg'),
(16, 0, '22', 1, 'products', 15, '', '/2/2/22.jpg'),
(17, 0, '8', 1, 'slider', 1, '', '/8/j/8.jpg'),
(19, 0, '1993240', 1, 'slider', 2, '', '/1/9/1993240.jpg'),
(24, 0, '1294[1]', 0, 'products', 1, '', '/1/2/1294[1].jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `mailouts`
--

CREATE TABLE IF NOT EXISTS `mailouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `users_ids` varchar(200) DEFAULT NULL,
  `mailouts_date` date DEFAULT NULL,
  `success` int(11) DEFAULT NULL,
  `no_success` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(4, 1, '<i class=icon-home></i>', 0, 0, '', 'link', 'admin/'),
(5, 1, 'Статьи', 0, 1, '', 'link', '#'),
(6, 1, 'Каталог', 0, 2, '', 'link', '#'),
(7, 1, 'Заказы', 0, 3, '', 'link', 'admin/admin_orders'),
(8, 1, 'Настройки', 0, 7, '', 'link', '#'),
(9, 1, 'Рассылки', 0, 5, '', 'link', '#'),
(10, 1, 'Меню', 8, 5, '', 'link', 'admin/menu_module/menus'),
(11, 1, 'Пользователи', 0, 6, '', 'link', '#'),
(12, 1, 'Все статьи', 5, 1, '', 'link', 'admin/content/items/articles'),
(13, 1, 'Категории', 6, 1, '', 'link', 'admin/content/items/categories/'),
(14, 1, 'Создать категорию', 6, 2, '', 'link', 'admin/content/item/edit/categories'),
(15, 1, 'Товары', 6, 3, '', 'link', 'admin/content/items/products/all'),
(16, 1, 'Создать товар', 6, 4, '', 'link', 'admin/content/item/edit/products'),
(17, 1, 'Настройки сайта', 8, 10, '', 'link', 'admin/content/item/edit/settings/1'),
(19, 1, 'Шаблоны', 9, 1, '', 'link', 'admin/content/items/emails/2'),
(20, 1, 'Рассылки', 9, 2, '', 'link', 'admin/mailouts_module'),
(21, 1, 'Системные письма', 9, 3, '', 'link', 'admin/content/items/emails/1'),
(22, 1, 'Пользователи', 11, 1, '', 'link', 'admin/users_module/'),
(23, 1, 'Группы пользователей', 11, 2, '', 'link', 'admin/content/items/users_groups/all'),
(24, 1, 'Характеристики', 6, 5, '', 'link', 'admin/content/items/characteristics_type/all'),
(35, 5, 'О нас', 0, 8, '', 'link', 'about'),
(36, 5, 'Новости', 0, 9, '', 'articles', 'novosti'),
(37, 5, 'Каталог', 0, 10, '', 'link', 'catalog'),
(38, 5, 'Контакты', 0, 11, '', 'link', 'contacts'),
(40, 1, 'Слайдер', 0, 4, '', 'link', 'admin/content/items/slider/');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_code`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `user_name`, `user_email`, `user_phone`, `user_address`, `total`, `delivery_id`, `payment_id`, `date`, `status_id`) VALUES
(1, '230786', '1', 'admin', '', '345', '', 8000, 0, 0, '2015-09-19 00:00:00', 1),
(2, '230787', '1', 'admin', 'admin@admin.ru', '34444333', 'rudneva', 5634, 0, 0, '2015-09-19 00:00:00', 1),
(3, '230788', '1', 'admin', 'admin@admin.ru', '234-56-34', 'rudneva 5-1-162', 36256, 0, 0, '2015-09-19 00:00:00', 1),
(4, '230789', '1', 'admin', 'admin@admin.ru', '+7 (123) 456-7890', 'rudneva 5-1-162', 5500, 0, 0, '2015-09-19 00:00:00', 1),
(5, '230790', '1', 'admin', 'admin@admin.ru', '+7 (987) 654-3210', 'rudneva 5-1-162', 4450, 0, 0, '2015-09-19 00:00:00', 1),
(6, '230791', '', 'Pavel', 'admin@admin.ru', '79500147120', '', 8000, 0, 0, '2015-10-08 00:00:00', 1),
(7, '230792', '', 'Pavel', 'admin@admin.ru', '79500147120', '', 8000, 0, 0, '2015-10-08 00:00:00', 1),
(8, '230793', '', 'Pavel', 'admin@admin.ru', '79500147120', '', 8000, 0, 0, '2015-10-08 00:00:00', 1),
(9, '230794', '', 'Pavel', 'admin@admin.ru', '79500147120', '', 8000, 0, 0, '2015-10-08 00:00:00', 1),
(10, '230795', '', 'Pavel', 'admin@admin.ru', '79500147120', '', 8000, 0, 0, '2015-10-08 00:00:00', 1),
(11, '230796', '', 'Pavel', 'admin@admin.ru', '79500147120', '', 8000, 0, 0, '2015-10-08 00:00:00', 1),
(12, '230797', '', 'admin', 'admin@admin.ru', '+7 (123) 456-7890', '', 5500, 0, 0, '2015-10-08 00:00:00', 1);

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
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `order_qty`) VALUES
(1, '1', 1, 'Композиция Даниэла', '8000', 1),
(2, '2', 10, 'Элис', '5634', 1),
(3, '3', 4, 'Композиция Замфира', '36256', 1),
(4, '4', 2, 'Композиция Фекла', '5500', 1),
(5, '5', 9, 'Зарина', '4450', 1),
(6, '7', 1, 'Композиция Даниэла', '8000', 1),
(7, '8', 1, 'Композиция Даниэла', '8000', 1),
(8, '9', 1, 'Композиция Даниэла', '8000', 1),
(9, '10', 1, 'Композиция Даниэла', '8000', 1),
(10, '11', 1, 'Композиция Даниэла', '8000', 1),
(11, '12', 2, 'Композиция Фекла', '5500', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `article` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `discount` tinyint(3) unsigned NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastmod` date NOT NULL,
  `changefreq` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_new` tinyint(1) DEFAULT NULL,
  `is_special` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `sort`, `name`, `article`, `price`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `description`, `is_new`, `is_special`) VALUES
(1, 3, 1, 0, 'Композиция Даниэла', '132', 8000, 0, '', '', '', 'kompoziciya-lyubov', '2015-10-07', '', '0.1', '&lt;p&gt;Состав: роза - 25шт.;&lt;br /&gt;\r\nзелень;&lt;br /&gt;\r\nкорзина;&lt;/p&gt;', 0, 1),
(2, 3, 1, 0, 'Композиция Фекла', '128', 5500, 0, '', '', '', 'kompoziciya-fekla', '2015-09-16', '', '0.1', '&lt;p&gt;Состав: роза - 13шт.;&lt;br /&gt;\r\nзелень;&lt;br /&gt;\r\nкорзина;&lt;/p&gt;', 1, 0),
(3, 3, 1, 0, 'Композиция Викторина', '294', 6256, 0, '', '', '', 'kompoziciya-viktorina', '2015-09-17', '', '0.1', '&lt;p&gt;Состав: роза - 19шт.;&lt;br /&gt;\r\nзелень;&lt;/p&gt;', 0, 1),
(4, 3, 1, 0, 'Композиция Замфира', '145', 36256, 0, '', '', '', 'kompoziciya-zamfira', '2015-09-17', '', '0.1', '&lt;p&gt;Состав: роза - 101шт.;&lt;br /&gt;\r\nкорзина;&lt;/p&gt;', 1, 0),
(5, 1, 1, 0, 'Ирина', '222', 3120, 0, '', '', '', 'buket-yarina', '2015-09-17', '', '0.1', '&lt;p&gt;Состав: роза - 11шт.;&lt;/p&gt;', 0, 1),
(6, 1, 1, 0, 'Лойсине', '118', 2350, 0, '', '', '', 'lojs', '2015-09-17', '', '0.1', '&lt;p&gt;Состав: роза - 4шт.;&lt;br /&gt;\r\nлилия - 1шт.;&lt;br /&gt;\r\nлента;&lt;br /&gt;\r\nзелень;&lt;/p&gt;', 0, 0),
(7, 1, 1, 0, 'Сочи', '1144', 3642, 0, '', '', '', 'sochi', '2015-09-17', '', '0.1', '&lt;p&gt;Состав: альстромерия - 5шт.;&lt;br /&gt;\r\nгербера - 7шт.;&lt;br /&gt;\r\nсеточка;&lt;br /&gt;\r\nзелень;&lt;/p&gt;', 0, 0),
(8, 1, 1, 0, 'Дарина', '345', 9652, 0, '', '', '', 'darina', '2015-09-17', '', '0.1', '&lt;p&gt;Состав: роза - 31шт.;&lt;br /&gt;\r\nлента;&lt;/p&gt;', 0, 0),
(9, 2, 1, 0, 'Зарина', '412', 4450, 0, '', '', '', 'zarina', '2015-09-17', '', '0.1', '&lt;p&gt;Состав: альстромерия - 4шт.;&lt;br /&gt;\r\nгербера - 5шт.;&lt;br /&gt;\r\nгвоздика - 4шт.;&lt;br /&gt;\r\nзелень;&lt;br /&gt;\r\nкорзина;&lt;/p&gt;', 1, 0),
(10, 2, 1, 0, 'Элис', '784', 5634, 0, '', '', '', 'elis', '2015-09-17', '', '0.1', '&lt;p&gt;Состав: роза - 7шт.;&lt;br /&gt;\r\nгербера - 6шт.;&lt;br /&gt;\r\nлилия - 2шт.;&lt;br /&gt;\r\nзелень;&lt;br /&gt;\r\nкорзина;&lt;/p&gt;', 1, 1),
(11, 8, 1, 0, 'Герберы 1', '223', 60, 0, '', '', '', 'gerbery-1', '2015-09-17', '', '0.1', '&lt;p&gt;Герберы в асортименте&lt;/p&gt;', 0, 0),
(12, 5, 1, 0, 'Роза №1', '23', 120, 0, '', '', '', 'roza-1', '2015-09-17', '', '0.1', '&lt;p&gt;Роза в асортименте&lt;/p&gt;', 0, 0),
(13, 5, 1, 0, 'Роза №2', '1455', 130, 0, '', '', '', 'roza-2', '2015-09-17', '', '0.1', '&lt;p&gt;Роза в ассортименте&lt;/p&gt;', 0, 0),
(14, 6, 1, 0, 'Гвоздика', '33433', 40, 0, '', '', '', 'gvozdika', '2015-09-17', '', '0.1', '&lt;p&gt;Гвоздика в ассортименте&lt;/p&gt;', 0, 0),
(15, 9, 1, 0, 'Лилия', '8558', 140, 0, '', '', '', 'liliya', '2015-09-17', '', '0.1', '&lt;p&gt;Лилия в ассортимете&lt;/p&gt;', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `recommended_products`
--

CREATE TABLE IF NOT EXISTS `recommended_products` (
  `product1_id` int(11) DEFAULT NULL,
  `product2_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_string` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `per_page` int(11) NOT NULL,
  `site_description` text COLLATE utf8_unicode_ci NOT NULL,
  `site_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastmod` date NOT NULL,
  `site_offline` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `order_string`, `per_page`, `site_description`, `site_keywords`, `lastmod`, `site_offline`) VALUES
(1, 'Ромашка', 'romashka@gmail.com', '', '', 3, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;', '', '2015-09-18', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `slider`
--

INSERT INTO `slider` (`id`, `sort`, `name`, `link`, `description`, `is_active`) VALUES
(1, 0, 'Новые поступления цветов', 'articles/novosti/pervaya-novost', 'В нашем магазине новые поступления', 1),
(2, 0, 'Новые поступления цветов', 'articles/novosti/vtoraya-novost', 'В нашем магазине новые поступления', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `valid_email` tinyint(1) NOT NULL DEFAULT '0',
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `address`, `valid_email`, `secret`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '', '', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `users2users_groups`
--

CREATE TABLE IF NOT EXISTS `users2users_groups` (
  `users_group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `users_group_id` (`users_group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users2users_groups`
--

INSERT INTO `users2users_groups` (`users_group_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_edit` tinyint(1) NOT NULL DEFAULT '1',
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
