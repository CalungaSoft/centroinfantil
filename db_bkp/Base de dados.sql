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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idadministrador`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

 INSERT INTO administradores VALUES("16","31","administrador","esmael00","$2y$10$EWQps2A4ziwed3hftU/YUehGlANnJ9Pxm/fouCvf9pSmTIfk7Ekja","desbloqueado","2023-11-05 16:17:29","2023-10-08 02:31:39","2023-11-05 16:17:29");
 


DROP TABLE IF EXISTS administradoresalunos;

CREATE TABLE `administradoresalunos` (
  `idadministradoraluno` int(11) NOT NULL AUTO_INCREMENT,
  `idmatriculaconfirmacao` varchar(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `painel` varchar(120) NOT NULL DEFAULT 'funcionario',
  `username` varchar(100) NOT NULL,
  `senha` varchar(260) NOT NULL,
  `acesso` varchar(90) NOT NULL DEFAULT 'desbloqueado',
  `ultimoacesso` datetime DEFAULT NULL,
  `horadodeslogue` datetime DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idadministradoraluno`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS agenda;

CREATE TABLE `agenda` (
  `idagenda` int(11) NOT NULL AUTO_INCREMENT,
  `nomedaactividade` varchar(220) DEFAULT NULL,
  `datainicio` date DEFAULT NULL,
  `datafim` date DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `obs` varchar(220) DEFAULT NULL,
  `horainicio` time DEFAULT NULL,
  `horafim` time DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idagenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




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
  `datadecadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `estatus` varchar(200) NOT NULL DEFAULT 'activo',
  `obs` text DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `caminhodafoto` varchar(222) DEFAULT NULL,
  `nifencarregado` varchar(222) DEFAULT NULL,
  PRIMARY KEY (`idaluno`)
) ENGINE=InnoDB AUTO_INCREMENT=1320 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 

DROP TABLE IF EXISTS anoslectivos;

CREATE TABLE `anoslectivos` (
  `idanolectivo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `vigor` varchar(4) NOT NULL DEFAULT 'Não',
  `posicao` int(3) NOT NULL DEFAULT 0,
  `nomedamediadostrimestres` varchar(11) NOT NULL DEFAULT 'CAP',
  `percentagemdamediadostrimestres` double NOT NULL DEFAULT 0.4,
  `nomedaprovadeescola` varchar(11) NOT NULL DEFAULT 'CPE',
  `nomedaprovadeexame` varchar(11) NOT NULL DEFAULT 'NER',
  `nomedamediaanual` varchar(10) NOT NULL DEFAULT 'CF',
  `arredondarmedia` int(1) NOT NULL DEFAULT 2,
  `precodafalta` double NOT NULL DEFAULT 0,
  `precodareconfirmacao` double NOT NULL DEFAULT 0,
  `datainicio` date NOT NULL DEFAULT '2021-08-01',
  `datafim` date NOT NULL DEFAULT '2022-06-01',
  `datafimexame` date NOT NULL DEFAULT '2022-07-01',
  `diadamulta` int(2) NOT NULL DEFAULT 15,
  `precodamulta` varchar(50) NOT NULL DEFAULT '0',
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idanolectivo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 
 INSERT INTO anoslectivos VALUES("4","2023/2024","Sim","0","MFD","0.6","NE","NER","MF","2","100","0","2022-09-01","2023-06-30","2023-07-31","15","20%","2023-10-16 06:40:12");
 


DROP TABLE IF EXISTS atl;

CREATE TABLE `atl` (
  `idatl` int(11) NOT NULL AUTO_INCREMENT,
  `idanolectivo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text DEFAULT NULL,
  `propina` double NOT NULL DEFAULT 0,
  `matricula` double NOT NULL DEFAULT 0,
  `idcoordenador` int(11) NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idatl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS avaliacoes;

CREATE TABLE `avaliacoes` (
  `idavaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `iddisciplina` int(11) NOT NULL,
  `titulo` varchar(220) NOT NULL DEFAULT 'Avaliação Contínua',
  `data` date NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `notavinculada` int(11) NOT NULL DEFAULT 0,
  `idturma` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idavaliacao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 


DROP TABLE IF EXISTS cadeirasdeixadas;

CREATE TABLE `cadeirasdeixadas` (
  `idcadeiradeixada` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT 0,
  `data` date DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idcadeiradeixada`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci; 


DROP TABLE IF EXISTS ciclos;

CREATE TABLE `ciclos` (
  `idciclo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(222) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idciclo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO ciclos VALUES("1","Ensino Primário","2023-08-12 19:50:52");
INSERT INTO ciclos VALUES("2","1º Ciclo","2023-08-12 19:50:52"); 



DROP TABLE IF EXISTS classes;

CREATE TABLE `classes` (
  `idclasse` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  `idciclo` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idclasse`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO classes VALUES("1","1ª","1","2023-08-12 19:50:53");
INSERT INTO classes VALUES("2","2ª","1","2023-08-12 19:50:53");
INSERT INTO classes VALUES("3","3ª","1","2023-08-12 19:50:53");
INSERT INTO classes VALUES("4","4ª","1","2023-08-12 19:50:53");
INSERT INTO classes VALUES("5","5ª","1","2023-08-12 19:50:53");
INSERT INTO classes VALUES("6","6ª","1","2023-08-12 19:50:53");
INSERT INTO classes VALUES("7","7ª","2","2023-08-12 19:50:53");
INSERT INTO classes VALUES("8","8ª","2","2023-08-12 19:50:53");
INSERT INTO classes VALUES("9","9ª","2","2023-08-12 19:50:53");
INSERT INTO classes VALUES("10","10ª","3","2023-08-12 19:50:53");
INSERT INTO classes VALUES("11","11ª","3","2023-08-12 19:50:53");
INSERT INTO classes VALUES("12","12ª","3","2023-08-12 19:50:53");
INSERT INTO classes VALUES("13","Pré - B","1","2023-08-12 19:50:53");
INSERT INTO classes VALUES("14","Pré- A","1","2023-08-12 19:50:53");



DROP TABLE IF EXISTS compra;

CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) DEFAULT NULL,
  `idaluno` int(11) DEFAULT NULL,
  `idanolectivo` int(11) NOT NULL DEFAULT 2,
  `iddacompra` int(11) DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `estatus` varchar(30) NOT NULL DEFAULT 'vendido',
  `preco` double NOT NULL DEFAULT 0,
  `quantidade` double NOT NULL DEFAULT 0,
  `entregue` int(11) NOT NULL DEFAULT 0,
  `valorpago` double NOT NULL DEFAULT 0,
  `desconto` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idcompra`),
  KEY `idproduto` (`idproduto`),
  KEY `idcliente` (`idaluno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;
 


DROP TABLE IF EXISTS compras;

CREATE TABLE `compras` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) DEFAULT NULL,
  `obs` varchar(100) DEFAULT '',
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `idfuncionario` int(11) NOT NULL,
  `idatendimento` int(11) DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idcompra`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

INSERT INTO compras VALUES("1","1268","","2023-10-16 05:54:04","31","0","2023-11-06 06:45:26");



DROP TABLE IF EXISTS cursos;

CREATE TABLE `cursos` (
  `idcurso` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO cursos VALUES("1","Nenhum","2023-08-12 19:50:56"); 


DROP TABLE IF EXISTS dadosdaempresa;

CREATE TABLE `dadosdaempresa` (
  `iddadosdaempresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) DEFAULT NULL,
  `servicos` text DEFAULT NULL,
  `numerodecontribuinte` varchar(120) DEFAULT NULL,
  `contabancaria` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `localizacao` text DEFAULT NULL,
  `telefone` text DEFAULT NULL,
  `site` varchar(100) NOT NULL,
  `localizacaoprecisa` varchar(220) DEFAULT NULL,
  `nomedodireitor` varchar(200) NOT NULL DEFAULT 'Esmael Calunga',
  `caminhodologo` varchar(222) DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`iddadosdaempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO dadosdaempresa VALUES("1","Complexo Escolar Arena do Saber","Ensino Primário, Iº e IIº Ciclo e Ensino Secundário","","BIC: 0051.0000.0591.9169.1014.2","","Viana - Luanda, Angola","923848537","","Bairro Jacinto Tchipa, Ciquentinha, Por detrás das roloutes","Augusto Tuta Nguvo","65220fae74ac0.png","2023-10-08 03:10:54");



DROP TABLE IF EXISTS descadastrados;

CREATE TABLE `descadastrados` (
  `iddescadastrado` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL DEFAULT 'Inactivo',
  `descricao` text DEFAULT NULL,
  `data` date NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`iddescadastrado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS disciplinas;

CREATE TABLE `disciplinas` (
  `iddisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `idprofessor` int(11) NOT NULL,
  `idprofessorauxiliar` int(11) NOT NULL DEFAULT 0,
  `idtipodedisciplina` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `abreviatura` varchar(20) DEFAULT NULL,
  `idturma` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `tipodedisciplina` varchar(220) NOT NULL DEFAULT 'Normal',
  `agrupamento` varchar(200) DEFAULT NULL,
  `obs` varchar(220) DEFAULT NULL,
  `estatus` int(2) NOT NULL DEFAULT 1,
  `salarioportempo` double NOT NULL DEFAULT 700,
  `salarioportempoauxiliar` double NOT NULL DEFAULT 500,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`iddisciplina`)
) ENGINE=InnoDB AUTO_INCREMENT=312 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 


DROP TABLE IF EXISTS documentostratados;

CREATE TABLE `documentostratados` (
  `iddocumentotratado` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL DEFAULT 2,
  `tipodedocumento` varchar(50) NOT NULL DEFAULT 'Declaração Sem Notas',
  `preco` double NOT NULL DEFAULT 0,
  `desconto` double NOT NULL DEFAULT 0,
  `valorpago` double NOT NULL DEFAULT 0,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`iddocumentotratado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS entradas;

CREATE TABLE `entradas` (
  `identrada` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `idtipo` int(11) DEFAULT NULL,
  `valor` double NOT NULL DEFAULT 0,
  `divida` double NOT NULL DEFAULT 0,
  `formadepagamento` varchar(200) NOT NULL DEFAULT 'Dinheiro',
  `idaluno` int(11) DEFAULT NULL,
  `idturma` int(11) DEFAULT NULL,
  `datadaentrada` timestamp NOT NULL DEFAULT current_timestamp(),
  `idanolectivo` int(11) DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`identrada`)
) ENGINE=InnoDB AUTO_INCREMENT=7264 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 


DROP TABLE IF EXISTS faltas;

CREATE TABLE `faltas` (
  `idfalta` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `falta` double NOT NULL DEFAULT 0,
  `pago` int(3) NOT NULL DEFAULT 0,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idfalta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS formasdepagamento;

CREATE TABLE `formasdepagamento` (
  `idformadepagamento` int(11) NOT NULL AUTO_INCREMENT,
  `formadepagamento` varchar(220) DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idformadepagamento`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO formasdepagamento VALUES("1","Dinheiro","2023-08-12 19:51:03"); 



DROP TABLE IF EXISTS funcionarios;

CREATE TABLE `funcionarios` (
  `idfuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `nomedofuncionario` varchar(100) NOT NULL,
  `datadenascimento` date DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `telefone` varchar(100) DEFAULT NULL,
  `localizacao` text DEFAULT NULL,
  `naturalidade` varchar(220) DEFAULT NULL,
  `proveniencia` varchar(220) DEFAULT NULL,
  `habilitacoesliterarias` varchar(180) DEFAULT NULL,
  `contabancaria` varchar(80) DEFAULT NULL,
  `datadeentrada` date NOT NULL,
  `salario` double DEFAULT NULL,
  `datadeentradanosistema` datetime NOT NULL DEFAULT current_timestamp(),
  `salarioporhora` double NOT NULL DEFAULT 0,
  `numerodedias` double NOT NULL DEFAULT 22,
  `numerodehoras` double NOT NULL DEFAULT 8,
  `estatus` varchar(11) NOT NULL DEFAULT 'activo',
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `caminhodafoto` varchar(222) DEFAULT NULL,
  `subsideodealimentacao` double DEFAULT 0,
  `subsideodetransporte` double DEFAULT 0,
  PRIMARY KEY (`idfuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO funcionarios VALUES("31","Esmael Calunga","0000-00-00","C.E.O","92924444","",""," ","","","0000-00-00","150000","2021-02-28 14:03:05","852","22","8","activo","2023-10-16 05:09:37","652cb781ad372.png","30000","35000");
 


DROP TABLE IF EXISTS historico;

CREATE TABLE `historico` (
  `idhistorico` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` int(11) NOT NULL,
  `descricao` varchar(90) DEFAULT NULL,
  `antigo` text DEFAULT NULL,
  `novo` text DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idhistorico`),
  KEY `idfuncionario` (`idfuncionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS historico_sincronizacao;

CREATE TABLE `historico_sincronizacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datadasicronizacao` datetime NOT NULL,
  `numeroderegistrossicronizados` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO historico_sincronizacao VALUES("1","2023-11-06 08:11:36","5","2023-11-06 07:12:00");
 


DROP TABLE IF EXISTS impostos;

CREATE TABLE `impostos` (
  `idimposto` int(11) NOT NULL AUTO_INCREMENT,
  `imposto` varchar(100) NOT NULL,
  `incidencia` varchar(100) NOT NULL DEFAULT 'entradas',
  `percentagem` double NOT NULL DEFAULT 0,
  `obs` varchar(220) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idimposto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO impostos VALUES("1","Imposto sobre Venda","entradas","14","","2023-08-12 19:51:08");
INSERT INTO impostos VALUES("2","Imposto sobre Consumo","saidas","3","","2023-08-12 19:51:08");
INSERT INTO impostos VALUES("7","Imposto de Renda","entradas","7"," ","2023-08-12 19:51:08");



DROP TABLE IF EXISTS lembretes;

CREATE TABLE `lembretes` (
  `idlembrete` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text DEFAULT NULL,
  `datadolembrete` date NOT NULL,
  `datadecadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idlembrete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS matriculaseconfirmacoes;

CREATE TABLE `matriculaseconfirmacoes` (
  `idmatriculaeconfirmacao` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `tipodealuno` varchar(50) NOT NULL DEFAULT 'Normal',
  `idanolectivo` int(11) NOT NULL,
  `idturma` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL DEFAULT 'Matrícula',
  `preco` double NOT NULL DEFAULT 0,
  `desconto` double NOT NULL DEFAULT 0,
  `valorpago` double NOT NULL DEFAULT 0,
  `turma` varchar(50) NOT NULL,
  `sala` varchar(50) NOT NULL,
  `curso` varchar(200) NOT NULL,
  `periodo` varchar(50) NOT NULL,
  `classe` varchar(10) NOT NULL,
  `data` date DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `estatus` varchar(200) NOT NULL DEFAULT 'activo',
  `ultimomespago` date NOT NULL,
  `classificacaofinal` varchar(50) NOT NULL DEFAULT 'Sem Classificação',
  `descontoparapropinas` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reconfirmou` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idmatriculaeconfirmacao`)
) ENGINE=InnoDB AUTO_INCREMENT=828 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 


DROP TABLE IF EXISTS matriculatransporte;

CREATE TABLE `matriculatransporte` (
  `idmatriculatransporte` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `idtransporte` int(11) NOT NULL,
  `preco` double NOT NULL DEFAULT 0,
  `desconto` double NOT NULL DEFAULT 0,
  `valorpago` double NOT NULL DEFAULT 0,
  `transporte` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `estatus` varchar(200) NOT NULL DEFAULT 'activo',
  `ultimomespago` date NOT NULL,
  `descontoparapropinas` double NOT NULL DEFAULT 0,
  `tipodealuno` varchar(222) NOT NULL DEFAULT 'Normal',
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idmatriculatransporte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS mediasdoano;

CREATE TABLE `mediasdoano` (
  `idmediadoano` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `tipodeturma` varchar(222) NOT NULL DEFAULT 'Transição',
  `posicao` int(2) NOT NULL,
  `arredondarmedia` int(2) NOT NULL DEFAULT 0,
  `tipodemedia` varchar(100) NOT NULL DEFAULT 'denotas',
  `idmediamaior` int(11) NOT NULL DEFAULT 0,
  `percentagem` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idmediadoano`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO mediasdoano VALUES("2","MT1","11","4","Transição","1","0","denotas","11","0","2023-08-12 19:51:13");
INSERT INTO mediasdoano VALUES("3","MT1","11","4","Exame","1","0","denotas","8","0","2023-08-12 19:51:13");
INSERT INTO mediasdoano VALUES("4","MT2","12","4","Transição","2","0","denotas","11","0","2023-08-12 19:51:13");
INSERT INTO mediasdoano VALUES("5","MT2","12","4","Exame","2","0","denotas","8","0","2023-08-12 19:51:13");
INSERT INTO mediasdoano VALUES("6","MT3","13","4","Transição","5","0","denotas","11","0","2023-08-12 19:51:13");
INSERT INTO mediasdoano VALUES("7","MT3","13","4","Exame","6","0","denotas","8","0","2023-08-12 19:51:13");
INSERT INTO mediasdoano VALUES("8","MFD","13","4","Exame","7","0","demedias","9","0.4","2023-08-12 19:51:13");
INSERT INTO mediasdoano VALUES("9","MF","13","4","Exame","8","0","ponderada","0","0","2023-08-12 19:51:13");
INSERT INTO mediasdoano VALUES("11","MF","13","4","Transição","10","0","demedias","0","0","2023-08-12 19:51:13");



DROP TABLE IF EXISTS metas;

CREATE TABLE `metas` (
  `idmeta` int(11) NOT NULL AUTO_INCREMENT,
  `nomedameta` varchar(100) DEFAULT NULL,
  `sector` varchar(220) DEFAULT '',
  `diainicio` date DEFAULT NULL,
  `diafim` date NOT NULL,
  `valor` double NOT NULL DEFAULT 0,
  `obs` text DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `estatus` varchar(100) NOT NULL DEFAULT 'em andamento',
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idmeta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS notas;

CREATE TABLE `notas` (
  `idnota` int(11) NOT NULL AUTO_INCREMENT,
  `iddisciplina` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `idnotadoano` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT 0,
  `idturma` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idnota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS notasavaliacao;

CREATE TABLE `notasavaliacao` (
  `idnotaavaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `idavaliacao` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idnotaavaliacao`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 



DROP TABLE IF EXISTS notasdoano;

CREATE TABLE `notasdoano` (
  `idnotadoano` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `tipodeturma` varchar(222) NOT NULL DEFAULT 'Transição',
  `posicao` int(3) NOT NULL,
  `tipo` varchar(200) NOT NULL DEFAULT 'normal',
  `idmediaaquepertence` int(11) NOT NULL DEFAULT 0,
  `percentagem` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idnotadoano`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO notasdoano VALUES("2","MAC","11","4","Transição","1","Normal","2","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("3","MAC","11","4","Exame","1","Normal","3","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("4","PP","11","4","Transição","2","Normal","2","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("5","PP","11","4","Exame","2","Normal","3","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("6","PT","11","4","Transição","3","Normal","2","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("7","PT","11","4","Exame","3","Normal","3","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("8","MAC","12","4","Transição","4","Normal","4","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("9","PP","12","4","Transição","5","Normal","4","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("10","PT","12","4","Transição","9","Normal","4","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("11","MAC","13","4","Transição","10","Normal","6","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("12","PP","13","4","Transição","11","Normal","6","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("13","PT","13","4","Transição","12","Normal","6","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("14","MAC","12","4","Exame","13","Normal","5","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("15","PP","12","4","Exame","14","Normal","5","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("16","PT","12","4","Exame","15","Normal","5","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("17","MAC","13","4","Exame","16","Normal","7","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("18","PP","13","4","Exame","17","Normal","7","0","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("19","NE","13","4","Exame","18","Exame","9","0.6","2023-08-12 19:53:01");
INSERT INTO notasdoano VALUES("20","NER","13","4","Exame","19","Recurso","0","0","2023-08-12 19:53:01");



DROP TABLE IF EXISTS periodos;

CREATE TABLE `periodos` (
  `idperiodo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idperiodo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO periodos VALUES("1","Manhã","2023-08-12 19:53:03");
INSERT INTO periodos VALUES("2","Tarde","2023-08-12 19:53:03");



DROP TABLE IF EXISTS presenca;

CREATE TABLE `presenca` (
  `idfalta` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` int(11) NOT NULL,
  `ano` int(4) NOT NULL,
  `dia` int(3) NOT NULL,
  `mes` int(3) NOT NULL,
  `falta` varchar(4) DEFAULT NULL,
  `horastrabalhadas` double NOT NULL DEFAULT 0,
  `horasextras` double NOT NULL DEFAULT 0,
  `remunerar` int(2) NOT NULL DEFAULT 1,
  `salariopordia` double NOT NULL DEFAULT 0,
  `salariopelahorasextras` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idfalta`),
  KEY `idfuncionario` (`idfuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 


DROP TABLE IF EXISTS presencaprofessores;

CREATE TABLE `presencaprofessores` (
  `idpresencaprofessor` int(11) NOT NULL AUTO_INCREMENT,
  `idprofessor` int(11) NOT NULL,
  `diadapresenca` date NOT NULL,
  `totaldetempos` double NOT NULL DEFAULT 0,
  `salarioportempo` double NOT NULL DEFAULT 0,
  `iddisciplina` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idpresencaprofessor`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 



DROP TABLE IF EXISTS produtos;

CREATE TABLE `produtos` (
  `idproduto` int(11) NOT NULL AUTO_INCREMENT,
  `nomedoproduto` varchar(100) NOT NULL,
  `preco` double NOT NULL DEFAULT 0,
  `precodecompra` double NOT NULL DEFAULT 0,
  `quantidade` double NOT NULL DEFAULT 0,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `datadeexpiracao` date DEFAULT NULL,
  `ultimavenda` date DEFAULT NULL,
  `estatus` varchar(30) NOT NULL DEFAULT 'operacional',
  `stockminimo` int(11) NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

INSERT INTO produtos VALUES("1","Uniforme Polo","7000","4000","217","2022-10-07 14:47:10","0000-00-00","2023-10-16","operacional","20","2023-10-16 05:54:05");
INSERT INTO produtos VALUES("2","Calção","6000","3500","15","2022-11-08 10:02:05","0000-00-00","2023-10-16","operacional","10","2023-10-16 05:54:05");
INSERT INTO produtos VALUES("3","Saia","6000","3500","23","2022-11-08 10:02:33","0000-00-00","2023-01-31","operacional","10","2023-08-12 19:53:11");
INSERT INTO produtos VALUES("4","Folha de Prova","75","30","5499","2022-12-05 01:37:04","0000-00-00","2023-05-08","operacional","50","2023-08-12 19:53:11");



DROP TABLE IF EXISTS propinas;

CREATE TABLE `propinas` (
  `idpropina` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `preco` double NOT NULL DEFAULT 0,
  `multa` double NOT NULL DEFAULT 0,
  `valorpago` double NOT NULL DEFAULT 0,
  `desconto` double NOT NULL DEFAULT 0,
  `mespago` date NOT NULL,
  `datadopagamento` timestamp NOT NULL DEFAULT current_timestamp(),
  `obs` varchar(220) NOT NULL,
  `codigodepropina` varchar(200) NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `datadedeposito` date DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idpropina`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 

DROP TABLE IF EXISTS propinasdoatl;

CREATE TABLE `propinasdoatl` (
  `idpropinadoatl` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaatl` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `preco` double NOT NULL DEFAULT 0,
  `multa` double NOT NULL DEFAULT 0,
  `valorpago` double NOT NULL DEFAULT 0,
  `desconto` double NOT NULL DEFAULT 0,
  `mespago` date NOT NULL,
  `datadopagamento` timestamp NOT NULL DEFAULT current_timestamp(),
  `obs` varchar(220) NOT NULL,
  `codigodepropina` varchar(200) NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `datadedeposito` date NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idpropinadoatl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS propinasdotransporte;

CREATE TABLE `propinasdotransporte` (
  `idpropinadotransporte` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculatransporte` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `preco` double NOT NULL DEFAULT 0,
  `multa` double NOT NULL DEFAULT 0,
  `valorpago` double NOT NULL DEFAULT 0,
  `desconto` double NOT NULL DEFAULT 0,
  `mespago` date NOT NULL,
  `datadopagamento` timestamp NOT NULL DEFAULT current_timestamp(),
  `obs` varchar(220) NOT NULL,
  `codigodepropina` varchar(200) NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `datadedeposito` date NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idpropinadotransporte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS relatoriodiario;

CREATE TABLE `relatoriodiario` (
  `idrelatoriodiario` int(11) NOT NULL AUTO_INCREMENT,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `data` date NOT NULL,
  `idprofessor` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idrelatoriodiario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS saidas;

CREATE TABLE `saidas` (
  `idsaida` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` int(11) DEFAULT NULL,
  `descricao` varchar(220) DEFAULT NULL,
  `tipo` varchar(60) DEFAULT NULL,
  `valor` double NOT NULL DEFAULT 0,
  `divida` double NOT NULL DEFAULT 0,
  `datadasaida` datetime NOT NULL DEFAULT current_timestamp(),
  `idtipo` int(11) DEFAULT NULL,
  `idanolectivo` int(11) NOT NULL DEFAULT 2,
  `formadesaida` varchar(200) NOT NULL DEFAULT 'Dinheiro',
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idsaida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS salario;

CREATE TABLE `salario` (
  `idsalario` int(11) NOT NULL AUTO_INCREMENT,
  `idfuncionario` int(11) NOT NULL,
  `ano` int(4) DEFAULT NULL,
  `mes` int(2) DEFAULT NULL,
  `faltas` int(3) NOT NULL DEFAULT 0,
  `horastrabalhadas` int(11) DEFAULT NULL,
  `salarioactualporhora` double DEFAULT 0,
  `salarioactualbase` double NOT NULL DEFAULT 0,
  `salariobruto` double NOT NULL DEFAULT 0,
  `horasextras` int(11) DEFAULT NULL,
  `valorextra` double DEFAULT NULL,
  `abonodefamilia` double NOT NULL DEFAULT 0,
  `subsidiodeferias` double NOT NULL DEFAULT 0,
  `subsidiodenatal` double NOT NULL DEFAULT 0,
  `segurancasocial` double NOT NULL DEFAULT 0,
  `valorporreceber` double DEFAULT NULL,
  `irt` double DEFAULT NULL,
  `valorrecebido` double DEFAULT NULL,
  `formapagamento` varchar(130) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `datadepagamento` datetime NOT NULL DEFAULT current_timestamp(),
  `idnasaida` int(11) NOT NULL,
  `outrosdescontos` double NOT NULL DEFAULT 0,
  `idposto` int(11) NOT NULL DEFAULT -1,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idsalario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS salas;

CREATE TABLE `salas` (
  `idsala` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idsala`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO salas VALUES("1","1","2023-08-12 20:08:20");
INSERT INTO salas VALUES("2","2","2023-08-12 20:08:20");
INSERT INTO salas VALUES("3","3","2023-08-12 20:08:20");
INSERT INTO salas VALUES("4","4","2023-08-12 20:08:20");
INSERT INTO salas VALUES("5","5","2023-08-12 20:08:20");
INSERT INTO salas VALUES("6","6","2023-08-12 20:08:20");
INSERT INTO salas VALUES("7","7","2023-08-12 20:08:20");
INSERT INTO salas VALUES("8","8","2023-08-12 20:08:20");
INSERT INTO salas VALUES("9","9","2023-08-12 20:08:20");
INSERT INTO salas VALUES("10","10","2023-08-12 20:08:20");
INSERT INTO salas VALUES("11","11","2023-08-12 20:08:20");
INSERT INTO salas VALUES("12","12","2023-08-12 20:08:20");
INSERT INTO salas VALUES("13","13","2023-08-12 20:08:20");
INSERT INTO salas VALUES("14","14","2023-08-12 20:08:20");
INSERT INTO salas VALUES("15","15","2023-08-12 20:08:20");
INSERT INTO salas VALUES("16","16","2023-08-12 20:08:20");
INSERT INTO salas VALUES("17","17","2023-08-12 20:08:20");



DROP TABLE IF EXISTS stock;

CREATE TABLE `stock` (
  `idstock` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) NOT NULL,
  `precodevenda` double NOT NULL DEFAULT 0,
  `precodecompra` double NOT NULL DEFAULT 0,
  `quantidade` int(8) NOT NULL DEFAULT 0,
  `datadecadastro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idstock`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 

DROP TABLE IF EXISTS tipodedisciplinas;

CREATE TABLE `tipodedisciplinas` (
  `idtipodedisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `abreviatura` varchar(20) DEFAULT NULL,
  `tipodedisciplina` varchar(220) NOT NULL DEFAULT 'Normal',
  `agrupamento` varchar(200) DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idtipodedisciplina`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tipodedisciplinas VALUES("1","Matemática","MAT","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("2","Física","FIS","Chave","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("3","Biologia","BIO","Chave","Formação Específica","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("4","Química","QUIM","Normal","Formação Específica","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("5","Inglês","ING","Normal","Opção","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("6","Educação Física","Ed. Física","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("7","Língua Portuguesa ","L. Port","Chave","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("8","Estudo do Meio","Est. Meio","Chave","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("9","Geometria Descritiva","Geom. Desc","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("10","Geologia","Geol","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("11","Geografia","Geog","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("12","Ciência da Natureza","C. Natureza","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("13","Informática","Informática","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("14","Empreendedorismo","EMP","Normal","Opção","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("15","Educação Moral e Cívica","E.M.C","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("16","Educação Visual e Plastica","E.V.P","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("17","Educação Manual e Plastica","E.M.P","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("18","História","Histo","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("19","Direito","DRT","Chave","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("20","Economia","ECON","Chave","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("21","Densenvolvimento ","DES","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("22","Filosofia","FILOS","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("23","Sociologia","SOCIOL","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("24","Educação Musical","Ed. Musical","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("25","Estudo do Meio Físico","E.M.F","Normal","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("26","Representação Matemática","R. Mat","Chave","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("27","Comunicação Linguística","C.Linguística","Chave","Formação Geral","2023-08-12 20:08:23");
INSERT INTO tipodedisciplinas VALUES("28","Educação Laboral","Ed. Lab","Normal","Formação Geral","2023-08-12 20:08:23");



DROP TABLE IF EXISTS tipodesaidas;

CREATE TABLE `tipodesaidas` (
  `idtipodesaida` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(220) NOT NULL,
  `categoria` varchar(200) NOT NULL DEFAULT 'Custos Variados',
  `numerodesaida` int(11) NOT NULL DEFAULT 0,
  `valorlimite` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idtipodesaida`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tipodesaidas VALUES("1","Salário","Gastos com o Pessoal","11","500000","2023-08-12 20:08:24");
INSERT INTO tipodesaidas VALUES("2","Energia","Custos Variados","4","8000","2023-08-12 20:08:24"); 
INSERT INTO tipodesaidas VALUES("4","Aluguer","Custos Variados","2","12000","2023-08-12 20:08:24");
INSERT INTO tipodesaidas VALUES("5","Alimentação","Custos Variados","23","100000","2023-08-12 20:08:24");
INSERT INTO tipodesaidas VALUES("6","Empréstimos","Gastos com o Pessoal","1","50000","2023-08-12 20:08:24");



DROP TABLE IF EXISTS tiposdenotas;

CREATE TABLE `tiposdenotas` (
  `idtipodenota` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `percentagemnotrimestre` double NOT NULL DEFAULT 0.5,
  `posicao` int(2) NOT NULL DEFAULT 1,
  `especial` int(1) NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idtipodenota`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tiposdenotas VALUES("1","MAC","0","1","0.33","1","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("2","PP   ","0","1","0.33","2","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("3","MAC","0","2","0.33","3","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("4","CPP","0","2","0.33","4","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("5","MAC","0","3","0.3","5","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("6","CPP","0","3","0.3","6","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("9","CPP","0","7","0.3","2","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("10","MAC","0","6","0.3","1","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("11","CPP","0","6","0.3","2","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("12","MAC","0","5","0.3","1","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("13","CPP","0","5","0.3","2","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("15","CPE","2","0","0.6","1","1","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("16","NER","2","0","1","2","1","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("17","PT","2","3","0.4","9","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("18","PT","2","2","0.34","6","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("19","PT","2","1","0.34","3","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("20"," MAC   ","4","13","0.3","1","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("21"," NPP   ","4","13","0.3","2","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("22"," NPT   ","4","13","0.4","3","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("23","MAC","4","12","0.3","1","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("24","NPP","4","12","0.3","2","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("25","NPT","4","12","0.4","3","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("26","MAC","4","11","0.3","1","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("27","NPP","4","11","0.3","2","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("28","NPT","4","11","0.4","3","0","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("29","NE","4","0","0.6","1","1","2023-08-12 20:08:25");
INSERT INTO tiposdenotas VALUES("30","MF","4","0","1","2","1","2023-08-12 20:08:25");



DROP TABLE IF EXISTS transportes;

CREATE TABLE `transportes` (
  `idtransporte` int(11) NOT NULL AUTO_INCREMENT,
  `idanolectivo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `propina` double NOT NULL DEFAULT 0,
  `matricula` double NOT NULL DEFAULT 0,
  `pessoal` varchar(252) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idtransporte`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 


DROP TABLE IF EXISTS trimestres;

CREATE TABLE `trimestres` (
  `idtrimestre` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  `numerodenotas` int(4) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `nomedamedia` varchar(6) NOT NULL,
  `arredondarmedia` int(1) NOT NULL DEFAULT 2,
  `percentagemnoanolectivo` double NOT NULL DEFAULT 0.33,
  `posicao` int(1) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idtrimestre`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO trimestres VALUES("1","Iº","3","2","MT1","0","0.33","1","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("2","IIº","3","2","MT2","0","0.33","2","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("3","IIIº","3","2","MT3","0","0.33","3","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("5","Iº","2","1","CT1","0","0.33","1","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("6","IIº","2","1","CT2","0","0.33","2","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("7","IIIº","2","1","CT3","0","0.33","3","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("8","Iº","2","3","CT1","0","0.33","1","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("9","IIº","2","3","CT2","0","0.33","2","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("10","IIIº","2","3","CT3","0","0.33","3","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("11","Iº","5","4","MT1","0","0.33","1","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("12","IIº","5","4","MT2","0","0.33","2","2023-08-12 20:08:28");
INSERT INTO trimestres VALUES("13","IIIº","5","4","MT3","0","0.34","3","2023-08-12 20:08:28");



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
  `propina` double NOT NULL DEFAULT 0,
  `reconfirmacao` double NOT NULL DEFAULT 0,
  `matricula` double NOT NULL DEFAULT 0,
  `eclassedeexame` varchar(11) NOT NULL DEFAULT 'Não',
  `minimoparapositiva` double NOT NULL DEFAULT 10,
  `valormaximo` double NOT NULL DEFAULT 20,
  `valorminimo` double NOT NULL DEFAULT 0,
  `classificacaopositiva` varchar(50) NOT NULL DEFAULT 'Apto',
  `classificacaonegativa` varchar(50) NOT NULL DEFAULT 'Não Apto',
  `idcoordenador` int(11) NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idturma`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
 