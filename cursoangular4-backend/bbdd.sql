CREATE DATABASE IF NOT EXISTS curso_angular4;
USE curso_angular4;

  CREATE TABLE productos
   (id INT(255) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(255),
    description TEXT,
    precio VARCHAR(255),
    imagen VARCHAR(255),
    CONSTRAINT pk_productos PRIMARY KEY(id))
    ENGINE=INNODB;