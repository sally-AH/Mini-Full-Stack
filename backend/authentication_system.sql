DROP DATABASE IF EXISTS authentication_db;
CREATE DATABASE authentication_db CHARACTER SET utf8 COLLATE utf8_general_ci;
USE authentication_db;

DROP TABLE IF EXISTS Users;

CREATE TABLE Users
(
   user_id              int AUTO_INCREMENT NOT NULL,
   user_name            varchar(255) NOT NULL,
   user_email           varchar(255) NOT NULL,
   user_password        varchar(255) NOT NULL,
   PRIMARY KEY (user_id),
   UNIQUE KEY (user_name),
   UNIQUE KEY (user_email)
)
Engine = InnoDB;