-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2023 a las 18:56:59
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id` varchar(13) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellido` varchar(20) DEFAULT NULL,
  `DNI` varchar(20) DEFAULT NULL,
  `Domicilio` varchar(20) DEFAULT NULL,
  `Celular` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ficha`
--

CREATE TABLE `detalle_ficha` (
  `Id` varchar(13) NOT NULL,
  `Precio` int(6) NOT NULL,
  `id_Ficha` varchar(13) NOT NULL,
  `id_Disfraz` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disfraz`
--

CREATE TABLE `disfraz` (
  `Id` varchar(13) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Tematica` varchar(20) NOT NULL,
  `Cantidad` int(3) NOT NULL,
  `Precio` float NOT NULL,
  `Talla` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `Id` varchar(13) NOT NULL,
  `F_Entrega` date NOT NULL,
  `F_Devolucion` date NOT NULL,
  `Precio` int(11) NOT NULL,
  `Id_Cliente` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `detalle_ficha`
--
ALTER TABLE `detalle_ficha`
  ADD PRIMARY KEY (`Id`,`id_Ficha`,`id_Disfraz`),
  ADD KEY `id_Ficha` (`id_Ficha`),
  ADD KEY `id_Disfraz` (`id_Disfraz`);

--
-- Indices de la tabla `disfraz`
--
ALTER TABLE `disfraz`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`Id`,`Id_Cliente`),
  ADD KEY `Id_Cliente` (`Id_Cliente`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_ficha`
--
ALTER TABLE `detalle_ficha`
  ADD CONSTRAINT `detalle_ficha_ibfk_1` FOREIGN KEY (`id_Ficha`) REFERENCES `ficha` (`Id`),
  ADD CONSTRAINT `detalle_ficha_ibfk_2` FOREIGN KEY (`id_Disfraz`) REFERENCES `disfraz` (`Id`);

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `ficha_ibfk_1` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
