-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 13 2015 г., 22:26
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `express`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `parent_id`, `name`, `date`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`, `lastmod`, `changefreq`, `priority`) VALUES
(1, 0, 'Услуги', '2015-10-13', 0, '', '', '', '', 'uslugi', '2015-10-13', '', '0.1'),
(2, 1, 'Оценка недвижимости', '2015-10-13', 0, '<p>Оценка стоимости недвижимости это ответственная и важная работа для определения рыночной стоимости любого объекта в вашей или не в вашей собственности. Мы можем определить любой тип стоимости недвижимости. Наши сотрудники отлично знают рынок и все юридические нюансы оценки недвижимого имущества.</p>\r\n', '', '', '', 'ocenka-nedvizhimosti', '2015-10-13', '', '0.1'),
(3, 1, 'Оценка транспортных средств', '2015-10-13', 0, '<p>Оценка автомобиля после ДТП, это важная и ответственная работа, которая выполняется профессионалами и включает в себя несколько процедур. Наши специалисты определят точную стоимость ущерба на основе количества поврежденных элементов и утери товарной стоимости автомобиля. Вам будет что предъявить суду или страховой компании.</p>\r\n', '', '', '', 'ocenka-transportnyh-sredstv', '2015-10-13', '', '0.1'),
(4, 1, 'Оценка земельных участков', '2015-10-13', 0, '<p>Мы проводим процедуру оценки земельных участков любого назначения &ndash; от земель сельскохозяйственного назначения и земель населенных пунктов до особо охраняемых территорий и объектов и земель запаса. В оценке земельного участка мы руководствуемся большим опытом и законами Российской Федерации.</p>\r\n', '', '', '', 'ocenka-zemelnyh-uchastkov', '2015-10-13', '', '0.1'),
(5, 1, 'Оценка оборудования', '2015-10-13', 0, '<p>Оценка машин и оборудования поможет вам рассчитать и определить актуальную рыночную стоимость любого движимого имущества &ndash; приборов, автомобилей, станков, силовых агрегатов, оргтехники, бытовых предметов, мебели и других объектов. Наши специалисты-оценщики определят реальную рыночную стоимость.</p>\r\n', '', '', '', 'ocenka-oborudovaniya', '2015-10-13', '', '0.1'),
(6, 0, 'О компании', '2015-10-13', 0, '<p>Экспресс-Оценка &mdash; это молодая и амбициозная команда профессионалов. Не смотря на свой относительно юный возраст, мы заняли устойчивую позицию на рынке независимых оценок и экспертиз в разных отраслях. На сегодняшний день у нас работают офисы в Москве, Саратове, Вольске и Балаково. Главной ценностью нашей компании я считаю свою команду &ndash; каждый наш эксперт это высококвалифицированный специалист в отдельно взятой отрасли. Мы не делаем шаблонных универсальных оценок и не обещаем золотых гор. Мы умеем искать выход из любой нестандартной ситуации и отлично совмещаем высокую скорость работы с невысокими ценами на услуги. Обращайтесь к нам, если вы не удовлетворены качеством работы вашей страховой компании, покупаете или продаете недвижимость, стали жертвой пожара или затопления и в любых других случаях, в которых может понадобиться профессиональная независимая оценка.</p>\r\n\r\n<p><b>Кирилл Мандрика </b></p>\r\n', '', '', '', 'o-kompanii', '2015-10-13', '', '0.1');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
('31144a98e7332ae81bf500755289a0ec', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0', 1444764143, 'a:3:{s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:0:"";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}');

-- --------------------------------------------------------

--
-- Структура таблицы `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `documents`
--

INSERT INTO `documents` (`id`, `name`, `sort`) VALUES
(1, 'Свидетельство ФНС', 0),
(2, 'Выписка №17', 0),
(3, 'Свидетельство СОНП', 0),
(4, 'Сертификат соответствия судебного эксперта', 0);

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
(1, 'Меню админ панели', '');

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
-- Структура таблицы `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(11) NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_type_object_id` (`object_type`,`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `name`, `file_type`, `object_type`, `object_id`, `url`) VALUES
(43, 'avtoexp_man_kasko.pdf', 'pdf', 'testimonials', 5, '/a/v/avtoexp-man-kasko.pdf'),
(45, 'stroit_fundament_alekseevka.pdf', 'pdf', 'testimonials', 6, '/s/t/stroit-fundament-alekseevka.pdf');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `sort`, `name`, `is_cover`, `object_type`, `object_id`, `image_type`, `url`) VALUES
(2, 0, 'doc2', 1, 'documents', 2, '', '/d/o/doc2.jpg'),
(3, 0, 'doc3', 1, 'documents', 3, '', '/d/o/doc3.jpg'),
(4, 0, 'doc4', 1, 'documents', 4, '', '/d/o/doc4.jpg'),
(5, 0, 'popular1', 1, 'articles', 2, '', '/p/o/popular1.png'),
(6, 0, 'popular2', 1, 'articles', 3, '', '/p/o/popular2.png'),
(7, 0, 'popular3', 1, 'articles', 4, '', '/p/o/popular3.png'),
(8, 0, 'popular4', 1, 'articles', 5, '', '/p/o/popular4.png'),
(9, 0, 'ots1', 1, 'testimonials', 1, '', '/o/t/ots1.png'),
(14, 0, 'ots2', 1, 'testimonials', 6, '', '/o/t/ots2.jpg'),
(15, 0, 'company', 1, 'articles', 6, '', '/c/o/company.jpg'),
(16, 0, 'mandrika', 1, 'users', 2, '', '/m/a/mandrika.png'),
(18, 0, 'doc1', 1, 'documents', 1, '', '/d/o/doc1.jpg'),
(19, 0, 'ivanov', 1, 'users', 3, '', '/i/v/ivanov.png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(4, 1, '<i class=icon-home></i>', 0, 0, '', 'link', 'admin/'),
(5, 1, 'Статьи', 0, 1, '', 'link', '#'),
(6, 1, 'Каталог', 0, 2, '', 'link', '#'),
(7, 1, 'Заказы', 0, 5, '', 'link', 'admin/admin_orders'),
(8, 1, 'Настройки', 0, 8, '', 'link', '#'),
(9, 1, 'Рассылки', 0, 6, '', 'link', '#'),
(10, 1, 'Меню', 8, 5, '', 'link', 'admin/menu_module/menus'),
(11, 1, 'Пользователи', 0, 7, '', 'link', '#'),
(12, 1, 'Все статьи', 5, 1, '', 'link', 'admin/content/items/articles'),
(13, 1, 'Категории', 6, 1, '', 'link', 'admin/content/items/categories/'),
(14, 1, 'Создать категорию', 6, 2, '', 'link', 'admin/content/item/edit/categories'),
(15, 1, 'Товары', 6, 3, '', 'link', 'admin/content/items/products/all'),
(16, 1, 'Создать товар', 6, 4, '', 'link', 'admin/content/item/edit/products'),
(17, 1, 'Настройки сайта', 8, 10, '', 'link', 'admin/content/items/settings'),
(19, 1, 'Шаблоны', 9, 1, '', 'link', 'admin/content/items/emails/2'),
(20, 1, 'Рассылки', 9, 2, '', 'link', 'admin/mailouts_module'),
(21, 1, 'Системные письма', 9, 3, '', 'link', 'admin/content/items/emails/1'),
(22, 1, 'Пользователи', 11, 1, '', 'link', 'admin/users_module/'),
(23, 1, 'Группы пользователей', 11, 2, '', 'link', 'admin/content/items/users_groups/all'),
(24, 1, 'Характеристики', 6, 5, '', 'link', 'admin/content/items/characteristics_type/all'),
(36, 1, 'Документы', 0, 3, '', 'link', 'admin/content/items/documents/'),
(37, 1, 'Отзывы', 0, 4, '', '', 'admin/content/items/testimonials/');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniq_text_id` text COLLATE utf8_unicode_ci NOT NULL,
  `string_value` text COLLATE utf8_unicode_ci NOT NULL,
  `text_value` text COLLATE utf8_unicode_ci NOT NULL,
  `image_value` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `uniq_text_id`, `string_value`, `text_value`, `image_value`) VALUES
(1, 'site_title', 'Экспресс-Оценка', '', ''),
(2, 'per_page', '20', '', ''),
(3, 'slogan', 'Мы даем финансовые гарантии', '', ''),
(4, 'phone', '+74957403780', '', ''),
(5, 'email', 'mail@ocenkaexp.ru', '', ''),
(6, 'main_autoexpertiza', 'Автоэкспертиза', '<p>Независимая автоэкспертиза пригодится людям, оказавшимся в сложных ситуациях. Например, если вы попали в ДТП и сомневаетесь в намерении страховой компании покрыть весь ущерб. Автоэкспертиза экономит время деньги и нервы.</p>\r\n', ''),
(7, 'main_nedvigimost', 'Оценка недвижимости', '<p>Наши специалисты быстро и качественно проведут оценку любой недвижимости. Мы проводим все типы оценки и работаем с объектами любой сложности. Процедуру оценки проводят аккредитованные специалисты.</p>\r\n', ''),
(8, 'main_zaliv', 'Оценка ущерба от заливов', '<p>Если по вине соседей или коммунальных служб, на вас обрушилась вода, то вам пригодится данная услуга. Мы поможем урегулировать вопрос о возмещении ущерба, определив его реальную стоимость, с учетом рынка и уровня повреждений.</p>\r\n', ''),
(9, 'main_ocenka', 'Оперативная оценка', 'Выезжаем на место сразу же после получения заявки. Вы получаете результат оценки за 2 дня\r\n', ''),
(10, 'main_finance', 'Финансовые гарантии', 'Возвращаем деньги в тройном размере, в случае если суд не принимает наш отчет\r\n', ''),
(11, 'main_zatrat', 'Никаких дополнительных затрат', 'Консультации и юридическое сопровождение включены в стоимость\r\n', ''),
(12, 'main_about', 'Мандрика Кирилл', 'Дорогие друзья! Меня зовут Кирилл Мандрика и я представляю вашему вниманию мою компанию &ndash; Экспресс-Оценка. Основывая эту фирму, я ориентировался, прежде всего, на свою квалификацию и профессионализм моих коллег, поэтому в основе нашей команды прочный фундамент из профессионалов своего дела. За время работы мы заслужили большое доверие среди своих клиентов: к нам обращаются, нас рекомендуют, нам доверяют. Сегодня мы настолько уверены в своих силах, что готовы вернуть деньги в тройном размере, если суд не примет нашу оценку.\r\n', ''),
(13, 'facts_money', '135<span>млн.</span>', 'рублей получено нашими клиентами в судах\r\n', ''),
(14, 'facts_expertiz', '2075', 'экспертиз проведено на сегодняшний день\r\n', ''),
(15, 'facts_procent', '97%', 'судебных решений в пользу клиентов', ''),
(16, 'facts_time', '3<span>часа</span>', 'минимальное время получения отчета с момента заявки\r\n', ''),
(17, 'inn', '1632015444', '', ''),
(18, 'ogrn', '1151677000155', '', ''),
(19, 'ya_map', 'https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=-sWnEnK6EaMhNKFFguXnrM9YGxmB6bb3&width=100%&height=400&lang=ru_UA&sourceType=constructor', '', ''),
(20, 'advances_finance', 'Фининсовые гарантии', 'Если документы не примет суд – возвращаем деньги в тройном размере', ''),
(21, 'advances_zatrat', 'Никаких дополнительных затрат', 'Наличие собственного подразделения юристов, консультация которых входит в стоимость услуги', ''),
(22, 'advances_sotrudniki', 'Профессиональные сотрудники', 'Профессиональный штат сотрудников с опытом более 5 лет, прошедших специальное обучение', ''),
(23, 'advances_ocenka', 'Оперативная оценка', 'Оперативный выезд на место, оценка до 2-х дней', ''),
(24, 'advances_opit', 'Опыт более 5 лет', 'Опыт более 5 лет, проведено более 1000 экспертиз', ''),
(25, 'advances_expertiza', 'Индивидуальная экспертиза', 'У нас нет шаблонов - каждая экспертиза прорабатывается индивидуально', '');

-- --------------------------------------------------------

--
-- Структура таблицы `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `title`, `description`, `sort`) VALUES
(1, 'Кирилл Гвоздик', 'Независимая техническая экспертиза транспортного средства МАН-БМЦ-57,6 - TGS40/400 6X4 . Решался вопрос о выплате страхового возмещения по договору КАСКО.', '<p>Кирилл провел оценку очень быстро, буквально за 1 день, как и обещал. Отчет в суде приняли, сумму выплатили полностью. Рекомендую.</p>\r\n', 0),
(6, 'Соня Кутепова', 'Экспертиза по определению марки бетона, использованного при заливке ленточного фундамента отдельно стоящего дома, находящегося по адресу: Саратовская обл., Хвалынский р-н, п. Алексеевка.', '<p>Это были вторые оценщики, к которым я обращалась. Первые долго думали, потом отказались. &quot;Экспресс-Оценка&quot; сделали оценку без лишних вопросов и заморочек. Хорошие специалисты.</p>\r\n', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `rank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `vk_link` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `valid_email` tinyint(1) NOT NULL DEFAULT '0',
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `sort`, `name`, `rank`, `password`, `email`, `vk_link`, `phone`, `description`, `valid_email`, `secret`) VALUES
(1, 0, 'admin', '', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '', '', '', 0, ''),
(2, 0, 'Мандрика Кирилл', 'Руководитель, эксперт-оценщик', '698d51a19d8a121ce581499d7b701668', 'k.mandrika@ocenkaexp.ru', 'http://vk.com/id18295847', '+7 (925) 281-94-95', '', 0, ''),
(3, 0, 'Иванов Александр', 'Ведущий специалист', 'bcbe3365e6ac95ea2c0343a2395834dd', 'a.ivanov@ocenkaexp.ru', '', '+7 (495) 740-37-80', '', 0, '');

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
(1, 1),
(3, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_edit` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`, `is_edit`) VALUES
(1, 'admin', 0),
(2, 'customer', 0),
(3, 'сотрудники', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
