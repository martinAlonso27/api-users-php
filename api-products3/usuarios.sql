-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2026 a las 22:23:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'client',
  `status` tinyint(1) DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `status`, `updated_at`, `created_at`) VALUES
(2, 'María López', 'maria@example.com', '$2y$10$abcdefghijklmnopqrstuvwxyZ1234567890', NULL, 'client', 1, '2026-11-06 19:09:10', '2026-11-06 19:09:10'),
(3, 'Carlos Gómez', 'carlos@example.com', '$2y$10$abcdefghijklmnopqrstuvwxyZ1234567890', NULL, 'client', 1, '2026-11-06 19:09:10', '2026-11-06 19:09:10'),
(20, 'Juan Pérez', 'juan.nuevo@example.com', '$2y$10$QRkY7eO.aYGpgqxpxagjNuf.WcvFs6BLDaylEi.c5t5N/0V.aN7Wi', NULL, 'client', 1, '2026-11-06 20:30:01', '2026-11-06 20:30:01'),
(26, 'Juan Pérez', 'juwan.nuevo@example.com', '$2y$10$NuJfpEjSuQq5Pm9r30V/Ue0L1mGB3eisnAXtby53NNesPN2lEDGSe', NULL, 'client', 1, '2026-11-06 20:30:22', '2026-11-06 20:30:22');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
