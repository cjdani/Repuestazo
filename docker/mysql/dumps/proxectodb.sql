-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: DanielCasas-mysql
-- Tiempo de generación: 04-06-2025 a las 13:27:15
-- Versión del servidor: 8.4.5
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+02:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proxectodb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `marca` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anio` year NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desguace_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `nombre`, `descripcion`, `precio`, `marca`, `modelo`, `anio`, `categoria`, `imagen`, `desguace_id`, `created_at`, `updated_at`) VALUES
(1, 'ullam', 'Velit esse dolorem totam.', 108.74, 'Lomeli de Escobedo', 'sit', '2025', 'sed', NULL, 10, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(2, 'et', 'Eos dolores tenetur culpa recusandae saepe.', 189.48, 'Lira-Loya', 'ex', '1997', 'et', NULL, 10, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(3, 'corrupti', 'Corrupti tempore deleniti vitae debitis aut id tempore voluptas.', 200.62, 'Posada-Pedraza e Hijos', 'fugit', '2020', 'quisquam', NULL, 5, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(4, 'omnis', 'Possimus optio dolorum laudantium inventore.', 130.48, 'Air Pedroza', 'dolores', '2013', 'molestiae', NULL, 4, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(5, 'est', 'Iure nemo placeat fugiat et aut.', 113.29, 'Air Quintanilla-Villarreal', 'animi', '1989', 'vel', NULL, 6, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(6, 'eum', 'Eos in enim et enim ut dolores.', 447.83, 'Guzmán de Sandoval e Hija', 'saepe', '1972', 'velit', NULL, 1, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(7, 'eligendi', 'Doloremque et vel dolorem dolorem laudantium commodi.', 272.41, 'Armendáriz-Brito e Hijos', 'et', '1982', 'rerum', NULL, 9, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(8, 'quia', 'Ullam saepe est esse qui qui.', 168.41, 'Mireles de Perales y Asoc.', 'perspiciatis', '1991', 'placeat', NULL, 1, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(9, 'non', 'Et eos odio dicta qui quos dicta repellat aut.', 88.74, 'Ferrer, Calderón y Agosto e Hijo', 'aut', '2010', 'perferendis', NULL, 10, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(10, 'eum', 'Vel sit qui nisi error placeat ducimus.', 102.60, 'Vera-Corral e Hija', 'quibusdam', '2022', 'error', NULL, 9, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(11, 'iste', 'Sint sunt suscipit tenetur doloremque voluptates tenetur eos accusamus.', 345.63, 'Gallego y Cuesta', 'quo', '2007', 'nihil', NULL, 7, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(12, 'doloribus', 'Sunt tenetur est voluptatibus saepe ab aut dolorem.', 146.61, 'Ortega-Maya e Hijo', 'cumque', '2019', 'beatae', NULL, 9, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(13, 'consequatur', 'Est adipisci dolorum modi et doloribus explicabo temporibus suscipit.', 467.21, 'Olivo-Orellana', 'ratione', '1976', 'nesciunt', NULL, 4, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(14, 'quaerat', 'Nemo dolore exercitationem mollitia.', 22.23, 'Serna y Oliva', 'natus', '2005', 'atque', NULL, 9, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(15, 'unde', 'Ut neque vitae omnis nostrum iure aut.', 184.17, 'Cano-Berríos', 'enim', '2019', 'molestias', NULL, 6, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(16, 'sed', 'Dignissimos et molestiae commodi perspiciatis.', 461.97, 'Lucio y Rael e Hijos', 'vel', '2022', 'maxime', NULL, 6, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(17, 'officiis', 'Repellat mollitia placeat quaerat enim.', 270.47, 'Casanova, Benavídez y Bernal e Hijos', 'nostrum', '1992', 'minus', NULL, 8, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(18, 'repudiandae', 'Occaecati aut dolorem recusandae temporibus ea unde consequatur qui.', 61.06, 'Corporación Cortés', 'est', '2004', 'repellat', NULL, 10, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(19, 'distinctio', 'Dicta ex similique inventore exercitationem cumque qui eius.', 209.82, 'Candelaria de Gaona', 'eos', '1999', 'fugit', NULL, 3, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(20, 'magni', 'Vel aut possimus fugit pariatur.', 164.21, 'Ureña de Sancho y Flia.', 'adipisci', '1972', 'et', NULL, 10, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(21, 'voluptas', 'Ut sint ut ab quo aut.', 493.94, 'Urbina de Almanza S. de H.', 'sed', '1988', 'consequuntur', NULL, 10, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(22, 'et', 'Rem quia molestiae et aut vel amet illo.', 290.28, 'Adame, Saiz y Carrero SRL', 'sit', '2006', 'et', NULL, 8, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(23, 'architecto', 'Perferendis dignissimos natus et libero eum quos minus.', 202.99, 'Asociación Pastor-Valdez', 'ut', '2019', 'eum', NULL, 1, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(24, 'aut', 'Quidem quis at dicta non.', 222.78, 'Garza, Grijalva y Mesa e Hijo', 'tempore', '2013', 'molestiae', NULL, 7, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(25, 'et', 'Aut perspiciatis doloremque ut accusantium sint magnam eum.', 474.09, 'Asociación Agosto-Carrera', 'quis', '2019', 'ut', NULL, 6, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(26, 'vero', 'Quasi illo voluptas illo aut aliquam quos in voluptatem.', 125.73, 'Feliciano de Casanova', 'odit', '1972', 'dicta', NULL, 1, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(27, 'eos', 'Non voluptatem qui corporis nemo eius nemo.', 145.09, 'Empresa Mesa', 'non', '1986', 'iste', NULL, 1, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(28, 'eligendi', 'Distinctio asperiores sint consectetur reprehenderit.', 382.73, 'Grupo Gaytán', 'eaque', '2007', 'libero', NULL, 6, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(29, 'in', 'In asperiores aut aut nihil et dolorem.', 333.50, 'Gil de Arce y Flia.', 'ut', '2022', 'et', NULL, 8, '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(30, 'dolor', 'Error minima distinctio sapiente tempore perspiciatis.', 451.97, 'Bernal y Valle', 'nostrum', '1981', 'aut', NULL, 10, '2025-06-04 09:30:06', '2025-06-04 09:30:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desguaces`
--

CREATE TABLE `desguaces` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `desguaces`
--

INSERT INTO `desguaces` (`id`, `nombre`, `direccion`, `telefono`, `email`, `ciudad`, `provincia`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Grupo Benito e Hija', 'Travessera África, 895, 75º D, 98424, Lira de Lemos', '+34 989-651777', 'archuleta.naiara@godinez.net', 'L\' Clemente del Pozo', 'Camerún', NULL, '2025-06-04 09:30:05', '2025-06-04 09:30:05'),
(2, 'Figueroa y Vázquez e Hijo', 'Travessera Andrés, 16, Entre suelo 9º, 48521, Ontiveros de la Sierra', '953 11 0085', 'guillen.gonzalo@garcia.org', 'L\' Córdova de Arriba', 'Liberia', NULL, '2025-06-04 09:30:05', '2025-06-04 09:30:05'),
(3, 'Luján de Rivero', 'Paseo Delgadillo, 227, Bajos, 34105, As López de San Pedro', '+34 905-369157', 'ian63@laureano.com', 'As Andrés', 'China', NULL, '2025-06-04 09:30:05', '2025-06-04 09:30:05'),
(4, 'Solorzano-Carballo', 'Travesía Orellana, 4, 88º C, 71746, Las Sierra', '+34 933638101', 'burgos.gonzalo@delafuente.es', 'O Palacios del Mirador', 'Etiopía', NULL, '2025-06-04 09:30:05', '2025-06-04 09:30:05'),
(5, 'Empresa Tejada', 'Plaça Montemayor, 37, Bajos, 55563, La Navarro Medio', '931-68-1560', 'raul.salgado@gamboa.com', 'La Riera de la Sierra', 'Suazilandia', NULL, '2025-06-04 09:30:05', '2025-06-04 09:30:05'),
(6, 'Centro Olivares e Hijo', 'Rúa Pabón, 532, Entre suelo 1º, 00583, Las Saldaña del Bages', '931 36 1629', 'jose.cuellar@baeza.es', 'Villa Rivero de San Pedro', 'Singapur', NULL, '2025-06-04 09:30:05', '2025-06-04 09:30:05'),
(7, 'Grupo Alicea', 'Paseo Raquel, 9, 47º A, 53910, Solorio de las Torres', '+34 910977843', 'wrey@benavidez.com', 'Verdugo del Barco', 'Colombia', NULL, '2025-06-04 09:30:05', '2025-06-04 09:30:05'),
(8, 'Montoya de Armas SRL', 'Camino Mireia, 2, 46º A, 94960, Amador Alta', '989-842241', 'llerma@amaya.org', 'As Botello del Barco', 'Omán', NULL, '2025-06-04 09:30:05', '2025-06-04 09:30:05'),
(9, 'Arteaga-Otero', 'Avenida Lucas, 289, Bajo 3º, 89747, La Montemayor', '957883839', 'nbrito@paredes.com.es', 'A Vaca del Mirador', 'Nauru', NULL, '2025-06-04 09:30:05', '2025-06-04 09:30:05'),
(10, 'Orta, Ávila y De la Cruz e Hija', 'Avenida Cobo, 34, 3º B, 57377, Villa Rangel del Pozo', '+34 983-64-9669', 'marta.espinosa@deanda.com', 'Vall Delapaz', 'Sudáfrica', NULL, '2025-06-04 09:30:05', '2025-06-04 09:30:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_desguaces_table', 1),
(2, '0001_01_01_000001_create_users_table', 1),
(3, '0001_01_01_000002_create_cache_table', 1),
(4, '0001_01_01_000003_create_jobs_table', 1),
(5, '2025_06_04_081518_create_articulos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xfMCuBqb9mkgebZc33Kh1d9zJZEezFSbJnDS9bOA', NULL, '172.19.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZU4zdXVtcUlLZzlsMlhLQ3hHZmlHZGJlYW50OE9Rbm1vWlBTYkJYNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749043606);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('cliente','empleado','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente',
  `desguace_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `desguace_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '2025-06-04 09:30:05', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'admin', NULL, 'HNI6LcI7DK', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(2, 'Cliente User', 'cliente@example.com', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'cliente', NULL, 'LAZawbxIv4', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(3, 'Empleado User', 'empleado@example.com', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'empleado', 7, '8Oerb4DBE3', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(4, 'Mar Mascareñas Tercero', 'nadia.maestas@example.org', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'cliente', NULL, 'YlCMv8gS7w', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(5, 'Raquel Noriega Hijo', 'valeria31@example.net', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'cliente', NULL, 'Bhn5psFcym', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(6, 'Francisca Lerma', 'emilia03@example.net', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'empleado', 9, 'NbXEw5Qcb4', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(7, 'Ariadna Perales Segundo', 'lhurtado@example.com', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'admin', NULL, 'PKafVOpVPe', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(8, 'Sr. Aaron Ocasio Segundo', 'ogamez@example.org', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'admin', NULL, '6RkcVFtjJn', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(9, 'D. Pedro Tafoya Tercero', 'nicolas.tejada@example.com', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'cliente', NULL, 'Wc7CQMpYRP', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(10, 'Vera Rael', 'lucas47@example.net', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'empleado', 2, 'ad1AcCAU0Z', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(11, 'Silvia Gómez', 'zjurado@example.org', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'admin', NULL, '0tqJtf5gIw', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(12, 'Abril Flórez', 'vmunguia@example.com', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'admin', NULL, 'HSm3YXdKTH', '2025-06-04 09:30:06', '2025-06-04 09:30:06'),
(13, 'Berta Pedroza', 'roman.ariadna@example.com', '2025-06-04 09:30:06', '$2y$12$JcOiu51mizZOFqSfql00zOIRgDOtlCbu70bh4eY6QO/mbnK2PLiWW', 'empleado', 9, 'XStSQfefTv', '2025-06-04 09:30:06', '2025-06-04 09:30:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulos_desguace_id_foreign` (`desguace_id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `desguaces`
--
ALTER TABLE `desguaces`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_desguace_id_foreign` (`desguace_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `desguaces`
--
ALTER TABLE `desguaces`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_desguace_id_foreign` FOREIGN KEY (`desguace_id`) REFERENCES `desguaces` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_desguace_id_foreign` FOREIGN KEY (`desguace_id`) REFERENCES `desguaces` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
