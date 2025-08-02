CREATE DATABASE IF NOT EXISTS waph_team12;

DROP USER IF EXISTS 'team12'@'localhost';

CREATE USER 'team12'@'localhost' IDENTIFIED BY 'team12';

GRANT ALL PRIVILEGES ON waph_team12.* TO 'team12'@'localhost';

FLUSH PRIVILEGES;