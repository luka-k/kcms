ALTER TABLE articles ADD en_name varchar(255) after name;
ALTER TABLE articles ADD en_menu_name varchar(255) after menu_name;
ALTER TABLE articles ADD en_description TEXT after description;
ALTER TABLE articles ADD en_full_description TEXT after full_description;
ALTER TABLE articles ADD en_meta_title varchar(255) after meta_title;
ALTER TABLE articles ADD en_meta_keywords varchar(255) after meta_keywords;
ALTER TABLE articles ADD en_meta_description varchar(255) after meta_description;
ALTER TABLE articles ADD en_direction varchar(255) after direction;
ALTER TABLE articles ADD en_lead_name varchar(255) after lead_name;

ALTER TABLE settings ADD en_site_title varchar(255) after site_title;
ALTER TABLE settings ADD en_site_description varchar(255) after site_description;
ALTER TABLE settings ADD en_site_keywords varchar(255) after site_keywords;

ALTER TABLE slider ADD en_description TEXT after description;

ALTER TABLE news ADD en_name varchar(255) after name;
ALTER TABLE news ADD en_description TEXT after description;
ALTER TABLE news ADD en_full_description TEXT after full_description;
ALTER TABLE news ADD en_meta_title varchar(255) after meta_title;
ALTER TABLE news ADD en_meta_keywords varchar(255) after meta_keywords;
ALTER TABLE news ADD en_meta_description varchar(255) after meta_description;
