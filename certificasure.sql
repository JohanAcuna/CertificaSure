-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2023 a las 00:51:06
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
-- Base de datos: `certificasure`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `id_contrato` int(10) NOT NULL,
  `tipo_contrato` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`id_contrato`, `tipo_contrato`) VALUES
(1, 'Freemium'),
(2, 'Basico'),
(3, 'Gold');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_reporte` int(100) NOT NULL,
  `id_estudiante` int(10) NOT NULL,
  `horas` int(10) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`id_reporte`, `id_estudiante`, `horas`, `fecha`) VALUES
(8, 1, 4, '2023-05-18'),
(9, 1, 3, '2023-05-18'),
(10, 1, 2, '2023-05-27'),
(11, 2, 2, '2023-05-27'),
(12, 3, 2, '2023-05-27'),
(13, 4, 2, '2023-05-19'),
(14, 1, 3, '2023-05-29'),
(15, 5, 3, '2023-05-28'),
(16, 5, 3, '2023-05-29'),
(17, 5, 2, '2023-05-30'),
(18, 6, 3, '2023-05-29'),
(19, 6, 3, '2023-05-29'),
(20, 6, 3, '2023-05-30'),
(21, 7, 2, '2023-05-28'),
(22, 8, 3, '2023-05-29'),
(23, 9, 2, '2023-05-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(10) NOT NULL,
  `tipo_rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `tipo_rol`) VALUES
(1, 'Administrador'),
(2, 'Monitor'),
(3, 'Estudiante o Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL,
  `id_rol` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_rol`, `email`, `pass`) VALUES
(1, 1, 'myempresa@gmail.com', 'empresa1'),
(2, 2, 'sebastian.urbano1@utp.edu.co', '12345'),
(3, 2, 'daya@gmail.com', '12345'),
(4, 3, 'juanPosso@gmail.com', '12345'),
(5, 3, 'danna_s@gmail.com', '12345'),
(6, 3, 'julian@gmail.com', '12345'),
(7, 3, 'michi@gmail.com', '12345'),
(8, 2, 'diego@gmail.com', '12345'),
(9, 3, 'mincus@gmail.com', '12345'),
(10, 3, 'tt@gmail.com', '12345'),
(11, 3, 'topanga@gmail.com', '12345'),
(12, 3, 'palacios@gmail.com', '12345'),
(13, 3, 'gongora@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_admin`
--

CREATE TABLE `usuario_admin` (
  `id_admin` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_contrato` int(10) NOT NULL,
  `nombre_organizacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_admin`
--

INSERT INTO `usuario_admin` (`id_admin`, `id_usuario`, `id_contrato`, `nombre_organizacion`) VALUES
(1, 1, 1, 'MyEmpresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_monitor`
--

CREATE TABLE `usuario_monitor` (
  `id_monitor` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_admin` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `grupo` varchar(30) NOT NULL,
  `duracion_proceso` int(10) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_monitor`
--

INSERT INTO `usuario_monitor` (`id_monitor`, `id_usuario`, `id_admin`, `nombre`, `apellido`, `grupo`, `duracion_proceso`, `estado`) VALUES
(1, 2, 1, 'Luis Sebastian', 'Urbano Luna ', 'Gabo', 80, 'Activo'),
(2, 3, 1, 'Dayana', 'Diaz Rivera', 'Calasanz de Pereira', 80, 'Inactivo'),
(3, 8, 1, 'Diego Alejandro ', 'Castro Cardona', 'Liceo', 8, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_normal`
--

CREATE TABLE `usuario_normal` (
  `id_estudiante` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_monitor` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `documento` varchar(10) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `estado` enum('Activo','Inactivo','Finalizo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_normal`
--

INSERT INTO `usuario_normal` (`id_estudiante`, `id_usuario`, `id_monitor`, `nombre`, `apellido`, `documento`, `celular`, `estado`) VALUES
(1, 4, 1, 'Juan Esteban', 'Duque Posso', '1114789456', '3145351793', 'Activo'),
(2, 5, 1, 'Danna Sofia', 'Mejia Marin', '1113275007', '3122154535', 'Activo'),
(3, 6, 1, 'Julian Andres', 'Torrez Lozano', '1114005456', '3182980546', 'Inactivo'),
(4, 7, 2, 'Michi', 'Torrez Marin', '1112556789', '3203455516', 'Activo'),
(5, 9, 3, 'Jhon Stwuar', 'Mincus Gallego', '1114785009', '3214567789', 'Finalizo'),
(6, 10, 3, 'Marcus', 'Toro Quintero', '1114789223', '3217444555', 'Finalizo'),
(7, 11, 3, 'Topanga', 'Cassella Nuñez', '1114223004', '3187554789', 'Inactivo'),
(8, 12, 1, 'Thomas Felipe', 'Rangel Palacios', '1114556411', '3184752535', 'Activo'),
(9, 13, 3, 'Camilo Andres ', 'Gonogora ', '1110895723', '3152984756', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id_contrato`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `usuario_admin`
--
ALTER TABLE `usuario_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_contrato` (`id_contrato`);

--
-- Indices de la tabla `usuario_monitor`
--
ALTER TABLE `usuario_monitor`
  ADD PRIMARY KEY (`id_monitor`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `usuario_normal`
--
ALTER TABLE `usuario_normal`
  ADD PRIMARY KEY (`id_estudiante`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_monitor` (`id_monitor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id_reporte` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario_admin`
--
ALTER TABLE `usuario_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario_monitor`
--
ALTER TABLE `usuario_monitor`
  MODIFY `id_monitor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_normal`
--
ALTER TABLE `usuario_normal`
  MODIFY `id_estudiante` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `usuario_normal` (`id_estudiante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_admin`
--
ALTER TABLE `usuario_admin`
  ADD CONSTRAINT `usuario_admin_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_admin_ibfk_2` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_monitor`
--
ALTER TABLE `usuario_monitor`
  ADD CONSTRAINT `usuario_monitor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_monitor_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `usuario_admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_normal`
--
ALTER TABLE `usuario_normal`
  ADD CONSTRAINT `usuario_normal_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_normal_ibfk_2` FOREIGN KEY (`id_monitor`) REFERENCES `usuario_monitor` (`id_monitor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
