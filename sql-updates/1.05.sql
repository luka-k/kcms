CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(11) COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci,
  `description` text,
  `ya_map` text,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE files ADD COLUMN name VARCHAR(255) AFTER id;
ALTER TABLE files ADD COLUMN file_type VARCHAR(255) AFTER name;

ALTER TABLE files ADD COLUMN download_code VARCHAR(255) AFTER id;