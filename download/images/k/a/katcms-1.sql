-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 21 2014 г., 08:22
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
(2, 0, 1, 'Первая запись в блоге', 'Первая запись в блоге', '', '', 'pervaya-zapis-v-bloge', '<p>Текст первой записи в блоге</p>', '', '', '14.08.2014'),
(3, 0, 1, 'Вторая запись в блоге', '', '', '', 'vtoraja-zapis-v-bloge', '<p>Текст второй записи</p>', '', '', '20.07.2014'),
(4, 0, 1, 'Третья запись в блоге', '', '', '', 'tretja-zapis-v-bloge', '<p>Текст третьей записи в блоге</p>', '', '', '30.07.2014');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(5) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(2, 1, 'Водка', '', '', '', 'vodka', 0, '<p>В нашем каталоге вый найдете различные виды водок</p>'),
(3, 1, 'Пиво', '', '', '', 'pivo', 0, '<p>Пиво различных производителей</p>'),
(4, 1, 'Вино', '', '', '', 'vino', 0, '<p>В нашем асортименте вина различных производителей</p>'),
(7, 1, 'Светлое', '', '', '', 'svetloe', 3, ''),
(8, 1, 'Темное', '', '', '', 'temnoe', 3, ''),
(9, 1, 'Красное', '', '', '', 'krasnoe', 3, ''),
(12, 1, 'Россия', '', '', '', 'rossija', 7, ''),
(13, 1, 'Германия', '', '', '', 'germanija', 7, '');

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
('3bb2835a1303afd8f2da2c7a497fbda7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0', 1408448428, 'a:4:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"26";s:9:"user_name";s:5:"pavel";s:9:"logged_in";b:1;}'),
('aaae5c0d8982f3291ce173249f46808d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0', 1408457650, 'a:4:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"26";s:9:"user_name";s:5:"pavel";s:9:"logged_in";b:1;}');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `url`) VALUES
(10, 1, 'products', 15, '/p/s/pshenichnaya.jpg'),
(11, 1, 'categories', 2, '/w/o/wodkaflaschen.JPG'),
(18, 1, 'products', 18, '/b/e/beer-baltika-1.jpg'),
(20, 1, 'products', 17, '/8/-/8-70-baltik-1000x769.gif'),
(22, 1, 'products', 14, '/v/o/vodka-putinka-0-5l.jpg');

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
(1, 1, 'Блог', 'Блог', '', '', 'blog', 0, '<p>В блоге много интересных статей о разном бухле</p>'),
(2, 1, 'Новости', 'Новости', '', '', 'news', 0, '<p>Новости нашей компании.</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `description`, `publish_date`) VALUES
(14, 2, 1, 'Путинка', '', '', '', 'putinka', '<p>Патриотичная водка</p>', 0),
(15, 2, 1, 'Пшеничная', '', '', '', 'pshenichnaya', '<p>Классика русской водки</p>', 0),
(16, 2, 1, 'Смирнофф', '', '', '', 'smirnoff', '<p>Самая известная водка в мире</p>', 0),
(17, 12, 1, 'Балтика №0', '', '', '', 'baltika-0', '<p>Безалкогольное пиво. Для тех кто любит хряпнуть за рулем.</p>', 0),
(18, 12, 1, 'Балтика №1', '', '', '', 'baltika-1', '<p>Пиво какого не существует.</p>', 0),
(19, 12, 1, 'Балтика №2', '', '', '', 'baltika-2', '<p>Обычное светлое пиво</p>', 0),
(20, 12, 1, 'Балтика №3', '', '', '', 'baltika-3', '<p>Самое популярное пиво Балтика.</p>', 0),
(21, 8, 1, 'Балтика №4', '', '', '', 'baltika-4', '<p>Полутемное пиво от балтика</p>', 0),
(22, 12, 1, 'Балтика №5', '', '', '', 'baltika-5', '<p>Золотистое пиво</p>', 0),
(23, 8, 1, 'Балтика №6', '', '', '', 'baltika-6', '<p>Портер. Крепкое, темное пиво.</p>', 0),
(24, 12, 1, 'Балтика №7', '', '', '', 'baltika-7', '<p>Экспортное пиво.</p>', 0),
(25, 12, 1, 'Балтика №8', '', '', '', 'baltika-8', '<p>Нефильтрованое пиво от Балтика</p>', 0),
(26, 12, 1, 'Балтика №9', '', '', '', 'baltika-9', '<p>Крепкое пиво от Балтика</p>', 0);

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
(1, 'Сайт о годном бухле', 'На нешем сайте Вы найдете инфорцию о разном бухле', 'бухло, алкоголь, купить бухло', 0, '', 2, 6, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `secret`) VALUES
(26, 'pavel', 'fae0b27c451c728867a567e8c1bb4e53', 'luka_bass_king@inbox.ru', 'd41d8cd98f00b204e9800998ecf8427e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
