-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2024 a las 01:40:19
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
-- Base de datos: `torneo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancha`
--

CREATE TABLE `cancha` (
  `id` int(11) NOT NULL,
  `club_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cancha`
--

INSERT INTO `cancha` (`id`, `club_id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cancha 1', '2024-01-25 16:52:25', '2024-01-25 16:52:25'),
(2, 1, 'Cancha 2', '2024-01-25 16:57:25', '2024-01-25 16:57:25'),
(3, 1, 'Cancha 3', '2024-01-25 16:57:30', '2024-01-25 16:57:30'),
(4, 2, 'Cancha 1', '2024-01-25 16:58:05', '2024-01-25 16:58:05'),
(5, 2, 'Cancha 2', '2024-01-25 16:58:11', '2024-01-25 16:58:11'),
(6, 3, 'Cancha 1', '2024-01-25 16:58:17', '2024-01-25 16:58:17'),
(7, 3, 'Cancha 2', '2024-01-25 16:58:23', '2024-01-25 16:58:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(5, '+30', 'Categoría mayores de 30 años', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(6, '+35', 'Categoría mayores de 35 años', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(7, '+42', 'Categoría mayores de 42 años', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(8, '+50', 'Categoría mayores de 50 años', '2024-01-24 22:24:44', '2024-01-24 22:24:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club`
--

CREATE TABLE `club` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `club`
--

INSERT INTO `club` (`id`, `nombre`, `direccion`, `created_at`, `updated_at`) VALUES
(1, 'CLUB BANCO PROVINCIAL', 'sede central', '2024-01-25 16:52:17', '2024-01-25 16:52:17'),
(2, 'Regatas Santa Fe', 'Santa Fe', '2024-01-25 16:57:42', '2024-01-25 16:57:42'),
(3, 'Villa Dora', 'Santa Fe', '2024-01-25 16:57:49', '2024-01-25 16:57:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231230023345', '2024-01-24 22:07:36', 480),
('DoctrineMigrations\\Version20240118235403', '2024-01-24 22:07:36', 5),
('DoctrineMigrations\\Version20240123232742', '2024-01-24 22:07:36', 144),
('DoctrineMigrations\\Version20240124231810', '2024-01-24 22:07:37', 27),
('DoctrineMigrations\\Version20240125004533', '2024-01-24 22:07:37', 4),
('DoctrineMigrations\\Version20240125215834', '2024-01-25 18:59:05', 64);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `torneo_genero_categoria_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `torneo_genero_categoria_id`, `nombre`, `created_at`, `updated_at`) VALUES
(75, 7, 'INFINITO', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(76, 7, 'CSDC CORRRIENTES', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(77, 7, 'LA EMILIA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(78, 7, 'EL QUILLA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(79, 7, 'FUNDACION CORRIENTES', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(80, 7, 'LA MILONETA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(81, 7, 'ALIANZA SANTOTO', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(82, 7, 'MAMIS RESISTENCIA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(83, 8, 'REGATAS', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(84, 8, 'MALUCA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(85, 8, 'LAS BRUJAS', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(86, 8, 'LAS CUERVAS', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(87, 8, 'EL QUILLA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(88, 8, 'VILLA DORA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(89, 8, 'MALA MIA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(90, 8, 'LAS VIRGI', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(91, 8, 'OVJ PAISANDU', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(92, 8, 'APA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(93, 8, 'ADELANTE', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(94, 8, 'LAS GOLOS', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(95, 8, 'SOC SPORT ROLDAN', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(96, 8, 'ON FIRE', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(97, 8, 'NAUTICO AVELLANEDA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(98, 8, 'AQUELARRE URUGUAY', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(99, 8, 'TREDE/BIRRA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(100, 8, 'MONSTARD', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(101, 9, 'MALUCA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(102, 9, 'SF ALTO VOLEY', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(103, 9, 'INFINITO', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(104, 9, 'VOLEY MONTE', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(105, 9, 'MALA MIA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(106, 9, 'LAS VIEJA DE TATI', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(107, 9, 'CTRO REC SGO ESTERO', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(108, 9, 'MICUMAN', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(109, 9, 'LAS GOLOS', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(110, 9, 'CANARIAS', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(111, 9, 'AMIGAS POR EL VOLEY', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(112, 9, 'LAS BRANCAS', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(113, 9, 'MONSTARD', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(114, 9, 'COSTA MIX', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(115, 9, 'GUEMES SALTA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(116, 9, '12 REINAS', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(117, 9, 'BISARRAS', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(118, 9, 'LAS FENIX', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(119, 9, 'GYE E.R.', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(120, 9, 'EL REJUNTE', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(121, 9, 'LA MADRID', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(122, 9, 'UNI SF', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(123, 9, 'KUÑA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(124, 9, 'PANSAS VERDES', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(125, 10, 'BOLA 8', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(126, 10, 'LA GARRA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(127, 10, 'RACING RECONQUISTA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(128, 10, 'DESPELOTE', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(129, 10, 'ROMANG FUTBOL CLUB', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(130, 10, 'CLUB DE AMIGOS', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(131, 11, 'MAXI SANTA FE', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(132, 11, 'PAYSANDU', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(133, 11, 'HAVANNA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(134, 11, 'DEF MORENO', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(135, 11, 'NO PASA NARANJA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(136, 11, 'ROSARIO VOLEY', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(137, 11, 'BANCO PROVINCIA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(138, 11, 'LA TRIBU', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(139, 12, 'TACUAREMBO', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(140, 12, 'TUCUMAN DE GIMNASIA', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(141, 12, 'LOS PERKIN', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(142, 12, 'DEF MORENO', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(143, 12, 'BANCO HISPANO', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(144, 12, 'UNI SJ', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(145, 12, 'LPV', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(146, 12, 'LA TRIBU', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(147, 12, 'RIO CUARTO', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(148, 12, 'ALGO DISTINTO', '2024-01-24 22:24:44', '2024-01-24 22:24:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(3, 'Femenino', '2024-01-24 22:24:44', '2024-01-24 22:24:44'),
(4, 'Masculino', '2024-01-24 22:24:44', '2024-01-24 22:24:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `id` int(11) NOT NULL,
  `cancha_id` int(11) DEFAULT NULL,
  `zona_id` int(11) NOT NULL,
  `equipo_local_id` int(11) DEFAULT NULL,
  `equipo_visitante_id` int(11) DEFAULT NULL,
  `local_set1` int(11) DEFAULT NULL,
  `local_set2` int(11) DEFAULT NULL,
  `local_set3` int(11) DEFAULT NULL,
  `local_set4` int(11) DEFAULT NULL,
  `local_set5` int(11) DEFAULT NULL,
  `visitante_set1` int(11) DEFAULT NULL,
  `visitante_set2` int(11) DEFAULT NULL,
  `visitante_set3` int(11) DEFAULT NULL,
  `visitante_set4` int(11) DEFAULT NULL,
  `visitante_set5` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id`, `cancha_id`, `zona_id`, `equipo_local_id`, `equipo_visitante_id`, `local_set1`, `local_set2`, `local_set3`, `local_set4`, `local_set5`, `visitante_set1`, `visitante_set2`, `visitante_set3`, `visitante_set4`, `visitante_set5`) VALUES
(33, 1, 19, 75, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, NULL, 19, 75, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, NULL, 19, 75, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, NULL, 19, 76, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, NULL, 19, 76, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, NULL, 19, 77, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, NULL, 20, 79, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, NULL, 20, 79, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, NULL, 20, 79, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, NULL, 20, 80, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, NULL, 20, 80, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, NULL, 20, 81, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, NULL, 21, 83, 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, NULL, 21, 83, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, NULL, 21, 83, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, NULL, 21, 83, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, 21, 84, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, 21, 84, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, NULL, 21, 84, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, NULL, 21, 85, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, NULL, 21, 85, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, NULL, 21, 86, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, NULL, 22, 88, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, NULL, 22, 88, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, NULL, 22, 88, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, NULL, 22, 88, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, NULL, 22, 89, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, NULL, 22, 89, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, NULL, 22, 89, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, NULL, 22, 90, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, NULL, 22, 90, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, NULL, 22, 91, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, NULL, 23, 93, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, NULL, 23, 93, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, NULL, 23, 93, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, NULL, 23, 94, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, NULL, 23, 94, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, NULL, 23, 95, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, NULL, 24, 97, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, NULL, 24, 97, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, NULL, 24, 97, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, NULL, 24, 98, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, NULL, 24, 98, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, NULL, 24, 99, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 1, 18, 125, 126, 10, 11, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL),
(78, 1, 18, 125, 127, 12, 25, 8, NULL, NULL, 25, 19, 15, NULL, NULL),
(79, 1, 18, 125, 128, 10, 18, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL),
(80, 1, 18, 125, 129, 21, 25, 15, NULL, NULL, 25, 15, 13, NULL, NULL),
(81, 1, 18, 125, 130, 10, 20, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL),
(82, 1, 18, 126, 127, 25, 21, 15, NULL, NULL, 21, 25, 13, NULL, NULL),
(83, 1, 18, 126, 128, 25, 30, NULL, NULL, NULL, 18, 28, NULL, NULL, NULL),
(84, 1, 18, 126, 129, 25, 25, NULL, NULL, NULL, 11, 16, NULL, NULL, NULL),
(85, 1, 18, 126, 130, 25, 25, NULL, NULL, NULL, 14, 18, NULL, NULL, NULL),
(86, 1, 18, 127, 128, 19, 13, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL),
(87, 1, 18, 127, 129, 25, 25, NULL, NULL, NULL, 12, 20, NULL, NULL, NULL),
(88, 1, 18, 127, 130, 22, 20, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL),
(89, 1, 18, 128, 129, 25, 25, NULL, NULL, NULL, 18, 16, NULL, NULL, NULL),
(90, 1, 18, 128, 130, 18, 13, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL),
(91, 1, 18, 129, 130, 6, 12, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL),
(92, NULL, 25, 139, 140, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, NULL, 25, 139, 141, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, NULL, 25, 139, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, NULL, 25, 139, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, NULL, 25, 140, 141, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, NULL, 25, 140, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, NULL, 25, 140, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, NULL, 25, 141, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, NULL, 25, 141, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, NULL, 25, 142, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, NULL, 26, 144, 145, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, NULL, 26, 144, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, NULL, 26, 144, 147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, NULL, 26, 144, 148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, NULL, 26, 145, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, NULL, 26, 145, 147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, NULL, 26, 145, 148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, NULL, 26, 146, 147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, NULL, 26, 146, 148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, NULL, 26, 147, 148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, NULL, 27, 131, 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, NULL, 27, 131, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, NULL, 27, 131, 134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, NULL, 27, 132, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, NULL, 27, 132, 134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, NULL, 27, 133, 134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, NULL, 28, 135, 136, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, NULL, 28, 135, 137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, NULL, 28, 135, 138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, NULL, 28, 136, 137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, NULL, 28, 136, 138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, NULL, 28, 137, 138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, NULL, 29, 101, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, NULL, 29, 101, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, NULL, 29, 101, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, NULL, 29, 102, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, NULL, 29, 102, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, NULL, 29, 103, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, NULL, 30, 105, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, NULL, 30, 105, 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, NULL, 30, 105, 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, NULL, 30, 106, 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, NULL, 30, 106, 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, NULL, 30, 107, 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, NULL, 31, 109, 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, NULL, 31, 109, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, NULL, 31, 109, 112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, NULL, 31, 110, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, NULL, 31, 110, 112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, NULL, 31, 111, 112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, NULL, 32, 113, 114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, NULL, 32, 113, 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, NULL, 32, 113, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, NULL, 32, 114, 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, NULL, 32, 114, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, NULL, 32, 115, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, NULL, 33, 117, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, NULL, 33, 117, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, NULL, 33, 117, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, NULL, 33, 118, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, NULL, 33, 118, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, NULL, 33, 119, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, NULL, 34, 121, 122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, NULL, 34, 121, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(156, NULL, 34, 121, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, NULL, 34, 122, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, NULL, 34, 122, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, NULL, 34, 123, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo`
--

CREATE TABLE `torneo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `fecha_fin` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `fecha_inicio_inscripcion` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `fecha_fin_inscripcion` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `torneo`
--

INSERT INTO `torneo` (`id`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`, `fecha_inicio_inscripcion`, `fecha_fin_inscripcion`, `created_at`, `updated_at`) VALUES
(2, 'Torneo de prueba', 'Descripcion torneo de prueba', '2024-01-01 09:00:00', '2024-01-31 20:00:00', '2020-12-01 00:00:00', '2023-12-31 23:59:59', '2024-01-24 22:24:44', '2024-01-24 22:24:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo_genero_categoria`
--

CREATE TABLE `torneo_genero_categoria` (
  `id` int(11) NOT NULL,
  `torneo_id` int(11) DEFAULT NULL,
  `genero_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `cerrado` tinyint(1) NOT NULL,
  `creado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `torneo_genero_categoria`
--

INSERT INTO `torneo_genero_categoria` (`id`, `torneo_id`, `genero_id`, `categoria_id`, `created_at`, `updated_at`, `cerrado`, `creado`) VALUES
(7, 2, 3, 5, '2024-01-24 22:24:44', '2024-01-24 22:27:20', 1, 1),
(8, 2, 3, 6, '2024-01-24 22:24:44', '2024-01-24 22:27:26', 1, 1),
(9, 2, 3, 7, '2024-01-24 22:24:44', '2024-01-24 22:28:21', 1, 1),
(10, 2, 4, 6, '2024-01-24 22:24:44', '2024-01-24 22:27:32', 1, 1),
(11, 2, 4, 7, '2024-01-24 22:24:44', '2024-01-24 22:28:06', 1, 1),
(12, 2, 4, 8, '2024-01-24 22:24:44', '2024-01-24 22:28:02', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(2, 'admin', '[]', '$2y$13$pMBxCH8MALvzGue8AAu0HeD9eYdoXbn0iZYZcUlwMhdlvxk7cbHna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `id` int(11) NOT NULL,
  `torneo_genero_categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`id`, `torneo_genero_categoria_id`) VALUES
(19, 7),
(20, 7),
(21, 8),
(22, 8),
(23, 8),
(24, 8),
(29, 9),
(30, 9),
(31, 9),
(32, 9),
(33, 9),
(34, 9),
(18, 10),
(27, 11),
(28, 11),
(25, 12),
(26, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona_equipo`
--

CREATE TABLE `zona_equipo` (
  `id` int(11) NOT NULL,
  `zona_id` int(11) DEFAULT NULL,
  `equipo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zona_equipo`
--

INSERT INTO `zona_equipo` (`id`, `zona_id`, `equipo_id`) VALUES
(75, 18, 125),
(76, 18, 126),
(77, 18, 127),
(78, 18, 128),
(79, 18, 129),
(80, 18, 130),
(81, 19, 75),
(82, 19, 76),
(83, 19, 77),
(84, 19, 78),
(85, 20, 79),
(86, 20, 80),
(87, 20, 81),
(88, 20, 82),
(89, 21, 83),
(90, 21, 84),
(91, 21, 85),
(92, 21, 86),
(93, 21, 87),
(94, 22, 88),
(95, 22, 89),
(96, 22, 90),
(97, 22, 91),
(98, 22, 92),
(99, 23, 93),
(100, 23, 94),
(101, 23, 95),
(102, 23, 96),
(103, 24, 97),
(104, 24, 98),
(105, 24, 99),
(106, 24, 100),
(107, 25, 139),
(108, 25, 140),
(109, 25, 141),
(110, 25, 142),
(111, 25, 143),
(112, 26, 144),
(113, 26, 145),
(114, 26, 146),
(115, 26, 147),
(116, 26, 148),
(117, 27, 131),
(118, 27, 132),
(119, 27, 133),
(120, 27, 134),
(121, 28, 135),
(122, 28, 136),
(123, 28, 137),
(124, 28, 138),
(125, 29, 101),
(126, 29, 102),
(127, 29, 103),
(128, 29, 104),
(129, 30, 105),
(130, 30, 106),
(131, 30, 107),
(132, 30, 108),
(133, 31, 109),
(134, 31, 110),
(135, 31, 111),
(136, 31, 112),
(137, 32, 113),
(138, 32, 114),
(139, 32, 115),
(140, 32, 116),
(141, 33, 117),
(142, 33, 118),
(143, 33, 119),
(144, 33, 120),
(145, 34, 121),
(146, 34, 122),
(147, 34, 123),
(148, 34, 124);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9D09C78261190A32` (`club_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4E10122D3A909126` (`nombre`);

--
-- Indices de la tabla `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C49C530BD7CF149E` (`torneo_genero_categoria_id`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A000883A3A909126` (`nombre`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4E79750B7997F36E` (`cancha_id`),
  ADD KEY `IDX_4E79750B104EA8FC` (`zona_id`),
  ADD KEY `IDX_4E79750B88774E73` (`equipo_local_id`),
  ADD KEY `IDX_4E79750B8C243011` (`equipo_visitante_id`);

--
-- Indices de la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `torneo_genero_categoria`
--
ALTER TABLE `torneo_genero_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D2F850FAA0139802` (`torneo_id`),
  ADD KEY `IDX_D2F850FABCE7B795` (`genero_id`),
  ADD KEY `IDX_D2F850FA3397707A` (`categoria_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A786041ED7CF149E` (`torneo_genero_categoria_id`);

--
-- Indices de la tabla `zona_equipo`
--
ALTER TABLE `zona_equipo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7FC5758323BFBED` (`equipo_id`),
  ADD KEY `IDX_7FC57583104EA8FC` (`zona_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cancha`
--
ALTER TABLE `cancha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `torneo_genero_categoria`
--
ALTER TABLE `torneo_genero_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `zona_equipo`
--
ALTER TABLE `zona_equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD CONSTRAINT `FK_9D09C78261190A32` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`);

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `FK_C49C530BD7CF149E` FOREIGN KEY (`torneo_genero_categoria_id`) REFERENCES `torneo_genero_categoria` (`id`);

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `FK_4E79750B104EA8FC` FOREIGN KEY (`zona_id`) REFERENCES `zona` (`id`),
  ADD CONSTRAINT `FK_4E79750B7997F36E` FOREIGN KEY (`cancha_id`) REFERENCES `cancha` (`id`),
  ADD CONSTRAINT `FK_4E79750B88774E73` FOREIGN KEY (`equipo_local_id`) REFERENCES `equipo` (`id`),
  ADD CONSTRAINT `FK_4E79750B8C243011` FOREIGN KEY (`equipo_visitante_id`) REFERENCES `equipo` (`id`);

--
-- Filtros para la tabla `torneo_genero_categoria`
--
ALTER TABLE `torneo_genero_categoria`
  ADD CONSTRAINT `FK_D2F850FA3397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `FK_D2F850FAA0139802` FOREIGN KEY (`torneo_id`) REFERENCES `torneo` (`id`),
  ADD CONSTRAINT `FK_D2F850FABCE7B795` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`);

--
-- Filtros para la tabla `zona`
--
ALTER TABLE `zona`
  ADD CONSTRAINT `FK_A786041ED7CF149E` FOREIGN KEY (`torneo_genero_categoria_id`) REFERENCES `torneo_genero_categoria` (`id`);

--
-- Filtros para la tabla `zona_equipo`
--
ALTER TABLE `zona_equipo`
  ADD CONSTRAINT `FK_7FC57583104EA8FC` FOREIGN KEY (`zona_id`) REFERENCES `zona` (`id`),
  ADD CONSTRAINT `FK_7FC5758323BFBED` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
