/*filters cache*/

CREATE TABLE IF NOT EXISTS `filters_cache` (
    `id` VARCHAR(255),
	`cache_data` MEDIUMTEXT,
	`is_last` TINYINT(1)
);
