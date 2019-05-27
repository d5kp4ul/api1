-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2019 a las 09:01:45
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `api_rest_crud_vdos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombreCliente` varchar(45) NOT NULL,
  `telefonoCliente` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombreCliente`, `telefonoCliente`) VALUES
(1, 'Carlos Humberto Ochoa', '45678223'),
(2, 'Karla Xiomara Santizo López', '465753236'),
(3, 'Diego Antonio Salgado', '45678223');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_facturas`
--

CREATE TABLE `detalles_facturas` (
  `idDetalles_Factura` int(11) NOT NULL,
  `Menus_idMenu` int(11) NOT NULL,
  `Facturas_idFactura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalles_facturas`
--

INSERT INTO `detalles_facturas` (`idDetalles_Factura`, `Menus_idMenu`, `Facturas_idFactura`) VALUES
(1, 5, 1),
(2, 5, 2),
(3, 3, 3),
(4, 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `nombreEmpleado` varchar(45) NOT NULL,
  `apellidosEmpleado` varchar(45) NOT NULL,
  `direccionEmpleado` varchar(45) NOT NULL,
  `cargoEmpleado` varchar(45) NOT NULL,
  `telefonoEmpleado` char(10) NOT NULL,
  `e_mailEmpleado` varchar(45) NOT NULL,
  `passwordEmpleado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `nombreEmpleado`, `apellidosEmpleado`, `direccionEmpleado`, `cargoEmpleado`, `telefonoEmpleado`, `e_mailEmpleado`, `passwordEmpleado`) VALUES
(1, 'Carlos Dario', 'Gomez Roblero', 'San Marcos', 'Administrador', '346241324', 'gomez21@gmail.com', 'gomez2019'),
(2, 'Diana Damaris', 'Cifuentes Sanchez', 'Comitancillo', 'Administradora', '465753236', 'ciguentes21@gmail.com', 'cifuentes2019'),
(3, 'Adonias Antonio', 'López Morales', 'Santa Catarina', 'Bodeguero', '465753236', 'lopez22@gmail.com', 'lopez2019'),
(4, 'Dina Melissa', 'Marroquín Torres', 'Santa Catarina', 'Mesera', '9823241324', 'marroquin25@gmail.com', 'marroquin2019'),
(5, 'Darwin David', 'Ovalle Alvarado', 'Comitancillo', 'Repartidor', '36789923', 'ovalle21@gmail.com', 'ovalle2019'),
(6, 'Dennis Fernando', 'Alvarado Salvador', 'San Lorenzo', 'Repartidor', '98675320', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimientos`
--

CREATE TABLE `establecimientos` (
  `idEstablecimiento` int(11) NOT NULL,
  `nombreEstablecimiento` varchar(45) NOT NULL,
  `telefonoEstablecimiento` char(10) NOT NULL,
  `direccionEstablecimiento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `establecimientos`
--

INSERT INTO `establecimientos` (`idEstablecimiento`, `nombreEstablecimiento`, `telefonoEstablecimiento`, `direccionEstablecimiento`) VALUES
(1, 'Casa Burguer', '1234683124', 'Colonia Vianorte, San Marcos'),
(2, 'Casa Burguer Full', '122541124', 'Parque San Marcos, San Marcos'),
(3, 'Amburguesa Real', '465753236', 'Zona 2, Av. 5, San Pedro'),
(4, 'Casa Burguer Dorado', '6234423124', 'Calle 3, Zona 3, San Pedro'),
(5, 'Burguer King', '234568234', 'Av. 2, zona-4, San Marcos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idFactura` int(11) NOT NULL,
  `fechaFactura` date NOT NULL,
  `Clientes_idCliente` int(11) NOT NULL,
  `Empleados_idEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idFactura`, `fechaFactura`, `Clientes_idCliente`, `Empleados_idEmpleado`) VALUES
(1, '2019-05-08', 1, 1),
(2, '2019-04-29', 2, 1),
(3, '2019-05-21', 3, 1),
(4, '2019-05-21', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `idMenu` int(11) NOT NULL,
  `nombreMenu` varchar(45) NOT NULL,
  `descripcionMenu` varchar(45) NOT NULL,
  `precioMenu` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`idMenu`, `nombreMenu`, `descripcionMenu`, `precioMenu`) VALUES
(1, 'Amburgeusa Simple', 'Pan, jamón, salchicha', 23.5),
(2, 'Amgurguesa Simple', 'Pan, Ensalada China', 33.5),
(3, 'Amburgeusa Medium', 'Pan, jamón, salchicha, huevos, refresco', 40.5),
(4, 'Amburgeusa Grande', 'Pan, jamón, salchicha, carne, refresco', 50),
(5, 'Amburgeusa Extra Grande', 'Pan, jamón, salchicha, carne, refresco, extra', 65.75),
(6, 'Ensalada Japoneas', 'Ensalada de frutas y verduras medio cocidas', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `idMesa` int(11) NOT NULL,
  `nombreMesa` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`idMesa`, `nombreMesa`) VALUES
(1, 'Mesa Uno'),
(2, 'Mesa Dos'),
(3, 'Mesa Tres'),
(4, 'Mesa Cuatro'),
(5, 'Mesa Cinco'),
(6, 'Mesa Seis'),
(7, 'Mesa Siete'),
(8, 'Mesa Ocho'),
(9, 'Mesa Nueve'),
(10, 'Mesa Diez'),
(11, 'Mesa Once');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_a_domicilio`
--

CREATE TABLE `pedidos_a_domicilio` (
  `idPedido_a_Domicilio` int(11) NOT NULL,
  `Clientes_nombreCliente` varchar(45) NOT NULL,
  `telefonoCliente` varchar(45) NOT NULL,
  `fechaPedido` date NOT NULL,
  `horarioSalida` time NOT NULL,
  `ubicacionCliente` varchar(45) NOT NULL,
  `coordenadasCliente` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidos_a_domicilio`
--

INSERT INTO `pedidos_a_domicilio` (`idPedido_a_Domicilio`, `Clientes_nombreCliente`, `telefonoCliente`, `fechaPedido`, `horarioSalida`, `ubicacionCliente`, `coordenadasCliente`) VALUES
(1, 'Carlos Humberto Ochoa', '45678223', '2019-05-20', '20:15:00', 'Calle Real, San Pedro', '45-56'),
(2, 'Sergio Damián Pérez', '162354254', '2019-05-22', '13:25:00', 'Calle Real, San Pedro', '31-17'),
(3, 'Carlos Humberto Ochoa', '', '2019-05-21', '20:15:00', 'Casa-25, calle real, zona 1, San Pedro', '24-15'),
(5, 'Diego Antonio Salgado', '45678223', '2019-05-21', '12:15:00', 'Casa-12, calle real, zona 3, San Pedro', '45-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_a_domicilio_has_menus`
--

CREATE TABLE `pedidos_a_domicilio_has_menus` (
  `Pedidos_a_Domicilio_idPedido_a_Domicilio` int(11) NOT NULL,
  `Menus_idMenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `idReservacion` int(11) NOT NULL,
  `Clientes_nombreCliente` varchar(45) NOT NULL,
  `fechaReservacion` date NOT NULL,
  `horaReservacion` time NOT NULL,
  `Mesas_idMesa` int(11) NOT NULL,
  `Establecimientos_idEstablecimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservaciones`
--

INSERT INTO `reservaciones` (`idReservacion`, `Clientes_nombreCliente`, `fechaReservacion`, `horaReservacion`, `Mesas_idMesa`, `Establecimientos_idEstablecimiento`) VALUES
(1, 'Diego Antonio Salgado', '2019-05-30', '14:30:00', 2, 1),
(2, 'Karla Xiomara Santizo López', '2019-05-22', '14:00:00', 8, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`,`nombreCliente`);

--
-- Indices de la tabla `detalles_facturas`
--
ALTER TABLE `detalles_facturas`
  ADD PRIMARY KEY (`idDetalles_Factura`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `establecimientos`
--
ALTER TABLE `establecimientos`
  ADD PRIMARY KEY (`idEstablecimiento`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idFactura`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`idMenu`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`idMesa`);

--
-- Indices de la tabla `pedidos_a_domicilio`
--
ALTER TABLE `pedidos_a_domicilio`
  ADD PRIMARY KEY (`idPedido_a_Domicilio`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`idReservacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalles_facturas`
--
ALTER TABLE `detalles_facturas`
  MODIFY `idDetalles_Factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `establecimientos`
--
ALTER TABLE `establecimientos`
  MODIFY `idEstablecimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `idMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `idMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pedidos_a_domicilio`
--
ALTER TABLE `pedidos_a_domicilio`
  MODIFY `idPedido_a_Domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `idReservacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
