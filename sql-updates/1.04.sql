CREATE TABLE IF NOT EXISTS `manufacturer2service`(
	`service_id` INT(11),
	`manufacturer_id` INT(11),
	KEY `service_id` (`service_id`),
	KEY `manufacturer_id` (`manufacturer_id`)
)