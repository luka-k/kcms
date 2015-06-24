CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(11) COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci,
  `description` text,
  `ya_map` text,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;