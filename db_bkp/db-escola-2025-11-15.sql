DROP TABLE IF EXISTS administradores;

CREATE TABLE `administradores` (
  `idadministrador` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` varchar(11) NOT NULL,
  `painel` varchar(120) NOT NULL DEFAULT 'funcionario',
  `username` varchar(100) NOT NULL,
  `senha` varchar(260) NOT NULL,
  `acesso` varchar(90) NOT NULL DEFAULT 'desbloqueado',
  `ultimoacesso` datetime DEFAULT NULL,
  `horadodeslogue` datetime DEFAULT NULL,
  PRIMARY KEY (`idadministrador`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO administradores VALUES("2","32","funcionario","daniele","$2y$10$4Qpp2Nl/CJa5VauOjpIP7uI/XQf7CGwERe6XWiYmD1GZYVAR1FufO","bloqueado","2021-03-10 12:34:17","2021-03-10 12:44:24");
INSERT INTO administradores VALUES("3","30","administrador","zulmira","$2y$10$QvwR28/SJj4/IZT2CfQqZuIs.6dTu0F5c6xG9dyp1VoFqsKuqeTAq","desbloqueado","2021-09-02 17:18:36","2021-09-02 17:56:38");
INSERT INTO administradores VALUES("5","1","administrador","walter","$2y$10$/vs6S2TtT5yhlIZ1kZRHEOMZbTsVQziHg9XtCOWCHCLMSWQ8YyGp.","desbloqueado","2021-09-02 17:56:43","0000-00-00 00:00:00");
INSERT INTO administradores VALUES("6","31","administrador","123","$2y$10$s1Mzav7O2BnS4G6SVnWlleb88zDHL8MoLhc8B71ZpeBF.Vywy5IjC","desbloqueado","2021-11-15 09:56:34","2021-11-01 08:28:02");



DROP TABLE IF EXISTS agenda;

CREATE TABLE `agenda` (
  `idagenda` int(11) NOT NULL AUTO_INCREMENT,
  `nomedaactividade` varchar(220) DEFAULT NULL,
  `datainicio` date DEFAULT NULL,
  `datafim` date DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obs` varchar(220) DEFAULT NULL,
  `horainicio` time DEFAULT NULL,
  `horafim` time DEFAULT NULL,
  PRIMARY KEY (`idagenda`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO agenda VALUES("11","Acampamento ","2021-04-01","2021-04-08","2021-04-01 00:18:49","nenhuma","09:00:00","20:00:00");
INSERT INTO agenda VALUES("12","Acampamento 3","2021-08-31","0000-00-00","2021-08-08 04:29:25","","00:00:00","00:00:00");
INSERT INTO agenda VALUES("13","ir no tribunal","2021-08-10","2021-08-18","2021-08-08 04:45:55","","00:00:00","00:00:00");
INSERT INTO agenda VALUES("14","ir no campo","2021-08-17","0000-00-00","2021-08-08 04:46:57","","00:00:00","00:00:00");
INSERT INTO agenda VALUES("15","bolado","2021-02-15","0000-00-00","2021-08-08 04:47:15","","00:00:00","00:00:00");



DROP TABLE IF EXISTS alunos;

CREATE TABLE `alunos` (
  `idaluno` int(11) NOT NULL AUTO_INCREMENT,
  `nomecompleto` varchar(200) NOT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `nomedopai` varchar(200) DEFAULT NULL,
  `nomedamae` varchar(220) DEFAULT NULL,
  `naturalidade` varchar(200) DEFAULT NULL,
  `nacionalidade` varchar(220) NOT NULL DEFAULT 'Angolana',
  `provincia` varchar(220) DEFAULT NULL,
  `numerodobioucedula` varchar(100) DEFAULT NULL,
  `arquivodeidentificacao` varchar(201) NOT NULL DEFAULT 'Luanda',
  `deficiencia` varchar(200) NOT NULL DEFAULT 'Nenhuma',
  `escoladeorigem` varchar(200) DEFAULT NULL,
  `telefone` varchar(200) DEFAULT NULL,
  `telefoneincarregados` varchar(200) DEFAULT NULL,
  `profissao` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `anodeentrada` int(4) DEFAULT NULL,
  `datadenascimento` date DEFAULT NULL,
  `datadeexpiracaodobi` date DEFAULT NULL,
  `numerodeprocesso` varchar(100) DEFAULT NULL,
  `morada` varchar(220) DEFAULT NULL,
  `religiao` varchar(200) DEFAULT NULL,
  `nomedoencarregado` varchar(200) DEFAULT NULL,
  `datadecadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` varchar(200) NOT NULL DEFAULT 'activo',
  `obs` text,
  PRIMARY KEY (`idaluno`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

INSERT INTO alunos VALUES("1","Esmael Calunga","Masculino","Valentim Tomas","Teresa Francisco","Luanda","Angolana","Luanda","490349204BN34","Luanda","Nenhuma","Isutic","943234243","934232344","Programmer","esmael@gmail.com","2021","2012-07-30","2021-07-27","2007","Viana","Adventista do 7º Dia","Esmael","2021-07-29 09:46:32","activo","");
INSERT INTO alunos VALUES("2","Bernardo Pedro","Masculino","Ananias Pedro","Maria Andre","","Angolana","","","Luanda","","","","","","","0","2009-08-02","0000-00-00","","","","Victor Dala","2021-07-29 09:56:49","activo","");
INSERT INTO alunos VALUES("3","Teresa Francisco Dala","Femenino","Gomes Gonga","Gunha Pedro","","Angolana","","","Luanda","","Arena do Saber","","","","","2011","2002-08-04","2021-08-03","4000","","Católica","Esmael Dembro","2021-07-29 14:51:17","activo","");
INSERT INTO alunos VALUES("4","Ernandes f","Femenino","Ananias Pedro","Maria Andre","","Angolana","","","Luanda","","","","","","","0","0000-00-00","0000-00-00","","","","Victor Dala gg","2021-07-29 15:07:00","activo","");
INSERT INTO alunos VALUES("5","Ernandes Fr Gr","Masculino","","","","Angolana","","","Luanda","","","","","","","0","0000-00-00","0000-00-00","","","","","2021-07-29 23:46:52","activo","");
INSERT INTO alunos VALUES("6","Rodrigues Narciso","Masculino","Raimundo Zua","Fernanda Pedro","Luanda","Angolana","Luanda","29837948379","Luanda","","Arena do Saber","94123453","94737345","","","2010","2001-08-03","2021-08-04","4837","","Adventista do 7º Dia","Raimundo Zua","2021-07-30 06:51:44","activo","");
INSERT INTO alunos VALUES("7","Rafael Gonga","Masculino","Gomes Gonga","Fernandas Pedros","Benguela","Angolana","Benguela","","Luanda","Visual","Miry","94123453","94737345","Pedreiro","Ant.g@gmail.com","2019","2021-08-04","0000-00-00","2300","Benfica","Pentecostal","Gomes Gonga","2021-07-30 07:55:34","activo","Aluno Excelente");
INSERT INTO alunos VALUES("8","Eliandes Manuel","Masculino","Elias Paulo","Vunda Gonga","Colomboloco","Angolana","Bengo","27328764872","Luanda","Auditiva","Laurista","94123453","947765345","Programador","","2012","2020-08-05","2021-08-03","1200","Luanda Sul","Testemunha de Jeová","Elias Paulo","2021-07-30 08:24:39","activo","aluno bem crak");
INSERT INTO alunos VALUES("9","Gomedilna da Costa","Femenino","Gomes Gonga","Maria Andre","Bengo","Angolana","Bengo","3453345","Luanda","","Zangala","954434523","94737345","","","2021","2011-08-04","2021-08-06","2340","Jacinto Tchipa","","Gomes Gonga","2021-08-02 10:18:49","activo","");
INSERT INTO alunos VALUES("10","Maria Gomes","Femenino","Rineu Pedro","Rita Cabaça","Icolo e Bengo","Angolana","Bengo","109343283","Luanda","Visual","Nayuca","943935464","94737345","","","2020","2003-08-05","2021-08-06","12394","Imbondeiro Sul","","Rineu Pedro","2021-08-02 10:29:44","activo","");
INSERT INTO alunos VALUES("11","Madalena Francisco","Femenino","Gomes Gonga","Fernanda Pedro","","Angolana","","","Luanda","","Laurista","954434523","94737345","","","2021","2021-08-04","0000-00-00","4422","","","Gomes Gonga","2021-08-02 11:10:25","activo","");
INSERT INTO alunos VALUES("12","Hugo Da Cruz Gomes","Femenino","Raimundo Zua Hp","Gunha Pedro f","Colomboloco f","Angolanas","provincia","numer","Luandaa","vusual","Puniv","9348424","942782","949743","esmael","2019","2021-08-03","2021-08-12","12343","Viana","Católica","Raimundo Zua Fernandes","2021-08-02 11:11:50","activo","Obs");
INSERT INTO alunos VALUES("13","Margarida Francisco","Femenino","Gomes Gonga","Gunha Pedro","Icolo e Bengo","Angolana","","","Luanda","","Zangala","","","","","0","2021-08-03","2021-08-05","44223","","","Gomes Gonga","2021-08-02 15:30:30","activo","");
INSERT INTO alunos VALUES("14","Rita Cabaça","Femenino","Raimundo Zua","Fernanda Pedro","Benguela","Angolana","","","Luanda","","Arena do Saber","954434523","94737345","","","0","2021-08-05","2021-08-06","12430","","","Raimundo Zua","2021-08-03 15:34:50","activo","");
INSERT INTO alunos VALUES("15","Margarida Fernandes","Femenino","Ananias Pedro","Gunha Pedro","","Angolana","","","Luanda","","","94123453","947765345","","","0","2021-08-07","2021-08-09","2343","","","Ananias Pedro","2021-08-03 15:35:44","activo","");
INSERT INTO alunos VALUES("16","Rodrigues Tengulo","Masculino","Gomes Gonga","Fernanda Pedro","","Angolana","","","Luanda","","","943935464","947765345","","","0","2021-08-12","2021-08-12","53332","","","Gomes Gonga","2021-08-03 15:36:39","activo","");
INSERT INTO alunos VALUES("17","Martins Sampaio","Masculino","Ananias Pedro","Fernanda Pedro","","Angolana","","","Luanda","","","94123453","94737345","","","0","0000-00-00","0000-00-00","644","","","Ananias Pedro","2021-08-03 15:39:37","activo","");
INSERT INTO alunos VALUES("18","Rita Francisco","Femenino","Elias Paulo","Maria Andre","","Angolana","","","Luanda","","","94123453","947765345","","","0","2011-08-06","0000-00-00","","","","Elias Paulo","2021-08-03 15:41:21","activo","");
INSERT INTO alunos VALUES("19","Maria Domingos","Femenino","Ananias Pedro","Gunha Pedro","","Angolana","","","Luanda","","","954434523","94737345","","","0","2001-08-08","0000-00-00","1220","","","Ananias Pedro","2021-08-03 15:42:17","activo","");
INSERT INTO alunos VALUES("20","Tilsom Camaba","Masculino","Raimundo Zua","Gunha Pedro","","Angolana","","","Luanda","","","954434523","94737345","","","0","2001-08-05","0000-00-00","1200","","","Raimundo Zua","2021-08-03 20:39:56","activo","");
INSERT INTO alunos VALUES("21","Wilson Daniel","Masculino","Raimundo Zua","Fernanda Pedro","","Angolana","","","Luanda","","","954434523","947765345","","","0","0000-00-00","0000-00-00","4556","","","Raimundo Zua","2021-08-03 20:40:42","activo","");
INSERT INTO alunos VALUES("22","Adão Zeferino","Masculino","Gomes Gonga gg","Gunha Pedro","","Angolana","","","Luanda","","","94123453","94737345","","","0","2021-08-09","2021-08-11","5434","","","Gomes Gonga","2021-08-03 20:43:54","activo","");
INSERT INTO alunos VALUES("23","Mariana Pedro","Femenino","Ananias Pedro","Maria Andre","Icolo e Bengo","Angolana","Bengo","","Luanda","","","954434523","","","","0","2021-08-06","0000-00-00","8767","","","Ananias Pedro","2021-08-03 20:46:34","activo","");
INSERT INTO alunos VALUES("24","Palmira Manuel","Femenino","Raimundo Zua","Fernandas Pedros","","Angolana","","","Luanda","","","954434523","94737345","","","0","2021-08-11","0000-00-00","8767","","","Raimundo Zua","2021-08-03 20:47:32","activo","");
INSERT INTO alunos VALUES("25","Arnaldo Vunda","Masculino","Raimundo Zua","Fernanda Pedro","Icolo e Bengo","Angolana","Uíge","3443323","Luanda","","Laurista","954434523","94737345","","","0","2006-08-07","2021-08-12","12430","Jacinto Tchipa","","Raimundo Zua","2021-08-04 06:16:08","activo","");
INSERT INTO alunos VALUES("26","Ana Kimbenze","Femenino","Gomes Gonga","Maria Andre","Icolo e Bengo","Angolana","Bengo","","Luanda","","","94123453","","","","0","2021-08-15","0000-00-00","6543","","","Gomes Gonga","2021-08-04 06:18:45","activo","");
INSERT INTO alunos VALUES("27","Telma De Jesus","Femenino","Gomes Gonga","Maria Andre","","Angolana","","","Luanda","","Arena do Saber","94123453","94737345","","","0","2021-08-07","2021-08-12","12430","","","Gomes Gonga","2021-08-04 06:20:50","activo","");
INSERT INTO alunos VALUES("28","Rinel De Sousa","Masculino","Gomes Gonga","Maria Andre","Bengo","Angolana","Luanda","","Luanda","","Laurista","","","","","0","2021-08-03","2021-08-05","7654","Luanda Sul","","Gomes Gonga","2021-08-04 06:35:47","activo","");
INSERT INTO alunos VALUES("29","Suzana Pedro","Femenino","Ananias Pedro","Gunha Pedro","","Angolana","","","Luanda","","","954434523","947765345","","","0","2021-08-07","2021-08-13","857","","","Ananias Pedro","2021-08-04 06:36:49","activo","");
INSERT INTO alunos VALUES("30","Esmael Andre Bento","Masculino","Gomes Gonga","Maria Andre","Colomboloco","Angolana","Luanda","","Luanda","Visual","Isutic","","","Lavrador","esmaelcalunga0@gmail.com","0","0000-00-00","0000-00-00","2007","Jacinto Tchipa","","Gomes Gonga","2021-08-04 06:38:51","activo","");
INSERT INTO alunos VALUES("31","Marinela Fransico Sonhi","Femenino","Gomes Gonga","Gunha Pedro","Colomboloco","Angolana","Luanda","","Luanda","Visual","Isutic","94123453","94737345","Lavrador","Ant.g@gmail.com","2021","2021-08-06","2020-12-31","885332","Jacinto Tchipa","Adventista do 7º Dia","Raimundo Zua","2021-08-04 06:39:41","activo","b");
INSERT INTO alunos VALUES("32","Rodrigo Faraó","Masculino","Raimundo Zua","Fernanda Pedro","Colomboloco","Angolana","","","Luanda","","Cassonzola","943935464","","","","2019","2021-08-07","0000-00-00","523","","","Raimundo Zua","2021-08-04 06:43:55","activo","");
INSERT INTO alunos VALUES("33","Armando Da Costa Zeferino Dumba","Masculino","Valentim Cabamga","Alice José","","Angolana","","","Luanda","","Arena do Saber","954434523","","","","2019","2021-08-07","0000-00-00","524","","","Valentim Cabamga","2021-08-04 06:48:51","activo","");
INSERT INTO alunos VALUES("34","Bernardo Antonio","Masculino","Ananias Pedro","Gunha Pedro","Bengo","Angolana","","","Luanda","","","954434523","","","","0","2021-08-06","0000-00-00","145","","","Ananias Pedro","2021-08-04 07:48:04","activo","");
INSERT INTO alunos VALUES("35","Mariana Manuel","Femenino","Ananias Pedro","Maria Andre","","Angolana","","","Luanda","","Laurista","","","","","2018","2021-08-13","2021-08-13","4232","","","Ananias Pedro","2021-08-06 04:23:33","activo","");
INSERT INTO alunos VALUES("36","Ermelina Manuel Pedro","Femenino","Raimundo Zua","Fernandas Pedros","","Angolana","","","Luanda","","Arena do Saber","954434523","","","","2011","2021-08-15","0000-00-00","4231","","","Raimundo Zua","2021-08-06 04:28:57","activo","");
INSERT INTO alunos VALUES("37","Ermelina Da Silva","Femenino","Ananias Pedro","Fernandas Pedros","Bengo","Angolana","","","Luanda","","Laurista","94123453","947765345","","","0","2021-08-13","2021-08-13","12430","","","Ananias Pedro","2021-08-06 04:29:42","activo","");
INSERT INTO alunos VALUES("38","Marcos Da Silva Baião","Masculino","Elias Paulo","Gunha Pedro","","Angolana","","","Luanda","","","","","","","2021","2021-08-07","0000-00-00","","","","Elias Paulo","2021-08-06 10:21:56","activo","");
INSERT INTO alunos VALUES("39","Futila Pedro","Masculino","Gomes Gonga","Gunha Pedro","","Angolana","","","Luanda","","","","","","","2019","2021-08-07","0000-00-00","5341","","","Gomes Gonga","2021-08-06 10:35:14","activo","");
INSERT INTO alunos VALUES("40","Rogerio Mateus","Masculino","Ananias Pedro","Gunha Pedro","","Angolana","","","Luanda","","","","","","","2021","2008-08-10","0000-00-00","7453","","","Ananias Pedro","2021-08-08 05:37:35","activo","");
INSERT INTO alunos VALUES("41","Vânia Manuel","Femenino","Raimundo Zua","Maria Andre","Benguela","Angolana","Luanda","","Luanda","","","94123453","947765345","","","2021","2005-08-04","2021-08-17","876","","","Raimundo Zua","2021-08-10 09:28:17","activo","");
INSERT INTO alunos VALUES("42","Esmael Calunga r","Femenino","Ananias Pedro","Maria Andre","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","Ananias Pedro","2021-08-11 13:27:57","activo","");
INSERT INTO alunos VALUES("43","Simao dengo","Masculino","Gomes Gonga","Fernanda Pedro","Icolo e Bengo","Angolana","","","Luanda","","","","","","","2021","2021-08-14","2021-08-14","","","","Gomes Gonga","2021-08-13 10:38:01","activo","");
INSERT INTO alunos VALUES("44","Bernardo Gomes da Costa","Masculino","","","","Angolana","","","Luanda","","","","","","","2019","0000-00-00","0000-00-00","","","","","2021-08-16 12:39:23","activo","");
INSERT INTO alunos VALUES("45","Pedro Zua","Masculino","","","","Angolana","","","Luanda","","","","","","","2018","0000-00-00","0000-00-00","","","","","2021-08-16 12:40:08","activo","");
INSERT INTO alunos VALUES("46","Madalena Hugo","Masculino","","","","Angolana","","","Luanda","","","","","","","2012","0000-00-00","0000-00-00","","","","","2021-08-16 12:40:20","activo","");
INSERT INTO alunos VALUES("47","Daniel Dala","Masculino","","","","Angolana","","","Luanda","","","","","","","2019","0000-00-00","0000-00-00","","","","","2021-08-16 12:40:31","activo","");
INSERT INTO alunos VALUES("48","Gonçalves Pedro","Masculino","","","","Angolana","","","Luanda","","","","","","","2017","0000-00-00","0000-00-00","","","","","2021-08-16 12:41:49","activo","");
INSERT INTO alunos VALUES("49","Adelino Manuel","Masculino","","","","Angolana","","","Luanda","","","","","","","2017","0000-00-00","0000-00-00","","","","","2021-08-16 12:49:16","activo","");
INSERT INTO alunos VALUES("50","Walkidea Manuel","Femenino","Ananias Pedro","Fernandas Pedros","","Angolana","","","Luanda","","","","","","","2021","2019-08-18","0000-00-00","","","","Ananias Pedro","2021-08-16 15:09:08","activo","");
INSERT INTO alunos VALUES("51","Ribeiro Da Silva","Masculino","","","","Angolana","","","Luanda","","","","","","","2012","0000-00-00","0000-00-00","","","","","2021-08-16 15:17:41","activo","");
INSERT INTO alunos VALUES("52","Marcos Valentim","Masculino","Elias Paulo","Fernandas Pedros","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","Elias Paulo","2021-08-16 15:17:59","activo","");
INSERT INTO alunos VALUES("53","Luquênia Lamento","Femenino","Lamento","Eva","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","Lamento","2021-08-17 06:24:17","activo","");
INSERT INTO alunos VALUES("54","Ermenegildo Canhenga","Masculino","","","","Angolana","","","Luanda","","","","","","","2017","0000-00-00","0000-00-00","","","","","2021-08-17 06:38:42","activo","");
INSERT INTO alunos VALUES("55","Ermelina Manuel Pedro g","Masculino","Gomes Gonga","Gunha Pedro","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","Gomes Gonga","2021-08-17 11:52:28","activo","");
INSERT INTO alunos VALUES("56","Simone Alvez","Masculino","","","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","","2021-08-18 12:46:28","activo","");
INSERT INTO alunos VALUES("57","Daniel","Masculino","","","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","","2021-08-18 13:00:10","activo","");
INSERT INTO alunos VALUES("58","Mateus Fernades da Piedade","Masculino","Gomes Gonga","Fernandas Pedros","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","Gomes Gonga","2021-08-21 19:52:59","activo","");
INSERT INTO alunos VALUES("59","Turim Pedro","Masculino","","","","Angolana","","","Luanda","","","","","","","2018","0000-00-00","0000-00-00","","","","","2021-08-23 08:15:35","activo","");
INSERT INTO alunos VALUES("60","Romeu Pedro","Masculino","","","","Angolana","","","Luanda","","","","","","","2018","0000-00-00","0000-00-00","","","","","2021-08-23 10:21:25","activo","");
INSERT INTO alunos VALUES("61","Yung Thina","Masculino","","","","Angolana","","","Luanda","","","","","","","2017","0000-00-00","0000-00-00","","","","","2021-08-23 10:21:39","activo","");
INSERT INTO alunos VALUES("62","Pedro Mateus","Masculino","","","","Angolana","","","Luanda","","","","","","","2012","0000-00-00","0000-00-00","","","","","2021-08-23 10:49:08","activo","");
INSERT INTO alunos VALUES("63","Guilherme Dala","Masculino","","","","Angolana","","","Luanda","","","","","","","2014","0000-00-00","0000-00-00","","","","","2021-08-23 10:49:34","activo","");
INSERT INTO alunos VALUES("64","Alberto Vunge","Masculino","","","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","","2021-08-23 11:46:02","activo","");
INSERT INTO alunos VALUES("65","Dany Sebastião","Masculino","","","","Angolana","","","Luanda","","","","","","","2017","0000-00-00","0000-00-00","","","","","2021-08-24 09:05:31","activo","");
INSERT INTO alunos VALUES("66","Helana Quaresma","Femenino","Fernandes Pedro","Madalena Firmino","","Angolana","","","Luanda","","Arena do Saber","94123453","947765345","","","2021","0000-00-00","0000-00-00","12430","","","Fernandes Pedro","2021-09-02 10:41:16","activo","");
INSERT INTO alunos VALUES("67","Pedro da Silva","Masculino","Bernardo Gonga","Ester Da Silva","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","2001-09-07","","","","Bernardo Gonga","2021-09-06 09:25:09","activo","");
INSERT INTO alunos VALUES("68","Ronalda Andre","Femenino","Rebussado Fernandes","Fernanda Pedro","","Angolana","","","Luanda","","","","","","","2021","2009-09-06","0000-00-00","","","","Rebussado Fernandes","2021-09-06 09:38:32","activo","");
INSERT INTO alunos VALUES("69","Dambe Pedro","Masculino","Erneto Dala","Gunha Pedro","","Angolana","","","Luanda","","","","","","","2021","2018-09-05","0000-00-00","","","","Erneto Dala","2021-09-06 09:41:48","activo","");
INSERT INTO alunos VALUES("70","Rebeca Silda Dos Santos","Femenino","Ananias Pedro","Gunha Pedro","","Angolana","","","Luanda","","","","","","","2021","2010-09-06","0000-00-00","","","","Ananias Pedro","2021-09-06 09:42:21","activo","");
INSERT INTO alunos VALUES("71","Walkiria Domingos","Femenino","Gomes Gonga","Fernandas Pedros","","Angolana","","","Luanda","","","","","","","2021","2001-09-11","0000-00-00","","","","Gomes Gonga","2021-09-06 09:42:54","activo","");
INSERT INTO alunos VALUES("72","Sebastião Fyla","Femenino","Ananias Pedro","Fernanda Pedro","","Angolana","","","Luanda","","","","","","","2021","2009-09-08","2021-09-17","","","","Ananias Pedro","2021-09-06 10:12:37","activo","");
INSERT INTO alunos VALUES("73","Ernanes Gavião Pedro","Masculino","Gomes Gonga","Vunda Gonga","Icolo e Bengo","Angolana","Luanda","324223","Luanda","Auditiva","Laurista","954434523","94737345","Lavrador","samabando@gmail.com","2021","2001-09-16","2022-10-08","12430","Luanda Sul","Testemunha de Jeová","Gomes Gonga","2021-09-11 14:45:54","activo","");
INSERT INTO alunos VALUES("74","Gildo Massaque Vunge","Masculino","Raimundo Zua","Fernanda Pedro","Benguela","Angolana","Benguela","4121142","Luanda","Auditiva","Zangala","954434523","947765345","Lavrador","gui2@gmail.com","2021","2001-09-24","2021-09-16","12430","Imbondeiro Sul","Testemunha de Jeová","Raimundo Zua","2021-09-11 14:47:48","activo","");
INSERT INTO alunos VALUES("75","Marcos Valentim Tomás","Masculino","Ananias Pedro","Gunha Pedro","","Angolana","Luanda","","Luanda","Visual","","94123453","94737345","Lavrador","sofia@gmail.com","2017","2021-09-17","0000-00-00","8767","Jacinto Tchipa","Adventista do 7º Dia","Ananias Pedro","2021-09-11 15:16:20","activo","");
INSERT INTO alunos VALUES("76","Firmino Da Sila","Masculino","","","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","","2021-09-21 17:41:13","activo","");
INSERT INTO alunos VALUES("77","Pedro Francisco","Masculino","","","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","","2021-09-23 12:27:18","activo","");
INSERT INTO alunos VALUES("78","Ernandes Fr Grff","Masculino","","","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","","2021-09-29 17:16:17","activo","");
INSERT INTO alunos VALUES("79","Pedro André Catete","Masculino","Jorge Bento","Maria Fátima","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","Jorge Bento","2021-11-05 08:54:40","activo","");
INSERT INTO alunos VALUES("80","Fernandes Andre","Masculino","Filomena gr","FIlo","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","Filomena gr","2021-11-05 09:00:15","activo","");
INSERT INTO alunos VALUES("81","Simão dos Santos","Masculino","","","","Angolana","","","Luanda","","","","","","","2017","0000-00-00","0000-00-00","","","","","2021-11-05 09:00:54","activo","");
INSERT INTO alunos VALUES("82","Filomaena","Femenino","","","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","","2021-11-05 09:01:36","activo","");
INSERT INTO alunos VALUES("83","Ananias Pedro","Masculino","Jorge Bento","Maria Fátima","","Angolana","","","Luanda","","","","","","","2021","2001-11-10","0000-00-00","","","","Jorge Bento","2021-11-08 07:17:40","activo","");
INSERT INTO alunos VALUES("84","Miguel Outubro","Masculino","Filomena gr","","","Angolana","","","Luanda","","","","","","","2021","0000-00-00","0000-00-00","","","","Filomena gr","2021-11-08 07:51:00","activo","");



DROP TABLE IF EXISTS anoslectivos;

CREATE TABLE `anoslectivos` (
  `idanolectivo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `vigor` varchar(4) NOT NULL DEFAULT 'Não',
  `posicao` int(3) NOT NULL DEFAULT '0',
  `nomedamediadostrimestres` varchar(11) NOT NULL DEFAULT 'CAP',
  `percentagemdamediadostrimestres` double NOT NULL DEFAULT '0.4',
  `nomedaprovadeescola` varchar(11) NOT NULL DEFAULT 'CPE',
  `nomedaprovadeexame` varchar(11) NOT NULL DEFAULT 'NER',
  `nomedamediaanual` varchar(10) NOT NULL DEFAULT 'CF',
  `arredondarmedia` int(1) NOT NULL DEFAULT '2',
  `minimoparapositiva` int(2) NOT NULL DEFAULT '10',
  `precodafalta` double NOT NULL DEFAULT '0',
  `precodareconfirmacao` double NOT NULL DEFAULT '0',
  `datainicio` date NOT NULL DEFAULT '2021-08-01',
  `datafim` date NOT NULL DEFAULT '2022-06-01',
  `datafimexame` date NOT NULL DEFAULT '2022-07-01',
  `diadamulta` int(2) NOT NULL DEFAULT '15',
  `precodamulta` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idanolectivo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO anoslectivos VALUES("1","2020","Não","1","CAP","0.4","CPE","NER","CF","2","10","0","0","2021-08-01","2022-06-01","2022-07-01","15","0");
INSERT INTO anoslectivos VALUES("2","2021/2022","Sim","2","CAP","0.4","CPE","NER","CF","2","10","50","3000","2021-08-01","2022-06-01","2022-07-01","15","2500");
INSERT INTO anoslectivos VALUES("3","2019","Não","0","CAP","0.4","CPE","NER","CF","2","10","0","0","2021-08-01","2022-06-01","2022-07-01","15","0");



DROP TABLE IF EXISTS cadeirasdeixadas;

CREATE TABLE `cadeirasdeixadas` (
  `idcadeiradeixada` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT '0',
  `data` date DEFAULT NULL,
  PRIMARY KEY (`idcadeiradeixada`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO cadeirasdeixadas VALUES("2","29","37","11","6.6","2021-10-18");



DROP TABLE IF EXISTS classes;

CREATE TABLE `classes` (
  `idclasse` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  PRIMARY KEY (`idclasse`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO classes VALUES("1","Iniciação");
INSERT INTO classes VALUES("2","12ª");
INSERT INTO classes VALUES("3","1ª");
INSERT INTO classes VALUES("4","2ª");
INSERT INTO classes VALUES("5","3ª");
INSERT INTO classes VALUES("6","4ª");
INSERT INTO classes VALUES("7","5ª");
INSERT INTO classes VALUES("8","6ª");
INSERT INTO classes VALUES("9","7ª");
INSERT INTO classes VALUES("10","8ª");
INSERT INTO classes VALUES("11","9ª");
INSERT INTO classes VALUES("12","10ª");
INSERT INTO classes VALUES("13","11ª");
INSERT INTO classes VALUES("14","13ª");



DROP TABLE IF EXISTS compra;

CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) DEFAULT NULL,
  `idaluno` int(11) DEFAULT NULL,
  `iddacompra` int(11) DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` varchar(30) COLLATE utf8_roman_ci NOT NULL DEFAULT 'vendido',
  `preco` double NOT NULL DEFAULT '0',
  `quantidade` double NOT NULL DEFAULT '0',
  `entregue` int(11) NOT NULL DEFAULT '0',
  `valorpago` double NOT NULL DEFAULT '0',
  `desconto` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcompra`),
  KEY `idproduto` (`idproduto`),
  KEY `idcliente` (`idaluno`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

INSERT INTO compra VALUES("1","28","1","1","2020-10-26 16:06:25","vendido","1400","3","0","3200","500");
INSERT INTO compra VALUES("2","26","1","1","2020-10-26 16:06:25","vendido","1600","5","0","2000","0");
INSERT INTO compra VALUES("3","27","1","1","2020-10-26 16:06:26","vendido","900","3","0","900","0");
INSERT INTO compra VALUES("5","28","1","3","2020-11-03 18:06:54","vendido","12000","1","0","11000","900");
INSERT INTO compra VALUES("7","25","1","3","2020-11-03 18:06:54","vendido","800","7","0","4600","1000");
INSERT INTO compra VALUES("8","28","1","4","2020-11-10 10:29:15","vendido","12000","1","0","10400","600");
INSERT INTO compra VALUES("9","25","1","4","2020-11-10 10:29:16","vendido","800","3","0","2000","400");
INSERT INTO compra VALUES("10","27","1","4","2020-11-10 10:29:16","vendido","900","4","0","3600","0");
INSERT INTO compra VALUES("11","28","1","5","2020-11-10 10:52:17","vendido","12000","2","0","20950","50");
INSERT INTO compra VALUES("13","25","1","5","2020-11-10 10:52:17","vendido","800","4","0","2300","900");
INSERT INTO compra VALUES("14","28","1","6","2020-11-20 11:10:52","vendido","12000","2","0","23600","400");
INSERT INTO compra VALUES("16","27","1","6","2020-11-20 11:10:52","vendido","900","6","0","1000","0");
INSERT INTO compra VALUES("17","28","8","7","2020-11-22 10:45:24","vendido","12000","2","2","22800","200");
INSERT INTO compra VALUES("19","28","1","8","2020-11-24 09:34:16","vendido","12000","4","0","47000","500");
INSERT INTO compra VALUES("21","27","1","8","2020-11-24 09:34:16","vendido","900","6","0","5400","0");
INSERT INTO compra VALUES("22","28","1","9","2020-11-29 10:38:56","vendido","12000","5","0","59940","60");
INSERT INTO compra VALUES("23","25","1","9","2020-11-29 10:38:56","vendido","800","1","0","0","0");
INSERT INTO compra VALUES("24","28","1","10","2020-12-08 08:44:52","vendido","12000","2","0","20100","900");
INSERT INTO compra VALUES("26","27","1","10","2020-12-08 08:44:53","vendido","900","9","0","7300","800");
INSERT INTO compra VALUES("27","28","1","11","2020-12-17 13:05:29","vendido","12000","4","0","1000","800");
INSERT INTO compra VALUES("28","27","1","11","2020-12-17 13:05:29","vendido","900","2","0","1800","0");
INSERT INTO compra VALUES("29","25","1","11","2020-12-17 13:05:29","vendido","800","6","0","4800","0");
INSERT INTO compra VALUES("33","28","1","13","2021-01-11 16:27:36","vendido","12000","4","2","4200","6000");
INSERT INTO compra VALUES("34","25","1","13","2021-01-11 16:27:36","vendido","800","6","4","4000","800");
INSERT INTO compra VALUES("35","25","1","14","2021-01-11 16:48:40","vendido","800","4","4","3200","0");
INSERT INTO compra VALUES("36","28","1","15","2021-01-12 05:58:25","vendido","12000","6","6","72000","0");
INSERT INTO compra VALUES("40","28","2","17","2021-01-13 08:04:52","vendido","1200","4","3","4100","700");
INSERT INTO compra VALUES("45","28","2","19","2021-01-13 08:18:48","vendido","1200","7","3","8400","0");
INSERT INTO compra VALUES("46","28","2","20","2021-01-13 08:20:56","vendido","1200","5","5","6000","0");
INSERT INTO compra VALUES("47","28","2","21","2021-01-13 08:21:49","vendido","1200","5","2","6000","0");
INSERT INTO compra VALUES("53","28","2","26","2021-01-13 16:35:44","vendido","1200","6","5","3000","500");
INSERT INTO compra VALUES("54","26","2","26","2021-01-13 16:35:44","vendido","900","2","2","1500","50");
INSERT INTO compra VALUES("56","25","2","26","2021-01-13 16:35:45","vendido","1200","2","2","1000","400");
INSERT INTO compra VALUES("58","28","2","28","2021-01-14 23:50:56","vendido","1200","4","4","4800","0");
INSERT INTO compra VALUES("59","28","12","29","2021-01-15 12:49:33","vendido","1200","4","0","3000","900");
INSERT INTO compra VALUES("60","26","12","29","2021-01-15 12:49:34","vendido","900","6","1","2000","400");
INSERT INTO compra VALUES("61","25","12","29","2021-01-15 12:49:34","vendido","1200","8","0","7000","600");
INSERT INTO compra VALUES("62","26","2","30","2021-01-17 02:33:21","vendido","900","10","5","2000","900");
INSERT INTO compra VALUES("63","28","2","30","2021-01-17 02:33:22","vendido","1200","16","7","15200","600");
INSERT INTO compra VALUES("64","28","13","31","2021-01-26 12:08:45","vendido","1200","2","2","1000","800");
INSERT INTO compra VALUES("65","26","13","31","2021-01-26 12:08:45","vendido","900","5","0","4000","0");
INSERT INTO compra VALUES("67","26","13","31","2021-01-26 12:08:46","vendido","900","6","4","0","0");
INSERT INTO compra VALUES("68","28","7","32","2021-05-20 16:38:44","vendido","1200","3","0","3600","0");
INSERT INTO compra VALUES("69","25","7","32","2021-05-20 16:38:44","vendido","1200","4","0","4800","0");
INSERT INTO compra VALUES("70","29","7","32","2021-05-20 16:38:44","vendido","900","5","0","4500","0");
INSERT INTO compra VALUES("71","28","1","33","2021-05-21 05:38:35","vendido","1200","1","1","1200","0");
INSERT INTO compra VALUES("72","26","1","33","2021-05-21 05:38:35","vendido","900","2","2","1800","0");
INSERT INTO compra VALUES("73","29","1","33","2021-05-21 05:38:36","vendido","900","3","3","2700","0");
INSERT INTO compra VALUES("74","28","1","34","2021-05-21 06:20:16","vendido","1200","4","4","4800","0");
INSERT INTO compra VALUES("75","28","1","35","2021-05-21 06:24:09","vendido","1200","5","5","6000","0");
INSERT INTO compra VALUES("76","28","1","36","2021-05-21 08:09:30","vendido","1200","4","4","4800","0");
INSERT INTO compra VALUES("77","29","1","37","2021-05-21 08:19:55","vendido","900","3","3","2700","0");
INSERT INTO compra VALUES("78","25","1","37","2021-05-21 08:19:56","vendido","1200","4","4","4800","0");
INSERT INTO compra VALUES("79","28","1","37","2021-05-21 08:19:56","vendido","1200","6","6","7200","0");
INSERT INTO compra VALUES("80","28","1","38","2021-05-21 08:20:53","vendido","1200","3","3","3600","0");
INSERT INTO compra VALUES("81","26","1","38","2021-05-21 08:20:53","vendido","900","3","3","2700","0");
INSERT INTO compra VALUES("82","25","1","38","2021-05-21 08:20:54","vendido","1200","3","3","3600","0");
INSERT INTO compra VALUES("83","28","1","39","2021-05-21 08:23:18","vendido","1200","1","1","1200","0");
INSERT INTO compra VALUES("84","26","1","39","2021-05-21 08:23:18","vendido","900","2","2","1800","0");
INSERT INTO compra VALUES("85","25","1","39","2021-05-21 08:23:18","vendido","1200","3","3","3600","0");
INSERT INTO compra VALUES("90","28","17","41","2021-05-23 10:27:53","vendido","1200","2","2","1000","700");
INSERT INTO compra VALUES("91","26","17","41","2021-05-23 10:27:53","vendido","900","6","3","5000","300");
INSERT INTO compra VALUES("92","29","17","41","2021-05-23 10:27:53","vendido","900","5","4","3900","600");
INSERT INTO compra VALUES("93","25","17","41","2021-05-23 10:27:53","vendido","1200","7","2","8000","200");
INSERT INTO compra VALUES("94","28","17","42","2021-05-23 10:36:10","vendido","1200","3","3","3000","500");
INSERT INTO compra VALUES("95","26","17","42","2021-05-23 10:36:10","vendido","900","5","5","3000","600");
INSERT INTO compra VALUES("96","25","17","42","2021-05-23 10:36:10","vendido","1200","6","6","600","300");
INSERT INTO compra VALUES("97","28","17","43","2021-05-23 10:57:53","vendido","1200","3","3","3600","0");
INSERT INTO compra VALUES("98","28","7","44","2021-05-24 05:01:56","vendido","1200","1","1","1200","0");
INSERT INTO compra VALUES("99","29","7","44","2021-05-24 05:01:56","vendido","900","2","2","1800","0");
INSERT INTO compra VALUES("100","25","7","44","2021-05-24 05:01:56","vendido","1200","3","3","0","0");
INSERT INTO compra VALUES("101","29","7","45","2021-05-24 05:02:39","vendido","900","2","2","1800","0");
INSERT INTO compra VALUES("102","25","7","45","2021-05-24 05:02:40","vendido","1200","3","3","3000","0");
INSERT INTO compra VALUES("103","28","7","46","2021-05-24 05:03:34","vendido","1200","10","0","10000","0");
INSERT INTO compra VALUES("104","28","21","47","2021-05-25 03:42:36","vendido","1200","2","2","2400","0");
INSERT INTO compra VALUES("105","29","21","47","2021-05-25 03:42:36","vendido","900","3","0","2700","0");
INSERT INTO compra VALUES("106","25","21","47","2021-05-25 03:42:36","vendido","1200","4","4","4800","0");
INSERT INTO compra VALUES("107","28","22","48","2021-05-25 03:48:18","vendido","1200","2","2","2400","0");
INSERT INTO compra VALUES("108","29","22","48","2021-05-25 03:48:19","vendido","900","3","3","2700","0");
INSERT INTO compra VALUES("109","25","22","48","2021-05-25 03:48:19","vendido","1200","4","4","4800","0");
INSERT INTO compra VALUES("110","26","22","48","2021-05-25 03:48:19","vendido","900","5","5","4500","0");
INSERT INTO compra VALUES("111","26","22","48","2021-05-25 03:48:19","vendido","900","3","3","2700","0");
INSERT INTO compra VALUES("112","25","22","48","2021-05-25 03:48:19","vendido","1200","4","4","4800","0");
INSERT INTO compra VALUES("113","28","22","48","2021-05-25 03:48:19","vendido","1200","5","5","6000","0");
INSERT INTO compra VALUES("114","26","22","48","2021-05-25 03:48:19","vendido","900","2","2","1800","0");
INSERT INTO compra VALUES("115","28","22","48","2021-05-25 03:48:20","vendido","1200","1","1","1200","0");
INSERT INTO compra VALUES("116","29","22","48","2021-05-25 03:48:20","vendido","900","1","1","900","0");
INSERT INTO compra VALUES("117","28","22","48","2021-05-25 03:48:20","vendido","1200","2","2","2400","0");
INSERT INTO compra VALUES("118","25","22","48","2021-05-25 03:48:20","vendido","1200","3","3","3600","0");
INSERT INTO compra VALUES("119","26","22","48","2021-05-25 03:48:20","vendido","900","2","2","1800","0");
INSERT INTO compra VALUES("120","28","22","48","2021-05-25 03:48:20","vendido","1200","1","1","1200","0");
INSERT INTO compra VALUES("121","29","22","48","2021-05-25 03:48:20","vendido","900","2","2","1800","0");
INSERT INTO compra VALUES("122","28","22","48","2021-05-25 03:48:20","vendido","1200","3","3","3600","0");
INSERT INTO compra VALUES("123","26","22","48","2021-05-25 03:48:20","vendido","900","4","4","3600","0");
INSERT INTO compra VALUES("124","29","22","48","2021-05-25 03:48:21","vendido","900","5","5","4500","0");
INSERT INTO compra VALUES("125","312","1","50","2021-05-25 05:15:18","vendido","300","1","1","300","0");
INSERT INTO compra VALUES("126","284","1","50","2021-05-25 05:15:19","vendido","150","2","2","300","0");
INSERT INTO compra VALUES("127","291","1","50","2021-05-25 05:15:19","vendido","600","3","3","1800","0");
INSERT INTO compra VALUES("128","245","1","50","2021-05-25 05:15:19","vendido","800","4","4","3200","0");
INSERT INTO compra VALUES("129","105","1","50","2021-05-25 05:15:19","vendido","400","5","5","2000","0");
INSERT INTO compra VALUES("130","245","1","51","2021-05-25 05:19:36","vendido","800","4","4","3200","0");
INSERT INTO compra VALUES("131","283","23","52","2021-05-25 06:08:36","vendido","800","2","1","1000","600");
INSERT INTO compra VALUES("132","168","23","52","2021-05-25 06:08:37","vendido","300","8","2","1000","0");
INSERT INTO compra VALUES("133","88","23","52","2021-05-25 06:08:37","vendido","700","3","3","1500","600");
INSERT INTO compra VALUES("134","574","24","53","2021-05-25 11:04:48","vendido","15000","2","0","30000","0");
INSERT INTO compra VALUES("135","284","24","53","2021-05-25 11:04:49","vendido","150","4","2","600","0");
INSERT INTO compra VALUES("136","90","24","53","2021-05-25 11:04:49","vendido","700","5","1","3500","0");
INSERT INTO compra VALUES("137","245","24","54","2021-05-25 11:05:55","vendido","800","2","2","1600","0");
INSERT INTO compra VALUES("138","193","24","55","2021-05-25 11:37:17","vendido","400","4","4","1600","0");
INSERT INTO compra VALUES("139","250","12","56","2021-05-26 03:26:36","vendido","200","8","5","1000","0");
INSERT INTO compra VALUES("140","299","12","56","2021-05-26 03:26:36","vendido","2000","9","7","14000","0");
INSERT INTO compra VALUES("141","250","3","57","2021-05-26 05:43:20","vendido","200","5","5","1000","0");
INSERT INTO compra VALUES("142","283","25","58","2021-05-26 05:45:02","vendido","800","8","5","5500","0");
INSERT INTO compra VALUES("143","275","2","59","2021-05-26 13:31:18","vendido","1500","3","3","4500","0");
INSERT INTO compra VALUES("144","275","13","60","2021-05-27 03:39:55","vendido","1500","2","2","3000","0");
INSERT INTO compra VALUES("145","283","13","60","2021-05-27 03:39:55","vendido","800","8","8","6400","0");
INSERT INTO compra VALUES("146","169","11","61","2021-05-27 09:17:54","vendido","800","2","2","1550","50");
INSERT INTO compra VALUES("147","168","11","61","2021-05-27 09:17:54","vendido","300","1","1","250","50");
INSERT INTO compra VALUES("148","275","1","62","2021-06-23 09:48:52","vendido","15005","4","4","60020","0");
INSERT INTO compra VALUES("149","266","1","63","2021-06-23 09:50:26","vendido","1300.055","5","5","6500.275","0");
INSERT INTO compra VALUES("150","88","1","64","2021-06-23 09:56:12","vendido","700.07","2","2","0","0");
INSERT INTO compra VALUES("151","290","1","64","2021-06-23 09:56:12","vendido","400.7","5","5","0","0");
INSERT INTO compra VALUES("152","250","1","65","2021-06-23 09:58:14","vendido","200.7","8","8","1605.2","0");
INSERT INTO compra VALUES("153","313","1","65","2021-06-23 09:58:14","vendido","300.13","7","7","2100.22","0");
INSERT INTO compra VALUES("154","105","1","66","2021-06-23 10:03:02","vendido","400.003","3","3","1109","0");
INSERT INTO compra VALUES("155","169","1","66","2021-06-23 10:03:02","vendido","800.06","3","3","2400.18","0");
INSERT INTO compra VALUES("156","90","1","66","2021-06-23 10:03:02","vendido","700.553","7","7","4903.81","0");
INSERT INTO compra VALUES("157","313","1","66","2021-06-23 10:03:02","vendido","300.0402","7","7","2100.0003","0");
INSERT INTO compra VALUES("158","266","1","67","2021-06-25 07:41:46","vendido","1300.09","1","1","1299.3","0.56");
INSERT INTO compra VALUES("159","250","1","67","2021-06-25 07:41:46","vendido","200.05","2","2","27.79","112.31");
INSERT INTO compra VALUES("160","291","1","67","2021-06-25 07:41:47","vendido","600.411","5","5","2560.85","441.2");
INSERT INTO compra VALUES("161","90","1","68","2021-07-05 13:45:36","vendido","700","3","3","2100","0");
INSERT INTO compra VALUES("162","168","7","69","2021-07-07 11:49:20","vendido","300.09","3","3","90.027","0");
INSERT INTO compra VALUES("163","169","7","69","2021-07-07 11:49:20","vendido","800.03","2","2","160.00599999999997","0");
INSERT INTO compra VALUES("164","313","7","70","2021-07-07 11:53:00","vendido","300.04","4","4","120.016","0");
INSERT INTO compra VALUES("165","183","7","70","2021-07-07 11:53:00","vendido","547.45","3","3","164.235","0");
INSERT INTO compra VALUES("166","291","31","71","2021-07-07 12:05:09","vendido","600","2","2","600","0");
INSERT INTO compra VALUES("167","183","31","71","2021-07-07 12:05:09","vendido","500","4","4","1000","0");
INSERT INTO compra VALUES("169","766","33","73","2021-08-11 09:33:58","vendido","5000","1","1","4000","0");
INSERT INTO compra VALUES("170","768","33","74","2021-08-11 10:30:31","vendido","5000","2","2","9000","400");
INSERT INTO compra VALUES("171","767","33","75","2021-08-11 13:29:54","vendido","2000","1","1","2000","0");
INSERT INTO compra VALUES("172","767","25","76","2021-09-02 08:32:47","vendido","5000","2","2","10000","0");
INSERT INTO compra VALUES("173","767","49","77","2021-09-02 08:34:22","vendido","2000","5","5","10000","0");



DROP TABLE IF EXISTS compras;

CREATE TABLE `compras` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) DEFAULT NULL,
  `obs` varchar(100) COLLATE utf8_roman_ci DEFAULT '',
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idfuncionario` int(11) NOT NULL,
  `idatendimento` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcompra`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

INSERT INTO compras VALUES("1","1","Trarei a parte que falta na terça feira","2020-10-26 16:06:25","9","0");
INSERT INTO compras VALUES("2","2","","2020-10-27 01:28:40","9","0");
INSERT INTO compras VALUES("3","1","","2020-11-03 18:06:53","30","0");
INSERT INTO compras VALUES("4","1","","2020-11-10 10:29:15","10","0");
INSERT INTO compras VALUES("5","1","","2020-11-10 10:52:16","10","0");
INSERT INTO compras VALUES("6","1","","2020-11-20 11:10:52","30","0");
INSERT INTO compras VALUES("7","8","","2020-11-22 10:45:24","30","0");
INSERT INTO compras VALUES("8","1","","2020-11-24 09:34:15","30","0");
INSERT INTO compras VALUES("9","1","","2020-11-29 10:38:56","30","0");
INSERT INTO compras VALUES("10","1","","2020-12-08 08:44:52","10","0");
INSERT INTO compras VALUES("11","1","","2020-12-17 13:05:29","10","0");
INSERT INTO compras VALUES("13","1","","2021-01-11 16:27:36","1","0");
INSERT INTO compras VALUES("14","1","","2021-01-11 16:48:40","1","0");
INSERT INTO compras VALUES("15","1","","2021-01-12 05:58:25","1","0");
INSERT INTO compras VALUES("17","2","","2021-01-13 08:04:52","1","0");
INSERT INTO compras VALUES("19","2","em fase de cadastramento","2021-01-13 08:18:48","0","0");
INSERT INTO compras VALUES("20","2","em fase de cadastramento","2021-01-13 08:20:55","0","0");
INSERT INTO compras VALUES("21","2","em fase de cadastramento","2021-01-13 08:21:48","0","0");
INSERT INTO compras VALUES("26","2","","2021-01-13 16:35:44","1","23");
INSERT INTO compras VALUES("27","2","","2021-01-14 23:46:18","1","23");
INSERT INTO compras VALUES("28","2","","2021-01-14 23:50:56","1","0");
INSERT INTO compras VALUES("29","12","","2021-01-15 12:49:33","1","26");
INSERT INTO compras VALUES("30","2","","2021-01-17 02:33:21","1","1");
INSERT INTO compras VALUES("31","13","","2021-01-26 12:08:45","1","2");
INSERT INTO compras VALUES("32","7","","2021-05-20 16:38:43","1","27");
INSERT INTO compras VALUES("33","1","","2021-05-21 05:38:35","1","0");
INSERT INTO compras VALUES("34","1","","2021-05-21 06:20:15","1","0");
INSERT INTO compras VALUES("35","1","","2021-05-21 06:24:09","1","0");
INSERT INTO compras VALUES("36","1","","2021-05-21 08:09:30","1","0");
INSERT INTO compras VALUES("37","1","","2021-05-21 08:19:55","1","0");
INSERT INTO compras VALUES("38","1","","2021-05-21 08:20:53","1","0");
INSERT INTO compras VALUES("39","1","","2021-05-21 08:23:18","1","0");
INSERT INTO compras VALUES("41","17","deves pagar antes da data","2021-05-23 10:27:53","1","0");
INSERT INTO compras VALUES("42","17","Até segunda sai os resultados","2021-05-23 10:36:10","1","0");
INSERT INTO compras VALUES("43","17","","2021-05-23 10:57:53","1","0");
INSERT INTO compras VALUES("44","7","","2021-05-24 05:01:56","1","0");
INSERT INTO compras VALUES("45","7","","2021-05-24 05:02:39","1","27");
INSERT INTO compras VALUES("46","7","","2021-05-24 05:03:34","1","27");
INSERT INTO compras VALUES("47","21","","2021-05-25 03:42:35","1","0");
INSERT INTO compras VALUES("48","22","","2021-05-25 03:48:18","1","0");
INSERT INTO compras VALUES("49","1","","2021-05-25 05:06:45","1","0");
INSERT INTO compras VALUES("50","1","","2021-05-25 05:15:18","1","0");
INSERT INTO compras VALUES("51","1","","2021-05-25 05:19:36","1","0");
INSERT INTO compras VALUES("52","23","","2021-05-25 06:08:36","1","28");
INSERT INTO compras VALUES("53","24","","2021-05-25 11:04:48","1","0");
INSERT INTO compras VALUES("54","24","","2021-05-25 11:05:55","1","0");
INSERT INTO compras VALUES("55","24","","2021-05-25 11:37:17","1","0");
INSERT INTO compras VALUES("56","12","","2021-05-26 03:26:36","1","30");
INSERT INTO compras VALUES("57","3","nenhuma","2021-05-26 05:43:20","1","0");
INSERT INTO compras VALUES("58","25","nenhuma","2021-05-26 05:45:02","1","12");
INSERT INTO compras VALUES("59","2","","2021-05-26 13:31:18","1","0");
INSERT INTO compras VALUES("60","13","","2021-05-27 03:39:55","1","42");
INSERT INTO compras VALUES("61","11","","2021-05-27 09:17:54","1","46");
INSERT INTO compras VALUES("62","1","","2021-06-23 09:48:52","1","0");
INSERT INTO compras VALUES("63","1","","2021-06-23 09:50:26","1","0");
INSERT INTO compras VALUES("64","1","","2021-06-23 09:56:12","1","0");
INSERT INTO compras VALUES("65","1","","2021-06-23 09:58:14","1","0");
INSERT INTO compras VALUES("66","1","","2021-06-23 10:03:01","1","0");
INSERT INTO compras VALUES("67","1","","2021-06-25 07:41:46","1","0");
INSERT INTO compras VALUES("68","1","","2021-07-05 13:45:36","1","0");
INSERT INTO compras VALUES("69","7","","2021-07-07 11:49:20","1","0");
INSERT INTO compras VALUES("70","7","","2021-07-07 11:53:00","1","0");
INSERT INTO compras VALUES("71","31","","2021-07-07 12:05:09","1","0");
INSERT INTO compras VALUES("73","33","","2021-08-11 09:33:58","1","42");
INSERT INTO compras VALUES("74","33","","2021-08-11 10:30:31","1","42");
INSERT INTO compras VALUES("75","33","","2021-08-11 13:29:54","1","42");
INSERT INTO compras VALUES("76","25","","2021-09-02 08:32:47","31","33");
INSERT INTO compras VALUES("77","49","","2021-09-02 08:34:22","31","0");



DROP TABLE IF EXISTS cursos;

CREATE TABLE `cursos` (
  `idcurso` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO cursos VALUES("1","Nenhum");
INSERT INTO cursos VALUES("2","Ciências Físicas e Biológicas");
INSERT INTO cursos VALUES("3","Ciências Económicas e Jurídicas");
INSERT INTO cursos VALUES("4","Enfermagem");
INSERT INTO cursos VALUES("5","Informática de Gestão");



DROP TABLE IF EXISTS dadosdaempresa;

CREATE TABLE `dadosdaempresa` (
  `iddadosdaempresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) DEFAULT NULL,
  `servicos` text,
  `numerodecontribuinte` varchar(120) DEFAULT NULL,
  `contabancaria` text,
  `email` text,
  `localizacao` text,
  `telefone` text,
  `site` varchar(100) NOT NULL,
  `localizacaoprecisa` varchar(220) DEFAULT NULL,
  `nomedodireitor` varchar(200) NOT NULL DEFAULT 'Esmael Calunga',
  PRIMARY KEY (`iddadosdaempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO dadosdaempresa VALUES("1","Colégio Martino M. Zangala","Ensino Primário, Iº Ciclo e Ensino Secundário","45645464","BIC: AO066909503484389589384","","Viana - Luanda, Angola","95448246","","Bairro Jacinto Tchipa, Ciquentinha, Por detrás das roloutes","Zangala");



DROP TABLE IF EXISTS descadastrados;

CREATE TABLE `descadastrados` (
  `iddescadastrado` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL DEFAULT 'Inactivo',
  `descricao` text,
  `data` date NOT NULL,
  PRIMARY KEY (`iddescadastrado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO descadastrados VALUES("5","20","27","Inactivo","","2021-08-17");
INSERT INTO descadastrados VALUES("6","22","29","Desistiu","","2021-08-17");
INSERT INTO descadastrados VALUES("7","19","26","Expulso","Lutou na sala de aula","2021-08-16");
INSERT INTO descadastrados VALUES("8","54","57","Faleceu","morreu na instituiçao","2021-08-20");



DROP TABLE IF EXISTS disciplinas;

CREATE TABLE `disciplinas` (
  `iddisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `idprofessor` int(11) NOT NULL,
  `idprofessorauxiliar` int(11) NOT NULL DEFAULT '0',
  `idtipodedisciplina` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `abreviatura` varchar(20) DEFAULT NULL,
  `idturma` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `tipodedisciplina` varchar(220) NOT NULL DEFAULT 'Normal',
  `agrupamento` varchar(200) DEFAULT NULL,
  `obs` varchar(220) DEFAULT NULL,
  PRIMARY KEY (`iddisciplina`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

INSERT INTO disciplinas VALUES("2","1","39","1","Matemática","MAT","13","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("3","1","39","1","Matemática","MAT","11","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("4","1","39","1","Matemática","MAT","10","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("5","30","0","2","Física","FIS","8","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("6","27","33","3","Biologia","BIO","13","2","Chave","Formação Específica","obs");
INSERT INTO disciplinas VALUES("7","27","33","3","Biologia","BIO","8","2","Chave","Formação Específica","obs");
INSERT INTO disciplinas VALUES("8","27","33","3","Biologia","BIO","7","2","Chave","Formação Específica","obs");
INSERT INTO disciplinas VALUES("9","17","0","5","Inglês","ING","2","2","Normal","Opção","obs");
INSERT INTO disciplinas VALUES("10","17","0","5","Inglês","ING","6","2","Normal","Opção","obs");
INSERT INTO disciplinas VALUES("11","17","0","5","Inglês","ING","10","2","Normal","Opção","obs");
INSERT INTO disciplinas VALUES("12","37","39","4","Química","QUIM","13","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("13","37","39","4","Química","QUIM","11","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("14","37","39","4","Química","QUIM","9","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("15","17","0","2","Física","FIS","13","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("16","17","0","2","Física","FIS","9","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("17","17","0","2","Física","FIS","7","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("18","37","41","2","Física","FIS","2","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("19","37","41","2","Física","FIS","6","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("20","1","0","3","Biologia","BIO","11","2","Chave","Formação Específica","obs");
INSERT INTO disciplinas VALUES("21","1","0","4","Química","QUIM","2","2","Normal","Formação Específica","obs");
INSERT INTO disciplinas VALUES("22","1","0","4","Química","QUIM","6","2","Normal","Formação Específica","obs");
INSERT INTO disciplinas VALUES("23","1","0","4","Química","QUIM","7","2","Normal","Formação Específica","obs");
INSERT INTO disciplinas VALUES("24","1","0","1","Matemática","MAT","14","1","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("25","1","0","1","Matemática","MAT","3","1","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("26","37","30","1","Matemática","MAT","4","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("27","37","30","1","Matemática","MAT","7","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("28","39","40","5","Inglês","ING","13","2","Normal","Opção","obs");
INSERT INTO disciplinas VALUES("29","29","0","6","Educação Física","Ed. Física","13","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("30","29","0","6","Educação Física","Ed. Física","4","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("31","29","0","6","Educação Física","Ed. Física","9","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("32","1","0","6","Educação Física","Ed. Física","11","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("33","1","0","6","Educação Física","Ed. Física","10","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("34","1","0","6","Educação Física","Ed. Física","2","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("35","29","39","5","Inglês","ING","15","1","Normal","Opção","obs");
INSERT INTO disciplinas VALUES("36","1","37","4","Química","QUIM","5","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("37","1","37","4","Química","QUIM","8","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("38","30","34","3","Biologia","BIO","10","2","Chave","Formação Específica","obs");
INSERT INTO disciplinas VALUES("39","1","0","5","Inglês","ING","9","2","Normal","Opção","obs");
INSERT INTO disciplinas VALUES("40","1","0","5","Inglês","ING","5","2","Normal","Opção","obs");
INSERT INTO disciplinas VALUES("41","1","0","5","Inglês","ING","7","2","Normal","Opção","obs");
INSERT INTO disciplinas VALUES("42","32","0","6","Educação Física","Ed. Física","5","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("43","32","0","6","Educação Física","Ed. Física","8","2","Normal","Formação Geral","obs");
INSERT INTO disciplinas VALUES("44","1","0","2","Física","FIS","5","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("45","37","0","4","Química","QUIM","19","2","Normal","Formação Específica","obs");
INSERT INTO disciplinas VALUES("46","37","0","4","Química","QUIM","18","2","Normal","Formação Específica","obs");
INSERT INTO disciplinas VALUES("47","37","0","4","Química","QUIM","16","2","Normal","Formação Específica","obs");
INSERT INTO disciplinas VALUES("48","1","0","2","Física","FIS","19","2","Chave","Formação Geral","obs");
INSERT INTO disciplinas VALUES("49","1","0","2","Física","FIS","16","2","Chave","Formação Geral","obs");



DROP TABLE IF EXISTS documentostratados;

CREATE TABLE `documentostratados` (
  `iddocumentotratado` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `tipodedocumento` varchar(50) NOT NULL DEFAULT 'Declaração Sem Notas',
  `preco` double NOT NULL DEFAULT '0',
  `desconto` double NOT NULL DEFAULT '0',
  `valorpago` double NOT NULL DEFAULT '0',
  `datadeentrada` date NOT NULL,
  `datadolevantamento` date NOT NULL,
  `jalevantado` varchar(10) NOT NULL DEFAULT 'Não',
  `escoladedestino` varchar(220) DEFAULT NULL,
  `idtrimestre` int(11) DEFAULT NULL,
  `ensino` varchar(40) DEFAULT NULL,
  `classeum` int(11) DEFAULT NULL,
  `classedois` int(11) DEFAULT NULL,
  `classetres` int(11) DEFAULT NULL,
  `classequatro` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddocumentotratado`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO documentostratados VALUES("4","64","63","Guia de Transferência","1200","400","800","2021-09-11","2021-09-11","Sim","Isutic","0","","0","0","0","0");
INSERT INTO documentostratados VALUES("5","27","35","Guia de Transferência","350","50","200","2021-09-11","2021-09-11","Não","Colêgio Rainha Ginga","0","","0","0","0","0");
INSERT INTO documentostratados VALUES("6","69","68","Declaração sem notas","1200","500","400","2021-09-11","2021-09-11","Sim","","0","","0","0","0","0");
INSERT INTO documentostratados VALUES("7","22","29","Declaração com notas","2450","500","1000","2021-09-11","2021-09-11","Sim","","0","","0","0","0","0");
INSERT INTO documentostratados VALUES("8","23","31","Declaração com notas","450","0","450","2021-09-11","2021-09-11","Não","","0","","0","0","0","0");
INSERT INTO documentostratados VALUES("9","13","18","Declaração com notas","1200","0","1200","2021-09-11","2021-09-11","Não","","0","","0","0","0","0");
INSERT INTO documentostratados VALUES("10","41","51","Declaração sem notas","0","0","0","2021-09-11","2021-09-11","Não","","0","","0","0","0","0");
INSERT INTO documentostratados VALUES("11","69","68","Declaração com notas","0","0","0","2021-09-11","2021-09-11","Não","","0","","0","0","0","0");
INSERT INTO documentostratados VALUES("12","69","68","Boletin","600","60","450","2021-09-11","2021-09-11","Não","","3","","0","0","0","0");
INSERT INTO documentostratados VALUES("13","10","15","Boletin","1450","600","0","2021-09-11","2021-09-11","Não","","1","","0","0","0","0");
INSERT INTO documentostratados VALUES("14","41","61","Termo de Matrícula","1800","250","1000","2021-09-11","2021-09-15","Não","","0","","0","0","0","0");
INSERT INTO documentostratados VALUES("17","44","60","Certificado","3400","0","3400","2021-09-11","2021-09-11","Não","","0","medio13","5","11","4","9");
INSERT INTO documentostratados VALUES("18","44","76","Certificado","1200","0","1200","2021-09-12","2021-09-12","Não","","0","medio12","5","11","4","0");
INSERT INTO documentostratados VALUES("19","73","73","Certificado","500","0","500","2021-09-12","2021-09-12","Não","","0","primeirociclo","19","18","16","0");
INSERT INTO documentostratados VALUES("20","74","75","Certificado","500","0","500","2021-09-12","2021-09-12","Não","","0","primario","20","6","17","0");



DROP TABLE IF EXISTS entradas;

CREATE TABLE `entradas` (
  `identrada` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `idtipo` int(11) DEFAULT NULL,
  `valor` double NOT NULL DEFAULT '0',
  `divida` double NOT NULL DEFAULT '0',
  `formadepagamento` varchar(200) NOT NULL DEFAULT 'Dinheiro',
  `idaluno` int(11) DEFAULT NULL,
  `idturma` int(11) DEFAULT NULL,
  `datadaentrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idanolectivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`identrada`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;

INSERT INTO entradas VALUES("2","1","Registro de Matrícula","Matrícula","10","900","200","Dinheiro","8","5","2021-07-30 08:25:21","0");
INSERT INTO entradas VALUES("4","1","Registro de Matrícula","Matrícula","12","3500","500","Dinheiro","8","3","2021-07-30 08:29:02","0");
INSERT INTO entradas VALUES("5","1","Registro de Matrícula","Matrícula","13","11000","0","BIC","9","3","2021-08-02 10:19:13","0");
INSERT INTO entradas VALUES("6","1","Registro de Confirmação","Confirmação","14","5000","0","Dinheiro","9","6","2021-08-02 10:21:37","0");
INSERT INTO entradas VALUES("7","1","Registro de Matrícula","Matrícula","16","300","2700","BIC","11","6","2021-08-02 11:11:01","0");
INSERT INTO entradas VALUES("8","1","Registro de Matrícula","Matrícula","17","4500","0","Dinheiro","12","4","2021-08-02 11:11:56","0");
INSERT INTO entradas VALUES("9","1","Registro de Propina","Propina","1","1000","0","Dinheiro","8","6","2021-08-02 15:08:20","0");
INSERT INTO entradas VALUES("10","1","Registro de Propina","Propina","2","5000","0","Dinheiro","8","5","2021-08-02 15:10:49","0");
INSERT INTO entradas VALUES("12","1","Registro de Matrícula","Matrícula","18","4500","0","Dinheiro","13","4","2021-08-02 15:30:47","0");
INSERT INTO entradas VALUES("13","1","Registro de Matrícula","Matrícula","19","0","0","Dinheiro","14","7","2021-08-03 15:34:59","0");
INSERT INTO entradas VALUES("14","1","Registro de Matrícula","Matrícula","20","0","0","Dinheiro","15","10","2021-08-03 15:35:53","0");
INSERT INTO entradas VALUES("15","1","Registro de Matrícula","Matrícula","21","2000","0","Dinheiro","16","2","2021-08-03 15:36:52","0");
INSERT INTO entradas VALUES("16","1","Registro de Matrícula","Matrícula","22","4500","0","Dinheiro","16","4","2021-08-03 15:37:02","0");
INSERT INTO entradas VALUES("18","1","Registro de Matrícula","Matrícula","24","4500","0","Dinheiro","17","4","2021-08-03 15:39:57","0");
INSERT INTO entradas VALUES("19","1","Registro de Matrícula","Matrícula","25","0","0","Dinheiro","18","7","2021-08-03 15:41:28","0");
INSERT INTO entradas VALUES("20","1","Registro de Matrícula","Matrícula","26","0","0","Dinheiro","19","9","2021-08-03 15:42:22","0");
INSERT INTO entradas VALUES("21","1","Registro de Matrícula","Matrícula","27","14000","0","Dinheiro","20","13","2021-08-03 20:40:04","0");
INSERT INTO entradas VALUES("22","1","Registro de Matrícula","Matrícula","28","14000","0","Dinheiro","21","13","2021-08-03 20:40:52","0");
INSERT INTO entradas VALUES("23","1","Registro de Matrícula","Matrícula","29","0","0","Dinheiro","22","8","2021-08-03 20:44:05","0");
INSERT INTO entradas VALUES("24","1","Registro de Matrícula","Matrícula","30","0","0","Dinheiro","22","11","2021-08-03 20:44:24","0");
INSERT INTO entradas VALUES("25","1","Registro de Matrícula","Matrícula","31","14000","0","Dinheiro","23","13","2021-08-03 20:46:46","0");
INSERT INTO entradas VALUES("26","1","Registro de Matrícula","Matrícula","32","0","0","Dinheiro","24","7","2021-08-03 20:47:37","0");
INSERT INTO entradas VALUES("27","1","Registro de Matrícula","Matrícula","33","0","0","Dinheiro","25","8","2021-08-04 06:16:25","0");
INSERT INTO entradas VALUES("28","1","Registro de Propina","Propina","5","1200","0","Dinheiro","22","8","2021-08-04 06:32:27","2");
INSERT INTO entradas VALUES("29","1","Registro de Matrícula","Matrícula","36","1100","0","BIC","28","2","2021-08-04 06:36:13","2");
INSERT INTO entradas VALUES("30","1","Registro de Matrícula","Matrícula","38","4500","0","BIC","30","4","2021-08-04 06:39:01","2");
INSERT INTO entradas VALUES("31","1","Registro de Matrícula","Matrícula","39","14000","0","Dinheiro","31","3","2021-08-04 06:39:55","1");
INSERT INTO entradas VALUES("32","1","Registro de Confirmação","Confirmação","40","4500","0","Dinheiro","31","4","2021-08-04 06:40:39","2");
INSERT INTO entradas VALUES("33","1","Registro de Matrícula","Matrícula","41","600","0","Multicaixa Express","32","8","2021-08-04 06:46:41","2");
INSERT INTO entradas VALUES("34","1","Registro de Matrícula","Matrícula","42","0","0","BAI","33","4","2021-08-04 06:49:19","2");
INSERT INTO entradas VALUES("35","1","Registro de Matrícula","Matrícula","43","1400","0","Dinheiro","34","3","2021-08-04 07:48:16","1");
INSERT INTO entradas VALUES("36","1","Registro de Propina","Propina","6","5000","0","Dinheiro","37","13","2021-08-06 07:25:41","2");
INSERT INTO entradas VALUES("37","1","Registro de Propina","Propina","7","1000","1200","BIC","37","7","2021-08-06 07:26:20","2");
INSERT INTO entradas VALUES("38","1","Registro de Matrícula","Matrícula","49","1200","0","Dinheiro","39","5","2021-08-06 10:35:28","2");
INSERT INTO entradas VALUES("39","1","oferta","Outras","0","3400","450","Dinheiro","0","0","2021-08-06 10:59:21","0");
INSERT INTO entradas VALUES("41","1","Registro de Matrícula","Matrícula","50","900","100","Dinheiro","40","8","2021-08-08 05:38:03","2");
INSERT INTO entradas VALUES("43","1","Venda para o aluno(Armando Da Costa Zeferino Dumba)| 1  Uniforme de Educação física","Material Escolar","73","4000","1000","Dinheiro","33","4","2021-08-11 09:33:58","2");
INSERT INTO entradas VALUES("44","1","Venda de 2  Uniforme Escolar","Material Escolar","74","9000","600","Dinheiro","33","4","2021-08-11 10:30:32","2");
INSERT INTO entradas VALUES("45","1","Registro de Matrícula","Matrícula","52","1900","0","Dinheiro","42","9","2021-08-11 13:28:24","2");
INSERT INTO entradas VALUES("46","1","Registro de Propina de 08/2021","Propina","8","2300","0","Dinheiro","30","4","2021-08-11 13:28:58","2");
INSERT INTO entradas VALUES("47","1","Venda de 1  Batas para Laboratório","Material Escolar","75","2000","0","Dinheiro","33","4","2021-08-11 13:29:54","2");
INSERT INTO entradas VALUES("48","1","Registro de Matrícula","Matrícula","53","4500","0","Dinheiro","43","4","2021-08-13 10:39:30","2");
INSERT INTO entradas VALUES("49","1","Registro de Propina de 07/2021","Propina","9","2300","0","Multicaixa Express","33","4","2021-08-13 10:41:30","2");
INSERT INTO entradas VALUES("54","1","Registro de Confirmação","Confirmação","57","4500","0","Dinheiro","54","7","2021-08-17 06:39:18","2");
INSERT INTO entradas VALUES("55","1","Registro de Matrícula","Matrícula","58","4500","0","Dinheiro","55","4","2021-08-17 11:53:00","2");
INSERT INTO entradas VALUES("62","31","Registro de Rematrícula","Rematrícula","60","1000","3500","Dinheiro","44","9","2021-08-21 09:15:38","2");
INSERT INTO entradas VALUES("63","31","Registro de Matrícula","Matrícula","61","6800","0","Dinheiro","41","7","2021-08-20 09:23:58","2");
INSERT INTO entradas VALUES("64","31","Registro de Matrícula","Matrícula","62","4500","0","Dinheiro","58","11","2021-08-21 19:53:05","2");
INSERT INTO entradas VALUES("65","31","Oferta preciosa de Barros","Outras","0","1900","3000","Cheque","0","0","2021-08-22 04:32:18","2");
INSERT INTO entradas VALUES("79","31","Dívida Precedente","Inserção no Sistema","62","1200","3000","Dinheiro","62","0","2021-08-25 14:49:08","0");
INSERT INTO entradas VALUES("82","31","valor restante","Matrícula","61","1200","0","Multicaixa Express","41","7","2021-08-23 11:00:36","2");
INSERT INTO entradas VALUES("83","31","valor restante","Matrícula","61","1200","0","Multicaixa Express","41","7","2021-08-23 11:01:26","2");
INSERT INTO entradas VALUES("84","31","Matricula 2","Matrícula","61","4500","0","Dinheiro","41","7","2021-08-23 11:02:01","2");
INSERT INTO entradas VALUES("85","31","pagamento","Matrícula","61","4500","0","Multicaixa Express","41","7","2021-08-23 11:02:24","2");
INSERT INTO entradas VALUES("87","31","t","Matrícula","61","500","0","Multicaixa Express","41","7","2021-08-23 11:03:34","2");
INSERT INTO entradas VALUES("88","31","Ener","Matrícula","61","1200","0","Dinheiro","41","7","2021-08-23 11:05:36","2");
INSERT INTO entradas VALUES("89","31","des","Matrícula","61","500","0","Dinheiro","41","7","2021-08-23 11:05:58","2");
INSERT INTO entradas VALUES("90","31","des","Matrícula","61","1000","0","BAI","41","7","2021-08-23 11:06:39","2");
INSERT INTO entradas VALUES("91","31","des","Matrícula","61","1000","0","BAI","41","7","2021-08-23 11:08:03","2");
INSERT INTO entradas VALUES("92","31","desc","Matrícula","61","1400","0","BAI","41","7","2021-08-23 11:09:06","2");
INSERT INTO entradas VALUES("93","31","desc","Matrícula","61","1000","0","BIC","41","7","2021-08-23 11:11:34","2");
INSERT INTO entradas VALUES("94","31","es","Matrícula","61","1400","0","Dinheiro","41","7","2021-08-23 11:27:42","2");
INSERT INTO entradas VALUES("97","31","sw","Matrícula","61","300","3000","Dinheiro","41","7","2021-08-23 11:30:45","2");
INSERT INTO entradas VALUES("98","31","Registro de Matrícula","Matrícula","63","3900","0","Dinheiro","64","7","2021-08-23 11:46:09","2");
INSERT INTO entradas VALUES("99","31","Funcionou perfeitamene","Matrícula","63","0","800","Dinheiro","64","7","2021-08-23 12:04:31","2");
INSERT INTO entradas VALUES("100","31","Registro de Matrícula","Matrícula","41","2200","0","Multicaixa Express","32","8","2021-08-04 06:46:41","2");
INSERT INTO entradas VALUES("101","31","pagando o que faltava","Matrícula","41","120","0","Dinheiro","32","8","2021-08-23 18:27:19","2");
INSERT INTO entradas VALUES("108","31","Pagamento da divida","Matrícula","42","200","3400","Dinheiro","33","4","2021-08-24 08:37:39","2");
INSERT INTO entradas VALUES("119","31","Dívida Precedente","Inserção no Sistema","65","2400","0","Dinheiro","65","0","2021-08-24 09:05:31","0");
INSERT INTO entradas VALUES("120","31","Pagamento da divida","Inserção no Sistema","65","1200","0","BAI","65","0","2021-08-24 09:06:02","0");
INSERT INTO entradas VALUES("121","31","Pagamento da divida","Inserção no Sistema","65","6300","0","Dinheiro","65","0","2021-08-24 09:06:37","0");
INSERT INTO entradas VALUES("122","31","primeiros socorros","Inserção no Sistema","65","13000","0","Dinheiro","65","0","2021-08-24 09:06:49","0");
INSERT INTO entradas VALUES("124","31","Pagamento da divida","Confirmação","40","300","0","Dinheiro","31","4","2021-08-24 09:08:50","2");
INSERT INTO entradas VALUES("125","31","Registro de Confirmação","Confirmação","40","1900","200","BAI","31","4","2021-08-04 06:40:39","2");
INSERT INTO entradas VALUES("131","31","Registro de Propina de 06/2021","Propina","13","1300","0","Dinheiro","54","7","2021-08-25 20:17:35","2");
INSERT INTO entradas VALUES("138","31","Registro de Propina de 08/2021","Propina","16","1300","0","Dinheiro","37","7","2021-08-25 21:56:57","2");
INSERT INTO entradas VALUES("140","31","Registro de Propina de 10/2021","Propina","17","2000","0","Dinheiro","22","8","2021-08-25 22:03:20","2");
INSERT INTO entradas VALUES("150","30","Registro de Propina de 07/2021","Propina","18","4500","0","Dinheiro","22","11","2021-08-30 11:06:52","2");
INSERT INTO entradas VALUES("151","30","Registro de Matrícula","Matrícula","64","4500","0","Dinheiro","66","4","2021-09-02 10:41:22","2");
INSERT INTO entradas VALUES("152","30","Registro de Propina de 07/2021","Propina","19","4000","0","Dinheiro","44","9","2021-09-02 11:17:11","2");
INSERT INTO entradas VALUES("153","30","Registro de Propina de 09/2021","Propina","20","1000","200","Multicaixa Express","54","7","2021-09-02 17:20:30","2");
INSERT INTO entradas VALUES("154","1","Registro de Confirmação","Confirmação","65","1000","200","Dinheiro","64","5","2021-09-03 10:35:38","2");
INSERT INTO entradas VALUES("155","1","Registro de Propina de 09/2021","Propina","21","1300","0","Dinheiro","64","7","2021-09-06 04:19:32","2");
INSERT INTO entradas VALUES("156","1","Registro de Propina de 09/2021","Propina","22","5000","0","Dinheiro","64","5","2021-09-06 04:19:39","2");
INSERT INTO entradas VALUES("157","1","Registro de Propina de 09/2021","Propina","23","2300","0","Dinheiro","55","4","2021-09-06 04:19:58","2");
INSERT INTO entradas VALUES("158","1","Registro de Propina de 09/2021","Propina","24","2000","300","Dinheiro","30","4","2021-09-06 10:11:18","2");
INSERT INTO entradas VALUES("159","1","Registro de Matrícula","Matrícula","71","3000","3200","BIC","72","7","2021-09-06 10:13:23","2");
INSERT INTO entradas VALUES("160","31","Registro de Propina de 09/2021","Propina","25","2300","0","Dinheiro","33","4","2021-09-07 06:57:05","2");
INSERT INTO entradas VALUES("161","31","Registro de Propina de 09/2021","Propina","26","4000","0","Dinheiro","42","9","2021-09-07 06:57:15","2");
INSERT INTO entradas VALUES("162","31","Registro de Propina de 09/2021","Propina","27","2000","0","Dinheiro","69","8","2021-09-09 14:50:49","2");
INSERT INTO entradas VALUES("163","31","Registro de Confirmação","Confirmação","72","0","0","Dinheiro","25","0","2021-09-09 15:56:39","2");
INSERT INTO entradas VALUES("164","31","Justificação de 5 Faltas do Iº trimestre","Justificação de Faltas","33","300","200","Multicaixa Express","25","8","2021-09-09 16:12:06","0");
INSERT INTO entradas VALUES("165","31","Justificação de 1 Faltas do IIIº trimestre","Justificação de Faltas","33","500","0","BIC","25","8","2021-09-09 16:12:54","2");
INSERT INTO entradas VALUES("166","31","Justificação de 3 Faltas do IIº trimestre","Justificação de Faltas","61","200","50","Multicaixa Express","41","7","2021-09-09 16:19:09","2");
INSERT INTO entradas VALUES("167","31","Justificação de 3 Faltas do Iº trimestre","Justificação de Faltas","36","150","300","Cheque","35","7","2021-09-09 16:41:40","2");
INSERT INTO entradas VALUES("168","31","Justificação de 2 Faltas do IIº trimestre","Justificação de Faltas","33","0","200","Dinheiro","54","7","2021-09-09 16:45:46","2");
INSERT INTO entradas VALUES("169","31","Justificação de 4 Faltas do IIIº trimestre","Justificação de Faltas","44","0","900","Multicaixa Express","41","7","2021-09-09 16:49:30","2");
INSERT INTO entradas VALUES("175","31","Guia de Transferência","Tratar Documento","4","800","0","Dinheiro","64","7","2021-09-11 00:07:40","2");
INSERT INTO entradas VALUES("176","31","Guia de Transferência","Tratar Documento","5","200","100","BIC","27","7","2021-09-11 03:40:21","2");
INSERT INTO entradas VALUES("177","31","Declaração sem notas","Tratar Documento","6","400","300","BAI","69","8","2021-09-11 04:22:43","2");
INSERT INTO entradas VALUES("178","31","Declaração com notas","Tratar Documento","7","1000","950","BIC","22","8","2021-09-11 04:47:34","2");
INSERT INTO entradas VALUES("179","31","Declaração com notas","Tratar Documento","8","450","0","Dinheiro","23","13","2021-09-11 07:25:47","2");
INSERT INTO entradas VALUES("180","31","Declaração com notas","Tratar Documento","9","1200","0","Dinheiro","13","4","2021-09-11 07:58:37","2");
INSERT INTO entradas VALUES("181","31","Declaração sem notas","Tratar Documento","10","0","0","Dinheiro","41","15","2021-09-11 08:11:19","1");
INSERT INTO entradas VALUES("182","31","Declaração com notas","Tratar Documento","11","0","0","Dinheiro","69","8","2021-09-11 08:59:52","2");
INSERT INTO entradas VALUES("183","31","Boletin","Tratar Documento","12","0","0","Dinheiro","69","8","2021-09-11 09:18:16","2");
INSERT INTO entradas VALUES("184","31","Pagamento da divida","Tratar Documento","12","450","90","Multicaixa Express","69","8","2021-09-11 09:32:27","2");
INSERT INTO entradas VALUES("185","31","Boletin","Tratar Documento","13","0","850","Dinheiro","10","2","2021-09-11 10:54:28","2");
INSERT INTO entradas VALUES("186","31","Termo de Matrícula","Tratar Documento","14","1000","550","BIC","41","7","2021-09-11 12:21:59","2");
INSERT INTO entradas VALUES("187","31","Registro de Matrícula","Matrícula","73","4000","500","Dinheiro","73","16","2021-09-11 14:46:14","2");
INSERT INTO entradas VALUES("188","31","Registro de Matrícula","Matrícula","74","3000","0","Dinheiro","73","14","2021-09-11 14:46:33","1");
INSERT INTO entradas VALUES("189","31","Registro de Matrícula","Matrícula","75","1200","0","Dinheiro","74","17","2021-09-11 14:47:58","2");
INSERT INTO entradas VALUES("190","31","Dívida Precedente","Inserção no Sistema","75","0","300","","75","0","2021-09-11 15:16:20","0");
INSERT INTO entradas VALUES("191","31","Registro de Confirmação","Confirmação","76","400","0","Dinheiro","44","4","2021-09-11 15:18:23","2");
INSERT INTO entradas VALUES("192","31","Registro de Confirmação","Confirmação","77","1000","0","Dinheiro","44","11","2021-09-11 15:18:40","2");
INSERT INTO entradas VALUES("193","31","Registro de Confirmação","Confirmação","78","1200","0","Dinheiro","44","5","2021-09-11 15:18:49","2");
INSERT INTO entradas VALUES("196","31","Certificado","Tratar Documento","17","3400","0","Dinheiro","44","9","2021-09-11 18:25:03","2");
INSERT INTO entradas VALUES("197","31","Certificado","Tratar Documento","18","1200","0","Dinheiro","44","4","2021-09-12 08:12:51","2");
INSERT INTO entradas VALUES("198","31","Registro de Confirmação","Confirmação","79","1500","0","Dinheiro","73","18","2021-09-12 08:27:57","2");
INSERT INTO entradas VALUES("199","31","Registro de Confirmação","Confirmação","80","1250","0","Dinheiro","73","19","2021-09-12 08:28:03","2");
INSERT INTO entradas VALUES("200","31","Certificado","Tratar Documento","19","500","0","Dinheiro","73","16","2021-09-12 08:28:52","2");
INSERT INTO entradas VALUES("201","31","Registro de Confirmação","Confirmação","81","1250","0","Dinheiro","74","20","2021-09-12 09:05:32","2");
INSERT INTO entradas VALUES("202","31","Registro de Confirmação","Confirmação","82","5500","0","Dinheiro","74","6","2021-09-12 09:05:40","2");
INSERT INTO entradas VALUES("203","31","Certificado","Tratar Documento","20","500","0","Dinheiro","74","17","2021-09-12 09:06:33","2");
INSERT INTO entradas VALUES("204","31","Registro de Confirmação","Confirmação","83","4500","0","Dinheiro","77","7","2021-09-23 12:27:46","2");
INSERT INTO entradas VALUES("205","31","Registro de Matrícula","Matrícula","84","4500","0","Dinheiro","78","4","2021-09-29 17:16:26","2");
INSERT INTO entradas VALUES("206","31","Registro de Propina de 10/2021","Propina","28","2300","0","Dinheiro","44","4","2021-10-01 08:30:40","2");
INSERT INTO entradas VALUES("207","31","Registro de Confirmação","Confirmação","85","1200","0","Dinheiro","31","5","2021-09-02 08:07:44","2");
INSERT INTO entradas VALUES("208","31","Venda de 2  Batas para Laboratório","Material Escolar","76","10000","0","Dinheiro","25","8","2021-09-02 08:32:47","2");
INSERT INTO entradas VALUES("209","31","Venda de 5  Batas para Laboratório","Material Escolar","77","10000","0","Dinheiro","49","0","2021-09-02 08:34:22","0");
INSERT INTO entradas VALUES("210","31","Registro de Propina de 11/2021","Propina","29","1850","0","Dinheiro","44","4","2021-09-02 18:25:53","2");
INSERT INTO entradas VALUES("211","31","Registro de Propina de 10/2021","Propina","30","2200","3000","Multicaixa Express","64","5","2021-09-02 18:29:02","2");
INSERT INTO entradas VALUES("212","31","Registro de Propina de 09/2021","Propina","31","1200","1000","Dinheiro","25","8","2021-09-02 18:30:03","2");
INSERT INTO entradas VALUES("213","31","Registro de Propina de 10/2021","Propina","32","2300","0","Dinheiro","30","4","2021-09-05 05:01:46","2");
INSERT INTO entradas VALUES("214","31","Registro de Propina de 11/2021","Propina","33","2300","0","Dinheiro","30","4","2021-09-05 05:02:02","2");
INSERT INTO entradas VALUES("215","31","Registro de Propina de 12/2021","Propina","34","2700","4000","Dinheiro","30","4","2021-09-05 05:02:31","2");
INSERT INTO entradas VALUES("216","31","Registro de Propina de 10/2021","Propina","35","3500","3000","Dinheiro","22","11","2021-11-05 08:12:08","2");
INSERT INTO entradas VALUES("217","31","Registro de Propina de 08/2021","Propina","36","4500","2500","Dinheiro","44","11","2021-11-05 08:33:02","2");
INSERT INTO entradas VALUES("218","31","Registro de Propina de 08/2021","Propina","37","3500","2000","Dinheiro","44","9","2021-11-05 08:33:50","2");
INSERT INTO entradas VALUES("219","31","Registro de Propina de 09/2021","Propina","38","3000","3000","BAI","44","9","2021-11-05 08:34:21","2");
INSERT INTO entradas VALUES("220","31","Registro de Propina de 10/2021","Propina","39","6000","0","Dinheiro","44","9","2021-11-05 08:34:46","2");
INSERT INTO entradas VALUES("221","31","Registro de Propina de 11/2021","Propina","40","2000","2000","Dinheiro","44","9","2021-11-05 08:34:58","2");
INSERT INTO entradas VALUES("222","31","Registro de Matrícula","Matrícula","86","1900","0","Dinheiro","79","9","2021-11-05 08:59:15","2");
INSERT INTO entradas VALUES("223","31","Registro de Confirmação","Confirmação","87","1200","0","Dinheiro","9","5","2021-11-05 08:59:39","2");
INSERT INTO entradas VALUES("224","31","Dívida Precedente","Inserção no Sistema","81","0","3500","","81","0","2021-11-05 09:00:54","0");
INSERT INTO entradas VALUES("225","31","Registro de Confirmação","Confirmação","89","1250","0","Dinheiro","82","10","2021-11-05 09:01:48","2");
INSERT INTO entradas VALUES("226","31","Registro de Confirmação","Confirmação","90","1200","0","Dinheiro","38","5","2021-11-05 09:02:23","2");
INSERT INTO entradas VALUES("227","31","Registro de Propina de 06/2021","Propina","41","6000","0","Dinheiro","79","9","2021-11-05 09:12:07","2");
INSERT INTO entradas VALUES("228","31","Registro de Propina de 12/2021","Propina","42","4800","0","Dinheiro","44","4","2022-01-06 22:13:50","2");
INSERT INTO entradas VALUES("229","31","Registro de Propina de 01/2022","Propina","43","2300","0","Dinheiro","30","4","2022-01-06 22:14:04","2");
INSERT INTO entradas VALUES("230","31","Registro de Propina de 02/2022","Propina","44","4800","0","Dinheiro","30","4","2022-03-06 22:45:55","2");
INSERT INTO entradas VALUES("231","31","Registro de Propina de 03/2022","Propina","45","2300","0","Dinheiro","30","4","2022-03-06 22:46:02","2");
INSERT INTO entradas VALUES("232","31","Registro de Propina de 03/2023","Propina","46","4800","0","Dinheiro","30","4","2023-06-06 22:59:07","2");
INSERT INTO entradas VALUES("233","31","Registro de Confirmação","Confirmação","91","0","0","","83","22","2021-11-08 07:19:21","3");
INSERT INTO entradas VALUES("234","31","Registro de Propina de 08/2021","Propina","47","1900","0","Dinheiro","83","22","2021-11-08 07:33:13","3");
INSERT INTO entradas VALUES("235","31","Registro de Propina de 09/2021","Propina","48","1900","0","BIC","83","22","2021-11-08 07:34:25","3");
INSERT INTO entradas VALUES("236","31","Registro de Propina de 10/2021","Propina","49","2000","0","Multicaixa Express","83","22","2021-11-08 07:45:53","3");
INSERT INTO entradas VALUES("237","31","Registro de Propina de 11/2021","Propina","50","2000","0","Dinheiro","83","22","2021-11-08 07:46:06","3");
INSERT INTO entradas VALUES("239","31","Registro de Matrícula","Matrícula","92","1000","0","Multicaixa Express","84","22","2021-11-08 07:51:26","3");
INSERT INTO entradas VALUES("240","31","Controlo","Outras","0","0","0","","0","","2025-11-15 10:12:38","1");



DROP TABLE IF EXISTS faltas;

CREATE TABLE `faltas` (
  `idfalta` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL DEFAULT '2',
  `iddisciplina` int(11) NOT NULL,
  `valordafalta` double NOT NULL DEFAULT '0',
  `preco` double NOT NULL DEFAULT '0',
  `valorpago` double NOT NULL DEFAULT '0',
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idfalta`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

INSERT INTO faltas VALUES("1","42","52","1","2","31","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("2","50","54","3","2","31","6","0","-250","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("3","42","52","3","2","31","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("4","52","55","1","2","31","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("5","19","26","2","2","31","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("6","23","31","2","2","29","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("7","20","27","1","2","29","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("8","21","28","2","2","29","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("9","37","46","3","2","29","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("10","21","28","3","2","29","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("11","37","46","1","2","29","2","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("12","23","31","3","2","29","0","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("13","22","29","1","2","7","35","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("14","38","48","1","2","7","2","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("15","38","48","2","2","7","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("16","25","33","2","2","7","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("17","22","29","2","2","7","2","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("18","25","33","1","2","7","0","500","300","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("19","32","41","1","2","7","6","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("20","40","50","3","2","7","5","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("21","25","33","3","2","7","1","500","500","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("22","22","29","3","2","7","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("23","38","48","3","2","7","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("24","32","41","2","2","7","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("25","29","37","1","2","33","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("26","15","20","1","2","33","5","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("27","15","20","2","2","33","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("28","29","37","2","2","33","2","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("29","15","20","3","2","33","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("30","37","45","1","2","8","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("31","64","63","1","2","8","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("32","37","45","2","2","8","5","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("33","54","57","2","2","8","3","200","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("34","24","32","2","2","8","2","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("35","24","32","1","2","8","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("36","35","44","1","2","8","0","450","150","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("37","54","57","1","2","8","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("38","54","57","3","2","8","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("39","37","45","3","2","8","2","20","20","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("40","64","63","3","2","8","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("41","64","63","2","2","8","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("42","41","61","1","2","23","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("43","41","61","2","2","23","2","250","200","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("44","41","61","3","2","23","2","900","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("45","10","15","1","2","34","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("46","10","15","2","2","34","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("47","10","15","3","2","34","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("48","28","36","1","2","34","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("49","28","36","2","2","34","42","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("50","6","8","2","2","34","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("51","6","8","1","2","34","11","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("52","16","21","1","2","34","23","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("53","16","21","2","2","34","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("54","16","21","3","2","34","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("55","6","8","3","2","34","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("56","28","36","3","2","34","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("57","10","15","1","2","21","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("58","10","15","2","2","21","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("59","10","15","3","2","21","14","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("60","28","36","2","2","21","2","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("61","28","36","1","2","21","4","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("62","6","8","2","2","21","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("63","16","21","2","2","21","11","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("64","6","8","1","2","21","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("65","6","8","3","2","21","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("66","16","21","3","2","21","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("67","16","21","1","2","21","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("68","28","36","3","2","21","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("69","10","15","1","2","9","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("70","10","15","2","2","9","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("71","10","15","3","2","9","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("72","28","36","1","2","9","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("73","28","36","2","2","9","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("74","6","8","2","2","9","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("75","16","21","2","2","9","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("76","28","36","3","2","9","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("77","10","15","1","2","18","11","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("78","10","15","2","2","18","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("79","10","15","3","2","18","32","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("80","23","31","1","2","6","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("81","20","27","2","2","6","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("82","21","28","2","2","6","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("83","23","31","3","2","6","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("84","21","28","3","2","6","3","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("85","22","30","1","2","32","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("86","44","77","2","2","32","11","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("87","58","62","3","2","32","9","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("88","33","42","1","2","30","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("89","44","76","2","2","30","1","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("90","30","38","2","2","30","12","0","0","2021-09-02 06:32:30");
INSERT INTO faltas VALUES("91","66","64","2","2","30","1","0","0","2021-09-02 06:32:30");



DROP TABLE IF EXISTS formasdepagamento;

CREATE TABLE `formasdepagamento` (
  `idformadepagamento` int(11) NOT NULL AUTO_INCREMENT,
  `formadepagamento` varchar(220) DEFAULT NULL,
  PRIMARY KEY (`idformadepagamento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO formasdepagamento VALUES("1","Dinheiro");
INSERT INTO formasdepagamento VALUES("2","BIC");
INSERT INTO formasdepagamento VALUES("4","Multicaixa Express");
INSERT INTO formasdepagamento VALUES("5","BAI");
INSERT INTO formasdepagamento VALUES("7","Cheque");



DROP TABLE IF EXISTS funcionarios;

CREATE TABLE `funcionarios` (
  `idfuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `nomedofuncionario` varchar(100) NOT NULL,
  `datadenascimento` date DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `telefone` varchar(100) DEFAULT NULL,
  `localizacao` text,
  `naturalidade` varchar(220) DEFAULT NULL,
  `proveniencia` varchar(220) DEFAULT NULL,
  `habilitacoesliterarias` varchar(180) DEFAULT NULL,
  `contabancaria` varchar(80) DEFAULT NULL,
  `datadeentrada` date NOT NULL,
  `salario` double DEFAULT NULL,
  `datadeentradanosistema` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salarioporhora` double NOT NULL DEFAULT '0',
  `numerodedias` double NOT NULL DEFAULT '22',
  `numerodehoras` double NOT NULL DEFAULT '8',
  `estatus` varchar(11) NOT NULL DEFAULT 'activo',
  PRIMARY KEY (`idfuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

INSERT INTO funcionarios VALUES("1","Walter Gonga Pedro","0000-00-00",""," 94949944","             Vila Alice","","","         Ensino Superior","              AO 43643746432253 ; BAI: AO 347348263448","2020-07-03","500","2020-07-09 04:20:16","3","22","8","activo");
INSERT INTO funcionarios VALUES("9","Mateus de andrade","0000-00-00","","   92924444","     Cazenga","","","     Ensino medio","       AO 43643746432253 ; BAI: AO 347348263448","2020-07-01","70000","2020-07-08 05:38:19","350","25","8","activo");
INSERT INTO funcionarios VALUES("17","Manuel Da Costa","0000-00-00","","92924448","    Vila de Viana","","","    Ensino medio","     AO 43643746432253 ; BAI: AO 347348263448","2020-07-10","600","2020-07-09 03:53:06","450","22","8","activo");
INSERT INTO funcionarios VALUES("27","Simão Pedro","0000-00-00","","92924444"," Viana","",""," Ensino Superior","  AO 43643746432253 ; BAI: AO 347348263448","2020-07-03","600","2020-07-09 04:18:28","230","22","8","activo");
INSERT INTO funcionarios VALUES("29","Fernandas Paula da Silva","0000-00-00",""," 934657678","  Imbondeiro Sul","","Arena do Saber","  Ensino medio","    AO 43643746432253 ; BAI: AO 347348263448","2020-07-14","800","2020-07-14 06:30:04","5","22","8","activo");
INSERT INTO funcionarios VALUES("30","Zulmira Barbosa","0000-00-00","Pesada","  94949944"," Vila Alice","",""," Ensino medio","    AO 43643746432253 ; BAI: AO 347348263448","2020-02-01","85500","2021-02-01 01:34:33","500","22","12","activo");
INSERT INTO funcionarios VALUES("31","Yolanda Fernandes","0000-00-00","Família","92924444","","","","","","0000-00-00","65000","2021-02-28 14:03:05","290","22","8","activo");
INSERT INTO funcionarios VALUES("32","Daniel Pablo ","0000-00-00","respiratórias","927999178 ","Viana","","","Ensino medio","   AO 43643746432253 ; BAI: AO 347348263448","0000-00-00","120000","2021-03-01 13:38:48","682","22","8","activo");
INSERT INTO funcionarios VALUES("33","Pedro Salvador","0000-00-00","","","","","","","","0000-00-00","120000","2021-03-01 13:39:45","667","22","8","activo");
INSERT INTO funcionarios VALUES("34","Simão Baptista Pedro ","0000-00-00","Gestor","92924444","vila alice","","","Ensino medio","  AO 43643746432253 ; BAI: AO 347348263448","2021-03-01","150000","2021-03-01 19:22:26","1136","22","8","activo");
INSERT INTO funcionarios VALUES("37","Sergio Donaires Adão","0000-00-00","Família"," 92924444"," vila alice","",""," Ensino medio","   AO 43643746432253 ; BAI: AO 347348263448","2021-02-26","120000","2021-03-03 06:07:52","682","22","8","activo");
INSERT INTO funcionarios VALUES("39","Marcelina Francisco Garcia","0000-00-00","Cuzinheira","92924444","Estalagem","Luanda","FAPLA","Ensino Superior","  AO 43643746432253 ; BAI: AO 347348263448","2021-03-21","52000","2020-03-22 10:01:28","241","27","8","inactivo");
INSERT INTO funcionarios VALUES("40","Milguel Vela Caiombo","0000-00-00","Segurança","92924444","Estalagem","Bengo 3","FAA","Ensino medio","  AO 43643746432253 ; BAI: AO 347348263448","2021-03-31","60000","2021-03-30 09:07:26","341","22","8","activo");
INSERT INTO funcionarios VALUES("41","Donaires Pedro Calunga ","0000-00-00","Família","92924444","Vila de Viana","Golf-2","FAA"," Ensino Superior"," AO 43643746432253 ; BAI: AO 347348263448","2021-04-01","100000","2021-04-01 00:13:13","658","19","8","activo");
INSERT INTO funcionarios VALUES("42","Aminadabe Nhanga","0000-00-00","Professor","94123453","","","Arena do Saber","","","2021-08-31","55000","2021-08-06 11:34:38","313","22","8","activo");



DROP TABLE IF EXISTS historico;

CREATE TABLE `historico` (
  `idhistorico` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` int(11) NOT NULL,
  `descricao` varchar(90) DEFAULT NULL,
  `antigo` text,
  `novo` text,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idhistorico`),
  KEY `idfuncionario` (`idfuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=412 DEFAULT CHARSET=utf8;

INSERT INTO historico VALUES("224","1","edição","As horas extra do(a) <a href=funcionario.php?idfuncionario=42>Aminadabe Nhanga</a> do dia 1/8/2021 |Horas: 0 ","Horas: 3","2021-08-06 12:33:46");
INSERT INTO historico VALUES("225","1","edição","As horas extra do(a) <a href=funcionario.php?idfuncionario=42>Aminadabe Nhanga</a> do dia 1/8/2021 |Horas: 3 ","Horas: 4","2021-08-06 12:33:50");
INSERT INTO historico VALUES("226","1","Eliminação","Lembra de pagar o imposto de luz |Data do Lembrete: ","Eliminado","2021-08-08 05:14:43");
INSERT INTO historico VALUES("227","1","Eliminação","Fazer pagamento da Energia |Data do Lembrete: 2021-08-16","Eliminado","2021-08-08 05:15:23");
INSERT INTO historico VALUES("228","1","edição","A nota do aluno <a href=aluno.php?idaluno=23>Biologia</a> da disciplina de Mariana Pedro |Valor da Nota:  ","Valor da Nota:  12","2021-08-09 07:03:13");
INSERT INTO historico VALUES("229","1","edição","A nota do aluno <a href=aluno.php?idaluno=23>Biologia</a> da disciplina de Mariana Pedro |Valor da Nota:  ","Valor da Nota: 12","2021-08-09 07:04:19");
INSERT INTO historico VALUES("230","1","edição","A nota do aluno <a href=aluno.php?idaluno=23>Biologia</a> da disciplina de Mariana Pedro |Valor da Nota:  ","Valor da Nota: 12","2021-08-09 07:04:39");
INSERT INTO historico VALUES("231","1","edição","A nota do aluno <a href=aluno.php?idaluno=23>Biologia</a> da disciplina de Mariana Pedro |Valor da Nota: 0 ","Valor da Nota: 12","2021-08-09 07:05:08");
INSERT INTO historico VALUES("232","1","edição","A nota do aluno <a href=aluno.php?idaluno=37>Matemática</a> da disciplina de Ermelina Da Silva |Valor da Nota: 15 ","Valor da Nota: 1","2021-08-10 08:56:53");
INSERT INTO historico VALUES("233","1","edição","A nota do aluno <a href=aluno.php?idaluno=11>Química</a> da disciplina de Madalena Francisco |Valor da Nota: 3 ","Valor da Nota: 13","2021-08-10 09:54:08");
INSERT INTO historico VALUES("234","1","edição","A nota do aluno <a href=aluno.php?idaluno=11>Química</a> da disciplina de Madalena Francisco |Valor da Nota: 4 ","Valor da Nota: 8","2021-08-10 09:54:11");
INSERT INTO historico VALUES("235","1","edição","A nota do aluno <a href=aluno.php?idaluno=42>Educação Física</a> da disciplina de Esmael Calunga r |Valor da Nota: 3 ","Valor da Nota: 18","2021-08-17 23:15:52");
INSERT INTO historico VALUES("236","1","edição","A nota do aluno <a href=aluno.php?idaluno=52>Educação Física</a> da disciplina de Marcos Valentim |Valor da Nota: 14 ","Valor da Nota: 9","2021-08-17 23:16:01");
INSERT INTO historico VALUES("237","31","Eliminação","Eliminado  do aluno <a href=aluno.php?idaluno=></a> | Na Turma: <a href=turma.php?idturma=></a> | Valor pago:  ","Eliminado","2021-08-20 10:48:52");
INSERT INTO historico VALUES("238","31","Eliminação","Eliminado  do aluno <a href=aluno.php?idaluno=></a> | Na Turma: <a href=turma.php?idturma=></a> | Valor pago:  ","Eliminado","2021-08-20 10:50:47");
INSERT INTO historico VALUES("239","31","Eliminação","Eliminado  do aluno <a href=aluno.php?idaluno=></a> | Na Turma: <a href=turma.php?idturma=></a> | Valor pago:  ","Eliminado","2021-08-20 10:53:30");
INSERT INTO historico VALUES("240","31","Eliminação","Eliminado  do aluno <a href=aluno.php?idaluno=></a> | Na Turma: <a href=turma.php?idturma=></a> | Valor pago:  ","Eliminado","2021-08-20 10:53:55");
INSERT INTO historico VALUES("241","31","Eliminação","Eliminado  do aluno <a href=aluno.php?idaluno=></a> | Na Turma: <a href=turma.php?idturma=></a> | Valor pago:  ","Eliminado","2021-08-20 10:53:58");
INSERT INTO historico VALUES("242","31","Eliminação","Eliminado Matrícula do aluno <a href=aluno.php?idaluno=37>Ermelina Da Silva</a> | Na Turma: <a href=turma.php?idturma=13>10CFB</a> | Valor pago: 0 ","Eliminado","2021-08-20 10:55:01");
INSERT INTO historico VALUES("243","31","Eliminação","Eliminado  do aluno <a href=aluno.php?idaluno=></a> | Na Turma: <a href=turma.php?idturma=></a> | Valor pago:  ","Eliminado","2021-08-20 10:55:05");
INSERT INTO historico VALUES("244","31","Eliminação","Eliminado Matrícula do aluno <a href=aluno.php?idaluno=37>Ermelina Da Silva</a> | Na Turma: <a href=turma.php?idturma=8>11ENF</a> | Valor pago: 0 ","Eliminado","2021-08-20 10:55:38");
INSERT INTO historico VALUES("245","31","Eliminação","Eliminado Confirmação do aluno <a href=aluno.php?idaluno=57>Daniel</a> | Na Turma: <a href=turma.php?idturma=8>11ENF</a> | Valor pago: 3500 ","Eliminado","2021-08-20 10:56:40");
INSERT INTO historico VALUES("246","31","Eliminação","Eliminado  do aluno <a href=aluno.php?idaluno=></a> | Na Turma: <a href=turma.php?idturma=></a> | Valor pago:  ","Eliminado","2021-08-20 10:56:41");
INSERT INTO historico VALUES("247","31","Eliminação","Eliminado Matrícula do aluno <a href=aluno.php?idaluno=8>Eliandes Manuel</a> | Na Turma: <a href=turma.php?idturma=6>4A</a> | Valor pago: 2500 ","Eliminado","2021-08-20 10:57:43");
INSERT INTO historico VALUES("248","31","Eliminação","Eliminado Matrícula do aluno <a href=aluno.php?idaluno=17>Martins Sampaio</a> | Na Turma: <a href=turma.php?idturma=5>10INF</a> | Valor pago: 1200 ","Eliminado","2021-08-20 11:02:24");
INSERT INTO historico VALUES("249","31","Eliminação"," | Valor: 0,00 KZ | Dívida 0,00 KZ","ELIMINADO","2021-08-23 03:39:52");
INSERT INTO historico VALUES("250","31","Eliminação"," | Valor: 0,00 KZ | Dívida 0,00 KZ","ELIMINADO","2021-08-23 03:45:46");
INSERT INTO historico VALUES("251","31","Eliminação"," | Valor: 0,00 KZ | Dívida 0,00 KZ","ELIMINADO","2021-08-23 03:49:03");
INSERT INTO historico VALUES("252","31","Eliminação"," | Valor: 0,00 KZ | Dívida 0,00 KZ","ELIMINADO","2021-08-23 03:49:24");
INSERT INTO historico VALUES("253","31","Eliminação","Devolução de Valores | Valor: 5.600,00 KZ | Por Consolidar 7400 KZ","Eliminado","2021-08-23 03:50:07");
INSERT INTO historico VALUES("254","31","Edição","(Oferta preciosa de Barros) | Pago: 1900 | Dívida: 3000 | F. Pag: Cheque | 2021-08-23 04:32:18","(Oferta preciosa de Barros) | Pago: 1900 | Dívida: 3000 | F. Pag: Cheque | 2021-08-22 04:32:18","2021-08-23 07:25:10");
INSERT INTO historico VALUES("255","31","Edição","(8 meses de propina) | Pago: 0 | Dívida: 20000 | F. Pag:  | 2021-08-18 13:05:59","(8 meses de propina) | Pago: 2400 | Dívida: 3500 | F. Pag: BAI | 2021-08-18 13:05:59","2021-08-23 07:27:30");
INSERT INTO historico VALUES("256","31","Edição","(Dívida Precedente) | Pago: 0 | Dívida: 25000 | F. Pag:  | 2021-08-23 08:15:35","(Dívida Precedente) | Pago: 0 | Dívida: 2500 | F. Pag: Dinheiro | 2021-08-23 08:15:35","2021-08-23 08:16:08");
INSERT INTO historico VALUES("257","31","Edição","(Pagamento da divida) | Pago: 1000 | Dívida: 0 | F. Pag: BAI | 2021-08-23 08:17:00","(Pagamento da divida) | Pago: 1200 | Dívida: 0 | F. Pag: BAI | 2021-08-23 08:17:00","2021-08-23 08:45:14");
INSERT INTO historico VALUES("258","31","Eliminação","Dívida Precedente | Valor: 0,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 10:18:45");
INSERT INTO historico VALUES("259","31","Eliminação","Pagamento da divida | Valor: 1.200,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 10:20:11");
INSERT INTO historico VALUES("260","31","Edição","(um mes de propina) | Pago: 12000 | Dívida: -22800 | F. Pag: Dinheiro | 2021-08-23 10:22:58","(um mes de propina) | Pago: 1200 | Dívida: 2800 | F. Pag: Dinheiro | 2021-08-23 10:22:58","2021-08-23 10:23:36");
INSERT INTO historico VALUES("261","31","Eliminação","Dívida Precedente | Valor: 0,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 10:25:26");
INSERT INTO historico VALUES("262","31","Eliminação","um mes de propina | Valor: 12.000,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 10:31:46");
INSERT INTO historico VALUES("263","31","Eliminação","tudo | Valor: 1.443,00 KZ | Por Consolidar -2043 KZ","Eliminado","2021-08-23 10:32:51");
INSERT INTO historico VALUES("264","31","Eliminação","um mes de propina | Valor: 1.200,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 10:32:59");
INSERT INTO historico VALUES("265","31","Eliminação","teste | Valor: 3.400,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 10:34:10");
INSERT INTO historico VALUES("266","31","Eliminação","eske | Valor: 2.300,00 KZ | Por Consolidar -2334 KZ","Eliminado","2021-08-23 10:34:20");
INSERT INTO historico VALUES("267","31","Eliminação","des | Valor: 34,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 10:34:26");
INSERT INTO historico VALUES("268","31","Eliminação","Dívida Precedente | Valor: 0,00 KZ | Por Consolidar 4500 KZ","Eliminado","2021-08-23 10:34:48");
INSERT INTO historico VALUES("269","31","Eliminação","Pagamento de multa da matricula | Valor: 500,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 10:35:19");
INSERT INTO historico VALUES("270","31","Eliminação","prime | Valor: 3.400,00 KZ | Por Consolidar -3100 KZ","Eliminado","2021-08-23 10:35:48");
INSERT INTO historico VALUES("271","31","Eliminação","Todos os dados de() | Valor: 1.200,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 10:48:15");
INSERT INTO historico VALUES("272","31","Eliminação","Todos os dados de(Dívida Precedente) | Valor: 300,00 KZ | Por Consolidar 1700 KZ","Eliminado","2021-08-23 10:50:33");
INSERT INTO historico VALUES("273","31","Edição","(Dívida Precedente) | Pago: 0 | Dívida: 3000 | F. Pag:  | 2021-08-23 10:49:08","(Dívida Precedente) | Pago: 0 | Dívida: 3000 | F. Pag: Dinheiro | 2021-08-23 14:49:08","2021-08-23 10:51:06");
INSERT INTO historico VALUES("274","31","Edição","(pagamento) | Pago: 4500 | Dívida: 0 | F. Pag: Multicaixa Express | 2021-08-23 11:02:24","(pagamento) | Pago: 4500 | Dívida: 12000 | F. Pag: Multicaixa Express | 2021-08-23 11:02:24","2021-08-23 11:02:42");
INSERT INTO historico VALUES("275","31","Edição","(Matricula 2) | Pago: 4500 | Dívida: 0 | F. Pag: Dinheiro | 2021-08-23 11:02:01","(Matricula 2) | Pago: 4500 | Dívida: 2500 | F. Pag: Dinheiro | 2021-08-23 11:02:01","2021-08-23 11:03:16");
INSERT INTO historico VALUES("276","31","Edição","(Ener) | Pago: 1200 | Dívida: 0 | F. Pag: Dinheiro | 2021-08-23 11:05:36","(Ener) | Pago: 1200 | Dívida: 2500 | F. Pag: Dinheiro | 2021-08-23 11:05:36","2021-08-23 11:05:45");
INSERT INTO historico VALUES("277","31","Edição","(des) | Pago: 500 | Dívida: 0 | F. Pag: Dinheiro | 2021-08-23 11:05:58","(des) | Pago: 500 | Dívida: 3500 | F. Pag: Dinheiro | 2021-08-23 11:05:58","2021-08-23 11:06:25");
INSERT INTO historico VALUES("278","31","Edição","(desc) | Pago: 1400 | Dívida: 0 | F. Pag: BAI | 2021-08-23 11:09:06","(desc) | Pago: 1400 | Dívida: 12000 | F. Pag: BAI | 2021-08-23 11:09:06","2021-08-23 11:09:31");
INSERT INTO historico VALUES("279","31","Edição","(desc) | Pago: 1000 | Dívida: 0 | F. Pag: BIC | 2021-08-23 11:11:34","(desc) | Pago: 1000 | Dívida: 1200 | F. Pag: BIC | 2021-08-23 11:11:34","2021-08-23 11:14:07");
INSERT INTO historico VALUES("280","31","Edição","(desc) | Pago: 1000 | Dívida: 1200 | F. Pag: BIC | 2021-08-23 11:11:34","(desc) | Pago: 1000 | Dívida: 1200 | F. Pag: BIC | 2021-08-23 11:11:34","2021-08-23 11:15:16");
INSERT INTO historico VALUES("281","31","Edição","(desc) | Pago: 1000 | Dívida: 1200 | F. Pag: BIC | 2021-08-23 11:11:34","(desc) | Pago: 1000 | Dívida: 1200 | F. Pag: BIC | 2021-08-23 11:11:34","2021-08-23 11:15:29");
INSERT INTO historico VALUES("282","31","Edição","(pagamento) | Pago: 4500 | Dívida: 0 | F. Pag: Multicaixa Express | 2021-08-23 11:02:24","(pagamento) | Pago: 4500 | Dívida: 1200 | F. Pag: Multicaixa Express | 2021-08-23 11:02:24","2021-08-23 11:29:50");
INSERT INTO historico VALUES("283","31","Edição","(primeiros socorros) | Pago: 500 | Dívida: 0 | F. Pag: Dinheiro | 2021-08-23 11:30:00","(primeiros socorros) | Pago: 500 | Dívida: 4500 | F. Pag: Dinheiro | 2021-08-23 11:30:00","2021-08-23 11:30:20");
INSERT INTO historico VALUES("284","31","Eliminação","des | Valor: 1.200,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 11:30:57");
INSERT INTO historico VALUES("285","31","Eliminação","primeiros socorros | Valor: 500,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 11:31:03");
INSERT INTO historico VALUES("286","31","Eliminação","matriculadno | Valor: 1.500,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-23 11:31:13");
INSERT INTO historico VALUES("287","31","Edição","(Registro de Matrícula) | Pago: 6000 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","(Registro de Matrícula) | Pago: 5000 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","2021-08-23 11:46:23");
INSERT INTO historico VALUES("288","31","Edição","(Registro de Matrícula) | Pago: 5000 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","(Registro de Matrícula) | Pago: 1200 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","2021-08-23 11:48:01");
INSERT INTO historico VALUES("289","31","Edição","(Registro de Matrícula) | Pago: 1200 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","(Registro de Matrícula) | Pago: 1600 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","2021-08-23 11:50:07");
INSERT INTO historico VALUES("290","31","Edição","(Registro de Matrícula) | Pago: 1600 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","(Registro de Matrícula) | Pago: 1600 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","2021-08-23 11:51:11");
INSERT INTO historico VALUES("291","31","Edição","(Registro de Matrícula) | Pago: 1600 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","(Registro de Matrícula) | Pago: 3600 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","2021-08-23 11:51:24");
INSERT INTO historico VALUES("292","31","Edição","(Registro de Matrícula) | Pago: 3600 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","(Registro de Matrícula) | Pago: 3900 | Dívida: 800 | F. Pag: Dinheiro | 2021-08-23 11:46:09","2021-08-23 11:58:24");
INSERT INTO historico VALUES("293","31","Edição","(Registro de Matrícula) | Pago: 0 | Dívida: 0 | F. Pag: Multicaixa Express | 2021-08-04 06:46:41","(Registro de Matrícula) | Pago: 200 | Dívida: 3500 | F. Pag: Multicaixa Express | 2021-08-04 06:46:41","2021-08-23 17:56:45");
INSERT INTO historico VALUES("294","31","Edição","(pagando) | Pago: 0 | F. Pag: Dinheiro | 2021-08-23 17:52:19","(Registro de Matrícula) | Pago: 1200  | F. Pag: Multicaixa Express | 2021-08-04 06:46:41","2021-08-23 18:15:42");
INSERT INTO historico VALUES("295","31","Edição","(Registro de Matrícula) | Pago: 1200 | F. Pag: Multicaixa Express | 2021-08-04 06:46:41","(Registro de Matrícula) | Pago: 1200  | F. Pag: Multicaixa Express | 2021-08-04 06:46:41","2021-08-23 18:16:32");
INSERT INTO historico VALUES("296","31","Edição","(Registro de Matrícula) | Pago: 1200 | F. Pag: Multicaixa Express | 2021-08-04 06:46:41","(Registro de Matrícula) | Pago: 2200  | F. Pag: Multicaixa Express | 2021-08-04 06:46:41","2021-08-23 18:16:55");
INSERT INTO historico VALUES("297","31","Edição","(Registro de Matrícula) | Pago: 200 | F. Pag: Multicaixa Express | 2021-08-04 06:46:41","(Registro de Matrícula) | Pago: 600  | F. Pag: Multicaixa Express | 2021-08-04 06:46:41","2021-08-23 18:19:15");
INSERT INTO historico VALUES("298","31","Edição","(Registro de Matrícula) | Pago: 1400 | F. Pag: Dinheiro | 2021-08-04 06:49:19","(Registro de Matrícula) | Pago: 1450  | F. Pag: BAI | 2021-08-04 06:49:19","2021-08-23 18:30:39");
INSERT INTO historico VALUES("299","31","Eliminação","Pagando uma parte | Valor:  KZ ","Eliminado","2021-08-24 08:07:54");
INSERT INTO historico VALUES("300","31","Eliminação","Pagamento da divida | Valor: 500,00 KZ | Por Consolidar 1250 KZ","Eliminado","2021-08-24 08:09:01");
INSERT INTO historico VALUES("301","31","Eliminação","Todos os dados de(Registro de Matrícula) | Valor: 3.700,00 KZ | Por Consolidar 100 KZ","Eliminado","2021-08-24 08:26:11");
INSERT INTO historico VALUES("302","31","Eliminação","Todos os dados de(Registro de Matrícula) | Valor: 0,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-24 08:26:45");
INSERT INTO historico VALUES("303","31","Eliminação","Todos os dados de(Registro de Matrícula) | Valor: 0,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-24 08:32:36");
INSERT INTO historico VALUES("304","31","Eliminação","Todos os dados de(Registro de Matrícula) | Valor: 0,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-08-24 08:32:53");
INSERT INTO historico VALUES("305","31","Eliminação","Todos os dados de(Registro de Matrícula) | Valor: 200,00 KZ | Por Consolidar 3600 KZ","Eliminado","2021-08-24 08:35:41");
INSERT INTO historico VALUES("306","31","Edição","(Registro de Rematrícula) | Pago: 1900 | F. Pag: Dinheiro | 2021-08-20 09:15:38","(Registro de Rematrícula) | Pago: 1500  | F. Pag: Dinheiro | 2021-08-21 09:15:38","2021-08-24 08:43:17");
INSERT INTO historico VALUES("307","31","Edição","(Pagamento da divida) | Pago: 300 | F. Pag: Dinheiro | 2021-08-24 08:50:15","(Registro de Rematrícula) | Pago: 500  | F. Pag: Dinheiro | 2021-08-21 09:15:38 <a href=entradamatricula.php?identrada=109>Clique para ver</a>","2021-08-24 08:50:26");
INSERT INTO historico VALUES("308","31","Eliminação","Registro de Rematrícula | Valor: 500,00 KZ <a href=entradamatricula.php?identrada=109>Clique para ver</a>","Eliminado","2021-08-24 08:51:07");
INSERT INTO historico VALUES("309","31","Eliminação","Pagamento da divida | Valor: 300,00 KZ <a href=entradamatricula.php?identrada=62>Clique para ver</a>","Eliminado","2021-08-24 08:52:57");
INSERT INTO historico VALUES("310","31","Eliminação","Todos os dados de(Registro de Rematrícula) | Valor: 2.100,00 KZ | Por Consolidar 800 KZ | <a href=entradamatricula.php?identrada=62>Clique para ver</a>","Eliminado","2021-08-24 08:53:48");
INSERT INTO historico VALUES("311","31","Eliminação","Todos os dados de(Registro de Rematrícula) | Valor: 1.300,00 KZ | Por Consolidar 1600 KZ | <a href=entradamatricula.php?identrada=62>Clique para ver</a>","Eliminado","2021-08-24 08:56:39");
INSERT INTO historico VALUES("312","31","Eliminação","Pagamento da divida | Valor: 130,00 KZ <a href=entradamatricula.php?identrada=62>Clique para ver</a>","Eliminado","2021-08-24 08:59:33");
INSERT INTO historico VALUES("313","31","Edição","(Registro de Rematrícula) | Pago: 0 | F. Pag: Dinheiro | 2021-08-21 09:15:38","(Registro de Rematrícula) | Pago: 2000  | F. Pag: Dinheiro | 2021-08-21 09:15:38 <a href=entradamatricula.php?identrada=62>Clique para ver</a>","2021-08-24 08:59:57");
INSERT INTO historico VALUES("314","31","Eliminação","Todos os dados de(Registro de Rematrícula) | Valor: 3.650,00 KZ | Por Consolidar 850 KZ | <a href=entradamatricula.php?identrada=62>Clique para ver</a>","Eliminado","2021-08-24 09:00:08");
INSERT INTO historico VALUES("315","31","Edição","(Registro de Rematrícula) | Pago: 0 | F. Pag: Dinheiro | 2021-08-21 09:15:38","(Registro de Rematrícula) | Pago: 1000  | F. Pag: Dinheiro | 2021-08-21 09:15:38 <a href=entradamatricula.php?identrada=62>Clique para ver</a>","2021-08-24 09:00:29");
INSERT INTO historico VALUES("316","31","Edição","(Dívida Precedente) | Pago: 0 | Dívida: 3000 | F. Pag: Dinheiro | 2021-08-23 14:49:08","(Dívida Precedente) | Pago: 1200 | Dívida: 3000 | F. Pag: Dinheiro | 2021-08-25 14:49:08","2021-08-24 09:04:02");
INSERT INTO historico VALUES("317","31","Edição","(Dívida Precedente) | Pago: 0 | Dívida: 0 | F. Pag:  | 2021-08-24 09:05:31","(Dívida Precedente) | Pago: 2400 | Dívida: 0 | F. Pag: Dinheiro | 2021-08-24 09:05:31","2021-08-24 09:06:19");
INSERT INTO historico VALUES("318","31","Edição","(oferta) | Pago: 3400 | Dívida: 0 | F. Pag: Dinheiro | 2021-08-06 10:59:21","(oferta) | Pago: 3400 | Dívida: 450 | F. Pag: Dinheiro | 2021-08-06 10:59:21","2021-08-24 09:07:15");
INSERT INTO historico VALUES("319","31","Eliminação","Pagamento da divida | Valor: 0,00 KZ <a href=entradamatricula.php?identrada=45>Clique para ver</a>","Eliminado","2021-08-24 09:08:03");
INSERT INTO historico VALUES("320","31","Edição","(Pagamento da divida) | Pago: 1900 | F. Pag: Dinheiro | 2021-08-24 09:09:07","(Registro de Confirmação) | Pago: 1900  | F. Pag: BAI | 2021-08-04 06:40:39 <a href=entradamatricula.php?identrada=125>Clique para ver</a>","2021-08-24 09:09:15");
INSERT INTO historico VALUES("321","31","Edição","(Registro de Propina de 08/2021) | Pago: 4500 | F. Pag: Dinheiro | 2021-08-17 11:56:00","(Registro de Propina de 08/2021) | Pago: 4000  | F. Pag: Multicaixa Express | 2021-08-17 11:56:00 <a href=entradamatricula.php?identrada=56>Clique para ver</a>","2021-08-25 19:08:40");
INSERT INTO historico VALUES("322","31","Eliminação","voltando a pagar | Valor: 300,00 KZ <a href=entradapropina.php?identrada=56>Clique para ver</a>","Eliminado","2021-08-25 19:42:55");
INSERT INTO historico VALUES("323","31","Eliminação","Pagamento da divida | Valor: 120,00 KZ <a href=entradapropina.php?identrada=56>Clique para ver</a>","Eliminado","2021-08-25 19:43:12");
INSERT INTO historico VALUES("324","31","Eliminação","Todos os dados de(Registro de Propina de 08/2021) | Valor: 5.400,00 KZ | Por Consolidar 900 KZ | <a href=entradapropina.php?identrada=56>Clique para ver</a>","Eliminado","2021-08-25 20:07:06");
INSERT INTO historico VALUES("325","31","Eliminação","Todos os dados de(Registro de Propina) | Valor: 1.200,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=11>Clique para ver</a>","Eliminado","2021-08-25 20:09:01");
INSERT INTO historico VALUES("326","31","Eliminação","Eliminado o pagamento de propinas do aluno  <a href=aluno.php?idaluno=9>Gomedilna da Costa </a> do mês de 04/2020","Eliminado","2021-08-25 20:09:02");
INSERT INTO historico VALUES("327","31","Eliminação","Todos os dados de(Registro de Propina de 08/2021) | Valor: 1.300,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=129>Clique para ver</a>","Eliminado","2021-08-25 20:11:42");
INSERT INTO historico VALUES("328","31","Eliminação","Eliminado o pagamento de propinas do aluno  <a href=aluno.php?idaluno=64>Alberto Vunge </a> do mês de 08/2021","Eliminado","2021-08-25 20:11:42");
INSERT INTO historico VALUES("329","31","Eliminação","Todos os dados de(Registro de Propina de 08/2021) | Valor: 2.300,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=130>Clique para ver</a>","Eliminado","2021-08-25 20:13:25");
INSERT INTO historico VALUES("330","31","Eliminação","Eliminado o pagamento de propinas do aluno  <a href=aluno.php?idaluno=33>Armando Da Costa Zeferino Dumba </a> do mês de 08/2021","Eliminado","2021-08-25 20:13:26");
INSERT INTO historico VALUES("331","31","Eliminação","Todos os dados de(Registro de Propina de 08/2021) | Valor: 1.300,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=132>Clique para ver</a>","Eliminado","2021-08-25 20:18:19");
INSERT INTO historico VALUES("332","31","Eliminação","Eliminado o pagamento de propinas do aluno  <a href=aluno.php?idaluno=54>Ermenegildo Canhenga </a> do mês de 08/2021","Eliminado","2021-08-25 20:18:19");
INSERT INTO historico VALUES("333","31","Eliminação","Todos os dados de(Registro de Propina de 08/2021) | Valor: 2.300,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=134>Clique para ver</a>","Eliminado","2021-08-25 21:45:34");
INSERT INTO historico VALUES("334","31","Eliminação","Eliminado o pagamento de propinas do aluno  <a href=aluno.php?idaluno=13>Margarida Francisco </a> do mês de 08/2021","Eliminado","2021-08-25 21:45:34");
INSERT INTO historico VALUES("335","31","Eliminação","Todos os dados de(Registro de Propina de 07/2021) | Valor: 2.300,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=133>Clique para ver</a>","Eliminado","2021-08-25 21:46:30");
INSERT INTO historico VALUES("336","31","Eliminação","Eliminado o pagamento de propinas do aluno  <a href=aluno.php?idaluno=13>Margarida Francisco </a> do mês de 07/2021","Eliminado","2021-08-25 21:46:30");
INSERT INTO historico VALUES("337","31","Eliminação","Todos os dados de(Registro de Propina de 07/2021) | Valor: 1.300,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=136>Clique para ver</a>","Eliminado","2021-08-25 21:51:07");
INSERT INTO historico VALUES("338","31","Eliminação","Eliminado o pagamento de propinas do aluno  <a href=aluno.php?idaluno=64>Alberto Vunge </a> do mês de 07/2021","Eliminado","2021-08-25 21:51:08");
INSERT INTO historico VALUES("339","31","Eliminação","Todos os dados de(Registro de Propina de 09/2021) | Valor: 4.500,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=137>Clique para ver</a>","Eliminado","2021-08-25 21:55:31");
INSERT INTO historico VALUES("340","31","Eliminação","Eliminado o pagamento de propinas do aluno  <a href=aluno.php?idaluno=22>Adão Zeferino </a> do mês de 09/2021","Eliminado","2021-08-25 21:55:31");
INSERT INTO historico VALUES("341","31","Eliminação","Todos 3 os dados de(Registro de Propina de 06/2021) | Valor: 1.300,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=135>Clique para ver</a>","Eliminado","2021-08-25 21:59:26");
INSERT INTO historico VALUES("342","31","Eliminação","Eliminado o pagamento de propinas do aluno  <a href=aluno.php?idaluno=64>Alberto Vunge </a> do mês de 06/2021","Eliminado","2021-08-25 21:59:26");
INSERT INTO historico VALUES("343","31","Eliminação","Todos  os dados de(Registro de Propina de 10/2021) | Valor: 2.000,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=139>Clique para ver</a>","Eliminado","2021-08-25 22:01:55");
INSERT INTO historico VALUES("344","31","Eliminação","Eliminado o pagamento de propina do aluno  <a href=aluno.php?idaluno=22>Adão Zeferino </a> do mês de 010/2021","Eliminado","2021-08-25 22:01:55");
INSERT INTO historico VALUES("345","31","Eliminação","Todos  os dados de(Registro de Propina de 09/2021) | Valor: 2.000,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=50>Clique para ver</a>","Eliminado","2021-08-25 22:03:43");
INSERT INTO historico VALUES("346","31","Eliminação","Eliminado o pagamento de propina do aluno  <a href=aluno.php?idaluno=22>Adão Zeferino </a> do mês de 09/2021","Eliminado","2021-08-25 22:03:43");
INSERT INTO historico VALUES("347","31","Edição","Mudado a quantidade do produto Uniforme de Educação física, na : <a href=detalhesdacompra.php?idtipo=78>venda 78 </a> | Quantidade: 1","quantidade nova 2","2021-08-26 22:39:11");
INSERT INTO historico VALUES("348","31","Edição","Mudado a quantidade do produto Uniforme Escolar, na : <a href=detalhesdacompra.php?idtipo=78>venda 78 </a> | Quantidade: 3","quantidade nova 5","2021-08-26 22:39:29");
INSERT INTO historico VALUES("349","31","Edição","Mudado o Desconto do produto Batas para Laboratório, na : <a href=detalhesdacompra.php?idcompra=78>venda 78 </a> | Desconto: 0 KZ ","Desconto novo 500 KZ","2021-08-26 22:39:44");
INSERT INTO historico VALUES("350","31","Edição","Mudado o Desconto do produto Uniforme de Educação física, na : <a href=detalhesdacompra.php?idcompra=78>venda 78 </a> | Desconto: 0 KZ ","Desconto novo 1900 KZ","2021-08-26 22:39:51");
INSERT INTO historico VALUES("351","31","Edição","Mudado o Desconto do produto Uniforme Escolar, na : <a href=detalhesdacompra.php?idcompra=78>venda 78 </a> | Desconto: 0 KZ ","Desconto novo 4500 KZ","2021-08-26 22:39:54");
INSERT INTO historico VALUES("352","31","Eliminação"," | Valor: 0,00 KZ | Dívida 0,00 KZ","Actualização(Venda para o aluno()| 2  Uniforme de Educação física, 2 Batas para Laboratório) | Valor: 4900 KZ | Dívida 6700 KZ","2021-08-26 23:03:34");
INSERT INTO historico VALUES("353","31","Eliminação","Venda para o aluno()| 2  Uniforme de Educação física, 2 Batas para Laboratório | Valor: 9.900,00 KZ | Dívida 0,00 KZ","Actualização(Venda para o aluno(Ana Kimbenze)| 2  Uniforme de Educação física) | Valor: 2300 KZ | Dívida 5800 KZ","2021-08-26 23:11:34");
INSERT INTO historico VALUES("354","31","Eliminação","Venda para o aluno(Ana Kimbenze)| 2  Uniforme de Educação física | Valor: 7.300,00 KZ | Dívida 5.800,00 KZ","Actualização(Venda para o aluno(Ana Kimbenze)| ) | Valor: 0 KZ | Dívida 0 KZ","2021-08-26 23:12:18");
INSERT INTO historico VALUES("355","31","Eliminação","Venda de 9  Lacosta de Treino | Valor: 30.600,00 KZ | Dívida 0,00 KZ","ELIMINADO","2021-08-26 23:19:10");
INSERT INTO historico VALUES("356","31","Eliminação","Venda de 3  Uniforme Escolar | Valor: 14.000,00 KZ | Dívida 500,00 KZ","ELIMINADO","2021-08-26 23:19:34");
INSERT INTO historico VALUES("357","30","Edição","Mudado o Desconto do produto Batas para Laboratório, na : <a href=detalhesdacompra.php?idcompra=72>venda 72 </a> | Desconto: 0 KZ ","Desconto novo 100 KZ","2021-08-30 03:38:27");
INSERT INTO historico VALUES("358","30","Eliminação","Venda para o aluno()| 4  Batas para Laboratório | Valor: 2.800,00 KZ | Dívida 0,00 KZ","ELIMINADO","2021-08-30 03:39:03");
INSERT INTO historico VALUES("359","30","Eliminação","Venda para o aluno(Ana Kimbenze)|  | Valor: 8.000,00 KZ | Dívida 0,00 KZ","ELIMINADO","2021-08-30 03:39:39");
INSERT INTO historico VALUES("360","1","edição","compra do Almoço | 4.500,00 KZ","compra do Almoço | 4.600,00 KZ","2021-09-03 10:36:40");
INSERT INTO historico VALUES("361","1","edição","compra do Almoço |Por Consolidadar 500,00 KZ","compra do Almoço |Por Consolidadar 400,00 KZ","2021-09-03 10:37:12");
INSERT INTO historico VALUES("362","1","Eliminação","compra do Almoço | Valor: 4.600,00 KZ | Por Consolidar 400 KZ","Eliminado","2021-09-03 10:42:47");
INSERT INTO historico VALUES("363","1","edição","Pagamento do Aluguer | 5.000,00 KZ","Pagamento do Alugueres | 5.000,00 KZ","2021-09-03 10:48:38");
INSERT INTO historico VALUES("364","1","Eliminação","pagamento da energia | Valor: 4.000,00 KZ | Por Consolidar 600 KZ","Eliminado","2021-09-03 10:55:44");
INSERT INTO historico VALUES("365","31","edição","A nota do aluno <a href=aluno.php?idaluno=15>Margarida Fernandes</a> da disciplina de Educação Física |Valor da Nota: 5 ","Valor da Nota: 15","2021-09-09 14:57:39");
INSERT INTO historico VALUES("366","31","edição","A nota do aluno <a href=aluno.php?idaluno=29>Suzana Pedro</a> da disciplina de Educação Física |Valor da Nota: 6 ","Valor da Nota: 16","2021-09-09 14:57:41");
INSERT INTO historico VALUES("367","31","Edição","(Pagando a divida) | Pago: 30 | F. Pag: Multicaixa Express | 2021-09-09 16:51:38","(Justificação de 4 Faltas do IIIº trimestre) | Pago: 45  | F. Pag: Multicaixa Express | 2021-09-09 16:55:30 <a href=detalhesdafalta.php?identrada=170>Clique para ver</a>","2021-09-09 16:55:22");
INSERT INTO historico VALUES("368","31","Edição","() | Preço: 600   ","Falta restando =5 | preço: 600 |  <a href=detalhesdafalta.php?identrada=169>Clique para ver</a>","2021-09-09 17:04:21");
INSERT INTO historico VALUES("369","31","Edição","(Justificação de 4 Faltas do IIIº trimestre) | Preço: 700   ","Falta restando =4 | preço: 700 |  <a href=detalhesdafalta.php?identrada=169>Clique para ver</a>","2021-09-09 17:05:41");
INSERT INTO historico VALUES("370","31","Edição","Falta restando = | Preço: 900   ","Falta restando =2 | preço: 900 |  <a href=detalhesdafalta.php?identrada=169>Clique para ver</a>","2021-09-09 17:08:40");
INSERT INTO historico VALUES("371","31","Edição","Falta restando =2 | Preço: 900   ","Falta restando =2 | preço: 900 |  <a href=detalhesdafalta.php?identrada=169>Clique para ver</a>","2021-09-09 17:09:05");
INSERT INTO historico VALUES("372","31","Eliminação","Pagamento da divida | Valor: 250,00 KZ <a href=entradamatricula.php?identrada=169>Clique para ver</a>","Eliminado","2021-09-09 17:22:49");
INSERT INTO historico VALUES("373","31","Eliminação","Justificação de 4 Faltas do IIIº trimestre | Valor: 45,00 KZ <a href=entradamatricula.php?identrada=169>Clique para ver</a>","Eliminado","2021-09-09 17:23:25");
INSERT INTO historico VALUES("374","31","Eliminação","Pagamento da divida | Valor: 250,00 KZ <a href=detalhesdafalta.php?identrada=169>Clique para ver</a>","Eliminado","2021-09-09 17:24:46");
INSERT INTO historico VALUES("375","31","Eliminação","Todos os dados de(Justificação de 4 Faltas do IIIº trimestre) | Valor: 400,00 KZ | Por Consolidar 500 KZ | <a href=entradamatricula.php?identrada=169>Clique para ver</a>","Eliminado","2021-09-09 17:32:10");
INSERT INTO historico VALUES("376","31","Eliminação","Todos os dados de(Justificação de 4 Faltas do IIIº trimestre) | Valor: 0,00 KZ | Por Consolidar 900 KZ | <a href=detalhesdafalta.php?identrada=169>Clique para ver</a>","Eliminado","2021-09-09 17:32:44");
INSERT INTO historico VALUES("377","31","Edição","(Pagamento da divida) | Pago: 300 | F. Pag: Dinheiro | 2021-09-09 17:33:01","(Justificação de 4 Faltas do IIIº trimestre) | Pago: 350  | F. Pag: BIC | 2021-09-09 16:49:30 <a href=detalhesdafalta.php?identrada=173>Clique para ver</a>","2021-09-09 17:33:13");
INSERT INTO historico VALUES("378","31","Eliminação","Todos os dados de(Justificação de 4 Faltas do IIIº trimestre) | Valor: 350,00 KZ | Por Consolidar 550 KZ | <a href=detalhesdafalta.php?identrada=169>Clique para ver</a>","Eliminado","2021-09-09 17:39:37");
INSERT INTO historico VALUES("379","31","Edição","Tratar Documento (Declaração sem notas) | Preço 2500 , Desconto 350 , valor pago 1100","Preço 2500 , Desconto 500 , valor pago 1100 |  <a href=detalhestratardocumentos.php?identrada=170>Clique para ver</a>","2021-09-10 21:36:33");
INSERT INTO historico VALUES("380","31","Edição","Tratar Documento (Declaração sem notas) | Preço 2500 , Desconto 500 , valor pago 1100","Preço 2700 , Desconto 500 , valor pago 1100 |  <a href=detalhestratardocumentos.php?identrada=170>Clique para ver</a>","2021-09-10 21:37:30");
INSERT INTO historico VALUES("381","31","Edição","Tratar Documento (Declaração sem notas) | Preço 2700 , Desconto 500 , valor pago 1100","Preço 2700 , Desconto 500 , valor pago 1100 |  <a href=detalhestratardocumentos.php?identrada=170>Clique para ver</a>","2021-09-10 21:39:10");
INSERT INTO historico VALUES("382","31","Edição","(Declaração sem notas) | Pago: 1100 | F. Pag: Multicaixa Express | 2021-09-10 19:15:20","(Declaração sem notas) | Pago: 1300  | F. Pag: Multicaixa Express | 2021-09-10 19:15:20 <a href=detalhesdafalta.php?identrada=170>Clique para ver</a>","2021-09-10 22:21:21");
INSERT INTO historico VALUES("383","31","Eliminação","Pagamento da divida | Valor: 250,00 KZ <a href=detalhesdafalta.php?identrada=170>Clique para ver</a>","Eliminado","2021-09-10 22:39:06");
INSERT INTO historico VALUES("384","31","Edição","Tratar Documento (Declaração sem notas) | Preço 2700 , Desconto 500 , valor pago 2000","Preço 2700 , Desconto 500 , valor pago 1750 |  <a href=detalhestratardocumentos.php?identrada=170>Clique para ver</a>","2021-09-10 22:41:34");
INSERT INTO historico VALUES("385","31","Eliminação","Pagamento da divida | Valor: 200,00 KZ <a href=detalhestratardocumentos.php?identrada=170>Clique para ver</a>","Eliminado","2021-09-10 22:45:59");
INSERT INTO historico VALUES("386","31","Eliminação","Todos os dados de(Declaração sem notas) | Valor: 1.750,00 KZ | Por Consolidar 450 KZ","Eliminado","2021-09-10 23:03:49");
INSERT INTO historico VALUES("387","31","Eliminação","Todos os dados de(Declaração sem notas) (<a href=aluno.php?idaluno=64>Alberto Vunge</a>)| Valor: 4.040,00 KZ | Por Consolidar 0 KZ","Eliminado","2021-09-10 23:20:45");
INSERT INTO historico VALUES("388","31","Edição","Tratar Documento (Guia de Transferência) | Preço 350 , Desconto 50 , valor pago 300","Preço 350 , Desconto 50 , valor pago 300 |  <a href=detalhestratardocumentos.php?identrada=176>Clique para ver</a>","2021-09-11 04:21:01");
INSERT INTO historico VALUES("389","31","Edição","(Guia de Transferência) | Pago: 300 | F. Pag: BIC | 2021-09-11 03:40:21","(Guia de Transferência) | Pago: 200  | F. Pag: BIC | 2021-09-11 03:40:21 <a href=detalhesdafalta.php?identrada=176>Clique para ver</a>","2021-09-11 04:21:49");
INSERT INTO historico VALUES("390","31","Edição","Tratar Documento (Declaração sem notas) | Preço 1200 , Desconto 500 , valor pago 400","Preço 1200 , Desconto 500 , valor pago 400 |  <a href=detalhestratardocumentos.php?identrada=177>Clique para ver</a>","2021-09-11 04:24:30");
INSERT INTO historico VALUES("391","31","Edição","Tratar Documento (Declaração sem notas) | Preço 1200 , Desconto 500 , valor pago 400","Preço 1200 , Desconto 500 , valor pago 400 |  <a href=detalhestratardocumentos.php?identrada=177>Clique para ver</a>","2021-09-11 04:25:16");
INSERT INTO historico VALUES("392","31","Edição","Tratar Documento (Boletin) | Preço 0 , Desconto 0 , valor pago 0","Preço 0 , Desconto 0 , valor pago 0 |  <a href=detalhestratardocumentos.php?identrada=183>Clique para ver</a>","2021-09-11 09:31:59");
INSERT INTO historico VALUES("393","31","Edição","Tratar Documento (Boletin) | Preço 0 , Desconto 0 , valor pago 0","Preço 600 , Desconto 60 , valor pago 0 |  <a href=detalhestratardocumentos.php?identrada=183>Clique para ver</a>","2021-09-11 09:32:14");
INSERT INTO historico VALUES("394","31","Edição","Tratar Documento (Boletin) | Preço 0 , Desconto 0 , valor pago 0","Preço 1450 , Desconto 600 , valor pago 0 |  <a href=detalhestratardocumentos.php?identrada=185>Clique para ver</a>","2021-09-11 11:30:14");
INSERT INTO historico VALUES("395","31","Edição","Tratar Documento (Termo de Matrícula) | Preço 1500 , Desconto 250 , valor pago 1000","Preço 1500 , Desconto 250 , valor pago 1000 |  <a href=detalhestratardocumentos.php?identrada=186>Clique para ver</a>","2021-09-11 13:37:13");
INSERT INTO historico VALUES("396","31","Edição","Tratar Documento (Termo de Matrícula) | Preço 1500 , Desconto 250 , valor pago 1000","Preço 1500 , Desconto 250 , valor pago 1000 |  <a href=detalhestratardocumentos.php?identrada=186>Clique para ver</a>","2021-09-11 13:37:29");
INSERT INTO historico VALUES("397","31","Edição","Tratar Documento (Termo de Matrícula) | Preço 1500 , Desconto 250 , valor pago 1000"," (Termo de Matrícula) Preço 1500 , Desconto 250 , valor pago 1000 |  <a href=detalhestratardocumentos.php?identrada=186>Clique para ver</a>","2021-09-11 13:47:16");
INSERT INTO historico VALUES("398","31","Edição","Tratar Documento (Declaração com notas) | Preço 2450 , Desconto 500 , valor pago 1000"," (Declaração com notas) Preço 2450 , Desconto 500 , valor pago 1000 |  <a href=detalhestratardocumentos.php?identrada=178>Clique para ver</a>","2021-09-11 13:49:15");
INSERT INTO historico VALUES("399","31","Edição","Tratar Documento (0) | Preço 2450 , Desconto 500 , valor pago 1000"," (0) Preço 2450 , Desconto 500 , valor pago 1000 |  <a href=detalhestratardocumentos.php?identrada=178>Clique para ver</a>","2021-09-11 13:53:56");
INSERT INTO historico VALUES("400","31","Edição","Tratar Documento (Termo de Matrícula de Notas) | Preço 1500 , Desconto 250 , valor pago 1000"," (Termo de Matrícula de Notas) Preço 1500 , Desconto 250 , valor pago 1000 |  <a href=detalhestratardocumentos.php?identrada=186>Clique para ver</a>","2021-09-11 13:58:32");
INSERT INTO historico VALUES("401","31","Edição","Tratar Documento (Termo de Matrícula) | Preço 1500 , Desconto 250 , valor pago 1000"," (Termo de Matrícula) Preço 1800 , Desconto 250 , valor pago 1000 |  <a href=detalhestratardocumentos.php?identrada=186>Clique para ver</a>","2021-09-11 13:58:43");
INSERT INTO historico VALUES("402","31","Eliminação","Todos os dados de(Certificado) (<a href=aluno.php?idaluno=44>Bernardo Gomes da Costa</a>)| Valor: 2.000,00 KZ | Por Consolidar 2000 KZ","Eliminado","2021-09-11 16:50:02");
INSERT INTO historico VALUES("403","31","Edição","Tratar Documento (Certificado) | Preço 4500 , Desconto 500 , valor pago 2000","Preço 4900 , Desconto 500 , valor pago 2000 |  <a href=detalhestratardocumentos.php?identrada=195>Clique para ver</a>","2021-09-11 16:50:27");
INSERT INTO historico VALUES("404","31","Eliminação","Todos os dados de(Certificado) (<a href=aluno.php?idaluno=44>Bernardo Gomes da Costa</a>)| Valor: 2.000,00 KZ | Por Consolidar 2400 KZ","Eliminado","2021-09-11 18:24:38");
INSERT INTO historico VALUES("405","31","Eliminação","Eliminado Matrícula do aluno <a href=aluno.php?idaluno=76>Firmino Da Sila</a> | Na Turma: <a href=turma.php?idturma=22>teste </a> | Valor pago: 1900 ","Eliminado","2021-09-21 18:02:13");
INSERT INTO historico VALUES("406","31","Eliminação","Eliminado  do aluno <a href=aluno.php?idaluno=></a> | Na Turma: <a href=turma.php?idturma=></a> | Valor pago:  ","Eliminado","2021-09-21 18:02:17");
INSERT INTO historico VALUES("407","31","edição","A nota do aluno <a href=aluno.php?idaluno=68>Ronalda Andre</a> da disciplina de Química |Valor da Nota: 7.27 ","Valor da Nota: 7.25","2021-09-22 02:00:51");
INSERT INTO historico VALUES("408","31","edição","A nota do aluno <a href=aluno.php?idaluno=29>Suzana Pedro</a> da disciplina de Inglês |Valor da Nota: 16 ","Valor da Nota: 11","2021-09-23 12:38:10");
INSERT INTO historico VALUES("409","31","edição","A nota do aluno <a href=aluno.php?idaluno=15>Margarida Fernandes</a> da disciplina de Inglês |Valor da Nota: 12 ","Valor da Nota: 17","2021-09-23 12:38:14");
INSERT INTO historico VALUES("410","31","Eliminação","Todos  os dados de(Registro de Propina de 12/2021) | Valor: 2.000,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=238>Clique para ver</a>","Eliminado","2021-11-08 07:53:15");
INSERT INTO historico VALUES("411","31","Eliminação","Eliminado o pagamento de propina do aluno  <a href=aluno.php?idaluno=83>Ananias Pedro </a> do mês de 012/2021","Eliminado","2021-11-08 07:53:16");



DROP TABLE IF EXISTS impostos;

CREATE TABLE `impostos` (
  `idimposto` int(11) NOT NULL AUTO_INCREMENT,
  `imposto` varchar(100) NOT NULL,
  `incidencia` varchar(100) NOT NULL DEFAULT 'entradas',
  `percentagem` double NOT NULL DEFAULT '0',
  `obs` varchar(220) NOT NULL,
  PRIMARY KEY (`idimposto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO impostos VALUES("1","Imposto sobre Venda","entradas","14","");
INSERT INTO impostos VALUES("2","Imposto sobre Consumo","saidas","3","");
INSERT INTO impostos VALUES("7","Imposto de Renda","entradas","7"," ");



DROP TABLE IF EXISTS lembretes;

CREATE TABLE `lembretes` (
  `idlembrete` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text,
  `datadolembrete` date NOT NULL,
  `datadecadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idlembrete`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO lembretes VALUES("2","Lembra de cobrar propina ao senhor joão","2021-08-10","2021-08-08 05:07:01");
INSERT INTO lembretes VALUES("4","Lembrar de Pagar a Energia","2021-08-15","2021-08-08 05:15:40");
INSERT INTO lembretes VALUES("5","des
","2021-08-09","2021-08-08 11:48:02");



DROP TABLE IF EXISTS matriculaseconfirmacoes;

CREATE TABLE `matriculaseconfirmacoes` (
  `idmatriculaeconfirmacao` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `tipodealuno` varchar(50) NOT NULL DEFAULT 'Normal',
  `idanolectivo` int(11) NOT NULL,
  `idturma` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL DEFAULT 'Matrícula',
  `preco` double NOT NULL DEFAULT '0',
  `desconto` double NOT NULL DEFAULT '0',
  `valorpago` double NOT NULL DEFAULT '0',
  `turma` varchar(50) NOT NULL,
  `sala` varchar(50) NOT NULL,
  `curso` varchar(200) NOT NULL,
  `periodo` varchar(50) NOT NULL,
  `classe` varchar(10) NOT NULL,
  `data` date DEFAULT NULL,
  `obs` text,
  `estatus` varchar(200) NOT NULL DEFAULT 'activo',
  `ultimomespago` date NOT NULL DEFAULT '0000-00-00',
  `classificacaofinal` varchar(50) NOT NULL DEFAULT 'Sem Classificação',
  `reconfirmou` int(2) NOT NULL DEFAULT '0',
  `descontoparapropinas` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmatriculaeconfirmacao`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

INSERT INTO matriculaseconfirmacoes VALUES("8","6","Normal","2","2","Matrícula","2000","0","2000","3A","3","Ciências Físicas e Biológicas","Manhã","12ª","2021-07-30","","Inactivo","0000-00-00","Sem Classificação","1","0");
INSERT INTO matriculaseconfirmacoes VALUES("9","7","Normal","2","4","Matrícula","4500","0","4500","12B","8","Informática de Gestão","Manhã","12ª","2021-07-28","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("10","8","Normal","2","5","Matrícula","1200","100","900","10INF","8","Informática de Gestão","Noite","10ª","2021-08-02","","activo","2021-06-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("12","8","Normal","1","3","Matrícula","14000","10000","3500","1B","2","Nenhum","Manhã","Iniciação","2021-07-30","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("13","9","Normal","1","3","Matrícula","14000","3000","11000","1B","2","Nenhum","Manhã","Iniciação","2021-08-01","","activo","0000-00-00","Sem Classificação","1","0");
INSERT INTO matriculaseconfirmacoes VALUES("14","9","Normal","2","6","Confirmação","5500","500","5000","4A","2","Nenhum","Manhã","4ª","2021-08-02","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("15","10","Normal","2","2","Matrícula","0","0","0","3A","3","Ciências Físicas e Biológicas","Manhã","12ª","2020-08-06","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("16","11","Normal","2","6","Matrícula","3000","0","300","4A","2","Nenhum","Manhã","4ª","2021-08-02","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("17","12","Normal","2","4","Matrícula","4500","0","4500","12B","8","Informática de Gestão","Manhã","12ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("18","13","Normal","2","4","Matrícula","4500","0","4500","12B","8","Informática de Gestão","Manhã","12ª","2021-08-02","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("19","14","Normal","2","7","Matrícula","0","0","0","12ENF","8","Enfermagem","Tarde","12ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("20","15","Normal","2","10","Matrícula","0","0","0","10CEJ","4","Ciências Económicas e Jurídicas","Tarde","10ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("21","16","Normal","2","2","Matrícula","2000","0","2000","3A","3","Ciências Físicas e Biológicas","Manhã","12ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("22","16","Normal","2","4","Matrícula","4500","0","4500","12B","8","Informática de Gestão","Manhã","12ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("24","17","Normal","2","4","Matrícula","4500","0","4500","12B","8","Informática de Gestão","Manhã","12ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("25","18","Normal","2","7","Matrícula","0","0","0","12ENF","8","Enfermagem","Tarde","12ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("26","19","Normal","2","9","Matrícula","0","0","0","13INF","2","Informática de Gestão","Manhã","13ª","0000-00-00","","Expulso","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("27","20","Normal","2","13","Matrícula","14000","0","14000","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("28","21","Normal","2","13","Matrícula","14000","0","14000","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("29","22","Normal","2","8","Matrícula","0","0","0","11ENF","6","Enfermagem","Noite","11ª","0000-00-00","","Desistiu","2021-10-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("30","22","Normal","2","11","Matrícula","0","0","0","11CEJ","2","Ciências Económicas e Jurídicas","Tarde","11ª","0000-00-00","","activo","2021-10-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("31","23","Normal","2","13","Matrícula","14000","0","14000","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","0000-00-00","","activo","2020-08-11","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("32","24","Normal","2","7","Matrícula","0","0","0","12ENF","8","Enfermagem","Tarde","12ª","0000-00-00","","activo","2020-08-02","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("33","25","Normal","2","8","Matrícula","0","0","0","11ENF","6","Enfermagem","Noite","11ª","2021-08-04","","activo","2021-09-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("34","26","Bolseiro","1","14","Matrícula","0","0","0","6B","4","Nenhum","Noite","6ª","2021-08-03","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("35","27","Normal","2","7","Matrícula","0","0","0","12ENF","8","Enfermagem","Tarde","12ª","2021-08-02","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("36","28","Normal","2","2","Matrícula","2000","900","1100","3A","3","Ciências Físicas e Biológicas","Manhã","12ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("37","29","Normal","2","10","Matrícula","0","0","0","10CEJ","4","Ciências Económicas e Jurídicas","Tarde","10ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("38","30","Normal","2","4","Matrícula","4500","0","4500","12B","8","Informática de Gestão","Manhã","12ª","0000-00-00","","activo","2023-03-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("39","31","Normal","1","3","Matrícula","14000","0","14000","1B","2","Nenhum","Manhã","Iniciação","2021-09-01","","activo","0000-00-00","Sem Classificação","1","0");
INSERT INTO matriculaseconfirmacoes VALUES("40","31","Normal","2","4","Confirmação","7500","600","6700","12B","8","Informática de Gestão","Manhã","12ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("41","32","Normal","2","8","Matrícula","3500","0","2920","11ENF","6","Enfermagem","Noite","11ª","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("42","33","Normal","2","4","Matrícula","4500","700","200","12B","8","Informática de Gestão","Manhã","12ª","2021-08-04","","activo","2021-09-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("43","34","Normal","1","3","Matrícula","1400","0","1400","1B","2","Nenhum","Manhã","Iniciação","2021-09-05","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("44","35","Normal","2","7","Matrícula","0","0","0","12ENF","8","Enfermagem","Tarde","12ª","2021-08-06","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("45","37","Normal","2","7","Matrícula","0","0","0","12ENF","8","Enfermagem","Tarde","12ª","2021-08-06","","activo","2021-08-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("48","38","Normal","2","8","Matrícula","0","0","0","11ENF","6","Enfermagem","Noite","11ª","2021-08-06","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("49","39","Bolseiro","2","5","Matrícula","1200","0","1200","10INF","8","Informática de Gestão","Noite","10ª","2021-08-06","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("50","40","Normal","2","8","Matrícula","1200","200","900","11ENF","6","Enfermagem","Noite","11ª","2021-08-08","vai pagar outra parte outro dia","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("51","41","Normal","1","15","Matrícula","0","0","0","13CFB","5","Ciências Físicas e Biológicas","Tarde","13ª","2021-08-10","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("52","42","Normal","2","9","Matrícula","1900","0","1900","13INF","2","Informática de Gestão","Manhã","13ª","2021-08-11","","activo","2021-09-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("53","43","Normal","2","4","Matrícula","4500","0","4500","12B","8","Informática de Gestão","Manhã","12ª","2021-08-13","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("54","50","Normal","2","9","","0","0","0","13INF","2","Informática de Gestão","Manhã","13ª","2021-08-16","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("55","52","Normal","2","9","Confirmação","0","0","0","13INF","2","Informática de Gestão","Manhã","13ª","2021-08-16","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("56","53","Normal","2","5","Matrícula","0","0","0","10INF","8","Informática de Gestão","Noite","10ª","2021-08-17","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("57","54","Normal","2","7","Confirmação","4500","0","4500","12ENF","8","Enfermagem","Tarde","12ª","2021-08-17","","Faleceu","2021-09-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("58","55","Normal","2","4","Matrícula","4500","0","4500","12B","8","Informática de Gestão","Manhã","12ª","2021-08-17","","activo","2021-09-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("60","44","Normal","2","9","Rematrícula","4900","400","1000","13INF","2","Informática de Gestão","Manhã","13ª","2021-08-20","","activo","2021-11-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("61","41","Normal","2","7","Matrícula","6800","0","6800","12ENF","8","Enfermagem","Tarde","12ª","2021-08-20","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("62","58","Normal","2","11","Matrícula","4500","0","4500","11CEJ","2","Ciências Económicas e Jurídicas","Tarde","11ª","2021-08-21","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("63","64","Normal","2","7","Matrícula","6800","0","3900","12ENF","8","Enfermagem","Tarde","12ª","2021-08-23","","activo","2021-09-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("64","66","Normal","2","4","Matrícula","4500","0","4500","12B","8","Informática de Gestão","Manhã","12ª","2021-09-02","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("65","64","Normal","2","5","Confirmação","1200","0","1000","10INF","8","Informática de Gestão","Noite","10ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("66","67","Normal","2","5","Matrícula","0","0","0","10INF","8","Informática de Gestão","Noite","10ª","2021-09-06","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("67","68","Normal","2","9","Matrícula","0","0","0","13INF","2","Informática de Gestão","Manhã","13ª","2021-09-06","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("68","69","Normal","2","8","Matrícula","0","0","0","11ENF","6","Enfermagem","Noite","11ª","2021-09-06","","activo","2021-09-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("69","70","Normal","2","4","Matrícula","0","0","0","12B","8","Informática de Gestão","Manhã","12ª","2021-09-06","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("70","71","Normal","2","5","Matrícula","0","0","0","10INF","8","Informática de Gestão","Noite","10ª","2021-09-06","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("71","72","Normal","2","7","Matrícula","6800","600","3000","12ENF","8","Enfermagem","Tarde","12ª","2021-09-06","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("72","25","Bolseiro","2","0","Confirmação","0","0","0","","","","","","0000-00-00","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("73","73","Normal","2","16","Matrícula","4500","0","4000","9A","8","Nenhum","Tarde","9ª","2021-09-11","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("74","73","Normal","1","14","Matrícula","3000","0","3000","6B","4","Nenhum","Noite","6ª","2021-09-11","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("75","74","Normal","2","17","Matrícula","1200","0","1200","6B","8","Nenhum","Tarde","6ª","2021-09-11","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("76","44","Normal","2","4","Confirmação","400","0","400","12B","8","Informática de Gestão","Manhã","12ª","2021-09-11","","activo","2021-12-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("77","44","Normal","2","11","Confirmação","1000","0","1000","11CEJ","2","Ciências Económicas e Jurídicas","Tarde","11ª","2021-09-11","","activo","2021-08-01","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("78","44","Normal","2","5","Confirmação","1200","0","1200","10INF","8","Informática de Gestão","Noite","10ª","2021-09-11","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("79","73","Normal","2","18","Confirmação","1500","0","1500","8A","6","Nenhum","Tarde","8ª","2021-09-12","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("80","73","Normal","2","19","Confirmação","1250","0","1250","7A","8","Nenhum","Tarde","7ª","2021-09-12","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("81","74","Normal","2","20","Confirmação","1250","0","1250","2A","8","Nenhum","Manhã","2ª","2021-09-12","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("82","74","Normal","2","6","Confirmação","5500","0","5500","4A","2","Nenhum","Manhã","4ª","2021-09-12","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("83","77","Normal","2","7","Confirmação","4500","0","4500","12ENF","8","Enfermagem","Tarde","12ª","2021-09-23","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("84","78","Normal","2","4","Matrícula","4500","0","4500","12B","8","Informática de Gestão","Manhã","12ª","2021-09-29","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("85","31","Normal","2","5","Confirmação","1200","0","1200","10INF","8","Informática de Gestão","Noite","10ª","2021-09-02","","activo","0000-00-00","Sem Classificação","0","0");
INSERT INTO matriculaseconfirmacoes VALUES("86","79","Normal","2","9","Matrícula","1900","0","1900","13INF","2","Informática de Gestão","Manhã","13ª","2021-11-05","","activo","2021-06-01","Sem Classificação","0","500");
INSERT INTO matriculaseconfirmacoes VALUES("87","9","Normal","2","5","Confirmação","1200","0","1200","10INF","8","Informática de Gestão","Noite","10ª","2021-11-05","","activo","0000-00-00","Sem Classificação","0","1200");
INSERT INTO matriculaseconfirmacoes VALUES("88","80","Normal","2","19","Confirmação","0","0","0","7A","8","Nenhum","Tarde","7ª","2021-11-05","","activo","0000-00-00","Sem Classificação","0","560");
INSERT INTO matriculaseconfirmacoes VALUES("89","82","Normal","2","10","Confirmação","1250","0","1250","10CEJ","4","Ciências Económicas e Jurídicas","Tarde","10ª","2021-11-05","","activo","0000-00-00","Sem Classificação","0","600");
INSERT INTO matriculaseconfirmacoes VALUES("90","38","Normal","2","5","Confirmação","1200","0","1200","10INF","8","Informática de Gestão","Noite","10ª","2021-11-05","","activo","0000-00-00","Sem Classificação","0","560");
INSERT INTO matriculaseconfirmacoes VALUES("91","83","Normal","3","22","Confirmação","0","0","0","1A2019","8","Nenhum","Tarde","Iniciação","2021-08-01","","activo","2021-11-01","Sem Classificação","0","100");
INSERT INTO matriculaseconfirmacoes VALUES("92","84","Normal","3","22","Matrícula","1000","0","1000","1A2019","8","Nenhum","Tarde","Iniciação","2021-09-01","","activo","0000-00-00","Sem Classificação","0","0");



DROP TABLE IF EXISTS metas;

CREATE TABLE `metas` (
  `idmeta` int(11) NOT NULL AUTO_INCREMENT,
  `nomedameta` varchar(100) DEFAULT NULL,
  `sector` varchar(220) DEFAULT '',
  `diainicio` date DEFAULT NULL,
  `diafim` date NOT NULL,
  `valor` double NOT NULL DEFAULT '0',
  `obs` text,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` varchar(100) NOT NULL DEFAULT 'em andamento',
  PRIMARY KEY (`idmeta`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO metas VALUES("13","Aumentar Matrícula","Material Escolar","2021-08-17","2021-08-28","12000","","2021-08-24 09:55:55","em andamento");
INSERT INTO metas VALUES("15","Aumentar as propinas","Todos","2021-08-10","2021-09-04","150000","","2021-08-24 09:58:20","em andamento");



DROP TABLE IF EXISTS notas;

CREATE TABLE `notas` (
  `idnota` int(11) NOT NULL AUTO_INCREMENT,
  `iddisciplina` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `idtipodenota` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT '0',
  `idturma` int(11) NOT NULL,
  PRIMARY KEY (`idnota`)
) ENGINE=InnoDB AUTO_INCREMENT=442 DEFAULT CHARSET=utf8;

INSERT INTO notas VALUES("1","4","15","1","20","18","10");
INSERT INTO notas VALUES("2","4","29","2","37","9","10");
INSERT INTO notas VALUES("3","4","15","3","20","13","10");
INSERT INTO notas VALUES("4","4","29","3","37","17","10");
INSERT INTO notas VALUES("5","4","15","2","20","20","10");
INSERT INTO notas VALUES("6","4","29","1","37","15","10");
INSERT INTO notas VALUES("9","7","25","1","33","12","8");
INSERT INTO notas VALUES("10","7","37","2","47","15","8");
INSERT INTO notas VALUES("11","7","38","2","48","12","8");
INSERT INTO notas VALUES("12","7","32","1","41","16","8");
INSERT INTO notas VALUES("13","7","38","1","48","18","8");
INSERT INTO notas VALUES("14","7","37","1","47","15","8");
INSERT INTO notas VALUES("15","7","25","2","33","9","8");
INSERT INTO notas VALUES("16","7","32","2","41","4","8");
INSERT INTO notas VALUES("17","7","22","1","29","16","8");
INSERT INTO notas VALUES("18","7","22","2","29","4","8");
INSERT INTO notas VALUES("19","7","25","3","33","5","8");
INSERT INTO notas VALUES("20","7","37","3","47","12","8");
INSERT INTO notas VALUES("21","7","38","3","48","9","8");
INSERT INTO notas VALUES("22","7","32","3","41","7","8");
INSERT INTO notas VALUES("23","7","22","3","29","0","8");
INSERT INTO notas VALUES("24","7","22","4","29","12","8");
INSERT INTO notas VALUES("25","7","25","4","33","3","8");
INSERT INTO notas VALUES("26","6","37","1","46","12","13");
INSERT INTO notas VALUES("27","6","37","2","46","3","13");
INSERT INTO notas VALUES("28","6","23","2","31","17","13");
INSERT INTO notas VALUES("29","6","23","1","31","12","13");
INSERT INTO notas VALUES("30","6","20","1","27","9","13");
INSERT INTO notas VALUES("31","6","20","2","27","17","13");
INSERT INTO notas VALUES("32","6","21","1","28","11","13");
INSERT INTO notas VALUES("33","6","21","2","28","5","13");
INSERT INTO notas VALUES("34","4","15","4","20","9","10");
INSERT INTO notas VALUES("35","4","29","4","37","12","10");
INSERT INTO notas VALUES("36","4","15","5","20","20","10");
INSERT INTO notas VALUES("37","4","29","5","37","19","10");
INSERT INTO notas VALUES("38","4","15","6","20","11","10");
INSERT INTO notas VALUES("39","4","29","6","37","15","10");
INSERT INTO notas VALUES("40","6","37","3","46","13","13");
INSERT INTO notas VALUES("41","6","23","3","31","12","13");
INSERT INTO notas VALUES("42","6","21","3","28","12","13");
INSERT INTO notas VALUES("43","6","20","3","27","12","13");
INSERT INTO notas VALUES("44","6","37","4","46","12","13");
INSERT INTO notas VALUES("45","6","23","4","31","18","13");
INSERT INTO notas VALUES("46","6","20","4","27","4","13");
INSERT INTO notas VALUES("47","6","21","4","28","5","13");
INSERT INTO notas VALUES("48","6","23","5","31","12","13");
INSERT INTO notas VALUES("49","6","37","5","46","12","13");
INSERT INTO notas VALUES("50","6","20","5","27","0","13");
INSERT INTO notas VALUES("51","6","21","5","28","15","13");
INSERT INTO notas VALUES("52","6","23","6","31","12","13");
INSERT INTO notas VALUES("53","6","20","6","27","18","13");
INSERT INTO notas VALUES("54","30","33","1","42","4","4");
INSERT INTO notas VALUES("55","30","30","1","38","5","4");
INSERT INTO notas VALUES("56","30","12","1","17","7","4");
INSERT INTO notas VALUES("57","30","13","1","18","12","4");
INSERT INTO notas VALUES("58","30","31","1","40","19","4");
INSERT INTO notas VALUES("59","30","17","1","24","20","4");
INSERT INTO notas VALUES("60","30","33","2","42","12","4");
INSERT INTO notas VALUES("61","30","30","2","38","9","4");
INSERT INTO notas VALUES("62","30","12","2","17","12","4");
INSERT INTO notas VALUES("63","30","13","2","18","15","4");
INSERT INTO notas VALUES("64","30","31","2","40","18","4");
INSERT INTO notas VALUES("65","30","17","2","24","19","4");
INSERT INTO notas VALUES("66","30","30","3","38","12","4");
INSERT INTO notas VALUES("67","30","12","4","17","9","4");
INSERT INTO notas VALUES("68","30","13","4","18","17","4");
INSERT INTO notas VALUES("69","30","13","3","18","19","4");
INSERT INTO notas VALUES("70","30","33","4","42","10","4");
INSERT INTO notas VALUES("71","30","33","3","42","11","4");
INSERT INTO notas VALUES("72","30","31","3","40","12","4");
INSERT INTO notas VALUES("73","30","17","4","24","19","4");
INSERT INTO notas VALUES("74","30","7","3","9","11","4");
INSERT INTO notas VALUES("75","16","19","1","26","12","9");
INSERT INTO notas VALUES("76","16","19","2","26","15","9");
INSERT INTO notas VALUES("77","16","19","3","26","4","9");
INSERT INTO notas VALUES("78","16","19","4","26","17","9");
INSERT INTO notas VALUES("79","16","19","5","26","20","9");
INSERT INTO notas VALUES("80","16","19","6","26","18","9");
INSERT INTO notas VALUES("81","2","37","6","46","1","13");
INSERT INTO notas VALUES("82","2","21","6","28","18","13");
INSERT INTO notas VALUES("83","2","23","2","31","17","13");
INSERT INTO notas VALUES("84","2","21","1","28","15","13");
INSERT INTO notas VALUES("85","2","23","1","31","18","13");
INSERT INTO notas VALUES("86","22","8","1","11","12","6");
INSERT INTO notas VALUES("87","22","8","2","11","12","6");
INSERT INTO notas VALUES("88","22","8","3","11","16","6");
INSERT INTO notas VALUES("89","22","8","4","11","12","6");
INSERT INTO notas VALUES("90","22","8","5","11","8","6");
INSERT INTO notas VALUES("91","22","8","6","11","19","6");
INSERT INTO notas VALUES("92","22","9","1","14","3","6");
INSERT INTO notas VALUES("93","22","9","2","14","12","6");
INSERT INTO notas VALUES("94","22","9","3","14","8","6");
INSERT INTO notas VALUES("95","22","9","4","14","10","6");
INSERT INTO notas VALUES("96","22","9","5","14","11","6");
INSERT INTO notas VALUES("97","22","9","6","14","10","6");
INSERT INTO notas VALUES("98","22","11","6","16","19","6");
INSERT INTO notas VALUES("99","22","11","5","16","20","6");
INSERT INTO notas VALUES("100","22","11","4","16","13","6");
INSERT INTO notas VALUES("101","22","11","3","16","8","6");
INSERT INTO notas VALUES("102","22","11","2","16","12","6");
INSERT INTO notas VALUES("103","22","11","1","16","17","6");
INSERT INTO notas VALUES("104","15","21","3","28","12","13");
INSERT INTO notas VALUES("105","31","42","15","52","18","9");
INSERT INTO notas VALUES("106","31","52","15","55","9","9");
INSERT INTO notas VALUES("107","31","19","15","26","12","9");
INSERT INTO notas VALUES("108","31","19","16","26","19","9");
INSERT INTO notas VALUES("109","31","52","1","55","12","9");
INSERT INTO notas VALUES("110","31","42","1","52","3","9");
INSERT INTO notas VALUES("111","31","42","2","52","16","9");
INSERT INTO notas VALUES("112","31","52","2","55","12","9");
INSERT INTO notas VALUES("113","31","50","2","54","16","9");
INSERT INTO notas VALUES("114","31","50","1","54","19","9");
INSERT INTO notas VALUES("115","31","42","3","52","12","9");
INSERT INTO notas VALUES("116","31","52","3","55","3","9");
INSERT INTO notas VALUES("117","31","19","3","26","4","9");
INSERT INTO notas VALUES("118","31","50","3","54","15","9");
INSERT INTO notas VALUES("119","31","42","4","52","17","9");
INSERT INTO notas VALUES("120","31","52","4","55","2","9");
INSERT INTO notas VALUES("121","31","50","4","54","16","9");
INSERT INTO notas VALUES("122","31","52","5","55","16","9");
INSERT INTO notas VALUES("123","31","42","5","52","1","9");
INSERT INTO notas VALUES("124","31","50","5","54","15","9");
INSERT INTO notas VALUES("125","31","52","6","55","13","9");
INSERT INTO notas VALUES("126","31","42","6","52","19","9");
INSERT INTO notas VALUES("127","31","50","6","54","20","9");
INSERT INTO notas VALUES("128","31","50","15","54","11","9");
INSERT INTO notas VALUES("129","9","10","15","15","12","2");
INSERT INTO notas VALUES("130","9","6","15","8","12","2");
INSERT INTO notas VALUES("131","9","16","15","21","11","2");
INSERT INTO notas VALUES("132","9","28","15","36","14","2");
INSERT INTO notas VALUES("133","9","10","1","15","12","2");
INSERT INTO notas VALUES("134","9","28","2","36","15","2");
INSERT INTO notas VALUES("135","9","10","2","15","3","2");
INSERT INTO notas VALUES("136","9","28","1","36","17","2");
INSERT INTO notas VALUES("137","9","6","1","8","15","2");
INSERT INTO notas VALUES("138","9","6","2","8","12","2");
INSERT INTO notas VALUES("139","9","16","2","21","11","2");
INSERT INTO notas VALUES("140","9","16","1","21","15","2");
INSERT INTO notas VALUES("141","9","10","3","15","1","2");
INSERT INTO notas VALUES("142","9","28","3","36","12","2");
INSERT INTO notas VALUES("143","9","6","3","8","16","2");
INSERT INTO notas VALUES("144","9","16","3","21","19","2");
INSERT INTO notas VALUES("145","9","16","4","21","12","2");
INSERT INTO notas VALUES("146","9","6","4","8","5","2");
INSERT INTO notas VALUES("147","9","28","4","36","7","2");
INSERT INTO notas VALUES("148","9","10","4","15","15","2");
INSERT INTO notas VALUES("149","9","10","5","15","12","2");
INSERT INTO notas VALUES("150","9","28","5","36","13","2");
INSERT INTO notas VALUES("151","9","6","5","8","12","2");
INSERT INTO notas VALUES("152","9","16","5","21","11","2");
INSERT INTO notas VALUES("153","9","28","6","36","3","2");
INSERT INTO notas VALUES("154","9","10","6","15","4","2");
INSERT INTO notas VALUES("155","9","16","6","21","16","2");
INSERT INTO notas VALUES("156","9","6","6","8","12","2");
INSERT INTO notas VALUES("157","33","15","15","20","15","10");
INSERT INTO notas VALUES("158","33","29","15","37","16","10");
INSERT INTO notas VALUES("159","33","15","1","20","18","10");
INSERT INTO notas VALUES("160","33","29","1","37","15","10");
INSERT INTO notas VALUES("161","33","29","2","37","9","10");
INSERT INTO notas VALUES("162","33","15","2","20","20","10");
INSERT INTO notas VALUES("163","33","15","3","20","13","10");
INSERT INTO notas VALUES("164","33","29","3","37","17","10");
INSERT INTO notas VALUES("165","33","29","4","37","12","10");
INSERT INTO notas VALUES("166","33","29","5","37","19","10");
INSERT INTO notas VALUES("167","33","15","5","20","20","10");
INSERT INTO notas VALUES("168","33","15","6","20","11","10");
INSERT INTO notas VALUES("169","33","29","6","37","15","10");
INSERT INTO notas VALUES("170","25","34","1","43","4","3");
INSERT INTO notas VALUES("171","25","8","1","12","5","3");
INSERT INTO notas VALUES("172","25","9","2","13","12","3");
INSERT INTO notas VALUES("173","25","31","2","39","16","3");
INSERT INTO notas VALUES("174","18","10","1","15","14","2");
INSERT INTO notas VALUES("175","18","28","1","36","12","2");
INSERT INTO notas VALUES("176","18","6","2","8","15","2");
INSERT INTO notas VALUES("177","18","10","2","15","12","2");
INSERT INTO notas VALUES("178","18","10","3","15","15","2");
INSERT INTO notas VALUES("179","18","10","4","15","13","2");
INSERT INTO notas VALUES("180","18","28","4","36","4","2");
INSERT INTO notas VALUES("181","18","28","3","36","13","2");
INSERT INTO notas VALUES("182","18","6","3","8","6","2");
INSERT INTO notas VALUES("183","18","6","4","8","20","2");
INSERT INTO notas VALUES("184","18","16","4","21","12","2");
INSERT INTO notas VALUES("185","18","28","5","36","14","2");
INSERT INTO notas VALUES("186","42","44","15","78","15","5");
INSERT INTO notas VALUES("187","42","64","15","65","19","5");
INSERT INTO notas VALUES("188","40","44","15","78","19","5");
INSERT INTO notas VALUES("189","44","44","15","78","12","5");
INSERT INTO notas VALUES("190","30","44","15","76","13","4");
INSERT INTO notas VALUES("191","30","44","16","76","15","4");
INSERT INTO notas VALUES("192","26","44","15","76","14","4");
INSERT INTO notas VALUES("193","47","73","1","73","12","16");
INSERT INTO notas VALUES("194","47","73","2","73","6","16");
INSERT INTO notas VALUES("195","47","73","3","73","5","16");
INSERT INTO notas VALUES("196","47","73","4","73","14","16");
INSERT INTO notas VALUES("197","47","73","5","73","12","16");
INSERT INTO notas VALUES("198","47","73","6","73","11","16");
INSERT INTO notas VALUES("199","47","73","15","73","12","16");
INSERT INTO notas VALUES("200","48","73","15","80","15","19");
INSERT INTO notas VALUES("201","4","15","15","20","14","10");
INSERT INTO notas VALUES("202","4","29","15","37","12","10");
INSERT INTO notas VALUES("203","14","44","1","60","12","9");
INSERT INTO notas VALUES("204","14","42","2","52","5","9");
INSERT INTO notas VALUES("205","14","52","2","55","11","9");
INSERT INTO notas VALUES("206","14","19","2","26","10","9");
INSERT INTO notas VALUES("207","14","50","2","54","9.5","9");
INSERT INTO notas VALUES("208","14","68","1","67","7.25","9");
INSERT INTO notas VALUES("209","14","19","1","26","12","9");
INSERT INTO notas VALUES("210","14","52","1","55","10","9");
INSERT INTO notas VALUES("211","14","42","1","52","9","9");
INSERT INTO notas VALUES("212","14","50","1","54","10","9");
INSERT INTO notas VALUES("213","14","42","15","52","13","9");
INSERT INTO notas VALUES("214","14","52","15","55","10","9");
INSERT INTO notas VALUES("215","14","19","15","26","11","9");
INSERT INTO notas VALUES("216","14","50","15","54","9","9");
INSERT INTO notas VALUES("217","14","44","15","60","16","9");
INSERT INTO notas VALUES("218","14","68","15","67","19","9");
INSERT INTO notas VALUES("219","14","52","16","55","19","9");
INSERT INTO notas VALUES("220","14","42","5","52","12","9");
INSERT INTO notas VALUES("221","14","44","5","60","10","9");
INSERT INTO notas VALUES("222","14","44","4","60","11","9");
INSERT INTO notas VALUES("223","14","52","3","55","11","9");
INSERT INTO notas VALUES("224","14","19","4","26","19","9");
INSERT INTO notas VALUES("225","8","64","1","63","12","7");
INSERT INTO notas VALUES("226","8","37","2","45","12","7");
INSERT INTO notas VALUES("227","8","54","2","57","14","7");
INSERT INTO notas VALUES("228","8","24","2","32","5","7");
INSERT INTO notas VALUES("229","8","54","1","57","6","7");
INSERT INTO notas VALUES("230","8","35","1","44","3","7");
INSERT INTO notas VALUES("231","8","54","3","57","12","7");
INSERT INTO notas VALUES("232","8","37","3","45","11","7");
INSERT INTO notas VALUES("233","8","64","3","63","20","7");
INSERT INTO notas VALUES("234","8","64","4","63","12","7");
INSERT INTO notas VALUES("235","8","37","4","45","16","7");
INSERT INTO notas VALUES("236","8","54","4","57","13","7");
INSERT INTO notas VALUES("237","8","24","4","32","19","7");
INSERT INTO notas VALUES("238","8","14","3","19","10","7");
INSERT INTO notas VALUES("239","8","18","3","25","9","7");
INSERT INTO notas VALUES("240","8","72","2","71","2","7");
INSERT INTO notas VALUES("241","8","14","1","19","3","7");
INSERT INTO notas VALUES("242","8","18","2","25","4","7");
INSERT INTO notas VALUES("243","8","14","2","19","8","7");
INSERT INTO notas VALUES("244","8","27","4","35","12","7");
INSERT INTO notas VALUES("245","8","18","4","25","3","7");
INSERT INTO notas VALUES("246","8","14","4","19","12","7");
INSERT INTO notas VALUES("247","8","35","4","44","14","7");
INSERT INTO notas VALUES("248","8","35","3","44","11","7");
INSERT INTO notas VALUES("249","8","24","3","32","3","7");
INSERT INTO notas VALUES("250","8","72","3","71","18","7");
INSERT INTO notas VALUES("251","8","27","3","35","12","7");
INSERT INTO notas VALUES("252","8","72","4","71","12","7");
INSERT INTO notas VALUES("253","8","54","5","57","12","7");
INSERT INTO notas VALUES("254","8","37","5","45","15","7");
INSERT INTO notas VALUES("255","8","64","5","63","12","7");
INSERT INTO notas VALUES("256","8","35","5","44","4","7");
INSERT INTO notas VALUES("257","8","24","5","32","12","7");
INSERT INTO notas VALUES("258","8","14","5","19","6","7");
INSERT INTO notas VALUES("259","8","18","5","25","13","7");
INSERT INTO notas VALUES("260","8","18","6","25","12","7");
INSERT INTO notas VALUES("261","8","14","6","19","1","7");
INSERT INTO notas VALUES("262","8","35","6","44","2","7");
INSERT INTO notas VALUES("263","8","54","6","57","3","7");
INSERT INTO notas VALUES("264","8","37","6","45","12","7");
INSERT INTO notas VALUES("265","8","64","6","63","12","7");
INSERT INTO notas VALUES("266","8","35","2","44","12","7");
INSERT INTO notas VALUES("267","8","27","2","35","12","7");
INSERT INTO notas VALUES("268","8","41","2","61","11","7");
INSERT INTO notas VALUES("269","8","72","1","71","11","7");
INSERT INTO notas VALUES("270","8","18","1","25","11","7");
INSERT INTO notas VALUES("271","8","27","1","35","12","7");
INSERT INTO notas VALUES("272","8","41","1","61","15","7");
INSERT INTO notas VALUES("273","8","41","3","61","17","7");
INSERT INTO notas VALUES("274","8","41","4","61","18","7");
INSERT INTO notas VALUES("275","8","41","5","61","12","7");
INSERT INTO notas VALUES("276","8","27","5","35","15","7");
INSERT INTO notas VALUES("277","8","72","5","71","12","7");
INSERT INTO notas VALUES("278","8","72","6","71","12","7");
INSERT INTO notas VALUES("279","8","27","6","35","11","7");
INSERT INTO notas VALUES("280","8","41","6","61","5","7");
INSERT INTO notas VALUES("281","8","24","6","32","17","7");
INSERT INTO notas VALUES("282","8","24","1","32","14","7");
INSERT INTO notas VALUES("283","8","37","1","45","5","7");
INSERT INTO notas VALUES("284","8","64","15","63","12","7");
INSERT INTO notas VALUES("285","8","37","15","45","16","7");
INSERT INTO notas VALUES("286","8","54","15","57","4","7");
INSERT INTO notas VALUES("287","8","35","15","44","16","7");
INSERT INTO notas VALUES("288","8","24","15","32","4","7");
INSERT INTO notas VALUES("289","8","24","16","32","16","7");
INSERT INTO notas VALUES("290","8","14","16","19","14","7");
INSERT INTO notas VALUES("291","8","18","15","25","12","7");
INSERT INTO notas VALUES("292","8","14","15","19","17","7");
INSERT INTO notas VALUES("293","8","72","15","71","15","7");
INSERT INTO notas VALUES("294","8","27","15","35","12","7");
INSERT INTO notas VALUES("295","8","41","15","61","16","7");
INSERT INTO notas VALUES("296","17","64","1","63","14","7");
INSERT INTO notas VALUES("297","17","37","1","45","12","7");
INSERT INTO notas VALUES("298","17","54","1","57","1","7");
INSERT INTO notas VALUES("299","17","35","1","44","12","7");
INSERT INTO notas VALUES("300","17","14","1","19","18","7");
INSERT INTO notas VALUES("301","17","18","1","25","19","7");
INSERT INTO notas VALUES("302","17","72","1","71","12","7");
INSERT INTO notas VALUES("303","17","41","1","61","9","7");
INSERT INTO notas VALUES("304","17","27","1","35","8","7");
INSERT INTO notas VALUES("305","17","27","2","35","12","7");
INSERT INTO notas VALUES("306","17","41","2","61","17","7");
INSERT INTO notas VALUES("307","17","18","2","25","12","7");
INSERT INTO notas VALUES("308","17","14","2","19","12","7");
INSERT INTO notas VALUES("309","17","24","2","32","19","7");
INSERT INTO notas VALUES("310","17","35","2","44","19","7");
INSERT INTO notas VALUES("311","17","54","2","57","20","7");
INSERT INTO notas VALUES("312","17","37","2","45","11","7");
INSERT INTO notas VALUES("313","17","64","2","63","2","7");
INSERT INTO notas VALUES("314","17","64","3","63","12","7");
INSERT INTO notas VALUES("315","17","37","3","45","19","7");
INSERT INTO notas VALUES("316","17","54","3","57","18","7");
INSERT INTO notas VALUES("317","17","35","3","44","12","7");
INSERT INTO notas VALUES("318","17","24","3","32","10","7");
INSERT INTO notas VALUES("319","17","14","3","19","10","7");
INSERT INTO notas VALUES("320","17","18","3","25","1","7");
INSERT INTO notas VALUES("321","17","72","3","71","18","7");
INSERT INTO notas VALUES("322","17","27","3","35","16","7");
INSERT INTO notas VALUES("323","17","41","3","61","10","7");
INSERT INTO notas VALUES("324","17","64","4","63","11","7");
INSERT INTO notas VALUES("325","17","37","4","45","12","7");
INSERT INTO notas VALUES("326","17","54","4","57","12","7");
INSERT INTO notas VALUES("327","17","35","4","44","18","7");
INSERT INTO notas VALUES("328","17","14","4","19","12","7");
INSERT INTO notas VALUES("329","17","18","4","25","1","7");
INSERT INTO notas VALUES("330","17","27","4","35","12","7");
INSERT INTO notas VALUES("331","17","41","4","61","1","7");
INSERT INTO notas VALUES("332","17","41","5","61","18","7");
INSERT INTO notas VALUES("333","17","27","5","35","8","7");
INSERT INTO notas VALUES("334","17","72","5","71","7","7");
INSERT INTO notas VALUES("335","17","14","5","19","9","7");
INSERT INTO notas VALUES("336","17","35","5","44","12","7");
INSERT INTO notas VALUES("337","17","24","5","32","18","7");
INSERT INTO notas VALUES("338","17","54","5","57","11","7");
INSERT INTO notas VALUES("339","17","37","5","45","17","7");
INSERT INTO notas VALUES("340","17","64","5","63","6","7");
INSERT INTO notas VALUES("341","17","37","6","45","12","7");
INSERT INTO notas VALUES("342","17","64","6","63","1","7");
INSERT INTO notas VALUES("343","17","54","6","57","12","7");
INSERT INTO notas VALUES("344","17","24","6","32","12","7");
INSERT INTO notas VALUES("345","17","14","6","19","18","7");
INSERT INTO notas VALUES("346","17","18","6","25","19","7");
INSERT INTO notas VALUES("347","17","64","15","63","12","7");
INSERT INTO notas VALUES("348","17","37","15","45","11","7");
INSERT INTO notas VALUES("349","17","54","15","57","19","7");
INSERT INTO notas VALUES("350","17","35","15","44","20","7");
INSERT INTO notas VALUES("351","17","24","15","32","9","7");
INSERT INTO notas VALUES("352","17","14","15","19","11","7");
INSERT INTO notas VALUES("353","17","18","15","25","8","7");
INSERT INTO notas VALUES("354","17","18","16","25","12","7");
INSERT INTO notas VALUES("355","17","72","16","71","12","7");
INSERT INTO notas VALUES("356","17","72","15","71","19","7");
INSERT INTO notas VALUES("357","17","27","15","35","20","7");
INSERT INTO notas VALUES("358","17","41","16","61","12","7");
INSERT INTO notas VALUES("359","17","41","15","61","3","7");
INSERT INTO notas VALUES("360","23","64","1","63","12","7");
INSERT INTO notas VALUES("361","23","37","1","45","11","7");
INSERT INTO notas VALUES("362","23","54","1","57","15","7");
INSERT INTO notas VALUES("363","23","35","1","44","12","7");
INSERT INTO notas VALUES("364","23","24","1","32","12","7");
INSERT INTO notas VALUES("365","23","14","1","19","14","7");
INSERT INTO notas VALUES("366","23","18","1","25","18","7");
INSERT INTO notas VALUES("367","23","72","1","71","10","7");
INSERT INTO notas VALUES("368","23","41","1","61","11","7");
INSERT INTO notas VALUES("369","23","27","1","35","19","7");
INSERT INTO notas VALUES("370","23","41","2","61","7","7");
INSERT INTO notas VALUES("371","23","27","2","35","9","7");
INSERT INTO notas VALUES("372","23","72","2","71","10","7");
INSERT INTO notas VALUES("373","23","14","2","19","12","7");
INSERT INTO notas VALUES("374","23","35","2","44","11","7");
INSERT INTO notas VALUES("375","23","54","2","57","11","7");
INSERT INTO notas VALUES("376","23","37","2","45","20","7");
INSERT INTO notas VALUES("377","23","64","2","63","20","7");
INSERT INTO notas VALUES("378","23","64","3","63","11","7");
INSERT INTO notas VALUES("379","23","37","3","45","11","7");
INSERT INTO notas VALUES("380","23","54","3","57","12","7");
INSERT INTO notas VALUES("381","23","35","3","44","19","7");
INSERT INTO notas VALUES("382","23","24","3","32","12","7");
INSERT INTO notas VALUES("383","23","14","3","19","19","7");
INSERT INTO notas VALUES("384","23","18","3","25","19","7");
INSERT INTO notas VALUES("385","23","72","3","71","12","7");
INSERT INTO notas VALUES("386","23","27","3","35","18","7");
INSERT INTO notas VALUES("387","23","41","3","61","5","7");
INSERT INTO notas VALUES("388","23","41","4","61","12","7");
INSERT INTO notas VALUES("389","23","27","4","35","19","7");
INSERT INTO notas VALUES("390","23","72","4","71","12","7");
INSERT INTO notas VALUES("391","23","18","4","25","19","7");
INSERT INTO notas VALUES("392","23","14","4","19","20","7");
INSERT INTO notas VALUES("393","23","24","4","32","12.9","7");
INSERT INTO notas VALUES("394","23","35","4","44","11","7");
INSERT INTO notas VALUES("395","23","54","4","57","19","7");
INSERT INTO notas VALUES("396","23","37","4","45","5","7");
INSERT INTO notas VALUES("397","23","24","2","32","5","7");
INSERT INTO notas VALUES("398","23","64","4","63","9","7");
INSERT INTO notas VALUES("399","23","18","5","25","2","7");
INSERT INTO notas VALUES("400","23","35","5","44","20","7");
INSERT INTO notas VALUES("401","23","24","5","32","12","7");
INSERT INTO notas VALUES("402","23","14","5","19","11","7");
INSERT INTO notas VALUES("403","23","72","5","71","19","7");
INSERT INTO notas VALUES("404","23","27","5","35","9","7");
INSERT INTO notas VALUES("405","23","41","5","61","10","7");
INSERT INTO notas VALUES("406","23","27","6","35","11","7");
INSERT INTO notas VALUES("407","23","41","6","61","12","7");
INSERT INTO notas VALUES("408","23","18","6","25","12","7");
INSERT INTO notas VALUES("409","23","72","6","71","10","7");
INSERT INTO notas VALUES("410","23","14","6","19","12","7");
INSERT INTO notas VALUES("411","23","24","6","32","19","7");
INSERT INTO notas VALUES("412","23","35","6","44","12","7");
INSERT INTO notas VALUES("413","23","54","6","57","11","7");
INSERT INTO notas VALUES("414","23","54","5","57","12","7");
INSERT INTO notas VALUES("415","23","37","5","45","19","7");
INSERT INTO notas VALUES("416","23","37","6","45","10","7");
INSERT INTO notas VALUES("417","23","64","6","63","11","7");
INSERT INTO notas VALUES("418","23","64","5","63","11","7");
INSERT INTO notas VALUES("419","23","64","15","63","12","7");
INSERT INTO notas VALUES("420","23","37","15","45","5","7");
INSERT INTO notas VALUES("421","23","54","15","57","19","7");
INSERT INTO notas VALUES("422","23","35","15","44","11","7");
INSERT INTO notas VALUES("423","23","24","15","32","19","7");
INSERT INTO notas VALUES("424","23","14","15","19","2","7");
INSERT INTO notas VALUES("425","23","14","16","19","12","7");
INSERT INTO notas VALUES("426","23","18","15","25","18","7");
INSERT INTO notas VALUES("427","23","72","15","71","19","7");
INSERT INTO notas VALUES("428","23","27","15","35","11","7");
INSERT INTO notas VALUES("429","23","41","15","61","18","7");
INSERT INTO notas VALUES("430","27","35","1","44","12","7");
INSERT INTO notas VALUES("431","27","35","2","44","12","7");
INSERT INTO notas VALUES("432","27","35","3","44","12","7");
INSERT INTO notas VALUES("433","27","35","4","44","14","7");
INSERT INTO notas VALUES("434","27","35","5","44","15","7");
INSERT INTO notas VALUES("435","27","35","15","44","15","7");
INSERT INTO notas VALUES("436","41","35","15","44","8","7");
INSERT INTO notas VALUES("437","41","35","16","44","13","7");
INSERT INTO notas VALUES("438","38","15","15","20","19","10");
INSERT INTO notas VALUES("439","38","29","15","37","17","10");
INSERT INTO notas VALUES("440","11","15","15","20","17","10");
INSERT INTO notas VALUES("441","11","29","15","37","11","10");



DROP TABLE IF EXISTS periodos;

CREATE TABLE `periodos` (
  `idperiodo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`idperiodo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO periodos VALUES("1","Manhã");
INSERT INTO periodos VALUES("2","Tarde");
INSERT INTO periodos VALUES("3","Duplo 2");
INSERT INTO periodos VALUES("4","Noite");



DROP TABLE IF EXISTS presenca;

CREATE TABLE `presenca` (
  `idfalta` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` int(11) NOT NULL,
  `ano` int(4) NOT NULL,
  `dia` int(3) NOT NULL,
  `mes` int(3) NOT NULL,
  `falta` varchar(4) DEFAULT NULL,
  `horastrabalhadas` double NOT NULL DEFAULT '0',
  `horasextras` double NOT NULL DEFAULT '0',
  `remunerar` int(2) NOT NULL DEFAULT '1',
  `salariopordia` double NOT NULL DEFAULT '0',
  `salariopelahorasextras` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idfalta`),
  KEY `idfuncionario` (`idfuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8;

INSERT INTO presenca VALUES("26","26","2020","5","7","P","0","0","1","600","0");
INSERT INTO presenca VALUES("27","9","2020","5","7","P","0","0","1","700","0");
INSERT INTO presenca VALUES("29","28","2020","5","7","68","0","0","0","400","0");
INSERT INTO presenca VALUES("30","26","2020","4","7","12","0","0","0","600","0");
INSERT INTO presenca VALUES("32","9","2020","4","7","P","0","0","1","700","0");
INSERT INTO presenca VALUES("33","28","2020","4","7","P","0","0","1","400","0");
INSERT INTO presenca VALUES("35","9","2020","7","7","70","0","0","1","700","0");
INSERT INTO presenca VALUES("37","28","2020","7","7","13","0","0","1","400","0");
INSERT INTO presenca VALUES("38","26","2020","10","7","P","0","0","1","600","0");
INSERT INTO presenca VALUES("39","9","2020","10","7","P","0","0","1","700","0");
INSERT INTO presenca VALUES("40","28","2020","10","7","P","0","0","1","400","0");
INSERT INTO presenca VALUES("42","26","2020","12","7","P","0","0","1","600","0");
INSERT INTO presenca VALUES("43","9","2020","12","7","72","0","0","0","700","0");
INSERT INTO presenca VALUES("45","28","2020","12","7","P","0","0","1","400","0");
INSERT INTO presenca VALUES("46","26","2020","6","7","P","0","0","1","600","0");
INSERT INTO presenca VALUES("47","9","2020","6","7","P","0","0","1","700","0");
INSERT INTO presenca VALUES("49","28","2020","6","7","67","0","0","0","400","0");
INSERT INTO presenca VALUES("50","9","2020","13","7","P","0","0","1","700","0");
INSERT INTO presenca VALUES("51","26","2020","13","7","P","0","0","1","600","0");
INSERT INTO presenca VALUES("53","28","2020","13","7","P","0","0","1","400","0");
INSERT INTO presenca VALUES("54","26","2020","15","7","P","0","0","1","600","0");
INSERT INTO presenca VALUES("57","28","2020","15","7","P","0","0","1","400","0");
INSERT INTO presenca VALUES("59","26","2020","11","7","P","0","0","1","600","0");
INSERT INTO presenca VALUES("70","26","2020","7","7","P","0","0","1","600","0");
INSERT INTO presenca VALUES("71","26","2020","14","7","P","0","0","1","600","0");
INSERT INTO presenca VALUES("72","26","2020","16","7","P","0","0","1","600","0");
INSERT INTO presenca VALUES("73","29","2020","16","7","P","0","0","1","0","0");
INSERT INTO presenca VALUES("74","26","2020","17","7","73","0","0","0","600","0");
INSERT INTO presenca VALUES("75","29","2020","12","6","P","0","0","1","0","0");
INSERT INTO presenca VALUES("76","29","2020","14","6","P","0","0","1","800","0");
INSERT INTO presenca VALUES("77","26","2020","12","11","P","0","0","1","600","0");
INSERT INTO presenca VALUES("79","9","2021","10","1","P","8","0","1","6400","0");
INSERT INTO presenca VALUES("81","29","2021","10","1","P","8","3","1","4800","1800");
INSERT INTO presenca VALUES("82","26","2021","12","1","P","8","6","1","0","0");
INSERT INTO presenca VALUES("88","28","2021","3","1","73","4","0","0","0","0");
INSERT INTO presenca VALUES("89","26","2021","2","1","P","8","4","1","0","1800");
INSERT INTO presenca VALUES("92","9","2021","11","1","P","8","5","1","6400","4000");
INSERT INTO presenca VALUES("93","9","2021","1","1","P","8","0","1","6400","0");
INSERT INTO presenca VALUES("95","29","2021","26","1","73","4","4","0","0","2400");
INSERT INTO presenca VALUES("100","26","2021","13","1","P","8","0","1","6400","0");
INSERT INTO presenca VALUES("101","26","2021","9","1","22","8","0","1","3600","0");
INSERT INTO presenca VALUES("102","29","2021","16","2","P","8","0","1","4800","0");
INSERT INTO presenca VALUES("103","26","2021","18","2","P","8","0","1","3600","0");
INSERT INTO presenca VALUES("105","30","2021","20","2","P","8","0","1","3636.32","0");
INSERT INTO presenca VALUES("106","26","2021","28","2","P","8","0","1","3600","0");
INSERT INTO presenca VALUES("107","29","2021","2","2","P","8","4","1","4800","2400");
INSERT INTO presenca VALUES("108","26","2021","2","2","72","4","0","0","0","0");
INSERT INTO presenca VALUES("109","9","2021","2","2","12","0","0","0","0","0");
INSERT INTO presenca VALUES("110","30","2021","2","2","P","8","5","1","3636.32","2272.7");
INSERT INTO presenca VALUES("111","1","2021","2","2","P","8","1","1","4000","500");
INSERT INTO presenca VALUES("113","9","2021","3","2","P","8","2","1","6400","1600");
INSERT INTO presenca VALUES("114","26","2021","22","2","P","8","0","1","3600","0");
INSERT INTO presenca VALUES("115","29","2021","23","2","P","8","0","1","4800","0");
INSERT INTO presenca VALUES("117","30","2021","22","2","P","8","0","1","3636.32","0");
INSERT INTO presenca VALUES("118","30","2021","24","2","P","8","0","1","3636.32","0");
INSERT INTO presenca VALUES("119","30","2021","26","2","P","8","0","1","3636.32","0");
INSERT INTO presenca VALUES("120","9","2021","26","2","P","8","0","1","6400","0");
INSERT INTO presenca VALUES("121","29","2021","26","2","P","8","0","1","4800","0");
INSERT INTO presenca VALUES("122","29","2021","27","2","P","8","0","1","4800","0");
INSERT INTO presenca VALUES("123","29","2021","28","2","P","8","0","1","4800","0");
INSERT INTO presenca VALUES("124","29","2021","19","2","P","8","0","1","4800","0");
INSERT INTO presenca VALUES("125","9","2021","7","2","P","8","0","1","6400","0");
INSERT INTO presenca VALUES("127","9","2021","10","2","P","8","0","1","6400","0");
INSERT INTO presenca VALUES("128","1","2021","9","2","P","8","0","1","4000","0");
INSERT INTO presenca VALUES("129","30","2021","3","3","P","12","0","1","6000","0");
INSERT INTO presenca VALUES("130","30","2021","6","3","P","12","0","1","6000","0");
INSERT INTO presenca VALUES("131","30","2021","7","3","P","12","5","1","6000","2500");
INSERT INTO presenca VALUES("132","30","2021","8","3","P","12","12","1","6000","6000");
INSERT INTO presenca VALUES("133","29","2021","13","3","P","8","0","1","4800","0");
INSERT INTO presenca VALUES("134","17","2021","12","3","P","8","0","1","3600","0");
INSERT INTO presenca VALUES("135","17","2021","8","3","P","8","0","1","3600","0");
INSERT INTO presenca VALUES("136","17","2021","5","3","P","8","0","1","3600","0");
INSERT INTO presenca VALUES("137","9","2021","6","3","P","8","0","1","2800","0");
INSERT INTO presenca VALUES("138","9","2021","11","3","P","8","0","1","2800","0");
INSERT INTO presenca VALUES("139","9","2021","16","3","P","8","0","1","2800","0");
INSERT INTO presenca VALUES("140","29","2021","3","3","P","8","0","1","4800","0");
INSERT INTO presenca VALUES("141","34","2021","30","3","P","8","0","1","9088","0");
INSERT INTO presenca VALUES("144","33","2021","30","3","P","8","0","1","5336","0");
INSERT INTO presenca VALUES("145","32","2021","2","4","p","8","0","1","5456","0");
INSERT INTO presenca VALUES("146","32","2021","3","4","p","8","0","1","5456","0");
INSERT INTO presenca VALUES("147","32","2021","7","4","p","8","0","1","5456","0");
INSERT INTO presenca VALUES("148","32","2021","10","4","p","8","0","1","5456","0");
INSERT INTO presenca VALUES("149","32","2021","12","4","p","8","0","1","5456","0");
INSERT INTO presenca VALUES("150","39","2021","14","4","p","8","0","1","1928","0");
INSERT INTO presenca VALUES("151","39","2021","8","4","p","8","0","1","1928","0");
INSERT INTO presenca VALUES("152","39","2021","5","4","p","8","0","1","1928","0");
INSERT INTO presenca VALUES("153","39","2021","2","4","p","8","0","1","1928","0");
INSERT INTO presenca VALUES("154","34","2021","1","4","p","8","0","1","9088","0");
INSERT INTO presenca VALUES("155","34","2021","2","4","p","8","0","1","9088","0");
INSERT INTO presenca VALUES("156","34","2021","4","4","2","8","0","1","9088","0");
INSERT INTO presenca VALUES("157","1","2021","19","4","22","8","0","1","24","0");
INSERT INTO presenca VALUES("158","31","2021","19","4","13","8","0","1","2320","0");
INSERT INTO presenca VALUES("159","31","2021","16","4","P","8","0","1","2320","0");
INSERT INTO presenca VALUES("160","31","2021","13","4","p","8","0","1","2320","0");
INSERT INTO presenca VALUES("161","1","2021","10","4","p","8","0","1","24","0");
INSERT INTO presenca VALUES("162","30","2021","9","4","p","12","0","1","6000","0");
INSERT INTO presenca VALUES("163","30","2021","10","4","p","12","0","1","6000","0");
INSERT INTO presenca VALUES("164","30","2021","21","4","p","12","0","1","6000","0");
INSERT INTO presenca VALUES("165","30","2021","23","4","p","12","0","1","6000","0");
INSERT INTO presenca VALUES("166","31","2021","24","4","p","8","0","1","2320","0");
INSERT INTO presenca VALUES("167","1","2021","23","4","p","8","0","1","24","0");
INSERT INTO presenca VALUES("168","34","2021","10","4","p","8","0","1","9088","0");
INSERT INTO presenca VALUES("169","34","2021","12","4","p","8","0","1","9088","0");
INSERT INTO presenca VALUES("172","33","2021","1","4","p","8","0","1","5336","0");
INSERT INTO presenca VALUES("173","33","2021","4","4","p","8","0","1","5336","0");
INSERT INTO presenca VALUES("174","33","2021","6","4","p","8","0","1","5336","0");
INSERT INTO presenca VALUES("176","33","2021","9","4","p","8","0","1","5336","0");
INSERT INTO presenca VALUES("177","33","2021","12","4","p","8","0","1","5336","0");
INSERT INTO presenca VALUES("178","33","2021","15","4","p","8","0","1","5336","0");
INSERT INTO presenca VALUES("179","33","2021","27","4","p","8","0","1","5336","0");
INSERT INTO presenca VALUES("180","33","2021","28","4","p","8","0","1","5336","0");
INSERT INTO presenca VALUES("181","33","2021","29","4","p","8","0","1","5336","0");
INSERT INTO presenca VALUES("182","42","2021","1","8","P","8","4","1","2504","1252");
INSERT INTO presenca VALUES("183","27","2021","1","8","P","8","0","1","1840","0");
INSERT INTO presenca VALUES("184","27","2021","3","8","P","8","0","1","1840","0");
INSERT INTO presenca VALUES("185","1","2021","2","8","P","8","0","1","24","0");
INSERT INTO presenca VALUES("186","30","2021","3","8","P","12","0","1","6000","0");
INSERT INTO presenca VALUES("187","41","2021","1","8","P","8","0","1","5264","0");
INSERT INTO presenca VALUES("188","32","2021","4","8","P","8","0","1","5456","0");
INSERT INTO presenca VALUES("189","42","2021","3","8","P","8","0","1","2504","0");



DROP TABLE IF EXISTS produtos;

CREATE TABLE `produtos` (
  `idproduto` int(11) NOT NULL AUTO_INCREMENT,
  `nomedoproduto` varchar(100) COLLATE utf8_roman_ci NOT NULL,
  `preco` double NOT NULL DEFAULT '0',
  `precodecompra` double NOT NULL DEFAULT '0',
  `quantidade` double NOT NULL DEFAULT '0',
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datadeexpiracao` date DEFAULT NULL,
  `ultimavenda` date DEFAULT NULL,
  `estatus` varchar(30) COLLATE utf8_roman_ci NOT NULL DEFAULT 'operacional',
  `stockminimo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=770 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

INSERT INTO produtos VALUES("766","Uniforme de Educação física","5000","2000","44","2021-08-11 09:10:40","0000-00-00","2021-08-26","operacional","0");
INSERT INTO produtos VALUES("767","Batas para Laboratório","2000","500","37","2021-08-11 09:11:29","2021-08-16","2021-09-02","operacional","0");
INSERT INTO produtos VALUES("768","Uniforme Escolar","5000","4500","20","2021-08-11 09:44:37","2022-11-18","2021-08-26","operacional","3");
INSERT INTO produtos VALUES("769","Lacosta de Treino","3400","1200","7","2021-08-17 22:06:38","0000-00-00","2021-08-17","operacional","1");



DROP TABLE IF EXISTS propinas;

CREATE TABLE `propinas` (
  `idpropina` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `preco` double NOT NULL DEFAULT '0',
  `multa` double NOT NULL DEFAULT '0',
  `valorpago` double NOT NULL DEFAULT '0',
  `desconto` double NOT NULL DEFAULT '0',
  `mespago` date NOT NULL,
  `datadopagamento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obs` varchar(220) NOT NULL,
  `codigodepropina` varchar(200) NOT NULL,
  PRIMARY KEY (`idpropina`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

INSERT INTO propinas VALUES("1","8","11","2","1900","0","1000","900","2021-06-01","2021-08-02 15:08:20","","CDP81/3916");
INSERT INTO propinas VALUES("2","8","10","2","5000","0","5000","0","2021-06-01","2021-08-02 15:10:49","","CDP82/2535");
INSERT INTO propinas VALUES("3","9","13","1","1200","0","1200","0","2020-04-01","2021-08-02 15:13:24","","CDP93/4725");
INSERT INTO propinas VALUES("4","25","33","2","4500","0","4500","0","2021-08-01","2021-08-04 06:31:52","","CDP254/5360");
INSERT INTO propinas VALUES("5","22","29","2","1200","0","1200","0","2021-08-01","2021-08-04 06:32:26","","CDP225/3334");
INSERT INTO propinas VALUES("6","37","46","2","5000","0","5000","0","2021-08-01","2021-08-06 07:25:41","","CDP376/9219");
INSERT INTO propinas VALUES("7","37","45","2","1300","900","1000","0","2021-07-01","2021-08-06 07:26:20","","CDP377/2818");
INSERT INTO propinas VALUES("8","30","38","2","2300","0","2300","0","2021-08-01","2021-08-11 13:28:58","","CDP308/5794");
INSERT INTO propinas VALUES("9","33","42","2","2300","0","2300","0","2021-07-01","2021-08-13 10:41:29","","CDP339/4810");
INSERT INTO propinas VALUES("11","64","63","2","1300","0","1300","0","2021-08-01","2021-08-25 20:11:07","","CDP6411/10443");
INSERT INTO propinas VALUES("12","33","42","2","2300","0","2300","0","2021-08-01","2021-08-25 20:12:09","","CDP3312/9981");
INSERT INTO propinas VALUES("13","54","57","2","1300","0","1300","0","2021-06-01","2021-08-25 20:17:34","","CDP5413/11438");
INSERT INTO propinas VALUES("14","54","57","2","1300","0","1300","0","2021-08-01","2021-08-25 20:17:42","","CDP5414/9107");
INSERT INTO propinas VALUES("16","37","45","2","1300","0","1300","0","2021-08-01","2021-08-25 21:56:57","","CDP3716/11102");
INSERT INTO propinas VALUES("17","22","29","2","2000","0","2000","0","2021-10-01","2021-08-25 22:03:20","","CDP2217/11817");
INSERT INTO propinas VALUES("18","22","30","2","4500","0","4500","0","2021-07-01","2021-08-30 11:06:52","","CDP2218/62512");
INSERT INTO propinas VALUES("19","44","60","2","4000","0","4000","0","2021-07-01","2021-09-02 11:17:11","","CDP4419/22086");
INSERT INTO propinas VALUES("20","54","57","2","1600","0","1000","400","2021-09-01","2021-09-02 17:20:30","","CDP5420/51132");
INSERT INTO propinas VALUES("21","64","63","2","1300","0","1300","0","2021-09-01","2021-09-06 04:19:31","","CDP6421/67089");
INSERT INTO propinas VALUES("22","64","65","2","5000","0","5000","0","2021-09-01","2021-09-06 04:19:38","","CDP6422/42267");
INSERT INTO propinas VALUES("23","55","58","2","2300","0","2300","0","2021-09-01","2021-09-06 04:19:58","","CDP5523/30501");
INSERT INTO propinas VALUES("24","30","38","2","2300","0","2000","0","2021-09-01","2021-09-06 10:11:18","","CDP3024/80743");
INSERT INTO propinas VALUES("25","33","42","2","2300","0","2300","0","2021-09-01","2021-09-07 06:57:05","","CDP3325/24876");
INSERT INTO propinas VALUES("26","42","52","2","4000","0","4000","0","2021-09-01","2021-09-07 06:57:15","","CDP4226/33763");
INSERT INTO propinas VALUES("27","69","68","2","2000","0","2000","0","2021-09-01","2021-09-09 14:50:49","","CDP6927/32041");
INSERT INTO propinas VALUES("28","44","76","2","2300","0","2300","0","2021-10-01","2021-10-01 08:30:40","","CDP4428/32456");
INSERT INTO propinas VALUES("29","44","76","2","2300","550","1850","1000","2021-11-01","2021-09-02 18:25:53","","CDP4429/14658");
INSERT INTO propinas VALUES("30","64","65","2","5000","500","2200","300","2021-10-01","2021-09-02 18:29:02","O aluno ficou devendo","CDP6430/69884");
INSERT INTO propinas VALUES("31","25","33","2","2000","500","1200","300","2021-09-01","2021-09-02 18:30:02","","CDP2531/21891");
INSERT INTO propinas VALUES("32","30","38","2","2300","0","2300","0","2021-10-01","2021-09-05 05:01:45","","CDP3032/36033");
INSERT INTO propinas VALUES("33","30","38","2","2300","0","2300","0","2021-11-01","2021-09-05 05:02:02","","CDP3033/97672");
INSERT INTO propinas VALUES("34","30","38","2","2300","5000","2700","600","2021-12-01","2021-09-05 05:02:31","","CDP3034/78152");
INSERT INTO propinas VALUES("35","22","30","2","4500","2500","3500","500","2021-10-01","2021-11-05 08:12:08","","CDP2235/28382");
INSERT INTO propinas VALUES("36","44","77","2","4500","2500","4500","0","2021-08-01","2021-11-05 08:33:02","","CDP4436/88992");
INSERT INTO propinas VALUES("37","44","60","2","4000","2500","3500","1000","2021-08-01","2021-11-05 08:33:49","","CDP4437/37587");
INSERT INTO propinas VALUES("38","44","60","2","4000","2500","3000","500","2021-09-01","2021-11-05 08:34:21","","CDP4438/19370");
INSERT INTO propinas VALUES("39","44","60","2","4000","2500","6000","500","2021-10-01","2021-11-05 08:34:45","
","CDP4439/22453");
INSERT INTO propinas VALUES("40","44","60","2","4000","0","2000","0","2021-11-01","2021-11-05 08:34:58","","CDP4440/60910");
INSERT INTO propinas VALUES("41","79","86","2","4000","2500","6000","500","2021-06-01","2021-11-05 09:12:07","","CDP7941/11064");
INSERT INTO propinas VALUES("42","44","76","2","2300","2500","4800","0","2021-12-01","2022-01-06 22:13:50","","CDP4442/55119");
INSERT INTO propinas VALUES("43","30","38","2","2300","0","2300","0","2022-01-01","2022-01-06 22:14:04","","CDP3043/56102");
INSERT INTO propinas VALUES("44","30","38","2","2300","2500","4800","0","2022-02-01","2022-03-06 22:45:55","","CDP3044/42981");
INSERT INTO propinas VALUES("45","30","38","2","2300","0","2300","0","2022-03-01","2022-03-06 22:46:02","","CDP3045/48359");
INSERT INTO propinas VALUES("46","30","38","2","2300","2500","4800","0","2023-03-01","2023-06-06 22:59:07","","CDP3046/54750");
INSERT INTO propinas VALUES("47","83","91","3","2000","0","1900","100","2021-08-01","2021-11-08 07:33:12","","CDP8347/49576");
INSERT INTO propinas VALUES("48","83","91","3","2000","0","1900","100","2021-09-01","2021-11-08 07:34:25","","CDP8348/15084");
INSERT INTO propinas VALUES("49","83","91","3","2000","100","2000","100","2021-10-01","2021-11-08 07:45:53","","CDP8349/52604");
INSERT INTO propinas VALUES("50","83","91","3","2000","100","2000","100","2021-11-01","2021-11-08 07:46:06","","CDP8350/39749");



DROP TABLE IF EXISTS saidas;

CREATE TABLE `saidas` (
  `idsaida` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` int(11) DEFAULT NULL,
  `descricao` varchar(220) DEFAULT NULL,
  `tipo` varchar(60) DEFAULT NULL,
  `valor` double NOT NULL DEFAULT '0',
  `divida` double NOT NULL DEFAULT '0',
  `datadasaida` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idtipo` int(11) DEFAULT NULL,
  `idanolectivo` int(11) NOT NULL DEFAULT '2',
  `formadesaida` varchar(200) NOT NULL DEFAULT 'Dinheiro',
  PRIMARY KEY (`idsaida`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

INSERT INTO saidas VALUES("1","9","Compra do Almoço ","Alimentação","4500","500","2020-10-08 05:44:02","5","2","Dinheiro");
INSERT INTO saidas VALUES("3","9","Compra do Pequeno Almoço","Alimentação","12000","2000","2020-10-06 06:04:51","5","2","Dinheiro");
INSERT INTO saidas VALUES("8","9","Dinheiro perdido","Gastos Exporáticos","16000","7000","2020-10-08 08:00:08","3","2","Dinheiro");
INSERT INTO saidas VALUES("12","9","Pagamento do Salário do mês de 10/2020 do funcionario:<a href=funcionario.php?id=9> Fulanda Pedro</a> ","Salário","10000","2780","2020-10-28 08:10:08","1","2","Dinheiro");
INSERT INTO saidas VALUES("15","10","Pagamento do Salário do mês de 11/2020 do funcionario:<a href=funcionario.php?idfuncionario=10> Donaires Pedro</a> ","Salário","9000","900","2020-11-10 17:57:20","1","2","Dinheiro");
INSERT INTO saidas VALUES("17","10","Compra do Almoço","Alimentação","5000","0","2020-12-04 02:32:43","5","2","Dinheiro");
INSERT INTO saidas VALUES("18","10","Pagamento do Salário do mês de 12/2020 do funcionario:<a href=funcionario.php?idfuncionario=9> Fulanda Pedro</a> ","Salário","2500","2000","2020-12-04 02:38:31","1","2","Dinheiro");
INSERT INTO saidas VALUES("19","10","Compra do Almoço","Alimentação","6000","0","2020-12-17 08:22:40","5","2","Dinheiro");
INSERT INTO saidas VALUES("20","30","Pagamento do Salário do mês de 03/2021 do funcionario:  Zulmira Barbosa ","salario","12000","25847","2021-03-22 12:14:29","1","2","Dinheiro");
INSERT INTO saidas VALUES("22","30","compra do mata-bicho de hoje","Alimentação","6000","500","2021-03-30 07:29:57","5","2","Dinheiro");
INSERT INTO saidas VALUES("24","30","Pagamento do Salário do mês de 04/2021 do funcionario:  Zulmira Barbosa ","salario","25000","1260","2021-04-05 01:01:04","1","2","Dinheiro");
INSERT INTO saidas VALUES("25","30","Pagamento do Salário do mês de 04/2021 do funcionario:  Simão Baptista Pedro  ","salario","10000","31546","2021-04-05 01:01:40","1","2","Dinheiro");
INSERT INTO saidas VALUES("26","30","Pagamento do Salário do mês de 04/2021 do funcionario:  Marcelina Francisco Garcia ","salario","17000","5712","2021-04-05 01:11:07","1","2","Dinheiro");
INSERT INTO saidas VALUES("29","30","Pagamento do Salário do mês de 04/2021 do funcionario:  Milguel Vela Caiombo ","salario","6000","0","2021-04-05 01:59:20","1","2","Dinheiro");
INSERT INTO saidas VALUES("30","30","Pagamento do Salário do mês de 04/2021 do funcionario:  Marcelina Francisco Garcia ","salario","5000","2712","2021-04-05 02:00:16","1","2","Dinheiro");
INSERT INTO saidas VALUES("31","30","Pagamento do Salário do mês de 04/2021 do funcionario:  Daniel Pablo  ","salario","27000","280","2021-04-05 02:00:56","1","2","Dinheiro");
INSERT INTO saidas VALUES("32","30","pagamento da energia","Energia","5000","0","2021-04-06 11:54:40","2","2","Dinheiro");
INSERT INTO saidas VALUES("33","30","Compra do Almoço","Alimentação","4500","800","2021-04-08 07:34:25","5","2","Dinheiro");
INSERT INTO saidas VALUES("34","1","compra do Almoço","Alimentação","1200","0","2021-08-06 11:22:55","5","2","Dinheiro");
INSERT INTO saidas VALUES("35","1","compra do Almoço","Alimentação","1400","0","2021-08-08 05:38:33","5","2","Dinheiro");
INSERT INTO saidas VALUES("36","1","energia","Energia","12000","0","2021-08-13 10:43:20","2","2","Dinheiro");
INSERT INTO saidas VALUES("37","30","compra do Almoço","Alimentação","1200","400","2021-09-02 10:47:31","5","2","Dinheiro");
INSERT INTO saidas VALUES("38","1","comprou bolacha","Gastos Exporâticos","350","50","2021-09-02 17:57:06","3","2","Dinheiro");
INSERT INTO saidas VALUES("40","1","pagamento da energia","Energia","1200","500","2021-09-03 10:41:16","2","2","Dinheiro");
INSERT INTO saidas VALUES("41","1","compra de bolacha","Gastos Exporâticos","450","50","2021-09-03 10:41:44","3","2","Dinheiro");
INSERT INTO saidas VALUES("42","1","Pagamento do Alugueres","Aluguer","5000","4600","2021-09-03 10:42:06","4","2","Dinheiro");
INSERT INTO saidas VALUES("43","31","compra do Almoço","Alimentação","1200","450","2021-09-07 06:57:45","5","2","Dinheiro");
INSERT INTO saidas VALUES("44","31","compra do Almoço","Alimentação","700","0","2021-09-09 14:51:17","5","2","Dinheiro");
INSERT INTO saidas VALUES("45","31","compra do Almoço","Alimentação","700","0","2021-09-09 14:51:19","5","2","Dinheiro");
INSERT INTO saidas VALUES("46","31","Compra de quadro","Gastos Exporâticos","3000","0","2021-11-05 12:00:06","3","1","Dinheiro");
INSERT INTO saidas VALUES("47","31","compra almoço","Alimentação","7000","0","2021-11-07 00:06:18","5","2","Dinheiro");
INSERT INTO saidas VALUES("48","31","doando aroosz","Gastos Exporâticos","200","0","2021-11-07 00:13:19","3","2","Dinheiro");
INSERT INTO saidas VALUES("49","31","Pagamento do Salário do mês de 11/2021 do funcionario:  Fernandas Paula da Silva ","salario","3500","500","2021-11-07 00:20:43","1","2","Dinheiro");
INSERT INTO saidas VALUES("50","31","para sr. davide","Empréstimos","4500","0","2021-11-07 00:27:29","6","2","Dinheiro");
INSERT INTO saidas VALUES("51","31","compra almoço","Alimentação","1400","0","2021-11-08 17:06:17","5","2","Multicaixa Express");
INSERT INTO saidas VALUES("52","31","Pagamento do Salário do mês de 11/2021 do funcionario:  Walter Gonga Pedro ","salario","3500","500","2021-11-08 17:14:52","1","2","Dinheiro");
INSERT INTO saidas VALUES("53","31","Pagamento do Salário do mês de 11/2021 do funcionario:  Simão Pedro ","salario","1800","700","2021-11-08 17:16:06","1","2","BAI");
INSERT INTO saidas VALUES("54","31","doando aroosz","Alimentação","400","0","2021-11-15 10:11:45","5","2","BIC");
INSERT INTO saidas VALUES("55","31","doando pao","Alimentação","4000","0","2025-11-15 10:12:38","5","1","Multicaixa Express");



DROP TABLE IF EXISTS salario;

CREATE TABLE `salario` (
  `idsalario` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` int(11) NOT NULL,
  `ano` int(4) DEFAULT NULL,
  `mes` int(2) DEFAULT NULL,
  `faltas` int(3) NOT NULL DEFAULT '0',
  `horastrabalhadas` int(11) DEFAULT NULL,
  `salarioactualporhora` double DEFAULT '0',
  `salarioactualbase` double NOT NULL DEFAULT '0',
  `salariobruto` double NOT NULL DEFAULT '0',
  `horasextras` int(11) DEFAULT NULL,
  `valorextra` double DEFAULT NULL,
  `abonodefamilia` double NOT NULL DEFAULT '0',
  `subsidiodeferias` double NOT NULL DEFAULT '0',
  `subsidiodenatal` double NOT NULL DEFAULT '0',
  `segurancasocial` double NOT NULL DEFAULT '0',
  `valorporreceber` double DEFAULT NULL,
  `irt` double DEFAULT NULL,
  `valorrecebido` double DEFAULT NULL,
  `formapagamento` varchar(130) DEFAULT NULL,
  `obs` text,
  `datadepagamento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idnasaida` int(11) NOT NULL,
  `outrosdescontos` double NOT NULL DEFAULT '0',
  `idposto` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`idsalario`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO salario VALUES("23","28","2020","7","0","56","500","0","0","0","0","0","0","0","0","19200","0","15000","BAI","","2020-07-23 05:51:50","44","0","-1");
INSERT INTO salario VALUES("24","29","2020","6","0","30","800","0","0","14","5600","0","0","0","0","12000","0","12000","BAI","","2020-06-25 06:02:08","46","0","-1");
INSERT INTO salario VALUES("25","30","2021","3","0","48","500","85.5","32500","17","8500","12000","5","0","10","37847","10","12000","Multicaixa Express","outra parte daremos próximo mês","2021-03-22 12:14:30","20","0","-1");
INSERT INTO salario VALUES("27","30","2021","4","0","48","500","85.5","24000","0","0","5000","0","0","6","26260","0","25000","BIC","","2021-04-05 01:01:04","24","1000","-1");
INSERT INTO salario VALUES("28","34","2021","4","0","40","1.136","150","45440","0","0","9000","0","0","5","41546","10","10000","","","2021-04-05 01:01:40","25","5000","-1");
INSERT INTO salario VALUES("29","39","2021","4","0","32","241","52","7712","0","0","15000","0","0","0","22712","0","17000","","","2021-04-05 01:11:07","26","0","-1");
INSERT INTO salario VALUES("31","40","2021","4","0","0","341","60000","0","0","0","6000","0","0","0","6000","0","6000","","","2021-04-05 01:59:20","28","0","0");
INSERT INTO salario VALUES("32","39","2021","4","0","32","241","52000","7712","0","0","0","0","0","0","7712","0","5000","","","2021-04-05 02:00:16","30","0","0");
INSERT INTO salario VALUES("33","32","2021","4","0","40","682","120000","27280","0","0","0","0","0","0","27280","0","27000","","","2021-04-05 02:00:56","31","0","12");
INSERT INTO salario VALUES("34","29","2021","11","0","0","5","800","0","0","0","4000","0","0","0","4000","0","3500","","","2021-11-07 00:20:43","49","0","0");
INSERT INTO salario VALUES("35","1","2021","11","0","0","3","500","0","0","0","4000","0","0","0","4000","0","3500","Multicaixa Express","","2021-11-08 17:14:52","52","0","0");
INSERT INTO salario VALUES("36","27","2021","11","0","0","230","600","0","0","0","2500","0","0","0","2500","0","1800","BAI","","2021-11-08 17:16:06","53","0","0");



DROP TABLE IF EXISTS salas;

CREATE TABLE `salas` (
  `idsala` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`idsala`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO salas VALUES("1","1");
INSERT INTO salas VALUES("2","2");
INSERT INTO salas VALUES("3","3");
INSERT INTO salas VALUES("4","4");
INSERT INTO salas VALUES("5","5");
INSERT INTO salas VALUES("6","6");
INSERT INTO salas VALUES("7","7");
INSERT INTO salas VALUES("8","8");



DROP TABLE IF EXISTS stock;

CREATE TABLE `stock` (
  `idstock` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) NOT NULL,
  `precodevenda` double NOT NULL DEFAULT '0',
  `precodecompra` double NOT NULL DEFAULT '0',
  `quantidade` int(8) NOT NULL DEFAULT '0',
  `datadecadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idstock`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO stock VALUES("8","29","100","800","60","2020-10-26 09:16:32");
INSERT INTO stock VALUES("9","28","12000","700","5","2020-10-26 16:27:05");
INSERT INTO stock VALUES("10","28","12000","700","5","2020-10-26 16:29:08");
INSERT INTO stock VALUES("11","26","900","600","50","2021-01-13 16:31:50");
INSERT INTO stock VALUES("12","29","900","400","38","2021-01-13 16:33:41");
INSERT INTO stock VALUES("13","25","1200","500","120","2021-01-13 16:34:06");
INSERT INTO stock VALUES("14","768","5000","4500","22","2021-08-11 09:44:38");
INSERT INTO stock VALUES("15","767","2000","500","4","2021-08-11 10:02:10");
INSERT INTO stock VALUES("16","767","2000","500","4","2021-08-11 10:02:10");
INSERT INTO stock VALUES("17","769","3400","1200","9","2021-08-17 22:06:38");
INSERT INTO stock VALUES("18","769","3400","1200","-2","2021-09-02 06:10:54");



DROP TABLE IF EXISTS tipodedisciplinas;

CREATE TABLE `tipodedisciplinas` (
  `idtipodedisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `abreviatura` varchar(20) DEFAULT NULL,
  `tipodedisciplina` varchar(220) NOT NULL DEFAULT 'Normal',
  `agrupamento` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idtipodedisciplina`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO tipodedisciplinas VALUES("1","Matemática","MAT","Normal","Formação Geral");
INSERT INTO tipodedisciplinas VALUES("2","Física","FIS","Chave","Formação Geral");
INSERT INTO tipodedisciplinas VALUES("3","Biologia","BIO","Chave","Formação Específica");
INSERT INTO tipodedisciplinas VALUES("4","Química","QUIM","Normal","Formação Específica");
INSERT INTO tipodedisciplinas VALUES("5","Inglês","ING","Normal","Opção");
INSERT INTO tipodedisciplinas VALUES("6","Educação Física","Ed. Física","Normal","Formação Geral");



DROP TABLE IF EXISTS tipodesaidas;

CREATE TABLE `tipodesaidas` (
  `idtipodesaida` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(220) NOT NULL,
  `categoria` varchar(200) NOT NULL DEFAULT 'Custos Variados',
  `numerodesaida` int(11) NOT NULL DEFAULT '0',
  `valorlimite` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipodesaida`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO tipodesaidas VALUES("1","Salário","Gastos com o Pessoal","0","500000");
INSERT INTO tipodesaidas VALUES("2","Energia","Custos Variados","4","8000");
INSERT INTO tipodesaidas VALUES("3","Gastos Exporâticos","Outros","6","45000");
INSERT INTO tipodesaidas VALUES("4","Aluguer","Custos Variados","1","12000");
INSERT INTO tipodesaidas VALUES("5","Alimentação","Custos Variados","18","100000");
INSERT INTO tipodesaidas VALUES("6","Empréstimos","Gastos com o Pessoal","1","50000");



DROP TABLE IF EXISTS tiposdenotas;

CREATE TABLE `tiposdenotas` (
  `idtipodenota` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `valormaximo` double NOT NULL DEFAULT '20',
  `valorminimo` double NOT NULL DEFAULT '0',
  `minimoparapositiva` double NOT NULL DEFAULT '10',
  `percentagemnotrimestre` double NOT NULL DEFAULT '0.5',
  `posicao` int(2) NOT NULL DEFAULT '1',
  `especial` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipodenota`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO tiposdenotas VALUES("1","MAC","0","1","20","0","10","0.5","1","0");
INSERT INTO tiposdenotas VALUES("2","CPP","0","1","20","0","10","0.5","2","0");
INSERT INTO tiposdenotas VALUES("3","MAC","0","2","20","0","10","0.5","3","0");
INSERT INTO tiposdenotas VALUES("4","CPP","0","2","20","0","10","0.5","4","0");
INSERT INTO tiposdenotas VALUES("5","MAC","0","3","20","0","10","0.5","5","0");
INSERT INTO tiposdenotas VALUES("6","CPP","0","3","20","0","10","0.5","6","0");
INSERT INTO tiposdenotas VALUES("9","CPP","0","7","20","0","10","0.5","2","0");
INSERT INTO tiposdenotas VALUES("10","MAC","0","6","20","0","10","0.5","1","0");
INSERT INTO tiposdenotas VALUES("11","CPP","0","6","20","0","10","0.5","2","0");
INSERT INTO tiposdenotas VALUES("12","MAC","0","5","20","0","10","0.5","1","0");
INSERT INTO tiposdenotas VALUES("13","CPP","0","5","20","0","10","0.5","2","0");
INSERT INTO tiposdenotas VALUES("15","CPE","2","0","20","0","10","0.6","1","1");
INSERT INTO tiposdenotas VALUES("16","NER","2","0","20","0","10","1","2","1");



DROP TABLE IF EXISTS trimestres;

CREATE TABLE `trimestres` (
  `idtrimestre` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  `numerodenotas` int(4) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `nomedamedia` varchar(6) NOT NULL,
  `arredondarmedia` int(1) NOT NULL DEFAULT '2',
  `percentagemnoanolectivo` double NOT NULL DEFAULT '0.33',
  `posicao` int(1) NOT NULL,
  PRIMARY KEY (`idtrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO trimestres VALUES("1","Iº","2","2","CT1","2","0.33","1");
INSERT INTO trimestres VALUES("2","IIº","2","2","CT2","2","0.33","2");
INSERT INTO trimestres VALUES("3","IIIº","2","2","CT3","2","0.33","3");
INSERT INTO trimestres VALUES("5","Iº","2","1","CT1","2","0.33","1");
INSERT INTO trimestres VALUES("6","IIº","2","1","CT2","2","0.33","2");
INSERT INTO trimestres VALUES("7","IIIº","2","1","CT3","2","0.33","3");
INSERT INTO trimestres VALUES("8","Iº","2","3","CT1","2","0.33","1");
INSERT INTO trimestres VALUES("9","IIº","2","3","CT2","2","0.33","2");
INSERT INTO trimestres VALUES("10","IIIº","2","3","CT3","0","0.33","3");



DROP TABLE IF EXISTS turmas;

CREATE TABLE `turmas` (
  `idturma` int(11) NOT NULL AUTO_INCREMENT,
  `idanolectivo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `idperiodo` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `idsala` int(11) NOT NULL,
  `idclasse` int(11) NOT NULL,
  `propina` double NOT NULL DEFAULT '0',
  `reconfirmacao` double NOT NULL DEFAULT '0',
  `matricula` double NOT NULL DEFAULT '0',
  `eclassedeexame` varchar(11) NOT NULL DEFAULT 'Não',
  `classificacaopositiva` varchar(50) NOT NULL DEFAULT 'Apto',
  `classificacaonegativa` varchar(50) NOT NULL DEFAULT 'Não Apto',
  PRIMARY KEY (`idturma`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO turmas VALUES("2","2","3A","1","2","3","2","9000","3000","2000","Não","Apto","Não Apto");
INSERT INTO turmas VALUES("3","1","1B","1","1","2","1","1200","1200","14000","Não","Apto","Não Apto");
INSERT INTO turmas VALUES("4","2","12B","1","5","8","2","2300","4500","4500","Sim","Apto","Não Apto");
INSERT INTO turmas VALUES("5","2","10INF","4","5","8","12","5000","1200","1200","Não","Apto","Não Apto");
INSERT INTO turmas VALUES("6","2","4A","1","1","2","6","1900","5500","3000","Não","Apto","Não Apto");
INSERT INTO turmas VALUES("7","2","12ENF","2","4","8","2","1300","4500","6800","Sim","Apto","Não Apto");
INSERT INTO turmas VALUES("8","2","11ENF","4","4","6","13","2000","3500","1200","Não","Apto","Não Apto");
INSERT INTO turmas VALUES("9","2","13INF","1","5","2","14","4000","2300","1900","Sim","Apto","Não Apto");
INSERT INTO turmas VALUES("10","2","10CEJ","2","3","4","12","1300","1250","4500","Não","Transita","N/ Transita");
INSERT INTO turmas VALUES("11","2","11CEJ","2","3","2","13","4500","1500","4500","Não","Apto","Não Apto");
INSERT INTO turmas VALUES("13","2","10CFB","2","2","4","12","5000","4500","14000","Não","Apto","Não Apto");
INSERT INTO turmas VALUES("14","1","6B","4","1","4","8","1200","4500","3000","Não","Apto","Não Apto");
INSERT INTO turmas VALUES("15","1","13CFB","2","2","5","14","8500","3000","2000","Sim","Apto","Não Apto");
INSERT INTO turmas VALUES("16","2","9A","2","1","8","11","4600","1200","4500","Sim","Apto","Não Apto");
INSERT INTO turmas VALUES("17","2","6B","2","1","8","8","3500","4500","1200","Sim","Apto","Não Apto");
INSERT INTO turmas VALUES("18","2","8A","2","1","6","10","8500","1500","2000","Não","Apto","Não Apto");
INSERT INTO turmas VALUES("19","2","7A","2","1","8","9","4600","1250","3000","Não","Apto","Não Apto");
INSERT INTO turmas VALUES("20","2","2A","1","1","8","4","4600","1250","1900","Sim","Apto","Não Apto");
INSERT INTO turmas VALUES("21","2","11CFB","2","2","8","13","4600","1500","6800","Não","Transita","N/ Transita");
INSERT INTO turmas VALUES("22","3","1A2019","2","1","8","1","2000","6000","1000","Não","Transita","N/ Transita");



