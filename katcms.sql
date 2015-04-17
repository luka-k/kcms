-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 17 2015 г., 09:19
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `parent_id`, `name`, `date`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`, `lastmod`, `changefreq`, `priority`) VALUES
(1, 0, 'Блог', '0000-00-00', 0, '', '', '', '', 'blog', '2015-04-16', '', '0.1'),
(3, 0, 'Новости', '0000-00-00', 0, '', '', '', '', 'novosti', '0000-00-00', '', ''),
(5, 3, 'Первая новость', '2015-01-01', 0, '<p>Текст первой новости</p>\r\n', '', '', '', 'pervaya-novost', '2015-04-06', '', '0.1'),
(6, 3, 'Вторая новость', '2015-04-06', 0, '<p>Текст второй новости</p>\r\n', '', '', '', 'vtoraya-novost', '2015-04-06', '', '0.1'),
(8, 0, 'Контакты', '0000-00-00', 0, '', '', '', '', 'kontakty', '0000-00-00', '', ''),
(9, 0, 'Статья с огромным на', '2015-03-17', 0, '', '', '', '', 'statya-s-ogromnym-nazvaniem-nu-prosto-ogromnejshim-nazvaniem-dlya-proverki-redaktora-menyu-da-i-voobshe-malo-li-gde-prigoditsya-statya-s-ogromnym-nazvaniem', '2015-03-17', '', '0.1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `parent_id`, `description`) VALUES
(1, 1, 0, 'Шины', '', '', '', 'shiny', '2015-04-06', '', '0.1', 0, ''),
(2, 1, 0, 'Диски', '', '', '', 'diski', '2015-04-06', '', '0.1', 0, ''),
(3, 1, 0, 'Аксессуары', '', '', '', 'aksessuary', '2015-04-06', '', '0.1', 0, ''),
(4, 1, 0, 'Легковые', '', '', '', 'legkovye', '2015-04-06', '', '0.1', 1, ''),
(5, 1, 0, 'Грузовые', '', '', '', 'gruzovye', '2015-04-06', '', '0.1', 1, ''),
(8, 1, 0, 'Штампованные', '', '', '', 'shtampovanye', '2015-04-06', '', '0.1', 2, ''),
(9, 1, 0, 'Легкосплавные', '', '', '', 'legkosplavnye', '2015-04-06', '', '0.1', 2, ''),
(10, 1, 0, 'Насосы', '', '', '', 'nasosy', '2015-04-06', '', '0.1', 3, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`id`, `type`, `value`, `object_type`, `object_id`) VALUES
(14, 'diametr', '14', 'products', 1),
(15, 'diametr', '16', 'products', 1),
(16, 'diametr', '14', 'products', 2),
(17, 'cvet', 'Черный', 'products', 2),
(18, 'diametr', '24', 'products', 7);

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
(1, 'Цвет', 0, 'cvet', 'text'),
(2, 'Диаметр', 0, 'diametr', 'multy');

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
('313b13decb14f18b4a5e98fdd69a9a5e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', 1429194041, 'a:5:{s:9:"user_data";s:0:"";s:13:"cart_contents";a:3:{s:5:"items";a:3:{s:32:"c4ca4238a0b923820dcc509a6f75849b";a:7:{s:2:"id";s:1:"1";s:9:"parent_id";s:1:"4";s:4:"name";s:13:"Шина №1";s:3:"url";s:7:"shina-1";s:5:"price";s:4:"3000";s:3:"qty";i:5;s:10:"item_total";i:15000;}s:32:"eccbc87e4b5ce2fe28308fd9f2a7baf3";a:7:{s:2:"id";s:1:"3";s:9:"parent_id";s:1:"4";s:4:"name";s:13:"Шина №3";s:3:"url";s:7:"shina-3";s:5:"price";s:4:"3400";s:3:"qty";i:9;s:10:"item_total";i:30600;}s:32:"8f14e45fceea167a5a36dedd4bea2543";a:7:{s:2:"id";s:1:"7";s:9:"parent_id";s:1:"5";s:4:"name";s:30:"Шина грузовая №1";s:3:"url";s:17:"shina-gruzovaya-1";s:5:"price";i:7040;s:3:"qty";i:3;s:10:"item_total";i:21120;}}s:9:"total_qty";i:17;s:10:"cart_total";i:66720;}s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:32:"f556de45badbca0264ee68f418a42265";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}'),
('6013e51e114dc28d69ff9d46ee272e61', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36', 1429190188, 'a:5:{s:9:"user_data";s:0:"";s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:32:"f556de45badbca0264ee68f418a42265";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}s:13:"cart_contents";a:3:{s:5:"items";a:0:{}s:10:"cart_total";s:0:"";s:9:"total_qty";s:0:"";}}'),
('794138aa3737288ddecc610e462b5883', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', 1429191314, 'a:5:{s:9:"user_data";s:0:"";s:13:"cart_contents";a:3:{s:5:"items";a:2:{s:32:"8f14e45fceea167a5a36dedd4bea2543";a:7:{s:2:"id";s:1:"7";s:9:"parent_id";s:1:"5";s:4:"name";s:30:"Шина грузовая №1";s:3:"url";s:17:"shina-gruzovaya-1";s:5:"price";i:7040;s:3:"qty";s:1:"4";s:10:"item_total";i:28160;}s:32:"c81e728d9d4c2f636f067f89cc14862c";a:7:{s:2:"id";s:1:"2";s:9:"parent_id";s:1:"4";s:4:"name";s:13:"Шина №2";s:3:"url";s:7:"shina-2";s:5:"price";s:4:"4000";s:3:"qty";s:1:"1";s:10:"item_total";i:4000;}}s:9:"total_qty";i:5;s:10:"cart_total";i:32160;}s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:32:"f556de45badbca0264ee68f418a42265";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}'),
('b1d6da126514b01f901af7be9b46a3f3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', 1429251237, ''),
('c8207c3a8dca9b836a2e03323421c59b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36', 1429193827, 'a:5:{s:9:"user_data";s:0:"";s:13:"cart_contents";a:3:{s:5:"items";a:0:{}s:9:"total_qty";i:0;s:10:"cart_total";i:0;}s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:32:"f556de45badbca0264ee68f418a42265";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}');

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
(1, 'Меню админ панели', ''),
(4, 'Верхнее меню', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

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
(7, 1, 'Востановление пароля', '<p>Для изменения пароля перейдите по <a href="%base_url%admin/registration/new_password?email=%user_email%&amp;secret=%secret%">ссылке</a></p>\r\n', 'Востановление пароля'),
(8, 2, 'Пробное письмо', 'Текст пробного письма\r\n', 'Пробное письмо');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=97 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `is_cover`, `object_type`, `object_id`, `image_type`, `url`) VALUES
(20, '', 1, 'settings', 1, '', '/n/o/no-photo-available.png'),
(85, '1212823312-image-1206444062-1', 1, 'products', 2, '', '/1/2/1212823312-image-1206444062-1.jpg'),
(86, '20-lm7-1076', 1, 'products', 1, '', '/2/0/20-lm7-1076.jpg'),
(87, 'images', 1, 'products', 3, '', '/i/m/images.jpg'),
(88, 'shiny-161460', 1, 'products', 4, '', '/s/h/shiny-161460.jpg'),
(89, 'zimnie-shiny-kontinental-4', 1, 'products', 5, '', '/z/i/zimnie-shiny-kontinental-4.jpg'),
(90, 'continental-vanco-winter-contact-2', 1, 'products', 6, '', '/c/o/continental-vanco-winter-contact-2.jpg'),
(91, 'image007', 1, 'products', 7, '', '/i/m/image007.jpg'),
(92, '94068', 1, 'products', 8, '', '/9/4/94068.jpg'),
(93, '82445', 1, 'products', 9, '', '/8/2/82445.jpg'),
(94, '2125803', 1, 'products', 10, '', '/2/1/2125803.png'),
(95, '52632871-1', 1, 'products', 11, '', '/5/2/52632871-1.jpg'),
(96, 'nasos-mm', 1, 'products', 12, '', '/n/a/nasos-mm.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(1, 4, 'Блог', 0, 1, '', 'articles', 'blog'),
(2, 4, 'Новости', 0, 0, '', 'articles', 'novosti'),
(4, 1, '<i class=icon-home></i>', 0, 2, '', 'link', 'admin/'),
(5, 1, 'Статьи', 0, 3, '', 'link', '#'),
(6, 1, 'Каталог', 0, 4, '', 'link', '#'),
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
(34, 4, 'Каталог', 0, 18, '', 'link', 'catalog/');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `user_name`, `user_email`, `user_phone`, `user_address`, `total`, `delivery_id`, `payment_id`, `date`, `status_id`) VALUES
(1, '5521471393232', '1', 'admin', 'admin@admin.ru', '8-950-123-45', '', 1000, 3, 1, '2015-04-05 00:00:00', 3),
(2, '552fa59f36732', '', 'admin', '', '8-950-123-45', '', 0, 0, 0, '2015-04-16 00:00:00', 1),
(5, '552fa6a2e3c49', '', 'Павел', '', '8-950-014-56-56', '', 3400, 0, 0, '2015-04-16 00:00:00', 1),
(6, '552fa6b1c933f', '', 'Павел', '', '8-950-014-56-56', '', 0, 0, 0, '2015-04-16 00:00:00', 1),
(7, '552fa829e4660', '', 'Павел', '', '345357467', '', 7040, 0, 0, '2015-04-16 00:00:00', 1),
(8, '552fb11d7a25d', '', 'Павел', '', '345357467', '', 0, 0, 0, '2015-04-16 00:00:00', 1),
(9, '552fb179bd343', '', 'admin', '', '8-950-123-45', '', 7040, 0, 0, '2015-04-16 00:00:00', 1),
(10, '552fb1e197b4f', '', 'admin', '', '8-950-123-45', '', 3400, 0, 0, '2015-04-16 00:00:00', 1),
(11, '552fb20db62a4', '', 'admin', '', '8-950-123-45', '', 3400, 0, 0, '2015-04-16 00:00:00', 1),
(12, '552fb26de06b2', '', 'admin', '', '8-950-123-45', '', 1500, 0, 0, '2015-04-16 00:00:00', 1),
(13, '552fb32d28de4', '', 'admin', '', '8-950-123-45', '', 0, 0, 0, '2015-04-16 00:00:00', 1),
(14, '552fb48732987', '', 'admin', '', '8-950-123-45', '', 7040, 0, 0, '2015-04-16 00:00:00', 1),
(15, '552fb4abebbaa', '', 'admin', '', '8-950-123-45', '', 0, 0, 0, '2015-04-16 00:00:00', 1),
(16, '552fb4e1253f3', '', 'admin', '', '8-950-123-45', '', 7040, 0, 0, '2015-04-16 00:00:00', 1),
(17, '552fb645923e6', '', 'admin', '', '8-950-123-45', '', 3000, 0, 0, '2015-04-16 00:00:00', 1),
(18, '552fb96c6f047', '', 'admin', '', '8-950-123-45', '', 3000, 0, 0, '2015-04-16 00:00:00', 1),
(19, '552fb99dbb393', '', 'admin', '', '8-950-123-45', '', 0, 0, 0, '2015-04-16 00:00:00', 1),
(20, '552fb9de54cd6', '', 'admin', '', '8-950-123-45', '', 10500, 0, 0, '2015-04-16 00:00:00', 1),
(21, '552fb9ed08584', '', 'admin', '', '8-950-123-45', '', 10500, 0, 0, '2015-04-16 00:00:00', 1),
(22, '552fb9f5cb744', '', 'admin', '', '8-950-123-45', '', 10500, 0, 0, '2015-04-16 00:00:00', 1),
(23, '552fba43a44e2', '', 'admin', '', '8-950-123-45', '', 10500, 0, 0, '2015-04-16 00:00:00', 1),
(24, '552fba982474a', '', 'admin', '', '8-950-123-45', '', 0, 0, 0, '2015-04-16 00:00:00', 1),
(25, '552fbad8e3083', '', 'admin', '', '8-950-123-45', '', 13500, 0, 0, '2015-04-16 00:00:00', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `order_qty`) VALUES
(1, '5521471393232', 20, 'Товар 4', '1000', 1),
(2, '552fa6a2e3c49', 3, 'Шина №3', '3400', 1),
(3, '552fa829e4660', 7, 'Шина грузовая №1', '7040', 1),
(4, '552fb179bd343', 7, 'Шина грузовая №1', '7040', 1),
(5, '552fb1e197b4f', 3, 'Шина №3', '3400', 1),
(6, '552fb20db62a4', 3, 'Шина №3', '3400', 1),
(7, '552fb26de06b2', 9, 'Диск штампованный №1', '1500', 1),
(8, '552fb48732987', 7, 'Шина грузовая №1', '7040', 1),
(9, '552fb4e1253f3', 7, 'Шина грузовая №1', '7040', 1),
(10, '552fb645923e6', 1, 'Шина №1', '3000', 1),
(11, '552fb96c6f047', 1, 'Шина №1', '3000', 1),
(12, '552fb9de54cd6', 1, 'Шина №1', '3000', 3),
(14, '552fb9ed08584', 1, 'Шина №1', '3000', 3),
(16, '552fb9f5cb744', 1, 'Шина №1', '3000', 3),
(18, '552fba43a44e2', 1, 'Шина №1', '3000', 3),
(19, '552fba43a44e2', 9, 'Диск штампованный №1', '1500', 1),
(20, '552fbad8e3083', 2, 'Шина №2', '4000', 3),
(21, '552fbad8e3083', 9, 'Диск штампованный №1', '1500', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `sort`, `name`, `article`, `price`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `description`, `is_new`, `is_special`) VALUES
(1, 4, 1, 0, 'Шина №1', '001sh', 3000, 0, '', '', '', 'shina-1', '2015-04-15', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;', 1, 1),
(2, 4, 1, 1, 'Шина №2', 'sh344', 4000, 0, '', '', '', 'shina-2', '2015-04-06', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;', 1, 0),
(3, 4, 1, 2, 'Шина №3', '023sh', 3400, 0, '', '', '', 'shina-3', '2015-04-06', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;', 0, 1),
(4, 4, 1, 3, 'Шина №4', 'sh453', 3345, 0, '', '', '', 'shina-4', '2015-04-06', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;', 0, 0),
(5, 4, 1, 4, 'Шина №6', 'sh445w', 4500, 0, '', '', '', 'shina-6', '2015-04-06', '', '0.1', '', 0, 0),
(6, 4, 1, 5, 'Шина №5', 'sh34w', 4200, 0, '', '', '', 'shina-5', '2015-04-06', '', '0.1', '&lt;p&gt;&lt;span style=&quot;color:rgb(0, 0, 0); font-family:arial,helvetica,sans; font-size:11px&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/span&gt;&lt;/p&gt;', 0, 0),
(7, 5, 1, 0, 'Шина грузовая №1', 'wg34', 8000, 12, '', '', '', 'shina-gruzovaya-1', '2015-04-06', '', '0.1', '', 1, 1),
(8, 5, 1, 0, 'Шина грузовая №2', 'wg3434', 8400, 0, '', '', '', 'shina-gruzovaya-2', '2015-04-06', '', '0.1', '&lt;p&gt;&lt;span style=&quot;color:rgb(0, 0, 0); font-family:arial,helvetica,sans; font-size:11px&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/span&gt;&lt;/p&gt;', 0, 0),
(9, 2, 1, 0, 'Диск штампованный №1', 'd45', 1500, 0, '', '', '', 'disk-shtampovannyj-1', '2015-04-06', '', '0.1', '&lt;p&gt;&lt;span style=&quot;color:rgb(0, 0, 0); font-family:arial,helvetica,sans; font-size:11px&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/span&gt;&lt;/p&gt;', 1, 0),
(10, 9, 1, 0, 'Диск легкосплавный №1', 'da34', 3500, 0, '', '', '', 'disk-legkosplavnyj-1', '2015-04-06', '', '0.1', '&lt;p&gt;&lt;span style=&quot;color:rgb(0, 0, 0); font-family:arial,helvetica,sans; font-size:11px&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/span&gt;&lt;/p&gt;', 0, 0),
(11, 9, 1, 0, 'Диск легкосплавный №2', 'da23', 4300, 14, '', '', '', 'disk-legkosplavnyj-2', '2015-04-06', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;', 0, 0),
(12, 10, 1, 0, 'Насос ручной', 'pr3435', 560, 0, '', '', '', 'nasos-ruchnoj', '2015-04-06', '', '0.1', '&lt;p&gt;&lt;span style=&quot;color:rgb(0, 0, 0); font-family:arial,helvetica,sans; font-size:11px&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/span&gt;&lt;/p&gt;', 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `address`, `valid_email`, `secret`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '8-950-123-45', '', 0, 'f556de45badbca0264ee68f418a42265'),
(3, 'Павел', '21232f297a57a5a743894a0e4a801fc3', 'admin-2@admin.ru', '', '', 0, ''),
(4, 'Павелидзе', 'fae0b27c451c728867a567e8c1bb4e53', 'pavel@mail.ru', '', '', 0, '');

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
(2, 3),
(1, 1),
(2, 4);

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
