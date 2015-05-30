ALTER TABLE manufacturer ADD email varchar(50) after phone;
ALTER TABLE manufacturer ADD country varchar(50) after email;
ALTER TABLE manufacturer ADD city varchar(50) after country;
ALTER TABLE manufacturer ADD is_active tinyint(1) after name;
ALTER TABLE manufacturer ADD meta_title varchar(255) after url;
ALTER TABLE manufacturer ADD meta_keywords varchar(255) after meta_title;
ALTER TABLE manufacturer ADD meta_description varchar(255) after meta_keywords;
ALTER TABLE manufacturer ADD seo_text text after meta_description;