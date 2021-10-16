-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 23-Set-2019 às 20:51
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--
CREATE DATABASE IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;
USE `biblioteca`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) COLLATE utf8_swedish_ci DEFAULT NULL,
  `senha` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`id`, `nome`, `senha`, `email`) VALUES
(1, 'admin', '123', 'admin@etec');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`idCurso`, `nome`) VALUES
(1, 'Administração'),
(2, 'Desenvolvimento de Sistemas'),
(3, 'Edificações'),
(4, 'Eletrotécnica'),
(5, 'Farmácia'),
(6, 'Informática'),
(7, 'Informática para internet'),
(8, 'Logística'),
(9, 'Manutenção automotiva'),
(10, 'Mecânica'),
(11, 'Mecatrônica'),
(12, 'Meio ambiente'),
(13, 'Nutrição'),
(14, 'Química'),
(15, 'Recursos Humanos'),
(16, 'Segurança do trabalho');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `idProfessor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `senha` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `coordenador` tinyint(1) DEFAULT NULL,
  `email` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `idCurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProfessor`),
  KEY `idCurso` (`idCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`idProfessor`, `nome`, `senha`, `coordenador`, `email`, `idCurso`) VALUES
(1, 'sid', '123', 1, 'sid@etec', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

DROP TABLE IF EXISTS `projeto`;
CREATE TABLE IF NOT EXISTS `projeto` (
  `idProjeto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `alunos` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `arquivo` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `favorito` tinyint(1) DEFAULT NULL,
  `verificado` tinyint(1) DEFAULT NULL,
  `ano` char(4) COLLATE utf8_swedish_ci NOT NULL,
  `idCurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProjeto`),
  KEY `idCurso` (`idCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`idProjeto`, `nome`, `alunos`, `arquivo`, `favorito`, `verificado`, `ano`, `idCurso`) VALUES
(1, 'Biblioteca virtual de TCCs', 'Ruan Camargo, Gabriel Arruda e Otavio Garcia', '20191010', 1, 1, '2019', 6),
(2, 'Lanchonete Mox\'s', 'Lucas Takahagui, Eduardo Guimarães e Pedro Santos', '20190801', 1, 1, '2017', 6),
(3, 'Home Service', 'João Epaminondas, João de Andrade e José da Silva', '20190605', 1, 1, '2019', 6),
(4, 'Noblis Organization', 'Gustavo Rodrigues, Lucas Marques e Mateus Macedo', '20190301', 0, 0, '2020', 6);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
