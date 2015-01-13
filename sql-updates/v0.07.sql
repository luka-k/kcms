CREATE TABLE dealers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200),
    region VARCHAR(10)
);

INSERT INTO `dealers` (`name`, `region`) VALUES ('RedBTR-1', 'ch');
INSERT INTO `dealers` (`name`, `region`) VALUES ('RedBTR-2', 'ch');
INSERT INTO `dealers` (`name`, `region`) VALUES ('redBTR', 'ka');