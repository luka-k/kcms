ALTER TABLE settings ADD COLUMN catalog_h1 VARCHAR(255) AFTER site_description;
ALTER TABLE settings ADD COLUMN catalog_description TEXT AFTER catalog_h1;

ALTER TABLE settings ADD COLUMN vendors_h1 VARCHAR(255) AFTER site_description;
ALTER TABLE settings ADD COLUMN vendors_description TEXT AFTER vendors_h1;

ALTER TABLE settings ADD COLUMN contractor_h1 VARCHAR(255) AFTER site_description;
ALTER TABLE settings ADD COLUMN contractor_description TEXT AFTER contractor_h1;

ALTER TABLE manufacturers ADD COLUMN description TEXT AFTER link;