-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Out-2022 às 15:12
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
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `username` int(11) NOT NULL,
  `host` varchar(255) NOT NULL,
  `dyn` char(1) NOT NULL,
  `nat` char(1) NOT NULL,
  `acl` varchar(255) DEFAULT NULL,
  `port` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ramais`
--

INSERT INTO `ramais` (`id`, `name`, `username`, `host`, `dyn`, `nat`, `acl`, `port`, `status`) VALUES
(1, 7000, 7000, '181.219.125.7', 'D', 'N', NULL, 42367, 'OK'),
(2, 7001, 7001, '181.219.125.7', 'D', 'N', NULL, 42367, 'OK'),
(3, 7004, 7002, 'Unspecified', 'D', 'N', NULL, 0, 'UNKNOWN'),
(4, 7003, 7003, 'Unspecified', 'D', 'N', NULL, 0, 'UNKNOWN'),
(5, 7002, 7004, '181.219.125.7', 'D', 'N', NULL, 42367, 'OK');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ramais`
--
ALTER TABLE `ramais`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ramais`
--
ALTER TABLE `ramais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
