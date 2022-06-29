-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2022 a las 19:28:17
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_productos`
--

CREATE TABLE `categoria_productos` (
  `id` int(11) NOT NULL,
  `nombre_categoria` varchar(40) NOT NULL,
  `descripcion_categoria` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria_productos`
--

INSERT INTO `categoria_productos` (`id`, `nombre_categoria`, `descripcion_categoria`, `created_at`, `updated_at`) VALUES
(1, 'Lentes biselados', 'lentes con biselado', '2022-06-29 22:26:33', '2022-06-29 22:26:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisions`
--

CREATE TABLE `comisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_solicitud_venta` int(10) UNSIGNED DEFAULT NULL,
  `valor_comision` int(11) DEFAULT NULL,
  `tipo_comision` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comisions`
--

INSERT INTO `comisions` (`id`, `id_solicitud_venta`, `valor_comision`, `tipo_comision`, `created_at`, `updated_at`) VALUES
(1, 1, 15000, 'lente', '2022-06-29 22:24:26', '2022-06-29 22:24:26'),
(2, 1, 10000, 'montura', '2022-06-29 22:24:26', '2022-06-29 22:24:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Activo', 'Activo', NULL, NULL),
(2, 'Inactivo', 'Inactivo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_ventas`
--

CREATE TABLE `estado_ventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_ventas`
--

INSERT INTO `estado_ventas` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'en proceso', 'la venta esta en proceso', NULL, NULL),
(2, 'por reclamar', 'ya esta por reclamar el prducto', NULL, NULL),
(3, 'entregado', 'el producto ya ha sido entregado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorios`
--

CREATE TABLE `laboratorios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nit` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_estado` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `laboratorios`
--

INSERT INTO `laboratorios` (`id`, `nit`, `nombre`, `telefono`, `direccion`, `email`, `id_estado`, `created_at`, `updated_at`) VALUES
(3, '900456783', 'LA NUEVA ERA', '3208973456', 'palmira-valle', 'LANUEVAERA@GMAIL.COM', 1, '2022-06-29 22:20:12', '2022-06-29 22:20:12'),
(4, '9000456734', 'LENTES X', '324895643', 'CALLE 44 #5-79', 'lentesX@gmail.com', 1, '2022-06-29 22:21:05', '2022-06-29 22:21:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 1),
(13, '2019_12_23_154242_create_tipo_documentos_table', 1),
(14, '2019_12_23_154243_create_roles_table', 1),
(15, '2019_12_23_154304_create_estados_table', 1),
(16, '2019_12_23_154528_create_usuarios_table', 1),
(17, '2019_12_23_154758_create_laboratorios_table', 1),
(18, '2019_12_23_154817_create_estado_ventas_table', 1),
(19, '2020_01_10_155341_create_solicitud_ventas_table', 1),
(20, '2020_01_10_155441_create_comisions_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', NULL, NULL),
(2, 'Vendedeor', 'Vendedor', NULL, NULL),
(3, 'Cliente', 'Cliente', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_ventas`
--

CREATE TABLE `solicitud_ventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_cliente` int(10) UNSIGNED DEFAULT NULL,
  `casillero` int(11) DEFAULT NULL,
  `gaveta` int(11) DEFAULT NULL,
  `od_esf` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `od_cyl` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `od_eje` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `od_add` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `od_dp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `od_af` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oi_esf` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oi_cyl` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oi_eje` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oi_add` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oi_dp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oi_af` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medidas_especiales` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_lente` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_lente` int(11) DEFAULT NULL,
  `comision_lente` int(11) DEFAULT NULL,
  `filtros_adicionales` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_laboratorio` int(10) UNSIGNED DEFAULT NULL,
  `id_laboratorio_bisel` int(10) UNSIGNED DEFAULT NULL,
  `montura` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_montura` int(11) DEFAULT NULL,
  `comision_montura` int(11) DEFAULT NULL,
  `id_vendedor` int(10) UNSIGNED DEFAULT NULL,
  `id_estado` int(10) UNSIGNED DEFAULT NULL,
  `id_estado_venta` int(10) UNSIGNED DEFAULT NULL,
  `observaciones` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solicitud_ventas`
--

INSERT INTO `solicitud_ventas` (`id`, `fecha`, `id_cliente`, `casillero`, `gaveta`, `od_esf`, `od_cyl`, `od_eje`, `od_add`, `od_dp`, `od_af`, `oi_esf`, `oi_cyl`, `oi_eje`, `oi_add`, `oi_dp`, `oi_af`, `medidas_especiales`, `tipo_lente`, `valor_lente`, `comision_lente`, `filtros_adicionales`, `id_laboratorio`, `id_laboratorio_bisel`, `montura`, `color`, `valor_montura`, `comision_montura`, `id_vendedor`, `id_estado`, `id_estado_venta`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, '2022-06-29', 4, 9, 3, '56', '65', '67', '78', '56', '65', '56', '33', '58', '34', '33', '24', 'ninguna', 'obturador', 500000, 1, 'KF-034555', 4, 3, 'cromatica', 'negro', 7900000, 1, 3, 1, 1, 'ninguna', '2022-06-29 22:24:26', '2022-06-29 22:24:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documentos`
--

CREATE TABLE `tipo_documentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documentos`
--

INSERT INTO `tipo_documentos` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'CC', 'cedula', NULL, NULL),
(2, 'TI', 'tarjeta de identidad', NULL, NULL),
(3, 'PA', 'pasaporte', NULL, NULL),
(4, 'CE', 'cedula extranjera', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tipo_documento` int(10) UNSIGNED DEFAULT NULL,
  `numero_documento` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_completo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_role` int(10) UNSIGNED DEFAULT NULL,
  `id_estado` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_tipo_documento`, `numero_documento`, `nombre_completo`, `telefono`, `direccion`, `email`, `password`, `foto`, `id_role`, `id_estado`, `created_at`, `updated_at`) VALUES
(1, 1, '1113667990', 'Steven Manyoma Rosero', '3206041556', 'calle 5', 'stevenluck431@gmail.com', '$2y$10$O2TdpeRiRFIQ4YIuixRjd.NGhNYMnN6rIbIs7wGpg/Vi96BfL.eLm', 'usuario.jpg', 1, 1, '2022-06-29 22:10:46', '2022-06-29 22:10:46'),
(2, 1, '61', 'Daniela gutierres', '31267890', 'calle 67', 'daniela@mailinator.com', '$2y$10$l9rKcOcftyskptYFsFCs2.uZpqne.EVCrOG4jinJHFmraNuczz7AW', 'usuario.jpg', 2, 1, '2022-06-29 22:14:22', '2022-06-29 22:14:22'),
(3, 1, '11157908', 'Andrea  rodriguez', '34522225', 'calle 6789', 'andrea@mailinator.com', '$2y$10$qQHrb2UB9S7FYzur2gz9Uu3JvBFbH/r0stZ.F7H8GwZh6K4jFuF/2', 'usuario.jpg', 2, 1, '2022-06-29 22:16:00', '2022-06-29 22:16:00'),
(4, 1, '11147654', 'Daniel Ortiz', '3217767', 'palmira-valle del cauca', 'daniel@mailinator.com', NULL, NULL, 3, 1, '2022-06-29 22:17:54', '2022-06-29 22:22:15'),
(5, 1, '11156789', 'Javier Grajales', '320565674', 'calle 8', 'javi@gmail.com', NULL, NULL, 3, 1, '2022-06-29 22:18:42', '2022-06-29 22:18:42'),
(6, 1, '1116799554', 'Nicole Tatiana Sandoval', '3125673456', 'Bolo san isidro', 'nicole@gmail.com', NULL, NULL, 3, 1, '2022-06-29 22:19:24', '2022-06-29 22:19:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_productos`
--
ALTER TABLE `categoria_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comisions`
--
ALTER TABLE `comisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comisions_id_solicitud_venta_foreign` (`id_solicitud_venta`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_ventas`
--
ALTER TABLE `estado_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laboratorios_id_estado_foreign` (`id_estado`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_ventas`
--
ALTER TABLE `solicitud_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_ventas_id_cliente_foreign` (`id_cliente`),
  ADD KEY `solicitud_ventas_id_vendedor_foreign` (`id_vendedor`),
  ADD KEY `solicitud_ventas_id_laboratorio_foreign` (`id_laboratorio`),
  ADD KEY `solicitud_ventas_id_estado_foreign` (`id_estado`),
  ADD KEY `solicitud_ventas_id_laboratorio_bisel` (`id_laboratorio_bisel`),
  ADD KEY `solicitud_ventas_id_estado_venta` (`id_estado_venta`);

--
-- Indices de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_id_tipo_documento_foreign` (`id_tipo_documento`),
  ADD KEY `usuarios_id_role_foreign` (`id_role`),
  ADD KEY `usuarios_id_estado_foreign` (`id_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_productos`
--
ALTER TABLE `categoria_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comisions`
--
ALTER TABLE `comisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado_ventas`
--
ALTER TABLE `estado_ventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitud_ventas`
--
ALTER TABLE `solicitud_ventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comisions`
--
ALTER TABLE `comisions`
  ADD CONSTRAINT `comisions_id_solicitud_venta_foreign` FOREIGN KEY (`id_solicitud_venta`) REFERENCES `solicitud_ventas` (`id`);

--
-- Filtros para la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD CONSTRAINT `laboratorios_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `solicitud_ventas`
--
ALTER TABLE `solicitud_ventas`
  ADD CONSTRAINT `solicitud_ventas_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `solicitud_ventas_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estado_ventas` (`id`),
  ADD CONSTRAINT `solicitud_ventas_id_estado_venta` FOREIGN KEY (`id_estado_venta`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `solicitud_ventas_id_laboratorio_bisel` FOREIGN KEY (`id_laboratorio_bisel`) REFERENCES `laboratorios` (`id`),
  ADD CONSTRAINT `solicitud_ventas_id_laboratorio_foreign` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorios` (`id`),
  ADD CONSTRAINT `solicitud_ventas_id_vendedor_foreign` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `usuarios_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `usuarios_id_tipo_documento_foreign` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documentos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
