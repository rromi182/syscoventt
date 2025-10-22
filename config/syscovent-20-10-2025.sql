-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 21, 2025 at 01:25 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syscovent`
--

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
CREATE TABLE IF NOT EXISTS `articulos` (
  `id_articulo` int NOT NULL AUTO_INCREMENT,
  `codigo_articulo` varchar(20) DEFAULT NULL,
  `articulo_descrip` varchar(50) NOT NULL,
  `precio` int NOT NULL,
  `foto` varchar(300) DEFAULT NULL,
  `stock_minimo` int DEFAULT '0',
  `id_categoria` int NOT NULL,
  `id_marca` int NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_articulo`),
  UNIQUE KEY `codigo_articulo` (`codigo_articulo`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_marca` (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `codigo_articulo`, `articulo_descrip`, `precio`, `foto`, `stock_minimo`, `id_categoria`, `id_marca`, `estado`) VALUES
(1, 'ARRDS', 'Remera Dama S', 150000, 'remeradama_s.png', 5, 1, 1, 'ACTIVO'),
(2, 'ARRDM', 'Remera Dama M', 150000, 'remeradama_m.png', 5, 1, 1, 'ACTIVO'),
(3, 'CHRCS', 'Remera Classic Jersey S', 100000, 'no-image.jpg', 5, 2, 2, 'ACTIVO'),
(4, 'CHRCM', 'Remera Classic Jersey M', 100000, 'no-image.jpg', 5, 2, 2, 'ACTIVO'),
(5, 'LVPD38', 'Pantalón Dama T38', 250000, 'no-image.jpg', 5, 3, 3, 'ACTIVO'),
(6, 'NKPC40', 'Pantalón Caballero T40', 200000, 'no-image.jpg', 5, 4, 4, 'ACTIVO'),
(7, 'PRUEBA1', 'Prueba', 5000, 'articulo_1760991197_68f697ddb0a2e.png', 5, 1, 1, 'ACTIVO'),
(8, 'PRUEBA 2', 'Prueba 2', 91000, 'no-image.jpg', 5, 4, 4, 'ACTIVO'),
(9, 'PRUEBA3', 'PRUEBA 3', 15000, 'no-image.jpg', 5, 1, 1, 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `id_cargo` int NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `descripcion`, `estado`) VALUES
(1, 'Administrador de Sistemas', 'ACTIVO'),
(2, 'Jefe de Compras', 'ACTIVO'),
(3, 'Auxiliar de Compras', 'ACTIVO'),
(4, 'Jefe de Ventas', 'ACTIVO'),
(5, 'Auxiiar de Ventas', 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `cargos_permisos`
--

DROP TABLE IF EXISTS `cargos_permisos`;
CREATE TABLE IF NOT EXISTS `cargos_permisos` (
  `id_cargo` int NOT NULL,
  `id_permiso` int NOT NULL,
  PRIMARY KEY (`id_cargo`,`id_permiso`),
  KEY `id_permiso` (`id_permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cargos_permisos`
--

INSERT INTO `cargos_permisos` (`id_cargo`, `id_permiso`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 4),
(3, 4),
(1, 5),
(2, 5),
(1, 6),
(3, 6),
(1, 7),
(3, 7),
(1, 8),
(3, 8),
(1, 9),
(2, 9),
(1, 10),
(3, 10),
(1, 11),
(3, 11),
(1, 12),
(3, 12),
(1, 13),
(2, 13),
(1, 14),
(2, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(4, 24);

-- --------------------------------------------------------

--
-- Table structure for table `categoria_articulo`
--

DROP TABLE IF EXISTS `categoria_articulo`;
CREATE TABLE IF NOT EXISTS `categoria_articulo` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `categoria_descrip` varchar(50) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categoria_articulo`
--

INSERT INTO `categoria_articulo` (`id_categoria`, `categoria_descrip`, `estado`) VALUES
(1, 'Remeras Dama', 'ACTIVO'),
(2, 'Remeras Caballero', 'ACTIVO'),
(3, 'Pantalones Dama', 'ACTIVO'),
(4, 'Pantalones Caballero', 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
CREATE TABLE IF NOT EXISTS `ciudades` (
  `id_ciudad` int NOT NULL AUTO_INCREMENT,
  `descrip_ciudad` varchar(35) NOT NULL,
  `id_departamento` int NOT NULL,
  PRIMARY KEY (`id_ciudad`),
  KEY `id_departamento` (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ciudades`
--

INSERT INTO `ciudades` (`id_ciudad`, `descrip_ciudad`, `id_departamento`) VALUES
(1, 'Asunción', 1),
(2, 'Concepción', 2),
(3, 'Horqueta', 2),
(4, 'San Pedro de Ycuamandiyú', 3),
(5, 'San Estanislao', 3),
(6, 'Caacupé', 4),
(7, 'Villarrica', 5),
(8, 'Coronel Oviedo', 6),
(9, 'Caaguazú', 6),
(10, 'Caazapá', 7),
(11, 'Encarnación', 8),
(12, 'San Juan Bautista', 9),
(13, 'Ayolas', 9),
(14, 'Paraguarí', 10),
(15, 'Ciudad del Este', 11),
(16, 'Presidente Franco', 11),
(17, 'Hernandarias', 11),
(18, 'Minga Guazú', 11),
(19, 'San Lorenzo', 12),
(20, 'Capiatá', 12),
(21, 'Lambaré', 12),
(22, 'Fernando de la Mora', 12),
(23, 'Luque', 12),
(24, 'Ñemby', 12),
(25, 'Limpio', 12),
(26, 'Pilar', 13),
(27, 'Pedro Juan Caballero', 14),
(28, 'Salto del Guairá', 15),
(29, 'Villa Hayes', 16),
(30, 'Fuerte Olimpo', 17),
(31, 'Filadelfia', 18),
(32, 'Mariscal Estigarribia', 18);

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id_departamento` int NOT NULL AUTO_INCREMENT,
  `dep_descripcion` varchar(35) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `dep_descripcion`) VALUES
(1, 'Asunción'),
(2, 'Concepción'),
(3, 'San Pedro'),
(4, 'Cordillera'),
(5, 'Guairá'),
(6, 'Caaguazú'),
(7, 'Caazapá'),
(8, 'Itapúa'),
(9, 'Misiones'),
(10, 'Paraguarí'),
(11, 'Alto Paraná'),
(12, 'Central'),
(13, 'Ñeembucú'),
(14, 'Amambay'),
(15, 'Canindeyú'),
(16, 'Presidente Hayes'),
(17, 'Alto Paraguay'),
(18, 'Boquerón');

-- --------------------------------------------------------

--
-- Table structure for table `depositos`
--

DROP TABLE IF EXISTS `depositos`;
CREATE TABLE IF NOT EXISTS `depositos` (
  `id_deposito` int NOT NULL AUTO_INCREMENT,
  `descrip` varchar(50) NOT NULL,
  `id_sucursal` int NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id_deposito`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `depositos`
--

INSERT INTO `depositos` (`id_deposito`, `descrip`, `id_sucursal`, `estado`) VALUES
(1, 'Depósito Central', 1, 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleado` int NOT NULL,
  `id_persona` int NOT NULL,
  `id_cargo` int NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_empleado`),
  KEY `id_persona` (`id_persona`),
  KEY `id_cargo` (`id_cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `id_persona`, `id_cargo`, `estado`) VALUES
(1, 1, 1, 'ACTIVO'),
(2, 2, 2, 'ACTIVO'),
(3, 3, 3, 'ACTIVO'),
(4, 4, 4, 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id_marca` int NOT NULL,
  `marca_descrip` varchar(100) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `marcas`
--

INSERT INTO `marcas` (`id_marca`, `marca_descrip`, `estado`) VALUES
(1, 'AEROPOSTALE', 'ACTIVO'),
(2, 'CHAMPION', 'ACTIVO'),
(3, 'LEVI’S', 'ACTIVO'),
(4, 'NIKE', 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `pedido_compra`
--

DROP TABLE IF EXISTS `pedido_compra`;
CREATE TABLE IF NOT EXISTS `pedido_compra` (
  `id_pedido_compra` int NOT NULL AUTO_INCREMENT,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime DEFAULT NULL,
  `id_user` int NOT NULL,
  `id_sucursal` int NOT NULL,
  `estado` enum('Pendiente','Aprobado','Cancelado') NOT NULL DEFAULT 'Pendiente',
  `observacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pedido_compra`),
  KEY `id_user` (`id_user`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedido_compra_det`
--

DROP TABLE IF EXISTS `pedido_compra_det`;
CREATE TABLE IF NOT EXISTS `pedido_compra_det` (
  `id_pedido_compra` int NOT NULL,
  `id_articulo` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id_pedido_compra`,`id_articulo`),
  KEY `id_articulo` (`id_articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id_permiso` int NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `descripcion`, `estado`) VALUES
(1, 'Ver todo', 'Activo'),
(2, 'Editar todo', 'Activo'),
(3, 'Administrar usuarios', 'Activo'),
(4, 'Ver compras', 'Activo'),
(5, 'Editar compras', 'Activo'),
(6, 'Registrar compras', 'Activo'),
(7, 'Registrar Pedido de Compra', 'Activo'),
(8, 'Registrar Presupuesto de Prove', 'Activo'),
(9, 'Generar Orden de Compra', 'Activo'),
(10, 'Registrar Facturas Compras', 'Activo'),
(11, 'Registrar Notas Crédito/Débito', 'Activo'),
(12, 'Registrar Notas de Remisión Co', 'Activo'),
(13, 'Registrar Ajustes de Stock', 'Activo'),
(14, 'Generar Informes Compras Web', 'Activo'),
(15, 'Registrar Apertura de Caja', 'Activo'),
(16, 'Registrar Facturas Ventas', 'Activo'),
(17, 'Gestionar Cobranzas', 'Activo'),
(18, 'Imprimir Comprobantes', 'Activo'),
(19, 'Generar Notas Crédito/Débito V', 'Activo'),
(20, 'Generar Nota de Remisión Venta', 'Activo'),
(21, 'Generar Arqueo de Caja', 'Activo'),
(22, 'Registrar Cierre de Caja', 'Activo'),
(23, 'Generar Informes Ventas Web', 'Activo'),
(24, 'Ver ventas', 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE IF NOT EXISTS `personas` (
  `id_persona` int NOT NULL,
  `per_ci` int NOT NULL,
  `per_ruc` varchar(30) NOT NULL,
  `per_nombre` varchar(30) NOT NULL,
  `per_apellido` varchar(30) NOT NULL,
  `per_razon_social` varchar(60) NOT NULL,
  `per_fecha_nac` date NOT NULL,
  `per_tel` varchar(11) NOT NULL,
  `per_correo` varchar(100) NOT NULL,
  `per_direccion` varchar(100) NOT NULL,
  `per_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'ACTIVO',
  `per_genero` enum('Masculino','Femenino','Otro') NOT NULL,
  `per_estado_civil` enum('Soltero','Casado','Divorciado','Viudo') NOT NULL,
  `id_tipo_persona` int NOT NULL,
  `id_ciudad` int NOT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `id_tipo_persona` (`id_tipo_persona`),
  KEY `id_ciudad` (`id_ciudad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `personas`
--

INSERT INTO `personas` (`id_persona`, `per_ci`, `per_ruc`, `per_nombre`, `per_apellido`, `per_razon_social`, `per_fecha_nac`, `per_tel`, `per_correo`, `per_direccion`, `per_estado`, `per_genero`, `per_estado_civil`, `id_tipo_persona`, `id_ciudad`) VALUES
(1, 1000001, '1000001-7', 'Romina', 'Almeida', 'Ana Gómez', '1985-03-15', '1234567890', 'ana.gomez@example.com', 'Calle 123, Asunción', 'ACTIVO', 'Femenino', 'Soltero', 1, 1),
(2, 1000002, '1000002-7', 'Jefe ', 'de Compras', 'Carlos López', '1990-07-22', '1234567891', 'carlos.lopez@example.com', 'Calle 456, Asunción', 'ACTIVO', 'Masculino', 'Casado', 1, 1),
(3, 1000003, '1000003-7', 'Auxiliar', 'de Compras', 'María Pérez', '1995-11-10', '1234567892', 'maria.perez@example.com', 'Calle 789, Asunción', 'ACTIVO', 'Femenino', 'Soltero', 1, 1),
(4, 123123, '123123', 'Luz', 'Paredes', '', '2000-07-28', '0992456789', 'luzpa@gmail.com', 'Ficticio 123', 'ACTIVO', 'Femenino', 'Soltero', 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_sucursal` int NOT NULL,
  `id_deposito` int NOT NULL,
  `id_articulo` int NOT NULL,
  `cantidad` int NOT NULL,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_deposito`,`id_articulo`,`id_sucursal`),
  KEY `id_articulo` (`id_articulo`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sucursales`
--

DROP TABLE IF EXISTS `sucursales`;
CREATE TABLE IF NOT EXISTS `sucursales` (
  `id_sucursal` int NOT NULL AUTO_INCREMENT,
  `sucursal` varchar(40) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sucursales`
--

INSERT INTO `sucursales` (`id_sucursal`, `sucursal`, `estado`) VALUES
(1, 'Sucursal 1', 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_persona`
--

DROP TABLE IF EXISTS `tipo_persona`;
CREATE TABLE IF NOT EXISTS `tipo_persona` (
  `id_tipo_persona` int NOT NULL,
  `tp_descrip` varchar(50) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id_tipo_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipo_persona`
--

INSERT INTO `tipo_persona` (`id_tipo_persona`, `tp_descrip`, `estado`) VALUES
(1, 'Empleado', 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `foto` varchar(300) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO','BLOQUEADO') NOT NULL DEFAULT 'ACTIVO',
  `intentos_fallidos` int DEFAULT NULL,
  `id_empleado` int NOT NULL,
  `id_sucursal` int NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_empleado` (`id_empleado`),
  KEY `id_sucursal` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `username`, `password`, `foto`, `estado`, `intentos_fallidos`, `id_empleado`, `id_sucursal`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'foto_admin.png', 'ACTIVO', 0, 1, 1),
(2, 'jcompra', '954cb22b39f0ce9f8ab770210d09aefe', 'foto_jefe.png', 'ACTIVO', 0, 2, 1),
(3, 'acompra', '10a91e89917948100f87cd1228a11540', 'foto_auxi.png', 'ACTIVO', 0, 3, 1),
(7, 'jventas', 'ddfbf114b8d8e0a1e1e44d26f799602d', 'user-photo.png', 'ACTIVO', NULL, 4, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_articulo` (`id_categoria`) ON DELETE RESTRICT,
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE RESTRICT;

--
-- Constraints for table `cargos_permisos`
--
ALTER TABLE `cargos_permisos`
  ADD CONSTRAINT `cargos_permisos_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id_cargo`) ON DELETE CASCADE,
  ADD CONSTRAINT `cargos_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`) ON DELETE CASCADE;

--
-- Constraints for table `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE RESTRICT;

--
-- Constraints for table `depositos`
--
ALTER TABLE `depositos`
  ADD CONSTRAINT `depositos_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON DELETE RESTRICT;

--
-- Constraints for table `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`) ON DELETE CASCADE,
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id_cargo`) ON DELETE RESTRICT;

--
-- Constraints for table `pedido_compra`
--
ALTER TABLE `pedido_compra`
  ADD CONSTRAINT `pedido_compra_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`) ON DELETE RESTRICT,
  ADD CONSTRAINT `pedido_compra_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON DELETE RESTRICT;

--
-- Constraints for table `pedido_compra_det`
--
ALTER TABLE `pedido_compra_det`
  ADD CONSTRAINT `pedido_compra_det_ibfk_1` FOREIGN KEY (`id_pedido_compra`) REFERENCES `pedido_compra` (`id_pedido_compra`) ON DELETE CASCADE;

--
-- Constraints for table `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`id_tipo_persona`) REFERENCES `tipo_persona` (`id_tipo_persona`) ON DELETE RESTRICT,
  ADD CONSTRAINT `personas_ibfk_2` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`) ON DELETE RESTRICT;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_deposito`) REFERENCES `depositos` (`id_deposito`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_ibfk_3` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON DELETE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
