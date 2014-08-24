-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 25 2014 г., 01:26
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `garage`
--

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
('34aa22186ab591b241ea720f0b91de4a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0', 1408914441, '');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `is_cover` int(1) NOT NULL DEFAULT '0',
  `object_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(2) NOT NULL,
  `image_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `image_type`, `url`) VALUES
(30, 1, 'partners', 1, '', '/v/d/vdygdfo0vru.jpg'),
(34, 1, 'works', 1, 'was', '/y/j/yjho2xk99oc.jpg'),
(35, 0, 'works', 1, 'in_work', '/m/e/metla.jpg'),
(36, 0, 'works', 1, 'result', '/v/d/vdygdfo0vru[1].jpg'),
(37, 1, 'works', 2, 'was', '/y/j/yjho2xk99oc[1].jpg'),
(38, 0, 'works', 2, 'in_work', '/m/e/metla[1].jpg'),
(39, 0, 'works', 2, 'result', '/v/d/vdygdfo0vru[2].jpg'),
(40, 1, 'works', 3, 'was', '/v/o/vodka-putinka-0-5l.jpg'),
(41, 0, 'works', 3, 'in_work', '/p/s/pshenichnaya.jpg'),
(42, 0, 'works', 3, 'result', '/b/e/beer-baltika-1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `partners`
--

INSERT INTO `partners` (`id`, `parent_id`, `title`, `link`) VALUES
(1, 0, 'Агрорусь', 'vk.com');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `parts`
--

INSERT INTO `parts` (`id`, `is_active`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(2, 1, 'Работы', '', NULL, NULL, 'works', 0, 'Перечень наших работ'),
(5, 0, 'Партнеры', '', NULL, NULL, 'partners', 0, 'Партнеры нашей компании');

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
(1, 'Гаражи', 'На нешем сайте Вы найдете инфорцию о разном бухле', 'бухло, алкоголь, купить бухло', 0, '', 2, 6, 1);

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

-- --------------------------------------------------------

--
-- Структура таблицы `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `vk_link` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`id`, `parent_id`, `title`, `time`, `price`, `name`, `text`, `vk_link`) VALUES
(1, 0, 'Гараж на ул. Кораблестроителей  во дворе д. 25', '1,5', '20000', 'Вячеслав', '<p>Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!</p>', 'vk.com'),
(2, 0, 'Гараж на ул. Кораблестроителей  во дворе д. 26', '2', '25000', 'Иван', '<p>Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!</p>', 'vk.com'),
(3, 0, 'Гараж на ул. Кораблестроителей  во дворе д. 27', '1', '15000', 'Игорь', '<p>Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!</p>', 'vk.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
