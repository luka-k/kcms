-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 30 2015 г., 01:28
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ribaweb`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
('e9bd461f27d331e99328b9f6654bdbbd', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1440887212, 'a:4:{s:9:"user_data";s:0:"";s:4:"user";O:8:"stdClass":8:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:11:"valid_email";s:1:"0";s:6:"secret";s:32:"f556de45badbca0264ee68f418a42265";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}');

-- --------------------------------------------------------

--
-- Структура таблицы `dynamic_menus`
--

CREATE TABLE IF NOT EXISTS `dynamic_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `dynamic_menus`
--

INSERT INTO `dynamic_menus` (`id`, `name`, `description`) VALUES
(1, 'Меню админ панели', ''),
(2, 'Верхнее меню', '');

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
(1, 1, 'У вас новый заказ %product_name%', '<p>У вас новый заказ %product_name%:<br />\r\n<br />\r\nИмя: <strong>%name%</strong><br />\r\nИнфа: <strong>%product_name%</strong><br />\r\nМыло: <strong>%mail%</strong><br />\r\nТелефон: <strong>%phone%</strong><br />\r\nСообщение: <strong>%memessage%</strong><br />\r\n<br />\r\nСейчас: %date%</p>\r\n', 'Администратору при заказе'),
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
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_type_object_id` (`object_type`,`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `is_cover`, `object_type`, `object_id`, `image_type`, `url`, `sort`) VALUES
(4, 'umagz', 1, 'portfolio', 1, '', '/u/m/umagz.jpg', 0),
(5, 'web1', 1, 'portfolio', 2, '', '/w/e/web1.jpg', 0),
(6, 'web3', 1, 'portfolio', 3, '', '/w/e/web3.jpg', 0),
(7, 'web2', 1, 'portfolio', 4, '', '/w/e/web2.jpg', 0),
(8, 'web6', 1, 'portfolio', 5, '', '/w/e/web6.png', 0),
(9, 'web5', 1, 'portfolio', 6, '', '/w/e/web5.png', 0),
(10, 'web6', 1, 'portfolio', 7, '', '/w/e/web6.jpg', 0),
(11, 'web4', 1, 'portfolio', 8, '', '/w/e/web4.png', 0),
(12, 'egg', 1, 'portfolio', 9, '', '/e/g/egg.png', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Дамп данных таблицы `menus_items`
--

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort`, `description`, `item_type`, `url`) VALUES
(1, 4, 'Блог', 0, 1, '', 'articles', 'blog'),
(2, 4, 'Новости', 0, 0, '', 'articles', 'novosti'),
(4, 1, '<i class=icon-home></i>', 0, 0, '', 'link', 'admin/'),
(5, 1, 'Статьи', 0, 1, '', 'link', '#'),
(7, 1, 'Заказы', 0, 3, '', 'link', 'admin/admin_orders'),
(8, 1, 'Настройки', 0, 4, '', 'link', '#'),
(9, 1, 'Рассылки', 0, 5, '', 'link', '#'),
(10, 1, 'Меню', 0, 6, '', 'link', 'admin/menu_module/menus'),
(11, 1, 'Пользователи', 0, 7, '', 'link', '#'),
(12, 1, 'Все статьи', 5, 1, '', 'link', 'admin/content/items/articles'),
(17, 1, 'Настройки сайта', 8, 10, '', 'link', 'admin/content/item/edit/settings/1'),
(19, 1, 'Шаблоны', 9, 1, '', 'link', 'admin/content/items/emails/2'),
(20, 1, 'Рассылки', 9, 2, '', 'link', 'admin/mailouts_module'),
(21, 1, 'Системные письма', 9, 3, '', 'link', 'admin/content/items/emails/1'),
(22, 1, 'Пользователи', 11, 1, '', 'link', 'admin/users_module/'),
(23, 1, 'Группы пользователей', 11, 2, '', 'link', 'admin/content/items/users_groups/all'),
(33, 4, 'Контакты', 0, 17, '', 'link', 'contacts/'),
(34, 4, 'Каталог', 0, 18, '', 'link', 'catalog/'),
(35, 2, 'Главная', 0, 19, '', 'link', 'index'),
(36, 2, 'Услуги', 0, 20, '', 'link', '#'),
(37, 2, 'Наши проекты', 0, 21, '', 'link', 'nashi_proekty'),
(38, 2, 'FAQ', 0, 22, '', 'link', 'faq'),
(39, 2, 'О нас', 0, 23, '', 'link', 'o_nas'),
(40, 2, 'Контакты', 0, 24, '', 'link', 'kontakty'),
(41, 2, 'Бизнес под ключ', 36, 25, '', 'link', 'biznes_po_klyuch'),
(42, 2, 'Совместный бизнес', 36, 26, '', 'link', 'sovmestnyj_biznes'),
(43, 2, 'Прочие услуги', 36, 27, '', 'link', 'prochie_uslugi'),
(44, 1, 'Проекты', 0, 2, '', 'link', 'admin/content/items/portfolio/all');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `product_name`, `mail`, `phone`, `message`, `date`) VALUES
(1, '', '', '', '', '', '2015-08-29 00:00:00'),
(2, '', '', '', '', '', '2015-08-29 00:00:00'),
(3, 'test', 'kcms/index.php - Заказать звонок', '', '+7 (123) 456-7890', 'test', '2015-08-29 00:00:00'),
(4, 'test', 'kcms/index.php - Заказать звонок', '', '+7 (123) 456-7890', 'test', '2015-08-30 00:00:00'),
(5, 'test', 'kcms/index.php - Заказать звонок', '', '+7 (123) 456-7890', 'test', '2015-08-30 00:00:00'),
(6, '', 'kcms/index.php - Получить книгу', '', '', '', '2015-08-30 00:00:00'),
(7, 'test', 'kcms/index.php - Получить книгу', 'test@test.ru', '', '', '2015-08-30 00:00:00'),
(8, 'test', 'kcms/index.php - Оставить заявку', '', '+7 (123) 456-7890', 'test', '2015-08-30 00:00:00'),
(9, 'tst', 'kcms/index.php - Задать вопрос', 'test@test.ru', '', 'test', '2015-08-30 00:00:00'),
(10, 'test', 'kcms/index.php - Оставить заявку', '', '+7 (123) 456-7890', 'test', '2015-08-30 00:00:00'),
(11, '', 'kcms/index.php - Получить книгу', '', '', '', '2015-08-30 00:00:00'),
(12, 'test', 'kcms/index.php - Получить книгу', 'test@test.ru', '', '', '2015-08-30 00:00:00'),
(13, 'test', 'kcms/index.php - Получить книгу', 'test@test.ru', '', '', '2015-08-30 00:00:00'),
(14, 'test', 'kcms/index.php - Получить книгу', 'test@test.ru', '', '', '2015-08-30 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL,
  `in_work` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `portfolio`
--

INSERT INTO `portfolio` (`id`, `is_active`, `in_work`, `name`, `sort`, `short_description`, `description`) VALUES
(1, 1, 0, 'u-bags.ru', 1, '&lt;p&gt;Сайт: &lt;a href=&quot;http://u-bags.ru/&quot;&gt;www.u-bags.ru&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Тип проекта: Интернет-бизнес под ключ&lt;/p&gt;\r\n\r\n&lt;p&gt;Срок реализации: 1,5 месяца&lt;/p&gt;\r\n\r\n&lt;p&gt;Ежемесячные расходы магазина: 15 000&lt;/p&gt;\r\n\r\n&lt;p&gt;Чистая прибыль: 250 000 рублей в месяц&lt;/p&gt;', 'Интернет-магазин сумок U-bags был убыточным, увядающим проектом. Практически весь бюджет уходил на рекламу. Мы переработали рекламную компанию, сократив ее расходы на 60% и увеличив прибыль магазина на 400%. Нами был разработан новый дизайн и уникальное торговое предложение. Кроме того, мы переработали весь функционал сайта. Фактически, клиент получил новый интернет-магазин.'),
(2, 1, 0, 'Healthy Eyes', 0, '&lt;p&gt;Сайт: &lt;a href=&quot;http://healthyeyes-russia.ru/&quot;&gt;www.healthyeyes-russia.ru&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Тип проекта: Бизнес под ключ&lt;/p&gt;\r\n\r\n&lt;p&gt;Срок реализации: 2 месяца&lt;/p&gt;\r\n\r\n&lt;p&gt;Прибыль после третьего месяца работы: 87 000 рублей&lt;/p&gt;\r\n\r\n&lt;p&gt;Ежемесячные расходы: 15 000 рублей&lt;/p&gt;', '&lt;p&gt;Healthy Eyes это красивый одностраничный сайт с предложением купить очки-массажер. Очки позиционируются как оригинальный американский бренд. Для проекта был разработан уникальный дизайн и продуманна рекламная компания с учетом конъюнктуры рынка.&lt;/p&gt;'),
(3, 1, 0, 'Сайт по продаже автозапчастей Камминз', 2, '&lt;p&gt;Сайт: &lt;a href=&quot;http://cummins.detali360.ru/&quot;&gt;www.cummins.detali360.ru&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Тип проекта: Лэндинг в поддержку сайта&lt;/p&gt;\r\n\r\n&lt;p&gt;Срок реализации: 1 месяц&lt;/p&gt;\r\n\r\n&lt;p&gt;Ежемесячные расходы лэндинга: 20 000 рублей&lt;/p&gt;\r\n\r\n&lt;p&gt;Чистая прибыль: 180 000 рублей в месяц&lt;/p&gt;', '&lt;p&gt;Дополнительный одностраничник большого проекта detali360.ru который существует уже несколько лет. Несмотря на наличие собственного интернет-магазина, работу с несколькими компаниями по продвижению, рекламе на яндекс-маркете и других ресурсах, розничные продажи авто-деталей оставляли желать лучшего. Мы собрали данные обо всех бизнес-процессах, истории компании и преимуществах. На основе этих данных мы сделали лэндинг, на котором сформировали уникальное торговое предложение.&lt;/p&gt;'),
(4, 1, 0, 'Сервис для предпринимателей Delivery-planet', 3, '&lt;p&gt;Сайт: Проект временно приостановлен&lt;/p&gt;\r\n\r\n&lt;p&gt;Тип проекта: Разработка технического решения&lt;/p&gt;\r\n\r\n&lt;p&gt;Срок реализации: 2 месяца&lt;/p&gt;\r\n\r\n&lt;p&gt;Результат сразу после реализации: 4 оптовых заказа в первую неделю&lt;/p&gt;', '&lt;p&gt;Мы разработали новую концепцию бизнеса, для клиента у которого были хорошие связи с китайскими партнерами. Не смотря на отличные контракты и два действующих интернет магазина, наш клиент не получал ощутимой прибыли. Мы придумали, как получить максимум прибыли из его возможностей. Разработанный сервис Delivery-planet это удобный агригатор для предпринимателей. Сервис собрал более 400 000 товаров на одном сайте. Delivery-planet, предлагал минимальные цены напрямую от поставщика, без дополнительных накруток. Кроме того, была возможность предложить свою цену за товар.&lt;/p&gt;'),
(5, 1, 0, 'Сайт для компании «Аксиома»', 4, '&lt;p&gt;Сайт: &lt;a href=&quot;http://aksioma-t.ru&quot;&gt;www.aksioma-t.ru&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Тип проекта: Сайт под ключ&lt;/p&gt;\r\n\r\n&lt;p&gt;Результаты: Выход компании на новый уровень работы, долгосрочные контракты&lt;/p&gt;', '&lt;p&gt;Компания &amp;laquo;Аксиома&amp;raquo; оказывает транспортные и таможенные услуги. Основные направления работы компании это доставка любых грузов от &amp;laquo;двери к двери&amp;raquo; в удобные для клиента сроки, таможенное оформление импортных грузов, экспедирование и сертификация. Перед нами стояла задача разработки качественного сайта, не используя при этом &amp;laquo;фотографий глобального масштаба&amp;raquo;, как это принято на сайтах такой тематики. Мы сделали простой сайт с красивым дизайном, написали хорошие тексты и сформировали &amp;laquo;точки касания&amp;raquo;. Перед дизайнером так же стояла задача отрисовки иконок в соответствии с бренд-буком компании и компоновки всех элементов в единый продукт.&lt;/p&gt;'),
(6, 1, 0, 'MAISON DE REEFUR', 5, '&lt;p&gt;Сайт: &lt;a href=&quot;http://maisondereefur.ru/&quot;&gt;www.maisondereefur.ru&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Тип проекта: Бизнес под ключ&lt;/p&gt;\r\n\r\n&lt;p&gt;Проект в разработке.&lt;/p&gt;', '&lt;p&gt;Maison de reefur это японский бренд аксессуаров и одежды класса премиум, сооснователем которого является дизайнер Maison Michel. Сайт представляет собой многостраничный интернет-магазин предлагающий шикарные уникальные товары. В настоящее время проект в разработке.&lt;/p&gt;'),
(7, 1, 0, 'Wow-presents', 6, '&lt;p&gt;Сайт: &lt;a href=&quot;http://www.wow-presents.me/&quot;&gt;www.wow-presents.me&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Тип проекта: Бизнес под ключ с гарантией&lt;/p&gt;\r\n\r\n&lt;p&gt;Проект в разработке.&lt;/p&gt;', '&lt;p&gt;Wow-presents это интернет магазин необычных подарков для тех кто любит удивлять и удивляться. К примеру, можно подарить другу сумку-клатч в виде окровавленного топора, сумка будет в коробке с изображением друга. Предложения меняются в зависимости от спроса и близости различных праздников. Оказалось, что сумка пользуется особой популярностью.&lt;/p&gt;'),
(8, 1, 0, 'Choco Teddy', 7, '&lt;p&gt;Сайт: &lt;a href=&quot;http://choco-teddy.ru/&quot;&gt;www.choco-teddy.ru&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Тип проекта: Собственный проект&lt;/p&gt;\r\n\r\n&lt;p&gt;Хотите стать дилером Choco Teddy и продавать этих мишек? &lt;a href=&quot;http://ribaweb.ru/joint-business.php#win1&quot;&gt;Оставьте заявку&lt;/a&gt;. Спешите быть в первых рядах, скоро это будет дорогой и популярный бренд!&lt;/p&gt;', '&lt;p&gt;Choco Teddy это популярный в Европе и Азии бренд. Эти необыкновенные медведи появились 3 года назад в Японии и в отличие от аксессуаров Hello Kitty, полюбились более взрослым, современным девочкам. Мы первые в России, кто заключил контракт с производителями Choco Teddy и привезли Teddy в Петербург. Проект оправдал себя в первые два месяца. Сегодня мы продаем франшизы и открываем торговые точки.&lt;/p&gt;'),
(9, 1, 0, 'Ваш будущий проект', 8, '&lt;p&gt;Тип проекта: Бизнес под ключ&lt;/p&gt;\r\n\r\n&lt;p&gt;Срок реализации: 2 месяца&lt;/p&gt;\r\n\r\n&lt;p&gt;Прибыль после третьего месяца работы: около 50000 рублей&lt;/p&gt;\r\n\r\n&lt;p&gt;Инвестиции: 99000 рублей&lt;/p&gt;', '&lt;p&gt;Вы тоже можете зарабатывать на том, что вам интересно. Мы готовы создать для вас интернет-проект в любой тематике, начиная от лендингов по продаже товаров из Китая и заканчивая сложными стартапами. Оставьте заявку и мы найдем, что вам предложить!&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `article` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `recommended_products`
--

CREATE TABLE IF NOT EXISTS `recommended_products` (
  `product1_id` int(11) DEFAULT NULL,
  `product2_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `site_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `site_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastmod` date NOT NULL,
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

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `order_string`, `site_description`, `site_keywords`, `lastmod`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`) VALUES
(1, 'IT бизнес-агентство RIBA', 'admin@admin.ru', 'admin', 'Ваш заказ оформлен', '', '', '2015-08-28', 0, '', 2, 6, 1);

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
