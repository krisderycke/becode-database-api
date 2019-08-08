CREATE DATABASE IF NOT EXISTS `note_app`;

CREATE TABLE My Notes(
	ID      INT              NOT NULL AUTO_INCREMENT,
  	Title   VARCHAR (20)    ,
   	Note_Context    VARCHAR(800)    ,
	Date    DATE	NOT NULL,
	PRIMARY KEY (ID)
);
