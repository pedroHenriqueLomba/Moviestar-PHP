-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Fev-2023 às 03:17
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `moviestar`
--
CREATE DATABASE IF NOT EXISTS `moviestar` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `moviestar`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE `movies` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `trailer` varchar(150) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `length` varchar(50) DEFAULT NULL,
  `users_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `image`, `trailer`, `category`, `length`, `users_id`) VALUES
(20, 'Missão impossível ', 'O agente do governo Ethan Hunt e seu mentor, Jim Phelps, embarcam em uma missão secreta que toma um rumo desastroso: Jim é morto e Ethan torna-se o principal suspeito do assassinato. Em fuga, Hunt recruta o brilhante Luther Stickell e o piloto Franz Krieger para ajudá-lo a entrar no prédio da CIA, fortemente vigiado, a fim de pegar um arquivo de computador confidencial que pode provar a sua inocência.', 'img/movies/c08623c9591c45875817c417e16830e1b353c996ef742bddc849ac7cfdd720c33700c5edd61ec91d90b7a47e84f3eeec1f122e6c16a192ac9dde21ca.jpg', 'https://www.youtube.com/embed/pi4UJDCkSTU', 'Ação', '110', 1),
(22, 'Velozes e Furiosos', 'Dominic Toretto (Vin Diesel) é o líder de uma gangue de corridas de ruas em Los Angeles que está sendo investigado pela polícia por roubo de equipamentos eletrônicos. Para investigá-lo é enviado Brian O\'Conner (Paul Walker), que se infiltra na gangue na intenção de descobrir se Toretto é realmente o autor dos crimes ou se há alguém mais por trás deles.', 'img/movies/97995ebbcc3ee62bb15ddc18d19347b2d619fed2add923ca7ebaf440d6d663d2bd3831f7ed398dacfdee6f13c80c34221e6737b5cd0cfb28609c41ff.jpg', 'https://www.youtube.com/embed/ZuQ-CWAjFT4', 'Ação', '107', 4),
(23, 'Gente Grande', 'Em Gente Grande, Lenny (Adam Sandler), Kurt (Chris Rock), Eric (Kevin James), Marcus (David Spade) e Rob (Rob Schneider) se conhecem desde pequenos. Passados trinta anos, os cinco amigos se reencontram para curtir um fim de semana juntos com as respectivas famílias, mas o feriado de 4 de Julho em uma casa no lago promete muito mais diversão do que apenas lembranças dos bons momentos. Casados e com várias crianças, os homens de família terão de confrontar o fato de não serem mais tão jovens.', 'img/movies/56b081d049c587d33ef5691c881966c6486b4d393c1a6c40f2caf31a25a27907031f254b9bd1190e2335cc1cb6044c78753e1748a668863b1cac07b8.jpg', 'https://www.youtube.com/embed/HKVve_VSz58', 'Comédia', '102', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int(11) UNSIGNED NOT NULL,
  `rating` int(50) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `users_id` int(11) UNSIGNED DEFAULT NULL,
  `movies_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `reviews`
--

INSERT INTO `reviews` (`id`, `rating`, `review`, `users_id`, `movies_id`) VALUES
(2, 9, 'O filme é muito bom!', 4, 20),
(3, 10, 'Saudades do Paul Walker :(', 1, 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT 'img/users/user.png',
  `bio` text DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `password`, `image`, `bio`, `token`) VALUES
(1, 'Pedro', 'Lomba', 'p.henrique.lomba@gmail.com', '$2y$10$BSnPHcRVag6LW/n6T77KnepVwja1jiZt.NCDjv8TS6sV9giokPZWa', 'img/users/0b8c608182c614865ad100b3329b0120c7daf1dcc0d287bd3096ddf34b8fd340ef52f9ac4f10b5e4d9a49c413747941dc6b19f697d48c05576f37c2f.jpg', 'Software engineer', 'a41064bed16ef4125ec1826bac0e9cc3e437ec518d8fb298678c4e855ccddc31b7abb644a08c305f0120f15b4972def07ee77409e43fee498b2cd74c'),
(4, 'Pedro', 'Lomba', 'p.henrique.lomba@hotmail.com', '$2y$10$tQ7Vg01w3eP6vVQuffKsReDPsllyl.VdhmuOZILGYHWYFZWI.7kQq', 'img/users/7a9ca48401efa70c38dfdca93750b5d672540bf307cf9de2885a37f328fad5b74f468f289aad7bb4236cd9924b50861d939e83c97ba25cc1eede0354.jpg', 'Segundo perfil!', '8c629855664916623cd8b18f9ddcdae961848821ece505afd178436765cb957edc0df16f0794004089f8eafa75f4eeb7f3e3');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices para tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `movies_id` (`movies_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`movies_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
