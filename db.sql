/*
 * Este arquivo faz parte do pacote de códigos "Sistema de avaliação de fotos" (github.com/gurideprograma/ilikeyou).
 * E está sob a licença GPLv2, localizada no diretório "licenca" (sem aspas) deste pacote de códigos.
 * Copyright (C) 2012 @_gurideprograma
 */

create database ilikeyou;

create table pictures (
	id int(11) auto_increment,
	pkey varchar(128),
	pic text,
	usr int(11),
	since datetime,
	status int(1),
	yes int(11),
	no int(11),
	total int(11),
	yes_an int(11),
	no_an int(11),
	primary key(id)
);

create table usr (
	id int(11) auto_increment,
	ukey varchar(128),
	name varchar(20),
	email varchar(50),
	login varchar(20),
	pass varchar(128),
	since datetime,
	status int(1),
	primary key(id)
);

create table vote_usr (
	id int(11) auto_increment,
	pic int(11),
	usr int(11),
	datehour datetime,
	primary key(id)
);

create table vote_an (
	id int(11) auto_increment,
	pic int(11),
	ip int(11),
	datehour datetime,
	primary key(id)
);

create table stats (
	id int(11) auto_increment,
	users int(11),
	pictures int(11),
	votes int(11),
	anvotes int(11),
	primary key(id)
);


