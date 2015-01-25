-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 25 2015 г., 20:35
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `date`, `parent_id`, `name`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`) VALUES
(1, '2014-12-22', 5, 'Новости', 0, '', '', '', '', 'novosti'),
(2, '2014-12-23', 1, 'Выставки', 0, '<p><span style="color:rgb(0, 0, 0); font-family:myriad pro,sans-serif; font-size:16px">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quaerat ab et, maxime quo, maiores! Hic est explicabo porro eligendi doloribus veniam inventore asperiores deleniti nesciunt, delectus qui, aliquid eos.</span></p>\r\n', '', '', '', 'vystavki'),
(3, '2014-12-21', 0, 'Поддержка клиентов', 0, '', '', '', '', 'podderzhka-klientov'),
(4, '2014-12-21', 0, 'Где купить', 0, '', '', '', '', 'gde-kupit'),
(5, '2014-12-21', 0, 'О нас', 0, '', '', '', '', 'o-nas'),
(6, '2014-12-21', 0, 'Контакты', 0, '', '', '', '', 'kontakty'),
(7, '2014-12-23', 3, 'Авторизованные сервис центры', 0, '', '', '', '', 'avtorizovannye-servis-centry'),
(8, '2014-12-22', 1, 'Внедорожные мероприятия', 0, '', '', '', '', 'vnedorozhnye-meropriyatiya'),
(9, '2014-12-22', 5, 'История компании', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam doloribus tempore libero maxime voluptates voluptatem, ut beatae neque reprehenderit nulla perferendis doloremque, molestiae rem omnis dolorum officia suscipit, ea repellat!</p>\r\n', '', '', '', 'istoriya-kompanii'),
(10, '2014-12-22', 5, 'Производства', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia nesciunt similique eaque, ab ad quae molestiae fugit tempora aut. Magni, explicabo quam ratione praesentium veritatis distinctio aliquid dignissimos voluptatum repellendus.</p>\r\n', '', '', '', 'proizvodstva'),
(11, '2014-12-22', 5, 'Политика качества', 0, '', '', '', '', 'politika-kachestva'),
(12, '2014-12-22', 5, 'ЧА.ВО. / FAQ', 0, '', '', '', '', 'cha-vo-faq'),
(13, '2014-12-22', 5, 'Работа с магазином', 0, '', '', '', '', 'rabota-s-magazinom'),
(14, '2014-12-23', 2, 'Название мероприятия', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia nesciunt similique eaque, ab ad quae molestiae fugit tempora aut. Magni, explicabo quam ratione praesentium veritatis distinctio aliquid dignissimos voluptatum repellendus.</p>\r\n', '', '', '', 'nazvanie-meropriyatiya'),
(15, '2014-12-22', 8, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia nesciunt similique eaque, ab ad quae molestiae fugit tempora aut. Magni, explicabo quam ratione praesentium veritatis distinctio aliquid dignissimos voluptatum repellendus.</p>\r\n', '', '', '', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit'),
(16, '2014-12-29', 2, 'Название мероприятия 2', 0, '<p>Текст пробной новости</p>\r\n', '', '', '', 'nazvanie-meropriyatiya'),
(17, '2014-12-29', 8, 'Мероприятие три', 0, '<p>Текст пробной новости</p>\r\n', '', '', '', 'meropriyatie-tri'),
(18, '2014-12-29', 13, 'Информация', 0, '', '', '', '', 'informaciya'),
(19, '2014-12-29', 13, 'Оформление заказа', 0, '', '', '', '', 'oformlenie-zakaza'),
(20, '2014-12-29', 13, 'Информация о доставке', 0, '', '', '', '', 'informaciya-o-dostavke'),
(21, '2014-12-29', 13, 'Дисконтная система', 0, '', '', '', '', 'diskontnaya-sistema'),
(22, '2015-01-11', 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia nesciunt similique eaque, ab ad quae molestiae fugit tempora aut. Magni, Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia nesciunt similique eaque, ab ad quae molestiae fugit tempora aut. Magni,</p>\r\n', '', '', '', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(1, 1, 0, 'Колёсные диски', '', '', '', 'kolyosnye-diski', 0, ''),
(2, 1, 1, 'Диски колёсные легкосплавные', '', '', '', 'diski-kolyosnye-legkosplavnye', 1, ''),
(3, 1, 0, 'Диски колёсные штампованные', '', '', '', 'diski-kolyosnye-shtampovannye', 1, ''),
(4, 1, 0, 'Автоаксессуары', '', '', '', 'avtoaksessuary', 0, ''),
(5, 1, 0, 'Дефляторы', '', '', '', 'deflyatory', 4, ''),
(6, 1, 0, 'Канистры', '', '', '', 'kanistry', 4, ''),
(7, 1, 0, 'Проекторы', '', '', '', 'proektory', 4, ''),
(8, 1, 0, 'Ремонт шин', '', '', '', 'remont-shin', 4, ''),
(9, 1, 0, 'Системы крепления', '', '', '', 'sistemy-krepleniya', 4, '');

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
(1, 'use', 'AVT (Quatro Crazy)', 'products', 1),
(2, 'use', 'Водный транспорт (Mission Naval)', 'products', 2),
(3, 'use', 'Туризм (Country side)', 'products', 3),
(4, 'use', 'Промышленность (Mission SOS)', 'products', 3),
(5, 'use', 'Тяжелое бездорожье и внедорожный спорт (Mission Impossible)', 'products', 4),
(6, 'use', 'Промышленность (Mission SOS)', 'products', 5);

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
('41cd9d83104de63adc3288815f89ba1a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1422199234, ''),
('51cad0cbe87b37c6a79de7db05871583', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1422202975, 'a:6:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"27";s:9:"user_name";s:5:"admin";s:9:"logged_in";b:1;s:5:"group";a:1:{i:0;s:5:"admin";}s:13:"cart_contents";a:3:{s:5:"items";a:0:{}s:10:"cart_total";s:0:"";s:9:"total_qty";s:0:"";}}'),
('9929a7f4d33b105afa750bf3e43d5f2a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1422199234, '');

-- --------------------------------------------------------

--
-- Структура таблицы `dealers`
--

CREATE TABLE IF NOT EXISTS `dealers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `dealers`
--

INSERT INTO `dealers` (`id`, `name`, `region`) VALUES
(1, 'RedBTR-1', 'ch'),
(3, 'RedBTR-2', 'ch'),
(4, 'redBTR', 'ka'),
(5, '1', 'vl');

-- --------------------------------------------------------

--
-- Структура таблицы `dynamic_menus`
--

CREATE TABLE IF NOT EXISTS `dynamic_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `dynamic_menus`
--

INSERT INTO `dynamic_menus` (`id`, `name`, `description`) VALUES
(1, 'top_menu', '');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `name`, `type`, `subject`, `description`) VALUES
(1, 'Администратору при заказе', 1, 'Новый заказ', '<p>Кллиент %user_name% оформил заказ № %order_id%.</p>\r\n'),
(2, 'Клиенту при заказе', 1, 'Заказ %order_id% в интернет магазине', '<p>Менеджер свяжется с Вами %user_name%.</p>\r\n'),
(3, 'Клиенту при изменении статуса заказа', 1, 'Статус Вашего заказа изменен', '<p>Уважаемый %user_name%. Статус Вашего заказа %order_id% изменен на %order_status%</p>\r\n'),
(4, 'При регистрации', 1, 'Регистрация в магазине', '<p>%user_name%, спасибо за регистрацию в нашем магазине. Ваш логин %login% Ваш пароль %password%</p>\r\n'),
(5, 'При изменении пароля', 1, 'Ваш пароль изменен', '<p>%user_name%, Ваш пароль в интернет магазине изменен. Новые данный доступа Ваш логин %login% Ваш пароль %password%</p>\r\n'),
(6, 'Обратный звонок', 1, 'Заказан обратный звонок', ''),
(7, 'Пробный шаблон рассылки', 2, 'Пробное письмо', '<table border="1" cellpadding="1" cellspacing="1" style="width:500px">\r\n	<tbody>\r\n		<tr>\r\n			<td>ываываыу</td>\r\n			<td>ывыупыупы</td>\r\n		</tr>\r\n		<tr>\r\n			<td>ыпыупыуп</td>\r\n			<td>ыупыупы</td>\r\n		</tr>\r\n		<tr>\r\n			<td>ыпыупыупыуы</td>\r\n			<td>ыупыупыуп</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `filials`
--

INSERT INTO `filials` (`id`, `name`, `phone`, `caption`) VALUES
(1, 'Санкт-Петербург', '+7 (812) 999 99 99', 'время работы: пн-пт 10:00 - 18:00'),
(2, 'Сингапур', '+7 (812) 999 99 98', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `url`) VALUES
(1, 1, 'slider', 1, '/1/./1.jpg'),
(29, 0, 'products', 1, '/2/[/2[2].jpg'),
(30, 1, 'products', 1, '/1/[/1[1].jpg'),
(31, 1, 'products', 2, '/1/[/1[2].jpg'),
(32, 1, 'products', 3, '/2/[/2[3].jpg'),
(34, 1, 'products', 5, '/2/./2.jpg'),
(35, 1, 'products', 4, '/2/[/2[1].jpg'),
(36, 1, 'slider', 2, '/1/[/1[3].jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `mailouts`
--

INSERT INTO `mailouts` (`id`, `template_id`, `users_ids`, `mailouts_date`, `success`, `no_success`) VALUES
(1, 7, '1/2', '2015-01-25', 2, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

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
(8, 1, 'Авторизованные сервис центры', 7, 1, '', 'articles', 'avtorizovannye-servis-centry'),
(11, 1, 'Новости', 3, 0, '', 'articles', 'novosti'),
(12, 1, 'История компании', 3, 1, '', 'articles', 'istoriya-kompanii'),
(13, 1, 'Производства', 3, 2, '', 'articles', 'proizvodstva'),
(14, 1, 'Политика качества', 3, 4, '', 'articles', 'politika-kachestva'),
(15, 1, 'ЧА.ВО. / FAQ', 3, 5, '', 'articles', 'cha-vo-faq'),
(16, 1, 'Работа с магазином', 3, 3, '', 'articles', 'rabota-s-magazinom'),
(17, 1, 'Выставки', 11, 0, '', 'articles', 'vystavki'),
(18, 1, 'Внедорожные мероприятия', 11, 1, '', 'articles', 'vnedorozhnye-meropriyatiya'),
(19, 1, 'Как стать дилером', 2, 1, '', 'link', 'dealers'),
(20, 1, 'Информация', 16, 1, '', 'articles', 'informaciya'),
(21, 1, 'Оформление заказа', 16, 2, '', 'articles', 'oformlenie-zakaza'),
(22, 1, 'Информация о доставке', 16, 3, '', 'articles', 'informaciya-o-dostavke'),
(24, 1, 'Дисконтная система', 16, 4, '', 'articles', 'diskontnaya-sistema'),
(27, 1, 'Пункт меню', 7, 2, '', 'link', '000'),
(28, 1, 'Авторизованные сервис центры', 27, 1, '', 'articles', 'avtorizovannye-servis-centry'),
(29, 1, 'Регистрация', 7, 3, '', 'link', 'http://kcms/account/registration?activity=reg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `user_name`, `user_email`, `user_phone`, `user_address`, `message`, `city_id`, `total`, `delivery_id`, `payment_id`, `date`, `status_id`) VALUES
(1, '', 'pavel', '', '8-950-123-45-67', '', '', 0, 10500, 0, 0, '2015-01-10 00:00:00', 1),
(2, '', 'admin', '', '55555', '', '', 0, 10500, 0, 0, '2015-01-12 00:00:00', 1),
(3, '', 'admin', '', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', 0, 1080, 0, 0, '2015-01-13 00:00:00', 1),
(4, '', 'admin', '', '8-950-123-45-67', '', '', 0, 1500, 0, 0, '2015-01-13 00:00:00', 1),
(5, '', 'admin', '', '8-950-123-45', ' Санкт-Петербург Руднева д.5 к. кв.162', '', 0, 1500, 0, 0, '2015-01-13 00:00:00', 1),
(6, '', 'admin', '', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 кв.162', '', 0, 1080, 0, 0, '2015-01-13 00:00:00', 1),
(7, '', 'admin', 'admin@admin.ru', '85555555', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', 0, 1500, 0, 0, '2015-01-13 00:00:00', 1),
(8, '', 'pavel pavel', 'luk@mail.ru', '8-950-123-45-67', '  ', '', 0, 1080, 0, 0, '2015-01-13 00:00:00', 1),
(9, '31', 'pavel pavel', 'luk@mail.ru', '8-950-123-45-67', '  ', '', 0, 10500, 0, 0, '2015-01-13 00:00:00', 1),
(10, '31', 'pavel pavel', 'luk@mail.ru', '8-950-123-45-67', '  ', '', 0, 0, 0, 0, '2015-01-13 00:00:00', 1),
(11, '', 'pavel', '', '85555555', '  ', '', NULL, 1000, 0, 0, '2015-01-23 00:00:00', 1),
(12, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 1000, 0, 0, '2015-01-25 00:00:00', 1),
(13, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(14, '27', 'admin', 'admin@admin.ru', '4545454', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 1000, 0, 0, '2015-01-25 00:00:00', 1),
(15, '27', 'admin', 'admin@admin.ru', '123', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 1000, 0, 0, '2015-01-25 00:00:00', 1),
(16, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 1000, 0, 0, '2015-01-25 00:00:00', 1),
(17, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(18, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(19, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(20, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(21, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(22, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(23, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(24, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(25, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(26, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(27, '27', 'admin', 'admin@admin.ru', '8-950-123-45-67', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(28, '27', 'admin', 'admin@admin.ru', '4345345', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 1000, 0, 0, '2015-01-25 00:00:00', 1),
(29, '27', 'admin', 'admin@admin.ru', '4345345', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(30, '27', 'admin', 'admin@admin.ru', '4345345', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1),
(31, '27', 'admin', 'admin@admin.ru', '4345345', ' Санкт-Петербург Руднева д.5 к.1 кв.162', '', NULL, 0, 0, 0, '2015-01-25 00:00:00', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `order_qty`) VALUES
(1, '1', 1, 'Диск колесный', '10500', 1),
(2, '2', 1, 'Диск колесный', '10500', 1),
(3, '3', 3, 'Набор для ремонта шин', '1080', 1),
(4, '4', 4, 'Набор для ремонта безкамерных шин', '1500', 1),
(5, '5', 4, 'Набор для ремонта безкамерных шин', '1500', 1),
(6, '6', 3, 'Набор для ремонта шин', '1080', 1),
(7, '7', 4, 'Набор для ремонта безкамерных шин', '1500', 1),
(8, '8', 3, 'Набор для ремонта шин', '1080', 1),
(9, '9', 1, 'Диск колесный', '10500', 1),
(10, '11', 2, 'Канистра', '1000', 1),
(11, '12', 2, 'Канистра', '1000', 1),
(12, '14', 2, 'Канистра', '1000', 1),
(13, '15', 2, 'Канистра', '1000', 1),
(14, '16', 2, 'Канистра', '1000', 1),
(15, '28', 2, 'Канистра', '1000', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `is_new`, `is_good_buy`, `sort`, `name`, `article`, `warrant`, `price`, `discount`, `video`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `short_description`, `description`) VALUES
(1, 3, 1, 1, 0, 0, 'Диск колесный', 'dr001', '2', 15000, 30, 'yZcrcS6IiS4', '', '', '', 'disk-kolesnyj', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita . Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita . Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>\r\n'),
(2, 6, 1, 0, 1, 0, 'Канистра', 'к456', '2', 1000, 0, '', '', '', '', 'kanistra', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita . Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita . Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>\r\n'),
(3, 8, 0, 1, 1, 0, 'Набор для ремонта шин', 'sh678', '2', 1200, 10, '', '', '', '', 'nabor-dlya-remonta-shin', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita . Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita . Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>\r\n'),
(4, 8, 1, 1, 1, 1, 'Набор для ремонта безкамерных шин', 'sh456', '1', 1500, 0, '', '', '', '', 'nabor-dlya-remonta-bezkamernyh-shin', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita . Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita . Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>\r\n'),
(5, 7, 1, 1, 1, 0, 'Проектор', 'pr236', '2', 5000, 20, '', '', '', '', 'proektor', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita . Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita . Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `main_title`, `description`, `site_description`, `site_keywords`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`) VALUES
(1, 'RedBTR', 'info@redBTR.ru', 'admin', 'Продукция от компании redBTR', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum optio, voluptatem, atque ab consectetur sequi cum eius totam culpa vel magnam tempore similique beatae molestiae praesentium eum aperiam doloremque deleniti.similique beatae molestiae praesentium eum aperiam doloremque deleniti.</p>', '', '', 0, '', 2, 6, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `slider`
--

INSERT INTO `slider` (`id`, `sort`, `name`, `description`, `link`, `is_active`) VALUES
(1, 0, 'Заголовок рекламной акции-1', '<p>Краткое описание условий акции с переходом на страницу с полным текстом</p>\r\n', '#', 1),
(2, 0, 'Заголовок рекламной акции-2', '<p>Краткое описание условий акции с переходом на страницу с полным текстом</p>\r\n', '', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `last_name`, `name`, `patronymic`, `password`, `email`, `phone`, `city`, `street`, `house`, `building`, `apartment`, `zip_code`, `secret`) VALUES
(27, '', 'admin', '', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '', 'Санкт-Петербург', 'Руднева', '5', '1', '162', '', ''),
(31, '', 'pavel pavel', '', '698d51a19d8a121ce581499d7b701668', 'luk@mail.ru', '', '', '', '', '', '', '', '');

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
(2, '31');

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_edit` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`, `is_edit`) VALUES
(1, 'admin', 0),
(2, 'customers', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `video`
--

INSERT INTO `video` (`id`, `name`, `link`, `is_main`) VALUES
(1, 'Первое видео', '3bt1BjUm9mw', 1),
(2, 'Второе видео', 'yZcrcS6IiS4', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
