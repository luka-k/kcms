-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 07 2014 г., 14:05
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mywaymin`
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
(2, 0, 1, 'Первая запись в блоге', 'Первая запись в блоге', '', '', 'pervaya-zapis-v-bloge', '<p>Текст первой записи в блоге</p>', '', '', '03.09.2014'),
(3, 0, 1, 'Вторая запись в блоге', '', '', '', 'vtoraja-zapis-v-bloge', '<p>Текст второй записи</p>', '', '', '20.07.2014'),
(4, 0, 1, 'Третья запись в блоге', '', '', '', 'tretja-zapis-v-bloge', '<p>Текст третьей записи в блоге</p>', '', '', '30.07.2014');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(5) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `is_active`, `sort`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(16, 0, 0, 'Standalone', '', '', '', 'standalone', 0, '<p>This section is reserved for miniatures not currently related to any specific themed project.</p>'),
(17, 0, 0, 'Creatures', '', '', '', 'creatures', 0, '<p>In this section we gather various creatures that are hard to specify, born both by our imagination or under inspiration.</p>'),
(18, 0, 0, 'Bits', '', '', '', 'bits', 0, '');

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
('cab5b951eda0a1ee28b240f40f5e9cad', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:33.0) Gecko/20100101 Firefox/33.0', 1415354607, 'a:6:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"27";s:9:"user_name";s:5:"admin";s:4:"role";s:5:"admin";s:9:"logged_in";b:1;s:13:"cart_contents";a:3:{s:5:"items";a:0:{}s:10:"cart_total";s:0:"";s:9:"total_qty";s:0:"";}}');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `type`, `subject`, `description`) VALUES
(1, 'admin_order', 'Новый заказ', 'Кллиент  %user_name% оформил заказ № %order_id%.'),
(2, 'customer_order', 'Заказ %order_id% в интернет магазине', 'Менеджер свяжется с Вами %user_name%.'),
(3, 'change_order_status', 'Статус Вашего заказа изменен', 'Уважаемый %user_name%.\r\nСтатус Вашего заказа %order_id% изменен на %order_status%'),
(4, 'registration', 'Регистрация в магазине', '%user_name%, спасибо за регистрацию в нашем магазине. \r\nВаш логин %login%\r\nВаш пароль %password%'),
(5, 'change_password', 'Ваш пароль изменен', '%user_name%, Ваш пароль в интернет магазине изменен.\r\nНовые данный доступа\r\nВаш логин %login%\r\nВаш пароль %password%'),
(6, 'callback', 'Заказан обратный звонок', '');

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
(37, 1, 'products', 27, '/r/o/ronin-1.JPG'),
(38, 0, 'products', 27, '/r/o/ronin-2.JPG'),
(39, 0, 'products', 27, '/r/o/ronin-3.jpg'),
(40, 0, 'products', 27, '/r/o/ronin-4.jpg'),
(41, 0, 'products', 27, '/r/o/ronin-5.jpg'),
(42, 0, 'products', 27, '/r/o/ronin-6.jpg'),
(43, 0, 'products', 27, '/r/o/ronin-7.jpg'),
(44, 0, 'products', 27, '/r/o/ronin-8.jpg'),
(45, 1, 'products', 28, '/b/o/bo-1.JPG'),
(46, 0, 'products', 28, '/b/o/bo-2.JPG'),
(47, 0, 'products', 28, '/b/o/bo-3.JPG'),
(48, 0, 'products', 28, '/b/o/bo-4.JPG'),
(53, 1, 'slider', 2, '/s/l/slider-2.jpg'),
(54, 1, 'slider', 1, '/s/l/slider-3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `information`
--

CREATE TABLE IF NOT EXISTS `information` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `information`
--

INSERT INTO `information` (`id`, `title`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'Order and Delivery', '<p><span style="font-size: 22px;">To order something from MyWay Miniatures you need to follow this simple steps:</span></p>\r\n<p><span style="font-size: 26px;"><strong><a name="Filling_your_cart"></a>Filling your cart</strong></span></p>\r\n<p><span style="font-size: 22px;">Add all the wanted items to your cart by using <span style="color: #843a36;">"add to: cart"</span> option. To add more than one copy of an item enter desired value in the <span style="color: #843a36;">"quantity"</span> box next to the price tag. Those items will appear in the <span style="color: #843a36;">"CART"</span> section on the right side of the screen. You can remove an item from the cart buy clicking the <span style="color: #843a36;">"X"</span> button near its name.</span></p>\r\n<p><span style="font-size: 22px;">The shipping price is fixed and is always shown in the <span style="color: #843a36;">"CART"</span> section, for more information on shipping and delivery look in the corresponding section below</span></p>\r\n<p><span style="font-size: 22px;">When you''ve added all the wanted items push the <span style="color: #843a36;">"CHECK OUT"</span> to proceed. In case of one-item order use the <span style="color: #843a36;">"BUY NOW"</span> option to go directly to check out.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="font-size: 26px;"><strong><a name="Checking_out"></a>Checking out</strong></span></p>\r\n<p><span style="font-size: 22px;">This step is devided in to four screens. First is the <span style="color: #843a36;">"Summary"</span> screen where you can edit your cart by removing items and changing quantity.</span></p>\r\n<p><span style="font-size: 22px;">On the next screen you can login with the existing MyWay account or create one by filling up registration form. This step is purely optional and you can proceed without logging, but doing so will let you store your postal information for further purchases.</span></p>\r\n<p><span style="font-size: 22px;">Then you have to provide delivery and contact information by filling up boxes on the <span style="color: #843a36;">"Address"</span> page.</span></p>\r\n<p><span style="font-size: 22px;">To submit your payment please click the <span style="color: #843a36;">"Buy Now"</span> button on the last page and follow instructions of the PayPal system.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="font-size: 26px;"><strong><a name="Delivery"></a>Delivery method</strong></span></p>\r\n<p><span style="font-size: 22px;">At MyWay Miniatures we use Russian Post servises to deliver orders. Packages are send via regular mail from Saint-Petersburg within 2-3 workdays after the payment unless noted otherwise.</span></p>\r\n<p><span style="font-size: 22px;">Delivery time depends on the distance and quality of the postal services. As an example - it usally takes around two weeks for a package to reach Great Britian.</span></p>\r\n<p><span style="font-size: 22px;">If you wish to use a different delivery method please <a href="http://mywayminiatures.com/contact-us/"><span style="color: #843a36;">contact us</span></a> BEFORE making an order.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="font-size: 26px;"><strong><a name="Risks_and_solutions"></a>Possible risks and solutions</strong></span></p>\r\n<p><span style="font-size: 22px;">MyWay Miniatures cannot take responsibility for package loss or damage during postal transfer. Please make sure to provide the correct shipping address and additional contacts to help minimize the risks.</span></p>\r\n<p><span style="font-size: 22px;">We do our best to protect your orders by using sturdy cardboard boxes with bubble wrap stuffing and tough padded envelopes:</span></p>\r\n<p><span style="font-size: 22px;"><img src="https://lh5.googleusercontent.com/-ReVJmx4tSjE/Uxd_yiLrcyI/AAAAAAAACzs/GLYSqp9foCM/w654-h491-no/Pack1.JPG" alt="Cardboard box" width="594" height="446" /></span></p>\r\n<p><span style="font-size: 22px;"><img src="https://lh3.googleusercontent.com/-7vofr6U3viM/Uxd_yjnBrrI/AAAAAAAACzc/bgjEycBxgo0/w654-h491-no/Pack2.JPG" alt="Padded envelope" width="594" height="446" /></span></p>\r\n<p><span style="font-size: 22px;">To help you track package movements we provide an international post tracking number on your e-mail as soon as your order is sent. You can use services like <span style="color: #843a36;"><a href="http://www.track-trace.com/post"><span style="color: #843a36;">track-trace.com</span></a></span>&nbsp;to see the status of your delivery.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="font-size: 26px;"><strong><a name="Prices"></a>Prices</strong></span></p>\r\n<p><span style="font-size: 22px;">Standard shipping cost used at our store is determined by Russian post tariffs and is actual for packages with total weight under 0,5 kg. Unfortunately we are unable to determine the exact weight of an individual package before we process and pack that order. If your package resulting weight exeeds this limit we will contact you to regulate the issue and work out a solution.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="font-size: 26px;"><strong><a name="Returns"></a>Returns and complaints</strong></span></p>\r\n<p><span style="font-size: 22px;">According to Russian Federal Laws current period for returning goods without defects is 7 days after the package is received by the customer.&nbsp;To be accepted the returned products must be intact and in their original wrapping.</span></p>\r\n<p><span style="font-size: 22px;">To claim a refund, the buyer should <span style="color: #843a36;"><a href="http://mywayminiatures.com/contact-us/"><span style="color: #843a36;">contact us</span></a></span>&nbsp;stating the reason for the return and provide information about redelivery. The customer will be responsible for redelivery shipping costs. Funds will be transfered to the customers account within 10 days after the returned product is recieved by MyWay Miniatures.</span></p>\r\n<p><span style="font-size: 22px;">&nbsp;</span></p>\r\n<p><span style="font-size: 22px;">For complaints and suggestions about our products and services please <span style="color: #843a36;"><a href="http://mywayminiatures.com/contact-us/"><span style="color: #843a36;">contact us</span></a></span>&nbsp;describing the issue and we''ll do our best to improve the situation.</span></p>', 'order_and_delivery', '', '', ''),
(2, 'Legal Notice ', '<div id="content">\r\n<p><strong><span style="font-size: 26px;">Website copyright</span></strong></p>\r\n<p><span style="font-size: 22px;">All the copyrights regarding the content of this website like graphic design are exclusively owned by MyWay Miniatures, which has the exclusive right to promote them.</span></p>\r\n<p><span style="font-size: 22px;">Therefore, the reproduction, distribution, publicity and use of, in whole or in part, is prohibited, without the express permission of Roman Tarasov or Alexander Zigle. In the same way, all trade names, trademarks or distinctive signs of any kind contained in this website are protected by law.</span></p>\r\n</div>', 'legal_notice', '', '', ''),
(3, 'About us', '<p><span style="font-size: 22px;">MyWay Miniatures is a small, two-man Russian based company producing collectable miniatures for anyone who takes interest in this form of art.</span></p>\r\n<p><span style="font-size: 22px;">We are Alexander Zigle and Roman Tarasov and before we became artists we were hobbyists. Through years of modeling experience we formed a solid opinion on what we like about hobby market and what we don''t. We realise that the best way to change things is to do them the only way that matters - your way! As name implies we started MyWay Miniatures to share our artistic vision with fellow modelers, collectors and gamers throughout the world.</span></p>\r\n<p><span style="font-size: 22px;">Our products are high-resolution resin casts of our own sculpts and we work hard to ensure quality of each individual copy. All miniatures are supplied as a multi-part kit unpainted and unassembled. Some degree of skill and additional instruments are required to put the parts together. Due to small size and materials used we do not recomend this products for children under 12.</span></p>\r\n<p><span style="font-size: 22px;">We are always open for new ideas and projects, so if you feel like we can help each other please <span style="color: #843a36;"><a href="http://mywayminiatures.com/contact-us/"><span style="color: #843a36;">contact us</span></a></span>!</span></p>', 'about_us', '', '', ''),
(4, 'Help', '', 'help', '', '', ''),
(5, 'Announcement', '<div id="content">\r\n<p><span style="font-size: 22px;">We''ve been reported about our email not receiving some letters. If you have any difficulty trying to reach us via email, please, use the <a href="http://mywayminiatures.com/contact-us/"><span style="color: #843a36;">Contact Us</span></a> form here on the website.</span></p>\r\n<p><span style="font-size: 22px;">We are very sorry for such a complication.</span></p>\r\n<p><span style="font-size: 22px;">-------------------------------------------------------------------------</span></p>\r\n<p><span style="font-size: 22px;">We are proud to announce, that weapon team is now complete and available for purchase! While each character is available separately we prepared two bundled offers on a reduced price:</span></p>\r\n<p><span style="font-size: 22px;">- the <span style="color: #843a36;"><a href="http://mywayminiatures.com/catalog/creatures/weapon-team"><span style="color: #843a36;">Weapon Team</span></a></span> bundle containing all four weapon miniatures for 36 euro. Thus you get each character for 9 euro instead of regular 11.</span></p>\r\n<p><span style="font-size: 22px;">- the <span style="color: #843a36;"><a href="http://mywayminiatures.com/catalog/creatures/collectors-pack"><span style="color: #843a36;">Collectors Pack</span></a></span> for 40 euro also contains all weapons, but with a scenic display specially crafted to house and show off those miniatures in a cool and convenient way. The scenic display is made from resin and has slots for mini bases for each character. This display base is only available as a part of Collectors Pack bundle and cannot be purchased separately.</span></p>\r\n<p><span style="font-size: 22px;">We are extremely grateful to all who supported us by purchasing previously released mutants individually. As a token of appreciation we are willing to offer those customers a chance to order missing characters as well as the collectors edition display on a discount price. To do so, please send us the list of wanted items on: <span style="color: #843a36;">Order@MyWayMiniatures.com</span> via the same e-mail you used for previous purchase and we''ll send you a direct invoice.</span></p>\r\n</div>', 'main', '', '', '');

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
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_first_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` text COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` text COLLATE utf8_unicode_ci NOT NULL,
  `user_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_postal` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `tracking_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_id` int(11) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `date` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_phone`, `user_country`, `user_region`, `user_city`, `user_address_1`, `user_address_2`, `user_postal`, `total`, `delivery_id`, `tracking_number`, `payment_id`, `payment_date`, `date`, `status_id`) VALUES
(1, '545c84e3be055', '28', 'pavel', 'lukinsky', 'luka_bass_king@inbox.ru', '8-950-014-71-25', 'Russia', '', 'Spb', '', '', '', 15, 0, '', 0, NULL, '2014-11-07 00:00:00', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `order_qty`) VALUES
(1, '545c84e3be055', 27, 'Ronin', '9', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `parts`
--

INSERT INTO `parts` (`id`, `is_active`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `parent_id`, `description`) VALUES
(3, 1, 'Слайдер', 'Слайдер', NULL, NULL, 'slider', 0, NULL),
(4, 0, 'Информация', '', '', '', 'information', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `article` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `parent_id`, `is_active`, `sort`, `title`, `article`, `price`, `meta_title`, `meta_keywords`, `meta_description`, `url`, `description`) VALUES
(27, 16, 0, 0, 'Ronin', 'TK001', 9, '', '', '', 'ronin', '<p>Dangerous mercenary and a bounty hunter, Ronin is a grim fella with a grim past, covered in a fog of mystery. Yet a little is known, but some speaks he''s the only one survivor of once powerful but destroyed order and now he ought to wander all across the galaxy without master and grand purpose.</p>\r\n<p>HD resin cast, 35mm, 1/64 scale, comes in 4 pieces, including additional weapon option.&nbsp;Base not included.</p>\r\n<p>Sculpted and painted by Roman Tarasov.</p>'),
(28, 17, 0, 0, 'Bo ', 'WT001', 11, '', '', '', 'bo', '<p>Bo staff and its mystical wielder - a city legend, a shadow''s disciple, a genius. HD resin cast, 26mm, 1/64 scale, comes in 3 pieces.&nbsp;Base not included. Sculpted by Alexander Zigle, painted by Roman Tarasov.</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `shipping` int(3) NOT NULL,
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

INSERT INTO `settings` (`id`, `site_title`, `admin_email`, `admin_name`, `shipping`, `site_description`, `site_keywords`, `site_offline`, `offline_text`, `main_page_type`, `main_page_id`, `main_page_cat`) VALUES
(1, 'MyWay Miniatures -Custom miniatures and bits for gamers and collectors', 'admin@admin.ru', 'admin', 6, 'Описание пробного сайта', 'сайт, пробный сайт', 0, '', 2, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(1) NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `slider`
--

INSERT INTO `slider` (`id`, `title`, `is_active`, `link`) VALUES
(1, 'Слайдер №1', 1, 'http://kcms/catalog/creatures'),
(2, 'Слайдер №2', 1, 'http://mywayminiatures.com/catalog/standalone');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `region` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `address_1` text COLLATE utf8_unicode_ci NOT NULL,
  `address_2` text COLLATE utf8_unicode_ci NOT NULL,
  `postal` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `country`, `region`, `city`, `address_1`, `address_2`, `postal`, `phone`, `birth_date`, `role`, `secret`) VALUES
(27, 'admin', '', 'admin@admin.ru', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', '', '0', '', '0000-00-00', 'admin', 'd41d8cd98f00b204e9800998ecf8427e'),
(28, 'pavel', 'lukinsky', 'luka_bass_king@inbox.ru', 'fae0b27c451c728867a567e8c1bb4e53', 'Russia', '', 'Spb', 'Rudneva 5-162', '', '21221', '8-950-014-71-25', '0000-00-00', 'customer', 'd41d8cd98f00b204e9800998ecf8427e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
