DROP DATABASE IF EXISTS minichat;
CREATE DATABASE minichat;
USE minichat;


CREATE TABLE mini_chat(
  id INT NOT NULL AUTO_INCREMENT,
  pseudo CHAR(20) NOT NULL,
  msg CHAR(255) NOT NULL,
  date_heure DATETIME,
  PRIMARY KEY(id, pseudo, msg, date_heure)
);
