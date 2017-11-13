-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2017 at 08:03 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nelly_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartado`
--

CREATE TABLE `apartado` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `anticipo` double NOT NULL,
  `total` double NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apartado_producto`
--

CREATE TABLE `apartado_producto` (
  `codigo_producto` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_apartado` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  `apellido_paterno` int(11) NOT NULL,
  `apellido_materno` int(11) NOT NULL,
  `rfc` int(11) NOT NULL,
  `direccion` int(11) NOT NULL,
  `e-mail` int(11) NOT NULL,
  `sexo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `motd`
--

CREATE TABLE `motd` (
  `id` int(11) NOT NULL,
  `mensaje` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `motd`
--

INSERT INTO `motd` (`id`, `mensaje`, `id_usuario`, `fecha`) VALUES
(22, 'Este es un mensaje del dia!', 1, '2017-11-12 00:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `codigo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_talla` int(11) NOT NULL,
  `precio` double NOT NULL,
  `cantidad_stock` int(11) NOT NULL,
  `fotografia` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`codigo`, `nombre`, `descripcion`, `id_talla`, `precio`, `cantidad_stock`, `fotografia`, `id_tipo`, `activo`) VALUES
('1051974443', 'Vestido liso Prontomoda azul', 'Vestido slim fit, color AZUL.', 2, 359.2, 14, 'prod_img\\1051974443.jpg', 2, 1),
('1057597323', 'Vestido liso ThatÂ´s It', 'Vestido liso color GRIS, slim.', 2, 259, 10, 'prod_img\\1057597323.jpg', 2, 1),
('1057754887', 'Camisa a rayas Gap', 'Camisa con diseÃ±o a rayas, cuello camisero, fijaciÃ³n de botones al frente y costuras a detalle', 6, 959.2, 30, 'prod_img\\1057754887.jpg', 5, 1),
('1058719449', 'Camisa lisa Tommy Hilfiger seda blanco', 'Camisa con diseÃ±o liso, cuello camisero, bolsillos en parte superior y botÃ³n en puÃ±o', 12, 2124, 20, 'prod_img\\1058719449.jpg', 5, 1),
('1060874515', 'Camisa rombos Tommy Hilfiger rosa claro', 'Camisa con rombos de la marca Tommy Hilfiger rosa claro', 12, 1112, 10, 'prod_img\\1060874515.jpg', 5, 1),
('1060958913', 'Blusa BGL', 'Blusa modelo 2009, liso, con cuello tortuga.', 17, 159.2, 12, 'prod_img\\1060958913.jpg', 8, 1),
('1061949918', 'Vestido Duplan salmÃ³n', 'Vestido Duplan con DiseÃ±o Texturizado salmÃ³n', 1, 959.2, 8, 'prod_img\\1061949918.jpg', 2, 1),
('1062654415', 'Vestido liso Sarah Bustani ', 'Hecho con algodÃ³n negro.', 1, 479.2, 4, 'prod_img\\1062654415.jpg', 2, 1),
('Borrar', 'Borrar', 'BOrrar', 1, 1, 1, 'prod_img\\0.png', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `talla`
--

CREATE TABLE `talla` (
  `id` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `talla` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `talla`
--

INSERT INTO `talla` (`id`, `id_tipo`, `talla`) VALUES
(1, 2, '32'),
(2, 2, '30'),
(3, 3, '36'),
(4, 3, '34'),
(5, 3, '32'),
(6, 5, '28'),
(7, 5, '32'),
(11, 7, '20'),
(12, 5, '2'),
(13, 5, '4'),
(14, 5, '6'),
(15, 5, '8'),
(16, 5, '10'),
(17, 8, 'CH'),
(18, 8, 'M'),
(19, 8, 'G'),
(20, 8, 'XG'),
(21, 6, 'CH'),
(22, 6, 'M'),
(23, 6, 'G');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipo_producto`
--

INSERT INTO `tipo_producto` (`id`, `nombre`) VALUES
(2, 'Vestido'),
(3, 'Pantalon'),
(5, 'Camisa'),
(6, 'Chaleco'),
(7, 'Falda'),
(8, 'Blusa');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nac` date NOT NULL,
  `user` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  `fotografia` text COLLATE utf8mb4_unicode_ci,
  `genero` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biografia` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nac`, `user`, `pass`, `nivel`, `fotografia`, `genero`, `email`, `biografia`, `telefono`, `activo`) VALUES
(1, 'Administrador', 'Administrador', 'Administrador', '2017-11-14', 'admin', 'admin', 0, 'usr_img\\1.jpg', 'M', 'admin@mail.com', '\r\nBio', '8340000000', 1),
(2, 'Erick', 'Elizondo', 'RodrÃ­guez', '1997-08-06', 'erickelizondo', 'erickelizondo', 0, 'usr_img\\0.png', 'M', '1530061@upv.edu.mx', 'Estudiante de la Universidad Politecnica de Victoria.', '83412312312', 1),
(3, 'empleado', 'empleado', 'empleado', '2017-11-13', 'empleado', 'empleado', 1, 'usr_img\\3.jpg', 'M', '', '									', '', 1),
(4, 'Juan', 'Ramirez', 'Perez', '2017-11-19', 'juanramirez', 'juanramirez', 0, 'usr_img\\4.png', 'M', 'juanramirez@mail.net', 'Hola. Soy&nbsp;<span style=\"background-color: rgb(255, 255, 0);\"> JUAN RAMIREZ</span>', '143241564', 1),
(5, 'Borrar', 'Borrar', 'Borrar', '2017-11-20', '', '', 0, 'usr_img\\0.png', 'M', 'borrar@a.com', '									', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` double NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`id`, `fecha`, `total`, `id_usuario`) VALUES
(1, '2017-11-12', 1797.6000000000001, 1),
(2, '2017-11-12', 4021.5999999999995, 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id_venta` int(11) NOT NULL,
  `codigo_producto` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venta_producto`
--

INSERT INTO `venta_producto` (`id_venta`, `codigo_producto`, `cantidad`) VALUES
(1, '1051974443', 1),
(1, '1061949918', 1),
(1, '1062654415', 1),
(2, '1051974443', 1),
(2, '1060874515', 2),
(2, '1061949918', 1),
(2, '1062654415', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartado`
--
ALTER TABLE `apartado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indexes for table `apartado_producto`
--
ALTER TABLE `apartado_producto`
  ADD PRIMARY KEY (`codigo_producto`,`id_apartado`),
  ADD KEY `id_apartado` (`id_apartado`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motd`
--
ALTER TABLE `motd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `talla` (`id_talla`);

--
-- Indexes for table `talla`
--
ALTER TABLE `talla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indexes for table `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`id_venta`,`codigo_producto`),
  ADD KEY `codigo_producto` (`codigo_producto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartado`
--
ALTER TABLE `apartado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `motd`
--
ALTER TABLE `motd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `talla`
--
ALTER TABLE `talla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartado`
--
ALTER TABLE `apartado`
  ADD CONSTRAINT `apartado_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `apartado_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `apartado_producto`
--
ALTER TABLE `apartado_producto`
  ADD CONSTRAINT `apartado_producto_ibfk_1` FOREIGN KEY (`codigo_producto`) REFERENCES `producto` (`codigo`),
  ADD CONSTRAINT `apartado_producto_ibfk_2` FOREIGN KEY (`id_apartado`) REFERENCES `apartado` (`id`);

--
-- Constraints for table `motd`
--
ALTER TABLE `motd`
  ADD CONSTRAINT `motd_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_producto` (`id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_talla`) REFERENCES `talla` (`id`);

--
-- Constraints for table `talla`
--
ALTER TABLE `talla`
  ADD CONSTRAINT `talla_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_producto` (`id`);

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Constraints for table `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `venta_producto_ibfk_1` FOREIGN KEY (`codigo_producto`) REFERENCES `producto` (`codigo`),
  ADD CONSTRAINT `venta_producto_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
