-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/11/2024 às 17:30
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_vigia_chuva`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_comentarios`
--

CREATE TABLE `tb_comentarios` (
  `id_comentario` int(11) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `comentario` text NOT NULL,
  `ponto_referencia` varchar(255) NOT NULL,
  `grau_alagamento` varchar(50) NOT NULL,
  `data_hora` datetime DEFAULT current_timestamp(),
  `id_sinalizacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tb_comentarios`
--

INSERT INTO `tb_comentarios` (`id_comentario`, `nome_usuario`, `comentario`, `ponto_referencia`, `grau_alagamento`, `data_hora`, `id_sinalizacao`) VALUES
(8, 'melissa', 'já esta começando a encher, no fundo da rua principalmente.', '7 de setembro', 'medio', '2024-10-20 17:37:46', 22),
(12, 'miguel', 'começando a alagar', 'perto da rotatoria', 'leve', '2024-11-01 15:50:40', 32),
(13, 'miguel', 'começou a alagar, valeta já esta cheia de água', 'etec ', 'medio', '2024-11-01 17:13:57', 33),
(14, 'miguel', 'muito cheio, carro nenhum passa', 'trevo da pedreira', 'grave', '2024-11-01 17:17:03', 34),
(15, 'miguel', 'muito cheio por aqui', 'praça do centro', 'grave', '2024-11-01 17:20:21', 35);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sinalizacao`
--

CREATE TABLE `tb_sinalizacao` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ativo` char(3) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `data_hora` datetime NOT NULL,
  `ponto_referencia` varchar(255) NOT NULL,
  `grau_alagamento` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tb_sinalizacao`
--

INSERT INTO `tb_sinalizacao` (`id`, `nome`, `ativo`, `latitude`, `longitude`, `data_hora`, `ponto_referencia`, `grau_alagamento`) VALUES
(1, 'Desconhecido', 'SIM', '-24.096320', '-46.624276', '2024-10-19 22:10:21', 'av xxx', 'leve'),
(2, 'Desconhecido', 'SIM', '-24.095869', '-46.623901', '2024-10-19 22:11:57', 'rua 11', 'grave'),
(3, 'Desconhecido', 'SIM', '-24.119378', '-46.688547', '2024-10-19 22:15:53', 'regina maria', 'leve'),
(4, 'Desconhecido', 'SIM', '-24.107000', '-46.652005', '2024-10-19 22:18:00', 'rua minas gerais', 'medio'),
(5, 'miguel', 'SIM', '-24.107176', '-46.645095', '2024-10-19 22:22:30', 'av xxx', 'medio'),
(6, 'miguel', 'SIM', '-24.114413', '-46.667433', '2024-10-19 22:29:43', 'rua xxxxx', 'medio'),
(7, 'gabriel cara', 'SIM', '-24.101170', '-46.637126', '2024-10-19 22:42:29', 'pista em frente ao vera', 'grave'),
(8, 'gabriel cara', 'SIM', '-24.095767', '-46.624882', '2024-10-19 23:03:23', 'xxxxx', 'medio'),
(9, 'toninohn', 'SIM', '-24.114756', '-46.664139', '2024-10-19 23:48:03', 'perto do postinho', 'medio'),
(19, 'melissa', 'SIM', '-24.099674', '-46.660051', '2024-10-20 17:32:13', 'av xxx', 'leve'),
(20, 'melissa', 'SIM', '-24.100105', '-46.654687', '2024-10-20 17:34:18', 'aaaa', 'leve'),
(21, 'melissa', 'SIM', '-24.105134', '-46.653131', '2024-10-20 17:34:54', 'aaaaa', 'leve'),
(22, 'melissa', 'SIM', '-24.102123', '-46.648378', '2024-10-20 17:37:46', '7 de setembro', 'medio'),
(23, 'melissa', 'SIM', '-24.109017', '-46.650052', '2024-10-20 18:11:06', 'lado praia', 'leve'),
(24, 'melissa', 'SIM', '-24.124959', '-46.685264', '2024-10-20 18:26:00', 'rua um', 'grave'),
(25, 'melissa', 'SIM', '-24.106148', '-46.650031', '2024-10-20 18:41:57', 'av xxx', 'medio'),
(26, 'melissa', 'SIM', '-24.117422', '-46.661811', '2024-10-20 18:46:38', 'aaa', 'leve'),
(27, 'melissa', 'SIM', '-24.105386', '-46.649339', '2024-10-20 18:59:51', 'jkhjçokç', 'medio'),
(28, 'melissa', 'SIM', '-24.105487', '-46.650943', '2024-10-20 19:01:07', 'rua minas gerais', 'medio'),
(29, 'melissa', 'SIM', '-24.104302', '-46.650133', '2024-10-20 19:01:53', 'av xxx', 'medio'),
(30, 'miguel', 'SIM', '-24.105296', '-46.651232', '2024-11-01 15:05:30', 'rua minas gerais', 'medio'),
(31, 'miguel', 'SIM', '-24.104806', '-46.64988', '2024-11-01 15:20:25', 'rua minas gerais', 'grave'),
(32, 'miguel', 'SIM', '-24.113375', '-46.662867', '2024-11-01 15:50:40', 'perto da rotatoria', 'leve'),
(33, 'miguel', 'SIM', '-24.122239', '-46.678493', '2024-11-01 17:13:57', 'etec ', 'medio'),
(34, 'miguel', 'SIM', '-24.094866', '-46.625569', '2024-11-01 17:17:03', 'trevo da pedreira', 'grave'),
(35, 'miguel', 'SIM', '-24.095212', '-46.621096', '2024-11-01 17:20:21', 'praça do centro', 'grave'),
(36, 'miguel', 'SIM', '-24.109208', '-46.650522', '2024-11-01 17:21:36', 'av são paulo', 'leve'),
(37, 'miguel', 'SIM', '-24.11964', '-46.668299', '2024-11-01 17:22:14', 'lado praia', 'grave'),
(38, 'miguel', 'SIM', '-24.122228', '-46.679499', '2024-11-01 17:22:50', 'perto da etec', 'medio'),
(39, 'miguel', 'SIM', '-24.098612', '-46.641154', '2024-11-01 17:23:55', 'vera cruz', 'medio'),
(40, 'miguel', 'SIM', '-24.09353', '-46.650089', '2024-11-01 17:24:47', 'vera', 'medio');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nm_user` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `dt_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nm_user`, `email`, `senha`, `dt_nascimento`) VALUES
(3, 'miguel', 'miguel@gmail.com', '$2y$10$HigIYJukPi0zzlf2NDY1FO9f35QX1txsOVhVpzI544AkPyQMb/vKW', '0000-00-00'),
(4, 'daniel cara', 'daniel@gmail.com', '$2y$10$XsRAkTQVkrkqE5RTkGKc9encsbQwzmD0a321YZ4QIggVeGX3uJlWe', '0000-00-00'),
(5, 'gabriel cara', 'gabriel@gmail.com', '$2y$10$95Lydj49.2zYyLFOnFOqKeFiMUJjujlY5niavUGcD/1hij6.bMGW6', '0000-00-00'),
(6, 'eduardo', 'edusambaqui@hotmai.com', '$2y$10$zdiPQ/WidiPnzBEv45fC7egs3gNsH1DPtoEA/bR9eMVNrIcM4qfqS', '0000-00-00'),
(7, 'vanessa', 'vanessa@gmail.com', '$2y$10$gundeGngAZrinxpQEmEZD.b247PiIX1pXvJvp4KzKKGQAy.h03Xuy', '0000-00-00'),
(8, 'odete', 'odete@gmail.com', '$2y$10$Q2rr2W4p3bv7PTfAizWIIeZOvaE0tYuBVKUQyZImpBLQnJ/0cAO5K', '0000-00-00'),
(9, 'toninho', 'toninho@gmail.com', '$2y$10$tu6pzpTFYVYvSENUjaqoUujOVwvuFG1zTaYBsO//M3AGfVznn5BYe', '0000-00-00'),
(10, 'melissa', 'melissa@gmail.com', '$2y$10$acuH9Wd1VyNJTG1CmvX8QOoHicVZLXX4WUOt2zGQD4O5AMyCJxkJS', '0000-00-00');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_sinalizacao` (`id_sinalizacao`);

--
-- Índices de tabela `tb_sinalizacao`
--
ALTER TABLE `tb_sinalizacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tb_sinalizacao`
--
ALTER TABLE `tb_sinalizacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  ADD CONSTRAINT `tb_comentarios_ibfk_1` FOREIGN KEY (`id_sinalizacao`) REFERENCES `tb_sinalizacao` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
