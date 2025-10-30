-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2025 a las 23:29:11
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
-- Base de datos: `w`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `ID_Cargo` int(11) NOT NULL,
  `Cargo_Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`ID_Cargo`, `Cargo_Nombre`) VALUES
(1, 'Administrador'),
(2, 'Empleados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casilleros`
--

CREATE TABLE `casilleros` (
  `ID_Casillero` int(11) NOT NULL,
  `Casillero_Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `casilleros`
--

INSERT INTO `casilleros` (`ID_Casillero`, `Casillero_Nombre`, `Direccion`) VALUES
(36, '4533', 'sdfssd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `ID_Categoria` int(11) NOT NULL,
  `Categoria_Nombre` varchar(50) DEFAULT NULL,
  `Categoria_Altura` decimal(10,2) DEFAULT NULL,
  `Categoria_Largo` decimal(10,2) DEFAULT NULL,
  `Categoria_Ancho` decimal(10,2) DEFAULT NULL,
  `Categoria_Peso` decimal(10,2) DEFAULT NULL,
  `Categoria_Piezas` int(11) DEFAULT NULL,
  `Categoria_Precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`ID_Categoria`, `Categoria_Nombre`, `Categoria_Altura`, `Categoria_Largo`, `Categoria_Ancho`, `Categoria_Peso`, `Categoria_Piezas`, `Categoria_Precio`) VALUES
(6, 'SAD', 3.00, 3.00, 3.00, 3.00, 3, 3.00),
(9, '4545', 567.00, 5.00, 7.00, 6.00, 45, 3456.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_Cliente` int(11) NOT NULL,
  `Cedula_Identidad` varchar(23) NOT NULL,
  `Nombres_Cliente` varchar(50) NOT NULL,
  `Apellidos_Cliente` varchar(50) NOT NULL,
  `Direccion_Cliente` varchar(255) DEFAULT NULL,
  `Telefono_Cliente` varchar(20) DEFAULT NULL,
  `Correo_Cliente` varchar(100) DEFAULT NULL,
  `Fecha_Registro` datetime DEFAULT current_timestamp(),
  `ID_Sucursal` int(11) DEFAULT NULL,
  `ID_Casillero` int(11) DEFAULT NULL,
  `Estado_Cliente` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Cedula_Identidad`, `Nombres_Cliente`, `Apellidos_Cliente`, `Direccion_Cliente`, `Telefono_Cliente`, `Correo_Cliente`, `Fecha_Registro`, `ID_Sucursal`, `ID_Casillero`, `Estado_Cliente`) VALUES
(35, '11111111', 'Jean Carlos', 'Leal Guedez', 'Carrera 18\r\nSanta Eduvigis', '04268092177', 'jeancleal03022004@gmail.com', '2025-10-29 17:43:12', 65, 36, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courier`
--

CREATE TABLE `courier` (
  `ID_Courier` int(11) NOT NULL,
  `RIF_Courier` varchar(23) NOT NULL,
  `Courier_Nombre` varchar(100) NOT NULL,
  `Courier_Direccion` varchar(255) DEFAULT NULL,
  `Courier_Telefono` varchar(20) DEFAULT NULL,
  `Courier_Correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `courier`
--

INSERT INTO `courier` (`ID_Courier`, `RIF_Courier`, `Courier_Nombre`, `Courier_Direccion`, `Courier_Telefono`, `Courier_Correo`) VALUES
(8, 'J-00000000-0', 'Courierjdd', 'Couriers', '4444432', 'ZDFD@GMIAL.COM'),
(11, 'J-00000020-0', 'Courier', 'Carrera 18', '435534534', 'jeancleal03022004@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_sacas`
--

CREATE TABLE `detalle_sacas` (
  `ID_Detalle` int(11) NOT NULL,
  `ID_Saca` int(11) NOT NULL,
  `ID_Paquete` int(11) NOT NULL,
  `Fecha_Agregado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `ID_Imagen` int(11) NOT NULL,
  `imagen_nombre_original` varchar(255) NOT NULL,
  `imagen_archivo` varchar(255) NOT NULL,
  `Fecha_Subida` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`ID_Imagen`, `imagen_nombre_original`, `imagen_archivo`, `Fecha_Subida`) VALUES
(14, 'img.jpg', 'perfil_20251029_102445_47394f820572aef9.jpg', '2025-10-29 05:24:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manifiestos`
--

CREATE TABLE `manifiestos` (
  `ID_Manifiesto` int(11) NOT NULL,
  `ID_Saca` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Ruta_PDF` varchar(255) NOT NULL,
  `Fecha_Creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `ID_Paquete` int(11) NOT NULL,
  `ID_Prealerta` int(11) DEFAULT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `ID_Cliente` int(11) DEFAULT NULL,
  `Nombre_Instrumento` varchar(255) DEFAULT NULL,
  `ID_Categoria` int(11) DEFAULT NULL,
  `ID_Sucursal` int(11) DEFAULT NULL,
  `Tracking` varchar(50) NOT NULL,
  `ID_Courier` int(11) DEFAULT NULL,
  `Prealerta_Descripcion` text DEFAULT NULL,
  `Paquete_Peso` decimal(10,2) DEFAULT 0.00,
  `Qr_code` varchar(50) DEFAULT NULL,
  `Estado` enum('En tránsito','Entregado','Fallido') DEFAULT 'En tránsito',
  `ID_Saca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`ID_Paquete`, `ID_Prealerta`, `ID_Usuario`, `ID_Cliente`, `Nombre_Instrumento`, `ID_Categoria`, `ID_Sucursal`, `Tracking`, `ID_Courier`, `Prealerta_Descripcion`, `Paquete_Peso`, `Qr_code`, `Estado`, `ID_Saca`) VALUES
(35, NULL, 1, 35, 'jsdf', 9, 65, 'PKG-14109', 8, 'asd', 784.00, 'PAQUETE-PKG-14109.png', 'En tránsito', NULL),
(37, NULL, 1, 35, '55666', 9, 65, 'PKG-44194', 8, 'klzsd', 567.00, 'PAQUETE-PKG-44194.png', 'En tránsito', NULL),
(38, NULL, 1, 35, 'jsdf', 9, 65, 'PKG-89838', 8, 'klzs', 56768.00, 'PAQUETE-PKG-89838.png', 'En tránsito', NULL);

--
-- Disparadores `paquetes`
--
DELIMITER $$
CREATE TRIGGER `trg_paquetes_before_insert` BEFORE INSERT ON `paquetes` FOR EACH ROW BEGIN
    IF NEW.ID_Prealerta IS NOT NULL THEN
        SET NEW.Paquete_Peso = (
            SELECT Prealerta_Peso FROM prealertas WHERE ID_Prealerta = NEW.ID_Prealerta
        );
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prealertas`
--

CREATE TABLE `prealertas` (
  `ID_Prealerta` int(11) NOT NULL,
  `ID_Cliente` int(11) DEFAULT NULL,
  `ID_Tienda` int(11) DEFAULT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `ID_Casillero` int(11) DEFAULT NULL,
  `ID_Sucursal` int(11) DEFAULT NULL,
  `Tracking_Tienda` varchar(100) DEFAULT NULL,
  `Prealerta_Piezas` int(11) DEFAULT NULL,
  `Prealerta_Peso` decimal(10,2) DEFAULT NULL,
  `Prealerta_Descripcion` text DEFAULT NULL,
  `Estado` enum('Prealerta','Consolidado') NOT NULL DEFAULT 'Prealerta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prealertas`
--

INSERT INTO `prealertas` (`ID_Prealerta`, `ID_Cliente`, `ID_Tienda`, `ID_Usuario`, `ID_Casillero`, `ID_Sucursal`, `Tracking_Tienda`, `Prealerta_Piezas`, `Prealerta_Peso`, `Prealerta_Descripcion`, `Estado`) VALUES
(70, 35, 13, 1, 36, 65, 'bsd44kk', 67, 89.00, 'klsad', 'Prealerta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sacas`
--

CREATE TABLE `sacas` (
  `ID_Saca` int(11) NOT NULL,
  `Codigo_Saca` varchar(50) NOT NULL,
  `Fecha_Creacion` datetime DEFAULT current_timestamp(),
  `ID_Usuario` int(11) DEFAULT NULL,
  `ID_Sucursal` int(11) DEFAULT NULL,
  `Estado` enum('Pendiente','En tránsito','Entregada') DEFAULT 'Pendiente',
  `Peso_Total` decimal(10,2) DEFAULT 0.00,
  `Qr_Code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos`
--

CREATE TABLE `seguimientos` (
  `ID_Seguimiento` int(11) NOT NULL,
  `ID_Cliente` int(11) NOT NULL,
  `ID_Paquete` int(11) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `ID_Sucursal` int(11) NOT NULL,
  `RIF_Sucursal` varchar(20) NOT NULL,
  `Sucursal_Nombre` varchar(50) NOT NULL,
  `Sucursal_Direccion` varchar(255) DEFAULT NULL,
  `Sucursal_Telefono` varchar(20) DEFAULT NULL,
  `Sucursal_Correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`ID_Sucursal`, `RIF_Sucursal`, `Sucursal_Nombre`, `Sucursal_Direccion`, `Sucursal_Telefono`, `Sucursal_Correo`) VALUES
(63, 'J-12345678-8', 'Sucursal Central', 'Guayaquil', '04246567895', 'central@empresa.com'),
(65, 'J-12347678-3', 'Sucursaentral', 'Guayaquil', '04142345673', 'central@presa.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `ID_Tienda` int(11) NOT NULL,
  `Tienda_Nombre` varchar(50) DEFAULT NULL,
  `Tienda_Direccion` varchar(255) DEFAULT NULL,
  `Tienda_Telefono` varchar(20) DEFAULT NULL,
  `Tienda_Correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`ID_Tienda`, `Tienda_Nombre`, `Tienda_Direccion`, `Tienda_Telefono`, `Tienda_Correo`) VALUES
(1, 'Tienda', 'Av Comercio 100', '0412112222', 'tiendaA@mail.com'),
(2, 'Tienda B', 'Av Comercio 200', '0412-3334444', 'tiendaB@mail.com'),
(5, 'ssss', 'Mi casa', '04339417443', 'support@LLmazon.com'),
(13, 'S', 'Mi DcasaD', '04339417442', 'supSDport@LLmazon.com'),
(15, 'ssssd', 'Mi dd', '04339447443', 'support@LLmazon.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Cedula_Identidad` varchar(23) NOT NULL,
  `Nombres_Usuario` varchar(50) NOT NULL,
  `Apellidos_Usuario` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Telefono_Usuario` varchar(20) DEFAULT NULL,
  `Correo_Usuario` varchar(100) DEFAULT NULL,
  `Direccion_Usuario` varchar(255) DEFAULT NULL,
  `Fecha_Registro` datetime DEFAULT current_timestamp(),
  `ID_Imagen` int(11) DEFAULT NULL,
  `ID_Cargo` int(11) DEFAULT NULL,
  `ID_Sucursal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `Cedula_Identidad`, `Nombres_Usuario`, `Apellidos_Usuario`, `Username`, `Password`, `Telefono_Usuario`, `Correo_Usuario`, `Direccion_Usuario`, `Fecha_Registro`, `ID_Imagen`, `ID_Cargo`, `ID_Sucursal`) VALUES
(1, '11111111', 'JEAL', 'LEAL', 'admin', '$2y$10$qlSzyXyEg4LjxpE97xkNb.OetvVKJis2Bxj6JvuocqUNDzS77m/3O', '0414558557', 'admin@mail.com', 'ddyu', '2025-08-27 13:16:47', 14, 1, 63),
(17, '474556668', 'Jean Carlos', 'Leal Guedez', 'admin6', '$2y$10$LfQCDDweQW4dhdClCHJAlu3O6hY.hExSEMl.OCC8S0k0UcdJ0izD2', '0426809279', 'jeancleal0322004@gmail.com', 'Carrera 18', '2025-10-27 17:53:27', NULL, 2, NULL),
(18, '445566687', 'Jeanarlos', 'Lealz', 'admin68', '$2y$10$FzhVvz6A8dMhz7aLD2e1XemXbrEJaAzGW4Z76KhR0PfZq0hdpqPFy', '04268092177', 'jeancleal0302004@gmail.com', 'Carrera 18', '2025-10-27 17:55:45', NULL, 2, NULL),
(19, '111111115', 'JeanCarlos', 'Leal', 'emple', '$2y$10$o1yzniNLdh5gIIrojN.QsOXJeBOHZdx2wzOSJdGVygsL2qQhRwsUi', '0426708177', 'jeanclea022004@gmail.com', 'Carrera 18', '2025-10-28 00:21:02', NULL, 2, 65);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`ID_Cargo`);

--
-- Indices de la tabla `casilleros`
--
ALTER TABLE `casilleros`
  ADD PRIMARY KEY (`ID_Casillero`),
  ADD KEY `ID_Casillero` (`ID_Casillero`,`Casillero_Nombre`,`Direccion`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_Cliente`),
  ADD UNIQUE KEY `Cedula_Identidad` (`Cedula_Identidad`),
  ADD UNIQUE KEY `Correo_Cliente` (`Correo_Cliente`),
  ADD KEY `ID_Sucursal` (`ID_Sucursal`),
  ADD KEY `ID_Casillero` (`ID_Casillero`);

--
-- Indices de la tabla `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`ID_Courier`),
  ADD UNIQUE KEY `RIF_Courier` (`RIF_Courier`),
  ADD UNIQUE KEY `Courier_Correo` (`Courier_Correo`);

--
-- Indices de la tabla `detalle_sacas`
--
ALTER TABLE `detalle_sacas`
  ADD PRIMARY KEY (`ID_Detalle`),
  ADD UNIQUE KEY `UNQ_Saca_Paquete` (`ID_Saca`,`ID_Paquete`),
  ADD KEY `FK_DetalleSaca_Saca` (`ID_Saca`),
  ADD KEY `FK_DetalleSaca_Paquete` (`ID_Paquete`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`ID_Imagen`);

--
-- Indices de la tabla `manifiestos`
--
ALTER TABLE `manifiestos`
  ADD PRIMARY KEY (`ID_Manifiesto`),
  ADD KEY `ID_Saca` (`ID_Saca`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`ID_Paquete`),
  ADD UNIQUE KEY `Tracking` (`Tracking`),
  ADD KEY `FK_Paquete_Prealerta` (`ID_Prealerta`),
  ADD KEY `FK_Paquete_Usuario` (`ID_Usuario`),
  ADD KEY `FK_Paquete_Cliente` (`ID_Cliente`),
  ADD KEY `FK_Paquete_Categoria` (`ID_Categoria`),
  ADD KEY `FK_Paquete_Sucursal` (`ID_Sucursal`),
  ADD KEY `FK_Paquete_Courier` (`ID_Courier`),
  ADD KEY `FK_Paquete_Saca` (`ID_Saca`);

--
-- Indices de la tabla `prealertas`
--
ALTER TABLE `prealertas`
  ADD PRIMARY KEY (`ID_Prealerta`),
  ADD UNIQUE KEY `Tracking_Tienda` (`Tracking_Tienda`),
  ADD KEY `ID_Cliente` (`ID_Cliente`),
  ADD KEY `ID_Tienda` (`ID_Tienda`),
  ADD KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `ID_Casillero` (`ID_Casillero`),
  ADD KEY `ID_Sucursal` (`ID_Sucursal`);

--
-- Indices de la tabla `sacas`
--
ALTER TABLE `sacas`
  ADD PRIMARY KEY (`ID_Saca`),
  ADD UNIQUE KEY `Codigo_Saca` (`Codigo_Saca`),
  ADD KEY `FK_Saca_Usuario` (`ID_Usuario`),
  ADD KEY `FK_Saca_Sucursal` (`ID_Sucursal`);

--
-- Indices de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD PRIMARY KEY (`ID_Seguimiento`),
  ADD KEY `ID_Cliente` (`ID_Cliente`),
  ADD KEY `ID_Paquete` (`ID_Paquete`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`ID_Sucursal`),
  ADD UNIQUE KEY `RIF_Sucursal` (`RIF_Sucursal`),
  ADD UNIQUE KEY `Sucursal_Correo` (`Sucursal_Correo`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`ID_Tienda`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD UNIQUE KEY `Cedula_Identidad` (`Cedula_Identidad`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Correo_Usuario` (`Correo_Usuario`),
  ADD KEY `fk_usuarios_imagenes` (`ID_Imagen`),
  ADD KEY `usuarios_ibfk_1` (`ID_Cargo`),
  ADD KEY `usuarios_ibfk_2` (`ID_Sucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `ID_Cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `casilleros`
--
ALTER TABLE `casilleros`
  MODIFY `ID_Casillero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `courier`
--
ALTER TABLE `courier`
  MODIFY `ID_Courier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalle_sacas`
--
ALTER TABLE `detalle_sacas`
  MODIFY `ID_Detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `ID_Imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `manifiestos`
--
ALTER TABLE `manifiestos`
  MODIFY `ID_Manifiesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `ID_Paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `prealertas`
--
ALTER TABLE `prealertas`
  MODIFY `ID_Prealerta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `sacas`
--
ALTER TABLE `sacas`
  MODIFY `ID_Saca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  MODIFY `ID_Seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `ID_Sucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `ID_Tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`ID_Sucursal`) REFERENCES `sucursales` (`ID_Sucursal`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`ID_Casillero`) REFERENCES `casilleros` (`ID_Casillero`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_sacas`
--
ALTER TABLE `detalle_sacas`
  ADD CONSTRAINT `FK_DetalleSaca_Paquete` FOREIGN KEY (`ID_Paquete`) REFERENCES `paquetes` (`ID_Paquete`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DetalleSaca_Saca` FOREIGN KEY (`ID_Saca`) REFERENCES `sacas` (`ID_Saca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `manifiestos`
--
ALTER TABLE `manifiestos`
  ADD CONSTRAINT `manifiestos_ibfk_1` FOREIGN KEY (`ID_Saca`) REFERENCES `sacas` (`ID_Saca`),
  ADD CONSTRAINT `manifiestos_ibfk_2` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`);

--
-- Filtros para la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD CONSTRAINT `FK_Paquete_Categoria` FOREIGN KEY (`ID_Categoria`) REFERENCES `categorias` (`ID_Categoria`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Paquete_Cliente` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Paquete_Courier` FOREIGN KEY (`ID_Courier`) REFERENCES `courier` (`ID_Courier`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Paquete_Prealerta` FOREIGN KEY (`ID_Prealerta`) REFERENCES `prealertas` (`ID_Prealerta`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Paquete_Saca` FOREIGN KEY (`ID_Saca`) REFERENCES `sacas` (`ID_Saca`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Paquete_Sucursal` FOREIGN KEY (`ID_Sucursal`) REFERENCES `sucursales` (`ID_Sucursal`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Paquete_Usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `prealertas`
--
ALTER TABLE `prealertas`
  ADD CONSTRAINT `prealertas_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prealertas_ibfk_2` FOREIGN KEY (`ID_Tienda`) REFERENCES `tiendas` (`ID_Tienda`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `prealertas_ibfk_3` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `prealertas_ibfk_4` FOREIGN KEY (`ID_Casillero`) REFERENCES `casilleros` (`ID_Casillero`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `prealertas_ibfk_5` FOREIGN KEY (`ID_Sucursal`) REFERENCES `sucursales` (`ID_Sucursal`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `sacas`
--
ALTER TABLE `sacas`
  ADD CONSTRAINT `FK_Saca_Sucursal` FOREIGN KEY (`ID_Sucursal`) REFERENCES `sucursales` (`ID_Sucursal`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Saca_Usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD CONSTRAINT `seguimientos_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seguimientos_ibfk_2` FOREIGN KEY (`ID_Paquete`) REFERENCES `paquetes` (`ID_Paquete`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_imagenes` FOREIGN KEY (`ID_Imagen`) REFERENCES `imagenes` (`ID_Imagen`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ID_Cargo`) REFERENCES `cargos` (`ID_Cargo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`ID_Sucursal`) REFERENCES `sucursales` (`ID_Sucursal`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
