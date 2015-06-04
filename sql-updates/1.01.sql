/*manufacturer*/

ALTER TABLE manufacturer ADD email ALTER TABLE categories ADD accusative_name TEXT after name;
ALTER TABLE categories ADD genitive_name TEXT after accusative_name; after phone;
ALTER TABLE manufacturer ADD country VARCHAR(50) after email;
ALTER TABLE manufacturer ADD city VARCHAR(50) after country;
ALTER TABLE manufacturer ADD is_active TINYINT(1) after name;
ALTER TABLE manufacturer ADD meta_title VARCHAR(255) after url;
ALTER TABLE manufacturer ADD meta_keywords VARCHAR(255) after meta_title;
ALTER TABLE manufacturer ADD meta_description VARCHAR(255) after meta_keywords;
ALTER TABLE manufacturer ADD seo_text text after meta_description;

/*categories*/
ALTER TABLE categories ADD accusative_name VARCHAR(255) after name;
ALTER TABLE categories ADD genitive_name VARCHAR(255) after accusative_name;
ALTER TABLE categories ADD seo_text text after url;

/*привязка производителей и категорий*/
CREATE TABLE manufacturer2category(
	category_id INT(11),
	manufacturer_id INT(11)
)

CREATE TABLE manufacturer2categorygoods(
	goods_category_id INT(11),
	manufacturer_id INT(11)
)

CREATE TABLE manufacturer2manufacturer(
	distributor INT(11),
	distributor_2 INT(11)
)

/*services*/
CREATE TABLE services (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
	parent_id INT(11),
	is_active TINYINT(1),
	sort INT(11),
	url VARCHAR(255),
	meta_title VARCHAR(255),
	meta_keywords VARCHAR(255),
	meta_description VARCHAR(255),
	seo_text TEXT
);

INSERT INTO `services` (`id`, `name`, `parent_id`, `is_active`, `sort`, `url`, `meta_title`, `meta_keywords`, `meta_description`, `seo_text`) VALUES
(1, 'Гарантийное/Сервисное обслуживание/ремонт', NULL, 1, 0, 'garantijnoe-servisnoe-obsluzhivanie-remont', '', '', '', ''),
(2, 'Гарантийное/Сервисное обслуживание/ремонт', 0, 1, 0, 'garantijnoe-servisnoe-obsluzhivanie-remont', '', '', '', ''),
(3, 'Дизайн/Проектирование', 0, 1, 0, 'dizajn-proektirovanie', '', '', '', ''),
(4, 'обслуживание/ремонт сантехники', 2, 1, 0, 'obsluzhivanie-remont-santehniki', '', '', '', ''),
(5, 'обслуживание/ремонт столярных изделий', 2, 1, 0, 'obsluzhivanie-remont-stolyarnyh-izdelij', '', '', '', ''),
(6, 'перетяжка мебели', 2, 1, 0, 'peretyazhka-mebeli', '', '', '', '');


/*Документы*/
CREATE TABLE documents (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
	is_active TINYINT(1),
	doc_type VARCHAR(255),
	manufacturer_id int(11),
	sort INT(11),
	description TEXT,
	url VARCHAR(255)
);

CREATE TABLE document2category(
	category_id INT(11),
	document_id INT(11)
)

/*Изменение в меню*/
UPDATE `menus_items` SET `parent_id` = '6' WHERE `id` =35;

INSERT INTO `menus_items` (`id`, `menu_id`, `name`, `parent_id`, `sort` , `description`, `item_type`, `url`) VALUES
(37, 1, 'Услуги', 6, 6, '', 'link', '/admin/content/items/services/all'),
(38, 1, 'Услуги', 6, 6, '', 'link', '/admin/content/items/documents/all');

CREATE TABLE IF NOT EXISTS `files` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`object_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
	`object_id` int(11) NOT NULL,
	`url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
	KEY `object_type_object_id` (`object_type`,`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11;

