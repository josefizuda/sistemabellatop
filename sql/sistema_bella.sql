-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 18/02/2019 às 17:27
-- Versão do servidor: 5.7.25-0ubuntu0.16.04.2
-- Versão do PHP: 7.0.33-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_bella`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acess_level`
--

CREATE TABLE `acess_level` (
  `acess_level_id` int(11) NOT NULL,
  `acess_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `acess_level`
--

INSERT INTO `acess_level` (`acess_level_id`, `acess_level`) VALUES
(1, 'Padrão'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cad_status`
--

CREATE TABLE `cad_status` (
  `cad_status_id` int(11) NOT NULL,
  `cad_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `cad_status`
--

INSERT INTO `cad_status` (`cad_status_id`, `cad_status`) VALUES
(1, 'Ativo'),
(2, 'Bloqueado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emitir_ordem`
--

CREATE TABLE `emitir_ordem` (
  `emit_id` int(11) NOT NULL,
  `cod_provider` int(11) NOT NULL,
  `cod_marcas` int(1) NOT NULL,
  `cod_size` int(11) NOT NULL,
  `qtyentry` varchar(255) NOT NULL,
  `qtyexit` int(255) DEFAULT NULL,
  `qtysaldo` int(255) DEFAULT NULL,
  `order_sign` datetime NOT NULL,
  `cod_order_status` int(11) NOT NULL,
  `cod_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `emitir_ordem`
--

INSERT INTO `emitir_ordem` (`emit_id`, `cod_provider`, `cod_marcas`, `cod_size`, `qtyentry`, `qtyexit`, `qtysaldo`, `order_sign`, `cod_order_status`, `cod_user`) VALUES
(77, 5, 3, 0, '1000', 0, 0, '2019-02-07 15:57:47', 1, 1),
(78, 5, 3, 1, '1500', 0, 0, '2019-02-07 15:58:54', 1, 1),
(79, 6, 3, 0, '1000', 0, 0, '2019-02-07 16:23:00', 1, 3),
(80, 5, 3, 2, '1', 1, -1, '2019-02-07 17:02:42', 1, 3),
(82, 7, 3, 0, '5000', 0, 0, '2019-02-13 17:31:42', 1, 1),
(83, 5, 5, 2, '2500', 0, 0, '2019-02-13 17:32:00', 1, 1),
(84, 5, 3, 0, '2345', 0, 0, '2019-02-13 17:32:16', 1, 1),
(85, 6, 3, 1, '2500', 0, 0, '2019-02-13 17:32:30', 1, 1),
(86, 6, 3, 0, '1000', 0, 0, '2019-02-13 17:32:50', 1, 1),
(87, 9, 4, 5, '1000', 0, 0, '2019-02-13 17:33:07', 1, 1),
(88, 11, 6, 5, '500', 0, 0, '2019-02-13 17:33:20', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `gender`
--

CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL,
  `gender` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `gender`
--

INSERT INTO `gender` (`gender_id`, `gender`) VALUES
(1, 'Masculino'),
(2, 'Feminino');

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_marcas`
--

CREATE TABLE `order_marcas` (
  `marcas_id` int(1) NOT NULL,
  `marcas` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `order_marcas`
--

INSERT INTO `order_marcas` (`marcas_id`, `marcas`) VALUES
(3, 'AREZZO'),
(4, 'ANA CAPRI'),
(5, 'CONSTANCE'),
(6, 'LIALINE'),
(7, 'RAPHAELLA BOOZ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_size`
--

CREATE TABLE `order_size` (
  `size_id` int(11) NOT NULL,
  `size` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `order_size`
--

INSERT INTO `order_size` (`size_id`, `size`) VALUES
(0, 'AREZZO P'),
(1, 'AREZZO M'),
(2, 'CONSTANCE P'),
(3, 'CONSTANCE M'),
(4, '20x28 cm'),
(5, '27x38 cm'),
(6, '25x30 cm'),
(7, '30x30 cm'),
(8, '30x40 cm'),
(9, '35x40 cm'),
(10, '35x46 cm'),
(11, '35X48 cm'),
(12, '40x40 cm'),
(13, '45x50 cm'),
(14, '44x56 cm'),
(15, '56x56 cm'),
(21, '12x17 cm'),
(22, '16x21 cm'),
(23, '20x22 cm');

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `status` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `status`) VALUES
(1, 'Em Producao'),
(2, 'Finalizada'),
(3, 'DADOS INCORRETOS');

-- --------------------------------------------------------

--
-- Estrutura para tabela `provider`
--

CREATE TABLE `provider` (
  `provider_id` int(11) NOT NULL,
  `name_pr` varchar(65) NOT NULL,
  `tel_pr` varchar(11) NOT NULL,
  `cep` int(8) NOT NULL,
  `rua_pr` varchar(35) NOT NULL,
  `numero_end_pr` int(4) NOT NULL,
  `bairro_pr` varchar(35) NOT NULL,
  `cidade_pr` varchar(35) NOT NULL,
  `estado_pr` varchar(2) NOT NULL,
  `obs_pr` varchar(300) NOT NULL,
  `cod_cad_status` int(11) NOT NULL,
  `sign_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `provider`
--

INSERT INTO `provider` (`provider_id`, `name_pr`, `tel_pr`, `cep`, `rua_pr`, `numero_end_pr`, `bairro_pr`, `cidade_pr`, `estado_pr`, `obs_pr`, `cod_cad_status`, `sign_date`) VALUES
(5, 'Gleivania Gonsalves', '47996617099', 89056510, 'Rua Max Aldemann', 1, 'Fortaleza', 'Blumenau', 'SC', '', 1, '2019-01-16 14:38:02'),
(6, 'Edivania Ribeiro da Silva', '47984617161', 89053600, 'Rua Vereador RomÃ¡rio da ConceiÃ§Ã£', 1, 'Itoupava Norte', 'Blumenau', 'SC', '', 1, '2019-01-16 14:39:43'),
(7, 'Elza Cavalcante ', '47984369203', 89053600, 'Rua Vereador RomÃ¡rio da ConceiÃ§Ã£', 1, 'Itoupava Norte', 'Blumenau', 'SC', '', 1, '2019-01-16 14:42:16'),
(8, 'Daniele Jamile Shimit', '4733397242', 89066, 'Rua Augusta Wirth', 88, 'Itoupava Central', 'Blumenau', 'SC', '', 1, '2019-01-21 14:07:44'),
(9, 'Rosa Arlete Romg', '4733397242', 89066, 'Rua Augusta Wirth', 88, 'Itoupava Central', 'Blumenau', 'SC', '', 1, '2019-01-21 14:10:12'),
(10, 'Andreia Draeger', '4733397242', 89066, 'Rua Augusta Wirth', 88, 'Itoupava Central', 'Blumenau', 'SC', '', 1, '2019-01-21 14:30:50'),
(11, 'Valmor kuhnen ', '47 33374193', 89066, 'Rua Bruno Zeretzke', 40, 'Itoupava Central', 'Blumenau', 'SC', '', 1, '2019-01-21 14:32:22'),
(12, 'Cilene Correia maia ', '47996088114', 89066, 'Rua Mariana Zabel', 1, 'Itoupava Central', 'Blumenau', 'SC', '', 1, '2019-01-21 14:33:14'),
(13, 'Marisa Schroeder', '4733273354', 89107000, 'Rua Bruno Reimer', 389, 'Itoupavazinha', 'Blumenau', 'SC', '', 1, '2019-01-21 14:39:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `cod_acess_level` int(11) NOT NULL,
  `sign_date` datetime NOT NULL,
  `photo_user` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `user`
--

INSERT INTO `user` (`id_user`, `name`, `last_name`, `gender`, `email`, `password`, `cod_acess_level`, `sign_date`, `photo_user`) VALUES
(1, 'Josef', 'Weslley', 1, 'josefizuda', '202cb962ac59075b964b07152d234b70', 2, '2018-09-17 00:00:00', 'faef3024b12492843837677817255c7e.jpeg'),
(2, 'uelton', 'lima santos', 1, 'uelton@bellatop.com.br', '25d55ad283aa400af464c76d713c07ad', 2, '2018-09-17 17:28:41', ''),
(3, 'Fabricio', 'Cabelo', 1, 'fabricio', '202cb962ac59075b964b07152d234b70', 1, '2018-09-17 17:52:19', '1810349db7f8c384d8fcf2488c41bae2.jpg');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `acess_level`
--
ALTER TABLE `acess_level`
  ADD PRIMARY KEY (`acess_level_id`);

--
-- Índices de tabela `cad_status`
--
ALTER TABLE `cad_status`
  ADD PRIMARY KEY (`cad_status_id`);

--
-- Índices de tabela `emitir_ordem`
--
ALTER TABLE `emitir_ordem`
  ADD PRIMARY KEY (`emit_id`),
  ADD KEY `fk_emitProvider` (`cod_provider`),
  ADD KEY `fk_emitmarcas` (`cod_marcas`),
  ADD KEY `fk_emitstatus` (`cod_order_status`),
  ADD KEY `fk_cod_user` (`cod_user`),
  ADD KEY `fk_cod_size` (`cod_size`);

--
-- Índices de tabela `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Índices de tabela `order_marcas`
--
ALTER TABLE `order_marcas`
  ADD PRIMARY KEY (`marcas_id`);

--
-- Índices de tabela `order_size`
--
ALTER TABLE `order_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Índices de tabela `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Índices de tabela `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`provider_id`),
  ADD KEY `fk_providercadStatus` (`cod_cad_status`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_userGender` (`gender`),
  ADD KEY `fk_userAcessLevel` (`cod_acess_level`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `acess_level`
--
ALTER TABLE `acess_level`
  MODIFY `acess_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `cad_status`
--
ALTER TABLE `cad_status`
  MODIFY `cad_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `emitir_ordem`
--
ALTER TABLE `emitir_ordem`
  MODIFY `emit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT de tabela `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `order_marcas`
--
ALTER TABLE `order_marcas`
  MODIFY `marcas_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `order_size`
--
ALTER TABLE `order_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de tabela `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `provider`
--
ALTER TABLE `provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `emitir_ordem`
--
ALTER TABLE `emitir_ordem`
  ADD CONSTRAINT `fk_cod_size` FOREIGN KEY (`cod_size`) REFERENCES `order_size` (`size_id`),
  ADD CONSTRAINT `fk_cod_user` FOREIGN KEY (`cod_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `fk_emitProvider` FOREIGN KEY (`cod_provider`) REFERENCES `provider` (`provider_id`),
  ADD CONSTRAINT `fk_emitmarcas` FOREIGN KEY (`cod_marcas`) REFERENCES `order_marcas` (`marcas_id`),
  ADD CONSTRAINT `fk_emitstatus` FOREIGN KEY (`cod_order_status`) REFERENCES `order_status` (`order_status_id`);

--
-- Restrições para tabelas `provider`
--
ALTER TABLE `provider`
  ADD CONSTRAINT `fk_providercadStatus` FOREIGN KEY (`cod_cad_status`) REFERENCES `cad_status` (`cad_status_id`);

--
-- Restrições para tabelas `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_userAcessLevel` FOREIGN KEY (`cod_acess_level`) REFERENCES `acess_level` (`acess_level_id`),
  ADD CONSTRAINT `fk_userGender` FOREIGN KEY (`gender`) REFERENCES `gender` (`gender_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
