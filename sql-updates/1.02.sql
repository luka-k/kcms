/*filters cache*/

CREATE TABLE IF NOT EXISTS `filters_cache` (
  `id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cache_data` mediumtext COLLATE utf8_unicode_ci,
  `is_last` tinyint(1) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*users groups*/

INSERT INTO `users_groups` (`id`, `name`, `is_edit`) VALUES
(3, 'manager', 0),

CREATE TABLE IF NOT EXISTS `users_group2manufacturer`(
	`manufacturer_id` INT(11),
	`user_group_id` INT(11),
	KEY `manufacturer_id` (`manufacturer_id`),
	KEY `user_group_id` (`user_group_id`)
)

/*manufacturer*/

ALTER TABLE `manufacturer` CHANGE `is_active` `is_active` TINYINT( 1 ) NULL DEFAULT '1';