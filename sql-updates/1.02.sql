/*filters cache*/

CREATE TABLE IF NOT EXISTS `filters_cache` (
  `id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cache_data` mediumtext COLLATE utf8_unicode_ci,
  `is_last` tinyint(1) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
