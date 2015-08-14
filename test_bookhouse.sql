-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 14 2015 г., 15:35
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `bookhouse`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `parent_id`, `name`, `date`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`, `lastmod`, `changefreq`, `priority`) VALUES
(1, 0, 'Новости', '2015-04-19', 0, '', '', '', '', 'novosti', '2015-04-19', '', '0.1'),
(2, 1, 'Опубликована электронная и печатная версия журнала', '2015-04-16', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '', '', '', 'opublikovana-elektronnaya-i-pechatnaya-versiya-zhurnala', '2015-04-19', '', '0.1'),
(3, 1, 'Опубликована электронная и печатная версия журнала-2', '2015-04-16', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '', '', '', 'opublikovana-elektronnaya-i-pechatnaya-versiya-zhurnala-2', '2015-04-19', '', '0.1'),
(4, 1, 'Новость пробная номер 1', '2015-04-18', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '', '', '', 'novost-probnaya-nomer-1', '2015-04-20', '', '0.1'),
(5, 0, 'События', '2015-07-13', 0, '', '', '', '', 'sobytiya', '2015-07-13', '', '0.1'),
(6, 5, 'Собитие 1', '2015-03-12', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '', '', '', 'sobitie-1', '2015-07-15', '', '0.1'),
(7, 5, 'Собитие 2', '2015-04-01', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '', '', '', 'sobitie-2', '2015-07-15', '', '0.1'),
(8, 5, 'Собитие 3', '2015-04-16', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '', '', '', 'sobitie-3', '2015-07-13', '', '0.1'),
(9, 0, 'Информация', '2015-07-17', 0, '', '', '', '', 'informaciya', '2015-07-17', '', '0.1'),
(10, 9, 'О компании', '2015-07-17', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', '', '', '', 'o-kompanii', '2015-07-17', '', '0.1'),
(11, 9, 'Оплата и доставка', '2015-07-17', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', '', '', '', 'oplata-i-dostavka', '2015-07-17', '', '0.1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `parent_id`, `description`) VALUES
(1, 1, 0, 'Pearson', '', '', '', 'pearson', '2015-07-14', '', '0.1', 0, ''),
(2, 1, 0, 'Macmillan', '', '', '', 'macmillan', '2015-07-14', '', '0.1', 0, ''),
(3, 1, 0, 'Cambridge', '', '', '', 'cambridge', '2015-07-14', '', '0.1', 0, ''),
(4, 1, 0, 'Heuber', '', '', '', 'heuber', '2015-07-14', '', '0.1', 0, ''),
(5, 1, 0, 'Раннее обучение', '', '', '', 'rannee-obuchenie', '2015-07-14', '', '0.1', 1, ''),
(6, 1, 0, 'Начальная школа', '', '', '', 'nachalnaya-shkola', '2015-07-14', '', '0.1', 1, ''),
(7, 1, 0, 'Средняя и старшая школа', '', '', '', 'srednyaya-i-starshaya-shkola', '2015-07-14', '', '0.1', 1, ''),
(8, 1, 0, 'Подготовка к ОГЭ и ЕГЭ', '', '', '', 'podgotovka-k-oge-i-ege', '2015-07-14', '', '0.1', 1, ''),
(9, 1, 0, 'Английский для специальных целей', '', '', '', 'anglijskij-dlya-specialnyh-celej', '2015-07-14', '', '0.1', 1, ''),
(10, 1, 0, 'Раннее обучение', '', '', '', 'rannee-obuchenie', '2015-07-14', '', '0.1', 2, ''),
(11, 1, 0, 'Средняя и старшая школа', '', '', '', 'srednyaya-i-starshaya-shkola', '2015-07-14', '', '0.1', 2, ''),
(12, 1, 0, 'Средняя и старшая школа', '', '', '', 'srednyaya-i-starshaya-shkola', '2015-07-14', '', '0.1', 3, ''),
(13, 1, 0, 'Английский для специальных целей', '', '', '', 'anglijskij-dlya-specialnyh-celej', '2015-07-14', '', '0.1', 3, ''),
(14, 1, 0, 'Английский для специальных целей', '', '', '', 'anglijskij-dlya-specialnyh-celej', '2015-07-14', '', '0.1', 4, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=90 ;

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`id`, `type`, `value`, `object_type`, `object_id`) VALUES
(2, 'yazyk', 'Английский', 'products', 1),
(3, 'uroven', 'Уровень 1', 'products', 1),
(4, 'tip', 'Тип 2', 'products', 1),
(5, 'yazyk', 'Английский', 'products', 2),
(7, 'uroven', 'Уровень 1', 'products', 2),
(8, 'izdatelstvo', 'Издательство 2', 'products', 2),
(9, 'tip', 'Тип 1', 'products', 2),
(10, 'izdatelstvo', 'Издательство 1', 'products', 3),
(11, 'yazyk', 'Немецкий', 'products', 3),
(12, 'uroven', 'Уровень 1', 'products', 3),
(13, 'tip', 'Тип 3', 'products', 3),
(14, 'yazyk', 'Английский', 'products', 2),
(15, 'uroven', 'Уровень 1', 'products', 2),
(16, 'tip', 'Тип 1', 'products', 2),
(17, 'yazyk', 'Английский', 'products', 3),
(18, 'uroven', 'Уровень 1', 'products', 3),
(19, 'izdatelstvo', 'Издательство 2', 'products', 3),
(20, 'tip', 'Тип 1', 'products', 3),
(21, 'yazyk', 'Английский', 'products', 3),
(22, 'uroven', 'Уровень 1', 'products', 3),
(23, 'tip', 'Тип 1', 'products', 3),
(24, 'izdatelstvo', 'Издательство 1', 'products', 4),
(25, 'yazyk', 'Немецкий', 'products', 4),
(26, 'uroven', 'Уровень 1', 'products', 4),
(27, 'tip', 'Тип 3', 'products', 4),
(28, 'yazyk', 'Английский', 'products', 4),
(29, 'uroven', 'Уровень 1', 'products', 4),
(30, 'izdatelstvo', 'Издательство 2', 'products', 4),
(31, 'tip', 'Тип 1', 'products', 4),
(32, 'yazyk', 'Английский', 'products', 4),
(33, 'uroven', 'Уровень 1', 'products', 4),
(34, 'tip', 'Тип 1', 'products', 4),
(35, 'izdatelstvo', 'Издательство 1', 'products', 5),
(36, 'yazyk', 'Немецкий', 'products', 5),
(37, 'uroven', 'Уровень 1', 'products', 5),
(38, 'tip', 'Тип 3', 'products', 5),
(39, 'yazyk', 'Английский', 'products', 5),
(40, 'uroven', 'Уровень 1', 'products', 5),
(41, 'izdatelstvo', 'Издательство 2', 'products', 5),
(42, 'tip', 'Тип 1', 'products', 5),
(43, 'yazyk', 'Английский', 'products', 5),
(44, 'uroven', 'Уровень 1', 'products', 5),
(45, 'tip', 'Тип 1', 'products', 5),
(46, 'izdatelstvo', 'Издательство 1', 'products', 6),
(47, 'yazyk', 'Немецкий', 'products', 6),
(48, 'uroven', 'Уровень 1', 'products', 6),
(49, 'tip', 'Тип 3', 'products', 6),
(50, 'yazyk', 'Английский', 'products', 6),
(51, 'uroven', 'Уровень 1', 'products', 6),
(52, 'izdatelstvo', 'Издательство 2', 'products', 6),
(53, 'tip', 'Тип 1', 'products', 6),
(54, 'yazyk', 'Английский', 'products', 6),
(55, 'uroven', 'Уровень 1', 'products', 6),
(56, 'tip', 'Тип 1', 'products', 6),
(57, 'izdatelstvo', 'Издательство 1', 'products', 7),
(58, 'yazyk', 'Немецкий', 'products', 7),
(59, 'uroven', 'Уровень 1', 'products', 7),
(60, 'tip', 'Тип 3', 'products', 7),
(61, 'yazyk', 'Английский', 'products', 7),
(62, 'uroven', 'Уровень 1', 'products', 7),
(63, 'izdatelstvo', 'Издательство 2', 'products', 7),
(64, 'tip', 'Тип 1', 'products', 7),
(65, 'yazyk', 'Английский', 'products', 7),
(66, 'uroven', 'Уровень 1', 'products', 7),
(67, 'tip', 'Тип 1', 'products', 7),
(68, 'izdatelstvo', 'Издательство 1', 'products', 8),
(69, 'yazyk', 'Немецкий', 'products', 8),
(70, 'uroven', 'Уровень 1', 'products', 8),
(71, 'tip', 'Тип 3', 'products', 8),
(72, 'yazyk', 'Английский', 'products', 8),
(73, 'uroven', 'Уровень 1', 'products', 8),
(74, 'izdatelstvo', 'Издательство 2', 'products', 8),
(75, 'tip', 'Тип 1', 'products', 8),
(76, 'yazyk', 'Английский', 'products', 8),
(77, 'uroven', 'Уровень 1', 'products', 8),
(78, 'tip', 'Тип 1', 'products', 8),
(79, 'izdatelstvo', 'Издательство 1', 'products', 9),
(80, 'yazyk', 'Немецкий', 'products', 9),
(81, 'uroven', 'Уровень 1', 'products', 9),
(82, 'tip', 'Тип 3', 'products', 9),
(83, 'yazyk', 'Английский', 'products', 9),
(84, 'uroven', 'Уровень 1', 'products', 9),
(85, 'izdatelstvo', 'Издательство 2', 'products', 9),
(86, 'tip', 'Тип 1', 'products', 9),
(87, 'yazyk', 'Английский', 'products', 9),
(88, 'uroven', 'Уровень 1', 'products', 9),
(89, 'tip', 'Тип 1', 'products', 9);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `characteristics_type`
--

INSERT INTO `characteristics_type` (`id`, `name`, `category`, `url`, `view_type`) VALUES
(1, 'Издательство', 0, 'izdatelstvo', 'multy'),
(2, 'Язык', 0, 'yazyk', 'multy'),
(3, 'Уровень', 0, 'uroven', 'multy'),
(4, 'Тип', 0, 'tip', 'multy');

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
('99f893ba61cfca60c8156e18bd7893ce', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1439553579, 'a:4:{s:9:"user_data";s:0:"";s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:32:"f556de45badbca0264ee68f418a42265";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}');

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opened` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `name`, `address`, `phone`, `opened`, `sort`) VALUES
(10, 'Магазин на малой конющенной', '', '', 'будни: 9.30 - 20.00; суббота, воскресенье: 11.00 - 18.00 ', 0),
(11, 'Издательский отдел', '', '', 'будни: 10.00 - 18.00', 0),
(12, 'Экзаменационный центр', 'ул. Большая Конюшенная, 8', '244-54-88', 'будни: 11.00 - 19.00; суббота, воскресенье: выходной', 0),
(13, 'Букхауз', 'Проспект Испытателей, 7А', '995-73-74', 'будни: 11.00 - 20.00; обед: 14.00 - 15.00', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `dynamic_menus`
--

CREATE TABLE IF NOT EXISTS `dynamic_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `dynamic_menus`
--

INSERT INTO `dynamic_menus` (`id`, `name`, `description`) VALUES
(1, 'Меню админ панели', ''),
(2, 'Меню магазина', ''),
(3, 'Основное меню', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `is_cover`, `object_type`, `object_id`, `image_type`, `url`) VALUES
(11, 'slider-1', 1, 'sliders', 3, '', '/s/l/slider-1.png'),
(12, 'slider-2', 1, 'sliders', 4, '', '/s/l/slider-2.png'),
(13, 'slider', 1, 'sliders', 5, '', '/s/l/slider.png'),
(14, 'slider[1]', 1, 'sliders', 6, '', '/s/l/slider[1].png'),
(15, 'shop-logo', 1, 'partners', 7, '', '/s/h/shop-logo.png'),
(16, 'shop-logo[1]', 1, 'partners', 8, '', '/s/h/shop-logo[1].png'),
(27, 'cover', 1, 'products', 1, '', '/c/o/cover.png'),
(28, 'cover[1]', 1, 'products', 2, '', '/c/o/cover[1].png'),
(29, 'cover[2]', 1, 'products', 3, '', '/c/o/cover[2].png'),
(30, 'cover[3]', 1, 'products', 7, '', '/c/o/cover[3].png'),
(31, 'cover[4]', 1, 'products', 4, '', '/c/o/cover[4].png'),
(32, 'cover[5]', 1, 'products', 5, '', '/c/o/cover[5].png'),
(33, 'cover[6]', 1, 'products', 6, '', '/c/o/cover[6].png'),
(34, 'cover[7]', 1, 'products', 8, '', '/c/o/cover[7].png'),
(35, 'cover[8]', 1, 'products', 9, '', '/c/o/cover[8].png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(4, 1, '<i class=icon-home></i>', 0, 0, '', 'link', 'admin/'),
(5, 1, 'Статьи', 0, 1, '', 'link', '#'),
(6, 1, 'Каталог', 0, 2, '', 'link', '#'),
(7, 1, 'Заказы', 0, 6, '', 'link', 'admin/admin_orders'),
(8, 1, 'Настройки', 0, 7, '', 'link', '#'),
(9, 1, 'Рассылки', 0, 8, '', 'link', '#'),
(10, 1, 'Меню', 0, 9, '', 'link', 'admin/menu_module/menus'),
(11, 1, 'Пользователи', 0, 10, '', 'link', '#'),
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
(35, 2, 'Новости', 0, 10, '', 'articles', 'novosti'),
(36, 2, 'Оплата и доставка', 0, 11, '', 'link', 'articles/informaciya/oplata-i-dostavka'),
(37, 2, 'Контакты', 0, 12, '', 'link', 'contacts'),
(38, 3, 'О компании', 0, 13, '', 'link', 'articles/informaciya/o-kompanii'),
(39, 3, 'Новости', 0, 14, '', 'link', 'articles/novosti'),
(40, 3, 'Мероприятия', 0, 15, '', 'link', 'articles/sobytiya'),
(41, 3, 'Партнеры', 0, 16, '', 'link', 'partneri'),
(42, 3, 'Контакты', 0, 17, '', 'link', 'contacts'),
(43, 1, 'Слайдеры', 0, 3, '', 'link', 'admin/content/items/sliders/all'),
(44, 1, 'Отделы', 0, 5, '', 'link', 'admin/content/items/departments/all'),
(45, 1, 'Партнеры', 0, 4, '', 'link', 'admin/content/items/partners/all'),
(46, 1, 'Импорт', 0, 18, '', 'link', 'admin/import_module/');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `user_name`, `user_email`, `user_phone`, `user_address`, `total`, `delivery_id`, `payment_id`, `date`, `status_id`) VALUES
(1, '55340c0b27088', '', 'admin', '', '8-950-123-45', '', 4700, 0, 0, '2015-04-19 00:00:00', 1),
(2, '5534c8a5e7ce0', '', 'admin', '', '8-950-123-45', '', 2350, 0, 0, '2015-04-20 00:00:00', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `order_qty`) VALUES
(1, '55340c0b27088', 1, 'Skillfull Writing and Reading: Level 3: Student Book with Digibook Access', '2350', 2),
(2, '5534c8a5e7ce0', 1, 'Skillfull Writing and Reading: Level 3: Student Book with Digibook Access', '2350', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `partners`
--

INSERT INTO `partners` (`id`, `name`, `link`, `sort`) VALUES
(7, 'Партнер 1', 'www.link.ru', 0),
(8, 'Партнер 2', 'www.link.ru', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ISBN` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` date NOT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `height` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `ISBN`, `parent_id`, `is_active`, `sort`, `name`, `autor`, `year`, `cover`, `amount`, `article`, `price`, `height`, `width`, `depth`, `weight`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `lastmod`, `changefreq`, `priority`, `description`, `is_new`, `is_special`) VALUES
(1, NULL, 5, 1, 0, 'Книга 1', 'автор', '0000-00-00', 'мягкая', '300', 'k-1', 200, NULL, NULL, NULL, NULL, 0, '', '', '', 'kniga-1', '2015-08-03', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;', 1, 1),
(2, NULL, 5, 1, 0, 'Книга 2', 'автор', '0000-00-00', '', '', 'k-2', 220, NULL, NULL, NULL, NULL, 0, '', '', '', 'kniga-2', '2015-08-03', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;', 1, 0),
(3, NULL, 9, 1, 0, 'Книга 3', 'автор', '0000-00-00', '', '', 'k-3', 250, NULL, NULL, NULL, NULL, 0, '', '', '', 'kniga-3', '2015-08-03', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;', 0, 1),
(4, NULL, 11, 1, 0, 'Книга 4', 'автор', '0000-00-00', '', '', 'k-4', 6000, NULL, NULL, NULL, NULL, 0, '', '', '', 'kniga-4', '2015-08-03', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;', 0, 1),
(5, NULL, 11, 1, 0, 'Книга 5', 'автор', '0000-00-00', '', '', 'k-5', 600, NULL, NULL, NULL, NULL, 0, '', '', '', 'kniga-5', '2015-08-03', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;', 1, 0),
(6, NULL, 13, 1, 0, 'Книга 6', 'автор', '0000-00-00', '', '', 'k-6', 456, NULL, NULL, NULL, NULL, 0, '', '', '', 'kniga-6', '2015-08-03', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;', 1, 1),
(7, NULL, 9, 1, 0, 'Книга 7', 'автор', '0000-00-00', '', '', 'k-7', 466, NULL, NULL, NULL, NULL, 0, '', '', '', 'kniga-7', '2015-08-03', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;', 0, 1),
(8, NULL, 12, 1, 0, 'Книга 8', 'автор', '0000-00-00', '', '', 'k-8', 340, NULL, NULL, NULL, NULL, 0, '', '', '', 'kniga-8', '2015-08-03', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;', 0, 1),
(9, NULL, 8, 1, 0, 'Книга 9', 'автор', '0000-00-00', '', '', 'k-9', 360, NULL, NULL, NULL, NULL, 0, '', '', '', 'kniga-9', '2015-08-03', '', '0.1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `recommended_products`
--

CREATE TABLE IF NOT EXISTS `recommended_products` (
  `product1_id` int(11) DEFAULT NULL,
  `product2_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `recommended_products`
--

INSERT INTO `recommended_products` (`product1_id`, `product2_id`) VALUES
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phones` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_string` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_description` text COLLATE utf8_unicode_ci NOT NULL,
  `site_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastmod` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `email`, `address`, `phones`, `admin_name`, `order_string`, `site_description`, `site_keywords`, `lastmod`) VALUES
(1, 'Книжный дом', 'info@bookhouse.ru', 'Санкт-Петербург, ул. Малая Конющенная, 5', '/812/380-73-00; /812/380-73-22', 'admin', 'Ваш заказ оформлен', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/p&gt;', '', '2015-07-13');

-- --------------------------------------------------------

--
-- Структура таблицы `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `link`, `type`, `sort`) VALUES
(3, 'Первый слайдер', '', 0, 0),
(4, 'Второй слайдер', '', 0, 0),
(5, 'Первый слайд на странице магазина', '', 1, 0),
(6, 'Второй слайд на странице магазина', '', 1, 0);

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
