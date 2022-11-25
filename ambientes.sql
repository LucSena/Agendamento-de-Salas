-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Nov-2022 às 03:04
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ambientes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_andar`
--

CREATE TABLE `tb_andar` (
  `id` int(11) NOT NULL,
  `andar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_andar`
--

INSERT INTO `tb_andar` (`id`, `andar`) VALUES
(1, 'Primeiro Andar'),
(2, 'Segundo Andar'),
(3, 'Terceiro Andar'),
(4, 'Quarto Andar'),
(5, 'Quinto Andar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_bloco`
--

CREATE TABLE `tb_bloco` (
  `id` int(11) NOT NULL,
  `bloco` varchar(20) NOT NULL,
  `descricao` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_bloco`
--

INSERT INTO `tb_bloco` (`id`, `bloco`, `descricao`) VALUES
(1, 'Bloco A', 'Bloco redirecionado aos computadores'),
(2, 'Bloco B', ''),
(3, 'Bloco C', ''),
(4, 'Bloco C', ''),
(5, 'Bloco D', ''),
(6, 'Bloco E', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pc`
--

CREATE TABLE `tb_pc` (
  `id` int(11) NOT NULL,
  `computador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_salas`
--

CREATE TABLE `tb_salas` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `fk_andar` int(11) DEFAULT NULL,
  `fk_bloco` int(11) DEFAULT NULL,
  `Horario` time DEFAULT NULL,
  `Datas` date DEFAULT NULL,
  `HorarioFinal` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_salas`
--

INSERT INTO `tb_salas` (`id`, `nome`, `descricao`, `status`, `fk_andar`, `fk_bloco`, `Horario`, `Datas`, `HorarioFinal`) VALUES
(25, 'C-15', 'Sala de computadores da rede sesi, utilizados pelo alunos do curso do senai e oferecidos pelo lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem senai naisneian senai senai senai senai senai senai senai senai senai', '3', 2, 3, '10:54:00', '2022-09-13', NULL),
(28, 'C-14', 'Essa sala é composta por diversos computadores com tecnologias de ponta e podem ser utilizados por alunos dos cursos, esses alunos podem fazer proveito maximo de seu corso com seus pcs', '3', 1, 3, NULL, NULL, NULL),
(29, 'C-13', 'Essa sala é composta por diversos computadores com tecnologias de ponta e podem ser utilizados por alunos dos cursos, esses alunos podem fazer proveito maximo de seu corso com seus pcs', '1', 2, 3, '09:20:00', '2022-10-01', NULL),
(30, 'C-12', 'Essa sala é composta por diversos computadores com tecnologias de ponta e podem ser utilizados por alunos dos cursos, esses alunos podem fazer proveito maximo de seu corso com seus pcs', '1', 2, 3, '21:31:00', '2022-09-29', '22:32:00'),
(31, 'C-11', 'Essa sala é composta por diversos computadores com tecnologias de ponta e podem ser utilizados por alunos dos cursos, esses alunos podem fazer proveito maximo de seu corso com seus pcs', '2', 2, 3, '23:25:00', '2022-11-24', '00:25:00'),
(32, 'C-10', 'Essa sala é composta por diversos computadores com tecnologias de ponta e podem ser utilizados por alunos dos cursos, esses alunos podem fazer proveito maximo de seu corso com seus pcs', '1', 2, 3, '21:45:00', '2022-09-29', '21:46:00'),
(33, 'C-8', 'Essa sala é composta por diversos computadores com tecnologias de ponta e podem ser utilizados por alunos dos cursos, esses alunos podem fazer proveito maximo de seu corso com seus pcs', '2', 1, 1, NULL, NULL, NULL),
(34, 'C-9', 'Essa sala é composta por diversos computadores com tecnologias de ponta e podem ser utilizados por alunos dos cursos, esses alunos podem fazer proveito maximo de seu corso com seus pcs', '2', 1, 1, NULL, NULL, NULL),
(36, 'M-30', 'Sala de aula normal', '2', 1, 1, '08:50:00', '2022-09-29', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `instituicao` varchar(10) NOT NULL,
  `nivel` varchar(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nome`, `email`, `senha`, `instituicao`, `nivel`) VALUES
(14, 'Admin', 'adm@gmail.com', '202cb962ac59075b964b07152d234b70', '2', '2'),
(16, 'Usuario', 'Usuario@gmail.com', '202cb962ac59075b964b07152d234b70', '1', '1');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_andar`
--
ALTER TABLE `tb_andar`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_bloco`
--
ALTER TABLE `tb_bloco`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_pc`
--
ALTER TABLE `tb_pc`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_salas`
--
ALTER TABLE `tb_salas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fk_andar` (`fk_andar`),
  ADD KEY `id_fk_bloco` (`fk_bloco`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_andar`
--
ALTER TABLE `tb_andar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_bloco`
--
ALTER TABLE `tb_bloco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_pc`
--
ALTER TABLE `tb_pc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_salas`
--
ALTER TABLE `tb_salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_salas`
--
ALTER TABLE `tb_salas`
  ADD CONSTRAINT `id_fk_andar` FOREIGN KEY (`fk_andar`) REFERENCES `tb_andar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_fk_bloco` FOREIGN KEY (`fk_bloco`) REFERENCES `tb_bloco` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
