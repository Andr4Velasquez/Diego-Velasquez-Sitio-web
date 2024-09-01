-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-09-2024 a las 07:39:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `base_sitio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opinion`
--

CREATE TABLE `opinion` (
  `nombre` varchar(280) DEFAULT NULL,
  `email` varchar(280) NOT NULL,
  `opinion` varchar(280) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `opinion`
--

INSERT INTO `opinion` (`nombre`, `email`, `opinion`) VALUES
('Diego Andre Velasquez Martinez', 'diegovemartines123@gmail.com', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(280) DEFAULT NULL,
  `usuario` varchar(280) DEFAULT NULL,
  `email` varchar(280) DEFAULT NULL,
  `contraseña` varchar(280) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo`, `nombre`, `usuario`, `email`, `contraseña`) VALUES
(1, 'Jose Daniel', 'Dhsiho', 'joselopez@gmail.com', 'pablo123'),
(2, 'Diego Andre Velasquez Martinez', 'Dieguitoxwx', 'diegovemartines123@gmail.com', 'xingfu2024'),
(3, 'Daniel Armando', 'BalsesGreed', 'danielpavon@gmai.com', 'piedi123'),
(4, 'Jordana', 'Jordana', 'Jordana@gmail.com', 'pato'),
(5, 'Si', 'Si', 'si@gmail.com', 'si');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `opinion`
--
ALTER TABLE `opinion`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
