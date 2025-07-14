-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2025 a las 19:42:36
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `Id_Catalogo` int(11) NOT NULL,
  `Estado` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci,
  `Fecha_Publicacion` date DEFAULT NULL,
  `Id_Vehiculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`Id_Catalogo`, `Estado`, `Precio`, `Descripcion`, `Fecha_Publicacion`, `Id_Vehiculo`) VALUES
(1, 'disponible', '4555.00', '                    ', NULL, 3),
(2, 'vendido', '260.00', '                    ', NULL, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `Id_Citas` int(11) NOT NULL,
  `Estado` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Id_Cliente` int(11) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Id_Catalogo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`Id_Citas`, `Estado`, `Fecha`, `Hora`, `Id_Cliente`, `Id_Usuario`, `Id_Catalogo`) VALUES
(1, 'Pendiente', '2025-07-09', '09:15:00', 1, 1, NULL),
(2, 'Pendiente', '2025-07-09', '01:43:00', 2, 2, NULL),
(3, 'Pendiente', '2025-07-13', '11:27:00', 3, 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id_Cliente` int(11) NOT NULL,
  `Rif` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Poder` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Traspaso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Id_Documento` int(11) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_Cliente`, `Rif`, `Poder`, `Traspaso`, `Id_Documento`, `Id_Usuario`) VALUES
(1, '4546546546', NULL, NULL, NULL, 1),
(2, '1564654', NULL, NULL, NULL, 2),
(3, '4546546546', NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_vendedor`
--

CREATE TABLE `c_vendedor` (
  `Id_Vendedor` int(11) NOT NULL,
  `Cedula` varchar(8) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Nombre_Apellido` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Telefono` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Rif` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Copia_Llaves` tinyint(1) DEFAULT NULL,
  `Garantia_Vehiculo` tinyint(1) DEFAULT NULL,
  `Certificado_Garantia` tinyint(1) DEFAULT NULL,
  `Manual_VehiculoGarantia` tinyint(1) DEFAULT NULL,
  `Id_Documento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `c_vendedor`
--

INSERT INTO `c_vendedor` (`Id_Vendedor`, `Cedula`, `Nombre_Apellido`, `Telefono`, `Rif`, `Copia_Llaves`, `Garantia_Vehiculo`, `Certificado_Garantia`, `Manual_VehiculoGarantia`, `Id_Documento`) VALUES
(1, '123456', 'ghkjhkkj', '0001321300', '4546546546', 1, 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_mantenimiento`
--

CREATE TABLE `det_mantenimiento` (
  `Id_Detalle` int(11) NOT NULL,
  `Tipo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Id_Mantenimiento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentacion`
--

CREATE TABLE `documentacion` (
  `Id_Documento` int(11) NOT NULL,
  `Original_TotalPropiedad` tinyint(1) DEFAULT NULL,
  `Experticia_Transito` tinyint(1) DEFAULT NULL,
  `Certificado_Origen` tinyint(1) DEFAULT NULL,
  `Carnet_Circulacion` tinyint(1) DEFAULT NULL,
  `Reserva_Dominio` tinyint(1) DEFAULT NULL,
  `Finiquito` tinyint(1) DEFAULT NULL,
  `Factura_Compra` tinyint(1) DEFAULT NULL,
  `Resguardo` tinyint(1) DEFAULT NULL,
  `Fecha_Transferencia` tinyint(1) DEFAULT NULL,
  `Gato` tinyint(1) DEFAULT NULL,
  `Repuesto` tinyint(1) DEFAULT NULL,
  `Triangulo` tinyint(1) DEFAULT NULL,
  `Seguro` tinyint(1) DEFAULT NULL,
  `Kilometraje` int(11) DEFAULT NULL,
  `Fecha_Ingreso` date DEFAULT NULL,
  `Fecha_Venta` date DEFAULT NULL,
  `Otro_Documento` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documentacion`
--

INSERT INTO `documentacion` (`Id_Documento`, `Original_TotalPropiedad`, `Experticia_Transito`, `Certificado_Origen`, `Carnet_Circulacion`, `Reserva_Dominio`, `Finiquito`, `Factura_Compra`, `Resguardo`, `Fecha_Transferencia`, `Gato`, `Repuesto`, `Triangulo`, `Seguro`, `Kilometraje`, `Fecha_Ingreso`, `Fecha_Venta`, `Otro_Documento`) VALUES
(2, 1, 0, 1, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(3, 1, 0, 0, 0, 1, 1, 1, 0, NULL, 0, 1, 0, 0, 20, '0000-00-00', '0000-00-00', NULL),
(4, 1, 0, 0, 0, 1, 1, 1, 0, NULL, 1, 1, 0, 0, 5, '0000-00-00', '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `Id_Imagen` int(11) NOT NULL,
  `URL` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Id_Vehiculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`Id_Imagen`, `URL`, `Id_Vehiculo`) VALUES
(2, 'uploads/vehiculos/68536b09c2bc7-descarga.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `Id_Mantenimiento` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci,
  `Quien_Autoriza` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Id_Vehiculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`Id_Mantenimiento`, `Fecha`, `Descripcion`, `Quien_Autoriza`, `Id_Vehiculo`) VALUES
(1, '2025-07-11', 'fghdhh', 'dfhdfh', NULL),
(2, '2025-07-11', 'fghdhh', 'dghgfhg', NULL),
(3, '2025-07-13', 'holaaaa', 'yo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `Id_Marca` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`Id_Marca`, `Nombre`) VALUES
(1, 'Toyota'),
(2, 'Chevrolet'),
(5, 'Daewbo'),
(6, 'Cocoa'),
(7, 'Hola'),
(8, 'Casa'),
(9, 'Corolla'),
(10, 'Yujuu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `Id_Modelo` int(11) NOT NULL,
  `Nombre_modelo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`Id_Modelo`, `Nombre_modelo`) VALUES
(1, 'Honda'),
(2, 'kiubo'),
(3, 'Cielo'),
(4, 'Pablo'),
(5, 'Chevrolet'),
(6, 'Piso'),
(7, 'Ferrari'),
(8, 'Holaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `Id_Proveedor` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Apellido` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Direccion` text COLLATE utf8_spanish_ci,
  `Cedula` varchar(8) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Telefono` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Tipo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`Id_Proveedor`, `Nombre`, `Apellido`, `Direccion`, `Cedula`, `Telefono`, `Tipo`) VALUES
(1, 'toyota', 'gutierrez', 'casa verdes', '000000', '23234234', 'nacional'),
(2, 'yesenia', 'escobar', 'jose felix', '5555555', '23234234', 'local');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Id_Rol` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Id_Rol`, `Nombre`) VALUES
(1, 'administrador'),
(2, 'vendedor'),
(3, 'cliente'),
(4, 'jefe_patio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_realizados`
--

CREATE TABLE `servicios_realizados` (
  `Id_Servicios` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Costo` decimal(10,2) DEFAULT NULL,
  `Id_Detalle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usuario` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Apellido` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Cedula` varchar(8) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Correo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Telefono` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Direccion` text COLLATE utf8_spanish_ci,
  `Contrasena` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Id_Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usuario`, `Nombre`, `Apellido`, `Cedula`, `Correo`, `Telefono`, `Direccion`, `Contrasena`, `Id_Rol`) VALUES
(1, 'yenifer', 'escobar', '123456', 'ELICIE28@HOTMAIL.COM', '23234234', '', '$2y$10$0np54ME5ugVeKBBkbcXt9eLeqW1QwJtD9f.egC9Q3E9', 3),
(2, 'daryeli', 'gutierrez', '5555555', 'daryeli2003gutierrez@gmail.com', '23234234', '', '$2y$10$vuDLkpBvMXCS94sbS21CruMQ6ppud8ZPm/BcU.yzke4', 3),
(3, 'toyota', 'escobar', '123456', 'daryeli2003gutierrez@gmail.com', '000000', '', '$2y$10$rVY3c2xfQg8KrF0VhcNwnOrbO6keMGhC9IFlFW.FBnX', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `Id_Vehiculo` int(11) NOT NULL,
  `Placa` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Color` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Anio` int(11) DEFAULT NULL,
  `Tipo` text COLLATE utf8_spanish_ci NOT NULL,
  `Id_Marca` int(11) NOT NULL,
  `Id_Modelo` int(11) DEFAULT NULL,
  `Id_Documento` int(11) DEFAULT NULL,
  `Id_Proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`Id_Vehiculo`, `Placa`, `Color`, `Anio`, `Tipo`, `Id_Marca`, `Id_Modelo`, `Id_Documento`, `Id_Proveedor`) VALUES
(2, 'dhd445', 'azul cielo', 1990, 'carro', 2, 5, 2, NULL),
(3, 'dhd445', 'Negro', 2003, 'carro', 1, 5, 3, NULL),
(4, 'dhd445', 'Negro', 2003, 'camion', 5, 5, 4, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`Id_Catalogo`),
  ADD KEY `Id_Vehículo` (`Id_Vehiculo`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`Id_Citas`),
  ADD UNIQUE KEY `Id_Usuario` (`Id_Usuario`),
  ADD KEY `Id_Cliente` (`Id_Cliente`),
  ADD KEY `Id_Catalogo` (`Id_Catalogo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_Cliente`),
  ADD KEY `Id_Documento` (`Id_Documento`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `c_vendedor`
--
ALTER TABLE `c_vendedor`
  ADD PRIMARY KEY (`Id_Vendedor`),
  ADD KEY `Id_Documento` (`Id_Documento`);

--
-- Indices de la tabla `det_mantenimiento`
--
ALTER TABLE `det_mantenimiento`
  ADD PRIMARY KEY (`Id_Detalle`),
  ADD KEY `Id_Mantenimiento` (`Id_Mantenimiento`);

--
-- Indices de la tabla `documentacion`
--
ALTER TABLE `documentacion`
  ADD PRIMARY KEY (`Id_Documento`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`Id_Imagen`),
  ADD KEY `Id_Vehículo` (`Id_Vehiculo`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`Id_Mantenimiento`),
  ADD KEY `Id_Vehículo` (`Id_Vehiculo`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`Id_Marca`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`Id_Modelo`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`Id_Proveedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Id_Rol`);

--
-- Indices de la tabla `servicios_realizados`
--
ALTER TABLE `servicios_realizados`
  ADD PRIMARY KEY (`Id_Servicios`),
  ADD KEY `Id_Detalle` (`Id_Detalle`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `Id_Rol` (`Id_Rol`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`Id_Vehiculo`),
  ADD KEY `Id_Documento` (`Id_Documento`),
  ADD KEY `Id_Proveedor` (`Id_Proveedor`),
  ADD KEY `Id_Marca` (`Id_Marca`),
  ADD KEY `Id_Modelo` (`Id_Modelo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `Id_Catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `Id_Citas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `c_vendedor`
--
ALTER TABLE `c_vendedor`
  MODIFY `Id_Vendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `det_mantenimiento`
--
ALTER TABLE `det_mantenimiento`
  MODIFY `Id_Detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentacion`
--
ALTER TABLE `documentacion`
  MODIFY `Id_Documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `Id_Imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `Id_Mantenimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `Id_Marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `Id_Modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `Id_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicios_realizados`
--
ALTER TABLE `servicios_realizados`
  MODIFY `Id_Servicios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `Id_Vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD CONSTRAINT `catalogo_ibfk_1` FOREIGN KEY (`Id_Vehiculo`) REFERENCES `vehiculo` (`Id_Vehiculo`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id_Cliente`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`Id_Catalogo`) REFERENCES `catalogo` (`Id_Catalogo`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id_Usuario`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`Id_Documento`) REFERENCES `documentacion` (`Id_Documento`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id_Usuario`);

--
-- Filtros para la tabla `c_vendedor`
--
ALTER TABLE `c_vendedor`
  ADD CONSTRAINT `c_vendedor_ibfk_1` FOREIGN KEY (`Id_Documento`) REFERENCES `documentacion` (`Id_Documento`);

--
-- Filtros para la tabla `det_mantenimiento`
--
ALTER TABLE `det_mantenimiento`
  ADD CONSTRAINT `det_mantenimiento_ibfk_1` FOREIGN KEY (`Id_Mantenimiento`) REFERENCES `mantenimiento` (`Id_Mantenimiento`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`Id_Vehiculo`) REFERENCES `vehiculo` (`Id_Vehiculo`);

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `mantenimiento_ibfk_1` FOREIGN KEY (`Id_Vehiculo`) REFERENCES `vehiculo` (`Id_Vehiculo`);

--
-- Filtros para la tabla `servicios_realizados`
--
ALTER TABLE `servicios_realizados`
  ADD CONSTRAINT `servicios_realizados_ibfk_1` FOREIGN KEY (`Id_Detalle`) REFERENCES `det_mantenimiento` (`Id_Detalle`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Id_Rol`) REFERENCES `rol` (`Id_Rol`);

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`Id_Documento`) REFERENCES `documentacion` (`Id_Documento`),
  ADD CONSTRAINT `vehiculo_ibfk_2` FOREIGN KEY (`Id_Proveedor`) REFERENCES `proveedor` (`Id_Proveedor`),
  ADD CONSTRAINT `vehiculo_ibfk_3` FOREIGN KEY (`Id_Modelo`) REFERENCES `modelo` (`Id_Modelo`),
  ADD CONSTRAINT `vehiculo_ibfk_4` FOREIGN KEY (`Id_Marca`) REFERENCES `marca` (`Id_Marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
