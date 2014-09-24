-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 24 2014 г., 11:15
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
-- Структура таблицы `calculator`
--

CREATE TABLE IF NOT EXISTS `calculator` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `unit` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `calculator`
--

INSERT INTO `calculator` (`id`, `title`, `description`, `price`, `unit`) VALUES
(1, 'Общивка вагонкой', '<p>Небольшое описание позиции. Так же как и квартира, дом или любое другое строение, гараж нуждается в качественном и своевременном ремонте. Для заядлых автомобилистов гараж являеться вторым домом, где можно посвятить время ремонту и тюнингу. Небольшое описание позиции. Так же как и квартира, дом или любое другое строение, гараж нуждается в качественном и своевременном ремонте. Для заядлых автомобилистов гараж являеться вторым домом, где можно посвятить время ремонту и тюнингу.</p>', 250, 2),
(2, 'Тестовая услуга 1', '<p>Небольшое описание позиции. Так же как и квартира, дом или любое другое строение, гараж нуждается в качественном и своевременном ремонте. Для заядлых автомобилистов гараж являеться вторым домом, где можно посвятить время ремонту и тюнингу. Небольшое описание позиции. Так же как и квартира, дом или любое другое строение, гараж нуждается в качественном и своевременном ремонте. Для заядлых автомобилистов гараж являеться вторым домом, где можно посвятить время ремонту и тюнингу.</p>', 325, 1),
(4, 'Тестовая услуга 2', '<p>Небольшое описание позиции. Так же как и квартира, дом или любое другое строение, гараж нуждается в качественном и своевременном ремонте. Для заядлых автомобилистов гараж являеться вторым домом, где можно посвятить время ремонту и тюнингу.</p>', 0, 1);

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
('ada8495a1e6557010a4815b39178802c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:32.0) Gecko/20100101 Firefox/32.0', 1411542640, 'a:4:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"26";s:9:"user_name";s:5:"pavel";s:9:"logged_in";b:1;}'),
('e21b2d0f8884ac466c2cd7adbc01503a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:32.0) Gecko/20100101 Firefox/32.0', 1411535549, 'a:4:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"26";s:9:"user_name";s:5:"pavel";s:9:"logged_in";b:1;}');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=105 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `image_type`, `url`) VALUES
(49, 1, 'partners', 0, '', '/t/e/tehnonikol.jpg'),
(73, 1, 'works', 2, 'was', '/r/a/raboti-1[1].png'),
(74, 0, 'works', 2, 'in_work', '/r/a/raboti-2[1].png'),
(75, 0, 'works', 2, 'result', '/r/a/raboti-3[1].png'),
(79, 1, 'works', 3, 'was', '/r/a/raboti-1[2].png'),
(80, 0, 'works', 3, 'in_work', '/r/a/raboti-2[2].png'),
(81, 0, 'works', 3, 'result', '/r/a/raboti-3[2].png'),
(93, 1, 'works', 1, 'was', '/r/a/raboti-1.png'),
(94, 0, 'works', 1, 'in_work', '/r/a/raboti-2.png'),
(95, 0, 'works', 1, 'result', '/r/a/raboti-3.png'),
(96, 1, 'partners', 5, '', '/t/e/tehnonikol[1].jpg'),
(97, 1, 'partners', 6, '', '/m/e/metrika.jpg'),
(98, 1, 'partners', 7, '', '/o/b/obi.jpg'),
(99, 1, 'partners', 8, '', '/m/a/maksidom.jpg'),
(100, 1, 'partners', 9, '', '/l/o/logo-castorama.jpg'),
(101, 1, 'works', 4, 'was', '/r/a/raboti-1[3].png'),
(102, 0, 'works', 4, 'in_work', '/r/a/raboti-2[3].png'),
(103, 1, 'works', 0, 'was', '/r/a/raboti-1[4].png'),
(104, 0, 'works', 0, 'in_work', '/r/a/raboti-2[4].png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `partners`
--

INSERT INTO `partners` (`id`, `parent_id`, `title`, `link`) VALUES
(5, 0, 'ТехноНИКОЛЬ', 'http://www.tn.ru/'),
(6, 0, 'Метрика', 'http://spb.metrika.ru/'),
(7, 0, 'Оби', 'http://www.obi.ru/decom/home.html'),
(8, 0, 'Максидом', 'http://maxidom.ru/'),
(9, 0, 'Castorama', 'http://castorama.ru/');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `parts`
--

INSERT INTO `parts` (`id`, `is_active`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(2, 1, 'Работы', '', NULL, NULL, 'works', 0, 'Перечень наших работ'),
(5, 0, 'Партнеры', '', NULL, NULL, 'partners', 0, 'Партнеры нашей компании'),
(6, 1, 'Калькулятор', '', NULL, NULL, 'calculator', 0, 'Настройкии калькулятора');

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
  `file` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `site_description`, `site_keywords`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`, `file`) VALUES
(1, 'Гаражи', '', '', 0, '', 2, 6, 1, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`id`, `parent_id`, `title`, `time`, `price`, `name`, `text`, `vk_link`) VALUES
(1, 0, 'Гараж на ул. Кораблестроителей  во дворе д. 25', '1,5', '20000', 'Вячеслав', '<p>Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!</p>', 'vk.com'),
(2, 0, 'Гараж на ул. Кораблестроителей  во дворе д. 26', '2 месяца', '25000', 'Иван', '<p>Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!</p>', 'vk.com'),
(3, 0, 'Гараж на ул. Кораблестроителей  во дворе д. 27', '1 месяц', '15000', 'Игорь', '<p>Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!</p>', 'vk.com'),
(4, 0, 'Гараж на ул. Кораблестроителей  во дворе д. 28', '3 месяца', '20000', 'Анатолий', '<p>Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!</p>', 'vk.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
