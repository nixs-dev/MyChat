create database mychat;
use mychat;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Ago-2021 às 18:24
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mychat`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `ID` int(10) NOT NULL,
  `idRemetente` int(5) NOT NULL,
  `idDestinatario` int(5) NOT NULL,
  `Conteudo_texto` varchar(300) NOT NULL,
  `Conteudo_blob` longblob NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `Fundo` longblob DEFAULT NULL,
  `Imagem` longblob DEFAULT NULL,
  `ID` int(5) NOT NULL,
  `Nick` varchar(20) NOT NULL,
  `Senha` varchar(20) NOT NULL,
  `UltimaVez` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Remetente` (`idRemetente`),
  ADD KEY `fk_Destinatario` (`idDestinatario`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`,`Nick`);
  
--
-- Limitadores para a tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `fk_Destinatario` FOREIGN KEY (`idDestinatario`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Remetente` FOREIGN KEY (`idRemetente`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE;
COMMIT;


--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`Fundo`, `Imagem`, `ID`, `Nick`, `Senha`, `UltimaVez`) VALUES
(NULL, NULL, 110, 'User3', 'usuario', '2021-09-16 10:41:17'),
(NULL, NULL, 1010, 'User2', 'usuario', '2021-09-16 10:41:17');
INSERT INTO `usuarios` (`Fundo`, `Imagem`, `ID`, `Nick`, `Senha`, `UltimaVez`) VALUES
(NULL, NULL, 60071, 'Joao', '321', '2021-09-16 10:41:17');
--

--
-- Extraindo dados da tabela `mensagens`
--

INSERT INTO `mensagens` (`ID`, `idRemetente`, `idDestinatario`, `Conteudo_texto`, `Conteudo_blob`) VALUES
(1, 1010, 60071, 'Oi', NULL),
(3, 60071, 110, 'Oi user', NULL);

-- Índices para tabelas despejadas
--


--
-- Restrições para despejos de tabelas
--



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
