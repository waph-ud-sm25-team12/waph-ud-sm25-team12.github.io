DROP TABLE IF EXISTS users;

CREATE TABLE users (
    username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(100) NOT NULL
);

LOCK TABLES `users` WRITE;

INSERT INTO users(username, password)
VALUES ('Anvitha', MD5('Anvitha'));

INSERT INTO users(username, password)
VALUES ('Neeraj', MD5('Neeraj'));

INSERT INTO users(username, password)
VALUES ('Ryan', MD5('Ryan'));

INSERT INTO users(username, password)
VALUES ('admin', MD5('team12'));

UNLOCK TABLES;
