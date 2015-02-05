-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 05 2015 г., 23:41
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
  `date` date NOT NULL,
  `sort` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

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
(10, 1, 0, 'Государственные объекты', '', '', '', 'gosudarstvennye-obekty', 1, '');

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
('00338237fc16bd6eb94fbe79bcb17a93', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423159203, ''),
('10d8da5105f29e0b5a8f853c5f853170', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423159206, ''),
('15c2352bde81253e2ebeb1feb0c0beb5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423159205, ''),
('17c6bbdb2b0216f7601a63406acc4266', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158792, ''),
('29b35cedc1be205d94dd96b959159609', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423159203, ''),
('2b81462573b76960063b7cc9c71cfc18', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158795, ''),
('3c195bc355aa54195ec85dde83649d4f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423159204, ''),
('3fd6500e366c149717e7a2e705054184', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158390, ''),
('4b225905561ac64ae9f56f02d77edbe8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158390, ''),
('4e3eb05b7ca23ba6e564af8c13806f3a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158390, ''),
('5399924ea780716d2098a741dbe8be60', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158795, ''),
('544b4e5a3df33923b6a5101967a98077', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158390, ''),
('562e8b45deb44bf8d0cab83462e77a3c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158390, ''),
('63d6300305c51f026c21fddae923f413', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423165242, 'a:4:{s:9:"user_data";s:0:"";s:4:"user";O:8:"stdClass":7:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}'),
('6b4bbe84c30f7868380b3d12987f2dd7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158390, ''),
('724389cda562d5de5cf3661357bc60f7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158390, ''),
('7311140b24a70444a2b964e0183e940c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423159204, ''),
('793252ac4e912778f6ce6f5fff68607f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423163480, 'a:3:{s:4:"user";O:8:"stdClass":7:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}'),
('a07e4a947c19a41b1603248e5859a0ee', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158794, ''),
('af5394a43bdd9fbd41f3309f6f4b3d0e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158390, ''),
('b3e79364a57fde45975b60d41302d3d6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158390, ''),
('d5a1d92bf170d124b3ef7006c207f4f0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423159205, ''),
('d9b4323e4db037db649cd2d4cfacbe52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423159203, 'a:4:{s:9:"user_data";s:0:"";s:4:"user";O:8:"stdClass":7:{s:2:"id";s:1:"1";s:4:"name";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:14:"admin@admin.ru";s:5:"phone";s:12:"8-950-123-45";s:7:"address";s:0:"";s:6:"secret";s:0:"";}s:9:"logged_in";b:1;s:11:"user_groups";a:1:{i:0;s:5:"admin";}}'),
('eb21c837b585e901b5560b7cbc05d24d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158792, ''),
('f2d5bd3438a73df0332ffdeab00fc4ec', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158390, ''),
('f579080147e5a06d51b38aa5b574f4f3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1423158795, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

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
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `is_cover`, `object_type`, `object_id`, `is_main`, `url`) VALUES
(1, 1, 'settings', 1, 0, '/n/o/no-photo-available.png'),
(6, 1, 'products', 1, 1, '/1/./1.jpg'),
(7, 0, 'products', 1, 1, '/2/./2.jpg'),
(8, 0, 'products', 1, 1, '/3/./3.jpg'),
(13, 1, 'categories', 1, 0, '/o/b/objects.jpg'),
(14, 0, 'categories', 1, 0, '/o/b/objects-hover.jpg');

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
(2, 1, 'Наши работы', 0, 2, '', 'link', 'http://kcms/works/'),
(3, 1, 'О компании', 0, 3, '', 'link', '/'),
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
(1, 'Интерьеры из дерева, производство мебели из дуба,  лестницы из массива, художественная ручная ковка - Брайтберри', 'admin@admin.ru', 'admin', '<p>Рекламный текст. Для настоящих ценителей ручной работы bрайтbерри предлагает интерьерные коллекции от классики до авангарда. Для нас нет ничего невозможного. Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>\r\n<p>Каждый предмет интерьера создается по индивидуальному заказу и является результатом совместного творчества из Ваших пожеланий и нашего мастерства. Вы можете быть уверены - вещь, заказанная у нас, уникальна. Так bрайтbерри создает неповторимый стиль и яркую индивидуальность Вашего дома.</p>', 'Ваш заказ оформлен', '', '', 0, '');

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
