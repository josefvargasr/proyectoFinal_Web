-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2016 a las 05:17:13
-- Versión del servidor: 5.6.15-log
-- Versión de PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `aulas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `hora` varchar(200) NOT NULL,
  `fecha` varchar(200) NOT NULL,
  `aula` int(11) NOT NULL,
  `tip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `tipo`, `hora`, `fecha`, `aula`, `tip`) VALUES
(3, 6, '9:53', '15-1-2016', 33, 0),
(2, 1, '9:47', '15-1-2016', 31, 345),
(4, 6, '9:53', '15-1-2016', 34, 0),
(5, 7, '9:54', '15-1-2016', 21, 876871231),
(6, 1, '10:0', '15-1-2016', 5, 1234567890),
(7, 2, '11:37', '15-1-2016', 5, 1234567890),
(8, 2, '11:41', '15-1-2016', 5, 1234567890),
(9, 2, '11:45', '15-1-2016', 5, 1234567890),
(10, 1, '12:1', '15-1-2016', 7, 1234567890),
(11, 2, '12:4', '15-1-2016', 7, 1234567890),
(12, 3, '12:4', '15-1-2016', 7, 1234567890),
(13, 3, '17:45', '17-1-2016', 0, 1017207056),
(14, 51, '17:47', '17-1-2016', 0, 1017207056),
(15, 52, '17:47', '17-1-2016', 0, 1017207056),
(16, 51, '8:28', '18-1-2016', 0, 1017207056),
(17, 1, '8:44', '18-1-2016', 17, 123),
(18, 2, '8:45', '18-1-2016', 17, 123),
(19, 3, '8:45', '18-1-2016', 17, 123),
(20, 1, '9:32', '18-1-2016', 19, 123),
(21, 51, '10:43', '18-1-2016', 0, 1017207056),
(22, 51, '10:43', '18-1-2016', 0, 1017207056),
(23, 51, '12:11', '18-1-2016', 0, 1017207056),
(24, 1, '12:15', '18-1-2016', 0, 0),
(25, 6, '12:15', '18-1-2016', 0, 0),
(26, 1, '12:16', '18-1-2016', 32, 123123),
(27, 1, '12:21', '18-1-2016', 0, 0),
(28, 54, '14:47', '18-1-2016', 0, 1017207056),
(29, 56, '14:49', '18-1-2016', 0, 1017207056);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'Monitor', 'Monitor UdeA'),
(4, 'Profesor', 'Profesor UdeA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aula` int(11) NOT NULL,
  `equipo` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=185 ;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `aula`, `equipo`, `estado`) VALUES
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 1, 4, 0),
(5, 1, 5, 0),
(6, 2, 1, 0),
(7, 2, 2, 0),
(8, 2, 3, 0),
(9, 2, 4, 0),
(10, 2, 5, 0),
(11, 3, 1, 0),
(12, 3, 2, 0),
(13, 3, 3, 0),
(14, 3, 4, 0),
(15, 3, 5, 0),
(16, 4, 1, 0),
(17, 4, 2, 0),
(18, 4, 3, 0),
(19, 4, 4, 0),
(20, 4, 5, 0),
(21, 5, 1, 0),
(22, 5, 2, 0),
(23, 5, 3, 0),
(24, 5, 4, 0),
(25, 5, 5, 0),
(26, 6, 1, 0),
(27, 6, 2, 0),
(28, 6, 3, 0),
(29, 6, 4, 0),
(30, 6, 5, 0),
(31, 7, 1, 0),
(32, 7, 2, 0),
(33, 7, 3, 0),
(34, 7, 4, 0),
(35, 7, 5, 0),
(36, 8, 1, 0),
(37, 8, 2, 0),
(38, 8, 3, 0),
(39, 8, 4, 0),
(40, 8, 5, 0),
(41, 9, 1, 0),
(42, 9, 2, 0),
(43, 9, 3, 0),
(44, 9, 4, 0),
(45, 9, 5, 0),
(46, 10, 1, 0),
(47, 10, 2, 0),
(48, 10, 3, 0),
(49, 10, 4, 0),
(50, 10, 5, 0),
(51, 11, 1, 0),
(52, 11, 2, 0),
(53, 11, 3, 0),
(54, 11, 4, 0),
(55, 11, 5, 0),
(56, 12, 1, 0),
(57, 12, 2, 0),
(58, 12, 3, 0),
(59, 12, 4, 0),
(60, 12, 5, 0),
(61, 13, 1, 0),
(62, 13, 2, 0),
(63, 13, 3, 0),
(64, 13, 4, 0),
(65, 13, 5, 0),
(66, 14, 1, 0),
(67, 14, 2, 0),
(68, 14, 3, 0),
(69, 14, 4, 0),
(70, 14, 5, 0),
(71, 15, 1, 0),
(72, 15, 2, 0),
(73, 15, 3, 0),
(74, 15, 4, 0),
(75, 15, 5, 0),
(76, 16, 1, 0),
(77, 16, 2, 0),
(78, 16, 3, 0),
(79, 16, 4, 0),
(80, 16, 5, 0),
(81, 17, 1, 0),
(82, 17, 2, 0),
(83, 17, 3, 0),
(84, 17, 4, 0),
(85, 17, 5, 0),
(86, 18, 1, 0),
(87, 18, 2, 0),
(88, 18, 3, 0),
(89, 18, 4, 0),
(90, 18, 5, 0),
(91, 19, 1, 0),
(92, 19, 2, 0),
(93, 19, 3, 0),
(94, 19, 4, 0),
(95, 19, 5, 0),
(96, 20, 1, 0),
(97, 20, 2, 0),
(98, 20, 3, 0),
(99, 20, 4, 0),
(100, 20, 5, 0),
(101, 21, 1, 0),
(102, 21, 2, 0),
(103, 21, 3, 0),
(104, 21, 4, 0),
(105, 21, 5, 0),
(106, 22, 1, 0),
(107, 22, 2, 0),
(108, 22, 3, 0),
(109, 22, 4, 0),
(110, 22, 5, 0),
(111, 23, 1, 0),
(112, 23, 2, 0),
(113, 23, 3, 0),
(114, 23, 4, 0),
(115, 23, 5, 0),
(116, 24, 1, 0),
(117, 24, 2, 0),
(118, 24, 3, 0),
(119, 24, 4, 0),
(120, 24, 5, 0),
(121, 25, 1, 0),
(122, 25, 2, 0),
(123, 25, 3, 0),
(124, 25, 4, 0),
(125, 25, 5, 0),
(126, 26, 1, 0),
(127, 26, 2, 0),
(128, 26, 3, 0),
(129, 26, 4, 0),
(130, 26, 5, 0),
(131, 27, 1, 0),
(132, 27, 2, 0),
(133, 27, 3, 0),
(134, 27, 4, 0),
(135, 27, 5, 0),
(136, 28, 1, 0),
(137, 28, 2, 0),
(138, 28, 3, 0),
(139, 28, 4, 0),
(140, 28, 5, 0),
(141, 29, 1, 0),
(142, 29, 2, 0),
(143, 29, 3, 0),
(144, 29, 4, 0),
(145, 29, 5, 0),
(146, 30, 1, 0),
(147, 30, 2, 0),
(148, 30, 3, 0),
(149, 30, 4, 0),
(150, 30, 5, 0),
(151, 31, 1, 0),
(152, 31, 2, 0),
(153, 31, 3, 0),
(154, 31, 4, 0),
(155, 31, 5, 0),
(156, 32, 1, 0),
(157, 32, 2, 0),
(158, 32, 3, 0),
(159, 32, 4, 0),
(160, 32, 5, 0),
(161, 33, 1, 0),
(162, 33, 2, 0),
(163, 33, 3, 0),
(164, 33, 4, 0),
(165, 33, 5, 0),
(166, 34, 1, 0),
(167, 34, 2, 0),
(168, 34, 3, 0),
(169, 34, 4, 0),
(170, 34, 5, 0),
(171, 35, 1, 0),
(172, 35, 2, 0),
(173, 35, 3, 0),
(174, 35, 4, 0),
(175, 35, 5, 0),
(176, 36, 1, 0),
(177, 36, 2, 0),
(178, 36, 3, 0),
(179, 36, 4, 0),
(180, 36, 5, 0),
(181, 1, 6, 0),
(182, 1, 7, 1),
(184, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aula` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `hora` varchar(200) NOT NULL,
  `fecha` varchar(200) NOT NULL,
  `curso` varchar(200) NOT NULL,
  `profesor` varchar(200) NOT NULL,
  `cc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `aula`, `estado`, `hora`, `fecha`, `curso`, `profesor`, `cc`) VALUES
(31, 30, 1, '6:00-8:00', '1-1-2015', 'Acondi', 'Carrillo', 123),
(33, 5, 2, '10:00-12:00', '15-1-2016', 'Redes', 'Jose', 1234567890),
(29, 21, 1, '18:00-20:00', '14-1-2016', 'CircuitosI', 'Norman', 876871231),
(20, 11, 1, '6:00-8:00', '1-1-2015', 'Potencia', 'Leal', 123),
(18, 22, 1, '6:00-8:00', '1-1-2015', 'Discretas', 'Ruben', 2147483647),
(17, 2, 1, '6:00-8:00', '1-1-2015', 'DigitalesI', 'Aedo', 2147483647),
(16, 1, 1, '6:00-8:00', '1-1-2015', 'Electromagnetismo', 'Gaviria', 1234567890),
(32, 31, 1, '6:00-8:00', '1-1-2015', 'Cocina', 'Yo', 345),
(34, 7, 3, '12:00-14:00', '15-1-2016', 'Musica2', 'Jose', 1234567890),
(35, 17, 3, '8:00-10:00', '18-1-2016', 'Web', 'Stivi', 123),
(36, 19, 1, '8:00-10:00', '1-1-2015', 'qwe', 'qwe', 123),
(38, 32, 1, '6:00-8:00', '1-1-2015', 'Web', '1234', 123123),
(39, 0, 1, '', '--', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1453173530, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '127.0.0.1', NULL, '$2y$08$tRtv2.jtGijYEcY8WyLOUum2hfMCPnNjBrKnyQkoomkDrqkvzQAFW', NULL, 'josefvargasr@gmail.com', NULL, NULL, NULL, NULL, 1451490327, 1453129362, 1, 'Jose', 'Vargas', 'UdeA', '3006488379');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(5, 2, 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
