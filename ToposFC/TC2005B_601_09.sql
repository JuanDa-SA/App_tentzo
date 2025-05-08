-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-06-2024 a las 04:59:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `TC2005B_601_09`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topos_admins`
--

CREATE TABLE `topos_admins` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topos_admins`
--

INSERT INTO `topos_admins` (`id_admin`, `usuario`, `pass`) VALUES
(1, 'topos', '12345'),
(12, 'Anhuar', 'algonose'),
(14, 'judany', '12345'),
(15, 'Jorge', 'rorro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topos_arbitros`
--

CREATE TABLE `topos_arbitros` (
  `id_arbitro` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topos_arbitros`
--

INSERT INTO `topos_arbitros` (`id_arbitro`, `nombre`) VALUES
(1, 'Tribilin Hdez'),
(2, 'Rodrigo Perez'),
(3, 'Aparicio Martinez'),
(4, 'Pedro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topos_capitan`
--

CREATE TABLE `topos_capitan` (
  `id_capitan` int(11) NOT NULL,
  `id_jugador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topos_capitan`
--

INSERT INTO `topos_capitan` (`id_capitan`, `id_jugador`) VALUES
(13, 15),
(14, 16),
(15, 17),
(20, 25),
(21, 26),
(22, 27),
(23, 28),
(24, 29),
(25, 30),
(27, 34),
(28, 36),
(29, 38),
(30, 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topos_encuentro`
--

CREATE TABLE `topos_encuentro` (
  `id_encuentro` int(11) NOT NULL,
  `id_equipo_local` int(11) NOT NULL,
  `id_equipo_visitante` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_arbitro` int(11) DEFAULT NULL,
  `ganador_penales` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topos_encuentro`
--

INSERT INTO `topos_encuentro` (`id_encuentro`, `id_equipo_local`, `id_equipo_visitante`, `fecha`, `hora`, `id_arbitro`, `ganador_penales`) VALUES
(303, 25, 34, NULL, NULL, 2, NULL),
(304, 25, 35, NULL, NULL, 2, NULL),
(305, 25, 36, NULL, NULL, 2, NULL),
(306, 25, 38, NULL, NULL, 4, NULL),
(307, 25, 42, NULL, NULL, 2, NULL),
(308, 34, 35, NULL, NULL, 2, NULL),
(309, 34, 36, NULL, NULL, 1, NULL),
(310, 34, 38, NULL, NULL, 1, NULL),
(311, 34, 42, NULL, NULL, 4, NULL),
(312, 35, 36, NULL, NULL, 4, NULL),
(313, 35, 38, NULL, NULL, 2, NULL),
(314, 35, 42, NULL, NULL, 2, NULL),
(315, 36, 38, NULL, NULL, 2, NULL),
(316, 36, 42, NULL, NULL, 1, NULL),
(317, 38, 42, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topos_equipo`
--

CREATE TABLE `topos_equipo` (
  `id_equipo` int(11) NOT NULL,
  `nombre_equipo` varchar(50) NOT NULL,
  `logo` varchar(60) DEFAULT NULL,
  `id_torneo` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topos_equipo`
--

INSERT INTO `topos_equipo` (`id_equipo`, `nombre_equipo`, `logo`, `id_torneo`, `estado`) VALUES
(24, 'Caguamers2', 'b7a5dbeb44b7f834007d6fca11d4e593.png', 2, 0),
(25, 'Caguamer5', '8843dd13b76db07a00225144a226aad7.png', 1, 1),
(26, 'Equipo Dinamita2645687979', '4796b9b6cd8c463da3378ae8c950fbff.png', 2, 0),
(34, 'asddasdsd', NULL, 1, 1),
(35, 'qasw', NULL, 1, 1),
(36, 'qasw3', 'a36d42fa5b2c9f96ee9aa91a507b5c41.png', 1, 1),
(37, 'qasw3', '2d674c93a3ac701848a2087b2b03eb4e.png', 2, 1),
(38, 'qasw1', '8f871f7efca72afeef046c5d47de0c5f.png', 1, 1),
(39, 'Equipo Hola', 'a7423c3475dba04cf56c81a257b39a41.png', 1, 0),
(41, 'Ertitit', NULL, 1, 0),
(42, 'Los maldonados fc', 'c612d21af52aa4e5185dc41fabf51d49.png', 1, 1),
(43, 'Caguamer50', NULL, 2, 0),
(44, 'Equipo Dinamitadsss', NULL, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topos_evento`
--

CREATE TABLE `topos_evento` (
  `id_evento` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topos_evento`
--

INSERT INTO `topos_evento` (`id_evento`, `tipo`) VALUES
(1, 'Gol'),
(2, 'Tarjeta Amarilla'),
(3, 'Tarjeta Roja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topos_eventos_encuentro`
--

CREATE TABLE `topos_eventos_encuentro` (
  `id_evento_encuentro` int(11) NOT NULL,
  `id_encuentro` int(11) DEFAULT NULL,
  `id_estadistica` int(11) DEFAULT NULL,
  `id_jugador` int(11) DEFAULT NULL,
  `minuto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topos_eventos_encuentro`
--

INSERT INTO `topos_eventos_encuentro` (`id_evento_encuentro`, `id_encuentro`, `id_estadistica`, `id_jugador`, `minuto`) VALUES
(11, 303, 1, 16, 90),
(12, 303, 1, 25, 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topos_jugador`
--

CREATE TABLE `topos_jugador` (
  `id_jugador` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) DEFAULT NULL,
  `apellido_materno` varchar(50) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `edad` int(11) NOT NULL,
  `colonia` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `tutor` varchar(50) DEFAULT NULL,
  `permiso_imagen` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topos_jugador`
--

INSERT INTO `topos_jugador` (`id_jugador`, `nombre`, `apellido_paterno`, `apellido_materno`, `numero`, `id_equipo`, `edad`, `colonia`, `telefono`, `correo`, `tutor`, `permiso_imagen`) VALUES
(15, 'Manuel', 'Cova', 'Maldonado', 10, 24, 17, 'Puebla', '32423423423', 'spiAdmin@tec.mx', 'Juan Daniel Salmeron Mora', 'si'),
(16, 'Anhuar', 'Rodrigue', 'Perez', 11, 25, 17, 'Puebla', '32423423423', 'spiAdmin@tec.mx', 'sadasd', 'si'),
(17, 'Manuel', 'Maldonado', 'Aguilar', 34, 26, 20, 'Puebla', '32423423423', 'spiAdmin@tec.mx', NULL, 'si'),
(25, 'Anhuar', 'Maldonade', 'Aguilee', 10, 34, 19, 'naucalpan', '123123345', '123321777@hotmail.com', NULL, 'si'),
(26, 'Anhuar', 'Malddddonade', 'Aguilee', 90, 35, 18, 'naucalpan', '123cc123345', '12321777@hotmail.com', 'Juan Daniel', 'si'),
(27, 'Anhuar', 'Malddddonade', 'Aguilee', 34, 36, 17, 'naucalpan', '123cc123342', '123217747@hotmail.com', 'Juan Daniel', 'si'),
(28, 'Anhuar', 'Malddddonade', 'Aguilee', 90, 37, 19, 'naucalpan', '123cyc123342', '123j217747@hotmail.com', 'Juan Daniel', 'si'),
(29, 'Anhuar', 'Malddddodnade', 'Aguilee', 33, 38, 19, 'naucalpan', '123cyc1d223342', '123j2172747d@hotmail.com', 'Juan Daniel', 'si'),
(30, 'Juan', 'Daniel', 'Salmeron', 22, 39, 17, 'Puebla', '6767675849', 'judany@hotmail.com', 'Juan Daniel Salmeron Mora', 'si'),
(31, 'Javier', 'j', 'j', 10, 39, 19, 'Puebla', '0101010101010', 'spincorrsdas@hotmail.com', NULL, 'si'),
(34, 'Lolokoko', 'popopop', 'qwqwqw', 10, 41, 19, 'qweasd', '7563547891', 'mnbsdf@hotmail.com', NULL, 'si'),
(35, 'asdasddgff', 'dfbvcbvc', 'cvbvbcv', 10, 41, 20, 'jklljklkj', '7987656549', 'ajskdhaksj@jlaksaljskd.com', NULL, 'si'),
(36, 'Anhuar', 'Maldonado', 'Aguilaaar', 10, 42, 17, 'Orizaba', '1237894237', 'loasss@hotmail.com', 'Juan Daniel Salmeron', 'si'),
(37, 'Alejando', 'Guzman', 'Perez', 12, 42, 20, 'Puebla2', '7982347892', 'aleguz@gmail.com', NULL, 'si'),
(38, 'vnxcmvnm', 'nmnxzmcnasm', 'mnfnmds', 12, 43, 19, 'Puebla', '1231234235', 'ajsej@hotmail.com', NULL, 'si'),
(39, 'asdasddf', 'cxvxcv', 'xcvbcvbcv', 15, 44, 16, 'sdfdsfsdf', '3455466575', 'fghsdf@fdg.com', 'juandi', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topos_reservas`
--

CREATE TABLE `topos_reservas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `hora_de_reserva` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topos_reservas`
--

INSERT INTO `topos_reservas` (`id`, `titulo`, `motivo`, `nombre`, `correo`, `telefono`, `fecha`, `hora_inicio`, `hora_fin`, `hora_de_reserva`, `estado`) VALUES
(67, 'alkdsjkla', 'kljsakldjaslkj', 'kljslakdjaksl', 'salmeronmora@gmail.com', '1231231231', '2024-06-02', '09:00:00', '10:00:00', '2024-06-03 03:55:12', 0),
(68, 'dalksdsajlkdaj', 'ldkadjlkdjaskljkldasjldjalkd', 'dklsdjlajslakdj', 'salmeronmora@gmail.com', '1231231231', '2024-06-03', '08:00:00', '09:00:00', '2024-06-03 04:04:41', 0),
(69, 'sdslkflsdjk', 'kjaklfjadf', 'klajlkajdsldj', 'salmeronmora@gmail.com', '1231231231', '2024-06-02', '10:00:00', '11:00:00', '2024-06-03 04:15:03', 1),
(70, 'Reserva Alejandro', 'Quiero jugar al furvo', 'Alejandro Guzmán Sánchez', 'alegusaman@gmail.com', '2224204005', '2024-06-12', '09:00:00', '10:00:00', '2024-06-03 18:42:12', 1),
(71, 'Fiesta Bruno', 'Peda', 'Bruno Manuel Zamora', 'bruno.zamora.garcia39@gmail.com', '2411231231', '2024-06-05', '12:00:00', '13:00:00', '2024-06-06 02:42:37', 1),
(72, 'Reserva Cast', 'Fiesta familiar', 'Diego Castelan', 'dcastell1@hotmail.com', '1231231231', '2024-12-20', '12:00:00', '17:00:00', '2024-06-06 06:22:42', 1),
(73, 'Fiesta Dan', 'Dan celebra', 'Daniel Perez', 'salmeronmora@gmail.com', '1231232342', '2024-06-30', '15:00:00', '20:00:00', '2024-06-06 17:31:20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topos_torneo`
--

CREATE TABLE `topos_torneo` (
  `id_torneo` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `cantidad_equipos` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `topos_torneo`
--

INSERT INTO `topos_torneo` (`id_torneo`, `nombre`, `cantidad_equipos`, `estado`) VALUES
(1, 'Torneo 1', 6, 1),
(2, 'Torneo 3', 10, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `topos_admins`
--
ALTER TABLE `topos_admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `topos_arbitros`
--
ALTER TABLE `topos_arbitros`
  ADD PRIMARY KEY (`id_arbitro`);

--
-- Indices de la tabla `topos_capitan`
--
ALTER TABLE `topos_capitan`
  ADD PRIMARY KEY (`id_capitan`),
  ADD KEY `topos_capitan_jugador__fk` (`id_jugador`);

--
-- Indices de la tabla `topos_encuentro`
--
ALTER TABLE `topos_encuentro`
  ADD PRIMARY KEY (`id_encuentro`),
  ADD KEY `fk_encuentro_equipo_local` (`id_equipo_local`),
  ADD KEY `fk_encuentro_equipo_visitante` (`id_equipo_visitante`),
  ADD KEY `fk_arbitro` (`id_arbitro`);

--
-- Indices de la tabla `topos_equipo`
--
ALTER TABLE `topos_equipo`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `fk_id_torneo` (`id_torneo`);

--
-- Indices de la tabla `topos_evento`
--
ALTER TABLE `topos_evento`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `topos_eventos_encuentro`
--
ALTER TABLE `topos_eventos_encuentro`
  ADD PRIMARY KEY (`id_evento_encuentro`),
  ADD KEY `id_encuentro` (`id_encuentro`),
  ADD KEY `id_estadistica` (`id_estadistica`),
  ADD KEY `id_jugador` (`id_jugador`);

--
-- Indices de la tabla `topos_jugador`
--
ALTER TABLE `topos_jugador`
  ADD PRIMARY KEY (`id_jugador`),
  ADD KEY `id_equipo` (`id_equipo`);

--
-- Indices de la tabla `topos_reservas`
--
ALTER TABLE `topos_reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `topos_torneo`
--
ALTER TABLE `topos_torneo`
  ADD PRIMARY KEY (`id_torneo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `topos_admins`
--
ALTER TABLE `topos_admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `topos_arbitros`
--
ALTER TABLE `topos_arbitros`
  MODIFY `id_arbitro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `topos_capitan`
--
ALTER TABLE `topos_capitan`
  MODIFY `id_capitan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `topos_encuentro`
--
ALTER TABLE `topos_encuentro`
  MODIFY `id_encuentro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT de la tabla `topos_equipo`
--
ALTER TABLE `topos_equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `topos_evento`
--
ALTER TABLE `topos_evento`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `topos_eventos_encuentro`
--
ALTER TABLE `topos_eventos_encuentro`
  MODIFY `id_evento_encuentro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `topos_jugador`
--
ALTER TABLE `topos_jugador`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `topos_reservas`
--
ALTER TABLE `topos_reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `topos_torneo`
--
ALTER TABLE `topos_torneo`
  MODIFY `id_torneo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `topos_capitan`
--
ALTER TABLE `topos_capitan`
  ADD CONSTRAINT `topos_capitan_jugador__fk` FOREIGN KEY (`id_jugador`) REFERENCES `topos_jugador` (`id_jugador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `topos_encuentro`
--
ALTER TABLE `topos_encuentro`
  ADD CONSTRAINT `fk_arbitro` FOREIGN KEY (`id_arbitro`) REFERENCES `topos_arbitros` (`id_arbitro`),
  ADD CONSTRAINT `fk_encuentro_equipo_local` FOREIGN KEY (`id_equipo_local`) REFERENCES `topos_equipo` (`id_equipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_encuentro_equipo_visitante` FOREIGN KEY (`id_equipo_visitante`) REFERENCES `topos_equipo` (`id_equipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `topos_encuentro_ibfk_1` FOREIGN KEY (`id_equipo_local`) REFERENCES `topos_equipo` (`id_equipo`),
  ADD CONSTRAINT `topos_encuentro_ibfk_2` FOREIGN KEY (`id_equipo_visitante`) REFERENCES `topos_equipo` (`id_equipo`);

--
-- Filtros para la tabla `topos_equipo`
--
ALTER TABLE `topos_equipo`
  ADD CONSTRAINT `fk_id_torneo` FOREIGN KEY (`id_torneo`) REFERENCES `topos_torneo` (`id_torneo`);

--
-- Filtros para la tabla `topos_eventos_encuentro`
--
ALTER TABLE `topos_eventos_encuentro`
  ADD CONSTRAINT `topos_eventos_encuentro_ibfk_1` FOREIGN KEY (`id_encuentro`) REFERENCES `topos_encuentro` (`id_encuentro`) ON DELETE CASCADE,
  ADD CONSTRAINT `topos_eventos_encuentro_ibfk_2` FOREIGN KEY (`id_estadistica`) REFERENCES `topos_evento` (`id_evento`) ON DELETE CASCADE,
  ADD CONSTRAINT `topos_eventos_encuentro_ibfk_3` FOREIGN KEY (`id_jugador`) REFERENCES `topos_jugador` (`id_jugador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `topos_jugador`
--
ALTER TABLE `topos_jugador`
  ADD CONSTRAINT `fk_jugador_equipo` FOREIGN KEY (`id_equipo`) REFERENCES `topos_equipo` (`id_equipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `topos_jugador_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `topos_equipo` (`id_equipo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
