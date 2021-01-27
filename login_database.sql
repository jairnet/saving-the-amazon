-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-01-2021 a las 21:40:28
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqrs`
--

CREATE TABLE `pqrs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_create` date NOT NULL,
  `date_limit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pqrs`
--

INSERT INTO `pqrs` (`id`, `user_id`, `type`, `topic`, `state`, `date_create`, `date_limit`) VALUES
(1, 1, 'peticion', 'Hola', 'nuevo', '2021-01-26', '2021-01-30'),
(3, 3, 'reclamo', 'animalitos', 'ejecucion', '2021-01-25', '2021-01-30'),
(4, 3, 'peticion', 'kop', 'cerrado', '2021-01-29', '2021-02-11'),
(5, 1, 'queja', 'lol', 'ejecucion', '2021-01-30', '2021-01-29'),
(6, 1, 'reclamo', 'swe', 'ejecucion', '2021-01-29', '2021-01-29'),
(7, 1, 'reclamo', '', 'nuevo', '2021-01-15', '2021-01-22'),
(8, 1, 'peticion', '', 'nuevo', '2021-01-01', '2021-01-08'),
(9, 1, 'peticion', 'ssss', 'nuevo', '2021-01-07', '2021-01-14'),
(10, 1, 'queja', '', 'nuevo', '2021-01-15', '2021-01-18'),
(11, 1, 'reclamo', '', 'nuevo', '2021-01-28', '2021-01-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `last_name`, `role`) VALUES
(1, 'drdiazb@uqvirtual.edu.co', '$2y$10$7do/HJ/cFK2bdLhvB/uZuef4g81XNyKJEX4Hxp0rPIt/Z/98aJkuS', 'Jair Buitron', 'Barona', 'user'),
(2, 'jairnet5@gmail.com', '$2y$10$UKZXuZRV9bES/m6zuoFixuH/3abY.yoh9Rs9h5pnS1s2oTWZox54C', 'Jair', 'Buitron', 'admin'),
(3, 'jair.buitron@loquenecesito.co', '$2y$10$vZbbu/cmre4ygq20u9K.yeiUbBBP1TAgCuvZSSHiDCrFg1040JGUq', 'Loco', 'Gomez', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pqrs`
--
ALTER TABLE `pqrs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pqrs_users` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pqrs`
--
ALTER TABLE `pqrs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pqrs`
--
ALTER TABLE `pqrs`
  ADD CONSTRAINT `fk_pqrs_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
