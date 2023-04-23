/* Ensure the config permissions are properly setup */
CREATE USER 'server'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON * . * TO 'server'@'localhost';
FLUSH PRIVILEGES;

/* Create and use the target database */
CREATE DATABASE taylor_swift;
USE taylor_swift;

/* Create / Delete the comments table */
DROP TABLE IF EXISTS comments;
CREATE TABLE comments (
    commentID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    posterID INT NOT NULL,
    commentText TEXT(500) NOT NULL,
    postDate DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (posterID) REFERENCES users(userID)
);

/* Create / Delete the users table */
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    userID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username CHAR(32) NOT NULL UNIQUE,
    salt CHAR(64) NOT NULL,
    hash TEXT(500) NOT NULL
);