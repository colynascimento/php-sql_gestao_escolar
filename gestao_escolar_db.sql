-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Set-2025 às 02:13
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
-- Banco de dados: `gestao_escolar_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `cpf` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nasc` date NOT NULL,
  `num_turma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`cpf`, `nome`, `data_nasc`, `num_turma`) VALUES
('111.111.111-11', 'João da Silva', '2010-05-15', 101),
('222.222.222-22', 'Maria Souza', '2010-09-20', 101),
('333.333.333-33', 'Pedro Santos', '2009-02-10', 201),
('444.444.444-44', 'Ana Oliveira', '2008-11-25', 102),
('555.555.555-55', 'Fernanda Lima', '2011-03-22', 103),
('666.666.666-66', 'Thiago Rocha', '2012-08-05', 202),
('777.777.777-77', 'Larissa Mendes', '2011-01-18', 202),
('888.888.888-88', 'Guilherme Castro', '2009-06-30', 201);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `cod_disc` int(11) NOT NULL,
  `nome_disciplina` varchar(100) NOT NULL,
  `carga_horaria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `disciplinas`
--

INSERT INTO `disciplinas` (`cod_disc`, `nome_disciplina`, `carga_horaria`) VALUES
(1, 'Matemática', 80),
(2, 'Português', 80),
(3, 'História', 60),
(4, 'Química', 90),
(5, 'Geografia', 60),
(6, 'Biologia', 70),
(7, 'Física', 90),
(8, 'Sociologia', 50),
(9, 'Artes', 40),
(10, 'Educação Física', 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `cpf` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nasc` date NOT NULL,
  `cod_disciplina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`cpf`, `nome`, `data_nasc`, `cod_disciplina`) VALUES
('000.000.000-00', 'Juliana Costa', '1992-06-08', NULL),
('111.111.111-11', 'Lucas Pereira', '1988-02-14', NULL),
('222.222.222-22', 'Mariana Neves', '1995-09-03', NULL),
('555.555.555-55', 'Carlos Lima', '1975-03-01', NULL),
('666.666.666-66', 'Marta Fernandes', '1980-07-22', NULL),
('777.777.777-77', 'Fernanda Dias', '1990-01-30', NULL),
('888.888.888-88', 'Ana Carolina', '1985-11-10', NULL),
('999.999.999-99', 'Rafael Souza', '1979-04-25', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_disciplina`
--

CREATE TABLE `professor_disciplina` (
  `cpf` varchar(20) NOT NULL,
  `cod_disc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professor_disciplina`
--

INSERT INTO `professor_disciplina` (`cpf`, `cod_disc`) VALUES
('000.000.000-00', 7),
('111.111.111-11', 9),
('222.222.222-22', 10),
('555.555.555-55', 1),
('555.555.555-55', 5),
('666.666.666-66', 2),
('666.666.666-66', 8),
('777.777.777-77', 3),
('888.888.888-88', 4),
('999.999.999-99', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `num_turma` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `turno` varchar(50) DEFAULT NULL,
  `sala` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`num_turma`, `nome`, `turno`, `sala`) VALUES
(101, '1º Ano A', 'Manhã', 'Sala 10'),
(102, '1º Ano B', 'Tarde', 'Sala 11'),
(103, '1º Ano C', 'Noite', 'Sala 12'),
(201, '2º Ano A', 'Manhã', 'Sala 20'),
(202, '2º Ano B', 'Tarde', 'Sala 21'),
(302, '3º Ano B', 'Tarde', 'Sala 31'),
(401, '4º Ano A', 'Noite', 'Sala 40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_disciplina`
--

CREATE TABLE `turma_disciplina` (
  `num_turma` int(11) NOT NULL,
  `cod_disc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turma_disciplina`
--

INSERT INTO `turma_disciplina` (`num_turma`, `cod_disc`) VALUES
(101, 1),
(101, 2),
(101, 3),
(102, 1),
(102, 5),
(102, 6),
(103, 2),
(103, 8),
(201, 4),
(201, 7),
(202, 1),
(202, 2),
(202, 9);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`cpf`),
  ADD KEY `num_turma` (`num_turma`);

--
-- Índices para tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`cod_disc`);

--
-- Índices para tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices para tabela `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  ADD PRIMARY KEY (`cpf`,`cod_disc`),
  ADD KEY `fk_disciplinas_professor_disciplina` (`cod_disc`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`num_turma`);

--
-- Índices para tabela `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  ADD PRIMARY KEY (`num_turma`,`cod_disc`),
  ADD KEY `cod_disc` (`cod_disc`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`num_turma`) REFERENCES `turmas` (`num_turma`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  ADD CONSTRAINT `fk_disciplinas_professor_disciplina` FOREIGN KEY (`cod_disc`) REFERENCES `disciplinas` (`cod_disc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_professores_professor_disciplina` FOREIGN KEY (`cpf`) REFERENCES `professores` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `professor_disciplina_ibfk_1` FOREIGN KEY (`cpf`) REFERENCES `professores` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `professor_disciplina_ibfk_2` FOREIGN KEY (`cod_disc`) REFERENCES `disciplinas` (`cod_disc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  ADD CONSTRAINT `turma_disciplina_ibfk_1` FOREIGN KEY (`num_turma`) REFERENCES `turmas` (`num_turma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `turma_disciplina_ibfk_2` FOREIGN KEY (`cod_disc`) REFERENCES `disciplinas` (`cod_disc`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
