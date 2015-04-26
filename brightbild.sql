-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 26 2015 г., 19:09
-- Версия сервера: 5.1.63-community-log
-- Версия PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `brightbild`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `description`) VALUES
(8, 1, 0, 'аксессуары для ванной', '', '', '', 'aksessuary-dlya-vannoj', '0000-00-00', '', '', NULL),
(9, 1, 0, 'Ванная комната', '', '', '', 'vannaya-komnata', '0000-00-00', '', '', NULL),
(10, 1, 0, 'светильники для ванной', '', '', '', 'svetilniki-dlya-vannoj', '0000-00-00', '', '', NULL),
(11, 1, 0, 'Свет/Электрика', '', '', '', 'svet-elektrika', '0000-00-00', '', '', NULL),
(12, 1, 0, 'зеркала косметические', '', '', '', 'zerkala-kosmeticheskie', '0000-00-00', '', '', NULL),
(13, 1, 0, 'Зеркала', '', '', '', 'zerkala', '0000-00-00', '', '', NULL),
(14, 1, 0, 'зеркала для ванной', '', '', '', 'zerkala-dlya-vannoj', '0000-00-00', '', '', NULL),
(15, 1, 0, 'фены для ванной', '', '', '', 'feny-dlya-vannoj', '0000-00-00', '', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `category2category`
--

CREATE TABLE IF NOT EXISTS `category2category` (
  `category_parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `category2category`
--

INSERT INTO `category2category` (`category_parent_id`, `child_id`) VALUES
(0, 9),
(9, 8),
(0, 11),
(11, 10),
(9, 10),
(0, 13),
(13, 12),
(9, 12),
(13, 14),
(9, 14),
(9, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics`
--

CREATE TABLE IF NOT EXISTS `characteristics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `object_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_value` (`type`,`value`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
('a34daa4712e68e26ec215d0e9d4bc5e1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', 1430060905, 'a:3:{s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:32:"f556de45badbca0264ee68f418a42265";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}');

-- --------------------------------------------------------

--
-- Структура таблицы `collections`
--

CREATE TABLE IF NOT EXISTS `collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `collections`
--

INSERT INTO `collections` (`id`, `parent_id`, `name`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`, `lastmod`, `changefreq`, `priority`) VALUES
(5, 0, 'Basic', 0, '', '', '', '', 'Basic', '0000-00-00', '', ''),
(6, 0, 'Gallery', 0, '', '', '', '', 'Gallery', '0000-00-00', '', ''),
(7, 0, 'Isole', 0, '', '', '', '', 'Isole', '0000-00-00', '', ''),
(8, 0, 'Land', 0, '', '', '', '', 'Land', '0000-00-00', '', ''),
(9, 0, 'Bart', 0, '', '', '', '', 'Bart', '0000-00-00', '', ''),
(10, 0, 'Khala', 0, '', '', '', '', 'Khala', '0000-00-00', '', ''),
(11, 0, 'Appenditutto', 0, '', '', '', '', 'Appenditutto', '0000-00-00', '', ''),
(12, 0, 'Oggettistica', 0, '', '', '', '', 'Oggettistica', '0000-00-00', '', ''),
(13, 0, 'Look', 0, '', '', '', '', 'Look', '0000-00-00', '', ''),
(14, 0, 'Link', 0, '', '', '', '', 'Link', '0000-00-00', '', ''),
(15, 0, 'Lulu', 0, '', '', '', '', 'Lulu', '0000-00-00', '', ''),
(16, 0, 'Luna', 0, '', '', '', '', 'Luna', '0000-00-00', '', ''),
(17, 0, 'Melo', 0, '', '', '', '', 'Melo', '0000-00-00', '', ''),
(18, 0, 'Nordic', 0, '', '', '', '', 'Nordic', '0000-00-00', '', ''),
(19, 0, 'Positano', 0, '', '', '', '', 'Positano', '0000-00-00', '', ''),
(20, 0, 'Over', 0, '', '', '', '', 'Over', '0000-00-00', '', ''),
(21, 0, 'Planets', 0, '', '', '', '', 'Planets', '0000-00-00', '', ''),
(22, 0, 'Plus', 0, '', '', '', '', 'Plus', '0000-00-00', '', ''),
(23, 0, 'Portofino', 0, '', '', '', '', 'Portofino', '0000-00-00', '', ''),
(24, 0, 'Sguare', 0, '', '', '', '', 'Sguare', '0000-00-00', '', ''),
(25, 0, 'Complementi', 0, '', '', '', '', 'Complementi', '0000-00-00', '', ''),
(26, 0, 'Time', 0, '', '', '', '', 'Time', '0000-00-00', '', ''),
(27, 0, 'Units', 0, '', '', '', '', 'Units', '0000-00-00', '', ''),
(28, 0, 'Alize', 0, '', '', '', '', 'Alize', '0000-00-00', '', ''),
(29, 0, 'Black & White', 0, '', '', '', '', 'Black & White', '0000-00-00', '', ''),
(30, 0, 'Viva', 0, '', '', '', '', 'Viva', '0000-00-00', '', ''),
(31, 0, 'Yoga', 0, '', '', '', '', 'Yoga', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `dynamic_menus`
--

CREATE TABLE IF NOT EXISTS `dynamic_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `dynamic_menus`
--

INSERT INTO `dynamic_menus` (`id`, `name`, `description`) VALUES
(1, 'Меню админ панели', ''),
(2, 'Верхнее меню', '');

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
(1, 1, 'Новый заказ', 'Кллиент  %user_name% оформил заказ № %order_id%.', 'Администратору при заказе'),
(2, 1, 'Заказ %order_id% в интернет магазине', '<p>Менеджер свяжется с Вами %user_name%.</p>\r\n\r\n<p>%products%</p>\r\n', 'Клиенту при заказе'),
(3, 1, 'Статус Вашего заказа изменен', 'Уважаемый %user_name%.\r\nСтатус Вашего заказа %order_id% изменен на %order_status%', 'Клиенту при изменении статуса заказа'),
(4, 1, 'Регистрация в магазине', '%user_name%, спасибо за регистрацию в нашем магазине. \r\nВаш логин %login%\r\nВаш пароль %password%', 'При регистрации'),
(5, 1, 'Ваш пароль изменен', '<p>%user_name%, Ваш пароль в интернет магазине изменен.</p>\r\n\r\n<p>Новые данные доступа:</p>\r\n\r\n<p>Ваш логин %login%</p>\r\n\r\n<p>Ваш пароль %password%</p>\r\n', 'При изменении пароля'),
(6, 1, 'Заказан обратный звонок', '<p>Клиент %USER_NAME%, оставил номер телефона - %USER_PHONE%</p>\r\n', 'Обратный звонок'),
(7, 1, 'Востановление пароля', '<p>Для изменения пароля перейдите по <a href="%base_url%admin/registration/new_password?email=%user_email%&amp;secret=%secret%">ссылке</a></p>\r\n', 'Востановление пароля');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `is_cover` tinyint(1) NOT NULL DEFAULT '0',
  `object_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(11) NOT NULL,
  `image_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_type_object_id` (`object_type`,`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
-- Структура таблицы `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `url`, `phone`, `link`) VALUES
(6, 'Colombo', '', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(1, 4, 'Блог', 0, 1, '', 'articles', 'blog'),
(2, 4, 'Новости', 0, 0, '', 'articles', 'novosti'),
(4, 1, '<i class=icon-home></i>', 0, 0, '', 'link', 'admin/'),
(5, 1, 'Статьи', 0, 1, '', 'link', '#'),
(6, 1, 'Каталог', 0, 2, '', 'link', '#'),
(7, 1, 'Заказы', 0, 5, '', 'link', 'admin/admin_orders'),
(8, 1, 'Настройки', 0, 6, '', 'link', '#'),
(9, 1, 'Рассылки', 0, 7, '', 'link', '#'),
(10, 1, 'Меню', 0, 8, '', 'link', 'admin/menu_module/menus'),
(11, 1, 'Пользователи', 0, 9, '', 'link', '#'),
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
(33, 4, 'Контакты', 0, 17, '', 'link', 'contacts/'),
(34, 4, 'Каталог', 0, 18, '', 'link', 'catalog/'),
(35, 1, 'Производители', 0, 3, '', 'link', 'admin/content/items/manufacturer/all'),
(36, 1, 'Коллекции', 0, 4, '', 'link', 'admin/content/items/collections/all');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `product2category`
--

CREATE TABLE IF NOT EXISTS `product2category` (
  `category_parent_id` int(10) NOT NULL,
  `child_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `product2collection`
--

CREATE TABLE IF NOT EXISTS `product2collection` (
  `collection_parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `product2collection`
--

INSERT INTO `product2collection` (`collection_parent_id`, `child_id`) VALUES
(5, 447),
(5, 448),
(6, 449),
(6, 450),
(6, 451),
(6, 452),
(7, 453),
(7, 454),
(7, 455),
(7, 456),
(7, 457),
(7, 458),
(7, 459),
(7, 460),
(7, 461),
(7, 462),
(7, 463),
(7, 464),
(8, 465),
(8, 466),
(8, 467),
(9, 468),
(8, 468),
(8, 469),
(8, 470),
(8, 471),
(7, 472),
(7, 473),
(7, 474),
(7, 475),
(10, 476),
(10, 477),
(10, 478),
(10, 479),
(10, 480),
(10, 481),
(10, 482),
(10, 483),
(10, 484),
(10, 485),
(10, 486),
(10, 487),
(10, 488),
(10, 489),
(7, 489),
(10, 490),
(10, 491),
(10, 492),
(8, 493),
(8, 494),
(8, 495),
(8, 496),
(8, 497),
(8, 498),
(8, 499),
(8, 500),
(8, 501),
(8, 502),
(8, 503),
(8, 504),
(8, 505),
(8, 506),
(8, 507),
(8, 508),
(8, 509),
(11, 509),
(8, 510),
(11, 510),
(8, 511),
(12, 511),
(13, 512),
(13, 513),
(13, 514),
(13, 515),
(13, 516),
(13, 517),
(13, 518),
(13, 519),
(13, 520),
(13, 521),
(13, 522),
(13, 523),
(13, 524),
(13, 525),
(13, 526),
(13, 527),
(13, 528),
(8, 529),
(12, 529),
(8, 530),
(12, 530),
(8, 531),
(12, 531),
(8, 532),
(12, 532),
(14, 533),
(14, 534),
(14, 535),
(14, 536),
(14, 537),
(14, 538),
(14, 539),
(14, 540),
(14, 541),
(14, 542),
(14, 543),
(14, 544),
(14, 545),
(14, 546),
(14, 547),
(14, 548),
(14, 549),
(14, 550),
(14, 551),
(14, 552),
(11, 552),
(14, 553),
(12, 553),
(14, 554),
(12, 554),
(14, 555),
(12, 555),
(15, 556),
(15, 557),
(15, 558),
(15, 559),
(15, 560),
(15, 561),
(15, 562),
(15, 563),
(11, 563),
(13, 564),
(13, 565),
(11, 565),
(13, 566),
(11, 566),
(13, 567),
(12, 567),
(13, 568),
(12, 568),
(13, 569),
(12, 569),
(13, 570),
(12, 570),
(13, 571),
(12, 571),
(13, 572),
(12, 572),
(15, 573),
(15, 574),
(15, 575),
(15, 576),
(15, 577),
(15, 578),
(15, 579),
(15, 580),
(15, 581),
(15, 582),
(15, 583),
(15, 584),
(16, 585),
(16, 586),
(16, 587),
(16, 588),
(16, 589),
(16, 590),
(16, 591),
(16, 592),
(16, 593),
(16, 594),
(16, 595),
(16, 596),
(16, 597),
(11, 597),
(16, 598),
(11, 598),
(16, 599),
(12, 599),
(16, 600),
(12, 600),
(15, 601),
(11, 601),
(15, 602),
(12, 602),
(15, 603),
(12, 603),
(15, 604),
(12, 604),
(15, 605),
(12, 605),
(16, 606),
(16, 607),
(16, 608),
(16, 609),
(16, 610),
(17, 611),
(17, 612),
(17, 613),
(17, 614),
(17, 615),
(17, 616),
(17, 617),
(17, 618),
(17, 619),
(17, 620),
(17, 621),
(12, 621),
(17, 622),
(12, 622),
(18, 623),
(18, 624),
(18, 625),
(18, 626),
(18, 627),
(18, 628),
(18, 629),
(18, 630),
(18, 631),
(18, 632),
(18, 633),
(18, 634),
(18, 635),
(11, 635),
(18, 636),
(11, 636),
(18, 637),
(12, 637),
(18, 638),
(12, 638),
(18, 639),
(12, 639),
(19, 640),
(12, 640),
(19, 641),
(12, 641),
(19, 642),
(12, 642),
(20, 643),
(20, 644),
(20, 645),
(20, 646),
(20, 647),
(10, 648),
(11, 648),
(10, 649),
(12, 649),
(10, 650),
(12, 650),
(10, 651),
(12, 651),
(20, 652),
(20, 653),
(20, 654),
(20, 655),
(20, 656),
(20, 657),
(20, 658),
(20, 659),
(20, 660),
(11, 660),
(20, 661),
(12, 661),
(20, 662),
(12, 662),
(20, 663),
(12, 663),
(21, 664),
(21, 665),
(21, 666),
(21, 667),
(21, 668),
(21, 669),
(21, 670),
(21, 671),
(21, 672),
(21, 673),
(21, 674),
(21, 675),
(21, 676),
(21, 677),
(21, 678),
(21, 679),
(21, 680),
(21, 681),
(21, 682),
(21, 683),
(22, 684),
(22, 685),
(22, 686),
(22, 687),
(22, 688),
(22, 689),
(22, 690),
(22, 691),
(22, 692),
(22, 693),
(22, 694),
(22, 695),
(22, 696),
(22, 697),
(22, 698),
(22, 699),
(22, 700),
(22, 701),
(22, 702),
(22, 703),
(22, 704),
(22, 705),
(22, 706),
(22, 707),
(22, 708),
(22, 709),
(22, 710),
(22, 711),
(11, 711),
(22, 712),
(12, 712),
(22, 713),
(12, 713),
(22, 714),
(12, 714),
(22, 715),
(12, 715),
(23, 716),
(23, 717),
(23, 718),
(23, 719),
(23, 720),
(23, 721),
(23, 722),
(23, 723),
(23, 724),
(23, 725),
(23, 726),
(23, 727),
(23, 728),
(23, 729),
(23, 730),
(23, 731),
(23, 732),
(23, 733),
(23, 734),
(23, 735),
(23, 736),
(23, 737),
(23, 738),
(23, 739),
(11, 739),
(23, 740),
(11, 740),
(23, 741),
(12, 741),
(23, 742),
(12, 742),
(23, 743),
(12, 743),
(24, 744),
(24, 745),
(24, 746),
(24, 747),
(24, 748),
(24, 749),
(24, 750),
(24, 751),
(25, 752),
(24, 753),
(26, 754),
(26, 755),
(26, 756),
(26, 757),
(26, 758),
(26, 759),
(26, 760),
(26, 761),
(26, 762),
(26, 763),
(26, 764),
(26, 765),
(26, 766),
(26, 767),
(26, 768),
(26, 769),
(26, 770),
(26, 771),
(26, 772),
(11, 772),
(26, 773),
(11, 773),
(26, 774),
(11, 774),
(26, 775),
(11, 775),
(26, 776),
(11, 776),
(26, 777),
(12, 777),
(26, 778),
(12, 778),
(26, 779),
(12, 779),
(27, 780),
(27, 781),
(27, 782),
(27, 783),
(27, 784),
(27, 785),
(27, 786),
(27, 787),
(27, 788),
(27, 789),
(27, 790),
(25, 791),
(25, 792),
(25, 793),
(25, 794),
(25, 795),
(25, 796),
(25, 797),
(25, 798),
(25, 799),
(25, 800),
(25, 801),
(25, 802),
(22, 803),
(22, 804),
(28, 805),
(9, 806),
(9, 807),
(9, 808),
(9, 809),
(9, 810),
(9, 811),
(9, 812),
(9, 813),
(9, 814),
(9, 815),
(9, 816),
(9, 817),
(9, 818),
(11, 818),
(9, 819),
(11, 819),
(9, 820),
(12, 820),
(5, 821),
(5, 822),
(5, 823),
(5, 824),
(5, 825),
(5, 826),
(5, 827),
(5, 828),
(5, 829),
(5, 830),
(5, 831),
(5, 832),
(5, 833),
(5, 834),
(5, 835),
(5, 836),
(5, 837),
(5, 838),
(29, 839),
(29, 840),
(29, 841),
(29, 842),
(29, 843),
(29, 844),
(29, 845),
(29, 846),
(29, 847),
(29, 848),
(29, 849),
(29, 850),
(29, 851),
(29, 852),
(29, 853),
(29, 854),
(29, 855),
(29, 856),
(29, 857),
(6, 858),
(17, 859),
(28, 860),
(12, 860),
(28, 861),
(28, 862),
(28, 863),
(11, 863),
(28, 864),
(28, 865),
(28, 866),
(17, 867),
(17, 868),
(28, 869),
(28, 870),
(28, 871),
(12, 871),
(28, 872),
(12, 872),
(28, 873),
(28, 874),
(28, 875),
(11, 876),
(11, 877),
(11, 878),
(30, 878),
(11, 879),
(31, 879),
(9, 880),
(9, 881),
(11, 882),
(11, 883),
(9, 884),
(9, 885),
(9, 886),
(9, 887);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
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
  `width` float NOT NULL,
  `height` float NOT NULL,
  `depth` float NOT NULL,
  `color` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `turn` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `material` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `finishing` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `shortdesc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `1c_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `shortname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`manufacturer_id`),
  KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=888 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `manufacturer_id`, `is_active`, `sort`, `name`, `sku`, `price`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `description`, `is_new`, `is_special`, `width`, `height`, `depth`, `color`, `turn`, `material`, `finishing`, `shortdesc`, `parent_id`, `1c_id`, `shortname`) VALUES
(447, 6, 1, 0, 'COLOMBO Basic  B2713 340 хром. Полотенцедержатель настенный', 'B2713', 0, 0, '', '', '', 'colombo-basic-b2713-340-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 340, 0, 0, 'хром', '', '', '', '', 8, 'e7f8dfc6-065c-11e4-859e-0011951d1b08', 'Полотенцедержатель настенный'),
(448, 6, 1, 0, 'COLOMBO Basic  B2787 545xh120x280 хром. Полотенцедержатель настенный большой', 'B2787', 0, 0, '', '', '', 'colombo-basic-b2787-545xh120x280-hrom-polotencederzhatel-nastennyj-bolshoj', '0000-00-00', '', '', '', NULL, NULL, 545, 120, 280, 'хром', '', '', '', 'большой', 8, 'e7f8dfc7-065c-11e4-859e-0011951d1b08', 'Полотенцедержатель настенный'),
(449, 6, 1, 0, 'COLOMBO Gallery  B1332 60xh170x150 хром/стекло матовое. Светильник на зеркало', 'B1332', 0, 0, '', '', '', 'colombo-gallery-b1332-60xh170x150-hrom-steklo-matovoe-svetilnik-na-zerkalo', '0000-00-00', '', '', '', NULL, NULL, 60, 170, 150, 'хром', '', 'стекло', 'матовое', '', 10, 'b13c0502-b4d5-11e3-8836-0011951d1b08', 'Светильник на зеркало'),
(450, 6, 1, 0, 'COLOMBO Gallery  B1391 260xh125x135 хром/стекло матовое. Светильник настенный/потолочный', 'B1391', 0, 0, '', '', '', 'colombo-gallery-b1391-260xh125x135-hrom-steklo-matovoe-svetilnik-nastennyj-potolochnyj', '0000-00-00', '', '', '', NULL, NULL, 260, 125, 135, 'хром', '', 'стекло', 'матовое', '', 10, 'b13c0505-b4d5-11e3-8836-0011951d1b08', 'Светильник настенный/потолочный'),
(451, 6, 1, 0, 'COLOMBO Gallery  B1392 175xh45x160 хром/стекло матовое. Светильник настенный/потолочный', 'B1392', 0, 0, '', '', '', 'colombo-gallery-b1392-175xh45x160-hrom-steklo-matovoe-svetilnik-nastennyj-potolochnyj', '0000-00-00', '', '', '', NULL, NULL, 175, 45, 160, 'хром', '', 'стекло', 'матовое', '', 10, 'b13c0507-b4d5-11e3-8836-0011951d1b08', 'Светильник настенный/потолочный'),
(452, 6, 1, 0, 'COLOMBO Gallery  B1393 255xh40x140 хром/стекло матовое. Светильник настенный', 'B1393', 0, 0, '', '', '', 'colombo-gallery-b1393-255xh40x140-hrom-steklo-matovoe-svetilnik-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 255, 40, 140, 'хром', '', 'стекло', 'матовое', '', 10, 'b13c0508-b4d5-11e3-8836-0011951d1b08', 'Светильник настенный'),
(453, 6, 1, 0, 'COLOMBO Isole  B9407 240xh750x240 хром. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги)', 'B9407', 0, 0, '', '', '', 'colombo-isole-b9407-240xh750x240-hrom-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 240, 750, 240, 'хром', '', '', '', '(ершик + держатель туалетной бумаги)', 8, 'b13c0520-b4d5-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(454, 6, 1, 0, 'COLOMBO Isole  B9416 240xh750x240 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги)', 'B9416', 0, 0, '', '', '', 'colombo-isole-b9416-240xh750x240-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 240, 750, 240, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги)', 8, 'b13c0522-b4d5-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(455, 6, 1, 0, 'COLOMBO Isole  B9403 490xh900x280 хром. Полотенцедержатель напольный тройной, поворотный', 'B9403', 0, 0, '', '', '', 'colombo-isole-b9403-490xh900x280-hrom-polotencederzhatel-napolnyj-trojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 490, 900, 280, 'хром', '', '', '', 'тройной, поворотный', 8, 'b13c0523-b4d5-11e3-8836-0011951d1b08', 'Полотенцедержатель напольный'),
(456, 6, 1, 0, 'COLOMBO Isole  B9414 410xh900x280 хром/стекло матовое. Стойка с аксессуарами напольная (мыльница + полотенцедержатель двойной, поворотный)', 'B9414', 0, 0, '', '', '', 'colombo-isole-b9414-410xh900x280-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-mylnica-polotencederzhatel-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 410, 900, 280, 'хром', '', 'стекло', 'матовое', '(мыльница + полотенцедержатель двойной, поворотный)', 8, 'b13c0526-b4d5-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(457, 6, 1, 0, 'COLOMBO Isole  B9415 460xh900x280 хром. Полотенцедержатель напольный тройной, поворотный', 'B9415', 0, 0, '', '', '', 'colombo-isole-b9415-460xh900x280-hrom-polotencederzhatel-napolnyj-trojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 460, 900, 280, 'хром', '', '', '', 'тройной, поворотный', 8, 'b13c0528-b4d5-11e3-8836-0011951d1b08', 'Полотенцедержатель напольный'),
(458, 6, 1, 0, 'COLOMBO Isole  B9408 400xh900x280 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + полка)', 'B9408', 0, 0, '', '', '', 'colombo-isole-b9408-400xh900x280-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-polka', '0000-00-00', '', '', '', NULL, NULL, 400, 900, 280, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + полка)', 8, 'b13c0529-b4d5-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(459, 6, 1, 0, 'COLOMBO Isole  B9409 400xh900x250 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 'B9409', 0, 0, '', '', '', 'colombo-isole-b9409-400xh900x250-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-mylnica', '0000-00-00', '', '', '', NULL, NULL, 400, 900, 250, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 8, 'b13c052b-b4d5-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(460, 6, 1, 0, 'COLOMBO Isole  B9413 370xh900x240 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 'B9413', 0, 0, '', '', '', 'colombo-isole-b9413-370xh900x240-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-mylnica', '0000-00-00', '', '', '', NULL, NULL, 370, 900, 240, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 8, 'b13c052d-b4d5-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(461, 6, 1, 0, 'COLOMBO Isole  B9417 400xh900x280 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + полка) (снято с производства 01.01.14)', 'B9417', 0, 0, '', '', '', 'colombo-isole-b9417-400xh900x280-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-polka-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 400, 900, 280, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + полка)', 8, 'b13c052e-b4d5-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(462, 6, 1, 0, 'COLOMBO Isole  B9418 400xh900x250 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 'B9418', 0, 0, '', '', '', 'colombo-isole-b9418-400xh900x250-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-mylnica', '0000-00-00', '', '', '', NULL, NULL, 400, 900, 250, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 8, 'b13c052f-b4d5-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(463, 6, 1, 0, 'COLOMBO Isole  B9419 360xh900x240 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 'B9419', 0, 0, '', '', '', 'colombo-isole-b9419-360xh900x240-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-mylnica', '0000-00-00', '', '', '', NULL, NULL, 360, 900, 240, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 8, 'b13c0530-b4d5-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(464, 6, 1, 0, 'COLOMBO Isole  B9412 450xh1780x320 хром. Вешалка напольная (2 полотенцедержателя + 2 крючка)', 'B9412', 0, 0, '', '', '', 'colombo-isole-b9412-450xh1780x320-hrom-veshalka-napolnaya-2-polotencederzhatelya-2-kryuchka', '0000-00-00', '', '', '', NULL, NULL, 450, 1780, 320, 'хром', '', '', '', '(2 полотенцедержателя + 2 крючка)', 8, 'b13c0531-b4d5-11e3-8836-0011951d1b08', 'Вешалка напольная'),
(465, 6, 1, 0, 'COLOMBO Land  B2801 хром. Мыльница настенная', 'B2801', 0, 0, '', '', '', 'colombo-land-b2801-hrom-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'b13c0537-b4d5-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(466, 6, 1, 0, 'COLOMBO Land  B2802 хром/стекло матовое. Стакан настенный', 'B2802', 0, 0, '', '', '', 'colombo-land-b2802-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'b13c0539-b4d5-11e3-8836-0011951d1b08', 'Стакан настенный'),
(467, 6, 1, 0, 'COLOMBO Land  B9318 хром/стекло матовое. Дозатор жидкого мыла настенный', 'B9318', 0, 0, '', '', '', 'colombo-land-b9318-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'b13c053a-b4d5-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(468, 6, 1, 0, 'COLOMBO Bart (Land) B9985 115xh180x60 хром. Дозатор жидкого мыла настенный 0,4 л', 'B9985', 0, 0, '', '', '', 'colombo-bart-land-b9985-115xh180x60-hrom-dozator-zhidkogo-myla-nastennyj-0-4-l', '0000-00-00', '', '', '', NULL, NULL, 115, 180, 60, 'хром', '', '', '', '0,4 л', 8, 'b13c053b-b4d5-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(469, 6, 1, 0, 'COLOMBO Land  B2816 600xh30x140 хром/стекло матовое. Полка настенная', 'B2816', 0, 0, '', '', '', 'colombo-land-b2816-600xh30x140-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 600, 30, 140, 'хром', '', 'стекло', 'матовое', '', 8, 'b13c053d-b4d5-11e3-8836-0011951d1b08', 'Полка настенная'),
(470, 6, 1, 0, 'COLOMBO Land  B2815 750xh175x140 хром/стекло матовое. Полка + стакан + дозатор жидкого мыла настенная (снято с производства 01.01.14)', 'B2815', 0, 0, '', '', '', 'colombo-land-b2815-750xh175x140-hrom-steklo-matovoe-polka-stakan-dozator-zhidkogo-myla-nastennaya-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 750, 175, 140, 'хром', '', 'стекло', 'матовое', '', 8, 'b13c053e-b4d5-11e3-8836-0011951d1b08', 'Полка + стакан + дозатор жидкого мыла настенная'),
(471, 6, 1, 0, 'COLOMBO Land  B2874DX 375xh180x100 хром/стекло матовое, правый. Дозатор жидкого мыла + полотенцедержатель настенные', 'B2874DX', 0, 0, '', '', '', 'colombo-land-b2874dx-375xh180x100-hrom-steklo-matovoe-pravyj-dozator-zhidkogo-myla-polotencederzhatel-nastennye', '0000-00-00', '', '', '', NULL, NULL, 375, 180, 100, 'хром', 'правый', 'стекло', 'матовое', '', 8, 'b13c0540-b4d5-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла + полотенцедержатель настенные'),
(472, 6, 1, 0, 'COLOMBO Isole  B9404 400xh1780x320 хром. Вешалка напольная (полотенцедержатель + 3 крючка)', 'B9404', 0, 0, '', '', '', 'colombo-isole-b9404-400xh1780x320-hrom-veshalka-napolnaya-polotencederzhatel-3-kryuchka', '0000-00-00', '', '', '', NULL, NULL, 400, 1780, 320, 'хром', '', '', '', '(полотенцедержатель + 3 крючка)', 8, '0afa96a8-b4ef-11e3-8836-0011951d1b08', 'Вешалка напольная'),
(473, 6, 1, 0, 'COLOMBO Isole  B9422 315xh1020x165 хром/стекло матовое. Штанга с аксессуарами настенная (ершик + держатель туалетной бумаги + мыльница + полотенцедержатель)', 'B9422', 0, 0, '', '', '', 'colombo-isole-b9422-315xh1020x165-hrom-steklo-matovoe-shtanga-s-aksessuarami-nastennaya-ershik-derzhatel-tualetnoj-bumagi-mylnica-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 315, 1020, 165, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + мыльница + полотенцедержатель)', 8, '0afa96ab-b4ef-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(474, 6, 1, 0, 'COLOMBO Isole  B9423 145xh730x165 хром/стекло матовое. Штанга с аксессуарами настенная (ершик + держатель туалетной бумаги)', 'B9423', 0, 0, '', '', '', 'colombo-isole-b9423-145xh730x165-hrom-steklo-matovoe-shtanga-s-aksessuarami-nastennaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 145, 730, 165, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги)', 8, '0afa96ae-b4ef-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(475, 6, 1, 0, 'COLOMBO Isole  B9424 350xh370x165 хром/стекло матовое. Штанга с аксессуарами настенная (мыльница + 2 полотенцедержателя)', 'B9424', 0, 0, '', '', '', 'colombo-isole-b9424-350xh370x165-hrom-steklo-matovoe-shtanga-s-aksessuarami-nastennaya-mylnica-2-polotencederzhatelya', '0000-00-00', '', '', '', NULL, NULL, 350, 370, 165, 'хром', '', 'стекло', 'матовое', '(мыльница + 2 полотенцедержателя)', 8, '0afa96b0-b4ef-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(476, 6, 1, 0, 'COLOMBO Khala  B1801 хром. Мыльница настенная', 'B1801', 0, 0, '', '', '', 'colombo-khala-b1801-hrom-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '0afa96b2-b4ef-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(477, 6, 1, 0, 'COLOMBO Khala  B1802 хром/стекло матовое. Стакан настенный', 'B1802', 0, 0, '', '', '', 'colombo-khala-b1802-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '0afa96b3-b4ef-11e3-8836-0011951d1b08', 'Стакан настенный'),
(478, 6, 1, 0, 'COLOMBO Khala  B9303 хром/стекло матовое. Дозатор жидкого мыла настенный', 'B9303', 0, 0, '', '', '', 'colombo-khala-b9303-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '0afa96b4-b4ef-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(479, 6, 1, 0, 'COLOMBO Khala  B1803 275xh140x180 хром/стекло матовое. Мыльница с полочкой настенная', 'B1803', 0, 0, '', '', '', 'colombo-khala-b1803-275xh140x180-hrom-steklo-matovoe-mylnica-s-polochkoj-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 275, 140, 180, 'хром', '', 'стекло', 'матовое', '', 8, '0afa96b5-b4ef-11e3-8836-0011951d1b08', 'Мыльница с полочкой настенная'),
(480, 6, 1, 0, 'COLOMBO Khala  B1804 275xh140x180 хром/стекло матовое. Мыльница + стакан настенные', 'B1804', 0, 0, '', '', '', 'colombo-khala-b1804-275xh140x180-hrom-steklo-matovoe-mylnica-stakan-nastennye', '0000-00-00', '', '', '', NULL, NULL, 275, 140, 180, 'хром', '', 'стекло', 'матовое', '', 8, '0afa96b7-b4ef-11e3-8836-0011951d1b08', 'Мыльница + стакан настенные'),
(481, 6, 1, 0, 'COLOMBO Khala  B1816 680xh140x150 хром/стекло матовое. Полка настенная', 'B1816', 0, 0, '', '', '', 'colombo-khala-b1816-680xh140x150-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 680, 140, 150, 'хром', '', 'стекло', 'матовое', '', 8, '0afa96b9-b4ef-11e3-8836-0011951d1b08', 'Полка настенная'),
(482, 6, 1, 0, 'COLOMBO Khala  B1809 400xh50x75 хром. Полотенцедержатель настенный', 'B1809', 0, 0, '', '', '', 'colombo-khala-b1809-400xh50x75-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 400, 50, 75, 'хром', '', '', '', '', 8, '0afa96ba-b4ef-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(483, 6, 1, 0, 'COLOMBO Khala  B1810 500xh50x75 хром. Полотенцедержатель настенный', 'B1810', 0, 0, '', '', '', 'colombo-khala-b1810-500xh50x75-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 500, 50, 75, 'хром', '', '', '', '', 8, '0afa96bb-b4ef-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(484, 6, 1, 0, 'COLOMBO Khala  B1811 650xh50x75 хром. Полотенцедержатель настенный', 'B1811', 0, 0, '', '', '', 'colombo-khala-b1811-650xh50x75-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 650, 50, 75, 'хром', '', '', '', '', 8, '0afa96bc-b4ef-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(485, 6, 1, 0, 'COLOMBO Khala  B1812 800xh50x75 хром. Полотенцедержатель настенный', 'B1812', 0, 0, '', '', '', 'colombo-khala-b1812-800xh50x75-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 800, 50, 75, 'хром', '', '', '', '', 8, '0afa96bd-b4ef-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(486, 6, 1, 0, 'COLOMBO Khala  B1813 460xh50x70 хром. Полотенцедержатель настенный двойной, поворотный', 'B1813', 0, 0, '', '', '', 'colombo-khala-b1813-460xh50x70-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 460, 50, 70, 'хром', '', '', '', 'двойной, поворотный', 8, '0afa96be-b4ef-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(487, 6, 1, 0, 'COLOMBO Khala  B1831 220xh150x55 хром. Полотенцедержатель настенный кольцо', 'B1831', 0, 0, '', '', '', 'colombo-khala-b1831-220xh150x55-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 220, 150, 55, 'хром', '', '', '', 'кольцо', 8, '0afa96c1-b4ef-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(488, 6, 1, 0, 'COLOMBO Khala  B1808 хром. Держатель запасного рулона туалетной бумаги', 'B1808', 0, 0, '', '', '', 'colombo-khala-b1808-hrom-derzhatel-zapasnogo-rulona-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '0afa96c2-b4ef-11e3-8836-0011951d1b08', 'Держатель запасного рулона туалетной бумаги'),
(489, 6, 1, 0, 'COLOMBO Khala (Isole) B9405 120xh360x90 хром. Ершик туалетный напольный', 'B9405', 0, 0, '', '', '', 'colombo-khala-isole-b9405-120xh360x90-hrom-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 120, 360, 90, 'хром', '', '', '', '', 8, '0afa96c5-b4ef-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(490, 6, 1, 0, 'COLOMBO Khala  B1807 хром/стекло матовое. Ершик туалетный настенный', 'B1807', 0, 0, '', '', '', 'colombo-khala-b1807-hrom-steklo-matovoe-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '0afa96c6-b4ef-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(491, 6, 1, 0, 'COLOMBO Khala  B1823 200xh900x160 хром/стекло матовое. Штанга с аксессуарами настенная (ершик + держатель туалетной бумаги) (снято с производства 01.01.14)', 'B1823', 0, 0, '', '', '', 'colombo-khala-b1823-200xh900x160-hrom-steklo-matovoe-shtanga-s-aksessuarami-nastennaya-ershik-derzhatel-tualetnoj-bumagi-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 200, 900, 160, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги)', 8, '0afa96ca-b4ef-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(492, 6, 1, 0, 'COLOMBO Khala  B1824 450xh900x240 хром/стекло матовое. Штанга с аксессуарами настенная (зеркало косметическое + стакан + мыльница + полотенцедержатель) (снято с производства 01.01.14)', 'B1824', 0, 0, '', '', '', 'colombo-khala-b1824-450xh900x240-hrom-steklo-matovoe-shtanga-s-aksessuarami-nastennaya-zerkalo-kosmeticheskoe-stakan-mylnica-polotencederzhatel-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 450, 900, 240, 'хром', '', 'стекло', 'матовое', '(зеркало косметическое + стакан + мыльница + полотенцедержатель)', 8, '0afa96cb-b4ef-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(493, 6, 1, 0, 'COLOMBO Land  B2874SX 375xh180x100 хром/стекло матовое, левый. Дозатор жидкого мыла + полотенцедержатель настенные', 'B2874SX', 0, 0, '', '', '', 'colombo-land-b2874sx-375xh180x100-hrom-steklo-matovoe-levyj-dozator-zhidkogo-myla-polotencederzhatel-nastennye', '0000-00-00', '', '', '', NULL, NULL, 375, 180, 100, 'хром', 'левый', 'стекло', 'матовое', '', 8, '064f9d08-b56f-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла + полотенцедержатель настенные'),
(494, 6, 1, 0, 'COLOMBO Land  B2809 410 хром. Полотенцедержатель настенный', 'B2809', 0, 0, '', '', '', 'colombo-land-b2809-410-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 410, 0, 0, 'хром', '', '', '', '', 8, '064f9d09-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(495, 6, 1, 0, 'COLOMBO Land  B2810 510 хром. Полотенцедержатель настенный', 'B2810', 0, 0, '', '', '', 'colombo-land-b2810-510-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 510, 0, 0, 'хром', '', '', '', '', 8, '064f9d0a-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(496, 6, 1, 0, 'COLOMBO Land  B2811 610 хром. Полотенцедержатель настенный', 'B2811', 0, 0, '', '', '', 'colombo-land-b2811-610-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 610, 0, 0, 'хром', '', '', '', '', 8, '064f9d0b-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(497, 6, 1, 0, 'COLOMBO Land  B2871 625xh125x65 хром. Полотенцедержатель настенный', 'B2871', 0, 0, '', '', '', 'colombo-land-b2871-625xh125x65-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 625, 125, 65, 'хром', '', '', '', '', 8, '064f9d0c-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(498, 6, 1, 0, 'COLOMBO Land  B2872 825xh125x65 хром. Полотенцедержатель настенный', 'B2872', 0, 0, '', '', '', 'colombo-land-b2872-825xh125x65-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 825, 125, 65, 'хром', '', '', '', '', 8, '064f9d0d-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(499, 6, 1, 0, 'COLOMBO Land  B2888 475xh135x70 хром. Полотенцедержатель настенный двойной', 'B2888', 0, 0, '', '', '', 'colombo-land-b2888-475xh135x70-hrom-polotencederzhatel-nastennyj-dvojnoj', '0000-00-00', '', '', '', NULL, NULL, 475, 135, 70, 'хром', '', '', '', 'двойной', 8, '064f9d0e-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(500, 6, 1, 0, 'COLOMBO Land  B2813 345xh45x80 хром. Полотенцедержатель настенный двойной, поворотный', 'B2813', 0, 0, '', '', '', 'colombo-land-b2813-345xh45x80-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 345, 45, 80, 'хром', '', '', '', 'двойной, поворотный', 8, '064f9d0f-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(501, 6, 1, 0, 'COLOMBO Land  B2831 200xh140x70 хром. Полотенцедержатель настенный кольцо', 'B2831', 0, 0, '', '', '', 'colombo-land-b2831-200xh140x70-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 200, 140, 70, 'хром', '', '', '', 'кольцо', 8, '064f9d10-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(502, 6, 1, 0, 'COLOMBO Land  B2808 хром. Держатель туалетной бумаги настенный', 'B2808', 0, 0, '', '', '', 'colombo-land-b2808-hrom-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '064f9d11-b56f-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(503, 6, 1, 0, 'COLOMBO Land  B2891 хром. Держатель туалетной бумаги настенный с крышкой', 'B2891', 0, 0, '', '', '', 'colombo-land-b2891-hrom-derzhatel-tualetnoj-bumagi-nastennyj-s-kryshkoj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'с крышкой', 8, '064f9d12-b56f-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(504, 6, 1, 0, 'COLOMBO Land  B2806 хром/стекло матовое. Ершик туалетный напольный', 'B2806', 0, 0, '', '', '', 'colombo-land-b2806-hrom-steklo-matovoe-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '064f9d13-b56f-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(505, 6, 1, 0, 'COLOMBO Land  B2807 хром/стекло матовое. Ершик туалетный настенный', 'B2807', 0, 0, '', '', '', 'colombo-land-b2807-hrom-steklo-matovoe-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '064f9d14-b56f-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(506, 6, 1, 0, 'COLOMBO Land  B2887 475xh140x290 хром. Полотенцедержатель настенный большой', 'B2887', 0, 0, '', '', '', 'colombo-land-b2887-475xh140x290-hrom-polotencederzhatel-nastennyj-bolshoj', '0000-00-00', '', '', '', NULL, NULL, 475, 140, 290, 'хром', '', '', '', 'большой', 8, '064f9d15-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(507, 6, 1, 0, 'COLOMBO Land  B2889 475xh510x90 хром. Полотенцедержатель настенный большой', 'B2889', 0, 0, '', '', '', 'colombo-land-b2889-475xh510x90-hrom-polotencederzhatel-nastennyj-bolshoj', '0000-00-00', '', '', '', NULL, NULL, 475, 510, 90, 'хром', '', '', '', 'большой', 8, '064f9d16-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(508, 6, 1, 0, 'COLOMBO Land  B2838 470xh950x20 хром. Полотенцедержатель напольный (снято с производства 01.01.14)', 'B2838', 0, 0, '', '', '', 'colombo-land-b2838-470xh950x20-hrom-polotencederzhatel-napolnyj-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 470, 950, 20, 'хром', '', '', '', '', 8, '064f9d17-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель напольный'),
(509, 6, 1, 0, 'COLOMBO Land (Appenditutto) CD67 хром. Крючок настенный', 'CD67', 0, 0, '', '', '', 'colombo-land-appenditutto-cd67-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '064f9d23-b56f-11e3-8836-0011951d1b08', 'Крючок настенный'),
(510, 6, 1, 0, 'COLOMBO Land (Appenditutto) CD77 хром. Крючок настенный', 'CD77', 0, 0, '', '', '', 'colombo-land-appenditutto-cd77-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '064f9d24-b56f-11e3-8836-0011951d1b08', 'Крючок настенный'),
(511, 6, 1, 0, 'COLOMBO Land (Oggettistica) B2840 хром. Мыльница настольная', 'B2840', 0, 0, '', '', '', 'colombo-land-oggettistica-b2840-hrom-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '064f9d25-b56f-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(512, 6, 1, 0, 'COLOMBO Look  B1601 хром/стекло матовое. Мыльница настенная', 'B1601', 0, 0, '', '', '', 'colombo-look-b1601-hrom-steklo-matovoe-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '064f9d26-b56f-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(513, 6, 1, 0, 'COLOMBO Look  B1602 хром/стекло матовое. Стакан настенный', 'B1602', 0, 0, '', '', '', 'colombo-look-b1602-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '064f9d2a-b56f-11e3-8836-0011951d1b08', 'Стакан настенный'),
(514, 6, 1, 0, 'COLOMBO Look  B9316 хром/стекло матовое. Дозатор жидкого мыла настенный', 'B9316', 0, 0, '', '', '', 'colombo-look-b9316-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '064f9d2c-b56f-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(515, 6, 1, 0, 'COLOMBO Look  B1674 320xh190x95 хром/стекло матовое. Дозатор жидкого мыла + полотенцедержатель настенные', 'B1674', 0, 0, '', '', '', 'colombo-look-b1674-320xh190x95-hrom-steklo-matovoe-dozator-zhidkogo-myla-polotencederzhatel-nastennye', '0000-00-00', '', '', '', NULL, NULL, 320, 190, 95, 'хром', '', 'стекло', 'матовое', '', 8, '064f9d2d-b56f-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла + полотенцедержатель настенные'),
(516, 6, 1, 0, 'COLOMBO Look  B1616 600xh30x130 хром/стекло матовое. Полка настенная', 'B1616', 0, 0, '', '', '', 'colombo-look-b1616-600xh30x130-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 600, 30, 130, 'хром', '', 'стекло', 'матовое', '', 8, '064f9d30-b56f-11e3-8836-0011951d1b08', 'Полка настенная'),
(517, 6, 1, 0, 'COLOMBO Look  B1609 420 хром/стекло матовое. Полотенцедержатель настенный', 'B1609', 0, 0, '', '', '', 'colombo-look-b1609-420-hrom-steklo-matovoe-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 420, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '064f9d34-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(518, 6, 1, 0, 'COLOMBO Look  B1610 570 хром/стекло матовое. Полотенцедержатель настенный', 'B1610', 0, 0, '', '', '', 'colombo-look-b1610-570-hrom-steklo-matovoe-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 570, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '064f9d36-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(519, 6, 1, 0, 'COLOMBO Look  B1611 720 хром. Полотенцедержатель настенный', 'B1611', 0, 0, '', '', '', 'colombo-look-b1611-720-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 720, 0, 0, 'хром', '', '', '', '', 8, '064f9d38-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(520, 6, 1, 0, 'COLOMBO Look  B1612 335 хром. Полотенцедержатель настенный двойной, поворотный', 'B1612', 0, 0, '', '', '', 'colombo-look-b1612-335-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 335, 0, 0, 'хром', '', '', '', 'двойной, поворотный', 8, '064f9d3a-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(521, 6, 1, 0, 'COLOMBO Look  B1631 200xh140x65 хром. Полотенцедержатель настенный кольцо', 'B1631', 0, 0, '', '', '', 'colombo-look-b1631-200xh140x65-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 200, 140, 65, 'хром', '', '', '', 'кольцо', 8, '064f9d3c-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(522, 6, 1, 0, 'COLOMBO Look  B1687 500xh35x265 хром. Полотенцедержатель настенный большой', 'B1687', 0, 0, '', '', '', 'colombo-look-b1687-500xh35x265-hrom-polotencederzhatel-nastennyj-bolshoj', '0000-00-00', '', '', '', NULL, NULL, 500, 35, 265, 'хром', '', '', '', 'большой', 8, '064f9d3e-b56f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(523, 6, 1, 0, 'COLOMBO Look  B1608 хром. Держатель туалетной бумаги настенный', 'B1608', 0, 0, '', '', '', 'colombo-look-b1608-hrom-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '064f9d3f-b56f-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(524, 6, 1, 0, 'COLOMBO Look  B1691 хром. Держатель туалетной бумаги настенный с крышкой', 'B1691', 0, 0, '', '', '', 'colombo-look-b1691-hrom-derzhatel-tualetnoj-bumagi-nastennyj-s-kryshkoj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'с крышкой', 8, '064f9d41-b56f-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(525, 6, 1, 0, 'COLOMBO Look  B1606 хром. Ершик туалетный напольный', 'B1606', 0, 0, '', '', '', 'colombo-look-b1606-hrom-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '064f9d42-b56f-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(526, 6, 1, 0, 'COLOMBO Look  B1607 хром/стекло матовое. Ершик туалетный настенный', 'B1607', 0, 0, '', '', '', 'colombo-look-b1607-hrom-steklo-matovoe-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '064f9d44-b56f-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(527, 6, 1, 0, 'COLOMBO Look  B1626 хром/пластик. Ершик туалетный напольный', 'B1626', 0, 0, '', '', '', 'colombo-look-b1626-hrom-plastik-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'пластик', '', '', 8, '064f9d46-b56f-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(528, 6, 1, 0, 'COLOMBO Look  B1627 хром/пластик. Ершик туалетный настенный', 'B1627', 0, 0, '', '', '', 'colombo-look-b1627-hrom-plastik-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'пластик', '', '', 8, '064f9d47-b56f-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(529, 6, 1, 0, 'COLOMBO Land (Oggettistica) B2841 хром/стекло матовое. Стакан настольный', 'B2841', 0, 0, '', '', '', 'colombo-land-oggettistica-b2841-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f612-b585-11e3-8836-0011951d1b08', 'Стакан настольный'),
(530, 6, 1, 0, 'COLOMBO Land (Oggettistica) B9319 хром/стекло матовое. Дозатор жидкого мыла настольный', 'B9319', 0, 0, '', '', '', 'colombo-land-oggettistica-b9319-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f613-b585-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(531, 6, 1, 0, 'COLOMBO Land (Oggettistica) B2842 хром/стекло матовое. Мыльница настольная', 'B2842', 0, 0, '', '', '', 'colombo-land-oggettistica-b2842-hrom-steklo-matovoe-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f614-b585-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(532, 6, 1, 0, 'COLOMBO Land (Oggettistica) B2843 250xh45x110 хром/стекло матовое. Полка настольная', 'B2843', 0, 0, '', '', '', 'colombo-land-oggettistica-b2843-250xh45x110-hrom-steklo-matovoe-polka-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 250, 45, 110, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f615-b585-11e3-8836-0011951d1b08', 'Полка настольная'),
(533, 6, 1, 0, 'COLOMBO Link  B2401DX хром/стекло матовое, правый. Мыльница настенная', 'B2401DX', 0, 0, '', '', '', 'colombo-link-b2401dx-hrom-steklo-matovoe-pravyj-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', 'правый', 'стекло', 'матовое', '', 8, 'd222f619-b585-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(534, 6, 1, 0, 'COLOMBO Link  B2402SX хром/стекло матовое, левый. Стакан настенный', 'B2402SX', 0, 0, '', '', '', 'colombo-link-b2402sx-hrom-steklo-matovoe-levyj-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', 'левый', 'стекло', 'матовое', '', 8, 'd222f61c-b585-11e3-8836-0011951d1b08', 'Стакан настенный'),
(535, 6, 1, 0, 'COLOMBO Link  B9310DX хром/стекло матовое, правый. Дозатор жидкого мыла настенный', 'B9310DX', 0, 0, '', '', '', 'colombo-link-b9310dx-hrom-steklo-matovoe-pravyj-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', 'правый', 'стекло', 'матовое', '', 8, 'd222f61d-b585-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(536, 6, 1, 0, 'COLOMBO Link  B2404 300xh135x140 хром/стекло матовое. Стакан + мыльница настенные', 'B2404', 0, 0, '', '', '', 'colombo-link-b2404-300xh135x140-hrom-steklo-matovoe-stakan-mylnica-nastennye', '0000-00-00', '', '', '', NULL, NULL, 300, 135, 140, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f61f-b585-11e3-8836-0011951d1b08', 'Стакан + мыльница настенные'),
(537, 6, 1, 0, 'COLOMBO Link  B2416 645xh55x165 хром/стекло матовое. Полка настенная', 'B2416', 0, 0, '', '', '', 'colombo-link-b2416-645xh55x165-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 645, 55, 165, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f621-b585-11e3-8836-0011951d1b08', 'Полка настенная'),
(538, 6, 1, 0, 'COLOMBO Link  B2409 380 хром. Полотенцедержатель настенный', 'B2409', 0, 0, '', '', '', 'colombo-link-b2409-380-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 380, 0, 0, 'хром', '', '', '', '', 8, 'd222f622-b585-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(539, 6, 1, 0, 'COLOMBO Link  B2410 480 хром. Полотенцедержатель настенный', 'B2410', 0, 0, '', '', '', 'colombo-link-b2410-480-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 480, 0, 0, 'хром', '', '', '', '', 8, 'd222f623-b585-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(540, 6, 1, 0, 'COLOMBO Link  B2411 580 хром. Полотенцедержатель настенный', 'B2411', 0, 0, '', '', '', 'colombo-link-b2411-580-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 580, 0, 0, 'хром', '', '', '', '', 8, 'd222f624-b585-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(541, 6, 1, 0, 'COLOMBO Link  B2412 310 хром. Полотенцедержатель настенный', 'B2412', 0, 0, '', '', '', 'colombo-link-b2412-310-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 310, 0, 0, 'хром', '', '', '', '', 8, 'd222f625-b585-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(542, 6, 1, 0, 'COLOMBO Link  B2413 360xh70x25 хром. Полотенцедержатель настенный двойной, поворотный', 'B2413', 0, 0, '', '', '', 'colombo-link-b2413-360xh70x25-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 360, 70, 25, 'хром', '', '', '', 'двойной, поворотный', 8, 'd222f626-b585-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(543, 6, 1, 0, 'COLOMBO Link  B2431 240xh150x65 хром. Полотенцедержатель настенный кольцо', 'B2431', 0, 0, '', '', '', 'colombo-link-b2431-240xh150x65-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 240, 150, 65, 'хром', '', '', '', 'кольцо', 8, 'd222f627-b585-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(544, 6, 1, 0, 'COLOMBO Link  B2473 565xh185x80 хром. Полотенцедержатель настенный', 'B2473', 0, 0, '', '', '', 'colombo-link-b2473-565xh185x80-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 565, 185, 80, 'хром', '', '', '', '', 8, 'd222f628-b585-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(545, 6, 1, 0, 'COLOMBO Link  B2474 665xh185x80 хром. Полотенцедержатель настенный', 'B2474', 0, 0, '', '', '', 'colombo-link-b2474-665xh185x80-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 665, 185, 80, 'хром', '', '', '', '', 8, 'd222f629-b585-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(546, 6, 1, 0, 'COLOMBO Link  B2475 565xh185x80 хром/хром матовый. Полка-сетка настенная', 'B2475', 0, 0, '', '', '', 'colombo-link-b2475-565xh185x80-hrom-hrom-matovyj-polka-setka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 565, 185, 80, 'хром/хром матовый', '', '', '', '', 8, 'd222f62a-b585-11e3-8836-0011951d1b08', 'Полка-сетка настенная'),
(547, 6, 1, 0, 'COLOMBO Link  B2476 665xh185x80 хром/хром матовый. Полка-сетка настенная (снято с производства 01.01.14)', 'B2476', 0, 0, '', '', '', 'colombo-link-b2476-665xh185x80-hrom-hrom-matovyj-polka-setka-nastennaya-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 665, 185, 80, 'хром/хром матовый', '', '', '', '', 8, 'd222f62c-b585-11e3-8836-0011951d1b08', 'Полка-сетка настенная'),
(548, 6, 1, 0, 'COLOMBO Link  B2408 хром. Держатель туалетной бумаги настенный', 'B2408', 0, 0, '', '', '', 'colombo-link-b2408-hrom-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'd222f62d-b585-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(549, 6, 1, 0, 'COLOMBO Link  B2491 хром. Держатель туалетной бумаги настенный с крышкой', 'B2491', 0, 0, '', '', '', 'colombo-link-b2491-hrom-derzhatel-tualetnoj-bumagi-nastennyj-s-kryshkoj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'с крышкой', 8, 'd222f62e-b585-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(550, 6, 1, 0, 'COLOMBO Link  B2406 хром/стекло матовое. Ершик туалетный напольный', 'B2406', 0, 0, '', '', '', 'colombo-link-b2406-hrom-steklo-matovoe-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f62f-b585-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(551, 6, 1, 0, 'COLOMBO Link  B2407DX хром/стекло матовое, правый. Ершик туалетный настенный', 'B2407DX', 0, 0, '', '', '', 'colombo-link-b2407dx-hrom-steklo-matovoe-pravyj-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', 'правый', 'стекло', 'матовое', '', 8, 'd222f630-b585-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(552, 6, 1, 0, 'COLOMBO Link (Appenditutto) AR27 хром. Крючок настенный', 'AR27', 0, 0, '', '', '', 'colombo-link-appenditutto-ar27-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'd222f632-b585-11e3-8836-0011951d1b08', 'Крючок настенный'),
(553, 6, 1, 0, 'COLOMBO Link (Oggettistica) B2440 хром. Мыльница настольная', 'B2440', 0, 0, '', '', '', 'colombo-link-oggettistica-b2440-hrom-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'd222f633-b585-11e3-8836-0011951d1b08', 'Мыльница настольная');
INSERT INTO `products` (`id`, `manufacturer_id`, `is_active`, `sort`, `name`, `sku`, `price`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `description`, `is_new`, `is_special`, `width`, `height`, `depth`, `color`, `turn`, `material`, `finishing`, `shortdesc`, `parent_id`, `1c_id`, `shortname`) VALUES
(554, 6, 1, 0, 'COLOMBO Link (Oggettistica) B2441 хром/стекло матовое. Стакан настольный', 'B2441', 0, 0, '', '', '', 'colombo-link-oggettistica-b2441-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f634-b585-11e3-8836-0011951d1b08', 'Стакан настольный'),
(555, 6, 1, 0, 'COLOMBO Link (Oggettistica) B9311 хром/стекло матовое. Дозатор жидкого мыла настольный', 'B9311', 0, 0, '', '', '', 'colombo-link-oggettistica-b9311-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f635-b585-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(556, 6, 1, 0, 'COLOMBO Lulu  B6291 хром/стекло матовое. Полотенцедержатель двойной, поворотный', 'B6291', 0, 0, '', '', '', 'colombo-lulu-b6291-hrom-steklo-matovoe-polotencederzhatel-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', 'двойной, поворотный', 8, 'd222f644-b585-11e3-8836-0011951d1b08', 'Полотенцедержатель'),
(557, 6, 1, 0, 'COLOMBO Lulu  B6232 300xh90x105 хром/стекло матовое. Полка-сетка настенная', 'B6232', 0, 0, '', '', '', 'colombo-lulu-b6232-300xh90x105-hrom-steklo-matovoe-polka-setka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 300, 90, 105, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f646-b585-11e3-8836-0011951d1b08', 'Полка-сетка настенная'),
(558, 6, 1, 0, 'COLOMBO Lulu  B6233 470xh90x105 хром/стекло матовое. Полка-сетка настенная', 'B6233', 0, 0, '', '', '', 'colombo-lulu-b6233-470xh90x105-hrom-steklo-matovoe-polka-setka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 470, 90, 105, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f648-b585-11e3-8836-0011951d1b08', 'Полка-сетка настенная'),
(559, 6, 1, 0, 'COLOMBO Lulu  B6206 хром/стекло матовое. Ершик туалетный напольный', 'B6206', 0, 0, '', '', '', 'colombo-lulu-b6206-hrom-steklo-matovoe-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f64a-b585-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(560, 6, 1, 0, 'COLOMBO Lulu  B6207 хром/стекло матовое. Ершик туалетный настенный', 'B6207', 0, 0, '', '', '', 'colombo-lulu-b6207-hrom-steklo-matovoe-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f64c-b585-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(561, 6, 1, 0, 'COLOMBO Lulu  B6226 хром/пластик. Ершик туалетный напольный', 'B6226', 0, 0, '', '', '', 'colombo-lulu-b6226-hrom-plastik-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'пластик', '', '', 8, 'd222f64e-b585-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(562, 6, 1, 0, 'COLOMBO Lulu  B6227 хром/пластик. Ершик туалетный напольный', 'B6227', 0, 0, '', '', '', 'colombo-lulu-b6227-hrom-plastik-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'пластик', '', '', 8, 'd222f64f-b585-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(563, 6, 1, 0, 'COLOMBO Lulu (Appenditutto) LC47 хром/стекло матовое. Крючок настенный', 'LC47', 0, 0, '', '', '', 'colombo-lulu-appenditutto-lc47-hrom-steklo-matovoe-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'd222f650-b585-11e3-8836-0011951d1b08', 'Крючок настенный'),
(564, 6, 1, 0, 'COLOMBO Look  B9316 CM хром матовый/стекло матовое. Дозатор жидкого мыла настенный (снято с производства 01.01.14)', 'B9316 CM', 0, 0, '', '', '', 'colombo-look-b9316-cm-hrom-matovyj-steklo-matovoe-dozator-zhidkogo-myla-nastennyj-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром матовый', '', 'стекло', 'матовое', '', 8, 'de1b4010-b5b6-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(565, 6, 1, 0, 'COLOMBO Look (Appenditutto) LC27 хром. Крючок настенный', 'LC27', 0, 0, '', '', '', 'colombo-look-appenditutto-lc27-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'de1b4011-b5b6-11e3-8836-0011951d1b08', 'Крючок настенный'),
(566, 6, 1, 0, 'COLOMBO Look (Appenditutto) LC37 хром. Крючок настенный', 'LC37', 0, 0, '', '', '', 'colombo-look-appenditutto-lc37-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'de1b4013-b5b6-11e3-8836-0011951d1b08', 'Крючок настенный'),
(567, 6, 1, 0, 'COLOMBO Look (Oggettistica) B1640 хром/стекло матовое. Мыльница настольная', 'B1640', 0, 0, '', '', '', 'colombo-look-oggettistica-b1640-hrom-steklo-matovoe-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4015-b5b6-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(568, 6, 1, 0, 'COLOMBO Look (Oggettistica) B1641 хром/стекло матовое. Стакан настольный', 'B1641', 0, 0, '', '', '', 'colombo-look-oggettistica-b1641-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4017-b5b6-11e3-8836-0011951d1b08', 'Стакан настольный'),
(569, 6, 1, 0, 'COLOMBO Look (Oggettistica) B9317 хром/стекло матовое. Дозатор жидкого мыла настольный', 'B9317', 0, 0, '', '', '', 'colombo-look-oggettistica-b9317-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b401a-b5b6-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(570, 6, 1, 0, 'COLOMBO Look (Oggettistica) B1642 хром. Мыльница настольная', 'B1642', 0, 0, '', '', '', 'colombo-look-oggettistica-b1642-hrom-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'de1b401c-b5b6-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(571, 6, 1, 0, 'COLOMBO Look (Oggettistica) B1643 хром. Стакан настольный', 'B1643', 0, 0, '', '', '', 'colombo-look-oggettistica-b1643-hrom-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'de1b401d-b5b6-11e3-8836-0011951d1b08', 'Стакан настольный'),
(572, 6, 1, 0, 'COLOMBO Look (Oggettistica) B9320 хром. Дозатор жидкого мыла настольный', 'B9320', 0, 0, '', '', '', 'colombo-look-oggettistica-b9320-hrom-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'de1b401e-b5b6-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(573, 6, 1, 0, 'COLOMBO Lulu  B6201 хром/стекло матовое. Мыльница настенная', 'B6201', 0, 0, '', '', '', 'colombo-lulu-b6201-hrom-steklo-matovoe-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4024-b5b6-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(574, 6, 1, 0, 'COLOMBO Lulu  B6202 хром/стекло матовое. Стакан настенный', 'B6202', 0, 0, '', '', '', 'colombo-lulu-b6202-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4027-b5b6-11e3-8836-0011951d1b08', 'Стакан настенный'),
(575, 6, 1, 0, 'COLOMBO Lulu  B9321 хром/стекло матовое. Дозатор жидкого мыла настенный', 'B9321', 0, 0, '', '', '', 'colombo-lulu-b9321-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4029-b5b6-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(576, 6, 1, 0, 'COLOMBO Lulu  B6203 350xh30x125 хром/стекло матовое. Полка настенная', 'B6203', 0, 0, '', '', '', 'colombo-lulu-b6203-350xh30x125-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 350, 30, 125, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b402b-b5b6-11e3-8836-0011951d1b08', 'Полка настенная'),
(577, 6, 1, 0, 'COLOMBO Lulu  B6216 600xh30x130 хром/стекло матовое. Полка настенная', 'B6216', 0, 0, '', '', '', 'colombo-lulu-b6216-600xh30x130-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 600, 30, 130, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b402d-b5b6-11e3-8836-0011951d1b08', 'Полка настенная'),
(578, 6, 1, 0, 'COLOMBO Lulu  B6274 325xh170x110 хром/стекло матовое. Дозатор жидкого мыла + полотенцедержатель настенные', 'B6274', 0, 0, '', '', '', 'colombo-lulu-b6274-325xh170x110-hrom-steklo-matovoe-dozator-zhidkogo-myla-polotencederzhatel-nastennye', '0000-00-00', '', '', '', NULL, NULL, 325, 170, 110, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4031-b5b6-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла + полотенцедержатель настенные'),
(579, 6, 1, 0, 'COLOMBO Lulu  B6209 380 хром/стекло матовое. Держатель полки настенный', 'B6209', 0, 0, '', '', '', 'colombo-lulu-b6209-380-hrom-steklo-matovoe-derzhatel-polki-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 380, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4033-b5b6-11e3-8836-0011951d1b08', 'Держатель полки настенный'),
(580, 6, 1, 0, 'COLOMBO Lulu  B6210 530 хром/стекло матовое. Полотенцедержатель настенный', 'B6210', 0, 0, '', '', '', 'colombo-lulu-b6210-530-hrom-steklo-matovoe-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 530, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4035-b5b6-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(581, 6, 1, 0, 'COLOMBO Lulu  B6211 68 хром/стекло матовое. Полотенцедержатель настенный', 'B6211', 0, 0, '', '', '', 'colombo-lulu-b6211-68-hrom-steklo-matovoe-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 68, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4037-b5b6-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(582, 6, 1, 0, 'COLOMBO Lulu  B6212 350 хром/стекло матовое. Полотенцедержатель настенный двойной, поворотный', 'B6212', 0, 0, '', '', '', 'colombo-lulu-b6212-350-hrom-steklo-matovoe-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 350, 0, 0, 'хром', '', 'стекло', 'матовое', 'двойной, поворотный', 8, 'de1b4039-b5b6-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(583, 6, 1, 0, 'COLOMBO Lulu  B6231 220xh110x65 хром/стекло матовое. Полотенцедержатель настенный кольцо', 'B6231', 0, 0, '', '', '', 'colombo-lulu-b6231-220xh110x65-hrom-steklo-matovoe-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 220, 110, 65, 'хром', '', 'стекло', 'матовое', 'кольцо', 8, 'de1b403b-b5b6-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(584, 6, 1, 0, 'COLOMBO Lulu  B6208 хром/стекло матовое. Держатель туалетной бумаги настенный', 'B6208', 0, 0, '', '', '', 'colombo-lulu-b6208-hrom-steklo-matovoe-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b403d-b5b6-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(585, 6, 1, 0, 'COLOMBO Luna  B0131 330 хром. Полотенцедержатель настенный', 'B0131', 0, 0, '', '', '', 'colombo-luna-b0131-330-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 330, 0, 0, 'хром', '', '', '', '', 8, 'de1b403e-b5b6-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(586, 6, 1, 0, 'COLOMBO Luna  B0109 480 хром. Полотенцедержатель настенный', 'B0109', 0, 0, '', '', '', 'colombo-luna-b0109-480-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 480, 0, 0, 'хром', '', '', '', '', 8, 'de1b403f-b5b6-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(587, 6, 1, 0, 'COLOMBO Luna  B0110 630 хром. Полотенцедержатель настенный', 'B0110', 0, 0, '', '', '', 'colombo-luna-b0110-630-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 630, 0, 0, 'хром', '', '', '', '', 8, 'de1b4040-b5b6-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(588, 6, 1, 0, 'COLOMBO Luna  B0112 400 хром. Полотенцедержатель настенный двойной, поворотный', 'B0112', 0, 0, '', '', '', 'colombo-luna-b0112-400-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 400, 0, 0, 'хром', '', '', '', 'двойной, поворотный', 8, 'de1b4041-b5b6-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(589, 6, 1, 0, 'COLOMBO Luna  B0113 250 хром. Полотенцедержатель настенный двойной, поворотный', 'B0113', 0, 0, '', '', '', 'colombo-luna-b0113-250-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 250, 0, 0, 'хром', '', '', '', 'двойной, поворотный', 8, 'de1b4042-b5b6-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(590, 6, 1, 0, 'COLOMBO Luna  B0111 220xh225x55 хром. Полотенцедержатель настенный кольцо', 'B0111', 0, 0, '', '', '', 'colombo-luna-b0111-220xh225x55-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 220, 225, 55, 'хром', '', '', '', 'кольцо', 8, 'de1b4043-b5b6-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(591, 6, 1, 0, 'COLOMBO Luna  B0108 хром. Держатель туалетной бумаги настенный', 'B0108', 0, 0, '', '', '', 'colombo-luna-b0108-hrom-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'de1b4044-b5b6-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(592, 6, 1, 0, 'COLOMBO Luna  B0125 265xh200x245 хром. Зеркало косметическое настенное 3х', 'B0125', 0, 0, '', '', '', 'colombo-luna-b0125-265xh200x245-hrom-zerkalo-kosmeticheskoe-nastennoe-3h', '0000-00-00', '', '', '', NULL, NULL, 265, 200, 245, 'хром', '', '', '', '3х', 12, 'de1b4045-b5b6-11e3-8836-0011951d1b08', 'Зеркало косметическое настенное'),
(593, 6, 1, 0, 'COLOMBO Luna  B0106 хром/стекло матовое. Ершик туалетный напольный', 'B0106', 0, 0, '', '', '', 'colombo-luna-b0106-hrom-steklo-matovoe-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4047-b5b6-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(594, 6, 1, 0, 'COLOMBO Luna  B0506 хром. Ершик туалетный напольный', 'B0506', 0, 0, '', '', '', 'colombo-luna-b0506-hrom-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'de1b4048-b5b6-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(595, 6, 1, 0, 'COLOMBO Luna  B0107 хром/стекло матовое. Ершик туалетный настенный', 'B0107', 0, 0, '', '', '', 'colombo-luna-b0107-hrom-steklo-matovoe-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b4049-b5b6-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(596, 6, 1, 0, 'COLOMBO Luna  B0507 хром. Ершик туалетный настенный (снято с производства 01.01.14)', 'B0507', 0, 0, '', '', '', 'colombo-luna-b0507-hrom-ershik-tualetnyj-nastennyj-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'de1b404a-b5b6-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(597, 6, 1, 0, 'COLOMBO Luna (Appenditutto) CB17 хром. Крючок настенный', 'CB17', 0, 0, '', '', '', 'colombo-luna-appenditutto-cb17-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'de1b404b-b5b6-11e3-8836-0011951d1b08', 'Крючок настенный'),
(598, 6, 1, 0, 'COLOMBO Luna (Appenditutto) CB37 хром. Крючок настенный', 'CB37', 0, 0, '', '', '', 'colombo-luna-appenditutto-cb37-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'de1b404c-b5b6-11e3-8836-0011951d1b08', 'Крючок настенный'),
(599, 6, 1, 0, 'COLOMBO Luna (Oggettistica) B0140 хром/стекло матовое. Мыльница настольная', 'B0140', 0, 0, '', '', '', 'colombo-luna-oggettistica-b0140-hrom-steklo-matovoe-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b404d-b5b6-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(600, 6, 1, 0, 'COLOMBO Luna (Oggettistica) B0141 хром/стекло матовое. Стакан настольный', 'B0141', 0, 0, '', '', '', 'colombo-luna-oggettistica-b0141-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'de1b404e-b5b6-11e3-8836-0011951d1b08', 'Стакан настольный'),
(601, 6, 1, 0, 'COLOMBO Lulu (Appenditutto) LC57 хром/стекло матовое. Крючок настенный', 'LC57', 0, 0, '', '', '', 'colombo-lulu-appenditutto-lc57-hrom-steklo-matovoe-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '06016f5a-b5c6-11e3-8836-0011951d1b08', 'Крючок настенный'),
(602, 6, 1, 0, 'COLOMBO Lulu (Oggettistica) B6240 хром/стекло матовое. Мыльница настольная', 'B6240', 0, 0, '', '', '', 'colombo-lulu-oggettistica-b6240-hrom-steklo-matovoe-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '06016f5c-b5c6-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(603, 6, 1, 0, 'COLOMBO Lulu (Oggettistica) B6241 хром/стекло матовое. Стакан настольный', 'B6241', 0, 0, '', '', '', 'colombo-lulu-oggettistica-b6241-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '06016f5e-b5c6-11e3-8836-0011951d1b08', 'Стакан настольный'),
(604, 6, 1, 0, 'COLOMBO Lulu (Oggettistica) B9322 хром/стекло матовое. Дозатор жидкого мыла настольный', 'B9322', 0, 0, '', '', '', 'colombo-lulu-oggettistica-b9322-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '06016f60-b5c6-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(605, 6, 1, 0, 'COLOMBO Lulu (Oggettistica) B6242 345xh40x125 хром/стекло матовое. Полка настольная', 'B6242', 0, 0, '', '', '', 'colombo-lulu-oggettistica-b6242-345xh40x125-hrom-steklo-matovoe-polka-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 345, 40, 125, 'хром', '', 'стекло', 'матовое', '', 8, '06016f62-b5c6-11e3-8836-0011951d1b08', 'Полка настольная'),
(606, 6, 1, 0, 'COLOMBO Luna  B0101 хром/стекло матовое. Мыльница настенная', 'B0101', 0, 0, '', '', '', 'colombo-luna-b0101-hrom-steklo-matovoe-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '06016f71-b5c6-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(607, 6, 1, 0, 'COLOMBO Luna  B0102 хром/стекло матовое. Стакан настенный', 'B0102', 0, 0, '', '', '', 'colombo-luna-b0102-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '06016f72-b5c6-11e3-8836-0011951d1b08', 'Стакан настенный'),
(608, 6, 1, 0, 'COLOMBO Luna  B0115 410xh70x175 хром/стекло прозрачное. Полка настенная', 'B0115', 0, 0, '', '', '', 'colombo-luna-b0115-410xh70x175-hrom-steklo-prozrachnoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 410, 70, 175, 'хром', '', 'стекло', 'прозрачное', '', 8, '06016f73-b5c6-11e3-8836-0011951d1b08', 'Полка настенная'),
(609, 6, 1, 0, 'COLOMBO Luna  B0116 820xh70x215 хром/стекло прозрачное. Полка настенная', 'B0116', 0, 0, '', '', '', 'colombo-luna-b0116-820xh70x215-hrom-steklo-prozrachnoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 820, 70, 215, 'хром', '', 'стекло', 'прозрачное', '', 8, '06016f74-b5c6-11e3-8836-0011951d1b08', 'Полка настенная'),
(610, 6, 1, 0, 'COLOMBO Luna  B0130 720xh70x175 хром/стекло. Полка настенная', 'B0130', 0, 0, '', '', '', 'colombo-luna-b0130-720xh70x175-hrom-steklo-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 720, 70, 175, 'хром', '', 'стекло', '', '', 8, '06016f75-b5c6-11e3-8836-0011951d1b08', 'Полка настенная'),
(611, 6, 1, 0, 'COLOMBO Melo  B1201 хром/стекло матовое. Мыльница настенная', 'B1201', 0, 0, '', '', '', 'colombo-melo-b1201-hrom-steklo-matovoe-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'c933ce8f-b5d0-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(612, 6, 1, 0, 'COLOMBO Melo  B1202 хром/стекло матовое. Стакан настенный', 'B1202', 0, 0, '', '', '', 'colombo-melo-b1202-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'c933ce90-b5d0-11e3-8836-0011951d1b08', 'Стакан настенный'),
(613, 6, 1, 0, 'COLOMBO Melo  B9306 хром/стекло матовое. Дозатор жидкого мыла настенный', 'B9306', 0, 0, '', '', '', 'colombo-melo-b9306-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'c933ce91-b5d0-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(614, 6, 1, 0, 'COLOMBO Melo  B1216 700xh55x140 хром/стекло матовое. Полка настенная', 'B1216', 0, 0, '', '', '', 'colombo-melo-b1216-700xh55x140-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 700, 55, 140, 'хром', '', 'стекло', 'матовое', '', 8, 'c933ce92-b5d0-11e3-8836-0011951d1b08', 'Полка настенная'),
(615, 6, 1, 0, 'COLOMBO Melo  B1210 600 хром. Полотенцедержатель настенный', 'B1210', 0, 0, '', '', '', 'colombo-melo-b1210-600-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 600, 0, 0, 'хром', '', '', '', '', 8, 'c933ce96-b5d0-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(616, 6, 1, 0, 'COLOMBO Melo  B1211 310 хром. Полотенцедержатель настенный', 'B1211', 0, 0, '', '', '', 'colombo-melo-b1211-310-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 310, 0, 0, 'хром', '', '', '', '', 8, 'c933ce98-b5d0-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(617, 6, 1, 0, 'COLOMBO Melo  B1212 400 хром. Полотенцедержатель настенный двойной, поворотный', 'B1212', 0, 0, '', '', '', 'colombo-melo-b1212-400-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 400, 0, 0, 'хром', '', '', '', 'двойной, поворотный', 8, 'c933ce9f-b5d0-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(618, 6, 1, 0, 'COLOMBO Melo  B1231 230xh140x75 хром. Полотенцедержатель настенный кольцо', 'B1231', 0, 0, '', '', '', 'colombo-melo-b1231-230xh140x75-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 230, 140, 75, 'хром', '', '', '', 'кольцо', 8, 'c933cea0-b5d0-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(619, 6, 1, 0, 'COLOMBO Melo  B1208 хром. Держатель туалетной бумаги настенный', 'B1208', 0, 0, '', '', '', 'colombo-melo-b1208-hrom-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c933cea1-b5d0-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(620, 6, 1, 0, 'COLOMBO Melo  B1207 хром/стекло матовое. Ершик туалетный настенный', 'B1207', 0, 0, '', '', '', 'colombo-melo-b1207-hrom-steklo-matovoe-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'c933cea3-b5d0-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(621, 6, 1, 0, 'COLOMBO Melo (Oggettistica) B9305 хром/стекло матовое. Дозатор жидкого мыла настольный', 'B9305', 0, 0, '', '', '', 'colombo-melo-oggettistica-b9305-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'c933cea5-b5d0-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(622, 6, 1, 0, 'COLOMBO Melo (Oggettistica) B1240 хром/стекло матовое. Мыльница + стакан настольный', 'B1240', 0, 0, '', '', '', 'colombo-melo-oggettistica-b1240-hrom-steklo-matovoe-mylnica-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'c933cea6-b5d0-11e3-8836-0011951d1b08', 'Мыльница + стакан настольный'),
(623, 6, 1, 0, 'COLOMBO Nordic  B5201 хром/стекло матовое. Мыльница настенная', 'B5201', 0, 0, '', '', '', 'colombo-nordic-b5201-hrom-steklo-matovoe-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'c933cebd-b5d0-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(624, 6, 1, 0, 'COLOMBO Nordic  B5202 хром/стекло матовое. Стакан настенный', 'B5202', 0, 0, '', '', '', 'colombo-nordic-b5202-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'c933cec0-b5d0-11e3-8836-0011951d1b08', 'Стакан настенный'),
(625, 6, 1, 0, 'COLOMBO Nordic  B9323 хром/стекло матовое. Дозатор жидкого мыла настенный', 'B9323', 0, 0, '', '', '', 'colombo-nordic-b9323-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'c933cec2-b5d0-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(626, 6, 1, 0, 'COLOMBO Nordic  B5209 хром. Полотенцедержатель настенный', 'B5209', 0, 0, '', '', '', 'colombo-nordic-b5209-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c933cec4-b5d0-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(627, 6, 1, 0, 'COLOMBO Nordic  B5210 хром. Полотенцедержатель настенный', 'B5210', 0, 0, '', '', '', 'colombo-nordic-b5210-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c933cec5-b5d0-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(628, 6, 1, 0, 'COLOMBO Nordic  B5211 хром. Полотенцедержатель настенный', 'B5211', 0, 0, '', '', '', 'colombo-nordic-b5211-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c933cec6-b5d0-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(629, 6, 1, 0, 'COLOMBO Nordic  B5212 хром. Полотенцедержатель настенный двойной, поворотный', 'B5212', 0, 0, '', '', '', 'colombo-nordic-b5212-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'двойной, поворотный', 8, 'c933cec7-b5d0-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(630, 6, 1, 0, 'COLOMBO Nordic  B5231 хром. Полотенцедержатель настенный', 'B5231', 0, 0, '', '', '', 'colombo-nordic-b5231-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c933cec8-b5d0-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(631, 6, 1, 0, 'COLOMBO Nordic  B5208 хром. Держатель туалетной бумаги настенный', 'B5208', 0, 0, '', '', '', 'colombo-nordic-b5208-hrom-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c933cec9-b5d0-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(632, 6, 1, 0, 'COLOMBO Nordic  B5291 хром. Держатель туалетной бумаги настенный с крышкой', 'B5291', 0, 0, '', '', '', 'colombo-nordic-b5291-hrom-derzhatel-tualetnoj-bumagi-nastennyj-s-kryshkoj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'с крышкой', 8, 'c933ceca-b5d0-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(633, 6, 1, 0, 'COLOMBO Nordic  B5206 хром. Ершик туалетный напольный', 'B5206', 0, 0, '', '', '', 'colombo-nordic-b5206-hrom-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c933cecb-b5d0-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(634, 6, 1, 0, 'COLOMBO Nordic  B5207 хром. Ершик туалетный настенный', 'B5207', 0, 0, '', '', '', 'colombo-nordic-b5207-hrom-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'a3f92a0a-b68d-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(635, 6, 1, 0, 'COLOMBO Nordic (Appenditutto) EB17 хром. Крючок настенный', 'EB17', 0, 0, '', '', '', 'colombo-nordic-appenditutto-eb17-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'a3f92a0b-b68d-11e3-8836-0011951d1b08', 'Крючок настенный'),
(636, 6, 1, 0, 'COLOMBO Nordic (Appenditutto) EB27 хром. Крючок настенный', 'EB27', 0, 0, '', '', '', 'colombo-nordic-appenditutto-eb27-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'a3f92a0c-b68d-11e3-8836-0011951d1b08', 'Крючок настенный'),
(637, 6, 1, 0, 'COLOMBO Nordic (Oggettistica) B5240 хром/стекло матовое. Мыльница настольная', 'B5240', 0, 0, '', '', '', 'colombo-nordic-oggettistica-b5240-hrom-steklo-matovoe-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'a3f92a0d-b68d-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(638, 6, 1, 0, 'COLOMBO Nordic (Oggettistica) B5241 хром/стекло матовое. Стакан настольный', 'B5241', 0, 0, '', '', '', 'colombo-nordic-oggettistica-b5241-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'a3f92a0e-b68d-11e3-8836-0011951d1b08', 'Стакан настольный'),
(639, 6, 1, 0, 'COLOMBO Nordic (Oggettistica) B9324 хром/стекло матовое. Дозатор жидкого мыла настольный', 'B9324', 0, 0, '', '', '', 'colombo-nordic-oggettistica-b9324-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'a3f92a0f-b68d-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(640, 6, 1, 0, 'COLOMBO Positano (Oggettistica) B3640 хром/стекло матовое. Мыльница настольная', 'B3640', 0, 0, '', '', '', 'colombo-positano-oggettistica-b3640-hrom-steklo-matovoe-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'a3f92a1a-b68d-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(641, 6, 1, 0, 'COLOMBO Positano (Oggettistica) B3641 хром/стекло матовое. Стакан настольный', 'B3641', 0, 0, '', '', '', 'colombo-positano-oggettistica-b3641-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'a3f92a1c-b68d-11e3-8836-0011951d1b08', 'Стакан настольный'),
(642, 6, 1, 0, 'COLOMBO Positano (Oggettistica) B9327 хром/стекло матовое. Дозатор жидкого мыла настольный', 'B9327', 0, 0, '', '', '', 'colombo-positano-oggettistica-b9327-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'a3f92a1e-b68d-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(643, 6, 1, 0, 'COLOMBO Over  B7001 сатин/стекло матовое. Мыльница настенная', 'B7001', 0, 0, '', '', '', 'colombo-over-b7001-satin-steklo-matovoe-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', 'стекло', 'матовое', '', 8, 'a3f92a20-b68d-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(644, 6, 1, 0, 'COLOMBO Over  B7002 сатин/стекло матовое. Стакан настенный', 'B7002', 0, 0, '', '', '', 'colombo-over-b7002-satin-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', 'стекло', 'матовое', '', 8, 'a3f92a23-b68d-11e3-8836-0011951d1b08', 'Стакан настенный'),
(645, 6, 1, 0, 'COLOMBO Over  B9328 сатин/стекло матовое. Дозатор жидкого мыла настенный', 'B9328', 0, 0, '', '', '', 'colombo-over-b9328-satin-steklo-matovoe-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', 'стекло', 'матовое', '', 8, 'a3f92a24-b68d-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(646, 6, 1, 0, 'COLOMBO Over  B7071 240xh200x95 сатин. Держатель журналов настенный', 'B7071', 0, 0, '', '', '', 'colombo-over-b7071-240xh200x95-satin-derzhatel-zhurnalov-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 240, 200, 95, 'сатин', '', '', '', '', 8, 'a3f92a25-b68d-11e3-8836-0011951d1b08', 'Держатель журналов настенный'),
(647, 6, 1, 0, 'COLOMBO Over  B7070 140xh55x80 сатин. Полка настенная', 'B7070', 0, 0, '', '', '', 'colombo-over-b7070-140xh55x80-satin-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 140, 55, 80, 'сатин', '', '', '', '', 8, 'a3f92a27-b68d-11e3-8836-0011951d1b08', 'Полка настенная'),
(648, 6, 1, 0, 'COLOMBO Khala (Appenditutto) MH17 хром. Крючок настенный', 'MH17', 0, 0, '', '', '', 'colombo-khala-appenditutto-mh17-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '177ada4b-b703-11e3-8836-0011951d1b08', 'Крючок настенный'),
(649, 6, 1, 0, 'COLOMBO Khala (Oggettistica) B1840 хром. Мыльница настольная', 'B1840', 0, 0, '', '', '', 'colombo-khala-oggettistica-b1840-hrom-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '177ada4c-b703-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(650, 6, 1, 0, 'COLOMBO Khala (Oggettistica) B1841 хром/стекло матовое. Стакан настольный', 'B1841', 0, 0, '', '', '', 'colombo-khala-oggettistica-b1841-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '177ada4d-b703-11e3-8836-0011951d1b08', 'Стакан настольный'),
(651, 6, 1, 0, 'COLOMBO Khala (Oggettistica) B9304 хром/стекло матовое. Дозатор жидкого мыла настольный', 'B9304', 0, 0, '', '', '', 'colombo-khala-oggettistica-b9304-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '177ada4e-b703-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(652, 6, 1, 0, 'COLOMBO Over  B7009 300xh55x80 сатин. Полотенцедержатель настенный', 'B7009', 0, 0, '', '', '', 'colombo-over-b7009-300xh55x80-satin-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 300, 55, 80, 'сатин', '', '', '', '', 8, 'c35e18a5-b71f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(653, 6, 1, 0, 'COLOMBO Over  B7010 450xh55x80 сатин. Полотенцедержатель настенный', 'B7010', 0, 0, '', '', '', 'colombo-over-b7010-450xh55x80-satin-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 450, 55, 80, 'сатин', '', '', '', '', 8, 'c35e18a6-b71f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(654, 6, 1, 0, 'COLOMBO Over  B7011 600xh55x80 сатин. Полотенцедержатель настенный', 'B7011', 0, 0, '', '', '', 'colombo-over-b7011-600xh55x80-satin-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 600, 55, 80, 'сатин', '', '', '', '', 8, 'c35e18a7-b71f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(655, 6, 1, 0, 'COLOMBO Over  B7031 220xh100x65 сатин. Полотенцедержатель настенный кольцо', 'B7031', 0, 0, '', '', '', 'colombo-over-b7031-220xh100x65-satin-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 220, 100, 65, 'сатин', '', '', '', 'кольцо', 8, 'c35e18a8-b71f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(656, 6, 1, 0, 'COLOMBO Over  B7008 сатин. Держатель туалетной бумаги настенный', 'B7008', 0, 0, '', '', '', 'colombo-over-b7008-satin-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', '', '', '', 8, 'c35e18a9-b71f-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(657, 6, 1, 0, 'COLOMBO Over  B7090 сатин/стекло матовое. Держатель туалетной бумаги настенный для запасного рулона', 'B7090', 0, 0, '', '', '', 'colombo-over-b7090-satin-steklo-matovoe-derzhatel-tualetnoj-bumagi-nastennyj-dlya-zapasnogo-rulona', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', 'стекло', 'матовое', 'для запасного рулона', 8, 'c35e18aa-b71f-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(658, 6, 1, 0, 'COLOMBO Over  B7006 сатин/стекло матовое. Ершик туалетный напольный', 'B7006', 0, 0, '', '', '', 'colombo-over-b7006-satin-steklo-matovoe-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', 'стекло', 'матовое', '', 8, 'c35e18ab-b71f-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(659, 6, 1, 0, 'COLOMBO Over  B7007 сатин/стекло матовое. Ершик туалетный настенный', 'B7007', 0, 0, '', '', '', 'colombo-over-b7007-satin-steklo-matovoe-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', 'стекло', 'матовое', '', 8, 'c35e18ac-b71f-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(660, 6, 1, 0, 'COLOMBO Over (Appenditutto) GM17 сатин. Крючок настенный', 'GM17', 0, 0, '', '', '', 'colombo-over-appenditutto-gm17-satin-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', '', '', '', 8, 'c35e18ad-b71f-11e3-8836-0011951d1b08', 'Крючок настенный'),
(661, 6, 1, 0, 'COLOMBO Over (Oggettistica) B7040 сатин/стекло матовое. Мыльница настольная', 'B7040', 0, 0, '', '', '', 'colombo-over-oggettistica-b7040-satin-steklo-matovoe-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', 'стекло', 'матовое', '', 8, 'c35e18ae-b71f-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(662, 6, 1, 0, 'COLOMBO Over (Oggettistica) B7041 сатин/стекло матовое. Стакан настольный', 'B7041', 0, 0, '', '', '', 'colombo-over-oggettistica-b7041-satin-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', 'стекло', 'матовое', '', 8, 'c35e18af-b71f-11e3-8836-0011951d1b08', 'Стакан настольный'),
(663, 6, 1, 0, 'COLOMBO Over (Oggettistica) B9329 сатин/стекло матовое. Дозатор жидкого мыла настольный', 'B9329', 0, 0, '', '', '', 'colombo-over-oggettistica-b9329-satin-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'сатин', '', 'стекло', 'матовое', '', 8, 'c35e18b0-b71f-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(664, 6, 1, 0, 'COLOMBO Planets  B9807 220xh720x220 хром. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги)', 'B9807', 0, 0, '', '', '', 'colombo-planets-b9807-220xh720x220-hrom-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 220, 720, 220, 'хром', '', '', '', '(ершик + держатель туалетной бумаги)', 8, 'c35e18bf-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(665, 6, 1, 0, 'COLOMBO Planets  B9816 220xh720x220 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги)', 'B9816', 0, 0, '', '', '', 'colombo-planets-b9816-220xh720x220-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 220, 720, 220, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги)', 8, 'c35e18c1-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(666, 6, 1, 0, 'COLOMBO Planets  B9809 400xh880x310 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 'B9809', 0, 0, '', '', '', 'colombo-planets-b9809-400xh880x310-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-mylnica', '0000-00-00', '', '', '', NULL, NULL, 400, 880, 310, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 8, 'c35e18c2-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(667, 6, 1, 0, 'COLOMBO Planets  B9813 360xh880x310 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 'B9813', 0, 0, '', '', '', 'colombo-planets-b9813-360xh880x310-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-mylnica', '0000-00-00', '', '', '', NULL, NULL, 360, 880, 310, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 8, 'c35e18c3-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(668, 6, 1, 0, 'COLOMBO Planets  B9814 410xh880x260 хром/стекло матовое. Стойка с аксессуарами напольная (мыльница + полотенцедержатель двойной, поворотный)', 'B9814', 0, 0, '', '', '', 'colombo-planets-b9814-410xh880x260-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-mylnica-polotencederzhatel-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 410, 880, 260, 'хром', '', 'стекло', 'матовое', '(мыльница + полотенцедержатель двойной, поворотный)', 8, 'c35e18c4-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(669, 6, 1, 0, 'COLOMBO Planets  B9815 410xh880x260 хром. Полотенцедержатель напольный', 'B9815', 0, 0, '', '', '', 'colombo-planets-b9815-410xh880x260-hrom-polotencederzhatel-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 410, 880, 260, 'хром', '', '', '', '', 8, 'c35e18c5-b71f-11e3-8836-0011951d1b08', 'Полотенцедержатель напольный');
INSERT INTO `products` (`id`, `manufacturer_id`, `is_active`, `sort`, `name`, `sku`, `price`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `description`, `is_new`, `is_special`, `width`, `height`, `depth`, `color`, `turn`, `material`, `finishing`, `shortdesc`, `parent_id`, `1c_id`, `shortname`) VALUES
(670, 6, 1, 0, 'COLOMBO Planets  B9818 400xh880x270 хром. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла (снято с производства 01.01.14)', 'B9818', 0, 0, '', '', '', 'colombo-planets-b9818-400xh880x270-hrom-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-dozator-zhidkogo-myla-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 400, 880, 270, 'хром', '', '', '', '(ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла', 8, 'c35e18c6-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(671, 6, 1, 0, 'COLOMBO Planets  B9819 360xh880x270 хром. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла', 'B9819', 0, 0, '', '', '', 'colombo-planets-b9819-360xh880x270-hrom-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-dozator-zhidkogo-myla', '0000-00-00', '', '', '', NULL, NULL, 360, 880, 270, 'хром', '', '', '', '(ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла', 8, 'c35e18c8-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(672, 6, 1, 0, 'COLOMBO Planets  B9839 390xh880x220 хром. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла (снято с производства 01.01.14)', 'B9839', 0, 0, '', '', '', 'colombo-planets-b9839-390xh880x220-hrom-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-dozator-zhidkogo-myla-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 390, 880, 220, 'хром', '', '', '', '(ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла', 8, 'c35e18c9-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(673, 6, 1, 0, 'COLOMBO Planets  B9833 390xh880x220 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 'B9833', 0, 0, '', '', '', 'colombo-planets-b9833-390xh880x220-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-mylnica', '0000-00-00', '', '', '', NULL, NULL, 390, 880, 220, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 8, 'c35e18ca-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(674, 6, 1, 0, 'COLOMBO Planets  B9843 390xh880x220 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 'B9843', 0, 0, '', '', '', 'colombo-planets-b9843-390xh880x220-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-mylnica', '0000-00-00', '', '', '', NULL, NULL, 390, 880, 220, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 8, 'c35e18cb-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(675, 6, 1, 0, 'COLOMBO Planets  B9849 390xh880x220 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла', 'B9849', 0, 0, '', '', '', 'colombo-planets-b9849-390xh880x220-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-dozator-zhidkogo-myla', '0000-00-00', '', '', '', NULL, NULL, 390, 880, 220, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла', 8, 'c35e18cc-b71f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(676, 6, 1, 0, 'COLOMBO Planets  B9805 хром. Ершик туалетный напольный', 'B9805', 0, 0, '', '', '', 'colombo-planets-b9805-hrom-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c35e18cd-b71f-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(677, 6, 1, 0, 'COLOMBO Planets  B9804 400xh1780x300 хром. Вешалка напольная (2 полотенцедержателя + 2 крючка)', 'B9804', 0, 0, '', '', '', 'colombo-planets-b9804-400xh1780x300-hrom-veshalka-napolnaya-2-polotencederzhatelya-2-kryuchka', '0000-00-00', '', '', '', NULL, NULL, 400, 1780, 300, 'хром', '', '', '', '(2 полотенцедержателя + 2 крючка)', 8, 'c35e18ce-b71f-11e3-8836-0011951d1b08', 'Вешалка напольная'),
(678, 6, 1, 0, 'COLOMBO Planets  B9812 300xh1780x300 хром. Вешалка напольная 4 крючка', 'B9812', 0, 0, '', '', '', 'colombo-planets-b9812-300xh1780x300-hrom-veshalka-napolnaya-4-kryuchka', '0000-00-00', '', '', '', NULL, NULL, 300, 1780, 300, 'хром', '', '', '', '4 крючка', 8, 'c35e18cf-b71f-11e3-8836-0011951d1b08', 'Вешалка напольная'),
(679, 6, 1, 0, 'COLOMBO Planets  B9820 340xh1000x220 хром/стекло матовое. Штанга с аксессуарами настенная (мыльница + стакан + 2 полотенцедержателя + зеркало косметическое) (снято с производства 01.01.14)', 'B9820', 0, 0, '', '', '', 'colombo-planets-b9820-340xh1000x220-hrom-steklo-matovoe-shtanga-s-aksessuarami-nastennaya-mylnica-stakan-2-polotencederzhatelya-zerkalo-kosmeticheskoe-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 340, 1000, 220, 'хром', '', 'стекло', 'матовое', '(мыльница + стакан + 2 полотенцедержателя + зеркало косметическое)', 8, 'c35e18d1-b71f-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(680, 6, 1, 0, 'COLOMBO Planets  B9822 300xh880x200 хром/стекло матовое. Штанга с аксессуарами настенная (ершик + держатель туалетной бумаги + мыльница + полотенцедержатель)', 'B9822', 0, 0, '', '', '', 'colombo-planets-b9822-300xh880x200-hrom-steklo-matovoe-shtanga-s-aksessuarami-nastennaya-ershik-derzhatel-tualetnoj-bumagi-mylnica-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 300, 880, 200, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + мыльница + полотенцедержатель)', 8, 'c35e18d3-b71f-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(681, 6, 1, 0, 'COLOMBO Planets  B9823 140xh730x160 хром/стекло матовое. Штанга с аксессуарами настенная (ершик + держатель туалетной бумаги)', 'B9823', 0, 0, '', '', '', 'colombo-planets-b9823-140xh730x160-hrom-steklo-matovoe-shtanga-s-aksessuarami-nastennaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 140, 730, 160, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги)', 8, 'c35e18d4-b71f-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(682, 6, 1, 0, 'COLOMBO Planets  B9824 280xh390x160 хром/стекло матовое. Штанга с аксессуарами настенная (мыльница + 2 полотенцедержателя)', 'B9824', 0, 0, '', '', '', 'colombo-planets-b9824-280xh390x160-hrom-steklo-matovoe-shtanga-s-aksessuarami-nastennaya-mylnica-2-polotencederzhatelya', '0000-00-00', '', '', '', NULL, NULL, 280, 390, 160, 'хром', '', 'стекло', 'матовое', '(мыльница + 2 полотенцедержателя)', 8, 'c35e18d5-b71f-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(683, 6, 1, 0, 'COLOMBO Planets  B9825 280xh390x160 хром. Штанга с аксессуарами настенная (дозатор жидкого мыла + 2 полотенцедержателя) (снято с производства 01.01.14)', 'B9825', 0, 0, '', '', '', 'colombo-planets-b9825-280xh390x160-hrom-shtanga-s-aksessuarami-nastennaya-dozator-zhidkogo-myla-2-polotencederzhatelya-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 280, 390, 160, 'хром', '', '', '', '(дозатор жидкого мыла + 2 полотенцедержателя)', 8, 'c35e18d6-b71f-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(684, 6, 1, 0, 'COLOMBO Plus  W4901 хром. Мыльница настенная', 'W4901', 0, 0, '', '', '', 'colombo-plus-w4901-hrom-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c35e18dc-b71f-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(685, 6, 1, 0, 'COLOMBO Plus  W4902 хром. Стакан настенный', 'W4902', 0, 0, '', '', '', 'colombo-plus-w4902-hrom-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c35e18de-b71f-11e3-8836-0011951d1b08', 'Стакан настенный'),
(686, 6, 1, 0, 'COLOMBO Plus  W4981 хром. Дозатор жидкого мыла настенный 0,15л', 'W4981', 0, 0, '', '', '', 'colombo-plus-w4981-hrom-dozator-zhidkogo-myla-nastennyj-0-15l', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '0,15л', 8, 'c35e18df-b71f-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(687, 6, 1, 0, 'COLOMBO Plus  W4916 600xh35x125 хром. Полка настенная', 'W4916', 0, 0, '', '', '', 'colombo-plus-w4916-600xh35x125-hrom-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 600, 35, 125, 'хром', '', '', '', '', 8, 'c35e18e1-b71f-11e3-8836-0011951d1b08', 'Полка настенная'),
(688, 6, 1, 0, 'COLOMBO Plus  W4975 хром. Дозатор жидкого мыла + полотенцедержатель настенные', 'W4975', 0, 0, '', '', '', 'colombo-plus-w4975-hrom-dozator-zhidkogo-myla-polotencederzhatel-nastennye', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'c35e18e2-b71f-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла + полотенцедержатель настенные'),
(689, 6, 1, 0, 'COLOMBO Plus  W4909 335 хром. Полотенцедержатель настенный', 'W4909', 0, 0, '', '', '', 'colombo-plus-w4909-335-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 335, 0, 0, 'хром', '', '', '', '', 8, 'e32f1870-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(690, 6, 1, 0, 'COLOMBO Plus  W4910 485 хром. Полотенцедержатель настенный', 'W4910', 0, 0, '', '', '', 'colombo-plus-w4910-485-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 485, 0, 0, 'хром', '', '', '', '', 8, 'e32f1871-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(691, 6, 1, 0, 'COLOMBO Plus  W4911 635 хром. Полотенцедержатель настенный', 'W4911', 0, 0, '', '', '', 'colombo-plus-w4911-635-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 635, 0, 0, 'хром', '', '', '', '', 8, 'e32f1872-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(692, 6, 1, 0, 'COLOMBO Plus  W4912 835 хром. Полотенцедержатель настенный', 'W4912', 0, 0, '', '', '', 'colombo-plus-w4912-835-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 835, 0, 0, 'хром', '', '', '', '', 8, 'e32f1873-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(693, 6, 1, 0, 'COLOMBO Plus  W4909R 305 хром. Полотенцедержатель настенный', 'W4909R', 0, 0, '', '', '', 'colombo-plus-w4909r-305-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 305, 0, 0, 'хром', '', '', '', '', 8, 'e32f1874-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(694, 6, 1, 0, 'COLOMBO Plus  W4910R 455 хром. Полотенцедержатель настенный', 'W4910R', 0, 0, '', '', '', 'colombo-plus-w4910r-455-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 455, 0, 0, 'хром', '', '', '', '', 8, 'e32f1875-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(695, 6, 1, 0, 'COLOMBO Plus  W4911R 635 хром. Полотенцедержатель настенный', 'W4911R', 0, 0, '', '', '', 'colombo-plus-w4911r-635-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 635, 0, 0, 'хром', '', '', '', '', 8, 'e32f1876-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(696, 6, 1, 0, 'COLOMBO Plus  W4915 38 хром. Полотенцедержатель настенный выдвижной (25-38см)', 'W4915', 0, 0, '', '', '', 'colombo-plus-w4915-38-hrom-polotencederzhatel-nastennyj-vydvizhnoj-25-38sm', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 38, 'хром', '', '', '', 'выдвижной (25-38см)', 8, 'e32f1877-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(697, 6, 1, 0, 'COLOMBO Plus  W4913 345xh45x45 хром. Полотенцедержатель настенный', 'W4913', 0, 0, '', '', '', 'colombo-plus-w4913-345xh45x45-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 345, 45, 45, 'хром', '', '', '', '', 8, 'e32f1879-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(698, 6, 1, 0, 'COLOMBO Plus  W4914 415xh45x45 хром. Полотенцедержатель настенный двойной, поворотный, выдвижной (28-42см)', 'W4914', 0, 0, '', '', '', 'colombo-plus-w4914-415xh45x45-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj-vydvizhnoj-28-42sm', '0000-00-00', '', '', '', NULL, NULL, 415, 45, 45, 'хром', '', '', '', 'двойной, поворотный, выдвижной (28-42см)', 8, 'e32f187a-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(699, 6, 1, 0, 'COLOMBO Plus  W4931 хром. Полотенцедержатель настенный кольцо', 'W4931', 0, 0, '', '', '', 'colombo-plus-w4931-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'кольцо', 8, 'e32f187c-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(700, 6, 1, 0, 'COLOMBO Plus  W4908 хром. Держатель туалетной бумаги настенный', 'W4908', 0, 0, '', '', '', 'colombo-plus-w4908-hrom-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'e32f187d-b73f-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(701, 6, 1, 0, 'COLOMBO Plus  W4990 хром. Держатель туалетной бумаги настенный двойной', 'W4990', 0, 0, '', '', '', 'colombo-plus-w4990-hrom-derzhatel-tualetnoj-bumagi-nastennyj-dvojnoj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'двойной', 8, 'e32f187e-b73f-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(702, 6, 1, 0, 'COLOMBO Plus  W4908SX хром, левый. Держатель туалетной бумаги настенный', 'W4908SX', 0, 0, '', '', '', 'colombo-plus-w4908sx-hrom-levyj-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', 'левый', '', '', '', 8, 'e32f1880-b73f-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(703, 6, 1, 0, 'COLOMBO Plus  W4961 хром. Ершик туалетный напольный', 'W4961', 0, 0, '', '', '', 'colombo-plus-w4961-hrom-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'e32f1881-b73f-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(704, 6, 1, 0, 'COLOMBO Plus  W4962 хром. Ершик туалетный настенный', 'W4962', 0, 0, '', '', '', 'colombo-plus-w4962-hrom-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'e32f1882-b73f-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(705, 6, 1, 0, 'COLOMBO Plus  W4987 495xh45x265 хром. Полотенцедержатель настенный большой', 'W4987', 0, 0, '', '', '', 'colombo-plus-w4987-495xh45x265-hrom-polotencederzhatel-nastennyj-bolshoj', '0000-00-00', '', '', '', NULL, NULL, 495, 45, 265, 'хром', '', '', '', 'большой', 8, 'e32f1883-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(706, 6, 1, 0, 'COLOMBO Plus  B9956 250xh250x55 голубой лакированный. Шкафчик для ключей с зеркалом круглый (ключ) (снято с производства 01.01.14)', 'B9956', 0, 0, '', '', '', 'colombo-plus-b9956-250xh250x55-goluboj-lakirovannyj-shkafchik-dlya-klyuchej-s-zerkalom-kruglyj-klyuch-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 250, 250, 55, 'голубой', '', '', 'лакированный', 'круглый (ключ)', 8, 'e32f1884-b73f-11e3-8836-0011951d1b08', 'Шкафчик для ключей с зеркалом'),
(707, 6, 1, 0, 'COLOMBO Plus  W4923 205xh605x180 хром. Штанга с аксессуарами настенная (ершик + держатель туалетной бумаги)', 'W4923', 0, 0, '', '', '', 'colombo-plus-w4923-205xh605x180-hrom-shtanga-s-aksessuarami-nastennaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 205, 605, 180, 'хром', '', '', '', '(ершик + держатель туалетной бумаги)', 8, 'e32f1888-b73f-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(708, 6, 1, 0, 'COLOMBO Plus  W4935 260xh750x200 хром. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги)', 'W4935', 0, 0, '', '', '', 'colombo-plus-w4935-260xh750x200-hrom-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 260, 750, 200, 'хром', '', '', '', '(ершик + держатель туалетной бумаги)', 8, 'e32f1889-b73f-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(709, 6, 1, 0, 'COLOMBO Plus  W4936 320xh830x235 хром. Полотенцедержатель напольный двойной поворотный', 'W4936', 0, 0, '', '', '', 'colombo-plus-w4936-320xh830x235-hrom-polotencederzhatel-napolnyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 320, 830, 235, 'хром', '', '', '', 'двойной поворотный', 8, 'e32f188a-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель напольный'),
(710, 6, 1, 0, 'COLOMBO Plus  W4938 400xh835x200 хром. Полотенцедержатель напольный двойной', 'W4938', 0, 0, '', '', '', 'colombo-plus-w4938-400xh835x200-hrom-polotencederzhatel-napolnyj-dvojnoj', '0000-00-00', '', '', '', NULL, NULL, 400, 835, 200, 'хром', '', '', '', 'двойной', 8, 'e32f188c-b73f-11e3-8836-0011951d1b08', 'Полотенцедержатель напольный'),
(711, 6, 1, 0, 'COLOMBO Plus (Appenditutto) W4917 хром. Крючок настенный', 'W4917', 0, 0, '', '', '', 'colombo-plus-appenditutto-w4917-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'e32f188e-b73f-11e3-8836-0011951d1b08', 'Крючок настенный'),
(712, 6, 1, 0, 'COLOMBO Plus (Oggettistica) W4940 хром. Мыльница настольная', 'W4940', 0, 0, '', '', '', 'colombo-plus-oggettistica-w4940-hrom-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'e32f188f-b73f-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(713, 6, 1, 0, 'COLOMBO Plus (Oggettistica) W4941 хром. Стакан настольный', 'W4941', 0, 0, '', '', '', 'colombo-plus-oggettistica-w4941-hrom-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'e32f1890-b73f-11e3-8836-0011951d1b08', 'Стакан настольный'),
(714, 6, 1, 0, 'COLOMBO Plus (Oggettistica) W4980 хром. Дозатор жидкого мыла настольный 0,15л', 'W4980', 0, 0, '', '', '', 'colombo-plus-oggettistica-w4980-hrom-dozator-zhidkogo-myla-nastolnyj-0-15l', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '0,15л', 8, 'e32f1891-b73f-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(715, 6, 1, 0, 'COLOMBO Plus (Oggettistica) W4980XL хром. Дозатор жидкого мыла настольный 0,5л', 'W4980XL', 0, 0, '', '', '', 'colombo-plus-oggettistica-w4980xl-hrom-dozator-zhidkogo-myla-nastolnyj-0-5l', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '0,5л', 8, 'e32f1893-b73f-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(716, 6, 1, 0, 'COLOMBO Portofino  B3200 55xh55x5 хром. Накладка декоративная на крепление квадратная', 'B3200', 0, 0, '', '', '', 'colombo-portofino-b3200-55xh55x5-hrom-nakladka-dekorativnaya-na-kreplenie-kvadratnaya', '0000-00-00', '', '', '', NULL, NULL, 55, 55, 5, 'хром', '', '', '', 'квадратная', 8, 'e32f1898-b73f-11e3-8836-0011951d1b08', 'Накладка декоративная на крепление'),
(717, 6, 1, 0, 'COLOMBO Portofino  B3200 OR 55xh55x5 золото. Накладка декоративная на крепление квадратная', 'B3200 OR', 0, 0, '', '', '', 'colombo-portofino-b3200-or-55xh55x5-zoloto-nakladka-dekorativnaya-na-kreplenie-kvadratnaya', '0000-00-00', '', '', '', NULL, NULL, 55, 55, 5, 'золото', '', '', '', 'квадратная', 8, 'e32f189b-b73f-11e3-8836-0011951d1b08', 'Накладка декоративная на крепление'),
(718, 6, 1, 0, 'COLOMBO Portofino  B3201 55xh55x5 хром/стекло матовое. Мыльница настенная', 'B3201', 0, 0, '', '', '', 'colombo-portofino-b3201-55xh55x5-hrom-steklo-matovoe-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 55, 55, 5, 'хром', '', 'стекло', 'матовое', '', 8, 'e32f189c-b73f-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(719, 6, 1, 0, 'COLOMBO Portofino  B3202 хром/стекло матовое. Стакан настенный', 'B3202', 0, 0, '', '', '', 'colombo-portofino-b3202-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'e32f189d-b73f-11e3-8836-0011951d1b08', 'Стакан настенный'),
(720, 6, 1, 0, 'COLOMBO Portofino  B9325 хром/стекло матовое. Дозатор жидкого мыла настенный 0,3л', 'B9325', 0, 0, '', '', '', 'colombo-portofino-b9325-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastennyj-0-3l', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '0,3л', 8, 'e32f189e-b73f-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(721, 6, 1, 0, 'COLOMBO Portofino  B3216 600xh70x125 хром/стекло матовое. Полка настенная', 'B3216', 0, 0, '', '', '', 'colombo-portofino-b3216-600xh70x125-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 600, 70, 125, 'хром', '', 'стекло', 'матовое', '', 8, 'e32f18a0-b73f-11e3-8836-0011951d1b08', 'Полка настенная'),
(722, 6, 1, 0, 'COLOMBO Portofino  B3274SX 400xh50x125 хром/стекло матовое, левый. Мыльница с полотенцедержателем настенная', 'B3274SX', 0, 0, '', '', '', 'colombo-portofino-b3274sx-400xh50x125-hrom-steklo-matovoe-levyj-mylnica-s-polotencederzhatelem-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 400, 50, 125, 'хром', 'левый', 'стекло', 'матовое', '', 8, 'e32f18a3-b73f-11e3-8836-0011951d1b08', 'Мыльница с полотенцедержателем настенная'),
(723, 6, 1, 0, 'COLOMBO Portofino  B3209 350 хром. Полотенцедержатель настенный', 'B3209', 0, 0, '', '', '', 'colombo-portofino-b3209-350-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 350, 0, 0, 'хром', '', '', '', '', 8, '5b5a6dcf-bafe-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(724, 6, 1, 0, 'COLOMBO Portofino  B3210 450 хром. Полотенцедержатель настенный', 'B3210', 0, 0, '', '', '', 'colombo-portofino-b3210-450-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 450, 0, 0, 'хром', '', '', '', '', 8, '5b5a6dd0-bafe-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(725, 6, 1, 0, 'COLOMBO Portofino  B3211 600 хром. Полотенцедержатель настенный', 'B3211', 0, 0, '', '', '', 'colombo-portofino-b3211-600-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 600, 0, 0, 'хром', '', '', '', '', 8, '5b5a6dd1-bafe-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(726, 6, 1, 0, 'COLOMBO Portofino  B3212 410 хром. Полотенцедержатель настенный двойной, поворотный', 'B3212', 0, 0, '', '', '', 'colombo-portofino-b3212-410-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 410, 0, 0, 'хром', '', '', '', 'двойной, поворотный', 8, '5b5a6dd2-bafe-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(727, 6, 1, 0, 'COLOMBO Portofino  B3231 хром. Полотенцедержатель настенный кольцо', 'B3231', 0, 0, '', '', '', 'colombo-portofino-b3231-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'кольцо', 8, '5b5a6dd3-bafe-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(728, 6, 1, 0, 'COLOMBO Portofino  B3208DX хром, правый. Держатель туалетной бумаги настенный', 'B3208DX', 0, 0, '', '', '', 'colombo-portofino-b3208dx-hrom-pravyj-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', 'правый', '', '', '', 8, '5b5a6dd4-bafe-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(729, 6, 1, 0, 'COLOMBO Portofino  B3291 хром. Держатель туалетной бумаги настенный с крышкой', 'B3291', 0, 0, '', '', '', 'colombo-portofino-b3291-hrom-derzhatel-tualetnoj-bumagi-nastennyj-s-kryshkoj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'с крышкой', 8, '5b5a6dd6-bafe-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(730, 6, 1, 0, 'COLOMBO Portofino  B3206 хром/стекло матовое. Ершик туалетный напольный', 'B3206', 0, 0, '', '', '', 'colombo-portofino-b3206-hrom-steklo-matovoe-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '5b5a6dd7-bafe-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(731, 6, 1, 0, 'COLOMBO Portofino  B3207 хром/стекло матовое. Ершик туалетный настенный', 'B3207', 0, 0, '', '', '', 'colombo-portofino-b3207-hrom-steklo-matovoe-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '5b5a6dd8-bafe-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(732, 6, 1, 0, 'COLOMBO Portofino  B2016 710xh710x30. Зеркало для ванной на металлической раме + выключатель + розетка', 'B2016', 0, 0, '', '', '', 'colombo-portofino-b2016-710xh710x30-zerkalo-dlya-vannoj-na-metallicheskoj-rame-vyklyuchatel-rozetka', '0000-00-00', '', '', '', NULL, NULL, 710, 710, 30, '', '', '', '', 'на металлической раме + выключатель + розетка', 14, '5b5a6dd9-bafe-11e3-8836-0011951d1b08', 'Зеркало для ванной'),
(733, 6, 1, 0, 'COLOMBO Portofino  B2018 410xh1010x30. Зеркало для ванной на металлической раме + выключатель + розетка (реверсивное) (снято с производства 01.01.14)', 'B2018', 0, 0, '', '', '', 'colombo-portofino-b2018-410xh1010x30-zerkalo-dlya-vannoj-na-metallicheskoj-rame-vyklyuchatel-rozetka-reversivnoe-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 410, 1010, 30, '', '', '', '', 'на металлической раме + выключатель + розетка (реверсивное)', 14, '5b5a6ddb-bafe-11e3-8836-0011951d1b08', 'Зеркало для ванной'),
(734, 6, 1, 0, 'COLOMBO Portofino  B1305M 120xh190x220 хром/стекло матовое. Светильник настенный (max 60W/230V)', 'B1305M', 0, 0, '', '', '', 'colombo-portofino-b1305m-120xh190x220-hrom-steklo-matovoe-svetilnik-nastennyj-max-60w-230v', '0000-00-00', '', '', '', NULL, NULL, 120, 190, 220, 'хром', '', 'стекло', 'матовое', '(max 60W/230V)', 10, '5b5a6ddd-bafe-11e3-8836-0011951d1b08', 'Светильник настенный'),
(735, 6, 1, 0, 'COLOMBO Portofino  B3218 255xh735x215 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги)', 'B3218', 0, 0, '', '', '', 'colombo-portofino-b3218-255xh735x215-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 255, 735, 215, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги)', 8, '5b5a6ddf-bafe-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(736, 6, 1, 0, 'COLOMBO Portofino  B3219 370xh735x215 хром/стекло матовое. Стойка с аксессуарами напольная (мыльница + полотенцедержатель) (снято с производства 01.01.14)', 'B3219', 0, 0, '', '', '', 'colombo-portofino-b3219-370xh735x215-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-mylnica-polotencederzhatel-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 370, 735, 215, 'хром', '', 'стекло', 'матовое', '(мыльница + полотенцедержатель)', 8, '5b5a6de0-bafe-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(737, 6, 1, 0, 'COLOMBO Portofino  B3238 450xh850x215 хром. Полотенцедержатель напольный двойной поворотный', 'B3238', 0, 0, '', '', '', 'colombo-portofino-b3238-450xh850x215-hrom-polotencederzhatel-napolnyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 450, 850, 215, 'хром', '', '', '', 'двойной поворотный', 8, '5b5a6de2-bafe-11e3-8836-0011951d1b08', 'Полотенцедержатель напольный'),
(738, 6, 1, 0, 'COLOMBO Portofino  B1305 120xh190x220 хром/стекло матовое. Светильник на зеркало крепеж на раму (max 60W/230V)', 'B1305', 0, 0, '', '', '', 'colombo-portofino-b1305-120xh190x220-hrom-steklo-matovoe-svetilnik-na-zerkalo-krepezh-na-ramu-max-60w-230v', '0000-00-00', '', '', '', NULL, NULL, 120, 190, 220, 'хром', '', 'стекло', 'матовое', 'крепеж на раму (max 60W/230V)', 10, '5b5a6de3-bafe-11e3-8836-0011951d1b08', 'Светильник на зеркало'),
(739, 6, 1, 0, 'COLOMBO Portofino (Appenditutto) CD87 хром. Крючок настенный', 'CD87', 0, 0, '', '', '', 'colombo-portofino-appenditutto-cd87-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '5b5a6de5-bafe-11e3-8836-0011951d1b08', 'Крючок настенный'),
(740, 6, 1, 0, 'COLOMBO Portofino (Appenditutto) CD97 хром. Крючок настенный', 'CD97', 0, 0, '', '', '', 'colombo-portofino-appenditutto-cd97-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '5b5a6de6-bafe-11e3-8836-0011951d1b08', 'Крючок настенный'),
(741, 6, 1, 0, 'COLOMBO Portofino (Oggettistica) B3242 хром/стекло матовое. Мыльница настольная', 'B3242', 0, 0, '', '', '', 'colombo-portofino-oggettistica-b3242-hrom-steklo-matovoe-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '5b5a6de7-bafe-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(742, 6, 1, 0, 'COLOMBO Portofino (Oggettistica) B3241 хром/стекло матовое. Стакан настольный', 'B3241', 0, 0, '', '', '', 'colombo-portofino-oggettistica-b3241-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '5b5a6dea-bafe-11e3-8836-0011951d1b08', 'Стакан настольный'),
(743, 6, 1, 0, 'COLOMBO Portofino (Oggettistica) B9326 хром/стекло матовое. Дозатор жидкого мыла настольный', 'B9326', 0, 0, '', '', '', 'colombo-portofino-oggettistica-b9326-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '5b5a6dec-bafe-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(744, 6, 1, 0, 'COLOMBO Sguare  B9904 240xh670x140 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги)', 'B9904', 0, 0, '', '', '', 'colombo-sguare-b9904-240xh670x140-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 240, 670, 140, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги)', 8, '5b5a6df9-bafe-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(745, 6, 1, 0, 'COLOMBO Sguare  B9901 360xh810x140 хром. Полотенцедержатель напольный двойной поворотный', 'B9901', 0, 0, '', '', '', 'colombo-sguare-b9901-360xh810x140-hrom-polotencederzhatel-napolnyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 360, 810, 140, 'хром', '', '', '', 'двойной поворотный', 8, '5b5a6dfb-bafe-11e3-8836-0011951d1b08', 'Полотенцедержатель напольный'),
(746, 6, 1, 0, 'COLOMBO Sguare  B9902 280xh680x140 хром/стекло матовое. Стойка с аксессуарами напольная (мыльница + полотенцедержатель)', 'B9902', 0, 0, '', '', '', 'colombo-sguare-b9902-280xh680x140-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-mylnica-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 280, 680, 140, 'хром', '', 'стекло', 'матовое', '(мыльница + полотенцедержатель)', 8, '5b5a6dfc-bafe-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(747, 6, 1, 0, 'COLOMBO Sguare  B9914 280xh680x140 хром. Стойка с аксессуарами напольная (держатель дозатора жидкого мыла + полотенцедержатель) (снято с производства 01.01.14)', 'B9914', 0, 0, '', '', '', 'colombo-sguare-b9914-280xh680x140-hrom-stojka-s-aksessuarami-napolnaya-derzhatel-dozatora-zhidkogo-myla-polotencederzhatel-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 280, 680, 140, 'хром', '', '', '', '(держатель дозатора жидкого мыла + полотенцедержатель)', 8, '5b5a6dfd-bafe-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(748, 6, 1, 0, 'COLOMBO Sguare  B9915 360xh810x140 хром. Полотенцедержатель напольный тройной, поворотный', 'B9915', 0, 0, '', '', '', 'colombo-sguare-b9915-360xh810x140-hrom-polotencederzhatel-napolnyj-trojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 360, 810, 140, 'хром', '', '', '', 'тройной, поворотный', 8, '5b5a6dff-bafe-11e3-8836-0011951d1b08', 'Полотенцедержатель напольный'),
(749, 6, 1, 0, 'COLOMBO Sguare  B9903 430xh810x200. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 'B9903', 0, 0, '', '', '', 'colombo-sguare-b9903-430xh810x200-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-mylnica', '0000-00-00', '', '', '', NULL, NULL, 430, 810, 200, '', '', '', '', '(ершик + держатель туалетной бумаги + полотенцедержатель + мыльница)', 8, '5b5a6e00-bafe-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(750, 6, 1, 0, 'COLOMBO Sguare  B9908 350xh810x320 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + полка)', 'B9908', 0, 0, '', '', '', 'colombo-sguare-b9908-350xh810x320-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-polka', '0000-00-00', '', '', '', NULL, NULL, 350, 810, 320, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + полка)', 8, '5b5a6e01-bafe-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(751, 6, 1, 0, 'COLOMBO Sguare  B9913 350xh810x240 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла', 'B9913', 0, 0, '', '', '', 'colombo-sguare-b9913-350xh810x240-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-dozator-zhidkogo-myla', '0000-00-00', '', '', '', NULL, NULL, 350, 810, 240, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла', 8, '5b5a6e02-bafe-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(752, 6, 1, 0, 'COLOMBO Complementi  B9210 160xh255x220 хром. Ведро для мусора с крышкой с педалью, квадратное, 3 л', 'B9210', 0, 0, '', '', '', 'colombo-complementi-b9210-160xh255x220-hrom-vedro-dlya-musora-s-kryshkoj-s-pedalyu-kvadratnoe-3-l', '0000-00-00', '', '', '', NULL, NULL, 160, 255, 220, 'хром', '', '', '', 'с педалью, квадратное, 3 л', 8, '5b5a6e05-bafe-11e3-8836-0011951d1b08', 'Ведро для мусора с крышкой'),
(753, 6, 1, 0, 'COLOMBO Sguare  B9918 300xh810x270 хром/стекло матовое. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла', 'B9918', 0, 0, '', '', '', 'colombo-sguare-b9918-300xh810x270-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi-polotencederzhatel-dozator-zhidkogo-myla', '0000-00-00', '', '', '', NULL, NULL, 300, 810, 270, 'хром', '', 'стекло', 'матовое', '(ершик + держатель туалетной бумаги + полотенцедержатель + дозатор жидкого мыла', 8, '8ba0e242-bb0a-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(754, 6, 1, 0, 'COLOMBO Time  W4201 хром/стекло матовое. Мыльница настенная', 'W4201', 0, 0, '', '', '', 'colombo-time-w4201-hrom-steklo-matovoe-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e244-bb0a-11e3-8836-0011951d1b08', 'Мыльница настенная'),
(755, 6, 1, 0, 'COLOMBO Time  W4202 хром/стекло матовое. Стакан настенный', 'W4202', 0, 0, '', '', '', 'colombo-time-w4202-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e246-bb0a-11e3-8836-0011951d1b08', 'Стакан настенный'),
(756, 6, 1, 0, 'COLOMBO Time  W4280 хром/стекло матовое. Дозатор жидкого мыла настенный', 'W4280', 0, 0, '', '', '', 'colombo-time-w4280-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e247-bb0a-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(757, 6, 1, 0, 'COLOMBO Time  W4272 хром/стекло матовое. Мыльница + стакан настенные', 'W4272', 0, 0, '', '', '', 'colombo-time-w4272-hrom-steklo-matovoe-mylnica-stakan-nastennye', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e248-bb0a-11e3-8836-0011951d1b08', 'Мыльница + стакан настенные'),
(758, 6, 1, 0, 'COLOMBO Time  W4271 хром/стекло матовое. Стакан + дозатор для жидкого мыла настенные', 'W4271', 0, 0, '', '', '', 'colombo-time-w4271-hrom-steklo-matovoe-stakan-dozator-dlya-zhidkogo-myla-nastennye', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e249-bb0a-11e3-8836-0011951d1b08', 'Стакан + дозатор для жидкого мыла настенные'),
(759, 6, 1, 0, 'COLOMBO Time  W4216 600xh15x110 хром/стекло матовое. Полка настенная', 'W4216', 0, 0, '', '', '', 'colombo-time-w4216-600xh15x110-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 600, 15, 110, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e24b-bb0a-11e3-8836-0011951d1b08', 'Полка настенная'),
(760, 6, 1, 0, 'COLOMBO Time  W4274 300xh170x80 хром/стекло матовое. Дозатор жидкого мыла + полотенцедержатель настенные', 'W4274', 0, 0, '', '', '', 'colombo-time-w4274-300xh170x80-hrom-steklo-matovoe-dozator-zhidkogo-myla-polotencederzhatel-nastennye', '0000-00-00', '', '', '', NULL, NULL, 300, 170, 80, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e24c-bb0a-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла + полотенцедержатель настенные'),
(761, 6, 1, 0, 'COLOMBO Time  W4209 300 хром. Полотенцедержатель настенный', 'W4209', 0, 0, '', '', '', 'colombo-time-w4209-300-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 300, 0, 0, 'хром', '', '', '', '', 8, '8ba0e24d-bb0a-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(762, 6, 1, 0, 'COLOMBO Time  W4210 450 хром. Полотенцедержатель настенный', 'W4210', 0, 0, '', '', '', 'colombo-time-w4210-450-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 450, 0, 0, 'хром', '', '', '', '', 8, '8ba0e24e-bb0a-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(763, 6, 1, 0, 'COLOMBO Time  W4211 600 хром. Полотенцедержатель настенный', 'W4211', 0, 0, '', '', '', 'colombo-time-w4211-600-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 600, 0, 0, 'хром', '', '', '', '', 8, '8ba0e24f-bb0a-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(764, 6, 1, 0, 'COLOMBO Time  W4212 250 хром. Полотенцедержатель настенный', 'W4212', 0, 0, '', '', '', 'colombo-time-w4212-250-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 250, 0, 0, 'хром', '', '', '', '', 8, '8ba0e250-bb0a-11e3-8836-0011951d1b08', 'Полотенцедержатель настенный'),
(765, 6, 1, 0, 'COLOMBO Time  W4208 хром. Держатель туалетной бумаги настенный', 'W4208', 0, 0, '', '', '', 'colombo-time-w4208-hrom-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '8ba0e251-bb0a-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(766, 6, 1, 0, 'COLOMBO Time  W4291 хром. Держатель туалетной бумаги настенный с крышкой', 'W4291', 0, 0, '', '', '', 'colombo-time-w4291-hrom-derzhatel-tualetnoj-bumagi-nastennyj-s-kryshkoj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'с крышкой', 8, '8ba0e252-bb0a-11e3-8836-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(767, 6, 1, 0, 'COLOMBO Time  W4206 хром/стекло матовое. Ершик туалетный напольный', 'W4206', 0, 0, '', '', '', 'colombo-time-w4206-hrom-steklo-matovoe-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e253-bb0a-11e3-8836-0011951d1b08', 'Ершик туалетный напольный'),
(768, 6, 1, 0, 'COLOMBO Time  W4207 хром/стекло матовое. Ершик туалетный настенный', 'W4207', 0, 0, '', '', '', 'colombo-time-w4207-hrom-steklo-matovoe-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e254-bb0a-11e3-8836-0011951d1b08', 'Ершик туалетный настенный'),
(769, 6, 1, 0, 'COLOMBO Time  W4275 415xh65x105 хром. Полка с крючками', 'W4275', 0, 0, '', '', '', 'colombo-time-w4275-415xh65x105-hrom-polka-s-kryuchkami', '0000-00-00', '', '', '', NULL, NULL, 415, 65, 105, 'хром', '', '', '', '', 8, '8ba0e255-bb0a-11e3-8836-0011951d1b08', 'Полка с крючками');
INSERT INTO `products` (`id`, `manufacturer_id`, `is_active`, `sort`, `name`, `sku`, `price`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `description`, `is_new`, `is_special`, `width`, `height`, `depth`, `color`, `turn`, `material`, `finishing`, `shortdesc`, `parent_id`, `1c_id`, `shortname`) VALUES
(770, 6, 1, 0, 'COLOMBO Time  W4276DX 445xh850x105 хром, правый. Полка + полотенцедержатель + держатель туалетной бумаги', 'W4276DX', 0, 0, '', '', '', 'colombo-time-w4276dx-445xh850x105-hrom-pravyj-polka-polotencederzhatel-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 445, 850, 105, 'хром', 'правый', '', '', '', 8, '8ba0e257-bb0a-11e3-8836-0011951d1b08', 'Полка + полотенцедержатель + держатель туалетной бумаги'),
(771, 6, 1, 0, 'COLOMBO Time  W4277 445xh850x105 хром. Полка с полотенцедержателем', 'W4277', 0, 0, '', '', '', 'colombo-time-w4277-445xh850x105-hrom-polka-s-polotencederzhatelem', '0000-00-00', '', '', '', NULL, NULL, 445, 850, 105, 'хром', '', '', '', '', 8, '8ba0e25a-bb0a-11e3-8836-0011951d1b08', 'Полка с полотенцедержателем'),
(772, 6, 1, 0, 'COLOMBO Time (Appenditutto) W4217 хром. Крючок настенный', 'W4217', 0, 0, '', '', '', 'colombo-time-appenditutto-w4217-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '8ba0e25b-bb0a-11e3-8836-0011951d1b08', 'Крючок настенный'),
(773, 6, 1, 0, 'COLOMBO Time (Appenditutto) W4227 хром. Крючок настенный', 'W4227', 0, 0, '', '', '', 'colombo-time-appenditutto-w4227-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '8ba0e25c-bb0a-11e3-8836-0011951d1b08', 'Крючок настенный'),
(774, 6, 1, 0, 'COLOMBO Time (Appenditutto) W4237 310 хром. Крючок настенный', 'W4237', 0, 0, '', '', '', 'colombo-time-appenditutto-w4237-310-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 310, 0, 0, 'хром', '', '', '', '', 8, '8ba0e25d-bb0a-11e3-8836-0011951d1b08', 'Крючок настенный'),
(775, 6, 1, 0, 'COLOMBO Time (Appenditutto) W4247 хром. Крючок настенный', 'W4247', 0, 0, '', '', '', 'colombo-time-appenditutto-w4247-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '8ba0e25e-bb0a-11e3-8836-0011951d1b08', 'Крючок настенный'),
(776, 6, 1, 0, 'COLOMBO Time (Appenditutto) W4257 170 хром. Крючок настенный тройной', 'W4257', 0, 0, '', '', '', 'colombo-time-appenditutto-w4257-170-hrom-kryuchok-nastennyj-trojnoj', '0000-00-00', '', '', '', NULL, NULL, 170, 0, 0, 'хром', '', '', '', 'тройной', 8, '8ba0e25f-bb0a-11e3-8836-0011951d1b08', 'Крючок настенный'),
(777, 6, 1, 0, 'COLOMBO Time (Oggettistica) W4240 хром/стекло матовое. Мыльница настольная', 'W4240', 0, 0, '', '', '', 'colombo-time-oggettistica-w4240-hrom-steklo-matovoe-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e260-bb0a-11e3-8836-0011951d1b08', 'Мыльница настольная'),
(778, 6, 1, 0, 'COLOMBO Time (Oggettistica) W4241 хром/стекло матовое. Стакан настольный', 'W4241', 0, 0, '', '', '', 'colombo-time-oggettistica-w4241-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e261-bb0a-11e3-8836-0011951d1b08', 'Стакан настольный'),
(779, 6, 1, 0, 'COLOMBO Time (Oggettistica) W4281 хром/стекло матовое. Дозатор жидкого мыла настольный', 'W4281', 0, 0, '', '', '', 'colombo-time-oggettistica-w4281-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '8ba0e262-bb0a-11e3-8836-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(780, 6, 1, 0, 'COLOMBO Units  B9103 365xh860x140 хром. Полотенцедержатель напольный двойной поворотный', 'B9103', 0, 0, '', '', '', 'colombo-units-b9103-365xh860x140-hrom-polotencederzhatel-napolnyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 365, 860, 140, 'хром', '', '', '', 'двойной поворотный', 8, '8ba0e267-bb0a-11e3-8836-0011951d1b08', 'Полотенцедержатель напольный'),
(781, 6, 1, 0, 'COLOMBO Units  B9107D 210xh660x240 хром, правый. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги)', 'B9107D', 0, 0, '', '', '', 'colombo-units-b9107d-210xh660x240-hrom-pravyj-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 210, 660, 240, 'хром', 'правый', '', '', '(ершик + держатель туалетной бумаги)', 8, '8ba0e269-bb0a-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(782, 6, 1, 0, 'COLOMBO Units  B9110 365xh830x245 хром/стекло матовое. Стойка с аксессуарами напольная (мыльница + стакан + полотенцедержатель)', 'B9110', 0, 0, '', '', '', 'colombo-units-b9110-365xh830x245-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-mylnica-stakan-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 365, 830, 245, 'хром', '', 'стекло', 'матовое', '(мыльница + стакан + полотенцедержатель)', 8, '8ba0e26b-bb0a-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(783, 6, 1, 0, 'COLOMBO Units  B9111 365xh830x190 хром/стекло матовое. Стойка с аксессуарами напольная (дозатор жидкого мыла + стакан + полотенцедержатель)', 'B9111', 0, 0, '', '', '', 'colombo-units-b9111-365xh830x190-hrom-steklo-matovoe-stojka-s-aksessuarami-napolnaya-dozator-zhidkogo-myla-stakan-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 365, 830, 190, 'хром', '', 'стекло', 'матовое', '(дозатор жидкого мыла + стакан + полотенцедержатель)', 8, '8ba0e26d-bb0a-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(784, 6, 1, 0, 'COLOMBO Units  B9113D 295xh830x220 хром/стекло матовое, правый. Стойка с аксессуарами напольная (мыльница + держатель туалетной бумаги + полотенцедержатель)', 'B9113D', 0, 0, '', '', '', 'colombo-units-b9113d-295xh830x220-hrom-steklo-matovoe-pravyj-stojka-s-aksessuarami-napolnaya-mylnica-derzhatel-tualetnoj-bumagi-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 295, 830, 220, 'хром', 'правый', 'стекло', 'матовое', '(мыльница + держатель туалетной бумаги + полотенцедержатель)', 8, '8ba0e26f-bb0a-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(785, 6, 1, 0, 'COLOMBO Units  B9119D 295xh830x210 хром/стекло матовое, правый. Стойка с аксессуарами напольная (дозатор жидкого мыла + держатель туалетной бумаги + полотенцедержатель)', 'B9119D', 0, 0, '', '', '', 'colombo-units-b9119d-295xh830x210-hrom-steklo-matovoe-pravyj-stojka-s-aksessuarami-napolnaya-dozator-zhidkogo-myla-derzhatel-tualetnoj-bumagi-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 295, 830, 210, 'хром', 'правый', 'стекло', 'матовое', '(дозатор жидкого мыла + держатель туалетной бумаги + полотенцедержатель)', 8, '8ba0e272-bb0a-11e3-8836-0011951d1b08', 'Стойка с аксессуарами напольная'),
(786, 6, 1, 0, 'COLOMBO Units  B9120S 470xh300x110 хром/стекло матовое, левый. Штанга с аксессуарами настенная (мыльница + стакан + полотенцедержатель)', 'B9120S', 0, 0, '', '', '', 'colombo-units-b9120s-470xh300x110-hrom-steklo-matovoe-levyj-shtanga-s-aksessuarami-nastennaya-mylnica-stakan-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 470, 300, 110, 'хром', 'левый', 'стекло', 'матовое', '(мыльница + стакан + полотенцедержатель)', 8, '8ba0e277-bb0a-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(787, 6, 1, 0, 'COLOMBO Units  B9121D 415xh325x120 хром/стекло матовое, правый. Штанга с аксессуарами настенная (дозатор жидкого мыла + стакан + полотенцедержатель)', 'B9121D', 0, 0, '', '', '', 'colombo-units-b9121d-415xh325x120-hrom-steklo-matovoe-pravyj-shtanga-s-aksessuarami-nastennaya-dozator-zhidkogo-myla-stakan-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 415, 325, 120, 'хром', 'правый', 'стекло', 'матовое', '(дозатор жидкого мыла + стакан + полотенцедержатель)', 8, '8ba0e278-bb0a-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(788, 6, 1, 0, 'COLOMBO Units  B9122S 400xh300x110 хром/стекло матовое, левый. Штанга с аксессуарами настенная (мыльница + держатель туалетной бумаги + полотенцедержатель)', 'B9122S', 0, 0, '', '', '', 'colombo-units-b9122s-400xh300x110-hrom-steklo-matovoe-levyj-shtanga-s-aksessuarami-nastennaya-mylnica-derzhatel-tualetnoj-bumagi-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 400, 300, 110, 'хром', 'левый', 'стекло', 'матовое', '(мыльница + держатель туалетной бумаги + полотенцедержатель)', 8, '8ba0e27d-bb0a-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(789, 6, 1, 0, 'COLOMBO Units  B9123D 180xh485x165 хром, правый. Штанга с аксессуарами настенная (ершик + держатель туалетной бумаги)', 'B9123D', 0, 0, '', '', '', 'colombo-units-b9123d-180xh485x165-hrom-pravyj-shtanga-s-aksessuarami-nastennaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 180, 485, 165, 'хром', 'правый', '', '', '(ершик + держатель туалетной бумаги)', 8, '8ba0e27e-bb0a-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(790, 6, 1, 0, 'COLOMBO Units  B9124D 390xh325x120 хром/стекло матовое, правый. Штанга с аксессуарами настенная (дозатор жидкого мыла + держатель туалетной бумаги + полотенцедержатель)', 'B9124D', 0, 0, '', '', '', 'colombo-units-b9124d-390xh325x120-hrom-steklo-matovoe-pravyj-shtanga-s-aksessuarami-nastennaya-dozator-zhidkogo-myla-derzhatel-tualetnoj-bumagi-polotencederzhatel', '0000-00-00', '', '', '', NULL, NULL, 390, 325, 120, 'хром', 'правый', 'стекло', 'матовое', '(дозатор жидкого мыла + держатель туалетной бумаги + полотенцедержатель)', 8, '8ba0e280-bb0a-11e3-8836-0011951d1b08', 'Штанга с аксессуарами настенная'),
(791, 6, 1, 0, 'COLOMBO Complementi  B9608 290xh80x125 хром. Полка-сетка настенная угловая', 'B9608', 0, 0, '', '', '', 'colombo-complementi-b9608-290xh80x125-hrom-polka-setka-nastennaya-uglovaya', '0000-00-00', '', '', '', NULL, NULL, 290, 80, 125, 'хром', '', '', '', 'угловая', 8, '416be9cf-bb14-11e3-8836-0011951d1b08', 'Полка-сетка настенная'),
(792, 6, 1, 0, 'COLOMBO Complementi  B9602 180xh80x180 хром. Полка-сетка настенная угловая + крючок', 'B9602', 0, 0, '', '', '', 'colombo-complementi-b9602-180xh80x180-hrom-polka-setka-nastennaya-uglovaya-kryuchok', '0000-00-00', '', '', '', NULL, NULL, 180, 80, 180, 'хром', '', '', '', 'угловая + крючок', 8, '416be9d6-bb14-11e3-8836-0011951d1b08', 'Полка-сетка настенная'),
(793, 6, 1, 0, 'COLOMBO Complementi  B9607 290xh290x245 хром. Полка-сетка настенная угловая двойная', 'B9607', 0, 0, '', '', '', 'colombo-complementi-b9607-290xh290x245-hrom-polka-setka-nastennaya-uglovaya-dvojnaya', '0000-00-00', '', '', '', NULL, NULL, 290, 290, 245, 'хром', '', '', '', 'угловая двойная', 8, '416be9da-bb14-11e3-8836-0011951d1b08', 'Полка-сетка настенная'),
(794, 6, 1, 0, 'COLOMBO Complementi  B9601 180xh300x180 хром/керамика белый. Полка-сетка настенная угловая двойная + крючок', 'B9601', 0, 0, '', '', '', 'colombo-complementi-b9601-180xh300x180-hrom-keramika-belyj-polka-setka-nastennaya-uglovaya-dvojnaya-kryuchok', '0000-00-00', '', '', '', NULL, NULL, 180, 300, 180, 'хром', '', 'керамика', 'белый', 'угловая двойная + крючок', 8, '416be9e1-bb14-11e3-8836-0011951d1b08', 'Полка-сетка настенная'),
(795, 6, 1, 0, 'COLOMBO Complementi  B9631 200xh50x110 хром. Полка-сетка настенная', 'B9631', 0, 0, '', '', '', 'colombo-complementi-b9631-200xh50x110-hrom-polka-setka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 200, 50, 110, 'хром', '', '', '', '', 8, '416be9e3-bb14-11e3-8836-0011951d1b08', 'Полка-сетка настенная'),
(796, 6, 1, 0, 'COLOMBO Complementi  B9634 270xh690x195 хром. Полка-сетка на душевую перегородку двойная + крючки', 'B9634', 0, 0, '', '', '', 'colombo-complementi-b9634-270xh690x195-hrom-polka-setka-na-dushevuyu-peregorodku-dvojnaya-kryuchki', '0000-00-00', '', '', '', NULL, NULL, 270, 690, 195, 'хром', '', '', '', 'двойная + крючки', 8, '416be9e6-bb14-11e3-8836-0011951d1b08', 'Полка-сетка на душевую перегородку'),
(797, 6, 1, 0, 'COLOMBO Complementi  B9635 260xh690x200 хром. Полка-сетка на душевую перегородку двойная + крючки', 'B9635', 0, 0, '', '', '', 'colombo-complementi-b9635-260xh690x200-hrom-polka-setka-na-dushevuyu-peregorodku-dvojnaya-kryuchki', '0000-00-00', '', '', '', NULL, NULL, 260, 690, 200, 'хром', '', '', '', 'двойная + крючки', 8, '416be9e8-bb14-11e3-8836-0011951d1b08', 'Полка-сетка на душевую перегородку'),
(798, 6, 1, 0, 'COLOMBO Complementi  B9710 315xh505x350 хром. Полка на душевую перегородку двойная, поворотная', 'B9710', 0, 0, '', '', '', 'colombo-complementi-b9710-315xh505x350-hrom-polka-na-dushevuyu-peregorodku-dvojnaya-povorotnaya', '0000-00-00', '', '', '', NULL, NULL, 315, 505, 350, 'хром', '', '', '', 'двойная, поворотная', 8, '416be9ea-bb14-11e3-8836-0011951d1b08', 'Полка на душевую перегородку'),
(799, 6, 1, 0, 'COLOMBO Complementi  B9720 305 хром. Ручка для ванной', 'B9720', 0, 0, '', '', '', 'colombo-complementi-b9720-305-hrom-ruchka-dlya-vannoj', '0000-00-00', '', '', '', NULL, NULL, 305, 0, 0, 'хром', '', '', '', '', 8, '50813dba-bb25-11e3-8836-0011951d1b08', 'Ручка для ванной'),
(800, 6, 1, 0, 'COLOMBO Complementi  B9993 180xh570 белый. Фен для ванной', 'B9993', 0, 0, '', '', '', 'colombo-complementi-b9993-180xh570-belyj-fen-dlya-vannoj', '0000-00-00', '', '', '', NULL, NULL, 180, 570, 0, 'белый', '', '', '', '', 15, '50813dd6-bb25-11e3-8836-0011951d1b08', 'Фен для ванной'),
(801, 6, 1, 0, 'COLOMBO Complementi  B9994 280xh280 черный. Фен для ванной', 'B9994', 0, 0, '', '', '', 'colombo-complementi-b9994-280xh280-chernyj-fen-dlya-vannoj', '0000-00-00', '', '', '', NULL, NULL, 280, 280, 0, 'черный', '', '', '', '', 15, '50813ddb-bb25-11e3-8836-0011951d1b08', 'Фен для ванной'),
(802, 6, 1, 0, 'COLOMBO Complementi  B9995 200xh220 белый. Фен для ванной', 'B9995', 0, 0, '', '', '', 'colombo-complementi-b9995-200xh220-belyj-fen-dlya-vannoj', '0000-00-00', '', '', '', NULL, NULL, 200, 220, 0, 'белый', '', '', '', '', 15, '50813ddc-bb25-11e3-8836-0011951d1b08', 'Фен для ванной'),
(803, 6, 1, 0, 'COLOMBO Plus  B9957BI 250xh250x55 белый лакированный. Шкафчик для ключей с зеркалом круглый  (снято с производства 01.01.14)', 'B9957BI', 0, 0, '', '', '', 'colombo-plus-b9957bi-250xh250x55-belyj-lakirovannyj-shkafchik-dlya-klyuchej-s-zerkalom-kruglyj-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 250, 250, 55, 'белый', '', '', 'лакированный', 'круглый ', 8, '7b17ef76-be58-11e3-8a8f-0011951d1b08', 'Шкафчик для ключей с зеркалом'),
(804, 6, 1, 0, 'COLOMBO Plus  B9957NE 250xh250x55 черный лакированный. Шкафчик для ключей с зеркалом круглый  (снято с производства 01.01.14)', 'B9957NE', 0, 0, '', '', '', 'colombo-plus-b9957ne-250xh250x55-chernyj-lakirovannyj-shkafchik-dlya-klyuchej-s-zerkalom-kruglyj-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 250, 250, 55, 'черный', '', '', 'лакированный', 'круглый ', 8, '7b17ef78-be58-11e3-8a8f-0011951d1b08', 'Шкафчик для ключей с зеркалом'),
(805, 6, 1, 0, 'COLOMBO Alize  B2501DX хром/стекло матовое, правый. Мыльница настенная', 'B2501DX', 0, 0, '', '', '', 'colombo-alize-b2501dx-hrom-steklo-matovoe-pravyj-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', 'правый', 'стекло', 'матовое', '', 8, '48f646a9-aa1f-11e3-8b90-00e07de4ffa7', 'Мыльница настенная'),
(806, 6, 1, 0, 'COLOMBO Bart  B2210 450 хром. Полотенцедержатель настенный', 'B2210', 0, 0, '', '', '', 'colombo-bart-b2210-450-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 450, 0, 0, 'хром', '', '', '', '', 8, '4c35cfd6-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(807, 6, 1, 0, 'COLOMBO Bart  B2211 640 хром. Полотенцедержатель настенный', 'B2211', 0, 0, '', '', '', 'colombo-bart-b2211-640-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 640, 0, 0, 'хром', '', '', '', '', 8, '4c35cfd7-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(808, 6, 1, 0, 'COLOMBO Bart  B2212 345 хром. Полотенцедержатель настенный двойной, поворотный', 'B2212', 0, 0, '', '', '', 'colombo-bart-b2212-345-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 345, 0, 0, 'хром', '', '', '', 'двойной, поворотный', 8, '4c35cfd8-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(809, 6, 1, 0, 'COLOMBO Bart  B2213 335 хром. Полотенцедержатель настенный', 'B2213', 0, 0, '', '', '', 'colombo-bart-b2213-335-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 335, 'хром', '', '', '', '', 8, '4c35cfd9-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(810, 6, 1, 0, 'COLOMBO Bart  B2216 600xh65x135 хром/стекло матовое. Полка настенная', 'B2216', 0, 0, '', '', '', 'colombo-bart-b2216-600xh65x135-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 600, 65, 135, 'хром', '', 'стекло', 'матовое', '', 8, '4c35cfda-b3e9-11e3-a4fd-0011951d1b08', 'Полка настенная'),
(811, 6, 1, 0, 'COLOMBO Bart  B2231 250xh135x75 хром. Полотенцедержатель настенный кольцо', 'B2231', 0, 0, '', '', '', 'colombo-bart-b2231-250xh135x75-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 250, 135, 75, 'хром', '', '', '', 'кольцо', 8, '4c35cfdb-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(812, 6, 1, 0, 'COLOMBO Bart  B2281 хром. Мыльница настенная', 'B2281', 0, 0, '', '', '', 'colombo-bart-b2281-hrom-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '4c35cfdd-b3e9-11e3-a4fd-0011951d1b08', 'Мыльница настенная'),
(813, 6, 1, 0, 'COLOMBO Bart  B2288 450xh65x115 хром. Полотенцедержатель настенный двойной', 'B2288', 0, 0, '', '', '', 'colombo-bart-b2288-450xh65x115-hrom-polotencederzhatel-nastennyj-dvojnoj', '0000-00-00', '', '', '', NULL, NULL, 450, 65, 115, 'хром', '', '', '', 'двойной', 8, '4c35cfdf-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(814, 6, 1, 0, 'COLOMBO Bart  B2290 55xh175x100 хром. Держатель туалетной бумаги настенный для запасного рулона', 'B2290', 0, 0, '', '', '', 'colombo-bart-b2290-55xh175x100-hrom-derzhatel-tualetnoj-bumagi-nastennyj-dlya-zapasnogo-rulona', '0000-00-00', '', '', '', NULL, NULL, 55, 175, 100, 'хром', '', '', '', 'для запасного рулона', 8, '4c35cfe1-b3e9-11e3-a4fd-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(815, 6, 1, 0, 'COLOMBO Bart  B2291 175xh110x125 хром. Держатель туалетной бумаги настенный с крышкой', 'B2291', 0, 0, '', '', '', 'colombo-bart-b2291-175xh110x125-hrom-derzhatel-tualetnoj-bumagi-nastennyj-s-kryshkoj', '0000-00-00', '', '', '', NULL, NULL, 175, 110, 125, 'хром', '', '', '', 'с крышкой', 8, '4c35cfe3-b3e9-11e3-a4fd-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(816, 6, 1, 0, 'COLOMBO Bart  B2295 хром. Открывашка для бутылок настенная', 'B2295', 0, 0, '', '', '', 'colombo-bart-b2295-hrom-otkryvashka-dlya-butylok-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '4c35cfe5-b3e9-11e3-a4fd-0011951d1b08', 'Открывашка для бутылок настенная'),
(817, 6, 1, 0, 'COLOMBO Bart  B9308 хром/стекло матовое. Дозатор жидкого мыла настенный 0,25 л', 'B9308', 0, 0, '', '', '', 'colombo-bart-b9308-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastennyj-0-25-l', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '0,25 л', 8, '4c35cfe7-b3e9-11e3-a4fd-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(818, 6, 1, 0, 'COLOMBO Bart (Appenditutto) CB57 хром. Крючок настенный', 'CB57', 0, 0, '', '', '', 'colombo-bart-appenditutto-cb57-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '4c35cfeb-b3e9-11e3-a4fd-0011951d1b08', 'Крючок настенный'),
(819, 6, 1, 0, 'COLOMBO Bart (Appenditutto) CB67 хром. Крючок настенный двойной', 'CB67', 0, 0, '', '', '', 'colombo-bart-appenditutto-cb67-hrom-kryuchok-nastennyj-dvojnoj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'двойной', 8, '4c35cfec-b3e9-11e3-a4fd-0011951d1b08', 'Крючок настенный'),
(820, 6, 1, 0, 'COLOMBO Bart (Oggettistica) B9307 хром/стекло матовое. Дозатор жидкого мыла настольный 0,25 л', 'B9307', 0, 0, '', '', '', 'colombo-bart-oggettistica-b9307-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj-0-25-l', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '0,25 л', 8, '4c35cfed-b3e9-11e3-a4fd-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(821, 6, 1, 0, 'COLOMBO Basic  B2701 хром/стекло матовое. Мыльница настенная', 'B2701', 0, 0, '', '', '', 'colombo-basic-b2701-hrom-steklo-matovoe-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '4c35d005-b3e9-11e3-a4fd-0011951d1b08', 'Мыльница настенная'),
(822, 6, 1, 0, 'COLOMBO Basic  B2781 хром. Мыльница настенная', 'B2781', 0, 0, '', '', '', 'colombo-basic-b2781-hrom-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '4c35d006-b3e9-11e3-a4fd-0011951d1b08', 'Мыльница настенная'),
(823, 6, 1, 0, 'COLOMBO Basic  B2702 хром/стекло матовое. Стакан настенный', 'B2702', 0, 0, '', '', '', 'colombo-basic-b2702-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '4c35d007-b3e9-11e3-a4fd-0011951d1b08', 'Стакан настенный'),
(824, 6, 1, 0, 'COLOMBO Basic  B9332 хром/стекло матовое. Дозатор жидкого мыла настенный', 'B9332', 0, 0, '', '', '', 'colombo-basic-b9332-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '4c35d008-b3e9-11e3-a4fd-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(825, 6, 1, 0, 'COLOMBO Basic  B2716 600xh45x135 хром/стекло матовое. Полка настенная', 'B2716', 0, 0, '', '', '', 'colombo-basic-b2716-600xh45x135-hrom-steklo-matovoe-polka-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 600, 45, 135, 'хром', '', 'стекло', 'матовое', '', 8, '4c35d009-b3e9-11e3-a4fd-0011951d1b08', 'Полка настенная'),
(826, 6, 1, 0, 'COLOMBO Basic  B2717 хром. Крючок настенный', 'B2717', 0, 0, '', '', '', 'colombo-basic-b2717-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '4c35d00a-b3e9-11e3-a4fd-0011951d1b08', 'Крючок настенный'),
(827, 6, 1, 0, 'COLOMBO Basic  B2727 хром. Крючок настенный', 'B2727', 0, 0, '', '', '', 'colombo-basic-b2727-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '4c35d00b-b3e9-11e3-a4fd-0011951d1b08', 'Крючок настенный'),
(828, 6, 1, 0, 'COLOMBO Basic  B2731 250xh125x80 хром. Полотенцедержатель настенный кольцо', 'B2731', 0, 0, '', '', '', 'colombo-basic-b2731-250xh125x80-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 250, 125, 80, 'хром', '', '', '', 'кольцо', 8, '4c35d00c-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(829, 6, 1, 0, 'COLOMBO Basic  B2709 310 хром. Полотенцедержатель настенный', 'B2709', 0, 0, '', '', '', 'colombo-basic-b2709-310-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 310, 0, 0, 'хром', '', '', '', '', 8, '4c35d00d-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(830, 6, 1, 0, 'COLOMBO Basic  B2710 460 хром. Полотенцедержатель настенный', 'B2710', 0, 0, '', '', '', 'colombo-basic-b2710-460-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 460, 0, 0, 'хром', '', '', '', '', 8, '4c35d00e-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(831, 6, 1, 0, 'COLOMBO Basic  B2711 645 хром. Полотенцедержатель настенный', 'B2711', 0, 0, '', '', '', 'colombo-basic-b2711-645-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 645, 0, 0, 'хром', '', '', '', '', 8, '4c35d00f-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(832, 6, 1, 0, 'COLOMBO Basic  B2712 345 хром. Полотенцедержатель настенный двойной, поворотный', 'B2712', 0, 0, '', '', '', 'colombo-basic-b2712-345-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 345, 0, 0, 'хром', '', '', '', 'двойной, поворотный', 8, '4c35d010-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(833, 6, 1, 0, 'COLOMBO Basic  B2788 460 хром. Полотенцедержатель настенный двойной', 'B2788', 0, 0, '', '', '', 'colombo-basic-b2788-460-hrom-polotencederzhatel-nastennyj-dvojnoj', '0000-00-00', '', '', '', NULL, NULL, 460, 0, 0, 'хром', '', '', '', 'двойной', 8, '4c35d011-b3e9-11e3-a4fd-0011951d1b08', 'Полотенцедержатель настенный'),
(834, 6, 1, 0, 'COLOMBO Basic  B2708 хром. Держатель запасного рулона туалетной бумаги', 'B2708', 0, 0, '', '', '', 'colombo-basic-b2708-hrom-derzhatel-zapasnogo-rulona-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '4c35d012-b3e9-11e3-a4fd-0011951d1b08', 'Держатель запасного рулона туалетной бумаги'),
(835, 6, 1, 0, 'COLOMBO Basic  B2790 хром. Держатель запасного рулона туалетной бумаги для запасного рулона', 'B2790', 0, 0, '', '', '', 'colombo-basic-b2790-hrom-derzhatel-zapasnogo-rulona-tualetnoj-bumagi-dlya-zapasnogo-rulona', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'для запасного рулона', 8, '4c35d014-b3e9-11e3-a4fd-0011951d1b08', 'Держатель запасного рулона туалетной бумаги'),
(836, 6, 1, 0, 'COLOMBO Basic  B2791 хром. Держатель запасного рулона туалетной бумаги с крышкой', 'B2791', 0, 0, '', '', '', 'colombo-basic-b2791-hrom-derzhatel-zapasnogo-rulona-tualetnoj-bumagi-s-kryshkoj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'с крышкой', 8, 'f26480a8-b409-11e3-a4fd-0011951d1b08', 'Держатель запасного рулона туалетной бумаги'),
(837, 6, 1, 0, 'COLOMBO Basic  B2706 хром. Ершик туалетный напольный', 'B2706', 0, 0, '', '', '', 'colombo-basic-b2706-hrom-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'f26480aa-b409-11e3-a4fd-0011951d1b08', 'Ершик туалетный напольный'),
(838, 6, 1, 0, 'COLOMBO Basic  B2707 хром. Ершик туалетный настенный', 'B2707', 0, 0, '', '', '', 'colombo-basic-b2707-hrom-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'f26480ab-b409-11e3-a4fd-0011951d1b08', 'Ершик туалетный настенный'),
(839, 6, 1, 0, 'COLOMBO Black & White  B9220 NE черный/эко кожа/стекло матовое. Мыльница настольная прямоугольная', 'B9220 NE', 0, 0, '', '', '', 'colombo-black-white-b9220-ne-chernyj-eko-kozha-steklo-matovoe-mylnica-nastolnaya-pryamougolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'черный', '', 'эко кожа/стекло', 'матовое', 'прямоугольная', 8, 'b357acff-b40e-11e3-a4fd-0011951d1b08', 'Мыльница настольная'),
(840, 6, 1, 0, 'COLOMBO Black & White  B9221 BI белый/эко кожа. Стакан настольный квадратный', 'B9221 BI', 0, 0, '', '', '', 'colombo-black-white-b9221-bi-belyj-eko-kozha-stakan-nastolnyj-kvadratnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'белый', '', 'эко кожа', '', 'квадратный', 8, 'b357ad01-b40e-11e3-a4fd-0011951d1b08', 'Стакан настольный'),
(841, 6, 1, 0, 'COLOMBO Black & White  B9222 NE черный/хром/эко кожа. Дозатор жидкого мыла настольный квадратный', 'B9222 NE', 0, 0, '', '', '', 'colombo-black-white-b9222-ne-chernyj-hrom-eko-kozha-dozator-zhidkogo-myla-nastolnyj-kvadratnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'черный/хром', '', 'эко кожа', '', 'квадратный', 8, 'b357ad08-b40e-11e3-a4fd-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(842, 6, 1, 0, 'COLOMBO Black & White  B9230 NE черный/эко кожа/стекло матовое. Мыльница настольная круглая', 'B9230 NE', 0, 0, '', '', '', 'colombo-black-white-b9230-ne-chernyj-eko-kozha-steklo-matovoe-mylnica-nastolnaya-kruglaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'черный', '', 'эко кожа/стекло', 'матовое', 'круглая', 8, 'b357ad0c-b40e-11e3-a4fd-0011951d1b08', 'Мыльница настольная'),
(843, 6, 1, 0, 'COLOMBO Black & White  B9231 NE черный/эко кожа. Стакан настольный круглый', 'B9231 NE', 0, 0, '', '', '', 'colombo-black-white-b9231-ne-chernyj-eko-kozha-stakan-nastolnyj-kruglyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'черный', '', 'эко кожа', '', 'круглый', 8, 'b357ad0f-b40e-11e3-a4fd-0011951d1b08', 'Стакан настольный'),
(844, 6, 1, 0, 'COLOMBO Black & White  B9232 BI белый/хром/эко кожа. Дозатор жидкого мыла настольный круглый', 'B9232 BI', 0, 0, '', '', '', 'colombo-black-white-b9232-bi-belyj-hrom-eko-kozha-dozator-zhidkogo-myla-nastolnyj-kruglyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'белый/хром', '', 'эко кожа', '', 'круглый', 8, 'b357ad10-b40e-11e3-a4fd-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(845, 6, 1, 0, 'COLOMBO Black & White  B9223 NE 150xh35x150 черный/эко кожа. Полка настольная квадратная', 'B9223 NE', 0, 0, '', '', '', 'colombo-black-white-b9223-ne-150xh35x150-chernyj-eko-kozha-polka-nastolnaya-kvadratnaya', '0000-00-00', '', '', '', NULL, NULL, 150, 35, 150, 'черный', '', 'эко кожа', '', 'квадратная', 8, 'b357ad16-b40e-11e3-a4fd-0011951d1b08', 'Полка настольная'),
(846, 6, 1, 0, 'COLOMBO Black & White  B9224 NE 160xh45x120 черный/эко кожа. Полка настольная прямоугольная', 'B9224 NE', 0, 0, '', '', '', 'colombo-black-white-b9224-ne-160xh45x120-chernyj-eko-kozha-polka-nastolnaya-pryamougolnaya', '0000-00-00', '', '', '', NULL, NULL, 160, 45, 120, 'черный', '', 'эко кожа', '', 'прямоугольная', 8, 'b357ad19-b40e-11e3-a4fd-0011951d1b08', 'Полка настольная'),
(847, 6, 1, 0, 'COLOMBO Black & White  B9225 BI 105xh100x105 белый/эко кожа. Контейнер для мелочей настольный квадратный', 'B9225 BI', 0, 0, '', '', '', 'colombo-black-white-b9225-bi-105xh100x105-belyj-eko-kozha-kontejner-dlya-melochej-nastolnyj-kvadratnyj', '0000-00-00', '', '', '', NULL, NULL, 105, 100, 105, 'белый', '', 'эко кожа', '', 'квадратный', 8, 'b357ad1b-b40e-11e3-a4fd-0011951d1b08', 'Контейнер для мелочей настольный'),
(848, 6, 1, 0, 'COLOMBO Black & White  B9234 BI 100xh95x100 белый/эко кожа. Контейнер для мелочей настольный круглый', 'B9234 BI', 0, 0, '', '', '', 'colombo-black-white-b9234-bi-100xh95x100-belyj-eko-kozha-kontejner-dlya-melochej-nastolnyj-kruglyj', '0000-00-00', '', '', '', NULL, NULL, 100, 95, 100, 'белый', '', 'эко кожа', '', 'круглый', 8, 'b357ad1f-b40e-11e3-a4fd-0011951d1b08', 'Контейнер для мелочей настольный'),
(849, 6, 1, 0, 'COLOMBO Black & White  B9226 NE 300xh35x160 черный/эко кожа. Полка настольная прямоугольная', 'B9226 NE', 0, 0, '', '', '', 'colombo-black-white-b9226-ne-300xh35x160-chernyj-eko-kozha-polka-nastolnaya-pryamougolnaya', '0000-00-00', '', '', '', NULL, NULL, 300, 35, 160, 'черный', '', 'эко кожа', '', 'прямоугольная', 8, 'b357ad23-b40e-11e3-a4fd-0011951d1b08', 'Полка настольная'),
(850, 6, 1, 0, 'COLOMBO Black & White  B9203 BI 250xh90x140 белый/эко кожа. Диспенсер салфеток настольный прямоугольный', 'B9203 BI', 0, 0, '', '', '', 'colombo-black-white-b9203-bi-250xh90x140-belyj-eko-kozha-dispenser-salfetok-nastolnyj-pryamougolnyj', '0000-00-00', '', '', '', NULL, NULL, 250, 90, 140, 'белый', '', 'эко кожа', '', 'прямоугольный', 8, 'b357ad24-b40e-11e3-a4fd-0011951d1b08', 'Диспенсер салфеток настольный'),
(851, 6, 1, 0, 'COLOMBO Black & White  B9204 BI 140xh150x140 белый/эко кожа. Диспенсер салфеток настольный квадратный', 'B9204 BI', 0, 0, '', '', '', 'colombo-black-white-b9204-bi-140xh150x140-belyj-eko-kozha-dispenser-salfetok-nastolnyj-kvadratnyj', '0000-00-00', '', '', '', NULL, NULL, 140, 150, 140, 'белый', '', 'эко кожа', '', 'квадратный', 8, 'b357ad28-b40e-11e3-a4fd-0011951d1b08', 'Диспенсер салфеток настольный'),
(852, 6, 1, 0, 'COLOMBO Black & White  B9210 BI 160xh255x220 белый/эко кожа. Ведро для мусора с крышкой с педалью, квадратное, 3 л', 'B9210 BI', 0, 0, '', '', '', 'colombo-black-white-b9210-bi-160xh255x220-belyj-eko-kozha-vedro-dlya-musora-s-kryshkoj-s-pedalyu-kvadratnoe-3-l', '0000-00-00', '', '', '', NULL, NULL, 160, 255, 220, 'белый', '', 'эко кожа', '', 'с педалью, квадратное, 3 л', 8, 'b357ad2c-b40e-11e3-a4fd-0011951d1b08', 'Ведро для мусора с крышкой'),
(853, 6, 1, 0, 'COLOMBO Black & White  B9211BI 200xh275x260 белый/эко кожа. Ведро для мусора с крышкой с педалью, квадратное, 5 л', 'B9211BI', 0, 0, '', '', '', 'colombo-black-white-b9211bi-200xh275x260-belyj-eko-kozha-vedro-dlya-musora-s-kryshkoj-s-pedalyu-kvadratnoe-5-l', '0000-00-00', '', '', '', NULL, NULL, 200, 275, 260, 'белый', '', 'эко кожа', '', 'с педалью, квадратное, 5 л', 8, 'b357ad30-b40e-11e3-a4fd-0011951d1b08', 'Ведро для мусора с крышкой'),
(854, 6, 1, 0, 'COLOMBO Black & White  B9202 BI 250xh340x200 белый/эко кожа. Корзина', 'B9202 BI', 0, 0, '', '', '', 'colombo-black-white-b9202-bi-250xh340x200-belyj-eko-kozha-korzina', '0000-00-00', '', '', '', NULL, NULL, 250, 340, 200, 'белый', '', 'эко кожа', '', '', 8, 'b357ad33-b40e-11e3-a4fd-0011951d1b08', 'Корзина'),
(855, 6, 1, 0, 'COLOMBO Black & White  B9988 NE 370xh440x330 черный/эко кожа. Табурет 3 ножки', 'B9988 NE', 0, 0, '', '', '', 'colombo-black-white-b9988-ne-370xh440x330-chernyj-eko-kozha-taburet-3-nozhki', '0000-00-00', '', '', '', NULL, NULL, 370, 440, 330, 'черный', '', 'эко кожа', '', '3 ножки', 8, 'b357ad39-b40e-11e3-a4fd-0011951d1b08', 'Табурет'),
(856, 6, 1, 0, 'COLOMBO Black & White  B9201 BI 490xh600x290 белый/эко кожа. Корзина для белья с крышкой', 'B9201 BI', 0, 0, '', '', '', 'colombo-black-white-b9201-bi-490xh600x290-belyj-eko-kozha-korzina-dlya-belya-s-kryshkoj', '0000-00-00', '', '', '', NULL, NULL, 490, 600, 290, 'белый', '', 'эко кожа', '', 'с крышкой', 8, 'f0289352-b42b-11e3-a4fd-0011951d1b08', 'Корзина для белья'),
(857, 6, 1, 0, 'COLOMBO Black & White  B9233 NE 130xh45x130 черный/эко кожа. Полка настольная прямоугольная', 'B9233 NE', 0, 0, '', '', '', 'colombo-black-white-b9233-ne-130xh45x130-chernyj-eko-kozha-polka-nastolnaya-pryamougolnaya', '0000-00-00', '', '', '', NULL, NULL, 130, 45, 130, 'черный', '', 'эко кожа', '', 'прямоугольная', 8, 'f0289356-b42b-11e3-a4fd-0011951d1b08', 'Полка настольная'),
(858, 6, 1, 0, 'COLOMBO Gallery  B1320 90xh175x170 хром/стекло матовое. Светильник настенный', 'B1320', 0, 0, '', '', '', 'colombo-gallery-b1320-90xh175x170-hrom-steklo-matovoe-svetilnik-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 90, 175, 170, 'хром', '', 'стекло', 'матовое', '', 10, 'f0289369-b42b-11e3-a4fd-0011951d1b08', 'Светильник настенный'),
(859, 6, 1, 0, 'COLOMBO Melo  B1200 60xh60 хром. Накладка декоративная на крепление круглая', 'B1200', 0, 0, '', '', '', 'colombo-melo-b1200-60xh60-hrom-nakladka-dekorativnaya-na-kreplenie-kruglaya', '0000-00-00', '', '', '', NULL, NULL, 60, 60, 0, 'хром', '', '', '', 'круглая', 8, 'a2f33a7c-05c7-11e4-aeb8-0011951d1b08', 'Накладка декоративная на крепление'),
(860, 6, 1, 0, 'COLOMBO Alize (Oggettistica) B2540 хром. Мыльница настольная', 'B2540', 0, 0, '', '', '', 'colombo-alize-oggettistica-b2540-hrom-mylnica-nastolnaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '43c060ee-acf8-11e3-b0d2-0011951d1b08', 'Мыльница настольная'),
(861, 6, 1, 0, 'COLOMBO Alize  B2509 410 хром. Полотенцедержатель настенный', 'B2509', 0, 0, '', '', '', 'colombo-alize-b2509-410-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 410, 0, 0, 'хром', '', '', '', '', 8, '43c060f0-acf8-11e3-b0d2-0011951d1b08', 'Полотенцедержатель настенный'),
(862, 6, 1, 0, 'COLOMBO Alize  B2531 235xh140 хром. Полотенцедержатель настенный кольцо', 'B2531', 0, 0, '', '', '', 'colombo-alize-b2531-235xh140-hrom-polotencederzhatel-nastennyj-kolco', '0000-00-00', '', '', '', NULL, NULL, 235, 140, 0, 'хром', '', '', '', 'кольцо', 8, '43c060f3-acf8-11e3-b0d2-0011951d1b08', 'Полотенцедержатель настенный'),
(863, 6, 1, 0, 'COLOMBO Alize (Appenditutto) AR37 хром. Крючок настенный', 'AR37', 0, 0, '', '', '', 'colombo-alize-appenditutto-ar37-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '43c060f6-acf8-11e3-b0d2-0011951d1b08', 'Крючок настенный'),
(864, 6, 1, 0, 'COLOMBO Alize  B2508 хром. Держатель туалетной бумаги настенный', 'B2508', 0, 0, '', '', '', 'colombo-alize-b2508-hrom-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, '43c060f8-acf8-11e3-b0d2-0011951d1b08', 'Держатель туалетной бумаги настенный'),
(865, 6, 1, 0, 'COLOMBO Alize  B2506 хром/стекло матовое. Ершик туалетный напольный', 'B2506', 0, 0, '', '', '', 'colombo-alize-b2506-hrom-steklo-matovoe-ershik-tualetnyj-napolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '43c060fa-acf8-11e3-b0d2-0011951d1b08', 'Ершик туалетный напольный'),
(866, 6, 1, 0, 'COLOMBO Alize  B2512 380 хром. Полотенцедержатель настенный двойной, поворотный', 'B2512', 0, 0, '', '', '', 'colombo-alize-b2512-380-hrom-polotencederzhatel-nastennyj-dvojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 380, 0, 0, 'хром', '', '', '', 'двойной, поворотный', 8, '43c06100-acf8-11e3-b0d2-0011951d1b08', 'Полотенцедержатель настенный'),
(867, 6, 1, 0, 'COLOMBO Melo  B1235 275xh720x215 хром. Стойка с аксессуарами напольная (ершик + держатель туалетной бумаги)', 'B1235', 0, 0, '', '', '', 'colombo-melo-b1235-275xh720x215-hrom-stojka-s-aksessuarami-napolnaya-ershik-derzhatel-tualetnoj-bumagi', '0000-00-00', '', '', '', NULL, NULL, 275, 720, 215, 'хром', '', '', '', '(ершик + держатель туалетной бумаги)', 8, '43c0610d-acf8-11e3-b0d2-0011951d1b08', 'Стойка с аксессуарами напольная'),
(868, 6, 1, 0, 'COLOMBO Melo  B1287 700xh255x225 хром. Полотенцедержатель настенный большой', 'B1287', 0, 0, '', '', '', 'colombo-melo-b1287-700xh255x225-hrom-polotencederzhatel-nastennyj-bolshoj', '0000-00-00', '', '', '', NULL, NULL, 700, 255, 225, 'хром', '', '', '', 'большой', 8, '43c06111-acf8-11e3-b0d2-0011951d1b08', 'Полотенцедержатель настенный'),
(869, 6, 1, 0, 'COLOMBO Alize  B2502SX хром/стекло матовое, левый. Стакан настенный', 'B2502SX', 0, 0, '', '', '', 'colombo-alize-b2502sx-hrom-steklo-matovoe-levyj-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', 'левый', 'стекло', 'матовое', '', 8, '22b86a3d-ade3-11e3-b0d2-0011951d1b08', 'Стакан настенный'),
(870, 6, 1, 0, 'COLOMBO Alize  B9330SX хром/стекло матовое, левый. Дозатор жидкого мыла настенный', 'B9330SX', 0, 0, '', '', '', 'colombo-alize-b9330sx-hrom-steklo-matovoe-levyj-dozator-zhidkogo-myla-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', 'левый', 'стекло', 'матовое', '', 8, '22b86a3e-ade3-11e3-b0d2-0011951d1b08', 'Дозатор жидкого мыла настенный'),
(871, 6, 1, 0, 'COLOMBO Alize (Oggettistica) B2541 хром/стекло матовое. Стакан настольный', 'B2541', 0, 0, '', '', '', 'colombo-alize-oggettistica-b2541-hrom-steklo-matovoe-stakan-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '22b86a3f-ade3-11e3-b0d2-0011951d1b08', 'Стакан настольный'),
(872, 6, 1, 0, 'COLOMBO Alize (Oggettistica) B9331 хром/стекло матовое. Дозатор жидкого мыла настольный', 'B9331', 0, 0, '', '', '', 'colombo-alize-oggettistica-b9331-hrom-steklo-matovoe-dozator-zhidkogo-myla-nastolnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, '22b86a41-ade3-11e3-b0d2-0011951d1b08', 'Дозатор жидкого мыла настольный'),
(873, 6, 1, 0, 'COLOMBO Alize  B2510 560 хром. Полотенцедержатель настенный', 'B2510', 0, 0, '', '', '', 'colombo-alize-b2510-560-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 560, 0, 0, 'хром', '', '', '', '', 8, '22b86a43-ade3-11e3-b0d2-0011951d1b08', 'Полотенцедержатель настенный'),
(874, 6, 1, 0, 'COLOMBO Alize  B2511 710 хром. Полотенцедержатель настенный', 'B2511', 0, 0, '', '', '', 'colombo-alize-b2511-710-hrom-polotencederzhatel-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 710, 0, 0, 'хром', '', '', '', '', 8, '22b86a44-ade3-11e3-b0d2-0011951d1b08', 'Полотенцедержатель настенный'),
(875, 6, 1, 0, 'COLOMBO Alize  B2507DX хром/стекло матовое, правый. Ершик туалетный настенный', 'B2507DX', 0, 0, '', '', '', 'colombo-alize-b2507dx-hrom-steklo-matovoe-pravyj-ershik-tualetnyj-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', 'правый', 'стекло', 'матовое', '', 8, '22b86a45-ade3-11e3-b0d2-0011951d1b08', 'Ершик туалетный настенный'),
(876, 6, 1, 0, 'COLOMBO Appenditutto  AM17 хром. Крючок настенный двойной', 'AM17', 0, 0, '', '', '', 'colombo-appenditutto-am17-hrom-kryuchok-nastennyj-dvojnoj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'двойной', 8, 'b971de63-b279-11e3-bbd6-0011951d1b08', 'Крючок настенный'),
(877, 6, 1, 0, 'COLOMBO Appenditutto  AM27 65xh170x100 хром. Крючок настенный тройной', 'AM27', 0, 0, '', '', '', 'colombo-appenditutto-am27-65xh170x100-hrom-kryuchok-nastennyj-trojnoj', '0000-00-00', '', '', '', NULL, NULL, 65, 170, 100, 'хром', '', '', '', 'тройной', 8, 'b971de64-b279-11e3-bbd6-0011951d1b08', 'Крючок настенный');
INSERT INTO `products` (`id`, `manufacturer_id`, `is_active`, `sort`, `name`, `sku`, `price`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `description`, `is_new`, `is_special`, `width`, `height`, `depth`, `color`, `turn`, `material`, `finishing`, `shortdesc`, `parent_id`, `1c_id`, `shortname`) VALUES
(878, 6, 1, 0, 'COLOMBO Appenditutto (Viva) CB77 хром. Крючок настенный (снято с производства 01.01.14)', 'CB77', 0, 0, '', '', '', 'colombo-appenditutto-viva-cb77-hrom-kryuchok-nastennyj-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'b971de67-b279-11e3-bbd6-0011951d1b08', 'Крючок настенный'),
(879, 6, 1, 0, 'COLOMBO Appenditutto (Yoga) FL17 хром. Крючок настенный (снято с производства 01.01.14)', 'FL17', 0, 0, '', '', '', 'colombo-appenditutto-yoga-fl17-hrom-kryuchok-nastennyj-snyato-s-proizvodstva-01-01-14', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'b971de69-b279-11e3-bbd6-0011951d1b08', 'Крючок настенный'),
(880, 6, 1, 0, 'COLOMBO Bart  B2201 хром/стекло матовое. Мыльница настенная', 'B2201', 0, 0, '', '', '', 'colombo-bart-b2201-hrom-steklo-matovoe-mylnica-nastennaya', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'b971de6b-b279-11e3-bbd6-0011951d1b08', 'Мыльница настенная'),
(881, 6, 1, 0, 'COLOMBO Bart  B2202 хром/стекло матовое. Стакан настенный', 'B2202', 0, 0, '', '', '', 'colombo-bart-b2202-hrom-steklo-matovoe-stakan-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'стекло', 'матовое', '', 8, 'b971de6c-b279-11e3-bbd6-0011951d1b08', 'Стакан настенный'),
(882, 6, 1, 0, 'COLOMBO Appenditutto  FL27 хром. Крючок настенный тройной, поворотный', 'FL27', 0, 0, '', '', '', 'colombo-appenditutto-fl27-hrom-kryuchok-nastennyj-trojnoj-povorotnyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', 'тройной, поворотный', 8, 'd1609e46-b375-11e3-bbd6-0011951d1b08', 'Крючок настенный'),
(883, 6, 1, 0, 'COLOMBO Appenditutto  LC17 хром. Крючок настенный', 'LC17', 0, 0, '', '', '', 'colombo-appenditutto-lc17-hrom-kryuchok-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'd1609e47-b375-11e3-bbd6-0011951d1b08', 'Крючок настенный'),
(884, 6, 1, 0, 'COLOMBO Bart  B2203 450xh75x115 хром. Полка-сетка', 'B2203', 0, 0, '', '', '', 'colombo-bart-b2203-450xh75x115-hrom-polka-setka', '0000-00-00', '', '', '', NULL, NULL, 450, 75, 115, 'хром', '', '', '', '', 8, 'd1609e48-b375-11e3-bbd6-0011951d1b08', 'Полка-сетка настенная'),
(885, 6, 1, 0, 'COLOMBO Bart  B2206 хром/пластик белый. Ершик туалетный напольный (снято с производства 01.07.14)', 'B2206', 0, 0, '', '', '', 'colombo-bart-b2206-hrom-plastik-belyj-ershik-tualetnyj-napolnyj-snyato-s-proizvodstva-01-07-14', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'пластик', 'белый', '', 8, 'd1609e4a-b375-11e3-bbd6-0011951d1b08', 'Ершик туалетный напольный'),
(886, 6, 1, 0, 'COLOMBO Bart  B2207 хром/пластик белый. Ершик туалетный настенный (снято с производства 01.07.14)', 'B2207', 0, 0, '', '', '', 'colombo-bart-b2207-hrom-plastik-belyj-ershik-tualetnyj-nastennyj-snyato-s-proizvodstva-01-07-14', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', 'пластик', 'белый', '', 8, 'd1609e4d-b375-11e3-bbd6-0011951d1b08', 'Ершик туалетный настенный'),
(887, 6, 1, 0, 'COLOMBO Bart  B2208 хром. Держатель туалетной бумаги настенный', 'B2208', 0, 0, '', '', '', 'colombo-bart-b2208-hrom-derzhatel-tualetnoj-bumagi-nastennyj', '0000-00-00', '', '', '', NULL, NULL, 0, 0, 0, 'хром', '', '', '', '', 8, 'd1609e4e-b375-11e3-bbd6-0011951d1b08', 'Держатель туалетной бумаги настенный');

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
  `site_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `order_string` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastmod` date NOT NULL,
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

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `order_string`, `site_description`, `site_keywords`, `lastmod`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`) VALUES
(1, 'Пробный сайт', 'admin@admin.ru', 'admin', 'Ваш заказ оформлен', '', '', '2015-03-06', 0, '', 2, 6, 1);

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '8-950-123-45', '', 0, 'f556de45badbca0264ee68f418a42265');

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
