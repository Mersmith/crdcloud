-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2023 a las 00:10:28
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crddb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradors`
--

CREATE TABLE `administradors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sede_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `rol` varchar(255) DEFAULT 'administrador',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `administradors`
--

INSERT INTO `administradors` (`id`, `user_id`, `sede_id`, `nombre`, `apellido`, `email`, `celular`, `rol`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Fabiola Rath', 'Dach', 'sheridan11@example.com', '(785) 504-9527', 'administrador', '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(2, 2, 5, 'Dr. Sylvester O\'Hara PhD', 'Stehr', 'margret93@example.com', '(786) 300-4148', 'administrador', '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(3, 3, 3, 'Olin Hagenes', 'Kutch', 'aniya.hoppe@example.net', '334.364.7473', 'administrador', '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(4, 4, 4, 'Elvie Walker', 'Wisoky', 'lebsack.darron@example.net', '1-720-320-8788', 'administrador', '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(5, 5, 9, 'Dereck Christiansen', 'Casper', 'bertrand.jacobson@example.net', '929.985.5279', 'administrador', '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(6, 6, 6, 'Marcelo Mraz', 'Gislason', 'cristian28@example.net', '(458) 772-5955', 'administrador', '2023-02-21 03:51:16', '2023-02-21 03:51:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canjeos`
--

CREATE TABLE `canjeos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canjeo_detalles`
--

CREATE TABLE `canjeo_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clinicas`
--

CREATE TABLE `clinicas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `especialidad_id` bigint(20) UNSIGNED NOT NULL,
  `sede_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` enum('hombre','mujer') NOT NULL,
  `puntos` int(11) DEFAULT 0,
  `ruc` varchar(255) DEFAULT NULL,
  `nombre_clinica` varchar(255) DEFAULT NULL,
  `rol` varchar(255) DEFAULT 'clinica',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clinicas`
--

INSERT INTO `clinicas` (`id`, `user_id`, `especialidad_id`, `sede_id`, `nombre`, `apellido`, `email`, `celular`, `fecha_nacimiento`, `genero`, `puntos`, `ruc`, `nombre_clinica`, `rol`, `created_at`, `updated_at`) VALUES
(1, 22, 9, 10, 'Stephanie Schultz', 'Kuhn', 'goodwin.isadore@example.com', '1-831-514-9907', '2022-12-17', 'hombre', 80, '974107', 'Minus et excepturi.', 'clinica', '2022-12-30 03:01:21', '2023-02-21 03:51:17'),
(2, 23, 27, 6, 'Mrs. Minnie Wintheiser MD', 'Kemmer', 'ransom.kreiger@example.net', '401-399-9922', '2022-11-27', 'hombre', 50, '282728', 'Aliquam ea.', 'clinica', '2022-12-27 20:19:13', '2023-02-21 03:51:17'),
(3, 24, 8, 9, 'Ebony Brekke', 'Murphy', 'gordon.murazik@example.org', '+1 (636) 704-3633', '2022-12-18', 'hombre', 500, '95', 'Illo doloremque.', 'clinica', '2023-01-03 17:40:51', '2023-02-21 03:51:17'),
(4, 25, 26, 3, 'Keshawn Haag', 'Huels', 'miller.marina@example.org', '916-867-5315', '2022-11-30', 'mujer', 500, '890525447', 'Repellat provident nostrum.', 'clinica', '2022-12-24 23:05:05', '2023-02-21 03:51:17'),
(5, 26, 7, 10, 'Miss Aylin Torp', 'Spinka', 'cecilia71@example.net', '+19304367949', '2022-12-18', 'mujer', 80, '42', 'Voluptatum sunt.', 'clinica', '2023-01-14 17:22:00', '2023-02-21 03:51:17'),
(6, 27, 16, 4, 'Mr. Orlando Oberbrunner', 'Ziemann', 'bogisich.bart@example.org', '1-276-696-9717', '2022-12-04', 'mujer', 50, '2850', 'Porro veniam.', 'clinica', '2023-01-10 22:11:21', '2023-02-21 03:51:17'),
(7, 28, 19, 7, 'Dane Schowalter', 'Graham', 'osvaldo49@example.net', '(765) 849-8865', '2022-12-17', 'mujer', 50, '606811894', 'At a facilis.', 'clinica', '2022-12-22 10:32:50', '2023-02-21 03:51:17'),
(8, 29, 15, 6, 'Prof. Colt Gorczany Jr.', 'Jenkins', 'meaghan22@example.net', '(330) 929-8161', '2022-12-01', 'hombre', 0, '891456042', 'Distinctio quidem voluptatem.', 'clinica', '2022-12-27 15:29:52', '2023-02-21 03:51:17'),
(9, 30, 5, 6, 'Jordi McKenzie', 'Ratke', 'nmraz@example.com', '+1 (541) 741-6776', '2022-12-19', 'hombre', 500, '821', 'Molestiae sed placeat.', 'clinica', '2023-01-09 21:45:53', '2023-02-21 03:51:17'),
(10, 31, 8, 8, 'Maya Sporer', 'Kautzer', 'lstark@example.org', '213-747-7527', '2022-11-23', 'hombre', 20, '7723', 'Ducimus non.', 'clinica', '2022-12-31 13:51:15', '2023-02-21 03:51:17'),
(11, 32, 17, 8, 'Jovanny Kub', 'Willms', 'rossie.morissette@example.org', '+1-763-351-3825', '2022-12-09', 'mujer', 500, '1384737', 'Ea beatae.', 'clinica', '2022-12-22 11:59:33', '2023-02-21 03:51:17'),
(12, 33, 29, 4, 'Hortense Waters', 'Weimann', 'kmosciski@example.org', '253.707.8444', '2022-12-03', 'hombre', 80, '31869', 'Iusto quia dolores.', 'clinica', '2023-01-12 21:01:06', '2023-02-21 03:51:17'),
(13, 34, 14, 2, 'Marquis Harvey', 'Powlowski', 'jesse01@example.org', '(320) 620-1069', '2022-11-27', 'hombre', 50, '63233198', 'Sint consectetur rerum.', 'clinica', '2023-01-16 04:48:56', '2023-02-21 03:51:17'),
(14, 35, 11, 3, 'Joanny Trantow', 'Marvin', 'juliana.pfannerstill@example.net', '(239) 222-7240', '2022-12-10', 'hombre', 500, '13', 'Dolorem sint.', 'clinica', '2022-12-31 20:35:56', '2023-02-21 03:51:17'),
(15, 36, 16, 2, 'Prof. Lillie Abbott', 'Zboncak', 'jana26@example.org', '(220) 340-9031', '2022-12-12', 'mujer', 70, '8', 'Sed laboriosam.', 'clinica', '2022-12-29 19:08:17', '2023-02-21 03:51:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clinica_paciente`
--

CREATE TABLE `clinica_paciente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED NOT NULL,
  `clinica_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clinica_paciente`
--

INSERT INTO `clinica_paciente` (`id`, `paciente_id`, `clinica_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, NULL, NULL),
(2, 1, 10, NULL, NULL),
(3, 2, 8, NULL, NULL),
(4, 2, 15, NULL, NULL),
(5, 3, 2, NULL, NULL),
(6, 4, 4, NULL, NULL),
(7, 5, 7, NULL, NULL),
(8, 5, 10, NULL, NULL),
(9, 6, 3, NULL, NULL),
(10, 7, 7, NULL, NULL),
(11, 7, 8, NULL, NULL),
(12, 8, 7, NULL, NULL),
(13, 9, 8, NULL, NULL),
(14, 10, 5, NULL, NULL),
(15, 10, 13, NULL, NULL),
(16, 11, 3, NULL, NULL),
(17, 11, 9, NULL, NULL),
(18, 12, 14, NULL, NULL),
(19, 13, 6, NULL, NULL),
(20, 14, 11, NULL, NULL),
(21, 14, 12, NULL, NULL),
(22, 15, 3, NULL, NULL),
(23, 15, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'AMAZONAS', NULL, NULL),
(2, 'ANCASH', NULL, NULL),
(3, 'APURIMAC', NULL, NULL),
(4, 'AREQUIPA', NULL, NULL),
(5, 'AYACUCHO', NULL, NULL),
(6, 'CAJAMARCA', NULL, NULL),
(7, 'CUSCO', NULL, NULL),
(8, 'HUANCAVELICA', NULL, NULL),
(9, 'HUANUCO', NULL, NULL),
(10, 'ICA', NULL, NULL),
(11, 'JUNIN', NULL, NULL),
(12, 'LA LIBERTAD', NULL, NULL),
(13, 'LAMBAYEQUE', NULL, NULL),
(14, 'LIMA', NULL, NULL),
(15, 'LORETO', NULL, NULL),
(16, 'MADRE DE DIOS', NULL, NULL),
(17, 'MOQUEGUA', NULL, NULL),
(18, 'PASCO', NULL, NULL),
(19, 'PIURA', NULL, NULL),
(20, 'PUNO', NULL, NULL),
(21, 'SAN MARTIN', NULL, NULL),
(22, 'TACNA', NULL, NULL),
(23, 'TUMBES', NULL, NULL),
(24, 'UCAYALI', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccions`
--

CREATE TABLE `direccions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `departamento_id` bigint(20) UNSIGNED NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `distrito_id` bigint(20) UNSIGNED NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `departamento_nombre` varchar(255) NOT NULL,
  `provincia_nombre` varchar(255) NOT NULL,
  `distrito_nombre` varchar(255) NOT NULL,
  `codigo_postal` varchar(255) DEFAULT NULL,
  `posicion` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `direccions`
--

INSERT INTO `direccions` (`id`, `user_id`, `departamento_id`, `provincia_id`, `distrito_id`, `direccion`, `referencia`, `departamento_nombre`, `provincia_nombre`, `distrito_nombre`, `codigo_postal`, `posicion`, `created_at`, `updated_at`) VALUES
(1, 7, 3, 34, 329, '846 Halvorson Estate\nNew Damienborough, ID 90130', 'Nesciunt culpa reiciendis aut quas. Placeat itaque ratione neque exercitationem. Deleniti voluptate eos sequi aut voluptates aspernatur minima. Voluptas aliquid nam officia officia nihil.', 'APURIMAC', 'GRAU', 'VIRUNDO', '85936-0478', 0, NULL, NULL),
(2, 8, 16, 146, 1478, '253 Abshire Circle\nHermistonhaven, MN 89774-2694', 'Vel aliquid voluptatem id praesentium. Impedit a mollitia doloremque ea consequatur impedit. Voluptatum ab aliquam beatae rerum. Doloribus est qui animi sit.', 'MADRE DE DIOS', 'TAMBOPATA', 'LABERINTO', '69870-5534', 0, NULL, NULL),
(3, 9, 9, 87, 887, '259 Alvah Extension Apt. 715\nLake Baby, TX 89034', 'In quis delectus et voluptatem. Molestias earum itaque fuga voluptas quis fuga. Aut dolore incidunt cum. Ullam ad et dolorem. Aliquam accusamus vitae in optio et.', 'HUANUCO', 'AMBO', 'TOMAYQUICHUA', '13326', 0, NULL, NULL),
(4, 10, 15, 143, 1469, '91889 Hoppe Mount Suite 910\nAmberhaven, AR 85140', 'Cum mollitia quam modi repellat temporibus quasi alias. Atque eos at veniam. Aut consequatur distinctio quibusdam quia.', 'LORETO', 'UCAYALI', 'VARGAS GUERRA', '58785', 0, NULL, NULL),
(5, 11, 22, 187, 1802, '32272 Hilma Motorway Suite 794\nPort Jadon, LA 12452-7167', 'Ea beatae voluptates molestiae commodi laudantium. Itaque quas natus et non cum omnis in. Velit culpa similique nesciunt et.', 'TACNA', 'TARATA', 'TARATA', '06621-6292', 0, NULL, NULL),
(6, 12, 19, 159, 1581, '8863 Schroeder Mountain Apt. 618\nPort Boydshire, PA 34219-2216', 'Aut maiores rem explicabo adipisci. Qui et optio tenetur aut aut excepturi. Placeat cumque qui illum voluptatem inventore voluptatem qui assumenda. Sit in nesciunt et vel modi et aut.', 'PIURA', 'SULLANA', 'LANCONES', '45379', 0, NULL, NULL),
(7, 13, 5, 50, 515, '36898 Stephan Overpass Apt. 056\nLake Mitchell, HI 79011-8682', 'Quia quaerat aut rem expedita sed quia nostrum cumque. Laboriosam quia ipsum officiis est. Rem odit labore iusto nemo a dolor expedita.', 'AYACUCHO', 'PAUCAR DEL SARA SARA', 'PAUSA', '85472', 0, NULL, NULL),
(8, 14, 20, 169, 1661, '764 Kunze Gateway\nLarsonland, WV 38537', 'Nihil vel voluptas sunt voluptatem dolores. Exercitationem exercitationem eligendi sed.', 'PUNO', 'PUNO', 'ACORA', '77950', 0, NULL, NULL),
(9, 15, 13, 126, 1232, '2463 Janiya Ridges\nEugeniahaven, MS 61182', 'Eum magnam optio ducimus. Temporibus id dolore quis et ex deserunt distinctio tempora. Harum et aut quia nemo libero quia.', 'LAMBAYEQUE', 'LAMBAYEQUE', 'ILLIMO', '32161', 0, NULL, NULL),
(10, 16, 23, 189, 1808, '474 Carey Mission Apt. 070\nAlexzanderville, AK 82209', 'Id dicta rem sint saepe dolor laudantium. Aut explicabo enim cumque laboriosam quasi. Et et similique quaerat consequatur et qui.', 'TUMBES', 'TUMBES', 'LA CRUZ', '45742', 0, NULL, NULL),
(11, 17, 21, 181, 1753, '741 Freida Knolls Suite 132\nSalvadorfort, NE 93069', 'Numquam vero ut omnis et numquam. Magnam in nam beatae ut quod qui fugiat. Officiis enim iste qui velit nihil aut sed. Nisi incidunt perspiciatis dolor mollitia.', 'SAN MARTIN', 'RIOJA', 'PARDO MIGUEL', '38272-8456', 0, NULL, NULL),
(12, 18, 12, 119, 1173, '229 Dooley Creek\nWest Herthachester, HI 94831', 'Quam quasi nihil modi qui accusamus neque magni. Sapiente qui beatae ut nobis laborum. Soluta sint odio non et omnis cum. Nemo saepe est sed aspernatur.', 'LA LIBERTAD', 'PATAZ', 'TAYABAMBA', '26910', 0, NULL, NULL),
(13, 19, 1, 4, 40, '64304 Delphia Rest Apt. 876\nPort Arvid, SD 40502-5010', 'Minus excepturi dignissimos ut quibusdam sapiente quisquam optio quibusdam. Soluta fugiat consequatur voluptatibus eligendi hic hic esse.', 'AMAZONAS', 'CONDORCANQUI', 'NIEVA', '20120-9434', 0, NULL, NULL),
(14, 20, 10, 101, 989, '4089 Johnson Courts Suite 036\nNorth Hector, LA 54948-0577', 'Illo natus iure suscipit a. Doloribus eum repellat distinctio voluptatem dicta. Debitis doloremque repudiandae commodi sint quos quibusdam.', 'ICA', 'PALPA', 'SANTA CRUZ', '18183', 0, NULL, NULL),
(15, 21, 1, 4, 39, '64081 Rolfson Light\nSouth Brenda, AK 63301-6545', 'Tempore facere quo odit mollitia facere. Voluptatem et dolorem aut repudiandae quos. Voluptatibus iste sed quo harum excepturi est eligendi rerum.', 'AMAZONAS', 'CONDORCANQUI', 'EL CENEPA', '65227', 0, NULL, NULL),
(16, 22, 23, 189, 1812, '9256 Stanton Dam Apt. 495\nRempelside, NJ 79635', 'Id id ea tempora aliquam explicabo adipisci pariatur. Omnis natus corporis quia repellat odit voluptatem consequatur. Dolor ut et excepturi animi esse nam odio.', 'TUMBES', 'TUMBES', 'TUMBES', '12626', 0, NULL, NULL),
(17, 23, 10, 98, 965, '15497 Bergnaum Curve Apt. 243\nSporershire, AZ 82772-1469', 'Dolores aut omnis est voluptate laborum debitis asperiores minus. Sapiente deserunt nemo ab dolor. Vitae rerum aut qui nesciunt harum odio.', 'ICA', 'CHINCHA', 'SUNAMPE', '12547-4826', 0, NULL, NULL),
(18, 24, 6, 54, 550, '448 West Via Suite 138\nWest Vallieberg, AK 59029', 'Ut quasi illo sit rerum. Aut aut perferendis sunt possimus et. Mollitia optio amet neque ipsa veritatis a. Dignissimos aperiam ea autem iusto blanditiis.', 'CAJAMARCA', 'CAJABAMBA', 'CACHACHI', '49679-5457', 0, NULL, NULL),
(19, 25, 8, 81, 797, '78891 Zoey Underpass\nPort Reaganside, MN 65097', 'Vitae maxime et harum. Vel nihil a sed sed aspernatur eos. Eos repellendus dolores hic omnis officiis explicabo. Nemo quo consectetur magnam illo.', 'HUANCAVELICA', 'ANGARAES', 'CONGALLA', '87103', 0, NULL, NULL),
(20, 26, 11, 107, 1060, '666 Medhurst Wall Apt. 011\nJerdestad, FL 72901-5150', 'Et eos provident mollitia perferendis quasi cupiditate. Non mollitia voluptatem aliquid temporibus fugit nam quod.', 'JUNIN', 'JAUJA', 'CANCHAYLLO', '10599-3743', 0, NULL, NULL),
(21, 27, 13, 125, 1225, '305 Estelle Streets\nVonborough, WV 41754', 'Veniam et sed a. Quo quisquam qui ut magni omnis mollitia. Labore quasi occaecati sed enim ut dolores. Quidem molestiae et cumque modi. Dolores omnis fugit placeat recusandae inventore.', 'LAMBAYEQUE', 'FERREÑAFE', 'CANARIS', '03918-1786', 0, NULL, NULL),
(22, 28, 6, 59, 612, '353 Fritsch Plains Suite 242\nRempelville, MT 76539-3963', 'Dolor sapiente natus excepturi et ipsam. Eos sint at maxime pariatur illum atque possimus. Dicta vitae sed incidunt excepturi ut commodi.', 'CAJAMARCA', 'CUTERVO', 'SAN ANDRES DE CUTERVO', '70936-7017', 0, NULL, NULL),
(23, 29, 21, 178, 1733, '160 Melisa Burg\nNorth Maynard, NM 43893-1784', 'Ut perferendis voluptatem deserunt optio quaerat. Alias in quos voluptates optio ullam. Maiores expedita commodi quaerat quo.', 'SAN MARTIN', 'MARISCAL CACERES', 'PAJARILLO', '07485', 0, NULL, NULL),
(24, 30, 15, 141, 1449, '71348 Bernier Knolls Suite 593\nNorth Marcelinafurt, OR 94462-5987', 'Perspiciatis nostrum deleniti non dolores quaerat nostrum in quis. Omnis fuga et minima error debitis repellat qui. Illum qui libero nemo nostrum. Ipsam dolor et dicta similique ut aut iste.', 'LORETO', 'MAYNAS', 'PUTUMAYO', '74136-6965', 0, NULL, NULL),
(25, 31, 11, 105, 1021, '8731 Gottlieb Ford Apt. 598\nWest Janyfort, UT 66709-6357', 'Adipisci voluptate vero quis cupiditate sit. Est enim qui natus et quos qui exercitationem. Quos est qui alias. Omnis dolorum placeat maiores amet libero sint tempore veniam.', 'JUNIN', 'CONCEPCION', 'MANZANARES', '48595-6780', 0, NULL, NULL),
(26, 32, 2, 12, 119, '732 Botsford Inlet Suite 105\nWest Shanna, GA 70730', 'Nostrum facilis eius deserunt est id architecto sapiente. Dicta laboriosam doloribus minima est soluta sit. Quia officia similique sit sint ad. Quo excepturi quisquam qui aut et.', 'ANCASH', 'CARHUAZ', 'SAN MIGUEL DE ACO', '29285', 0, NULL, NULL),
(27, 33, 13, 125, 1226, '134 Lebsack Path Apt. 784\nXanderland, DC 69542-0542', 'Autem sequi ea id ullam esse autem. Eveniet est amet quibusdam nesciunt iusto et odio. Ipsam fuga quia porro aperiam ipsa recusandae quasi.', 'LAMBAYEQUE', 'FERREÑAFE', 'FERRENAFE', '05944', 0, NULL, NULL),
(28, 34, 13, 126, 1231, '80840 Powlowski Stream\nSouth Guillermo, TN 45637-8358', 'Repellat rerum officiis dolore praesentium aut. Quos voluptates molestiae dolores. Temporibus aliquam eum autem. Eos accusantium vitae architecto molestiae omnis incidunt sit porro.', 'LAMBAYEQUE', 'LAMBAYEQUE', 'CHOCHOPE', '43835-6207', 0, NULL, NULL),
(29, 35, 18, 152, 1517, '6132 Oda Alley\nNew Judah, HI 51970', 'Ea dolorum quae molestiae. Ipsum est eos et eum qui. Autem fugit est veritatis repellendus explicabo et assumenda sed.', 'PASCO', 'PASCO', 'HUACHON', '67227', 0, NULL, NULL),
(30, 36, 3, 29, 275, '918 Nader Glen\nTillmanside, NE 10323', 'Id doloribus ex iste omnis omnis. Nemo ut perspiciatis voluptatibus ea beatae. Voluptate hic illo atque. Voluptas officia sit ut aut totam aut perferendis.', 'APURIMAC', 'ANDAHUAYLAS', 'TALAVERA', '65764', 0, NULL, NULL),
(31, 37, 24, 192, 1826, '766 Walker Mountains Suite 533\nNorth Brodyfurt, NY 74400', 'Velit in iure hic illum explicabo omnis repellendus. Voluptatem repellendus et ex. Voluptatem aliquam accusamus enim et sed.', 'UCAYALI', 'CORONEL PORTILLO', 'YARINACOCHA', '14081-3336', 0, NULL, NULL),
(32, 38, 15, 142, 1452, '37852 Ibrahim Squares Apt. 268\nSouth Jack, VT 00439-7532', 'Vel est provident molestiae odit eum voluptatem. Error dolorum eligendi eum porro et dolor. Totam voluptatem dolorum minus sapiente asperiores et. Voluptates vel excepturi quasi voluptatem.', 'LORETO', 'REQUENA', 'ALTO TAPICHE', '23815', 0, NULL, NULL),
(33, 39, 10, 98, 956, '9164 Purdy Lights Apt. 455\nMaciview, CT 54808-4932', 'Animi nostrum doloremque tempora nam pariatur. Soluta reiciendis molestiae perferendis iure. Exercitationem veniam omnis facere qui provident quisquam.', 'ICA', 'CHINCHA', 'ALTO LARAN', '54555-6366', 0, NULL, NULL),
(34, 40, 17, 149, 1499, '2053 Turner Gardens Apt. 929\nTerrencechester, VA 32922', 'Corrupti nulla ullam voluptates ea distinctio. Cum dolor ab voluptas ex. Id aut voluptate cupiditate ut consectetur et.', 'MOQUEGUA', 'MARISCAL NIETO', 'SAN CRISTOBAL', '34425-5329', 0, NULL, NULL),
(35, 41, 21, 176, 1714, '251 Alfonzo Lake\nGutkowskiberg, GA 59811-0214', 'Ut fugit eaque quasi. Cupiditate voluptatem in natus. Dolores et qui temporibus neque rem. Reiciendis explicabo mollitia dolorum fugit aut accusamus ut.', 'SAN MARTIN', 'HUALLAGA', 'PISCOYACU', '17767', 0, NULL, NULL),
(36, 42, 24, 192, 1825, '91037 Abigayle Dale Suite 337\nNew Gust, CT 06480', 'Et aut magni eligendi. Voluptatem ea dolorum aut ut. Ipsa aut deserunt earum nisi sint deserunt mollitia. Dicta id inventore aut ratione in nobis.', 'UCAYALI', 'CORONEL PORTILLO', 'NUEVA REQUENA', '49079', 0, NULL, NULL),
(37, 43, 5, 47, 473, '4675 Roberts Mountain Suite 148\nNorth Justynchester, VA 11786-1741', 'Facere voluptates esse magnam voluptates ea dolorem. Necessitatibus eum odit laboriosam qui sapiente ut. Eligendi et pariatur reiciendis et dignissimos aut. Qui officiis maxime alias qui est et.', 'AYACUCHO', 'LA MAR', 'AYNA', '99354', 0, NULL, NULL),
(38, 44, 5, 52, 540, '161 Meghan Track\nConstantinberg, KS 69799-2789', 'Ducimus provident nostrum ut unde nesciunt debitis exercitationem. Voluptatem itaque error voluptatem numquam esse maxime. Culpa autem hic non at quasi magnam.', 'AYACUCHO', 'VICTOR FAJARDO', 'SARHUA', '99166-4443', 0, NULL, NULL),
(39, 45, 23, 190, 1816, '903 Stokes Streets\nAdanborough, OR 76801', 'Optio animi sunt ut blanditiis porro illo ea. Nobis veritatis unde ullam sed. Eos distinctio omnis laboriosam id aut nostrum.', 'TUMBES', 'ZARUMILLA', 'ZARUMILLA', '27933-1958', 0, NULL, NULL),
(40, 46, 2, 22, 204, '865 Rigoberto Crest\nEulaliamouth, MI 74072-6167', 'Laudantium maiores modi corrupti non voluptatem maxime impedit et. Minus vitae debitis ut quis facilis est mollitia culpa. Sint possimus ut sed laborum quae aut.', 'ANCASH', 'PALLASCA', 'LLAPO', '55325-9014', 0, NULL, NULL),
(41, 47, 7, 73, 726, '256 Bailey Hollow\nGrahamchester, IN 00035-6874', 'Eius laborum consectetur dolorum suscipit ut et. Nisi deleniti nisi deleniti magni dolor excepturi. Debitis qui modi tempora.', 'CUSCO', 'CUSCO', 'CUSCO', '91791', 0, NULL, NULL),
(42, 48, 23, 188, 1806, '4783 Hassie Bypass\nBinsburgh, MA 20803-6960', 'Enim provident possimus non perspiciatis. Perspiciatis est sed non. Quisquam laudantium et aut vero. Laborum odit provident sunt.', 'TUMBES', 'CONTRALMIRANTE VILLAR', 'ZORRITOS', '49555-9635', 0, NULL, NULL),
(43, 49, 2, 12, 120, '585 Lubowitz Flat Suite 810\nChristianachester, WV 05146-1450', 'Aut placeat occaecati earum asperiores aut. Autem quaerat voluptatem in doloribus placeat. Qui asperiores nam fuga quia in omnis. Quaerat et reiciendis enim.', 'ANCASH', 'CARHUAZ', 'SHILLA', '56608-8325', 0, NULL, NULL),
(44, 50, 15, 138, 1428, '198 Alessia Port Suite 134\nEast Dianna, ID 05390', 'Consequatur tempore quasi ea dolor veniam dolores. Doloribus enim qui deserunt sunt voluptatem. Doloremque vel incidunt earum et accusamus. Sed sint voluptatem sunt quia dolorem dolorem.', 'LORETO', 'ALTO AMAZONAS', 'SANTA CRUZ', '88035', 0, NULL, NULL),
(45, 51, 17, 149, 1495, '9170 Kozey Plaza Suite 809\nNew Gladys, DE 19526-0019', 'Nesciunt assumenda sint assumenda optio reprehenderit repudiandae. Iusto quia eos harum possimus culpa dolores. Nesciunt quam ut cum exercitationem.', 'MOQUEGUA', 'MARISCAL NIETO', 'CARUMAS', '56529', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE `distritos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`id`, `provincia_id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'ARAMANGO', NULL, NULL),
(2, 1, 'COPALLIN', NULL, NULL),
(3, 1, 'EL PARCO', NULL, NULL),
(4, 1, 'IMAZA', NULL, NULL),
(5, 1, 'LA PECA', NULL, NULL),
(6, 2, 'CHISQUILLA', NULL, NULL),
(7, 2, 'CHURUJA', NULL, NULL),
(8, 2, 'COROSHA', NULL, NULL),
(9, 2, 'CUISPES', NULL, NULL),
(10, 2, 'FLORIDA', NULL, NULL),
(11, 2, 'JAZAN', NULL, NULL),
(12, 2, 'JUMBILLA', NULL, NULL),
(13, 2, 'RECTA', NULL, NULL),
(14, 2, 'SAN CARLOS', NULL, NULL),
(15, 2, 'SHIPASBAMBA', NULL, NULL),
(16, 2, 'VALERA', NULL, NULL),
(17, 2, 'YAMBRASBAMBA', NULL, NULL),
(18, 3, 'ASUNCION', NULL, NULL),
(19, 3, 'BALSAS', NULL, NULL),
(20, 3, 'CHACHAPOYAS', NULL, NULL),
(21, 3, 'CHETO', NULL, NULL),
(22, 3, 'CHILIQUIN', NULL, NULL),
(23, 3, 'CHUQUIBAMBA', NULL, NULL),
(24, 3, 'GRANADA', NULL, NULL),
(25, 3, 'HUANCAS', NULL, NULL),
(26, 3, 'LA JALCA', NULL, NULL),
(27, 3, 'LEIMEBAMBA', NULL, NULL),
(28, 3, 'LEVANTO', NULL, NULL),
(29, 3, 'MAGDALENA', NULL, NULL),
(30, 3, 'MARISCAL CASTILLA', NULL, NULL),
(31, 3, 'MOLINOPAMPA', NULL, NULL),
(32, 3, 'MONTEVIDEO', NULL, NULL),
(33, 3, 'OLLEROS', NULL, NULL),
(34, 3, 'QUINJALCA', NULL, NULL),
(35, 3, 'SAN FRANCISCO DE DAGUAS', NULL, NULL),
(36, 3, 'SAN ISIDRO DE MAINO', NULL, NULL),
(37, 3, 'SOLOCO', NULL, NULL),
(38, 3, 'SONCHE', NULL, NULL),
(39, 4, 'EL CENEPA', NULL, NULL),
(40, 4, 'NIEVA', NULL, NULL),
(41, 4, 'RIO SANTIAGO', NULL, NULL),
(42, 5, 'CAMPORREDONDO', NULL, NULL),
(43, 5, 'COCABAMBA', NULL, NULL),
(44, 5, 'COLCAMAR', NULL, NULL),
(45, 5, 'CONILA', NULL, NULL),
(46, 5, 'INGUILPATA', NULL, NULL),
(47, 5, 'LAMUD', NULL, NULL),
(48, 5, 'LONGUITA', NULL, NULL),
(49, 5, 'LONYA CHICO', NULL, NULL),
(50, 5, 'LUYA', NULL, NULL),
(51, 5, 'LUYA VIEJO', NULL, NULL),
(52, 5, 'MARIA', NULL, NULL),
(53, 5, 'OCALLI', NULL, NULL),
(54, 5, 'OCUMAL', NULL, NULL),
(55, 5, 'PISUQUIA', NULL, NULL),
(56, 5, 'PROVIDENCIA', NULL, NULL),
(57, 5, 'SAN CRISTOBAL', NULL, NULL),
(58, 5, 'SAN FRANCISCO DEL YESO', NULL, NULL),
(59, 5, 'SAN JERONIMO', NULL, NULL),
(60, 5, 'SAN JUAN DE LOPECANCHA', NULL, NULL),
(61, 5, 'SANTA CATALINA', NULL, NULL),
(62, 5, 'SANTO TOMAS', NULL, NULL),
(63, 5, 'TINGO', NULL, NULL),
(64, 5, 'TRITA', NULL, NULL),
(65, 6, 'CHIRIMOTO', NULL, NULL),
(66, 6, 'COCHAMAL', NULL, NULL),
(67, 6, 'HUAMBO', NULL, NULL),
(68, 6, 'LIMABAMBA', NULL, NULL),
(69, 6, 'LONGAR', NULL, NULL),
(70, 6, 'MARISCAL BENAVIDES', NULL, NULL),
(71, 6, 'MILPUC', NULL, NULL),
(72, 6, 'OMIA', NULL, NULL),
(73, 6, 'SAN NICOLAS', NULL, NULL),
(74, 6, 'SANTA ROSA', NULL, NULL),
(75, 6, 'TOTORA', NULL, NULL),
(76, 6, 'VISTA ALEGRE', NULL, NULL),
(77, 7, 'BAGUA GRANDE', NULL, NULL),
(78, 7, 'CAJARURO', NULL, NULL),
(79, 7, 'CUMBA', NULL, NULL),
(80, 7, 'EL MILAGRO', NULL, NULL),
(81, 7, 'JAMALCA', NULL, NULL),
(82, 7, 'LONYA GRANDE', NULL, NULL),
(83, 7, 'YAMON', NULL, NULL),
(84, 8, 'AIJA', NULL, NULL),
(85, 8, 'CORIS', NULL, NULL),
(86, 8, 'HUACLLAN', NULL, NULL),
(87, 8, 'LA MERCED', NULL, NULL),
(88, 8, 'SUCCHA', NULL, NULL),
(89, 9, 'ACZO', NULL, NULL),
(90, 9, 'CHACCHO', NULL, NULL),
(91, 9, 'CHINGAS', NULL, NULL),
(92, 9, 'LLAMELLIN', NULL, NULL),
(93, 9, 'MIRGAS', NULL, NULL),
(94, 9, 'SAN JUAN DE RONTOY', NULL, NULL),
(95, 10, 'ACOCHACA', NULL, NULL),
(96, 10, 'CHACAS', NULL, NULL),
(97, 11, 'ABELARDO PARDO LEZAMETA', NULL, NULL),
(98, 11, 'ANTONIO RAYMONDI', NULL, NULL),
(99, 11, 'AQUIA', NULL, NULL),
(100, 11, 'CAJACAY', NULL, NULL),
(101, 11, 'CANIS', NULL, NULL),
(102, 11, 'CHIQUIAN', NULL, NULL),
(103, 11, 'COLQUIOC', NULL, NULL),
(104, 11, 'HUALLANCA', NULL, NULL),
(105, 11, 'HUASTA', NULL, NULL),
(106, 11, 'HUAYLLACAYAN', NULL, NULL),
(107, 11, 'LA PRIMAVERA', NULL, NULL),
(108, 11, 'MANGAS', NULL, NULL),
(109, 11, 'PACLLON', NULL, NULL),
(110, 11, 'SAN MIGUEL DE CORPANQUI', NULL, NULL),
(111, 11, 'TICLLOS', NULL, NULL),
(112, 12, 'ACOPAMPA', NULL, NULL),
(113, 12, 'AMASHCA', NULL, NULL),
(114, 12, 'ANTA', NULL, NULL),
(115, 12, 'ATAQUERO', NULL, NULL),
(116, 12, 'CARHUAZ', NULL, NULL),
(117, 12, 'MARCARA', NULL, NULL),
(118, 12, 'PARIAHUANCA', NULL, NULL),
(119, 12, 'SAN MIGUEL DE ACO', NULL, NULL),
(120, 12, 'SHILLA', NULL, NULL),
(121, 12, 'TINCO', NULL, NULL),
(122, 12, 'YUNGAR', NULL, NULL),
(123, 13, 'SAN LUIS', NULL, NULL),
(124, 13, 'SAN NICOLAS', NULL, NULL),
(125, 13, 'YAUYA', NULL, NULL),
(126, 14, 'BUENA VISTA ALTA', NULL, NULL),
(127, 14, 'CASMA', NULL, NULL),
(128, 14, 'COMANDANTE NOEL', NULL, NULL),
(129, 14, 'YAUTAN', NULL, NULL),
(130, 15, 'ACO', NULL, NULL),
(131, 15, 'BAMBAS', NULL, NULL),
(132, 15, 'CORONGO', NULL, NULL),
(133, 15, 'CUSCA', NULL, NULL),
(134, 15, 'LA PAMPA', NULL, NULL),
(135, 15, 'YANAC', NULL, NULL),
(136, 15, 'YUPAN', NULL, NULL),
(137, 16, 'COCHABAMBA', NULL, NULL),
(138, 16, 'COLCABAMBA', NULL, NULL),
(139, 16, 'HUANCHAY', NULL, NULL),
(140, 16, 'HUARAZ', NULL, NULL),
(141, 16, 'INDEPENDENCIA', NULL, NULL),
(142, 16, 'JANGAS', NULL, NULL),
(143, 16, 'LA LIBERTAD', NULL, NULL),
(144, 16, 'OLLEROS', NULL, NULL),
(145, 16, 'PAMPAS', NULL, NULL),
(146, 16, 'PARIACOTO', NULL, NULL),
(147, 16, 'PIRA', NULL, NULL),
(148, 16, 'TARICA', NULL, NULL),
(149, 17, 'ANRA', NULL, NULL),
(150, 17, 'CAJAY', NULL, NULL),
(151, 17, 'CHAVIN DE HUANTAR', NULL, NULL),
(152, 17, 'HUACACHI', NULL, NULL),
(153, 17, 'HUACCHIS', NULL, NULL),
(154, 17, 'HUACHIS', NULL, NULL),
(155, 17, 'HUANTAR', NULL, NULL),
(156, 17, 'HUARI', NULL, NULL),
(157, 17, 'MASIN', NULL, NULL),
(158, 17, 'PAUCAS', NULL, NULL),
(159, 17, 'PONTO', NULL, NULL),
(160, 17, 'RAHUAPAMPA', NULL, NULL),
(161, 17, 'RAPAYAN', NULL, NULL),
(162, 17, 'SAN MARCOS', NULL, NULL),
(163, 17, 'SAN PEDRO DE CHANA', NULL, NULL),
(164, 17, 'UCO', NULL, NULL),
(165, 18, 'COCHAPETI', NULL, NULL),
(166, 18, 'CULEBRAS', NULL, NULL),
(167, 18, 'HUARMEY', NULL, NULL),
(168, 18, 'HUAYAN', NULL, NULL),
(169, 18, 'MALVAS', NULL, NULL),
(170, 19, 'CARAZ', NULL, NULL),
(171, 19, 'HUALLANCA', NULL, NULL),
(172, 19, 'HUATA', NULL, NULL),
(173, 19, 'HUAYLAS', NULL, NULL),
(174, 19, 'MATO', NULL, NULL),
(175, 19, 'PAMPAROMAS', NULL, NULL),
(176, 19, 'PUEBLO LIBRE', NULL, NULL),
(177, 19, 'SANTA CRUZ', NULL, NULL),
(178, 19, 'SANTO TORIBIO', NULL, NULL),
(179, 19, 'YURACMARCA', NULL, NULL),
(180, 20, 'CASCA', NULL, NULL),
(181, 20, 'ELEAZAR GUZMAN BARRON', NULL, NULL),
(182, 20, 'FIDEL OLIVAS ESCUDERO', NULL, NULL),
(183, 20, 'LLAMA', NULL, NULL),
(184, 20, 'LLUMPA', NULL, NULL),
(185, 20, 'LUCMA', NULL, NULL),
(186, 20, 'MUSGA', NULL, NULL),
(187, 20, 'PISCOBAMBA', NULL, NULL),
(188, 21, 'ACAS', NULL, NULL),
(189, 21, 'CAJAMARQUILLA', NULL, NULL),
(190, 21, 'CARHUAPAMPA', NULL, NULL),
(191, 21, 'COCHAS', NULL, NULL),
(192, 21, 'CONGAS', NULL, NULL),
(193, 21, 'LLIPA', NULL, NULL),
(194, 21, 'OCROS', NULL, NULL),
(195, 21, 'SAN CRISTOBAL DE RAJAN', NULL, NULL),
(196, 21, 'SAN PEDRO', NULL, NULL),
(197, 21, 'SANTIAGO DE CHILCAS', NULL, NULL),
(198, 22, 'BOLOGNESI', NULL, NULL),
(199, 22, 'CABANA', NULL, NULL),
(200, 22, 'CONCHUCOS', NULL, NULL),
(201, 22, 'HUACASCHUQUE', NULL, NULL),
(202, 22, 'HUANDOVAL', NULL, NULL),
(203, 22, 'LACABAMBA', NULL, NULL),
(204, 22, 'LLAPO', NULL, NULL),
(205, 22, 'PALLASCA', NULL, NULL),
(206, 22, 'PAMPAS', NULL, NULL),
(207, 22, 'SANTA ROSA', NULL, NULL),
(208, 22, 'TAUCA', NULL, NULL),
(209, 23, 'HUAYLLAN', NULL, NULL),
(210, 23, 'PAROBAMBA', NULL, NULL),
(211, 23, 'POMABAMBA', NULL, NULL),
(212, 23, 'QUINUABAMBA', NULL, NULL),
(213, 24, 'CATAC', NULL, NULL),
(214, 24, 'COTAPARACO', NULL, NULL),
(215, 24, 'HUAYLLAPAMPA', NULL, NULL),
(216, 24, 'LLACLLIN', NULL, NULL),
(217, 24, 'MARCA', NULL, NULL),
(218, 24, 'PAMPAS CHICO', NULL, NULL),
(219, 24, 'PARARIN', NULL, NULL),
(220, 24, 'RECUAY', NULL, NULL),
(221, 24, 'TAPACOCHA', NULL, NULL),
(222, 24, 'TICAPAMPA', NULL, NULL),
(223, 25, 'CACERES DEL PERU', NULL, NULL),
(224, 25, 'CHIMBOTE', NULL, NULL),
(225, 25, 'COISHCO', NULL, NULL),
(226, 25, 'MACATE', NULL, NULL),
(227, 25, 'MORO', NULL, NULL),
(228, 25, 'NEPEÑA', NULL, NULL),
(229, 25, 'NUEVO CHIMBOTE', NULL, NULL),
(230, 25, 'SAMANCO', NULL, NULL),
(231, 25, 'SANTA', NULL, NULL),
(232, 26, 'ACOBAMBA', NULL, NULL),
(233, 26, 'ALFONSO UGARTE', NULL, NULL),
(234, 26, 'CASHAPAMPA', NULL, NULL),
(235, 26, 'CHINGALPO', NULL, NULL),
(236, 26, 'HUAYLLABAMBA', NULL, NULL),
(237, 26, 'QUICHES', NULL, NULL),
(238, 26, 'RAGASH', NULL, NULL),
(239, 26, 'SAN JUAN', NULL, NULL),
(240, 26, 'SICSIBAMBA', NULL, NULL),
(241, 26, 'SIHUAS', NULL, NULL),
(242, 27, 'CASCAPARA', NULL, NULL),
(243, 27, 'MANCOS', NULL, NULL),
(244, 27, 'MATACOTO', NULL, NULL),
(245, 27, 'QUILLO', NULL, NULL),
(246, 27, 'RANRAHIRCA', NULL, NULL),
(247, 27, 'SHUPLUY', NULL, NULL),
(248, 27, 'YANAMA', NULL, NULL),
(249, 27, 'YUNGAY', NULL, NULL),
(250, 28, 'ABANCAY', NULL, NULL),
(251, 28, 'CHACOCHE', NULL, NULL),
(252, 28, 'CIRCA', NULL, NULL),
(253, 28, 'CURAHUASI', NULL, NULL),
(254, 28, 'HUANIPACA', NULL, NULL),
(255, 28, 'LAMBRAMA', NULL, NULL),
(256, 28, 'PICHIRHUA', NULL, NULL),
(257, 28, 'SAN PEDRO DE CACHORA', NULL, NULL),
(258, 28, 'TAMBURCO', NULL, NULL),
(259, 29, 'ANDAHUAYLAS', NULL, NULL),
(260, 29, 'ANDARAPA', NULL, NULL),
(261, 29, 'CHIARA', NULL, NULL),
(262, 29, 'HUANCARAMA', NULL, NULL),
(263, 29, 'HUANCARAY', NULL, NULL),
(264, 29, 'HUAYANA', NULL, NULL),
(265, 29, 'KAQUIABAMBA', NULL, NULL),
(266, 29, 'KISHUARA', NULL, NULL),
(267, 29, 'PACOBAMBA', NULL, NULL),
(268, 29, 'PACUCHA', NULL, NULL),
(269, 29, 'PAMPACHIRI', NULL, NULL),
(270, 29, 'POMACOCHA', NULL, NULL),
(271, 29, 'SAN ANTONIO DE CACHI', NULL, NULL),
(272, 29, 'SAN JERONIMO', NULL, NULL),
(273, 29, 'SAN MIGUEL DE CHACCRAMPA', NULL, NULL),
(274, 29, 'SANTA MARIA DE CHICMO', NULL, NULL),
(275, 29, 'TALAVERA', NULL, NULL),
(276, 29, 'TUMAY HUARACA', NULL, NULL),
(277, 29, 'TURPO', NULL, NULL),
(278, 30, 'ANTABAMBA', NULL, NULL),
(279, 30, 'EL ORO', NULL, NULL),
(280, 30, 'HUAQUIRCA', NULL, NULL),
(281, 30, 'JUAN ESPINOZA MEDRANO', NULL, NULL),
(282, 30, 'OROPESA', NULL, NULL),
(283, 30, 'PACHACONAS', NULL, NULL),
(284, 30, 'SABAINO', NULL, NULL),
(285, 31, 'CAPAYA', NULL, NULL),
(286, 31, 'CARAYBAMBA', NULL, NULL),
(287, 31, 'CHALHUANCA', NULL, NULL),
(288, 31, 'CHAPIMARCA', NULL, NULL),
(289, 31, 'COLCABAMBA', NULL, NULL),
(290, 31, 'COTARUSE', NULL, NULL),
(291, 31, 'HUAYLLO', NULL, NULL),
(292, 31, 'JUSTO APU SAHUARAURA', NULL, NULL),
(293, 31, 'LUCRE', NULL, NULL),
(294, 31, 'POCOHUANCA', NULL, NULL),
(295, 31, 'SAN JUAN DE CHACÑA', NULL, NULL),
(296, 31, 'SAÑAYCA', NULL, NULL),
(297, 31, 'SORAYA', NULL, NULL),
(298, 31, 'TAPAIRIHUA', NULL, NULL),
(299, 31, 'TINTAY', NULL, NULL),
(300, 31, 'TORAYA', NULL, NULL),
(301, 31, 'YANACA', NULL, NULL),
(302, 32, 'ANCO-HUALLO', NULL, NULL),
(303, 32, 'CHINCHEROS', NULL, NULL),
(304, 32, 'COCHARCAS', NULL, NULL),
(305, 32, 'HUACCANA', NULL, NULL),
(306, 32, 'OCOBAMBA', NULL, NULL),
(307, 32, 'ONGOY', NULL, NULL),
(308, 32, 'RANRACANCHA', NULL, NULL),
(309, 32, 'URANMARCA', NULL, NULL),
(310, 33, 'CHALLHUAHUACHO', NULL, NULL),
(311, 33, 'COTABAMBAS', NULL, NULL),
(312, 33, 'COYLLURQUI', NULL, NULL),
(313, 33, 'HAQUIRA', NULL, NULL),
(314, 33, 'MARA', NULL, NULL),
(315, 33, 'TAMBOBAMBA', NULL, NULL),
(316, 34, 'CHUQUIBAMBILLA', NULL, NULL),
(317, 34, 'CURASCO', NULL, NULL),
(318, 34, 'CURPAHUASI', NULL, NULL),
(319, 34, 'GAMARRA', NULL, NULL),
(320, 34, 'HUAYLLATI', NULL, NULL),
(321, 34, 'MAMARA', NULL, NULL),
(322, 34, 'MICAELA BASTIDAS', NULL, NULL),
(323, 34, 'PATAYPAMPA', NULL, NULL),
(324, 34, 'PROGRESO', NULL, NULL),
(325, 34, 'SAN ANTONIO', NULL, NULL),
(326, 34, 'SANTA ROSA', NULL, NULL),
(327, 34, 'TURPAY', NULL, NULL),
(328, 34, 'VILCABAMBA', NULL, NULL),
(329, 34, 'VIRUNDO', NULL, NULL),
(330, 35, 'ALTO SELVA ALEGRE', NULL, NULL),
(331, 35, 'AREQUIPA', NULL, NULL),
(332, 35, 'CAYMA', NULL, NULL),
(333, 35, 'CERRO COLORADO', NULL, NULL),
(334, 35, 'CHARACATO', NULL, NULL),
(335, 35, 'CHIGUATA', NULL, NULL),
(336, 35, 'JACOBO HUNTER', NULL, NULL),
(337, 35, 'JOSE LUIS BUSTAMANTE Y RIVERO', NULL, NULL),
(338, 35, 'LA JOYA', NULL, NULL),
(339, 35, 'MARIANO MELGAR', NULL, NULL),
(340, 35, 'MIRAFLORES', NULL, NULL),
(341, 35, 'MOLLEBAYA', NULL, NULL),
(342, 35, 'PAUCARPATA', NULL, NULL),
(343, 35, 'POCSI', NULL, NULL),
(344, 35, 'POLOBAYA', NULL, NULL),
(345, 35, 'QUEQUEÑA', NULL, NULL),
(346, 35, 'SABANDIA', NULL, NULL),
(347, 35, 'SACHACA', NULL, NULL),
(348, 35, 'SAN JUAN DE SIGUAS', NULL, NULL),
(349, 35, 'SAN JUAN DE TARUCANI', NULL, NULL),
(350, 35, 'SANTA ISABEL DE SIGUAS', NULL, NULL),
(351, 35, 'SANTA RITA DE SIGUAS', NULL, NULL),
(352, 35, 'SOCABAYA', NULL, NULL),
(353, 35, 'TIABAYA', NULL, NULL),
(354, 35, 'UCHUMAYO', NULL, NULL),
(355, 35, 'VITOR  1/', NULL, NULL),
(356, 35, 'YANAHUARA', NULL, NULL),
(357, 35, 'YARABAMBA', NULL, NULL),
(358, 35, 'YURA', NULL, NULL),
(359, 36, 'CAMANA', NULL, NULL),
(360, 36, 'JOSE MARIA QUIMPER', NULL, NULL),
(361, 36, 'MARIANO NICOLAS VALCARCEL', NULL, NULL),
(362, 36, 'MARISCAL CACERES', NULL, NULL),
(363, 36, 'NICOLAS DE PIEROLA', NULL, NULL),
(364, 36, 'OCOÑA', NULL, NULL),
(365, 36, 'QUILCA', NULL, NULL),
(366, 36, 'SAMUEL PASTOR', NULL, NULL),
(367, 37, 'ACARI', NULL, NULL),
(368, 37, 'ATICO', NULL, NULL),
(369, 37, 'ATIQUIPA', NULL, NULL),
(370, 37, 'BELLA UNION', NULL, NULL),
(371, 37, 'CAHUACHO', NULL, NULL),
(372, 37, 'CARAVELI', NULL, NULL),
(373, 37, 'CHALA', NULL, NULL),
(374, 37, 'CHAPARRA', NULL, NULL),
(375, 37, 'HUANUHUANU', NULL, NULL),
(376, 37, 'JAQUI', NULL, NULL),
(377, 37, 'LOMAS', NULL, NULL),
(378, 37, 'QUICACHA', NULL, NULL),
(379, 37, 'YAUCA', NULL, NULL),
(380, 38, 'ANDAGUA', NULL, NULL),
(381, 38, 'APLAO', NULL, NULL),
(382, 38, 'AYO', NULL, NULL),
(383, 38, 'CHACHAS', NULL, NULL),
(384, 38, 'CHILCAYMARCA', NULL, NULL),
(385, 38, 'CHOCO', NULL, NULL),
(386, 38, 'HUANCARQUI', NULL, NULL),
(387, 38, 'MACHAGUAY', NULL, NULL),
(388, 38, 'ORCOPAMPA', NULL, NULL),
(389, 38, 'PAMPACOLCA', NULL, NULL),
(390, 38, 'TIPAN', NULL, NULL),
(391, 38, 'UÑON', NULL, NULL),
(392, 38, 'URACA', NULL, NULL),
(393, 38, 'VIRACO', NULL, NULL),
(394, 39, 'ACHOMA', NULL, NULL),
(395, 39, 'CABANACONDE', NULL, NULL),
(396, 39, 'CALLALLI', NULL, NULL),
(397, 39, 'CAYLLOMA', NULL, NULL),
(398, 39, 'CHIVAY', NULL, NULL),
(399, 39, 'COPORAQUE', NULL, NULL),
(400, 39, 'HUAMBO', NULL, NULL),
(401, 39, 'HUANCA', NULL, NULL),
(402, 39, 'ICHUPAMPA', NULL, NULL),
(403, 39, 'LARI', NULL, NULL),
(404, 39, 'LLUTA', NULL, NULL),
(405, 39, 'MACA', NULL, NULL),
(406, 39, 'MADRIGAL', NULL, NULL),
(407, 39, 'MAJES', NULL, NULL),
(408, 39, 'SAN ANTONIO DE CHUCA', NULL, NULL),
(409, 39, 'SIBAYO', NULL, NULL),
(410, 39, 'TAPAY', NULL, NULL),
(411, 39, 'TISCO', NULL, NULL),
(412, 39, 'TUTI', NULL, NULL),
(413, 39, 'YANQUE', NULL, NULL),
(414, 40, 'ANDARAY', NULL, NULL),
(415, 40, 'CAYARANI', NULL, NULL),
(416, 40, 'CHICHAS', NULL, NULL),
(417, 40, 'CHUQUIBAMBA', NULL, NULL),
(418, 40, 'IRAY', NULL, NULL),
(419, 40, 'RIO GRANDE', NULL, NULL),
(420, 40, 'SALAMANCA', NULL, NULL),
(421, 40, 'YANAQUIHUA', NULL, NULL),
(422, 41, 'COCACHACRA', NULL, NULL),
(423, 41, 'DEAN VALDIVIA', NULL, NULL),
(424, 41, 'ISLAY', NULL, NULL),
(425, 41, 'MEJIA', NULL, NULL),
(426, 41, 'MOLLENDO', NULL, NULL),
(427, 41, 'PUNTA DE BOMBON', NULL, NULL),
(428, 42, 'ALCA', NULL, NULL),
(429, 42, 'CHARCANA', NULL, NULL),
(430, 42, 'COTAHUASI', NULL, NULL),
(431, 42, 'HUAYNACOTAS', NULL, NULL),
(432, 42, 'PAMPAMARCA', NULL, NULL),
(433, 42, 'PUYCA', NULL, NULL),
(434, 42, 'QUECHUALLA', NULL, NULL),
(435, 42, 'SAYLA', NULL, NULL),
(436, 42, 'TAURIA', NULL, NULL),
(437, 42, 'TOMEPAMPA', NULL, NULL),
(438, 42, 'TORO', NULL, NULL),
(439, 43, 'CANGALLO', NULL, NULL),
(440, 43, 'CHUSCHI', NULL, NULL),
(441, 43, 'LOS MOROCHUCOS', NULL, NULL),
(442, 43, 'MARIA PARADO DE BELLIDO', NULL, NULL),
(443, 43, 'PARAS', NULL, NULL),
(444, 43, 'TOTOS', NULL, NULL),
(445, 44, 'ACOCRO', NULL, NULL),
(446, 44, 'ACOS VINCHOS', NULL, NULL),
(447, 44, 'AYACUCHO', NULL, NULL),
(448, 44, 'CARMEN ALTO', NULL, NULL),
(449, 44, 'CHIARA', NULL, NULL),
(450, 44, 'JESUS NAZARENO', NULL, NULL),
(451, 44, 'OCROS', NULL, NULL),
(452, 44, 'PACAYCASA', NULL, NULL),
(453, 44, 'QUINUA', NULL, NULL),
(454, 44, 'SAN JOSE DE TICLLAS', NULL, NULL),
(455, 44, 'SAN JUAN BAUTISTA', NULL, NULL),
(456, 44, 'SANTIAGO DE PISCHA', NULL, NULL),
(457, 44, 'SOCOS', NULL, NULL),
(458, 44, 'TAMBILLO', NULL, NULL),
(459, 44, 'VINCHOS', NULL, NULL),
(460, 45, 'CARAPO', NULL, NULL),
(461, 45, 'SACSAMARCA', NULL, NULL),
(462, 45, 'SANCOS', NULL, NULL),
(463, 45, 'SANTIAGO DE LUCANAMARCA', NULL, NULL),
(464, 46, 'AYAHUANCO', NULL, NULL),
(465, 46, 'HUAMANGUILLA', NULL, NULL),
(466, 46, 'HUANTA', NULL, NULL),
(467, 46, 'IGUAIN', NULL, NULL),
(468, 46, 'LLOCHEGUA', NULL, NULL),
(469, 46, 'LURICOCHA', NULL, NULL),
(470, 46, 'SANTILLANA', NULL, NULL),
(471, 46, 'SIVIA', NULL, NULL),
(472, 47, 'ANCO', NULL, NULL),
(473, 47, 'AYNA', NULL, NULL),
(474, 47, 'CHILCAS', NULL, NULL),
(475, 47, 'CHUNGUI', NULL, NULL),
(476, 47, 'LUIS CARRANZA', NULL, NULL),
(477, 47, 'SAN MIGUEL', NULL, NULL),
(478, 47, 'SANTA ROSA', NULL, NULL),
(479, 47, 'TAMBO', NULL, NULL),
(480, 48, 'AUCARA', NULL, NULL),
(481, 48, 'CABANA', NULL, NULL),
(482, 48, 'CARMEN SALCEDO', NULL, NULL),
(483, 48, 'CHAVIÑA', NULL, NULL),
(484, 48, 'CHIPAO', NULL, NULL),
(485, 48, 'HUAC-HUAS', NULL, NULL),
(486, 48, 'LARAMATE', NULL, NULL),
(487, 48, 'LEONCIO PRADO', NULL, NULL),
(488, 48, 'LLAUTA', NULL, NULL),
(489, 48, 'LUCANAS', NULL, NULL),
(490, 48, 'OCAÑA', NULL, NULL),
(491, 48, 'OTOCA', NULL, NULL),
(492, 48, 'PUQUIO', NULL, NULL),
(493, 48, 'SAISA', NULL, NULL),
(494, 48, 'SAN CRISTOBAL', NULL, NULL),
(495, 48, 'SAN JUAN', NULL, NULL),
(496, 48, 'SAN PEDRO', NULL, NULL),
(497, 48, 'SAN PEDRO DE PALCO', NULL, NULL),
(498, 48, 'SANCOS', NULL, NULL),
(499, 48, 'SANTA ANA DE HUAYCAHUACHO', NULL, NULL),
(500, 48, 'SANTA LUCIA', NULL, NULL),
(501, 49, 'CHUMPI', NULL, NULL),
(502, 49, 'CORACORA', NULL, NULL),
(503, 49, 'CORONEL CASTAÑEDA', NULL, NULL),
(504, 49, 'PACAPAUSA', NULL, NULL),
(505, 49, 'PULLO', NULL, NULL),
(506, 49, 'PUYUSCA', NULL, NULL),
(507, 49, 'SAN FRANCISCO DE RAVACAYCO', NULL, NULL),
(508, 49, 'UPAHUACHO', NULL, NULL),
(509, 50, 'COLTA', NULL, NULL),
(510, 50, 'CORCULLA', NULL, NULL),
(511, 50, 'LAMPA', NULL, NULL),
(512, 50, 'MARCABAMBA', NULL, NULL),
(513, 50, 'OYOLO', NULL, NULL),
(514, 50, 'PARARCA', NULL, NULL),
(515, 50, 'PAUSA', NULL, NULL),
(516, 50, 'SAN JAVIER DE ALPABAMBA', NULL, NULL),
(517, 50, 'SAN JOSE DE USHUA', NULL, NULL),
(518, 50, 'SARA SARA', NULL, NULL),
(519, 51, 'BELEN', NULL, NULL),
(520, 51, 'CHALCOS', NULL, NULL),
(521, 51, 'CHILCAYOC', NULL, NULL),
(522, 51, 'HUACAÑA', NULL, NULL),
(523, 51, 'MORCOLLA', NULL, NULL),
(524, 51, 'PAICO', NULL, NULL),
(525, 51, 'QUEROBAMBA', NULL, NULL),
(526, 51, 'SAN PEDRO DE LARCAY', NULL, NULL),
(527, 51, 'SAN SALVADOR DE QUIJE', NULL, NULL),
(528, 51, 'SANTIAGO DE PAUCARAY', NULL, NULL),
(529, 51, 'SORAS', NULL, NULL),
(530, 52, 'ALCAMENCA', NULL, NULL),
(531, 52, 'APONGO', NULL, NULL),
(532, 52, 'ASQUIPATA', NULL, NULL),
(533, 52, 'CANARIA', NULL, NULL),
(534, 52, 'CAYARA', NULL, NULL),
(535, 52, 'COLCA', NULL, NULL),
(536, 52, 'HUAMANQUIQUIA', NULL, NULL),
(537, 52, 'HUANCAPI', NULL, NULL),
(538, 52, 'HUANCARAYLLA', NULL, NULL),
(539, 52, 'HUAYA', NULL, NULL),
(540, 52, 'SARHUA', NULL, NULL),
(541, 52, 'VILCANCHOS', NULL, NULL),
(542, 53, 'ACCOMARCA', NULL, NULL),
(543, 53, 'CARHUANCA', NULL, NULL),
(544, 53, 'CONCEPCION', NULL, NULL),
(545, 53, 'HUAMBALPA', NULL, NULL),
(546, 53, 'INDEPENDENCIA', NULL, NULL),
(547, 53, 'SAURAMA', NULL, NULL),
(548, 53, 'VILCAS HUAMAN', NULL, NULL),
(549, 53, 'VISCHONGO', NULL, NULL),
(550, 54, 'CACHACHI', NULL, NULL),
(551, 54, 'CAJABAMBA', NULL, NULL),
(552, 54, 'CONDEBAMBA', NULL, NULL),
(553, 54, 'SITACOCHA', NULL, NULL),
(554, 55, 'ASUNCION', NULL, NULL),
(555, 55, 'CAJAMARCA', NULL, NULL),
(556, 55, 'CHETILLA', NULL, NULL),
(557, 55, 'COSPAN', NULL, NULL),
(558, 55, 'ENCAÑADA', NULL, NULL),
(559, 55, 'JESUS', NULL, NULL),
(560, 55, 'LLACANORA', NULL, NULL),
(561, 55, 'LOS BAÑOS DEL INCA', NULL, NULL),
(562, 55, 'MAGDALENA', NULL, NULL),
(563, 55, 'MATARA', NULL, NULL),
(564, 55, 'NAMORA', NULL, NULL),
(565, 55, 'SAN JUAN', NULL, NULL),
(566, 56, 'CELENDIN', NULL, NULL),
(567, 56, 'CHUMUCH', NULL, NULL),
(568, 56, 'CORTEGANA', NULL, NULL),
(569, 56, 'HUASMIN', NULL, NULL),
(570, 56, 'JORGE CHAVEZ', NULL, NULL),
(571, 56, 'JOSE GALVEZ', NULL, NULL),
(572, 56, 'LA LIBERTAD DE PALLAN', NULL, NULL),
(573, 56, 'MIGUEL IGLESIAS', NULL, NULL),
(574, 56, 'OXAMARCA', NULL, NULL),
(575, 56, 'SOROCHUCO', NULL, NULL),
(576, 56, 'SUCRE', NULL, NULL),
(577, 56, 'UTCO', NULL, NULL),
(578, 57, 'ANGUIA', NULL, NULL),
(579, 57, 'CHADIN', NULL, NULL),
(580, 57, 'CHALAMARCA', NULL, NULL),
(581, 57, 'CHIGUIRIP', NULL, NULL),
(582, 57, 'CHIMBAN', NULL, NULL),
(583, 57, 'CHOROPAMPA', NULL, NULL),
(584, 57, 'CHOTA', NULL, NULL),
(585, 57, 'COCHABAMBA', NULL, NULL),
(586, 57, 'CONCHAN', NULL, NULL),
(587, 57, 'HUAMBOS', NULL, NULL),
(588, 57, 'LAJAS', NULL, NULL),
(589, 57, 'LLAMA', NULL, NULL),
(590, 57, 'MIRACOSTA', NULL, NULL),
(591, 57, 'PACCHA', NULL, NULL),
(592, 57, 'PION', NULL, NULL),
(593, 57, 'QUEROCOTO', NULL, NULL),
(594, 57, 'SAN JUAN DE LICUPIS', NULL, NULL),
(595, 57, 'TACABAMBA', NULL, NULL),
(596, 57, 'TOCMOCHE', NULL, NULL),
(597, 58, 'CHILETE', NULL, NULL),
(598, 58, 'CONTUMAZA', NULL, NULL),
(599, 58, 'CUPISNIQUE', NULL, NULL),
(600, 58, 'GUZMANGO', NULL, NULL),
(601, 58, 'SAN BENITO', NULL, NULL),
(602, 58, 'SANTA CRUZ DE TOLEDO', NULL, NULL),
(603, 58, 'TANTARICA', NULL, NULL),
(604, 58, 'YONAN', NULL, NULL),
(605, 59, 'CALLAYUC', NULL, NULL),
(606, 59, 'CHOROS', NULL, NULL),
(607, 59, 'CUJILLO', NULL, NULL),
(608, 59, 'CUTERVO', NULL, NULL),
(609, 59, 'LA RAMADA', NULL, NULL),
(610, 59, 'PIMPINGOS', NULL, NULL),
(611, 59, 'QUEROCOTILLO', NULL, NULL),
(612, 59, 'SAN ANDRES DE CUTERVO', NULL, NULL),
(613, 59, 'SAN JUAN DE CUTERVO', NULL, NULL),
(614, 59, 'SAN LUIS DE LUCMA', NULL, NULL),
(615, 59, 'SANTA CRUZ', NULL, NULL),
(616, 59, 'SANTO TOMAS', NULL, NULL),
(617, 59, 'SOCOTA', NULL, NULL),
(618, 59, 'STO. DOMINGO DE LA CAPILLA', NULL, NULL),
(619, 59, 'TORIBIO CASANOVA', NULL, NULL),
(620, 60, 'BAMBAMARCA', NULL, NULL),
(621, 60, 'CHUGUR', NULL, NULL),
(622, 60, 'HUALGAYOC', NULL, NULL),
(623, 61, 'BELLAVISTA', NULL, NULL),
(624, 61, 'CHONTALI', NULL, NULL),
(625, 61, 'COLASAY', NULL, NULL),
(626, 61, 'HUABAL', NULL, NULL),
(627, 61, 'JAEN', NULL, NULL),
(628, 61, 'LAS PIRIAS', NULL, NULL),
(629, 61, 'POMAHUACA', NULL, NULL),
(630, 61, 'PUCARA', NULL, NULL),
(631, 61, 'SALLIQUE', NULL, NULL),
(632, 61, 'SAN FELIPE', NULL, NULL),
(633, 61, 'SAN JOSE DEL ALTO', NULL, NULL),
(634, 61, 'SANTA ROSA', NULL, NULL),
(635, 62, 'CHIRINOS', NULL, NULL),
(636, 62, 'HUARANGO', NULL, NULL),
(637, 62, 'LA COIPA', NULL, NULL),
(638, 62, 'NAMBALLE', NULL, NULL),
(639, 62, 'SAN IGNACIO', NULL, NULL),
(640, 62, 'SAN JOSE DE LOURDES', NULL, NULL),
(641, 62, 'TABACONAS', NULL, NULL),
(642, 63, 'CHANCAY', NULL, NULL),
(643, 63, 'EDUARDO VILLANUEVA', NULL, NULL),
(644, 63, 'GREGORIO PITA', NULL, NULL),
(645, 63, 'ICHOCAN', NULL, NULL),
(646, 63, 'JOSE MANUEL QUIROZ', NULL, NULL),
(647, 63, 'JOSE SABOGAL', NULL, NULL),
(648, 63, 'PEDRO GALVEZ', NULL, NULL),
(649, 64, 'BOLIVAR', NULL, NULL),
(650, 64, 'CALQUIS', NULL, NULL),
(651, 64, 'CATILLUC', NULL, NULL),
(652, 64, 'EL PRADO', NULL, NULL),
(653, 64, 'LA FLORIDA', NULL, NULL),
(654, 64, 'LLAPA', NULL, NULL),
(655, 64, 'NANCHOC', NULL, NULL),
(656, 64, 'NIEPOS', NULL, NULL),
(657, 64, 'SAN GREGORIO', NULL, NULL),
(658, 64, 'SAN MIGUEL', NULL, NULL),
(659, 64, 'SAN SILVESTRE DE COCHAN', NULL, NULL),
(660, 64, 'TONGOD', NULL, NULL),
(661, 64, 'UNION AGUA BLANCA', NULL, NULL),
(662, 65, 'SAN BERNARDINO', NULL, NULL),
(663, 65, 'SAN LUIS', NULL, NULL),
(664, 65, 'SAN PABLO', NULL, NULL),
(665, 65, 'TUMBADEN', NULL, NULL),
(666, 66, 'ANDABAMBA', NULL, NULL),
(667, 66, 'CATACHE', NULL, NULL),
(668, 66, 'CHANCAYBAÑOS', NULL, NULL),
(669, 66, 'LA ESPERANZA', NULL, NULL),
(670, 66, 'NINABAMBA', NULL, NULL),
(671, 66, 'PULAN', NULL, NULL),
(672, 66, 'SANTA CRUZ', NULL, NULL),
(673, 66, 'SAUCEPAMPA', NULL, NULL),
(674, 66, 'SEXI', NULL, NULL),
(675, 66, 'UTICYACU', NULL, NULL),
(676, 66, 'YAUYUCAN', NULL, NULL),
(677, 67, 'ACOMAYO', NULL, NULL),
(678, 67, 'ACOPIA', NULL, NULL),
(679, 67, 'ACOS', NULL, NULL),
(680, 67, 'MOSOC LLACTA', NULL, NULL),
(681, 67, 'POMACANCHI', NULL, NULL),
(682, 67, 'RONDOCAN', NULL, NULL),
(683, 67, 'SANGARARA', NULL, NULL),
(684, 68, 'ANCAHUASI', NULL, NULL),
(685, 68, 'ANTA', NULL, NULL),
(686, 68, 'CACHIMAYO', NULL, NULL),
(687, 68, 'CHINCHAYPUJIO', NULL, NULL),
(688, 68, 'HUAROCONDO', NULL, NULL),
(689, 68, 'LIMATAMBO', NULL, NULL),
(690, 68, 'MOLLEPATA', NULL, NULL),
(691, 68, 'PUCYURA', NULL, NULL),
(692, 68, 'ZURITE', NULL, NULL),
(693, 69, 'CALCA', NULL, NULL),
(694, 69, 'COYA', NULL, NULL),
(695, 69, 'LAMAY', NULL, NULL),
(696, 69, 'LARES', NULL, NULL),
(697, 69, 'PISAC', NULL, NULL),
(698, 69, 'SAN SALVADOR', NULL, NULL),
(699, 69, 'TARAY', NULL, NULL),
(700, 69, 'YANATILE', NULL, NULL),
(701, 70, 'CHECCA', NULL, NULL),
(702, 70, 'KUNTURKANKI', NULL, NULL),
(703, 70, 'LANGUI', NULL, NULL),
(704, 70, 'LAYO', NULL, NULL),
(705, 70, 'PAMPAMARCA', NULL, NULL),
(706, 70, 'QUEHUE', NULL, NULL),
(707, 70, 'TUPAC AMARU', NULL, NULL),
(708, 70, 'YANAOCA', NULL, NULL),
(709, 71, 'CHECACUPE', NULL, NULL),
(710, 71, 'COMBAPATA', NULL, NULL),
(711, 71, 'MARANGANI', NULL, NULL),
(712, 71, 'PITUMARCA', NULL, NULL),
(713, 71, 'SAN PABLO', NULL, NULL),
(714, 71, 'SAN PEDRO', NULL, NULL),
(715, 71, 'SICUANI', NULL, NULL),
(716, 71, 'TINTA', NULL, NULL),
(717, 72, 'CAPACMARCA', NULL, NULL),
(718, 72, 'CHAMACA', NULL, NULL),
(719, 72, 'COLQUEMARCA', NULL, NULL),
(720, 72, 'LIVITACA', NULL, NULL),
(721, 72, 'LLUSCO', NULL, NULL),
(722, 72, 'QUIÑOTA', NULL, NULL),
(723, 72, 'SANTO TOMAS', NULL, NULL),
(724, 72, 'VELILLE', NULL, NULL),
(725, 73, 'CCORCA', NULL, NULL),
(726, 73, 'CUSCO', NULL, NULL),
(727, 73, 'POROY', NULL, NULL),
(728, 73, 'SAN JERONIMO', NULL, NULL),
(729, 73, 'SAN SEBASTIAN', NULL, NULL),
(730, 73, 'SANTIAGO', NULL, NULL),
(731, 73, 'SAYLLA', NULL, NULL),
(732, 73, 'WANCHAQ', NULL, NULL),
(733, 74, 'ALTO PICHIGUA', NULL, NULL),
(734, 74, 'CONDOROMA', NULL, NULL),
(735, 74, 'COPORAQUE', NULL, NULL),
(736, 74, 'ESPINAR', NULL, NULL),
(737, 74, 'OCORURO', NULL, NULL),
(738, 74, 'PALLPATA', NULL, NULL),
(739, 74, 'PICHIGUA', NULL, NULL),
(740, 74, 'SUYCKUTAMBO', NULL, NULL),
(741, 75, 'ECHARATE', NULL, NULL),
(742, 75, 'HUAYOPATA', NULL, NULL),
(743, 75, 'MARANURA', NULL, NULL),
(744, 75, 'OCOBAMBA', NULL, NULL),
(745, 75, 'PICHARI', NULL, NULL),
(746, 75, 'QUELLOUNO', NULL, NULL),
(747, 75, 'QUIMBIRI', NULL, NULL),
(748, 75, 'SANTA ANA', NULL, NULL),
(749, 75, 'SANTA TERESA', NULL, NULL),
(750, 75, 'VILCABAMBA', NULL, NULL),
(751, 76, 'ACCHA', NULL, NULL),
(752, 76, 'CCAPI', NULL, NULL),
(753, 76, 'COLCHA', NULL, NULL),
(754, 76, 'HUANOQUITE', NULL, NULL),
(755, 76, 'OMACHA', NULL, NULL),
(756, 76, 'PACCARITAMBO', NULL, NULL),
(757, 76, 'PARURO', NULL, NULL),
(758, 76, 'PILLPINTO', NULL, NULL),
(759, 76, 'YAURISQUE', NULL, NULL),
(760, 77, 'CAICAY', NULL, NULL),
(761, 77, 'CHALLABAMBA', NULL, NULL),
(762, 77, 'COLQUEPATA', NULL, NULL),
(763, 77, 'HUANCARANI', NULL, NULL),
(764, 77, 'KOSÑIPATA', NULL, NULL),
(765, 77, 'PAUCARTAMBO', NULL, NULL),
(766, 78, 'ANDAHUAYLILLAS', NULL, NULL),
(767, 78, 'CAMANTI', NULL, NULL),
(768, 78, 'CCARHUAYO', NULL, NULL),
(769, 78, 'CCATCA', NULL, NULL),
(770, 78, 'CUSIPATA', NULL, NULL),
(771, 78, 'HUARO', NULL, NULL),
(772, 78, 'LUCRE', NULL, NULL),
(773, 78, 'MARCAPATA', NULL, NULL),
(774, 78, 'OCONGATE', NULL, NULL),
(775, 78, 'OROPESA', NULL, NULL),
(776, 78, 'QUIQUIJANA', NULL, NULL),
(777, 78, 'URCOS', NULL, NULL),
(778, 79, 'CHINCHERO', NULL, NULL),
(779, 79, 'HUAYLLABAMBA', NULL, NULL),
(780, 79, 'MACHUPICCHU', NULL, NULL),
(781, 79, 'MARAS', NULL, NULL),
(782, 79, 'OLLANTAYTAMBO', NULL, NULL),
(783, 79, 'URUBAMBA', NULL, NULL),
(784, 79, 'YUCAY', NULL, NULL),
(785, 80, 'ACOBAMBA', NULL, NULL),
(786, 80, 'ANDABAMBA', NULL, NULL),
(787, 80, 'ANTA', NULL, NULL),
(788, 80, 'CAJA', NULL, NULL),
(789, 80, 'MARCAS', NULL, NULL),
(790, 80, 'PAUCARA', NULL, NULL),
(791, 80, 'POMACOCHA', NULL, NULL),
(792, 80, 'ROSARIO', NULL, NULL),
(793, 81, 'ANCHONGA', NULL, NULL),
(794, 81, 'CALLANMARCA', NULL, NULL),
(795, 81, 'CCOCHACCASA', NULL, NULL),
(796, 81, 'CHINCHO', NULL, NULL),
(797, 81, 'CONGALLA', NULL, NULL),
(798, 81, 'HUANCA-HUANCA', NULL, NULL),
(799, 81, 'HUAYLLAY GRANDE', NULL, NULL),
(800, 81, 'JULCAMARCA', NULL, NULL),
(801, 81, 'LIRCAY', NULL, NULL),
(802, 81, 'SAN ANTONIO DE ANTAPARCO', NULL, NULL),
(803, 81, 'SANTO TOMAS DE PATA', NULL, NULL),
(804, 81, 'SECCLLA', NULL, NULL),
(805, 82, 'ARMA', NULL, NULL),
(806, 82, 'AURAHUA', NULL, NULL),
(807, 82, 'CAPILLAS', NULL, NULL),
(808, 82, 'CASTROVIRREYNA', NULL, NULL),
(809, 82, 'CHUPAMARCA', NULL, NULL),
(810, 82, 'COCAS', NULL, NULL),
(811, 82, 'HUACHOS', NULL, NULL),
(812, 82, 'HUAMATAMBO', NULL, NULL),
(813, 82, 'MOLLEPAMPA', NULL, NULL),
(814, 82, 'SAN JUAN', NULL, NULL),
(815, 82, 'SANTA ANA', NULL, NULL),
(816, 82, 'TANTARA', NULL, NULL),
(817, 82, 'TICRAPO', NULL, NULL),
(818, 83, 'ANCO', NULL, NULL),
(819, 83, 'CHINCHIHUASI', NULL, NULL),
(820, 83, 'CHURCAMPA', NULL, NULL),
(821, 83, 'EL CARMEN', NULL, NULL),
(822, 83, 'LA MERCED', NULL, NULL),
(823, 83, 'LOCROJA', NULL, NULL),
(824, 83, 'PACHAMARCA', NULL, NULL),
(825, 83, 'PAUCARBAMBA', NULL, NULL),
(826, 83, 'SAN MIGUEL DE MAYOCC', NULL, NULL),
(827, 83, 'SAN PEDRO DE CORIS', NULL, NULL),
(828, 84, 'ACOBAMBILLA', NULL, NULL),
(829, 84, 'ACORIA', NULL, NULL),
(830, 84, 'ASCENCION', NULL, NULL),
(831, 84, 'CONAYCA', NULL, NULL),
(832, 84, 'CUENCA', NULL, NULL),
(833, 84, 'HUACHOCOLPA', NULL, NULL),
(834, 84, 'HUANCAVELICA', NULL, NULL),
(835, 84, 'HUANDO', NULL, NULL),
(836, 84, 'HUANDO', NULL, NULL),
(837, 84, 'HUAYLLAHUARA', NULL, NULL),
(838, 84, 'IZCUCHACA', NULL, NULL),
(839, 84, 'LARIA', NULL, NULL),
(840, 84, 'MANTA', NULL, NULL),
(841, 84, 'MARISCAL CACERES', NULL, NULL),
(842, 84, 'MOYA', NULL, NULL),
(843, 84, 'NUEVO OCCORO', NULL, NULL),
(844, 84, 'PALCA', NULL, NULL),
(845, 84, 'PILCHACA', NULL, NULL),
(846, 84, 'VILCA', NULL, NULL),
(847, 84, 'YAULI', NULL, NULL),
(848, 85, 'AYAVI', NULL, NULL),
(849, 85, 'CORDOVA', NULL, NULL),
(850, 85, 'HUAYACUNDO ARMA', NULL, NULL),
(851, 85, 'HUAYTARA', NULL, NULL),
(852, 85, 'LARAMARCA', NULL, NULL),
(853, 85, 'OCOYO', NULL, NULL),
(854, 85, 'PILPICHACA', NULL, NULL),
(855, 85, 'QUERCO', NULL, NULL),
(856, 85, 'QUITO-ARMA', NULL, NULL),
(857, 85, 'SAN ANTONIO DE CUSICANCHA', NULL, NULL),
(858, 85, 'SAN FSCO. DE SANGAYAICO', NULL, NULL),
(859, 85, 'SAN ISIDRO', NULL, NULL),
(860, 85, 'SANTIAGO DE CHOCORVOS', NULL, NULL),
(861, 85, 'SANTIAGO DE QUIRAHUARA', NULL, NULL),
(862, 85, 'SANTO DOMINGO DE CAPILLAS', NULL, NULL),
(863, 85, 'TAMBO', NULL, NULL),
(864, 86, 'ACOSTAMBO', NULL, NULL),
(865, 86, 'ACRAQUIA', NULL, NULL),
(866, 86, 'AHUAYCHA', NULL, NULL),
(867, 86, 'COLCABAMBA', NULL, NULL),
(868, 86, 'DANIEL HERNANDEZ', NULL, NULL),
(869, 86, 'HUACHOCOLPA', NULL, NULL),
(870, 86, 'HUARIBAMBA', NULL, NULL),
(871, 86, 'PAMPAS', NULL, NULL),
(872, 86, 'PAZOS', NULL, NULL),
(873, 86, 'QUISHUAR', NULL, NULL),
(874, 86, 'SALCABAMBA', NULL, NULL),
(875, 86, 'SALCAHUASI', NULL, NULL),
(876, 86, 'SAN MARCOS DE ROCCHAC', NULL, NULL),
(877, 86, 'SURCUBAMBA', NULL, NULL),
(878, 86, 'TINTAY PUNCU', NULL, NULL),
(879, 86, 'YAHUIMPUQUIO', NULL, NULL),
(880, 87, 'AMBO', NULL, NULL),
(881, 87, 'CAYNA', NULL, NULL),
(882, 87, 'COLPAS', NULL, NULL),
(883, 87, 'CONCHAMARCA', NULL, NULL),
(884, 87, 'HUACAR', NULL, NULL),
(885, 87, 'SAN FRANCISCO', NULL, NULL),
(886, 87, 'SAN RAFAEL', NULL, NULL),
(887, 87, 'TOMAYQUICHUA', NULL, NULL),
(888, 88, 'CHUQUIS', NULL, NULL),
(889, 88, 'LA UNION', NULL, NULL),
(890, 88, 'MARIAS', NULL, NULL),
(891, 88, 'PACHAS', NULL, NULL),
(892, 88, 'QUIVILLA', NULL, NULL),
(893, 88, 'RIPAN', NULL, NULL),
(894, 88, 'SHUNQUI', NULL, NULL),
(895, 88, 'SILLAPATA', NULL, NULL),
(896, 88, 'YANAS', NULL, NULL),
(897, 89, 'CANCHABAMBA', NULL, NULL),
(898, 89, 'COCHABAMBA', NULL, NULL),
(899, 89, 'HUACAYBAMBA', NULL, NULL),
(900, 89, 'PINRA', NULL, NULL),
(901, 90, 'ARANCAY', NULL, NULL),
(902, 90, 'CHAVIN DE PARIARCA', NULL, NULL),
(903, 90, 'JACAS GRANDE', NULL, NULL),
(904, 90, 'JIRCAN', NULL, NULL),
(905, 90, 'LLATA', NULL, NULL),
(906, 90, 'MIRAFLORES', NULL, NULL),
(907, 90, 'MONZON', NULL, NULL),
(908, 90, 'PUNCHAO', NULL, NULL),
(909, 90, 'PUÑOS', NULL, NULL),
(910, 90, 'SINGA', NULL, NULL),
(911, 90, 'TANTAMAYO', NULL, NULL),
(912, 91, 'AMARILIS', NULL, NULL),
(913, 91, 'CHINCHAO', NULL, NULL),
(914, 91, 'CHURUBAMBA', NULL, NULL),
(915, 91, 'HUANUCO', NULL, NULL),
(916, 91, 'MARGOS', NULL, NULL),
(917, 91, 'PILCOMARCA', NULL, NULL),
(918, 91, 'QUISQUI', NULL, NULL),
(919, 91, 'SAN FRANCISCO DE CAYRAN', NULL, NULL),
(920, 91, 'SAN PEDRO DE CHAULAN', NULL, NULL),
(921, 91, 'SANTA MARIA DEL VALLE', NULL, NULL),
(922, 91, 'YARUMAYO', NULL, NULL),
(923, 92, 'BAÑOS', NULL, NULL),
(924, 92, 'JESUS', NULL, NULL),
(925, 92, 'JIVIA', NULL, NULL),
(926, 92, 'QUEROPALCA', NULL, NULL),
(927, 92, 'RONDOS', NULL, NULL),
(928, 92, 'SAN FRANCISCO DE ASIS', NULL, NULL),
(929, 92, 'SAN MIGUEL DE CAURI', NULL, NULL),
(930, 93, 'DANIEL ALOMIA  ROBLES', NULL, NULL),
(931, 93, 'HERMILIO VALDIZAN', NULL, NULL),
(932, 93, 'JOSE CRESPO Y CASTILLO', NULL, NULL),
(933, 93, 'LUYANDO', NULL, NULL),
(934, 93, 'MARIANO DAMASO BERAUN', NULL, NULL),
(935, 93, 'RUPA-RUPA', NULL, NULL),
(936, 94, 'CHOLON', NULL, NULL),
(937, 94, 'HUACRACHUCO', NULL, NULL),
(938, 94, 'SAN BUENAVENTURA', NULL, NULL),
(939, 95, 'CHAGLLA', NULL, NULL),
(940, 95, 'MOLINO', NULL, NULL),
(941, 95, 'PANAO', NULL, NULL),
(942, 95, 'UMARI', NULL, NULL),
(943, 96, 'CODO DEL POZUZO', NULL, NULL),
(944, 96, 'HONORIA', NULL, NULL),
(945, 96, 'PUERTO INCA', NULL, NULL),
(946, 96, 'TOURNAVISTA', NULL, NULL),
(947, 96, 'YUYAPICHIS', NULL, NULL),
(948, 97, 'APARICIO POMARES', NULL, NULL),
(949, 97, 'CAHUAC', NULL, NULL),
(950, 97, 'CHACABAMBA', NULL, NULL),
(951, 97, 'CHAVINILLO', NULL, NULL),
(952, 97, 'CHORAS', NULL, NULL),
(953, 97, 'JACAS CHICO', NULL, NULL),
(954, 97, 'OBAS', NULL, NULL),
(955, 97, 'PAMPAMARCA', NULL, NULL),
(956, 98, 'ALTO LARAN', NULL, NULL),
(957, 98, 'CHAVIN', NULL, NULL),
(958, 98, 'CHINCHA ALTA', NULL, NULL),
(959, 98, 'CHINCHA BAJA', NULL, NULL),
(960, 98, 'EL CARMEN', NULL, NULL),
(961, 98, 'GROCIO PRADO', NULL, NULL),
(962, 98, 'PUEBLO NUEVO', NULL, NULL),
(963, 98, 'SAN JUAN DE YANAC', NULL, NULL),
(964, 98, 'SAN PEDRO DE HUACARPANA', NULL, NULL),
(965, 98, 'SUNAMPE', NULL, NULL),
(966, 98, 'TAMBO DE MORA', NULL, NULL),
(967, 99, 'ICA', NULL, NULL),
(968, 99, 'LA TINGUIÑA', NULL, NULL),
(969, 99, 'LOS AQUIJES', NULL, NULL),
(970, 99, 'OCUCAJE', NULL, NULL),
(971, 99, 'PACHACUTEC', NULL, NULL),
(972, 99, 'PARCONA', NULL, NULL),
(973, 99, 'PUEBLO NUEVO', NULL, NULL),
(974, 99, 'SALAS', NULL, NULL),
(975, 99, 'SAN JOSE DE LOS MOLINOS', NULL, NULL),
(976, 99, 'SAN JUAN BAUTISTA', NULL, NULL),
(977, 99, 'SANTIAGO', NULL, NULL),
(978, 99, 'SUBTANJALLA', NULL, NULL),
(979, 99, 'TATE', NULL, NULL),
(980, 99, 'YAUCA DEL ROSARIO', NULL, NULL),
(981, 100, 'CHANGUILLO', NULL, NULL),
(982, 100, 'EL INGENIO', NULL, NULL),
(983, 100, 'MARCONA', NULL, NULL),
(984, 100, 'NAZCA', NULL, NULL),
(985, 100, 'VISTA ALEGRE', NULL, NULL),
(986, 101, 'LLIPATA', NULL, NULL),
(987, 101, 'PALPA', NULL, NULL),
(988, 101, 'RIO GRANDE', NULL, NULL),
(989, 101, 'SANTA CRUZ', NULL, NULL),
(990, 101, 'TIBILLO', NULL, NULL),
(991, 102, 'HUANCANO', NULL, NULL),
(992, 102, 'HUMAY', NULL, NULL),
(993, 102, 'INDEPENDENCIA', NULL, NULL),
(994, 102, 'PARACAS', NULL, NULL),
(995, 102, 'PISCO', NULL, NULL),
(996, 102, 'SAN ANDRES', NULL, NULL),
(997, 102, 'SAN CLEMENTE', NULL, NULL),
(998, 102, 'TUPAC AMARU INCA', NULL, NULL),
(999, 103, 'CHANCHAMAYO', NULL, NULL),
(1000, 103, 'PERENE', NULL, NULL),
(1001, 103, 'PICHANAQUI', NULL, NULL),
(1002, 103, 'SAN LUIS DE SHUARO', NULL, NULL),
(1003, 103, 'SAN RAMON', NULL, NULL),
(1004, 103, 'VITOC', NULL, NULL),
(1005, 104, 'AHUAC', NULL, NULL),
(1006, 104, 'CHONGOS BAJO', NULL, NULL),
(1007, 104, 'CHUPACA', NULL, NULL),
(1008, 104, 'HUACHAC', NULL, NULL),
(1009, 104, 'HUAMANCACA CHICO', NULL, NULL),
(1010, 104, 'SAN JUAN DE ISCOS', NULL, NULL),
(1011, 104, 'SAN JUAN DE JARPA', NULL, NULL),
(1012, 104, 'TRES DE DICIEMBRE', NULL, NULL),
(1013, 104, 'YANACANCHA', NULL, NULL),
(1014, 105, 'ACO', NULL, NULL),
(1015, 105, 'ANDAMARCA', NULL, NULL),
(1016, 105, 'CHAMBARA', NULL, NULL),
(1017, 105, 'COCHAS', NULL, NULL),
(1018, 105, 'COMAS', NULL, NULL),
(1019, 105, 'CONCEPCION', NULL, NULL),
(1020, 105, 'HEROINAS TOLEDO', NULL, NULL),
(1021, 105, 'MANZANARES', NULL, NULL),
(1022, 105, 'MARISCAL CASTILLA', NULL, NULL),
(1023, 105, 'MATAHUASI', NULL, NULL),
(1024, 105, 'MITO', NULL, NULL),
(1025, 105, 'NUEVE DE JULIO', NULL, NULL),
(1026, 105, 'ORCOTUNA', NULL, NULL),
(1027, 105, 'SAN JOSE DE QUERO', NULL, NULL),
(1028, 105, 'SANTA ROSA DE OCOPA', NULL, NULL),
(1029, 106, 'CARHUACALLANGA', NULL, NULL),
(1030, 106, 'CHACAPAMPA', NULL, NULL),
(1031, 106, 'CHICCHE', NULL, NULL),
(1032, 106, 'CHILCA', NULL, NULL),
(1033, 106, 'CHONGOS ALTO', NULL, NULL),
(1034, 106, 'CHUPURO', NULL, NULL),
(1035, 106, 'COLCA', NULL, NULL),
(1036, 106, 'CULLHUAS', NULL, NULL),
(1037, 106, 'EL TAMBO', NULL, NULL),
(1038, 106, 'HUACRAPUQUIO', NULL, NULL),
(1039, 106, 'HUALHUAS', NULL, NULL),
(1040, 106, 'HUANCAN', NULL, NULL),
(1041, 106, 'HUANCAYO', NULL, NULL),
(1042, 106, 'HUASICANCHA', NULL, NULL),
(1043, 106, 'HUAYUCACHI', NULL, NULL),
(1044, 106, 'INGENIO', NULL, NULL),
(1045, 106, 'PARIAHUANCA', NULL, NULL),
(1046, 106, 'PILCOMAYO', NULL, NULL),
(1047, 106, 'PUCARA', NULL, NULL),
(1048, 106, 'QUICHUAY', NULL, NULL),
(1049, 106, 'QUILCAS', NULL, NULL),
(1050, 106, 'SAN AGUSTIN', NULL, NULL),
(1051, 106, 'SAN JERONIMO DE TUNAN', NULL, NULL),
(1052, 106, 'SANTO DOMINGO DE ACOBAMBA', NULL, NULL),
(1053, 106, 'SAÑO', NULL, NULL),
(1054, 106, 'SAPALLANGA', NULL, NULL),
(1055, 106, 'SICAYA', NULL, NULL),
(1056, 106, 'VIQUES', NULL, NULL),
(1057, 107, 'ACOLLA', NULL, NULL),
(1058, 107, 'APATA', NULL, NULL),
(1059, 107, 'ATAURA', NULL, NULL),
(1060, 107, 'CANCHAYLLO', NULL, NULL),
(1061, 107, 'CURICACA', NULL, NULL),
(1062, 107, 'EL MANTARO', NULL, NULL),
(1063, 107, 'HUAMALI', NULL, NULL),
(1064, 107, 'HUARIPAMPA', NULL, NULL),
(1065, 107, 'HUERTAS', NULL, NULL),
(1066, 107, 'JANJAILLO', NULL, NULL),
(1067, 107, 'JAUJA', NULL, NULL),
(1068, 107, 'JULCAN', NULL, NULL),
(1069, 107, 'LEONOR ORDOÑEZ', NULL, NULL),
(1070, 107, 'LLOCLLAPAMPA', NULL, NULL),
(1071, 107, 'MARCO', NULL, NULL),
(1072, 107, 'MASMA', NULL, NULL),
(1073, 107, 'MASMA CHICCHE', NULL, NULL),
(1074, 107, 'MOLINOS', NULL, NULL),
(1075, 107, 'MONOBAMBA', NULL, NULL),
(1076, 107, 'MUQUI', NULL, NULL),
(1077, 107, 'MUQUIYAUYO', NULL, NULL),
(1078, 107, 'PACA', NULL, NULL),
(1079, 107, 'PACCHA', NULL, NULL),
(1080, 107, 'PANCAN', NULL, NULL),
(1081, 107, 'PARCO', NULL, NULL),
(1082, 107, 'POMACANCHA', NULL, NULL),
(1083, 107, 'RICRAN', NULL, NULL),
(1084, 107, 'SAN LORENZO', NULL, NULL),
(1085, 107, 'SAN PEDRO DE CHUNAN', NULL, NULL),
(1086, 107, 'SAUSA', NULL, NULL),
(1087, 107, 'SINCOS', NULL, NULL),
(1088, 107, 'TUNAN MARCA', NULL, NULL),
(1089, 107, 'YAULI', NULL, NULL),
(1090, 107, 'YAUYOS', NULL, NULL),
(1091, 108, 'CARHUAMAYO', NULL, NULL),
(1092, 108, 'JUNIN', NULL, NULL),
(1093, 108, 'ONDORES', NULL, NULL),
(1094, 108, 'ULCUMAYO', NULL, NULL),
(1095, 109, 'COVIRIALI', NULL, NULL),
(1096, 109, 'LLAYLLA', NULL, NULL),
(1097, 109, 'MAZAMARI', NULL, NULL),
(1098, 109, 'PAMPA HERMOSA', NULL, NULL),
(1099, 109, 'PANGOA', NULL, NULL),
(1100, 109, 'RIO NEGRO', NULL, NULL),
(1101, 109, 'RIO TAMBO', NULL, NULL),
(1102, 109, 'SATIPO', NULL, NULL),
(1103, 110, 'ACOBAMBA', NULL, NULL),
(1104, 110, 'HUARICOLCA', NULL, NULL),
(1105, 110, 'HUASAHUASI', NULL, NULL),
(1106, 110, 'LA UNION', NULL, NULL),
(1107, 110, 'PALCA', NULL, NULL),
(1108, 110, 'PALCAMAYO', NULL, NULL),
(1109, 110, 'SAN PEDRO DE CAJAS', NULL, NULL),
(1110, 110, 'TAPO', NULL, NULL),
(1111, 110, 'TARMA', NULL, NULL),
(1112, 111, 'CHACAPALPA', NULL, NULL),
(1113, 111, 'HUAY-HUAY', NULL, NULL),
(1114, 111, 'LA OROYA', NULL, NULL),
(1115, 111, 'MARCAPOMACOCHA', NULL, NULL),
(1116, 111, 'MOROCOCHA', NULL, NULL),
(1117, 111, 'PACCHA', NULL, NULL),
(1118, 111, 'SANTA ROSA DE SACCO', NULL, NULL),
(1119, 111, 'STA. BARBARA DE CARHUACAYAN', NULL, NULL),
(1120, 111, 'SUITUCANCHA', NULL, NULL),
(1121, 111, 'YAULI', NULL, NULL),
(1122, 112, 'ASCOPE', NULL, NULL),
(1123, 112, 'CASA GRANDE', NULL, NULL),
(1124, 112, 'CHICAMA', NULL, NULL),
(1125, 112, 'CHOCOPE', NULL, NULL),
(1126, 112, 'MAGDALENA DE CAO', NULL, NULL),
(1127, 112, 'PAIJAN', NULL, NULL),
(1128, 112, 'RAZURI', NULL, NULL),
(1129, 112, 'SANTIAGO DE CAO', NULL, NULL),
(1130, 113, 'BAMBAMARCA', NULL, NULL),
(1131, 113, 'BOLIVAR', NULL, NULL),
(1132, 113, 'CONDORMARCA', NULL, NULL),
(1133, 113, 'LONGOTEA', NULL, NULL),
(1134, 113, 'UCHUMARCA', NULL, NULL),
(1135, 113, 'UCUNCHA', NULL, NULL),
(1136, 114, 'CHEPEN', NULL, NULL),
(1137, 114, 'PACANGA', NULL, NULL),
(1138, 114, 'PUEBLO NUEVO', NULL, NULL),
(1139, 115, 'CASCAS', NULL, NULL),
(1140, 115, 'LUCMA', NULL, NULL),
(1141, 115, 'MARMOT', NULL, NULL),
(1142, 115, 'SAYAPULLO', NULL, NULL),
(1143, 116, 'CALAMARCA', NULL, NULL),
(1144, 116, 'CARABAMBA', NULL, NULL),
(1145, 116, 'HUASO', NULL, NULL),
(1146, 116, 'JULCAN', NULL, NULL),
(1147, 117, 'AGALLPAMPA', NULL, NULL),
(1148, 117, 'CHARAT', NULL, NULL),
(1149, 117, 'HUARANCHAL', NULL, NULL),
(1150, 117, 'LA CUESTA', NULL, NULL),
(1151, 117, 'MACHE', NULL, NULL),
(1152, 117, 'OTUZCO', NULL, NULL),
(1153, 117, 'PARANDAY', NULL, NULL),
(1154, 117, 'SALPO', NULL, NULL),
(1155, 117, 'SINSICAP', NULL, NULL),
(1156, 117, 'USQUIL', NULL, NULL),
(1157, 118, 'GUADALUPE', NULL, NULL),
(1158, 118, 'JEQUETEPEQUE', NULL, NULL),
(1159, 118, 'PACASMAYO', NULL, NULL),
(1160, 118, 'SAN JOSE', NULL, NULL),
(1161, 118, 'SAN PEDRO DE LLOC', NULL, NULL),
(1162, 119, 'BULDIBUYO', NULL, NULL),
(1163, 119, 'CHILLIA', NULL, NULL),
(1164, 119, 'HUANCASPATA', NULL, NULL),
(1165, 119, 'HUAYLILLAS', NULL, NULL),
(1166, 119, 'HUAYO', NULL, NULL),
(1167, 119, 'ONGON', NULL, NULL),
(1168, 119, 'PARCOY', NULL, NULL),
(1169, 119, 'PATAZ', NULL, NULL),
(1170, 119, 'PIAS', NULL, NULL),
(1171, 119, 'SANTIAGO DE CHALLAS', NULL, NULL),
(1172, 119, 'TAURIJA', NULL, NULL),
(1173, 119, 'TAYABAMBA', NULL, NULL),
(1174, 119, 'URPAY', NULL, NULL),
(1175, 120, 'CHUGAY', NULL, NULL),
(1176, 120, 'COCHORCO', NULL, NULL),
(1177, 120, 'CURGOS', NULL, NULL),
(1178, 120, 'HUAMACHUCO', NULL, NULL),
(1179, 120, 'MARCABAL', NULL, NULL),
(1180, 120, 'SANAGORAN', NULL, NULL),
(1181, 120, 'SARIN', NULL, NULL),
(1182, 120, 'SARTIMBAMBA', NULL, NULL),
(1183, 121, 'ANGASMARCA', NULL, NULL),
(1184, 121, 'CACHICADAN', NULL, NULL),
(1185, 121, 'MOLLEBAMBA', NULL, NULL),
(1186, 121, 'MOLLEPATA', NULL, NULL),
(1187, 121, 'QUIRUVILCA', NULL, NULL),
(1188, 121, 'SANTA CRUZ DE CHUCA', NULL, NULL),
(1189, 121, 'SANTIAGO DE CHUCO', NULL, NULL),
(1190, 121, 'SITABAMBA', NULL, NULL),
(1191, 122, 'EL PORVENIR', NULL, NULL),
(1192, 122, 'FLORENCIA DE MORA', NULL, NULL),
(1193, 122, 'HUANCHACO', NULL, NULL),
(1194, 122, 'LA ESPERANZA', NULL, NULL),
(1195, 122, 'LAREDO', NULL, NULL),
(1196, 122, 'MOCHE', NULL, NULL),
(1197, 122, 'POROTO', NULL, NULL),
(1198, 122, 'SALAVERRY', NULL, NULL),
(1199, 122, 'SIMBAL', NULL, NULL),
(1200, 122, 'TRUJILLO', NULL, NULL),
(1201, 122, 'VICTOR LARCO HERRERA', NULL, NULL),
(1202, 123, 'CHAO', NULL, NULL),
(1203, 123, 'GUADALUPITO', NULL, NULL),
(1204, 123, 'VIRU', NULL, NULL),
(1205, 124, 'CAYALTI', NULL, NULL),
(1206, 124, 'CHICLAYO', NULL, NULL),
(1207, 124, 'CHONGOYAPE', NULL, NULL),
(1208, 124, 'ETEN', NULL, NULL),
(1209, 124, 'ETEN PUERTO', NULL, NULL),
(1210, 124, 'JOSE LEONARDO ORTIZ', NULL, NULL),
(1211, 124, 'LA VICTORIA', NULL, NULL),
(1212, 124, 'LAGUNAS', NULL, NULL),
(1213, 124, 'MONSEFU', NULL, NULL),
(1214, 124, 'NUEVA ARICA', NULL, NULL),
(1215, 124, 'OYOTUN', NULL, NULL),
(1216, 124, 'PATAPO', NULL, NULL),
(1217, 124, 'PICSI', NULL, NULL),
(1218, 124, 'PIMENTEL', NULL, NULL),
(1219, 124, 'POMALCA', NULL, NULL),
(1220, 124, 'PUCALA', NULL, NULL),
(1221, 124, 'REQUE', NULL, NULL),
(1222, 124, 'SANTA ROSA', NULL, NULL),
(1223, 124, 'SAÑA', NULL, NULL),
(1224, 124, 'TUMAN', NULL, NULL),
(1225, 125, 'CANARIS', NULL, NULL),
(1226, 125, 'FERRENAFE', NULL, NULL),
(1227, 125, 'INCAHUASI', NULL, NULL),
(1228, 125, 'MANUEL A. MESONES MURO', NULL, NULL),
(1229, 125, 'PITIPO', NULL, NULL),
(1230, 125, 'PUEBLO NUEVO', NULL, NULL),
(1231, 126, 'CHOCHOPE', NULL, NULL),
(1232, 126, 'ILLIMO', NULL, NULL),
(1233, 126, 'JAYANCA', NULL, NULL),
(1234, 126, 'LAMBAYEQUE', NULL, NULL),
(1235, 126, 'MOCHUMI', NULL, NULL),
(1236, 126, 'MORROPE', NULL, NULL),
(1237, 126, 'MOTUPE', NULL, NULL),
(1238, 126, 'OLMOS', NULL, NULL),
(1239, 126, 'PACORA', NULL, NULL),
(1240, 126, 'SALAS', NULL, NULL),
(1241, 126, 'SAN JOSE', NULL, NULL),
(1242, 126, 'TUCUME', NULL, NULL),
(1243, 127, 'BARRANCA', NULL, NULL),
(1244, 127, 'PARAMONGA', NULL, NULL),
(1245, 127, 'PATIVILCA', NULL, NULL),
(1246, 127, 'SUPE', NULL, NULL),
(1247, 127, 'SUPE PUERTO', NULL, NULL),
(1248, 128, 'CAJATAMBO', NULL, NULL),
(1249, 128, 'COPA', NULL, NULL),
(1250, 128, 'GORGOR', NULL, NULL),
(1251, 128, 'HUANCAPON', NULL, NULL),
(1252, 128, 'MANAS', NULL, NULL),
(1253, 129, 'BELLAVISTA', NULL, NULL),
(1254, 129, 'CALLAO', NULL, NULL),
(1255, 129, 'CARMEN DE LA LEGUA  REYNOSO', NULL, NULL),
(1256, 129, 'LA PERLA', NULL, NULL),
(1257, 129, 'LA PUNTA', NULL, NULL),
(1258, 129, 'VENTANILLA', NULL, NULL),
(1259, 130, 'ARAHUAY', NULL, NULL),
(1260, 130, 'CANTA', NULL, NULL),
(1261, 130, 'HUAMANTANGA', NULL, NULL),
(1262, 130, 'HUAROS', NULL, NULL),
(1263, 130, 'LACHAQUI', NULL, NULL),
(1264, 130, 'SAN BUENAVENTURA', NULL, NULL),
(1265, 130, 'SANTA ROSA DE QUIVES', NULL, NULL),
(1266, 131, 'ASIA', NULL, NULL),
(1267, 131, 'CALANGO', NULL, NULL),
(1268, 131, 'CERRO AZUL', NULL, NULL),
(1269, 131, 'CHILCA', NULL, NULL),
(1270, 131, 'COAYLLO', NULL, NULL),
(1271, 131, 'IMPERIAL', NULL, NULL),
(1272, 131, 'LUNAHUANA', NULL, NULL),
(1273, 131, 'MALA', NULL, NULL),
(1274, 131, 'NUEVO IMPERIAL', NULL, NULL),
(1275, 131, 'PACARAN', NULL, NULL),
(1276, 131, 'QUILMANA', NULL, NULL),
(1277, 131, 'SAN ANTONIO', NULL, NULL),
(1278, 131, 'SAN LUIS', NULL, NULL),
(1279, 131, 'SAN VICENTE DE CAÑETE', NULL, NULL),
(1280, 131, 'SANTA CRUZ DE FLORES', NULL, NULL),
(1281, 131, 'ZUÑIGA', NULL, NULL),
(1282, 132, 'ATAVILLOS ALTO', NULL, NULL),
(1283, 132, 'ATAVILLOS BAJO', NULL, NULL),
(1284, 132, 'AUCALLAMA', NULL, NULL),
(1285, 132, 'CHANCAY', NULL, NULL),
(1286, 132, 'HUARAL', NULL, NULL),
(1287, 132, 'IHUARI', NULL, NULL),
(1288, 132, 'LAMPIAN', NULL, NULL),
(1289, 132, 'PACARAOS', NULL, NULL),
(1290, 132, 'SAN MIGUEL DE ACOS', NULL, NULL),
(1291, 132, 'SANTA CRUZ DE ANDAMARCA', NULL, NULL),
(1292, 132, 'SUMBILCA', NULL, NULL),
(1293, 132, 'VEINTISIETE DE NOVIEMBRE', NULL, NULL),
(1294, 133, 'ANTIOQUIA', NULL, NULL),
(1295, 133, 'CALLAHUANCA', NULL, NULL),
(1296, 133, 'CARAMPOMA', NULL, NULL),
(1297, 133, 'CHICLA', NULL, NULL),
(1298, 133, 'CUENCA', NULL, NULL),
(1299, 133, 'HUACHUPAMPA', NULL, NULL),
(1300, 133, 'HUANZA', NULL, NULL),
(1301, 133, 'HUAROCHIRI', NULL, NULL),
(1302, 133, 'LAHUAYTAMBO', NULL, NULL),
(1303, 133, 'LANGA', NULL, NULL),
(1304, 133, 'LARAOS', NULL, NULL),
(1305, 133, 'MARIATANA', NULL, NULL),
(1306, 133, 'MATUCANA', NULL, NULL),
(1307, 133, 'RICARDO PALMA', NULL, NULL),
(1308, 133, 'SAN ANDRES DE TUPICOCHA', NULL, NULL),
(1309, 133, 'SAN ANTONIO', NULL, NULL),
(1310, 133, 'SAN BARTOLOME', NULL, NULL),
(1311, 133, 'SAN DAMIAN', NULL, NULL),
(1312, 133, 'SAN JUAN DE IRIS', NULL, NULL),
(1313, 133, 'SAN JUAN DE TANTARANCHE', NULL, NULL),
(1314, 133, 'SAN LORENZO DE QUINTI', NULL, NULL),
(1315, 133, 'SAN MATEO', NULL, NULL),
(1316, 133, 'SAN MATEO DE OTAO', NULL, NULL),
(1317, 133, 'SAN PEDRO DE CASTA', NULL, NULL),
(1318, 133, 'SAN PEDRO DE HUANCAYRE', NULL, NULL),
(1319, 133, 'SANGALLAYA', NULL, NULL),
(1320, 133, 'SANTA CRUZ DE COCACHACRA', NULL, NULL),
(1321, 133, 'SANTA EULALIA', NULL, NULL),
(1322, 133, 'SANTIAGO DE ANCHUCAYA', NULL, NULL),
(1323, 133, 'SANTIAGO DE TUNA', NULL, NULL),
(1324, 133, 'STO. DMGO. DE LOS OLLEROS', NULL, NULL),
(1325, 133, 'SURCO', NULL, NULL),
(1326, 134, 'AMBAR', NULL, NULL),
(1327, 134, 'CALETA DE CARQUIN', NULL, NULL),
(1328, 134, 'CHECRAS', NULL, NULL),
(1329, 134, 'HUACHO', NULL, NULL),
(1330, 134, 'HUALMAY', NULL, NULL),
(1331, 134, 'HUAURA', NULL, NULL),
(1332, 134, 'LEONCIO PRADO', NULL, NULL),
(1333, 134, 'PACCHO', NULL, NULL),
(1334, 134, 'SANTA LEONOR', NULL, NULL),
(1335, 134, 'SANTA MARIA', NULL, NULL),
(1336, 134, 'SAYAN', NULL, NULL),
(1337, 134, 'VEGUETA', NULL, NULL),
(1338, 135, 'ANCON', NULL, NULL),
(1339, 135, 'ATE', NULL, NULL),
(1340, 135, 'BARRANCO', NULL, NULL),
(1341, 135, 'BREÑA', NULL, NULL),
(1342, 135, 'CARABAYLLO', NULL, NULL),
(1343, 135, 'CHACLACAYO', NULL, NULL),
(1344, 135, 'CHORRILLOS', NULL, NULL),
(1345, 135, 'CIENEGUILLA', NULL, NULL),
(1346, 135, 'COMAS', NULL, NULL),
(1347, 135, 'EL AGUSTINO', NULL, NULL),
(1348, 135, 'INDEPENDENCIA', NULL, NULL),
(1349, 135, 'JESUS MARIA', NULL, NULL),
(1350, 135, 'LA MOLINA', NULL, NULL),
(1351, 135, 'LA VICTORIA', NULL, NULL),
(1352, 135, 'LIMA', NULL, NULL),
(1353, 135, 'LINCE', NULL, NULL),
(1354, 135, 'LOS OLIVOS', NULL, NULL),
(1355, 135, 'LURIGANCHO', NULL, NULL),
(1356, 135, 'LURIN', NULL, NULL),
(1357, 135, 'MAGDALENA DEL MAR', NULL, NULL),
(1358, 135, 'MAGDALENA VIEJA', NULL, NULL),
(1359, 135, 'MIRAFLORES', NULL, NULL),
(1360, 135, 'PACHACAMAC', NULL, NULL),
(1361, 135, 'PUCUSANA', NULL, NULL),
(1362, 135, 'PUENTE PIEDRA', NULL, NULL),
(1363, 135, 'PUNTA HERMOSA', NULL, NULL),
(1364, 135, 'PUNTA NEGRA', NULL, NULL),
(1365, 135, 'RIMAC', NULL, NULL),
(1366, 135, 'SAN BARTOLO', NULL, NULL),
(1367, 135, 'SAN BORJA', NULL, NULL),
(1368, 135, 'SAN ISIDRO', NULL, NULL),
(1369, 135, 'SAN JUAN DE LURIGANCHO', NULL, NULL),
(1370, 135, 'SAN JUAN DE MIRAFLORES', NULL, NULL),
(1371, 135, 'SAN LUIS', NULL, NULL),
(1372, 135, 'SAN MARTIN DE PORRES', NULL, NULL),
(1373, 135, 'SAN MIGUEL', NULL, NULL),
(1374, 135, 'SANTA ANITA', NULL, NULL),
(1375, 135, 'SANTA MARIA DEL MAR', NULL, NULL),
(1376, 135, 'SANTA ROSA', NULL, NULL),
(1377, 135, 'SANTIAGO DE SURCO', NULL, NULL),
(1378, 135, 'SURQUILLO', NULL, NULL),
(1379, 135, 'VILLA EL SALVADOR', NULL, NULL),
(1380, 135, 'VILLA MARIA DEL TRIUNFO', NULL, NULL),
(1381, 136, 'ANDAJES', NULL, NULL),
(1382, 136, 'CAUJUL', NULL, NULL),
(1383, 136, 'COCHAMARCA', NULL, NULL),
(1384, 136, 'NAVAN', NULL, NULL),
(1385, 136, 'OYON', NULL, NULL),
(1386, 136, 'PACHANGARA', NULL, NULL),
(1387, 137, 'ALIS', NULL, NULL),
(1388, 137, 'AYAUCA', NULL, NULL),
(1389, 137, 'AYAVIRI', NULL, NULL),
(1390, 137, 'AZANGARO', NULL, NULL),
(1391, 137, 'CACRA', NULL, NULL),
(1392, 137, 'CARANIA', NULL, NULL),
(1393, 137, 'CATAHUASI', NULL, NULL),
(1394, 137, 'CHOCOS', NULL, NULL),
(1395, 137, 'COCHAS', NULL, NULL),
(1396, 137, 'COLONIA', NULL, NULL),
(1397, 137, 'HONGOS', NULL, NULL),
(1398, 137, 'HUAMPARA', NULL, NULL),
(1399, 137, 'HUANCAYA', NULL, NULL),
(1400, 137, 'HUANGASCAR', NULL, NULL),
(1401, 137, 'HUANTAN', NULL, NULL),
(1402, 137, 'HUAYEC', NULL, NULL),
(1403, 137, 'LARAOS', NULL, NULL),
(1404, 137, 'LINCHA', NULL, NULL),
(1405, 137, 'MADEAN', NULL, NULL),
(1406, 137, 'MIRAFLORES', NULL, NULL),
(1407, 137, 'OMAS', NULL, NULL),
(1408, 137, 'PUTINZA', NULL, NULL),
(1409, 137, 'QUINCHES', NULL, NULL),
(1410, 137, 'QUINOCAY', NULL, NULL),
(1411, 137, 'SAN JOAQUIN', NULL, NULL),
(1412, 137, 'SAN PEDRO DE PILAS', NULL, NULL),
(1413, 137, 'TANTA', NULL, NULL),
(1414, 137, 'TAURIPAMPA', NULL, NULL),
(1415, 137, 'TOMAS', NULL, NULL),
(1416, 137, 'TUPE', NULL, NULL),
(1417, 137, 'VIÑAC', NULL, NULL),
(1418, 137, 'VITIS', NULL, NULL),
(1419, 137, 'YAUYOS', NULL, NULL),
(1420, 138, 'BALSAPUERTO', NULL, NULL),
(1421, 138, 'BARRANCA', NULL, NULL),
(1422, 138, 'CAHUAPANAS', NULL, NULL),
(1423, 138, 'JEBEROS', NULL, NULL),
(1424, 138, 'LAGUNAS', NULL, NULL),
(1425, 138, 'MANSERICHE', NULL, NULL),
(1426, 138, 'MORONA', NULL, NULL),
(1427, 138, 'PASTAZA', NULL, NULL),
(1428, 138, 'SANTA CRUZ', NULL, NULL),
(1429, 138, 'TENIENTE CESAR LOPEZ ROJAS', NULL, NULL),
(1430, 138, 'YURIMAGUAS', NULL, NULL),
(1431, 139, 'NAUTA', NULL, NULL),
(1432, 139, 'PARINARI', NULL, NULL),
(1433, 139, 'TIGRE', NULL, NULL),
(1434, 139, 'TROMPETEROS', NULL, NULL),
(1435, 139, 'URARINAS', NULL, NULL),
(1436, 140, 'PEBAS', NULL, NULL),
(1437, 140, 'RAMON CASTILLA', NULL, NULL),
(1438, 140, 'SAN PABLO', NULL, NULL);
INSERT INTO `distritos` (`id`, `provincia_id`, `nombre`, `created_at`, `updated_at`) VALUES
(1439, 140, 'YAVARI', NULL, NULL),
(1440, 141, 'ALTO NANAY', NULL, NULL),
(1441, 141, 'BELEN', NULL, NULL),
(1442, 141, 'FERNANDO LORES', NULL, NULL),
(1443, 141, 'INDIANA', NULL, NULL),
(1444, 141, 'IQUITOS', NULL, NULL),
(1445, 141, 'LAS AMAZONAS', NULL, NULL),
(1446, 141, 'MAZAN', NULL, NULL),
(1447, 141, 'NAPO', NULL, NULL),
(1448, 141, 'PUNCHANA', NULL, NULL),
(1449, 141, 'PUTUMAYO', NULL, NULL),
(1450, 141, 'SAN JUAN BAUTISTA', NULL, NULL),
(1451, 141, 'TORRES CAUSANA', NULL, NULL),
(1452, 142, 'ALTO TAPICHE', NULL, NULL),
(1453, 142, 'CAPELO', NULL, NULL),
(1454, 142, 'EMILIO SAN MARTIN', NULL, NULL),
(1455, 142, 'JENARO HERRERA', NULL, NULL),
(1456, 142, 'MAQUIA', NULL, NULL),
(1457, 142, 'PUINAHUA', NULL, NULL),
(1458, 142, 'REQUENA', NULL, NULL),
(1459, 142, 'SAQUENA', NULL, NULL),
(1460, 142, 'SOPLIN', NULL, NULL),
(1461, 142, 'TAPICHE', NULL, NULL),
(1462, 142, 'YAQUERANA', NULL, NULL),
(1463, 142, 'YAQUERANA', NULL, NULL),
(1464, 143, 'CONTAMANA', NULL, NULL),
(1465, 143, 'INAHUAYA', NULL, NULL),
(1466, 143, 'PADRE MARQUEZ', NULL, NULL),
(1467, 143, 'PAMPA HERMOSA', NULL, NULL),
(1468, 143, 'SARAYACU', NULL, NULL),
(1469, 143, 'VARGAS GUERRA', NULL, NULL),
(1470, 144, 'FITZCARRALD', NULL, NULL),
(1471, 144, 'HUEPETUCHE', NULL, NULL),
(1472, 144, 'MADRE DE DIOS', NULL, NULL),
(1473, 144, 'MANU', NULL, NULL),
(1474, 145, 'IBERIA', NULL, NULL),
(1475, 145, 'IÑAPARI', NULL, NULL),
(1476, 145, 'TAHUAMANU', NULL, NULL),
(1477, 146, 'INAMBARI', NULL, NULL),
(1478, 146, 'LABERINTO', NULL, NULL),
(1479, 146, 'LAS PIEDRAS', NULL, NULL),
(1480, 146, 'TAMBOPATA', NULL, NULL),
(1481, 147, 'CHOJATA', NULL, NULL),
(1482, 147, 'COALAQUE', NULL, NULL),
(1483, 147, 'ICHUYA', NULL, NULL),
(1484, 147, 'LA CAPILLA', NULL, NULL),
(1485, 147, 'LLOQUE', NULL, NULL),
(1486, 147, 'MATALAQUE', NULL, NULL),
(1487, 147, 'OMATE', NULL, NULL),
(1488, 147, 'PUQUINA', NULL, NULL),
(1489, 147, 'QUINISTAQUILLAS', NULL, NULL),
(1490, 147, 'UBINAS', NULL, NULL),
(1491, 147, 'YUNGA', NULL, NULL),
(1492, 148, 'EL ALGARROBAL', NULL, NULL),
(1493, 148, 'ILO', NULL, NULL),
(1494, 148, 'PACOCHA', NULL, NULL),
(1495, 149, 'CARUMAS', NULL, NULL),
(1496, 149, 'CUCHUMBAYA', NULL, NULL),
(1497, 149, 'MOQUEGUA', NULL, NULL),
(1498, 149, 'SAMEGUA', NULL, NULL),
(1499, 149, 'SAN CRISTOBAL', NULL, NULL),
(1500, 149, 'TORATA', NULL, NULL),
(1501, 150, 'CHACAYAN', NULL, NULL),
(1502, 150, 'GOYLLARISQUIZGA', NULL, NULL),
(1503, 150, 'PAUCAR', NULL, NULL),
(1504, 150, 'SAN PEDRO DE PILLAO', NULL, NULL),
(1505, 150, 'SANTA ANA DE TUSI', NULL, NULL),
(1506, 150, 'TAPUC', NULL, NULL),
(1507, 150, 'VILCABAMBA', NULL, NULL),
(1508, 150, 'YANAHUANCA', NULL, NULL),
(1509, 151, 'CHONTABAMBA', NULL, NULL),
(1510, 151, 'HUANCABAMBA', NULL, NULL),
(1511, 151, 'OXAPAMPA', NULL, NULL),
(1512, 151, 'PALCAZU', NULL, NULL),
(1513, 151, 'POZUZO', NULL, NULL),
(1514, 151, 'PUERTO BERMUDEZ', NULL, NULL),
(1515, 151, 'VILLA RICA', NULL, NULL),
(1516, 152, 'CHAUPIMARCA', NULL, NULL),
(1517, 152, 'HUACHON', NULL, NULL),
(1518, 152, 'HUARIACA', NULL, NULL),
(1519, 152, 'HUAYLLAY', NULL, NULL),
(1520, 152, 'NINACACA', NULL, NULL),
(1521, 152, 'PALLANCHACRA', NULL, NULL),
(1522, 152, 'PAUCARTAMBO', NULL, NULL),
(1523, 152, 'SAN FCO.DE ASIS DE YARUSYACAN', NULL, NULL),
(1524, 152, 'SIMON BOLIVAR', NULL, NULL),
(1525, 152, 'TICLACAYAN', NULL, NULL),
(1526, 152, 'TINYAHUARCO', NULL, NULL),
(1527, 152, 'VICCO', NULL, NULL),
(1528, 152, 'YANACANCHA', NULL, NULL),
(1529, 153, 'AYABACA', NULL, NULL),
(1530, 153, 'FRIAS', NULL, NULL),
(1531, 153, 'JILILI', NULL, NULL),
(1532, 153, 'LAGUNAS', NULL, NULL),
(1533, 153, 'MONTERO', NULL, NULL),
(1534, 153, 'PACAIPAMPA', NULL, NULL),
(1535, 153, 'PAIMAS', NULL, NULL),
(1536, 153, 'SAPILLICA', NULL, NULL),
(1537, 153, 'SICCHEZ', NULL, NULL),
(1538, 153, 'SUYO', NULL, NULL),
(1539, 154, 'CANCHAQUE', NULL, NULL),
(1540, 154, 'EL CARMEN DE LA FRONTERA', NULL, NULL),
(1541, 154, 'HUANCABAMBA', NULL, NULL),
(1542, 154, 'HUARMACA', NULL, NULL),
(1543, 154, 'LALAQUIZ', NULL, NULL),
(1544, 154, 'SAN MIGUEL DE EL FAIQUE', NULL, NULL),
(1545, 154, 'SONDOR', NULL, NULL),
(1546, 154, 'SONDORILLO', NULL, NULL),
(1547, 155, 'BUENOS AIRES', NULL, NULL),
(1548, 155, 'CHALACO', NULL, NULL),
(1549, 155, 'CHULUCANAS', NULL, NULL),
(1550, 155, 'LA MATANZA', NULL, NULL),
(1551, 155, 'MORROPON', NULL, NULL),
(1552, 155, 'SALITRAL', NULL, NULL),
(1553, 155, 'SAN JUAN DE BIGOTE', NULL, NULL),
(1554, 155, 'SANTA CATALINA DE MOSSA', NULL, NULL),
(1555, 155, 'SANTO DOMINGO', NULL, NULL),
(1556, 155, 'YAMANGO', NULL, NULL),
(1557, 156, 'AMOTAPE', NULL, NULL),
(1558, 156, 'ARENAL', NULL, NULL),
(1559, 156, 'COLAN', NULL, NULL),
(1560, 156, 'LA HUACA', NULL, NULL),
(1561, 156, 'PAITA', NULL, NULL),
(1562, 156, 'TAMARINDO', NULL, NULL),
(1563, 156, 'VICHAYAL', NULL, NULL),
(1564, 157, 'CASTILLA', NULL, NULL),
(1565, 157, 'CATACAOS', NULL, NULL),
(1566, 157, 'CURA MORI', NULL, NULL),
(1567, 157, 'EL TALLAN', NULL, NULL),
(1568, 157, 'LA ARENA', NULL, NULL),
(1569, 157, 'LA UNION', NULL, NULL),
(1570, 157, 'LAS LOMAS', NULL, NULL),
(1571, 157, 'PIURA', NULL, NULL),
(1572, 157, 'TAMBO GRANDE', NULL, NULL),
(1573, 158, 'BELLAVISTA DE LA UNION', NULL, NULL),
(1574, 158, 'BERNAL', NULL, NULL),
(1575, 158, 'CRISTO NOS VALGA', NULL, NULL),
(1576, 158, 'RINCONADA LLICUAR', NULL, NULL),
(1577, 158, 'SECHURA', NULL, NULL),
(1578, 158, 'VICE', NULL, NULL),
(1579, 159, 'BELLAVISTA', NULL, NULL),
(1580, 159, 'IGNACIO ESCUDERO', NULL, NULL),
(1581, 159, 'LANCONES', NULL, NULL),
(1582, 159, 'MARCAVELICA', NULL, NULL),
(1583, 159, 'MIGUEL CHECA', NULL, NULL),
(1584, 159, 'QUERECOTILLO', NULL, NULL),
(1585, 159, 'SALITRAL', NULL, NULL),
(1586, 159, 'SULLANA', NULL, NULL),
(1587, 160, 'EL ALTO', NULL, NULL),
(1588, 160, 'LA BREA', NULL, NULL),
(1589, 160, 'LOBITOS', NULL, NULL),
(1590, 160, 'LOS ORGANOS', NULL, NULL),
(1591, 160, 'MANCORA', NULL, NULL),
(1592, 160, 'PARIÑAS', NULL, NULL),
(1593, 161, 'ACHAYA', NULL, NULL),
(1594, 161, 'ARAPA', NULL, NULL),
(1595, 161, 'ASILLO', NULL, NULL),
(1596, 161, 'AZANGARO', NULL, NULL),
(1597, 161, 'CAMINACA', NULL, NULL),
(1598, 161, 'CHUPA', NULL, NULL),
(1599, 161, 'JOSE D. CHOQUEHUANCA', NULL, NULL),
(1600, 161, 'MUYANI', NULL, NULL),
(1601, 161, 'POTONI', NULL, NULL),
(1602, 161, 'SAMAN', NULL, NULL),
(1603, 161, 'SAN ANTON', NULL, NULL),
(1604, 161, 'SAN JOSE', NULL, NULL),
(1605, 161, 'SAN JUAN DE SALINAS', NULL, NULL),
(1606, 161, 'SANTIAGO DE PUPUJA', NULL, NULL),
(1607, 161, 'TIRAPATA', NULL, NULL),
(1608, 162, 'AJOYANI', NULL, NULL),
(1609, 162, 'AYAPATA', NULL, NULL),
(1610, 162, 'COASA', NULL, NULL),
(1611, 162, 'CORANI', NULL, NULL),
(1612, 162, 'CRUCERO', NULL, NULL),
(1613, 162, 'ITUATA', NULL, NULL),
(1614, 162, 'MACUSANI', NULL, NULL),
(1615, 162, 'OLLACHEA', NULL, NULL),
(1616, 162, 'SAN GABAN', NULL, NULL),
(1617, 162, 'USICAYOS', NULL, NULL),
(1618, 163, 'DESAGUADERO', NULL, NULL),
(1619, 163, 'HUACULLANI', NULL, NULL),
(1620, 163, 'JULI', NULL, NULL),
(1621, 163, 'KELLUYO', NULL, NULL),
(1622, 163, 'PISACOMA', NULL, NULL),
(1623, 163, 'POMATA', NULL, NULL),
(1624, 163, 'ZEPITA', NULL, NULL),
(1625, 164, 'CAPAZO', NULL, NULL),
(1626, 164, 'CONDURIRI', NULL, NULL),
(1627, 164, 'ILAVE', NULL, NULL),
(1628, 164, 'PILCUYO', NULL, NULL),
(1629, 164, 'SANTA ROSA', NULL, NULL),
(1630, 165, 'COJATA', NULL, NULL),
(1631, 165, 'HUANCANE', NULL, NULL),
(1632, 165, 'HUATASANI', NULL, NULL),
(1633, 165, 'INCHUPALLA', NULL, NULL),
(1634, 165, 'PUSI', NULL, NULL),
(1635, 165, 'ROSASPATA', NULL, NULL),
(1636, 165, 'TARACO', NULL, NULL),
(1637, 165, 'VILQUE CHICO', NULL, NULL),
(1638, 166, 'CABANILLA', NULL, NULL),
(1639, 166, 'CALAPUJA', NULL, NULL),
(1640, 166, 'LAMPA', NULL, NULL),
(1641, 166, 'NICASIO', NULL, NULL),
(1642, 166, 'OCUVIRI', NULL, NULL),
(1643, 166, 'PALCA', NULL, NULL),
(1644, 166, 'PARATIA', NULL, NULL),
(1645, 166, 'PUCARA', NULL, NULL),
(1646, 166, 'SANTA LUCIA', NULL, NULL),
(1647, 166, 'VILAVILA', NULL, NULL),
(1648, 167, 'ANTAUTA', NULL, NULL),
(1649, 167, 'AYAVIRI', NULL, NULL),
(1650, 167, 'CUPI', NULL, NULL),
(1651, 167, 'LLALLI', NULL, NULL),
(1652, 167, 'MACARI', NULL, NULL),
(1653, 167, 'NUYOA', NULL, NULL),
(1654, 167, 'ORURILLO', NULL, NULL),
(1655, 167, 'SANTA ROSA', NULL, NULL),
(1656, 167, 'UMACHIRI', NULL, NULL),
(1657, 168, 'CONIMA', NULL, NULL),
(1658, 168, 'HUAYRAPATA', NULL, NULL),
(1659, 168, 'MOHO', NULL, NULL),
(1660, 168, 'TILALI', NULL, NULL),
(1661, 169, 'ACORA', NULL, NULL),
(1662, 169, 'AMANTANI', NULL, NULL),
(1663, 169, 'ATUNCOLLA', NULL, NULL),
(1664, 169, 'CAPACHICA', NULL, NULL),
(1665, 169, 'CHUCUITO', NULL, NULL),
(1666, 169, 'COATA', NULL, NULL),
(1667, 169, 'HUATA', NULL, NULL),
(1668, 169, 'MAYAZO', NULL, NULL),
(1669, 169, 'PAUCARCOLLA', NULL, NULL),
(1670, 169, 'PICHACANI', NULL, NULL),
(1671, 169, 'PLATERIA', NULL, NULL),
(1672, 169, 'PUNO', NULL, NULL),
(1673, 169, 'SAN ANTONIO', NULL, NULL),
(1674, 169, 'TIQUILLACA', NULL, NULL),
(1675, 169, 'VILQUE', NULL, NULL),
(1676, 170, 'ANANEA', NULL, NULL),
(1677, 170, 'PEDRO VILCA APAZA', NULL, NULL),
(1678, 170, 'PUTINA', NULL, NULL),
(1679, 170, 'QUILCAPUNCU', NULL, NULL),
(1680, 170, 'SINA', NULL, NULL),
(1681, 171, 'CABANA', NULL, NULL),
(1682, 171, 'CABANILLAS', NULL, NULL),
(1683, 171, 'CARACOTO', NULL, NULL),
(1684, 171, 'JULIACA', NULL, NULL),
(1685, 172, 'ALTO INAMBARI', NULL, NULL),
(1686, 172, 'CUYOCUYO', NULL, NULL),
(1687, 172, 'LIMBANI', NULL, NULL),
(1688, 172, 'PATAMBUCO', NULL, NULL),
(1689, 172, 'PHARA', NULL, NULL),
(1690, 172, 'QUIACA', NULL, NULL),
(1691, 172, 'SAN JUAN DEL ORO', NULL, NULL),
(1692, 172, 'SANDIA', NULL, NULL),
(1693, 172, 'YANAHUAYA', NULL, NULL),
(1694, 173, 'ANAPIA', NULL, NULL),
(1695, 173, 'COPANI', NULL, NULL),
(1696, 173, 'CUTURAPI', NULL, NULL),
(1697, 173, 'OLLARAYA', NULL, NULL),
(1698, 173, 'TINICACHI', NULL, NULL),
(1699, 173, 'UNICACHI', NULL, NULL),
(1700, 173, 'YUNGUYO', NULL, NULL),
(1701, 174, 'ALTO BIAVO', NULL, NULL),
(1702, 174, 'BAJO BIAVO', NULL, NULL),
(1703, 174, 'BELLAVISTA', NULL, NULL),
(1704, 174, 'HUALLAGA', NULL, NULL),
(1705, 174, 'SAN PABLO', NULL, NULL),
(1706, 174, 'SAN RAFAEL', NULL, NULL),
(1707, 175, 'AGUA BLANCA', NULL, NULL),
(1708, 175, 'SAN JOSE DE SISA', NULL, NULL),
(1709, 175, 'SAN MARTIN', NULL, NULL),
(1710, 175, 'SANTA ROSA', NULL, NULL),
(1711, 175, 'SHATOJA', NULL, NULL),
(1712, 176, 'ALTO SAPOSOA', NULL, NULL),
(1713, 176, 'EL ESLABON', NULL, NULL),
(1714, 176, 'PISCOYACU', NULL, NULL),
(1715, 176, 'SACANCHE', NULL, NULL),
(1716, 176, 'SAPOSOA', NULL, NULL),
(1717, 176, 'TINGO DE SAPOSOA', NULL, NULL),
(1718, 177, 'ALONSO DE ALVARADO', NULL, NULL),
(1719, 177, 'BARRANQUITA', NULL, NULL),
(1720, 177, 'CAYNARACHI', NULL, NULL),
(1721, 177, 'CUÑUMBUQUI', NULL, NULL),
(1722, 177, 'LAMAS', NULL, NULL),
(1723, 177, 'PINTO RECODO', NULL, NULL),
(1724, 177, 'RUMISAPA', NULL, NULL),
(1725, 177, 'SAN ROQUE DE CUMBAZA', NULL, NULL),
(1726, 177, 'SHANAO', NULL, NULL),
(1727, 177, 'TABALOSOS', NULL, NULL),
(1728, 177, 'ZAPATERO', NULL, NULL),
(1729, 178, 'CAMPANILLA', NULL, NULL),
(1730, 178, 'HUICUNGO', NULL, NULL),
(1731, 178, 'JUANJUI', NULL, NULL),
(1732, 178, 'PACHIZA', NULL, NULL),
(1733, 178, 'PAJARILLO', NULL, NULL),
(1734, 179, 'CALZADA', NULL, NULL),
(1735, 179, 'HABANA', NULL, NULL),
(1736, 179, 'JEPELACIO', NULL, NULL),
(1737, 179, 'MOYOBAMBA', NULL, NULL),
(1738, 179, 'SORITOR', NULL, NULL),
(1739, 179, 'YANTALO', NULL, NULL),
(1740, 180, 'BUENOS AIRES', NULL, NULL),
(1741, 180, 'CASPISAPA', NULL, NULL),
(1742, 180, 'PICOTA', NULL, NULL),
(1743, 180, 'PILLUANA', NULL, NULL),
(1744, 180, 'PUCACACA', NULL, NULL),
(1745, 180, 'SAN CRISTOBAL', NULL, NULL),
(1746, 180, 'SAN HILARION', NULL, NULL),
(1747, 180, 'SHAMBOYACU', NULL, NULL),
(1748, 180, 'TINGO DE PONASA', NULL, NULL),
(1749, 180, 'TRES UNIDOS', NULL, NULL),
(1750, 181, 'AWAJUN', NULL, NULL),
(1751, 181, 'ELIAS SOPLIN VARGAS', NULL, NULL),
(1752, 181, 'NUEVA CAJAMARCA', NULL, NULL),
(1753, 181, 'PARDO MIGUEL', NULL, NULL),
(1754, 181, 'POSIC', NULL, NULL),
(1755, 181, 'RIOJA', NULL, NULL),
(1756, 181, 'SAN FERNANDO', NULL, NULL),
(1757, 181, 'YORONGOS', NULL, NULL),
(1758, 181, 'YURACYACU', NULL, NULL),
(1759, 182, 'ALBERTO LEVEAU', NULL, NULL),
(1760, 182, 'CACATACHI', NULL, NULL),
(1761, 182, 'CHAZUTA', NULL, NULL),
(1762, 182, 'CHIPURANA', NULL, NULL),
(1763, 182, 'EL PORVENIR', NULL, NULL),
(1764, 182, 'HUIMBAYOC', NULL, NULL),
(1765, 182, 'JUAN GUERRA', NULL, NULL),
(1766, 182, 'LA BANDA DE SHILCAYO', NULL, NULL),
(1767, 182, 'MORALES', NULL, NULL),
(1768, 182, 'PAPAPLAYA', NULL, NULL),
(1769, 182, 'SAN ANTONIO', NULL, NULL),
(1770, 182, 'SAUCE', NULL, NULL),
(1771, 182, 'SHAPAJA', NULL, NULL),
(1772, 182, 'TARAPOTO', NULL, NULL),
(1773, 183, 'NUEVO PROGRESO', NULL, NULL),
(1774, 183, 'POLVORA', NULL, NULL),
(1775, 183, 'SHUNTE', NULL, NULL),
(1776, 183, 'TOCACHE', NULL, NULL),
(1777, 183, 'UCHIZA', NULL, NULL),
(1778, 184, 'CAIRANI', NULL, NULL),
(1779, 184, 'CAMILACA', NULL, NULL),
(1780, 184, 'CANDARAVE', NULL, NULL),
(1781, 184, 'CURIBAYA', NULL, NULL),
(1782, 184, 'HUANUARA', NULL, NULL),
(1783, 184, 'QUILAHUANI', NULL, NULL),
(1784, 185, 'ILABAYA', NULL, NULL),
(1785, 185, 'ITE', NULL, NULL),
(1786, 185, 'LOCUMBA', NULL, NULL),
(1787, 186, 'ALTO DE LA ALIANZA', NULL, NULL),
(1788, 186, 'CALANA', NULL, NULL),
(1789, 186, 'CIUDAD NUEVA', NULL, NULL),
(1790, 186, 'GREGORIO ALBARRACIN LANCHIPA', NULL, NULL),
(1791, 186, 'INCLAN', NULL, NULL),
(1792, 186, 'PACHIA', NULL, NULL),
(1793, 186, 'PALCA', NULL, NULL),
(1794, 186, 'POCOLLAY', NULL, NULL),
(1795, 186, 'SAMA', NULL, NULL),
(1796, 186, 'TACNA', NULL, NULL),
(1797, 187, 'ESTIQUE', NULL, NULL),
(1798, 187, 'ESTIQUE-PAMPA', NULL, NULL),
(1799, 187, 'HEROES ALBARRACIN', NULL, NULL),
(1800, 187, 'SITAJARA', NULL, NULL),
(1801, 187, 'SUSAPAYA', NULL, NULL),
(1802, 187, 'TARATA', NULL, NULL),
(1803, 187, 'TARUCACHI', NULL, NULL),
(1804, 187, 'TICACO', NULL, NULL),
(1805, 188, 'CASITAS', NULL, NULL),
(1806, 188, 'ZORRITOS', NULL, NULL),
(1807, 189, 'CORRALES', NULL, NULL),
(1808, 189, 'LA CRUZ', NULL, NULL),
(1809, 189, 'PAMPAS DE HOSPITAL', NULL, NULL),
(1810, 189, 'SAN JACINTO', NULL, NULL),
(1811, 189, 'SAN JUAN DE LA VIRGEN', NULL, NULL),
(1812, 189, 'TUMBES', NULL, NULL),
(1813, 190, 'AGUAS VERDES', NULL, NULL),
(1814, 190, 'MATAPALO', NULL, NULL),
(1815, 190, 'PAPAYAL', NULL, NULL),
(1816, 190, 'ZARUMILLA', NULL, NULL),
(1817, 191, 'RAYMONDI', NULL, NULL),
(1818, 191, 'SEPAHUA', NULL, NULL),
(1819, 191, 'TAHUANIA', NULL, NULL),
(1820, 191, 'YURUA', NULL, NULL),
(1821, 192, 'CALLERIA', NULL, NULL),
(1822, 192, 'CAMPOVERDE', NULL, NULL),
(1823, 192, 'IPARIA', NULL, NULL),
(1824, 192, 'MASISEA', NULL, NULL),
(1825, 192, 'NUEVA REQUENA', NULL, NULL),
(1826, 192, 'YARINACOCHA', NULL, NULL),
(1827, 193, 'CURIMANA', NULL, NULL),
(1828, 193, 'IRAZOLA', NULL, NULL),
(1829, 193, 'PADRE ABAD', NULL, NULL),
(1830, 194, 'PURUS', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidads`
--

CREATE TABLE `especialidads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especialidads`
--

INSERT INTO `especialidads` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Itaque maiores.', 'Natus commodi cum libero ea asperiores velit. Aut praesentium officiis expedita animi expedita omnis. Iste provident ea earum rerum tenetur dolores doloribus.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(2, 'Possimus temporibus.', 'Reiciendis accusantium nisi maiores maiores. Quaerat accusantium id nihil a porro sint. Voluptatum eos doloribus tempora deleniti officia. Accusantium adipisci ut nihil ipsum id temporibus qui.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(3, 'Iusto id.', 'Autem rerum aut eligendi soluta et illum assumenda. Vitae omnis est ab. Ullam ut quasi molestiae quaerat qui rerum ipsam qui.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(4, 'Ab ut.', 'Sequi corrupti voluptatem omnis sint sunt quos incidunt. Nobis enim eum molestias eos.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(5, 'Id repellat.', 'Deleniti autem adipisci illo inventore eum. Explicabo voluptate suscipit commodi reiciendis.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(6, 'Repellat voluptas et.', 'Fugiat eum hic voluptatem perspiciatis cumque. Qui ipsa eum eum ut. Minus tenetur eligendi doloremque quod eaque quia eum voluptatem. Cumque sint aut velit dolores fugit eveniet.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(7, 'Fugiat est.', 'Modi minus error hic quia aliquam tenetur eos. Quae et aut mollitia dolore ut sunt et. Esse eos qui ipsam atque.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(8, 'Non aut earum.', 'Nemo numquam officia adipisci at ut non quia. Eius eaque assumenda voluptates debitis.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(9, 'Ullam facere.', 'Vero numquam voluptatem dolor quos voluptatem id. Quis nihil quam dolorem repellendus quibusdam. Natus voluptatem magni nisi dolorem.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(10, 'Labore nobis qui.', 'Tempora quia consequuntur dolorum autem ipsum non aut. Et quia vero atque aut inventore omnis. Iusto illum velit soluta ut.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(11, 'Et est.', 'Nisi voluptatum qui dolorum sit ut consectetur aut. Rerum accusamus voluptatem ut consequuntur. Cumque sint iste dolor. Alias quod dolorem velit dignissimos aliquid suscipit.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(12, 'Quo error veniam.', 'Quibusdam ipsam non nulla. Necessitatibus necessitatibus laudantium reiciendis est nihil. Labore id ipsam ut consequatur quia laborum. Qui nam ipsum nostrum consequatur at et impedit.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(13, 'Amet magni eos.', 'Officiis non dicta consequatur et. Aut aut sequi aut eius vel vero ratione quae. Laborum qui quo laudantium laborum consequatur.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(14, 'In placeat.', 'Assumenda ut a qui. Aliquam quibusdam quasi omnis autem ullam. Sunt blanditiis sint sint quis.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(15, 'Libero possimus.', 'Deleniti ducimus porro eligendi ut. Exercitationem non nulla consequatur magnam. Qui rerum quia sapiente est consequatur tenetur assumenda fugiat.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(16, 'Laborum possimus.', 'Assumenda beatae cumque qui. Quae eius modi dicta facilis et eligendi. Debitis quo iste error quo quia. Adipisci omnis et ea similique qui accusamus.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(17, 'Et nihil.', 'Maxime at provident omnis in. Magni fugiat repudiandae qui. Atque est velit consequatur maxime rerum dolorem. Amet et recusandae dolor alias odio tenetur asperiores qui.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(18, 'Eos ducimus aut.', 'Non delectus et ipsam quidem. Et veritatis non et quia et. Impedit quisquam aut quae doloribus.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(19, 'Quo aut.', 'Deserunt sed ut necessitatibus repellat et praesentium dolorem. Fugiat eum explicabo sint perspiciatis deleniti. Consequatur iusto illum quo molestiae. Aut nesciunt quia debitis aspernatur sunt.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(20, 'Aspernatur repellendus.', 'Facere sunt aut nihil voluptate. Maxime cum est quia ex. Quos voluptatum nesciunt velit mollitia ut quia cumque. Est enim quidem alias sit consequatur mollitia autem.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(21, 'Dolorem fugit.', 'Esse fugit expedita et quis amet non. Inventore maxime molestiae et commodi aperiam. Dolorem dolor autem commodi delectus ut.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(22, 'Excepturi accusantium aperiam.', 'Veritatis reiciendis exercitationem natus. Architecto voluptas eum aut culpa dolores doloremque. Omnis molestias minus itaque in cum totam voluptatem. Laborum dolore aliquid commodi vero aut.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(23, 'Quidem consequatur sint.', 'Consequuntur minima quasi et velit minima illum. In nemo voluptatem voluptatem. Maxime sit error dolores assumenda eius. Quia magni quia eaque laborum aliquam voluptatem voluptatibus.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(24, 'Accusamus ipsum.', 'Nesciunt sint dolorem nisi doloremque ut pariatur dolore. Labore non ipsum cumque voluptatibus rerum. Omnis sit sit at culpa esse eos magnam.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(25, 'Excepturi dicta.', 'Placeat at quae laudantium atque. Dolor officia blanditiis et ad. Incidunt consectetur dicta non sed consequatur. Magni aut vel et totam ab voluptatum voluptas.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(26, 'Non suscipit.', 'Eum minima temporibus qui accusamus dolor dicta dicta. Dolorem et eveniet ipsum est. Aut soluta magni quia reprehenderit. Alias dolores debitis aspernatur sequi.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(27, 'Culpa sit exercitationem.', 'Rem ipsa excepturi aut inventore. Enim dignissimos dolorem cumque est sed. Quia molestiae necessitatibus tempore ullam quis autem enim et.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(28, 'Aut incidunt.', 'Et fugiat provident culpa laboriosam. Beatae magnam quis aut. Dolorem quia cum molestiae quos ut.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(29, 'Natus voluptatem a.', 'Culpa modi vel a et. Possimus at dicta magnam officia et id. Dolorem incidunt ipsa et ut et perferendis laboriosam porro.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(30, 'Voluptas velit nostrum.', 'Consectetur voluptas nostrum reprehenderit perspiciatis. Itaque commodi eaque aliquam quia sed iure. Dolor eaque dolor non.', '2023-02-21 03:51:15', '2023-02-21 03:51:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagens`
--

CREATE TABLE `imagens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

CREATE TABLE `informes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_02_16_010354_create_sessions_table', 1),
(7, '2023_02_16_012931_create_sedes_table', 1),
(8, '2023_02_16_012932_create_especialidads_table', 1),
(9, '2023_02_16_012950_create_administradors_table', 1),
(10, '2023_02_16_013008_create_odontologos_table', 1),
(11, '2023_02_16_013009_create_clinicas_table', 1),
(12, '2023_02_16_013025_create_pacientes_table', 1),
(13, '2023_02_16_013026_create_odontologo_pacientes_table', 1),
(14, '2023_02_16_013027_create_clinica_pacientes_table', 1),
(15, '2023_02_16_013945_create_departamentos_table', 1),
(16, '2023_02_16_014002_create_provincias_table', 1),
(17, '2023_02_16_014020_create_distritos_table', 1),
(18, '2023_02_16_014037_create_direccions_table', 1),
(19, '2023_02_16_213438_create_servicios_table', 1),
(20, '2023_02_16_215423_create_ventas_table', 1),
(21, '2023_02_16_215430_create_venta_detalles_table', 1),
(22, '2023_02_16_215542_create_imagens_table', 1),
(23, '2023_02_16_215612_create_informes_table', 1),
(24, '2023_02_16_215659_create_canjeos_table', 1),
(25, '2023_02_16_215710_create_canjeo_detalles_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `odontologos`
--

CREATE TABLE `odontologos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `especialidad_id` bigint(20) UNSIGNED NOT NULL,
  `sede_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` enum('hombre','mujer') NOT NULL,
  `puntos` int(11) DEFAULT 0,
  `rol` varchar(255) DEFAULT 'odontologo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `odontologos`
--

INSERT INTO `odontologos` (`id`, `user_id`, `especialidad_id`, `sede_id`, `nombre`, `apellido`, `email`, `celular`, `fecha_nacimiento`, `genero`, `puntos`, `rol`, `created_at`, `updated_at`) VALUES
(1, 7, 29, 9, 'Clinton Wisoky', 'Klein', 'chase.west@example.org', '352.587.2373', '2022-12-02', 'hombre', 70, 'odontologo', '2023-01-07 22:58:35', '2023-02-21 03:51:16'),
(2, 8, 15, 10, 'Mariana Keeling', 'Purdy', 'rolfson.karianne@example.net', '951.608.7683', '2022-12-13', 'hombre', 20, 'odontologo', '2023-01-01 16:33:47', '2023-02-21 03:51:16'),
(3, 9, 23, 7, 'Mrs. Hillary Cruickshank', 'Bode', 'efranecki@example.com', '1-732-483-2838', '2022-11-25', 'hombre', 500, 'odontologo', '2023-01-13 15:25:55', '2023-02-21 03:51:16'),
(4, 10, 13, 3, 'Ellie Hill', 'Maggio', 'susanna.strosin@example.com', '+1 (828) 289-2766', '2022-11-23', 'hombre', 70, 'odontologo', '2023-01-16 16:40:39', '2023-02-21 03:51:16'),
(5, 11, 17, 9, 'Nelson Johnson', 'Becker', 'soledad.waelchi@example.com', '+1-267-458-3391', '2022-11-23', 'hombre', 70, 'odontologo', '2022-12-26 03:30:06', '2023-02-21 03:51:16'),
(6, 12, 14, 5, 'Rashawn Monahan', 'Bode', 'fhammes@example.net', '463.424.8404', '2022-11-21', 'mujer', 0, 'odontologo', '2022-12-25 11:52:24', '2023-02-21 03:51:16'),
(7, 13, 12, 7, 'Susie Orn', 'Jerde', 'rudy.beier@example.org', '260-553-6403', '2022-12-02', 'mujer', 70, 'odontologo', '2023-01-20 13:03:36', '2023-02-21 03:51:16'),
(8, 14, 27, 6, 'Jerald Hessel MD', 'Fritsch', 'ehaley@example.net', '762.814.0651', '2022-12-10', 'mujer', 20, 'odontologo', '2023-01-09 09:47:41', '2023-02-21 03:51:16'),
(9, 15, 8, 10, 'Dr. Shaniya Crooks III', 'Turner', 'deja.smitham@example.com', '781.704.5562', '2022-12-09', 'hombre', 70, 'odontologo', '2023-01-07 22:41:34', '2023-02-21 03:51:16'),
(10, 16, 5, 6, 'Shanon Wolff', 'McCullough', 'nayeli.heller@example.org', '+1.585.816.0935', '2022-12-06', 'hombre', 500, 'odontologo', '2023-01-04 22:25:42', '2023-02-21 03:51:16'),
(11, 17, 3, 6, 'Verna Donnelly', 'Monahan', 'mcclure.rasheed@example.org', '1-906-539-4552', '2022-12-05', 'hombre', 20, 'odontologo', '2022-12-25 06:01:56', '2023-02-21 03:51:16'),
(12, 18, 8, 3, 'Lauryn Hegmann', 'Breitenberg', 'vincent.williamson@example.org', '+1 (651) 861-6862', '2022-12-06', 'hombre', 70, 'odontologo', '2022-12-25 00:16:44', '2023-02-21 03:51:16'),
(13, 19, 25, 2, 'Crystel Little', 'Homenick', 'dexter05@example.com', '1-828-567-2689', '2022-12-11', 'mujer', 500, 'odontologo', '2023-01-15 17:40:15', '2023-02-21 03:51:16'),
(14, 20, 26, 7, 'Dr. Liana Graham', 'Spencer', 'huels.triston@example.com', '234.384.5906', '2022-11-28', 'mujer', 70, 'odontologo', '2023-01-11 13:20:10', '2023-02-21 03:51:16'),
(15, 21, 10, 6, 'Prof. Dorcas Muller', 'Rolfson', 'kurt.collins@example.com', '1-607-446-0194', '2022-12-11', 'hombre', 500, 'odontologo', '2022-12-28 08:16:20', '2023-02-21 03:51:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `odontologo_paciente`
--

CREATE TABLE `odontologo_paciente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED NOT NULL,
  `odontologo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `odontologo_paciente`
--

INSERT INTO `odontologo_paciente` (`id`, `paciente_id`, `odontologo_id`, `created_at`, `updated_at`) VALUES
(1, 1, 13, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 11, NULL, NULL),
(4, 3, 5, NULL, NULL),
(5, 4, 11, NULL, NULL),
(6, 5, 3, NULL, NULL),
(7, 6, 14, NULL, NULL),
(8, 7, 3, NULL, NULL),
(9, 7, 4, NULL, NULL),
(10, 8, 1, NULL, NULL),
(11, 8, 3, NULL, NULL),
(12, 9, 6, NULL, NULL),
(13, 10, 4, NULL, NULL),
(14, 10, 10, NULL, NULL),
(15, 11, 7, NULL, NULL),
(16, 12, 13, NULL, NULL),
(17, 13, 4, NULL, NULL),
(18, 13, 13, NULL, NULL),
(19, 14, 12, NULL, NULL),
(20, 15, 10, NULL, NULL),
(21, 15, 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sede_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` enum('hombre','mujer') NOT NULL,
  `rol` varchar(255) DEFAULT 'paciente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `user_id`, `sede_id`, `nombre`, `apellido`, `email`, `celular`, `fecha_nacimiento`, `genero`, `rol`, `created_at`, `updated_at`) VALUES
(1, 37, 4, 'Jeffery Buckridge', 'Jenkins', 'howe.lessie@example.com', '(781) 391-1377', '2022-12-16', 'mujer', 'paciente', '2022-12-25 10:15:41', '2023-02-21 03:51:18'),
(2, 38, 2, 'Hubert Dibbert', 'Flatley', 'breitenberg.michelle@example.net', '+1 (959) 914-5197', '2022-11-28', 'mujer', 'paciente', '2022-12-31 20:09:53', '2023-02-21 03:51:18'),
(3, 39, 8, 'Jailyn Schultz', 'Buckridge', 'ikertzmann@example.com', '+1 (469) 560-4436', '2022-11-24', 'mujer', 'paciente', '2023-01-16 23:35:55', '2023-02-21 03:51:18'),
(4, 40, 1, 'Jerel Lynch Sr.', 'Bailey', 'gbradtke@example.net', '(207) 334-2192', '2022-12-11', 'hombre', 'paciente', '2023-01-07 02:07:57', '2023-02-21 03:51:18'),
(5, 41, 3, 'Mr. Talon Gerhold', 'Daniel', 'turcotte.esmeralda@example.org', '+1-458-243-0118', '2022-12-20', 'mujer', 'paciente', '2023-01-04 16:09:53', '2023-02-21 03:51:18'),
(6, 42, 4, 'Dr. Dillan Moore III', 'Mitchell', 'camren62@example.com', '(540) 565-7499', '2022-12-05', 'hombre', 'paciente', '2023-01-12 02:52:06', '2023-02-21 03:51:18'),
(7, 43, 6, 'Coleman Gusikowski V', 'Moen', 'eondricka@example.org', '1-272-926-3191', '2022-12-05', 'hombre', 'paciente', '2023-01-08 18:18:46', '2023-02-21 03:51:18'),
(8, 44, 3, 'Dr. Raleigh Blanda IV', 'Upton', 'maye.considine@example.com', '+1-458-671-1339', '2022-12-16', 'mujer', 'paciente', '2023-01-09 16:14:43', '2023-02-21 03:51:18'),
(9, 45, 1, 'Dr. Ernestina Ondricka', 'Gerhold', 'nokeefe@example.net', '+15167535287', '2022-11-25', 'mujer', 'paciente', '2022-12-30 22:53:45', '2023-02-21 03:51:18'),
(10, 46, 4, 'Cornell Gaylord V', 'Runolfsdottir', 'dessie.mayer@example.net', '443.490.4326', '2022-12-15', 'hombre', 'paciente', '2023-01-16 18:28:42', '2023-02-21 03:51:18'),
(11, 47, 2, 'Major Mante', 'Pouros', 'wisozk.sammie@example.net', '1-785-319-3636', '2022-11-27', 'mujer', 'paciente', '2022-12-25 23:37:47', '2023-02-21 03:51:18'),
(12, 48, 4, 'Erick McLaughlin', 'Trantow', 'effertz.casandra@example.com', '+1 (629) 556-7257', '2022-12-07', 'hombre', 'paciente', '2023-01-04 10:15:30', '2023-02-21 03:51:18'),
(13, 49, 9, 'Dr. Sid Boyle PhD', 'Leannon', 'webster32@example.net', '1-346-976-7293', '2022-12-13', 'hombre', 'paciente', '2023-01-04 20:53:40', '2023-02-21 03:51:18'),
(14, 50, 1, 'Deanna Sipes MD', 'Gerlach', 'kuhn.luigi@example.org', '706-890-8776', '2022-11-29', 'mujer', 'paciente', '2023-01-02 13:29:48', '2023-02-21 03:51:18'),
(15, 51, 6, 'Miss Verlie Hartmann', 'Schmeler', 'marta74@example.net', '737.887.6468', '2022-11-27', 'hombre', 'paciente', '2022-12-28 03:40:09', '2023-02-21 03:51:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departamento_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `departamento_id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'BAGUA', NULL, NULL),
(2, 1, 'BONGARA', NULL, NULL),
(3, 1, 'CHACHAPOYAS', NULL, NULL),
(4, 1, 'CONDORCANQUI', NULL, NULL),
(5, 1, 'LUYA', NULL, NULL),
(6, 1, 'RODRIGUEZ DE MENDOZA', NULL, NULL),
(7, 1, 'UTCUBAMBA', NULL, NULL),
(8, 2, 'AIJA', NULL, NULL),
(9, 2, 'ANTONIO RAYMONDI', NULL, NULL),
(10, 2, 'ASUNCION', NULL, NULL),
(11, 2, 'BOLOGNESI', NULL, NULL),
(12, 2, 'CARHUAZ', NULL, NULL),
(13, 2, 'CARLOS F.FITZCARRALD', NULL, NULL),
(14, 2, 'CASMA', NULL, NULL),
(15, 2, 'CORONGO', NULL, NULL),
(16, 2, 'HUARAZ', NULL, NULL),
(17, 2, 'HUARI', NULL, NULL),
(18, 2, 'HUARMEY', NULL, NULL),
(19, 2, 'HUAYLAS', NULL, NULL),
(20, 2, 'MARISCAL LUZURIAGA', NULL, NULL),
(21, 2, 'OCROS', NULL, NULL),
(22, 2, 'PALLASCA', NULL, NULL),
(23, 2, 'POMABAMBA', NULL, NULL),
(24, 2, 'RECUAY', NULL, NULL),
(25, 2, 'SANTA', NULL, NULL),
(26, 2, 'SIHUAS', NULL, NULL),
(27, 2, 'YUNGAY', NULL, NULL),
(28, 3, 'ABANCAY', NULL, NULL),
(29, 3, 'ANDAHUAYLAS', NULL, NULL),
(30, 3, 'ANTABAMBA', NULL, NULL),
(31, 3, 'AYMARAES', NULL, NULL),
(32, 3, 'CHINCHEROS', NULL, NULL),
(33, 3, 'COTABAMBAS', NULL, NULL),
(34, 3, 'GRAU', NULL, NULL),
(35, 4, 'AREQUIPA', NULL, NULL),
(36, 4, 'CAMANA', NULL, NULL),
(37, 4, 'CARAVELI', NULL, NULL),
(38, 4, 'CASTILLA', NULL, NULL),
(39, 4, 'CAYLLOMA', NULL, NULL),
(40, 4, 'CONDESUYOS', NULL, NULL),
(41, 4, 'ISLAY', NULL, NULL),
(42, 4, 'LA UNION', NULL, NULL),
(43, 5, 'CANGALLO', NULL, NULL),
(44, 5, 'HUAMANGA', NULL, NULL),
(45, 5, 'HUANCA SANCOS', NULL, NULL),
(46, 5, 'HUANTA', NULL, NULL),
(47, 5, 'LA MAR', NULL, NULL),
(48, 5, 'LUCANAS', NULL, NULL),
(49, 5, 'PARINACOCHAS', NULL, NULL),
(50, 5, 'PAUCAR DEL SARA SARA', NULL, NULL),
(51, 5, 'SUCRE', NULL, NULL),
(52, 5, 'VICTOR FAJARDO', NULL, NULL),
(53, 5, 'VILCASHUAMAN', NULL, NULL),
(54, 6, 'CAJABAMBA', NULL, NULL),
(55, 6, 'CAJAMARCA', NULL, NULL),
(56, 6, 'CELENDIN', NULL, NULL),
(57, 6, 'CHOTA', NULL, NULL),
(58, 6, 'CONTUMAZA', NULL, NULL),
(59, 6, 'CUTERVO', NULL, NULL),
(60, 6, 'HUALGAYOC', NULL, NULL),
(61, 6, 'JAEN', NULL, NULL),
(62, 6, 'SAN IGNACIO', NULL, NULL),
(63, 6, 'SAN MARCOS', NULL, NULL),
(64, 6, 'SAN MIGUEL', NULL, NULL),
(65, 6, 'SAN PABLO', NULL, NULL),
(66, 6, 'SANTA CRUZ', NULL, NULL),
(67, 7, 'ACOMAYO', NULL, NULL),
(68, 7, 'ANTA', NULL, NULL),
(69, 7, 'CALCA', NULL, NULL),
(70, 7, 'CANAS', NULL, NULL),
(71, 7, 'CANCHIS', NULL, NULL),
(72, 7, 'CHUMBIVILCAS', NULL, NULL),
(73, 7, 'CUSCO', NULL, NULL),
(74, 7, 'ESPINAR', NULL, NULL),
(75, 7, 'LA CONVENCION', NULL, NULL),
(76, 7, 'PARURO', NULL, NULL),
(77, 7, 'PAUCARTAMBO', NULL, NULL),
(78, 7, 'QUISPICANCHI', NULL, NULL),
(79, 7, 'URUBAMBA', NULL, NULL),
(80, 8, 'ACOBAMBA', NULL, NULL),
(81, 8, 'ANGARAES', NULL, NULL),
(82, 8, 'CASTROVIRREYNA', NULL, NULL),
(83, 8, 'CHURCAMPA', NULL, NULL),
(84, 8, 'HUANCAVELICA', NULL, NULL),
(85, 8, 'HUAYTARA', NULL, NULL),
(86, 8, 'TAYACAJA', NULL, NULL),
(87, 9, 'AMBO', NULL, NULL),
(88, 9, 'DOS DE MAYO', NULL, NULL),
(89, 9, 'HUACAYBAMBA', NULL, NULL),
(90, 9, 'HUAMALIES', NULL, NULL),
(91, 9, 'HUANUCO', NULL, NULL),
(92, 9, 'LAURICOCHA', NULL, NULL),
(93, 9, 'LEONCIO PRADO', NULL, NULL),
(94, 9, 'MARAÑON', NULL, NULL),
(95, 9, 'PACHITEA', NULL, NULL),
(96, 9, 'PUERTO INCA', NULL, NULL),
(97, 9, 'YAROWILCA', NULL, NULL),
(98, 10, 'CHINCHA', NULL, NULL),
(99, 10, 'ICA', NULL, NULL),
(100, 10, 'NAZCA', NULL, NULL),
(101, 10, 'PALPA', NULL, NULL),
(102, 10, 'PISCO', NULL, NULL),
(103, 11, 'CHANCHAMAYO', NULL, NULL),
(104, 11, 'CHUPACA', NULL, NULL),
(105, 11, 'CONCEPCION', NULL, NULL),
(106, 11, 'HUANCAYO', NULL, NULL),
(107, 11, 'JAUJA', NULL, NULL),
(108, 11, 'JUNIN', NULL, NULL),
(109, 11, 'SATIPO', NULL, NULL),
(110, 11, 'TARMA', NULL, NULL),
(111, 11, 'YAULI', NULL, NULL),
(112, 12, 'ASCOPE', NULL, NULL),
(113, 12, 'BOLIVAR', NULL, NULL),
(114, 12, 'CHEPEN', NULL, NULL),
(115, 12, 'GRAN CHIMU', NULL, NULL),
(116, 12, 'JULCAN', NULL, NULL),
(117, 12, 'OTUZCO', NULL, NULL),
(118, 12, 'PACASMAYO', NULL, NULL),
(119, 12, 'PATAZ', NULL, NULL),
(120, 12, 'SANCHEZ CARRION', NULL, NULL),
(121, 12, 'SANTIAGO DE CHUCO', NULL, NULL),
(122, 12, 'TRUJILLO', NULL, NULL),
(123, 12, 'VIRU', NULL, NULL),
(124, 13, 'CHICLAYO', NULL, NULL),
(125, 13, 'FERREÑAFE', NULL, NULL),
(126, 13, 'LAMBAYEQUE', NULL, NULL),
(127, 14, 'BARRANCA', NULL, NULL),
(128, 14, 'CAJATAMBO', NULL, NULL),
(129, 14, 'CALLAO', NULL, NULL),
(130, 14, 'CANTA', NULL, NULL),
(131, 14, 'CAÑETE', NULL, NULL),
(132, 14, 'HUARAL', NULL, NULL),
(133, 14, 'HUAROCHIRI', NULL, NULL),
(134, 14, 'HUAURA', NULL, NULL),
(135, 14, 'LIMA', NULL, NULL),
(136, 14, 'OYON', NULL, NULL),
(137, 14, 'YAUYOS', NULL, NULL),
(138, 15, 'ALTO AMAZONAS', NULL, NULL),
(139, 15, 'LORETO', NULL, NULL),
(140, 15, 'MARISCAL R.CASTILLA', NULL, NULL),
(141, 15, 'MAYNAS', NULL, NULL),
(142, 15, 'REQUENA', NULL, NULL),
(143, 15, 'UCAYALI', NULL, NULL),
(144, 16, 'MANU', NULL, NULL),
(145, 16, 'TAHUAMANU', NULL, NULL),
(146, 16, 'TAMBOPATA', NULL, NULL),
(147, 17, 'GENERAL SANCHEZ CERRO', NULL, NULL),
(148, 17, 'ILO', NULL, NULL),
(149, 17, 'MARISCAL NIETO', NULL, NULL),
(150, 18, 'DANIEL ALCIDES CARRION', NULL, NULL),
(151, 18, 'OXAPAMPA', NULL, NULL),
(152, 18, 'PASCO', NULL, NULL),
(153, 19, 'AYABACA', NULL, NULL),
(154, 19, 'HUANCABAMBA', NULL, NULL),
(155, 19, 'MORROPON', NULL, NULL),
(156, 19, 'PAITA', NULL, NULL),
(157, 19, 'PIURA', NULL, NULL),
(158, 19, 'SECHURA', NULL, NULL),
(159, 19, 'SULLANA', NULL, NULL),
(160, 19, 'TALARA', NULL, NULL),
(161, 20, 'AZANGARO', NULL, NULL),
(162, 20, 'CARABAYA', NULL, NULL),
(163, 20, 'CHUCUITO', NULL, NULL),
(164, 20, 'EL COLLAO', NULL, NULL),
(165, 20, 'HUANCANE', NULL, NULL),
(166, 20, 'LAMPA', NULL, NULL),
(167, 20, 'MELGAR', NULL, NULL),
(168, 20, 'MOHO', NULL, NULL),
(169, 20, 'PUNO', NULL, NULL),
(170, 20, 'SAN ANTONIO DE PUTINA', NULL, NULL),
(171, 20, 'SAN ROMAN', NULL, NULL),
(172, 20, 'SANDIA', NULL, NULL),
(173, 20, 'YUNGUYO', NULL, NULL),
(174, 21, 'BELLAVISTA', NULL, NULL),
(175, 21, 'EL DORADO', NULL, NULL),
(176, 21, 'HUALLAGA', NULL, NULL),
(177, 21, 'LAMAS', NULL, NULL),
(178, 21, 'MARISCAL CACERES', NULL, NULL),
(179, 21, 'MOYOBAMBA', NULL, NULL),
(180, 21, 'PICOTA', NULL, NULL),
(181, 21, 'RIOJA', NULL, NULL),
(182, 21, 'SAN MARTIN', NULL, NULL),
(183, 21, 'TOCACHE', NULL, NULL),
(184, 22, 'CANDARAVE', NULL, NULL),
(185, 22, 'JORGE BASADRE', NULL, NULL),
(186, 22, 'TACNA', NULL, NULL),
(187, 22, 'TARATA', NULL, NULL),
(188, 23, 'CONTRALMIRANTE VILLAR', NULL, NULL),
(189, 23, 'TUMBES', NULL, NULL),
(190, 23, 'ZARUMILLA', NULL, NULL),
(191, 24, 'ATALAYA', NULL, NULL),
(192, 24, 'CORONEL PORTILLO', NULL, NULL),
(193, 24, 'PADRE ABAD', NULL, NULL),
(194, 24, 'PURUS', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Amet optio esse.', 'Et earum fugiat impedit. Nihil sed tempora aut cum quos magnam. Maxime sed illum nesciunt molestias repellendus exercitationem rem.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(2, 'Facere quia eum.', 'Suscipit quibusdam rerum corporis sunt. Est nobis nulla ut distinctio velit hic eum.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(3, 'Inventore minima.', 'Unde maiores tempora est illum quam illum debitis enim. Aspernatur architecto laboriosam distinctio eius placeat. Veritatis laborum ullam natus eaque.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(4, 'Rem dolorem.', 'Vel tempore tempore qui illum a. Fugiat voluptatum at est quo. Necessitatibus adipisci in voluptatem.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(5, 'Provident dolorem id.', 'Sit et aliquid ex facilis quo. Vel soluta ut sint adipisci autem ea omnis.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(6, 'Fugiat cum.', 'Quidem perferendis rerum eligendi eos qui sit. Ullam accusantium excepturi est autem delectus odio veniam. Veritatis earum dolores ad dolor eos libero ut laudantium.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(7, 'Ut quasi quia.', 'Quia et atque dolores. Repellendus dolores similique et reprehenderit et.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(8, 'Voluptatem minus.', 'Pariatur velit sed quidem. Error laboriosam atque tenetur doloribus sed at. Sapiente expedita tenetur minus numquam qui.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(9, 'Omnis cumque eveniet.', 'Id dolorum deserunt rerum neque aut omnis. Est quas cum quae non consequatur aliquid. Magni perspiciatis aut dolor omnis quibusdam.', '2023-02-21 03:51:15', '2023-02-21 03:51:15'),
(10, 'Et aut ut.', 'Voluptatem voluptatem consequatur sint nobis molestiae voluptates rem cum. Tempore sint laudantium saepe dolores. Praesentium amet consequatur sit dolores dolores repellendus. Aut incidunt at cum.', '2023-02-21 03:51:15', '2023-02-21 03:51:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio_venta` double(8,2) NOT NULL,
  `descripcion` text NOT NULL,
  `puntos_ganar` int(11) NOT NULL DEFAULT 0,
  `puntos_canjeo` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `precio_venta`, `descripcion`, `puntos_ganar`, `puntos_canjeo`, `created_at`, `updated_at`) VALUES
(1, 'A ut.', 1400.00, 'In est accusantium omnis est. Autem dolor minus inventore modi. Id sapiente porro voluptates laborum est quia.', 5, 500, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(2, 'Non eaque sit.', 1500.00, 'Aperiam quas dignissimos quibusdam ab omnis. Quia corrupti dicta in velit fugiat. Sequi numquam rerum culpa totam atque nostrum. Reiciendis accusantium repellat libero sed.', 30, 200, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(3, 'In in.', 1000.00, 'Nisi explicabo ut sapiente fugiat ab. Ducimus aperiam sint dolorum sint vel rerum. Ex laboriosam saepe repellendus sit.', 5, 500, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(4, 'Sed consequatur officia.', 1500.00, 'Nam nemo rem repellendus aut. Quibusdam nihil voluptas quo. Exercitationem fugit repellat illum tempore sed architecto quia. Est et accusantium minima explicabo ut itaque id. Cum id quis blanditiis.', 10, 100, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(5, 'Non dolores et.', 1200.00, 'Voluptatibus ea ad blanditiis nemo molestiae veniam id. Sit repudiandae nihil autem at est omnis.', 5, 400, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(6, 'Harum eaque.', 1000.00, 'Tempore laboriosam non aut eaque. Officiis consequuntur fugit eveniet eius qui. Earum voluptatum laboriosam eius asperiores voluptas corrupti.', 4, 400, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(7, 'Inventore ipsam tempora.', 1200.00, 'Sint quae ut quis voluptatum nostrum. Et est dolorem sed ut ut vel. Aspernatur et sapiente hic sit officia doloribus repellendus. Molestias doloribus quia voluptas et porro voluptatum.', 4, 500, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(8, 'Repellat nostrum voluptas.', 1500.00, 'A distinctio laudantium aperiam beatae. Delectus ut vitae incidunt debitis dignissimos. Quibusdam quo quas vero asperiores voluptatem sit blanditiis. Iste soluta tempore beatae illum aut.', 5, 100, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(9, 'Fuga ea.', 1200.00, 'Sit minima modi numquam nesciunt fuga officiis. Iure esse hic consequatur qui. Rerum est nam illum modi velit cumque assumenda sint. Ducimus nemo ipsum consequatur dicta qui quia amet.', 30, 100, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(10, 'Libero aut ducimus.', 1200.00, 'Facere ducimus aut explicabo minus. Laudantium ut aut voluptatem occaecati vel sed. Odio ducimus occaecati numquam aut ut minus.', 20, 200, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(11, 'Quia velit.', 1000.00, 'Soluta quo enim ipsa ea. Voluptas inventore qui exercitationem eligendi voluptatem.', 5, 100, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(12, 'Corrupti sint.', 1400.00, 'Et ea laboriosam occaecati. Qui commodi sint repudiandae nesciunt veritatis id dicta. Rem laudantium maxime perferendis. Culpa sint quos laudantium vitae aut.', 5, 100, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(13, 'Aut qui quis.', 1000.00, 'Et ea autem sed sit nemo. Ex molestiae soluta ab ad officia possimus culpa. Explicabo ut unde et hic.', 5, 200, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(14, 'Facere odit.', 1400.00, 'Asperiores doloribus porro corporis ipsa qui. Et consectetur maiores hic delectus quo quisquam. Itaque quis corporis in a.', 5, 500, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(15, 'Quam vitae.', 1000.00, 'Voluptatem voluptas corrupti qui iste alias. Totam recusandae inventore autem et doloribus. Maxime debitis aliquid quod est. Magni aperiam sint qui animi illo iure.', 30, 500, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(16, 'Animi et aliquid.', 1500.00, 'Sunt est distinctio autem magni. Est a consequatur officia ullam. Non magni ipsa et fugit accusantium ut cum nemo. Ut necessitatibus aut quo delectus molestiae.', 20, 400, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(17, 'Reiciendis asperiores quisquam.', 1500.00, 'Est vitae voluptatem sequi distinctio dolor. Ut provident sed nulla. Est voluptatem quia ea animi. Quia ad voluptatum provident ut.', 4, 200, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(18, 'Maxime voluptatem.', 1000.00, 'Ut ab soluta accusamus quam. Ab id qui laboriosam eum autem quis adipisci. At voluptatibus saepe esse dicta.', 30, 400, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(19, 'Est et.', 1400.00, 'Tempore est natus incidunt et deleniti et atque. Eum molestias atque veritatis soluta ea nisi. Qui totam expedita maiores reprehenderit eos voluptatem.', 4, 500, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(20, 'Voluptatem iusto.', 1200.00, 'Itaque vitae excepturi molestias error adipisci. Eveniet et temporibus velit expedita quia quia vel. A voluptas laborum reiciendis veritatis dicta sapiente ea voluptates.', 5, 100, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(21, 'Officiis id voluptas.', 1500.00, 'Et accusamus aut dolorem. Aut error distinctio ut accusantium fugit voluptas. Libero qui illum minus sunt. Eligendi dolores occaecati dolore reprehenderit minima tempora.', 4, 300, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(22, 'Possimus suscipit dolore.', 1000.00, 'Blanditiis quasi expedita animi totam et ea officia harum. Et sint beatae ab eligendi. Repudiandae voluptatum suscipit dolores.', 30, 300, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(23, 'Atque ea molestiae.', 1400.00, 'Qui occaecati accusamus quia at quod similique. Doloribus iure odio totam optio. Quia est ut et illo error delectus.', 20, 100, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(24, 'Cum corrupti.', 1400.00, 'Sed tenetur nulla repellat recusandae quia. Eligendi perferendis dolorem voluptas dolorum. Exercitationem ut impedit labore.', 5, 100, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(25, 'Amet possimus doloremque.', 1000.00, 'Cumque est et odit vitae magni sit pariatur esse. A non placeat dolores. Aut quo delectus unde voluptas inventore sit. Fugit quis ea earum. Recusandae numquam eaque iure nesciunt dolores ipsa.', 30, 400, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(26, 'Iusto deleniti veniam.', 1200.00, 'Accusamus nostrum accusamus quia rerum ducimus odit. Quod laudantium adipisci quidem et labore. Nisi ea perspiciatis exercitationem eaque nulla. Perspiciatis non sunt aperiam voluptas.', 10, 400, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(27, 'Ex consequuntur.', 1200.00, 'Consequatur libero animi et ab facere sit. Repudiandae consequatur aliquid rerum odit aperiam et. Atque quia dolorem quis quidem libero.', 10, 200, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(28, 'Reiciendis dolorem nesciunt.', 1400.00, 'Quibusdam dolorem quas velit error illum veniam. Quidem sit architecto omnis ipsa aut. Explicabo ratione quibusdam enim mollitia autem sed.', 30, 200, '2023-02-21 03:51:19', '2023-02-21 03:51:19'),
(29, 'Voluptas in vel.', 1200.00, 'At vero quo modi molestiae consectetur error error. Ducimus consequatur doloremque et aliquam repellendus neque sed ducimus. Accusantium magni ratione ullam officia voluptates distinctio eius.', 5, 100, '2023-02-21 03:51:19', '2023-02-21 03:51:19'),
(30, 'Adipisci nesciunt.', 1000.00, 'Voluptatum quisquam quae architecto quod. Esse magnam quibusdam corporis voluptas quia sunt. Laudantium saepe cum est ab ducimus ut.', 10, 500, '2023-02-21 03:51:19', '2023-02-21 03:51:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NrWdrm1UrQdY3advesp1MpheNLAgVmN5rqsmtO7e', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidGgzOUNyb3d3WjFFNzVJRkk4Zm1jb09PaUsyMWFkZUtiQXI2S0FWNCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjU0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW5pc3RyYWRvci9zZWRlLzEvaW5mb3JtYWNpb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1676934535);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `rol` enum('administrador','odontologo','clinica','paciente') NOT NULL DEFAULT 'odontologo',
  `dni` varchar(255) DEFAULT NULL,
  `cop` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `rol`, `dni`, `cop`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'sheridan11@example.com', '2023-02-21 03:51:15', '$2y$10$uk8uh8XNBwj32zRIyCfcluk7jbw3EYPDpf7D7nPjyZZopBOdsoYMC', NULL, NULL, NULL, 'administrador', '9532296', '762424', '17VUDni3iG', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(2, 'margret93@example.com', '2023-02-21 03:51:15', '$2y$10$UC1pKtHy6mT6F3qXoUJ7lOo.plbO67FpiZAQl8fMgDXL.5txmWPaC', NULL, NULL, NULL, 'administrador', '8214047', '898977', 'edMDkyn1vE', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(3, 'aniya.hoppe@example.net', '2023-02-21 03:51:15', '$2y$10$oQb0T2m6LHwe.BntZRr8c.c46k2EADeW8apdI9OScG7vCe7qwr5pm', NULL, NULL, NULL, 'administrador', '3382532', '340607', 'c86ciQIkts', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(4, 'lebsack.darron@example.net', '2023-02-21 03:51:15', '$2y$10$aDtZ99kNDjGgfgodccDeZeLBnV6oM6aBEnIs7hZWATGZ8fBt4HYS.', NULL, NULL, NULL, 'administrador', '4644980', '942557', 'znSpiYdppb', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(5, 'bertrand.jacobson@example.net', '2023-02-21 03:51:15', '$2y$10$qzncjbP9WSN4GZo3r4BrSObj8O3jjkBG/dxehpoPopc6uGZqXrxbe', NULL, NULL, NULL, 'administrador', '3197487', '265949', 'Ez6GDscoHV', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(6, 'cristian28@example.net', '2023-02-21 03:51:15', '$2y$10$CNNETp9On2Fkuf2Ko7owG.OHAG3mwuWitbvmRW7iksVTZ4nV/wVEq', NULL, NULL, NULL, 'administrador', '5300779', '687209', 'wKyX2aWbuq', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(7, 'chase.west@example.org', '2023-02-21 03:51:16', '$2y$10$kQ3b.42PPtpYcNU9eVRkH./86ciDTBEEDmoeOxUDYPewCACjLePeq', NULL, NULL, NULL, 'odontologo', '7377962', '558745', 'oDZ7EEjzIS', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(8, 'rolfson.karianne@example.net', '2023-02-21 03:51:16', '$2y$10$byTDI8qLFdh2GMc5y17AnuzF.q2G/DJszQYfXHZj9NbDH1aWHX1AC', NULL, NULL, NULL, 'odontologo', '3166692', '974497', 'cZd77DgZBK', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(9, 'efranecki@example.com', '2023-02-21 03:51:16', '$2y$10$eNvS3t9DNDvQeUB7Tc9IiOCSF/terPVuZLx.JJPu90L/T0JZDsoNC', NULL, NULL, NULL, 'odontologo', '7887327', '451955', 'sTQlxNceaf', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(10, 'susanna.strosin@example.com', '2023-02-21 03:51:16', '$2y$10$dHzB/VHMnWWp2ARPo0QNSOly.c.zifmn0WHrdhXdzKwGxZ9yYYfve', NULL, NULL, NULL, 'odontologo', '4918977', '914504', 'wVtExdiO8S', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(11, 'soledad.waelchi@example.com', '2023-02-21 03:51:16', '$2y$10$9ldT4v.cF2Lh4lsuhYfdVOZ3Q2Ah.kJs.J81wUC.pYGjnZxU1XPuW', NULL, NULL, NULL, 'odontologo', '8306928', '736115', 'svbANjySpT', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(12, 'fhammes@example.net', '2023-02-21 03:51:16', '$2y$10$9j1ZyaICO41THmEYnJUyV.ZgMFdh2diX08nOxHWTEYxi.vOC9qyOe', NULL, NULL, NULL, 'odontologo', '1865914', '626381', 'hKI4BBTozs', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(13, 'rudy.beier@example.org', '2023-02-21 03:51:16', '$2y$10$bDclKukyms1ZlYSG62tKVu5uhbDM/bkp3WvDC.MmGSX7pqSw2dH3y', NULL, NULL, NULL, 'odontologo', '6890707', '804655', 'wUneOJ6Gzc', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(14, 'ehaley@example.net', '2023-02-21 03:51:16', '$2y$10$JdVXClSgjkYZlI78EGa4fuFiPTounWNa0ixNp/XumQrr6J3IZuIeC', NULL, NULL, NULL, 'odontologo', '8319875', '669934', 'Jy1ZKpDY4m', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(15, 'deja.smitham@example.com', '2023-02-21 03:51:16', '$2y$10$xAUioAL/d8rsQ8rYd/mGMO0LxmJ5Tv3kFZPvFX9rZ9t5qHFv7RYmu', NULL, NULL, NULL, 'odontologo', '2060215', '248464', 'TJVNnRH36r', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(16, 'nayeli.heller@example.org', '2023-02-21 03:51:16', '$2y$10$9s91PWzVuxyzfUvadP8LUeC4dXQ1Uy3OVqFwuGxzSMGq/xECd13tu', NULL, NULL, NULL, 'odontologo', '7267750', '780165', 'siHSaWgVZ5', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(17, 'mcclure.rasheed@example.org', '2023-02-21 03:51:16', '$2y$10$VNtQlsR9C7mTgyvjwna29.Q5lo03Bd4O3hssz20NAZ26pZAp2XPpK', NULL, NULL, NULL, 'odontologo', '1083729', '836261', 'oLdIhkGTvX', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(18, 'vincent.williamson@example.org', '2023-02-21 03:51:16', '$2y$10$5Ccc11dM3pJtBFOuCI0asO9nbzvPogOmgIgwcE3dm86gfXDYv122G', NULL, NULL, NULL, 'odontologo', '3230431', '145812', 'LSkimoXcxU', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(19, 'dexter05@example.com', '2023-02-21 03:51:16', '$2y$10$JBGVv3QACkJNg0cf7NtTZORuPfdo48CFs.fqHJbwtA2/w0WK5qzae', NULL, NULL, NULL, 'odontologo', '9975088', '395477', 'DFMHWPw0vx', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(20, 'huels.triston@example.com', '2023-02-21 03:51:16', '$2y$10$9KKeA9nhA4KWGa4b9kiR.eTVXzXYao7p5xxIUrzOtTb5xF90R.KQm', NULL, NULL, NULL, 'odontologo', '1485238', '993789', 'FVFuPw96DJ', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(21, 'kurt.collins@example.com', '2023-02-21 03:51:16', '$2y$10$oYq4dIcWoR6gbcjQTq74KeHAdO705DAoBlVMs7MlEmVheeKGP8RDC', NULL, NULL, NULL, 'odontologo', '4433963', '952506', 'fZ5r8LtaXQ', NULL, NULL, '2023-02-21 03:51:16', '2023-02-21 03:51:16'),
(22, 'goodwin.isadore@example.com', '2023-02-21 03:51:16', '$2y$10$Yt.q2OjpgT/Xg2rVFh5p6uqomEOPWHrCnkavkPmFwfG1VfqfwDYvS', NULL, NULL, NULL, 'clinica', '7177564', '805467', 'QI9p7q4Spz', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(23, 'ransom.kreiger@example.net', '2023-02-21 03:51:16', '$2y$10$bAuirOcTe53EqPuhPLsHiuJuXl9F6Imz0GvbDGDpwwVs2dnwHLWBG', NULL, NULL, NULL, 'clinica', '8240925', '598495', '2q5fP2FK0t', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(24, 'gordon.murazik@example.org', '2023-02-21 03:51:17', '$2y$10$VfGH/k5U1nO8yzAOK.uUye27Yn4R6jtoj378DXMP1rIcJncuKkpI.', NULL, NULL, NULL, 'clinica', '8525375', '161053', 'T93MD5gO8L', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(25, 'miller.marina@example.org', '2023-02-21 03:51:17', '$2y$10$hRStrCEShElD4.tkrEMtnOSaDj200J5GrzQj79ia.OTp1biZ/A9NW', NULL, NULL, NULL, 'clinica', '7842959', '898291', 'jXmrLBOWbH', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(26, 'cecilia71@example.net', '2023-02-21 03:51:17', '$2y$10$EBKl8XFcxPiaSymHmTlKUOyJhPr6N1EtfIkK1oKiT9jkGTJkfM7Q2', NULL, NULL, NULL, 'clinica', '5112723', '636129', 'KnsqkL1nDV', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(27, 'bogisich.bart@example.org', '2023-02-21 03:51:17', '$2y$10$FyP9GUAZ6uhksHuknNk4EuJvuY620Mjl6b/0ous9YemuePvhEN4wy', NULL, NULL, NULL, 'clinica', '3267635', '451774', 'mKbeSsA2ND', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(28, 'osvaldo49@example.net', '2023-02-21 03:51:17', '$2y$10$hyZxtuWZn5jQW/moE0tMiOuhMO5.2gSW1cZnVS/rpbIfKFqg2U76a', NULL, NULL, NULL, 'clinica', '3204256', '457328', 'l8BxSJAAAi', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(29, 'meaghan22@example.net', '2023-02-21 03:51:17', '$2y$10$SwgLuzd7LMWABwXR5762eObJz6deEPT7pEQbsddG2iOCCpBVUGey6', NULL, NULL, NULL, 'clinica', '8741101', '394839', 'ccRXbpMK3s', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(30, 'nmraz@example.com', '2023-02-21 03:51:17', '$2y$10$/tpTfie090erSyxN0ftd8uXAyup0st7aJFcvX0POZCuVtZa0KErYG', NULL, NULL, NULL, 'clinica', '3623904', '633164', 'Hfa6nUFZVW', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(31, 'lstark@example.org', '2023-02-21 03:51:17', '$2y$10$vuVfm8kNvPpL67devqD5xeAVZoI8//BdaLzaEiH.K7S5ArAhUUbt.', NULL, NULL, NULL, 'clinica', '4137390', '680131', 'zSAgbmLK6e', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(32, 'rossie.morissette@example.org', '2023-02-21 03:51:17', '$2y$10$ac98h5rdRDOTVKbR5nLcF.VLlGLX43805dFidLhtDUb0G/DNHWf5W', NULL, NULL, NULL, 'clinica', '5064239', '754996', 'OofC7YC6cn', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(33, 'kmosciski@example.org', '2023-02-21 03:51:17', '$2y$10$fl38KVUFY664kV/HTTE7du7ffBia0ohgZ/rmToQkuJ0lqogs4lFZG', NULL, NULL, NULL, 'clinica', '1115623', '897558', 'JQVGVSDkNo', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(34, 'jesse01@example.org', '2023-02-21 03:51:17', '$2y$10$L0NIJNw1CUhSDrrNYKfS2uGS5PXI5/u1ykNEQJWzpidLUELZmKFJG', NULL, NULL, NULL, 'clinica', '5957870', '257076', '8Z0v5W2L9O', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(35, 'juliana.pfannerstill@example.net', '2023-02-21 03:51:17', '$2y$10$DhGsQPfee1PlF/cQCGj2SOHlmWe1JWQp9g8kdXRinNI9OTeSQayN6', NULL, NULL, NULL, 'clinica', '2825314', '562947', 'NoX5cBGWdY', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(36, 'jana26@example.org', '2023-02-21 03:51:17', '$2y$10$1IW3/9.roIHoY9ukyfrYvOrzNmfCN4TIO3RErtjLO6rd64.W/bOhG', NULL, NULL, NULL, 'clinica', '9265857', '235562', 'GnUtOs6GFN', NULL, NULL, '2023-02-21 03:51:17', '2023-02-21 03:51:17'),
(37, 'howe.lessie@example.com', '2023-02-21 03:51:17', '$2y$10$lRUahjsgVVLzdAXWJNPMpeABgqm9Wr30uPk.rQYKdo42roA8WoOUK', NULL, NULL, NULL, 'paciente', '1570582', '774070', 'yZHGumORQI', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(38, 'breitenberg.michelle@example.net', '2023-02-21 03:51:17', '$2y$10$k46QBTu393SeHWtKFMDMKOP7FOwU7qXXhTk0IR6Uz1XClyvYjJiQW', NULL, NULL, NULL, 'paciente', '5483634', '304872', 'DoFV8iuFrF', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(39, 'ikertzmann@example.com', '2023-02-21 03:51:17', '$2y$10$vxkgDAf.YV5JwtvavWH4JuUf3ST8CXfUiYv3yZpTcYvZ.VU7dNRt6', NULL, NULL, NULL, 'paciente', '7795659', '249255', 'DNsIWgqzUS', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(40, 'gbradtke@example.net', '2023-02-21 03:51:17', '$2y$10$wr5xn5aB.NATfg0hXdJ.XOl.v3BObhMLpvRWh4hKR3C3Tvc7icR92', NULL, NULL, NULL, 'paciente', '5418730', '364076', 'Zw5z3AZjNA', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(41, 'turcotte.esmeralda@example.org', '2023-02-21 03:51:18', '$2y$10$Hx/Jv1C0QiVrzicPSTtgkO7QdLp0ePAFHZ/z8Y9wSBPt3ZMN4CraC', NULL, NULL, NULL, 'paciente', '3614479', '206963', 'ZCiOfxwFma', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(42, 'camren62@example.com', '2023-02-21 03:51:18', '$2y$10$ucXMCcCBU/9CDY7QoYGQx..OVt9Pu6.Vi7RjjV0JVpgOC0hHXgGg6', NULL, NULL, NULL, 'paciente', '3792690', '409510', 'GDdnTSTn0P', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(43, 'eondricka@example.org', '2023-02-21 03:51:18', '$2y$10$aYh/SsQXLJ0cAg1y9B4z1Ohsbx7xamTvWNuw7wJnyifLdWTEA54DO', NULL, NULL, NULL, 'paciente', '5844126', '625389', '23Vwjxj7lK', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(44, 'maye.considine@example.com', '2023-02-21 03:51:18', '$2y$10$xrvfjI83.lDDfAaOTIUBfeL/52d8qlgSEmhK6Me83FjToD.D9hM5a', NULL, NULL, NULL, 'paciente', '2384129', '125142', 'tE6LQyXbGU', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(45, 'nokeefe@example.net', '2023-02-21 03:51:18', '$2y$10$WGK21GilZj5zroire.txNu4A8ZMch4EAUsGSYy6KwJVFS00NAU5jK', NULL, NULL, NULL, 'paciente', '6912009', '254215', 'oE8r6lXTwt', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(46, 'dessie.mayer@example.net', '2023-02-21 03:51:18', '$2y$10$RuUt6hohMFGjzcXAJCrF5.dqDO6R3I89bcJPfbDsLY.bBefS9qDj2', NULL, NULL, NULL, 'paciente', '1298751', '337308', 'FT0NUNhZdh', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(47, 'wisozk.sammie@example.net', '2023-02-21 03:51:18', '$2y$10$PmQEZA0/FOZ.xRY.G0FN1eselWmwk.v8mTHW23VHitPDuGKc1uBrq', NULL, NULL, NULL, 'paciente', '8996373', '243948', '3u7VkRD2kp', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(48, 'effertz.casandra@example.com', '2023-02-21 03:51:18', '$2y$10$/sAgxgN69PKHvyMwt2K09uMHgLcH78c7h0n.1veJ0nGOqzk3GMnWO', NULL, NULL, NULL, 'paciente', '3596675', '612194', 'wcszkbczcU', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(49, 'webster32@example.net', '2023-02-21 03:51:18', '$2y$10$OteG9YqZf0k.xv/DDIAiEemcdLbJlTwCUFU9Z7JLyfHFn5NVtXhle', NULL, NULL, NULL, 'paciente', '8580483', '730271', 'tOHVKBz8aU', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(50, 'kuhn.luigi@example.org', '2023-02-21 03:51:18', '$2y$10$D4hGq9LaxZCC5FuXCSZgK.NLdeEFVwH9BHiwnKaWJghxm9EuEwuRS', NULL, NULL, NULL, 'paciente', '5895511', '430316', '4X46fxUIpB', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18'),
(51, 'marta74@example.net', '2023-02-21 03:51:18', '$2y$10$S4PYWguG8lNRWDjqXgw7h.jci6U9tp82iWTessZqBXxLzwP0Zbb.K', NULL, NULL, NULL, 'paciente', '6037653', '228577', 'Y8fb8B8sr1', NULL, NULL, '2023-02-21 03:51:18', '2023-02-21 03:51:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalles`
--

CREATE TABLE `venta_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradors`
--
ALTER TABLE `administradors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `administradors_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `administradors_email_unique` (`email`),
  ADD KEY `administradors_sede_id_foreign` (`sede_id`);

--
-- Indices de la tabla `canjeos`
--
ALTER TABLE `canjeos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `canjeo_detalles`
--
ALTER TABLE `canjeo_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clinicas`
--
ALTER TABLE `clinicas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clinicas_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `clinicas_email_unique` (`email`),
  ADD UNIQUE KEY `clinicas_ruc_unique` (`ruc`),
  ADD KEY `clinicas_sede_id_foreign` (`sede_id`),
  ADD KEY `clinicas_especialidad_id_foreign` (`especialidad_id`);

--
-- Indices de la tabla `clinica_paciente`
--
ALTER TABLE `clinica_paciente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinica_paciente_paciente_id_foreign` (`paciente_id`),
  ADD KEY `clinica_paciente_clinica_id_foreign` (`clinica_id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `direccions`
--
ALTER TABLE `direccions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `direccions_user_id_foreign` (`user_id`),
  ADD KEY `direccions_departamento_id_foreign` (`departamento_id`),
  ADD KEY `direccions_provincia_id_foreign` (`provincia_id`),
  ADD KEY `direccions_distrito_id_foreign` (`distrito_id`);

--
-- Indices de la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distritos_provincia_id_foreign` (`provincia_id`);

--
-- Indices de la tabla `especialidads`
--
ALTER TABLE `especialidads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `especialidads_nombre_unique` (`nombre`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informes`
--
ALTER TABLE `informes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `odontologos`
--
ALTER TABLE `odontologos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `odontologos_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `odontologos_email_unique` (`email`),
  ADD KEY `odontologos_sede_id_foreign` (`sede_id`),
  ADD KEY `odontologos_especialidad_id_foreign` (`especialidad_id`);

--
-- Indices de la tabla `odontologo_paciente`
--
ALTER TABLE `odontologo_paciente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `odontologo_paciente_paciente_id_foreign` (`paciente_id`),
  ADD KEY `odontologo_paciente_odontologo_id_foreign` (`odontologo_id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pacientes_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `pacientes_email_unique` (`email`),
  ADD KEY `pacientes_sede_id_foreign` (`sede_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provincias_departamento_id_foreign` (`departamento_id`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sedes_nombre_unique` (`nombre`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `servicios_nombre_unique` (`nombre`);

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
  ADD UNIQUE KEY `users_dni_unique` (`dni`),
  ADD UNIQUE KEY `users_cop_unique` (`cop`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_detalles`
--
ALTER TABLE `venta_detalles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradors`
--
ALTER TABLE `administradors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `canjeos`
--
ALTER TABLE `canjeos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `canjeo_detalles`
--
ALTER TABLE `canjeo_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clinicas`
--
ALTER TABLE `clinicas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `clinica_paciente`
--
ALTER TABLE `clinica_paciente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `direccions`
--
ALTER TABLE `direccions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `distritos`
--
ALTER TABLE `distritos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1831;

--
-- AUTO_INCREMENT de la tabla `especialidads`
--
ALTER TABLE `especialidads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `informes`
--
ALTER TABLE `informes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `odontologos`
--
ALTER TABLE `odontologos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `odontologo_paciente`
--
ALTER TABLE `odontologo_paciente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_detalles`
--
ALTER TABLE `venta_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradors`
--
ALTER TABLE `administradors`
  ADD CONSTRAINT `administradors_sede_id_foreign` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`),
  ADD CONSTRAINT `administradors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `clinicas`
--
ALTER TABLE `clinicas`
  ADD CONSTRAINT `clinicas_especialidad_id_foreign` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidads` (`id`),
  ADD CONSTRAINT `clinicas_sede_id_foreign` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`),
  ADD CONSTRAINT `clinicas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `clinica_paciente`
--
ALTER TABLE `clinica_paciente`
  ADD CONSTRAINT `clinica_paciente_clinica_id_foreign` FOREIGN KEY (`clinica_id`) REFERENCES `clinicas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clinica_paciente_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `direccions`
--
ALTER TABLE `direccions`
  ADD CONSTRAINT `direccions_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `direccions_distrito_id_foreign` FOREIGN KEY (`distrito_id`) REFERENCES `distritos` (`id`),
  ADD CONSTRAINT `direccions_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`),
  ADD CONSTRAINT `direccions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD CONSTRAINT `distritos_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `odontologos`
--
ALTER TABLE `odontologos`
  ADD CONSTRAINT `odontologos_especialidad_id_foreign` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidads` (`id`),
  ADD CONSTRAINT `odontologos_sede_id_foreign` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`),
  ADD CONSTRAINT `odontologos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `odontologo_paciente`
--
ALTER TABLE `odontologo_paciente`
  ADD CONSTRAINT `odontologo_paciente_odontologo_id_foreign` FOREIGN KEY (`odontologo_id`) REFERENCES `odontologos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `odontologo_paciente_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_sede_id_foreign` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`),
  ADD CONSTRAINT `pacientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `provincias_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
