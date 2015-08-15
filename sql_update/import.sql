ALTER TABLE products ADD COLUMN ISBN INT AFTER id;
ALTER TABLE products ADD COLUMN height INT AFTER price;
ALTER TABLE products ADD COLUMN width INT AFTER height;
ALTER TABLE products ADD COLUMN depth INT AFTER width;
ALTER TABLE products ADD COLUMN weight INT AFTER depth;

ALTER TABLE `products` CHANGE `year` `year` DATE NOT NULL ;
ALTER TABLE `products` CHANGE `ISBN` `ISBN` varchar(255) NOT NULL ;