-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2024 a las 23:09:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tareas_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_completada` timestamp NULL DEFAULT NULL,
  `archivo_adjunto` varchar(255) DEFAULT NULL,
  `completada` tinyint(1) DEFAULT 0,
  `eliminada` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `nombre`, `fecha_creacion`, `fecha_completada`, `archivo_adjunto`, `completada`, `eliminada`) VALUES
(9, 'Trabajo integrador ', '2024-11-08 21:40:02', '2024-11-08 21:59:08', 'uploads/Act. Clasificacion de las computadoras.pdf', 1, 0),
(10, 'Trabajo integrador ', '2024-11-08 21:40:02', NULL, 'uploads/Act. Clasificacion de las computadoras.pdf', 0, 0),
(11, 'analisis matematico ', '2024-11-08 21:52:00', NULL, 'uploads/TRABAJO INTEGRADOR  analisis.pdf', 0, 1),
(12, 'investigar sobre inteligencia artificial', '2024-11-08 22:01:43', NULL, 'uploads/INTELIGENCIA ARTIFICIAL pdf.pdf', 0, 0),
(13, 'investigar sobre inteligencia artificial', '2024-11-08 22:04:01', NULL, 'uploads/INTELIGENCIA ARTIFICIAL pdf.pdf', 0, 0),
(14, 'investigar sobre inteligencia artificial', '2024-11-08 22:05:31', NULL, 'uploads/INTELIGENCIA ARTIFICIAL pdf.pdf', 0, 0),
(15, 'investigar sobre inteligencia artificial', '2024-11-08 22:07:01', NULL, 'uploads/INTELIGENCIA ARTIFICIAL pdf.pdf', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
