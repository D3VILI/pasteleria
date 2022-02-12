-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2020 a las 09:35:24
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pasteleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(20) NOT NULL,
  `telefono1` int(9) NOT NULL,
  `telefono2` int(9) DEFAULT NULL,
  `nick` varchar(20) NOT NULL,
  `contraseña` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `telefono1`, `telefono2`, `nick`, `contraseña`) VALUES
(0, 'admin', 'admin', 656789098, NULL, 'admin', 'admin'),
(1, 'Angelit', 'Garcia Lopez', 123456789, 123456789, 'Cyralt', '1234'),
(2, 'Perito', 'Perez Galdos', 123435678, 123435678, 'Jhin', 'madrelocura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargos`
--

CREATE TABLE `encargos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `producto` bigint(20) NOT NULL,
  `extra` varchar(30) NOT NULL,
  `cliente` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encargos`
--

INSERT INTO `encargos` (`id`, `fecha`, `hora`, `producto`, `extra`, `cliente`) VALUES
(1, '2019-11-11', '15:00:00', 1, '', 1),
(2, '2019-11-21', '10:00:00', 1, '', 2),
(3, '2019-10-25', '23:00:00', 1, '', 1),
(4, '2019-11-07', '04:02:00', 1, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titular` varchar(70) NOT NULL,
  `contenido` varchar(1000) NOT NULL,
  `imagen` varchar(70) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titular`, `contenido`, `imagen`, `fecha`) VALUES
(1, 'Nueva Creación De Tarta', 'La tarta tiene chocolate, nata, chocolate blanco y una pizca de chocolate negro es como la tarta de tres chocolates con la variante de la nata que le da un saber dulce suave.', '../assets/images/TresChocolates.jpg', '2019-11-01'),
(2, 'Tarta De Chocolate Blanco', 'Está tarta tiene chocolate blanco pero también se basa en tener chocolate de ahí esa frescura entre sabores.', '../assets/images/ChocolateBlanco.jpg', '2019-11-02'),
(3, 'Nuevo Surtido De pasteles', 'Pastelitos tradicionales de cualquier tipo: café, todo tipo de chocolates y cremas.', '../assets/images/Surtido.jpg', '2019-11-29'),
(4, 'Muffin De Pepitas', 'Muffin con chocolate y helado de chocolate con pepitas de sabores', '../assets/images/MuffinPepitas.jpg', '2019-11-05'),
(6, 'Bandeja De Crema', 'Bollitos rellenos de crema y chocolate blanco por encima', '../assets/images/6BocaditosCrema.jpg', '2019-11-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripción` varchar(1000) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `imagen` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripción`, `precio`, `imagen`) VALUES
(1, 'Tarta de NataChocolateada', 'La tarta tiene chocolate, nata, chocolate blanco y una pizca de chocolate negro es como la tarta de tres chocolates con la variante de la nata que le da un saber dulce suave.', '12.12', '../assets/images/TresChocolates.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos`
--

CREATE TABLE `trabajos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `descripción` varchar(1000) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `cliente` bigint(20) NOT NULL,
  `imagen` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajos`
--

INSERT INTO `trabajos` (`id`, `titulo`, `descripción`, `precio`, `cliente`, `imagen`) VALUES
(1, 'Tarta de Chocolate', 'Tarta de chocolate realizada por un experto en la cocina', '12.00', 1, '../assets/images/Chocolate.jpg'),
(2, 'Muffin Amoroso', 'Muffin con crema de fresa.', '5.00', 2, '../assets/images/muffinAmor.jpg'),
(3, 'Muffin Chocolate', 'Muffin relleno con pepitas de chocolate y masa de chocolate  ', '7.00', 1, '../assets/images/Muffin chocolate.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `encargos`
--
ALTER TABLE `encargos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `encargos`
--
ALTER TABLE `encargos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
