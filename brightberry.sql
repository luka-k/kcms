-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 10 2015 г., 16:07
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `brightberry`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `menu_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
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

INSERT INTO `articles` (`id`, `parent_id`, `name`, `menu_name`, `date`, `sort`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `url`) VALUES
(1, 0, 'О компании', 'О компании', '2015-02-06', 0, '', '', '', '', 'o-kompanii'),
(2, 1, 'Наши преимущества', 'Наши преимущества', '2015-02-06', 0, '', '', '', '', 'nashi-preimushestva'),
(3, 1, 'Новости', 'Новости', '2015-02-06', 0, '', '', '', '', 'novosti'),
(4, 1, 'Партнеры', 'Партнеры', '2015-02-06', 0, '', '', '', '', 'partnery'),
(5, 1, 'Скачать документы', 'Скачать документы', '2015-02-06', 0, '', '', '', '', 'skachat-dokumenty'),
(6, 2, 'bрайтbерри. Высший уровень', 'Высший уровень', '2015-02-06', 0, '<p><strong>Факторы, обуславливающие высокий уровень качества продукции и сервиса bрайтbерри:</strong></p>\r\n\r\n<p><img alt="img" src="http://109.234.154.10/images/advantages/1.png" style="float:left" /></p>\r\n\r\n<p style="margin-left:80px">Индивидуальный подход к каждому клиенту:</p>\r\n\r\n<ul style="margin-left:80px">\r\n	<li>bрайтbерри учитывает все пожелания заказчиков.</li>\r\n	<li>Специалисты bрайтbерри прикладывают все усилия, чтобы реализовать идеи заказчика.</li>\r\n	<li>Если технологии производства не позволяют реализовать какие-то из идей заказчика, осуществляется поиск компромисса.</li>\r\n</ul>\r\n\r\n<p><img alt="img" src="http://109.234.154.10/images/advantages/2.png" style="float:left" /></p>\r\n\r\n<p style="margin-left:80px">Использование лучшего сырья, материалов и комплектующих:</p>\r\n\r\n<ul style="margin-left:80px">\r\n	<li>Доска, металл, стекло высшего качества, от лучших производителей и поставщиков на рынке.</li>\r\n	<li>Клеи марки KLEIBERIT от немецкого производителя KLEBCHEMIE M.G.Becker GmbH & Co. KG (www.kleiberit.ru).</li>\r\n	<li>Лаки и краски от итальянского производителя SAYERLACK (www.sayerlack.it).</li>\r\n	<li>Фурнитура (замки, петли и т.д.) от производителей: AGB (Италия, www.agb.it), OTLAV (Италия, www.otlav.it).</li>\r\n</ul>\r\n\r\n<p><img alt="img" src="http://109.234.154.10/images/advantages/3.png" style="float:left" /></p>\r\n\r\n<p style="margin-left:80px">Использование профессионального оборудования известных европейских марок:</p>\r\n\r\n<ul style="margin-left:80px">\r\n	<li>Деревообрабатывающее оборудование от производителей: WEINIG (Германия, www.weinig.ru), GRIGGIO (Италия, www.griggio.ru), ROBLAND (Бельгия, www.robland.ru).</li>\r\n	<li>Малярное оборудование GESCHA (Германия, www.gescha.de).</li>\r\n</ul>\r\n\r\n<p><img alt="img" src="http://109.234.154.10/images/advantages/4.png" style="float:left" /></p>\r\n\r\n<p style="margin-left:80px">Максимальный уровень сложности применяемых технологий для обеспечения высокого качества продукции:</p>\r\n\r\n<ul style="margin-left:80px">\r\n	<li>Сложная переклейка древесины.</li>\r\n	<li>Использование только ценных пород древесины по всей глубине изделий.</li>\r\n	<li>Ручная шлифовка всех деталей.</li>\r\n	<li>Многоуровневая, подетальная окраска.</li>\r\n	<li>Отсутствие видимых элементов сборки и монтажа изделий.</li>\r\n</ul>\r\n\r\n<p>Максимальное использование ручного труда:</p>\r\n\r\n<ul>\r\n	<li>Ручной труд применяется на всех этапах производства и осуществляется под постоянным контролем соответствующих мастеров.</li>\r\n</ul>\r\n\r\n<p>Наличие высококвалифицированного персонала:</p>\r\n\r\n<ul>\r\n	<li>Все мастера имеют большой опыт работы и высокую квалификацию.</li>\r\n	<li>На производстве осуществляется строгий отбор сотрудников, умение и мастерство которых проверено годами.</li>\r\n</ul>\r\n\r\n<p>Креативный, творческий подход к работе главных мастеров, отвечающих за качество и красоту изделий:</p>\r\n\r\n<ul>\r\n	<li>Главные мастера - это творческие, разносторонне развитые люди, которые любят свою работу.</li>\r\n	<li>Специалисты bрайтbерри постоянно повышают своё мастерство и совершенствуют технологии производства.</li>\r\n</ul>\r\n\r\n<p>Собственный проектный отдел.</p>\r\n\r\n<p>Беспрецедентный контроль качества продукции и выполняемых услуг:</p>\r\n\r\n<ul>\r\n	<li>bрайтbерри – это небольшое семейное предприятие, объединившее коллектив единомышленников, желающих и способных производить изделия высокого качества и предоставлять своим клиентам высокий уровень сервиса, достойный их статуса.</li>\r\n	<li>Все мастера во время рабочего процесса находятся под постоянным наблюдением и контролем руководства компании. Даже незначительные дефекты при производстве и нарекания клиентов сразу выявляются, и принимаются меры к их устранению.</li>\r\n</ul>\r\n\r\n<p>Сотрудничество с надёжными партнёрами:</p>\r\n\r\n<ul>\r\n	<li>Компания bрайтbерри очень щепетильна в выборе партнёров.</li>\r\n	<li>В числе партнеров bрайтbерри - только компании и люди, зарекомендовавшие себя с лучшей стороны.</li>\r\n</ul>\r\n', '', '', '', 'brajtberri-vysshij-uroven'),
(7, 2, 'Высший уровень (лестницы)', 'Высший уровень (лестницы)', '2015-02-06', 0, '', '', '', '', 'vysshij-uroven-lestnicy');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(1, 1, 0, 'Объекты', '', '', '', 'obekty', 0, ''),
(2, 1, 0, 'Лестницы', '', '', '', 'lestnicy', 0, ''),
(3, 1, 0, 'Двери', '', '', '', 'dveri', 0, ''),
(4, 1, 0, 'Оформление помещений', '', '', '', 'oformlenie-pomeshenij', 0, ''),
(5, 1, 0, 'Мебель', '', '', '', 'mebel', 0, ''),
(6, 1, 0, 'Ковка', '', '', '', 'kovka', 0, ''),
(7, 1, 0, 'Дома', '', '', '', 'doma', 1, ''),
(8, 1, 0, 'Квартиры', '', '', '', 'kvartiry', 1, ''),
(9, 1, 0, 'Объекты бизнеса', '', '', '', 'obekty-biznesa', 1, ''),
(10, 1, 0, 'Государственные объекты', '', '', '', 'gosudarstvennye-obekty', 1, ''),
(11, 1, 0, 'Двери распашные', '', '', '', 'dveri-raspashnye', 3, ''),
(12, 1, 0, 'Двери раздвижные', '', '', '', 'dveri-razdvizhnye', 3, '');

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
('df98cb81e3127ba0126493b0e8674577', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423569966, 'a:3:{s:4:"user";O:8:"stdClass":7:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}');

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
(1, 'Верхнее меню', '');

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '2',
  `subject` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `type`, `subject`, `description`, `name`) VALUES
(1, 1, 'Новый заказ', 'Кллиент  %user_name% оформил заказ № %order_id%.', 'Администратору при заказе'),
(2, 1, 'Заказ %order_id% в интернет магазине', 'Менеджер свяжется с Вами %user_name%.', 'Клиенту при заказе'),
(3, 1, 'Статус Вашего заказа изменен', 'Уважаемый %user_name%.\r\nСтатус Вашего заказа %order_id% изменен на %order_status%', 'Клиенту при изменении статуса заказа'),
(4, 1, 'Регистрация в магазине', '%user_name%, спасибо за регистрацию в нашем магазине. \r\nВаш логин %login%\r\nВаш пароль %password%', 'При регистрации'),
(5, 1, 'Ваш пароль изменен', '%user_name%, Ваш пароль в интернет магазине изменен.\r\nНовые данный доступа\r\nВаш логин %login%\r\nВаш пароль %password%', 'При изменении пароля'),
(6, 1, 'Заказан обратный звонок', '', 'Обратный звонок');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `is_cover` int(1) NOT NULL DEFAULT '0',
  `object_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(2) NOT NULL,
  `is_main` int(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `is_main`, `sort`, `url`) VALUES
(13, 1, 'categories', 1, 0, 0, '/o/b/objects.jpg'),
(14, 0, 'categories', 1, 0, 0, '/o/b/objects-hover.jpg'),
(19, 1, 'articles', 2, 0, 0, '/a/d/advantages.png'),
(20, 1, 'articles', 3, 0, 0, '/n/e/news.png'),
(21, 1, 'articles', 4, 0, 0, '/p/a/parnters.png'),
(22, 1, 'articles', 5, 0, 0, '/d/o/download.png'),
(23, 0, 'articles', 5, 0, 0, '/d/o/download[1].png'),
(24, 1, 'settings', 1, 0, 0, '/n/o/no-photo-available.png'),
(25, 1, 'categories', 2, 0, 0, '/l/a/ladders.jpg'),
(26, 0, 'categories', 2, 0, 0, '/l/a/ladders-hover.jpg'),
(27, 1, 'categories', 3, 0, 0, '/d/o/doors.jpg'),
(28, 0, 'categories', 3, 0, 0, '/d/o/doors-hover.jpg'),
(29, 1, 'categories', 4, 0, 0, '/d/e/decoration.jpg'),
(30, 0, 'categories', 4, 0, 0, '/d/e/decoration-hover.jpg'),
(31, 1, 'categories', 5, 0, 0, '/f/u/furniture.jpg'),
(32, 0, 'categories', 5, 0, 0, '/f/u/furniture-hover.jpg'),
(33, 1, 'categories', 6, 0, 0, '/f/o/forging.jpg'),
(34, 0, 'categories', 6, 0, 0, '/f/o/forging-hover.jpg'),
(35, 1, 'categories', 7, 0, 0, '/h/o/houses.jpg'),
(36, 1, 'categories', 8, 0, 0, '/f/l/flats.jpg'),
(37, 1, 'categories', 9, 0, 0, '/b/u/busyness.jpg'),
(38, 1, 'categories', 10, 0, 0, '/g/o/goverment.jpg'),
(39, 1, 'products', 1, 1, 1, '/1/./1.jpg'),
(40, 0, 'products', 1, 1, 0, '/2/./2.jpg'),
(42, 0, 'products', 1, 1, 2, '/3/./3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `images2categories`
--

CREATE TABLE IF NOT EXISTS `images2categories` (
  `category_parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `images2categories`
--

INSERT INTO `images2categories` (`category_parent_id`, `child_id`) VALUES
(2, 39),
(11, 40),
(12, 42);

-- --------------------------------------------------------

--
-- Структура таблицы `mailouts`
--

CREATE TABLE IF NOT EXISTS `mailouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `users_ids` varchar(300) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(1, 1, 'Галерея', 0, 1, '', 'link', '/'),
(2, 1, 'Наши работы', 0, 2, '', 'link', '/works/'),
(3, 1, 'О компании', 0, 3, '', 'articles', 'o-kompanii'),
(4, 1, 'Каталог', 0, 4, '', 'link', '/'),
(5, 1, 'Контакты', 0, 5, '', 'link', '/'),
(6, 1, 'Новости', 0, 6, '', 'link', '/');

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
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `article` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `discount` int(2) NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_new` int(1) DEFAULT NULL,
  `is_special` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `sort`, `name`, `article`, `price`, `discount`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `short_description`, `description`, `is_new`, `is_special`) VALUES
(1, 7, 1, 0, 'Дом в Пушкине', '', 0, 0, '', '', '', 'dom-v-pushkine', '<p>Лестница из массива апшеронского дуба с кованной балюстрадой. Ручная художественная ковка. Архитектор &ndash; Белов Юрий.</p>', '<p>Текст об объекте. Для настоящих ценителей ручной работы bрайтbерри предлагает интерьерные коллекции от классики до авангарда. Для нас нет ничего невозможного. Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства.</p>\r\n\r\n<p>Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Для нас нет ничего невозможного. Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Для нас нет ничего невозможного. Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>', 0, 0),
(2, 7, 1, 0, 'Дом в Лисьем Носу', '', 0, 0, '', '', '', 'dom-v-lisem-nosu', '<p>Загородный дом с помещениями оформленными стеновыми панелями, лестницами и дверями выполненными из массива дуба.</p>', '<p>Текст об объекте. Для настоящих ценителей ручной работы bрайтbерри предлагает интерьерные коллекции от классики до авангарда. Для нас нет ничего невозможного. Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства.</p>\r\n\r\n<p>Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Для нас нет ничего невозможного. Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Для нас нет ничего невозможного. Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `order_string` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_offline` int(11) DEFAULT '0',
  `offline_text` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `description`, `order_string`, `site_description`, `site_keywords`, `site_offline`, `offline_text`) VALUES
(1, 'Интерьеры из дерева, производство мебели из дуба,  лестницы из массива, художественная ручная ковка - Брайтберри', 'admin@admin.ru', 'admin', '<p>Рекламный текст. Для настоящих ценителей ручной работы bрайтbерри предлагает интерьерные коллекции от классики до авангарда. Для нас нет ничего невозможного. Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>', 'Ваш заказ оформлен', '', '', 0, '');

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
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `address`, `secret`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.ru', '8-950-123-45', '', '');

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
(1, '1');

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
(2, 'customer', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
