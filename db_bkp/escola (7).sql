-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3333
-- Tempo de geração: 22/10/2023 às 08:11
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escola`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradores`
--

CREATE TABLE `administradores` (
  `idadministrador` int(11) NOT NULL,
  `idfuncionario` varchar(11) NOT NULL,
  `painel` varchar(120) NOT NULL DEFAULT 'funcionario',
  `username` varchar(100) NOT NULL,
  `senha` varchar(260) NOT NULL,
  `acesso` varchar(90) NOT NULL DEFAULT 'desbloqueado',
  `ultimoacesso` datetime DEFAULT NULL,
  `horadodeslogue` datetime DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `administradores`
--

INSERT INTO `administradores` (`idadministrador`, `idfuncionario`, `painel`, `username`, `senha`, `acesso`, `ultimoacesso`, `horadodeslogue`, `data_modificacao`) VALUES
(13, '44', 'secretaria1', 'joana', '$2y$10$bE.DbgFr0r6Ul30H8l.A1uML6cNJnZoH0rmFzSgDV49A9fMdhg8Vq', 'desbloqueado', '2023-05-08 15:10:42', '2023-02-27 13:33:23', '2023-08-12 18:50:43'),
(14, '45', 'areapedagogica', 'floide', '$2y$10$3AgFKcaE6TeV2AuxpsL/Aee4gIkQCZ6DHKuwzz0YUxDemtqWSifrO', 'desbloqueado', '2008-01-01 00:03:23', '2023-01-11 11:37:19', '2023-08-12 18:50:43'),
(15, '43', 'administrador', 'tamara', '$2y$10$dY6JdQU4uzO9YC27wy045OrgmAOitvQyknClJow8pY81BNNDoKLPS', 'desbloqueado', '2007-12-31 23:02:53', '2007-12-31 23:24:28', '2023-08-12 18:50:43'),
(16, '31', 'administrador', 'esmael00', '$2y$10$EWQps2A4ziwed3hftU/YUehGlANnJ9Pxm/fouCvf9pSmTIfk7Ekja', 'desbloqueado', '2023-10-08 02:31:59', '2023-10-08 02:31:39', '2023-10-08 01:31:59'),
(17, '47', 'professor', '123', '$2y$10$6PLakV.bfhkzkbE/JSwFQufXvrmidHWaUtsiGhNojEBuhbn9tD4uu', 'desbloqueado', '2023-01-11 11:30:07', '2023-01-11 11:32:24', '2023-08-12 18:50:43'),
(18, '31', 'professor', '000', '$2y$10$it31/CoR0iFplZkxTT8VBe4cjoEttFnLqXIhBo6RVjBHHsd6dphSS', 'desbloqueado', '2023-07-25 13:29:59', '2023-07-27 05:52:09', '2023-08-12 18:50:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradoresalunos`
--

CREATE TABLE `administradoresalunos` (
  `idadministradoraluno` int(11) NOT NULL,
  `idmatriculaconfirmacao` varchar(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `painel` varchar(120) NOT NULL DEFAULT 'funcionario',
  `username` varchar(100) NOT NULL,
  `senha` varchar(260) NOT NULL,
  `acesso` varchar(90) NOT NULL DEFAULT 'desbloqueado',
  `ultimoacesso` datetime DEFAULT NULL,
  `horadodeslogue` datetime DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `administradoresalunos`
--

INSERT INTO `administradoresalunos` (`idadministradoraluno`, `idmatriculaconfirmacao`, `idaluno`, `painel`, `username`, `senha`, `acesso`, `ultimoacesso`, `horadodeslogue`, `data_modificacao`) VALUES
(19, '818', 1304, 'aluno', '666', '$2y$10$EWQps2A4ziwed3hftU/YUehGlANnJ9Pxm/fouCvf9pSmTIfk7Ekja', 'desbloqueado', '2023-10-03 16:18:38', '0000-00-00 00:00:00', '2023-10-03 15:18:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `idagenda` int(11) NOT NULL,
  `nomedaactividade` varchar(220) DEFAULT NULL,
  `datainicio` date DEFAULT NULL,
  `datafim` date DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `obs` varchar(220) DEFAULT NULL,
  `horainicio` time DEFAULT NULL,
  `horafim` time DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `idaluno` int(11) NOT NULL,
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
  `nifencarregado` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`idaluno`, `nomecompleto`, `sexo`, `nomedopai`, `nomedamae`, `naturalidade`, `nacionalidade`, `provincia`, `numerodobioucedula`, `arquivodeidentificacao`, `deficiencia`, `escoladeorigem`, `telefone`, `telefoneincarregados`, `profissao`, `email`, `anodeentrada`, `datadenascimento`, `datadeexpiracaodobi`, `numerodeprocesso`, `morada`, `religiao`, `nomedoencarregado`, `datadecadastro`, `estatus`, `obs`, `data_modificacao`, `caminhodafoto`, `nifencarregado`) VALUES
(1144, 'Kembi Elizabeth Feliciana Kuluca', 'Femenino', 'Lucombo André Kuluca', 'Graça Isabel Feliciano', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '922038640', '', '', 2022, '2017-05-29', '0000-00-00', 358, '', '', 'Lucombo André Kuluca', '2022-08-29 10:39:56', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1145, 'Elizandra Guia Francisco José', 'Femenino', 'Zinho Francisco José', 'Ruth Domingos Manuel Guia', 'Catete', 'Angolana', 'Luanda', '010104149BO040', 'Luanda', '', '', '', '924883086/924628633', '', '', 2022, '2010-02-05', '2024-03-25', 359, '', '', 'Zinho Francisco José', '2022-08-29 10:43:57', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1146, 'Inácia Madalena B. Rocha', 'Femenino', 'Assunção da Rocha', 'Domingas A. da Rocha', 'Luanda', 'Angolana', 'Luanda', '3282', 'Luanda', '', '', '', '923455248', '', '', 2022, '2006-10-22', '0000-00-00', 360, '', '', 'Assunção da Rocha', '2022-08-29 10:56:47', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1147, 'Trausio Chimbungule Hebo', 'Masculino', 'Mateus Manuel Hebo', 'Albertina Domingos Chimbungule', 'Ingombota', 'Angolana', 'Luanda', '009545587LA041', 'Luanda', '', '', '', '927559381', '', '', 2022, '2010-09-21', '2023-07-10', 361, '', '', 'Mateus Manuel Hebo', '2022-08-29 11:04:27', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1148, 'António José Chico', 'Masculino', 'Rofino Chico', 'Julieta José', 'Viana', 'Angolana', 'Luanda', '023726862LA051', 'Luanda', '', '', '', '925828235', '', '', 2022, '2002-02-06', '0000-00-00', 362, '', '', 'Rofino Chico', '2022-08-29 11:08:28', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1149, 'Laura Pontes dos Santos', 'Femenino', 'Manuel António dos Santos', 'Ana Maria S. S. Pontes', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '932112149/927633740', '', '', 2022, '2014-10-08', '0000-00-00', 365, '', '', 'Manuel António dos Santos', '2022-08-31 09:34:02', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1150, 'Anacleto Pontes dos Santos', 'Masculino', 'Manuel António os Santos', 'Ana Maria Sebastião de Sousa Pontes', 'Cazenga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '932112149/927633740', '', '', 2022, '2009-09-08', '0000-00-00', 366, '', '', 'Manuel António os Santos', '2022-08-31 09:37:06', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1151, 'Jocelina Miguel Manuel', 'Femenino', 'Nelson Sebastião Manuel', 'Filomena Miguel Manuel', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '924649293', '', '', 2022, '0000-00-00', '0000-00-00', 379, '', '', 'Nelson Sebastião Manuel', '2022-08-31 14:20:59', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1152, 'Karina Vunge Bembuca', 'Femenino', 'Gouveia André Bembuca', 'Jorgina Nazareth Vunge', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923885645/922520380', '', '', 2022, '2017-03-28', '0000-00-00', 381, '', '', 'Gouveia André Bembuca', '2022-08-31 14:30:21', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1153, 'Kerubim Suzana K. Pedro', 'Masculino', 'Makizayila Z. Pedro', 'Nsangu Kisoka', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '941938629', '', '', 2022, '2013-06-22', '0000-00-00', 383, '', '', 'Makizayila Z. Pedro', '2022-08-31 14:55:30', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1154, 'Maria Imaculada Luis Hossi', 'Femenino', 'Faustino Chico', 'Isabel Luisa', 'Ingombota', 'Angolana', 'Luanda', '004978992LA046', 'Luanda', '', '', '', '9279945/931292880', '', '', 2022, '2002-08-17', '2026-09-20', 384, '', '', 'Faustino Chico', '2022-08-31 15:06:53', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1155, 'Ventura Mucombe José Domingos', 'Masculino', 'António José Domingos', 'Domingas Soares Mucombe', 'Kunda dia Baze', 'Angolana', '', '', 'Luanda', '', '', '', '923208822', '', '', 2022, '2007-02-26', '0000-00-00', 386, '', '', 'António José Domingos', '2022-08-31 15:12:59', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1156, 'Evanilda Garcia João', 'Femenino', 'Edson Quingongo P. João', 'Engrácia da Costa Garcia', 'Ingombota', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '943823084/', '', '', 2022, '2012-03-12', '0000-00-00', 399, '', '', 'Edson Quingongo P. João', '2022-09-01 16:32:39', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1157, 'Bruno Garcia João', 'Masculino', 'Edson Quingongo Policarpo João', 'Engrácia da Costa Garcia', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '943823084', '', '', 2022, '2017-07-16', '0000-00-00', 400, '', '', 'Edson Quingongo Policarpo João', '2022-09-01 16:39:39', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1158, 'Edgar Lumbo Nhanga', 'Masculino', 'Manuel Nhanga', 'Marquinha António Lumbo', 'Cazenga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '', '', '', 2022, '2010-01-27', '0000-00-00', 401, '', '', 'Manuel Nhanga', '2022-09-01 16:43:44', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1159, 'Alberto Raul Cawende', 'Masculino', 'Raul Cawende', 'Filomena Alberto', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '941394680', '', '', 2022, '2006-09-24', '0000-00-00', 402, '', '', 'Raul Cawende', '2022-09-01 16:46:38', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1160, 'Celma Sapalo Domingos', 'Femenino', 'Francisco Silvano Domingos', 'Helena Quaresma F. Sapalo', 'Maianga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '926041034', '', '', 2022, '2011-08-20', '0000-00-00', 404, '', '', 'Francisco Silvano Domingos', '2022-09-01 16:58:22', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1161, 'Eugénio Gabriel Manuel da Silva', 'Masculino', 'Jorge Manuel da Silva', 'Gizela Filomena José Manuel', '', 'Angolana', '', '', 'Luanda', '', '', '', '923323795', '', '', 2022, '0000-00-00', '0000-00-00', 407, '', '', 'Jorge Manuel da Silva', '2022-09-01 17:52:17', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1162, 'Fláviano Mbuco Cololo', 'Masculino', 'Victor Osvaldo Cololo', 'Josefina Congolo Mbuco', 'Kilamba Kiaxi', 'Angolana', '', '', 'Luanda', '', '', '', '926875148/927988424', '', '', 2022, '2015-12-19', '0000-00-00', 413, '', '', 'Victor Osvaldo Cololo', '2022-09-01 18:46:39', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1163, 'Lúria Júlio de Almeida', 'Femenino', 'Arão Chitunda de Almeida', 'Lucinda José Júlio', 'Viana', 'Angolana', '', '', 'Luanda', '', '', '', '934353037', '', '', 2022, '2012-12-02', '0000-00-00', 424, '', '', 'Arão Chitunda de Almeida', '2022-09-01 19:37:59', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1164, 'Gabriel Kimuanga Calanzangi', 'Masculino', 'Diogo António Calazangi', 'Elisa M. Calazangi', 'Luanda', 'Angolana', '', '', 'Luanda', '', '', '', '944947362', '', '', 2022, '0000-00-00', '0000-00-00', 425, '', '', 'Diogo António Calazangi', '2022-09-01 19:42:53', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1165, 'Jacira Manuel Londa', 'Femenino', '.........................', 'Marcelina António Manuel Londa', 'Soyo', 'Angolana', 'Zaire', '010182920ZE043', 'Luanda', '', '', '', '938516950', '', '', 2022, '2007-07-06', '2024-05-15', 426, '', '', '.........................', '2022-09-01 19:46:57', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1166, 'Denise Yasmim K. Calanzange', 'Femenino', 'Diogo António Calazangi', 'Elisa M. Calanzangi', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '944947362', '', '', 2022, '2017-04-12', '0000-00-00', 427, '', '', 'Diogo António Calazangi', '2022-09-01 19:50:21', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1167, 'Andreia Kimuanza Calazangi', 'Femenino', 'Diogo António Calazangi', 'Elisa M. Calanzangi', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '944947362', '', '', 2022, '2009-05-20', '0000-00-00', 428, '', '', 'Diogo António Calazangi', '2022-09-01 19:52:53', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1168, 'Antonio Luboco Mafuta', 'Masculino', 'António Mafuta', 'Nkuna Luzizila Regina', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '945253814', '', '', 2022, '2015-05-22', '0000-00-00', 429, '', '', 'António Mafuta', '2022-09-01 19:56:14', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1169, 'Emanuel João Mussassa', 'Masculino', 'Lucas Felix Mussassa', 'Adelina Carlos João', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '924463062', '', '', 2022, '0000-00-00', '0000-00-00', 430, '', '', 'Lucas Felix Mussassa', '2022-09-01 20:00:34', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1170, 'Florinda Adriano Correia', 'Femenino', 'António Paulo Correia', 'Feliciana Luis Adriano', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '938789470', '', '', 2022, '2006-09-29', '0000-00-00', 431, '', '', 'António Paulo Correia', '2022-09-01 20:03:52', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1171, 'Eliezer Domingos Jerónimo', 'Masculino', 'Cassule Diogo Jerónimo', 'Maria W. Domingos Jerónimo', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '928647191', '', '', 2022, '2017-02-11', '0000-00-00', 433, '', '', 'Cassule Diogo Jerónimo', '2022-09-01 20:11:06', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1172, 'Marcelina Dovales Gongo', 'Femenino', 'Sebastião da Silva Gongo', 'Filomena Maria António Dovales', 'Malanje', 'Angolana', 'Malanje', '020245262ME058', 'Luanda', '', '', '', '936228283', '', '', 2022, '2004-10-01', '2024-10-27', 439, '', '', 'Sebastião da Silva Gongo', '2022-09-07 08:55:52', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1173, 'Madruga dos Santos Monteiro', 'Masculino', 'Fernandes Monteiro', 'Santa Luís dos Santos', 'Cuanza Norte', 'Angolana', '', '008867581KN044', 'Luanda', '', '', '', '931838171', '', '', 2022, '2007-08-27', '2022-05-08', 440, '', '', 'Fernandes Monteiro', '2022-09-07 09:01:06', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1174, 'Edgar Joaquim Eduardo', 'Masculino', 'José Francisco António Eduardo', 'Núria Cardoso de Matos Joquim', 'Ingombotas', 'Angolana', 'Luanda', '007646069LA040', 'Luanda', '', '', '', '940753948', '', '', 2022, '2009-05-22', '2026-10-14', 441, '', '', 'José Francisco António Eduardo', '2022-09-07 09:08:33', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1175, 'Irineu Miguel Garcia', 'Masculino', 'Germano de Sousa Garcia', 'Indira Francisca Miguel', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '935502684', '', '', 2022, '2013-04-17', '0000-00-00', 442, '', '', 'Germano de Sousa Garcia', '2022-09-07 09:21:48', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1176, 'Herculano Enzo Bernardo Manuel', 'Masculino', 'Nelson Job Mariano Manuel', 'Denise da Conceição B. Manuel', 'Ingombotas', 'Angolana', 'Luanda', '022043792LA053', 'Luanda', '', '', '', '923768069', '', '', 2022, '2008-10-11', '2026-06-13', 446, '', '', 'Nelson Job Mariano Manuel', '2022-09-07 09:36:01', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1177, 'Elton José Cafuça Catenda', 'Masculino', 'José Catenda', 'Inês A. Catenda', 'Maianga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923248304', '', '', 2022, '0000-00-00', '0000-00-00', 448, '', '', 'José Catenda', '2022-09-07 09:53:48', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1178, 'Marcolino Cahiata Masseca', 'Masculino', 'Lucas António', 'Emília Paula Cahiata', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '921477253', '', '', 2022, '2012-02-06', '0000-00-00', 456, '', '', 'Lucas António', '2022-09-07 10:20:48', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1179, 'Soraya de Lemos Miguel', 'Femenino', 'João Maria Miguel', 'Maria Ana Xiquete de Lemos', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '951512310', '', '', 2022, '2017-11-12', '0000-00-00', 462, '', '', 'João Maria Miguel', '2022-09-07 10:53:24', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1180, 'Mauricio de Goveia Leite Dias', 'Masculino', 'Sérgio António L. Dias', 'Maria Ribeiro de G. Dias', 'Viana', 'Angolana', '', '009889699LA042', 'Luanda', '', '', '', '924318659', '', '', 2022, '2006-03-25', '2023-12-19', 464, '', '', 'Sérgio António L. Dias', '2022-09-07 11:01:37', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1181, 'Celmira de Goveia Leite Dias', 'Femenino', 'Sérgio António L. Dias', 'Maria Ribeiro de Goveia Leite', 'Sambinzanga', 'Angolana', 'Luanda', '009889309A045', 'Luanda', '', '', '', '924318659', '', '', 2022, '0000-00-00', '2023-12-19', 469, '', '', 'Sérgio António L. Dias', '2022-09-07 11:21:51', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1182, 'Gabriel Breganha  Quibato', 'Masculino', 'Manuel F. Quibato', 'Luzia Kimbundo S. Breganha', 'Viana', 'Angolana', '', '', 'Luanda', '', '', '', '923552160', '', '', 2022, '2016-04-26', '0000-00-00', 480, '', '', 'Manuel F. Quibato', '2022-09-07 11:55:30', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1183, 'Joelma Ebenesia Curimenha', 'Femenino', '...................................', 'Benedita Maria Curimenha', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '010281871LA043', 'Luanda', '', '', '', '924704793', '', '', 2022, '2011-08-15', '2024-06-30', 484, '', '', '...................................', '2022-09-07 12:11:45', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1184, 'Rita Maria Curimenha', 'Femenino', '.................................', 'Benedita Maria Curimenha', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '010257265LA046', 'Luanda', '', '', '', '924704793', '', '', 2022, '2009-05-04', '2024-06-21', 485, '', '', '.................................', '2022-09-07 12:23:51', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1185, 'Lúcia da Graça A. Cassua', 'Femenino', 'Emanuel de Jesus Cassua', 'Catarina Daniela Augustinho', 'Cazenga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '925499999', '', '', 2022, '0000-00-00', '0000-00-00', 487, '', '', 'Emanuel de Jesus Cassua', '2022-09-07 12:33:16', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1186, 'Osvaldo de Jesus Curimenha', 'Femenino', '........................', 'Bendita Maria Curimenha', 'Golf', 'Angolana', 'Luanda', '008908117LA044', 'Luanda', '', '', '', '945834282', '', '', 2022, '2005-04-23', '2027-06-08', 489, '', '', '........................', '2022-09-07 12:56:19', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1187, 'Fabio Júnior António Dike', 'Masculino', 'Patrick O. Dike', 'Tânia Faustino António', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '931391325', '', '', 2022, '2015-05-25', '0000-00-00', 492, '', '', 'Patrick O. Dike', '2022-09-07 13:12:10', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1188, 'Manuela Francisco António', 'Femenino', 'Manuel António Diogo Mateus', 'Leonor E. Pedro Francisco', 'Maianga', 'Angolana', '', '', 'Luanda', '', '', '', '947775145', '', '', 2022, '2011-08-24', '0000-00-00', 493, '', '', 'Manuel António Diogo Mateus', '2022-09-07 13:16:07', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1189, 'Elizandro Domingos Noé', 'Masculino', 'Eduardo Francisco C. Noé', 'Cevardina Joaquim Domingos', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '948478160', '', '', 2022, '2017-07-17', '0000-00-00', 495, '', '', 'Eduardo Francisco C. Noé', '2022-09-07 13:26:10', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1190, 'Judith Nicolau Mendes', 'Femenino', 'Domingos Mendes', 'Teresa Nicolau', '', 'Angolana', '', '', 'Luanda', '', '', '', '925674399', '', '', 2022, '2022-09-02', '0000-00-00', 496, '', '', 'Domingos Mendes', '2022-09-07 15:51:11', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1191, 'Célio Sebastião Bento Caboco', 'Masculino', 'Alexandre Sebastião Caboco', 'Heslania da Conceição R. Bento', 'Cazenga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923636182', '', '', 2022, '2011-08-21', '0000-00-00', 501, '', '', 'Alexandre Sebastião Caboco', '2022-09-07 16:22:37', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1192, 'Augusta Ferreira Ginga', 'Femenino', 'Nelson Luis Fernandes', 'Luzia Maria Agostinho', '', 'Angolana', '', '', 'Luanda', '', '', '', '943979073/941906578', '', '', 2022, '2017-10-07', '0000-00-00', 503, '', '', 'Nelson Luis Fernandes', '2022-09-07 16:27:21', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1193, 'João Ferreira Ginga', 'Masculino', 'Nelson Luis Fernandes', 'Luzia Maria Agostinho', '', 'Angolana', '', '', 'Luanda', '', '', '', '943979073/941906578', '', '', 2022, '2016-02-29', '0000-00-00', 504, '', '', 'Nelson Luis Fernandes', '2022-09-07 16:29:33', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1194, 'Manuela Celestino Paulino Gonsalveis', 'Femenino', 'Manuel Celestino Gonsalveis', 'Emília Paulino', 'Caxito-Dande', 'Angolana', 'Caxito', '', 'Luanda', '', '', '', '941611105', '', '', 2022, '2006-09-10', '0000-00-00', 506, '', '', 'Manuel Celestino Gonsalveis', '2022-09-07 16:38:02', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1195, 'Jaoquim Manuel Fernando', 'Masculino', 'Manuel Celestino Gonsalveis', 'Teresa Fernandes', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '941611105/997944437', '', '', 2022, '0000-00-00', '0000-00-00', 507, '', '', 'Manuel Celestino Gonsalveis', '2022-09-07 16:41:29', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1196, 'Joaquim Manuel Fernandes Celestino', 'Masculino', 'Manuel Celestino Gonsalveis', 'Teresa Fernandes Gonsalveis', 'Bengo', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '941611105/997944437', '', '', 2022, '2002-10-20', '0000-00-00', 508, '', '', 'Manuel Celestino Gonsalveis', '2022-09-07 16:45:47', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1197, 'Natália Fernandes Gonsalveis', 'Femenino', 'Manuel Celestino Gonsalveis', 'Teresa Fernandes', 'Maianga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '941611105/997944437', '', '', 2022, '2006-01-27', '0000-00-00', 509, '', '', 'Manuel Celestino Gonsalveis', '2022-09-07 16:49:07', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1198, 'Antónia Gonga Canjungo', 'Femenino', 'Domingos Gonga Canjungo', 'Eugénia Canjungo Gonga', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '925800268', '', '', 2022, '2007-06-30', '0000-00-00', 514, '', '', 'Domingos Gonga Canjungo', '2022-09-07 17:18:38', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1199, 'Anaela Domingos dos Santos Escórcio', 'Femenino', 'Joel Ferreira Escócio', 'Sana Kuyela Tch. dos Santos', '', 'Angolana', '', '', 'Luanda', '', '', '', '921424874', '', '', 2022, '2017-03-12', '0000-00-00', 515, '', '', 'Joel Ferreira Escócio', '2022-09-07 17:22:31', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1200, 'Haniela Isabel dos Santos Escórcio', 'Femenino', 'Joel Ferreira Escócio', 'Sana Kuyela Tch. dos Santos', 'Ingombotas', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '921424874', '', '', 2022, '2017-03-12', '0000-00-00', 516, '', '', 'Joel Ferreira Escócio', '2022-09-07 17:25:03', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1201, 'Ester Maria de Jesus Manuel', 'Femenino', 'Osvaldo de Carvalho F. Manuel', 'Albertina Pedro de Jesus', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923594430', '', '', 2022, '2014-06-10', '0000-00-00', 517, '', '', 'Osvaldo de Carvalho F. Manuel', '2022-09-07 17:28:27', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1202, 'Radija Marina João Matias', 'Femenino', 'Raimundo Pires Cristóvão', 'Albertina António Q. João', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923313351', '', '', 2022, '2007-05-30', '0000-00-00', 528, '', '', 'Raimundo Pires Cristóvão', '2022-09-09 06:46:05', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1203, 'Paula Capato Ulica Tchimdumdo', 'Femenino', 'António Tchimdumbo', 'Isabel Kapato Ulica', 'Viana', 'Angolana', 'Luanda', '022375103LA059', 'Luanda', '', '', '', '921703533', '', '', 2022, '2010-07-09', '2026-08-22', 529, '', '', 'António Tchimdumbo', '2022-09-09 06:51:55', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1204, 'Gilson José Mariano Tongonho', 'Masculino', 'José Mariano Tongonho Duarte', 'Maria Luisa Samacuenge', 'Huambo', 'Angolana', 'Huambo', '', 'Luanda', '', '', '', '923943484', '', '', 2022, '0000-00-00', '0000-00-00', 530, '', '', 'José Mariano Tongonho Duarte', '2022-09-09 06:59:29', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1205, 'Otaniel Wamuno Cangahi', 'Masculino', 'Osvaldo José Cangahi', 'Dania Cangahi', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923343834', '', '', 2022, '2017-11-24', '0000-00-00', 532, '', '', 'Osvaldo José Cangahi', '2022-09-09 07:04:43', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1206, 'Luciana Panda Vilombo', 'Femenino', 'André Leonardo Vilombo', 'Valquiria Luisa Valeiriano P. Vilombo', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '926560536', '', '', 2022, '2017-02-20', '0000-00-00', 536, '', '', 'André Leonardo Vilombo', '2022-09-09 07:19:27', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1207, 'Marlene Manuel Mariano', 'Femenino', 'Ramido Mariano', 'Luisa Balanga Manuel', 'Samba', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '936916159', '', '', 2022, '2015-06-05', '0000-00-00', 538, '', '', 'Ramido Mariano', '2022-09-09 07:47:38', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1208, 'Lourenço Augusto António Dala', 'Masculino', 'José Augusto Dala', 'Joana Cabaça António', 'Malanje', 'Angolana', 'Malanje', '020227257ME059', 'Luanda', '', '', '', '925714979', '', '', 2022, '2005-11-25', '2024-10-17', 540, '', '', 'José Augusto Dala', '2022-09-09 08:10:53', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1209, 'Ana Maria António', 'Femenino', '............', 'Noémia Justino António', 'Cazenga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '947314475', '', '', 2022, '2012-01-28', '0000-00-00', 543, '', '', '............', '2022-09-09 08:35:27', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1210, 'Tonivaldo Francisco António', 'Masculino', '.........................', 'Noémia Justino António', 'Cazenga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923428895', '', '', 2022, '2009-06-01', '0000-00-00', 551, '', '', '.........................', '2022-09-09 09:42:53', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1211, 'Fernado Cassule Cristovão', 'Masculino', 'Venceslau Tavares Cristóvão', 'Eva António Cassule', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '925406209', '', '', 2022, '2018-04-15', '0000-00-00', 554, '', '', 'Venceslau Tavares Cristóvão', '2022-09-09 11:57:12', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1212, 'Fernado Chiquembe Soares', 'Masculino', 'Luis José Gomes Soares', 'Cristina Chulo C. Chiquemba', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '998761299', '', '', 2022, '2014-11-11', '0000-00-00', 555, '', '', 'Luis José Gomes Soares', '2022-09-09 12:03:53', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1213, 'Inês Diogo Mateus', 'Femenino', 'Alvaro Miguel João Mateus', 'Iracelma da Conceição O. Diogo', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '922328939', '', '', 2022, '2009-05-02', '0000-00-00', 561, '', '', 'Alvaro Miguel João Mateus', '2022-09-09 17:07:41', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1214, 'Marinela Armando Candumbo', 'Femenino', 'Alberto Candumbo', 'Francelina Valente Armando', 'Luanda', 'Angolana', 'Luanda', '008873686LA041', 'Luanda', '', '', '', '927160146', '', '', 2022, '2003-05-25', '2022-05-11', 565, '', '', 'Alberto Candumbo', '2022-09-12 09:24:39', 'activo', '', '2023-10-16 05:38:26', '', '69787989'),
(1215, 'Verónica Tito Laurindo', 'Femenino', 'Jaime Joaquim Larindo', 'Domingas Cutemba Tito', 'Viana', 'Angolana', 'Luanda', '023525994LA056', 'Luanda', '', '', '', '934291306', '', '', 2022, '2002-09-06', '2027-05-19', 567, '', '', 'Jaime Joaquim Larindo', '2022-09-12 09:48:34', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1216, 'Kene de Jesus Texeira', 'Masculino', '......................', 'Regina Alveis Texeira', 'Golungo Alto', 'Angolana', 'Cuanza Norte', '009982378KN046', 'Luanda', '', '', '', '924371235', '', '', 2022, '2008-10-13', '2024-01-31', 572, '', '', '......................', '2022-09-12 10:31:00', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1217, 'Marcelina Colela Quissanga', 'Femenino', 'Mateus Muhongo Quissanga', 'Fernanda', 'Cazenga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923741778', '', '', 2022, '2009-04-27', '0000-00-00', 575, '', '', 'Mateus Muhongo Quissanga', '2022-09-12 13:32:49', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1218, 'Utima Victória Manuel Brandão', 'Femenino', 'André de Jesus Brandão', 'Victória João Agostinho Manuel', 'Belas', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '931534894', '', '', 2022, '2017-03-22', '0000-00-00', 577, '', '', 'André de Jesus Brandão', '2022-09-12 13:40:04', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1219, 'Rita Gombo Cassoma', 'Femenino', 'Manuel Cassoma', 'Juliana Gombo', 'Viana', 'Angolana', 'Luanda', '008632469LA048', 'Luanda', '', '', '', '', '', '', 2022, '2001-05-10', '2027-04-11', 578, '', '', 'Manuel Cassoma', '2022-09-12 13:51:07', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1220, 'Zola Victória Manuel Brandão', 'Femenino', 'André de Jesus Brandão', 'Victória João Agostinho Manuel', 'Belas', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923425994', '', '', 2022, '2017-03-22', '0000-00-00', 579, '', '', 'André de Jesus Brandão', '2022-09-12 13:56:53', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1221, 'Emiliana de Jesus Carlos Olo', 'Femenino', 'Eliseu José Suca Olo', 'Isabel de Jesus S. Pataca', 'Ingombotas', 'Angolana', 'Luanda', '022430438LA055', 'Luanda', '', '', '', '945995563/924533457', '', '', 2022, '2008-10-17', '0000-00-00', 584, '', '', 'Eliseu José Suca Olo', '2022-09-12 14:46:04', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1222, 'Paulina Simão Buka', 'Femenino', 'Kams Pedro Buka', 'Maria Augusto Simão', 'Sambinzanga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '940451641', '', '', 2022, '2015-12-02', '0000-00-00', 591, '', '', 'Kams Pedro Buka', '2022-09-14 08:00:26', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1223, 'Kélsia Catarina Neto Caiombe', 'Femenino', 'Mateus Manuel Bumba Caiombe', 'Isabel dos Prazeres N. D. Caiombe', 'Viana', 'Angolana', 'Luanda', '0207115811LA050', 'Luanda', '', '', '', '923626184', '', '', 2022, '2010-06-06', '2025-06-01', 593, '', '', 'Mateus Manuel Bumba Caiombe', '2022-09-14 08:38:45', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1224, 'Mário José Ferreira', 'Masculino', 'Milton Domingos Alexandre Ferreira', 'Luisa da Conceição José', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '928970604', '', '', 2022, '2015-07-27', '0000-00-00', 595, '', '', 'Milton Domingos Alexandre Ferreira', '2022-09-14 11:17:32', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1225, 'Délcio da Purificação D. Francisco', 'Masculino', 'Geovane Afonso Francisco', 'Carmem Sheila da Silva Domingos', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '929158614', '', '', 2022, '2018-04-03', '0000-00-00', 600, '', '', 'Geovane Afonso Francisco', '2022-09-14 11:40:18', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1226, 'Pedro Agostinho da Silva Buiti', 'Masculino', 'Bruno da Silva Massanga Buiti', 'Eunice Maria Cabomo Agostinho', 'Maianga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '934174360', '', '', 2022, '2016-11-24', '0000-00-00', 601, '', '', 'Bruno da Silva Massanga Buiti', '2022-09-14 11:45:44', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1227, 'Yasmin Henriqueta Tchimungo Kamongo', 'Masculino', 'Valdano Júlio S. Kamongo', 'Odeth Américo Tchimungo', 'Sambinzanga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '934903905', '', '', 2022, '2017-10-13', '0000-00-00', 603, '', '', 'Valdano Júlio S. Kamongo', '2022-09-14 11:54:26', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1228, 'Manuel Francisco Ngola  Caniguida', 'Masculino', 'Francisco Caniguida', 'Maria ngola', '', 'Angolana', 'Malanje', '008161074LA044', 'Luanda', '', '', '', '', '', '', 2022, '2008-09-22', '2016-04-22', 606, '', '', 'Francisco Caniguida', '2022-09-14 12:18:21', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1229, 'Josiana Jorgina Diogo Francisco', 'Femenino', 'Jorge Adriano Francisco', 'Conceição de Almeida da Cruz', 'Cazenga', 'Angolana', 'Luanda', '022298045LA052', 'Luanda', '', '', '', '928318847', '', '', 2022, '2007-08-30', '2026-08-04', 607, '', '', 'Jorge Adriano Francisco', '2022-09-14 12:35:09', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1230, 'Emanuela Isabel Chingalule João', 'Femenino', 'Bernabe Daniel D0omingos João', 'Felomena Namela', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '949845724', '', '', 2022, '2009-02-14', '0000-00-00', 608, '', '', 'Bernabe Daniel D0omingos João', '2022-09-14 12:43:22', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1231, 'Isabel Kumbo', 'Femenino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 611, '', '', '', '2022-09-14 13:21:55', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1232, 'Mavunino Diansongui', 'Masculino', 'João Luvumbu', 'Mafuta Maria', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '924119791', '', '', 2022, '2009-01-05', '0000-00-00', 612, '', '', 'João Luvumbu', '2022-09-16 09:09:53', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1233, 'Bianca Maria Manuel Disonsi', 'Femenino', 'Alberto Macueno Manuel Dinsonsi', 'Helena Manuel', 'Cazenga', 'Angolana', '', '', 'Luanda', '', '', '', '943816412', '', '', 2022, '2012-03-23', '0000-00-00', 613, '', '', 'Alberto Macueno Manuel Dinsonsi', '2022-09-16 09:15:49', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1234, 'Majediyuka Francisca Muleleno Kuvilala', 'Femenino', 'Dimitrof Francisco da Silva Kuvilala', 'Fernanda Yolanda Muleleno', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '924800780', '', '', 2022, '2016-11-28', '0000-00-00', 614, '', '', 'Dimitrof Francisco da Silva Kuvilala', '2022-09-16 09:59:47', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1235, 'Janeth Dala Paciencia', 'Femenino', 'Miguel Samuel Paciencia', 'Rosa Cambo Dala', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '023901664LA059', 'Luanda', '', '', '', '923444870', '', '', 2022, '2006-01-24', '2027-07-21', 615, '', '', 'Miguel Samuel Paciencia', '2022-09-16 10:16:43', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1236, 'Marco Aurélio Cristo Dala', 'Masculino', 'Adolfo da Graça Dala', 'Marinela Glória Cristo Dala', 'Ingombotas', 'Angolana', 'Luanda', '020960950LA057', 'Luanda', '', '', '', '922853883', '', '', 2022, '2010-03-27', '2025-09-15', 623, '', '', 'Adolfo da Graça Dala', '2022-09-19 15:36:25', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1237, 'Catarina Luanda Matamba', 'Femenino', 'António Luis Tete Matamba', 'Juliana Hebo Luamba Luanda', 'Viana', 'Angolana', 'Luanda', '022068072LA058', 'Luanda', '', '', '', '922320229', '', '', 2022, '2012-10-18', '2026-06-17', 625, '', '', 'António Luis Tete Matamba', '2022-09-19 15:48:15', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1238, 'Dumilson Luis Luanda Matamba', 'Masculino', 'Ant[onio Luis Tate Matamba', 'Juliana Hebo Luamba Luanda', 'Viana', 'Angolana', 'Luanda', '022163549LA050', 'Luanda', '', '', '', '922320229', '', '', 2022, '2015-06-30', '2026-07-08', 626, '', '', 'Ant[onio Luis Tate Matamba', '2022-09-19 15:52:41', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1239, 'Olga Jorgina Rodrigues Franco', 'Femenino', 'Quilamba Jorge Franco', 'Laura Rodrigues Jorge', 'Saurimo', 'Angolana', '', '', 'Luanda', '', '', '', '923343834', '', '', 2022, '2011-01-07', '0000-00-00', 627, '', '', 'Quilamba Jorge Franco', '2022-09-19 15:55:54', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1240, 'Nataniela Royana José Gaspar', 'Femenino', 'Ant[onio Gaspar Joaquim', 'Rosa Luis José', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923661920', '', '', 2022, '2016-06-18', '0000-00-00', 630, '', '', 'Ant[onio Gaspar Joaquim', '2022-09-19 16:44:28', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1241, 'Emiliana Adalzira José Gaspar', 'Masculino', 'António Gaspar Joaquim', 'Rosa Luis José', 'Viana', 'Angolana', 'Luanda', '023283336LA052', 'Luanda', '', '', '', '923661920', '', '', 2022, '2015-04-19', '2027-03-29', 632, '', '', 'António Gaspar Joaquim', '2022-09-19 16:53:08', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1242, 'Neymar Moises Correia Nkunga', 'Masculino', 'João Nkunga', 'Carla Eugénia de Vasconcelos Correia', 'Cazenga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '939016161', '', '', 2022, '2011-08-20', '0000-00-00', 643, '', '', 'João Nkunga', '2022-09-19 17:41:01', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1243, 'Fernandes Junior Eduardo', 'Masculino', 'Fernando Eduardo', 'Ana Romão', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '941271862', '', '', 2022, '2015-02-28', '0000-00-00', 644, '', '', 'Fernando Eduardo', '2022-09-19 17:43:54', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1244, 'Laura Gomes Junqueira', 'Femenino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 645, '', '', '', '2022-09-19 17:46:14', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1245, 'Rosa Gomes Junqueira', 'Femenino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 646, '', '', '', '2022-09-19 17:47:10', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1246, 'Suzana Armando Paulo', 'Femenino', 'Martins Pulo Gambo', 'Angela Alberto Cuassa', 'Uige', 'Angolana', 'Uige', '', 'Luanda', '', '', '', '925464983', '', '', 2022, '2012-01-21', '0000-00-00', 655, '', '', 'Martins Pulo Gambo', '2022-09-21 09:30:00', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1247, 'Madalena Nsika Sinza', 'Femenino', 'Pedro Sinza', 'Afonsina Kuedikuenda', 'Kuinba', 'Angolana', 'Uige', '', 'Luanda', '', '', '', '947714672', '', '', 2022, '2008-07-19', '0000-00-00', 657, '', '', 'Pedro Sinza', '2022-09-21 09:39:02', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1248, 'Ventura Mucombo José', 'Masculino', 'António José Domingos', 'Domingas Soares Mucombe', 'Ndalatando-Cacengo', 'Angolana', 'Cuanza Norte', '', 'Luanda', '', '', '', '923208822', '', '', 2022, '2007-02-26', '0000-00-00', 662, '', '', 'António José Domingos', '2022-09-22 09:27:25', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1249, 'Victoria Fernandes José', 'Femenino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 665, '', '', '', '2022-09-23 15:42:23', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1250, 'Paulo Ndombaxi Albano', 'Masculino', 'Miguel Albano', 'Maria Goveia Ndombaxi', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '921996962', '', '', 2002, '2001-02-07', '0000-00-00', 671, '', '', 'Miguel Albano', '2002-01-01 01:20:28', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1251, 'Francisco Famado Jorge', 'Masculino', 'Álvaro Manuel', 'Teresa Famado', 'Negaje', 'Angolana', 'Uige', '', 'Luanda', '', '', '', '927285175', '', '', 2002, '2003-05-01', '0000-00-00', 672, '', '', 'Álvaro Manuel', '2002-01-01 02:55:20', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1252, 'Luzia António dos Santos', 'Femenino', 'Paulo C. do Santos', 'Nelsa C. António', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923580788', '', '', 2022, '2007-10-13', '0000-00-00', 676, '', '', 'Paulo C. do Santos', '2022-09-27 14:29:53', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1253, 'Jessica Patrícia da Silva Dias', 'Femenino', 'Carlos José Bernardo da Silva', 'Teresa Manuel Dias', 'Viana', 'Angolana', 'Luanda', '4110/2018', 'Luanda', 'nao', '', '926849000', '', '', '', 2022, '2017-09-27', '0000-00-00', 678, 'Spu2', '', '', '2022-09-28 08:12:43', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1254, 'Naureth de F. Bravo da Rosa', 'Femenino', 'Alcides C B.. Da Rosa', 'Eva Domingos de Carvalho', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '', '', '', 2022, '2009-05-17', '0000-00-00', 684, '', '', '', '2022-09-30 08:38:30', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1255, 'Paulo Estevão Pedro', 'Masculino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 689, '', '', '', '2022-10-03 08:51:53', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1256, 'Telmo Fernando David', 'Masculino', 'Alexandre T. David', 'Maria P. Fernando', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '925584481', '', '', 2022, '2018-04-04', '0000-00-00', 691, '', '', 'Alexandre T. David', '2022-10-03 10:09:40', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1257, 'Elisangela Fernando David', 'Masculino', 'Alexandre Tomas David', 'Maria Pedade Henriques', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '925584412', '', '', 2022, '2012-08-08', '0000-00-00', 694, '', '', 'Alexandre Tomas David', '2022-10-03 10:34:27', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1258, 'Henrique Luis Cardoso', 'Masculino', 'Fernando da Silva Cardoso', 'Tania Luis Pedro', 'Cazenga', 'Angolana', 'Luanda', '020466568LA059', 'Luanda', '', '', '', '949771795', '', '', 2022, '2005-01-12', '2025-01-13', 695, '', '', 'Fernando da Silva Cardoso', '2022-10-03 10:41:02', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1259, 'Luzia Francisco Moxi', 'Femenino', 'Serafim Alberto Moxi', 'Conceição Francisco', 'Catete', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923235225', '', '', 2022, '2026-09-16', '0000-00-00', 699, '', '', 'Serafim Alberto Moxi', '2022-10-03 12:43:14', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1260, 'Sandra Quipapa Lundangem', 'Masculino', 'Jacob João Lundange', 'Delfina António Lundange', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '924260703', '', '', 2022, '2016-06-27', '0000-00-00', 701, '', '', 'Jacob João Lundange', '2022-10-03 13:14:21', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1261, 'Florinda Catchumbo Constantino', 'Femenino', 'Constatino Catomba', 'Helena Constantino', '', 'Angolana', '', '', 'Luanda', '', '', '', '931160742', '', '', 2022, '2000-04-17', '0000-00-00', 702, '', '', 'Constatino Catomba', '2022-10-03 13:19:39', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1262, 'Paulina João Casimiro', 'Masculino', 'Tio Buci Casimiro', 'Am[elia João Muyeba', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '', '', '', 2022, '2016-06-28', '0000-00-00', 703, '', '', 'Tio Buci Casimiro', '2022-10-03 13:40:39', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1263, 'Avelina Manuela Lucunde', 'Femenino', 'Gabriel Kalungo Lucunde', 'Eduarda Manuela Kanjambala', '', 'Angolana', '', '', 'Luanda', '', '', '', '927914043', '', '', 2022, '2011-06-27', '0000-00-00', 704, '', '', 'Gabriel Kalungo Lucunde', '2022-10-03 13:55:50', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1264, 'Nubercia Eduardo Henriques', 'Femenino', 'Nuno Henriques', 'Belmiro Elizangela', 'Cuanza Sul', 'Angolana', '', '', 'Luanda', '', '', '', '948428515', '', '', 2022, '2015-11-09', '0000-00-00', 705, '', '', 'Nuno Henriques', '2022-10-03 14:51:20', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1265, 'Edmilcia João Neto', 'Femenino', 'João Neto BViera', 'Domingas Albino', 'Malange', 'Angolana', 'Malange', '', 'Luanda', '', '', '', '948428515', '', '', 2022, '2011-03-21', '0000-00-00', 706, '', '', 'João Neto BViera', '2022-10-03 14:55:05', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1266, 'Antonio Fernandes', 'Masculino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 708, '', '', '', '2022-10-03 15:05:20', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1267, 'Kezia Emanuela Perreira', 'Femenino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 709, '', '', '', '2022-10-03 15:45:22', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1268, 'Larissa Tamara Caquianda Matias', 'Femenino', 'Osvaldo Domingos Matias', 'Joana da Conceição N. Matias', 'Ingombotas', 'Angolana', 'Luanda', '009845042LA041', 'Luanda', '', '', '', '924220137', '', '', 2022, '2010-05-05', '2023-12-05', 712, '', '', 'Osvaldo Domingos Matias', '2022-10-04 10:03:24', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1269, 'Carla Albertina Baião', 'Femenino', '.............................', 'Marilena António Baião', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '020352392LA056', 'Luanda', '', '', '', '931304102', '', '', 2022, '2008-06-15', '2024-12-02', 713, '', '', '.............................', '2022-10-04 11:01:27', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1270, 'Emanuel Agostinho Vunge Gonga', 'Masculino', 'Josée Vunge Gonga', 'Luisa Lamento V. Gonga', 'Ingombotas', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923496972', '', '', 2022, '2004-04-02', '0000-00-00', 715, '', '', 'Josée Vunge Gonga', '2022-10-04 14:14:38', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1271, 'Marcos Aurelio Dalas', 'Masculino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 716, '', '', '', '2022-10-04 14:17:24', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1272, 'Claudino Manuel José Fernandes', 'Masculino', 'Francisco Fernandes', 'Teresa Manuel Caetaon José', 'Rangel', 'Angolana', 'Luanda', '022628013LA053', 'Luanda', '', '', '', '932138035', '', '', 2022, '2003-03-22', '2026-10-11', 721, '', '', 'Francisco Fernandes', '2022-10-04 15:22:18', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1273, 'Mizael Junior  Dimone Panzo', 'Masculino', 'Pedro K. Ramiro Panzo', 'Cristina Mansoni Dimone', 'Viana', 'Angolana', 'Luanda', '742/2017', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 723, '', '', '', '2022-10-05 08:13:20', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1274, 'Adão Zage Cazuma Pedro', 'Masculino', 'Zage Pedro', 'Cecília Nzango M. Cazuma', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '956541720', '', '', 2022, '2006-08-01', '0000-00-00', 731, '', '', 'Zage Pedro', '2022-10-10 12:19:42', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1275, 'Belmira Patricia Manecas Zenza', 'Masculino', 'Armindo Abel Zenza', 'Lademira Patricia Manecas', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '', '', '', 2022, '2012-12-22', '0000-00-00', 732, '', '', 'Armindo Abel Zenza', '2022-10-10 12:28:49', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1276, 'Fernando Germano Muati Francisco', 'Masculino', 'Germano Manuel João Francisco', 'Marcelina Joaquim Muati', 'Cacuaco', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '921650617', '', '', 2022, '2002-12-21', '0000-00-00', 733, '', '', 'Germano Manuel João Francisco', '2022-10-10 12:32:12', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1277, 'Maria Ashley Geraldo Gonçalves', 'Femenino', 'Nilton Edson de Lemos Gonçalves', 'Teresa Domiana Gonçalves', 'Ingombotas', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923854866', '', '', 2022, '2005-12-22', '0000-00-00', 736, '', '', 'Nilton Edson de Lemos Gonçalves', '2022-10-10 14:35:21', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1278, 'Feliciano Fonseca Kalundungo Joaquim', 'Masculino', 'Barreto Fonseca Joaquim', 'Ermelinda Fineza A. Kalundungo', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '', '', '', 2022, '2015-06-27', '0000-00-00', 743, '', '', 'Barreto Fonseca Joaquim', '2022-10-10 16:07:18', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1279, 'Andreia Segundo Lopes', 'Femenino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 745, '', '', '', '2022-10-11 15:51:06', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1280, 'Etelvina Madalena Santana Vicente', 'Femenino', 'Oseias Vicente', 'Ermelinda Santana', 'Luanda', 'Angolana', '', '', 'Luanda', '', '', '', '921519027', '', '', 2022, '2009-03-04', '0000-00-00', 746, '', '', 'Oseias Vicente', '2022-10-12 09:21:08', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1281, 'Auria da Silva da Gama', 'Femenino', 'Clemente Bartolomeu da Gama', 'Madalena ERmuno da Silva', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '934224906', '', '', 2022, '2013-05-18', '0000-00-00', 748, '', '', 'Clemente Bartolomeu da Gama', '2022-10-12 12:20:04', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1282, 'Agnaldo Rock Tchinhama', 'Masculino', 'Domingos Roque', 'Dulce Alexandre', 'Viana', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '', '', '', 2022, '2008-08-09', '0000-00-00', 749, '', '', 'Domingos Roque', '2022-10-13 08:02:35', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1283, 'Santos Domingos  dos Santos Toco', 'Masculino', 'Santos Miguel Toco', 'Rosa André Domingos', 'Cazenga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '940842743', '', '', 2022, '2006-06-12', '0000-00-00', 750, '', '', 'Santos Miguel Toco', '2022-10-13 09:40:59', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1284, 'Paulo Tomas Mariano', 'Masculino', 'Idácio Cordeiro Mariano', 'Hermengarda Jurema J. Mariano', 'Kilamba Kiaxi', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '938419373', '', '', 2022, '2012-05-14', '0000-00-00', 754, '', '', 'Idácio Cordeiro Mariano', '2022-10-17 08:03:56', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1285, 'Israel Filho Tomas Mariano', 'Masculino', 'Idácio Cordeiro Mariano', 'Hermengarda Jurema J. José', '', 'Angolana', '', '', 'Luanda', '', '', '', '938419373', '', '', 2022, '2014-03-14', '0000-00-00', 755, '', '', 'Idácio Cordeiro Mariano', '2022-10-17 08:08:03', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1286, 'Antonica Castelo Bengue', 'Masculino', 'Tomás Bengui', 'Luisa António', 'Samba', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '938388469', '', '', 2022, '2016-06-11', '0000-00-00', 761, '', '', 'Tomás Bengui', '2022-10-20 14:37:26', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1287, 'Dionisio Castelo Bengui', 'Masculino', 'Tomás Bengui', 'Luisa António', 'Samba', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '938388469', '', '', 2022, '2013-09-09', '0000-00-00', 762, '', '', 'Tomás Bengui', '2022-10-20 14:43:42', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1288, 'Marcelo Melinda dos Santos', 'Masculino', 'Novais José dos Santos', 'Jorgina Tchisseque Melinda', 'Maianga', 'Angolana', 'Luanda', '009104249LA048', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 763, '', '', 'Novais José dos Santos', '2022-10-20 15:07:46', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1289, 'Bonifácio Caterça Ferreira Adão', 'Masculino', 'Eugénio Caterça Ferreira', 'Maria Adão Francisco Saveia', 'Samba', 'Angolana', 'Luanda', '022439634KN053', 'Luanda', '', '', '', '954379920', '', '', 2022, '2003-12-11', '0000-00-00', 764, '', '', 'Eugénio Caterça Ferreira', '2022-10-20 15:13:28', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1290, 'David Benjamim Chiengo', 'Masculino', 'Benjamim M. Chiengo', 'Marisa da Silva', 'Viana', 'Angolana', '', '007176458LA044', 'Luanda', '', '', '', '928162797', '', '', 2022, '2002-01-16', '2026-01-11', 772, '', '', 'Benjamim M. Chiengo', '2022-11-14 19:53:47', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1291, 'Sandro Chipilica Muhongo', 'Masculino', 'Angelino Silva J. Muhongo', 'Rosalina Alice Chipilica', 'Viana', 'Angolana', '', '021700278LA053', 'Luanda', '', '', '', '922325477', '', '', 2022, '2007-10-11', '0000-00-00', 773, '', '', 'Angelino Silva J. Muhongo', '2022-11-14 19:57:34', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1292, 'Elizangelo Domingos Francisco', 'Masculino', 'Geovane Afonso Francisco', 'Carmem Sheila Francisco', 'Luanda', 'Angolana', '', '', 'Luanda', '', '', '', '929158614', '', '', 2022, '2015-04-03', '0000-00-00', 774, '', '', 'Geovane Afonso Francisco', '2022-11-14 21:28:00', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1293, 'Felizarda Fernandes José', 'Masculino', 'Santos Albano Jose', 'Teresa Fernando José', '', 'Angolana', '', '', 'Luanda', '', '', '', '933026880', '', '', 2022, '0000-00-00', '0000-00-00', 777, '', '', 'Santos Albano Jose', '2022-11-21 15:52:25', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1294, 'André Fernando José António', 'Masculino', 'Santos Albano Jose', 'Teresa Fernandes José', '', 'Angolana', '', '', 'Luanda', '', '', '', '924109194', '', '', 2022, '2018-04-04', '0000-00-00', 778, '', '', 'Santos Albano Jose', '2022-11-21 15:54:23', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1295, 'Maria Manza Pembele', 'Femenino', 'Kimbuamba Nestor', 'Arrieta Pembele', 'Cazenga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '', '', '', 2022, '0000-00-00', '0000-00-00', 779, '', '', 'Kimbuan', '2022-11-23 09:11:51', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1296, 'Mateus Nzuzi António', 'Masculino', 'Viriato Paulina António', 'Delfina Eduardo Nzunzi', 'Samba', 'Angolana', 'Luanda', '022432779LA051', 'Luanda', '', '', '', '', '', '', 2022, '2005-08-10', '2026-09-01', 781, '', '', 'Viriato Paulina António', '2022-12-15 06:08:44', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1297, 'Feliciana Baptista António', 'Femenino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '923320458/913252240', '', '', 2022, '0000-00-00', '0000-00-00', 782, '', '', '', '2022-12-15 06:11:12', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1298, 'Rosa Enfica Francisco Joaquim', 'Femenino', 'Lino Joaquim', 'Delmira Francisco Albino', 'Gabela', 'Angolana', 'Cuanza Sul', '021931787KS050', 'Luanda', '', '', '', '925295157', '', '', 2022, '2003-01-06', '2026-05-18', 784, '', '', 'Lino Joaquim', '2022-12-28 08:58:19', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1299, 'António Fernando', 'Masculino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2023, '0000-00-00', '0000-00-00', 785, '', '', '', '2023-01-05 14:01:46', 'activo', '', '2023-08-12 18:50:47', '', NULL);
INSERT INTO `alunos` (`idaluno`, `nomecompleto`, `sexo`, `nomedopai`, `nomedamae`, `naturalidade`, `nacionalidade`, `provincia`, `numerodobioucedula`, `arquivodeidentificacao`, `deficiencia`, `escoladeorigem`, `telefone`, `telefoneincarregados`, `profissao`, `email`, `anodeentrada`, `datadenascimento`, `datadeexpiracaodobi`, `numerodeprocesso`, `morada`, `religiao`, `nomedoencarregado`, `datadecadastro`, `estatus`, `obs`, `data_modificacao`, `caminhodafoto`, `nifencarregado`) VALUES
(1300, 'Adriana Luana António', 'Femenino', '...................................', 'Celma Marisa Major António', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '929042918/944783291', '', '', 2023, '2012-12-30', '0000-00-00', 786, '', '', '...................................', '2023-01-06 08:02:06', 'activo', '', '2023-08-19 19:03:55', '64e1121b9ffc9.png', NULL),
(1301, 'Inácio Mussungo Zua', 'Masculino', 'Cristovão Calombe Jungo Zua', 'Deolinda Clemente Mussungo Zua', 'Viana', 'Angolana', 'Luanda', '022324445LA059', 'Luanda', '', '', '', '923329373', '', '', 2023, '2013-06-24', '2026-09-10', 787, '', '', 'Cristovão Calombe Jungo Zua', '2023-01-06 08:07:03', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1302, 'Madalena Clemente Zua', 'Femenino', 'Géneses Salomão Zua', 'Suzana Clemente Mussungo', '', 'Angolana', '', '', 'Luanda', '', '', '', '923329373', '', '', 2023, '2013-01-26', '0000-00-00', 791, '', '', 'Géneses Salomão Zua', '2023-01-19 09:46:40', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1303, 'Eva Diolinda Mussungo Zua', 'Femenino', 'Cristóvão Calombi Jungo Zua', 'Diolinda Clemente Mussungo Zua', 'Viana', 'Angolana', '', '022276307LA057', 'Luanda', '', '', '', '923329373', '', '', 2023, '2011-07-06', '0000-00-00', 792, '', '', 'Cristóvão Calombi Jungo Zua', '2023-01-19 09:54:14', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1304, 'Airosana Mariana Garcia Aires', 'Femenino', 'Gonsalo Gaspar Marcos Aires', 'Inês Cabuço Garcia', 'Cazenga', 'Angolana', 'Luanda', '020392295LA056', 'Luanda', '', '', '', '', '', '', 2023, '2013-06-09', '2024-12-15', 793, '', '', 'Gonsalo Gaspar Marcos Aires', '2023-01-26 08:59:24', 'activo', '', '2023-08-19 18:42:09', '64e10d0174ba0.jpeg', NULL),
(1305, 'Yelciana Feliciana Garcia Aires', 'Femenino', 'Gonsalo Gaspar Marcos Aires', 'Inês Cabuço Garcia', 'Cazenga', 'Angolana', 'Luanda', '020392397LA051', 'Luanda', '', '', '', '', '', '', 2023, '2023-06-09', '2024-12-15', 794, '', '', 'Gonsalo Gaspar Marcos Aires', '2023-01-26 09:01:49', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1306, 'Hélio Mateus Chico Pedro', 'Masculino', 'Tito Mateus Pedro', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2023, '0000-00-00', '0000-00-00', 795, '', '', 'Tito Mateus Pedro', '2023-01-26 09:13:25', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1307, 'Simone Catarina A. Cassua', 'Femenino', 'Emanuel J. Cassua', 'Catarina D. Agostinho', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2023, '2021-08-19', '0000-00-00', 796, '', '', 'Emanuel J. Cassua', '2023-01-26 09:39:25', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1308, 'Fernanda Kaynara Falú da Silva', 'Femenino', 'Kevan Mário da silva', 'JeovannaMarias Falú', '', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '', '', '', 2023, '0000-00-00', '0000-00-00', 797, '', '', 'Kevan Mário da silva', '2023-01-30 12:49:48', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1309, 'Evaristo Cabamba Tama Vital', 'Masculino', 'Jeremias Vital', 'Berenice Vital', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923452910/945728085', '', '', 2023, '2011-02-14', '0000-00-00', 798, '', '', 'Jeremias Vital', '2023-02-06 08:45:32', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1310, 'Gaspar Francisco Josias', 'Masculino', 'Luciano Josias', 'Esperança João Francisco', 'Maianga', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '923409941', '', '', 2023, '2004-08-30', '0000-00-00', 801, '', '', 'Luciano Josias', '2023-02-08 14:51:08', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1311, 'Leo João Domingos', 'Masculino', 'João Domingos José', 'Neusa S. Mateus', 'Luanda', 'Angolana', 'Luanda', '', 'Luanda', '', '', '', '948900928', '', '', 2023, '0000-00-00', '0000-00-00', 802, '', '', 'João Domingos José', '2023-02-08 14:56:56', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1312, 'Pedro Diogo dos Santos', 'Masculino', 'António Francisco dos Santos', 'Marinela Francisco', 'Sambinzanga', 'Angolana', 'Luanda', '024575046LA053', 'Luanda', '', '', '', '931612066', '', '', 2002, '2004-11-12', '0000-00-00', 803, '', '', 'António Francisco dos Santos', '2002-01-03 02:45:03', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1313, 'mareus Andre', 'Masculino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2023, '0000-00-00', '0000-00-00', 804, '', '', '', '2023-07-25 12:23:18', 'activo', '', '2023-08-12 18:50:47', '', NULL),
(1314, 'Marinela Francisco Tomás', 'Masculino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2023, NULL, NULL, 805, '', '', '', '2023-09-20 22:36:03', 'activo', '', '2023-09-20 22:36:03', NULL, NULL),
(1315, 'Fernadndo', 'Masculino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2023, NULL, NULL, 806, '', '', '', '2023-10-10 09:16:46', 'activo', '', '2023-10-10 09:16:46', NULL, NULL),
(1316, 'Doriana Sambumba', 'Femenino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2023, '0000-00-00', '0000-00-00', 807, '', '', '', '2023-10-16 03:46:04', 'activo', '', '2023-10-16 03:52:00', NULL, '5003032666'),
(1317, 'Pedro', 'Masculino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2023, NULL, NULL, 808, '', '', '', '2023-10-16 03:57:14', 'activo', '', '2023-10-16 03:57:15', NULL, ''),
(1318, 'Rinial Pedro', 'Masculino', '', '', '', 'Angolana', '', '', 'Luanda', '', '', '', '', '', '', 2023, NULL, NULL, 809, '', '', '', '2023-10-16 04:13:58', 'activo', '', '2023-10-16 04:13:58', NULL, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `anoslectivos`
--

CREATE TABLE `anoslectivos` (
  `idanolectivo` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `anoslectivos`
--

INSERT INTO `anoslectivos` (`idanolectivo`, `titulo`, `vigor`, `posicao`, `nomedamediadostrimestres`, `percentagemdamediadostrimestres`, `nomedaprovadeescola`, `nomedaprovadeexame`, `nomedamediaanual`, `arredondarmedia`, `precodafalta`, `precodareconfirmacao`, `datainicio`, `datafim`, `datafimexame`, `diadamulta`, `precodamulta`, `data_modificacao`) VALUES
(1, '2020', 'Não', 1, 'CAP', 0.4, 'CPE', 'NER', 'CF', 0, 0, 0, '2020-02-01', '2020-11-01', '2020-12-01', 15, '0', '2023-08-12 18:50:48'),
(2, '2021/2022', 'Não', 2, 'CAP', 0.4, 'CPE', 'NER', 'CF', 0, 500, 3000, '2021-08-01', '2022-06-01', '2022-07-01', 15, '2300', '2023-08-12 18:50:48'),
(3, '2019', 'Não', 0, 'CAP', 0.4, 'CPE', 'NER', 'CF', 0, 0, 0, '2021-08-01', '2022-06-01', '2022-07-01', 15, '0', '2023-08-12 18:50:48'),
(4, '2022/2023', 'Sim', 0, 'MFD', 0.6, 'NE', 'NER', 'MF', 2, 100, 0, '2022-09-01', '2023-06-30', '2023-07-31', 15, '20%', '2023-10-16 05:40:12'),
(5, '2018', 'Não', 0, 'CAP', 0.4, 'CPE', 'NER', 'CF', 2, 0, 0, '2021-08-01', '2022-06-01', '2022-07-01', 15, '0', '2023-10-16 03:31:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `atl`
--

CREATE TABLE `atl` (
  `idatl` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text DEFAULT NULL,
  `propina` double NOT NULL DEFAULT 0,
  `matricula` double NOT NULL DEFAULT 0,
  `idcoordenador` int(11) NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `idavaliacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `titulo` varchar(220) NOT NULL DEFAULT 'Avaliação Contínua',
  `data` date NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `notavinculada` int(11) NOT NULL DEFAULT 0,
  `idturma` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`idavaliacao`, `iddisciplina`, `titulo`, `data`, `idtrimestre`, `notavinculada`, `idturma`, `data_modificacao`) VALUES
(1, 6, 'Avaliação', '2022-10-19', 11, 26, 32, '2023-08-12 18:50:50'),
(2, 11, 'Avaliação Continua', '2022-10-27', 11, 26, 30, '2023-08-12 18:50:50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadeirasdeixadas`
--

CREATE TABLE `cadeirasdeixadas` (
  `idcadeiradeixada` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT 0,
  `data` date DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cadeirasdeixadas`
--

INSERT INTO `cadeirasdeixadas` (`idcadeiradeixada`, `idaluno`, `idmatriculaeconfirmacao`, `iddisciplina`, `valordanota`, `data`, `data_modificacao`) VALUES
(23, 1104, 98, 13, 3, '2022-12-08', '2023-08-12 18:50:51'),
(24, 1063, 170, 13, 3, '2022-12-08', '2023-08-12 18:50:51'),
(25, 1137, 329, 13, 2, '2022-12-08', '2023-08-12 18:50:51'),
(26, 1195, 512, 13, 0, '2022-12-08', '2023-08-12 18:50:51'),
(27, 1202, 533, 13, 4, '2022-12-08', '2023-08-12 18:50:51'),
(28, 1208, 548, 13, 0, '2022-12-08', '2023-08-12 18:50:51'),
(29, 1219, 586, 13, 0, '2022-12-08', '2023-08-12 18:50:51'),
(30, 1251, 685, 13, 3, '2022-12-08', '2023-08-12 18:50:51'),
(31, 121, 695, 13, 3, '2022-12-08', '2023-08-12 18:50:51'),
(32, 1283, 764, 13, 3, '2022-12-08', '2023-08-12 18:50:51'),
(33, 194, 780, 13, 1, '2022-12-08', '2023-08-12 18:50:51');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ciclos`
--

CREATE TABLE `ciclos` (
  `idciclo` int(11) NOT NULL,
  `titulo` varchar(222) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `ciclos`
--

INSERT INTO `ciclos` (`idciclo`, `titulo`, `data_modificacao`) VALUES
(1, 'Ensino Primário', '2023-08-12 18:50:52'),
(2, '1º Ciclo', '2023-08-12 18:50:52'),
(3, '2º Ciclo', '2023-08-12 18:50:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `classes`
--

CREATE TABLE `classes` (
  `idclasse` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `idciclo` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `classes`
--

INSERT INTO `classes` (`idclasse`, `titulo`, `idciclo`, `data_modificacao`) VALUES
(1, '1ª', 1, '2023-08-12 18:50:53'),
(2, '2ª', 1, '2023-08-12 18:50:53'),
(3, '3ª', 1, '2023-08-12 18:50:53'),
(4, '4ª', 1, '2023-08-12 18:50:53'),
(5, '5ª', 1, '2023-08-12 18:50:53'),
(6, '6ª', 1, '2023-08-12 18:50:53'),
(7, '7ª', 2, '2023-08-12 18:50:53'),
(8, '8ª', 2, '2023-08-12 18:50:53'),
(9, '9ª', 2, '2023-08-12 18:50:53'),
(10, '10ª', 3, '2023-08-12 18:50:53'),
(11, '11ª', 3, '2023-08-12 18:50:53'),
(12, '12ª', 3, '2023-08-12 18:50:53'),
(13, 'Pré - B', 1, '2023-08-12 18:50:53'),
(14, 'Pré- A', 1, '2023-08-12 18:50:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compra`
--

CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

--
-- Despejando dados para a tabela `compra`
--

INSERT INTO `compra` (`idcompra`, `idproduto`, `idaluno`, `idanolectivo`, `iddacompra`, `data`, `estatus`, `preco`, `quantidade`, `entregue`, `valorpago`, `desconto`, `data_modificacao`) VALUES
(1, 2, 1268, 0, 1, '2023-10-16 05:54:04', 'vendido', 6000, 1, 0, 6000, 0, '2023-10-16 04:54:04'),
(2, 1, 1268, 0, 1, '2023-10-16 05:54:05', 'vendido', 7000, 1, 0, 7000, 0, '2023-10-16 04:54:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras`
--

CREATE TABLE `compras` (
  `idcompra` int(11) NOT NULL,
  `idaluno` int(11) DEFAULT NULL,
  `obs` varchar(100) DEFAULT '',
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `idfuncionario` int(11) NOT NULL,
  `idatendimento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

--
-- Despejando dados para a tabela `compras`
--

INSERT INTO `compras` (`idcompra`, `idaluno`, `obs`, `data`, `idfuncionario`, `idatendimento`) VALUES
(1, 1268, '', '2023-10-16 05:54:04', 31, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `idcurso` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`idcurso`, `titulo`, `data_modificacao`) VALUES
(1, 'Nenhum', '2023-08-12 18:50:56'),
(2, 'Ciências Físicas e Biológicas', '2023-08-12 18:50:56'),
(3, 'Ciências Econômicas e Jurídicas', '2023-08-12 18:50:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `dadosdaempresa`
--

CREATE TABLE `dadosdaempresa` (
  `iddadosdaempresa` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `dadosdaempresa`
--

INSERT INTO `dadosdaempresa` (`iddadosdaempresa`, `nome`, `servicos`, `numerodecontribuinte`, `contabancaria`, `email`, `localizacao`, `telefone`, `site`, `localizacaoprecisa`, `nomedodireitor`, `caminhodologo`, `data_modificacao`) VALUES
(1, 'Complexo Escolar Arena do Saber', 'Ensino Primário, Iº e IIº Ciclo e Ensino Secundário', '', 'BIC: 0051.0000.0591.9169.1014.2', '', 'Viana - Luanda, Angola', '923848537', '', 'Bairro Jacinto Tchipa, Ciquentinha, Por detrás das roloutes', 'Augusto Tuta Nguvo', '65220fae74ac0.png', '2023-10-08 02:10:54');

-- --------------------------------------------------------

--
-- Estrutura para tabela `descadastrados`
--

CREATE TABLE `descadastrados` (
  `iddescadastrado` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL DEFAULT 'Inactivo',
  `descricao` text DEFAULT NULL,
  `data` date NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `iddisciplina` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `disciplinas`
--

INSERT INTO `disciplinas` (`iddisciplina`, `idprofessor`, `idprofessorauxiliar`, `idtipodedisciplina`, `titulo`, `abreviatura`, `idturma`, `idanolectivo`, `tipodedisciplina`, `agrupamento`, `obs`, `estatus`, `salarioportempo`, `salarioportempoauxiliar`, `data_modificacao`) VALUES
(308, 31, 46, 4, 'Química', 'QUIM', 32, 4, 'Normal', 'Formação Específica', 'obs', 1, 700, 500, '2023-10-08 07:13:58'),
(309, 31, 50, 24, 'Educação Musical', 'Ed. Musical', 32, 4, 'Normal', 'Formação Geral', '', 1, 700, 500, '2023-10-08 07:27:47'),
(310, 31, 50, 24, 'Educação Musical', 'Ed. Musical', 18, 4, 'Normal', 'Formação Geral', '', 1, 700, 500, '2023-10-08 07:27:48'),
(311, 31, 50, 24, 'Educação Musical', 'Ed. Musical', 23, 4, 'Normal', 'Formação Geral', '', 1, 700, 500, '2023-10-08 07:27:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentostratados`
--

CREATE TABLE `documentostratados` (
  `iddocumentotratado` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `entradas`
--

CREATE TABLE `entradas` (
  `identrada` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `entradas`
--

INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `formadepagamento`, `idaluno`, `idturma`, `datadaentrada`, `idanolectivo`, `data_modificacao`) VALUES
(7242, 31, 'Registro de Rematrícula', 'Rematrícula', 818, 4000, 0, 'Dinheiro', 1304, 22, '2023-07-23 23:00:00', 4, '2023-08-12 18:51:01'),
(7243, 31, 'Registro de Matrícula', 'Matrícula', 819, 4000, 0, 'Dinheiro', 1313, 18, '2023-07-24 23:00:00', 4, '2023-08-12 18:51:01'),
(7244, 31, 'Registro de Propina de 04/2023 (Ref: 79979 )', 'Propina', 1, 5500, 0, 'Dinheiro', 1304, 22, '2023-07-27 09:13:23', 4, '2023-08-12 18:51:01'),
(7245, 31, 'Controlo', 'Outras', 0, 0, 0, '', 0, 0, '2023-03-31 23:00:00', 4, '2023-08-12 18:51:01'),
(7246, 31, 'Registro de Propina de 05/2023 (Ref: 76876 )', 'Propina', 2, 5500, 0, 'Dinheiro', 1304, 22, '2023-07-27 09:14:01', 4, '2023-08-12 18:51:01'),
(7247, 31, 'Controlo', 'Outras', 0, 0, 0, '', 0, 0, '2023-04-30 23:00:00', 4, '2023-08-12 18:51:01'),
(7248, 31, 'Registro de Matrícula', 'Matrícula', 820, 4500, 0, 'Dinheiro', 1314, 11, '2023-09-20 23:00:00', 4, '2023-09-20 22:36:10'),
(7249, 31, 'Registro de Propina de 06/2023 (Ref:  )', 'Propina', 3, 6050, 0, 'Dinheiro', 1304, 22, '2023-10-09 02:34:11', 4, '2023-10-09 02:34:11'),
(7250, 31, 'Controlo', 'Outras', 0, 0, 0, '', 0, NULL, '2023-05-31 23:00:00', 4, '2023-10-09 02:34:11'),
(7251, 31, 'Registro de Propina de 10/2023 (Ref:  )', 'Propina', 4, 6500, 150, 'Dinheiro', 1313, 18, '2023-10-09 02:34:40', 4, '2023-10-09 02:34:40'),
(7252, 31, 'Registro de Propina de 07/2023 (Ref:  )', 'Propina', 5, 6050, 0, 'Dinheiro', 1304, 22, '2023-10-09 14:02:35', 4, '2023-10-09 14:02:35'),
(7253, 31, 'Registro de Propina de 08/2023 (Ref:  )', 'Propina', 6, 6050, 0, 'Dinheiro', 1304, 22, '2023-10-09 14:02:39', 4, '2023-10-09 14:02:39'),
(7254, 31, 'Controlo', 'Outras', 0, 0, 0, '', 0, NULL, '2023-07-31 23:00:00', 4, '2023-10-09 14:02:40'),
(7255, 31, 'Registro de Propina de 09/2023 (Ref:  )', 'Propina', 7, 6050, 0, 'Dinheiro', 1304, 22, '2023-10-09 14:02:44', 4, '2023-10-09 14:02:44'),
(7256, 31, 'Registro de Propina de 08/2023 (Ref:  )', 'Propina', 8, 4500, 0, 'Dinheiro', 1314, 11, '2023-10-10 09:16:00', 4, '2023-10-10 09:16:00'),
(7257, 31, 'Registro de Matrícula', 'Matrícula', 821, 10000, 0, 'Dinheiro', 1315, 33, '2023-10-09 23:00:00', 2, '2023-10-10 09:17:46'),
(7258, 31, 'Registro de Matrícula', 'Matrícula', 822, 4000, 0, 'Dinheiro', 1316, 18, '2023-10-15 23:00:00', 4, '2023-10-16 03:46:23'),
(7259, 31, 'Registro de Confirmação', 'Confirmação', 824, 2000, 0, 'Dinheiro', 1317, 19, '2023-10-15 23:00:00', 4, '2023-10-16 04:03:22'),
(7260, 31, 'Registro de Matrícula', 'Matrícula', 825, 4000, 0, 'Dinheiro', 1318, 24, '2023-10-15 23:00:00', 4, '2023-10-16 04:14:03'),
(7261, 31, 'Registro de Matrícula', 'Matrícula', 826, 4000, 0, 'Dinheiro', 1318, 21, '2023-10-15 23:00:00', 4, '2023-10-16 04:18:42'),
(7262, 31, 'Venda de 1  Calção, 1 Uniforme Polo', 'Material Escolar', 1, 13000, 0, 'Dinheiro', 1268, 0, '2023-10-16 04:54:06', 0, '2023-10-16 04:54:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `faltas`
--

CREATE TABLE `faltas` (
  `idfalta` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `falta` double NOT NULL DEFAULT 0,
  `pago` int(3) NOT NULL DEFAULT 0,
  `data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `formasdepagamento`
--

CREATE TABLE `formasdepagamento` (
  `idformadepagamento` int(11) NOT NULL,
  `formadepagamento` varchar(220) DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `formasdepagamento`
--

INSERT INTO `formasdepagamento` (`idformadepagamento`, `formadepagamento`, `data_modificacao`) VALUES
(1, 'Dinheiro', '2023-08-12 18:51:03'),
(2, 'BIC', '2023-08-12 18:51:03'),
(4, 'Multicaixa Express', '2023-08-12 18:51:03'),
(5, 'BAI', '2023-08-12 18:51:03'),
(9, 'BCA', '2023-08-12 18:51:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `idfuncionario` int(11) NOT NULL,
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
  `subsideodetransporte` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`idfuncionario`, `nomedofuncionario`, `datadenascimento`, `categoria`, `telefone`, `localizacao`, `naturalidade`, `proveniencia`, `habilitacoesliterarias`, `contabancaria`, `datadeentrada`, `salario`, `datadeentradanosistema`, `salarioporhora`, `numerodedias`, `numerodehoras`, `estatus`, `data_modificacao`, `caminhodafoto`, `subsideodealimentacao`, `subsideodetransporte`) VALUES
(31, 'Esmael Calunga', '0000-00-00', 'C.E.O', '92924444', '', '', ' ', '', '', '0000-00-00', 150000, '2021-02-28 14:03:05', 852, 22, 8, 'activo', '2023-10-16 04:09:37', '652cb781ad372.png', 30000, 35000),
(43, 'Faustino Vasco Joaquim Gomes', '0000-00-00', 'Secretário', ' ', ' ', ' ', ' ', ' ', 'AO0600 0045 0000 3495 4857 9483 4992', '0000-00-00', 0, '2022-03-25 16:53:52', 0, 22, 8, 'activo', '2023-10-08 01:24:44', '', 15000, 50000),
(44, 'Joana Joaquim André', '0000-00-00', 'Secretária', ' ', '', '', ' ', '', '', '0000-00-00', 0, '2022-03-25 16:55:44', 0, 22, 8, 'activo', '2023-08-12 18:51:05', '', 0, 0),
(45, 'Floide de Jesus', '0000-00-00', 'Director Pedagógico', '', '', '', '  ', '', '', '0000-00-00', 0, '2022-03-25 16:59:33', 0, 22, 8, 'activo', '2023-08-20 04:09:00', '', 50000, 15000),
(46, 'Paulino Carlos Figueira', '0000-00-00', 'Professor da 2 Classe', '', '', 'Kilamba Kiaxi', 'Professor', 'Ensino Primário', '', '0000-00-00', 40000, '2022-10-18 12:40:59', 227, 22, 8, 'activo', '2023-08-12 18:51:05', '', 0, 0),
(47, 'Guilherme da Conceição P. Franco', '0000-00-00', 'Professor/ 1 Cíclo - Geografia /1 Classe', '', '', '', 'Professor', '12 Classe', '', '0000-00-00', 40000, '2022-10-19 08:54:28', 227, 22, 8, 'activo', '2023-08-20 04:09:15', '', 45000, 120000),
(48, 'Júlio Tavares Bebeca', '0000-00-00', '', '', '', '', 'Professor', '', '', '0000-00-00', 700, '2022-10-19 09:18:48', 4, 22, 8, 'activo', '2023-08-12 18:51:05', '', 0, 0),
(49, 'Isaac Menakuntima Pedro', '0000-00-00', 'Director de Turma', '', '', '', 'Professor', '', '', '0000-00-00', 700, '2022-10-19 09:19:55', 4, 22, 8, 'activo', '2023-08-12 18:51:05', '', 0, 0),
(50, 'Leonardo Correia Pazitp', '0000-00-00', 'Director de Turma', '', '', '', 'Professor', '', '', '0000-00-00', 700, '2022-10-19 09:20:27', 4, 22, 8, 'activo', '2023-08-20 04:09:20', '', 33000, 0),
(51, 'Marinela da S. Francisco', '0000-00-00', 'Director de Turma', '', '', '', 'Professor', '', '', '0000-00-00', 700, '2022-10-19 09:21:20', 4, 22, 8, 'activo', '2023-08-12 18:51:05', '', 0, 0),
(52, 'Osvaldo Caetano', '0000-00-00', 'Director de Turma', '', '', '', 'Professor', '', '', '0000-00-00', 700, '2022-10-19 09:21:49', 4, 22, 8, 'activo', '2023-08-12 18:51:05', '', 0, 0),
(53, 'Farncisco Gonga', '0000-00-00', 'Director de Turma', '', '', '', 'Professor', '', '', '0000-00-00', 700, '2022-10-19 09:22:12', 4, 22, 8, 'activo', '2023-08-12 18:51:05', '', 0, 0),
(54, 'Edna Kibuba', '0000-00-00', 'Director de Turma', '', '', '', 'Professor', '', '', '0000-00-00', 700, '2022-10-19 09:22:40', 4, 22, 8, 'activo', '2023-08-12 18:51:05', '', 0, 0),
(55, 'Andrade Buila', '0000-00-00', 'Director de Turma', '', '', '', 'Professor', '', '', '0000-00-00', 700, '2022-10-19 09:23:07', 4, 22, 8, 'activo', '2023-08-19 19:35:46', '64e119927d3a9.jpeg', 0, 0),
(56, 'Telma Catenda Ernesto', '0000-00-00', 'Director de Turma', '', '', '', 'Professor', '', '', '0000-00-00', 700, '2022-10-19 09:23:43', 4, 22, 8, 'activo', '2023-08-12 18:51:05', '', 0, 0),
(57, 'Sebastião Lando', '0000-00-00', 'Coordenador de Curso C.F.B', '', '', '', 'Professor', '', '', '0000-00-00', 700, '2022-10-19 09:24:31', 4, 22, 8, 'activo', '2023-08-12 18:51:05', '', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

CREATE TABLE `historico` (
  `idhistorico` int(11) NOT NULL,
  `idfuncionario` int(11) NOT NULL,
  `descricao` varchar(90) DEFAULT NULL,
  `antigo` text DEFAULT NULL,
  `novo` text DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_sincronizacao`
--

CREATE TABLE `historico_sincronizacao` (
  `id` int(11) NOT NULL,
  `datadasicronizacao` datetime NOT NULL,
  `numeroderegistrossicronizados` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `impostos`
--

CREATE TABLE `impostos` (
  `idimposto` int(11) NOT NULL,
  `imposto` varchar(100) NOT NULL,
  `incidencia` varchar(100) NOT NULL DEFAULT 'entradas',
  `percentagem` double NOT NULL DEFAULT 0,
  `obs` varchar(220) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `impostos`
--

INSERT INTO `impostos` (`idimposto`, `imposto`, `incidencia`, `percentagem`, `obs`, `data_modificacao`) VALUES
(1, 'Imposto sobre Venda', 'entradas', 14, '', '2023-08-12 18:51:08'),
(2, 'Imposto sobre Consumo', 'saidas', 3, '', '2023-08-12 18:51:08'),
(7, 'Imposto de Renda', 'entradas', 7, ' ', '2023-08-12 18:51:08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lembretes`
--

CREATE TABLE `lembretes` (
  `idlembrete` int(11) NOT NULL,
  `descricao` text DEFAULT NULL,
  `datadolembrete` date NOT NULL,
  `datadecadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `matriculaseconfirmacoes`
--

CREATE TABLE `matriculaseconfirmacoes` (
  `idmatriculaeconfirmacao` int(11) NOT NULL,
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
  `reconfirmou` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `matriculaseconfirmacoes`
--

INSERT INTO `matriculaseconfirmacoes` (`idmatriculaeconfirmacao`, `idaluno`, `tipodealuno`, `idanolectivo`, `idturma`, `tipo`, `preco`, `desconto`, `valorpago`, `turma`, `sala`, `curso`, `periodo`, `classe`, `data`, `obs`, `estatus`, `ultimomespago`, `classificacaofinal`, `descontoparapropinas`, `data_modificacao`, `reconfirmou`) VALUES
(818, 1304, 'Normal', 4, 22, 'Rematrícula', 4000, 0, 4000, '6B', '16', 'Nenhum', 'Manhã', '6ª', '2023-04-24', '', 'activo', '2023-09-01', 'Sem Classificação', 0, '2023-10-09 14:02:43', 0),
(819, 1313, 'Normal', 4, 18, 'Matrícula', 4000, 0, 4000, '9A', '13', 'Nenhum', 'Tarde', '9ª', '2023-01-25', '', 'activo', '2023-10-01', 'Sem Classificação', 500, '2023-10-09 02:34:40', 0),
(820, 1314, 'Normal', 4, 11, 'Matrícula', 4500, 0, 4500, '4C', '9', 'Nenhum', 'Tarde', '4ª', '2023-09-21', '', 'activo', '2023-08-01', 'Sem Classificação', 0, '2023-10-10 09:15:59', 0),
(821, 1315, 'Normal', 2, 33, 'Matrícula', 10000, 0, 10000, 'PreA', '9', 'Nenhum', 'Tarde', 'Pré- A', '2023-10-10', '', 'activo', '0000-00-00', 'Sem Classificação', 0, '2023-10-10 09:17:45', 0),
(822, 1316, 'Normal', 4, 18, 'Matrícula', 4000, 0, 4000, '9A', '13', 'Nenhum', 'Tarde', '9ª', '2023-10-16', '', 'activo', '0000-00-00', 'Sem Classificação', 0, '2023-10-16 03:46:23', 0),
(823, 1317, 'Normal', 4, 20, 'Confirmação', 2000, 0, 2000, '9C', '9', 'Nenhum', 'Tarde', '9ª', '2023-10-16', '', 'activo', '0000-00-00', 'Sem Classificação', 0, '2023-10-16 04:00:11', 0),
(824, 1317, 'Normal', 4, 19, 'Confirmação', 2000, 0, 2000, '9B', '14', 'Nenhum', 'Tarde', '9ª', '2023-10-16', '', 'activo', '0000-00-00', 'Sem Classificação', 0, '2023-10-16 04:03:22', 0),
(825, 1318, 'Normal', 4, 24, 'Matrícula', 4000, 0, 4000, '5A', '12', 'Nenhum', 'Tarde', '5ª', '2023-10-16', '', 'activo', '0000-00-00', 'Sem Classificação', 0, '2023-10-16 04:14:03', 0),
(826, 1318, 'Normal', 4, 21, 'Matrícula', 4000, 0, 4000, '6A', '14', 'Nenhum', 'Manhã', '6ª', '2023-10-16', '', 'activo', '0000-00-00', 'Sem Classificação', 0, '2023-10-16 04:18:42', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `matriculatransporte`
--

CREATE TABLE `matriculatransporte` (
  `idmatriculatransporte` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mediasdoano`
--

CREATE TABLE `mediasdoano` (
  `idmediadoano` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `tipodeturma` varchar(222) NOT NULL DEFAULT 'Transição',
  `posicao` int(2) NOT NULL,
  `arredondarmedia` int(2) NOT NULL DEFAULT 0,
  `tipodemedia` varchar(100) NOT NULL DEFAULT 'denotas',
  `idmediamaior` int(11) NOT NULL DEFAULT 0,
  `percentagem` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `mediasdoano`
--

INSERT INTO `mediasdoano` (`idmediadoano`, `titulo`, `idtrimestre`, `idanolectivo`, `tipodeturma`, `posicao`, `arredondarmedia`, `tipodemedia`, `idmediamaior`, `percentagem`, `data_modificacao`) VALUES
(2, 'MT1', 11, 4, 'Transição', 1, 0, 'denotas', 11, 0, '2023-08-12 18:51:13'),
(3, 'MT1', 11, 4, 'Exame', 1, 0, 'denotas', 8, 0, '2023-08-12 18:51:13'),
(4, 'MT2', 12, 4, 'Transição', 2, 0, 'denotas', 11, 0, '2023-08-12 18:51:13'),
(5, 'MT2', 12, 4, 'Exame', 2, 0, 'denotas', 8, 0, '2023-08-12 18:51:13'),
(6, 'MT3', 13, 4, 'Transição', 5, 0, 'denotas', 11, 0, '2023-08-12 18:51:13'),
(7, 'MT3', 13, 4, 'Exame', 6, 0, 'denotas', 8, 0, '2023-08-12 18:51:13'),
(8, 'MFD', 13, 4, 'Exame', 7, 0, 'demedias', 9, 0.4, '2023-08-12 18:51:13'),
(9, 'MF', 13, 4, 'Exame', 8, 0, 'ponderada', 0, 0, '2023-08-12 18:51:13'),
(11, 'MF', 13, 4, 'Transição', 10, 0, 'demedias', 0, 0, '2023-08-12 18:51:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `metas`
--

CREATE TABLE `metas` (
  `idmeta` int(11) NOT NULL,
  `nomedameta` varchar(100) DEFAULT NULL,
  `sector` varchar(220) DEFAULT '',
  `diainicio` date DEFAULT NULL,
  `diafim` date NOT NULL,
  `valor` double NOT NULL DEFAULT 0,
  `obs` text DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `estatus` varchar(100) NOT NULL DEFAULT 'em andamento',
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas`
--

CREATE TABLE `notas` (
  `idnota` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `idnotadoano` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT 0,
  `idturma` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notasavaliacao`
--

CREATE TABLE `notasavaliacao` (
  `idnotaavaliacao` int(11) NOT NULL,
  `idavaliacao` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `valordanota` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `notasavaliacao`
--

INSERT INTO `notasavaliacao` (`idnotaavaliacao`, `idavaliacao`, `idmatriculaeconfirmacao`, `valordanota`, `data_modificacao`) VALUES
(1, 1, 368, 12, '2023-08-12 18:52:59'),
(2, 1, 643, 12, '2023-08-12 18:52:59'),
(3, 1, 669, 13, '2023-08-12 18:52:59'),
(4, 1, 591, 13, '2023-08-12 18:52:59'),
(5, 1, 389, 13, '2023-08-12 18:52:59'),
(6, 1, 676, 14, '2023-08-12 18:52:59'),
(7, 1, 207, 13, '2023-08-12 18:52:59'),
(8, 2, 98, 10, '2023-08-12 18:52:59');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notasdoano`
--

CREATE TABLE `notasdoano` (
  `idnotadoano` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `tipodeturma` varchar(222) NOT NULL DEFAULT 'Transição',
  `posicao` int(3) NOT NULL,
  `tipo` varchar(200) NOT NULL DEFAULT 'normal',
  `idmediaaquepertence` int(11) NOT NULL DEFAULT 0,
  `percentagem` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `notasdoano`
--

INSERT INTO `notasdoano` (`idnotadoano`, `titulo`, `idtrimestre`, `idanolectivo`, `tipodeturma`, `posicao`, `tipo`, `idmediaaquepertence`, `percentagem`, `data_modificacao`) VALUES
(2, 'MAC', 11, 4, 'Transição', 1, 'Normal', 2, 0, '2023-08-12 18:53:01'),
(3, 'MAC', 11, 4, 'Exame', 1, 'Normal', 3, 0, '2023-08-12 18:53:01'),
(4, 'PP', 11, 4, 'Transição', 2, 'Normal', 2, 0, '2023-08-12 18:53:01'),
(5, 'PP', 11, 4, 'Exame', 2, 'Normal', 3, 0, '2023-08-12 18:53:01'),
(6, 'PT', 11, 4, 'Transição', 3, 'Normal', 2, 0, '2023-08-12 18:53:01'),
(7, 'PT', 11, 4, 'Exame', 3, 'Normal', 3, 0, '2023-08-12 18:53:01'),
(8, 'MAC', 12, 4, 'Transição', 4, 'Normal', 4, 0, '2023-08-12 18:53:01'),
(9, 'PP', 12, 4, 'Transição', 5, 'Normal', 4, 0, '2023-08-12 18:53:01'),
(10, 'PT', 12, 4, 'Transição', 9, 'Normal', 4, 0, '2023-08-12 18:53:01'),
(11, 'MAC', 13, 4, 'Transição', 10, 'Normal', 6, 0, '2023-08-12 18:53:01'),
(12, 'PP', 13, 4, 'Transição', 11, 'Normal', 6, 0, '2023-08-12 18:53:01'),
(13, 'PT', 13, 4, 'Transição', 12, 'Normal', 6, 0, '2023-08-12 18:53:01'),
(14, 'MAC', 12, 4, 'Exame', 13, 'Normal', 5, 0, '2023-08-12 18:53:01'),
(15, 'PP', 12, 4, 'Exame', 14, 'Normal', 5, 0, '2023-08-12 18:53:01'),
(16, 'PT', 12, 4, 'Exame', 15, 'Normal', 5, 0, '2023-08-12 18:53:01'),
(17, 'MAC', 13, 4, 'Exame', 16, 'Normal', 7, 0, '2023-08-12 18:53:01'),
(18, 'PP', 13, 4, 'Exame', 17, 'Normal', 7, 0, '2023-08-12 18:53:01'),
(19, 'NE', 13, 4, 'Exame', 18, 'Exame', 9, 0.6, '2023-08-12 18:53:01'),
(20, 'NER', 13, 4, 'Exame', 19, 'Recurso', 0, 0, '2023-08-12 18:53:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `periodos`
--

CREATE TABLE `periodos` (
  `idperiodo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `periodos`
--

INSERT INTO `periodos` (`idperiodo`, `titulo`, `data_modificacao`) VALUES
(1, 'Manhã', '2023-08-12 18:53:03'),
(2, 'Tarde', '2023-08-12 18:53:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `presenca`
--

CREATE TABLE `presenca` (
  `idfalta` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `presenca`
--

INSERT INTO `presenca` (`idfalta`, `idfuncionario`, `ano`, `dia`, `mes`, `falta`, `horastrabalhadas`, `horasextras`, `remunerar`, `salariopordia`, `salariopelahorasextras`, `data_modificacao`) VALUES
(1, 31, 2023, 1, 8, 'P', 8, 0, 1, 2320, 0, '2023-08-19 20:50:04'),
(2, 31, 2023, 2, 8, 'P', 8, 0, 1, 2320, 0, '2023-08-19 20:50:05'),
(3, 31, 2023, 5, 8, 'P', 8, 0, 1, 2320, 0, '2023-08-19 20:50:08'),
(4, 31, 2023, 7, 8, 'P', 8, 0, 1, 2320, 0, '2023-08-19 20:50:10'),
(5, 31, 2023, 9, 8, '12', 0, 0, 0, 0, 0, '2023-08-19 20:50:16'),
(6, 31, 2023, 14, 8, '12', 0, 0, 0, 0, 0, '2023-08-19 20:50:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `presencaprofessores`
--

CREATE TABLE `presencaprofessores` (
  `idpresencaprofessor` int(11) NOT NULL,
  `idprofessor` int(11) NOT NULL,
  `diadapresenca` date NOT NULL,
  `totaldetempos` double NOT NULL DEFAULT 0,
  `salarioportempo` double NOT NULL DEFAULT 0,
  `iddisciplina` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `presencaprofessores`
--

INSERT INTO `presencaprofessores` (`idpresencaprofessor`, `idprofessor`, `diadapresenca`, `totaldetempos`, `salarioportempo`, `iddisciplina`, `data_modificacao`) VALUES
(1, 31, '2023-10-01', 4, 700, 308, '2023-10-08 03:32:00'),
(2, 31, '2023-10-03', 3, 700, 308, '2023-10-08 03:32:05'),
(3, 31, '2023-10-04', 2, 700, 308, '2023-10-08 03:32:08'),
(4, 46, '2023-10-02', 2, 500, 308, '2023-10-08 03:46:37'),
(5, 46, '2023-10-03', 4, 500, 308, '2023-10-08 03:46:39'),
(6, 46, '2023-10-04', 2, 500, 308, '2023-10-08 03:46:41'),
(7, 46, '2023-10-05', 2, 500, 308, '2023-10-08 03:46:43'),
(8, 46, '2023-10-09', 3, 500, 308, '2023-10-08 07:03:53'),
(9, 46, '2023-10-12', 5, 500, 308, '2023-10-08 07:03:54'),
(10, 46, '2023-10-13', 4, 500, 308, '2023-10-08 07:03:55'),
(11, 31, '2023-10-03', 4, 700, 309, '2023-10-08 07:28:15'),
(12, 31, '2023-10-02', 5, 700, 310, '2023-10-08 07:28:16'),
(13, 31, '2023-10-04', 7, 700, 311, '2023-10-08 07:28:20'),
(14, 31, '2023-10-04', 7, 700, 309, '2023-10-08 07:28:21'),
(15, 31, '2023-10-05', 4, 700, 310, '2023-10-08 07:28:23'),
(16, 31, '2023-10-06', 3, 700, 308, '2023-10-08 07:28:25'),
(17, 31, '2023-10-02', 2, 700, 308, '2023-10-08 08:23:34'),
(18, 31, '2023-10-11', 6, 700, 308, '2023-10-08 08:23:38'),
(19, 31, '2023-10-05', 4, 700, 311, '2023-10-08 08:24:25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `idproduto` int(11) NOT NULL,
  `nomedoproduto` varchar(100) NOT NULL,
  `preco` double NOT NULL DEFAULT 0,
  `precodecompra` double NOT NULL DEFAULT 0,
  `quantidade` double NOT NULL DEFAULT 0,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `datadeexpiracao` date DEFAULT NULL,
  `ultimavenda` date DEFAULT NULL,
  `estatus` varchar(30) NOT NULL DEFAULT 'operacional',
  `stockminimo` int(11) NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`idproduto`, `nomedoproduto`, `preco`, `precodecompra`, `quantidade`, `data`, `datadeexpiracao`, `ultimavenda`, `estatus`, `stockminimo`, `data_modificacao`) VALUES
(1, 'Uniforme Polo', 7000, 4000, 217, '2022-10-07 14:47:10', '0000-00-00', '2023-10-16', 'operacional', 20, '2023-10-16 04:54:05'),
(2, 'Calção', 6000, 3500, 15, '2022-11-08 10:02:05', '0000-00-00', '2023-10-16', 'operacional', 10, '2023-10-16 04:54:05'),
(3, 'Saia', 6000, 3500, 23, '2022-11-08 10:02:33', '0000-00-00', '2023-01-31', 'operacional', 10, '2023-08-12 18:53:11'),
(4, 'Folha de Prova', 75, 30, 5499, '2022-12-05 01:37:04', '0000-00-00', '2023-05-08', 'operacional', 50, '2023-08-12 18:53:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `propinas`
--

CREATE TABLE `propinas` (
  `idpropina` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `propinas`
--

INSERT INTO `propinas` (`idpropina`, `idaluno`, `idmatriculaeconfirmacao`, `idanolectivo`, `preco`, `multa`, `valorpago`, `desconto`, `mespago`, `datadopagamento`, `obs`, `codigodepropina`, `referencia`, `datadedeposito`, `data_modificacao`) VALUES
(1, 1304, 818, 4, 5500, 0, 5500, 0, '2023-04-01', '2023-07-27 09:13:23', '', 'CDP13041/78097', '79979', '2023-07-05', '2023-08-12 18:53:13'),
(2, 1304, 818, 4, 5500, 0, 5500, 0, '2023-05-01', '2023-07-27 09:14:00', '', 'CDP13042/44412', '76876', '2023-07-20', '2023-08-12 18:53:13'),
(3, 1304, 818, 4, 5500, 550, 6050, 0, '2023-06-01', '2023-10-09 02:34:11', '', 'CDP13043/12704', '', NULL, '2023-10-09 02:34:11'),
(4, 1313, 819, 4, 6500, 650, 6500, 500, '2023-10-01', '2023-10-09 02:34:40', '', 'CDP13134/76016', '', NULL, '2023-10-09 02:34:40'),
(5, 1304, 818, 4, 5500, 550, 6050, 0, '2023-07-01', '2023-10-09 14:02:35', '', 'CDP13045/54958', '', NULL, '2023-10-09 14:02:35'),
(6, 1304, 818, 4, 5500, 550, 6050, 0, '2023-08-01', '2023-10-09 14:02:39', '', 'CDP13046/62580', '', NULL, '2023-10-09 14:02:39'),
(7, 1304, 818, 4, 5500, 550, 6050, 0, '2023-09-01', '2023-10-09 14:02:43', '', 'CDP13047/56026', '', NULL, '2023-10-09 14:02:43'),
(8, 1314, 820, 4, 4500, 0, 4500, 0, '2023-08-01', '2023-10-10 09:15:59', '', 'CDP13148/25260', '', NULL, '2023-10-10 09:15:59');

-- --------------------------------------------------------

--
-- Estrutura para tabela `propinasdoatl`
--

CREATE TABLE `propinasdoatl` (
  `idpropinadoatl` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `propinasdotransporte`
--

CREATE TABLE `propinasdotransporte` (
  `idpropinadotransporte` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatoriodiario`
--

CREATE TABLE `relatoriodiario` (
  `idrelatoriodiario` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `idmatriculaeconfirmacao` int(11) NOT NULL,
  `iddisciplina` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `data` date NOT NULL,
  `idprofessor` int(11) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `saidas`
--

CREATE TABLE `saidas` (
  `idsaida` int(11) NOT NULL,
  `idfuncionario` int(11) DEFAULT NULL,
  `descricao` varchar(220) DEFAULT NULL,
  `tipo` varchar(60) DEFAULT NULL,
  `valor` double NOT NULL DEFAULT 0,
  `divida` double NOT NULL DEFAULT 0,
  `datadasaida` datetime NOT NULL DEFAULT current_timestamp(),
  `idtipo` int(11) DEFAULT NULL,
  `idanolectivo` int(11) NOT NULL DEFAULT 2,
  `formadesaida` varchar(200) NOT NULL DEFAULT 'Dinheiro',
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `salario`
--

CREATE TABLE `salario` (
  `idsalario` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `salas`
--

CREATE TABLE `salas` (
  `idsala` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `salas`
--

INSERT INTO `salas` (`idsala`, `titulo`, `data_modificacao`) VALUES
(1, '1', '2023-08-12 19:08:20'),
(2, '2', '2023-08-12 19:08:20'),
(3, '3', '2023-08-12 19:08:20'),
(4, '4', '2023-08-12 19:08:20'),
(5, '5', '2023-08-12 19:08:20'),
(6, '6', '2023-08-12 19:08:20'),
(7, '7', '2023-08-12 19:08:20'),
(8, '8', '2023-08-12 19:08:20'),
(9, '9', '2023-08-12 19:08:20'),
(10, '10', '2023-08-12 19:08:20'),
(11, '11', '2023-08-12 19:08:20'),
(12, '12', '2023-08-12 19:08:20'),
(13, '13', '2023-08-12 19:08:20'),
(14, '14', '2023-08-12 19:08:20'),
(15, '15', '2023-08-12 19:08:20'),
(16, '16', '2023-08-12 19:08:20'),
(17, '17', '2023-08-12 19:08:20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `stock`
--

CREATE TABLE `stock` (
  `idstock` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `precodevenda` double NOT NULL DEFAULT 0,
  `precodecompra` double NOT NULL DEFAULT 0,
  `quantidade` int(8) NOT NULL DEFAULT 0,
  `datadecadastro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `stock`
--

INSERT INTO `stock` (`idstock`, `idproduto`, `precodevenda`, `precodecompra`, `quantidade`, `datadecadastro`, `data_modificacao`) VALUES
(1, 1, 7000, 7000, 150, '2022-10-07 14:47:10', '2023-08-12 19:08:22'),
(2, 1, 7000, 4000, 150, '2022-10-10 12:41:31', '2023-08-12 19:08:22'),
(3, 2, 6000, 3500, 25, '2022-11-08 10:02:05', '2023-08-12 19:08:22'),
(4, 3, 6000, 3500, 25, '2022-11-08 10:02:33', '2023-08-12 19:08:22'),
(5, 4, 75, 30, 6000, '2022-12-05 01:37:04', '2023-08-12 19:08:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipodedisciplinas`
--

CREATE TABLE `tipodedisciplinas` (
  `idtipodedisciplina` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `abreviatura` varchar(20) DEFAULT NULL,
  `tipodedisciplina` varchar(220) NOT NULL DEFAULT 'Normal',
  `agrupamento` varchar(200) DEFAULT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tipodedisciplinas`
--

INSERT INTO `tipodedisciplinas` (`idtipodedisciplina`, `titulo`, `abreviatura`, `tipodedisciplina`, `agrupamento`, `data_modificacao`) VALUES
(1, 'Matemática', 'MAT', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(2, 'Física', 'FIS', 'Chave', 'Formação Geral', '2023-08-12 19:08:23'),
(3, 'Biologia', 'BIO', 'Chave', 'Formação Específica', '2023-08-12 19:08:23'),
(4, 'Química', 'QUIM', 'Normal', 'Formação Específica', '2023-08-12 19:08:23'),
(5, 'Inglês', 'ING', 'Normal', 'Opção', '2023-08-12 19:08:23'),
(6, 'Educação Física', 'Ed. Física', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(7, 'Língua Portuguesa ', 'L. Port', 'Chave', 'Formação Geral', '2023-08-12 19:08:23'),
(8, 'Estudo do Meio', 'Est. Meio', 'Chave', 'Formação Geral', '2023-08-12 19:08:23'),
(9, 'Geometria Descritiva', 'Geom. Desc', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(10, 'Geologia', 'Geol', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(11, 'Geografia', 'Geog', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(12, 'Ciência da Natureza', 'C. Natureza', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(13, 'Informática', 'Informática', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(14, 'Empreendedorismo', 'EMP', 'Normal', 'Opção', '2023-08-12 19:08:23'),
(15, 'Educação Moral e Cívica', 'E.M.C', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(16, 'Educação Visual e Plastica', 'E.V.P', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(17, 'Educação Manual e Plastica', 'E.M.P', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(18, 'História', 'Histo', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(19, 'Direito', 'DRT', 'Chave', 'Formação Geral', '2023-08-12 19:08:23'),
(20, 'Economia', 'ECON', 'Chave', 'Formação Geral', '2023-08-12 19:08:23'),
(21, 'Densenvolvimento ', 'DES', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(22, 'Filosofia', 'FILOS', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(23, 'Sociologia', 'SOCIOL', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(24, 'Educação Musical', 'Ed. Musical', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(25, 'Estudo do Meio Físico', 'E.M.F', 'Normal', 'Formação Geral', '2023-08-12 19:08:23'),
(26, 'Representação Matemática', 'R. Mat', 'Chave', 'Formação Geral', '2023-08-12 19:08:23'),
(27, 'Comunicação Linguística', 'C.Linguística', 'Chave', 'Formação Geral', '2023-08-12 19:08:23'),
(28, 'Educação Laboral', 'Ed. Lab', 'Normal', 'Formação Geral', '2023-08-12 19:08:23');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipodesaidas`
--

CREATE TABLE `tipodesaidas` (
  `idtipodesaida` int(11) NOT NULL,
  `tipo` varchar(220) NOT NULL,
  `categoria` varchar(200) NOT NULL DEFAULT 'Custos Variados',
  `numerodesaida` int(11) NOT NULL DEFAULT 0,
  `valorlimite` double NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tipodesaidas`
--

INSERT INTO `tipodesaidas` (`idtipodesaida`, `tipo`, `categoria`, `numerodesaida`, `valorlimite`, `data_modificacao`) VALUES
(1, 'Salário', 'Gastos com o Pessoal', 11, 500000, '2023-08-12 19:08:24'),
(2, 'Energia', 'Custos Variados', 4, 8000, '2023-08-12 19:08:24'),
(3, 'Gastos Exporâticos', 'Outros', 96, 45000, '2023-08-12 19:08:24'),
(4, 'Aluguer', 'Custos Variados', 2, 12000, '2023-08-12 19:08:24'),
(5, 'Alimentação', 'Custos Variados', 23, 100000, '2023-08-12 19:08:24'),
(6, 'Empréstimos', 'Gastos com o Pessoal', 1, 50000, '2023-08-12 19:08:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tiposdenotas`
--

CREATE TABLE `tiposdenotas` (
  `idtipodenota` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `idtrimestre` int(11) NOT NULL,
  `percentagemnotrimestre` double NOT NULL DEFAULT 0.5,
  `posicao` int(2) NOT NULL DEFAULT 1,
  `especial` int(1) NOT NULL DEFAULT 0,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tiposdenotas`
--

INSERT INTO `tiposdenotas` (`idtipodenota`, `titulo`, `idanolectivo`, `idtrimestre`, `percentagemnotrimestre`, `posicao`, `especial`, `data_modificacao`) VALUES
(1, 'MAC', 0, 1, 0.33, 1, 0, '2023-08-12 19:08:25'),
(2, 'PP   ', 0, 1, 0.33, 2, 0, '2023-08-12 19:08:25'),
(3, 'MAC', 0, 2, 0.33, 3, 0, '2023-08-12 19:08:25'),
(4, 'CPP', 0, 2, 0.33, 4, 0, '2023-08-12 19:08:25'),
(5, 'MAC', 0, 3, 0.3, 5, 0, '2023-08-12 19:08:25'),
(6, 'CPP', 0, 3, 0.3, 6, 0, '2023-08-12 19:08:25'),
(9, 'CPP', 0, 7, 0.3, 2, 0, '2023-08-12 19:08:25'),
(10, 'MAC', 0, 6, 0.3, 1, 0, '2023-08-12 19:08:25'),
(11, 'CPP', 0, 6, 0.3, 2, 0, '2023-08-12 19:08:25'),
(12, 'MAC', 0, 5, 0.3, 1, 0, '2023-08-12 19:08:25'),
(13, 'CPP', 0, 5, 0.3, 2, 0, '2023-08-12 19:08:25'),
(15, 'CPE', 2, 0, 0.6, 1, 1, '2023-08-12 19:08:25'),
(16, 'NER', 2, 0, 1, 2, 1, '2023-08-12 19:08:25'),
(17, 'PT', 2, 3, 0.4, 9, 0, '2023-08-12 19:08:25'),
(18, 'PT', 2, 2, 0.34, 6, 0, '2023-08-12 19:08:25'),
(19, 'PT', 2, 1, 0.34, 3, 0, '2023-08-12 19:08:25'),
(20, ' MAC   ', 4, 13, 0.3, 1, 0, '2023-08-12 19:08:25'),
(21, ' NPP   ', 4, 13, 0.3, 2, 0, '2023-08-12 19:08:25'),
(22, ' NPT   ', 4, 13, 0.4, 3, 0, '2023-08-12 19:08:25'),
(23, 'MAC', 4, 12, 0.3, 1, 0, '2023-08-12 19:08:25'),
(24, 'NPP', 4, 12, 0.3, 2, 0, '2023-08-12 19:08:25'),
(25, 'NPT', 4, 12, 0.4, 3, 0, '2023-08-12 19:08:25'),
(26, 'MAC', 4, 11, 0.3, 1, 0, '2023-08-12 19:08:25'),
(27, 'NPP', 4, 11, 0.3, 2, 0, '2023-08-12 19:08:25'),
(28, 'NPT', 4, 11, 0.4, 3, 0, '2023-08-12 19:08:25'),
(29, 'NE', 4, 0, 0.6, 1, 1, '2023-08-12 19:08:25'),
(30, 'MF', 4, 0, 1, 2, 1, '2023-08-12 19:08:25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `transportes`
--

CREATE TABLE `transportes` (
  `idtransporte` int(11) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `propina` double NOT NULL DEFAULT 0,
  `matricula` double NOT NULL DEFAULT 0,
  `pessoal` varchar(252) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `transportes`
--

INSERT INTO `transportes` (`idtransporte`, `idanolectivo`, `titulo`, `descricao`, `propina`, `matricula`, `pessoal`, `data_modificacao`) VALUES
(1, 4, 'Transporte Zango 2', 'Alunos do Zango 2 e 4', 2500, 6000, 'Filipe Andre  r\r\ne Pedro Gregor', '2023-08-12 19:08:27'),
(2, 4, 'Transporte Mabor', 'leva os alunos de Viana', 6000, 2500, 'Pedro e António\r\n', '2023-08-12 19:08:27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `trimestres`
--

CREATE TABLE `trimestres` (
  `idtrimestre` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `numerodenotas` int(4) NOT NULL,
  `idanolectivo` int(11) NOT NULL,
  `nomedamedia` varchar(6) NOT NULL,
  `arredondarmedia` int(1) NOT NULL DEFAULT 2,
  `percentagemnoanolectivo` double NOT NULL DEFAULT 0.33,
  `posicao` int(1) NOT NULL,
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `trimestres`
--

INSERT INTO `trimestres` (`idtrimestre`, `titulo`, `numerodenotas`, `idanolectivo`, `nomedamedia`, `arredondarmedia`, `percentagemnoanolectivo`, `posicao`, `data_modificacao`) VALUES
(1, 'Iº', 3, 2, 'MT1', 0, 0.33, 1, '2023-08-12 19:08:28'),
(2, 'IIº', 3, 2, 'MT2', 0, 0.33, 2, '2023-08-12 19:08:28'),
(3, 'IIIº', 3, 2, 'MT3', 0, 0.33, 3, '2023-08-12 19:08:28'),
(5, 'Iº', 2, 1, 'CT1', 0, 0.33, 1, '2023-08-12 19:08:28'),
(6, 'IIº', 2, 1, 'CT2', 0, 0.33, 2, '2023-08-12 19:08:28'),
(7, 'IIIº', 2, 1, 'CT3', 0, 0.33, 3, '2023-08-12 19:08:28'),
(8, 'Iº', 2, 3, 'CT1', 0, 0.33, 1, '2023-08-12 19:08:28'),
(9, 'IIº', 2, 3, 'CT2', 0, 0.33, 2, '2023-08-12 19:08:28'),
(10, 'IIIº', 2, 3, 'CT3', 0, 0.33, 3, '2023-08-12 19:08:28'),
(11, 'Iº', 5, 4, 'MT1', 0, 0.33, 1, '2023-08-12 19:08:28'),
(12, 'IIº', 5, 4, 'MT2', 0, 0.33, 2, '2023-08-12 19:08:28'),
(13, 'IIIº', 5, 4, 'MT3', 0, 0.34, 3, '2023-08-12 19:08:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `idturma` int(11) NOT NULL,
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
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`idturma`, `idanolectivo`, `titulo`, `idperiodo`, `idciclo`, `idcurso`, `idsala`, `idclasse`, `propina`, `reconfirmacao`, `matricula`, `eclassedeexame`, `minimoparapositiva`, `valormaximo`, `valorminimo`, `classificacaopositiva`, `classificacaonegativa`, `idcoordenador`, `data_modificacao`) VALUES
(1, 4, 'Pré-A', 1, 1, 1, 1, 13, 4000, 2000, 4000, 'Não', 5, 10, 0, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(2, 4, 'Pré-B', 1, 1, 1, 5, 13, 4000, 2000, 4000, 'Não', 5, 10, 0, 'Transita', 'N/ Transita', 0, '2023-08-12 19:08:30'),
(3, 4, '1A', 1, 1, 1, 2, 1, 4500, 2000, 4000, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(4, 4, '1B', 1, 1, 1, 3, 1, 4500, 2000, 4500, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(5, 4, '2A', 1, 1, 1, 4, 2, 4500, 2000, 4500, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(6, 4, '2B', 1, 1, 1, 6, 2, 4500, 2000, 4500, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(7, 4, '3A', 1, 1, 1, 8, 3, 4500, 2000, 4500, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(8, 4, '3B', 1, 1, 1, 7, 3, 4500, 2000, 4500, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(9, 4, '4A', 1, 1, 1, 11, 4, 4500, 2000, 4500, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(10, 4, '4B', 1, 1, 1, 10, 4, 4500, 2000, 4500, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(11, 4, '4C', 2, 1, 1, 9, 4, 4500, 2000, 4500, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 0, '2023-08-12 19:08:30'),
(12, 4, '7A', 2, 2, 1, 2, 7, 6000, 2000, 4000, 'Não', 10, 20, 7, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(13, 4, '7B', 2, 2, 1, 3, 7, 6000, 2000, 4000, 'Não', 10, 20, 7, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(14, 4, '7C', 2, 1, 1, 4, 7, 6000, 2000, 4000, 'Não', 10, 20, 7, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(15, 4, '8A', 2, 2, 1, 8, 8, 6000, 2000, 4000, 'Não', 10, 20, 7, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(16, 4, '8B', 2, 2, 1, 7, 8, 6000, 2000, 4000, 'Não', 10, 20, 7, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(17, 4, '8C', 2, 2, 1, 12, 8, 6000, 2000, 4000, 'Não', 10, 20, 7, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(18, 4, '9A', 2, 2, 1, 13, 9, 6500, 2000, 4000, 'Sim', 10, 20, 0, 'Apto', 'N/ Apto', 31, '2023-08-12 19:08:30'),
(19, 4, '9B', 2, 2, 1, 14, 9, 6500, 2000, 4000, 'Sim', 10, 20, 0, 'Apto', 'N/ Apto', 31, '2023-08-12 19:08:30'),
(20, 4, '9C', 2, 2, 1, 9, 9, 6500, 2000, 4000, 'Sim', 10, 20, 0, 'Apto', 'N/ Apto', 0, '2023-08-12 19:08:30'),
(21, 4, '6A', 1, 1, 1, 14, 6, 5500, 2000, 4000, 'Sim', 5, 10, 0, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(22, 4, '6B', 1, 1, 1, 16, 6, 5500, 2000, 4000, 'Sim', 5, 10, 0, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(23, 4, '6C', 1, 1, 1, 12, 6, 5500, 2000, 4000, 'Sim', 5, 10, 2, 'Transita', 'N/ Transita', 0, '2023-08-12 19:08:30'),
(24, 4, '5A', 2, 1, 1, 12, 5, 5500, 2000, 4000, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(25, 4, '5B', 2, 1, 1, 13, 5, 5500, 2000, 4000, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(26, 4, '5C', 1, 1, 1, 9, 5, 5500, 2000, 4000, 'Não', 5, 10, 2, 'Transita', 'N/ Transita', 0, '2023-08-12 19:08:30'),
(27, 4, '10-C.E.J', 2, 3, 1, 9, 10, 7000, 2000, 4000, 'Não', 10, 20, 7, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(28, 4, '11-C.E.J', 2, 3, 1, 10, 11, 6500, 2000, 4000, 'Não', 10, 20, 7, 'Transita', 'N/ Transita', 31, '2023-10-10 09:19:19'),
(29, 4, '12-C.E.J', 2, 3, 1, 16, 12, 8000, 2000, 4000, 'Sim', 10, 20, 7, 'Apto', 'N/ Apto', 31, '2023-08-12 19:08:30'),
(30, 4, '10-C.F.B', 2, 3, 1, 17, 10, 7000, 2000, 4000, 'Não', 10, 20, 7, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(31, 4, '11-C.F.B', 2, 3, 1, 6, 11, 7500, 2000, 4000, 'Não', 10, 20, 7, 'Transita', 'N/ Transita', 31, '2023-08-12 19:08:30'),
(32, 4, '12-C.F.B', 2, 3, 1, 11, 12, 8000, 2000, 4000, 'Sim', 10, 20, 7, 'Apto', 'N/ Apto', 31, '2023-08-12 19:08:30'),
(33, 2, 'PreA', 2, 1, 1, 9, 14, 45000, 4000, 10000, 'Não', 10, 20, 0, 'Apto', 'N/ Apto', 0, '2023-10-10 09:17:31'),
(34, 5, '10-C.E.J', 2, 1, 3, 9, 14, 45000, 2000, 4000, 'Não', 10, 20, 0, 'Apto', 'N/ Apto', 54, '2023-10-16 03:33:24'),
(35, 4, '10-C.E.J', 2, 1, 1, 9, 14, 45000, 2000, 4000, 'Não', 10, 20, 0, 'Transita', 'N/ Transita', 0, '2023-10-16 03:34:08');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`idadministrador`);

--
-- Índices de tabela `administradoresalunos`
--
ALTER TABLE `administradoresalunos`
  ADD PRIMARY KEY (`idadministradoraluno`);

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`idagenda`);

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`idaluno`);

--
-- Índices de tabela `anoslectivos`
--
ALTER TABLE `anoslectivos`
  ADD PRIMARY KEY (`idanolectivo`);

--
-- Índices de tabela `atl`
--
ALTER TABLE `atl`
  ADD PRIMARY KEY (`idatl`);

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`idavaliacao`);

--
-- Índices de tabela `cadeirasdeixadas`
--
ALTER TABLE `cadeirasdeixadas`
  ADD PRIMARY KEY (`idcadeiradeixada`);

--
-- Índices de tabela `ciclos`
--
ALTER TABLE `ciclos`
  ADD PRIMARY KEY (`idciclo`);

--
-- Índices de tabela `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`idclasse`);

--
-- Índices de tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD KEY `idproduto` (`idproduto`),
  ADD KEY `idcliente` (`idaluno`);

--
-- Índices de tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idcompra`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idcurso`);

--
-- Índices de tabela `dadosdaempresa`
--
ALTER TABLE `dadosdaempresa`
  ADD PRIMARY KEY (`iddadosdaempresa`);

--
-- Índices de tabela `descadastrados`
--
ALTER TABLE `descadastrados`
  ADD PRIMARY KEY (`iddescadastrado`);

--
-- Índices de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`iddisciplina`);

--
-- Índices de tabela `documentostratados`
--
ALTER TABLE `documentostratados`
  ADD PRIMARY KEY (`iddocumentotratado`);

--
-- Índices de tabela `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`identrada`);

--
-- Índices de tabela `faltas`
--
ALTER TABLE `faltas`
  ADD PRIMARY KEY (`idfalta`);

--
-- Índices de tabela `formasdepagamento`
--
ALTER TABLE `formasdepagamento`
  ADD PRIMARY KEY (`idformadepagamento`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`idfuncionario`);

--
-- Índices de tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`idhistorico`),
  ADD KEY `idfuncionario` (`idfuncionario`);

--
-- Índices de tabela `historico_sincronizacao`
--
ALTER TABLE `historico_sincronizacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `impostos`
--
ALTER TABLE `impostos`
  ADD PRIMARY KEY (`idimposto`);

--
-- Índices de tabela `lembretes`
--
ALTER TABLE `lembretes`
  ADD PRIMARY KEY (`idlembrete`);

--
-- Índices de tabela `matriculaseconfirmacoes`
--
ALTER TABLE `matriculaseconfirmacoes`
  ADD PRIMARY KEY (`idmatriculaeconfirmacao`);

--
-- Índices de tabela `matriculatransporte`
--
ALTER TABLE `matriculatransporte`
  ADD PRIMARY KEY (`idmatriculatransporte`);

--
-- Índices de tabela `mediasdoano`
--
ALTER TABLE `mediasdoano`
  ADD PRIMARY KEY (`idmediadoano`);

--
-- Índices de tabela `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`idmeta`);

--
-- Índices de tabela `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`idnota`);

--
-- Índices de tabela `notasavaliacao`
--
ALTER TABLE `notasavaliacao`
  ADD PRIMARY KEY (`idnotaavaliacao`);

--
-- Índices de tabela `notasdoano`
--
ALTER TABLE `notasdoano`
  ADD PRIMARY KEY (`idnotadoano`);

--
-- Índices de tabela `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`idperiodo`);

--
-- Índices de tabela `presenca`
--
ALTER TABLE `presenca`
  ADD PRIMARY KEY (`idfalta`),
  ADD KEY `idfuncionario` (`idfuncionario`);

--
-- Índices de tabela `presencaprofessores`
--
ALTER TABLE `presencaprofessores`
  ADD PRIMARY KEY (`idpresencaprofessor`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idproduto`);

--
-- Índices de tabela `propinas`
--
ALTER TABLE `propinas`
  ADD PRIMARY KEY (`idpropina`);

--
-- Índices de tabela `propinasdoatl`
--
ALTER TABLE `propinasdoatl`
  ADD PRIMARY KEY (`idpropinadoatl`);

--
-- Índices de tabela `propinasdotransporte`
--
ALTER TABLE `propinasdotransporte`
  ADD PRIMARY KEY (`idpropinadotransporte`);

--
-- Índices de tabela `relatoriodiario`
--
ALTER TABLE `relatoriodiario`
  ADD PRIMARY KEY (`idrelatoriodiario`);

--
-- Índices de tabela `saidas`
--
ALTER TABLE `saidas`
  ADD PRIMARY KEY (`idsaida`);

--
-- Índices de tabela `salario`
--
ALTER TABLE `salario`
  ADD PRIMARY KEY (`idsalario`);

--
-- Índices de tabela `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`idsala`);

--
-- Índices de tabela `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idstock`);

--
-- Índices de tabela `tipodedisciplinas`
--
ALTER TABLE `tipodedisciplinas`
  ADD PRIMARY KEY (`idtipodedisciplina`);

--
-- Índices de tabela `tipodesaidas`
--
ALTER TABLE `tipodesaidas`
  ADD PRIMARY KEY (`idtipodesaida`);

--
-- Índices de tabela `tiposdenotas`
--
ALTER TABLE `tiposdenotas`
  ADD PRIMARY KEY (`idtipodenota`);

--
-- Índices de tabela `transportes`
--
ALTER TABLE `transportes`
  ADD PRIMARY KEY (`idtransporte`);

--
-- Índices de tabela `trimestres`
--
ALTER TABLE `trimestres`
  ADD PRIMARY KEY (`idtrimestre`);

--
-- Índices de tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`idturma`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `idadministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `administradoresalunos`
--
ALTER TABLE `administradoresalunos`
  MODIFY `idadministradoraluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `idagenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `idaluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1319;

--
-- AUTO_INCREMENT de tabela `anoslectivos`
--
ALTER TABLE `anoslectivos`
  MODIFY `idanolectivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `atl`
--
ALTER TABLE `atl`
  MODIFY `idatl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `idavaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cadeirasdeixadas`
--
ALTER TABLE `cadeirasdeixadas`
  MODIFY `idcadeiradeixada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `ciclos`
--
ALTER TABLE `ciclos`
  MODIFY `idciclo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `classes`
--
ALTER TABLE `classes`
  MODIFY `idclasse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `idcompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `dadosdaempresa`
--
ALTER TABLE `dadosdaempresa`
  MODIFY `iddadosdaempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `descadastrados`
--
ALTER TABLE `descadastrados`
  MODIFY `iddescadastrado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `iddisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT de tabela `documentostratados`
--
ALTER TABLE `documentostratados`
  MODIFY `iddocumentotratado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `entradas`
--
ALTER TABLE `entradas`
  MODIFY `identrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7263;

--
-- AUTO_INCREMENT de tabela `faltas`
--
ALTER TABLE `faltas`
  MODIFY `idfalta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `formasdepagamento`
--
ALTER TABLE `formasdepagamento`
  MODIFY `idformadepagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `idfuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `idhistorico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_sincronizacao`
--
ALTER TABLE `historico_sincronizacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `impostos`
--
ALTER TABLE `impostos`
  MODIFY `idimposto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `lembretes`
--
ALTER TABLE `lembretes`
  MODIFY `idlembrete` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `matriculaseconfirmacoes`
--
ALTER TABLE `matriculaseconfirmacoes`
  MODIFY `idmatriculaeconfirmacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=827;

--
-- AUTO_INCREMENT de tabela `matriculatransporte`
--
ALTER TABLE `matriculatransporte`
  MODIFY `idmatriculatransporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mediasdoano`
--
ALTER TABLE `mediasdoano`
  MODIFY `idmediadoano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `metas`
--
ALTER TABLE `metas`
  MODIFY `idmeta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `notas`
--
ALTER TABLE `notas`
  MODIFY `idnota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `notasavaliacao`
--
ALTER TABLE `notasavaliacao`
  MODIFY `idnotaavaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `notasdoano`
--
ALTER TABLE `notasdoano`
  MODIFY `idnotadoano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `periodos`
--
ALTER TABLE `periodos`
  MODIFY `idperiodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `presenca`
--
ALTER TABLE `presenca`
  MODIFY `idfalta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `presencaprofessores`
--
ALTER TABLE `presencaprofessores`
  MODIFY `idpresencaprofessor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `propinas`
--
ALTER TABLE `propinas`
  MODIFY `idpropina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `propinasdoatl`
--
ALTER TABLE `propinasdoatl`
  MODIFY `idpropinadoatl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `propinasdotransporte`
--
ALTER TABLE `propinasdotransporte`
  MODIFY `idpropinadotransporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `relatoriodiario`
--
ALTER TABLE `relatoriodiario`
  MODIFY `idrelatoriodiario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `saidas`
--
ALTER TABLE `saidas`
  MODIFY `idsaida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `salario`
--
ALTER TABLE `salario`
  MODIFY `idsalario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `salas`
--
ALTER TABLE `salas`
  MODIFY `idsala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `stock`
--
ALTER TABLE `stock`
  MODIFY `idstock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tipodedisciplinas`
--
ALTER TABLE `tipodedisciplinas`
  MODIFY `idtipodedisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `tipodesaidas`
--
ALTER TABLE `tipodesaidas`
  MODIFY `idtipodesaida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tiposdenotas`
--
ALTER TABLE `tiposdenotas`
  MODIFY `idtipodenota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `transportes`
--
ALTER TABLE `transportes`
  MODIFY `idtransporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `trimestres`
--
ALTER TABLE `trimestres`
  MODIFY `idtrimestre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `idturma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
