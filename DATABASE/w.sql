-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2025 a las 06:08:35
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
(56, 'klasñdfls'),
(60, 'ssd');

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
(38, 'kkk', '76kkkkkM'),
(53, '9990', 'jklkmll');

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
(35, '11111111', 'Jean Carlos', 'Leal Guedez', 'Carrera 18\r\nSanta EduvigisL', '04268092179', 'jeancleal03022004@gmail.com', '2025-10-29 17:43:12', 65, 38, 'activo'),
(37, '111111117', 'dsfdfsd', 'dsfdsf', 'KLDFLSDF', '37844434342', 'sdasds@GAMIL.COM', '2025-10-30 13:23:09', 65, 38, 'activo'),
(44, '1111111144', 'sddfs', 'sdffs', 'sfdsfdsf', '34454534', 'dfsd@gamil.com', '2025-10-30 23:21:55', 81, 38, 'activo'),
(46, '999999999', 'Pedro', 'Pedro', 'Carrera 18\r\nSanta Eduvigis', '0000000000', 'Pedro@gmail.com', '2025-10-31 12:00:42', 65, 38, 'activo');

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
(11, 'J-00000020-0', 'Courier', 'Carrera 18', '435534534', 'jeancleal03022004@gmail.cos'),
(15, 'J-00000800-0', 'CourierDDD', 'EWESD', '45678977', 'DSFASD@DSAD.CO'),
(16, 'J-12345658-2', 'SDASDA', 'SDFSDFSF', '3423423', '343SDFDSF@GMAIL.COM'),
(17, 'J-00000040-0', 'CourierE', 'EWESD', '444443233', 'ZDFSDS@GMIAL.COM');

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

--
-- Volcado de datos para la tabla `detalle_sacas`
--

INSERT INTO `detalle_sacas` (`ID_Detalle`, `ID_Saca`, `ID_Paquete`, `Fecha_Agregado`) VALUES
(55, 53, 57, '2025-10-31 01:17:47'),
(56, 56, 49, '2025-10-31 01:29:29'),
(57, 56, 50, '2025-10-31 01:29:33');

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
(16, 'logo-rapi.png', 'perfil_20251031_034310_59c9ef2fd7a605f7.png', '2025-10-30 22:43:10'),
(19, 'logo-rapi.png', 'perfil_20251031_171009_c17a3449c53ed53a.png', '2025-10-31 12:10:09');

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

--
-- Volcado de datos para la tabla `manifiestos`
--

INSERT INTO `manifiestos` (`ID_Manifiesto`, `ID_Saca`, `ID_Usuario`, `Ruta_PDF`, `Fecha_Creacion`) VALUES
(74, 34, 1, 'storage/manifiestos/Manifiesto_Saca_SACA-977A3F5C_20251030154953.pdf', '2025-10-30 10:49:53'),
(75, 34, 1, 'storage/manifiestos/Manifiesto_Saca_SACA-977A3F5C_20251030185659.pdf', '2025-10-30 13:56:59'),
(76, 53, 20, 'storage/manifiestos/Manifiesto_Saca_SACA-13A0B46A_20251031070141.pdf', '2025-10-31 02:01:42'),
(77, 55, 20, 'storage/manifiestos/Manifiesto_Saca_SACA-079EA55C_20251031070154.pdf', '2025-10-31 02:01:54'),
(78, 56, 20, 'storage/manifiestos/Manifiesto_Saca_SACA-9E56E5BF_20251031070201.pdf', '2025-10-31 02:02:01');

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
  `Paquete_Piezas` int(11) DEFAULT 1,
  `Qr_code` varchar(50) DEFAULT NULL,
  `Estado` enum('En tránsito','Entregado','Fallido') DEFAULT 'En tránsito',
  `ID_Saca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`ID_Paquete`, `ID_Prealerta`, `ID_Usuario`, `ID_Cliente`, `Nombre_Instrumento`, `ID_Categoria`, `ID_Sucursal`, `Tracking`, `ID_Courier`, `Prealerta_Descripcion`, `Paquete_Peso`, `Paquete_Piezas`, `Qr_code`, `Estado`, `ID_Saca`) VALUES
(48, NULL, 1, 37, '55666', 6, 65, 'PKG-88461', 11, 'dsf', 4.00, 1, 'PAQUETE-PKG-88461-20251030_201858.png', 'Entregado', NULL),
(49, NULL, 1, 35, 'jsdf', 9, 65, 'PKG-89706', 11, 'L', 8.00, 1, 'PAQUETE-PKG-89706.png', 'En tránsito', 56),
(50, NULL, 1, 37, 'K', 9, 65, 'PKG-06171', 11, 'K', 4.00, 3, 'PAQUETE-PKG-06171.png', 'En tránsito', 56),
(51, NULL, 1, 37, 'D', 9, 65, 'PKG-44394', 8, 'D', 8.00, 6, 'PAQUETE-PKG-44394.png', 'En tránsito', NULL),
(57, NULL, 1, 44, 'jsdf', 6, 81, 'PKG-87250', 17, 'ksddas', 6678.00, 1, 'PAQUETE-PKG-87250.png', 'En tránsito', 53),
(60, NULL, 20, 46, 'soda', 6, 81, 'PKG-53282', 11, 'soda', 34.00, 63, 'PAQUETE-PKG-53282.png', 'En tránsito', NULL);

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
(83, 35, 18, 20, 38, 81, 'skdf', 3, 45.00, 'a[sd', 'Prealerta');

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
  `Qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sacas`
--

INSERT INTO `sacas` (`ID_Saca`, `Codigo_Saca`, `Fecha_Creacion`, `ID_Usuario`, `ID_Sucursal`, `Estado`, `Peso_Total`, `Qr_code`) VALUES
(53, 'SACA-13A0B46A', '2025-10-31 01:17:15', 20, 81, 'En tránsito', 6678.00, NULL),
(55, 'SACA-079EA55C', '2025-10-31 01:27:15', 20, 65, 'Pendiente', 0.00, NULL),
(56, 'SACA-9E56E5BF', '2025-10-31 01:29:11', 20, 65, 'Pendiente', 12.00, 'SACA-SACA-9E56E5BF.png'),
(57, 'SACA-4096CDCA', '2025-10-31 01:49:42', 20, 65, 'Pendiente', 0.00, 'SACA-SACA-4096CDCA.png'),
(58, 'SACA-7F86BD6F', '2025-10-31 01:52:19', 20, 81, 'En tránsito', 0.00, NULL);

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
(63, 'J-12345678-8', 'Sucursal Central', 'GuayaquilLS', '04246567895', 'central@empresa.com'),
(65, 'J-12347678-3', 'Sucursaentral', 'Guayaquil', '04142345673', 'central@presa.com'),
(66, 'J-12345678-3', 'Sucursal SSSSCentral', 'Guayaquil', '042646567895', 'ceSntral@empresa.DD'),
(67, 'J-12335678-3', 'Jean Carlos Leal Gue', 'Carrera 18', '042680921773', 'jeancleal03022004@gmail.comKDDDDD'),
(81, 'J-12445678-3', 'DFSFD', 'DFSFFDS', '34554545', 'SDFSDFD@gmail.ds');

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
(5, 'ssss', 'Mi casa', '043394174433', 'support@LLmazon.coms'),
(18, 'ssssS', 'ASDAS', '434433333', 'supportE@LLmazon.Dcomd');

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
(1, '11111111', 'JEAL', 'LEAL', 'admin', '$2y$10$biifrQh4ZmTtDjG9.Z2ouuAGyTMBhU2SIDnlfJxttAmeiEzhFZK.2', '0414558557', 'admin@mail.com', 'ddyuL', '2025-08-27 13:16:47', 16, 1, 63),
(20, '0000000000', 'Kelvy Jose', 'De Narvaez', 'Kelvys', '$2y$10$5X2Qbed/FPW5DEO1WG6Nh.aRSi9iNJSIzB40A62YSZTA1ZsIzVQ2S', '0323232323233', 'KelvyyWill@gmail.com', 'Tukolsdg', '2025-10-30 18:38:51', 19, 56, 67),
(22, '999999944', 'sdfd', 'sdf', 'dsfdf', '$2y$10$tqvy/A5UwQC5OiB3VK.Z0e5n4lEuBzeejzqiFBaAwTeAWP/G77yeC', '04268442177', 'sdfd422@fds.fs', 'Carrera 18df', '2025-10-31 00:57:55', NULL, 1, 81);

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
  MODIFY `ID_Cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `casilleros`
--
ALTER TABLE `casilleros`
  MODIFY `ID_Casillero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `courier`
--
ALTER TABLE `courier`
  MODIFY `ID_Courier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `detalle_sacas`
--
ALTER TABLE `detalle_sacas`
  MODIFY `ID_Detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `ID_Imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `manifiestos`
--
ALTER TABLE `manifiestos`
  MODIFY `ID_Manifiesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `ID_Paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `prealertas`
--
ALTER TABLE `prealertas`
  MODIFY `ID_Prealerta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `sacas`
--
ALTER TABLE `sacas`
  MODIFY `ID_Saca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  MODIFY `ID_Seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `ID_Sucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `ID_Tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
