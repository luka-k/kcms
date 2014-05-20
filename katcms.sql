-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 21 2014 г., 01:55
-- Версия сервера: 5.1.71-community-log
-- Версия PHP: 5.4.20

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
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_desc` text COLLATE utf8_unicode_ci,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `root` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `cat_desc`, `url`, `root`) VALUES
(1, 'Первая категория', '<p>Описание первой категории</p>', 'pervaja-kategorija', 0),
(2, 'Вторая категория', '<p>Описание второй категории</p>', '', 0),
(3, 'Третья категория', '', 'tretja-kategorija', 0),
(4, 'Четвертая категория', '', '', 0),
(6, 'Пятая категория', '', 'pjataja-kategorija', 0);

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
('9a4e58bc05da2d056443a12daf83c4bc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36 OPR/21.0.1', 1400596938, 'a:4:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"26";s:9:"user_name";s:4:"stas";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expland_level` int(11) DEFAULT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `name`, `title`, `expland_level`, `status`) VALUES
(1, 'top_menu', 'Верхнее меню', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `menus_data`
--

CREATE TABLE IF NOT EXISTS `menus_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hidden` smallint(1) DEFAULT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `menus_data`
--

INSERT INTO `menus_data` (`id`, `menu_id`, `item_id`, `item_type`, `hidden`, `title`, `parent_id`, `url`) VALUES
(2, 1, 2, '1', 0, 'Второй', 0, 'glavnaja'),
(3, 0, NULL, '1', 0, 'Пятая', NULL, 'pjataja-stranica'),
(4, 0, NULL, '1', 0, 'Пятый', NULL, 'pjataja-stranica'),
(5, 0, NULL, '1', 0, 'Пятая', NULL, 'pjataja-stranica'),
(6, 0, NULL, '1', 0, 'Главная', NULL, 'glavnaja'),
(7, 0, NULL, '1', 0, 'Главная', NULL, 'glavnaja'),
(8, 0, NULL, '2', 0, 'Главная', NULL, 'pjataja-kategorija'),
(9, 0, NULL, '2', 0, 'Главная', NULL, 'pjataja-kategorija'),
(10, 0, NULL, '2', 0, 'Главная', NULL, 'pjataja-kategorija'),
(11, 0, NULL, '2', 0, 'Главная', NULL, 'pjataja-kategorija'),
(12, 1, NULL, '1', 0, 'Главная', NULL, 'glavnaja'),
(13, 1, NULL, '1', 0, 'Четвертая', NULL, 'chetvertaja-stranica');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `full_text` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `publish_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `cat_id`, `is_active`, `title`, `meta_title`, `keywords`, `description`, `url`, `full_text`, `status`, `autor`, `publish_date`) VALUES
(4, 1, 1, 'Третья', '', '', '', 'tretja', '<p>Текст третей страницы</p>', '1', '0', 0),
(5, 2, 1, 'Четвертая страница', 'Четвертая', '', '', 'chetvertaja-stranica', '<p>Текст четвертой страницы</p>', '1', '0', 0),
(6, 0, 0, 'Главная', '', '', '', 'glavnaja', '<p>Текст главной страницы</p>', '1', '0', 0),
(8, 0, 0, 'Пятая страница', '', '0', '0', 'pjataja-stranica', '<p>Содержимое пятой страницы</p>', '1', '0', 0),
(10, 1, 0, 'Шестая страница', 'Шестая', '', '', '0', '<p>Содержимое шестой страницы</p>', '1', '0', 0),
(11, 1, 0, 'Седьмая страница', 'Седьмая', '', '', 'sedmaja-stranica', '<p>Содержимое седьмой страницы</p>', '1', '0', 0),
(13, 0, 0, 'Восьмая страница', 'Восьмая', '', '', 'vosmaja-stranica', '<p>Текст восьмой страницы</p>', '1', '0', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `settings` (`id`, `site_title`, `site_description`, `site_keywords`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`) VALUES
(1, 'Пробный сайт', 'Описание пробного сайта', 'Клевый пробный сайт сайт', 0, 'Сайт на реконструкции', 2, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `secret`) VALUES
(26, 'stas', 'bcbe3365e6ac95ea2c0343a2395834dd', 'luka_bass_king@inbox.ru', '8d88b7257024d1d26fc50ea6b134e9e9'),
(27, 'pavel', 'bcbe3365e6ac95ea2c0343a2395834dd', 'luka-rabota@inbox.ru', ''),
(29, 'vasja', '698d51a19d8a121ce581499d7b701668', 'l@mail.ru', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
