/*manufacturer*/

ALTER TABLE manufacturer ADD email ALTER TABLE categories ADD accusative_name text after name;
ALTER TABLE categories ADD genitive_name text after accusative_name; after phone;
ALTER TABLE manufacturer ADD country varchar(50) after email;
ALTER TABLE manufacturer ADD city varchar(50) after country;
ALTER TABLE manufacturer ADD is_active tinyint(1) after name;
ALTER TABLE manufacturer ADD meta_title varchar(255) after url;
ALTER TABLE manufacturer ADD meta_keywords varchar(255) after meta_title;
ALTER TABLE manufacturer ADD meta_description varchar(255) after meta_keywords;
ALTER TABLE manufacturer ADD seo_text text after meta_description;

/*categories*/
ALTER TABLE categories ADD accusative_name varchar(255) after name;
ALTER TABLE categories ADD genitive_name varchar(255) after accusative_name;
ALTER TABLE categories ADD seo_text text after url;