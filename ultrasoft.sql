-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 02 2015 г., 18:00
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ultrasoft`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `parent_id`, `name`, `date`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`, `lastmod`, `changefreq`, `priority`) VALUES
(1, 0, 'Публикации', '2015-10-02', 0, '', '', '', '', 'publikacii', '2015-10-02', '', '0.1'),
(2, 0, 'Услуги и сервисы', '2015-10-02', 0, '', '', '', '', 'uslugi-i-servisy', '2015-10-02', '', '0.1'),
(3, 0, 'Проектный центр', '2015-10-02', 0, '', '', '', '', 'proektnyj-centr', '2015-10-02', '', '0.1'),
(4, 0, 'Продукты', '2015-10-02', 0, '', '', '', '', 'produkty', '2015-10-02', '', '0.1'),
(5, 0, 'Компания', '2015-10-02', 0, '', '', '', '', 'kompaniya', '2015-10-02', '', '0.1'),
(6, 0, 'Наш опыт', '2015-10-02', 0, '', '', '', '', 'nash-opyt', '2015-10-02', '', '0.1'),
(7, 2, 'Сопровождения и поддержка', '2015-10-02', 0, '', '', '', '', 'soprovozhdeniya-i-podderzhka', '2015-10-02', '', '0.1'),
(8, 2, 'Разработка и внедрение', '2015-10-02', 0, '', '', '', '', 'razrabotka-i-vnedrenie', '2015-10-02', '', '0.1'),
(9, 2, 'Бухгалтерское обслужевание', '2015-10-02', 0, '', '', '', '', 'buhgalterskoe-obsluzhevanie', '2015-10-02', '', '0.1'),
(10, 3, 'Принципы и технологии', '2015-10-02', 0, '', '', '', '', 'principy-i-tehnologii', '2015-10-02', '', '0.1'),
(11, 3, 'Собственные разработки', '2015-10-02', 0, '', '', '', '', 'sobstvennye-razrabotki', '2015-10-02', '', '0.1'),
(12, 3, 'Наши эксперты', '2015-10-02', 0, '', '', '', '', 'nashi-eksperty', '2015-10-02', '', '0.1'),
(13, 3, 'Примеры внедрений', '2015-10-02', 0, '', '', '', '', 'primery-vnedrenij', '2015-10-02', '', '0.1'),
(14, 4, 'Условия поставки', '2015-10-02', 0, '', '', '', '', 'usloviya-postavki', '2015-10-02', '', '0.1'),
(15, 4, 'Сопровождение сделки', '2015-10-02', 0, '', '', '', '', 'soprovozhdenie-sdelki', '2015-10-02', '', '0.1'),
(16, 4, 'Ассортимент', '2015-10-02', 0, '', '', '', '', 'assortiment', '2015-10-02', '', '0.1'),
(17, 5, 'Преимущества', '2015-10-02', 0, '', '', '', '', 'preimushestva', '2015-10-02', '', '0.1'),
(18, 5, 'Система качества', '2015-10-02', 0, '', '', '', '', 'sistema-kachestva', '2015-10-02', '', '0.1'),
(19, 5, 'Принципы', '2015-10-02', 0, '', '', '', '', 'principy', '2015-10-02', '', '0.1'),
(20, 5, 'Эксперты', '2015-10-02', 0, '', '', '', '', 'eksperty', '2015-10-02', '', '0.1'),
(21, 5, 'Достижения', '2015-10-02', 0, '', '', '', '', 'dostizheniya', '2015-10-02', '', '0.1'),
(22, 6, 'Производство и строительство', '2015-10-02', 0, '', '', '', '', 'proizvodstvo-i-stroitelstvo', '2015-10-02', '', '0.1'),
(23, 6, 'Оптовая торговля и дистрибьюция', '2015-10-02', 0, '', '', '', '', 'optovaya-torgovlya-i-distribyuciya', '2015-10-02', '', '0.1'),
(24, 6, 'Розничная торговля, ретейл', '2015-10-02', 0, '', '', '', '', 'roznichnaya-torgovlya-retejl', '2015-10-02', '', '0.1'),
(25, 6, 'Сервисные компании', '2015-10-02', 0, '', '', '', '', 'servisnye-kompanii', '2015-10-02', '', '0.1'),
(26, 6, 'Интеграция систем', '2015-10-02', 0, '', '', '', '', 'integraciya-sistem', '2015-10-02', '', '0.1');

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
('0185e8f77ef167a4d9901f2d4ffcbbd5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443797846, 'a:3:{s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:0:"";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}'),
('0c4acfe1b440697acb631196748e2ab4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794708, ''),
('0e78a226c22cb7ebd66daeb659fbae54', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794707, ''),
('109376329069897bede65f35598fe513', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792470, ''),
('1304ac3dbb32a8ef995611114d3d0dc9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792473, ''),
('1c8d2dd5e129817a826d6e5a4b06b05f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794713, ''),
('1f7fa4aa06a881d615f8b0a6f7b05b4f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792470, 'a:4:{s:9:"user_data";s:0:"";s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:0:"";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}'),
('23746055558875ad50e6381442eb2ce4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794708, ''),
('39ad40fac895daf6abd77d902e2845d2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792473, ''),
('3dd510509f6cf02e2ae3470de1a746c5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792472, ''),
('43363f3dcf72cfd72d6b10e654f649aa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794713, ''),
('485ae148a152e122045256bc477051fc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792470, ''),
('57fe19449d8b36ed649229449105f103', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792471, ''),
('65c8557cf5b54dd7aa546020ce57083d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794712, ''),
('6916a354a3a4390f3064eea0eb377028', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794709, ''),
('6f0631a5c27bf4580329249115ef6f66', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792472, ''),
('878dd2efe60b3a29ad7ea8c3aa0eaa99', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792472, ''),
('8fe288c7a1d4971cb1823a4cbffe53f5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794708, ''),
('91a8fd97671fa9d13608c229d6306fa6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794712, ''),
('93ff67cd17498fae19ee5a1d2d1474de', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792471, ''),
('94a7174e6ebe149da342f9d25cf9da07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792471, ''),
('9576868ca0f767f32758c3a6469a6d30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792471, ''),
('9b65d71ed36c0c5307af61800b7de611', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792472, ''),
('a0de63de2f589d5c731428ef83f5c334', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794712, ''),
('b38732eeedd6ed78d5ada724a9c3ac35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792472, ''),
('cc4078f5950db85a45d101808d6bbf4c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794713, ''),
('e56ea041c0a2687ddee2aa44b76974ef', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443794708, ''),
('fa842420a5945f101aba55ef83ecbdbd', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1443792472, '');

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
(5, 'Верхнее меню', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=67 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(4, 1, '<i class=icon-home></i>', 0, 0, '', 'link', 'admin/'),
(5, 1, 'Статьи', 0, 1, '', 'link', '#'),
(8, 1, 'Настройки', 0, 9, '', 'link', '#'),
(9, 1, 'Рассылки', 0, 7, '', 'link', '#'),
(10, 1, 'Меню', 8, 5, '', 'link', 'admin/menu_module/menus'),
(11, 1, 'Пользователи', 0, 8, '', 'link', '#'),
(12, 1, 'Все статьи', 5, 1, '', 'link', 'admin/content/items/articles'),
(17, 1, 'Настройки сайта', 8, 10, '', 'link', 'admin/content/item/edit/settings/1'),
(19, 1, 'Шаблоны', 9, 1, '', 'link', 'admin/content/items/emails/2'),
(20, 1, 'Рассылки', 9, 2, '', 'link', 'admin/mailouts_module'),
(21, 1, 'Системные письма', 9, 3, '', 'link', 'admin/content/items/emails/1'),
(22, 1, 'Пользователи', 11, 1, '', 'link', 'admin/users_module/'),
(23, 1, 'Группы пользователей', 11, 2, '', 'link', 'admin/content/items/users_groups/all'),
(35, 5, 'Услуги и сервисы', 0, 8, '', 'link', '#'),
(36, 5, 'Сопровождения и поддержка', 35, 1, '', 'link', '#'),
(37, 5, 'Разработка и внедрение', 35, 2, '', 'link', '#'),
(38, 5, 'Бухгалтерское                     обслужевание', 35, 3, '', 'link', '#'),
(39, 5, 'Проектный центр', 0, 9, '', 'link', '#'),
(40, 5, 'Принципы и технологии', 39, 10, '', 'link', '#'),
(41, 5, 'Собственные разработки', 39, 11, '', 'link', '#'),
(42, 5, 'Наши эксперты', 39, 12, '', 'link', '#'),
(43, 5, 'Примеры внедрений', 39, 13, '', 'link', '#'),
(44, 5, 'Продукты', 0, 10, '', 'link', '#'),
(45, 5, 'Условия поставки', 44, 1, '', 'link', '#'),
(46, 5, 'Сопровождение сделки', 44, 2, '', 'link', '#'),
(47, 5, 'Ассортимент', 44, 3, '', 'link', '#'),
(48, 5, 'Компания', 0, 11, '', 'link', '#'),
(49, 5, 'Преимущества', 48, 1, '', 'link', '#'),
(50, 5, 'Система качества', 48, 2, '', 'link', '#'),
(51, 5, 'Принципы', 48, 3, '', 'link', '#'),
(52, 5, 'Эксперты', 48, 4, '', 'link', '#'),
(53, 5, 'Достижения', 48, 5, '', 'link', '#'),
(54, 5, 'Наш опыт', 0, 12, '', 'link', '#'),
(55, 5, 'Производство и строительство', 54, 1, '', 'link', '#'),
(56, 5, 'Оптовая торговля и дистрибьюция', 54, 2, '', 'link', '#'),
(57, 5, 'Розничная торговля, ретейл', 54, 3, '', 'link', '#'),
(58, 5, 'Сервисные компании', 54, 4, '', 'link', '#'),
(59, 5, 'Интеграция систем', 54, 5, '', 'link', '#'),
(60, 5, 'Контакты', 0, 13, '', 'link', '#'),
(61, 1, 'Создать', 5, 0, '', 'link', 'admin/content/item/edit/articles'),
(62, 1, 'Услуги и сервисы', 0, 2, '', 'link', 'admin/content/item/edit/articles/2'),
(63, 1, 'Проектный центр', 0, 3, '', 'link', 'admin/content/item/edit/articles/3'),
(64, 1, 'Продукты', 0, 4, '', 'link', 'admin/content/item/edit/articles/4'),
(65, 1, 'Компания', 0, 5, '', 'link', 'admin/content/item/edit/articles/5'),
(66, 1, 'Наш опыт', 0, 6, '', 'link', 'admin/content/item/edit/articles/6');

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
  `per_page` int(11) NOT NULL,
  `site_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastmod` date NOT NULL,
  `site_offline` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `order_string`, `per_page`, `site_description`, `site_keywords`, `lastmod`, `site_offline`) VALUES
(1, 'УльтраСофт', '', '', '', 0, '', '', '2015-10-02', 0);

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
