-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Out-2022 às 05:37
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `monitoramento_de_ramais`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ramais`
--

CREATE TABLE `ramais` (
  `name` int(11) NOT NULL,
  `username` int(11) NOT NULL,
  `host` varchar(255) NOT NULL,
  `status_no_grupo` varchar(25) DEFAULT NULL,
  `agente` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ramais`
--

INSERT INTO `ramais` (`name`, `username`, `host`, `status_no_grupo`, `agente`) VALUES
(7000, 7000, '181.219.125.7', 'ocupado', 'Chaves'),
(7001, 7001, '181.219.125.7', 'chamando', 'Kiko'),
(7002, 7004, '181.219.125.7', 'pausa', 'Godines'),
(7003, 7003, '(Unspecified)', 'indisponivel', 'Nhonho'),
(7004, 7002, '(Unspecified)', 'indisponivel', 'Chiquinha'),
(7005, 7005, '181.219.125.7', 'disponivel', 'Sem Agente');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ramais`
--
ALTER TABLE `ramais`
  ADD PRIMARY KEY (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
