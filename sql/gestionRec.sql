-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: mariadb:3306
-- Tiempo de generación: 08-11-2022 a las 21:37:27
-- Versión del servidor: 10.6.10-MariaDB
-- Versión de PHP: 8.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestionRec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--
CREATE DATABASE gestionRec IF NOT EXISTS;
USE gestionRec;

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `idResource` int(5) NOT NULL,
  `idUser` int(5) NOT NULL,
  `idTimeSlot` int(5) NOT NULL,
  `date` date NOT NULL,
  `remark` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `idResource`, `idUser`, `idTimeSlot`, `date`, `remark`) VALUES
(1, 1, 1, 1, '2022-11-16', 'Clase de informatica'),
(2, 2, 2, 2, '2022-11-15', 'VideoLlamada Erasmus'),
(3, 2, 2, 6, '2022-11-28', 'VideoLlamada Erasmus'),
(4, 3, 2, 2, '2022-11-07', 'VideoLlamada Erasmus'),
(6, 3, 2, 6, '2022-11-14', 'VideoLlamada Erasmus'),
(7, 1, 3, 9, '2022-11-15', 'Charla seguridad informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources`
--

CREATE TABLE `resources` (
  `id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `location` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `resources`
--

INSERT INTO `resources` (`id`, `name`, `description`, `location`, `image`) VALUES
(1, 'Aula TIC', 'Aula TIC para utilizar', '1º planta aula 1-3', 'images/aulaTic.jpg'),
(2, 'Camara Web', 'Camara Web con conector USB', 'Secretaria', 'images/camaraWeb.jpg'),
(3, 'Portatil', 'Portatil para utilizarlo', 'Almacen', 'images/portatil.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `timeSlot`
--

CREATE TABLE `timeSlot` (
  `id` int(5) NOT NULL,
  `dayOfWeek` varchar(100) NOT NULL,
  `startTime` varchar(100) NOT NULL,
  `endTime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `timeSlot`
--

INSERT INTO `timeSlot` (`id`, `dayOfWeek`, `startTime`, `endTime`) VALUES
(1, 'Lunes', '08:05', '09:05'),
(2, 'Martes', '08:05', '09:05'),
(3, 'Miercoles', '08:05', '09:05'),
(4, 'Jueves', '08:05', '09:05'),
(5, 'Viernes', '08:05', '09:05'),
(6, 'Lunes', '09:05', '10:05'),
(7, 'Lunes', '10:05', '11:05'),
(8, 'Jueves', '11:35', '12:35'),
(9, 'Jueves', '12:35', '13:35'),
(10, 'Jueves', '13:35', '14:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `realname` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `realname`, `type`) VALUES
(1, 'root', 'root', 'root', 'admin'),
(2, 'usuario', 'usuario', 'usuario', 'user'),
(3, 'usuario2', 'usuario2', 'usuario2', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `timeSlot`
--
ALTER TABLE `timeSlot`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `timeSlot`
--
ALTER TABLE `timeSlot`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
