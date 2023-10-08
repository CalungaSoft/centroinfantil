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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO administradores VALUES("2","32","funcionario","daniele","$2y$10$4Qpp2Nl/CJa5VauOjpIP7uI/XQf7CGwERe6XWiYmD1GZYVAR1FufO","bloqueado","2021-03-10 12:34:17","2021-03-10 12:44:24");
INSERT INTO administradores VALUES("5","1","administrador","walter","$2y$10$/vs6S2TtT5yhlIZ1kZRHEOMZbTsVQziHg9XtCOWCHCLMSWQ8YyGp.","desbloqueado","2021-09-02 17:56:43","0000-00-00 00:00:00");
INSERT INTO administradores VALUES("6","31","administrador","123","$2y$10$s1Mzav7O2BnS4G6SVnWlleb88zDHL8MoLhc8B71ZpeBF.Vywy5IjC","desbloqueado","2022-03-25 16:19:31","2022-03-17 13:39:33");
INSERT INTO administradores VALUES("7","32","professor","777","$2y$10$nIswDKD0nPg7sNQ1SY/hhetRyXRLkzvwL0oqYDpc4owdpN8KlbdtC","desbloqueado","2021-12-21 04:35:13","2021-12-21 04:35:54");
INSERT INTO administradores VALUES("8","34","professor","professor","$2y$10$8uI2K4sTZoDWlfF0P91QRuS2z8QFmUeiFCQPX29QkHShq4VCSmDQm","desbloqueado","2022-03-17 13:35:48","2022-03-17 13:38:13");
INSERT INTO administradores VALUES("9","9","secretaria1","secretario1","$2y$10$4yE3WfTB7UWm8JqdaqAsNeEjkpb6.6stimA8/Njs5zc.72uN1Ra3O","desbloqueado","2022-03-17 14:57:28","2022-03-17 13:31:56");
INSERT INTO administradores VALUES("10","40","secretaria2","secretario2","$2y$10$VMB.Eqwsnw1FV3DURT0FS.B9PY4/I5cLbutKqI1xCw4Z8qb80Qsau","desbloqueado","2022-03-17 13:32:04","2022-03-17 13:32:14");
INSERT INTO administradores VALUES("11","42","areapedagogica","areapedagogica","$2y$10$qjpiyaUCT9eBktIBaJ9iJOHQ2Fovy99buNcx7ANoZdg9MruHemfA6","desbloqueado","2022-03-17 13:32:26","2022-03-17 13:33:13");
INSERT INTO administradores VALUES("12","30","professor","professora","$2y$10$6y6wT1omhMJKHcx0W8eBEOhIdDHey7KqPhjPDqALneDprMrncVvF2","desbloqueado","2022-01-16 09:36:23","2022-01-16 09:37:47");



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS alunos;

CREATE TABLE `alunos` (
  `idaluno` int(11) NOT NULL AUTO_INCREMENT,
  `nomecompleto` varchar(200) NOT NULL,
  `sexo` varchar(20) DEFAULT 'Masculino',
  `nomedopai` varchar(200) DEFAULT NULL,
  `nomedamae` varchar(220) DEFAULT NULL,
  `naturalidade` varchar(200) DEFAULT 'Luanda',
  `nacionalidade` varchar(220) NOT NULL DEFAULT 'Angolana',
  `provincia` varchar(220) DEFAULT 'Luanda',
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
) ENGINE=InnoDB AUTO_INCREMENT=1089 DEFAULT CHARSET=utf8;

INSERT INTO alunos VALUES("1","Aida de Rosália da C. Mariano","Masculino","José Mariano T. Duarte","Maria da Conceição","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923365659/923943484","923365659/923943484","","","0","2003-02-09","0000-00-00","ARS720","Sapú II","","José Mariano T. Duarte","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("2","Domingas Jambela Taca","Masculino","Felisberto Taca","Maria Rosalina A. Cafuta","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949009155","949009155","","","0","2001-06-12","0000-00-00","ARS664","Jacinto Tchipa","","Felisberto Taca","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("3","Evandro Cláudio Gomes Texeira","Masculino","Romão José M. Texeira","Rita C.G.Joaquim","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921296122","921296122","","","0","2003-08-18","0000-00-00","ARS879","Jacinto Tchipa","","Romão José M. Texeira","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("4","Fernando Calenga Gonga Nambalo","Masculino","Agostinho Domingos Nambalo","Balbina Jamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923953121","923953121","","","0","1999-04-27","0000-00-00","ARS659","Sapú II","","Agostinho Domingos Nambalo","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("5","Geoménia Quicala André da Costa","Masculino","Carlos João Quicala","Filomena Albino A. Dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926361742/927585826","926361742/927585826","","","0","2003-12-24","0000-00-00","ARS186","Jacinto Tchipa","","Carlos João Quicala","2021-08-04 00:00:00","activo","2021-08-04");
INSERT INTO alunos VALUES("6","Guilherme dos Santos Kimaz","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS570","Jacinto Tchipa","","","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("7","Helena Joaquim de Lemos ","Masculino","Luis Francisco Boas de Lemos","Joana Anónio Cassule Zombo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949301952/926146036","949301952/926146036","","","0","1996-03-03","0000-00-00","ARS188","Jacinto Tchipa","","Luis Francisco Boas de Lemos","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("8","Iracelma Madalena Luzembo Capitão","Masculino","Angelo António Capitão","Filomena Miguel Luzembo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938311014/932677209","938311014/932677209","","","0","2005-03-06","0000-00-00","ARS711","Sapú II","","Angelo António Capitão","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("9","Irene Ventura da Rocha","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1075","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("10","Isabel Cudiceta Dala","Masculino","Carlos Augusto B. Dala","Cecília Marcelino N. Cudiceta","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949302829/945876627","949302829/945876627","","","0","2002-04-01","0000-00-00","ARS64","Jacinto Tchipa","","Carlos Augusto B. Dala","2021-07-19 00:00:00","activo","2021-07-19");
INSERT INTO alunos VALUES("11","Jandira de Fatima Benza","Masculino","..................","Maria de Fatima Agostinho Benza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924233314","924233314","","","0","2003-06-15","0000-00-00","ARS417","Bita Vacaria","","..................","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("12","Lucau Armando Candumbo","Masculino","Alberto Camdumbo","Franncelina V. Armando","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927160146","927160146","","","0","2002-09-14","0000-00-00","ARS777","Jacinto Tchipa","","Alberto Camdumbo","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("13","Luquenio P. De Azevedo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS978","","","","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("14","Manuel Catala Paulo","Masculino","Paulo Ngolomoni","Viviana Mucuta Catala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932699437/996661901","932699437/996661901","","","0","2004-01-02","0000-00-00","ARS139","Jacinto Tchipa","","Paulo Ngolomoni","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("15","Manuel Mendes Pimenta ","Masculino","Helder de Jesus Pimenta","Angelica F. D. Mendes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933460301/912253366","933460301/912253366","","","0","2000-06-16","0000-00-00","ARS189","Sequele","","Helder de Jesus Pimenta","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("16","Marinela José dos Santos","Masculino","José Luis Casso Joaquim","Marcelina J. Dos Anjos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923266996","923266996","","","0","2000-06-24","0000-00-00","ARS906","Belo Horizonte","","José Luis Casso Joaquim","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("17","Rivaldo Amado Jorge Nsungo","Masculino","Marcos Ambrosio P. Nsungo","Igueth Avimpi A. Jorge","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928697363","928697363","","","0","2005-04-17","0000-00-00","ARS880","Jacinto Tchipa","","Marcos Ambrosio P. Nsungo","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("18","Rosa Lourenço Zatula","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS895","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("19","Ruth Alexandre Manta José","Masculino","Joaquim Sebastião José","Luisa Alfredo Mantas","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","946195016","946195016","","","0","2003-07-07","0000-00-00","ARS550","Golf 1","","Joaquim Sebastião José","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("20","Simão Victor da Costa Benjamim","Masculino","Costa Benjamim","Rosa Bamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937776410","937776410","","","0","1999-01-01","0000-00-00","ARS805","Sapú II","","Costa Benjamim","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("21","Tomás Lukoki José","Masculino","António Lukoki","Lando Mambo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","941738335/925471835","941738335/925471835","","","0","1999-03-20","0000-00-00","ARS788","Jacinto Tchipa","","António Lukoki","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("22","Fernando Ndongo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1089","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("23","Alice Maria da Silva","Masculino","António Augusto da Silva","Feliciana de Fatima","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930454757","930454757","","","0","2002-04-07","0000-00-00","ARS833","Jacinto Tchipa","","António Augusto da Silva","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("24","Aminata da Costa Jobe","Masculino","Mário Jobe","_______","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937289111","937289111","","","0","2001-10-25","0000-00-00","ARS26","Jacinto Tchipa","","Mário Jobe","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("25","Anibal Suafaleni Tchitue Tuleni","Masculino","Joel Tuleni","Cristina Frederico","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","940360647","940360647","","","0","2000-07-02","0000-00-00","ARS968","Inbondeiro Sul","","Joel Tuleni","2021-09-30 00:00:00","activo","2021-09-30");
INSERT INTO alunos VALUES("26","Braulio Gomes Luis","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS986","","","","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("27","Celestino João A. Domingos ","Masculino","João Francisco Domingos","Margarida Moises André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929759245","929759245","","","0","1998-01-04","0000-00-00","ARS820","Jacinto Tchipa","","João Francisco Domingos","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("28","Domingos do Carmo Paulo","Masculino","Vicente Pedro Mafani Paulo","Amélia Franscisco do Carmo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925278480","925278480","","","0","2001-01-16","0000-00-00","ARS52","Belo Horizonte","","Vicente Pedro Mafani Paulo","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("29","Edvânio Manuel da C. Van-Dúnem","Masculino","Erlander Jacinto C. Van-Dúnem","Eduarda Manuel d S. Vicente","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923695078/930413798","923695078/930413798","","","0","2002-03-21","0000-00-00","ARS75","Jacinto Tchipa","","Erlander Jacinto C. Van-Dúnem","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("30","Ester Patricia Fernandes Ramalhoso","Masculino","Emanuel Ramalhoso","Domingas Magalhães Ramalhoso","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","941154750","941154750","","","0","2003-03-25","0000-00-00","ARS653","Bita Vacaria","","Emanuel Ramalhoso","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("31","Fátima José Pinto","Masculino","João Joaquim Pinto","Victoória Dinis Pinto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923620868/923805074","923620868/923805074","","","0","2003-04-06","0000-00-00","ARS729","Jacinto Tchipa","","João Joaquim Pinto","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("32","Geraldo Bandeira Katwe","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS840","","","","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("33","Guilherme K. Polo Mateus","Masculino","Andrade Pedro P. Mateus","Zingo Nazaré","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936770734","936770734","","","0","1997-11-21","0000-00-00","ARS804","Sapú II","","Andrade Pedro P. Mateus","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("34","Inês Graneira Zamba","Masculino","Faustino Fernandes Zamba","Isabel Fernando Graneira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921262059","921262059","","","0","2002-05-13","0000-00-00","ARS1010","Jacinto Tchipa","","Faustino Fernandes Zamba","2021-10-07 00:00:00","activo","2021-10-07");
INSERT INTO alunos VALUES("35","José Alberto Kalielie","Masculino","Alberto Tchimoneca","Teresa Júlia Namusinga Kalielie","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930334781","930334781","","","0","2000-01-17","0000-00-00","ARS549","Belo Horizonte","","Alberto Tchimoneca","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("36","Josué Venceslau David Tavares","Masculino","Venceslau Tavares Cristovão","Josefa Maria David","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925406204","925406204","","","0","1999-06-14","0000-00-00","ARS691","Sapú II","","Venceslau Tavares Cristovão","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("37","Júlio Diogo da Costa ","Masculino","João Manuel da Costa ","Teresa Gaspar Diogo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","993819762/944481037","993819762/944481037","","","0","2001-01-12","0000-00-00","ARS557","Belo Horizonte","","João Manuel da Costa ","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("38","Leandro  Matenga Caetano","Masculino","João Domingos Caetano","Beatriz João M. Ginga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925747799","925747799","","","0","2001-12-14","0000-00-00","ARS1048","Boa Esperança","","João Domingos Caetano","2021-10-22 00:00:00","activo","2021-10-22");
INSERT INTO alunos VALUES("39","Luana Claire da Silva Bento","Masculino","Eduardo José Bento","Edith Amélia da Silva Bento","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924528416/921781119","924528416/921781119","","","0","1997-10-20","0000-00-00","ARS229","Sapú II","","Eduardo José Bento","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("40","Mariza Cauto da Costa","Masculino","José António C. Da Costa","Juduth Neto Cauto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923414090","923414090","","","0","2001-07-18","0000-00-00","ARS992","Bita Vacaria","","José António C. Da Costa","2021-10-05 00:00:00","activo","2021-10-05");
INSERT INTO alunos VALUES("41","Miguel Xando João","Masculino","Silva Domingos F. João","Ruth Francisco Xando","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924414874","924414874","","","0","2002-02-24","0000-00-00","ARS811","","","Silva Domingos F. João","2021-09-09 00:00:00","activo","2021-09-09");
INSERT INTO alunos VALUES("42","Nayobe Moreira Pedro","Masculino","Rui Gaspar da Costa Pedro","Sulana de Rosário L. Moreira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947089617/923441228","947089617/923441228","","","0","2002-10-05","0000-00-00","ARS133","Bita Vacaria","","Rui Gaspar da Costa Pedro","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("43","Paulo Pedro Mpaque","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS931","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("44","Samaritania Patricia Adão Francisco","Masculino","Tavares António Francisco","Esperança E. F. A. Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932342539","932342539","","","0","2000-01-08","0000-00-00","ARS363","Sapú II","","Tavares António Francisco","2021-08-17 00:00:00","activo","2021-08-17");
INSERT INTO alunos VALUES("45","Sandra João Martins","Masculino","Domingos Monteiro M. Salvador","Juliana Francisco João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923434303","923434303","","","0","2001-10-17","0000-00-00","ARS400","Jacinto Tchipa","","Domingos Monteiro M. Salvador","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("46","Suzana Domingas C. Quissebele","Masculino","Zeca Quissebele","Domingas Quissunge Cadiango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927405323","927405323","","","0","2004-09-11","0000-00-00","ARS381","Jacinto Tchipa","","Zeca Quissebele","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("47","Vanilson Pedro Rufino Francisco","Masculino","Pedro Domingos B. Francisco","Marcelina da Costa Rufino","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923788472/933791338","923788472/933791338","","","0","2002-08-26","0000-00-00","ARS140","Jacinto Tchipa","","Pedro Domingos B. Francisco","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("48","Ventura London Chavuma","Masculino","António Boás Chamavu","Masse Londoni Mussumali","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944997001","944997001","","","0","2000-08-10","0000-00-00","ARS394","Jacinto Tchipa","","António Boás Chamavu","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("49","Zicrina Crisitina Simão","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS815","","","","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("50","Abiud David Jones","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS932","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("51","Alberto Mariano Lopes","Masculino","Mariano Lopes","Catarina Paula Chimbundi","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924172684/926598950","924172684/926598950","","","0","1999-08-28","0000-00-00","ARS1063","Bequessa","","Mariano Lopes","2021-11-05 00:00:00","activo","2021-11-05");
INSERT INTO alunos VALUES("52","Anderson João Bento","Masculino","Mário Augusto Bento","Teresa Massanga João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945061194","945061194","","","0","2001-01-04","0000-00-00","ARS543","Jacinto Tchipa","","Mário Augusto Bento","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("53","Eduardo Jomba Keta","Masculino","Passo Jaime Keta","Helena Garcia Jomba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927755811","927755811","","","0","1999-12-19","0000-00-00","ARS948","Belo Horizonte","","Passo Jaime Keta","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("54","Edvânio Domingos Tchimoneca","Masculino","Alberto Tchimoneca","Teresa Caetano Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945993457","945993457","","","0","2002-02-10","0000-00-00","ARS933","Belo Horizonte","","Alberto Tchimoneca","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("55","Euclides Luciano Mussole","Masculino","Luciano Mussole","Sara da Conceição","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926584122","926584122","","","0","2005-08-04","0000-00-00","ARS934","Sapú II","","Luciano Mussole","2021-09-22 00:00:00","activo","2021-09-22");
INSERT INTO alunos VALUES("56","Evânio Segundo Lopes ","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS114","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("57","Filipe José","Masculino",".......................","Avelina Chulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934580719/935587285","934580719/935587285","","","0","2004-11-12","0000-00-00","ARS95","Jacinto Tchipa","",".......................","2021-07-23 00:00:00","activo","2021-07-23");
INSERT INTO alunos VALUES("58","Helena Domingos Jose ","Masculino","João José Gasolina","Teresa Domingos ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","935922606","935922606","","","0","2020-10-04","0000-00-00","ARS1059","Sapú II","","João José Gasolina","2021-11-05 00:00:00","activo","2021-11-05");
INSERT INTO alunos VALUES("59","Manuel Cubuca Gonga","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1039","","","","2021-10-08 00:00:00","activo","2021-10-08");
INSERT INTO alunos VALUES("60","Margarida Nguya Fernado","Masculino","Domingos Fernando","Rosa Verónica","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925348958","925348958","","","0","2004-10-13","0000-00-00","ARS97","Cinquentinha","","Domingos Fernando","2021-07-26 00:00:00","activo","2021-07-26");
INSERT INTO alunos VALUES("61","Miranda da C. Dos Santos","Masculino","António Ebo Manuel","Sónia António da Conceição","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","9240222345","9240222345","","","0","2004-09-20","0000-00-00","ARS980","Jacinto Tchipa","","António Ebo Manuel","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("62","Naide Paloma Amaral","Masculino","Fernando Silva do Amaral","Maria Isabel Segunda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924022238","924022238","","","0","2006-05-17","0000-00-00","ARS979","Jacinto Tchipa","","Fernando Silva do Amaral","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("63","Pedro Maria João","Masculino","Samuel João Matadi","Maria Alfa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936726553","936726553","","","0","2003-04-27","0000-00-00","ARS1020","Sapú II","","Samuel João Matadi","2021-10-06 00:00:00","activo","2021-10-06");
INSERT INTO alunos VALUES("64","Samuel Mulundo Marques","Masculino","Josué Sopa de Almeida Marques","Zinha Ihuca Mulundo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937776410","937776410","","","0","1999-05-02","0000-00-00","ARS683","Cacuaco","","Josué Sopa de Almeida Marques","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("65","Sandra Ana Caindo Fernando","Masculino","Carlos Fernando","Ana Hebo Caindo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937271978","937271978","","","0","2003-06-30","0000-00-00","ARS920","Sapú II","","Carlos Fernando","2021-07-21 00:00:00","activo","2021-07-21");
INSERT INTO alunos VALUES("66","André Dinis Txau João","Masculino","Makanda João","Munengue Txau","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2001-03-07","0000-00-00","ARS789","","","Makanda João","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("67","Carolina João Samuel","Masculino","Paulo João Kiala","Teresa Samuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926285036","926285036","","","0","2003-10-06","0000-00-00","ARS817","","","Paulo João Kiala","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("68","Délcia Rossana M. Benjamim ","Masculino","Francisco Manuel Benjamim","Irene dos Anjos Massy","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931258020","931258020","","","0","2003-03-20","0000-00-00","ARS892","Rangel","","Francisco Manuel Benjamim","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("69","Eliseu Domingos Lucala","Masculino","Domingos Lucala","Romana Bartolomeu","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925345248","925345248","","","0","2001-10-22","0000-00-00","ARS665","Belo Horizonte","","Domingos Lucala","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("70","Francisca Cândido António","Masculino","Manuel Domingos António","Victória Rodrigues C. Cândido","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923959280","923959280","","","0","2004-11-12","0000-00-00","ARS279","Sapú II","","Manuel Domingos António","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("71","Grinaldi de Carvalho Camões","Masculino","Alcides Costa Bravo da Rosa","Eva Domingos de Carvalho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2005-05-28","0000-00-00","ARS194","Sapú II","","Alcides Costa Bravo da Rosa","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("72","João Manuel Albano José","Masculino","Manuel José Cangundo","Luzia Luis Albano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2001-12-14","0000-00-00","ARS1078","Luanda Sul","","Manuel José Cangundo","2021-10-05 00:00:00","activo","2021-10-05");
INSERT INTO alunos VALUES("73","Manuel Domingos José","Masculino","Domigos José Sonde","Conceição José Mussumbo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947350810/924030693","947350810/924030693","","","0","2001-05-20","0000-00-00","ARS562","Madeira","","Domigos José Sonde","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("74","Maria Gonga Gerónimo","Masculino","Adriano Manuel Gerónimo","Eva António Gonga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2001-06-06","0000-00-00","ARS952","Jacinto Tchipa","","Adriano Manuel Gerónimo","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("75","Michel Txibi T. Culimuca","Masculino","Afonso T. Culimuca","Adolfina Mufinda M. Tvunganeno","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949322567","949322567","","","0","2000-04-04","0000-00-00","ARS605","Sapú II","","Afonso T. Culimuca","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("76","Moises dos Santos Martins","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS848","","","","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("77","Nilda Francisco José","Masculino","Gil Sebastião Maça Coluna","Lina José Sebastião","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2001-04-23","0000-00-00","ARS353","Sapú II","","Gil Sebastião Maça Coluna","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("78","Paula Simão José","Masculino","Alfredo S. Jose","Teresa Adão Simão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925260998","925260998","","","0","2004-04-25","0000-00-00","ARS1016","Sapú II","","Alfredo S. Jose","2021-10-12 00:00:00","activo","2021-10-12");
INSERT INTO alunos VALUES("79","Rosa Catanha J. Carlos","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS960","","","","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("80","Teresa Bimbi da Silva","Masculino","Martinho S. Catito","Silvia Bernadina S. Da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947647503","947647503","","","0","2003-05-02","0000-00-00","ARS1066","Jacinto Tchipa","","Martinho S. Catito","2021-11-10 00:00:00","activo","2021-11-10");
INSERT INTO alunos VALUES("81","Domiana Bento Capouco","Masculino","Aurelio dos Santos Capoco","Maria Julho Bento","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949796515","949796515","","","0","2004-02-22","0000-00-00","ARS940","Jacinto Tchipa","","Aurelio dos Santos Capoco","2021-11-18 00:00:00","activo","2021-11-18");
INSERT INTO alunos VALUES("82","Fatima José Albertina","Masculino","António José Gabriel","Madalena M. Albertina","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928616753","928616753","","","0","2002-03-08","0000-00-00","ARS646","Jacinto Tchipa","","António José Gabriel","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("83","Fernando Romão Messele Cavimbi","Masculino","Manuel Romão Ulombe","Rosa Natchimo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922150917","922150917","","","0","2002-01-17","0000-00-00","ARS435","Bita Vacaria","","Manuel Romão Ulombe","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("84","Graziela Augusto Afonso","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1083","","","","2021-12-01 00:00:00","activo","2021-12-01");
INSERT INTO alunos VALUES("85","João António Cassoma Americano","Masculino","António Francisco","Cecilia Cassoma","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944583512","944583512","","","0","2002-03-15","0000-00-00","ARS1050","Macom","","António Francisco","2021-10-29 00:00:00","activo","2021-10-29");
INSERT INTO alunos VALUES("86","João Samuel Alfa Matadi","Masculino","Samuel João Matadi","Maria Alfa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925541466","925541466","","","0","2006-02-21","0000-00-00","ARS860","Jacinto Tchipa","","Samuel João Matadi","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("87","Lembinha Pascoal Correia","Masculino","Pascoal Correia Mabacala","Donana Pedro Miguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923904275/939793703","923904275/939793703","","","0","2005-11-17","0000-00-00","ARS877","Sagrada Esperança","","Pascoal Correia Mabacala","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("88","Maida da Graça B. Quiahidica","Masculino","Domingas Quiahidica","Suzana Bernardo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938639855","938639855","","","0","2021-02-10","0000-00-00","ARS546","K. Kiaxi","","Domingas Quiahidica","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("89","Domingos Marques Dala","Masculino","João Jose H. Dala","Georgina Jungo F. Marques","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924505966","924505966","","","0","2002-02-14","0000-00-00","ARS898","Sapú II","","João Jose H. Dala","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("90","Emilia Panzo Afonso","Masculino","Sumo Alexandre Afonso","Antónia C. Panzo ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949509377","949509377","","","0","2005-05-23","0000-00-00","ARS616","Belo Horizonte","","Sumo Alexandre Afonso","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("91","Lucas Marques Camutola","Masculino","Manul Joaquim","Albertina Luis Marques","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925581714","925581714","","","0","2021-10-08","0000-00-00","ARS994","Sapú II","","Manul Joaquim","2021-10-08 00:00:00","activo","2021-10-08");
INSERT INTO alunos VALUES("92","Manuel Cumbuca Gonga","Masculino","Anttónio Quimonha Gonga","Mariza Albero Cumbuca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925527778","925527778","","","0","2001-01-02","0000-00-00","ARS983","Lunda Sul","","Anttónio Quimonha Gonga","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("93","Natalia da Palma Kahangala","Masculino","Avelino Kahangala","Catarina Josefina F. Da Palma","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937170006","937170006","","","0","2005-12-17","0000-00-00","ARS981","Belo Horizonte","","Avelino Kahangala","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("94","Teresa Domingos Lucas","Masculino","Nelson Adão de Lucas","Bernarda Domingos Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938472401","938472401","","","0","2004-04-07","0000-00-00","ARS1062","Jacinto Tchipa","","Nelson Adão de Lucas","2021-11-05 00:00:00","activo","2021-11-05");
INSERT INTO alunos VALUES("95","Estefanio Gabriel Mandenga","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1087","","","","2021-10-06 00:00:00","activo","2021-10-06");
INSERT INTO alunos VALUES("96","Pinto da Costa da Silva","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1007","","","","2021-10-11 00:00:00","activo","2021-10-11");
INSERT INTO alunos VALUES("97","Francisco Paulo Dias","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1037","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("98","Delson José Otavio Pascoal","Masculino","Zebedeu Pascoal Simão","Djamila Manuela A. Octavio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923.513.895 ","923.513.895 ","","","0","2007-06-19","0000-00-00","ARS1043","Bita Vacaria","","Zebedeu Pascoal Simão","2021-10-20 00:00:00","activo","2021-10-20");
INSERT INTO alunos VALUES("99","Manuel Guilherme Notícia","Masculino","Fidelino da Costa Notícia","Maria Luisa de Morais Notícia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923856180/921034921","923856180/921034921","","","0","2005-04-02","0000-00-00","ARS109","Belo Horizonte","","Fidelino da Costa Notícia","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("100","Samuel Miguel Mituanga","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS115","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("101","Rosa Daniela Camoi dos Santos","Masculino","Daniel Manuel","Bernardeth Luzia M. Camoli","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923474172/924938502","923474172/924938502","","","0","2004-11-24","0000-00-00","ARS129","Jacinto Tchipa","","Daniel Manuel","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("102","António Roberto Gomes Fernando","Masculino","Victor Manuel de S. Fernandes","Carla Gouveia Gomes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937333338/923916248","937333338/923916248","","","0","2007-03-07","0000-00-00","ARS271","Bita Vacaria","","Victor Manuel de S. Fernandes","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("103","Rute Garcia Baltazar","Masculino","José Correia Cardoso Baltazar","Esperança Manuel Garcia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926.465.333 ","926.465.333 ","","","0","2004-08-31","0000-00-00","ARS300","Macom","","José Correia Cardoso Baltazar","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("104","Alberto Francisco de Lima","Masculino","Leonardo Mateus de Lima","Esperança Bernardo Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930.357.931 ","930.357.931 ","","","0","2005-12-08","0000-00-00","ARS302","Sapú II","","Leonardo Mateus de Lima","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("105","Domingos Jerónimo António Cardoso","Masculino","António Sebastião Cardoso","Ana Maria J. Agostinho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933511984/937701627","933511984/937701627","","","0","2006-08-12","0000-00-00","ARS374","Sapú II","","António Sebastião Cardoso","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("106","Elisabeth Masseca Fulayi","Masculino","Tomás Tchihinga Fulaty","Silvia Masseca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944.997.001 ","944.997.001 ","","","0","2006-08-06","0000-00-00","ARS419","Jacinto Tchipa","","Tomás Tchihinga Fulaty","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("107","Delson Domingos Baia","Masculino","...................","Quintinha Conceição","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931.962.769 ","931.962.769 ","","","0","2005-08-18","0000-00-00","ARS446","Jacinto Tchipa","","...................","2021-08-24 00:00:00","activo","2021-08-24");
INSERT INTO alunos VALUES("108","Diro Angelo Chipilica Cofia","Masculino","Anibal de Jesus Cafia","Victória N. Chipilica","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2006-06-25","0000-00-00","ARS499","Jacinto Tchipa","","Anibal de Jesus Cafia","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("109","Silvio do Carmo Paulo","Masculino","Vicente Pedro Mafani Paulo","Amélia Franscisco do Carmo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925.278.480 ","925.278.480 ","","","0","2003-10-15","0000-00-00","ARS51","Belo Horizonte","","Vicente Pedro Mafani Paulo","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("110","Conceição Jacob Lundange","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS513","","","","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("111","Adilson Osvaldo Da Silva ","Masculino","....................","Judith da Conceição da S. Neto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949.971.614 ","949.971.614 ","","","0","2004-06-21","0000-00-00","ARS55","Sapú II","","....................","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("112","Domingas Tch. Nalumbo Chisolo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS587","Jacinto Tchipa","","","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("113","Vivaldo Mendes dos Santos ","Masculino","Honorio Afonso dos Santos","Engracia A.M dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925628277/933108977","925628277/933108977","","","0","2004-07-17","0000-00-00","ARS612","Jacinto Tchipa","","Honorio Afonso dos Santos","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("114","Rogeiro Luzolo Nicolau Marcos","Masculino","Abel Marcos","Sara Teresa Nicolau","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930.616.334 ","930.616.334 ","","","0","2008-09-08","0000-00-00","ARS670","Bita Vacaria","","Abel Marcos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("115","Francisco Carlos Dala Tchiuale","Masculino","Carlos Bernarbe Tchiuale","Eunice Dala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944.929.691 ","944.929.691 ","","","0","2007-01-10","0000-00-00","ARS690","Bequessa","","Carlos Bernarbe Tchiuale","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("116","Mataya Helena Pascoal","Masculino","António Pedro","Laura M. Pascoal","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924.455.965 ","924.455.965 ","","","0","2003-04-11","0000-00-00","ARS696","Sapú II","","António Pedro","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("117","Estefania Judith João Chissuva","Masculino","Prófirio Lourenço Chissuva","Ana Bela Miséria C. João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929.588.363 ","929.588.363 ","","","0","2004-06-01","0000-00-00","ARS698","Sapú II","","Prófirio Lourenço Chissuva","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("118","Silvano Fernando M. Calulemi","Masculino","Fernando C. Caculami","Regina Maute Alfredo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997.100.879 ","997.100.879 ","","","0","2006-09-10","0000-00-00","ARS763","Sapú II","","Fernando C. Caculami","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("119","Silvia Yussara Manuel da Silva","Masculino","José André Casimiro da Silva","Nuria Manuel da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","942.438.742 ","942.438.742 ","","","0","2006-07-31","0000-00-00","ARS790","Jacinto Tchipa","","José André Casimiro da Silva","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("120","Luzia da Glória Gabriel","Masculino","Luvuezo Correia","Albertina Nteco André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921.105.214 ","921.105.214 ","","","0","2005-06-15","0000-00-00","ARS799","Jacinto Tchipa","","Luvuezo Correia","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("121","Emanuel António Donga","Masculino",".........................","Laurinda João M. Donga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","935.767.954 ","935.767.954 ","","","0","2005-01-05","0000-00-00","ARS808","Jacinto Tchipa","",".........................","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("122","Filomena P. Hebo","Masculino","Figueira João N. Hebo","Teresa Aangolano Pagi","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","992.711.241 ","992.711.241 ","","","0","2006-06-16","0000-00-00","ARS838","Jacinto Tchipa","","Figueira João N. Hebo","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("123","Suzana Neto Domingos","Masculino","Carlos Domingos","Ana Joaquim N. Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939766112/923386101","939766112/923386101","","","0","2006-03-27","0000-00-00","ARS861","Jacinto Tchipa","","Carlos Domingos","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("124","Jeovani Abel Catungui Samucula","Masculino","Ernesto Zango Samucula","Maria Alice A. Catungui","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930446029/923848701","930446029/923848701","","","0","2005-04-27","0000-00-00","ARS865","Sapú II","","Ernesto Zango Samucula","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("125","Antonio Paulo Sebastião de Oliveira","Masculino","Bento Antonio Oliveira","Rita Oliveira António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923617411/925835754","923617411/925835754","","","0","2009-05-13","0000-00-00","ARS914","Projecto Nando","","Bento Antonio Oliveira","2021-08-07 00:00:00","activo","2021-08-07");
INSERT INTO alunos VALUES("126","Eliseu Bento Capouco","Masculino","Aurelio dos Santos Capoco","Maria Julio Bento","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949.796.515 ","949.796.515 ","","","0","2005-07-31","0000-00-00","ARS939","Jacinto Tchipa","","Aurelio dos Santos Capoco","2021-11-18 00:00:00","activo","2021-11-18");
INSERT INTO alunos VALUES("127","Dikizeco Antonica Paulo","Masculino","........................","Paulina Vaticano Antonio Paulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922.157.860 ","922.157.860 ","","","0","2006-04-09","0000-00-00","ARS967","Jacinto Tchipa","","........................","2021-09-30 00:00:00","activo","2021-09-30");
INSERT INTO alunos VALUES("128","Geovani Rosário Francisco Tavira","Masculino","Luis Gaspar Tavira","Mauro Manuel B. Tavira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923.720.893 ","923.720.893 ","","","0","2021-02-10","0000-00-00","ARS1073","Jacinto Tchipa","","Luis Gaspar Tavira","2021-11-08 00:00:00","activo","2021-11-08");
INSERT INTO alunos VALUES("129","Antonio andre miguel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1080","","","","2021-11-26 00:00:00","activo","2021-11-26");
INSERT INTO alunos VALUES("130","Reginaldo Miguel Mutuvanga","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS930","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("131","Meury Patricia Neto Silvestre","Masculino","António de Melo Silvestre","Violeta Jacinto Neto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924445496","924445496","","","0","2006-08-13","0000-00-00","ARS1013","Sapú II","","António de Melo Silvestre","2021-10-12 00:00:00","activo","2021-10-12");
INSERT INTO alunos VALUES("132","Evarisoto Fernandes Comba","Masculino","Buabua Comba","Rosa Tchumbo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923057875","923057875","","","0","2005-12-31","0000-00-00","ARS1040","Cinquentinha","","Buabua Comba","2021-10-08 00:00:00","activo","2021-10-08");
INSERT INTO alunos VALUES("133","Joseane Fernandes Ndombe","Masculino","Edson Fabião D. Ndombe","Nádia André Gonsalveis","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934445712","934445712","","","0","2006-04-15","0000-00-00","ARS255","","","Edson Fabião D. Ndombe","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("134","Luana Vanessa T. da Fonseca","Masculino","Fernado Ngola da Fonseca","Olivia da Silva Tchising","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","946351510","946351510","","","0","2007-05-04","0000-00-00","ARS311","Sapú II","","Fernado Ngola da Fonseca","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("135","Iracelma Fernandes Alexandre","Masculino","Domingos Sebastião","Álveis Alexandre","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932102428","932102428","","","0","2004-06-02","0000-00-00","ARS423","Sapú II","","Domingos Sebastião","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("136","Luis Sapalo Domingos ","Masculino","Francisco Silvano Domingos","Helena Quaresma F. Sapalo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926041034/944996715","926041034/944996715","","","0","2007-11-16","0000-00-00","ARS432","Jacinto Tchipa","","Francisco Silvano Domingos","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("137","Sara Francisco P. Lunguenha","Masculino","Domingos F. M. Lunguenha","Manuela S. Pembele","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931792605","931792605","","","0","2007-11-03","0000-00-00","ARS438","Sapú II","","Domingos F. M. Lunguenha","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("138","Maria Domingas Agostinho Júlio","Masculino","Francisco Manue Júlio","Domingas Rodrigues A. Julio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944599292/926898536","944599292/926898536","","","0","2006-04-04","0000-00-00","ARS439","Jacinto Tchipa","","Francisco Manue Júlio","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("139","Rosa Gunza Bungo","Masculino","Afonso Ezequiel Nate Bungo","Milena Guilhermina H. Gunza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927139600/997743505","927139600/997743505","","","0","2007-03-04","0000-00-00","ARS504","Jacinto Tchipa","","Afonso Ezequiel Nate Bungo","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("140","Sulamita Helena Fontoura Quixito","Masculino","Fernandes Quixito Neto","Esmeralda Fernandes Fontoura","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","991161549/924161549","991161549/924161549","","","0","2007-04-30","0000-00-00","ARS516","Jacinto Tchipa","","Fernandes Quixito Neto","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("141","Belunda Fernando de A. Manuel","Masculino","Fernando Manuel P. Sebastião","Victorina B. De Arnassa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923317996/946888034","923317996/946888034","","","0","2005-12-28","0000-00-00","ARS521","Sapú II","","Fernando Manuel P. Sebastião","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("142","Jerónimo Jacinto Agostinho","Masculino",".....................","Tânia Carlos Agostinho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924180197","924180197","","","0","2007-05-25","0000-00-00","ARS537","Bequessa","",".....................","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("143","Zenaida João Bento","Masculino","Mário Augusto Bento","Teresa Massanga João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945061194","945061194","","","0","2006-02-07","0000-00-00","ARS542","Jacinto Tchipa","","Mário Augusto Bento","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("144","Domingas Nangolo N. Cangombe","Masculino","Severina Chissolossi Cangombe","Benvinda Nalumbo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932042230/940367608","932042230/940367608","","","0","2007-01-10","0000-00-00","ARS563","Sapú II","","Severina Chissolossi Cangombe","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("145","Leonardo António Cabange","Masculino","Cipriano Manuel Cabange","Laura Francisco A. António ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928747066/937985559","928747066/937985559","","","0","2006-11-01","0000-00-00","ARS566","Jacinto Tchipa","","Cipriano Manuel Cabange","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("146","Albertina Faustino Antonio","Masculino","António Fernando","Albertina Faustino Ngonga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925301485","925301485","","","0","2021-08-31","0000-00-00","ARS571","Jacinto Tchipa","","António Fernando","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("147","Luana Vasconselho B. Vida","Masculino","Carlos Pinto Boavida","Engracia Zage Capemba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927824076/923961779","927824076/923961779","","","0","2007-07-19","0000-00-00","ARS576","Jacinto Tchipa","","Carlos Pinto Boavida","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("148","Gizela Vunge Zua","Masculino","Cândido Paulo Zua","Mariana Gonga Vunge","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","9237095332","9237095332","","","0","2007-08-22","0000-00-00","ARS630","Bita Vacaria","","Cândido Paulo Zua","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("149","Juvenal Fernandes José","Masculino","Santos Albano José","Teresa Fernandes José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924109194","924109194","","","0","2006-11-13","0000-00-00","ARS650","Bita Vacaria","","Santos Albano José","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("150","Berta Massoxi Sambo Gomes","Masculino","Agostinho Luis Gomes","Maria E. B. Sambo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923976001","923976001","","","0","2006-08-21","0000-00-00","ARS652","Bita Vacaria","","Agostinho Luis Gomes","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("151","Jessica Daniela Zangala","Masculino","........................","Eunice Caboco Zangala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947954268","947954268","","","0","2005-09-10","0000-00-00","ARS656","Sapú II","","........................","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("152","Marienala Garcia Ramiro","Masculino","Germano de Sousa Garcia","Indira Francisca Miguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","935502684/925614829","935502684/925614829","","","0","2006-05-12","0000-00-00","ARS715","Jacinto Tchipa","","Germano de Sousa Garcia","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("153","Carlos Manuel Hebo","Masculino","Carlos Francisco K. Hebo","Joana António Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944027893","944027893","","","0","2007-06-29","0000-00-00","ARS725","Jacinto Tchipa","","Carlos Francisco K. Hebo","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("154","Jureuma Balanga Manuel","Masculino","João Mateus Manuel","Cristina Miguel Balanga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945337968","945337968","","","0","2005-04-03","0000-00-00","ARS765","Bita Vacaria","","João Mateus Manuel","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("155","Gemima António Manuel Disonsi","Masculino","Mavunino Dinsonsi","Catarina Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924119791","924119791","","","0","2006-07-14","0000-00-00","ARS77","Jacinto Tchipa","","Mavunino Dinsonsi","2021-07-19 00:00:00","activo","2021-07-19");
INSERT INTO alunos VALUES("156","Joelma Engracia C. Cangai","Masculino","Joelma Engracia C. Cangahi","Ovete Casimiro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936668889","936668889","","","0","2005-04-22","0000-00-00","ARS803","Sapú II","","Joelma Engracia C. Cangahi","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("157","Francisca Eugenia Eduardo Gomes","Masculino","Francisco Eugénia Francisco","Sara Eduardo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2006-05-27","0000-00-00","ARS83","Jacinto Tchipa","","Francisco Eugénia Francisco","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("158","Esperança Barroso Dombo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS836","","","","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("159","Eliane Priscila B. Adão","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS845","","","","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("160","Josefania da Silva Mussunga","Masculino","Paulo Raimundo Mussungo","Josefa da Silva Mussunga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932598312/912664747","932598312/912664747","","","0","2007-05-28","0000-00-00","ARS878","Sapú II","","Paulo Raimundo Mussungo","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("161","João José Lópes","Masculino","José Luis João Lopes","Joana Adão Miguel José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928801703","928801703","","","0","2006-07-28","0000-00-00","ARS884","Jacinto Tchipa","","José Luis João Lopes","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("162","Arcanjo Augusto Kapiendje","Masculino","Francisco Domingos António","Guilhermina M. Combela Augusto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943113803","943113803","","","0","2006-05-06","0000-00-00","ARS894","Bita Vacaria","","Francisco Domingos António","2021-09-16 00:00:00","activo","2021-09-16");
INSERT INTO alunos VALUES("163","Abrão Manuel Jones","Masculino","Manuel Chinoia Jones","Zaina Fernanda António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924831040","924831040","","","0","2007-03-15","0000-00-00","ARS935","Jacinto Tchipa","","Manuel Chinoia Jones","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("164","Pinto da Costa da Silva","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1007","","","","2021-10-11 00:00:00","activo","2021-10-11");
INSERT INTO alunos VALUES("165","Francisco Paulo Dias","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1037","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("166","Delson José Otavio Pascoal","Masculino","Zebedeu Pascoal Simão","Djamila Manuela A. Octavio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923513895","923513895","","","0","2007-06-19","0000-00-00","ARS1043","Bita Vacaria","","Zebedeu Pascoal Simão","2021-10-20 00:00:00","activo","2021-10-20");
INSERT INTO alunos VALUES("167","Manuel Guilherme Notícia","Masculino","Fidelino da Costa Notícia","Maria Luisa de Morais Notícia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923856180/921034921","923856180/921034921","","","0","2005-04-02","0000-00-00","ARS109","Belo Horizonte","","Fidelino da Costa Notícia","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("168","Samuel Miguel Mituanga","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS115","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("169","Rosa Daniela Camoi dos Santos","Masculino","Daniel Manuel","Bernardeth Luzia M. Camoli","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923474172/924938502","923474172/924938502","","","0","2004-11-24","0000-00-00","ARS129","Jacinto Tchipa","","Daniel Manuel","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("170","António Roberto Gomes Fernando","Masculino","Victor Manuel de S. Fernandes","Carla Gouveia Gomes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937333338/923916248","937333338/923916248","","","0","2007-03-07","0000-00-00","ARS271","Bita Vacaria","","Victor Manuel de S. Fernandes","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("171","Rute Garcia Baltazar","Masculino","José Correia Cardoso Baltazar","Esperança Manuel Garcia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926465333","926465333","","","0","2004-08-31","0000-00-00","ARS300","Macom","","José Correia Cardoso Baltazar","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("172","Alberto Francisco de Lima","Masculino","Leonardo Mateus de Lima","Esperança Bernardo Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930357931","930357931","","","0","2005-12-08","0000-00-00","ARS302","Sapú II","","Leonardo Mateus de Lima","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("173","Domingos Jerónimo António Cardoso","Masculino","António Sebastião Cardoso","Ana Maria J. Agostinho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933511984/937701627","933511984/937701627","","","0","2006-08-12","0000-00-00","ARS374","Sapú II","","António Sebastião Cardoso","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("174","Elisabeth Masseca Fulayi","Masculino","Tomás Tchihinga Fulaty","Silvia Masseca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944997001","944997001","","","0","2006-08-06","0000-00-00","ARS419","Jacinto Tchipa","","Tomás Tchihinga Fulaty","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("175","Delson Domingos Baia","Masculino","...................","Quintinha Conceição","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931962769","931962769","","","0","2005-08-18","0000-00-00","ARS446","Jacinto Tchipa","","...................","2021-08-24 00:00:00","activo","2021-08-24");
INSERT INTO alunos VALUES("176","Diro Angelo Chipilica Cofia","Masculino","Anibal de Jesus Cafia","Victória N. Chipilica","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2006-06-25","0000-00-00","ARS499","Jacinto Tchipa","","Anibal de Jesus Cafia","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("177","Silvio do Carmo Paulo","Masculino","Vicente Pedro Mafani Paulo","Amélia Franscisco do Carmo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925278480","925278480","","","0","2003-10-15","0000-00-00","ARS51","Belo Horizonte","","Vicente Pedro Mafani Paulo","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("178","Conceição Jacob Lundange","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS513","","","","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("179","Adilson Osvaldo Da Silva ","Masculino","....................","Judith da Conceição da S. Neto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949971614","949971614","","","0","2004-06-21","0000-00-00","ARS55","Sapú II","","....................","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("180","Domingas Tch. Nalumbo Chisolo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS587","Jacinto Tchipa","","","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("181","Vivaldo Mendes dos Santos ","Masculino","Honorio Afonso dos Santos","Engracia A.M dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925628277/933108977","925628277/933108977","","","0","2004-07-17","0000-00-00","ARS612","Jacinto Tchipa","","Honorio Afonso dos Santos","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("182","Rogeiro Luzolo Nicolau Marcos","Masculino","Abel Marcos","Sara Teresa Nicolau","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930616334","930616334","","","0","2008-09-08","0000-00-00","ARS670","Bita Vacaria","","Abel Marcos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("183","Francisco Carlos Dala Tchiuale","Masculino","Carlos Bernarbe Tchiuale","Eunice Dala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944929691","944929691","","","0","2007-01-10","0000-00-00","ARS690","Bequessa","","Carlos Bernarbe Tchiuale","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("184","Mataya Helena Pascoal","Masculino","António Pedro","Laura M. Pascoal","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924455965","924455965","","","0","2003-04-11","0000-00-00","ARS696","Sapú II","","António Pedro","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("185","Estefania Judith João Chissuva","Masculino","Prófirio Lourenço Chissuva","Ana Bela Miséria C. João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929588363","929588363","","","0","2004-06-01","0000-00-00","ARS698","Sapú II","","Prófirio Lourenço Chissuva","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("186","Silvano Fernando M. Calulemi","Masculino","Fernando C. Caculami","Regina Maute Alfredo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997100879","997100879","","","0","2006-09-10","0000-00-00","ARS763","Sapú II","","Fernando C. Caculami","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("187","Silvia Yussara Manuel da Silva","Masculino","José André Casimiro da Silva","Nuria Manuel da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","942438742","942438742","","","0","2006-07-31","0000-00-00","ARS790","Jacinto Tchipa","","José André Casimiro da Silva","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("188","Luzia da Glória Gabriel","Masculino","Luvuezo Correia","Albertina Nteco André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921105214","921105214","","","0","2005-06-15","0000-00-00","ARS799","Jacinto Tchipa","","Luvuezo Correia","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("189","Emanuel António Donga","Masculino",".........................","Laurinda João M. Donga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","935767954","935767954","","","0","2005-01-05","0000-00-00","ARS808","Jacinto Tchipa","",".........................","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("190","Filomena P. Hebo","Masculino","Figueira João N. Hebo","Teresa Aangolano Pagi","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","992711241","992711241","","","0","2006-06-16","0000-00-00","ARS838","Jacinto Tchipa","","Figueira João N. Hebo","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("191","Suzana Neto Domingos","Masculino","Carlos Domingos","Ana Joaquim N. Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939766112/923386101","939766112/923386101","","","0","2006-03-27","0000-00-00","ARS861","Jacinto Tchipa","","Carlos Domingos","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("192","Jeovani Abel Catungui Samucula","Masculino","Ernesto Zango Samucula","Maria Alice A. Catungui","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930446029/923848701","930446029/923848701","","","0","2005-04-27","0000-00-00","ARS865","Sapú II","","Ernesto Zango Samucula","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("193","Antonio Paulo Sebastião de Oliveira","Masculino","Bento Antonio Oliveira","Rita Oliveira António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923617411/925835754","923617411/925835754","","","0","2009-05-13","0000-00-00","ARS914","Projecto Nando","","Bento Antonio Oliveira","2021-08-07 00:00:00","activo","2021-08-07");
INSERT INTO alunos VALUES("194","Eliseu Bento Capouco","Masculino","Aurelio dos Santos Capoco","Maria Julio Bento","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949796515","949796515","","","0","2005-07-31","0000-00-00","ARS939","Jacinto Tchipa","","Aurelio dos Santos Capoco","2021-11-18 00:00:00","activo","2021-11-18");
INSERT INTO alunos VALUES("195","Dikizeco Antonica Paulo","Masculino","........................","Paulina Vaticano Antonio Paulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922157860","922157860","","","0","2006-04-09","0000-00-00","ARS967","Jacinto Tchipa","","........................","2021-09-30 00:00:00","activo","2021-09-30");
INSERT INTO alunos VALUES("196","Geovani Rosário Francisco Tavira","Masculino","Luis Gaspar Tavira","Mauro Manuel B. Tavira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923720893","923720893","","","0","2021-02-10","0000-00-00","ARS1073","Jacinto Tchipa","","Luis Gaspar Tavira","2021-11-08 00:00:00","activo","2021-11-08");
INSERT INTO alunos VALUES("197","Antonio andre miguel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1080","","","","2021-11-26 00:00:00","activo","2021-11-26");
INSERT INTO alunos VALUES("198","Conceição Mussobo Mbuila","Masculino","Francisco Domingos Mbula","Francisca Alfredo Mussubo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931552168","931552168","","","0","2004-06-13","0000-00-00","ARS1009","Jacinto Tchipa","","Francisco Domingos Mbula","2021-10-07 00:00:00","activo","2021-10-07");
INSERT INTO alunos VALUES("199","Patricia Emiliana Antonio","Masculino","Benjamim Michel Chitomba","Emiliana Margarida João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928471188","928471188","","","0","2005-12-26","0000-00-00","ARS1014","Sapú II","","Benjamim Michel Chitomba","2021-10-12 00:00:00","activo","2021-10-12");
INSERT INTO alunos VALUES("200","Jandira Emilia Benjamim","Masculino","Benjamim Michel Chitomba","Emiliana Margarida João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928471188","928471188","","","0","2003-09-08","0000-00-00","ARS1015","Sapú II","","Benjamim Michel Chitomba","2021-10-12 00:00:00","activo","2021-10-12");
INSERT INTO alunos VALUES("201","Ana Stela Augusto Kapienge","Masculino","Francisco Domingos António","Guilhermina M. Combela Augusto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928890934","928890934","","","0","2008-04-15","0000-00-00","ARS1029","Sapú II","","Francisco Domingos António","2021-10-14 00:00:00","activo","2021-10-14");
INSERT INTO alunos VALUES("202","Fabio José Candido Afonso","Masculino","Pedro Jose Candido","Alegria K. Saca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923618579/923139183","923618579/923139183","","","0","2005-03-04","0000-00-00","ARS1044","Jacinto Tchipa","","Pedro Jose Candido","2021-10-20 00:00:00","activo","2021-10-20");
INSERT INTO alunos VALUES("203","Rosalina Lilunga Cachipa Cango","Masculino","Martins Canjo","Aldina Mangueve Cachipa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927067462","927067462","","","0","2007-04-02","0000-00-00","ARS1045","Macom","","Martins Canjo","2021-10-20 00:00:00","activo","2021-10-20");
INSERT INTO alunos VALUES("204","Leonel Elizandro João","Masculino",".............................","Margarida Beatriz João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921126371","921126371","","","0","2007-03-03","0000-00-00","ARS1049","Sapú II","",".............................","2021-10-11 00:00:00","activo","2021-10-11");
INSERT INTO alunos VALUES("205","Bernardo Camoli dos Santos","Masculino","Daniel Manuel","Bernardeth Luzia M. Camoli","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923474172/924938502","923474172/924938502","","","0","2006-08-10","0000-00-00","ARS128","Jacinto Tchipa","","Daniel Manuel","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("206","Maria Imacula Domingos de Oliveira","Masculino","Domingos João de Oliveira","Luzia Mbaca Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923281060/931616637","923281060/931616637","","","0","2008-12-11","0000-00-00","ARS169","Sapú II","","Domingos João de Oliveira","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("207","Bernardo António Culua","Masculino","Bonde António Culua","Cecélia Neves Quissueia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927118113/934837710","927118113/934837710","","","0","2002-01-15","0000-00-00","ARS178","Sapú II","","Bonde António Culua","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("208","Teresa Estefania Pimenta","Masculino","Helder de Jesus Pimenta","Angelica F. D. Mendes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933460301/912253366","933460301/912253366","","","0","2004-04-11","0000-00-00","ARS190","Sequele","","Helder de Jesus Pimenta","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("209","Helena Colela Quissanga","Masculino","Mateus Muhongo Quissanga","Fernanda Domingos Colela","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923741778/947697849","923741778/947697849","","","0","2008-08-01","0000-00-00","ARS214","Bita Vacaria","","Mateus Muhongo Quissanga","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("210","Carla Daniela Cavalheiro de Lima","Masculino","Rui Domingos de Lima","Adelina Bandeira P. C. De Lima","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","917022728/934512812","917022728/934512812","","","0","2021-08-09","0000-00-00","ARS257","Sapú II","","Rui Domingos de Lima","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("211","Breni Breganha Quibato","Masculino","Manuel Fabião Quibato","Luzia Kimbundo Simão Breganha","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923552160/944996623","923552160/944996623","","","0","2003-12-27","0000-00-00","ARS266","Jacinto Tchipa","","Manuel Fabião Quibato","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("212","Silvia Breganha Quibato","Masculino","Manuel Fabião Quibato","Luzia Kimbundo Simão Breganha","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923552160/944996623","923552160/944996623","","","0","2005-02-09","0000-00-00","ARS268","Jacinto Tchipa","","Manuel Fabião Quibato","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("213","Manuel Soares Nzage","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS287","","","","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("214","Honório Garcia Capenda","Masculino","Rui Capenda","Nkuina Paulina Fundo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923632751/924097909","923632751/924097909","","","0","2006-05-28","0000-00-00","ARS294","Jacinto Tchipa","","Rui Capenda","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("215","Teresa Sabina Ndeidalela Isaias","Masculino","Morais Pontes Isaias","Alice Ndeidalela","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923494922","923494922","","","0","2007-06-02","0000-00-00","ARS333","Sapú II","","Morais Pontes Isaias","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("216","Nedossany Fernandes Domingos","Masculino","Ernesto Domingos M. Garcia ","Iracelma Rossana Gaspar","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923796673","923796673","","","0","2005-10-18","0000-00-00","ARS370","Sapú II","","Ernesto Domingos M. Garcia ","2021-08-17 00:00:00","activo","2021-08-17");
INSERT INTO alunos VALUES("217","Raquel Irina da Silva Quinanga","Masculino","Dias Quinanga","Helena Celele da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929013703","929013703","","","0","2024-10-18","0000-00-00","ARS398","Bita Vacaria","","Dias Quinanga","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("218","Helena Bambi Goveia","Masculino","Pedro Lucas","Helena Belanda Alfredo da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997100921","997100921","","","0","2006-06-12","0000-00-00","ARS431","Jacinto Tchipa","","Pedro Lucas","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("219","Ernesto João António","Masculino","Morais António","Henriqueta João António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925190731/923585843","925190731/923585843","","","0","2005-08-20","0000-00-00","ARS44","Sapú II","","Morais António","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("220","Rodrina Fernandos dos Santo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS477","","","","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("221","Violeta Ngindo Xavier","Masculino","Clementino Chivala Xavier ","Teresa Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939169999/923386740","939169999/923386740","","","0","2007-11-30","0000-00-00","ARS500","Sapú II","","Clementino Chivala Xavier ","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("222","Angelo Armindo Albino","Masculino","Julio Carlos Albino","Rosária António Zeca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922979338/947212525","922979338/947212525","","","0","2004-04-05","0000-00-00","ARS581","Jacinto Tchipa","","Julio Carlos Albino","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("223","Celeste Debora Samuel Menezes","Masculino","Sérgio Saul Menezes","Madalena Pemba Samuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923577739","923577739","","","0","2006-03-26","0000-00-00","ARS594","Jacinto Tchipa","","Sérgio Saul Menezes","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("224","Victor Quimbaxi Calunga","Masculino","Celestino Kalunga Kaienvo","Noémia Marta Mário","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923883479","923883479","","","0","2005-06-14","0000-00-00","ARS638","Sapú II","","Celestino Kalunga Kaienvo","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("225","Adriano Luis Alexandre","Masculino","Adraino Domingos Alexandre","Fernanda José João Luis ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912322820","912322820","","","0","2006-06-26","0000-00-00","ARS686","Sapú II","","Adraino Domingos Alexandre","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("226","Gabriel de Almeida Domingos","Masculino","Salvador Filipe Domingos","Ester Cristóvão de A. Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922857723/990942263","922857723/990942263","","","0","2008-01-28","0000-00-00","ARS688","Jacinto Tchipa","","Salvador Filipe Domingos","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("227","João Cassule Nhanga","Masculino","Fernando J. Manuel Pedro","Helena António Cassule","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923735796","923735796","","","0","2006-02-12","0000-00-00","ARS697","Bita Vacaria","","Fernando J. Manuel Pedro","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("228","Alexandre Luis Dias da Silva","Masculino","Manuel Fransisco G. D. Dos Santos","Carolina Manuel A. Luis ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923218377","923218377","","","0","2005-07-08","0000-00-00","ARS709","Sapú II","","Manuel Fransisco G. D. Dos Santos","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("229","Bernardete Nhuca Luciano Calei","Masculino","Faustino Calei","Laurinda Lito Luciano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923440823/936785195","923440823/936785195","","","0","2006-08-01","0000-00-00","ARS741","Jacinto Tchipa","","Faustino Calei","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("230","Naquissia de Lima Quimonha","Masculino","Adão Canzambi Quimonha","Cristina Caetano de Lima","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939172858","939172858","","","0","2003-02-20","0000-00-00","ARS745","Sapú II","","Adão Canzambi Quimonha","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("231","Elizabete de Lima Quimonha","Masculino","Adão Canzambi Quimonha","Cristina Caetano de Lima","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939172858","939172858","","","0","2006-03-08","0000-00-00","ARS746","Sapú II","","Adão Canzambi Quimonha","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("232","Riana Solange Gabriel Tandala","Masculino","Elias Gonsalveis Tandala","Deolinda da Silva G. Tandala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923491442","923491442","","","0","2008-10-23","0000-00-00","ARS760","Jacinto Tchipa","","Elias Gonsalveis Tandala","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("233","Inácia Madalena B. Da Rocha","Masculino","Assunção A. Da Rocha","Domingas A. Baiage ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923455248","923455248","","","0","2006-10-22","0000-00-00","ARS774","Bita Vacaria","","Assunção A. Da Rocha","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("234","Skelson Francisco Gonsalveis Neto","Masculino","Capita Neto","Luisa do Carmo L. Gonsalveis ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923133813","923133813","","","0","2005-04-20","0000-00-00","ARS779","Jacinto Tchipa","","Capita Neto","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("235","Pedro Joaquim C.Kundinguida","Masculino","Tomás CH. Kundínguida","Micaela Feca Camundongo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923395979/922154400","923395979/922154400","","","0","2006-12-28","0000-00-00","ARS816","","","Tomás CH. Kundínguida","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("236","Olizandro de Oliveira","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS843","","","","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("237","José Alveis Manuel","Masculino","Alveis António Manuel","Ana Albertina","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931762032","931762032","","","0","2004-10-12","0000-00-00","ARS850","","","Alveis António Manuel","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("238","Teresa Muhongo Baião","Masculino","Castro António Baio","Teresa Viana Muhongo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931965139","931965139","","","0","2004-05-31","0000-00-00","ARS881","Jacinto Tchipa","","Castro António Baio","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("239","Juliana Luisa Lópes","Masculino","............................","Luisa M. Luis ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2009-03-30","0000-00-00","ARS896","","","............................","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("240","Bernardo Gonga Gerónimo","Masculino","Adriano Manuel Gerónimo","Eva António Gonga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2003-05-25","0000-00-00","ARS953","Jacinto Tchipa","","Adriano Manuel Gerónimo","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("241","Diakanga Gertrude N. Sebastião","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS996","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("242","Osvaldo Nambalo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1056","","","","2021-11-03 00:00:00","activo","2021-11-03");
INSERT INTO alunos VALUES("243","Mateus Moises Cardoso","Masculino","Agostinho M. Cardoso","Maria Manuel Moises","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926337107","926337107","","","0","2007-02-14","0000-00-00","ARS1061","Imbondeiro Sul","","Agostinho M. Cardoso","2021-11-05 00:00:00","activo","2021-11-05");
INSERT INTO alunos VALUES("244","Adelaide Nocipitali Sambata","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1077","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("245","Silvana Gomes Goge","Masculino","Silvio da Costa Goge","Fineza José Gomes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922777126/947899658","922777126/947899658","","","0","2009-03-24","0000-00-00","ARS719","Bita Vacaria","","Silvio da Costa Goge","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("246","Mankutima Vemba","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1035","","","","2021-10-18 00:00:00","activo","2021-10-18");
INSERT INTO alunos VALUES("247","Viera Moniz Vemba","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1036","","","","2021-10-18 00:00:00","activo","2021-10-18");
INSERT INTO alunos VALUES("248","Dumilde Luyangalalu Sobral Paulo","Masculino","Hotaniel Noé Alveis Paulo","Júlia Suzana Estevão Sobral","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925447685","925447685","","","0","2007-07-10","0000-00-00","ARS223","Jacinto Tchipa","","Hotaniel Noé Alveis Paulo","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("249","Salete Tomás Balanga","Masculino","Euclides Balanga","Evandra v. Balanga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923241628","923241628","","","0","2021-10-13","0000-00-00","ARS247","Jacinto Tchipa","","Euclides Balanga","2021-08-04 00:00:00","activo","2021-08-04");
INSERT INTO alunos VALUES("250","Elga Alexandre Soares","Masculino","Manuel Francisco Soares","Suzana Quintino M.  Alexandre","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937172507/923961772","937172507/923961772","","","0","2007-09-19","0000-00-00","ARS299","Jacinto Tchipa","","Manuel Francisco Soares","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("251","Felizardo Augusto B. Lourenço","Masculino","Augusto João Lourenço","Santa Felizardo Bernardo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923551574/932602342","923551574/932602342","","","0","2007-10-11","0000-00-00","ARS318","Jacinto Tchipa","","Augusto João Lourenço","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("252","Nlongui Alexandrino Paim Mavacala","Masculino","Don Sebastião A. Mavacala","Ana José Paim","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923031617/929205369","923031617/929205369","","","0","2007-08-11","0000-00-00","ARS322","Jacinto Tchipa","","Don Sebastião A. Mavacala","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("253","Cristália Tatiana Domingos Abino","Masculino","António Manuel Albino","Cristina Margarida Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926560157/923248886","926560157/923248886","","","0","2021-05-08","0000-00-00","ARS330","Sapú II","","António Manuel Albino","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("254","Luzia Gerónimo António Cardoso","Masculino","António Sebastião Cardoso","Ana Maria J. Cardoso","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933511984/937701627","933511984/937701627","","","0","2007-06-09","0000-00-00","ARS337","Jacinto Tchipa","","António Sebastião Cardoso","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("255","Abel Lucas Daniel Chivala","Masculino","António Chimuco Chivava","Anilde Cesaltina Ndataloneni","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923494922","923494922","","","0","2007-03-20","0000-00-00","ARS347","Sapú II","","António Chimuco Chivava","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("256","Telma Elizandra da Silva Machado","Masculino","Samuel José Machado","Teresa Caetano da Silva Machado","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923554922/923969885","923554922/923969885","","","0","2008-04-29","0000-00-00","ARS376","Sapú II","","Samuel José Machado","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("257","Evandro Aldair Honda Anibal","Masculino","Emanuel de Castro Anibal","Selmma Odeth Raimundo Honda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923877287","923877287","","","0","2008-01-20","0000-00-00","ARS386","Bita Vacaria","","Emanuel de Castro Anibal","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("258","Irene Perreira Dongua","Masculino","Moises Pinto Dongua","Eva Perreira Francisco Luís","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923655253","923655253","","","0","2009-01-13","0000-00-00","ARS403","Jacinto Tchipa","","Moises Pinto Dongua","2021-08-17 00:00:00","activo","2021-08-17");
INSERT INTO alunos VALUES("259","Adriana Luzolo Zua Paulo","Masculino","Adriana Luzola Zua Paulo","Inês José Paulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930071343/931016000","930071343/931016000","","","0","2007-06-25","0000-00-00","ARS408","Jacinto Tchipa","","Adriana Luzola Zua Paulo","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("260","Kiedika Elizabeth Mambu","Masculino","Leão Mambu Júnior","Sofia Muntu Nkiawete","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945637725","945637725","","","0","2007-06-11","0000-00-00","ARS425","Sapú II","","Leão Mambu Júnior","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("261","Joana Francisco Pedro Manuel","Masculino","Francisco Paulo Manuel","Lucinda de Carvaho Pedro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923000597","923000597","","","0","2006-11-18","0000-00-00","ARS429","Sapú II","","Francisco Paulo Manuel","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("262","Agostinho Tussamba Félix Henriques","Masculino","Sebastião Tussamba M. Henriques","Elsa Pedro Felix","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923338952/926778820","923338952/926778820","","","0","2006-07-29","0000-00-00","ARS436","Sapú II","","Sebastião Tussamba M. Henriques","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("263","Marcela Mongo Alveis","Masculino","Castro Alveis Albertino","Bela Muchima Alveis","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943294336","943294336","","","0","2007-01-25","0000-00-00","ARS447","Bita Vacaria","","Castro Alveis Albertino","2021-08-24 00:00:00","activo","2021-08-24");
INSERT INTO alunos VALUES("264","Pedro de Barros Morais","Masculino","Magalhães Manuel Morais","Luisa Maria de Barros","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","941993955/929509804","941993955/929509804","","","0","2006-03-29","0000-00-00","ARS456","Bita Vacaria","","Magalhães Manuel Morais","2021-08-25 00:00:00","activo","2021-08-25");
INSERT INTO alunos VALUES("265","Adriana fernanda dos Santos","Masculino","Alfredo Feliciano C. Dos Santos","..........................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923969744","923969744","","","0","2006-02-13","0000-00-00","ARS472","Jacinto Tchipa","","Alfredo Feliciano C. Dos Santos","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("266","Miranda Cardoso da Cruz ","Masculino","Gil Adriano","Cicilia Cardoso","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939268032","939268032","","","0","2009-03-06","0000-00-00","ARS476","Jacinto Tchipa","","Gil Adriano","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("267","Moises Tito Zua Gunza","Masculino","Tito Domingos Gunza","Ruth Esteves Zua","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923680189/925506786","923680189/925506786","","","0","2007-01-29","0000-00-00","ARS481","Jacinto Tchipa","","Tito Domingos Gunza","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("268","Derineth Manuela L. da Costa","Masculino","Manuel João da Costa","Luisa Chia Lucamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930753701","930753701","","","0","2007-12-14","0000-00-00","ARS490","Bequessa","","Manuel João da Costa","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("269","Adriel Benza Dias dos Santos","Masculino","Mateus Francisco Dias dos Santos","Lemba Correia B. Dias dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912238140/933255469","912238140/933255469","","","0","2006-08-19","0000-00-00","ARS495","Sapú II","","Mateus Francisco Dias dos Santos","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("270","João Pedro Cambando","Masculino","Henriques Ngola Cambando","Antonica João Pedro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924305424/938190831","924305424/938190831","","","0","2006-09-20","0000-00-00","ARS540","Bita Vacaria","","Henriques Ngola Cambando","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("271","Garcia Manuel Soma Benvindo","Masculino","Manuel Benvindo","Ponteciana Veriana Soma","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926286565","926286565","","","0","2007-03-26","0000-00-00","ARS554","Jacinto Tchipa","","Manuel Benvindo","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("272","António Gonga Cajungo","Masculino","Domingos Goga Cajungo","Eugénia Cajungo Gonga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925800268/940820489","925800268/940820489","","","0","2021-06-30","0000-00-00","ARS583","Jacinto Tchipa","","Domingos Goga Cajungo","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("273","Fernando Luis Alexandre","Masculino","Adraino Domingos Alexandre","Fernanda José João Luis ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912322820","912322820","","","0","2006-12-26","0000-00-00","ARS685","Sapú II","","Adraino Domingos Alexandre","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("274","Joaquim Samacuenge Mariano","Masculino","José Mariano T. Duarte","Maria da Conceição","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923365659/923943484","923365659/923943484","","","0","2007-11-02","0000-00-00","ARS721","Sapú II","","José Mariano T. Duarte","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("275","Pedro Ch. João Jamba","Masculino","Jaime Jamba","Mario João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927421228","927421228","","","0","2008-09-04","0000-00-00","ARS814","","","Jaime Jamba","2021-09-09 00:00:00","activo","2021-09-09");
INSERT INTO alunos VALUES("276","Afranio Arsénio Dias","Masculino","Francisco Fastudo Dias ","Conceição Francisco A. Dias ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923850300/993810480","923850300/993810480","","","0","2007-10-02","0000-00-00","ARS851","","","Francisco Fastudo Dias ","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("277","Domingas Nelson Manuel Pata","Masculino","Nelson Pata","Margarida Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934817466","934817466","","","0","2008-11-29","0000-00-00","ARS871","Jacinto Tchipa","","Nelson Pata","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("278","Santos Pimpão Domingos","Masculino","António Gerado Domingos","Mariana António Pimpão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933123471","933123471","","","0","2007-05-03","0000-00-00","ARS882","Jacinto Tchipa","","António Gerado Domingos","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("279","Mauricia Nguendelele P. Bombo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS922","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("280","Daniel Capingala da Silva","Masculino","António João F. Da Silva","Dionisia Caviva Capingano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931551045/931551045","931551045/931551045","","","0","2007-04-04","0000-00-00","ARS945","Jacinto Tchipa","","António João F. Da Silva","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("281","Helena Fernandes Vunza","Masculino","António Domingos Vunza","Teresa Maria F. Vunza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927222766","927222766","","","0","2007-04-03","0000-00-00","ARS989","Sapú II","","António Domingos Vunza","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("282","Luis Francisco dos Santos","Masculino","Manuel Domingos Apolinaria","Joana G. Dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925226319","925226319","","","0","2006-01-28","0000-00-00","ARS993","Jacinto Tchipa","","Manuel Domingos Apolinaria","2021-10-08 00:00:00","activo","2021-10-08");
INSERT INTO alunos VALUES("283","Victorino Ch. Cavindja","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS995","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("284","Arnaldo Monteiro Domingos Quembi","Masculino","Pedro Vicente Quembi","Josefa de Fatima M. Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","940046982","940046982","","","0","2007-03-19","0000-00-00","ARS675","","","Pedro Vicente Quembi","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("285","Adelaida Nocipitali Sambata","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1004","","","","2021-10-11 00:00:00","activo","2021-10-11");
INSERT INTO alunos VALUES("286","Ariclene Francisco Sebastião","Masculino","Lutumba K. Sebastião ","Domiana B. Antonio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924996814/924996814","924996814/924996814","","","0","2007-08-31","0000-00-00","ARS1021","Jacinto Tchipa","","Lutumba K. Sebastião ","2021-10-06 00:00:00","activo","2021-10-06");
INSERT INTO alunos VALUES("287","Eugenia Jamba Lotina Chinengo ","Masculino","Chinengo Canhengue","Elisabeth Priscila Chipira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","92770067462","92770067462","","","0","2006-09-03","0000-00-00","ARS1047","Macom","","Chinengo Canhengue","2021-10-20 00:00:00","activo","2021-10-20");
INSERT INTO alunos VALUES("288","Teresa Luis Pedro","Masculino","Moises Manuel Pedro","Delfina Teresa Luis","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926483546/936913392","926483546/936913392","","","0","2008-01-22","0000-00-00","ARS13","Jacinto Tchipa","","Moises Manuel Pedro","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("289","Pedro Saude Francisco","Masculino","Pedro Domingos B. Francisco","Aguila Figueredo Saude","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923788472/933791338","923788472/933791338","","","0","2007-07-21","0000-00-00","ARS142","Jacinto Tchipa","","Pedro Domingos B. Francisco","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("290","Victória C. António José","Masculino","Nelson José","Delfina António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923559563","923559563","","","0","2007-04-17","0000-00-00","ARS153","Sapú II","","Nelson José","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("291","Erson José Adriano André","Masculino","Alberto José André","Lucinda António Adriano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923559563","923559563","","","0","2008-02-08","0000-00-00","ARS155","Sapú II","","Alberto José André","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("292","Domingas Guia Francisco José","Masculino","Zinho Francisco José","Ruth Domingos Manuel Guia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924883086/924628633","924883086/924628633","","","0","2006-07-16","0000-00-00","ARS157","Bita Vacaria","","Zinho Francisco José","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("293","Rosária Cacuengue","Masculino","Laurindo Domingos Cacuengue","....................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925348784","925348784","","","0","0000-00-00","0000-00-00","ARS180","Belo Horizonte","","Laurindo Domingos Cacuengue","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("294","Benjamim Cacuengue","Masculino","Laurindo Domingos Cacuengue","....................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925348784","925348784","","","0","2007-12-31","0000-00-00","ARS181","Belo Horizonte","","Laurindo Domingos Cacuengue","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("295","Fernanda da Cruz Will de Sousa ","Masculino","Fernando António de Sousa ","Dacimim da Cruz Tavares Will","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","914458340/923813027","914458340/923813027","","","0","2008-06-21","0000-00-00","ARS19","Bita Vacaria","","Fernando António de Sousa ","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("296","Joseleny Ricardo Fastudo Venâncio","Masculino","José Gomes Venâncio","Albertina Carllos Faztudo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923510982/912887419","923510982/912887419","","","0","2008-04-29","0000-00-00","ARS207","Sapú II","","José Gomes Venâncio","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("297","Eduardo Martinho Nungo Sakuayela","Masculino","Germano Sapembe S. Wilson","Josefina N. V. Nangulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945605626","945605626","","","0","2007-10-01","0000-00-00","ARS213","Jacinto Tchipa","","Germano Sapembe S. Wilson","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("298","Sergio José Jorge Sebastião","Masculino","Augusto José Luis Sebastião","Marisa José Jorge","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947269190/948475165","947269190/948475165","","","0","2007-04-25","0000-00-00","ARS222","Jacinto Tchipa","","Augusto José Luis Sebastião","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("299","Josafat Lino João Zanda","Masculino","Lino da Silva Zanda","Virginia Raimundo N. J. Zanda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923855449/927901021","923855449/927901021","","","0","2006-09-30","0000-00-00","ARS226","Sapú II","","Lino da Silva Zanda","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("300","Jessica Cassinda T. Manuel","Masculino","Alfredo Manuel","Paulina Tchokunda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2007-05-15","0000-00-00","ARS241","Jacinto Tchipa","","Alfredo Manuel","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("301","Creciane Cadeth da Silva","Masculino","José Mendes Francisco da Silva","Lourdes Cadete","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997/239465/994407513","997/239465/994407513","","","0","2008-01-20","0000-00-00","ARS259","Jacinto Tchipa","","José Mendes Francisco da Silva","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("302","Júlia Rosana António de Oliveira","Masculino","Paiva Mateus de Oliveira","Clotilde Laurinda Panzo António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923322098","923322098","","","0","2007-12-01","0000-00-00","ARS283","Jacinto Tchipa","","Paiva Mateus de Oliveira","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("303","Jandira da Cruz André Marcelino","Masculino","Cruz Marcelino E. Manuel","Juliana André José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923796155","923796155","","","0","2021-08-05","0000-00-00","ARS29","Sapú II","","Cruz Marcelino E. Manuel","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("304","Ana Kailane Tchisingi da Fonseca","Masculino","Fernado Ngola da Fonseca","Olivia da Silva Tchising","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","946351510","946351510","","","0","2009-03-03","0000-00-00","ARS310","Sapú II","","Fernado Ngola da Fonseca","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("305","Mirian Marina Morais João","Masculino","José Ngangui F. João","Laura da Costa Morais","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912229868/925623050","912229868/925623050","","","0","2008-10-19","0000-00-00","ARS33","Jacinto Tchipa","","José Ngangui F. João","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("306","Francisco Sangombe André","Masculino","Augusto Quessongo André","Adriana Mahuvi Songomba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937773139/939240720","937773139/939240720","","","0","2005-12-23","0000-00-00","ARS358","Sapú II","","Augusto Quessongo André","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("307","Bruno Alexandre Canga Alexandre","Masculino","Conceição Manuel Adão Alexandre","Francisca Domingos C. Canga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925929868/942666656","925929868/942666656","","","0","2007-08-04","0000-00-00","ARS458","Sapú II","","Conceição Manuel Adão Alexandre","2021-08-25 00:00:00","activo","2021-08-25");
INSERT INTO alunos VALUES("308","Euclides Amadeu Dias Kiala","Masculino","Carlos Lucas Kiala","Madalena Machinge Dias","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932724076/947102523","932724076/947102523","","","0","2005-01-23","0000-00-00","ARS465","Jacinto Tchipa","","Carlos Lucas Kiala","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("309","Aguinaldo Roque A. Chinhama","Masculino","Domingos Roque Chinhama","Cristina Maria Judith","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943625295/927049489","943625295/927049489","","","0","2009-07-09","0000-00-00","ARS47","Jacinto Tchipa","","Domingos Roque Chinhama","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("310","Zecilio António Victor Lamento","Masculino","António João Lamento","Inocencia dos Santos L. Sualala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923929960","923929960","","","0","2007-10-17","0000-00-00","ARS471","Sapú II","","António João Lamento","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("311","Ivone Elizandra C. Cassumbata","Masculino","Eulutério Rolinho Cassumbata","Elisa Fernandes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923207066/923269244","923207066/923269244","","","0","2008-05-03","0000-00-00","ARS493","Jacinto Tchipa","","Eulutério Rolinho Cassumbata","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("312","Ariclene Chiminho Fransisco Fortuna","Masculino","Salvador Gonsalveies Fortuna","Maria Chiminho Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926151018/934457178","926151018/934457178","","","0","2008-03-23","0000-00-00","ARS531","Sapú II","","Salvador Gonsalveies Fortuna","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("313","Joaquina Catumbela Adriana Gil ","Masculino","Francisco Gil","Adriana Catumbela","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923740949","923740949","","","0","2008-04-10","0000-00-00","ARS58","Bita Vacaria","","Francisco Gil","2021-07-16 00:00:00","activo","2021-07-16");
INSERT INTO alunos VALUES("314","Adelaide Larissalete T. Morais","Masculino","Mombaça Francisco Morais","Branca Perreira Teodoro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929422449","929422449","","","0","2006-04-08","0000-00-00","ARS586","Jacinto Tchipa","","Mombaça Francisco Morais","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("315","Gilda Paulo Faustino","Masculino","Mateus Manuel Faustino","Teresa João Sebastião Faustino","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923557029","923557029","","","0","2008-06-12","0000-00-00","ARS60","Sapú II","","Mateus Manuel Faustino","2021-07-16 00:00:00","activo","2021-07-16");
INSERT INTO alunos VALUES("316","Filber de Jesus Filho da Costa ","Masculino","Daniel Joaquim da Costa","Josefa Adão Cardoso Filho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","915434620","915434620","","","0","2007-07-20","0000-00-00","ARS636","Jacinto Tchipa","","Daniel Joaquim da Costa","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("317","Rosário Vasco Sebastião","Masculino","Helder José Sebastião","Rosa Manuel G. Vasco ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926845316","926845316","","","0","2008-06-12","0000-00-00","ARS643","Jacinto Tchipa","","Helder José Sebastião","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("318","Isabel Maravilha Bimbo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS677","","","","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("319","Alice António Augusto","Masculino","Silas Augusto","Ana Sunga António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944996909","944996909","","","0","2007-03-06","0000-00-00","ARS678","","","Silas Augusto","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("320","Etellvino Yamina Garcia ","Masculino","Afonso Real Garcia","Natália CH. Chitungo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923234948/926103256","923234948/926103256","","","0","2008-07-25","0000-00-00","ARS747","Jacinto Tchipa","","Afonso Real Garcia","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("321","Luciana Cajongo João Silveira","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS839","","","","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("322","Esmeralda Quipaca Ramos","Masculino","Adão Cardoso Ramos","Lúcia Mateus Quipaca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925223274/934854747","925223274/934854747","","","0","2008-04-05","0000-00-00","ARS854","","","Adão Cardoso Ramos","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("323","Silviano Segunda Gomes","Masculino","Faustino Vasco J. Gomes","Tamara de Almeida Cristovão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923848537/927305511","923848537/927305511","","","0","0000-00-00","0000-00-00","ARS888","Jacinto Tchipa","","Faustino Vasco J. Gomes","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("324","Ana Manuel Branco","Masculino","Lukeni Manuel M. Branco","........................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923709895/931296799","923709895/931296799","","","0","2007-10-12","0000-00-00","ARS96","Bita Vacaria","","Lukeni Manuel M. Branco","2021-07-26 00:00:00","activo","2021-07-26");
INSERT INTO alunos VALUES("325","Emilia de Jesus Carlos Holo","Masculino","Eliseu José Suca Olo","Isabel de Jesus pataca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924533457/940185806","924533457/940185806","","","0","2008-10-17","0000-00-00","ARS984","Jacinto Tchipa","","Eliseu José Suca Olo","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("326","Edmilcia Tavira","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1082","","","","2021-11-08 00:00:00","activo","2021-11-08");
INSERT INTO alunos VALUES("327","Josefina Nzuzi Ndambalo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1000","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("328","Elizandra Trindade Martins","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1003","","","","2021-10-11 00:00:00","activo","2021-10-11");
INSERT INTO alunos VALUES("329","Carolina Miluanga Massango","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1028","","","","2021-10-14 00:00:00","activo","2021-10-14");
INSERT INTO alunos VALUES("330","Delma Bernardo Manuel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS125","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("331","Lucombo Madalena Mbedi","Masculino","Pembele Diambo","...................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928830046","928830046","","","0","2008-10-08","0000-00-00","ARS230","Sapú II","","Pembele Diambo","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("332","Baptista António Geraldo","Masculino","Adriano Geraldo","Emilia João António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932668293","932668293","","","0","2005-03-30","0000-00-00","ARS243","Jacinto Tchipa","","Adriano Geraldo","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("333","Clésio Adriano Piriquito Féliz","Masculino","Olávio Adriano Félix","Margarida Periquito Félix","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997898099/927395584","997898099/927395584","","","0","2006-08-20","0000-00-00","ARS261","Jacinto Tchipa","","Olávio Adriano Félix","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("334","Manuel Nzage da Costa","Masculino","António Kiaco da Costa","Delfina Soares Nzange","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945597327","945597327","","","0","2006-03-29","0000-00-00","ARS286","Jacinto Tchipa","","António Kiaco da Costa","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("335","Isamara Manuel  Cabaça dos Santos","Masculino","Osvaldo António D. Dos Santos","Olga Manuel M. Cabaça","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926045588/924961668","926045588/924961668","","","0","2008-08-23","0000-00-00","ARS291","Bita Vacaria","","Osvaldo António D. Dos Santos","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("336","Rosélio Quinglês Jerónimo","Masculino","Isaias Emanuel Jerónimo","Maria Domingos Cuango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930257908","930257908","","","0","2007-05-01","0000-00-00","ARS31","Jacinto Tchipa","","Isaias Emanuel Jerónimo","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("337","Miguel Miala Tulante António","Masculino","Miala António","Tulante Tukala Ana","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933515041","933515041","","","0","2007-03-04","0000-00-00","ARS352","Sapú II","","Miala António","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("338","Edvaldo Daniel Matranga","Masculino","Calenga Matranga","Teresa Napingala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924627521","924627521","","","0","2007-01-16","0000-00-00","ARS449","Jacinto Tchipa","","Calenga Matranga","2021-08-24 00:00:00","activo","2021-08-24");
INSERT INTO alunos VALUES("339","Reine Lucas Muanzunga","Masculino","Joaquim Muanzunga","Zinha Lucas","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","940763466/924272143","940763466/924272143","","","0","2006-06-10","0000-00-00","ARS464","Jacinto Tchipa","","Joaquim Muanzunga","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("340","Tatiana Maria Fumaça Tchivassi","Masculino","Domingos Carlos Tchivassi","Domingas Ernesto Fumaça","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924334345/923540225","924334345/923540225","","","0","2004-09-17","0000-00-00","ARS501","Jacinto Tchipa","","Domingos Carlos Tchivassi","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("341","Etelvino Segundo Lopes","Masculino","André Lopes","Joana Filomena Segunodo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921103352/929950989","921103352/929950989","","","0","2007-07-31","0000-00-00","ARS555","Jacinto Tchipa","","André Lopes","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("342","Berta Lumbo de Carvalho","Masculino","Domingos Carvalho","Domingas Feite Ginga Lumbo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2008-12-28","0000-00-00","ARS558","","","Domingos Carvalho","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("343","Celma Manuela Sangunga","Masculino",".................","Natália Sangunga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924584014","924584014","","","0","2004-08-10","0000-00-00","ARS602","Sapú II","",".................","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("344","Bonifacio Vidal Victória","Masculino","Daniel Bonifácio","Teresa Victória Segunda Antunes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924349988","924349988","","","0","2005-12-12","0000-00-00","ARS787","Jacinto Tchipa","","Daniel Bonifácio","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("345","Avelina Chitula Bumba Bemjamim","Masculino","Costa Benjamim","Rosalina Bumba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937776410","937776410","","","0","2005-04-14","0000-00-00","ARS806","","","Costa Benjamim","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("346","Esmael Daniel Maiomona","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS809","","","","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("347","Juliana Fuanga C. Júlio","Masculino","Constantino Julio Buta","Mariana Nehonvogo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938289934","938289934","","","0","2001-10-10","0000-00-00","ARS841","Sapú II","","Constantino Julio Buta","2021-09-10 00:00:00","activo","2021-09-10");
INSERT INTO alunos VALUES("348","Fábio Marques Mata","Masculino","Vladimir Luis da Mata","Constancia Armando M. Marques","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923030407","923030407","","","0","2007-06-22","0000-00-00","ARS852","","","Vladimir Luis da Mata","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("349","Rafael Francisco Miranda","Masculino","Rafael Alberto Miranda","Rosa Manuel Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937666510","937666510","","","0","2006-03-14","0000-00-00","ARS857","","","Rafael Alberto Miranda","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("350","Mauro Sacalage Capamba","Masculino","Carlos Abel Capamba","Olivia j. Capamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923957700","923957700","","","0","2007-12-13","0000-00-00","ARS873","Jacinto Tchipa","","Carlos Abel Capamba","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("351","Graciano José Lopes","Masculino","José Luis João Lopes","Joana Adão Miguel José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928801703","928801703","","","0","2008-11-14","0000-00-00","ARS883","Jacinto Tchipa","","José Luis João Lopes","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("352","Manuel Francisco Ngola Caniguila","Masculino","Francisco Paulino V Caniguila","Maria David Ngola","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931541082","931541082","","","0","2008-02-28","0000-00-00","ARS885","Jacinto Tchipa","","Francisco Paulino V Caniguila","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("353","Deolinda Bernanrda","Masculino","..........................",".....................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932347460/925555347","932347460/925555347","","","0","2005-10-20","0000-00-00","ARS893","Sapú II","","..........................","2021-09-16 00:00:00","activo","2021-09-16");
INSERT INTO alunos VALUES("354","Anacleto King Pinho","Masculino","Morais Luduvino da C. Pinho","Maria das Dores B. King","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933136997/933136997","933136997/933136997","","","0","2008-05-23","0000-00-00","ARS919","Sapú II","","Morais Luduvino da C. Pinho","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("355","Jureuma Kiluange Salvador","Masculino","Lourenço André Salvador","Joséfa Francisco Kiluange","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923966523","923966523","","","0","2007-08-27","0000-00-00","ARS936","Jacinto Tchipa","","Lourenço André Salvador","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("356","Maria B.Capouco","Masculino","Aurelio dos Santos Capouco","Maria Julio Bento","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949796515","949796515","","","0","2008-08-27","0000-00-00","ARS938","Jacinto Tchipa","","Aurelio dos Santos Capouco","2021-11-18 00:00:00","activo","2021-11-18");
INSERT INTO alunos VALUES("357","Rafael Ludizaila Kama","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS944","","","","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("358","Felisberto Miguel Francisco","Masculino","Domingos João Francisco","Branca Miguel Pedro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923557999/913800867","923557999/913800867","","","0","2007-07-16","0000-00-00","ARS947","Sapú II","","Domingos João Francisco","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("359","Fernanda Vieira Sebastiao","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS965","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("360","Gelson Gonga José Cabaça","Masculino","Fernandes Mucuaxi Gonga","Feiiciana Antonio José Cabaça","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923444415","923444415","","","0","2004-08-12","0000-00-00","ARS969","Jacinto Tchipa","","Fernandes Mucuaxi Gonga","2021-09-30 00:00:00","activo","2021-09-30");
INSERT INTO alunos VALUES("361","Maribelo Carlos Luis Cabanga","Masculino","Contreira Artur M. Cabanga","Ana Geraldo Luis Cabanga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924158985","924158985","","","0","2001-09-18","0000-00-00","ARS982","Bita Vacaria","","Contreira Artur M. Cabanga","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("362","Fátima Virginia Fernando","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS990","","","","2021-10-05 00:00:00","activo","2021-10-05");
INSERT INTO alunos VALUES("363","Arsenio Mariano Vunge","Masculino","Avelino Joáo Vunge","Engracia S Mariano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923910700","923910700","","","0","2008-02-13","0000-00-00","ARS1060","Sapú II","","Avelino Joáo Vunge","2021-11-05 00:00:00","activo","2021-11-05");
INSERT INTO alunos VALUES("364","Belmiro Domingos José","Masculino","Belmiro José L. Félix","Maria da Conceição R. Domingos ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928630097/935887277","928630097/935887277","","","0","2009-06-10","0000-00-00","ARS321","Bita Vacaria","","Belmiro José L. Félix","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("365","Marcelino Maza Moises","Masculino","Mário Dias Moisés","Marta Raquel Maza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931831562/927989658","931831562/927989658","","","0","2007-05-27","0000-00-00","ARS327","Bita Vacaria","","Mário Dias Moisés","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("366","Crisostomo Kawewe S. Soma","Masculino","José Eliseu Soma","Valéria Lúcia Sacomboco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926661329/937769675","926661329/937769675","","","0","2009-08-16","0000-00-00","ARS367","Bita Vacaria","","José Eliseu Soma","2021-08-17 00:00:00","activo","2021-08-17");
INSERT INTO alunos VALUES("367","Solange Cláudia da Silva Sabino","Masculino","Domingos Safumbele Sabino","Fernanda Marisa P. da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931603489","931603489","","","0","2009-06-26","0000-00-00","ARS369","Jacinto Tchipa","","Domingos Safumbele Sabino","2021-08-17 00:00:00","activo","2021-08-17");
INSERT INTO alunos VALUES("368","Plácida Nemia Cassequel Alexandre","Masculino","António Ferreira Alexandre","Conceição Domingos C. Alexandre","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924206207/924206208","924206207/924206208","","","0","2009-04-08","0000-00-00","ARS379","Jacinto Tchipa","","António Ferreira Alexandre","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("369","Kelcia da Conceição A. Lourenço","Masculino","Domingos da Conceição Lourenço","Jilsa Fausto F. António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937448958/997266768","937448958/997266768","","","0","2010-02-23","0000-00-00","ARS388","Bita Vacaria","","Domingos da Conceição Lourenço","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("370","João Lucas da Costa Pinto","Masculino","Gilberto Pinto ","Fatima Tulante da Costa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936296190","936296190","","","0","2008-04-27","0000-00-00","ARS418","Sapú II","","Gilberto Pinto ","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("371","Cleiton da Silva Cadete","Masculino","Cláudio António G. Cadete ","Jorgina Augusto da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922805057","922805057","","","0","2008-04-22","0000-00-00","ARS426","Jacinto Tchipa","","Cláudio António G. Cadete ","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("372","Jacira Celeste Máquina","Masculino","Valdimiro José Máquina",".......................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923385250","923385250","","","0","2008-04-28","0000-00-00","ARS433","Boa Esperança","","Valdimiro José Máquina","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("373","Isabel Bala Kaunda","Masculino","Benedito Morais Kaunda","Teresa Paulo J. Bala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923385250","923385250","","","0","2008-09-11","0000-00-00","ARS434","Boa Esperança","","Benedito Morais Kaunda","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("374","José Augusto Saude dos Santos","Masculino","José Augusto Perreira dos Santos","Júlia Agostinho Saudade","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928261402","928261402","","","0","2008-08-28","0000-00-00","ARS454","Bita Vacaria","","José Augusto Perreira dos Santos","2021-08-24 00:00:00","activo","2021-08-24");
INSERT INTO alunos VALUES("375","Lucinia Filho Basto Alfredo","Masculino","Alberto Basto Alfredo","Leonora da Costa Filho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923326642","923326642","","","0","2009-03-09","0000-00-00","ARS478","Sapú II","","Alberto Basto Alfredo","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("376","Reine Joaquim Muanzunga","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS479","","","","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("377","Jesua Roseth Lopes da Rocha","Masculino","Emanuel Trício António da Rocha","Urraca Detaly Pedro Lópes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923455248","923455248","","","0","2008-03-28","0000-00-00","ARS489","Bita Vacaria","","Emanuel Trício António da Rocha","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("378","Rossana Ferreira de G. Pinto","Masculino","Luís Monteiro de G. Pinto","Marina da Fonseca T. F. Pinto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923216084/921772658","923216084/921772658","","","0","2008-05-26","0000-00-00","ARS498","Jacinto Tchipa","","Luís Monteiro de G. Pinto","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("379","Fabiana Bireuma Francisco","Masculino","Domingos Paulino Francisco","Conceição Nhanga Cassua","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","995142774","995142774","","","0","2008-08-12","0000-00-00","ARS533","Sapú II","","Domingos Paulino Francisco","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("380","Francisca Faustino António","Masculino","António Fernando","Albertina Faustino Ngonga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925301485","925301485","","","0","2021-08-31","0000-00-00","ARS572","Jacinto Tchipa","","António Fernando","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("381","Belmiro Morais Dimame","Masculino","Marcos Vunge Dimame","Umbelina Mateus Morais","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926446934","926446934","","","0","2005-02-10","0000-00-00","ARS574","Jacinto Tchipa","","Marcos Vunge Dimame","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("382","Balbina Felizarda Lourreiro Mateus","Masculino","José Adão Borges Mateus","Beatriz Adelino J. Lourenço","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923977351/927075474","923977351/927075474","","","0","2008-11-25","0000-00-00","ARS628","Jacinto Tchipa","","José Adão Borges Mateus","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("383","Violeta Cuzanga Fernando Firmino","Masculino","Fernando Firmino","Joana Fernando","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923536881","923536881","","","0","2007-05-14","0000-00-00","ARS639","Sapú II","","Fernando Firmino","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("384","Leonel Diogo Vunda","Masculino","Luis Vunda","Esmeralda Francisco Diogo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921440006","921440006","","","0","2008-09-17","0000-00-00","ARS641","Sapú II","","Luis Vunda","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("385","Ana Isabela Fonseca Diogo","Masculino","Garcia Paulo Diogo","Domingas Estevão da Fonseca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923683586/924141183","923683586/924141183","","","0","2010-03-27","0000-00-00","ARS644","Jacinto Tchipa","","Garcia Paulo Diogo","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("386","Cláudio Fiança Quinguri","Masculino","Paciencia Domingos Quinguri","Dorca Fiança Canda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929380217/923819480","929380217/923819480","","","0","2007-04-30","0000-00-00","ARS667","Sapú II","","Paciencia Domingos Quinguri","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("387","Edson Quingongo Garcia João","Masculino","Edson Q. P. João","Engracia da Costa G. João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943823085/927099967","943823085/927099967","","","0","2009-04-02","0000-00-00","ARS695","Sapú II","","Edson Q. P. João","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("388","Leticia Vemba Crisitina","Masculino","António Abílio B. Crisitna","Ana de Fátima V. Crisitna","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912528814","912528814","","","0","2007-10-10","0000-00-00","ARS708","Sapú II","","António Abílio B. Crisitna","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("389","Constantino Correia Machado","Masculino","Lourenço António Machado","Nazareth Bernardo Correia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923488128/927919979","923488128/927919979","","","0","2007-07-16","0000-00-00","ARS731","Jacinto Tchipa","","Lourenço António Machado","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("390","Elizeth Juíz Caetano ","Masculino","Lopes Capita Caetano","Madalena João Juiz","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931554063","931554063","","","0","2008-06-26","0000-00-00","ARS773","Jacinto Tchipa","","Lopes Capita Caetano","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("391","Lukeni Domingos Gonsalveis João","Masculino","Capita Neto","Luisa do Carmo L. Gonsalveis ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923133813","923133813","","","0","2008-07-10","0000-00-00","ARS778","Jacinto Tchipa","","Capita Neto","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("392","Maria Alexandre Mbengi","Masculino","Mbengi Mauricio","...................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","996445877","996445877","","","0","2007-03-11","0000-00-00","ARS781","Jacinto Tchipa","","Mbengi Mauricio","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("393","Luzia Karina da Costa Texeira","Masculino","João Lourenço Texeira","Cecília Iracem F. da Costa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","990917951/923917951","990917951/923917951","","","0","2009-03-04","0000-00-00","ARS825","Jacinto Tchipa","","João Lourenço Texeira","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("394","Miguel Azevedo Martins","Masculino","Francisco Wolo Martins","Sangui Elizabeth","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945486765","945486765","","","0","2009-01-06","0000-00-00","ARS910","Jacinto Tchipa","","Francisco Wolo Martins","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("395","Henriqueta Kauha","Masculino","Abel Chitoma Kauaha","Natália Cassova Samuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937925262","937925262","","","0","2008-12-22","0000-00-00","ARS974","Viana","","Abel Chitoma Kauaha","2021-10-01 00:00:00","activo","2021-10-01");
INSERT INTO alunos VALUES("396","Michel Débora Bongue Varela","Masculino","Joaquim Gomes B. Varela","Angelina Avombo B. Varela","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923491582","923491582","","","0","2009-03-19","0000-00-00","ARS1076","Auto Pechicha","","Joaquim Gomes B. Varela","2021-11-17 00:00:00","activo","2021-11-17");
INSERT INTO alunos VALUES("397","Lauriana Manuel Dallas","Masculino","Ezequiel Ramos Dalas","Helena Manuel A. Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927724410/936659291","927724410/936659291","","","0","2009-05-07","0000-00-00","ARS105","Bita Vacaria","","Ezequiel Ramos Dalas","2021-07-28 00:00:00","activo","2021-07-28");
INSERT INTO alunos VALUES("398","Ilda João Miguel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS122","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("399","Eliseu Gabriel Bernardo","Masculino","José Manuel Bernardo","Maria Lucas Gabriel Bernardo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929973173/925869327","929973173/925869327","","","0","2009-02-15","0000-00-00","ARS151","Cinquentinha","","José Manuel Bernardo","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("400","Argentino Gaspar Manuel Pedro","Masculino","Gaspar Neto Pedro","Rita Adão Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923059591","923059591","","","0","2009-08-31","0000-00-00","ARS152","Jacinto Tchipa","","Gaspar Neto Pedro","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("401","Bruno Manuel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS16","Jacinto Tchipa","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("402","Marisa Aida Diogo Mangueira","Masculino","António da Fonseca Mangueira","Romana Domingos Diogo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924108006/945573363","924108006/945573363","","","0","2008-12-07","0000-00-00","ARS161","Jacinto Tchipa","","António da Fonseca Mangueira","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("403","Vivalda da Conceição André Felix","Masculino","Pedro Domingos J. Felix","Telma Baptista André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924213865/925118363","924213865/925118363","","","0","2009-10-11","0000-00-00","ARS164","Sapú II","","Pedro Domingos J. Felix","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("404","Afonso Armindo Cazola","Masculino","Manuel Alcínio C. Cazola","Natália Armindo André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927703307/925674399","927703307/925674399","","","0","2008-09-21","0000-00-00","ARS184","Sapú II","","Manuel Alcínio C. Cazola","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("405","Eliude Domingos Mucuaxi","Masculino","Manuel Mucuaxi","Laurinda Pedro Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923444415/925222629","923444415/925222629","","","0","2008-12-02","0000-00-00","ARS187","Bita Vacaria","","Manuel Mucuaxi","2021-08-04 00:00:00","activo","2021-08-04");
INSERT INTO alunos VALUES("406","Paulino Justo Hombo Zambi","Masculino","Narciso Paulo Zambi","Ana Justina Hombo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929061397","929061397","","","0","2008-06-12","0000-00-00","ARS195","Belo Horizonte","","Narciso Paulo Zambi","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("407","Soraia Mendes Pires Martias","Masculino","Raimundo Pires C. Matias ","Teresa Domingos Mendes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933509289","933509289","","","0","2009-03-19","0000-00-00","ARS198","Jacinto Tchipa","","Raimundo Pires C. Matias ","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("408","Franyhela Helena Lisboa Gomes","Masculino","Francisco Manuel Gomes","Ana Marisa Cassoma L. Gomes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921558526/924791529","921558526/924791529","","","0","2009-05-05","0000-00-00","ARS208","Sapú II","","Francisco Manuel Gomes","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("409","Edith Amélia Bento Fonseca","Masculino","Aguilar Mafuca Fonseca","Clélia Cecília da Silva Bento","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924528406","924528406","","","0","2009-07-26","0000-00-00","ARS232","Sapú II","","Aguilar Mafuca Fonseca","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("410","Eliandro Jorge António Bragança","Masculino","Ricardo Adolfo Guimarães","Catarina José António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926618569/924379158","926618569/924379158","","","0","2007-09-06","0000-00-00","ARS256","Sapú II","","Ricardo Adolfo Guimarães","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("411","Isabel Maria Manuel Dalas","Masculino","João Dala","Maria Nakuela Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923568007/996041123","923568007/996041123","","","0","2009-07-23","0000-00-00","ARS272","Sapú II","","João Dala","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("412","Laudiano Kioseque Miguel Perreira","Masculino","Laudiano António Perreira","Dionisia Pedro Miguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927453429/925256661","927453429/925256661","","","0","2009-06-15","0000-00-00","ARS277","Jacinto Tchipa","","Laudiano António Perreira","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("413","Maravilha Necandi E. Vasconselho","Masculino","Hernani Júnior C. Vasconselho ","Domingas Lucrecia da S. Etande","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921224020","921224020","","","0","2009-02-15","0000-00-00","ARS297","Jacinto Tchipa","","Hernani Júnior C. Vasconselho ","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("414","Benedito de Sousa Tomás","Masculino","Almeida Kapango Tomás","Diovalda da Graça G. De Sousa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923064272/915123439","923064272/915123439","","","0","2009-10-25","0000-00-00","ARS304","Sapú II","","Almeida Kapango Tomás","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("415","Aida João Macuenda","Masculino","Konda João","Nzumba Macuenda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925604764","925604764","","","0","2007-05-05","0000-00-00","ARS306","Sapú II","","Konda João","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("416","Fineza Inango Bela","Masculino","Mbenza Bela","Inésia Feliz Inango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925604764","925604764","","","0","2009-02-04","0000-00-00","ARS308","Sapú II","","Mbenza Bela","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("417","Gercy Wamy Manue Brandão","Masculino","André de Jesus Brandão","Victória João A. Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923425994/931534094","923425994/931534094","","","0","2009-11-28","0000-00-00","ARS319","Jacinto Tchipa","","André de Jesus Brandão","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("418","Filipe Manuel João","Masculino","Artur Pereira João","Elisa José Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934640889/923312803","934640889/923312803","","","0","2009-05-08","0000-00-00","ARS482","Macom","","Artur Pereira João","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("419","Joveth de Lemos Miguel","Masculino","João Maria Miguel","Maria de Lemos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943170355/924989502","943170355/924989502","","","0","0000-00-00","0000-00-00","ARS607","Bita Vacaria","","João Maria Miguel","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("420","Dinis Sapalo Domingos ","Masculino","Francisco Silvano Domingos","Helena Quaresma F. Sapalo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926041034/998041034","926041034/998041034","","","0","2009-06-30","0000-00-00","ARS624","Jacinto Tchipa","","Francisco Silvano Domingos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("421","Lenine Emanuel Texeira Dange","Masculino","Emanuel Ginga Dange","Filipa Domingos Texeira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930394312","930394312","","","0","2008-09-18","0000-00-00","ARS634","Jacinto Tchipa","","Emanuel Ginga Dange","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("422","Victoria Fernandes José","Masculino","Santos Albano José","Teresa Fernandes José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924109194","924109194","","","0","2008-09-05","0000-00-00","ARS648","Bita Vacaria","","Santos Albano José","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("423","Laura Maria Filipe","Masculino",".............................","Lérica Maria Filipe","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930054452","930054452","","","0","2006-01-21","0000-00-00","ARS70","Viana","",".............................","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("424","Josélia Patricia Sebastião","Masculino","Josimar José F. Sebastião","Evalise Pombal Caiamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923742030/923828507","923742030/923828507","","","0","2009-08-28","0000-00-00","ARS717","Sapú II","","Josimar José F. Sebastião","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("425","Carlos Luco Fararias","Masculino","Carlos Gaspar Faria","Esperança Manuel Luco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944891145","944891145","","","0","2018-07-24","0000-00-00","ARS782","Belo Horizonte","","Carlos Gaspar Faria","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("426","Rodrigo Francisco Eduardo Gomes","Masculino","Francisco Eugénia Francisco","Sara Eduardo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2007-03-30","0000-00-00","ARS79","Jacinto Tchipa","","Francisco Eugénia Francisco","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("427","Alice Cristina C. Caboco","Masculino","Agostinho Sebastião Caboco","Elisabeth António Correia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923931716","923931716","","","0","2009-08-28","0000-00-00","ARS87","Bita Vacaria","","Agostinho Sebastião Caboco","2021-07-21 00:00:00","activo","2021-07-21");
INSERT INTO alunos VALUES("428","Emanuel Ambrosio Francisco","Masculino","Armindo Joaquim B. Francisco","Apolinaria G. Ambrosio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","946004724","946004724","","","0","2009-06-10","0000-00-00","ARS89","Bita Vacaria","","Armindo Joaquim B. Francisco","2021-07-16 00:00:00","activo","2021-07-16");
INSERT INTO alunos VALUES("429","Antonica Tatiana Simão Rodrigues","Masculino","António D. B. Rodrigues","Sebastiana da G. S. Rodrigues","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2009-05-29","0000-00-00","ARS9","Jacinto Tchipa","","António D. B. Rodrigues","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("430","Paulo E. D. Pedro","Masculino","Luis E. Pedro","Marleni Damiao","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923885998","923885998","","","0","2008-05-13","0000-00-00","ARS971","Jacinto Tchipa","","Luis E. Pedro","2021-09-30 00:00:00","activo","2021-09-30");
INSERT INTO alunos VALUES("431","Osvaldo Eugénio Castelo Bengue","Masculino","Tomás Bengui","Teresa António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927535133","927535133","","","0","2007-12-17","0000-00-00","ARS752","Jacinto Tchipa","","Tomás Bengui","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("432","Alessandro Luis André Júnior","Masculino","António Francisco Luis Junior","Catarina André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923462455","923462455","","","0","2009-11-17","0000-00-00","ARS911","Jacinto Tchipa","","António Francisco Luis Junior","2021-08-04 00:00:00","activo","2021-08-04");
INSERT INTO alunos VALUES("433","Americo Makanda Fernandes","Masculino","Fernando Domingos","Luisa Domingos K. Fernando","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924211243","924211243","","","0","2009-06-08","0000-00-00","ARS674","Bita Vacaria","","Fernando Domingos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("434","Angela Agostinho","Masculino","Marcelo Francisco","Lucia Agostinho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927155017","927155017","","","0","2007-12-28","0000-00-00","ARS977","Bita Vacaria","","Marcelo Francisco","2021-09-29 00:00:00","activo","2021-09-29");
INSERT INTO alunos VALUES("435","Autilio Makiesse M Quicalango","Masculino","Nelson Quifuba Quicalango","Deolinda Simão Mariano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923316092/923910700","923316092/923910700","","","0","2010-05-05","0000-00-00","ARS1023","Sapú II","","Nelson Quifuba Quicalango","2021-10-06 00:00:00","activo","2021-10-06");
INSERT INTO alunos VALUES("436","Braulio António Geraldo","Masculino","Adriano Geraldo","Emilia João António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932668293","932668293","","","0","2009-07-23","0000-00-00","ARS242","Jacinto Tchipa","","Adriano Geraldo","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("437","Carlos Alberto Canda G. Figuereido","Masculino","Carlos António G. Figuereido","Teresa Barroso Canda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923649448","923649448","","","0","2009-12-09","0000-00-00","ARS150","Sapú II","","Carlos António G. Figuereido","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("438","Cassiano Magalhães da Costa","Masculino","Costa Domingos","Beatriz Magalhães","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923225845","923225845","","","0","2028-11-06","0000-00-00","ARS4","Jacinto Tchipa","","Costa Domingos","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("439","Cipriano José Gaspar","Masculino","Inoc Gavião João Gaspar","Domingas Cipriano José Gaspar","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2007-06-11","0000-00-00","ARS276","Jacinto Tchipa","","Inoc Gavião João Gaspar","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("440","Eliane Jandira Manuel Mendes","Masculino","Fernandos Mendes","Mariana João Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","994504254/926858277","994504254/926858277","","","0","2010-04-23","0000-00-00","ARS735","Bita Vacaria","","Fernandos Mendes","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("441","Elizandro Tavira","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1070","","","","2021-11-08 00:00:00","activo","2021-11-08");
INSERT INTO alunos VALUES("442","Elves Oliveira Tavira","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1069","","","","2021-11-08 00:00:00","activo","2021-11-08");
INSERT INTO alunos VALUES("443","Ermelinda Quisueia Culua","Masculino","Bonde António Culua","Cecélia Neves Quissueia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927118113/934837710","927118113/934837710","","","0","2008-10-20","0000-00-00","ARS173","Sapú II","","Bonde António Culua","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("444","Eugenio King Pinto","Masculino","Morais Luduvino da C. Pinho","Maria das Dores B. King","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933136997/933136997","933136997/933136997","","","0","2009-09-25","0000-00-00","ARS918","Sapú II","","Morais Luduvino da C. Pinho","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("445","Fernando Augusto Correia","Masculino","Pedro Pascoal Correia","Tilde Francisco Augusto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923904275/939793703","923904275/939793703","","","0","2009-09-21","0000-00-00","ARS876","Sagrada Esperança","","Pedro Pascoal Correia","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("446","Fernando Jorge Sacana","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS818","","","","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("447","Gabriela Jovita Domingos de Oliveira","Masculino","Domingos João de Oliveira","Luzia Mbaca Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923281060/931616637","923281060/931616637","","","0","2009-05-19","0000-00-00","ARS170","Sapú II","","Domingos João de Oliveira","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("448","Gelson Marcelo José","Masculino","João Figuereira José",".......................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929422448","929422448","","","0","0000-00-00","0000-00-00","ARS584","Jacinto Tchipa","","João Figuereira José","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("449","Irene Esperança Carlos Pedro","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS961","","","","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("450","Julia Ngola Kiari","Masculino","Josue Mateus Kiari","Neusa Joaquiim Ngola","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","994590745","994590745","","","0","2009-11-24","0000-00-00","ARS963","Jacinto Tchipa","","Josue Mateus Kiari","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("451","Júlio Mato Landu","Masculino","Julião Mato Pedro","Tinani Landu","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924198915/913104289","924198915/913104289","","","0","2009-09-29","0000-00-00","ARS217","Bita Vacaria","","Julião Mato Pedro","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("452","Manuel Filomeno S. André ","Masculino","Manuel M. V. André","Joana F. S. André ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925422262","925422262","","","0","2010-04-06","0000-00-00","ARS837","Sapú II","","Manuel M. V. André","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("453","Miriam Silva Adão","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS844","","","","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("454","Rosa Quipaca Ramos","Masculino","Adão Cardoso Ramos","Lúcia Mateus Quipaca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925223274/934854747","925223274/934854747","","","0","2011-06-25","0000-00-00","ARS853","","","Adão Cardoso Ramos","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("455","Saladino Julio Manuel dos Santos","Masculino","Daniel Manuel","Antonia Jamba Julio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923474172","923474172","","","0","2008-02-07","0000-00-00","ARS970","Jacinto Tchipa","","Daniel Manuel","2021-09-30 00:00:00","activo","2021-09-30");
INSERT INTO alunos VALUES("456","Solange José Augusto","Masculino","Silas Augusto","Ana Sunga António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944996909","944996909","","","0","2009-05-21","0000-00-00","ARS679","","","Silas Augusto","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("457","Zeno Calei Certo Contreira","Masculino","António Figueira Contreira","Deolinda de Jesus C. Kumbi","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937304865","937304865","","","0","2010-11-24","0000-00-00","ARS891","Jacinto Tchipa","","António Figueira Contreira","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("458","Adelaide António","Masculino",".......................","Luisa Natividade António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925724974","925724974","","","0","2008-05-25","0000-00-00","ARS437","Jacinto Tchipa","",".......................","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("459","Ana Keto Kama","Masculino","Bisalu Saka Kama",".................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926161038","926161038","","","0","2010-05-07","0000-00-00","ARS529","Sapú II","","Bisalu Saka Kama","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("460","Antónia Lourena U. Tchindumbo","Masculino","António Chimndumbo","Isabel Capato Ulica","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923040358/926567997","923040358/926567997","","","0","2010-07-09","0000-00-00","ARS784","Belo Horizonte","","António Chimndumbo","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("461","António Ribas Manuel Franciso","Masculino","Jorge Manuel de Oliveira","Zenilda Manuel Marcolino","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","990523795/923523795","990523795/923523795","","","0","2009-07-11","0000-00-00","ARS909","Bita Vacaria","","Jorge Manuel de Oliveira","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("462","Benvinda Fernandes Alexandre","Masculino","Domingos Sebastião","Álveis Alexandre","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932102428","932102428","","","0","2010-02-22","0000-00-00","ARS422","Sapú II","","Domingos Sebastião","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("463","Domiana N. Luciano Calei","Masculino","Faustino Calei","Laurinda Lito Luciano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923440823/936785195","923440823/936785195","","","0","2010-03-18","0000-00-00","ARS739","Jacinto Tchipa","","Faustino Calei","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("464","Domingas Francisco Dikunji","Masculino","Francisco João Martins Dikunji","Gracieth Simão Francisco Dikunji","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928378628/998378628","928378628/998378628","","","0","2010-06-06","0000-00-00","ARS567","Bita Vacaria","","Francisco João Martins Dikunji","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("465","Edvania Elicove Mariano","Masculino","José Mariano T. Duarte","Maria da Conceição","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923365659/923943484","923365659/923943484","","","0","2010-05-11","0000-00-00","ARS724","Sapú II","","José Mariano T. Duarte","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("466","Eva Conceição Caetano Sebastião","Masculino","Fernando Manuel P. Sebastião","Isabel Manuel Caetano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923317996/946888034","923317996/946888034","","","0","2010-09-05","0000-00-00","ARS522","Sapú II","","Fernando Manuel P. Sebastião","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("467","Hernane Enzo Manuel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS127","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("468","Isabel Yolanda Pacheco Alberto","Masculino","Orlando Constantino V. Alberto","Isabel Avelina Pacheco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924219931/917612782","924219931/917612782","","","0","2009-01-03","0000-00-00","ARS91","Sapú II","","Orlando Constantino V. Alberto","2021-07-22 00:00:00","activo","2021-07-22");
INSERT INTO alunos VALUES("469","Ivone da Conceição Manuel","Masculino","................","Ana Luis Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","948945337","948945337","","","0","2010-08-27","0000-00-00","ARS280","Belo Horizonte","","................","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("470","Jaime Texeira Dange","Masculino","Emanuel Ginga Dange","Filipa Domingos Texeira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930394312","930394312","","","0","2010-08-15","0000-00-00","ARS633","Jacinto Tchipa","","Emanuel Ginga Dange","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("471","José Hebo João","Masculino","Gaspar Junior S. João","Tatiana Maria Hebo Gunza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927139600","927139600","","","0","2006-09-02","0000-00-00","ARS687","Sapú II","","Gaspar Junior S. João","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("472","Kelvio Soares Cravid","Masculino","Milton de Assunção Cravid","Maria da Conçeição Luanda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923761745/990761745","923761745/990761745","","","0","2010-02-12","0000-00-00","ARS608","Bita Vacaria","","Milton de Assunção Cravid","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("473","Leonardo Nkiawete Júnior","Masculino","Leão Mambu Júnior","Sofia Muntu Nkiawete","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945637725","945637725","","","0","2010-09-01","0000-00-00","ARS424","Sapú II","","Leão Mambu Júnior","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("474","Lucrécia Garcia Capenda","Masculino","Rui Capenda","Nkuina Paulina Fundo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923632751/924097909","923632751/924097909","","","0","2007-11-07","0000-00-00","ARS295","Jacinto Tchipa","","Rui Capenda","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("475","Luisa Maravilha Kanda Bimbo","Masculino","João Simão Bimbo","Masakidi Nsoki","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934618906","934618906","","","0","2009-09-14","0000-00-00","ARS365","Sapú II","","João Simão Bimbo","2021-08-17 00:00:00","activo","2021-08-17");
INSERT INTO alunos VALUES("476","Macário Chivela U. Chindumbo","Masculino","António Chindumbo","Isabel Capato Ulica","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923040358/926567997","923040358/926567997","","","0","2008-01-04","0000-00-00","ARS785","Belo Horizonte","","António Chindumbo","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("477","Manuela Mafuta N.  Cachala","Masculino","João Baptista Cachala","Filomena Namela","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923492721/923561482","923492721/923561482","","","0","2007-02-02","0000-00-00","ARS680","Bita Vacaria","","João Baptista Cachala","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("478","Marilda Ruth Damião José","Masculino","Domingos Adão José","Teresa Gaspar Damião","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931551976/924895704","931551976/924895704","","","0","2010-09-16","0000-00-00","ARS274","Bita Vacaria","","Domingos Adão José","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("479","Marisa Ngunza Bungo","Masculino","Afonso Ezequiel Nate Bungo","Milena Guilhermina H. Gunza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927139600/997743505","927139600/997743505","","","0","2009-12-04","0000-00-00","ARS505","Jacinto Tchipa","","Afonso Ezequiel Nate Bungo","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("480","Marta Sebastião","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1054","","","","2021-11-03 00:00:00","activo","2021-11-03");
INSERT INTO alunos VALUES("481","Miuma Benza Dias dos Santos","Masculino","Mateus Francisco Dias dos Santos","Lemba Correia B. Dias dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912238140/933255469","912238140/933255469","","","0","2010-01-28","0000-00-00","ARS497","Sapú II","","Mateus Francisco Dias dos Santos","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("482","Odeth dos Santos António","Masculino","Mário Domingos Anónio","Domingas dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2006-12-07","0000-00-00","ARS414","Jacinto Tchipa","","Mário Domingos Anónio","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("483","Osvaldo Domingos Monteiro","Masculino","José Alberto T. Monteiro","Evilina Monteiro Daimone","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945466530/931968746","945466530/931968746","","","0","2009-12-12","0000-00-00","ARS827","Jacinto Tchipa","","José Alberto T. Monteiro","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("484","Paulo António dos Santos","Masculino","Paulo Catatina dos Santos","Nelsa Cláudia Alberto António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947337793/991580788","947337793/991580788","","","0","2009-07-03","0000-00-00","ARS629","Jacinto Tchipa","","Paulo Catatina dos Santos","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("485","Ricardo Joaquim Domingos","Masculino",".......................","Guilhermina da Conceição Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924371235","924371235","","","0","2009-05-08","0000-00-00","ARS573","Jacinto Tchipa","",".......................","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("486","Rogério Perreira Rodrigues","Masculino","Gilberto Rodrigues","Lembinha Martins Perreira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928348878/927688007","928348878/927688007","","","0","2008-03-23","0000-00-00","ARS332","Sapú II","","Gilberto Rodrigues","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("487","Romão Carlos Agostinho Diogo","Masculino","Romão Diogo Fernandes","Tânia Carlos Agostinho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924180197","924180197","","","0","2010-03-19","0000-00-00","ARS538","Bequessa","","Romão Diogo Fernandes","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("488","Suzana Mayoyo Nicolau Marcos","Masculino","Abel Marcos","Sara Teresa Nicolau","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930616334","930616334","","","0","2011-10-10","0000-00-00","ARS672","Bita Vacaria","","Abel Marcos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("489","Tânia Luzia Bartolomeu Queta","Masculino","Domingos Alberto A. Queta","Josefina Cufina","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934317717","934317717","","","0","2009-03-25","0000-00-00","ARS338","Jacinto Tchipa","","Domingos Alberto A. Queta","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("490","Teles Calenga Daniel Matranga","Masculino","Calenga Matranga","Teresa Napingala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924627521","924627521","","","0","2010-02-21","0000-00-00","ARS143","Jacinto Tchipa","","Calenga Matranga","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("491","Valquiria Daniel Francisco","Masculino","Agostinho Joaquim Francisco","Paulina António Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930404340","930404340","","","0","2008-10-04","0000-00-00","ARS320","Jacinto Tchipa","","Agostinho Joaquim Francisco","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("492","Vanda João Lundange","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS514","","","","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("493","Victoria Tchapanga N. Cangombe","Masculino","Severina Chissolossi Cangombe","Benvinda Nalumbo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","992042230/940367608","992042230/940367608","","","0","2008-11-07","0000-00-00","ARS552","Sapú II","","Severina Chissolossi Cangombe","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("494","Adelaide António","Masculino",".......................","Luisa Natividade António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925724974","925724974","","","0","2008-05-25","0000-00-00","ARS437","Jacinto Tchipa","",".......................","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("495","Ana Keto Kama","Masculino","Bisalu Saka Kama",".................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926161038","926161038","","","0","2010-05-07","0000-00-00","ARS529","Sapú II","","Bisalu Saka Kama","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("496","Antónia Lourena U. Tchindumbo","Masculino","António Chimndumbo","Isabel Capato Ulica","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923040358/926567997","923040358/926567997","","","0","2010-07-09","0000-00-00","ARS784","Belo Horizonte","","António Chimndumbo","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("497","António Ribas Manuel Franciso","Masculino","Jorge Manuel de Oliveira","Zenilda Manuel Marcolino","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","990523795/923523795","990523795/923523795","","","0","2009-07-11","0000-00-00","ARS909","Bita Vacaria","","Jorge Manuel de Oliveira","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("498","Benvinda Fernandes Alexandre","Masculino","Domingos Sebastião","Álveis Alexandre","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932102428","932102428","","","0","2010-02-22","0000-00-00","ARS422","Sapú II","","Domingos Sebastião","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("499","Domiana N. Luciano Calei","Masculino","Faustino Calei","Laurinda Lito Luciano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923440823/936785195","923440823/936785195","","","0","2010-03-18","0000-00-00","ARS739","Jacinto Tchipa","","Faustino Calei","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("500","Domingas Francisco Dikunji","Masculino","Francisco João Martins Dikunji","Gracieth Simão Francisco Dikunji","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928378628/998378628","928378628/998378628","","","0","2010-06-06","0000-00-00","ARS567","Bita Vacaria","","Francisco João Martins Dikunji","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("501","Edvania Elicove Mariano","Masculino","José Mariano T. Duarte","Maria da Conceição","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923365659/923943484","923365659/923943484","","","0","2010-05-11","0000-00-00","ARS724","Sapú II","","José Mariano T. Duarte","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("502","Eva Conceição Caetano Sebastião","Masculino","Fernando Manuel P. Sebastião","Isabel Manuel Caetano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923317996/946888034","923317996/946888034","","","0","2010-09-05","0000-00-00","ARS522","Sapú II","","Fernando Manuel P. Sebastião","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("503","Hernane Enzo Manuel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS127","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("504","Isabel Yolanda Pacheco Alberto","Masculino","Orlando Constantino V. Alberto","Isabel Avelina Pacheco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924219931/917612782","924219931/917612782","","","0","2009-01-03","0000-00-00","ARS91","Sapú II","","Orlando Constantino V. Alberto","2021-07-22 00:00:00","activo","2021-07-22");
INSERT INTO alunos VALUES("505","Ivone da Conceição Manuel","Masculino","................","Ana Luis Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","948945337","948945337","","","0","2010-08-27","0000-00-00","ARS280","Belo Horizonte","","................","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("506","Jaime Texeira Dange","Masculino","Emanuel Ginga Dange","Filipa Domingos Texeira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930394312","930394312","","","0","2010-08-15","0000-00-00","ARS633","Jacinto Tchipa","","Emanuel Ginga Dange","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("507","José Hebo João","Masculino","Gaspar Junior S. João","Tatiana Maria Hebo Gunza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927139600","927139600","","","0","2006-09-02","0000-00-00","ARS687","Sapú II","","Gaspar Junior S. João","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("508","Kelvio Soares Cravid","Masculino","Milton de Assunção Cravid","Maria da Conçeição Luanda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923761745/990761745","923761745/990761745","","","0","2010-02-12","0000-00-00","ARS608","Bita Vacaria","","Milton de Assunção Cravid","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("509","Leonardo Nkiawete Júnior","Masculino","Leão Mambu Júnior","Sofia Muntu Nkiawete","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945637725","945637725","","","0","2010-09-01","0000-00-00","ARS424","Sapú II","","Leão Mambu Júnior","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("510","Lucrécia Garcia Capenda","Masculino","Rui Capenda","Nkuina Paulina Fundo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923632751/924097909","923632751/924097909","","","0","2007-11-07","0000-00-00","ARS295","Jacinto Tchipa","","Rui Capenda","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("511","Luisa Maravilha Kanda Bimbo","Masculino","João Simão Bimbo","Masakidi Nsoki","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934618906","934618906","","","0","2009-09-14","0000-00-00","ARS365","Sapú II","","João Simão Bimbo","2021-08-17 00:00:00","activo","2021-08-17");
INSERT INTO alunos VALUES("512","Macário Chivela U. Chindumbo","Masculino","António Chindumbo","Isabel Capato Ulica","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923040358/926567997","923040358/926567997","","","0","2008-01-04","0000-00-00","ARS785","Belo Horizonte","","António Chindumbo","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("513","Manuela Mafuta N.  Cachala","Masculino","João Baptista Cachala","Filomena Namela","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923492721/923561482","923492721/923561482","","","0","2007-02-02","0000-00-00","ARS680","Bita Vacaria","","João Baptista Cachala","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("514","Marilda Ruth Damião José","Masculino","Domingos Adão José","Teresa Gaspar Damião","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931551976/924895704","931551976/924895704","","","0","2010-09-16","0000-00-00","ARS274","Bita Vacaria","","Domingos Adão José","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("515","Marisa Ngunza Bungo","Masculino","Afonso Ezequiel Nate Bungo","Milena Guilhermina H. Gunza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927139600/997743505","927139600/997743505","","","0","2009-12-04","0000-00-00","ARS505","Jacinto Tchipa","","Afonso Ezequiel Nate Bungo","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("516","Marta Sebastião","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1054","","","","2021-11-03 00:00:00","activo","2021-11-03");
INSERT INTO alunos VALUES("517","Miuma Benza Dias dos Santos","Masculino","Mateus Francisco Dias dos Santos","Lemba Correia B. Dias dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912238140/933255469","912238140/933255469","","","0","2010-01-28","0000-00-00","ARS497","Sapú II","","Mateus Francisco Dias dos Santos","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("518","Odeth dos Santos António","Masculino","Mário Domingos Anónio","Domingas dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2006-12-07","0000-00-00","ARS414","Jacinto Tchipa","","Mário Domingos Anónio","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("519","Osvaldo Domingos Monteiro","Masculino","José Alberto T. Monteiro","Evilina Monteiro Daimone","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945466530/931968746","945466530/931968746","","","0","2009-12-12","0000-00-00","ARS827","Jacinto Tchipa","","José Alberto T. Monteiro","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("520","Paulo António dos Santos","Masculino","Paulo Catatina dos Santos","Nelsa Cláudia Alberto António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947337793/991580788","947337793/991580788","","","0","2009-07-03","0000-00-00","ARS629","Jacinto Tchipa","","Paulo Catatina dos Santos","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("521","Ricardo Joaquim Domingos","Masculino",".......................","Guilhermina da Conceição Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924371235","924371235","","","0","2009-05-08","0000-00-00","ARS573","Jacinto Tchipa","",".......................","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("522","Rogério Perreira Rodrigues","Masculino","Gilberto Rodrigues","Lembinha Martins Perreira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928348878/927688007","928348878/927688007","","","0","2008-03-23","0000-00-00","ARS332","Sapú II","","Gilberto Rodrigues","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("523","Romão Carlos Agostinho Diogo","Masculino","Romão Diogo Fernandes","Tânia Carlos Agostinho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924180197","924180197","","","0","2010-03-19","0000-00-00","ARS538","Bequessa","","Romão Diogo Fernandes","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("524","Suzana Mayoyo Nicolau Marcos","Masculino","Abel Marcos","Sara Teresa Nicolau","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930616334","930616334","","","0","2011-10-10","0000-00-00","ARS672","Bita Vacaria","","Abel Marcos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("525","Tânia Luzia Bartolomeu Queta","Masculino","Domingos Alberto A. Queta","Josefina Cufina","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934317717","934317717","","","0","2009-03-25","0000-00-00","ARS338","Jacinto Tchipa","","Domingos Alberto A. Queta","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("526","Teles Calenga Daniel Matranga","Masculino","Calenga Matranga","Teresa Napingala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924627521","924627521","","","0","2010-02-21","0000-00-00","ARS143","Jacinto Tchipa","","Calenga Matranga","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("527","Valquiria Daniel Francisco","Masculino","Agostinho Joaquim Francisco","Paulina António Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930404340","930404340","","","0","2008-10-04","0000-00-00","ARS320","Jacinto Tchipa","","Agostinho Joaquim Francisco","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("528","Vanda João Lundange","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS514","","","","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("529","Victoria Tchapanga N. Cangombe","Masculino","Severina Chissolossi Cangombe","Benvinda Nalumbo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","992042230/940367608","992042230/940367608","","","0","2008-11-07","0000-00-00","ARS552","Sapú II","","Severina Chissolossi Cangombe","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("530","Abimael Luis G. Francisco","Masculino","Luis Simão Manuel Francsco","Janeth Rosa Rafael G. Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921365426","921365426","","","0","2012-02-21","0000-00-00","ARS1012","Belo Horizonte","","Luis Simão Manuel Francsco","2021-10-07 00:00:00","activo","2021-10-07");
INSERT INTO alunos VALUES("531","Anacleto José Gaspar","Masculino","Inoc Gavião João Gaspar","Domingas Cipriano José Gaspar","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2011-08-14","0000-00-00","ARS289","Jacinto Tchipa","","Inoc Gavião João Gaspar","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("532","André Segundo Lopes","Masculino","André Lopes","Joana Filomena Segunodo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921103352/929950989","921103352/929950989","","","0","2011-04-01","0000-00-00","ARS596","Jacinto Tchipa","","André Lopes","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("533","Antoniela Francisca Mendes","Masculino","................","Aurora Mendes Luzino","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927928743/922309503","927928743/922309503","","","0","2010-06-29","0000-00-00","ARS627","Jacinto Tchipa","","................","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("534","Ariel S. Pedro","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1006","","","","2021-10-11 00:00:00","activo","2021-10-11");
INSERT INTO alunos VALUES("535","Baptista Nelson Manuel Pata","Masculino","Nelson Pata","Margarida Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934817466","934817466","","","0","2011-04-19","0000-00-00","ARS872","Jacinto Tchipa","","Nelson Pata","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("536","Carlos Nambes Soares","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1041","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("537","Cecília Maza Moises","Masculino","Mário Dias Moisés","Marta Raquel Maza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931831562/927989658","931831562/927989658","","","0","2011-01-08","0000-00-00","ARS328","Bita Vacaria","","Mário Dias Moisés","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("538","Daniela Tayane R. Alberto","Masculino","Claudio António Alberto","Isabel Raimundo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928830024","928830024","","","0","2010-12-30","0000-00-00","ARS955","Jacinto Tchipa","","Claudio António Alberto","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("539","Delcio Henrique Vieira Nsambo","Masculino","André M. Nsambo","Alice Vieira Sebastião","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922118622/994100084","922118622/994100084","","","0","2010-03-06","0000-00-00","ARS727","Sapú II","","André M. Nsambo","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("540","Dilangano Jamba Alberto","Masculino","Baptista Simão Alberto","Cristina Nassoma Bimbi Jamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924946698/923820077","924946698/923820077","","","0","2011-08-28","0000-00-00","ARS568","Jacinto Tchipa","","Baptista Simão Alberto","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("541","Dilson Júnior Malanga Franscisco","Masculino","Tânio Rosário A. Francisco","Adelaide Armando Malanga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923949749/934693589","923949749/934693589","","","0","2011-08-08","0000-00-00","ARS700","Bita Vacaria","","Tânio Rosário A. Francisco","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("542","Domingos de Oliveira","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS842","","","","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("543","Dorivaldo António de Sousa Tomás","Masculino","Almeida Kapango Tomás","Diovalda da Graça G. De Sousa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923064272/915123439","923064272/915123439","","","0","2011-05-25","0000-00-00","ARS305","Sapú II","","Almeida Kapango Tomás","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("544","Emuel Luis João Zikuassalaco","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS924","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("545","Isaac Tchilombo Chicossi","Masculino","José Daniel Chicossi","Dulce P. Tchicossi","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926215885/945853472","926215885/945853472","","","0","2010-10-22","0000-00-00","ARS580","Jacinto Tchipa","","José Daniel Chicossi","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("546","Isabel Jeremias Sapata","Masculino","Teodoro Sapata","Esperança Francisco Jeremias","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927830692","927830692","","","0","2009-04-17","0000-00-00","ARS235","Sapú II","","Teodoro Sapata","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("547","Jesse Valente da Cunha","Masculino","Domingos Francisco S. Da Cunha","Suzana Rosa M. Valente","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936037738","936037738","","","0","2011-09-12","0000-00-00","ARS829","Jacinto Tchipa","","Domingos Francisco S. Da Cunha","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("548","João Baptista da Costa Cangile","Masculino","José Fernando Capemba","Beatriz José da Costa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944263555","944263555","","","0","2010-04-05","0000-00-00","ARS756","Jacinto Tchipa","","José Fernando Capemba","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("549","João Cariado da Silva Quime","Masculino","Cariado Ventura F. Quime","Marina Martins da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","990490705","990490705","","","0","2009-01-19","0000-00-00","ARS520","Sapú II","","Cariado Ventura F. Quime","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("550","Kilson da Cunha Guilherme","Masculino","Laurindo Figueredo Guilherme","Edvánia Saude da Cunha","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","998596872","998596872","","","0","2011-02-11","0000-00-00","ARS461","Jacinto Tchipa","","Laurindo Figueredo Guilherme","2021-08-25 00:00:00","activo","2021-08-25");
INSERT INTO alunos VALUES("551","Leandro Eduardo Texeira Mavenda","Masculino","Victor Eduardo J. Mavenda","Teresa Teixeira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924105172","924105172","","","0","2011-07-21","0000-00-00","ARS63","Jacinto Tchipa","","Victor Eduardo J. Mavenda","2021-07-19 00:00:00","activo","2021-07-19");
INSERT INTO alunos VALUES("552","Leandro Gonsaveis Calopa","Masculino","Gabriel Paulo Calopa","Sofia Maria Gonsalveis","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","940271857","940271857","","","0","2008-05-26","0000-00-00","ARS1038","Bita Vacaria","","Gabriel Paulo Calopa","2021-10-19 00:00:00","activo","2021-10-19");
INSERT INTO alunos VALUES("553","Mário João Bento","Masculino","Mário Augusto Bento","Teresa Massanga João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945061194","945061194","","","0","2010-07-18","0000-00-00","ARS544","Jacinto Tchipa","","Mário Augusto Bento","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("554","Nataniel Romão Agostinho Fernando","Masculino","Romão Diogo Fernandes","Tânia Carlos Agostinho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924180197","924180197","","","0","2011-07-10","0000-00-00","ARS539","Bequessa","","Romão Diogo Fernandes","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("555","Neide Zélia Castelo Bengue","Masculino","Tomás Bengui","Teresa António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927535133","927535133","","","0","2009-09-29","0000-00-00","ARS754","Jacinto Tchipa","","Tomás Bengui","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("556","Paula Serrote Cabale","Masculino","Frederico José Cabale","Domingas Q. Serrote","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924674058","924674058","","","0","2009-07-05","0000-00-00","ARS441","Jacinto Tchipa","","Frederico José Cabale","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("557","Pedro Augusto Kapienge","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1030","","","","2021-10-14 00:00:00","activo","2021-10-14");
INSERT INTO alunos VALUES("558","Rita Estevão Pedro","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS972","","","","2021-09-30 00:00:00","activo","2021-09-30");
INSERT INTO alunos VALUES("559","Stéfane Tomé Gouveia Catomba","Masculino","Tomé Chinguli Catomba","Inês Bernardo Feliciano Gouveia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922626879/930695254","922626879/930695254","","","0","2011-02-05","0000-00-00","ARS203","Sapú II","","Tomé Chinguli Catomba","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("560","Timótio Sacalage Capamba","Masculino","Carlos Abel Capamba","Olivia j. Capamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923957700","923957700","","","0","2010-04-19","0000-00-00","ARS874","Jacinto Tchipa","","Carlos Abel Capamba","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("561","Aderito da Silva Neto","Masculino","Aderito Romão Miguel Neto","Ludovina Inácio da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923411480","923411480","","","0","2010-08-30","0000-00-00","ARS238","Bita Vacaria","","Aderito Romão Miguel Neto","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("562","Alcione Rossana A. Roque","Masculino","Domingos Roque Chinhama","Dulce Alexandra A. Agostinho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943625295/927049489","943625295/927049489","","","0","2012-09-20","0000-00-00","ARS46","Jacinto Tchipa","","Domingos Roque Chinhama","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("563","Alegria Victorino Cavindja","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS442","","","","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("564","Ana Maria Santana Sicuba","Masculino","Cláudio Baptista","Serafina Cuazeca Sanntana","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947797561","947797561","","","0","2009-04-21","0000-00-00","ARS344","Macom","","Cláudio Baptista","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("565","Anderson Francisco Catumbela Gil","Masculino","Francisco Gil","Adriana Catumbela","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923740949","923740949","","","0","2010-09-30","0000-00-00","ARS57","Bita Vacaria","","Francisco Gil","2021-07-16 00:00:00","activo","2021-07-16");
INSERT INTO alunos VALUES("566","Ariete Maria Kilombo Lourenço","Masculino","José Francisco Lourenço","Maria João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923578886/932604972","923578886/932604972","","","0","2009-04-30","0000-00-00","ARS65","Jacinto Tchipa","","José Francisco Lourenço","2021-07-19 00:00:00","activo","2021-07-19");
INSERT INTO alunos VALUES("567","Belmira Lueji Vemba Cristina","Masculino","António Abílio B. Crisitna","Ana de Fátima V. Crisitna","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912528814","912528814","","","0","2011-07-30","0000-00-00","ARS707","Sapú II","","António Abílio B. Crisitna","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("568","Clara Tuzolana da Costa Texeira","Masculino","João Lourenço Texeira","Cecília Iracem F. da Costa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","990917951/923917951","990917951/923917951","","","0","2011-05-25","0000-00-00","ARS824","Jacinto Tchipa","","João Lourenço Texeira","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("569","Daniel Dalas Bernardo","Masculino","Serafim Bernardo","Elisa Fernando Dala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924313507","924313507","","","0","2011-04-02","0000-00-00","ARS410","Sapú II","","Serafim Bernardo","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("570","Ecolelo José Fernando António","Masculino","João António","Augusta Manjilo V. Fernando","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922671209/912647073","922671209/912647073","","","0","2011-03-14","0000-00-00","ARS99","Sapú II","","João António","2021-07-27 00:00:00","activo","2021-07-27");
INSERT INTO alunos VALUES("571","Emanuel Makiesse Nkanassau","Masculino","Makiesse Nkanassau","Mavinga Paulina Ndombase","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943016809","943016809","","","0","2010-06-22","0000-00-00","ARS1001","Bita Vacaria","","Makiesse Nkanassau","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("572","Evandra Eva Dias da Silva","Masculino","Carlos  José Bernardo da Silva","Teresa Manuel Dias","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923353515/926849000","923353515/926849000","","","0","2011-06-11","0000-00-00","ARS776","Sapú II","","Carlos  José Bernardo da Silva","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("573","Freima Dádiva Zua Paulo","Masculino","Adriana Luzola Zua Paulo","Inês José Paulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930071343/931016000","930071343/931016000","","","0","2011-07-12","0000-00-00","ARS409","Jacinto Tchipa","","Adriana Luzola Zua Paulo","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("574","Gelson Evaristo Pedro Francisco","Masculino","Pedro Domingos B. Francisco","Selma Evaristo André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923788472/933791338","923788472/933791338","","","0","2009-10-16","0000-00-00","ARS141","Jacinto Tchipa","","Pedro Domingos B. Francisco","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("575","Gildasia Soraya Joaquim Bravo ","Masculino","Hermengildo Martins Bravo","Esperança Ventura Joaquim","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","941906220/941906220","941906220/941906220","","","0","2010-10-24","0000-00-00","ARS492","Jacinto Tchipa","","Hermengildo Martins Bravo","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("576","Gildo Gonga Martins","Masculino","Bernardo Domingos M. João","Marta Pascoal Zua Gonga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","948901036/923540522","948901036/923540522","","","0","2010-01-27","0000-00-00","ARS18","Jacinto Tchipa","","Bernardo Domingos M. João","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("577","Jusebelma do Céu L. do Nascimento","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS757","","","","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("578","Leonel Paulino Cassua Francisco","Masculino","Domingos Paulino Francisco","Conceição Nhanga Cassua","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","995142774/921387430","995142774/921387430","","","0","2011-05-19","0000-00-00","ARS452","Sapú II","","Domingos Paulino Francisco","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("579","Leopoldo António Miguel","Masculino","Sanito Simões Miguel","Paulina André António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927554728/927342606","927554728/927342606","","","0","2010-12-24","0000-00-00","ARS69","Jacinto Tchipa","","Sanito Simões Miguel","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("580","Lucrécia Eliane S. Rodrigues ","Masculino","António D. B. Rodrigues","Sebastiana da G. S. Rodrigues","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925363371/935589952","925363371/935589952","","","0","2011-09-24","0000-00-00","ARS10","Jacinto Tchipa","","António D. B. Rodrigues","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("581","Lurdes Andre Cazola","Masculino","Manuel Alcínio C. Cazola","Natália Armindo André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927703307/925674399","927703307/925674399","","","0","2011-02-04","0000-00-00","ARS507","Sapú II","","Manuel Alcínio C. Cazola","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("582","Manuel Makiesse Nkanassau","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS987","","","","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("583","Manuela Valentim Paulo","Masculino","Manuel António Paulo","Deolinda Bartolomeu Valentim","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923520642/924494238","923520642/924494238","","","0","2020-11-05","0000-00-00","ARS532","Cinquentinha","","Manuel António Paulo","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("584","Margarida Elmar Neto António","Masculino","Elias Faustino António","Mariza da Silva Neto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947032861","947032861","","","0","2009-09-22","0000-00-00","ARS772","Jacinto Tchipa","","Elias Faustino António","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("585","Miguel Canga Alexandre","Masculino","Conceição Manuel Adão Alexandre","Francisca Domingos C. Canga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925929868/942666656","925929868/942666656","","","0","2011-06-20","0000-00-00","ARS457","Sapú II","","Conceição Manuel Adão Alexandre","2021-08-25 00:00:00","activo","2021-08-25");
INSERT INTO alunos VALUES("586","Milena Pedro Francisco","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS509","","","","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("587","Paula Francisca da Costa Gaspar","Masculino","Frankilin Adão M. Gaspar","Maria João da Costa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930753701","930753701","","","0","2011-01-10","0000-00-00","ARS485","Bequessa","","Frankilin Adão M. Gaspar","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("588","Rosária Filomena Huambo","Masculino","Vita Kapapelo Huambo","Elsa Pontes Neto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925714300/995685350","925714300/995685350","","","0","2010-12-08","0000-00-00","ARS1057","Jacinto Tchipa","","Vita Kapapelo Huambo","2021-11-08 00:00:00","activo","2021-11-08");
INSERT INTO alunos VALUES("589","Suellen Joana Perreira Miguel","Masculino","Paulo João C. Miguel ","Josina Marlene Paulo P. Miguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","919351983/922351983","919351983/922351983","","","0","2011-01-01","0000-00-00","ARS389","Jacinto Tchipa","","Paulo João C. Miguel ","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("590","Tamara Joseane Zenguel","Masculino","..........................","Marieta Cavunge Zenguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924565333/941685706","924565333/941685706","","","0","2011-09-05","0000-00-00","ARS301","Sapú II","","..........................","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("591","Tatina Segunda Gomes","Masculino","Faustino Vasco J. Gomes","Tamara de Almeida Cristovão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923848537/927305511","923848537/927305511","","","0","0000-00-00","0000-00-00","ARS889","Jacinto Tchipa","","Faustino Vasco J. Gomes","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("592","Teresa da Conceção Felix","Masculino","Pedro Domingos J. Felix","Telma Baptista André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924213865/925118363","924213865/925118363","","","0","2011-09-10","0000-00-00","ARS166","Sapú II","","Pedro Domingos J. Felix","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("593","Valdir António M. Dos Santos","Masculino","Honorio Afonso dos Santos","Engracia A.M dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925628277/933108977","925628277/933108977","","","0","2011-02-25","0000-00-00","ARS613","Jacinto Tchipa","","Honorio Afonso dos Santos","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("594","Viviane Gaspar Catomba","Masculino","Lofa Raimundo Catomba","Isaura Domingos Gaspar","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923495994/949406949","923495994/949406949","","","0","2011-03-14","0000-00-00","ARS396","Jacinto Tchipa","","Lofa Raimundo Catomba","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("595","Ana Corina Sualala Lamento","Masculino","António João Lamento","Inocencia dos Santos L. Sualala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923929960","923929960","","","0","2011-03-31","0000-00-00","ARS468","Sapú II","","António João Lamento","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("596","Ana Margarida Luis Dias da Silva","Masculino","Manuel Fransisco G. D. Dos Santos","Carolina Manuel A. Luis ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923218377","923218377","","","0","2012-02-07","0000-00-00","ARS710","Sapú II","","Manuel Fransisco G. D. Dos Santos","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("597","Ana Maria Ribeiro","Masculino",".......................","Nádia Valéria F. Ribeiro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923562468/925500757","923562468/925500757","","","0","2008-12-08","0000-00-00","ARS545","Jacinto Tchipa","",".......................","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("598","Andreia Renata da S. Salvador ","Masculino","Bulo R. Mussunga","Josefa da Silva Mussunga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932598312/932598312","932598312/932598312","","","0","2009-06-16","0000-00-00","ARS822","Sapú II","","Bulo R. Mussunga","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("599","Arão Daniel C. Dos Santos","Masculino","Daniel Manuel","Bernardeth Luzia M. Camoli","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923474172/924938502","923474172/924938502","","","0","2009-02-06","0000-00-00","ARS130","Jacinto Tchipa","","Daniel Manuel","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("600","Aurio Miluanga Massago","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1085","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("601","Beatriz Capemba Boa Vida","Masculino","Carlos Pinto Boavida","Engracia Zage Capemba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927824076/923961779","927824076/923961779","","","0","2010-07-03","0000-00-00","ARS577","Jacinto Tchipa","","Carlos Pinto Boavida","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("602","Beatriz Correia Machado","Masculino","Lourenço António Machado","Nazareth Bernardo Correia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923488128/927919979","923488128/927919979","","","0","2010-05-06","0000-00-00","ARS730","Jacinto Tchipa","","Lourenço António Machado","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("603","Beatriz Mato Landu","Masculino","Julião Mato Pedro","Tinani Landu","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924198915/913104289","924198915/913104289","","","0","2011-05-17","0000-00-00","ARS216","Bita Vacaria","","Julião Mato Pedro","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("604","Cailane Conceição da Silva António","Masculino","Caetano Estevão M. António","Djamila Domingas A. Da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925811243/924589230","925811243/924589230","","","0","2011-05-24","0000-00-00","ARS106","Jacinto Tchipa","","Caetano Estevão M. António","2021-07-28 00:00:00","activo","2021-07-28");
INSERT INTO alunos VALUES("605","Chelsia Pedro Chilombo","Masculino","José Mariano Chilombo","Maria Guida Dala J. Pedro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949618422/914393780","949618422/914393780","","","0","2010-03-18","0000-00-00","ARS536","Jacinto Tchipa","","José Mariano Chilombo","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("606","Cláudio da Conceição Raimundo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS957","Jacinto Tchipa","","","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("607","Dadivino A. Aleixo dos Santos ","Masculino","Monteiro João dos Santos","Anabela Emilia Aleixo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2010-12-22","0000-00-00","ARS3","Jacinto Tchipa","","Monteiro João dos Santos","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("608","Dária Miguel da Cruz","Masculino","Manuel António da Cruz","Domingas Lourenço Miguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924814531","924814531","","","0","2011-04-18","0000-00-00","ARS219","Bita Vacaria","","Manuel António da Cruz","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("609","Diane da Graça Paca Vicente","Masculino","Salvador Agostinoh Vicente","Carmemn Paca N. Vicente","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931299362","931299362","","","0","2012-01-22","0000-00-00","ARS954","Jacinto Tchipa","","Salvador Agostinoh Vicente","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("610","Donana Soley H. F. Dos Santos","Masculino","Virgilio Ferreira dos Santos","Florinda Sabalo Henriques","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934681640","934681640","","","0","2011-10-07","0000-00-00","ARS640","Bita Vacaria","","Virgilio Ferreira dos Santos","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("611","Emilio João","Masculino","...........................","Arlete João Simão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933458939/915966020","933458939/915966020","","","0","2009-04-06","0000-00-00","ARS325","Jacinto Tchipa","","...........................","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("612","Evaldina Yanusa Tomás","Masculino","Jano Manuel da F. Tomás","Eva Cazunga João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945200897/927847702","945200897/927847702","","","0","2011-11-06","0000-00-00","ARS136","Sapú II","","Jano Manuel da F. Tomás","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("613","Fernando Alexandre Toy Ventura","Masculino","Fernando Ventura","Julieta João Toy","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924280150/923960328","924280150/923960328","","","0","2011-02-25","0000-00-00","ARS445","Sapú II","","Fernando Ventura","2021-08-24 00:00:00","activo","2021-08-24");
INSERT INTO alunos VALUES("614","Gabriela Jemima Katala Gabriel","Masculino","Kiaku Gabriel ","Maria Celeste A. K.  Gabriel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","917462125/945589177","917462125/945589177","","","0","2011-08-01","0000-00-00","ARS42","Jacinto Tchipa","","Kiaku Gabriel ","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("615","Gaspar Kipaka João","Masculino","Gaspar Agostinho J. Domingos","Suzana Boavida Cambessande","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924187502","924187502","","","0","2010-01-20","0000-00-00","ARS172","Sapú II","","Gaspar Agostinho J. Domingos","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("616","Genilson Cardoso Jerónimo","Masculino","Paulo Mendes de A. Jerónimo","Regina Guedes Cardoso","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2011-07-08","0000-00-00","ARS526","Jacinto Tchipa","","Paulo Mendes de A. Jerónimo","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("617","Glória Contreira Clemente","Masculino","José Clemente Domingos","Domingas Monteiro Contreiras","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923777775","923777775","","","0","2021-03-30","0000-00-00","ARS20","Jacinto Tchipa","","José Clemente Domingos","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("618","Jacira Adão Domingos","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1033","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("619","Josemar Joao Florentino","Masculino","Jose Florentino Manuel","Ana Maria J. Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924007817","924007817","","","0","2008-06-07","0000-00-00","ARS928","Belo Horizonte","","Jose Florentino Manuel","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("620","Lissania Damares Perreiara ","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS252","","","","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("621","Maisa Isabel Cuango Jerónimo","Masculino","Isaias Emanuel Jerónimo","Maria Domingos Cuango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930257908","930257908","","","0","2010-12-30","0000-00-00","ARS30","Jacinto Tchipa","","Isaias Emanuel Jerónimo","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("622","Moisés da Cruz Luís Marcelino","Masculino","Cruz Marcelino E. Manuel","Leonor Luisa Ferrão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923796155","923796155","","","0","2009-09-10","0000-00-00","ARS37","Sapú II","","Cruz Marcelino E. Manuel","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("623","Nataniel Ngangui Morais João","Masculino","José Ngangui F. João","Laura da Costa Morais","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912229868/925623050","912229868/925623050","","","0","2012-08-27","0000-00-00","ARS34","Jacinto Tchipa","","José Ngangui F. João","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("624","Olga Leonor Cabaça dos Santos","Masculino","Osvaldo António D. Dos Santos","Olga Manuel M. Cabaça","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926045588/924961668","926045588/924961668","","","0","2011-04-03","0000-00-00","ARS290","Bita Vacaria","","Osvaldo António D. Dos Santos","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("625","Orivaldo Lunoche Francisco","Masculino","Ndombele J. Sebastião","Rosa José Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934058440","934058440","","","0","2011-05-17","0000-00-00","ARS762","Bita Vacaria","","Ndombele J. Sebastião","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("626","Romana da Silva Mussunga","Masculino","Bulo R. Mussunga","Josefa da Silva Mussunga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932598312/932598312","932598312/932598312","","","0","2009-10-19","0000-00-00","ARS821","Sapú II","","Bulo R. Mussunga","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("627","Romualdo Luis M. Bento","Masculino","Machi Ngoa F. Bento","Maria Rebeca Mussache","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936030252/930358075","936030252/930358075","","","0","2007-12-24","0000-00-00","ARS450","Jacinto Tchipa","","Machi Ngoa F. Bento","2021-08-24 00:00:00","activo","2021-08-24");
INSERT INTO alunos VALUES("628","Serafim António Bande","Masculino","Leo Domingos Bande","Joana Domingos Bande","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923714979/934421840","923714979/934421840","","","0","2011-06-06","0000-00-00","ARS25","Jacinto Tchipa","","Leo Domingos Bande","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("629","Serafina Domingos Albano","Masculino","António D.MaNUEL Albano","Domingas Albano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934355171","934355171","","","0","2011-03-31","0000-00-00","ARS86","Bita Vacaria","","António D.MaNUEL Albano","2021-07-21 00:00:00","activo","2021-07-21");
INSERT INTO alunos VALUES("630","Shelsia Vanda da Siva Queta ","Masculino","João Alberto Queta ","Vanda Patricia L. Queta","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934317717","934317717","","","0","2011-09-05","0000-00-00","ARS339","Jacinto Tchipa","","João Alberto Queta ","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("631","Teresa Mauricio António","Masculino","Crispim António","Ana Justino Mauricio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933690697","933690697","","","0","2010-10-31","0000-00-00","ARS564","Jacinto Tchipa","","Crispim António","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("632","Alice Bento Capouco","Masculino","Aurelio dos Santos Capoco","Maria Julho Bento","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949796515","949796515","","","0","2011-01-18","0000-00-00","ARS937","Jacinto Tchipa","","Aurelio dos Santos Capoco","2021-11-18 00:00:00","activo","2021-11-18");
INSERT INTO alunos VALUES("633","Ana Marilia Paulo Figueredo","Masculino","Kiala Mateus A. Martins","Sandra José Paulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923632751/924097909","923632751/924097909","","","0","2010-10-17","0000-00-00","ARS293","Jacinto Tchipa","","Kiala Mateus A. Martins","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("634","Ary António Diogo","Masculino","Pedro Franisco Diogo","Nazareth Francisca de A. Diogo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931678472","931678472","","","0","2006-09-29","0000-00-00","ARS830","Jacinto Tchipa","","Pedro Franisco Diogo","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("635","Augusta Pedro Cambando","Masculino","Henriques Ngola Cambando","Antonica João Pedro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924305424/938190831","924305424/938190831","","","0","2012-01-29","0000-00-00","ARS541","Bita Vacaria","","Henriques Ngola Cambando","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("636","Beatriz Eugenia Lufunda","Masculino","Carlos Lufunda","Eugénia Belita Chipango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2007-02-04","0000-00-00","ARS1027","Sapú II","","Carlos Lufunda","2021-10-14 00:00:00","activo","2021-10-14");
INSERT INTO alunos VALUES("637","Dionisio Luis Bokote","Masculino","Bernardo Bokote","Antonieta Emiliano Luis","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944997093","944997093","","","0","2019-05-27","0000-00-00","ARS902","Jacinto Tchipa","","Bernardo Bokote","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("638","Eliana Afonso Lima","Masculino","Santos Miguel","Banguiquidi Suzana Afonso","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925893390/941076176","925893390/941076176","","","0","0000-00-00","0000-00-00","ARS732","Jacinto Tchipa","","Santos Miguel","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("639","Elizandro Manuel Domingos","Masculino",".......................","Margarida Segunda Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932017970/924150780","932017970/924150780","","","0","2012-02-07","0000-00-00","ARS356","Sapú II","",".......................","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("640","Evandra Dias da Silva","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS791","","","","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("641","Ezalino Cláudio F. Tavira","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1071","","","","2021-11-08 00:00:00","activo","2021-11-08");
INSERT INTO alunos VALUES("642","Gabriela Alice Vicente","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS547","","","","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("643","Gelson Mário Quental da S. Manuel","Masculino","Gil Filipe da Silva Manuel","Elsa da Conceisão G. Quental","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923034027/949705959","923034027/949705959","","","0","2012-03-31","0000-00-00","ARS813","","","Gil Filipe da Silva Manuel","2021-09-09 00:00:00","activo","2021-09-09");
INSERT INTO alunos VALUES("644","Germana Vieira Sebastiao","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS966","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("645","Helena Tc. Elizabeth Chinengo","Masculino","Andre Chinengo","Elizabeth Chipita","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932652050","932652050","","","0","2013-06-09","0000-00-00","ARS1046","Macon","","Andre Chinengo","2021-10-20 00:00:00","activo","2021-10-20");
INSERT INTO alunos VALUES("646","Iracelma Domingos Noé","Masculino","Eduardo Francisco C. Noé","Cevardina Joaquim Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","942833532","942833532","","","0","2011-03-03","0000-00-00","ARS828","Jacinto Tchipa","","Eduardo Francisco C. Noé","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("647","Joana Ngola Kiari","Masculino","Josue Mateus Kiari","Neusa Joaquiim Ngola","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","994590745","994590745","","","0","2012-03-28","0000-00-00","ARS964","Jacinto Tchipa","","Josue Mateus Kiari","2021-09-29 00:00:00","activo","2021-09-29");
INSERT INTO alunos VALUES("648","Júlio  Manuel da Silva Salvor","Masculino","Fernando de Jesus V. Salvador ","Joana Manuel da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933411179","933411179","","","0","2012-05-21","0000-00-00","ARS750","Jacinto Tchipa","","Fernando de Jesus V. Salvador ","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("649","Kelsio da Conceição A. Lourenço","Masculino","Domingos da Conceição Lourenço","Jilsa Fausto F. António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937448958/997266768","937448958/997266768","","","0","2012-03-08","0000-00-00","ARS387","Bita Vacaria","","Domingos da Conceição Lourenço","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("650","Kiluange Inóc Luciano Calei","Masculino","Faustino Calei","Laurinda Lito Luciano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923440823/936785195","923440823/936785195","","","0","2012-10-31","0000-00-00","ARS740","Jacinto Tchipa","","Faustino Calei","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("651","Leonel Afonso Domingos Francisco","Masculino","Geovane Afonso Francisco","Carmem S. DA Silva Franciso","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931865117/926158614","931865117/926158614","","","0","2012-09-13","0000-00-00","ARS864","Bita Vacaria","","Geovane Afonso Francisco","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("652","Leonilde Pontes dos Santos","Masculino","Manuel António dos Santos","Ana Maria S. Pontes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932112149/927633740","932112149/927633740","","","0","2021-09-30","0000-00-00","ARS916","Sapú II","","Manuel António dos Santos","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("653","Luis Sacaleji Capamba","Masculino","Carlos Abel Capamba","Olivia j. Capamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923957700","923957700","","","0","2011-05-11","0000-00-00","ARS905","Jacinto Tchipa","","Carlos Abel Capamba","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("654","Manuel Eyengo de A. Calucango","Masculino","Martinho Perreira Calucango","Juliana N. Martins Calucango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938068055","938068055","","","0","2011-01-02","0000-00-00","ARS71","Jacinto Tchipa","","Martinho Perreira Calucango","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("655","Margarida da Silva Mussunga","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS758","","","","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("656","Margarida Dias da Silva","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS942","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("657","Mariana Armindo Albino","Masculino","Júlio Carlos Albino","Rosário António Zeca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947212525","947212525","","","0","2011-08-29","0000-00-00","ARS693","Sapú II","","Júlio Carlos Albino","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("658","Marinela da Silva Álvaro","Masculino","Simão António Álvaro","Sara da Silva Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923474487","923474487","","","0","2011-01-08","0000-00-00","ARS868","","","Simão António Álvaro","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("659","Marineth Cládia Izata Gaieta","Masculino","Manuel Paulo Gaieta","Maria da Conceição Gaieta","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947010302/912052588","947010302/912052588","","","0","2012-02-16","0000-00-00","ARS775","Bita Vacaria","","Manuel Paulo Gaieta","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("660","Nelson da Silva Mateus","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1067","","","","2021-11-10 00:00:00","activo","2021-11-10");
INSERT INTO alunos VALUES("661","Olivia Sambo Dumba","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1008","","","","2021-10-11 00:00:00","activo","2021-10-11");
INSERT INTO alunos VALUES("662","Sandra Domingos Lamba","Masculino","Silvio Bravo Chumbamba","Teuma Suzana Panda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934128144","934128144","","","0","2011-06-08","0000-00-00","ARS767","Jacinto Tchipa","","Silvio Bravo Chumbamba","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("663","Tomás Castelo Bengue","Masculino","Tomás Bengui","Teresa António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927535133","927535133","","","0","2011-04-18","0000-00-00","ARS753","Jacinto Tchipa","","Tomás Bengui","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("664","Josue Cardoso da Cruz","Masculino","Gil Adriano","Cicilia Cardoso","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939268032","939268032","","","0","0000-00-00","0000-00-00","ARS474","Jacinto Tchipa","","Gil Adriano","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("665","Victor António Bumba","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS835","","","","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("666","Belfranio Gaspar J. Kindissa","Masculino","Gaspar Francisco M. Kindissa","Isabel Sebastião J. Kindissa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938165327/992811857","938165327/992811857","","","0","2012-09-14","0000-00-00","ARS561","Belo Horizonte","","Gaspar Francisco M. Kindissa","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("667","Cristina José Luis","Masculino","Helder João Sebastião","Paula Luis José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997905582","997905582","","","0","2011-07-19","0000-00-00","ARS655","Jacinto Tchipa","","Helder João Sebastião","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("668","Djamila Caembe Tomás","Masculino","Job Renis Tomás","Emília António Caembe","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924003966/922331110","924003966/922331110","","","0","2011-10-15","0000-00-00","ARS375","Bita Vacaria","","Job Renis Tomás","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("669","Dorivaldo Ferreira M. da Conceição","Masculino","Domingos D. F. M. da Conceição ","Luzia Maria Agostinho Ferreira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943979073/939848469","943979073/939848469","","","0","2012-07-07","0000-00-00","ARS534","Sapú II","","Domingos D. F. M. da Conceição ","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("670","Edmar Jorge Popular Tchilamba","Masculino","Herculano Janilson Tchilamba","Júlia José Popular","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929609260","929609260","","","0","2011-07-29","0000-00-00","ARS619","Bita Vacaria","","Herculano Janilson Tchilamba","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("671","Emanuel da Rocha João ","Masculino","Armindo João","Luzia Florinda J. Da Rocha João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923661566/915329820","923661566/915329820","","","0","2012-01-28","0000-00-00","ARS459","Sapú II","","Armindo João","2021-08-25 00:00:00","activo","2021-08-25");
INSERT INTO alunos VALUES("672","Erilsen Perreira de Lemos","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS253","","","","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("673","Ermelinda Tiago Lucas","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS407","Jacinto Tchipa","","","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("674","Evandro Dias Kiala","Masculino","Carlos Lucas Kiala","Madalena Machinge Dias","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932724076/947102523","932724076/947102523","","","0","2011-12-22","0000-00-00","ARS467","Jacinto Tchipa","","Carlos Lucas Kiala","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("675","Fernando Filho da Costa","Masculino","Daniel Joaquim da Costa","Josefa Adão Cardoso Filho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","915434620","915434620","","","0","2012-12-11","0000-00-00","ARS637","Jacinto Tchipa","","Daniel Joaquim da Costa","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("676","Fidel Vemba  Azevedo Martins","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS926","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("677","Geovani Caxinga Fernandes","Masculino","Ndalatando Cazengo","Adilson Francisco Fernandes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","998501379/938739083","998501379/938739083","","","0","2011-12-05","0000-00-00","ARS657","Sapú II","","Ndalatando Cazengo","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("678","Gerson Pinto Pedro","Masculino","Sebastião da Costa Pedro","Domingas Diogo Pinto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937365635/997270192","937365635/997270192","","","0","2010-11-11","0000-00-00","ARS682","Bita Vacaria","","Sebastião da Costa Pedro","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("679","Haiandra Vemba Armindo","Masculino","Miler Calado Armindo","Joaquina M. Vemba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912441489","912441489","","","0","2012-04-05","0000-00-00","ARS647","Jacinto Tchipa","","Miler Calado Armindo","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("680","Helena de Lurdes Ulumbo Paulo","Masculino","Benjamim Paulo","Carolina Mussengue Ulumbo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927298520/922464068","927298520/922464068","","","0","2011-05-26","0000-00-00","ARS704","Sapú II","","Benjamim Paulo","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("681","Ismael Mateus da Silva Machado","Masculino","Samuel José Machado","Teresa Caetano da Silva Machado","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923554922/923969885","923554922/923969885","","","0","2012-01-30","0000-00-00","ARS395","Sapú II","","Samuel José Machado","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("682","Joaquim Tomás Balanga","Masculino","Euclides Balanga","Evandra v. Balanga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923241628","923241628","","","0","2011-02-28","0000-00-00","ARS248","Jacinto Tchipa","","Euclides Balanga","2021-08-04 00:00:00","activo","2021-08-04");
INSERT INTO alunos VALUES("683","Joel Luis Pedro","Masculino","Moises Manuel Pedro","Delfina Teresa Luis","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926483546/936913392","926483546/936913392","","","0","2013-06-16","0000-00-00","ARS14","Jacinto Tchipa","","Moises Manuel Pedro","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("684","José Domingos Cuango Jerónimo","Masculino","Isaías Emanuel Jerónimo","Maria Domingos Cuango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930257908","930257908","","","0","2019-06-19","0000-00-00","ARS346","Sapú II","","Isaías Emanuel Jerónimo","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("685","Joseane Gisela Joaquim Bravo","Masculino","Hermengildo Martins Bravo","Esperança Ventura Joaquim","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","941906220/941906220","941906220/941906220","","","0","2012-11-30","0000-00-00","ARS491","Jacinto Tchipa","","Hermengildo Martins Bravo","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("686","Josefina Samgombe Namele","Masculino","Augusto Quessongo André","Rosa Tchilefe","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937773139/939240720","937773139/939240720","","","0","2010-07-15","0000-00-00","ARS362","Sapú II","","Augusto Quessongo André","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("687","Josevanio Cassimiro Lourenço Neto","Masculino","Geonavi Trapatoni C. Neto","Jocelina Lourenço","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923862296/935940749","923862296/935940749","","","0","2012-06-13","0000-00-00","ARS654","Sapú II","","Geonavi Trapatoni C. Neto","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("688","Leandra Cuteta Almeida","Masculino","Flávio Julheord V. Almeida","Sandra Simão P. Cuteta","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924165679/912643434","924165679/912643434","","","0","2012-12-14","0000-00-00","ARS134","Bita Vacaria","","Flávio Julheord V. Almeida","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("689","Luciana Yamina Garcia","Masculino","Afonso Real Garcia","Natália CH. Chitungo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923234948/926103256","923234948/926103256","","","0","2012-06-16","0000-00-00","ARS748","Jacinto Tchipa","","Afonso Real Garcia","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("690","Lurdes Quicucussa A. Muanza","Masculino","António Armando Muanza","Rebeca Tavares Quificussa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924862423","924862423","","","0","2012-03-22","0000-00-00","ARS341","Sapú II","","António Armando Muanza","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("691","Márcio Lourenço da Silva","Masculino","Alberto João Francisco da Silva","Isabel Maria B. Lourenço","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923425491/912425491","923425491/912425491","","","0","2012-06-01","0000-00-00","ARS254","Jacinto Tchipa","","Alberto João Francisco da Silva","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("692","Melquisedeque Garcia Fonseca Diogo","Masculino","Garcia Paulo Diogo","Domingas Estevão da Fonseca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923683586/924141183","923683586/924141183","","","0","2012-06-16","0000-00-00","ARS645","Jacinto Tchipa","","Garcia Paulo Diogo","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("693","Paula Junara da Silva","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS792","","","","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("694","Priscila da Graça M. Bento","Masculino","Maele Ngola F. Bento","Maria Rebeca Mussache","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936030252","936030252","","","0","2012-02-02","0000-00-00","ARS448","Jacinto Tchipa","","Maele Ngola F. Bento","2021-08-24 00:00:00","activo","2021-08-24");
INSERT INTO alunos VALUES("695","Rodrigues Manuel Quigia","Masculino","Francisco Manue Júlio","Domingas Rodrigues A. Julio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944599292/926898536","944599292/926898536","","","0","2012-07-21","0000-00-00","ARS440","Jacinto Tchipa","","Francisco Manue Júlio","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("696","Sara Rosana Quiocamba Caculo","Masculino","António Hebo Caculo","Rosa Caberi Quiocamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922309503/991945164","922309503/991945164","","","0","2012-03-04","0000-00-00","ARS625","Jacinto Tchipa","","António Hebo Caculo","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("697","Sebastiana Emanuela Braga Gomes","Masculino","Sebastião Francisco F. J. Gomes","Valdirene da C. DE Sá Braga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928795454","928795454","","","0","2012-06-17","0000-00-00","ARS553","Jacinto Tchipa","","Sebastião Francisco F. J. Gomes","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("698","Suzana Couveiro Francisco","Masculino","Germano Manuel J. Francisco","Maura Suzana Perreira Couveiro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921650617","921650617","","","0","2011-08-04","0000-00-00","ARS383","Jacinto Tchipa","","Germano Manuel J. Francisco","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("699","Weza Miguel António","Masculino","António Sebastião João","Domingas Salvador Miguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924190215/923468759","924190215/923468759","","","0","2012-02-02","0000-00-00","ARS502","Sapú II","","António Sebastião João","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("700","Akiesse Maria Juca Militão","Masculino","Joaquim Francisco Militão","Verónica Isabel Juca Militão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923898195","923898195","","","0","2012-04-21","0000-00-00","ARS160","Bita Vacaria","","Joaquim Francisco Militão","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("701","Alfredo Braga Monteiro","Masculino","Alfredo Joaquim Monteiro","Luzia Pedro de Sousa Braga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933502712","933502712","","","0","2009-12-24","0000-00-00","ARS314","Jacinto Tchipa","","Alfredo Joaquim Monteiro","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("702","Alveis de Almeida P. Calucango","Masculino","Martinho Perreira Calucango","Juliana N. Martins Calucango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938068055","938068055","","","0","2012-03-24","0000-00-00","ARS73","Jacinto Tchipa","","Martinho Perreira Calucango","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("703","Ana Jeremias Sapata","Masculino","Teodoro Sapata","Esperança Francisco Jeremias","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927830692","927830692","","","0","2011-03-15","0000-00-00","ARS237","Sapú II","","Teodoro Sapata","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("704","Ana Sulamita Miguel Perreira","Masculino","Laudiano António Perreira","Dionisia Pedro Miguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927453429/925256661","927453429/925256661","","","0","2012-12-10","0000-00-00","ARS278","Jacinto Tchipa","","Laudiano António Perreira","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("705","Antónia Manuel Pedro","Masculino","Gaspar Neto Pedro","Rita Adão Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923059591","923059591","","","0","2012-04-26","0000-00-00","ARS144","Jacinto Tchipa","","Gaspar Neto Pedro","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("706","Cecília Júlia Braga Monteiro","Masculino","Alfredo Joaquim Monteiro","Luzia Pedro de Sousa Braga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933502712","933502712","","","0","2011-09-29","0000-00-00","ARS315","Jacinto Tchipa","","Alfredo Joaquim Monteiro","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("707","Clesiane Delfina Neto Caiombe","Masculino","Mateus Manuel Caiombe","Isabel dos Prazeres N. D. Caiombe","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923626184/996153557","923626184/996153557","","","0","2012-06-03","0000-00-00","ARS182","Sapú II","","Mateus Manuel Caiombe","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("708","Creusa Manuel Hebo ","Masculino","Carlos Francisco K. Hebo","Joana António Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944027893","944027893","","","0","2012-04-01","0000-00-00","ARS716","Jacinto Tchipa","","Carlos Francisco K. Hebo","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("709","Cussecala Albano Buco José","Masculino","Santos Albano José","Teresa Fernandes José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924109194","924109194","","","0","2010-08-16","0000-00-00","ARS651","Bita Vacaria","","Santos Albano José","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("710","Dadiva Aleixo Domingas dos Santos ","Masculino","Monteiro João dos Santos","Anabela Emilia Aleixo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2010-12-22","0000-00-00","ARS2","Jacinto Tchipa","","Monteiro João dos Santos","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("711","Elsa Jertrudes José Marques","Masculino","Apolinário Marques","Esperança Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923562569","923562569","","","0","2011-09-22","0000-00-00","ARS313","Sapú II","","Apolinário Marques","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("712","Elvira Ricardo António Bragança","Masculino","Ricardo Adolfo Guimarães","Catarina José António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926618569/924379158","926618569/924379158","","","0","2009-07-24","0000-00-00","ARS17","Sapú II","","Ricardo Adolfo Guimarães","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("713","Esperança João Manuel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS120","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("714","Estefania de Jesus Macungo Gomes","Masculino","José da Costa Gomes","Tatiana Maria J.Macungo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925689308","925689308","","","0","2021-08-01","0000-00-00","ARS1018","Inbondeiro Sul","","José da Costa Gomes","2021-10-13 00:00:00","activo","2021-10-13");
INSERT INTO alunos VALUES("715","Ester Margarida C. Da Silva","Masculino","António João F. Da Silva","Dionisia Caviva Capingano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931551045/931551045","931551045/931551045","","","0","2012-07-19","0000-00-00","ARS858","Jacinto Tchipa","","António João F. Da Silva","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("716","Fernanda kipaka João","Masculino","Gaspar Agostinho J. Domingos","Suzana Boavida Cambessande","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924187502","924187502","","","0","2012-09-27","0000-00-00","ARS171","Sapú II","","Gaspar Agostinho J. Domingos","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("717","Fernando Eduardo Gomes","Masculino","Francisco Eugénia Francisco","Sara Eduardo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2011-02-16","0000-00-00","ARS80","Jacinto Tchipa","","Francisco Eugénia Francisco","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("718","Franciany Marisa Lisboa Gomes","Masculino","Francisco Manuel Gomes","Ana Marisa Cassoma L. Gomes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921558526/924791529","921558526/924791529","","","0","2012-05-11","0000-00-00","ARS210","Sapú II","","Francisco Manuel Gomes","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("719","Gilmar Quental Da S. Manuel","Masculino","Gil Filipe da Silva Manuel","Elsa da Conceisão G. Quental","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923034027/949705959","923034027/949705959","","","0","2010-02-27","0000-00-00","ARS21","Sapú II","","Gil Filipe da Silva Manuel","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("720","Iris Heliana Cristo Dala","Masculino","Adolfo da Graça Dala","Marinela Glória Cristo Dala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922853883/992427551","922853883/992427551","","","0","2012-08-02","0000-00-00","ARS200","Jacinto Tchipa","","Adolfo da Graça Dala","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("721","João Manuel Dala","Masculino","João Dala","Maria Nakuela Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923568007/996041123","923568007/996041123","","","0","2012-12-11","0000-00-00","ARS273","Sapú II","","João Dala","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("722","José Lourenço Neves","Masculino","José Neves","Nazaré Nhanga Lourenço","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923334492/942006639","923334492/942006639","","","0","0000-00-00","0000-00-00","ARS589","Jacinto Tchipa","","José Neves","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("723","Kieza S. Tacanha Gomes","Masculino","Amilton Miguel M. Gomes","Carla A. V. Tacanha","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","942052717","942052717","","","0","2011-07-16","0000-00-00","ARS298","Jacinto Tchipa","","Amilton Miguel M. Gomes","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("724","Leonilde Lemos Miguel","Masculino","João Maria Miguel","Maria de Lemos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943170355/924989502","943170355/924989502","","","0","2011-06-08","0000-00-00","ARS606","Bita Vacaria","","João Maria Miguel","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("725","Luzia Kassova Vassuatala Sapembe","Masculino","Germano Sapembe S. Wilson","Josefina N. V. Nangulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945605676","945605676","","","0","2012-11-05","0000-00-00","ARS176","Jacinto Tchipa","","Germano Sapembe S. Wilson","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("726","Manuel da Cruz André Marcelino","Masculino","Cruz Marcelino E. Manuel","Juliana André José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923796155","923796155","","","0","2021-10-18","0000-00-00","ARS28","Sapú II","","Cruz Marcelino E. Manuel","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("727","Maximiliano Gunza Bungo","Masculino","Afonso Ezequiel Nate Bungo","Milena Guilhermina H. Gunza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927139600/997743505","927139600/997743505","","","0","2012-08-31","0000-00-00","ARS506","Jacinto Tchipa","","Afonso Ezequiel Nate Bungo","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("728","Nelson Chipembe Videira","Masculino","Nelson Videira","Inês Chipembe","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925609017/941389790","925609017/941389790","","","0","2011-08-16","0000-00-00","ARS103","Bita Vacaria","","Nelson Videira","2021-07-28 00:00:00","activo","2021-07-28");
INSERT INTO alunos VALUES("729","Paulina Quissueia Culua","Masculino","Bonde António Culua","Cecélia Neves Quissueia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927118113/934837710","927118113/934837710","","","0","2012-02-22","0000-00-00","ARS177","Sapú II","","Bonde António Culua","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("730","Paulo Ivandro G. Nestor","Masculino","Paulo Sebastião Nestor","Edna Julieta M. Nestor","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924312804/937000539","924312804/937000539","","","0","2012-02-18","0000-00-00","ARS93","Sapú II","","Paulo Sebastião Nestor","2021-07-22 00:00:00","activo","2021-07-22");
INSERT INTO alunos VALUES("731","Teresa Quifucussa A. Muanza","Masculino","António Armando Muanza","Rebeca Tavares Quificussa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924862423","924862423","","","0","2010-04-15","0000-00-00","ARS343","Sapú II","","António Armando Muanza","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("732","Tomé Manuel Gouveia Catomba","Masculino","Tomé Chinguli Catomba","Inês Bernardo Feliciano Gouveia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922626879/930695254","922626879/930695254","","","0","2021-05-17","0000-00-00","ARS201","Sapú II","","Tomé Chinguli Catomba","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("733","Valéria S. F. Agostinho","Masculino","José Israel  F. Agostinho","Jamba Mário Sebastião","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937769675","937769675","","","0","0000-00-00","0000-00-00","ARS798","Bita Vacaria","","José Israel  F. Agostinho","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("734","Walter Inongo Bela","Masculino","Mbenza Bela","Inésia Feliz Inango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925604764","925604764","","","0","2012-12-14","0000-00-00","ARS309","Sapú II","","Mbenza Bela","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("735","Abdel Francisco Leopoldo álvaro","Masculino","Simão António Álvaro","Virgília Natália Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923474487","923474487","","","0","2013-05-13","0000-00-00","ARS870","Sapú II","","Simão António Álvaro","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("736","Adilson Manuel Nambalo","Masculino","Agostinho Domingos Nambalo","Marisa João Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923953121","923953121","","","0","2012-04-30","0000-00-00","ARS660","Sapú II","","Agostinho Domingos Nambalo","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("737","Afonso de Assunção da S. Segundo","Masculino","Felisberto Afonso Segundo","Catarina Perreira Figueredo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923218916/992218916","923218916/992218916","","","0","2013-08-03","0000-00-00","ARS523","Jacinto Tchipa","","Felisberto Afonso Segundo","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("738","Alfredo Manuel João","Masculino","Artur Pereira João","Elisa José Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934640889/923312803","934640889/923312803","","","0","2013-10-18","0000-00-00","ARS483","Macom","","Artur Pereira João","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("739","Ambrósio Pedro Eduardo Kuluca","Masculino","Mavitidi Dombele Kuluca","Luza Maria","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923431675/940061305","923431675/940061305","","","0","2013-03-27","0000-00-00","ARS56","Bita Vacaria","","Mavitidi Dombele Kuluca","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("740","Andrea Segundo Lopes","Masculino","André Lopes","Joana Filomena Segunodo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921103352/929950989","921103352/929950989","","","0","2012-05-31","0000-00-00","ARS595","Jacinto Tchipa","","André Lopes","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("741","Angela Gonga Tomás","Masculino","Pedro Tomás","Suzana António Gonga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934511699/925747764","934511699/925747764","","","0","2008-09-06","0000-00-00","ARS795","Macon","","Pedro Tomás","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("742","Antónia Ventura da Rocha","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1074","","","","2021-11-19 00:00:00","activo","2021-11-19");
INSERT INTO alunos VALUES("743","Clementina Ndombaxi Marcos","Masculino","Abel Marcos","Sara Teresa Nicolau","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930616334","930616334","","","0","2014-01-07","0000-00-00","ARS669","Bita Vacaria","","Abel Marcos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("744","Elisa Pembele Castelo","Masculino","Ivo Malunda Castelo ","Tatiana Mbala Pembele","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926085148/937960360","926085148/937960360","","","0","2013-07-17","0000-00-00","ARS108","Sapú II","","Ivo Malunda Castelo ","2021-07-28 00:00:00","activo","2021-07-28");
INSERT INTO alunos VALUES("745","Emaculada Dala Polo","Masculino","Miguel Sebastião Apolo","Margarida Agostinho Dala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923565006","923565006","","","0","2012-11-20","0000-00-00","ARS364","Sapú II","","Miguel Sebastião Apolo","2021-08-17 00:00:00","activo","2021-08-17");
INSERT INTO alunos VALUES("746","Emiliana Lúcia de Sousa Tomás","Masculino","Almeida Kapango Tomás","Diovalda da Graça G. De Sousa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923064272/915123439","923064272/915123439","","","0","2013-05-07","0000-00-00","ARS303","Sapú II","","Almeida Kapango Tomás","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("747","Estefânia Luco Farias","Masculino","Carlos Gaspar Faria","Esperança Manuel Luco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944891145","944891145","","","0","2013-04-23","0000-00-00","ARS783","Belo Horizonte","","Carlos Gaspar Faria","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("748","Ester Mariana João Zikwassalaco","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS925","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("749","Eumara Patricia Sebastião","Masculino","Josimar José F. Sebastião","Evalise Pombal Caiamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923742030/923828507","923742030/923828507","","","0","2013-08-04","0000-00-00","ARS718","Sapú II","","Josimar José F. Sebastião","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("750","Florença Lourenço Neves","Masculino","José Neves","Nazaré Nhanga Lourenço","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923334492/942006639","923334492/942006639","","","0","2013-10-07","0000-00-00","ARS590","Jacinto Tchipa","","José Neves","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("751","Francisco Sapalo Domingos","Masculino","Francisco Silvano Domingos","Helena Quaresma F. Sapalo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926041034/998041034","926041034/998041034","","","0","2014-05-19","0000-00-00","ARS622","Jacinto Tchipa","","Francisco Silvano Domingos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("752","Isabel Diamatondo Felicia Kuluca","Masculino","Lucombo André Kuluca","Graça Isabel Feliciano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","916567453/995358389","916567453/995358389","","","0","2013-05-22","0000-00-00","ARS111","Bita Vacaria","","Lucombo André Kuluca","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("753","Jaelson Etelvino B. Monteiro","Masculino","Londa da Costa Monteiro","Janeth Jacira A. Barros","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997137656/929246271","997137656/929246271","","","0","0000-00-00","0000-00-00","ARS847","Jacinto Tchipa","","Londa da Costa Monteiro","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("754","José Eduardo Texeira Mavenda","Masculino","Victor Eduardo J. Mavenda","Teresa Teixeira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924105172","924105172","","","0","2013-11-05","0000-00-00","ARS62","Jacinto Tchipa","","Victor Eduardo J. Mavenda","2021-07-19 00:00:00","activo","2021-07-19");
INSERT INTO alunos VALUES("755","Josefa Martins Oliveira","Masculino","Apolinario António de Oliveira","Engracia S. Coimbra","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923505908","923505908","","","0","2010-11-14","0000-00-00","ARS1065","Bequessa","","Apolinario António de Oliveira","2021-11-09 00:00:00","activo","2021-11-09");
INSERT INTO alunos VALUES("756","Jucélio Kiami da Costa Texeira","Masculino","João Lourenço Texeira","Cecília Iracem F. da Costa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","990917951/923917951","990917951/923917951","","","0","2012-08-14","0000-00-00","ARS826","Jacinto Tchipa","","João Lourenço Texeira","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("757","Júnior Luís de Lemos Barros","Masculino","Leonel Luis Barros","Sabrita Adão de Lucas ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938472401","938472401","","","0","2021-08-21","0000-00-00","ARS551","Jacinto Tchipa","","Leonel Luis Barros","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("758","Kinanga Nkiawete Júnior","Masculino","Leão Mambu Júnior","Sofia Muntu Nkiawete","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945637725","945637725","","","0","2013-08-22","0000-00-00","ARS859","Jacinto Tchipa","","Leão Mambu Júnior","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("759","Laura Alicia de Gouveia P. Oliveira","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS923","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("760","Lidiane Cristina C. Matias","Masculino","Osvaldo Domingos Matias","Joanada Conceição C. Matias","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924220137/942389111","924220137/942389111","","","0","2013-04-17","0000-00-00","ARS146","Auto Pechicha","","Osvaldo Domingos Matias","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("761","Lisandro Nambes Soares","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1042","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("762","Luciano Adão Lima Quimonha","Masculino","Adão Canzambi Quimonha","Cristina Caetano de Lima","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939172858","939172858","","","0","2010-07-22","0000-00-00","ARS743","Sapú II","","Adão Canzambi Quimonha","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("763","Maria Augusto Charles Manuel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS907","","","","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("764","Maria Bernardo Charles Manuel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS908","","","","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("765","Marilia Mayala M. Benjamim","Masculino","Francisco Manuel Benjamim ","Irene dos Anjos Massy Benjamim","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931258020","931258020","","","0","2012-12-31","0000-00-00","ARS899","Rangel","","Francisco Manuel Benjamim ","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("766","Mario Monamesso Celestino","Masculino","António Celestino","Paulina Isabel Dimone","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939939855","939939855","","","0","2012-11-23","0000-00-00","ARS912","Jacinto Tchipa","","António Celestino","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("767","Mauricio Macueno Tati","Masculino","Mbungo Taty","Saca Isabel M. Maweno","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924271296","924271296","","","0","2012-11-19","0000-00-00","ARS1064","Jacinto Tchipa","","Mbungo Taty","2021-11-09 00:00:00","activo","2021-11-09");
INSERT INTO alunos VALUES("768","Mombaça Junior T. Morais","Masculino","Mombaça Francisco Morais","Branca Perreira Teodoro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929422449","929422449","","","0","0000-00-00","0000-00-00","ARS585","Jacinto Tchipa","","Mombaça Francisco Morais","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("769","Olivio Pedro Catende Cauoiongo","Masculino","Taiago Sengueira F. Cauongo","Esmeralda C. T. Catenda ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923740949","923740949","","","0","2012-10-08","0000-00-00","ARS59","Bita Vacaria","","Taiago Sengueira F. Cauongo","2021-07-16 00:00:00","activo","2021-07-16");
INSERT INTO alunos VALUES("770","Onára Benza dias dos Santos","Masculino","Mateus Francisco Dias dos Santos","Lemba Correia B. Dias dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912238140/933255469","912238140/933255469","","","0","2012-08-25","0000-00-00","ARS494","Sapú II","","Mateus Francisco Dias dos Santos","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("771","Paulo Francisco de Oliveira","Masculino","Julio Bozerra de Oliveira","Rossana Simão Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924452243","924452243","","","0","2012-10-16","0000-00-00","ARS812","","","Julio Bozerra de Oliveira","2021-09-09 00:00:00","activo","2021-09-09");
INSERT INTO alunos VALUES("772","Regina Nayole Ferreira Manuel","Masculino","Correia Cristóvão Manuel","Roobiany Patrícia B. Ferreira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937285904/931376180","937285904/931376180","","","0","2013-07-07","0000-00-00","ARS631","Sapú II","","Correia Cristóvão Manuel","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("773","Ricardo Dias Kiala","Masculino","Carlos Lucas Kiala","Madalena Machinge Dias","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932724076/947102523","932724076/947102523","","","0","2013-07-17","0000-00-00","ARS466","Jacinto Tchipa","","Carlos Lucas Kiala","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("774","Salomão Filipe da Silva Paulino","Masculino","Garcia Ernesto P. Paulino","Epfânio Jacinto D. Da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931165719/993559162","931165719/993559162","","","0","2013-07-16","0000-00-00","ARS601","Jacinto Tchipa","","Garcia Ernesto P. Paulino","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("775","Simão Germano Couveiro Francisco ","Masculino","Germano Manuel J. Francisco","Maura Suzana Perreira Couveiro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921650617","921650617","","","0","2013-03-09","0000-00-00","ARS382","Jacinto Tchipa","","Germano Manuel J. Francisco","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("776","Uziel Elidio Gabriel Tandala","Masculino","Elias Gonsalveis Tandala","Deolinda da Silva G. Tandala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923491442","923491442","","","0","2013-07-18","0000-00-00","ARS759","Jacinto Tchipa","","Elias Gonsalveis Tandala","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("777","Abraão Francisco Gomes","Masculino","Francisco Eugénia Francisco","........................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2010-09-30","0000-00-00","ARS81","Jacinto Tchipa","","Francisco Eugénia Francisco","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("778","Albertina Francisco K. Bongana","Masculino","Francisco Matu Bongana","Margarida Pedro Kubutuka","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","948056440/924381992","948056440/924381992","","","0","2014-09-30","0000-00-00","ARS336","Bita Vacaria","","Francisco Matu Bongana","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("779","Alexandra Edite da Silva","Masculino","Delcio Alexandre Félix da Silva",".....................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927069217","927069217","","","0","2012-12-05","0000-00-00","ARS751","Jacinto Tchipa","","Delcio Alexandre Félix da Silva","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("780","António Daniel C. Manuel ","Masculino","Daniel Domingos Manuel","Rebeca Mandeca C. Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923471411","923471411","","","0","2013-04-26","0000-00-00","ARS22","Jacinto Tchipa","","Daniel Domingos Manuel","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("781","António Luboko Mafuta","Masculino","António Mafuta","Nkuna Luzizila Regina","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945253214","945253214","","","0","2015-05-22","0000-00-00","ARS368","Sapú II","","António Mafuta","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("782","Arcenio Muhongo da Gama","Masculino","Flávio Longo da Gama","Paulina Elamba V. Muhongo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944892013/938745863","944892013/938745863","","","0","2014-11-17","0000-00-00","ARS23","Sapú II","","Flávio Longo da Gama","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("783","Bartolomeu de Jesus Cassua","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS117","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("784","Clementina Lourenço Simão","Masculino","Manguiaco Sebastião Simáo","Maria Luisa Lourenço","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2012-10-17","0000-00-00","ARS780","Jacinto Tchipa","","Manguiaco Sebastião Simáo","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("785","Clésio Zage da Silva","Masculino","Domingos Bonito da Silva","Quinema João A. Zage","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947167090/928144142","947167090/928144142","","","0","2012-11-28","0000-00-00","ARS413","Bita Vacaria","","Domingos Bonito da Silva","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("786","Edmilson Simão Kanda Bimbo","Masculino","João Simão Bimbo","Masakidi Nsoki","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934618906","934618906","","","0","2012-10-19","0000-00-00","ARS366","Sapú II","","João Simão Bimbo","2021-08-17 00:00:00","activo","2021-08-17");
INSERT INTO alunos VALUES("787","Edxandra Alexandre da Silva","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS761","","","","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("788","Elias Quipaca Ramos","Masculino","Adão Cardoso Ramos","Lúcia Mateus Quipaca","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925223274/934854747","925223274/934854747","","","0","2013-09-11","0000-00-00","ARS855","","","Adão Cardoso Ramos","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("789","Elisabeth Otaniela Luis Domingos","Masculino","João Pedro Domingos","Ângela João Luis Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924789371","924789371","","","0","0000-00-00","0000-00-00","ARS54","Sapú II","","João Pedro Domingos","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("790","Emilia Cangilo Filipe Satunga","Masculino","Nelson Valdemar C. Satunga ","Raquel Jamba C. Filipe","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923796155","923796155","","","0","2013-09-30","0000-00-00","ARS36","Sapú II","","Nelson Valdemar C. Satunga ","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("791","Ester Piriquito Féliz","Masculino","Olávio Adriano Félix","Margarida Periquito Félix","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997898099/927395584","997898099/927395584","","","0","2011-03-14","0000-00-00","ARS263","Jacinto Tchipa","","Olávio Adriano Félix","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("792","Fátima Breganha Quibato","Masculino","Manuel Fabião Quibato","Luzia Kimbundo Simão Breganha","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923552160/944996623","923552160/944996623","","","0","2011-09-19","0000-00-00","ARS269","Jacinto Tchipa","","Manuel Fabião Quibato","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("793","Felizarda Buco José","Masculino","Santos Albano José","Teresa Fernandes José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924109194","924109194","","","0","2014-01-16","0000-00-00","ARS649","Bita Vacaria","","Santos Albano José","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("794","Fernanda Clarice Tchisingi","Masculino","Fernado Ngola da Fonseca","Olivia da Silva Tchising","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","946351510","946351510","","","0","2012-09-14","0000-00-00","ARS312","Sapú II","","Fernado Ngola da Fonseca","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("795","Garcia Manuel Francisco","Masculino","Figueira Perreira Francisco","Ana Sebastião Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939510781/912334701","939510781/912334701","","","0","2012-10-27","0000-00-00","ARS565","Jacinto Tchipa","","Figueira Perreira Francisco","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("796","Gerusa Fabiola Ferreira Tchiguengue","Masculino","........................","Ariete Euclides F. Tchinguengue","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924831040","924831040","","","0","2012-05-22","0000-00-00","ARS535","Talatona","","........................","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("797","Helio Chivinda Chipango","Masculino","Joáo Carlos Chipango","Loide L. Ch. Chipango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926714270","926714270","","","0","2013-04-10","0000-00-00","ARS950","Sapú II","","Joáo Carlos Chipango","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("798","Isabel Ulumbo Paulo","Masculino","Benjamim Paulo","Carolina Mussengue Ulumbo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922464068","922464068","","","0","2013-04-27","0000-00-00","ARS738","Sapú II","","Benjamim Paulo","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("799","Jeft de Sousa dos Santos","Masculino","Santana dos Santos Mbuco","Nilda Chissola de S. Canga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929798333","929798333","","","0","2012-05-05","0000-00-00","ARS76","Jacinto Tchipa","","Santana dos Santos Mbuco","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("800","Joel Albano Garcia Leão","Masculino","Albano V. Leão","Lucrecia Neves Garcia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923522661","923522661","","","0","2013-05-02","0000-00-00","ARS736","Jacinto Tchipa","","Albano V. Leão","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("801","Joel Luis Botelho","Masculino","Estanislau F. G. Botelho","Aida Mateus Luis ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924418778/926311873","924418778/926311873","","","0","2013-07-15","0000-00-00","ARS6","Jacinto Tchipa","","Estanislau F. G. Botelho","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("802","Joel Pedro Domingos","Masculino","Alexandre Joaquim Domingos","Luzia Manuela Pedro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926556319/9484816","926556319/9484816","","","0","2013-09-07","0000-00-00","ARS246","Jacinto Tchipa","","Alexandre Joaquim Domingos","2021-08-04 00:00:00","activo","2021-08-04");
INSERT INTO alunos VALUES("803","José Essanjo Canda G. Figueiredo","Masculino","Carlos António G. Figuereido","Teresa Barroso Canda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923649448","923649448","","","0","2012-12-05","0000-00-00","ARS149","Sapú II","","Carlos António G. Figuereido","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("804","José Victor António de Oliveira","Masculino","Paiva Mateus de Oliveira","Clotilde Laurinda Panzo António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923322098","923322098","","","0","2012-11-14","0000-00-00","ARS284","Jacinto Tchipa","","Paiva Mateus de Oliveira","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("805","Kamussobo Quissueia Culua","Masculino","Bonde António Culua","Cecélia Neves Quissueia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927118113/934837710","927118113/934837710","","","0","2010-07-07","0000-00-00","ARS175","Sapú II","","Bonde António Culua","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("806","Kessia Rosa José Cardoso","Masculino","Jaime da Cruz Cardoso","Rosa Alfredo José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925998365/923020527","925998365/923020527","","","0","2013-02-13","0000-00-00","ARS218","Jacinto Tchipa","","Jaime da Cruz Cardoso","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("807","Laurindo da Cunha Guilherme","Masculino","Laurindo Figueredo Guilherme","Edvánia Saude da Cunha","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","998596872","998596872","","","0","2021-08-02","0000-00-00","ARS462","Jacinto Tchipa","","Laurindo Figueredo Guilherme","2021-08-25 00:00:00","activo","2021-08-25");
INSERT INTO alunos VALUES("808","Lucia Estefânia Bento Mata","Masculino","Carlos António Abílio Mata","Clélia Cecília da Silva Bento","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2013-04-21","0000-00-00","ARS231","Sapú II","","Carlos António Abílio Mata","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("809","Madalena Kelson","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS973","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("810","Marcela Lucrécia Garcia Leão","Masculino","Albano V. Leão","Lucrecia Neves Garcia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923522661","923522661","","","0","2013-05-02","0000-00-00","ARS737","Jacinto Tchipa","","Albano V. Leão","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("811","Maria da Cruz Luis Marcelino","Masculino","Cruz Marcelino E. Manuel","Leonor Luisa Ferrão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2013-04-23","0000-00-00","ARS239","","","Cruz Marcelino E. Manuel","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("812","Maura António Afonso","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS132","","","","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("813","Moises Kigielua","Masculino","........................","Tomalela Makanzu Kigelua","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","941358721","941358721","","","0","2011-08-29","0000-00-00","ARS991","Jacinto Tchipa","","........................","2021-10-05 00:00:00","activo","2021-10-05");
INSERT INTO alunos VALUES("814","Nelma Benção D. Fernandes","Masculino","Fernando Domingos","Luisa Domingos Fernando","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924211243/924537764","924211243/924537764","","","0","2013-05-08","0000-00-00","ARS673","Bita Vacaria","","Fernando Domingos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("815","Valdeth Silvia Tchimundo Kamongo","Masculino","Valdemiro Júlio S. Kamongo","Odeth Américo Tchimungo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934903905/922897492","934903905/922897492","","","0","2013-09-05","0000-00-00","ARS258","Jacinto Tchipa","","Valdemiro Júlio S. Kamongo","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("816","Abigail Gabriela Fontoura Quixito","Masculino","Fernandes Quixito Neto","Esmeralda Fernandes Fontoura","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","991161549/924161549","991161549/924161549","","","0","2013-11-14","0000-00-00","ARS515","Jacinto Tchipa","","Fernandes Quixito Neto","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("817","Alicia Alexandra F. Domingos","Masculino","Nemésio Gaspar Domingos","Esmeralda Macedo dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923750937","923750937","","","0","2014-05-02","0000-00-00","ARS484","Jacinto Tchipa","","Nemésio Gaspar Domingos","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("818","Aline António J. Lundange","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS511","","","","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("819","Braulio Emanuel M.Malamga","Masculino","Santos Malanga","LuziaEmanuel Biavanga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923542432","923542432","","","0","2013-08-26","0000-00-00","ARS668","Sapú II","","Santos Malanga","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("820","Cassia Neto Huambo","Masculino","Vita Kapapelo Huambo","Elsa Pontes Neto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925714300/995685350","925714300/995685350","","","0","2014-12-28","0000-00-00","ARS1058","Jacinto Tchipa","","Vita Kapapelo Huambo","2021-11-08 00:00:00","activo","2021-11-08");
INSERT INTO alunos VALUES("821","Catarina da Silva Gonga","Masculino","Júlio António Gonga","Marieta da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923027550","923027550","","","0","2014-04-04","0000-00-00","ARS385","Bita Vacaria","","Júlio António Gonga","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("822","Celina Yamina Garcia","Masculino","Afonso Real Garcia","Natália CH. Chitungo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923234948/926103256","923234948/926103256","","","0","2014-10-24","0000-00-00","ARS749","Jacinto Tchipa","","Afonso Real Garcia","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("823","Cristiano Cazambi de L. Quimonha","Masculino","Adão Canzambi Quimonha","Cristina Caetano de Lima","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939172858","939172858","","","0","2012-07-16","0000-00-00","ARS744","Sapú II","","Adão Canzambi Quimonha","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("824","Danivalda Cangala","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS998","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("825","Dorivaldo Waile do N. Cangahi","Masculino","António Manuel Albino","Cristina Margarida Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926560157/923248886","926560157/923248886","","","0","2014-05-23","0000-00-00","ARS331","Sapú II","","António Manuel Albino","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("826","Edvaldo Agata B. Monteiro","Masculino","Londa da Costa Monteiro","Janeth Jacira A. Barros","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997137656/929246271","997137656/929246271","","","0","2014-01-02","0000-00-00","ARS846","Jacinto Tchipa","","Londa da Costa Monteiro","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("827","Eliza Paulina Nkanassau","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS988","","","","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("828","Emaculda Manjor Mendes","Masculino","Fernandos Mendes","Eulária Nicodemos Major","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","994504254/926858277","994504254/926858277","","","0","2013-04-15","0000-00-00","ARS734","Bita Vacaria","","Fernandos Mendes","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("829","Felismina Chilamba","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS355","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("830","Fernanda Muleço Sebastião","Masculino","Fernando Manuel P. Sebastião","Isabel Francisco Muleco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","946888034/923317996","946888034/923317996","","","0","2013-09-26","0000-00-00","ARS617","Sapú II","","Fernando Manuel P. Sebastião","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("831","Garcia Ernesto da Silva Paulino","Masculino","Garcia Ernesto P. Paulino","Epfânio Jacinto D. Da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931165719/993559162","931165719/993559162","","","0","2015-04-30","0000-00-00","ARS600","Jacinto Tchipa","","Garcia Ernesto P. Paulino","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("832","Geomilson Caxinga Fernandes","Masculino","Adilson Francisco Fernandes","Maria de Carmo T. Caxinga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","998501379/949501379","998501379/949501379","","","0","2014-02-13","0000-00-00","ARS658","Sapú II","","Adilson Francisco Fernandes","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("833","Helena Morena Hebo Coxe","Masculino","Adão Fernando Coxe","Helena Futo Hebo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923317558","923317558","","","0","2013-09-28","0000-00-00","ARS823","Sapú II","","Adão Fernando Coxe","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("834","Jacira da Conceição M. Mendes","Masculino","Fernandos Mendes","Mariana João Miguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","994504254/926858277","994504254/926858277","","","0","2014-12-06","0000-00-00","ARS733","Bita Vacaria","","Fernandos Mendes","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("835","Jane Filismina José Tchilamba","Masculino","Herculano Janilson Tchilamba","Júlia José Popular","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929609260","929609260","","","0","2012-09-08","0000-00-00","ARS620","Bita Vacaria","","Herculano Janilson Tchilamba","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("836","Joana de Rosário Ch. Sebastião","Masculino","Nelson José Sebastião","Severina Manuel Chipango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924651155/923679550","924651155/923679550","","","0","2014-06-03","0000-00-00","ARS371","Belo Horizonte","","Nelson José Sebastião","2021-08-17 00:00:00","activo","2021-08-17");
INSERT INTO alunos VALUES("837","Joaquim Domingos Noé","Masculino","Eduardo Francisco C. Noé","Cevardina Joaquim Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","942833532","942833532","","","0","2014-07-21","0000-00-00","ARS834","Jacinto Tchipa","","Eduardo Francisco C. Noé","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("838","Jocelina Sebastiáo Henriques","Masculino","Cláudio Jorge Gaspar Henriques","Janeth Agostinho Sebastião","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938274607","938274607","","","0","2014-04-13","0000-00-00","ARS832","Sapú II","","Cláudio Jorge Gaspar Henriques","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("839","Jonatan António Sualala Lamento","Masculino","António João Lamento","Inocencia dos Santos L. Sualala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923929960","923929960","","","0","2014-12-25","0000-00-00","ARS469","Sapú II","","António João Lamento","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("840","Leandra João José","Masculino","Luciano José","Deolinda João Cambolo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943551648","943551648","","","0","2021-09-22","0000-00-00","ARS404","Jacinto Tchipa","","Luciano José","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("841","Luis Lourenço Pena ","Masculino","Luis Lukeny G. Penas","Geovania V. Lourenço","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928779294/915158195","928779294/915158195","","","0","2014-04-05","0000-00-00","ARS603","Jacinto Tchipa","","Luis Lukeny G. Penas","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("842","Madalena de Fatima Castelo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1051","","","","2021-10-29 00:00:00","activo","2021-10-29");
INSERT INTO alunos VALUES("843","Madalena Luisa","Masculino","Domingos José","Luisa M. Luis ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2021-09-20","0000-00-00","ARS901","Jacinto Tchipa","","Domingos José","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("844","Madaleno Fernandes Alexandre","Masculino","Domingos Sebastião","Álveis Alexandre","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932102428","932102428","","","0","2013-08-24","0000-00-00","ARS421","Sapú II","","Domingos Sebastião","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("845","Mara Raquel Gaspar Catomba ","Masculino","Lofa Raimundo Catomba","Isaura Domingos Gaspar","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923495994/949406949","923495994/949406949","","","0","2014-08-30","0000-00-00","ARS397","Jacinto Tchipa","","Lofa Raimundo Catomba","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("846","Marcela Augusto Correia","Masculino","Pedro Pascoal Correia","Tilde Francisco Augusto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923904275/939793703","923904275/939793703","","","0","2014-03-30","0000-00-00","ARS875","Sagrada Esperança","","Pedro Pascoal Correia","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("847","Marcelina Armando dos Santos","Masculino","Manuel dos Santos","Dety Teresa José Armando","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS406","Jacinto Tchipa","","Manuel dos Santos","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("848","Matukiese Francisco K. Bongana","Masculino","Francisco Matu Bongana","Margarida Pedro Kubutuka","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","948056440/924381992","948056440/924381992","","","0","2014-09-30","0000-00-00","ARS335","Bita Vacaria","","Francisco Matu Bongana","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("849","Miguel Luis Bokote","Masculino","Bernardo Bokote","Antonieta Emiliano Luis","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944997093","944997093","","","0","2012-05-07","0000-00-00","ARS903","Jacinto Tchipa","","Bernardo Bokote","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("850","Miriane da Conceção Sachimbongue","Masculino","Reginaldo I. Sachimbongue","Ivone da Conceição Samba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921044460/996516546","921044460/996516546","","","0","2014-04-24","0000-00-00","ARS1005","Jacinto Tchipa","","Reginaldo I. Sachimbongue","2021-10-11 00:00:00","activo","2021-10-11");
INSERT INTO alunos VALUES("851","Moises Fernandes Alexandre","Masculino","Domingos Sebastião","Álveis Alexandre","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932102428","932102428","","","0","2013-07-24","0000-00-00","ARS420","Sapú II","","Domingos Sebastião","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("852","Mónica António Micolo","Masculino","Januario Mussengo Micolo","Rosa Vunge Cassua","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924313456","924313456","","","0","2013-01-03","0000-00-00","ARS705","Sapú II","","Januario Mussengo Micolo","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("853","Nelisa Patrícia P. Miguel","Masculino","Paulo João C. Miguel ","Josina Marlene Paulo P. Miguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","919351983/922351983","919351983/922351983","","","0","2014-08-14","0000-00-00","ARS390","Jacinto Tchipa","","Paulo João C. Miguel ","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("854","Neliza Manuela Breganha Quibato","Masculino","Manuel Fabião Quibato","Luzia Kimbundo Simão Breganha","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923552160/944996623","923552160/944996623","","","0","2014-01-15","0000-00-00","ARS270","Jacinto Tchipa","","Manuel Fabião Quibato","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("855","Paulo Junior Francisco","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS508","","","","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("856","Raquel Isabel Filho da Costa ","Masculino","Daniel Joaquim da Costa","Josefa Adão Cardoso Filho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","915434620","915434620","","","0","2014-04-06","0000-00-00","ARS635","Jacinto Tchipa","","Daniel Joaquim da Costa","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("857","Reginaldo Benza Dias dos Santos","Masculino","Mateus Francisco Dias dos Santos","Lemba Correia B. Dias dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912238140/933255469","912238140/933255469","","","0","2014-03-05","0000-00-00","ARS496","Sapú II","","Mateus Francisco Dias dos Santos","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("858","Rosalina Cavindja","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS443","","","","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("859","Salesia Alcivânia de C. da Rosa","Masculino","Alcides Costa Bravo da Rosa","Eva Domingos de Carvalho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2014-11-27","0000-00-00","ARS193","Sapú II","","Alcides Costa Bravo da Rosa","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("860","Sheila Jorgina F. Sentado","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS793","","","","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("861","Stelvio Pedro Quitiquila","Masculino","Gomes Ferraz Quitiquila","Teresa Pedro Carimba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936670088/944235274","936670088/944235274","","","0","2014-09-25","0000-00-00","ARS221","Sapú II","","Gomes Ferraz Quitiquila","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("862","Teodora Dorca Bongue Varela","Masculino","Joaquim Gomes B. Varela","Angelina Avombo B. Varela","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923491582","923491582","","","0","2014-10-25","0000-00-00","ARS712","Sapú II","","Joaquim Gomes B. Varela","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("863","Victória Aniela Binga Florentino","Masculino","Jovandro Agostinho C. Florentino ","Elizandra Madalena A. Binga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936101327/947504883","936101327/947504883","","","0","2014-08-01","0000-00-00","ARS694","Sapú II","","Jovandro Agostinho C. Florentino ","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("864","Virgilinda C. H. Ferreira dos Santos","Masculino","Virgilio Ferreira dos Santos","Florinda Sabalo Henriques","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934861640","934861640","","","0","2014-11-26","0000-00-00","ARS642","Jacinto Tchipa","","Virgilio Ferreira dos Santos","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("865","Yara Eliane Domingos E. Santos","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS927","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("866","Adão João Lundange","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS512","","","","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("867","Albina Fernandes Ferreira","Masculino","Juariano Victor Ferreira","Bernardina de S. Ferreira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923490705","923490705","","","0","2014-11-30","0000-00-00","ARS204","Sapú II","","Juariano Victor Ferreira","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("868","Anastacio Cardoso da Cruz","Masculino","Gil Adriano","Cicilia Cardoso","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939268032","939268032","","","0","0000-00-00","0000-00-00","ARS475","Jacinto Tchipa","","Gil Adriano","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("869","Ângela Paulo Lukoki","Masculino","Mandoki Ndongala","Margarida Kembi Paulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","994611390/935001121","994611390/935001121","","","0","2014-08-25","0000-00-00","ARS264","Sapú II","","Mandoki Ndongala","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("870","Antonica Quisueia Culua","Masculino","Bonde António Culua","Cecélia Neves Quissueia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927118113/934837710","927118113/934837710","","","0","2014-05-27","0000-00-00","ARS174","Sapú II","","Bonde António Culua","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("871","Bernabé Daniel de Almeida João","Masculino","Berbabé Daniel D. João ","Laleca Fernandes de A. João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923492721/923561482","923492721/923561482","","","0","2014-05-25","0000-00-00","ARS766","Bita Vacaria","","Berbabé Daniel D. João ","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("872","Carolina Rita F. Tavira","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1072","","","","2021-11-08 00:00:00","activo","2021-11-08");
INSERT INTO alunos VALUES("873","Cassio Diogo Pedro","Masculino","Pedro Eduardo Mucungui","Juliana Manuel Diogo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944027893","944027893","","","0","2014-09-11","0000-00-00","ARS726","Jacinto Tchipa","","Pedro Eduardo Mucungui","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("874","Cesar António Mendes","Masculino","Salomão Alberto Mendes","Teresa João António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925190731/923585843","925190731/923585843","","","0","2014-10-09","0000-00-00","ARS43","Sapú II","","Salomão Alberto Mendes","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("875","Constatina Sangombe André","Masculino","Augusto Quessongo André","Adriana Mahuvi Songomba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937773139/939240720","937773139/939240720","","","0","2013-09-30","0000-00-00","ARS360","Sapú II","","Augusto Quessongo André","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("876","Cristian Agostinho Roque","Masculino","Domingos Roque Chinhama","Dulce Alexandra A. Agostinho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943625295/927049489","943625295/927049489","","","0","2014-09-25","0000-00-00","ARS45","Jacinto Tchipa","","Domingos Roque Chinhama","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("877","Daniel João de Barros","Masculino","Manuel Pedro de Barros","Lourença António João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922224165","922224165","","","0","2013-10-19","0000-00-00","ARS323","Jacinto Tchipa","","Manuel Pedro de Barros","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("878","Danilo Manuel Dallas","Masculino","Ezequiel Ramos Dalas","Helena Manuel A. Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927724410/936659291","927724410/936659291","","","0","2014-10-22","0000-00-00","ARS104","Bita Vacaria","","Ezequiel Ramos Dalas","2021-07-28 00:00:00","activo","2021-07-28");
INSERT INTO alunos VALUES("879","Dário Miluanga Massango","Masculino","Albano Massango","Edna Miluanga Massango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923385394","923385394","","","0","0000-00-00","0000-00-00","ARS890","Jacinto Tchipa","","Albano Massango","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("880","Débora Piriquito Félix","Masculino","Olávio Adriano Félix","Margarida Periquito Félix","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997898099/927395584","997898099/927395584","","","0","2013-03-05","0000-00-00","ARS262","Jacinto Tchipa","","Olávio Adriano Félix","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("881","Dilma Mumbanda da Costa Cangile","Masculino","José Fernando Capemba","Beatriz José da Costa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","944263555","944263555","","","0","2014-04-05","0000-00-00","ARS755","Jacinto Tchipa","","José Fernando Capemba","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("882","Domingas Piriquito Felix","Masculino","Paiva Mateus de Oliveira","Clotilde Laurinda Panzo António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923322098","923322098","","","0","0000-00-00","0000-00-00","ARS285","Jacinto Tchipa","","Paiva Mateus de Oliveira","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("883","Eliseu Domingos Jerónimo","Masculino","Cassule Diogo Jerónimo","Maria W. Jerónimo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2015-03-19","0000-00-00","ARS8","Jacinto Tchipa","","Cassule Diogo Jerónimo","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("884","Emanuel Tchinguila de A. Calucango","Masculino","Martinho Perreira Calucango","Juliana N. Martins Calucango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938068055","938068055","","","0","2014-07-26","0000-00-00","ARS72","Jacinto Tchipa","","Martinho Perreira Calucango","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("885","Evanice Guia Francisco José","Masculino","Zinho Francisco José","Ruth Domingos Manuel Guia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924883086/924628633","924883086/924628633","","","0","2014-02-10","0000-00-00","ARS158","Bita Vacaria","","Zinho Francisco José","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("886","Ezequiel Ambrósio Francisco","Masculino","Armindo Joaquim B. Francisco","Apolinaria G. Ambrosio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","946004724","946004724","","","0","2014-07-19","0000-00-00","ARS90","Bita Vacaria","","Armindo Joaquim B. Francisco","2021-07-16 00:00:00","activo","2021-07-16");
INSERT INTO alunos VALUES("887","Felicia Tchokunda Manuel","Masculino","Alfredo Manuel","Paulina Tchokunda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2014-06-15","0000-00-00","ARS240","Jacinto Tchipa","","Alfredo Manuel","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("888","Felix Inongo Bela","Masculino","Mbenza Bela","Inésia Feliz Inango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925604764","925604764","","","0","2014-10-22","0000-00-00","ARS307","Sapú II","","Mbenza Bela","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("889","Francelina Joia Pedro de Almeida","Masculino","Pascoal Francisco de Almeida","Márcia Joaquim P. DE Almeida ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923018663/925395767","923018663/925395767","","","0","2014-11-30","0000-00-00","ARS138","Jacinto Tchipa","","Pascoal Francisco de Almeida","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("890","Germano Domingos João Zua","Masculino","Germano João Zua","Gizela de Fátima C. João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922938949","922938949","","","0","2014-07-14","0000-00-00","ARS373","Jacinto Tchipa","","Germano João Zua","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("891","Gilberto Magalhães da Costa ","Masculino","Costa Domingos","Beatriz Magalhães","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923225845","923225845","","","0","2014-05-18","0000-00-00","ARS5","Jacinto Tchipa","","Costa Domingos","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("892","Ismael Delcio Katala Gabriel","Masculino","Kiaku Gabriel ","Maria Celeste A. K.  Gabriel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","917462125/945589177","917462125/945589177","","","0","2014-08-31","0000-00-00","ARS40","Jacinto Tchipa","","Kiaku Gabriel ","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("893","Jovelino Manuel T. António","Masculino","Miala António","Tulante Tukala Ana","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933515041","933515041","","","0","2013-08-31","0000-00-00","ARS350","Sapú II","","Miala António","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("894","Laurem Cadete da Silva","Masculino","José Mendes Francisco da Silva","Lourdes Cadete","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997/239465/994407513","997/239465/994407513","","","0","2014-09-30","0000-00-00","ARS260","Jacinto Tchipa","","José Mendes Francisco da Silva","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("895","Ludmila da Silva Mateus","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1068","","","","2021-11-10 00:00:00","activo","2021-11-10");
INSERT INTO alunos VALUES("896","Luiana Maria Adriano André","Masculino","Alberto José André","Lucinda António Adriano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923559563","923559563","","","0","2013-11-24","0000-00-00","ARS154","Sapú II","","Alberto José André","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("897","Maria de Fátima António Diogo","Masculino","Pedro Franisco Diogo","Nazareth Francisca de A. Diogo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931678472","931678472","","","0","2014-04-07","0000-00-00","ARS831","Jacinto Tchipa","","Pedro Franisco Diogo","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("898","Maria Jeremias Sapata","Masculino","Teodoro Sapata","Esperança Francisco Jeremias","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927830692","927830692","","","0","2013-11-07","0000-00-00","ARS236","Sapú II","","Teodoro Sapata","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("899","Martinho Marcos Perreira Rodrigues","Masculino","Gilberto Rodrigues","Lembinha Martins Perreira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928348878/927688007","928348878/927688007","","","0","2013-07-28","0000-00-00","ARS345","Sapú II","","Gilberto Rodrigues","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("900","Olgariclene João Simão","Masculino","Aldimiro Manuel Mateus Simão","Arlete João Simão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933458939/915966020","933458939/915966020","","","0","2014-03-02","0000-00-00","ARS324","Jacinto Tchipa","","Aldimiro Manuel Mateus Simão","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("901","Paulo Eduardo Gomes","Masculino","Francisco Eugénia Francisco","Sara Eduardo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2014-05-11","0000-00-00","ARS82","Jacinto Tchipa","","Francisco Eugénia Francisco","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("902","Pedro Domingos André Felix","Masculino","Pedro Domingos J. Felix","Telma Baptista André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924213865/925118363","924213865/925118363","","","0","2014-04-22","0000-00-00","ARS165","Sapú II","","Pedro Domingos J. Felix","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("903","Rufino Quifuba Correia","Masculino","António Paulo Correia","Luzia Fernando Quifuba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938789470","938789470","","","0","2013-07-20","0000-00-00","ARS15","Jacinto Tchipa","","António Paulo Correia","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("904","Sara António Sebastião","Masculino","Lutumba K. Sebastião ","Domiana B. Antonio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924996814/924996814","924996814/924996814","","","0","2014-11-02","0000-00-00","ARS1022","Jacinto Tchipa","","Lutumba K. Sebastião ","2021-10-06 00:00:00","activo","2021-10-06");
INSERT INTO alunos VALUES("905","William Bruno Domingos de Oliveira","Masculino","Domingos João de Oliveira","Luzia Mbaca Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923281060/931616637","923281060/931616637","","","0","2014-03-06","0000-00-00","ARS168","Sapú II","","Domingos João de Oliveira","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("906","Zenilda Filomena da Silva","Masculino","Jorge Manuel de Oliveira","Jizela Filomena J. Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","990523795/923523795","990523795/923523795","","","0","2015-04-01","0000-00-00","ARS357","Sapú II","","Jorge Manuel de Oliveira","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("907","Dorivaldo Cipriano Albano","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1090","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("908","Aline Leticia Mateus da Gama","Masculino","Domingos Manuel Mendes da Gama","Ana de Nazaré M. Gama ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924414878","924414878","","","0","2015-05-28","0000-00-00","ARS886","Jacinto Tchipa","","Domingos Manuel Mendes da Gama","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("909","Alione Ricardo Ferreira Manuel","Masculino","Correia Cristóvão Manuel","Roobiany Patrícia B. Ferreira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937285904/931376180","937285904/931376180","","","0","2015-03-02","0000-00-00","ARS632","Sapú II","","Correia Cristóvão Manuel","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("910","Angelina Preciosa Álvaro","Masculino","Simão António Álvaro","Virgília Natália Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923474487","923474487","","","0","2015-04-16","0000-00-00","ARS869","Sapú II","","Simão António Álvaro","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("911","Atsa Manuela I. Manuel","Masculino","Carlos Manuel","Elvira da Silva Gomes Inglês","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924453007/925978946","924453007/925978946","","","0","2015-03-06","0000-00-00","ARS863","Jacinto Tchipa","","Carlos Manuel","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("912","Betuel Francisco João Kindissa","Masculino","Gaspar Francisco M. Kindissa","Isabel Sebastião J. Kindissa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938165327/992811857","938165327/992811857","","","0","2015-01-27","0000-00-00","ARS559","Belo Horizonte","","Gaspar Francisco M. Kindissa","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("913","Carlos Abel Capamba","Masculino","Carlos Abel Capamba","Olivia j. Capamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923957700","923957700","","","0","2015-08-19","0000-00-00","ARS904","Jacinto Tchipa","","Carlos Abel Capamba","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("914","Carlos Chivinda Chipango","Masculino","Joáo Carlos Chipango","Loide L. Ch. Chipango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926714270","926714270","","","0","0000-00-00","0000-00-00","ARS951","Sapú II","","Joáo Carlos Chipango","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("915","Domingos Pedro Cambando","Masculino","Henriques Ngola Cambando","Antónica Joaquim Pedro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924305424","924305424","","","0","2014-08-18","0000-00-00","ARS530","Sapú II","","Henriques Ngola Cambando","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("916","Edvania Rosa António Furtado","Masculino","Edmundo Agostinho L. Furtado","Fansónia Admira . António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928093380/941651969","928093380/941651969","","","0","2015-08-15","0000-00-00","ARS819","Sapú II","","Edmundo Agostinho L. Furtado","2021-09-08 00:00:00","activo","2021-09-08");
INSERT INTO alunos VALUES("917","Elisa Paulina D.  Nkanassau","Masculino","Makiesse Nkanassau","Mavinga Paulina Ndombase","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943016809","943016809","","","0","2014-02-04","0000-00-00","ARS1002","Bita Vacaria","","Makiesse Nkanassau","2021-10-04 00:00:00","activo","2021-10-04");
INSERT INTO alunos VALUES("918","Elisângelo Domingos Francisco","Masculino","Geovane Afonso Francisco","Carmem S. DA Silva Franciso","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929158614","929158614","","","0","2015-04-03","0000-00-00","ARS866","","","Geovane Afonso Francisco","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("919","Elizandro Adão de Lima Quimonha","Masculino","Adão Canzambi Quimonha","Cristina Caetano de Lima","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939172858","939172858","","","0","2014-11-21","0000-00-00","ARS742","Sapú II","","Adão Canzambi Quimonha","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("920","Emanuel Sapalo Domingos","Masculino","Francisco Silvano Domingos","Helena Quaresma F. Sapalo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926041034/998041034","926041034/998041034","","","0","2015-11-22","0000-00-00","ARS623","Jacinto Tchipa","","Francisco Silvano Domingos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("921","Esmael Benza Dias dos Santos","Masculino","Mateus Francisco Dias dos Santos","Lemba Correia B. Dias dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912238140/933255469","912238140/933255469","","","0","2015-08-21","0000-00-00","ARS503","Sapú II","","Mateus Francisco Dias dos Santos","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("922","Feliciano Fonseca C. Joaquim ","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS962","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("923","Fernando Chiquemba Soares","Masculino","Luís José Gomes Soares","Cristina C. C. Chiquemba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","998761299","998761299","","","0","2014-11-11","0000-00-00","ARS597","Bita Vacaria","","Luís José Gomes Soares","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("924","Fernando Edvanio Azevedo Martins","Masculino","Francisco W. Martins","Sangui Elizabeth","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945486765","945486765","","","0","2015-06-30","0000-00-00","ARS921","Jacinto Tchipa","","Francisco W. Martins","2021-08-23 00:00:00","activo","2021-08-23");
INSERT INTO alunos VALUES("925","Francisco da Costa Gaspar","Masculino","Frankilin Adão M. Gaspar","Maria João da Costa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930753701","930753701","","","0","2015-05-29","0000-00-00","ARS486","Bequessa","","Frankilin Adão M. Gaspar","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("926","Gabriela Kahali André","Masculino","Bruno Geraldo N. André","Bernarda António Nojamba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","991862878/932545364","991862878/932545364","","","0","2015-10-26","0000-00-00","ARS251","Jacinto Tchipa","","Bruno Geraldo N. André","2021-08-04 00:00:00","activo","2021-08-04");
INSERT INTO alunos VALUES("927","Gilda Ruth Inglês André","Masculino","Pablo Manuel André","Esperança da Silva G. André ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","991915935/925978746","991915935/925978746","","","0","2015-10-30","0000-00-00","ARS862","Jacinto Tchipa","","Pablo Manuel André","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("928","Guilherme Ngunza Bungo","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1017","","","","2021-10-12 00:00:00","activo","2021-10-12");
INSERT INTO alunos VALUES("929","Helton Gabriel da Silva e Costa","Masculino","Tavares José da Silva Costa","Helena Domingos da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","941353834/912167025","941353834/912167025","","","0","2015-01-20","0000-00-00","ARS460","Jacinto Tchipa","","Tavares José da Silva Costa","2021-08-25 00:00:00","activo","2021-08-25");
INSERT INTO alunos VALUES("930","Jesuina Fernandes Filho Alfredo","Masculino","Alberto Bastos Alfredo","Leonora da Costa Filho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923326642","923326642","","","0","2015-07-29","0000-00-00","ARS524","Jacinto Tchipa","","Alberto Bastos Alfredo","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("931","José Luis Duarte Tongonho","Masculino","José Mariano T. Duarte","Maria da Conceição","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923365659/923943484","923365659/923943484","","","0","2014-09-26","0000-00-00","ARS722","Sapú II","","José Mariano T. Duarte","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("932","Josefa Bernarda de A. Domingos","Masculino","Salvador Filipe Domingos","Ester Cristóvão de A. Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922857723/990942263","922857723/990942263","","","0","2015-06-07","0000-00-00","ARS689","Jacinto Tchipa","","Salvador Filipe Domingos","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("933","Jossany Eliaquim Faztudo Hatewa","Masculino","Mateus Eugénio N. Hatewa","Albertina Carllos Faztudo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923510982/912887419","923510982/912887419","","","0","2015-11-11","0000-00-00","ARS206","Sapú II","","Mateus Eugénio N. Hatewa","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("934","Kuini Daniela D. Luis","Masculino","Nelson Brito Luis","Lidia de Fátima Dinis","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922380068/923505908","922380068/923505908","","","0","2015-06-16","0000-00-00","ARS897","Sapú II","","Nelson Brito Luis","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("935","Ludimila Patricia Neto Pascoal","Masculino","Francisco Adão Pascoal","Mariza da Silva Neto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925059606","925059606","","","0","2014-07-02","0000-00-00","ARS771","Jacinto Tchipa","","Francisco Adão Pascoal","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("936","Luis Alexandre Brandão","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS997","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("937","Manuel Paulino Cassua Francisco","Masculino","Domingos Paulino Francisco","Conceição Nhanga Cassua","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","995142774/921387430","995142774/921387430","","","0","2015-05-30","0000-00-00","ARS453","Sapú II","","Domingos Paulino Francisco","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("938","Maria Ncamba Mbedi","Masculino","Pembele Diambo",".....................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928830046","928830046","","","0","2015-05-20","0000-00-00","ARS288","Sapú II","","Pembele Diambo","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("939","Milton Soares Cravid","Masculino","Milton de Assunção Cravid","Maria da Conçeição Luanda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923761745/990761745","923761745/990761745","","","0","2021-04-23","0000-00-00","ARS609","Bita Vacaria","","Milton de Assunção Cravid","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("940","Nazareno Lourenço Neves","Masculino","José Neves","Nazaré Nhanga Lourenço","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923334492/942006639","923334492/942006639","","","0","2016-02-12","0000-00-00","ARS588","Jacinto Tchipa","","José Neves","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("941","Reginaldo de Castro Manuel","Masculino","Cláudio A. Manuel","Eva Venâncio Castro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","995582063","995582063","","","0","2015-07-27","0000-00-00","ARS428","Jacinto Tchipa","","Cláudio A. Manuel","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("942","Rosa Isabel C. Pacheco","Masculino","Gonçalveis Pacheco","Florinda Mufungueno Chipemenu","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934511699/937772517","934511699/937772517","","","0","0000-00-00","0000-00-00","ARS663","Sapú II","","Gonçalveis Pacheco","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("943","Silvio Mafuta","Masculino","António Mafuta","Nkuna Luzizila Regina","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945253214","945253214","","","0","0000-00-00","0000-00-00","ARS946","Sapú II","","António Mafuta","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("944","Tutula Nascimento M. Bernardo","Masculino","Tutula Nascimento M. Bernardo","Mzumba Kisoka","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","941938629","941938629","","","0","2016-04-09","0000-00-00","ARS713","Bita Vacaria","","Tutula Nascimento M. Bernardo","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("945","Julinho Mupessela Tetchoque","Masculino","Cesar Mupessela Tetchoque","Teresa Joaquim","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929609260","929609260","","","0","2013-06-20","0000-00-00","ARS769","Bita Vacaria","","Cesar Mupessela Tetchoque","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("946","Eliézer Augusto Venâncio Jeremias","Masculino","Anacleto m. Jeremias","Ludivina C. Venâncio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925154406","925154406","","","0","2015-06-03","0000-00-00","ARS786","Jacinto Tchipa","","Anacleto m. Jeremias","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("947","Paulo Vunge Baptista","Masculino","José João Baptista","Rosa Buta Vunge","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925899770","925899770","","","0","2014-08-16","0000-00-00","ARS856","","","José João Baptista","2021-09-13 00:00:00","activo","2021-09-13");
INSERT INTO alunos VALUES("948","Victória Sebastião","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1055","","","","2021-01-03 00:00:00","activo","2021-01-03");
INSERT INTO alunos VALUES("949","Adelaide Francisco André ","Masculino","................","Madalena Francisco André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923966523/931612423","923966523/931612423","","","0","2015-05-02","0000-00-00","ARS518","Sapú II","","................","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("950","Adriano Braga Monteiro","Masculino","Alfredo Joaquim Monteiro","Luzia Pedro de Sousa Braga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933502712","933502712","","","0","2015-08-10","0000-00-00","ARS316","Jacinto Tchipa","","Alfredo Joaquim Monteiro","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("951","Ana Maria da Silva Machado","Masculino","Samuel José Machado","Teresa Caetano da Silva Machado","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923554922/923969885","923554922/923969885","","","0","2017-04-25","0000-00-00","ARS377","Sapú II","","Samuel José Machado","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("952","Celestino Messele V. Sapembe","Masculino","Germano Sapembe S. Wilson","Josefina N. V. Nangulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945605626","945605626","","","0","2015-01-18","0000-00-00","ARS211","Jacinto Tchipa","","Germano Sapembe S. Wilson","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("953","Constância Teodora P. Alberto","Masculino","Orlando Constantino V. Alberto","Isabel Avelina Pacheco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924219931/917612782","924219931/917612782","","","0","2014-11-17","0000-00-00","ARS92","Sapú II","","Orlando Constantino V. Alberto","2021-07-22 00:00:00","activo","2021-07-22");
INSERT INTO alunos VALUES("954","Cristiano Cassule Tavares","Masculino","Venceslau Tavares Cristovão","Eva António Cassule","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925406204","925406204","","","0","2015-05-13","0000-00-00","ARS61","Sapú II","","Venceslau Tavares Cristovão","2021-07-16 00:00:00","activo","2021-07-16");
INSERT INTO alunos VALUES("955","Dárcio António André Júnior","Masculino","António Francisco L. Júnior","Catarina André","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923462455","923462455","","","0","2015-01-14","0000-00-00","ARS245","Jacinto Tchipa","","António Francisco L. Júnior","2021-08-04 00:00:00","activo","2021-08-04");
INSERT INTO alunos VALUES("956","Denise Cardoso Jerónimo","Masculino","Paulo Mendes de A. Jerónimo","Regina Guedes Cardoso","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2015-12-07","0000-00-00","ARS525","Jacinto Tchipa","","Paulo Mendes de A. Jerónimo","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("957","Deolinda Inácio Cabaça dos Santos","Masculino","Osvaldo António D. Dos Santos","Olga Manuel M. Cabaça","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926045588/924961668","926045588/924961668","","","0","2014-07-08","0000-00-00","ARS292","Bita Vacaria","","Osvaldo António D. Dos Santos","2021-08-11 00:00:00","activo","2021-08-11");
INSERT INTO alunos VALUES("958","Domingas João Miguel","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS121","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("959","Eduania Teresa M. Ferraz","Masculino","Rogério Ferraz","Teresa Munkanda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928931078/926238150","928931078/926238150","","","0","2016-02-13","0000-00-00","ARS415","Sapú II","","Rogério Ferraz","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("960","Edvânia Teresa Munkanda Ferraz","Masculino","Rogério Ferraz","Teresa Munkanda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928931078/926238150","928931078/926238150","","","0","2016-02-13","0000-00-00","ARS411","Sapú II","","Rogério Ferraz","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("961","Esagildo Cabinga Francisco","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS402","Jacinto Tchipa","","","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("962","Fernanda António Miguel","Masculino","Sanito Simões Miguel","Paulina André António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927554728/927342606","927554728/927342606","","","0","2015-07-06","0000-00-00","ARS68","Jacinto Tchipa","","Sanito Simões Miguel","2021-07-20 00:00:00","activo","2021-07-20");
INSERT INTO alunos VALUES("963","Franciele Sónia Lisboa Gomes","Masculino","Francisco Manuel Gomes","Ana Marisa Cassoma L. Gomes","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921558526/924791529","921558526/924791529","","","0","2015-10-13","0000-00-00","ARS209","Sapú II","","Francisco Manuel Gomes","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("964","Geovani Kiami Francisco Bango","Masculino","Paulo M. Bango","Ana Maria F. Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","990268015/925268015","990268015/925268015","","","0","2015-04-27","0000-00-00","ARS929","Bita Vacaria","","Paulo M. Bango","2021-07-22 00:00:00","activo","2021-07-22");
INSERT INTO alunos VALUES("965","Glaucia Celeste C. Manuel","Masculino","Daniel Domingos Manuel","Rebeca Mandeca C. Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923471411","923471411","","","0","2015-05-25","0000-00-00","ARS24","Jacinto Tchipa","","Daniel Domingos Manuel","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("966","Guedes Pelinganga de L. Barros","Masculino","Leonel Luis Barros","Sabrita Adão de Lucas ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938472401/927948804","938472401/927948804","","","0","2015-04-10","0000-00-00","ARS556","Jacinto Tchipa","","Leonel Luis Barros","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("967","Jaclene Simões Camburi","Masculino","Elizandro Monteiro Camburi","Indira da Cunha Simões","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2015-07-23","0000-00-00","ARS764","Jacinto Tchipa","","Elizandro Monteiro Camburi","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("968","Janeth Manuela Mateus Xavier","Masculino","Bento Augusto P. Xavier","Isabel Bernarda D. Mateus","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924932282/942019265","924932282/942019265","","","0","2015-01-14","0000-00-00","ARS101","Jacinto Tchipa","","Bento Augusto P. Xavier","2021-07-27 00:00:00","activo","2021-07-27");
INSERT INTO alunos VALUES("969","Jenifer Alzira Fernando António","Masculino","João António","Augusta Manjilo V. Fernando","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922671209/912647073","922671209/912647073","","","0","2015-07-17","0000-00-00","ARS100","Sapú II","","João António","2021-07-27 00:00:00","activo","2021-07-27");
INSERT INTO alunos VALUES("970","Joel Tito Muanilifa","Masculino","Glória Elizabeth","Muanilifa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923494922","923494922","","","0","2014-12-30","0000-00-00","ARS348","Sapú II","","Glória Elizabeth","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("971","Jorge Emiliano da Silva Nicolau","Masculino","Domingos Vunje Nicolau","Jorgina Augusto da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922805057","922805057","","","0","2014-11-10","0000-00-00","ARS427","Jacinto Tchipa","","Domingos Vunje Nicolau","2021-08-20 00:00:00","activo","2021-08-20");
INSERT INTO alunos VALUES("972","José Ernesto Sequeira Andrade","Masculino","Sunda Paulo Andrade","Elvira Isilda Sequeira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931298553/922604638","931298553/922604638","","","0","2015-06-01","0000-00-00","ARS112","Jacinto Tchipa","","Sunda Paulo Andrade","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("973","Josefa Maria João Lourenço","Masculino","José Francisco Lourenço","Maria João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923578886/932604972","923578886/932604972","","","0","2015-07-28","0000-00-00","ARS66","Jacinto Tchipa","","José Francisco Lourenço","2021-07-19 00:00:00","activo","2021-07-19");
INSERT INTO alunos VALUES("974","Joselina Etilene J. Quissanga","Masculino","Gabriel Francisco Quissanga","Domingas N. José","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997888893/923500770","997888893/923500770","","","0","2015-07-06","0000-00-00","ARS1025","Prenda","","Gabriel Francisco Quissanga","2021-10-14 00:00:00","activo","2021-10-14");
INSERT INTO alunos VALUES("975","Juariano Fernandes Ferreira","Masculino","Juariano Victor Ferreira","Bernardina de S. Ferreira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923490705","923490705","","","0","2016-03-27","0000-00-00","ARS205","Sapú II","","Juariano Victor Ferreira","2021-08-06 00:00:00","activo","2021-08-06");
INSERT INTO alunos VALUES("976","Kiame Joaquim Militão","Masculino","Joaquim Francisco Militão","Verónica Isabel Juca Militão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923898195","923898195","","","0","2015-05-21","0000-00-00","ARS159","Bita Vacaria","","Joaquim Francisco Militão","2021-08-03 00:00:00","activo","2021-08-03");
INSERT INTO alunos VALUES("977","Ludmila Joice M. António","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS119","","","","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("978","Luis Ngangui Morais João","Masculino","José Ngangui F. João","Laura da Costa Morais","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","912229868/925623050","912229868/925623050","","","0","2015-01-03","0000-00-00","ARS32","Jacinto Tchipa","","José Ngangui F. João","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("979","Luquenia Capemba Boa Vida","Masculino","Carlos Pinto Boavida","Engracia Zage Capemba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927824076/923961779","927824076/923961779","","","0","2015-04-12","0000-00-00","ARS578","Jacinto Tchipa","","Carlos Pinto Boavida","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("980","Maria Filomena Quissanga Pedro","Masculino","Francisco Miguel S. Pedro","Ivone de Fátima R. Quissanga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997888892/924345501","997888892/924345501","","","0","2014-05-11","0000-00-00","ARS1026","Prenda","","Francisco Miguel S. Pedro","2021-10-14 00:00:00","activo","2021-10-14");
INSERT INTO alunos VALUES("981","Marina Larissa Martins Junqueira","Masculino","Gildo Quele Junqueira","Lauria Manuel Martins","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","939705191/929102599","939705191/929102599","","","0","2014-08-25","0000-00-00","ARS191","Sapú II","","Gildo Quele Junqueira","2021-08-05 00:00:00","activo","2021-08-05");
INSERT INTO alunos VALUES("982","Micaela Chimbungule Hebo","Masculino","Mateus Manuel Hebo","Albertina Domingos Chimbungule","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927559381/923133592","927559381/923133592","","","0","2015-11-20","0000-00-00","ARS233","Sapú II","","Mateus Manuel Hebo","2021-08-09 00:00:00","activo","2021-08-09");
INSERT INTO alunos VALUES("983","Nelson N. António Afonso","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS131","","","","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("984","Paulo da Silva Mussunga","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1052","","","","2021-11-04 00:00:00","activo","2021-11-04");
INSERT INTO alunos VALUES("985","Pedro Wawe Tavares Malale","Masculino","Joaquim Bumba Malale","Sivetla Tenente Tavares","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926851955/923474621","926851955/923474621","","","0","2015-09-01","0000-00-00","ARS67","Jacinto Tchipa","","Joaquim Bumba Malale","2021-07-19 00:00:00","activo","2021-07-19");
INSERT INTO alunos VALUES("986","Priscila Maria Munnkanda Ferraz","Masculino","Rogério Ferraz","Teresa Munkanda","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928931078/926238150","928931078/926238150","","","0","2016-02-13","0000-00-00","ARS412","Sapú II","","Rogério Ferraz","2021-08-19 00:00:00","activo","2021-08-19");
INSERT INTO alunos VALUES("987","Rosária Wimbo André","Masculino","Augusto Quessongo André","Adriana Mahuvi Songomba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937773139/939240720","937773139/939240720","","","0","2016-04-19","0000-00-00","ARS359","Sapú II","","Augusto Quessongo André","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("988","Ruth Quifucussa Armando Muanza","Masculino","António Armando Muanza","Rebeca Tavares Quificussa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924862423","924862423","","","0","2014-12-05","0000-00-00","ARS342","Sapú II","","António Armando Muanza","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("989","Virgilio David dos Santos","Masculino","............","Jessica dos Santos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921446959","921446959","","","0","2016-04-14","0000-00-00","ARS943","Jacinto Tchipa","","............","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("990","Abel Nicolau Marcos","Masculino","Abel Marcos","Sara Teresa Nicolau","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930616334","930616334","","","0","2016-06-05","0000-00-00","ARS671","Bita Vacaria","","Abel Marcos","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("991","Alexandra Engracia Pulo Lukoki","Masculino","Mandoki Ndongala","Margarida Kembi Paulo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","994611390/935001121","994611390/935001121","","","0","2016-10-26","0000-00-00","ARS528","Sapú II","","Mandoki Ndongala","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("992","Aliandra Melisa Vieira Nsamber","Masculino","André M. Nsamber ","Alice Vieira Sebastião","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922118622/996100084","922118622/996100084","","","0","2015-10-17","0000-00-00","ARS684","Jacinto Tchipa","","André M. Nsamber ","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("993","Aline Maria Agostino Manuel","Masculino","Manuel Cardoso Cazanga","Rosa Agostino","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","947796767/948037748","947796767/948037748","","","0","2017-01-11","0000-00-00","ARS797","Jacinto Tchipa","","Manuel Cardoso Cazanga","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("994","André Salvador Domingos","Masculino",".................","Cândida Flora Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2016-10-15","0000-00-00","ARS487","Sapú II","",".................","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("995","Avelina Chombo Chilombo","Masculino","José Mariano Chilumbo","Vanilson Cristina Daniel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949618422","949618422","","","0","2015-07-23","0000-00-00","ARS699","Sapú II","","José Mariano Chilumbo","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("996","Azael Francisco L. Álvaro","Masculino","Simão António Álvaro","Virgília Natália Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923474487","923474487","","","0","2016-12-05","0000-00-00","ARS867","","","Simão António Álvaro","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("997","Belarmino Belídio Ramundo Alberto","Masculino","Claudio António Alberto","Isabel Raimundo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928830024","928830024","","","0","2016-05-19","0000-00-00","ARS956","Jacinto Tchipa","","Claudio António Alberto","2021-09-27 00:00:00","activo","2021-09-27");
INSERT INTO alunos VALUES("998","Carla Pinto Pedro","Masculino","Sebastião da Costa Pedro","Domingas Diogo Pinto","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","937365635/997270192","937365635/997270192","","","0","2016-05-23","0000-00-00","ARS681","Bita Vacaria","","Sebastião da Costa Pedro","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("999","Eduarda Domingos Noé","Masculino","Eduardo Francisco C. Noé","Cevardina Joaquim Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","942833532","942833532","","","0","2015-09-16","0000-00-00","ARS801","Jacinto Tchipa","","Eduardo Francisco C. Noé","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("1000","Estevão Caetano João António","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS941","","","","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("1001","Eugenia Mumphawe K. Chivassa","Masculino","Domingos Carlos Tchivassi","Domingas Fumança","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924334345","924334345","","","0","2015-09-02","0000-00-00","ARS615","Jacinto Tchipa","","Domingos Carlos Tchivassi","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("1002","Jasmim Teresa Inango Bela","Masculino","Mbenza Bela","Inésia Feliz Inango","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925604764","925604764","","","0","2016-07-27","0000-00-00","ARS706","Sapú II","","Mbenza Bela","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("1003","João Victor Sualala Lamento","Masculino","António João Lamento","Inocencia dos Santos L. Sualala","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923929960","923929960","","","0","2017-06-23","0000-00-00","ARS470","Sapú II","","António João Lamento","2021-08-26 00:00:00","activo","2021-08-26");
INSERT INTO alunos VALUES("1004","Josué José da Silva Narciso","Masculino","Kimild Guimarães J. Narciso","Elizangela Mendes da S. Bernardo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923205975","923205975","","","0","2016-05-07","0000-00-00","ARS618","Jacinto Tchipa","","Kimild Guimarães J. Narciso","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("1005","Kailane Patricia Ferreira","Masculino","...............................","Irina Patricia M. Ferreira ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","946606035","946606035","","","0","2016-10-22","0000-00-00","ARS900","Cinquentinha","","...............................","2021-09-20 00:00:00","activo","2021-09-20");
INSERT INTO alunos VALUES("1006","Luciano Faztudo Luis Mandavir","Masculino","Elias Luciano Sangoia L. Mandavir","Maria Emila Dala Faztudo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949911359/928780209","949911359/928780209","","","0","2016-07-08","0000-00-00","ARS796","","","Elias Luciano Sangoia L. Mandavir","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("1007","Manuel João Tomás","Masculino","Jano Manuel da F. Tomás","Eva Cazunga João","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","945200897/927847702","945200897/927847702","","","0","2016-01-17","0000-00-00","ARS137","Sapú II","","Jano Manuel da F. Tomás","2021-07-30 00:00:00","activo","2021-07-30");
INSERT INTO alunos VALUES("1008","Mauricio de Rosa Manuel","Masculino","Mateus Manuel","Natalia de Rosa Cativa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921095436","921095436","","","0","2016-08-06","0000-00-00","ARS692","Bita Vacaria","","Mateus Manuel","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("1009","Nataniel Filipe L. Da Rocha ","Masculino","Emanuel Patricio A. da Rocha ","Ester João Luhui","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","946605439","946605439","","","0","2016-06-29","0000-00-00","ARS488","Bita Vacaria","","Emanuel Patricio A. da Rocha ","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("1010","Nelsa Albino Pacheco","Masculino","Daniel Lourenço Pacheco","Maria Nzambi Albino","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934511699/925747764","934511699/925747764","","","0","0000-00-00","0000-00-00","ARS661","Sapú II","","Daniel Lourenço Pacheco","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("1011","Nilza albino Pacheco","Masculino","Daniel Lourenço Pacheco","Maria Nzambi Albino","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934511699/925747764","934511699/925747764","","","0","2016-06-22","0000-00-00","ARS662","Sapú II","","Daniel Lourenço Pacheco","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("1012","Onésimo Oscar Francisco","Masculino","João Roberto Francisco","Francisca Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922908048","922908048","","","0","2016-03-02","0000-00-00","ARS976","Jacinto Tchipa","","João Roberto Francisco","2021-10-06 00:00:00","activo","2021-10-06");
INSERT INTO alunos VALUES("1013","Pamela Rafaela Mateus da Gama ","Masculino","Domingos Manuel Mendes da Gama","Ana de Nazaré M. Gama ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924414878","924414878","","","0","2017-07-17","0000-00-00","ARS887","Jacinto Tchipa","","Domingos Manuel Mendes da Gama","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("1014","Paulino Daniel Francisco","Masculino","Agostinho Francisco","Paulina Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","9304340","9304340","","","0","0000-00-00","0000-00-00","ARS1024","Jacinto Tchipa","","Agostinho Francisco","2021-10-06 00:00:00","activo","2021-10-06");
INSERT INTO alunos VALUES("1015","Petra Elizete Rabassal Luis","Masculino","Helder João Luis","Edmara J. S. Rabassal","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","941388555","941388555","","","0","2016-12-08","0000-00-00","ARS768","Sapú II","","Helder João Luis","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("1016","Rosineide Sebastião Henriques","Masculino","Cláudio Jorge Gaspar Henriques","Janeth Agostinho Sebastião","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938276607/927159756","938276607/927159756","","","0","2015-07-21","0000-00-00","ARS800","Jacinto Tchipa","","Cláudio Jorge Gaspar Henriques","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("1017","Uziel Filipe Texeira Dange","Masculino","Emanuel Ginga Dange","Filipa Domingos Texeira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","930394312","930394312","","","0","2016-06-07","0000-00-00","ARS611","Jacinto Tchipa","","Emanuel Ginga Dange","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("1018","Wilson Tchokolomwenho P. Rodrigues","Masculino","Gilberto Rodrigues","Lembinha Martins Perreira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928348876","928348876","","","0","2016-07-10","0000-00-00","ARS349","Sapú II","","Gilberto Rodrigues","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("1019","Gaspar Luis Casimiro","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1084","","","","2021-11-09 00:00:00","activo","2021-11-09");
INSERT INTO alunos VALUES("1020","Adiel Segunda Gomes ","Masculino","Faustino Vasco J. Gomes","Tamara de Almeida Cristovão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923848537/927305511","923848537/927305511","","","0","0000-00-00","0000-00-00","ARS527","Jacinto Tchipa","","Faustino Vasco J. Gomes","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("1021","Adriano Tomas Balanga ","Masculino","Euclides Balanga","Evandra v. Balanga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923241628","923241628","","","0","2016-09-13","0000-00-00","ARS249","Jacinto Tchipa","","Euclides Balanga","2021-08-04 00:00:00","activo","2021-08-04");
INSERT INTO alunos VALUES("1022","Albertina Ruth Alfredo N. Dias","Masculino","Alberto Sacumboco N. Dias","Teresa Daniel Alfredo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928154612","928154612","","","0","2016-04-04","0000-00-00","ARS392","Jacinto Tchipa","","Alberto Sacumboco N. Dias","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("1023","Alberto Misael M. Da Silva","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1031","","","","2021-10-14 00:00:00","activo","2021-10-14");
INSERT INTO alunos VALUES("1024","Alexandre João Miguel","Masculino","Alexandre Cardoso Miguel","Helena Isabel K. Jõao","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","996288648/949410338","996288648/949410338","","","0","2017-01-09","0000-00-00","ARS124","Bita Vacaria","","Alexandre Cardoso Miguel","2021-07-29 00:00:00","activo","2021-07-29");
INSERT INTO alunos VALUES("1025","Antónia Kambamba E. Fernando","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS810","","","","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("1026","Benilda Sara João Kindissa","Masculino","Gaspar Francisco M. Kindissa","Isabel Sebastião J. Kindissa","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","938165327/992811857","938165327/992811857","","","0","2017-03-05","0000-00-00","ARS560","Belo Horizonte","","Gaspar Francisco M. Kindissa","2021-08-31 00:00:00","activo","2021-08-31");
INSERT INTO alunos VALUES("1027","Braulio de Jesus Malanga Francisco","Masculino","Tânio Rosário A. Francisco","Adelaide Armando Malanga","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923949749/934693589","923949749/934693589","","","0","2016-08-13","0000-00-00","ARS701","Bita Vacaria","","Tânio Rosário A. Francisco","2021-09-06 00:00:00","activo","2021-09-06");
INSERT INTO alunos VALUES("1028","Cássia Melody Cassequel Alexandre","Masculino","António Ferreira Alexandre","Conceição Domingos C. Alexandre","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924206207/924206208","924206207/924206208","","","0","2016-05-14","0000-00-00","ARS384","Jacinto Tchipa","","António Ferreira Alexandre","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("1029","Cristiane Tchivassi Carieji","Masculino","Filomeno Franco Carieji","Elsa Fumança Tchivassi","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927968509","927968509","","","0","2016-07-11","0000-00-00","ARS614","Jacinto Tchipa","","Filomeno Franco Carieji","2021-09-03 00:00:00","activo","2021-09-03");
INSERT INTO alunos VALUES("1030","Cristina Regina Agostinho Fernando","Masculino","Romão Diogo Fernandes","Tânia Carlos Agostinho","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921360366/924180197","921360366/924180197","","","0","2016-05-29","0000-00-00","ARS519","Sapú II","","Romão Diogo Fernandes","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("1031","Daniela Larissa Gonga Anibal","Masculino","Emanuel de Castro Anibal","Fernanda Mussungo G. Anibal ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923877287/923027550","923877287/923027550","","","0","2016-06-09","0000-00-00","ARS378","Bita Vacaria","","Emanuel de Castro Anibal","2021-08-16 00:00:00","activo","2021-08-16");
INSERT INTO alunos VALUES("1032","Dorivaldo Mizael M. Da Silva","Masculino","Guilherme da Silva","Esmeralda Augusta T. Mulihulo ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","914718679/929588736","914718679/929588736","","","0","2016-11-08","0000-00-00","ARS610","Jacinto Tchipa","","Guilherme da Silva","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("1033","Emiliano João da Silva Queta ","Masculino","João Alberto Queta ","Vanda Patricia L. Queta","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","934317717","934317717","","","0","2016-05-06","0000-00-00","ARS340","Jacinto Tchipa","","João Alberto Queta ","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("1034","Esmael Luis Botelho","Masculino","Estanislau F. G. Botelho","Aida Mateus Luis ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","997570292","997570292","","","0","2016-02-18","0000-00-00","ARS7","Jacinto Tchipa","","Estanislau F. G. Botelho","2022-01-20 00:00:00","activo","");
INSERT INTO alunos VALUES("1035","Evandra Suzana Kaponzo Lino","Masculino","Jorge António Lino","Hillary Suzana Júlio Kaponzo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924371235","924371235","","","0","2016-08-02","0000-00-00","ARS770","Bita Vacaria","","Jorge António Lino","2021-09-07 00:00:00","activo","2021-09-07");
INSERT INTO alunos VALUES("1036","Gabriel Breganha Quibato","Masculino","Manuel Fabião Quibato","Luzia Kimbundo Simão Breganha","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923552160/944996623","923552160/944996623","","","0","2016-04-26","0000-00-00","ARS267","Jacinto Tchipa","","Manuel Fabião Quibato","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("1037","Gabriel Tchamolowingue Nambelo","Masculino","Agostinho Domingos Nambalo","Paulina C. S. Tchamolowingue","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923953121","923953121","","","0","2016-06-19","0000-00-00","ARS599","Bita Vacaria","","Agostinho Domingos Nambalo","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("1038","Gabriel Valentim Paulo","Masculino","Manuel António Paulo","Deolinda Bartolomeu Valentim","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923520642/924494230","923520642/924494230","","","0","0000-00-00","0000-00-00","ARS473","Belo Horizonte","","Manuel António Paulo","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("1039","Gilmário Pedro Chilombo","Masculino","José Mário Chilombo","Maria Guida Dala J. Pedro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","949618422/991307213","949618422/991307213","","","0","2016-08-22","0000-00-00","ARS517","Jacinto Tchipa","","José Mário Chilombo","2021-08-30 00:00:00","activo","2021-08-30");
INSERT INTO alunos VALUES("1040","Helena Manuel Pedro","Masculino","Gaspar Neto Pedro","Rita Adão Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923059591","923059591","","","0","2016-10-20","0000-00-00","ARS145","Jacinto Tchipa","","Gaspar Neto Pedro","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("1041","Joaquina Mbayeta Nambalo","Masculino","..............","Jorgina Jamba Nambalo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","2016-11-16","0000-00-00","ARS598","Jacinto Tchipa","","..............","2021-09-01 00:00:00","activo","2021-09-01");
INSERT INTO alunos VALUES("1042","Josefa Maza Moises","Masculino","Mário Dias Moisés","Marta Raquel Maza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","931831562/927989658","931831562/927989658","","","0","2016-01-31","0000-00-00","ARS326","Bita Vacaria","","Mário Dias Moisés","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("1043","Jovita Antónia Sebastiao","Masculino","Lutumba K. Sebastião ","Domiana B. Antonio","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924996814/924996814","924996814/924996814","","","0","2017-07-09","0000-00-00","ARS1019","Jacinto Tchipa","","Lutumba K. Sebastião ","2021-10-06 00:00:00","activo","2021-10-06");
INSERT INTO alunos VALUES("1044","Lituánia Laurinda Domingos Albino","Masculino","António Manuel Albino","Cristina Margarida Domingos","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926560157/923248886","926560157/923248886","","","0","2016-04-24","0000-00-00","ARS329","Sapú II","","António Manuel Albino","2021-08-14 00:00:00","activo","2021-08-14");
INSERT INTO alunos VALUES("1045","Luciane Samara Caquianda Matias","Masculino","Osvaldo Domingos Matias","Joanada Conceição C. Matias","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924220137/942389111","924220137/942389111","","","0","2016-08-16","0000-00-00","ARS148","Auto Pechicha","","Osvaldo Domingos Matias","2021-08-02 00:00:00","activo","2021-08-02");
INSERT INTO alunos VALUES("1046","Mackela da Maquiesse L. Adão","Masculino","Tomás Domingos Adão","Medina Francisco Loureiro","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923032836","923032836","","","0","2016-12-14","0000-00-00","ARS1032","Belo Horizonte","","Tomás Domingos Adão","2021-10-15 00:00:00","activo","2021-10-15");
INSERT INTO alunos VALUES("1047","Manuel Armando dos Santos","Masculino","Manuel dos Santos","Dety Teresa José Armando","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923498867","923498867","","","0","2015-09-06","0000-00-00","ARS391","Jacinto Tchipa","","Manuel dos Santos","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("1048","Nelson Augusto Francisco Lourenço","Masculino","Augusto João Lourenço","Leonilda Simão Francisco","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923551574/932602342","923551574/932602342","","","0","2016-02-01","0000-00-00","ARS317","Jacinto Tchipa","","Augusto João Lourenço","2021-08-13 00:00:00","activo","2021-08-13");
INSERT INTO alunos VALUES("1049","Nixana Memória Correia Ndumba","Masculino","..............................","Judith Eduardo Correia N. Ndumba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928154612","928154612","","","0","2016-05-27","0000-00-00","ARS393","Jacinto Tchipa","","..............................","2021-08-18 00:00:00","activo","2021-08-18");
INSERT INTO alunos VALUES("1050","Samuel Mateus António de Oliveira","Masculino","Paiva Mateus de Oliveira","Clotilde Laurinda Panzo António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923322098","923322098","","","0","2016-01-14","0000-00-00","ARS282","Jacinto Tchipa","","Paiva Mateus de Oliveira","2021-08-10 00:00:00","activo","2021-08-10");
INSERT INTO alunos VALUES("1051","Sandra António J. Lundange","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS510","","","","2021-08-27 00:00:00","activo","2021-08-27");
INSERT INTO alunos VALUES("1052","Telma Catarina Tulante António ","Masculino","Miala António","Tulante Tukala Ana","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","933515041","933515041","","","0","2016-01-31","0000-00-00","ARS351","Sapú II","","Miala António","2021-08-12 00:00:00","activo","2021-08-12");
INSERT INTO alunos VALUES("1053","Weza Ezequiel Paim Mavacala","Masculino","Don Sebastião A. Mavacala","Ana José Paim","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","929205369/929205364","929205369/929205364","","","0","2021-09-02","0000-00-00","ARS626","Jacinto Tchipa","","Don Sebastião A. Mavacala","2021-09-02 00:00:00","activo","2021-09-02");
INSERT INTO alunos VALUES("1054","Romeu Oficial Correia ","Masculino","Julião Miguel Correia","Marisa Famorosa Oficial","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926288750","","","","0","2005-05-09","0000-00-00","ARS1","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","");
INSERT INTO alunos VALUES("1055","Eugénio da Graça Vieira","Masculino","Daniel Jamba Vieira","Domingas C. Vieira","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","921781940","","","","0","2007-06-16","0000-00-00","ARS1011","Sapú II","","","2022-03-17 12:52:10","activo","2021-10-07");
INSERT INTO alunos VALUES("1056","Videira Chipembe Torres","Masculino","Nelson Videira","Inês Chipembe","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925609017/941389790","","","","0","2006-04-15","0000-00-00","ARS102","Bita Vacaria","","","2022-03-17 12:52:10","activo","2021-07-28");
INSERT INTO alunos VALUES("1057","Samuel André Feliciano Kuluca","Masculino","Lucombo André Kuluca","Graça Isabel Feliciano","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","916567453/995358389","","","","0","2006-12-28","0000-00-00","ARS110","Bita Vacaria","","","2022-03-17 12:52:10","activo","2021-07-29");
INSERT INTO alunos VALUES("1058","João Carlos Manuel António","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS118","","","","2022-03-17 12:52:10","activo","2021-07-29");
INSERT INTO alunos VALUES("1059","Eliane da Conceição D. Mangueira","Femenino","António da Fonseca Mangueira","Romana Domingos Diogo","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924108006/945573363","","","","0","2006-03-22","0000-00-00","ARS163","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-08-03");
INSERT INTO alunos VALUES("1060","Vladimiro Quimbango Manuel","Masculino","Natalicio Adão José Manuel","Marcelina da Conceição Q. Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923660339/0916223512","","","","0","2007-06-28","0000-00-00","ARS196","Bita Vacaria","","","2022-03-17 12:52:10","activo","2021-08-05");
INSERT INTO alunos VALUES("1061","Karina Rosa Gouveia Catomba","Femenino","Tomé Chinguli Catomba","Inês Bernardo Feliciano Gouveia","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922626879/930695254","","","","0","2007-02-07","0000-00-00","ARS202","Sapú II","","","2022-03-17 12:52:10","activo","2021-08-09");
INSERT INTO alunos VALUES("1062","Alice Pedro Quitiquila","Femenino","Gomes Ferraz Quitiquila","Teresa Pedro Carimba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936670088/944235274","","","","0","2007-03-25","0000-00-00","ARS220","Sapú II","","","2022-03-17 12:52:10","activo","2021-08-06");
INSERT INTO alunos VALUES("1063","Lucinda Cachinga José Kalunga","Femenino","Fernando Ribeiro Kalunga","Conceição Manuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925998365","","","","0","2005-07-11","0000-00-00","ARS224","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-08-06");
INSERT INTO alunos VALUES("1064","Germana Tchississo E. Silveiro","Femenino","António Alfredo Silveiro","Rufina Kutala Estevão","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925154406","","","","0","2005-05-02","0000-00-00","ARS225","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-08-06");
INSERT INTO alunos VALUES("1065","Hélio Catarino António","Masculino","Francisco Manuel António","Antonica Henriques","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","932805227","","","","0","2006-04-02","0000-00-00","ARS265","Estalagem","","","2022-03-17 12:52:10","activo","2021-08-10");
INSERT INTO alunos VALUES("1066","Adriana Eduana Abel","Femenino",".......................","Gertrudes Maria da C. Abel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923324345","","","","0","2006-08-28","0000-00-00","ARS275","Belo Horizonte","","","2022-03-17 12:52:10","activo","2021-08-10");
INSERT INTO alunos VALUES("1067","Rosalina Paula António de Oliveira","Femenino","Paiva Mateus de Oliveira","Clotilde Laurinda Panzo António","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923322098","","","","0","2006-06-21","0000-00-00","ARS281","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-08-10");
INSERT INTO alunos VALUES("1068","Luzia Josefa Lutunga Ngola","Femenino","Kazete José Luango Ngola","Evita Samuel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923852403/926789552","","","","0","2007-12-07","0000-00-00","ARS296","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-08-13");
INSERT INTO alunos VALUES("1069","Gloria João Alfredo","Femenino","João Alfredo Xamungole","Domingas Ngunza","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","925451723/931080805","","","","0","2004-11-14","0000-00-00","ARS334","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-08-12");
INSERT INTO alunos VALUES("1070","Etelvina da Conceição José","Femenino","Belmiro José L. Félix","Maria da Conceição R. Domingos ","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","935887277/928630097","","","","0","2007-03-30","0000-00-00","ARS372","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-08-17");
INSERT INTO alunos VALUES("1071","Hilária Cassequel Alexandre","Femenino","António Ferreira Alexandre","Conceição Domingos C. Alexandre","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924206207/924206208","","","","0","2007-05-06","0000-00-00","ARS380","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-07-16");
INSERT INTO alunos VALUES("1072","Esmenia E. Cabinga Francisco","Femenino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS401","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-08-18");
INSERT INTO alunos VALUES("1073","Teresa Manuel Francisco ","Femenino","Vladimiro António Ribas Francisco","Zenilda Manuel Marcolino","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","990523795/923523795","","","","0","2007-06-01","0000-00-00","ARS430","Bita Vacaria","","","2022-03-17 12:52:10","activo","2021-08-20");
INSERT INTO alunos VALUES("1074","Palmira de Oliveira Gomes ","Femenino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS451","","","","2022-03-17 12:52:10","activo","2021-08-24");
INSERT INTO alunos VALUES("1075","Formosa Saudade dos Santos","Femenino","José Augusto Perreira dos Santos","Júlia Agostinho Saudade","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","928201402/932536872","","","","0","2004-06-11","0000-00-00","ARS463","Bita Vacaria","","","2022-03-17 12:52:10","activo","2021-08-25");
INSERT INTO alunos VALUES("1076","Lelécia Miguel Sebastião","Femenino","António Sebastião João","Domingas Salvador Miguel","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","924190215/990190215","","","","0","2006-11-30","0000-00-00","ARS480","Sapú II","","","2022-03-17 12:52:10","activo","2021-08-27");
INSERT INTO alunos VALUES("1077","Elias Joaquim Tintas ","Masculino","Joaquim Caetano Tinta","..........................","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","943811480","","","","0","2004-12-12","0000-00-00","ARS50","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","");
INSERT INTO alunos VALUES("1078","Elisabeth Capemba Boavida","Femenino","Carlos Pinto Boavida","Engracia Zage Capemba","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","927824076/923961779","","","","0","2008-04-04","0000-00-00","ARS575","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-08-31");
INSERT INTO alunos VALUES("1079","Hélio Lourenço Neves","Masculino","José Neves","Nazaré Nhanga Lourenço","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","923334492/942006639","","","","0","2007-08-12","0000-00-00","ARS591","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-09-01");
INSERT INTO alunos VALUES("1080","Ana da Rocha Costa","Femenino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS676","","","","2022-03-17 12:52:10","activo","2021-09-03");
INSERT INTO alunos VALUES("1081","Deolice Flora Vieira Nsambo","Femenino","André M. Nsambo","Alice Vieira Sebastião","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922118622/994100084","","","","0","2006-08-22","0000-00-00","ARS728","Sapú II","","","2022-03-17 12:52:10","activo","2021-09-06");
INSERT INTO alunos VALUES("1082","Delcio João Alexandre Cassinda","Masculino","Manuel António M. Cassinda","Maria Amélia Alexandre","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","926246027","","","","0","2004-03-27","0000-00-00","ARS807","","","","2022-03-17 12:52:10","activo","2021-09-07");
INSERT INTO alunos VALUES("1083","Nayara Fernandes Gouveia","Masculino","Antonio Pascual P. Silva","Nazaré de Fatima da Silva","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","936777716","","","","0","2006-05-09","0000-00-00","ARS849","Jacinto Tchipa","","","2022-03-17 12:52:10","activo","2021-09-13");
INSERT INTO alunos VALUES("1084","Evandro Carlos Pedro","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS959","","","","2022-03-17 12:52:10","activo","2021-08-30");
INSERT INTO alunos VALUES("1085","Desir Isabel Fernando António","Femenino","João António","Augusta Manjilo V. Fernando","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","922671209/912647073","","","","0","2007-06-28","0000-00-00","ARS98","Sapú II","","","2022-03-17 12:52:10","activo","2021-07-27");
INSERT INTO alunos VALUES("1086","Jefte Rodrigues Lourenço","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1079","","","","2022-03-17 12:52:10","activo","2021-11-23");
INSERT INTO alunos VALUES("1087","Bengui L. Baptista","Masculino","","","Luanda","Angolana","Luanda","","Luanda","Nenhuma","","","","","","0","0000-00-00","0000-00-00","ARS1086","","","","2022-03-17 12:52:10","activo","2021-12-16");



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
  `precodafalta` double NOT NULL DEFAULT '0',
  `precodareconfirmacao` double NOT NULL DEFAULT '0',
  `datainicio` date NOT NULL DEFAULT '2021-08-01',
  `datafim` date NOT NULL DEFAULT '2022-06-01',
  `datafimexame` date NOT NULL DEFAULT '2022-07-01',
  `diadamulta` int(2) NOT NULL DEFAULT '15',
  `precodamulta` double NOT NULL DEFAULT '0',
  `salarioportempo` double NOT NULL DEFAULT '0',
  `salarioportempoauxiliar` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idanolectivo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO anoslectivos VALUES("1","2020","Não","1","CAP","0.4","CPE","NER","CF","0","0","0","2020-02-01","2020-11-01","2020-12-01","15","0","0","0");
INSERT INTO anoslectivos VALUES("2","2021/2022","Sim","2","CAP","0.4","CPE","NER","CF","0","500","3000","2021-08-01","2022-06-01","2022-07-01","15","2300","450","340");
INSERT INTO anoslectivos VALUES("3","2019","Não","0","CAP","0.4","CPE","NER","CF","0","0","0","2021-08-01","2022-06-01","2022-07-01","15","0","0","0");



DROP TABLE IF EXISTS avaliacoes;

CREATE TABLE `avaliacoes` (
  `idavaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `iddisciplina` int(11) NOT NULL,
  `titulo` varchar(220) NOT NULL DEFAULT 'Avaliação Contínua',
  `data` date NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `notavinculada` int(11) NOT NULL DEFAULT '0',
  `idturma` int(11) NOT NULL,
  PRIMARY KEY (`idavaliacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS cadeirasdeixadas;

CREATE TABLE `cadeirasdeixadas` (
  `idcadeiradeixada` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT '0',
  `data` date DEFAULT NULL,
  PRIMARY KEY (`idcadeiradeixada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS ciclos;

CREATE TABLE `ciclos` (
  `idciclo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(222) NOT NULL,
  PRIMARY KEY (`idciclo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ciclos VALUES("1","Ensino Primário");
INSERT INTO ciclos VALUES("2","1º Ciclo");
INSERT INTO ciclos VALUES("3","2º Ciclo");



DROP TABLE IF EXISTS classes;

CREATE TABLE `classes` (
  `idclasse` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  `idciclo` int(11) NOT NULL,
  PRIMARY KEY (`idclasse`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO classes VALUES("1","1ª","1");
INSERT INTO classes VALUES("2","2ª","1");
INSERT INTO classes VALUES("3","3ª","1");
INSERT INTO classes VALUES("4","4ª","1");
INSERT INTO classes VALUES("5","5ª","1");
INSERT INTO classes VALUES("6","6ª","1");
INSERT INTO classes VALUES("7","7ª","2");
INSERT INTO classes VALUES("8","8ª","2");
INSERT INTO classes VALUES("9","9ª","2");
INSERT INTO classes VALUES("10","10ª","3");
INSERT INTO classes VALUES("11","11ª","3");
INSERT INTO classes VALUES("12","12ª","3");
INSERT INTO classes VALUES("13","Pré","1");



DROP TABLE IF EXISTS compra;

CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) DEFAULT NULL,
  `idaluno` int(11) DEFAULT NULL,
  `idanolectivo` int(11) NOT NULL DEFAULT '2',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;




DROP TABLE IF EXISTS compras;

CREATE TABLE `compras` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) DEFAULT NULL,
  `obs` varchar(100) COLLATE utf8_roman_ci DEFAULT '',
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idfuncionario` int(11) NOT NULL,
  `idatendimento` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcompra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;




DROP TABLE IF EXISTS cursos;

CREATE TABLE `cursos` (
  `idcurso` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO cursos VALUES("1","Nenhum");
INSERT INTO cursos VALUES("2","Ciências Físicas e Biológicas");
INSERT INTO cursos VALUES("3","Ciências Econômicas e Jurídicas");



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

INSERT INTO dadosdaempresa VALUES("1","Complexo Escolar Arena do Saber","Ensino Primário, Iº e IIº Ciclo e Ensino Secundário","","BIC: 0051.0000.0591.9169.1014.2","","Viana - Luanda, Angola","923848537","","Bairro Jacinto Tchipa, Ciquentinha, Por detrás das roloutes","Augusto Tuta Nguvo");



DROP TABLE IF EXISTS descadastrados;

CREATE TABLE `descadastrados` (
  `iddescadastrado` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL DEFAULT 'Inactivo',
  `descricao` text,
  `data` date NOT NULL,
  PRIMARY KEY (`iddescadastrado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




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
  `estatus` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`iddisciplina`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO disciplinas VALUES("1","1","0","1","Matemática","MAT","34","2","Normal","Formação Geral","obs","1");



DROP TABLE IF EXISTS documentostratados;

CREATE TABLE `documentostratados` (
  `iddocumentotratado` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL DEFAULT '2',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO entradas VALUES("2","31","Controlo","Outras","0","0","0","","0","","2021-11-01 00:00:00","2");



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




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
INSERT INTO funcionarios VALUES("31","Esmael Calunga","0000-00-00","Família","92924444","","","","","","0000-00-00","65000","2021-02-28 14:03:05","290","22","8","activo");
INSERT INTO funcionarios VALUES("32","Daniel Pablo ","0000-00-00","respiratórias","927999178 ","Viana","","","Ensino medio","   AO 43643746432253 ; BAI: AO 347348263448","0000-00-00","120000","2021-03-01 13:38:48","682","22","8","activo");
INSERT INTO funcionarios VALUES("33","Pedro Salvador","0000-00-00","","","","","","","","0000-00-00","120000","2021-03-01 13:39:45","667","22","8","activo");
INSERT INTO funcionarios VALUES("34","Simão Baptista Pedro ","0000-00-00","Gestor","92924444","vila alice","","","Ensino medio","  AO 43643746432253 ; BAI: AO 347348263448","2021-03-01","150000","2021-03-01 19:22:26","1136","22","8","activo");
INSERT INTO funcionarios VALUES("37","Sergio Donaires Adão","0000-00-00","Família"," 92924444"," vila alice","",""," Ensino medio","   AO 43643746432253 ; BAI: AO 347348263448","2021-02-26","120000","2021-03-03 06:07:52","682","22","8","activo");
INSERT INTO funcionarios VALUES("39","Marcelina Francisco ","0000-00-00","Cuzinheira","92924444","Estalagem","Luanda","FAPLA","Ensino Superior","  AO 43643746432253 ; BAI: AO 347348263448","2021-03-21","52000","2020-03-22 10:01:28","241","27","8","inactivo");
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO historico VALUES("1","31","Eliminação","Todos  os dados de(Registro de Propina de 11/2021) | Valor: 4.000,00 KZ | Por Consolidar 0 KZ | <a href=entradapropina.php?identrada=1>Clique para ver</a>","Eliminado","2022-03-25 16:40:01");
INSERT INTO historico VALUES("2","31","Eliminação","Eliminado o pagamento de propinas do aluno  <a href=aluno.php?idaluno=990>Abel Nicolau Marcos </a> do mês de 011/2021","Eliminado","2022-03-25 16:40:01");



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




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
  `descontoparapropinas` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmatriculaeconfirmacao`)
) ENGINE=InnoDB AUTO_INCREMENT=1156 DEFAULT CHARSET=utf8;

INSERT INTO matriculaseconfirmacoes VALUES("1","1","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("2","2","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("3","3","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("4","4","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("5","5","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("6","6","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("7","7","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("8","8","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("9","9","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("10","10","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-07-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("11","11","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("12","12","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("13","13","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("14","14","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("15","15","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("16","16","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("17","17","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("18","18","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("19","19","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("20","20","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("21","21","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("22","22","Normal","2","34","Confirmação","1000","0","0","12CFB","9","Ciências Físicas e Biológicas","Tarde","12ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("23","23","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("24","24","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("25","25","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-09-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("26","26","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("27","27","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("28","28","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("29","29","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("30","30","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("31","31","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("32","32","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("33","33","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("34","34","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-10-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("35","35","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("36","36","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("37","37","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("38","38","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-10-22","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("39","39","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("40","40","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-10-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("41","41","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-09-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("42","42","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("43","43","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("44","44","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-08-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("45","45","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("46","46","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("47","47","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("48","48","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("49","49","Normal","2","31","Confirmação","1000","0","0","12CEJ","9","Ciências Econômicas e Jurídicas","Tarde","12ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("50","50","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("51","51","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-11-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("52","52","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("53","53","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("54","54","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("55","55","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-09-22","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("56","56","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("57","57","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-07-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("58","58","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-11-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("59","59","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-10-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("60","60","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-07-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("61","61","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("62","62","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("63","63","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-10-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("64","64","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("65","65","Normal","2","33","Confirmação","1000","0","0","11CFB","9","Ciências Físicas e Biológicas","Tarde","11ª","2021-07-21","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("66","66","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("67","67","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("68","68","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("69","69","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("70","70","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("71","71","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("72","72","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-10-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("73","73","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("74","74","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("75","75","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("76","76","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("77","77","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("78","78","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-10-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("79","79","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("80","80","Normal","2","30","Confirmação","1000","0","0","11CEJ","9","Ciências Econômicas e Jurídicas","Tarde","11ª","2021-11-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("81","81","Normal","2","32","Confirmação","1000","0","0","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","2021-11-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("82","82","Normal","2","32","Confirmação","1000","0","0","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("83","83","Normal","2","32","Confirmação","1000","0","0","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("84","84","Normal","2","32","Confirmação","1000","0","0","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","2021-12-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("85","85","Normal","2","32","Confirmação","1000","0","0","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","2021-10-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("86","86","Normal","2","32","Confirmação","1000","0","0","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("87","87","Normal","2","32","Confirmação","1000","0","0","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("88","88","Normal","2","32","Confirmação","1000","0","0","10CFB","4","Ciências Físicas e Biológicas","Tarde","10ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("89","89","Normal","2","28","Confirmação","1000","0","0","10CEJ","9","Ciências Econômicas e Jurídicas","Tarde","10ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("90","90","Normal","2","28","Confirmação","1000","0","0","10CEJ","9","Ciências Econômicas e Jurídicas","Tarde","10ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("91","91","Normal","2","28","Confirmação","1000","0","0","10CEJ","9","Ciências Econômicas e Jurídicas","Tarde","10ª","2021-10-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("92","92","Normal","2","28","Confirmação","1000","0","0","10CEJ","9","Ciências Econômicas e Jurídicas","Tarde","10ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("93","93","Normal","2","28","Confirmação","1000","0","0","10CEJ","9","Ciências Econômicas e Jurídicas","Tarde","10ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("94","94","Normal","2","28","Confirmação","1000","0","0","10CEJ","9","Ciências Econômicas e Jurídicas","Tarde","10ª","2021-11-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("95","95","Normal","2","28","Confirmação","1000","0","0","10CEJ","9","Ciências Econômicas e Jurídicas","Tarde","10ª","2021-10-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("96","96","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-10-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("97","97","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("98","98","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-10-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("99","99","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("100","100","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("101","101","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("102","102","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("103","103","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("104","104","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("105","105","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("106","106","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("107","107","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-24","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("108","108","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("109","109","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("110","110","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("111","111","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("112","112","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("113","113","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("114","114","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("115","115","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("116","116","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("117","117","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("118","118","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("119","119","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("120","120","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("121","121","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("122","122","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("123","123","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("124","124","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("125","125","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-08-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("126","126","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-11-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("127","127","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-09-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("128","128","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-11-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("129","129","Normal","2","24","Confirmação","1000","0","0","9C","9","Nenhum","Tarde","9ª","2021-11-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("130","130","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("131","131","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-10-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("132","132","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-10-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("133","133","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("134","134","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("135","135","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("136","136","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("137","137","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("138","138","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("139","139","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("140","140","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("141","141","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("142","142","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("143","143","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("144","144","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("145","145","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("146","146","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("147","147","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("148","148","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("149","149","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("150","150","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("151","151","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("152","152","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("153","153","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("154","154","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("155","155","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-07-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("156","156","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("157","157","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("158","158","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("159","159","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("160","160","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("161","161","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("162","162","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-09-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("163","163","Normal","2","23","Confirmação","1000","0","0","9B","9","Nenhum","Tarde","9ª","2021-08-01","","activo","2021-11-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("198","198","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-10-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("199","199","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-10-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("200","200","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-10-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("201","201","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-10-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("202","202","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-10-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("203","203","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-10-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("204","204","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-10-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("205","205","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("206","206","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("207","207","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("208","208","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("209","209","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("210","210","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("211","211","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("212","212","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("213","213","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("214","214","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("215","215","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("216","216","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("217","217","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("218","218","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("219","219","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("220","220","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("221","221","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("222","222","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("223","223","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("224","224","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("225","225","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("226","226","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("227","227","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("228","228","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("229","229","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("230","230","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("231","231","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("232","232","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("233","233","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("234","234","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("235","235","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("236","236","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("237","237","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("238","238","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("239","239","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("240","240","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("241","241","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("242","242","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-11-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("243","243","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-11-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("244","244","Normal","2","21","Confirmação","1000","0","0","8C","9","Nenhum","Tarde","8ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("245","245","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("246","246","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-10-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("247","247","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-10-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("248","248","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("249","249","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("250","250","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("251","251","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("252","252","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("253","253","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("254","254","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("255","255","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-12","","activo","2021-11-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("256","256","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("257","257","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("258","258","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("259","259","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("260","260","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("261","261","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("262","262","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("263","263","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-24","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("264","264","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-25","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("265","265","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("266","266","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("267","267","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("268","268","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("269","269","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("270","270","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("271","271","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("272","272","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("273","273","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("274","274","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("275","275","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-09-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("276","276","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("277","277","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("278","278","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("279","279","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("280","280","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("281","281","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("282","282","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-10-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("283","283","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("284","284","Normal","2","20","Confirmação","1000","0","0","8B","9","Nenhum","Tarde","8ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("285","285","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-10-11","","activo","2021-11-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("286","286","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-10-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("287","287","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-10-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("288","288","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("289","289","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("290","290","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("291","291","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("292","292","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("293","293","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("294","294","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("295","295","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("296","296","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("297","297","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("298","298","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("299","299","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("300","300","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("301","301","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("302","302","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("303","303","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("304","304","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("305","305","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("306","306","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("307","307","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-25","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("308","308","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("309","309","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("310","310","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("311","311","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("312","312","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("313","313","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-07-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("314","314","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("315","315","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-07-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("316","316","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("317","317","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("318","318","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("319","319","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("320","320","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("321","321","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("322","322","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("323","323","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("324","324","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-07-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("325","325","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("326","326","Normal","2","19","Confirmação","1000","0","0","8A","9","Nenhum","Tarde","8ª","2021-11-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("327","327","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("328","328","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-10-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("329","329","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-10-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("330","330","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("331","331","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("332","332","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("333","333","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("334","334","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("335","335","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("336","336","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("337","337","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("338","338","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-24","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("339","339","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("340","340","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("341","341","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("342","342","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("343","343","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("344","344","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("345","345","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("346","346","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("347","347","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("348","348","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("349","349","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("350","350","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("351","351","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("352","352","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("353","353","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("354","354","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("355","355","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("356","356","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-11-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("357","357","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("358","358","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("359","359","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("360","360","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-09-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("361","361","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("362","362","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-10-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("363","363","Normal","2","18","Confirmação","1000","0","0","7C","9","Nenhum","Tarde","7ª","2021-11-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("364","364","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("365","365","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("366","366","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("367","367","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("368","368","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("369","369","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("370","370","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("371","371","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("372","372","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("373","373","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("374","374","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-24","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("375","375","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("376","376","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("377","377","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("378","378","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("379","379","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("380","380","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("381","381","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("382","382","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("383","383","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("384","384","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("385","385","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("386","386","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("387","387","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("388","388","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("389","389","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("390","390","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("391","391","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("392","392","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("393","393","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("394","394","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("395","395","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-10-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("396","396","Normal","2","17","Confirmação","1000","0","0","7B","9","Nenhum","Tarde","7ª","2021-11-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("397","397","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-07-28","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("398","398","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("399","399","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("400","400","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("401","401","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("402","402","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("403","403","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("404","404","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("405","405","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("406","406","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("407","407","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("408","408","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("409","409","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("410","410","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("411","411","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("412","412","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("413","413","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("414","414","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("415","415","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("416","416","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("417","417","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("418","418","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("419","419","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("420","420","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("421","421","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("422","422","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("423","423","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("424","424","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("425","425","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("426","426","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("427","427","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-07-21","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("428","428","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-07-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("429","429","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("430","430","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-09-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("431","431","Normal","2","16","Confirmação","1000","0","0","7A","9","Nenhum","Tarde","7ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("432","432","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("433","433","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("434","434","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-09-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("435","435","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-10-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("436","436","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("437","437","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("438","438","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("439","439","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("440","440","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("441","441","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-11-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("442","442","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-11-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("443","443","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("444","444","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("445","445","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("446","446","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("447","447","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("448","448","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("449","449","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("450","450","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("451","451","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("452","452","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("453","453","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("454","454","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("455","455","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-09-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("456","456","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("457","457","Normal","2","15","Confirmação","1000","0","0","6C","8","Nenhum","Manhã","6ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("458","458","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-23","","activo","2022-12-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("459","459","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("460","460","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("461","461","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("462","462","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("463","463","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("464","464","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("465","465","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("466","466","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("467","467","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("468","468","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-07-22","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("469","469","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("470","470","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("471","471","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("472","472","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("473","473","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("474","474","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("475","475","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("476","476","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("477","477","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("478","478","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("479","479","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("480","480","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-11-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("481","481","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("482","482","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("483","483","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("484","484","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("485","485","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("486","486","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("487","487","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("488","488","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("489","489","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("490","490","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("491","491","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("492","492","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("493","493","Normal","2","14","Confirmação","1000","0","0","6B","12","Nenhum","Manhã","6ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("494","494","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("495","495","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("496","496","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("497","497","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("498","498","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("499","499","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("500","500","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("501","501","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("502","502","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("503","503","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("504","504","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-07-22","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("505","505","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("506","506","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("507","507","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("508","508","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("509","509","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("510","510","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("511","511","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("512","512","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("513","513","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("514","514","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("515","515","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("516","516","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-11-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("517","517","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("518","518","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("519","519","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("520","520","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("521","521","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("522","522","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("523","523","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("524","524","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("525","525","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("526","526","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("527","527","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("528","528","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("529","529","Normal","2","13","Confirmação","1000","0","0","6A","11","Nenhum","Manhã","6ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("530","530","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-10-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("531","531","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("532","532","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("533","533","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("534","534","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-10-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("535","535","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("536","536","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("537","537","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("538","538","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("539","539","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("540","540","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("541","541","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("542","542","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("543","543","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("544","544","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("545","545","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("546","546","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("547","547","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("548","548","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("549","549","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("550","550","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-25","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("551","551","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-07-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("552","552","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-10-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("553","553","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("554","554","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("555","555","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("556","556","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("557","557","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-10-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("558","558","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-09-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("559","559","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("560","560","Normal","2","12","Confirmação","1000","0","0","5C","2","Nenhum","Manhã","5ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("561","561","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("562","562","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("563","563","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("564","564","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("565","565","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-07-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("566","566","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-07-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("567","567","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("568","568","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("569","569","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("570","570","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-07-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("571","571","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("572","572","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("573","573","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("574","574","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("575","575","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("576","576","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("577","577","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("578","578","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("579","579","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("580","580","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("581","581","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("582","582","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("583","583","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("584","584","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("585","585","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-25","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("586","586","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("587","587","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("588","588","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-11-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("589","589","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("590","590","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("591","591","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("592","592","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("593","593","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("594","594","Normal","2","11","Confirmação","1000","0","0","5B","11","Nenhum","Manhã","5ª","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("595","595","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("596","596","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("597","597","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("598","598","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("599","599","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("600","600","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("601","601","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("602","602","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("603","603","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("604","604","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-07-28","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("605","605","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("606","606","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("607","607","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("608","608","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("609","609","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("610","610","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("611","611","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("612","612","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("613","613","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-24","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("614","614","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("615","615","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("616","616","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("617","617","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("618","618","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("619","619","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("620","620","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("621","621","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("622","622","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("623","623","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("624","624","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("625","625","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("626","626","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("627","627","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-24","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("628","628","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("629","629","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-07-21","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("630","630","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("631","631","Normal","2","10","Confirmação","1000","0","0","5A","6","Nenhum","Manhã","5ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("632","632","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-11-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("633","633","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("634","634","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("635","635","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("636","636","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-10-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("637","637","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("638","638","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("639","639","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("640","640","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("641","641","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-11-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("642","642","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("643","643","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("644","644","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("645","645","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-10-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("646","646","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("647","647","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("648","648","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("649","649","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("650","650","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("651","651","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("652","652","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("653","653","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("654","654","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("655","655","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("656","656","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("657","657","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("658","658","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("659","659","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("660","660","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-11-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("661","661","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-10-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("662","662","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("663","663","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("664","664","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("665","665","Normal","2","9","Confirmação","1000","0","0","4C","11","Nenhum","Manhã","4ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("734","666","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("735","667","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("736","668","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("737","669","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("738","670","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("739","671","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-25","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("740","672","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("741","673","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("742","674","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("743","675","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("744","676","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("745","677","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("746","678","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("747","679","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("748","680","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("749","681","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("750","682","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("751","683","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("752","684","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("753","685","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("754","686","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("755","687","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("756","688","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("757","689","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("758","690","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("759","691","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("760","692","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("761","693","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("762","694","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-24","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("763","695","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("764","696","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("765","697","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("766","698","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("767","699","Normal","2","8","Confirmação","1000","0","0","4B","1","Nenhum","Manhã","4ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("768","700","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("769","701","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("770","702","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("771","703","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("772","704","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("773","705","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("774","706","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("775","707","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("776","708","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("777","709","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("778","710","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("779","711","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("780","712","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("781","713","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("782","714","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-10-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("783","715","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("784","716","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("785","717","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("786","718","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("787","719","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("788","720","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("789","721","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("790","722","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("791","723","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("792","724","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("793","725","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("794","726","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("795","727","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("796","728","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-07-28","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("797","729","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("798","730","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-07-22","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("799","731","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("800","732","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("801","733","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("802","734","Normal","2","7","Confirmação","1000","0","0","4A","2","Nenhum","Manhã","4ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("803","735","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-14","","activo","2022-02-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("804","736","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("805","737","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("806","738","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("807","739","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("808","740","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("809","741","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("810","742","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-11-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("811","743","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("812","744","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-07-28","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("813","745","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("814","746","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("815","747","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("816","748","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("817","749","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("818","750","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("819","751","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("820","752","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("821","753","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("822","754","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-07-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("823","755","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-11-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("824","756","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("825","757","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("826","758","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("827","759","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("828","760","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("829","761","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("830","762","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("831","763","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("832","764","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("833","765","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("834","766","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("835","767","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-11-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("836","768","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("837","769","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-07-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("838","770","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("839","771","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("840","772","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("841","773","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("842","774","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("843","775","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("844","776","Normal","2","6","Confirmação","1000","0","0","3B","1","Nenhum","Manhã","3ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("845","777","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("846","778","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("847","779","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("848","780","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("849","781","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("850","782","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("851","783","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("852","784","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("853","785","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("854","786","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("855","787","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("856","788","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("857","789","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("858","790","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("859","791","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("860","792","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("861","793","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("862","794","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("863","795","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("864","796","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("865","797","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("866","798","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("867","799","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("868","800","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("869","801","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("870","802","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("871","803","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("872","804","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("873","805","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("874","806","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("875","807","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-25","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("876","808","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("877","809","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("878","810","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("879","811","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("880","812","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("881","813","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-10-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("882","814","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("883","815","Normal","2","5","Confirmação","1000","0","0","3A","2","Nenhum","Manhã","3ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("884","816","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("885","817","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("886","818","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("887","819","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("888","820","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-11-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("889","821","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("890","822","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("891","823","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("892","824","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("893","825","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("894","826","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("895","827","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("896","828","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("897","829","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("898","830","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("899","831","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("900","832","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("901","833","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("902","834","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("903","835","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("904","836","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-17","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("905","837","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("906","838","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("907","839","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("908","840","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("909","841","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("910","842","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-10-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("911","843","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("912","844","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("913","845","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("914","846","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("915","847","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("916","848","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("917","849","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("918","850","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-10-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("919","851","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("920","852","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("921","853","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("922","854","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("923","855","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("924","856","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("925","857","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("926","858","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("927","859","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("928","860","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("929","861","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("930","862","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("931","863","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("932","864","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("933","865","Normal","2","4","Confirmação","1000","0","0","2B","2","Nenhum","Manhã","2ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("934","866","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("935","867","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("936","868","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("937","869","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("938","870","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("939","871","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("940","872","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-11-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("941","873","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("942","874","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("943","875","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("944","876","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("945","877","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("946","878","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-07-28","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("947","879","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("948","880","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("949","881","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("950","882","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("951","883","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("952","884","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("953","885","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("954","886","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-07-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("955","887","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("956","888","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("957","889","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("958","890","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("959","891","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("960","892","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("961","893","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("962","894","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("963","895","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-11-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("964","896","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("965","897","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("966","898","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("967","899","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("968","900","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("969","901","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("970","902","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("971","903","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("972","904","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-10-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("973","905","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("974","906","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("975","907","Normal","2","3","Confirmação","1000","0","0","2A","1","Nenhum","Manhã","2ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("976","908","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("977","909","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("978","910","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("979","911","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("980","912","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("981","913","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("982","914","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("983","915","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("984","916","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-08","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("985","917","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-10-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("986","918","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("987","919","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("988","920","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("989","921","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("990","922","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("991","923","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("992","924","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-23","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("993","925","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("994","926","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("995","927","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("996","928","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-10-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("997","929","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-25","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("998","930","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("999","931","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1000","932","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1001","933","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1002","934","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1003","935","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1004","936","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1005","937","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1006","938","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1007","939","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1008","940","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1009","941","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1010","942","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1011","943","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1012","944","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1013","945","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1014","946","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1015","947","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2021-09-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1016","948","Normal","2","2","Confirmação","1000","0","0","1B","2","Nenhum","Manhã","1ª","2022-01-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1017","949","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1018","950","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1019","951","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1020","952","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1021","953","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-22","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1022","954","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1023","955","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1024","956","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1025","957","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-11","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1026","958","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1027","959","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1028","960","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1029","961","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1030","962","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1031","963","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1032","964","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-22","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1033","965","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1034","966","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1035","967","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1036","968","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1037","969","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1038","970","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1039","971","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1040","972","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1041","973","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1042","974","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-10-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1043","975","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1044","976","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1045","977","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1046","978","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1047","979","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1048","980","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-10-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1049","981","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-05","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1050","982","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1051","983","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1052","984","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-11-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1053","985","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-07-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1054","986","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-19","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1055","987","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1056","988","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1057","989","Normal","2","1","Confirmação","1000","0","0","1A","1","Nenhum","Manhã","1ª","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1058","990","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-03","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1059","991","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1060","992","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1061","993","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1062","994","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1063","995","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1064","996","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1065","997","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1066","998","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1067","999","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1068","1000","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1069","1001","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1070","1002","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1071","1003","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-08-26","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1072","1004","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1073","1005","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-20","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1074","1006","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1075","1007","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-07-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1076","1008","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1077","1009","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1078","1010","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1079","1011","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1080","1012","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-10-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1081","1013","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1082","1014","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-10-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1083","1015","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1084","1016","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1085","1017","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1086","1018","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1087","1019","Normal","2","26","Confirmação","1000","0","0","PRÉ-B","4","Nenhum","Manhã","Pré","2021-11-09","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1088","1020","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1089","1021","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-04","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1090","1022","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1091","1023","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-10-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1092","1024","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-07-29","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1093","1025","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1094","1026","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-31","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1095","1027","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-09-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1096","1028","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1097","1029","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-09-03","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1098","1030","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1099","1031","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-16","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1100","1032","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1101","1033","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1102","1034","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1103","1035","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-09-07","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1104","1036","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1105","1037","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1106","1038","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1107","1039","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-30","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1108","1040","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1109","1041","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-09-01","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1110","1042","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1111","1043","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-10-06","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1112","1044","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-14","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1113","1045","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1114","1046","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-10-15","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1115","1047","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1116","1048","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-13","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1117","1049","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-18","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1118","1050","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-10","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1119","1051","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-27","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1120","1052","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-08-12","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1121","1053","Normal","2","25","Confirmação","1000","0","0","PRÉ-A","4","Nenhum","Manhã","Pré","2021-09-02","","activo","2021-10-01","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1122","1054","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-09-01","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1123","1055","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-10-07","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1124","1056","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-07-28","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1125","1057","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-07-29","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1126","1058","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-07-29","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1127","1059","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-03","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1128","1060","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-05","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1129","1061","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-09","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1130","1062","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-06","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1131","1063","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-06","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1132","1064","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-06","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1133","1065","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-10","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1134","1066","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-10","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1135","1067","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-10","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1136","1068","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-13","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1137","1069","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-12","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1138","1070","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-17","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1139","1071","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-07-16","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1140","1072","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-18","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1141","1073","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-20","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1142","1074","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-24","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1143","1075","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-25","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1144","1076","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-27","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1145","1077","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-09-01","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1146","1078","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-31","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1147","1079","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-09-01","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1148","1080","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-09-03","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1149","1081","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-09-06","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1150","1082","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-09-07","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1151","1083","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-09-13","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1152","1084","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-08-30","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1153","1085","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-07-27","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1154","1086","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-11-23","","activo","0000-00-00","Sem Classificação","0");
INSERT INTO matriculaseconfirmacoes VALUES("1155","1087","Normal","2","22","Matrícula","1000","0","0","9A","9","Nenhum","Tarde","9ª","2021-12-16","","activo","0000-00-00","Sem Classificação","0");



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS notasavaliacao;

CREATE TABLE `notasavaliacao` (
  `idnotaavaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `idavaliacao` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idnotaavaliacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS periodos;

CREATE TABLE `periodos` (
  `idperiodo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`idperiodo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO periodos VALUES("1","Manhã");
INSERT INTO periodos VALUES("2","Tarde");



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS presencaprofessores;

CREATE TABLE `presencaprofessores` (
  `idpresencaprofessor` int(11) NOT NULL AUTO_INCREMENT,
  `idprofessor` int(11) NOT NULL,
  `diadapresenca` date NOT NULL,
  `totaldetempos` double NOT NULL DEFAULT '0',
  `salarioportempo` double NOT NULL DEFAULT '0',
  `iddisciplina` int(11) NOT NULL,
  PRIMARY KEY (`idpresencaprofessor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS relatoriodiario;

CREATE TABLE `relatoriodiario` (
  `idrelatoriodiario` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `data` date NOT NULL,
  `idprofessor` int(11) NOT NULL,
  PRIMARY KEY (`idrelatoriodiario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS salas;

CREATE TABLE `salas` (
  `idsala` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`idsala`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO salas VALUES("1","1");
INSERT INTO salas VALUES("2","2");
INSERT INTO salas VALUES("3","3");
INSERT INTO salas VALUES("4","4");
INSERT INTO salas VALUES("5","5");
INSERT INTO salas VALUES("6","6");
INSERT INTO salas VALUES("7","7");
INSERT INTO salas VALUES("8","8");
INSERT INTO salas VALUES("9","9");
INSERT INTO salas VALUES("10","10");
INSERT INTO salas VALUES("11","11");
INSERT INTO salas VALUES("12","12");
INSERT INTO salas VALUES("13","13");



DROP TABLE IF EXISTS stock;

CREATE TABLE `stock` (
  `idstock` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) NOT NULL,
  `precodevenda` double NOT NULL DEFAULT '0',
  `precodecompra` double NOT NULL DEFAULT '0',
  `quantidade` int(8) NOT NULL DEFAULT '0',
  `datadecadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idstock`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




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
INSERT INTO tipodesaidas VALUES("4","Aluguer","Custos Variados","2","12000");
INSERT INTO tipodesaidas VALUES("5","Alimentação","Custos Variados","23","100000");
INSERT INTO tipodesaidas VALUES("6","Empréstimos","Gastos com o Pessoal","1","50000");



DROP TABLE IF EXISTS tiposdenotas;

CREATE TABLE `tiposdenotas` (
  `idtipodenota` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `percentagemnotrimestre` double NOT NULL DEFAULT '0.5',
  `posicao` int(2) NOT NULL DEFAULT '1',
  `especial` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipodenota`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO tiposdenotas VALUES("1","MAC","0","1","0.33","1","0");
INSERT INTO tiposdenotas VALUES("2","PP   ","0","1","0.33","2","0");
INSERT INTO tiposdenotas VALUES("3","MAC","0","2","0.33","3","0");
INSERT INTO tiposdenotas VALUES("4","CPP","0","2","0.33","4","0");
INSERT INTO tiposdenotas VALUES("5","MAC","0","3","0.3","5","0");
INSERT INTO tiposdenotas VALUES("6","CPP","0","3","0.3","6","0");
INSERT INTO tiposdenotas VALUES("9","CPP","0","7","0.3","2","0");
INSERT INTO tiposdenotas VALUES("10","MAC","0","6","0.3","1","0");
INSERT INTO tiposdenotas VALUES("11","CPP","0","6","0.3","2","0");
INSERT INTO tiposdenotas VALUES("12","MAC","0","5","0.3","1","0");
INSERT INTO tiposdenotas VALUES("13","CPP","0","5","0.3","2","0");
INSERT INTO tiposdenotas VALUES("15","CPE","2","0","0.6","1","1");
INSERT INTO tiposdenotas VALUES("16","NER","2","0","1","2","1");
INSERT INTO tiposdenotas VALUES("17","PT","2","3","0.4","9","0");
INSERT INTO tiposdenotas VALUES("18","PT","2","2","0.34","6","0");
INSERT INTO tiposdenotas VALUES("19","PT","2","1","0.34","3","0");



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

INSERT INTO trimestres VALUES("1","Iº","3","2","MT1","0","0.33","1");
INSERT INTO trimestres VALUES("2","IIº","3","2","MT2","0","0.33","2");
INSERT INTO trimestres VALUES("3","IIIº","3","2","MT3","0","0.33","3");
INSERT INTO trimestres VALUES("5","Iº","2","1","CT1","0","0.33","1");
INSERT INTO trimestres VALUES("6","IIº","2","1","CT2","0","0.33","2");
INSERT INTO trimestres VALUES("7","IIIº","2","1","CT3","0","0.33","3");
INSERT INTO trimestres VALUES("8","Iº","2","3","CT1","0","0.33","1");
INSERT INTO trimestres VALUES("9","IIº","2","3","CT2","0","0.33","2");
INSERT INTO trimestres VALUES("10","IIIº","2","3","CT3","0","0.33","3");



DROP TABLE IF EXISTS turmas;

CREATE TABLE `turmas` (
  `idturma` int(11) NOT NULL AUTO_INCREMENT,
  `idanolectivo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `idperiodo` int(11) NOT NULL,
  `idciclo` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `idsala` int(11) NOT NULL,
  `idclasse` int(11) NOT NULL,
  `propina` double NOT NULL DEFAULT '0',
  `reconfirmacao` double NOT NULL DEFAULT '0',
  `matricula` double NOT NULL DEFAULT '0',
  `eclassedeexame` varchar(11) NOT NULL DEFAULT 'Não',
  `minimoparapositiva` double NOT NULL DEFAULT '10',
  `valormaximo` double NOT NULL DEFAULT '20',
  `valorminimo` double NOT NULL DEFAULT '0',
  `classificacaopositiva` varchar(50) NOT NULL DEFAULT 'Apto',
  `classificacaonegativa` varchar(50) NOT NULL DEFAULT 'Não Apto',
  `idcoordenador` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idturma`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO turmas VALUES("1","2","1A","1","1","1","1","1","4500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("2","2","1B","1","1","1","2","1","4500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("3","2","2A","1","1","1","1","2","4500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("4","2","2B","1","1","1","2","2","4500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("5","2","3A","1","1","1","2","3","4500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("6","2","3B","1","1","1","1","3","4500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("7","2","4A","1","1","1","2","4","4500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("8","2","4B","1","1","1","1","4","4500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("9","2","4C","1","1","1","11","4","4500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("10","2","5A","1","1","1","6","5","5500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("11","2","5B","1","1","1","11","5","5500","2000","4000","Não","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("12","2","5C","1","1","1","2","5","5500","2000","4000","Não","5","10","0","Transita","N/ Transita","32");
INSERT INTO turmas VALUES("13","2","6A","1","1","1","11","6","5500","2000","4000","Sim","5","10","0","Apto","N/ Apto","0");
INSERT INTO turmas VALUES("14","2","6B","1","1","1","12","6","5500","2000","4000","Sim","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("15","2","6C","1","1","1","8","6","5500","2000","4000","Sim","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("16","2","7A","2","2","1","9","7","6000","2000","4000","Não","10","20","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("17","2","7B","2","2","1","9","7","6000","2000","4000","Não","10","20","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("18","2","7C","2","2","1","9","7","6000","2000","4000","Não","10","20","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("19","2","8A","2","2","1","9","8","6000","2000","4000","Não","10","20","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("20","2","8B","2","2","1","9","8","6000","2000","4000","Não","10","20","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("21","2","8C","2","2","1","9","8","6000","2000","4000","Não","10","20","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("22","2","9A","2","2","1","9","9","6500","2000","4000","Sim","10","20","0","Apto","N/ Apto","1");
INSERT INTO turmas VALUES("23","2","9B","2","2","1","9","9","6500","2000","4000","Sim","10","20","0","Apto","N/ Apto","0");
INSERT INTO turmas VALUES("24","2","9C","2","2","1","9","9","6500","2000","4000","Sim","10","20","0","Apto","N/ Apto","0");
INSERT INTO turmas VALUES("25","2","PRÉ-A","1","1","1","4","13","4000","2000","4000","Não","5","10","0","Transita","N/ Transita","1");
INSERT INTO turmas VALUES("26","2","PRÉ-B","1","1","1","4","13","4000","2000","4000","Não","5","10","0","Transita","N/ Transita","1");
INSERT INTO turmas VALUES("28","2","10CEJ","2","3","3","9","10","7000","2000","4000","Não","10","20","0","Transita","N/ Transita","1");
INSERT INTO turmas VALUES("30","2","11CEJ","2","3","3","9","11","7500","2000","4000","Não","10","20","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("31","2","12CEJ","2","3","3","9","12","8000","2000","4000","Sim","10","20","0","Apto","N/ Apto","0");
INSERT INTO turmas VALUES("32","2","10CFB","2","3","2","4","10","7000","2000","4000","Não","10","20","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("33","2","11CFB","2","3","2","9","11","7500","2000","4000","Não","10","20","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("34","2","12CFB","2","3","2","9","12","8000","2000","4000","Sim","10","20","0","Apto","N/ Apto","0");



