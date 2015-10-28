CREATE TABLE IF NOT EXISTS `empty_subcollections` (
  `parent_collection_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  KEY `parent_collection_id` (`parent_collection_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;