-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-05-2017 a las 20:23:58
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Musify`
--
CREATE DATABASE IF NOT EXISTS `Musify` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Musify`;

-- --------------------------------------------------------

GRANT ALL PRIVILEGES ON *.* TO 'root123'@'localhost' IDENTIFIED BY PASSWORD '*A4B6157319038724E3560894F7F932C8886EBFCF' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `musify`.* TO 'root123'@'localhost';


--
-- Estructura de tabla para la tabla `Grupos`
--

CREATE TABLE `Grupos` (
  `Name` varchar(20) NOT NULL,
  `minAge` int(11) DEFAULT NULL,
  `maxAge` int(11) DEFAULT NULL,
  `Music` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Grupos`
--

INSERT INTO `Grupos` (`Name`, `minAge`, `maxAge`, `Music`) VALUES
('MetÃ¡licos', 18, 27, 'Heavy Metal'),
('Muy Heavy!', 26, 40, 'Heavy Metal'),
('POP 90', 17, 52, 'Pop'),
('Triple Jazz', 18, 30, 'Jazz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Messages`
--

CREATE TABLE `Messages` (
  `Sender` varchar(20) DEFAULT NULL,
  `Receiver` varchar(20) DEFAULT NULL,
  `IdGrupo` varchar(20) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Messages`
--

INSERT INTO `Messages` (`Sender`, `Receiver`, `IdGrupo`, `Date`, `Message`) VALUES
('anika', 'lauris', NULL, '2017-05-31 18:13:13', 'Hola laura!'),
('anika', 'lauris', NULL, '2017-05-31 18:13:38', 'veo que tenemos casi los mismos gustos musicales :)'),
('guille123', NULL, NULL, '2017-05-31 18:13:55', 'Hola a todos! alguien por ahi?'),
('guille123', 'Jara', NULL, '2017-05-31 18:14:36', 'Hola julio! que gusta el Jazz?'),
('lauris', NULL, NULL, '2017-05-31 18:15:01', 'Hola! me llamo laura aunque podeis llamarme lauris :)'),
('lauris', NULL, NULL, '2017-05-31 18:15:35', 'alguien sabe si este finde se organiza algÃºn concierto?'),
('lauris', 'anika', NULL, '2017-05-31 18:15:48', 'Hola \"anika\"!'),
('lauris', 'anika', NULL, '2017-05-31 18:16:04', 'jeje ya lo he visto, quÃ© tipo de mÃºsica sueles escuchar?'),
('lauris', NULL, 'Triple Jazz', '2017-05-31 18:16:32', 'Ve que por aqui ya somos 3 participantes! :D'),
('guille123', NULL, 'Triple Jazz', '2017-05-31 18:17:02', 'Hola lauris!'),
('guille123', NULL, 'Triple Jazz', '2017-05-31 18:17:13', 'no sabÃ­a que te gustara el jazz :O'),
('Jara', NULL, 'Triple Jazz', '2017-05-31 18:18:09', 'Hola \"guille123\", eres nuevo en el grupo de Jazz?'),
('Jara', NULL, NULL, '2017-05-31 18:18:30', 'Si!, me parece que hay un concierto de Rock!!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Music`
--

CREATE TABLE `Music` (
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Music`
--

INSERT INTO `Music` (`Name`) VALUES
('Alternativa'),
('Clasica'),
('Country'),
('Heavy Metal'),
('Jazz'),
('Pop'),
('Punk'),
('R & B'),
('Rap'),
('Rock&Roll');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userGroup`
--

CREATE TABLE `userGroup` (
  `IdUser` varchar(20) DEFAULT NULL,
  `IdGroup` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `userGroup`
--

INSERT INTO `userGroup` (`IdUser`, `IdGroup`) VALUES
('anika', 'MetÃ¡licos'),
('anika', 'Muy Heavy!'),
('lauris', 'Muy Heavy!'),
('anika', 'POP 90'),
('lauris', 'POP 90'),
('guille123', 'Triple Jazz'),
('Jara', 'Triple Jazz'),
('lauris', 'Triple Jazz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userMusic`
--

CREATE TABLE `userMusic` (
  `IdUser` varchar(20) DEFAULT NULL,
  `IdMusic` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `userMusic`
--

INSERT INTO `userMusic` (`IdUser`, `IdMusic`) VALUES
('guille123', 'Alternativa'),
('guille123', 'Country'),
('guille123', 'Jazz'),
('guille123', 'Rap'),
('anika', 'Heavy Metal'),
('anika', 'Pop'),
('anika', 'R & B'),
('anika', 'Rock&Roll'),
('Jara', 'Alternativa'),
('Jara', 'Clasica'),
('Jara', 'Jazz'),
('Jara', 'Rock&Roll'),
('lauris', 'Heavy Metal'),
('lauris', 'Jazz'),
('lauris', 'Pop'),
('lauris', 'Punk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE `Users` (
  `Alias` varchar(20) NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  `Surname` varchar(20) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Mail` varchar(20) NOT NULL,
  `Pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Users`
--

INSERT INTO `Users` (`Alias`, `Name`, `Surname`, `Age`, `Mail`, `Pass`) VALUES
('anika', 'Ana', 'Romero', 27, 'ana@gmail.com', '1234'),
('guille123', 'Guillermo', 'Romero', 23, 'guille@gmail.com', '1234'),
('Jara', 'Julio', 'Romero', 19, 'julio@gmail.com', '1234'),
('lauris', 'Laura', 'PÃ©rez', 30, 'laura@gmail.com', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Grupos`
--
ALTER TABLE `Grupos`
  ADD PRIMARY KEY (`Name`);

--
-- Indices de la tabla `Messages`
--
ALTER TABLE `Messages`
  ADD KEY `Sender` (`Sender`),
  ADD KEY `Receiver` (`Receiver`),
  ADD KEY `IdGrupo` (`IdGrupo`);

--
-- Indices de la tabla `Music`
--
ALTER TABLE `Music`
  ADD PRIMARY KEY (`Name`);

--
-- Indices de la tabla `userGroup`
--
ALTER TABLE `userGroup`
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdGroup` (`IdGroup`);

--
-- Indices de la tabla `userMusic`
--
ALTER TABLE `userMusic`
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdMusic` (`IdMusic`);

--
-- Indices de la tabla `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Alias`),
  ADD UNIQUE KEY `Mail` (`Mail`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`Sender`) REFERENCES `Users` (`Alias`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`Receiver`) REFERENCES `Users` (`Alias`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`IdGrupo`) REFERENCES `Grupos` (`Name`) ON DELETE CASCADE;

--
-- Filtros para la tabla `userGroup`
--
ALTER TABLE `userGroup`
  ADD CONSTRAINT `usergroup_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `Users` (`Alias`) ON DELETE CASCADE,
  ADD CONSTRAINT `usergroup_ibfk_2` FOREIGN KEY (`IdGroup`) REFERENCES `Grupos` (`Name`) ON DELETE CASCADE;

--
-- Filtros para la tabla `userMusic`
--
ALTER TABLE `userMusic`
  ADD CONSTRAINT `usermusic_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `Users` (`Alias`) ON DELETE CASCADE,
  ADD CONSTRAINT `usermusic_ibfk_2` FOREIGN KEY (`IdMusic`) REFERENCES `Music` (`Name`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
