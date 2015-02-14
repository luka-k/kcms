-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 15 2015 г., 01:27
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `red_btr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `date`, `parent_id`, `name`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`) VALUES
(1, '2015-02-13', 7, 'Новости', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', '', '', '', 'novosti'),
(3, '2015-02-14', 1, 'Внедорожные мероприятия', 0, '', '', '', '', 'vnedorozhnye-meropriyatiya'),
(5, '2015-02-20', 3, 'Lorem ipsum dolor sit amet, consectetur...', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', '', '', '', 'lorem-ipsum-dolor-sit-amet-consectetur'),
(6, '2015-02-03', 1, 'Июнь', 0, '<p>Команда redBTR Sport участвует&nbsp;в Трофи-рейде &quot;Ладога&quot;&nbsp; в&nbsp;категории Adventure.</p>\r\n', '', '', '', 'lorem-ipsum-dolor-sit-amet-consectetu'),
(7, '2015-02-14', 0, 'О нас', 0, '', '', '', '', 'o-nas');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(1, 1, 0, 'Обвес', '', '', '', 'obves', 0, ''),
(2, 1, 2, 'Комплекты патрубков', '', '', '', 'komplekty-patrubkov', 0, ''),
(3, 1, 3, 'Электроника', '', '', '', 'elektronika', 0, ''),
(4, 1, 1, 'Домкраты', '', '', '', 'domkraty', 0, ''),
(5, 1, 0, 'Инверторы', '', '', '', 'invertory', 3, ''),
(6, 1, 0, 'Пусковые аккумуляторы', '', '', '', 'puskovye-akkumulyatory', 3, ''),
(7, 1, 0, 'Аксессуары', '', '', '', 'aksessuary', 3, ''),
(8, 1, 1, 'Домкраты гидравлические', '', '', '', 'domkraty-gidravlicheskie', 4, ''),
(9, 1, 2, 'Домкраты винтовые', '', '', '', 'domkraty-vintovye', 4, ''),
(10, 1, 0, 'Аксессуары', '', '', '', 'aksessuary', 4, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`id`, `type`, `value`, `object_type`, `object_id`) VALUES
(1, 'use', 'AVT (Quatro Crazy)', 'products', 5),
(2, 'use', 'Водный транспорт (Mission Naval)', 'products', 4),
(3, 'use', 'Туризм (Country side)', 'products', 6),
(4, 'use', 'Промышленность (Mission SOS)', 'products', 1),
(5, 'use', 'Тяжелое бездорожье и внедорожный спорт (Mission Impossible)', 'products', 2),
(6, 'use', 'Тяжелое бездорожье и внедорожный спорт (Mission Impossible)', 'products', 3);

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
('dd7b950998e5799ab98f661da98e94a6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423949106, 'a:3:{s:4:"user";O:8:"stdClass":14:{s:2:"id";s:2:"27";s:9:"last_name";s:0:"";s:4:"name";s:5:"admin";s:10:"patronymic";s:0:"";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:0:"";s:4:"city";s:29:"Санкт-Петербург";s:6:"street";s:14:"Руднева";s:5:"house";s:1:"5";s:8:"building";s:1:"1";s:9:"apartment";s:3:"162";s:8:"zip_code";s:0:"";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:11:"user_groups";a:2:{i:0;s:5:"admin";i:1;s:11:"subscribers";}}');

-- --------------------------------------------------------

--
-- Структура таблицы `dealers`
--

CREATE TABLE IF NOT EXISTS `dealers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `dealers`
--

INSERT INTO `dealers` (`id`, `name`, `description`, `region`) VALUES
(1, '1-ый диллер', '', 'al'),
(2, '2-ой диллер', '', 'kn'),
(3, '3-ий диллер', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', 'ps'),
(4, '4-ый дилер', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', 'ps');

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
(1, 'top_menu', ''),
(2, 'Меню панели администратора', '');

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1',
  `subject` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `name`, `type`, `subject`, `description`, `is_delete`) VALUES
(1, 'Администратору при заказе', 1, 'Новый заказ', '<p>Кллиент %user_name% оформил заказ № %order_id%.</p>\r\n', 0),
(2, 'Клиенту при заказе', 1, 'Заказ %order_id% в интернет магазине', '<p>Менеджер свяжется с Вами %user_name%.</p>\r\n', 0),
(3, 'Клиенту при изменении статуса заказа', 1, 'Статус Вашего заказа изменен', '<p>Уважаемый %user_name%. Статус Вашего заказа %order_id% изменен на %order_status%</p>\r\n', 0),
(4, 'При регистрации', 1, 'Регистрация в магазине', '<p>%user_name%, спасибо за регистрацию в нашем магазине. Ваш логин %login% Ваш пароль %password%</p>\r\n', 0),
(5, 'При изменении пароля', 1, 'Ваш пароль изменен', '<p>%user_name%, Ваш пароль в интернет магазине изменен. Новые данный доступа Ваш логин %login% Ваш пароль %password%</p>\r\n', 0),
(6, 'Обратный звонок', 1, 'Заказан обратный звонок', '', 0),
(7, 'Пробный шаблон рассылки', 2, 'Пробное письмо', '<table border="1" cellpadding="1" cellspacing="1" style="width:500px">\r\n	<tbody>\r\n		<tr>\r\n			<td>ываываыу</td>\r\n			<td>ывыупыупы</td>\r\n		</tr>\r\n		<tr>\r\n			<td>ыпыупыуп</td>\r\n			<td>ыупыупы</td>\r\n		</tr>\r\n		<tr>\r\n			<td>ыпыупыупыуы</td>\r\n			<td>ыупыупыуп</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `filials`
--

CREATE TABLE IF NOT EXISTS `filials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `filials`
--

INSERT INTO `filials` (`id`, `name`, `phone`, `caption`) VALUES
(1, 'Санкт-Петербург', '8 (800) 770 04 07', 'Санкт-Петербург');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `url`) VALUES
(1, 1, 'products', 1, '/8/4/84d981fb350911e4943200259019918b-371dd85da55a11e491b3005056991d0b.jpg'),
(2, 0, 'products', 1, '/8/4/84d981fb350911e4943200259019918b-371dd85ea55a11e491b3005056991d0b.jpg'),
(3, 0, 'products', 1, '/8/4/84d981fb350911e4943200259019918b-371dd85fa55a11e491b3005056991d0b.jpg'),
(4, 1, 'products', 2, '/e/f/ef61b710350711e4943200259019918b-2fa10d40a55911e491b3005056991d0b.jpg'),
(5, 0, 'products', 2, '/e/f/ef61b710350711e4943200259019918b-2fa10d41a55911e491b3005056991d0b.jpg'),
(6, 0, 'products', 2, '/e/f/ef61b710350711e4943200259019918b-2fa10d42a55911e491b3005056991d0b.jpg'),
(7, 0, 'products', 2, '/e/f/ef61b710350711e4943200259019918b-2fa10d43a55911e491b3005056991d0b.jpg'),
(8, 1, 'products', 3, '/e/f/ef61b710350711e4943200259019918b-2fa10d42a55911e491b3005056991d0b[1].jpg'),
(9, 0, 'products', 3, '/4/d/4dceb184350811e4943200259019918b-2fa10d47a55911e491b3005056991d0b.jpg'),
(10, 0, 'products', 3, '/4/d/4dceb184350811e4943200259019918b-2fa10d48a55911e491b3005056991d0b.jpg'),
(11, 0, 'products', 3, '/4/d/4dceb184350811e4943200259019918b-2fa10d4aa55911e491b3005056991d0b.jpg'),
(12, 1, 'products', 4, '/1/2/1261098de40a11e3956f00155d0a2e33-7e520f75a54f11e491b3005056991d0b.jpg'),
(13, 0, 'products', 4, '/1/2/1261098de40a11e3956f00155d0a2e33-7e520f73a54f11e491b3005056991d0b.jpg'),
(14, 0, 'products', 4, '/1/2/1261098de40a11e3956f00155d0a2e33-7e520f74a54f11e491b3005056991d0b.jpg'),
(15, 1, 'products', 5, '/1/2/1261098ee40a11e3956f00155d0a2e33-7e520f78a54f11e491b3005056991d0b.jpg'),
(16, 0, 'products', 5, '/1/2/1261098ee40a11e3956f00155d0a2e33-7e520f76a54f11e491b3005056991d0b.jpg'),
(17, 0, 'products', 5, '/1/2/1261098ee40a11e3956f00155d0a2e33-7e520f77a54f11e491b3005056991d0b.jpg'),
(18, 1, 'products', 6, '/4/e/4ef7e4cf89af11e4943200259019918b-4ef7e4d089af11e4943200259019918b.jpg'),
(19, 0, 'products', 5, '/1/2/1261098de40a11e3956f00155d0a2e33-7e520f73a54f11e491b3005056991d0b[1].jpg'),
(20, 0, 'products', 5, '/1/2/1261098de40a11e3956f00155d0a2e33-7e520f74a54f11e491b3005056991d0b[1].jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `mailouts`
--

CREATE TABLE IF NOT EXISTS `mailouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `users_ids` varchar(300) DEFAULT NULL,
  `mailouts_date` date DEFAULT NULL,
  `success` int(11) NOT NULL,
  `no_success` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(2, 1, 'Где купить', 0, 1, '', 'articles', 'gde-kupit'),
(3, 1, 'О нас', 0, 2, '', 'articles', 'o-nas'),
(4, 1, 'Контакты', 0, 3, '', 'link', 'kontakty'),
(5, 1, 'Авторезированные сервис центры', 1, 1, '', 'articles', 'avtorezirovannye-servis-centry'),
(6, 1, 'Регистрация и вход', 1, 2, '', 'link', 'йцукен'),
(7, 1, 'Поддержка клиентов', 0, 0, '', 'articles', 'podderzhka-klientov'),
(19, 1, 'Как стать дилером', 2, 1, '', 'link', 'dealers'),
(28, 1, 'Авторизованные сервис центры', 27, 1, '', 'articles', 'avtorizovannye-servis-centry'),
(30, 2, '<i class=icon-home></i>', 0, 0, '', 'link', '/admin'),
(31, 2, 'Статьи', 0, 0, '', 'link', '#'),
(32, 2, 'Все статьи', 31, 0, '', 'link', '/admin/content/items/articles'),
(33, 2, 'Новости', 31, 0, '', 'link', '/admin/content/items/articles/1'),
(34, 2, 'Каталог', 0, 0, '', 'link', '#'),
(35, 2, 'Категории', 34, 0, '', 'link', '/admin/content/items/categories'),
(36, 2, 'Создать категорию', 34, 0, '', 'link', '/admin/content/item/edit/categories'),
(37, 2, 'Товары', 34, 0, '', 'link', '/admin/content/items/products'),
(38, 2, 'Создать товар', 34, 0, '', 'link', '/admin/content/item/edit/products'),
(39, 2, 'Дополнения', 0, 0, '', 'link', '#'),
(40, 2, 'Слайдер', 39, 0, '', 'link', '/admin/content/items/slider'),
(41, 2, 'Видео', 39, 0, '', 'link', '/admin/content/items/video'),
(42, 2, 'Филиалы', 39, 0, '', 'link', '/admin/content/items/filials'),
(43, 2, 'Дилеры', 39, 0, '', 'link', '/admin/content/items/dealers'),
(44, 2, 'Заказы', 0, 0, '', 'link', '/admin/admin_orders'),
(45, 2, 'Настройки', 0, 0, '', 'link', '/admin/content/item/edit/settings/1'),
(46, 2, 'Меню', 0, 0, '', 'link', '/admin/menu_module/menus'),
(47, 2, 'Рассылки', 0, 0, '', 'link', '#'),
(48, 2, 'Шаблоны', 47, 0, '', 'link', '/admin/content/items/emails/2'),
(49, 2, 'Рассылки', 47, 0, '', 'link', '/admin/mailouts_module/'),
(50, 2, 'Системные письма', 47, 0, '', 'link', '/admin/content/items/emails/1'),
(51, 2, 'Пользователи', 0, 0, '', 'link', '#'),
(52, 2, 'Пользователи', 51, 0, '', 'link', '/admin/users_module/'),
(53, 2, 'Группы пользователей', 51, 0, '', 'link', '/admin/content/items/users_groups/'),
(55, 1, 'Новости', 3, 1, '', 'articles', 'novosti'),
(57, 1, 'Внедорожные мероприятия', 55, 1, '', 'articles', 'vnedorozhnye-meropriyatiya'),
(58, 1, 'Новости', 55, 0, '', 'articles', 'novosti');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_email` text COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` text COLLATE utf8_unicode_ci NOT NULL,
  `user_address` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(10) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_new` tinyint(1) NOT NULL,
  `is_good_buy` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `article` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `warrant` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `discount` int(2) NOT NULL,
  `video` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `is_new`, `is_good_buy`, `sort`, `name`, `article`, `warrant`, `price`, `discount`, `video`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `short_description`, `description`) VALUES
(1, 5, 1, 1, 1, 0, 'Преобразователь напряжения с 24/12V (автомобильный) 10A **', 'NF-12/24V-10A', '1 год', 939, 0, '', '', '', '', 'preobrazovatel-napryazheniya-s-24-12v-avtomobilnyj-10a', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', ''),
(2, 5, 1, 0, 1, 0, 'Инвертор напряжения автомобильный 24/220V 1000W, 2 розетки, 1 USB-порт', 'NF-24/220V-1000W', '1 год', 3899, 0, '', '', '', '', 'invertor-napryazheniya-avtomobilnyj-24-220v-1000w-2-rozetki-1-usb-port', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', ''),
(3, 5, 1, 1, 0, 0, 'Инвертор напряжения автомобильный 24/220V 1500W **', 'NF-12/220V-1500W', '1 год', 4749, 0, '', '', '', '', 'invertor-napryazheniya-avtomobilnyj-24-220v-1500w', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', ''),
(4, 10, 1, 1, 0, 1, 'Шакл для крепления буксирного троса и блоков лебёдки (серьга) 23 мм (7/8`) `Серия90-120`', '7\\8', '1 год', 459, 0, '', '', '', '', 'shakl-dlya-krepleniya-buksirnogo-trosa-i-blokov-lebyodki-serga-23-mm-7-8-seriya90-120', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', ''),
(5, 10, 1, 1, 1, 2, 'Шакл для крепления буксирного троса и блоков лебёдки (серьга) 20 мм (3/4`), до 4,75 тонн `redBTR`', 'RB-Shakle-3/4', '1 год', 469, 0, '', '', '', '', 'shakl-dlya-krepleniya-buksirnogo-trosa-i-blokov-lebyodki-serga-20-mm-3-4-do-4-75-tonn-redbtr', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', ''),
(6, 10, 1, 0, 1, 0, 'Шакл для крепления буксирного троса и блоков лебёдки (серьга) 16 мм (5/8`) `redBTR`', 'RB-Shakle-5/8', '1 год', 409, 0, '', '', '', '', 'shakl-dlya-krepleniya-buksirnogo-trosa-i-blokov-lebyodki-serga-16-mm-5-8-redbtr', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n', '');

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
  `main_title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `order_string`, `main_title`, `description`, `site_description`, `site_keywords`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`) VALUES
(1, 'RedBTR', 'info@redBTR.ru', 'admin', '', 'Продукция от компании redBTR', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>', '', '', 0, '', 2, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patronymic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `house` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `building` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `apartment` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `last_name`, `name`, `patronymic`, `password`, `email`, `phone`, `city`, `street`, `house`, `building`, `apartment`, `zip_code`, `secret`) VALUES
(27, '', 'admin', '', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '', 'Санкт-Петербург', 'Руднева', '5', '1', '162', '', ''),
(33, 'Лукинский', 'Павел', 'Юръевич', 'fae0b27c451c728867a567e8c1bb4e53', 'luka@mail.ru', '', '', '', '', '', '', '', ''),
(35, '', 'luka@ya.ru', '', '', 'luka@ya.ru', '', '', '', '', '', '', '', '');

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
(1, '27'),
(2, '33'),
(3, '35'),
(3, '27');

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_edit` int(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`, `is_edit`, `is_delete`) VALUES
(1, 'admin', 0, 0),
(2, 'customers', 0, 0),
(3, 'subscribers', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `is_main` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
