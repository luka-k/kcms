ALTER TABLE `users` ADD `last_name` varchar( 100 ) NOT NULL AFTER `id` ,
ADD `patronymic` varchar(100) NOT NULL AFTER `name` ,
ADD `city` text NOT NULL AFTER `phone` ,
ADD `street` varchar(100) NOT NULL AFTER `phone` ,
ADD `house` varchar(100) NOT NULL AFTER `street` ,
ADD `building` varchar(10) NOT NULL AFTER `house` ,
ADD `apartment` varchar(10) NOT NULL AFTER `building` ,
ADD `zip_code` varchar(20) NOT NULL AFTER `apartment`,
DROP `address` ;



ALTER TABLE `orders` ADD PRIMARY KEY(`order_id`),
tl MODIFY `order_id` INT NOT NULL AUTO_INCREMENT,
DROP `id`;