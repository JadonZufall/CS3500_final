CREATE USER 'server'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON * . * TO 'server'@'localhost';
FLUSH PRIVILEGES;

CREATE DATABASE taylor_swift;
USE taylor_swift;

CREATE TABLE comments (
    commentID INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    commentText TEXT(500) NOT NULL,
    postDate DATETIME NOT NULL DEFAULT NOW()
);

CREATE TABLE users (
    userID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username CHAR(32) NOT NULL UNIQUE,
    salt CHAR(64) NOT NULL,
    hash TEXT(500) NOT NULL,
);