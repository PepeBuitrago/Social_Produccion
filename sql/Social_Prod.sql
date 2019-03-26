CREATE DATABASE social_prod
    DEFAULT CHARACTER SET utf8;

USE social_prod;

CREATE TABLE usuarios (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	nombre VARCHAR(25) NOT NULL,
	apellido VARCHAR(25) NOT NULL,
	descripcion VARCHAR(140),
	url_foto VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	fecha_registro DATETIME NOT NULL,
	activo TINYINT NOT NULL,
	grupo INT NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE grupos (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	nombre VARCHAR(25) NOT NULL,
	descripcion VARCHAR(140),
	admin_id INT NOT NULL,
	fecha_creacion DATETIME NOT NULL,
	activo TINYINT NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE integrantes_grupo (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	grupo_id INT NOT NULL,
	usuario_id INT NOT NULL,
	fecha_ingreso DATETIME NOT NULL,
	admin TINYINT NOT NULL,
	activo TINYINT NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE chat (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	grupo_id INT NOT NULL,
	usuario_id INT NOT NULL,
	mensaje VARCHAR(255) NOT NULL,
	fecha_envio DATETIME NOT NULL,
	activo TINYINT NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE subida_archivos (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	usuario_id INT NOT NULL,
	url VARCHAR(255) NOT NULL,
	nombre VARCHAR(255) NOT NULL,
	formato VARCHAR(10) NOT NULL,
	size INT NOT NULL,
	fecha_subida DATETIME NOT NULL,
	activo TINYINT NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE notas (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	grupo_id INT NOT NULL,
	usuario_id INT NOT NULL,
	icono VARCHAR(255) NOT NULL,
	color VARCHAR(10) NOT NULL,
	titulo VARCHAR(55) NOT NULL,
	mensaje VARCHAR(255) NOT NULL,
	fecha_envio DATETIME NOT NULL,
	activo TINYINT NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE locaciones (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	usuario INT NOT NULL,
	nombre VARCHAR(100) NOT NULL,
	descripcion VARCHAR(140)NOT NULL,
	url_foto VARCHAR(255) NOT NULL,
	coor_x FLOAT(10,10) NOT NULL,
	coor_y FLOAT(10,10) NOT NULL,
	coor_z FLOAT(10,10) NOT NULL,
	fecha_subida DATETIME NOT NULL,
	activo TINYINT NOT NULL,
	PRIMARY KEY(id)
);