-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2020 a las 12:50:10
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aeronaves`
--

CREATE TABLE `aeronaves` (
  `aero_id` int(11) NOT NULL,
  `aero_serie` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'serie aeronave, unique	',
  `aero_casa` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `aeronaves`
--

INSERT INTO `aeronaves` (`aero_id`, `aero_serie`, `aero_casa`, `id_producto`) VALUES
(1, '163DFC4001HB2K', 1, 15),
(2, '163DFAQ001RZS5', 1, 15),
(3, '163DFCP001ZJQ9', 1, 15),
(4, '163DG19001KEPZ', 1, 15),
(5, '163DG190017T86', 1, 15),
(6, '163DFC40017NSB', 1, 15),
(7, '163DFAQ001E37M', 1, 15),
(8, '163DG13001426B', 1, 15),
(9, '163CGAHROA3QJK', 1, 15),
(10, '163CGAGROA3LK8', 1, 15),
(11, 'W13DCB12020447', 1, 40),
(12, 'W21ADH22020384', 1, 40),
(13, '0A0LDAA00300KC', 1, 52),
(14, '11UCF750A50107', 1, 28),
(15, '0AXCF270A30011', 1, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `aula_id` int(11) NOT NULL COMMENT 'auto incrementing aula_id of each aula, unique index AUTO_INCREMENT	',
  `aula_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `aula_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'aula email, unique	',
  `aula_telefono` int(11) NOT NULL COMMENT 'aula telefono, unique	',
  `aula_poblacion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `aula_maps` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `inactivo` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`aula_id`, `aula_name`, `aula_email`, `aula_telefono`, `aula_poblacion`, `aula_maps`, `inactivo`, `date_added`) VALUES
(1, 'Ayuntamiento Bellús', 'frnsaiti@hotmail.com', 647622645, 'Xátiva', 'https://www.google.com/maps/place/38%C2%B056\'42.9%22N+0%C2%B029\'18.3%22W/@38.9452547,-0.4906021,17z/', 0, '2020-02-28 12:31:17'),
(2, 'Formación Colón ', '', 983013714, 'Valladolid', 'https://www.google.com/maps/place/Col%C3%B3n+Formaci%C3%B3n/@41.6282422,-4.7297041,17z/data=!3m1!4b1', 0, '2020-02-28 12:31:17'),
(3, 'Aeródromo de Matilla', 'matillagestion@gmail.com', 618621750, 'Matilla de los Caños', 'https://goo.gl/maps/FS8tNnypDCx', 0, '2020-02-28 12:32:42'),
(4, 'Ayuntamiento La Pola de Gordón', 'j.fernandezsahelices@yahoo.es', 608001310, 'La Pola de Gordón', 'https://www.google.es/maps/place/Ayuntamiento+de+La+Pola+de+Gord%C3%B3n/@42.854167,-5.6711453,146m/d', 0, '2020-02-28 12:33:07'),
(5, 'AulaMarcaBlanca', 'info@aulamarcablanca.com', 656303872, 'Sevilla', 'https://www.google.es/maps/place/Alquiler+Aulas+Inform%C3%A1tica+Sevilla+Aulamarcablanca.com/@37.427', 0, '2020-02-28 12:33:37'),
(6, 'RMD Seguridad', 'frsprevencion@emergencias.info', 955751973, 'Sevilla', 'https://www.google.es/maps/place/Grupo+RMD/@37.3579195,-6.1440397,17z/data=!3m1!4b1!4m5!3m4!1s0xd121', 0, '2020-02-28 12:33:56'),
(7, 'Pazo Vilamarin', 'gabrielmouttet1963@gmail.com', 686888503, 'Vilamarín', ' https://goo.gl/maps/1zccaMkYxNt', 0, '2020-02-28 12:34:32'),
(8, 'AAZ', '', 976282332, 'Zaragoza', 'https://www.google.com/maps/place/AAZ.+Alquiler+Audiovisual+Zaragoza/@41.650301,-0.8946217,17z/data=', 0, '2020-02-28 12:34:32'),
(9, 'Fasnia', 'lali@fasnia.com', 629693371, 'Fasnia', 'https://www.google.com/maps/place/28%C2%B014\'10.4%22N+16%C2%B026\'28.7%22W/@28.2362118,-16.4434977,17', 0, '2020-02-28 12:35:53'),
(10, 'Academia Nota', 'administracion@academianota.com', 968256933, 'Murcia', 'https://www.google.com/maps/place/Academia+Nota+SL/@37.9769203,-1.1268999,15z/data=!4m2!3m1!1s0x0:0x', 0, '2020-02-28 12:37:52'),
(11, 'Hotel Manolo', 'direccion@hotelmanolo.com', 968330060, 'Cartagena', 'https://www.google.com/maps/place/Hotel+Manolo/@37.6217535,-1.001608,17z/data=!3m1!4b1!4m5!3m4!1s0xd', 0, '2020-02-28 12:38:16'),
(12, 'Muévete Formación', 'ifita@mueveteformacion.com', 689267756, 'Palma de Mallorca', 'https://www.google.es/maps/place/MUEVETE+FORMACION/@39.573014,2.6596022,17z/data=!3m1!4b1!4m5!3m4!1s', 0, '2020-02-28 12:39:11'),
(13, 'Centro Formación Macu', 'info@academiamacu.com', 952317694, 'Málaga', 'https://www.google.com/maps/place/Centro+de+Formaci%C3%B3n+Macu,+SL/@36.7083344,-4.4701286,17z/data=', 0, '2020-02-28 12:39:38'),
(14, 'Hotel Tamisa', 'eventos@hoteltamisagolf.com', 952585988, 'Málaga', 'https://www.google.es/maps/place/Tamisa+Hotel/@36.5468152,-4.6691582,17z/data=!3m1!4b1!4m5!3m4!1s0xd', 0, '2020-02-28 12:39:57'),
(15, 'QUANTUM CENTER', 'INFO@QUANTUMCENTER.ES', 952021670, 'Málaga', 'https://goo.gl/maps/AxTuwyDjAe4kem957', 0, '2020-02-28 12:41:02'),
(16, 'CENTRO DE FORMACIÓN ARES', 'info@centrodeformacionaries.es', 0, '', '', 0, '2020-02-28 12:41:02'),
(17, 'Grupo Inanto', 'grupoinanto@gmail.com', 691936559, 'Madrid', 'https://www.google.com/maps/place/Calle+de+los+Cruces,+1,+28270+Colmenarejo,+Madrid/@40.5616492,-4.0', 0, '2020-02-28 12:46:34'),
(18, 'Hotel Galaico', 'comercial@hotelgalaico.com', 918510304, 'Collado Villalba', 'https://goo.gl/maps/TAeitzff4sv', 0, '2020-02-28 12:46:54'),
(19, 'Centro de Negocios Inanto', 'plopezgu@gmail.com', 603728034, 'Colmenarejo. Calle Los Cruces Nº1 CP28270', 'https://bit.ly/2Eq3Ijk', 0, '2020-02-28 12:47:16'),
(20, 'Ayt. Cotobade', 'brunocotobade@gmail.com', 699644405, 'Cotobade', 'https://goo.gl/maps/G9wpZYRzYhS2', 0, '2020-02-28 12:47:56'),
(21, 'Centro cultural Caja Burgos', 'interclubbriviesca@cajadeburgos.com', 947590200, 'Briviesca', 'https://www.google.com/maps/place/Fundaci%C3%B3n+Caja+de+Burgos+-+Cultural+Briviesca/@42.5511035,-3.', 0, '2020-02-28 12:48:26'),
(22, 'Academia Cyma ', 'apoyocyma@gmail.com', 637682123, 'Burgos', 'https://www.google.com/maps/place/Academia+Cyma/@42.3492424,-3.6921032,17z/data=!3m1!4b1!4m5!3m4!1s0', 0, '2020-02-28 12:48:46'),
(23, 'Spaceson', 'casco.v@hotmail.com', 688684348, '', 'https://www.google.com/maps/place/Av.+del+Ferrocarril,+10,+48012+Bilbao,+Vizcaya/@43.2572788,-2.9483', 0, '2020-02-28 12:48:46'),
(24, 'IRTA -Torre Marimón', 'agusti.cot@irta.cat', 667051734, 'Caldes de Montbui', 'https://www.google.es/maps/place/IRTA+Torre+Marimon/@41.61304,2.1698692,15z/data=!4m2!3m1!1s0x0:0x50', 0, '2020-02-28 12:49:58'),
(25, 'Centro Univers', '', 0, '', 'https://www.google.com/maps/place/Centro+Univers/@41.3965104,2.1520398,17z/data=!3m1!4b1!4m5!3m4!1s0', 0, '2020-02-28 12:49:58'),
(26, 'Nest Coworking & Co', '', 0, '', 'https://www.google.com/maps/place/Nest+Coworking+%26+Co./@43.3577454,-8.4240808,17z/data=!3m1!4b1!4m', 0, '2020-02-28 12:49:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `baterias`
--

CREATE TABLE `baterias` (
  `bat_id` int(11) NOT NULL,
  `bat_serie` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'serie bateria, unique	',
  `bat_casa` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camposvuelo`
--

CREATE TABLE `camposvuelo` (
  `campo_id` int(11) NOT NULL COMMENT 'auto incrementing campos_id of each campos, unique index AUTO_INCREMENT	',
  `campo_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `campo_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'campos email, unique	',
  `campo_telefono` int(11) NOT NULL COMMENT 'campos telefono, unique	',
  `campo_poblacion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `campo_maps` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `inactivo` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `camposvuelo`
--

INSERT INTO `camposvuelo` (`campo_id`, `campo_name`, `campo_email`, `campo_telefono`, `campo_poblacion`, `campo_maps`, `inactivo`, `date_added`) VALUES
(1, 'Club Aeromodelismo Xátiva', 'frnsaiti@hotmail.com', 647622645, 'Xátiva', 'https://goo.gl/maps/ZSsobHbHZak', 0, '2020-02-28 13:21:16'),
(2, 'Aeródromo de Matilla', 'matillagestion@gmail.com', 618621750, 'Matilla de los Caños', 'https://goo.gl/maps/FS8tNnypDCx', 0, '2020-02-28 13:22:00'),
(3, 'CD Racing de Mayorga', 'alcalde@aytomayorga.org', 983751003, 'Mayorga', 'https://www.google.com/maps/place/C.D+Racing+de+Mayorga/@42.1673021,-5.2704405,17z/data=!3m1!4b1!4m5', 0, '2020-02-28 13:22:28'),
(4, 'Ayuntamiento La Pola de Gordón', 'j.fernandezsahelices@yahoo.es', 608001310, 'La Pola de Gordón', 'https://www.google.es/maps/place/Parque+%C3%81ngel+Gonz%C3%A1lez+Ju%C3%A1rez/@42.8546179,-5.6700582,', 0, '2020-02-28 13:23:03'),
(5, 'Aeroguillena', 'aeroguillena@hotmail.com', 607894257, 'Guillena', 'https://goo.gl/maps/hweF1xY54UH2', 0, '2020-02-28 13:23:38'),
(6, 'Pazo Vilamarin', 'gabrielmouttet1963@gmail.com', 686888503, 'Vilamarín', ' https://goo.gl/maps/1zccaMkYxNt', 0, '2020-02-28 13:24:08'),
(7, 'Aeródromo Gurrea de Gállego', 'pendular1@gmail.com', 675099309, 'Gurrea de Gállego', 'https://www.google.es/maps/place/Aer%C3%B3dromo+de+Gurrea+de+G%C3%A1llego/@42.0267886,-0.7878661,133', 0, '2020-02-28 13:24:31'),
(8, 'Fasnia', 'lali@fasnia.com', 629693371, 'Fasnia', 'https://www.google.com/maps/place/28%C2%B014\'16.2%22N+16%C2%B026\'04.0%22W/@28.2378426,-16.4366388,17', 0, '2020-02-28 13:24:56'),
(9, 'Aerodromo Caravaca de la Cruz', 'j.fernandez@rocabona.com', 657425276, 'Caravaca de la Cruz', 'https://www.google.com/maps/place/Aer%C3%B3dromo+de+Caravaca+de+la+Cruz/@38.0463842,-1.921977,15z/da', 0, '2020-02-28 13:25:19'),
(10, 'Finca Llucmayor', 'esantiago@global-charters.com', 617430622, 'Campos', 'https://www.google.com.br/maps/place/Unnamed+Road,+07609+Lluchmayor,+Islas+Baleares/@39.4570131,2.94', 0, '2020-02-28 13:25:57'),
(11, 'Rancho La Paz', 'rancholapaz@hotmail.com', 615407525, 'Fuengirola', 'https://goo.gl/maps/CWYYMnk2zR72', 0, '2020-02-28 13:26:22'),
(12, 'Aerodromo Villanueva del Pardillo', 'info@globosydirigibles.es', 608024076, 'Villanueva del Pardillo', 'https://goo.gl/maps/zjuX1kMmoAw', 0, '2020-02-28 13:26:46'),
(13, 'Campo fútbol Cotobade', 'brunocotobade@gmail.com', 699644405, 'Cotobade', 'https://goo.gl/maps/KtLWibEoQ3t', 0, '2020-02-28 13:27:26'),
(14, 'Aeródromo de La Vid de Bureba', 'aerolavidgn@gmail.com', 639171030, 'Burgos', 'https://www.google.com/maps/place/Aer%C3%B3dromo+de+La+Vid+de+Bureba+(AEROLAVID)/@42.6308539,-3.3131', 0, '2020-02-28 13:27:49'),
(15, 'Campo de Futbol Busto de Bureba', 'aytobusto@gmail.com', 671582111, 'Busto de Bureba(Burgos)', 'https://www.google.com/maps/place/42%C2%B039\'45.7%22N+3%C2%B015\'58.4%22W/@42.6626854,-3.2684004,17z/', 0, '2020-02-28 13:28:10'),
(16, 'RECINTO KOROSTONDO JATETXEA DE OTXANDIO', '', 606368936, '', 'https://www.google.com/maps/place/Restaurante+Korostondo+Jatetxea/@43.0509338,-2.6626718,17z/data=!3', 0, '2020-02-28 13:28:10'),
(17, 'IRTA -Torre Marimón', 'agusti.cot@irta.cat', 667051734, 'Caldes de Montbui', 'https://www.google.es/maps/place/IRTA+Torre+Marimon/@41.61304,2.1698692,15z/data=!4m2!3m1!1s0x0:0x50', 0, '2020-02-28 13:29:18'),
(18, 'Club de Vuelo Cambre', '', 0, '', 'https://www.google.com/maps/place/Club+de+Vuelo+Cambre+C.V.C/@43.1037909,-8.7638977,17z/data=!3m1!4b', 0, '2020-02-28 13:29:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargadores`
--

CREATE TABLE `cargadores` (
  `car_id` int(11) NOT NULL,
  `car_serie` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'serie cargador, unique	',
  `car_casa` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `inactivo` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `inactivo`, `date_added`) VALUES
(1, 'MAVIC PRO', 'Todos los elementos asociados al Mavic Pro.', 0, '2020-02-27 10:47:29'),
(2, 'MAVIC 2 PRO', 'Todos los elementos asociados al Mavic 2 Pro.', 0, '2020-02-27 10:47:38'),
(3, 'PHANTOM IV', 'Todos los elementos asociados al Phantom IV.', 0, '2020-02-27 10:48:06'),
(4, 'INSPIRE 1', 'Todos los elementos asociados al Inspire 1.', 0, '2020-02-27 10:48:19'),
(5, 'INSPIRE 2', 'Todos los elementos asociados al Inspire 2.', 0, '2020-02-27 10:48:25'),
(6, 'SIMULADOR', 'Todos los elementos asociados al simulador.', 0, '2020-02-27 10:48:44'),
(7, 'OTRO MATERIAL', 'Otros elementos.', 0, '2020-02-27 10:49:07'),
(8, 'MEMORIA', 'Todos los elementos para almacenar contenido.', 0, '2020-02-27 13:02:28'),
(9, 'RADIOFONÍA', 'Todos los elementos asociados a la radiofonía.', 0, '2020-03-02 15:14:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emisoras`
--

CREATE TABLE `emisoras` (
  `emi_id` int(11) NOT NULL,
  `emi_serie` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'serie emisora, unique	',
  `emi_casa` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `helices`
--

CREATE TABLE `helices` (
  `heli_id` int(11) NOT NULL,
  `heli_serie` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'serie helices, unique	',
  `heli_casa` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` varchar(255) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_aulas`
--

CREATE TABLE `historial_aulas` (
  `id_historial` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_campos`
--

CREATE TABLE `historial_campos` (
  `id_historial` int(11) NOT NULL,
  `id_campo` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_cat`
--

CREATE TABLE `historial_cat` (
  `id_historial` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_inst`
--

CREATE TABLE `historial_inst` (
  `id_historial` int(11) NOT NULL,
  `id_instr` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_invcon`
--

CREATE TABLE `historial_invcon` (
  `id_historial_invcon` int(11) NOT NULL,
  `id_invcon` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_users`
--

CREATE TABLE `historial_users` (
  `id_historial` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hubs`
--

CREATE TABLE `hubs` (
  `hub_id` int(11) NOT NULL,
  `hub_serie` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'serie hub, unique	',
  `hub_casa` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructores`
--

CREATE TABLE `instructores` (
  `inst_id` int(11) NOT NULL COMMENT 'auto incrementing inst_id of each instructor, unique index	AUTO_INCREMENT',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `inst_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'instructores email, unique	',
  `inst_telefono` int(11) NOT NULL COMMENT 'instructores telefono, unique	',
  `inst_direccion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `inactivo` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `inst_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'instructores password in salted and hashed format	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `instructores`
--

INSERT INTO `instructores` (`inst_id`, `firstname`, `lastname`, `inst_email`, `inst_telefono`, `inst_direccion`, `inactivo`, `date_added`, `inst_password_hash`) VALUES
(1, 'José María', 'Hortelano Marín', 'josemaria@hortelanofotografo.com', 678436648, 'Alicante', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(2, 'Carlos Antonio', 'Puig Mengual', 'carpuime@doctor.upv.es', 645499054, 'Valencia', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(3, 'Guillermo', 'Alvarez Gonzalez', 'galvarezgonza@gmail.com', 605979354, 'Valladolid', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(4, 'Miguel', 'Fernández Villacorta', '77mikemike@gmail.com', 622892025, 'Valladolid', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(5, 'Jorge', 'Fernández Villacorta', 'jorgefdzvill@hotmail.com', 647659665, 'Valladolid', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(6, 'José Daniel', 'Ramos García', 'josedanielramos1997@gmail.com', 693440539, 'Cádiz33', 0, '2020-02-28 10:47:28', '$2y$10$pP4syj8QCQQurpSQy6W1ruIIcA8mbyzKPGNZm9E0cftTRxXMx29Rm'),
(7, 'Alejandro', 'Tinoco Piñero', 'aletinoco_msm@hotmail.com', 656905011, 'Cádiz', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(8, 'Antonio Jose', 'Villeras Rodríguez', 'ajvdrones@gmail.com', 660328387, 'Sevilla', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(9, 'Héctor', 'Cortiñas Saco', 'hectorcortinassaco@gmail.com', 628411858, 'Ourense', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(10, 'Josue', 'Haro Lorenzo', 'jhlorenzo91@gmail.com', 662521333, 'Pontevedra', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(11, 'Misael', 'Agüero López', 'aircraft.professionals.navarra@gmail.com', 601010455, 'Navarra', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(12, 'Jonathan', 'Garcia Payo', 'jonatangarcia.bil@gmail.com', 636242678, 'Burgos', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(13, 'Aritz', 'Garces Aranaz', 'garcesaritz@hotmail.com', 660853600, 'Navarra', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(14, 'Martin Andres', ' Pérez - Trujillo Rodríguez', 'martinydelia@hotmail.com', 670910969, 'Tenerife', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(15, 'Mario', 'Molino Martínez', 'mariete_86@hotmail.com', 623184186, 'Murcia', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(16, 'Angel ', 'Pliego', '', 0, '', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(17, 'Ana María ', 'Amedo', '', 0, '', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(18, 'Pedro', 'López Gutierrez', 'plopezgu@gmail.com', 603728034, 'Madrid', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(19, 'Sergio', 'Rio Martin', 'riomartinsergio@gmail.com', 649804485, 'Madrid', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(20, 'Javier', 'Palomino Fontecha', 'jpalominofontecha@gmail.com', 680445491, 'Madrid', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(21, 'Cecilia', 'Gutierrez Ferrer', 'cecicgf@gmail.com', 662042737, 'Madrid', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(22, 'Juan', 'Gutierrez Millán', '', 645385410, 'Madrid', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(23, 'Jordi', 'Vila Fortuny', 'jordivilafortuny@gmail.com', 657920634, 'Barcelona', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(24, 'Daniel ', 'Barrio', 'dbg8793@gmail.com', 628735315, 'Barcelona', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(25, 'Guillermo ', 'Pérez  ', 'guillermo@aerocamaras.es', 667647146, 'Pontevedra', 0, '2020-02-28 10:47:28', '$2y$10$c1P1Q5FT/C8D/PghZuOgpO01yUeuXHjnOgMlx/LP/huEGjemYUgYS'),
(26, 'Abel Saul', 'Baños Fernández', 'a.s.leon@hotmail.es', 692379684, 'León', 0, '2020-02-28 10:47:28', ''),
(27, 'Miguel', 'Hernando', 'm.hernando78@gmail.com', 652862502, 'Zaragoza', 0, '2020-02-28 10:47:28', ''),
(28, 'Joan', 'Cairo', 'joan@cairo.cat', 618228342, 'Barcelona', 0, '2020-02-28 10:47:28', ''),
(29, 'Sergio', 'Cañellas', 'cronorainbow@gmail.com', 645963048, 'Baleares', 0, '2020-02-28 10:47:28', ''),
(30, 'David', 'Avero López', 'davidavero@gmail.com ', 685500540, 'Tenerife', 0, '2020-02-28 10:47:28', ''),
(31, 'Manuel ', 'Dominguez Caramés', 'm.dominguez.carames@gmail.com', 647884010, 'Ourense', 0, '2020-02-28 10:47:28', ''),
(32, 'José Antonio', 'García Riquel', 'aerocamarasandalucia2@gmail.com', 622228915, 'Sevilla', 0, '2020-02-28 10:47:28', ''),
(33, 'José Antonio', 'Piñeiro Galbán', 'jpinga9@gmail.com', 627591383, 'A Coruña', 0, '2020-02-28 10:47:28', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invcon`
--

CREATE TABLE `invcon` (
  `invcon_id` int(11) NOT NULL,
  `n_convocatoria` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_convocatoria` date NOT NULL,
  `id_instructor` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `id_campo` int(11) NOT NULL,
  `aeronave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banda_aerea` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emisora` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `car_emisora` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `helices` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bateria` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `car_baterias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cable_alimentacion` int(11) NOT NULL,
  `cable_otg` int(11) NOT NULL,
  `cable_usb` int(11) NOT NULL,
  `cable_c` int(11) NOT NULL,
  `cable_light` int(11) NOT NULL,
  `sd_32` int(11) NOT NULL,
  `sd_64` int(11) NOT NULL,
  `sd_128` int(11) NOT NULL,
  `pc_simulador` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emi_simulador` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `botiquin` int(11) NOT NULL,
  `arnes` int(11) NOT NULL,
  `chaleco` int(11) NOT NULL,
  `boligrafo` int(11) NOT NULL,
  `regleta` int(11) NOT NULL,
  `proyector` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `horas_aeronave` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url_pdf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `entregado` int(11) NOT NULL,
  `devuelto` int(11) NOT NULL,
  `fecha_entregado` datetime NOT NULL,
  `fecha_devuelto` datetime NOT NULL,
  `obs_entre` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `obs_devue` varchar(5000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` char(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `url_foto` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_actual` int(11) NOT NULL,
  `stock_fuera` int(11) NOT NULL,
  `inactivo` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_producto`, `nombre_producto`, `date_added`, `url_foto`, `stock`, `stock_actual`, `stock_fuera`, `inactivo`, `id_categoria`) VALUES
(1, 'Aeronave Mavic Pro', '2020-02-27 10:49:54', '2020-02-27-mavicpro.png', 0, 0, 0, 0, 1),
(2, 'Emisora Mavic Pro', '2020-02-27 10:50:09', '2020-02-27-emisoramavicpro.jpg', 0, 0, 0, 0, 1),
(3, 'Batería Mavic Pro', '2020-02-27 10:50:27', '2020-02-27-bateriamavicpro.png', 0, 0, 0, 0, 1),
(4, 'Hélices Mavic Pro', '2020-02-27 10:50:47', '2020-02-27-helicesmavicpro.png', 0, 0, 0, 0, 1),
(5, 'Cargador Emisora Mavic Pro', '2020-02-27 10:50:56', '2020-02-27-cargadoremavicpro.jpg', 0, 0, 0, 0, 1),
(6, 'Cargador Baterías Mavic Pro', '2020-02-27 10:51:03', '2020-02-27-cargadorbmavicpro.jpg', 0, 0, 0, 0, 1),
(7, 'Hub Mavic Pro', '2020-02-27 10:51:12', '2020-02-27-hubmavicpro.jpg', 0, 0, 0, 0, 1),
(8, 'Cable USB Mavic Pro', '2020-02-27 10:51:18', '2020-02-27-usbmavicpro.jpg', 2, 2, 0, 0, 1),
(9, 'Cable OTG Mavic Pro', '2020-02-27 10:51:29', '2020-02-27-otgmavicpro.jpg', 2, 2, 0, 0, 1),
(10, 'Tarjeta MicroSD SanDisk 32 GB', '2020-02-27 13:14:51', '2020-02-27-sandisk32.jpg', 2, 2, 0, 0, 8),
(11, 'Tarjeta MicroSD SanDisk 64 GB', '2020-02-27 13:16:09', '2020-02-27-sandisk64.jpg', 2, 2, 0, 0, 8),
(12, 'Tarjeta MicroSD SanDisk 128 GB', '2020-02-27 13:16:20', '2020-02-27-sandisk128.jpg', 2, 2, 0, 0, 8),
(13, 'Cable Lightning Mavic Pro', '2020-02-27 15:10:18', '2020-02-27-lightningmavicpro.jpg', 2, 2, 0, 0, 1),
(14, 'Cable Type-C Mavic Pro', '2020-02-27 15:12:59', '2020-02-27-typecmavicpro.jpg', 2, 2, 0, 0, 1),
(15, 'Aeronave Mavic 2 Pro', '2020-02-27 15:26:01', '2020-02-27-mavic2pro.png', 0, 0, 0, 0, 2),
(16, 'Emisora Mavic 2 Pro', '2020-02-27 15:34:45', '2020-02-27-emisoramavic2pro.png', 0, 0, 0, 0, 2),
(17, 'Hélices Mavic 2 Pro', '2020-02-27 15:35:45', '2020-02-27-helicesmavic2pro.png', 0, 0, 0, 0, 2),
(18, 'Cargador Emisora Mavic 2 Pro', '2020-02-27 15:36:06', '2020-02-27-cargadoremavic2pro.jpg', 0, 0, 0, 0, 2),
(19, 'Cargador Baterías Mavic 2 Pro', '2020-02-27 15:36:40', '2020-02-27-cargadorbmavic2pro.jpg', 0, 0, 0, 0, 2),
(20, 'Hub Mavic 2 Pro', '2020-02-27 15:36:54', '2020-02-27-hubmavic2pro.jpg', 0, 0, 0, 0, 2),
(21, 'Cable USB Mavic 2 Pro\r\n', '2020-02-27 15:37:21', '2020-02-27-usbmavic2pro.jpg', 5, 5, 0, 0, 2),
(22, 'Cable Type-C Mavic 2 Pro\r\n', '2020-02-27 15:37:39', '2020-02-27-typecmavic2pro.jpg', 4, 4, 0, 0, 2),
(23, 'Cable Lightning Mavic 2 Pro\r\n', '2020-02-27 15:38:03', '2020-02-27-lightningmavic2pro.jpg', 5, 5, 0, 0, 2),
(24, 'Cable OTG Mavic 2 Pro\r\n', '2020-02-27 15:38:18', '2020-02-27-otgmavic2pro.jpg', 6, 6, 0, 0, 2),
(25, 'Batería Mavic 2 Pro', '2020-02-27 15:39:12', '2020-02-27-bateriamavic2pro.png', 0, 0, 0, 0, 2),
(26, 'Cable de Alimentación Mavic Pro', '2020-02-27 15:40:53', '2020-02-27-alimentacionmavicpro.png', 2, 2, 0, 0, 1),
(27, 'Cable de Alimentación Mavic 2 Pro', '2020-02-27 15:40:58', '2020-02-27-alimentacionmavic2pro.png', 8, 8, 0, 0, 2),
(28, 'Aeronave Phantom IV', '2020-02-27 15:44:51', '2020-02-27-phantom4.png', 0, 0, 0, 0, 3),
(29, 'Batería Phantom IV', '2020-02-27 15:45:10', '2020-02-27-bateriaphantom4.png', 0, 0, 0, 0, 3),
(30, 'Emisora Phantom IV', '2020-02-27 15:46:38', '2020-02-27-emisoraphantom4.png', 0, 0, 0, 0, 3),
(31, 'Hélices Phantom IV', '2020-02-27 15:46:54', '2020-02-27-helicesphantom4.jpg', 0, 0, 0, 0, 3),
(32, 'Cargador Emisora Phantom IV', '2020-02-27 15:51:24', '2020-02-27-cargadorephantom4.jpg', 0, 0, 0, 0, 3),
(33, 'Cargador Baterías Phantom IV', '2020-02-27 15:52:28', '2020-02-27-cargadorbphantom4.jpg', 0, 0, 0, 0, 3),
(34, 'Hub Phantom IV', '2020-02-27 15:53:01', '2020-02-27-hubphantom4.jpg', 0, 0, 0, 0, 3),
(35, 'Cable USB Phantom IV', '2020-02-27 15:54:31', '2020-02-27-usbphantom4.jpg', 2, 2, 0, 0, 3),
(36, 'Cable Lightning Phantom IV', '2020-02-27 15:54:43', '2020-02-27-lightningphantom4.jpg', 2, 2, 0, 0, 3),
(37, 'Cable Type-C Phantom IV', '2020-02-27 15:54:57', '2020-02-27-typecphantom4.jpg', 2, 2, 0, 0, 3),
(38, 'Cable OTG Phantom IV', '2020-02-27 15:55:23', '2020-02-27-otgphantom4.jpg', 2, 2, 0, 0, 3),
(39, 'Cable de Alimentación Phantom IV', '2020-02-27 15:56:27', '2020-02-27-alimentacionphantom4.jpg', 2, 2, 0, 0, 3),
(40, 'Aeronave Inspire 1', '2020-02-27 15:58:51', '2020-02-27-inspire1.png', 0, 0, 0, 0, 4),
(41, 'Emisora Inspire 1', '2020-02-27 16:02:21', '2020-02-27-emisorainspire1.png', 0, 0, 0, 0, 4),
(42, 'Batería Inspire 1', '2020-02-27 16:02:36', '2020-02-27-bateriainspire1.png', 0, 0, 0, 0, 4),
(43, 'Hélices Inspire 1', '2020-02-27 16:03:32', '2020-02-27-helicesinspire1.png', 0, 0, 0, 0, 4),
(44, 'Cargador Emisora Inspire 1', '2020-02-27 16:04:08', '2020-02-27-cargadoreinspire1.jpg', 0, 0, 0, 0, 4),
(45, 'Cargador Baterías Inspire 1', '2020-02-27 16:07:36', '2020-02-27-cargadorbinspire1.jpg', 0, 0, 0, 0, 4),
(46, 'Hub Inspire 1', '2020-02-27 16:07:50', '2020-02-27-hubinspire1.jpg', 0, 0, 0, 0, 4),
(47, 'Cable USB Inspire 1', '2020-02-27 16:09:12', '2020-02-27-usbinspire1.jpg', 2, 2, 0, 0, 4),
(48, 'Cable Lightning Inspire 1', '2020-02-27 16:09:23', '2020-02-27-lightninginspire1.jpg', 2, 2, 0, 0, 4),
(49, 'Cable Type-C Inspire 1', '2020-02-27 16:09:34', '2020-02-27-typecinspire1.jpg', 2, 2, 0, 0, 4),
(50, 'Cable OTG Inspire 1', '2020-02-27 16:09:56', '2020-02-27-otginspire1.jpg', 2, 2, 0, 0, 4),
(51, 'Cable de Alimentación Inspire 1', '2020-02-27 16:11:57', '2020-02-27-alimentacioninspire1.png', 2, 2, 0, 0, 4),
(52, 'Aeronave Inspire 2', '2020-02-27 16:12:45', '2020-02-27-inspire2.png', 0, 0, 0, 0, 5),
(53, 'Emisora Inspire 2', '2020-02-27 16:13:22', '2020-02-27-emisorainspire2.jpg', 0, 0, 0, 0, 5),
(54, 'Batería Inspire 2', '2020-02-27 16:13:46', '2020-02-27-bateriainspire2.png', 0, 0, 0, 0, 5),
(55, 'Hélices Inspire 2', '2020-02-27 16:13:57', '2020-02-27-helicesinspire2.png', 0, 0, 0, 0, 5),
(56, 'Cargador Emisora Inspire 2', '2020-02-27 16:14:22', '2020-02-27-cargadoreinspire2.jpg', 0, 0, 0, 0, 5),
(57, 'Cargador Baterías Inspire 2', '2020-02-27 16:20:52', '2020-02-27-cargadorbinspire2.jpg', 0, 0, 0, 0, 5),
(58, 'Hub Inspire 2', '2020-02-27 16:21:43', '2020-02-27-hubinspire2.jpg', 0, 0, 0, 0, 5),
(59, 'Cable USB Inspire 2', '2020-02-27 16:23:14', '2020-02-27-usbinspire2.jpg', 2, 2, 0, 0, 5),
(60, 'Cable Lightning Inspire 2', '2020-02-27 16:23:26', '2020-02-27-lightninginspire2.jpg', 2, 2, 0, 0, 5),
(61, 'Cable Type-C Inspire 2', '2020-02-27 16:23:40', '2020-02-27-typecinspire2.jpg', 2, 2, 0, 0, 5),
(62, 'Cable OTG Inspire 2', '2020-02-27 16:24:03', '2020-02-27-otginspire2.jpg', 2, 2, 0, 0, 5),
(63, 'Cable de Alimentación Inspire 2', '2020-02-27 16:25:14', '2020-02-27-alimentacioninspire2.png', 2, 2, 0, 0, 5),
(64, 'Cable USB', '2020-02-27 16:26:14', '2020-02-27-cableusb.png', 2, 2, 0, 0, 7),
(65, 'Emisora Simulador SM 600', '2020-02-27 16:33:01', '2020-02-27-emisora_simulador.jpg', 0, 0, 0, 0, 6),
(66, 'PC Simulador', '2020-02-27 16:33:12', '2020-02-27-pc.jpg', 0, 0, 0, 0, 6),
(67, 'Arnés', '2020-02-27 16:33:27', '2020-02-27-arnes.jpg', 2, 2, 0, 0, 7),
(68, 'Bolígrafos', '2020-02-27 16:33:48', '2020-02-27-boligrafo.jpg', 1000, 1000, 0, 0, 7),
(69, 'Chalecos', '2020-02-27 16:34:01', '2020-02-27-chaleco.jpg', 1000, 1000, 0, 0, 7),
(70, 'Botiquín', '2020-02-27 16:34:12', '2020-02-27-botiquin.jpg', 12, 12, 0, 0, 7),
(71, 'Emisora Banda Aérea', '2020-03-02 15:15:02', '2020-03-02-emisorabandaaerea.jpg', 0, 0, 0, 0, 9),
(72, 'Proyector', '2020-03-02 15:43:09', '2020-03-02-proyector.jpg', 0, 0, 0, 0, 7),
(73, 'Regleta', '2020-03-02 15:43:16', '2020-03-02-regleta.jpg', 2, 2, 0, 0, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyector`
--

CREATE TABLE `proyector` (
  `proyector_id` int(11) NOT NULL,
  `proyector_serie` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'serie proyector, unique	',
  `proyector_casa` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulador`
--

CREATE TABLE `simulador` (
  `simulador_id` int(11) NOT NULL,
  `simulador_ref` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'referencia simulador, unique	',
  `simulador_casa` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `admin` int(11) NOT NULL,
  `inactivo` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `admin`, `inactivo`, `date_added`) VALUES
(1, 'Adriana', 'Armental', 'admin', '$2y$10$wKVIE.6tiB4aO6WVKuU5EuuHONByqsaZiXmz8fQLwXfMsnySF7ONa', 'admin@admin.es', 1, 0, '2016-12-19 15:06:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aeronaves`
--
ALTER TABLE `aeronaves`
  ADD PRIMARY KEY (`aero_id`),
  ADD KEY `aero_serie` (`aero_serie`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`aula_id`),
  ADD KEY `aula_email` (`aula_email`,`aula_telefono`);

--
-- Indices de la tabla `baterias`
--
ALTER TABLE `baterias`
  ADD PRIMARY KEY (`bat_id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `bat_serie` (`bat_serie`);

--
-- Indices de la tabla `camposvuelo`
--
ALTER TABLE `camposvuelo`
  ADD PRIMARY KEY (`campo_id`),
  ADD KEY `campo_email` (`campo_email`,`campo_telefono`);

--
-- Indices de la tabla `cargadores`
--
ALTER TABLE `cargadores`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `car_serie` (`car_serie`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `emisoras`
--
ALTER TABLE `emisoras`
  ADD PRIMARY KEY (`emi_id`),
  ADD KEY `emi_serie` (`emi_serie`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `helices`
--
ALTER TABLE `helices`
  ADD PRIMARY KEY (`heli_id`),
  ADD KEY `heli_serie` (`heli_serie`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `historial_aulas`
--
ALTER TABLE `historial_aulas`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_aula` (`id_aula`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `historial_campos`
--
ALTER TABLE `historial_campos`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_campo` (`id_campo`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `historial_cat`
--
ALTER TABLE `historial_cat`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_cat` (`id_cat`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `historial_inst`
--
ALTER TABLE `historial_inst`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_instr` (`id_instr`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `historial_invcon`
--
ALTER TABLE `historial_invcon`
  ADD PRIMARY KEY (`id_historial_invcon`),
  ADD KEY `id_invcon` (`id_invcon`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `historial_users`
--
ALTER TABLE `historial_users`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `hubs`
--
ALTER TABLE `hubs`
  ADD PRIMARY KEY (`hub_id`),
  ADD KEY `hub_serie` (`hub_serie`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `instructores`
--
ALTER TABLE `instructores`
  ADD PRIMARY KEY (`inst_id`),
  ADD KEY `inst_email` (`inst_email`,`inst_telefono`);

--
-- Indices de la tabla `invcon`
--
ALTER TABLE `invcon`
  ADD PRIMARY KEY (`invcon_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_categoria_2` (`id_categoria`),
  ADD KEY `id_categoria_3` (`id_categoria`);

--
-- Indices de la tabla `proyector`
--
ALTER TABLE `proyector`
  ADD PRIMARY KEY (`proyector_id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `simulador`
--
ALTER TABLE `simulador`
  ADD PRIMARY KEY (`simulador_id`),
  ADD KEY `simulador_ref` (`simulador_ref`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aeronaves`
--
ALTER TABLE `aeronaves`
  MODIFY `aero_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `aula_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing aula_id of each aula, unique index AUTO_INCREMENT	', AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `baterias`
--
ALTER TABLE `baterias`
  MODIFY `bat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `camposvuelo`
--
ALTER TABLE `camposvuelo`
  MODIFY `campo_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing campos_id of each campos, unique index AUTO_INCREMENT	', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `cargadores`
--
ALTER TABLE `cargadores`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `emisoras`
--
ALTER TABLE `emisoras`
  MODIFY `emi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `helices`
--
ALTER TABLE `helices`
  MODIFY `heli_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_aulas`
--
ALTER TABLE `historial_aulas`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_campos`
--
ALTER TABLE `historial_campos`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_cat`
--
ALTER TABLE `historial_cat`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_inst`
--
ALTER TABLE `historial_inst`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_invcon`
--
ALTER TABLE `historial_invcon`
  MODIFY `id_historial_invcon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_users`
--
ALTER TABLE `historial_users`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hubs`
--
ALTER TABLE `hubs`
  MODIFY `hub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instructores`
--
ALTER TABLE `instructores`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing inst_id of each instructor, unique index	AUTO_INCREMENT', AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `invcon`
--
ALTER TABLE `invcon`
  MODIFY `invcon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `proyector`
--
ALTER TABLE `proyector`
  MODIFY `proyector_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `simulador`
--
ALTER TABLE `simulador`
  MODIFY `simulador_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aeronaves`
--
ALTER TABLE `aeronaves`
  ADD CONSTRAINT `aeronaves_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`);

--
-- Filtros para la tabla `baterias`
--
ALTER TABLE `baterias`
  ADD CONSTRAINT `baterias_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`);

--
-- Filtros para la tabla `cargadores`
--
ALTER TABLE `cargadores`
  ADD CONSTRAINT `cargadores_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`);

--
-- Filtros para la tabla `emisoras`
--
ALTER TABLE `emisoras`
  ADD CONSTRAINT `emisoras_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`);

--
-- Filtros para la tabla `helices`
--
ALTER TABLE `helices`
  ADD CONSTRAINT `helices_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`);

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `fk_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `historial_aulas`
--
ALTER TABLE `historial_aulas`
  ADD CONSTRAINT `historial_aulas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `historial_aulas_ibfk_2` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`aula_id`);

--
-- Filtros para la tabla `historial_campos`
--
ALTER TABLE `historial_campos`
  ADD CONSTRAINT `historial_campos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `historial_campos_ibfk_2` FOREIGN KEY (`id_campo`) REFERENCES `camposvuelo` (`campo_id`);

--
-- Filtros para la tabla `historial_cat`
--
ALTER TABLE `historial_cat`
  ADD CONSTRAINT `historial_cat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `historial_inst`
--
ALTER TABLE `historial_inst`
  ADD CONSTRAINT `historial_inst_ibfk_1` FOREIGN KEY (`id_instr`) REFERENCES `instructores` (`inst_id`),
  ADD CONSTRAINT `historial_inst_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `historial_invcon`
--
ALTER TABLE `historial_invcon`
  ADD CONSTRAINT `historial_invcon_ibfk_1` FOREIGN KEY (`id_invcon`) REFERENCES `invcon` (`invcon_id`),
  ADD CONSTRAINT `historial_invcon_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `historial_users`
--
ALTER TABLE `historial_users`
  ADD CONSTRAINT `historial_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `hubs`
--
ALTER TABLE `hubs`
  ADD CONSTRAINT `hubs_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`);

--
-- Filtros para la tabla `proyector`
--
ALTER TABLE `proyector`
  ADD CONSTRAINT `proyector_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`);

--
-- Filtros para la tabla `simulador`
--
ALTER TABLE `simulador`
  ADD CONSTRAINT `simulador_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
