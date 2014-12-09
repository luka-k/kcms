-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 10 2014 г., 00:13
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `lt-pro`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `menu_name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `direction` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lead_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lead_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `parent_id`, `name`, `menu_name`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`, `direction`, `lead_name`, `lead_email`) VALUES
(1, 0, 'Регистрируйтесь он-лайн', 'Cambridge', 0, '<p>С 1 сентября 2014 года на нашем сайте начинает работать он-лайн регистрация на экзамены Cambridge English и IELTS.</p>', '', '', '', 'cambridge', 'Руководитель направления Cambridge English', 'Петухов Михаил Сергеевич', 'm.petukhov@lt-pro.ru'),
(2, 0, 'Регистрируйтесь он-лайн', 'IELTS', 0, '', '', '', '', 'ielts', '', '', ''),
(3, 0, '', 'Pearson', 0, '', '', '', '', 'pearson', '', '', ''),
(4, 0, '', 'Study', 0, '', '', '', '', 'study', '', '', ''),
(5, 0, '', 'Book store', 0, '', '', '', '', 'book-store', '', '', ''),
(6, 0, '', 'Контакты', 0, '', '', '', '', 'kontakty', '', '', ''),
(7, 1, 'Новости Cambridge', 'Новости Cambridge', 0, '', '', '', '', 'novosti-cambridge', '', '', ''),
(8, 1, 'Экзамены', 'Экзамены', 0, '', '', '', '', 'ekzameny', '', '', ''),
(9, 2, '', 'Новости IELTS', 0, '', '', '', '', 'novosti-ielts', '', '', ''),
(10, 8, 'Стоимость', 'Стоимость', 0, '<p>О стоимости</p>', '', '', '', 'stoimost', '', '', ''),
(11, 1, 'BULATS — Business Language Testing Service', 'BULATS', 0, '<div class="entry">\r\n<p><a href="http://lt-pro.ru/wp-content/uploads/2013/10/1_masthead-e1383061712241.jpg"><img class="alignleft size-full wp-image-936" src="http://lt-pro.ru/wp-content/uploads/2013/10/1_masthead-e1383061712241.jpg" alt="1_masthead" width="700" height="105" /></a></p>\r\n<p><strong>BULATS</strong> &mdash; Business Language Testing Service&nbsp;<span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">система тестирования знания делового иностранного языка, разработанная специально для компаний и организаций, которые нуждаются в достоверной оценке уровня знаний иностранного языка своих сотрудников.</span></span></p>\r\n<p><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Данная система предназначена для определения уровня владения иностранным языком сотрудников, использующих его в работе, а также студентов и служащих во время обучения на языковых или бизнес курсах, где знание иностранного языка является неотъемлемой частью учебной программы.</span></span></p>\r\n<p><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Система тестирования предлагает:</span></span></p>\r\n<ul>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Эффективный и надежный языковой тест практической направленности;</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Организацию тестирования в соответствии с индивидуальными потребностями каждой компании;</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Быструю обработку и оценку результатов;&nbsp;&nbsp;</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Консультации по обработке результатов и дальнейшему обучению сотрудников.</span></span></li>\r\n</ul>\r\n<p><strong><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Тест BULATS &nbsp;&ndash;&nbsp;&nbsp;компьютерный тест &nbsp;&ndash; &nbsp;быстрое и надежное тестирование навыков чтения и восприятия на слух. Тест доступен на&nbsp;<span style="color: #ff8c00;">английском, французском, немецком и испанском языках</span>.</span></span></strong></p>\r\n<p><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Темы, на которых построено тестирование, отражают ситуации, с которыми сотрудники сталкиваются в своей рабочей практике, а именно:&nbsp;</span></span></p>\r\n<ul>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Служебные обязанности</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Компании и их продукция</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Путешествия</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Менеджмент и маркетинг</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Работа с клиентами</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Планирование</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Составление отчетов</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Телефонные разговоры</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Деловая переписка</span></span></li>\r\n<li><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Презентации</span></span></li>\r\n</ul>\r\n<p><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">&nbsp;Задания в тестах имеют общий практический характер, например: &nbsp;умение использовать иностранный язык для общения по телефону, написания писем, проведения презентаций, чтения статей или составления отчетов и др.</span></span></p>\r\n<p><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">Результаты: &nbsp;При оценке результатов тестирования в системе BULATS используется шкала ALTE Framework от 0 до 5, которая соответствует уровням A1-C2 общепринятой европейской шкалы уровней.</span></span></p>\r\n<p>Для получения сертификата о <strong>сдаче теста BULATS</strong> обращайтесь в международный центр тестирования LT-PRO.</p>\r\n</div>', '', '', '', 'bulats-business-language-testing-service', '', '', ''),
(12, 6, '', 'Информация', 0, '<p style="text-align: center;"><strong><span style="font-family: verdana,geneva,sans-serif;"><span style="font-size: 14px;">Банковские реквизиты:</span></span></strong></p>\r\n<h3 style="font-size: 1.3em; line-height: 1.3em; margin-top: 0.769em; margin-bottom: 0.769em; font-family: Arial, Tahoma, Verdana, Helvetica, &#39;Bitstream Vera Sans&#39;, sans-serif;"><span style="font-size: 12px;"><span style="font-family: verdana,geneva,sans-serif;">ИНН 7810183620 КПП 784101001 &nbsp;ОКПО 52205817 ОГРН 1037821014780<br /> Фактический адрес:&nbsp;191186, г. Санкт-Петербург, Невский пр-кт, д.22-24, лит. А<br /> Почтовый адрес:&nbsp;191186, г. Санкт-Петербург, ул.&nbsp;Малая&nbsp;Конюшенная, д. 5<br /> Расчетный счет&nbsp;№ 40702810855230150922 Северо-Западный банк&nbsp;Сбербанка&nbsp;РФ<br /> Центральное ОСБ&nbsp;1991/0786 г. Санкт-Петербург корр / счет&nbsp;30101810500000000653<br /> БИК 044030653<br /> Телефон/факс: 8 (812) 380-73-00,&nbsp;380-73-22,&nbsp;571-93-13</span></span></h3>', '', '', '', 'informaciya', '', '', ''),
(13, 6, '', 'Обратная связь', 0, '<p>Адрес: ул. Большая Конюшенная, д. 8<br /> Тел: (812) 244-54-88<br /> e-mail: info@lt-pro.ru</p>\r\n<p><a href="http://lt-pro.ru/wp-content/uploads/2013/08/%D0%BD%D0%BE%D0%B2%D0%B0%D1%8F-%D1%81%D1%85%D0%B5%D0%BC%D0%B0.jpg"><img class="alignleft size-medium wp-image-732" src="http://lt-pro.ru/wp-content/uploads/2013/08/%D0%BD%D0%BE%D0%B2%D0%B0%D1%8F-%D1%81%D1%85%D0%B5%D0%BC%D0%B0-300x202.jpg" alt="how" width="300" height="202" /></a></p>', '', '', '', 'obratnaya-svyaz', '', '', ''),
(14, 6, '', 'Новости lt-pro', 0, '', '', '', '', 'novosti-lt-pro', '', '', ''),
(15, 6, '', 'Наши партнеры', 0, '', '', '', '', 'nashi-partnery', '', '', ''),
(16, 3, '', 'Новости Pearson', 0, '', '', '', '', 'novosti-pearson', '', '', '');

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
('e54f0959728d700827ff046c3c28b56b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:33.0) Gecko/20100101 Firefox/33.0', 1418155843, 'a:5:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"27";s:9:"user_name";s:5:"admin";s:4:"role";s:5:"admin";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Структура таблицы `dynamic_menus`
--

CREATE TABLE IF NOT EXISTS `dynamic_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `url`) VALUES
(5, 1, 'articles', 1, '/c/a/cambridge.jpg'),
(13, 1, 'settings', 1, '/l/o/logo.png'),
(14, 1, 'slider', 1, '/0/1/0192.jpg'),
(15, 1, 'slider', 2, '/0/1/012l.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `sort`, `description`, `meta_title`, `meta_keywords`, `meta_description`, `url`) VALUES
(1, 'Пробная новость №1', 0, '<p>Текст пробной новости</p>', '', '', '', 'probnaya-novost-1'),
(2, 'Пробная новость №2', 0, '<p>Текст пробной новости 2</p>', '', '', '', 'probnaya-novost-2'),
(3, 'Пробная новость №3', 0, '', '', '', '', 'probnaya-novost-3');

-- --------------------------------------------------------

--
-- Структура таблицы `news2article`
--

CREATE TABLE IF NOT EXISTS `news2article` (
  `article_parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `news2article`
--

INSERT INTO `news2article` (`article_parent_id`, `child_id`) VALUES
(7, 2),
(7, 1),
(9, 1),
(7, 3),
(9, 3),
(14, 3);

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
  PRIMARY KEY (`id`)
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
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `site_description`, `site_keywords`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`) VALUES
(1, 'Пробный сайт', 'admin@admin.ru', 'admin', '', '', 0, '', 2, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `slider`
--

INSERT INTO `slider` (`id`, `description`) VALUES
(1, '<p>С 1 сентября 2014 года на нашем сайте начинает&nbsp;работать&nbsp;<a href="http://register.lt-pro.ru/">он-лайн регистрация </a></p>\r\n<p>на экзамены Cambridge English и IELTS.</p>\r\n<p>Удобный электронный сервис не только позволит вам пройти процедуру регистрации&nbsp;не выходя из дома, но и отслеживать все этапы экзамена в личном кабинете:</p>\r\n<p>- проверить статус заявки, оплату и ход рассмотрения анкетных данных</p>\r\n<p>- уточнить время и место проведения всех частей экзамена со схемами проезда и комментариями</p>\r\n<p>- узнать результаты&nbsp;</p>\r\n<p>и еще много полезных функций</p>'),
(2, '<div>\r\n<p>Вам достаточно <a href="http://lt-pro.ru/category/study/cambridge-placement-test/">оплатить онлайн</a>&nbsp;</p>\r\n<p>и получить по электронной почте</p>\r\n<p>код для активации теста.</p>\r\n<p>После оплаты вы получите подробные инструкции</p>\r\n<p>и доступ к пробной версии.&nbsp;</p>\r\n<p>Дополнительная информация по телефону: 244-54-88.</p>\r\n<p>Желаем удачи!</p>\r\n</div>');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribes`
--

CREATE TABLE IF NOT EXISTS `subscribes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `lt-pro` int(1) NOT NULL,
  `cambridge` int(1) NOT NULL,
  `pearson` int(11) NOT NULL,
  `ielts` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `subscribes`
--

INSERT INTO `subscribes` (`id`, `email`, `lt-pro`, `cambridge`, `pearson`, `ielts`) VALUES
(1, 'luka_bass_king@inbox.ru', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `address`, `role`, `secret`) VALUES
(27, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '8-950-123-45', '', 'admin', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
