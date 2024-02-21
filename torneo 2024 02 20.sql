-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2024 a las 00:08:27
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
(1, 1, 'Cancha 1', '2024-02-20 20:07:59', '2024-02-20 20:07:59');

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
(1, '+30', 'Categoría mayores de 30 años', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(2, '+35', 'Categoría mayores de 35 años', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(3, '+42', 'Categoría mayores de 42 años', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(4, '+50', 'Categoría mayores de 50 años', '2024-02-20 13:58:07', '2024-02-20 13:58:07');

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
(1, 'Club 1', 'Direccion 1234', '2024-02-20 20:07:47', '2024-02-20 20:07:47');

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
('DoctrineMigrations\\Version20240220165348', '2024-02-20 13:54:29', 635);

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
(1, 1, 'INFINITO', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(2, 1, 'CSDC CORRRIENTES', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(3, 1, 'LA EMILIA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(4, 1, 'EL QUILLA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(5, 1, 'FUNDACION CORRIENTES', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(6, 1, 'LA MILONETA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(7, 1, 'ALIANZA SANTOTO', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(8, 1, 'MAMIS RESISTENCIA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(9, 2, 'REGATAS', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(10, 2, 'MALUCA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(11, 2, 'LAS BRUJAS', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(12, 2, 'LAS CUERVAS', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(13, 2, 'EL QUILLA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(14, 2, 'VILLA DORA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(15, 2, 'MALA MIA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(16, 2, 'LAS VIRGI', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(17, 2, 'OVJ PAISANDU', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(18, 2, 'APA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(19, 2, 'ADELANTE', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(20, 2, 'LAS GOLOS', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(21, 2, 'SOC SPORT ROLDAN', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(22, 2, 'ON FIRE', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(23, 2, 'NAUTICO AVELLANEDA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(24, 2, 'AQUELARRE URUGUAY', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(25, 2, 'TREDE/BIRRA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(26, 2, 'MONSTARD', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(27, 3, 'MALUCA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(28, 3, 'SF ALTO VOLEY', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(29, 3, 'INFINITO', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(30, 3, 'VOLEY MONTE', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(31, 3, 'MALA MIA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(32, 3, 'LAS VIEJA DE TATI', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(33, 3, 'CTRO REC SGO ESTERO', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(34, 3, 'MICUMAN', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(35, 3, 'LAS GOLOS', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(36, 3, 'CANARIAS', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(37, 3, 'AMIGAS POR EL VOLEY', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(38, 3, 'LAS BRANCAS', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(39, 3, 'MONSTARD', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(40, 3, 'COSTA MIX', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(41, 3, 'GUEMES SALTA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(42, 3, '12 REINAS', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(43, 3, 'BISARRAS', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(44, 3, 'LAS FENIX', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(45, 3, 'GYE E.R.', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(46, 3, 'EL REJUNTE', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(47, 3, 'LA MADRID', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(48, 3, 'UNI SF', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(49, 3, 'KUÑA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(50, 3, 'PANSAS VERDES', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(51, 4, 'BOLA 8', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(52, 4, 'LA GARRA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(53, 4, 'RACING RECONQUISTA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(54, 4, 'DESPELOTE', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(55, 4, 'ROMANG FUTBOL CLUB', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(56, 4, 'CLUB DE AMIGOS', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(57, 5, 'MAXI SANTA FE', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(58, 5, 'PAYSANDU', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(59, 5, 'HAVANNA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(60, 5, 'DEF MORENO', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(61, 5, 'NO PASA NARANJA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(62, 5, 'ROSARIO VOLEY', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(63, 5, 'BANCO PROVINCIA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(64, 5, 'LA TRIBU', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(65, 6, 'TACUAREMBO', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(66, 6, 'TUCUMAN DE GIMNASIA', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(67, 6, 'LOS PERKIN', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(68, 6, 'DEF MORENO', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(69, 6, 'BANCO HISPANO', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(70, 6, 'UNI SJ', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(71, 6, 'LPV', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(72, 6, 'LA TRIBU', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(73, 6, 'RIO CUARTO', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(74, 6, 'ALGO DISTINTO', '2024-02-20 13:58:07', '2024-02-20 13:58:07');

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
(1, 'Femenino', '2024-02-20 13:58:07', '2024-02-20 13:58:07'),
(2, 'Masculino', '2024-02-20 13:58:07', '2024-02-20 13:58:07');

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
  `visitante_set5` int(11) DEFAULT NULL,
  `horario` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id`, `cancha_id`, `zona_id`, `equipo_local_id`, `equipo_visitante_id`, `local_set1`, `local_set2`, `local_set3`, `local_set4`, `local_set5`, `visitante_set1`, `visitante_set2`, `visitante_set3`, `visitante_set4`, `visitante_set5`, `horario`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 9, 19, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(2, 1, 1, 1, 3, 15, 15, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(3, 1, 1, 1, 4, 13, 12, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(4, 1, 1, 2, 3, 14, 10, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(5, 1, 1, 2, 4, 13, 12, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(6, 1, 1, 3, 4, 21, 21, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(7, 1, 2, 5, 6, 22, 18, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(8, 1, 2, 5, 7, 20, 25, 15, NULL, NULL, 25, 20, 11, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(9, 1, 2, 5, 8, 25, 23, 15, NULL, NULL, 13, 25, 5, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(10, 1, 2, 6, 7, 24, 24, NULL, NULL, NULL, 26, 26, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(11, 1, 2, 6, 8, 25, 25, NULL, NULL, NULL, 14, 21, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(12, 1, 2, 7, 8, 25, 25, NULL, NULL, NULL, 16, 22, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(13, 1, 3, 9, 10, 23, 25, 15, NULL, NULL, 25, 13, 5, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(14, 1, 3, 9, 11, 25, 25, NULL, NULL, NULL, 12, 17, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(15, 1, 3, 9, 12, 24, 19, NULL, NULL, NULL, 26, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(16, 1, 3, 9, 13, 17, 17, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(17, 1, 3, 10, 11, 22, 23, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(18, 1, 3, 10, 12, 9, 9, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(19, 1, 3, 10, 13, 5, 9, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(20, 1, 3, 11, 12, 6, 14, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(21, 1, 3, 11, 13, 12, 5, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(22, 1, 3, 12, 13, 25, 20, 13, NULL, NULL, 14, 25, 15, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(23, 1, 4, 14, 15, 29, 25, NULL, NULL, NULL, 27, 16, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(24, 1, 4, 14, 16, 25, 25, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(25, 1, 4, 14, 17, 25, 25, NULL, NULL, NULL, 7, 24, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(26, 1, 4, 14, 18, 25, 25, NULL, NULL, NULL, 18, 17, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(27, 1, 4, 15, 16, 25, 25, NULL, NULL, NULL, 14, 12, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(28, 1, 4, 15, 17, 25, 25, NULL, NULL, NULL, 18, 16, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(29, 1, 4, 15, 18, 17, 25, 9, NULL, NULL, 25, 17, 15, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(30, 1, 4, 16, 17, 9, 9, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(31, 1, 4, 16, 18, 7, 14, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(32, 1, 4, 17, 18, 16, 16, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(33, 1, 5, 19, 20, 8, 9, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(34, 1, 5, 19, 21, 25, 25, NULL, NULL, NULL, 14, 22, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(35, 1, 5, 19, 22, 25, 25, NULL, NULL, NULL, 22, 19, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(36, 1, 5, 20, 21, 25, 25, NULL, NULL, NULL, 11, 5, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(37, 1, 5, 20, 22, 25, 25, NULL, NULL, NULL, 6, 12, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(38, 1, 5, 21, 22, 9, 15, NULL, NULL, NULL, 15, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(39, 1, 6, 23, 24, 25, 25, NULL, NULL, NULL, 12, 5, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(40, 1, 6, 23, 25, 25, 19, 13, NULL, NULL, 17, 25, 15, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(41, 1, 6, 23, 26, 25, 25, NULL, NULL, NULL, 15, 16, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(42, 1, 6, 24, 25, 5, 8, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(43, 1, 6, 24, 26, 17, 13, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(44, 1, 6, 25, 26, 25, 25, NULL, NULL, NULL, 19, 17, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(45, 1, 7, 27, 28, 11, 15, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(46, 1, 7, 27, 29, 25, 13, 18, NULL, NULL, 12, 25, 20, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(47, 1, 7, 27, 30, 20, 19, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(48, 1, 7, 28, 29, 25, 25, NULL, NULL, NULL, 5, 12, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(49, 1, 7, 28, 30, 25, 25, NULL, NULL, NULL, 10, 11, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(50, 1, 7, 29, 30, 25, 19, 15, NULL, NULL, 19, 25, 13, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(51, 1, 8, 31, 32, 25, 25, NULL, NULL, NULL, 19, 19, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(52, 1, 8, 31, 33, 26, 31, NULL, NULL, NULL, 24, 29, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(53, 1, 8, 31, 34, 25, 19, 15, NULL, NULL, 19, 25, 5, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(54, 1, 8, 32, 33, 17, 18, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(55, 1, 8, 32, 34, 25, 25, NULL, NULL, NULL, 13, 20, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(56, 1, 8, 33, 34, 25, 25, NULL, NULL, NULL, 14, 12, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(57, 1, 9, 35, 36, 25, 25, NULL, NULL, NULL, 23, 14, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(58, 1, 9, 35, 37, 27, 18, 13, NULL, NULL, 25, 25, 15, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(59, 1, 9, 35, 38, 25, 27, NULL, NULL, NULL, 23, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(60, 1, 9, 36, 37, 25, 14, 10, NULL, NULL, 16, 25, 15, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(61, 1, 9, 36, 38, 23, 19, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(62, 1, 9, 37, 38, 22, 18, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(63, 1, 10, 39, 40, 25, 25, NULL, NULL, NULL, 11, 22, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(64, 1, 10, 39, 41, 25, 25, NULL, NULL, NULL, 12, 22, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(65, 1, 10, 39, 42, 25, 25, NULL, NULL, NULL, 22, 21, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(66, 1, 10, 40, 41, 16, 25, NULL, NULL, NULL, 25, 27, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(67, 1, 10, 40, 42, 19, 16, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(68, 1, 10, 41, 42, 14, 12, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(69, 1, 11, 43, 44, 12, 14, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(70, 1, 11, 43, 45, 25, 25, NULL, NULL, NULL, 17, 14, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(71, 1, 11, 43, 46, 14, 11, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(72, 1, 11, 44, 45, 25, 25, NULL, NULL, NULL, 12, 11, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(73, 1, 11, 44, 46, 20, 25, 13, NULL, NULL, 25, 22, 15, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(74, 1, 11, 45, 46, 25, 18, NULL, NULL, NULL, 27, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(75, 1, 12, 47, 48, 20, 10, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(76, 1, 12, 47, 49, 25, 27, NULL, NULL, NULL, 16, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(77, 1, 12, 47, 50, 12, 22, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(78, 1, 12, 48, 49, 25, 23, 15, NULL, NULL, 5, 25, 9, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(79, 1, 12, 48, 50, 25, 19, 14, NULL, NULL, 23, 25, 16, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(80, 1, 12, 49, 50, 25, 11, 12, NULL, NULL, 23, 25, 15, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(81, 1, 13, 51, 52, 10, 11, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(82, 1, 13, 51, 53, 12, 25, 8, NULL, NULL, 25, 19, 15, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(83, 1, 13, 51, 54, 10, 18, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(84, 1, 13, 51, 55, 21, 25, 15, NULL, NULL, 25, 15, 13, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(85, 1, 13, 51, 56, 10, 20, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(86, 1, 13, 52, 53, 25, 21, 15, NULL, NULL, 21, 25, 13, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(87, 1, 13, 52, 54, 25, 30, NULL, NULL, NULL, 18, 28, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(88, 1, 13, 52, 55, 25, 25, NULL, NULL, NULL, 11, 16, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(89, 1, 13, 52, 56, 25, 25, NULL, NULL, NULL, 14, 18, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(90, 1, 13, 53, 54, 19, 13, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(91, 1, 13, 53, 55, 25, 25, NULL, NULL, NULL, 12, 20, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(92, 1, 13, 53, 56, 22, 20, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(93, 1, 13, 54, 55, 25, 25, NULL, NULL, NULL, 18, 16, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(94, 1, 13, 54, 56, 18, 13, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(95, 1, 13, 55, 56, 6, 12, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(96, 1, 14, 57, 58, 25, 18, 15, NULL, NULL, 18, 25, 12, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(97, 1, 14, 57, 59, 25, 25, NULL, NULL, NULL, 24, 16, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(98, 1, 14, 57, 60, 25, 25, NULL, NULL, NULL, 11, 19, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(99, 1, 14, 58, 59, 25, 25, NULL, NULL, NULL, 20, 21, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(100, 1, 14, 58, 60, 16, 26, 13, NULL, NULL, 25, 24, 15, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(101, 1, 14, 59, 60, 25, 25, NULL, NULL, NULL, 15, 16, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(102, 1, 15, 61, 62, 19, 25, 16, NULL, NULL, 25, 14, 14, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(103, 1, 15, 61, 63, 21, 25, 15, NULL, NULL, 25, 16, 9, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(104, 1, 15, 61, 64, 25, 25, NULL, NULL, NULL, 21, 23, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(105, 1, 15, 62, 63, 14, 25, 15, NULL, NULL, 25, 17, 12, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(106, 1, 15, 62, 64, 25, 25, NULL, NULL, NULL, 22, 11, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(107, 1, 15, 63, 64, 21, 26, 15, NULL, NULL, 25, 24, 11, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(108, 1, 16, 65, 66, 20, 18, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(109, 1, 16, 65, 67, 14, 20, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(110, 1, 16, 65, 68, 16, 26, 13, NULL, NULL, 25, 24, 15, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(111, 1, 16, 65, 69, 25, 25, NULL, NULL, NULL, 17, 20, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(112, 1, 16, 66, 67, 22, 21, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(113, 1, 16, 66, 68, 25, 25, NULL, NULL, NULL, 23, 23, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(114, 1, 16, 66, 69, 25, 25, NULL, NULL, NULL, 23, 12, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(115, 1, 16, 67, 68, 25, 17, 15, NULL, NULL, 13, 25, 8, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(116, 1, 16, 67, 69, 25, 25, NULL, NULL, NULL, 20, 16, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(117, 1, 16, 68, 69, 20, 25, 15, NULL, NULL, 25, 14, 11, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(118, 1, 17, 70, 71, 26, 25, NULL, NULL, NULL, 24, 17, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(119, 1, 17, 70, 72, 25, 25, NULL, NULL, NULL, 16, 15, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(120, 1, 17, 70, 73, 25, 25, NULL, NULL, NULL, 20, 13, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(121, 1, 17, 70, 74, 25, 25, NULL, NULL, NULL, 20, 15, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(122, 1, 17, 71, 72, 20, 25, 16, NULL, NULL, 25, 14, 14, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(123, 1, 17, 71, 73, 25, 24, 15, NULL, NULL, 18, 26, 9, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(124, 1, 17, 71, 74, 22, 25, 15, NULL, NULL, 25, 14, 12, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(125, 1, 17, 72, 73, 7, 0, NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(126, 1, 17, 72, 74, 25, 20, 15, NULL, NULL, 13, 25, 10, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44'),
(127, 1, 17, 73, 74, 20, 25, 15, NULL, NULL, 25, 12, 12, NULL, NULL, NULL, '2024-02-20 14:03:44', '2024-02-20 14:03:44');

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
(1, 'Torneo de prueba', 'Descripcion torneo de prueba', '2024-01-01 09:00:00', '2024-01-31 20:00:00', '2020-12-01 00:00:00', '2023-12-31 23:59:59', '2024-02-20 13:58:07', '2024-02-20 13:58:07');

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
(1, 1, 1, 1, '2024-02-20 13:58:07', '2024-02-20 14:03:44', 1, 1),
(2, 1, 1, 2, '2024-02-20 13:58:07', '2024-02-20 14:25:48', 1, 1),
(3, 1, 1, 3, '2024-02-20 13:58:07', '2024-02-20 14:25:53', 1, 1),
(4, 1, 2, 2, '2024-02-20 13:58:07', '2024-02-20 13:58:07', 0, 0),
(5, 1, 2, 3, '2024-02-20 13:58:07', '2024-02-20 13:58:07', 0, 0),
(6, 1, 2, 4, '2024-02-20 13:58:07', '2024-02-20 13:58:07', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(1, 'admin', '[]', '$2y$13$2rOsg1Sl21u/sCULfSueTeqSFaos0ZSnI1CaoJkjc0XtgZjbsTW2y');

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
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 4),
(14, 5),
(15, 5),
(16, 6),
(17, 6);


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
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 4, 14),
(15, 4, 15),
(16, 4, 16),
(17, 4, 17),
(18, 4, 18),
(19, 5, 19),
(20, 5, 20),
(21, 5, 21),
(22, 5, 22),
(23, 6, 23),
(24, 6, 24),
(25, 6, 25),
(26, 6, 26),
(27, 7, 27),
(28, 7, 28),
(29, 7, 29),
(30, 7, 30),
(31, 8, 31),
(32, 8, 32),
(33, 8, 33),
(34, 8, 34),
(35, 9, 35),
(36, 9, 36),
(37, 9, 37),
(38, 9, 38),
(39, 10, 39),
(40, 10, 40),
(41, 10, 41),
(42, 10, 42),
(43, 11, 43),
(44, 11, 44),
(45, 11, 45),
(46, 11, 46),
(47, 12, 47),
(48, 12, 48),
(49, 12, 49),
(50, 12, 50),
(51, 13, 51),
(52, 13, 52),
(53, 13, 53),
(54, 13, 54),
(55, 13, 55),
(56, 13, 56),
(57, 14, 57),
(58, 14, 58),
(59, 14, 59),
(60, 14, 60),
(61, 15, 61),
(62, 15, 62),
(63, 15, 63),
(64, 15, 64),
(65, 16, 65),
(66, 16, 66),
(67, 16, 67),
(68, 16, 68),
(69, 16, 69),
(70, 17, 70),
(71, 17, 71),
(72, 17, 72),
(73, 17, 73),
(74, 17, 74);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `torneo_genero_categoria`
--
ALTER TABLE `torneo_genero_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `zona_equipo`
--
ALTER TABLE `zona_equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
