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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO administradores VALUES("13","44","secretaria1","joana","$2y$10$bE.DbgFr0r6Ul30H8l.A1uML6cNJnZoH0rmFzSgDV49A9fMdhg8Vq","desbloqueado","2023-05-08 15:10:42","2023-02-27 13:33:23");
INSERT INTO administradores VALUES("14","45","areapedagogica","floide","$2y$10$3AgFKcaE6TeV2AuxpsL/Aee4gIkQCZ6DHKuwzz0YUxDemtqWSifrO","desbloqueado","2008-01-01 00:03:23","2023-01-11 11:37:19");
INSERT INTO administradores VALUES("15","43","administrador","tamara","$2y$10$dY6JdQU4uzO9YC27wy045OrgmAOitvQyknClJow8pY81BNNDoKLPS","desbloqueado","2007-12-31 23:02:53","2007-12-31 23:24:28");
INSERT INTO administradores VALUES("16","31","administrador","esmael00","$2y$10$EWQps2A4ziwed3hftU/YUehGlANnJ9Pxm/fouCvf9pSmTIfk7Ekja","desbloqueado","2022-12-21 10:07:04","2022-12-21 10:03:11");
INSERT INTO administradores VALUES("17","47","professor","123","$2y$10$6PLakV.bfhkzkbE/JSwFQufXvrmidHWaUtsiGhNojEBuhbn9tD4uu","desbloqueado","2023-01-11 11:30:07","2023-01-11 11:32:24");



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
  `numerodeprocesso` int(11) DEFAULT NULL,
  `morada` varchar(220) DEFAULT NULL,
  `religiao` varchar(200) DEFAULT NULL,
  `nomedoencarregado` varchar(200) DEFAULT NULL,
  `datadecadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` varchar(200) NOT NULL DEFAULT 'activo',
  `obs` text,
  PRIMARY KEY (`idaluno`)
) ENGINE=InnoDB AUTO_INCREMENT=1313 DEFAULT CHARSET=utf8;
 INSERT INTO alunos VALUES("1144","Kembi Elizabeth Feliciana Kuluca","Femenino","Lucombo Andr� Kuluca","Gra�a Isabel Feliciano","Viana","Angolana","Luanda","","Luanda","","","","922038640","","","2022","2017-05-29","0000-00-00","358","","","Lucombo Andr� Kuluca","2022-08-29 11:39:56","activo","");
INSERT INTO alunos VALUES("1145","Elizandra Guia Francisco Jos�","Femenino","Zinho Francisco Jos�","Ruth Domingos Manuel Guia","Catete","Angolana","Luanda","010104149BO040","Luanda","","","","924883086/924628633","","","2022","2010-02-05","2024-03-25","359","","","Zinho Francisco Jos�","2022-08-29 11:43:57","activo","");
INSERT INTO alunos VALUES("1146","In�cia Madalena B. Rocha","Femenino","Assun��o da Rocha","Domingas A. da Rocha","Luanda","Angolana","Luanda","3282","Luanda","","","","923455248","","","2022","2006-10-22","0000-00-00","360","","","Assun��o da Rocha","2022-08-29 11:56:47","activo","");
INSERT INTO alunos VALUES("1147","Trausio Chimbungule Hebo","Masculino","Mateus Manuel Hebo","Albertina Domingos Chimbungule","Ingombota","Angolana","Luanda","009545587LA041","Luanda","","","","927559381","","","2022","2010-09-21","2023-07-10","361","","","Mateus Manuel Hebo","2022-08-29 12:04:27","activo","");
INSERT INTO alunos VALUES("1148","Ant�nio Jos� Chico","Masculino","Rofino Chico","Julieta Jos�","Viana","Angolana","Luanda","023726862LA051","Luanda","","","","925828235","","","2022","2002-02-06","0000-00-00","362","","","Rofino Chico","2022-08-29 12:08:28","activo","");
INSERT INTO alunos VALUES("1149","Laura Pontes dos Santos","Femenino","Manuel Ant�nio dos Santos","Ana Maria S. S. Pontes","Viana","Angolana","Luanda","","Luanda","","","","932112149/927633740","","","2022","2014-10-08","0000-00-00","365","","","Manuel Ant�nio dos Santos","2022-08-31 10:34:02","activo","");
INSERT INTO alunos VALUES("1150","Anacleto Pontes dos Santos","Masculino","Manuel Ant�nio os Santos","Ana Maria Sebasti�o de Sousa Pontes","Cazenga","Angolana","Luanda","","Luanda","","","","932112149/927633740","","","2022","2009-09-08","0000-00-00","366","","","Manuel Ant�nio os Santos","2022-08-31 10:37:06","activo","");
INSERT INTO alunos VALUES("1151","Jocelina Miguel Manuel","Femenino","Nelson Sebasti�o Manuel","Filomena Miguel Manuel","Luanda","Angolana","Luanda","","Luanda","","","","924649293","","","2022","0000-00-00","0000-00-00","379","","","Nelson Sebasti�o Manuel","2022-08-31 15:20:59","activo","");
INSERT INTO alunos VALUES("1152","Karina Vunge Bembuca","Femenino","Gouveia Andr� Bembuca","Jorgina Nazareth Vunge","Viana","Angolana","Luanda","","Luanda","","","","923885645/922520380","","","2022","2017-03-28","0000-00-00","381","","","Gouveia Andr� Bembuca","2022-08-31 15:30:21","activo","");
INSERT INTO alunos VALUES("1153","Kerubim Suzana K. Pedro","Masculino","Makizayila Z. Pedro","Nsangu Kisoka","Kilamba Kiaxi","Angolana","Luanda","","Luanda","","","","941938629","","","2022","2013-06-22","0000-00-00","383","","","Makizayila Z. Pedro","2022-08-31 15:55:30","activo","");
INSERT INTO alunos VALUES("1154","Maria Imaculada Luis Hossi","Femenino","Faustino Chico","Isabel Luisa","Ingombota","Angolana","Luanda","004978992LA046","Luanda","","","","9279945/931292880","","","2022","2002-08-17","2026-09-20","384","","","Faustino Chico","2022-08-31 16:06:53","activo","");
INSERT INTO alunos VALUES("1155","Ventura Mucombe Jos� Domingos","Masculino","Ant�nio Jos� Domingos","Domingas Soares Mucombe","Kunda dia Baze","Angolana","","","Luanda","","","","923208822","","","2022","2007-02-26","0000-00-00","386","","","Ant�nio Jos� Domingos","2022-08-31 16:12:59","activo","");
INSERT INTO alunos VALUES("1156","Evanilda Garcia Jo�o","Femenino","Edson Quingongo P. Jo�o","Engr�cia da Costa Garcia","Ingombota","Angolana","Luanda","","Luanda","","","","943823084/","","","2022","2012-03-12","0000-00-00","399","","","Edson Quingongo P. Jo�o","2022-09-01 17:32:39","activo","");
INSERT INTO alunos VALUES("1157","Bruno Garcia Jo�o","Masculino","Edson Quingongo Policarpo Jo�o","Engr�cia da Costa Garcia","Viana","Angolana","Luanda","","Luanda","","","","943823084","","","2022","2017-07-16","0000-00-00","400","","","Edson Quingongo Policarpo Jo�o","2022-09-01 17:39:39","activo","");
INSERT INTO alunos VALUES("1158","Edgar Lumbo Nhanga","Masculino","Manuel Nhanga","Marquinha Ant�nio Lumbo","Cazenga","Angolana","Luanda","","Luanda","","","","","","","2022","2010-01-27","0000-00-00","401","","","Manuel Nhanga","2022-09-01 17:43:44","activo","");
INSERT INTO alunos VALUES("1159","Alberto Raul Cawende","Masculino","Raul Cawende","Filomena Alberto","Viana","Angolana","Luanda","","Luanda","","","","941394680","","","2022","2006-09-24","0000-00-00","402","","","Raul Cawende","2022-09-01 17:46:38","activo","");
INSERT INTO alunos VALUES("1160","Celma Sapalo Domingos","Femenino","Francisco Silvano Domingos","Helena Quaresma F. Sapalo","Maianga","Angolana","Luanda","","Luanda","","","","926041034","","","2022","2011-08-20","0000-00-00","404","","","Francisco Silvano Domingos","2022-09-01 17:58:22","activo","");
INSERT INTO alunos VALUES("1161","Eug�nio Gabriel Manuel da Silva","Masculino","Jorge Manuel da Silva","Gizela Filomena Jos� Manuel","","Angolana","","","Luanda","","","","923323795","","","2022","0000-00-00","0000-00-00","407","","","Jorge Manuel da Silva","2022-09-01 18:52:17","activo","");
INSERT INTO alunos VALUES("1162","Fl�viano Mbuco Cololo","Masculino","Victor Osvaldo Cololo","Josefina Congolo Mbuco","Kilamba Kiaxi","Angolana","","","Luanda","","","","926875148/927988424","","","2022","2015-12-19","0000-00-00","413","","","Victor Osvaldo Cololo","2022-09-01 19:46:39","activo","");
INSERT INTO alunos VALUES("1163","L�ria J�lio de Almeida","Femenino","Ar�o Chitunda de Almeida","Lucinda Jos� J�lio","Viana","Angolana","","","Luanda","","","","934353037","","","2022","2012-12-02","0000-00-00","424","","","Ar�o Chitunda de Almeida","2022-09-01 20:37:59","activo","");
INSERT INTO alunos VALUES("1164","Gabriel Kimuanga Calanzangi","Masculino","Diogo Ant�nio Calazangi","Elisa M. Calazangi","Luanda","Angolana","","","Luanda","","","","944947362","","","2022","0000-00-00","0000-00-00","425","","","Diogo Ant�nio Calazangi","2022-09-01 20:42:53","activo","");
INSERT INTO alunos VALUES("1165","Jacira Manuel Londa","Femenino",".........................","Marcelina Ant�nio Manuel Londa","Soyo","Angolana","Zaire","010182920ZE043","Luanda","","","","938516950","","","2022","2007-07-06","2024-05-15","426","","",".........................","2022-09-01 20:46:57","activo","");
INSERT INTO alunos VALUES("1166","Denise Yasmim K. Calanzange","Femenino","Diogo Ant�nio Calazangi","Elisa M. Calanzangi","Luanda","Angolana","Luanda","","Luanda","","","","944947362","","","2022","2017-04-12","0000-00-00","427","","","Diogo Ant�nio Calazangi","2022-09-01 20:50:21","activo","");
INSERT INTO alunos VALUES("1167","Andreia Kimuanza Calazangi","Femenino","Diogo Ant�nio Calazangi","Elisa M. Calanzangi","Luanda","Angolana","Luanda","","Luanda","","","","944947362","","","2022","2009-05-20","0000-00-00","428","","","Diogo Ant�nio Calazangi","2022-09-01 20:52:53","activo","");
INSERT INTO alunos VALUES("1168","Antonio Luboco Mafuta","Masculino","Ant�nio Mafuta","Nkuna Luzizila Regina","Kilamba Kiaxi","Angolana","Luanda","","Luanda","","","","945253814","","","2022","2015-05-22","0000-00-00","429","","","Ant�nio Mafuta","2022-09-01 20:56:14","activo","");
INSERT INTO alunos VALUES("1169","Emanuel Jo�o Mussassa","Masculino","Lucas Felix Mussassa","Adelina Carlos Jo�o","Luanda","Angolana","Luanda","","Luanda","","","","924463062","","","2022","0000-00-00","0000-00-00","430","","","Lucas Felix Mussassa","2022-09-01 21:00:34","activo","");
INSERT INTO alunos VALUES("1170","Florinda Adriano Correia","Femenino","Ant�nio Paulo Correia","Feliciana Luis Adriano","Kilamba Kiaxi","Angolana","Luanda","","Luanda","","","","938789470","","","2022","2006-09-29","0000-00-00","431","","","Ant�nio Paulo Correia","2022-09-01 21:03:52","activo","");
INSERT INTO alunos VALUES("1171","Eliezer Domingos Jer�nimo","Masculino","Cassule Diogo Jer�nimo","Maria W. Domingos Jer�nimo","Viana","Angolana","Luanda","","Luanda","","","","928647191","","","2022","2017-02-11","0000-00-00","433","","","Cassule Diogo Jer�nimo","2022-09-01 21:11:06","activo","");
INSERT INTO alunos VALUES("1172","Marcelina Dovales Gongo","Femenino","Sebasti�o da Silva Gongo","Filomena Maria Ant�nio Dovales","Malanje","Angolana","Malanje","020245262ME058","Luanda","","","","936228283","","","2022","2004-10-01","2024-10-27","439","","","Sebasti�o da Silva Gongo","2022-09-07 09:55:52","activo","");
INSERT INTO alunos VALUES("1173","Madruga dos Santos Monteiro","Masculino","Fernandes Monteiro","Santa Lu�s dos Santos","Cuanza Norte","Angolana","","008867581KN044","Luanda","","","","931838171","","","2022","2007-08-27","2022-05-08","440","","","Fernandes Monteiro","2022-09-07 10:01:06","activo","");
INSERT INTO alunos VALUES("1174","Edgar Joaquim Eduardo","Masculino","Jos� Francisco Ant�nio Eduardo","N�ria Cardoso de Matos Joquim","Ingombotas","Angolana","Luanda","007646069LA040","Luanda","","","","940753948","","","2022","2009-05-22","2026-10-14","441","","","Jos� Francisco Ant�nio Eduardo","2022-09-07 10:08:33","activo","");
INSERT INTO alunos VALUES("1175","Irineu Miguel Garcia","Masculino","Germano de Sousa Garcia","Indira Francisca Miguel","Viana","Angolana","Luanda","","Luanda","","","","935502684","","","2022","2013-04-17","0000-00-00","442","","","Germano de Sousa Garcia","2022-09-07 10:21:48","activo","");
INSERT INTO alunos VALUES("1176","Herculano Enzo Bernardo Manuel","Masculino","Nelson Job Mariano Manuel","Denise da Concei��o B. Manuel","Ingombotas","Angolana","Luanda","022043792LA053","Luanda","","","","923768069","","","2022","2008-10-11","2026-06-13","446","","","Nelson Job Mariano Manuel","2022-09-07 10:36:01","activo","");
INSERT INTO alunos VALUES("1177","Elton Jos� Cafu�a Catenda","Masculino","Jos� Catenda","In�s A. Catenda","Maianga","Angolana","Luanda","","Luanda","","","","923248304","","","2022","0000-00-00","0000-00-00","448","","","Jos� Catenda","2022-09-07 10:53:48","activo","");
INSERT INTO alunos VALUES("1178","Marcolino Cahiata Masseca","Masculino","Lucas Ant�nio","Em�lia Paula Cahiata","Viana","Angolana","Luanda","","Luanda","","","","921477253","","","2022","2012-02-06","0000-00-00","456","","","Lucas Ant�nio","2022-09-07 11:20:48","activo","");
INSERT INTO alunos VALUES("1179","Soraya de Lemos Miguel","Femenino","Jo�o Maria Miguel","Maria Ana Xiquete de Lemos","Viana","Angolana","Luanda","","Luanda","","","","951512310","","","2022","2017-11-12","0000-00-00","462","","","Jo�o Maria Miguel","2022-09-07 11:53:24","activo","");
INSERT INTO alunos VALUES("1180","Mauricio de Goveia Leite Dias","Masculino","S�rgio Ant�nio L. Dias","Maria Ribeiro de G. Dias","Viana","Angolana","","009889699LA042","Luanda","","","","924318659","","","2022","2006-03-25","2023-12-19","464","","","S�rgio Ant�nio L. Dias","2022-09-07 12:01:37","activo","");
INSERT INTO alunos VALUES("1181","Celmira de Goveia Leite Dias","Femenino","S�rgio Ant�nio L. Dias","Maria Ribeiro de Goveia Leite","Sambinzanga","Angolana","Luanda","009889309A045","Luanda","","","","924318659","","","2022","0000-00-00","2023-12-19","469","","","S�rgio Ant�nio L. Dias","2022-09-07 12:21:51","activo","");
INSERT INTO alunos VALUES("1182","Gabriel Breganha  Quibato","Masculino","Manuel F. Quibato","Luzia Kimbundo S. Breganha","Viana","Angolana","","","Luanda","","","","923552160","","","2022","2016-04-26","0000-00-00","480","","","Manuel F. Quibato","2022-09-07 12:55:30","activo","");
INSERT INTO alunos VALUES("1183","Joelma Ebenesia Curimenha","Femenino","...................................","Benedita Maria Curimenha","Kilamba Kiaxi","Angolana","Luanda","010281871LA043","Luanda","","","","924704793","","","2022","2011-08-15","2024-06-30","484","","","...................................","2022-09-07 13:11:45","activo","");
INSERT INTO alunos VALUES("1184","Rita Maria Curimenha","Femenino",".................................","Benedita Maria Curimenha","Kilamba Kiaxi","Angolana","Luanda","010257265LA046","Luanda","","","","924704793","","","2022","2009-05-04","2024-06-21","485","","",".................................","2022-09-07 13:23:51","activo","");
INSERT INTO alunos VALUES("1185","L�cia da Gra�a A. Cassua","Femenino","Emanuel de Jesus Cassua","Catarina Daniela Augustinho","Cazenga","Angolana","Luanda","","Luanda","","","","925499999","","","2022","0000-00-00","0000-00-00","487","","","Emanuel de Jesus Cassua","2022-09-07 13:33:16","activo","");
INSERT INTO alunos VALUES("1186","Osvaldo de Jesus Curimenha","Femenino","........................","Bendita Maria Curimenha","Golf","Angolana","Luanda","008908117LA044","Luanda","","","","945834282","","","2022","2005-04-23","2027-06-08","489","","","........................","2022-09-07 13:56:19","activo","");
INSERT INTO alunos VALUES("1187","Fabio J�nior Ant�nio Dike","Masculino","Patrick O. Dike","T�nia Faustino Ant�nio","Kilamba Kiaxi","Angolana","Luanda","","Luanda","","","","931391325","","","2022","2015-05-25","0000-00-00","492","","","Patrick O. Dike","2022-09-07 14:12:10","activo","");
INSERT INTO alunos VALUES("1188","Manuela Francisco Ant�nio","Femenino","Manuel Ant�nio Diogo Mateus","Leonor E. Pedro Francisco","Maianga","Angolana","","","Luanda","","","","947775145","","","2022","2011-08-24","0000-00-00","493","","","Manuel Ant�nio Diogo Mateus","2022-09-07 14:16:07","activo","");
INSERT INTO alunos VALUES("1189","Elizandro Domingos No�","Masculino","Eduardo Francisco C. No�","Cevardina Joaquim Domingos","Viana","Angolana","Luanda","","Luanda","","","","948478160","","","2022","2017-07-17","0000-00-00","495","","","Eduardo Francisco C. No�","2022-09-07 14:26:10","activo","");
INSERT INTO alunos VALUES("1190","Judith Nicolau Mendes","Femenino","Domingos Mendes","Teresa Nicolau","","Angolana","","","Luanda","","","","925674399","","","2022","2022-09-02","0000-00-00","496","","","Domingos Mendes","2022-09-07 16:51:11","activo","");
INSERT INTO alunos VALUES("1191","C�lio Sebasti�o Bento Caboco","Masculino","Alexandre Sebasti�o Caboco","Heslania da Concei��o R. Bento","Cazenga","Angolana","Luanda","","Luanda","","","","923636182","","","2022","2011-08-21","0000-00-00","501","","","Alexandre Sebasti�o Caboco","2022-09-07 17:22:37","activo","");
INSERT INTO alunos VALUES("1192","Augusta Ferreira Ginga","Femenino","Nelson Luis Fernandes","Luzia Maria Agostinho","","Angolana","","","Luanda","","","","943979073/941906578","","","2022","2017-10-07","0000-00-00","503","","","Nelson Luis Fernandes","2022-09-07 17:27:21","activo","");
INSERT INTO alunos VALUES("1193","Jo�o Ferreira Ginga","Masculino","Nelson Luis Fernandes","Luzia Maria Agostinho","","Angolana","","","Luanda","","","","943979073/941906578","","","2022","2016-02-29","0000-00-00","504","","","Nelson Luis Fernandes","2022-09-07 17:29:33","activo","");
INSERT INTO alunos VALUES("1194","Manuela Celestino Paulino Gonsalveis","Femenino","Manuel Celestino Gonsalveis","Em�lia Paulino","Caxito-Dande","Angolana","Caxito","","Luanda","","","","941611105","","","2022","2006-09-10","0000-00-00","506","","","Manuel Celestino Gonsalveis","2022-09-07 17:38:02","activo","");
INSERT INTO alunos VALUES("1195","Jaoquim Manuel Fernando","Masculino","Manuel Celestino Gonsalveis","Teresa Fernandes","Luanda","Angolana","Luanda","","Luanda","","","","941611105/997944437","","","2022","0000-00-00","0000-00-00","507","","","Manuel Celestino Gonsalveis","2022-09-07 17:41:29","activo","");
INSERT INTO alunos VALUES("1196","Joaquim Manuel Fernandes Celestino","Masculino","Manuel Celestino Gonsalveis","Teresa Fernandes Gonsalveis","Bengo","Angolana","Luanda","","Luanda","","","","941611105/997944437","","","2022","2002-10-20","0000-00-00","508","","","Manuel Celestino Gonsalveis","2022-09-07 17:45:47","activo","");
INSERT INTO alunos VALUES("1197","Nat�lia Fernandes Gonsalveis","Femenino","Manuel Celestino Gonsalveis","Teresa Fernandes","Maianga","Angolana","Luanda","","Luanda","","","","941611105/997944437","","","2022","2006-01-27","0000-00-00","509","","","Manuel Celestino Gonsalveis","2022-09-07 17:49:07","activo","");
INSERT INTO alunos VALUES("1198","Ant�nia Gonga Canjungo","Femenino","Domingos Gonga Canjungo","Eug�nia Canjungo Gonga","Viana","Angolana","Luanda","","Luanda","","","","925800268","","","2022","2007-06-30","0000-00-00","514","","","Domingos Gonga Canjungo","2022-09-07 18:18:38","activo","");
INSERT INTO alunos VALUES("1199","Anaela Domingos dos Santos Esc�rcio","Femenino","Joel Ferreira Esc�cio","Sana Kuyela Tch. dos Santos","","Angolana","","","Luanda","","","","921424874","","","2022","2017-03-12","0000-00-00","515","","","Joel Ferreira Esc�cio","2022-09-07 18:22:31","activo","");
INSERT INTO alunos VALUES("1200","Haniela Isabel dos Santos Esc�rcio","Femenino","Joel Ferreira Esc�cio","Sana Kuyela Tch. dos Santos","Ingombotas","Angolana","Luanda","","Luanda","","","","921424874","","","2022","2017-03-12","0000-00-00","516","","","Joel Ferreira Esc�cio","2022-09-07 18:25:03","activo","");
INSERT INTO alunos VALUES("1201","Ester Maria de Jesus Manuel","Femenino","Osvaldo de Carvalho F. Manuel","Albertina Pedro de Jesus","Viana","Angolana","Luanda","","Luanda","","","","923594430","","","2022","2014-06-10","0000-00-00","517","","","Osvaldo de Carvalho F. Manuel","2022-09-07 18:28:27","activo","");
INSERT INTO alunos VALUES("1202","Radija Marina Jo�o Matias","Femenino","Raimundo Pires Crist�v�o","Albertina Ant�nio Q. Jo�o","Kilamba Kiaxi","Angolana","Luanda","","Luanda","","","","923313351","","","2022","2007-05-30","0000-00-00","528","","","Raimundo Pires Crist�v�o","2022-09-09 07:46:05","activo","");
INSERT INTO alunos VALUES("1203","Paula Capato Ulica Tchimdumdo","Femenino","Ant�nio Tchimdumbo","Isabel Kapato Ulica","Viana","Angolana","Luanda","022375103LA059","Luanda","","","","921703533","","","2022","2010-07-09","2026-08-22","529","","","Ant�nio Tchimdumbo","2022-09-09 07:51:55","activo","");
INSERT INTO alunos VALUES("1204","Gilson Jos� Mariano Tongonho","Masculino","Jos� Mariano Tongonho Duarte","Maria Luisa Samacuenge","Huambo","Angolana","Huambo","","Luanda","","","","923943484","","","2022","0000-00-00","0000-00-00","530","","","Jos� Mariano Tongonho Duarte","2022-09-09 07:59:29","activo","");
INSERT INTO alunos VALUES("1205","Otaniel Wamuno Cangahi","Masculino","Osvaldo Jos� Cangahi","Dania Cangahi","Luanda","Angolana","Luanda","","Luanda","","","","923343834","","","2022","2017-11-24","0000-00-00","532","","","Osvaldo Jos� Cangahi","2022-09-09 08:04:43","activo","");
INSERT INTO alunos VALUES("1206","Luciana Panda Vilombo","Femenino","Andr� Leonardo Vilombo","Valquiria Luisa Valeiriano P. Vilombo","Viana","Angolana","Luanda","","Luanda","","","","926560536","","","2022","2017-02-20","0000-00-00","536","","","Andr� Leonardo Vilombo","2022-09-09 08:19:27","activo","");
INSERT INTO alunos VALUES("1207","Marlene Manuel Mariano","Femenino","Ramido Mariano","Luisa Balanga Manuel","Samba","Angolana","Luanda","","Luanda","","","","936916159","","","2022","2015-06-05","0000-00-00","538","","","Ramido Mariano","2022-09-09 08:47:38","activo","");
INSERT INTO alunos VALUES("1208","Louren�o Augusto Ant�nio Dala","Masculino","Jos� Augusto Dala","Joana Caba�a Ant�nio","Malanje","Angolana","Malanje","020227257ME059","Luanda","","","","925714979","","","2022","2005-11-25","2024-10-17","540","","","Jos� Augusto Dala","2022-09-09 09:10:53","activo","");
INSERT INTO alunos VALUES("1209","Ana Maria Ant�nio","Femenino","............","No�mia Justino Ant�nio","Cazenga","Angolana","Luanda","","Luanda","","","","947314475","","","2022","2012-01-28","0000-00-00","543","","","............","2022-09-09 09:35:27","activo","");
INSERT INTO alunos VALUES("1210","Tonivaldo Francisco Ant�nio","Masculino",".........................","No�mia Justino Ant�nio","Cazenga","Angolana","Luanda","","Luanda","","","","923428895","","","2022","2009-06-01","0000-00-00","551","","",".........................","2022-09-09 10:42:53","activo","");
INSERT INTO alunos VALUES("1211","Fernado Cassule Cristov�o","Masculino","Venceslau Tavares Crist�v�o","Eva Ant�nio Cassule","Viana","Angolana","Luanda","","Luanda","","","","925406209","","","2022","2018-04-15","0000-00-00","554","","","Venceslau Tavares Crist�v�o","2022-09-09 12:57:12","activo","");
INSERT INTO alunos VALUES("1212","Fernado Chiquembe Soares","Masculino","Luis Jos� Gomes Soares","Cristina Chulo C. Chiquemba","Viana","Angolana","Luanda","","Luanda","","","","998761299","","","2022","2014-11-11","0000-00-00","555","","","Luis Jos� Gomes Soares","2022-09-09 13:03:53","activo","");
INSERT INTO alunos VALUES("1213","In�s Diogo Mateus","Femenino","Alvaro Miguel Jo�o Mateus","Iracelma da Concei��o O. Diogo","Viana","Angolana","Luanda","","Luanda","","","","922328939","","","2022","2009-05-02","0000-00-00","561","","","Alvaro Miguel Jo�o Mateus","2022-09-09 18:07:41","activo","");
INSERT INTO alunos VALUES("1214","Marinela Armando Candumbo","Femenino","Alberto Candumbo","Francelina Valente Armando","Luanda","Angolana","Luanda","008873686LA041","Luanda","","","","927160146","","","2022","2003-05-25","2022-05-11","565","","","Alberto Candumbo","2022-09-12 10:24:39","activo","");
INSERT INTO alunos VALUES("1215","Ver�nica Tito Laurindo","Femenino","Jaime Joaquim Larindo","Domingas Cutemba Tito","Viana","Angolana","Luanda","023525994LA056","Luanda","","","","934291306","","","2022","2002-09-06","2027-05-19","567","","","Jaime Joaquim Larindo","2022-09-12 10:48:34","activo","");
INSERT INTO alunos VALUES("1216","Kene de Jesus Texeira","Masculino","......................","Regina Alveis Texeira","Golungo Alto","Angolana","Cuanza Norte","009982378KN046","Luanda","","","","924371235","","","2022","2008-10-13","2024-01-31","572","","","......................","2022-09-12 11:31:00","activo","");
INSERT INTO alunos VALUES("1217","Marcelina Colela Quissanga","Femenino","Mateus Muhongo Quissanga","Fernanda","Cazenga","Angolana","Luanda","","Luanda","","","","923741778","","","2022","2009-04-27","0000-00-00","575","","","Mateus Muhongo Quissanga","2022-09-12 14:32:49","activo","");
INSERT INTO alunos VALUES("1218","Utima Vict�ria Manuel Brand�o","Femenino","Andr� de Jesus Brand�o","Vict�ria Jo�o Agostinho Manuel","Belas","Angolana","Luanda","","Luanda","","","","931534894","","","2022","2017-03-22","0000-00-00","577","","","Andr� de Jesus Brand�o","2022-09-12 14:40:04","activo","");
INSERT INTO alunos VALUES("1219","Rita Gombo Cassoma","Femenino","Manuel Cassoma","Juliana Gombo","Viana","Angolana","Luanda","008632469LA048","Luanda","","","","","","","2022","2001-05-10","2027-04-11","578","","","Manuel Cassoma","2022-09-12 14:51:07","activo","");
INSERT INTO alunos VALUES("1220","Zola Vict�ria Manuel Brand�o","Femenino","Andr� de Jesus Brand�o","Vict�ria Jo�o Agostinho Manuel","Belas","Angolana","Luanda","","Luanda","","","","923425994","","","2022","2017-03-22","0000-00-00","579","","","Andr� de Jesus Brand�o","2022-09-12 14:56:53","activo","");
INSERT INTO alunos VALUES("1221","Emiliana de Jesus Carlos Olo","Femenino","Eliseu Jos� Suca Olo","Isabel de Jesus S. Pataca","Ingombotas","Angolana","Luanda","022430438LA055","Luanda","","","","945995563/924533457","","","2022","2008-10-17","0000-00-00","584","","","Eliseu Jos� Suca Olo","2022-09-12 15:46:04","activo","");
INSERT INTO alunos VALUES("1222","Paulina Sim�o Buka","Femenino","Kams Pedro Buka","Maria Augusto Sim�o","Sambinzanga","Angolana","Luanda","","Luanda","","","","940451641","","","2022","2015-12-02","0000-00-00","591","","","Kams Pedro Buka","2022-09-14 09:00:26","activo","");
INSERT INTO alunos VALUES("1223","K�lsia Catarina Neto Caiombe","Femenino","Mateus Manuel Bumba Caiombe","Isabel dos Prazeres N. D. Caiombe","Viana","Angolana","Luanda","0207115811LA050","Luanda","","","","923626184","","","2022","2010-06-06","2025-06-01","593","","","Mateus Manuel Bumba Caiombe","2022-09-14 09:38:45","activo","");
INSERT INTO alunos VALUES("1224","M�rio Jos� Ferreira","Masculino","Milton Domingos Alexandre Ferreira","Luisa da Concei��o Jos�","Viana","Angolana","Luanda","","Luanda","","","","928970604","","","2022","2015-07-27","0000-00-00","595","","","Milton Domingos Alexandre Ferreira","2022-09-14 12:17:32","activo","");
INSERT INTO alunos VALUES("1225","D�lcio da Purifica��o D. Francisco","Masculino","Geovane Afonso Francisco","Carmem Sheila da Silva Domingos","Viana","Angolana","Luanda","","Luanda","","","","929158614","","","2022","2018-04-03","0000-00-00","600","","","Geovane Afonso Francisco","2022-09-14 12:40:18","activo","");
INSERT INTO alunos VALUES("1226","Pedro Agostinho da Silva Buiti","Masculino","Bruno da Silva Massanga Buiti","Eunice Maria Cabomo Agostinho","Maianga","Angolana","Luanda","","Luanda","","","","934174360","","","2022","2016-11-24","0000-00-00","601","","","Bruno da Silva Massanga Buiti","2022-09-14 12:45:44","activo","");
INSERT INTO alunos VALUES("1227","Yasmin Henriqueta Tchimungo Kamongo","Masculino","Valdano J�lio S. Kamongo","Odeth Am�rico Tchimungo","Sambinzanga","Angolana","Luanda","","Luanda","","","","934903905","","","2022","2017-10-13","0000-00-00","603","","","Valdano J�lio S. Kamongo","2022-09-14 12:54:26","activo","");
INSERT INTO alunos VALUES("1228","Manuel Francisco Ngola  Caniguida","Masculino","Francisco Caniguida","Maria ngola","","Angolana","Malanje","008161074LA044","Luanda","","","","","","","2022","2008-09-22","2016-04-22","606","","","Francisco Caniguida","2022-09-14 13:18:21","activo","");
INSERT INTO alunos VALUES("1229","Josiana Jorgina Diogo Francisco","Femenino","Jorge Adriano Francisco","Concei��o de Almeida da Cruz","Cazenga","Angolana","Luanda","022298045LA052","Luanda","","","","928318847","","","2022","2007-08-30","2026-08-04","607","","","Jorge Adriano Francisco","2022-09-14 13:35:09","activo","");
INSERT INTO alunos VALUES("1230","Emanuela Isabel Chingalule Jo�o","Femenino","Bernabe Daniel D0omingos Jo�o","Felomena Namela","Viana","Angolana","Luanda","","Luanda","","","","949845724","","","2022","2009-02-14","0000-00-00","608","","","Bernabe Daniel D0omingos Jo�o","2022-09-14 13:43:22","activo","");
INSERT INTO alunos VALUES("1231","Isabel Kumbo","Femenino","","","","Angolana","","","Luanda","","","","","","","2022","0000-00-00","0000-00-00","611","","","","2022-09-14 14:21:55","activo","");
INSERT INTO alunos VALUES("1232","Mavunino Diansongui","Masculino","Jo�o Luvumbu","Mafuta Maria","Luanda","Angolana","Luanda","","Luanda","","","","924119791","","","2022","2009-01-05","0000-00-00","612","","","Jo�o Luvumbu","2022-09-16 10:09:53","activo","");
INSERT INTO alunos VALUES("1233","Bianca Maria Manuel Disonsi","Femenino","Alberto Macueno Manuel Dinsonsi","Helena Manuel","Cazenga","Angolana","","","Luanda","","","","943816412","","","2022","2012-03-23","0000-00-00","613","","","Alberto Macueno Manuel Dinsonsi","2022-09-16 10:15:49","activo","");
INSERT INTO alunos VALUES("1234","Majediyuka Francisca Muleleno Kuvilala","Femenino","Dimitrof Francisco da Silva Kuvilala","Fernanda Yolanda Muleleno","Viana","Angolana","Luanda","","Luanda","","","","924800780","","","2022","2016-11-28","0000-00-00","614","","","Dimitrof Francisco da Silva Kuvilala","2022-09-16 10:59:47","activo","");
INSERT INTO alunos VALUES("1235","Janeth Dala Paciencia","Femenino","Miguel Samuel Paciencia","Rosa Cambo Dala","Kilamba Kiaxi","Angolana","Luanda","023901664LA059","Luanda","","","","923444870","","","2022","2006-01-24","2027-07-21","615","","","Miguel Samuel Paciencia","2022-09-16 11:16:43","activo","");
INSERT INTO alunos VALUES("1236","Marco Aur�lio Cristo Dala","Masculino","Adolfo da Gra�a Dala","Marinela Gl�ria Cristo Dala","Ingombotas","Angolana","Luanda","020960950LA057","Luanda","","","","922853883","","","2022","2010-03-27","2025-09-15","623","","","Adolfo da Gra�a Dala","2022-09-19 16:36:25","activo","");
INSERT INTO alunos VALUES("1237","Catarina Luanda Matamba","Femenino","Ant�nio Luis Tete Matamba","Juliana Hebo Luamba Luanda","Viana","Angolana","Luanda","022068072LA058","Luanda","","","","922320229","","","2022","2012-10-18","2026-06-17","625","","","Ant�nio Luis Tete Matamba","2022-09-19 16:48:15","activo","");
INSERT INTO alunos VALUES("1238","Dumilson Luis Luanda Matamba","Masculino","Ant[onio Luis Tate Matamba","Juliana Hebo Luamba Luanda","Viana","Angolana","Luanda","022163549LA050","Luanda","","","","922320229","","","2022","2015-06-30","2026-07-08","626","","","Ant[onio Luis Tate Matamba","2022-09-19 16:52:41","activo","");
INSERT INTO alunos VALUES("1239","Olga Jorgina Rodrigues Franco","Femenino","Quilamba Jorge Franco","Laura Rodrigues Jorge","Saurimo","Angolana","","","Luanda","","","","923343834","","","2022","2011-01-07","0000-00-00","627","","","Quilamba Jorge Franco","2022-09-19 16:55:54","activo","");
INSERT INTO alunos VALUES("1240","Nataniela Royana Jos� Gaspar","Femenino","Ant[onio Gaspar Joaquim","Rosa Luis Jos�","Viana","Angolana","Luanda","","Luanda","","","","923661920","","","2022","2016-06-18","0000-00-00","630","","","Ant[onio Gaspar Joaquim","2022-09-19 17:44:28","activo","");
INSERT INTO alunos VALUES("1241","Emiliana Adalzira Jos� Gaspar","Masculino","Ant�nio Gaspar Joaquim","Rosa Luis Jos�","Viana","Angolana","Luanda","023283336LA052","Luanda","","","","923661920","","","2022","2015-04-19","2027-03-29","632","","","Ant�nio Gaspar Joaquim","2022-09-19 17:53:08","activo","");
INSERT INTO alunos VALUES("1242","Neymar Moises Correia Nkunga","Masculino","Jo�o Nkunga","Carla Eug�nia de Vasconcelos Correia","Cazenga","Angolana","Luanda","","Luanda","","","","939016161","","","2022","2011-08-20","0000-00-00","643","","","Jo�o Nkunga","2022-09-19 18:41:01","activo","");
INSERT INTO alunos VALUES("1243","Fernandes Junior Eduardo","Masculino","Fernando Eduardo","Ana Rom�o","Luanda","Angolana","Luanda","","Luanda","","","","941271862","","","2022","2015-02-28","0000-00-00","644","","","Fernando Eduardo","2022-09-19 18:43:54","activo","");
INSERT INTO alunos VALUES("1244","Laura Gomes Junqueira","Femenino","","","","Angolana","","","Luanda","","","","","","","2022","0000-00-00","0000-00-00","645","","","","2022-09-19 18:46:14","activo","");
INSERT INTO alunos VALUES("1245","Rosa Gomes Junqueira","Femenino","","","","Angolana","","","Luanda","","","","","","","2022","0000-00-00","0000-00-00","646","","","","2022-09-19 18:47:10","activo","");
INSERT INTO alunos VALUES("1246","Suzana Armando Paulo","Femenino","Martins Pulo Gambo","Angela Alberto Cuassa","Uige","Angolana","Uige","","Luanda","","","","925464983","","","2022","2012-01-21","0000-00-00","655","","","Martins Pulo Gambo","2022-09-21 10:30:00","activo","");
INSERT INTO alunos VALUES("1247","Madalena Nsika Sinza","Femenino","Pedro Sinza","Afonsina Kuedikuenda","Kuinba","Angolana","Uige","","Luanda","","","","947714672","","","2022","2008-07-19","0000-00-00","657","","","Pedro Sinza","2022-09-21 10:39:02","activo","");
INSERT INTO alunos VALUES("1248","Ventura Mucombo Jos�","Masculino","Ant�nio Jos� Domingos","Domingas Soares Mucombe","Ndalatando-Cacengo","Angolana","Cuanza Norte","","Luanda","","","","923208822","","","2022","2007-02-26","0000-00-00","662","","","Ant�nio Jos� Domingos","2022-09-22 10:27:25","activo","");
INSERT INTO alunos VALUES("1249","Victoria Fernandes Jos�","Femenino","","","","Angolana","","","Luanda","","","","","","","2022","0000-00-00","0000-00-00","665","","","","2022-09-23 16:42:23","activo","");
INSERT INTO alunos VALUES("1250","Paulo Ndombaxi Albano","Masculino","Miguel Albano","Maria Goveia Ndombaxi","Luanda","Angolana","Luanda","","Luanda","","","","921996962","","","2002","2001-02-07","0000-00-00","671","","","Miguel Albano","2002-01-01 01:20:28","activo","");
INSERT INTO alunos VALUES("1251","Francisco Famado Jorge","Masculino","�lvaro Manuel","Teresa Famado","Negaje","Angolana","Uige","","Luanda","","","","927285175","","","2002","2003-05-01","0000-00-00","672","","","�lvaro Manuel","2002-01-01 02:55:20","activo","");
INSERT INTO alunos VALUES("1252","Luzia Ant�nio dos Santos","Femenino","Paulo C. do Santos","Nelsa C. Ant�nio","Kilamba Kiaxi","Angolana","Luanda","","Luanda","","","","923580788","","","2022","2007-10-13","0000-00-00","676","","","Paulo C. do Santos","2022-09-27 15:29:53","activo","");
INSERT INTO alunos VALUES("1253","Jessica Patr�cia da Silva Dias","Femenino","Carlos Jos� Bernardo da Silva","Teresa Manuel Dias","Viana","Angolana","Luanda","4110/2018","Luanda","nao","","926849000","","","","2022","2017-09-27","0000-00-00","678","Spu2","","","2022-09-28 09:12:43","activo","");
INSERT INTO alunos VALUES("1254","Naureth de F. Bravo da Rosa","Femenino","Alcides C B.. Da Rosa","Eva Domingos de Carvalho","Luanda","Angolana","Luanda","","Luanda","","","","","","","2022","2009-05-17","0000-00-00","684","","","","2022-09-30 09:38:30","activo","");
INSERT INTO alunos VALUES("1255","Paulo Estev�o Pedro","Masculino","","","","Angolana","","","Luanda","","","","","","","2022","0000-00-00","0000-00-00","689","","","","2022-10-03 09:51:53","activo","");
INSERT INTO alunos VALUES("1256","Telmo Fernando David","Masculino","Alexandre T. David","Maria P. Fernando","Luanda","Angolana","Luanda","","Luanda","","","","925584481","","","2022","2018-04-04","0000-00-00","691","","","Alexandre T. David","2022-10-03 11:09:40","activo","");
INSERT INTO alunos VALUES("1257","Elisangela Fernando David","Masculino","Alexandre Tomas David","Maria Pedade Henriques","Viana","Angolana","Luanda","","Luanda","","","","925584412","","","2022","2012-08-08","0000-00-00","694","","","Alexandre Tomas David","2022-10-03 11:34:27","activo","");
INSERT INTO alunos VALUES("1258","Henrique Luis Cardoso","Masculino","Fernando da Silva Cardoso","Tania Luis Pedro","Cazenga","Angolana","Luanda","020466568LA059","Luanda","","","","949771795","","","2022","2005-01-12","2025-01-13","695","","","Fernando da Silva Cardoso","2022-10-03 11:41:02","activo","");
INSERT INTO alunos VALUES("1259","Luzia Francisco Moxi","Femenino","Serafim Alberto Moxi","Concei��o Francisco","Catete","Angolana","Luanda","","Luanda","","","","923235225","","","2022","2026-09-16","0000-00-00","699","","","Serafim Alberto Moxi","2022-10-03 13:43:14","activo","");
INSERT INTO alunos VALUES("1260","Sandra Quipapa Lundangem","Masculino","Jacob Jo�o Lundange","Delfina Ant�nio Lundange","Luanda","Angolana","Luanda","","Luanda","","","","924260703","","","2022","2016-06-27","0000-00-00","701","","","Jacob Jo�o Lundange","2022-10-03 14:14:21","activo","");
INSERT INTO alunos VALUES("1261","Florinda Catchumbo Constantino","Femenino","Constatino Catomba","Helena Constantino","","Angolana","","","Luanda","","","","931160742","","","2022","2000-04-17","0000-00-00","702","","","Constatino Catomba","2022-10-03 14:19:39","activo","");
INSERT INTO alunos VALUES("1262","Paulina Jo�o Casimiro","Masculino","Tio Buci Casimiro","Am[elia Jo�o Muyeba","Luanda","Angolana","Luanda","","Luanda","","","","","","","2022","2016-06-28","0000-00-00","703","","","Tio Buci Casimiro","2022-10-03 14:40:39","activo","");
INSERT INTO alunos VALUES("1263","Avelina Manuela Lucunde","Femenino","Gabriel Kalungo Lucunde","Eduarda Manuela Kanjambala","","Angolana","","","Luanda","","","","927914043","","","2022","2011-06-27","0000-00-00","704","","","Gabriel Kalungo Lucunde","2022-10-03 14:55:50","activo","");
INSERT INTO alunos VALUES("1264","Nubercia Eduardo Henriques","Femenino","Nuno Henriques","Belmiro Elizangela","Cuanza Sul","Angolana","","","Luanda","","","","948428515","","","2022","2015-11-09","0000-00-00","705","","","Nuno Henriques","2022-10-03 15:51:20","activo","");
INSERT INTO alunos VALUES("1265","Edmilcia Jo�o Neto","Femenino","Jo�o Neto BViera","Domingas Albino","Malange","Angolana","Malange","","Luanda","","","","948428515","","","2022","2011-03-21","0000-00-00","706","","","Jo�o Neto BViera","2022-10-03 15:55:05","activo","");
INSERT INTO alunos VALUES("1266","Antonio Fernandes","Masculino","","","","Angolana","","","Luanda","","","","","","","2022","0000-00-00","0000-00-00","708","","","","2022-10-03 16:05:20","activo","");
INSERT INTO alunos VALUES("1267","Kezia Emanuela Perreira","Femenino","","","","Angolana","","","Luanda","","","","","","","2022","0000-00-00","0000-00-00","709","","","","2022-10-03 16:45:22","activo","");
INSERT INTO alunos VALUES("1268","Larissa Tamara Caquianda Matias","Femenino","Osvaldo Domingos Matias","Joana da Concei��o N. Matias","Ingombotas","Angolana","Luanda","009845042LA041","Luanda","","","","924220137","","","2022","2010-05-05","2023-12-05","712","","","Osvaldo Domingos Matias","2022-10-04 11:03:24","activo","");
INSERT INTO alunos VALUES("1269","Carla Albertina Bai�o","Femenino",".............................","Marilena Ant�nio Bai�o","Kilamba Kiaxi","Angolana","Luanda","020352392LA056","Luanda","","","","931304102","","","2022","2008-06-15","2024-12-02","713","","",".............................","2022-10-04 12:01:27","activo","");
INSERT INTO alunos VALUES("1270","Emanuel Agostinho Vunge Gonga","Masculino","Jos�e Vunge Gonga","Luisa Lamento V. Gonga","Ingombotas","Angolana","Luanda","","Luanda","","","","923496972","","","2022","2004-04-02","0000-00-00","715","","","Jos�e Vunge Gonga","2022-10-04 15:14:38","activo","");
INSERT INTO alunos VALUES("1271","Marcos Aurelio Dalas","Masculino","","","","Angolana","","","Luanda","","","","","","","2022","0000-00-00","0000-00-00","716","","","","2022-10-04 15:17:24","activo","");
INSERT INTO alunos VALUES("1272","Claudino Manuel Jos� Fernandes","Masculino","Francisco Fernandes","Teresa Manuel Caetaon Jos�","Rangel","Angolana","Luanda","022628013LA053","Luanda","","","","932138035","","","2022","2003-03-22","2026-10-11","721","","","Francisco Fernandes","2022-10-04 16:22:18","activo","");
INSERT INTO alunos VALUES("1273","Mizael Junior  Dimone Panzo","Masculino","Pedro K. Ramiro Panzo","Cristina Mansoni Dimone","Viana","Angolana","Luanda","742/2017","Luanda","","","","","","","2022","0000-00-00","0000-00-00","723","","","","2022-10-05 09:13:20","activo","");
INSERT INTO alunos VALUES("1274","Ad�o Zage Cazuma Pedro","Masculino","Zage Pedro","Cec�lia Nzango M. Cazuma","Viana","Angolana","Luanda","","Luanda","","","","956541720","","","2022","2006-08-01","0000-00-00","731","","","Zage Pedro","2022-10-10 13:19:42","activo","");
INSERT INTO alunos VALUES("1275","Belmira Patricia Manecas Zenza","Masculino","Armindo Abel Zenza","Lademira Patricia Manecas","Kilamba Kiaxi","Angolana","Luanda","","Luanda","","","","","","","2022","2012-12-22","0000-00-00","732","","","Armindo Abel Zenza","2022-10-10 13:28:49","activo","");
INSERT INTO alunos VALUES("1276","Fernando Germano Muati Francisco","Masculino","Germano Manuel Jo�o Francisco","Marcelina Joaquim Muati","Cacuaco","Angolana","Luanda","","Luanda","","","","921650617","","","2022","2002-12-21","0000-00-00","733","","","Germano Manuel Jo�o Francisco","2022-10-10 13:32:12","activo","");
INSERT INTO alunos VALUES("1277","Maria Ashley Geraldo Gon�alves","Femenino","Nilton Edson de Lemos Gon�alves","Teresa Domiana Gon�alves","Ingombotas","Angolana","Luanda","","Luanda","","","","923854866","","","2022","2005-12-22","0000-00-00","736","","","Nilton Edson de Lemos Gon�alves","2022-10-10 15:35:21","activo","");
INSERT INTO alunos VALUES("1278","Feliciano Fonseca Kalundungo Joaquim","Masculino","Barreto Fonseca Joaquim","Ermelinda Fineza A. Kalundungo","Kilamba Kiaxi","Angolana","Luanda","","Luanda","","","","","","","2022","2015-06-27","0000-00-00","743","","","Barreto Fonseca Joaquim","2022-10-10 17:07:18","activo","");
INSERT INTO alunos VALUES("1279","Andreia Segundo Lopes","Femenino","","","","Angolana","","","Luanda","","","","","","","2022","0000-00-00","0000-00-00","745","","","","2022-10-11 16:51:06","activo","");
INSERT INTO alunos VALUES("1280","Etelvina Madalena Santana Vicente","Femenino","Oseias Vicente","Ermelinda Santana","Luanda","Angolana","","","Luanda","","","","921519027","","","2022","2009-03-04","0000-00-00","746","","","Oseias Vicente","2022-10-12 10:21:08","activo","");
INSERT INTO alunos VALUES("1281","Auria da Silva da Gama","Femenino","Clemente Bartolomeu da Gama","Madalena ERmuno da Silva","Viana","Angolana","Luanda","","Luanda","","","","934224906","","","2022","2013-05-18","0000-00-00","748","","","Clemente Bartolomeu da Gama","2022-10-12 13:20:04","activo","");
INSERT INTO alunos VALUES("1282","Agnaldo Rock Tchinhama","Masculino","Domingos Roque","Dulce Alexandre","Viana","Angolana","Luanda","","Luanda","","","","","","","2022","2008-08-09","0000-00-00","749","","","Domingos Roque","2022-10-13 09:02:35","activo","");
INSERT INTO alunos VALUES("1283","Santos Domingos  dos Santos Toco","Masculino","Santos Miguel Toco","Rosa Andr� Domingos","Cazenga","Angolana","Luanda","","Luanda","","","","940842743","","","2022","2006-06-12","0000-00-00","750","","","Santos Miguel Toco","2022-10-13 10:40:59","activo","");
INSERT INTO alunos VALUES("1284","Paulo Tomas Mariano","Masculino","Id�cio Cordeiro Mariano","Hermengarda Jurema J. Mariano","Kilamba Kiaxi","Angolana","Luanda","","Luanda","","","","938419373","","","2022","2012-05-14","0000-00-00","754","","","Id�cio Cordeiro Mariano","2022-10-17 09:03:56","activo","");
INSERT INTO alunos VALUES("1285","Israel Filho Tomas Mariano","Masculino","Id�cio Cordeiro Mariano","Hermengarda Jurema J. Jos�","","Angolana","","","Luanda","","","","938419373","","","2022","2014-03-14","0000-00-00","755","","","Id�cio Cordeiro Mariano","2022-10-17 09:08:03","activo","");
INSERT INTO alunos VALUES("1286","Antonica Castelo Bengue","Masculino","Tom�s Bengui","Luisa Ant�nio","Samba","Angolana","Luanda","","Luanda","","","","938388469","","","2022","2016-06-11","0000-00-00","761","","","Tom�s Bengui","2022-10-20 15:37:26","activo","");
INSERT INTO alunos VALUES("1287","Dionisio Castelo Bengui","Masculino","Tom�s Bengui","Luisa Ant�nio","Samba","Angolana","Luanda","","Luanda","","","","938388469","","","2022","2013-09-09","0000-00-00","762","","","Tom�s Bengui","2022-10-20 15:43:42","activo","");
INSERT INTO alunos VALUES("1288","Marcelo Melinda dos Santos","Masculino","Novais Jos� dos Santos","Jorgina Tchisseque Melinda","Maianga","Angolana","Luanda","009104249LA048","Luanda","","","","","","","2022","0000-00-00","0000-00-00","763","","","Novais Jos� dos Santos","2022-10-20 16:07:46","activo","");
INSERT INTO alunos VALUES("1289","Bonif�cio Cater�a Ferreira Ad�o","Masculino","Eug�nio Cater�a Ferreira","Maria Ad�o Francisco Saveia","Samba","Angolana","Luanda","022439634KN053","Luanda","","","","954379920","","","2022","2003-12-11","0000-00-00","764","","","Eug�nio Cater�a Ferreira","2022-10-20 16:13:28","activo","");
INSERT INTO alunos VALUES("1290","David Benjamim Chiengo","Masculino","Benjamim M. Chiengo","Marisa da Silva","Viana","Angolana","","007176458LA044","Luanda","","","","928162797","","","2022","2002-01-16","2026-01-11","772","","","Benjamim M. Chiengo","2022-11-14 19:53:47","activo","");
INSERT INTO alunos VALUES("1291","Sandro Chipilica Muhongo","Masculino","Angelino Silva J. Muhongo","Rosalina Alice Chipilica","Viana","Angolana","","021700278LA053","Luanda","","","","922325477","","","2022","2007-10-11","0000-00-00","773","","","Angelino Silva J. Muhongo","2022-11-14 19:57:34","activo","");
INSERT INTO alunos VALUES("1292","Elizangelo Domingos Francisco","Masculino","Geovane Afonso Francisco","Carmem Sheila Francisco","Luanda","Angolana","","","Luanda","","","","929158614","","","2022","2015-04-03","0000-00-00","774","","","Geovane Afonso Francisco","2022-11-14 21:28:00","activo","");
INSERT INTO alunos VALUES("1293","Felizarda Fernandes Jos�","Masculino","Santos Albano Jose","Teresa Fernando Jos�","","Angolana","","","Luanda","","","","933026880","","","2022","0000-00-00","0000-00-00","777","","","Santos Albano Jose","2022-11-21 15:52:25","activo","");
INSERT INTO alunos VALUES("1294","Andr� Fernando Jos� Ant�nio","Masculino","Santos Albano Jose","Teresa Fernandes Jos�","","Angolana","","","Luanda","","","","924109194","","","2022","2018-04-04","0000-00-00","778","","","Santos Albano Jose","2022-11-21 15:54:23","activo","");
INSERT INTO alunos VALUES("1295","Maria Manza Pembele","Femenino","Kimbuamba Nestor","Arrieta Pembele","Cazenga","Angolana","Luanda","","Luanda","","","","","","","2022","0000-00-00","0000-00-00","779","","","Kimbuan","2022-11-23 09:11:51","activo","");
INSERT INTO alunos VALUES("1296","Mateus Nzuzi Ant�nio","Masculino","Viriato Paulina Ant�nio","Delfina Eduardo Nzunzi","Samba","Angolana","Luanda","022432779LA051","Luanda","","","","","","","2022","2005-08-10","2026-09-01","781","","","Viriato Paulina Ant�nio","2022-12-15 06:08:44","activo","");
INSERT INTO alunos VALUES("1297","Feliciana Baptista Ant�nio","Femenino","","","","Angolana","","","Luanda","","","","923320458/913252240","","","2022","0000-00-00","0000-00-00","782","","","","2022-12-15 06:11:12","activo","");
INSERT INTO alunos VALUES("1298","Rosa Enfica Francisco Joaquim","Femenino","Lino Joaquim","Delmira Francisco Albino","Gabela","Angolana","Cuanza Sul","021931787KS050","Luanda","","","","925295157","","","2022","2003-01-06","2026-05-18","784","","","Lino Joaquim","2022-12-28 08:58:19","activo","");
INSERT INTO alunos VALUES("1299","Ant�nio Fernando","Masculino","","","","Angolana","","","Luanda","","","","","","","2023","0000-00-00","0000-00-00","785","","","","2023-01-05 14:01:46","activo","");
INSERT INTO alunos VALUES("1300","Adriana Luana Ant�nio","Femenino","...................................","Celma Marisa Major Ant�nio","Luanda","Angolana","Luanda","","Luanda","","","","929042918/944783291","","","2023","2012-12-30","0000-00-00","786","","","...................................","2023-01-06 08:02:06","activo","");
INSERT INTO alunos VALUES("1301","In�cio Mussungo Zua","Masculino","Cristov�o Calombe Jungo Zua","Deolinda Clemente Mussungo Zua","Viana","Angolana","Luanda","022324445LA059","Luanda","","","","923329373","","","2023","2013-06-24","2026-09-10","787","","","Cristov�o Calombe Jungo Zua","2023-01-06 08:07:03","activo","");
INSERT INTO alunos VALUES("1302","Madalena Clemente Zua","Femenino","G�neses Salom�o Zua","Suzana Clemente Mussungo","","Angolana","","","Luanda","","","","923329373","","","2023","2013-01-26","0000-00-00","791","","","G�neses Salom�o Zua","2023-01-19 09:46:40","activo","");
INSERT INTO alunos VALUES("1303","Eva Diolinda Mussungo Zua","Femenino","Crist�v�o Calombi Jungo Zua","Diolinda Clemente Mussungo Zua","Viana","Angolana","","022276307LA057","Luanda","","","","923329373","","","2023","2011-07-06","0000-00-00","792","","","Crist�v�o Calombi Jungo Zua","2023-01-19 09:54:14","activo","");
INSERT INTO alunos VALUES("1304","Airosana Mariana Garcia Aires","Femenino","Gonsalo Gaspar Marcos Aires","In�s Cabu�o Garcia","Cazenga","Angolana","Luanda","020392295LA056","Luanda","","","","","","","2023","2013-06-09","2024-12-15","793","","","Gonsalo Gaspar Marcos Aires","2023-01-26 08:59:24","activo","");
INSERT INTO alunos VALUES("1305","Yelciana Feliciana Garcia Aires","Femenino","Gonsalo Gaspar Marcos Aires","In�s Cabu�o Garcia","Cazenga","Angolana","Luanda","020392397LA051","Luanda","","","","","","","2023","2023-06-09","2024-12-15","794","","","Gonsalo Gaspar Marcos Aires","2023-01-26 09:01:49","activo","");
INSERT INTO alunos VALUES("1306","H�lio Mateus Chico Pedro","Masculino","Tito Mateus Pedro","","","Angolana","","","Luanda","","","","","","","2023","0000-00-00","0000-00-00","795","","","Tito Mateus Pedro","2023-01-26 09:13:25","activo","");
INSERT INTO alunos VALUES("1307","Simone Catarina A. Cassua","Femenino","Emanuel J. Cassua","Catarina D. Agostinho","","Angolana","","","Luanda","","","","","","","2023","2021-08-19","0000-00-00","796","","","Emanuel J. Cassua","2023-01-26 09:39:25","activo","");
INSERT INTO alunos VALUES("1308","Fernanda Kaynara Fal� da Silva","Femenino","Kevan M�rio da silva","JeovannaMarias Fal�","","Angolana","Luanda","","Luanda","","","","","","","2023","0000-00-00","0000-00-00","797","","","Kevan M�rio da silva","2023-01-30 12:49:48","activo","");
INSERT INTO alunos VALUES("1309","Evaristo Cabamba Tama Vital","Masculino","Jeremias Vital","Berenice Vital","Luanda","Angolana","Luanda","","Luanda","","","","923452910/945728085","","","2023","2011-02-14","0000-00-00","798","","","Jeremias Vital","2023-02-06 08:45:32","activo","");
INSERT INTO alunos VALUES("1310","Gaspar Francisco Josias","Masculino","Luciano Josias","Esperan�a Jo�o Francisco","Maianga","Angolana","Luanda","","Luanda","","","","923409941","","","2023","2004-08-30","0000-00-00","801","","","Luciano Josias","2023-02-08 14:51:08","activo","");
INSERT INTO alunos VALUES("1311","Leo Jo�o Domingos","Masculino","Jo�o Domingos Jos�","Neusa S. Mateus","Luanda","Angolana","Luanda","","Luanda","","","","948900928","","","2023","0000-00-00","0000-00-00","802","","","Jo�o Domingos Jos�","2023-02-08 14:56:56","activo","");
INSERT INTO alunos VALUES("1312","Pedro Diogo dos Santos","Masculino","Ant�nio Francisco dos Santos","Marinela Francisco","Sambinzanga","Angolana","Luanda","024575046LA053","Luanda","","","","931612066","","","2002","2004-11-12","0000-00-00","803","","","Ant�nio Francisco dos Santos","2002-01-03 02:45:03","activo","");



DROP TABLE IF EXISTS anoslectivos;

CREATE TABLE `anoslectivos` (
  `idanolectivo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `vigor` varchar(4) NOT NULL DEFAULT 'N�o',
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO anoslectivos VALUES("1","2020","N�o","1","CAP","0.4","CPE","NER","CF","0","0","0","2020-02-01","2020-11-01","2020-12-01","15","0","0","0");
INSERT INTO anoslectivos VALUES("2","2021/2022","N�o","2","CAP","0.4","CPE","NER","CF","0","500","3000","2021-08-01","2022-06-01","2022-07-01","15","2300","450","340");
INSERT INTO anoslectivos VALUES("3","2019","N�o","0","CAP","0.4","CPE","NER","CF","0","0","0","2021-08-01","2022-06-01","2022-07-01","15","0","0","0");
INSERT INTO anoslectivos VALUES("4","2022/2023","Sim","0","MFD","0.6","NE","NER","MF","2","50","0","2022-09-01","2023-06-30","2023-07-31","15","500","700","0");



DROP TABLE IF EXISTS atl;

CREATE TABLE `atl` (
  `idatl` int(11) NOT NULL AUTO_INCREMENT,
  `idanolectivo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text,
  `propina` double NOT NULL DEFAULT '0',
  `matricula` double NOT NULL DEFAULT '0',
  `idcoordenador` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idatl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS avaliacoes;

CREATE TABLE `avaliacoes` (
  `idavaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `iddisciplina` int(11) NOT NULL,
  `titulo` varchar(220) NOT NULL DEFAULT 'Avalia��o Cont�nua',
  `data` date NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `notavinculada` int(11) NOT NULL DEFAULT '0',
  `idturma` int(11) NOT NULL,
  PRIMARY KEY (`idavaliacao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO avaliacoes VALUES("1","6","Avalia��o","2022-10-19","11","26","32");
INSERT INTO avaliacoes VALUES("2","11","Avalia��o Continua","2022-10-27","11","26","30");



DROP TABLE IF EXISTS cadeirasdeixadas;

CREATE TABLE `cadeirasdeixadas` (
  `idcadeiradeixada` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT '0',
  `data` date DEFAULT NULL,
  PRIMARY KEY (`idcadeiradeixada`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

INSERT INTO cadeirasdeixadas VALUES("23","1104","98","13","3","2022-12-08");
INSERT INTO cadeirasdeixadas VALUES("24","1063","170","13","3","2022-12-08");
INSERT INTO cadeirasdeixadas VALUES("25","1137","329","13","2","2022-12-08");
INSERT INTO cadeirasdeixadas VALUES("26","1195","512","13","0","2022-12-08");
INSERT INTO cadeirasdeixadas VALUES("27","1202","533","13","4","2022-12-08");
INSERT INTO cadeirasdeixadas VALUES("28","1208","548","13","0","2022-12-08");
INSERT INTO cadeirasdeixadas VALUES("29","1219","586","13","0","2022-12-08");
INSERT INTO cadeirasdeixadas VALUES("30","1251","685","13","3","2022-12-08");
INSERT INTO cadeirasdeixadas VALUES("31","121","695","13","3","2022-12-08");
INSERT INTO cadeirasdeixadas VALUES("32","1283","764","13","3","2022-12-08");
INSERT INTO cadeirasdeixadas VALUES("33","194","780","13","1","2022-12-08");



DROP TABLE IF EXISTS ciclos;

CREATE TABLE `ciclos` (
  `idciclo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(222) NOT NULL,
  PRIMARY KEY (`idciclo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ciclos VALUES("1","Ensino Prim�rio");
INSERT INTO ciclos VALUES("2","1� Ciclo");
INSERT INTO ciclos VALUES("3","2� Ciclo");



DROP TABLE IF EXISTS classes;

CREATE TABLE `classes` (
  `idclasse` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  `idciclo` int(11) NOT NULL,
  PRIMARY KEY (`idclasse`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO classes VALUES("1","1�","1");
INSERT INTO classes VALUES("2","2�","1");
INSERT INTO classes VALUES("3","3�","1");
INSERT INTO classes VALUES("4","4�","1");
INSERT INTO classes VALUES("5","5�","1");
INSERT INTO classes VALUES("6","6�","1");
INSERT INTO classes VALUES("7","7�","2");
INSERT INTO classes VALUES("8","8�","2");
INSERT INTO classes VALUES("9","9�","2");
INSERT INTO classes VALUES("10","10�","3");
INSERT INTO classes VALUES("11","11�","3");
INSERT INTO classes VALUES("12","12�","3");
INSERT INTO classes VALUES("13","Pr� - B","1");
INSERT INTO classes VALUES("14","Pr�- A","1");



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
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;
 
DROP TABLE IF EXISTS cursos;

CREATE TABLE `cursos` (
  `idcurso` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO cursos VALUES("1","Nenhum");
INSERT INTO cursos VALUES("2","Ci�ncias F�sicas e Biol�gicas");
INSERT INTO cursos VALUES("3","Ci�ncias Econ�micas e Jur�dicas");



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

INSERT INTO dadosdaempresa VALUES("1","Complexo Escolar Arena do Saber","Ensino Prim�rio, I� e II� Ciclo e Ensino Secund�rio","","BIC: 0051.0000.0591.9169.1014.2","","Viana - Luanda, Angola","923848537","","Bairro Jacinto Tchipa, Ciquentinha, Por detr�s das roloutes","Augusto Tuta Nguvo");



DROP TABLE IF EXISTS descadastrados;

CREATE TABLE `descadastrados` (
  `iddescadastrado` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL DEFAULT 'Inactivo',
  `descricao` text,
  `data` date NOT NULL,
  PRIMARY KEY (`iddescadastrado`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
 

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
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=utf8;
 

DROP TABLE IF EXISTS documentostratados;

CREATE TABLE `documentostratados` (
  `iddocumentotratado` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL DEFAULT '2',
  `tipodedocumento` varchar(50) NOT NULL DEFAULT 'Declara��o Sem Notas',
  `preco` double NOT NULL DEFAULT '0',
  `desconto` double NOT NULL DEFAULT '0',
  `valorpago` double NOT NULL DEFAULT '0',
  `datadeentrada` date NOT NULL,
  `datadolevantamento` date NOT NULL,
  `jalevantado` varchar(10) NOT NULL DEFAULT 'N�o',
  `escoladedestino` varchar(220) DEFAULT NULL,
  `idtrimestre` int(11) DEFAULT NULL,
  `ensino` varchar(40) DEFAULT NULL,
  `classeum` int(11) DEFAULT NULL,
  `classedois` int(11) DEFAULT NULL,
  `classetres` int(11) DEFAULT NULL,
  `classequatro` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddocumentotratado`)
) ENGINE=InnoDB AUTO_INCREMENT=1017 DEFAULT CHARSET=utf8;
 

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
) ENGINE=InnoDB AUTO_INCREMENT=7242 DEFAULT CHARSET=utf8;
 
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO formasdepagamento VALUES("1","Dinheiro");
INSERT INTO formasdepagamento VALUES("2","BIC");
INSERT INTO formasdepagamento VALUES("4","Multicaixa Express");
INSERT INTO formasdepagamento VALUES("5","BAI");
INSERT INTO formasdepagamento VALUES("9","BCA");



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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

INSERT INTO funcionarios VALUES("31","Esmael Calunga","0000-00-00","Fam�lia","92924444","","","","","","0000-00-00","65000","2021-02-28 14:03:05","290","22","8","activo");
INSERT INTO funcionarios VALUES("43","Faustino Vasco Joaquim Gomes","0000-00-00","Secret�rio"," "," "," "," "," "," ","0000-00-00","0","2022-03-25 16:53:52","0","22","8","activo");
INSERT INTO funcionarios VALUES("44","Joana Joaquim Andr�","0000-00-00","Secret�ria"," ","",""," ","","","0000-00-00","0","2022-03-25 16:55:44","0","22","8","activo");
INSERT INTO funcionarios VALUES("45","Floide de Jesus","0000-00-00","Director Pedag�gico","","","","  ","","","0000-00-00","0","2022-03-25 16:59:33","0","22","8","activo");
INSERT INTO funcionarios VALUES("46","Paulino Carlos Figueira","","Professor da 2 Classe","","","Kilamba Kiaxi","Professor","Ensino Prim�rio","","0000-00-00","40000","2022-10-18 12:40:59","227","22","8","activo");
INSERT INTO funcionarios VALUES("47","Guilherme da Concei��o P. Franco","","Professor/ 1 C�clo - Geografia /1 Classe","","","","Professor","12 Classe","","0000-00-00","40000","2022-10-19 08:54:28","227","22","8","activo");
INSERT INTO funcionarios VALUES("48","J�lio Tavares Bebeca","","","","","","Professor","","","0000-00-00","700","2022-10-19 09:18:48","4","22","8","activo");
INSERT INTO funcionarios VALUES("49","Isaac Menakuntima Pedro","","Director de Turma","","","","Professor","","","0000-00-00","700","2022-10-19 09:19:55","4","22","8","activo");
INSERT INTO funcionarios VALUES("50","Leonardo Correia Pazitp","","Director de Turma","","","","Professor","","","0000-00-00","700","2022-10-19 09:20:27","4","22","8","activo");
INSERT INTO funcionarios VALUES("51","Marinela da S. Francisco","","Director de Turma","","","","Professor","","","0000-00-00","700","2022-10-19 09:21:20","4","22","8","activo");
INSERT INTO funcionarios VALUES("52","Osvaldo Caetano","","Director de Turma","","","","Professor","","","0000-00-00","700","2022-10-19 09:21:49","4","22","8","activo");
INSERT INTO funcionarios VALUES("53","Farncisco Gonga","","Director de Turma","","","","Professor","","","0000-00-00","700","2022-10-19 09:22:12","4","22","8","activo");
INSERT INTO funcionarios VALUES("54","Edna Kibuba","","Director de Turma","","","","Professor","","","0000-00-00","700","2022-10-19 09:22:40","4","22","8","activo");
INSERT INTO funcionarios VALUES("55","Andrade Buila","","Director de Turma","","","","Professor","","","0000-00-00","700","2022-10-19 09:23:07","4","22","8","activo");
INSERT INTO funcionarios VALUES("56","Telma Catenda Ernesto","","Director de Turma","","","","Professor","","","0000-00-00","700","2022-10-19 09:23:43","4","22","8","activo");
INSERT INTO funcionarios VALUES("57","Sebasti�o Lando","","Coordenador de Curso C.F.B","","","","Professor","","","0000-00-00","700","2022-10-19 09:24:31","4","22","8","activo");
 

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
) ENGINE=InnoDB AUTO_INCREMENT=799 DEFAULT CHARSET=utf8;
  
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




DROP TABLE IF EXISTS matriculaatl;

CREATE TABLE `matriculaatl` (
  `idmatriculaatl` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `idatl` int(11) NOT NULL,
  `preco` double NOT NULL DEFAULT '0',
  `desconto` double NOT NULL DEFAULT '0',
  `valorpago` double NOT NULL DEFAULT '0',
  `atl` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `obs` text,
  `estatus` varchar(200) NOT NULL DEFAULT 'activo',
  `ultimomespago` date NOT NULL DEFAULT '0000-00-00',
  `descontoparapropinas` double NOT NULL DEFAULT '0',
  `tipodealuno` varchar(222) NOT NULL DEFAULT 'Normal',
  PRIMARY KEY (`idmatriculaatl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS matriculaseconfirmacoes;

CREATE TABLE `matriculaseconfirmacoes` (
  `idmatriculaeconfirmacao` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `tipodealuno` varchar(50) NOT NULL DEFAULT 'Normal',
  `idanolectivo` int(11) NOT NULL,
  `idturma` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL DEFAULT 'Matr�cula',
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
  `classificacaofinal` varchar(50) NOT NULL DEFAULT 'Sem Classifica��o',
  `descontoparapropinas` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmatriculaeconfirmacao`)
) ENGINE=InnoDB AUTO_INCREMENT=818 DEFAULT CHARSET=utf8;

 

DROP TABLE IF EXISTS matriculatransporte;

CREATE TABLE `matriculatransporte` (
  `idmatriculatransporte` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `idtransporte` int(11) NOT NULL,
  `preco` double NOT NULL DEFAULT '0',
  `desconto` double NOT NULL DEFAULT '0',
  `valorpago` double NOT NULL DEFAULT '0',
  `transporte` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `obs` text,
  `estatus` varchar(200) NOT NULL DEFAULT 'activo',
  `ultimomespago` date NOT NULL DEFAULT '0000-00-00',
  `descontoparapropinas` double NOT NULL DEFAULT '0',
  `tipodealuno` varchar(222) NOT NULL DEFAULT 'Normal',
  PRIMARY KEY (`idmatriculatransporte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS mediasdoano;

CREATE TABLE `mediasdoano` (
  `idmediadoano` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `tipodeturma` varchar(222) NOT NULL DEFAULT 'Transi��o',
  `posicao` int(2) NOT NULL,
  `arredondarmedia` int(2) NOT NULL DEFAULT '0',
  `tipodemedia` varchar(100) NOT NULL DEFAULT 'denotas',
  `idmediamaior` int(11) NOT NULL DEFAULT '0',
  `percentagem` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmediadoano`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO mediasdoano VALUES("2","MT1","11","4","Transi��o","1","0","denotas","11","0");
INSERT INTO mediasdoano VALUES("3","MT1","11","4","Exame","1","0","denotas","8","0");
INSERT INTO mediasdoano VALUES("4","MT2","12","4","Transi��o","2","0","denotas","11","0");
INSERT INTO mediasdoano VALUES("5","MT2","12","4","Exame","2","0","denotas","8","0");
INSERT INTO mediasdoano VALUES("6","MT3","13","4","Transi��o","5","0","denotas","11","0");
INSERT INTO mediasdoano VALUES("7","MT3","13","4","Exame","6","0","denotas","8","0");
INSERT INTO mediasdoano VALUES("8","MFD","13","4","Exame","7","0","demedias","9","0.4");
INSERT INTO mediasdoano VALUES("9","MF","13","4","Exame","8","0","ponderada","0","0");
INSERT INTO mediasdoano VALUES("11","MF","13","4","Transi��o","10","0","demedias","0","0");



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
  `idnotadoano` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT '0',
  `idturma` int(11) NOT NULL,
  PRIMARY KEY (`idnota`)
) ENGINE=InnoDB AUTO_INCREMENT=11877 DEFAULT CHARSET=utf8;
 

DROP TABLE IF EXISTS notasavaliacao;

CREATE TABLE `notasavaliacao` (
  `idnotaavaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `idavaliacao` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idnotaavaliacao`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO notasavaliacao VALUES("1","1","368","12");
INSERT INTO notasavaliacao VALUES("2","1","643","12");
INSERT INTO notasavaliacao VALUES("3","1","669","13");
INSERT INTO notasavaliacao VALUES("4","1","591","13");
INSERT INTO notasavaliacao VALUES("5","1","389","13");
INSERT INTO notasavaliacao VALUES("6","1","676","14");
INSERT INTO notasavaliacao VALUES("7","1","207","13");
INSERT INTO notasavaliacao VALUES("8","2","98","10");



DROP TABLE IF EXISTS notasdoano;

CREATE TABLE `notasdoano` (
  `idnotadoano` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `tipodeturma` varchar(222) NOT NULL DEFAULT 'Transi��o',
  `posicao` int(3) NOT NULL,
  `tipo` varchar(200) NOT NULL DEFAULT 'normal',
  `idmediaaquepertence` int(11) NOT NULL DEFAULT '0',
  `percentagem` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idnotadoano`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO notasdoano VALUES("2","MAC","11","4","Transi��o","1","Normal","2","0");
INSERT INTO notasdoano VALUES("3","MAC","11","4","Exame","1","Normal","3","0");
INSERT INTO notasdoano VALUES("4","PP","11","4","Transi��o","2","Normal","2","0");
INSERT INTO notasdoano VALUES("5","PP","11","4","Exame","2","Normal","3","0");
INSERT INTO notasdoano VALUES("6","PT","11","4","Transi��o","3","Normal","2","0");
INSERT INTO notasdoano VALUES("7","PT","11","4","Exame","3","Normal","3","0");
INSERT INTO notasdoano VALUES("8","MAC","12","4","Transi��o","4","Normal","4","0");
INSERT INTO notasdoano VALUES("9","PP","12","4","Transi��o","5","Normal","4","0");
INSERT INTO notasdoano VALUES("10","PT","12","4","Transi��o","9","Normal","4","0");
INSERT INTO notasdoano VALUES("11","MAC","13","4","Transi��o","10","Normal","6","0");
INSERT INTO notasdoano VALUES("12","PP","13","4","Transi��o","11","Normal","6","0");
INSERT INTO notasdoano VALUES("13","PT","13","4","Transi��o","12","Normal","6","0");
INSERT INTO notasdoano VALUES("14","MAC","12","4","Exame","13","Normal","5","0");
INSERT INTO notasdoano VALUES("15","PP","12","4","Exame","14","Normal","5","0");
INSERT INTO notasdoano VALUES("16","PT","12","4","Exame","15","Normal","5","0");
INSERT INTO notasdoano VALUES("17","MAC","13","4","Exame","16","Normal","7","0");
INSERT INTO notasdoano VALUES("18","PP","13","4","Exame","17","Normal","7","0");
INSERT INTO notasdoano VALUES("19","NE","13","4","Exame","18","Exame","9","0.6");
INSERT INTO notasdoano VALUES("20","NER","13","4","Exame","19","Recurso","0","0");



DROP TABLE IF EXISTS periodos;

CREATE TABLE `periodos` (
  `idperiodo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`idperiodo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO periodos VALUES("1","Manh�");
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

INSERT INTO produtos VALUES("1","Uniforme Polo","7000","4000","217","2022-10-07 14:47:10","0000-00-00","2008-01-01","operacional","20");
INSERT INTO produtos VALUES("2","Cal��o","6000","3500","15","2022-11-08 10:02:05","0000-00-00","2023-02-22","operacional","10");
INSERT INTO produtos VALUES("3","Saia","6000","3500","23","2022-11-08 10:02:33","0000-00-00","2023-01-31","operacional","10");
INSERT INTO produtos VALUES("4","Folha de Prova","75","30","5499","2022-12-05 01:37:04","0000-00-00","2023-05-08","operacional","50");



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
  `referencia` varchar(50) NOT NULL,
  `datadedeposito` date NOT NULL,
  PRIMARY KEY (`idpropina`)
) ENGINE=InnoDB AUTO_INCREMENT=5219 DEFAULT CHARSET=utf8;
 

DROP TABLE IF EXISTS propinasdoatl;

CREATE TABLE `propinasdoatl` (
  `idpropinadoatl` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaatl` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `preco` double NOT NULL DEFAULT '0',
  `multa` double NOT NULL DEFAULT '0',
  `valorpago` double NOT NULL DEFAULT '0',
  `desconto` double NOT NULL DEFAULT '0',
  `mespago` date NOT NULL,
  `datadopagamento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obs` varchar(220) NOT NULL,
  `codigodepropina` varchar(200) NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `datadedeposito` date NOT NULL,
  PRIMARY KEY (`idpropinadoatl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS propinasdotransporte;

CREATE TABLE `propinasdotransporte` (
  `idpropinadotransporte` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculatransporte` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `preco` double NOT NULL DEFAULT '0',
  `multa` double NOT NULL DEFAULT '0',
  `valorpago` double NOT NULL DEFAULT '0',
  `desconto` double NOT NULL DEFAULT '0',
  `mespago` date NOT NULL,
  `datadopagamento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obs` varchar(220) NOT NULL,
  `codigodepropina` varchar(200) NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `datadedeposito` date NOT NULL,
  PRIMARY KEY (`idpropinadotransporte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




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
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
 

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

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
INSERT INTO salas VALUES("14","14");
INSERT INTO salas VALUES("15","15");
INSERT INTO salas VALUES("16","16");
INSERT INTO salas VALUES("17","17");



DROP TABLE IF EXISTS stock;

CREATE TABLE `stock` (
  `idstock` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) NOT NULL,
  `precodevenda` double NOT NULL DEFAULT '0',
  `precodecompra` double NOT NULL DEFAULT '0',
  `quantidade` int(8) NOT NULL DEFAULT '0',
  `datadecadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idstock`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO stock VALUES("1","1","7000","7000","150","2022-10-07 14:47:10");
INSERT INTO stock VALUES("2","1","7000","4000","150","2022-10-10 12:41:31");
INSERT INTO stock VALUES("3","2","6000","3500","25","2022-11-08 10:02:05");
INSERT INTO stock VALUES("4","3","6000","3500","25","2022-11-08 10:02:33");
INSERT INTO stock VALUES("5","4","75","30","6000","2022-12-05 01:37:04");



DROP TABLE IF EXISTS tipodedisciplinas;

CREATE TABLE `tipodedisciplinas` (
  `idtipodedisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `abreviatura` varchar(20) DEFAULT NULL,
  `tipodedisciplina` varchar(220) NOT NULL DEFAULT 'Normal',
  `agrupamento` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idtipodedisciplina`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

INSERT INTO tipodedisciplinas VALUES("1","Matem�tica","MAT","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("2","F�sica","FIS","Chave","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("3","Biologia","BIO","Chave","Forma��o Espec�fica");
INSERT INTO tipodedisciplinas VALUES("4","Qu�mica","QUIM","Normal","Forma��o Espec�fica");
INSERT INTO tipodedisciplinas VALUES("5","Ingl�s","ING","Normal","Op��o");
INSERT INTO tipodedisciplinas VALUES("6","Educa��o F�sica","Ed. F�sica","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("7","L�ngua Portuguesa ","L. Port","Chave","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("8","Estudo do Meio","Est. Meio","Chave","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("9","Geometria Descritiva","Geom. Desc","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("10","Geologia","Geol","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("11","Geografia","Geog","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("12","Ci�ncia da Natureza","C. Natureza","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("13","Inform�tica","Inform�tica","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("14","Empreendedorismo","EMP","Normal","Op��o");
INSERT INTO tipodedisciplinas VALUES("15","Educa��o Moral e C�vica","E.M.C","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("16","Educa��o Visual e Plastica","E.V.P","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("17","Educa��o Manual e Plastica","E.M.P","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("18","Hist�ria","Histo","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("19","Direito","DRT","Chave","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("20","Economia","ECON","Chave","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("21","Densenvolvimento ","DES","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("22","Filosofia","FILOS","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("23","Sociologia","SOCIOL","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("24","Educa��o Musical","Ed. Musical","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("25","Estudo do Meio F�sico","E.M.F","Normal","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("26","Representa��o Matem�tica","R. Mat","Chave","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("27","Comunica��o Lingu�stica","C.Lingu�stica","Chave","Forma��o Geral");
INSERT INTO tipodedisciplinas VALUES("28","Educa��o Laboral","Ed. Lab","Normal","Forma��o Geral");



DROP TABLE IF EXISTS tipodesaidas;

CREATE TABLE `tipodesaidas` (
  `idtipodesaida` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(220) NOT NULL,
  `categoria` varchar(200) NOT NULL DEFAULT 'Custos Variados',
  `numerodesaida` int(11) NOT NULL DEFAULT '0',
  `valorlimite` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipodesaida`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO tipodesaidas VALUES("1","Sal�rio","Gastos com o Pessoal","11","500000");
INSERT INTO tipodesaidas VALUES("2","Energia","Custos Variados","4","8000");
INSERT INTO tipodesaidas VALUES("3","Gastos Expor�ticos","Outros","96","45000");
INSERT INTO tipodesaidas VALUES("4","Aluguer","Custos Variados","2","12000");
INSERT INTO tipodesaidas VALUES("5","Alimenta��o","Custos Variados","23","100000");
INSERT INTO tipodesaidas VALUES("6","Empr�stimos","Gastos com o Pessoal","1","50000");



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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

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
INSERT INTO tiposdenotas VALUES("20"," MAC   ","4","13","0.3","1","0");
INSERT INTO tiposdenotas VALUES("21"," NPP   ","4","13","0.3","2","0");
INSERT INTO tiposdenotas VALUES("22"," NPT   ","4","13","0.4","3","0");
INSERT INTO tiposdenotas VALUES("23","MAC","4","12","0.3","1","0");
INSERT INTO tiposdenotas VALUES("24","NPP","4","12","0.3","2","0");
INSERT INTO tiposdenotas VALUES("25","NPT","4","12","0.4","3","0");
INSERT INTO tiposdenotas VALUES("26","MAC","4","11","0.3","1","0");
INSERT INTO tiposdenotas VALUES("27","NPP","4","11","0.3","2","0");
INSERT INTO tiposdenotas VALUES("28","NPT","4","11","0.4","3","0");
INSERT INTO tiposdenotas VALUES("29","NE","4","0","0.6","1","1");
INSERT INTO tiposdenotas VALUES("30","MF","4","0","1","2","1");



DROP TABLE IF EXISTS transportes;

CREATE TABLE `transportes` (
  `idtransporte` int(11) NOT NULL AUTO_INCREMENT,
  `idanolectivo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `propina` double NOT NULL DEFAULT '0',
  `matricula` double NOT NULL DEFAULT '0',
  `pessoal` varchar(252) NOT NULL,
  PRIMARY KEY (`idtransporte`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO transportes VALUES("1","4","Transporte Zango 2","Alunos do Zango 2 e 4","2500","6000","Filipe Andre  r
e Pedro Gregor");
INSERT INTO transportes VALUES("2","4","Transporte Mabor","leva os alunos de Viana","6000","2500","Pedro e Ant�nio
");



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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO trimestres VALUES("1","I�","3","2","MT1","0","0.33","1");
INSERT INTO trimestres VALUES("2","II�","3","2","MT2","0","0.33","2");
INSERT INTO trimestres VALUES("3","III�","3","2","MT3","0","0.33","3");
INSERT INTO trimestres VALUES("5","I�","2","1","CT1","0","0.33","1");
INSERT INTO trimestres VALUES("6","II�","2","1","CT2","0","0.33","2");
INSERT INTO trimestres VALUES("7","III�","2","1","CT3","0","0.33","3");
INSERT INTO trimestres VALUES("8","I�","2","3","CT1","0","0.33","1");
INSERT INTO trimestres VALUES("9","II�","2","3","CT2","0","0.33","2");
INSERT INTO trimestres VALUES("10","III�","2","3","CT3","0","0.33","3");
INSERT INTO trimestres VALUES("11","I�","5","4","MT1","0","0.33","1");
INSERT INTO trimestres VALUES("12","II�","5","4","MT2","0","0.33","2");
INSERT INTO trimestres VALUES("13","III�","5","4","MT3","0","0.34","3");



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
  `eclassedeexame` varchar(11) NOT NULL DEFAULT 'N�o',
  `minimoparapositiva` double NOT NULL DEFAULT '10',
  `valormaximo` double NOT NULL DEFAULT '20',
  `valorminimo` double NOT NULL DEFAULT '0',
  `classificacaopositiva` varchar(50) NOT NULL DEFAULT 'Apto',
  `classificacaonegativa` varchar(50) NOT NULL DEFAULT 'N�o Apto',
  `idcoordenador` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idturma`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

INSERT INTO turmas VALUES("1","4","Pr�-A","1","1","1","1","13","4000","2000","4000","N�o","5","10","0","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("2","4","Pr�-B","1","1","1","5","13","4000","2000","4000","N�o","5","10","0","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("3","4","1A","1","1","1","2","1","4500","2000","4000","N�o","5","10","2","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("4","4","1B","1","1","1","3","1","4500","2000","4500","N�o","5","10","2","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("5","4","2A","1","1","1","4","2","4500","2000","4500","N�o","5","10","2","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("6","4","2B","1","1","1","6","2","4500","2000","4500","N�o","5","10","2","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("7","4","3A","1","1","1","8","3","4500","2000","4500","N�o","5","10","2","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("8","4","3B","1","1","1","7","3","4500","2000","4500","N�o","5","10","2","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("9","4","4A","1","1","1","11","4","4500","2000","4500","N�o","5","10","2","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("10","4","4B","1","1","1","10","4","4500","2000","4500","N�o","5","10","2","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("11","4","4C","2","1","1","9","4","4500","2000","4500","N�o","5","10","2","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("12","4","7A","2","2","1","2","7","6000","2000","4000","N�o","10","20","7","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("13","4","7B","2","2","1","3","7","6000","2000","4000","N�o","10","20","7","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("14","4","7C","2","1","1","4","7","6000","2000","4000","N�o","10","20","7","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("15","4","8A","2","2","1","8","8","6000","2000","4000","N�o","10","20","7","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("16","4","8B","2","2","1","7","8","6000","2000","4000","N�o","10","20","7","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("17","4","8C","2","2","1","12","8","6000","2000","4000","N�o","10","20","7","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("18","4","9A","2","2","1","13","9","6500","2000","4000","Sim","10","20","0","Apto","N/ Apto","31");
INSERT INTO turmas VALUES("19","4","9B","2","2","1","14","9","6500","2000","4000","Sim","10","20","0","Apto","N/ Apto","31");
INSERT INTO turmas VALUES("20","4","9C","2","2","1","9","9","6500","2000","4000","Sim","10","20","0","Apto","N/ Apto","0");
INSERT INTO turmas VALUES("21","4","6A","1","1","1","14","6","5500","2000","4000","Sim","5","10","0","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("22","4","6B","1","1","1","16","6","5500","2000","4000","Sim","5","10","0","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("23","4","6C","1","1","1","12","6","5500","2000","4000","Sim","5","10","2","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("24","4","5A","2","1","1","12","5","5500","2000","4000","N�o","5","10","2","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("25","4","5B","2","1","1","13","5","5500","2000","4000","N�o","5","10","2","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("26","4","5C","1","1","1","9","5","5500","2000","4000","N�o","5","10","2","Transita","N/ Transita","0");
INSERT INTO turmas VALUES("27","4","10-C.E.J","2","3","1","9","10","7000","2000","4000","N�o","10","20","7","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("28","4","11-C.E.J","2","3","1","10","11","7500","2000","4000","N�o","10","20","7","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("29","4","12-C.E.J","2","3","1","16","12","8000","2000","4000","Sim","10","20","7","Apto","N/ Apto","31");
INSERT INTO turmas VALUES("30","4","10-C.F.B","2","3","1","17","10","7000","2000","4000","N�o","10","20","7","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("31","4","11-C.F.B","2","3","1","6","11","7500","2000","4000","N�o","10","20","7","Transita","N/ Transita","31");
INSERT INTO turmas VALUES("32","4","12-C.F.B","2","3","1","11","12","8000","2000","4000","Sim","10","20","7","Apto","N/ Apto","31");



