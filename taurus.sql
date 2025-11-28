-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-11-2025 a las 22:08:28
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taurus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bus`
--

CREATE TABLE `bus` (
  `id` int NOT NULL,
  `placa` varchar(30) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `capacidad` int DEFAULT '40',
  `estado` enum('activo','mantenimiento','retirado') DEFAULT 'activo',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `bus`
--

INSERT INTO `bus` (`id`, `placa`, `marca`, `modelo`, `capacidad`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'ABC-123', 'Mercedes', 'Sprinter', 20, 'activo', '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(2, 'DEF-456', 'Volvo', 'Touring', 30, 'activo', '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolidado_viaje`
--

CREATE TABLE `consolidado_viaje` (
  `id` int NOT NULL,
  `ficha_id` int NOT NULL,
  `total_turistas` int DEFAULT '0',
  `total_gastos` decimal(14,2) DEFAULT '0.00',
  `total_ingresos` decimal(14,2) DEFAULT '0.00',
  `utilidad` decimal(14,2) GENERATED ALWAYS AS ((`total_ingresos` - `total_gastos`)) STORED,
  `observaciones` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `consolidado_viaje`
--

INSERT INTO `consolidado_viaje` (`id`, `ficha_id`, `total_turistas`, `total_gastos`, `total_ingresos`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1500.00, 3000.00, NULL, '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_bus`
--

CREATE TABLE `detalle_bus` (
  `id` int NOT NULL,
  `ficha_id` int NOT NULL,
  `bus_id` int NOT NULL,
  `piloto_id` int DEFAULT NULL,
  `fecha_asignacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `rol_onboard` varchar(100) DEFAULT NULL,
  `observacion` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_bus`
--

INSERT INTO `detalle_bus` (`id`, `ficha_id`, `bus_id`, `piloto_id`, `fecha_asignacion`, `rol_onboard`, `observacion`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025-11-28 16:54:14', 'Conductor principal', NULL, '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(2, 1, 2, NULL, '2025-11-28 16:54:14', 'Bus de apoyo', NULL, '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id` int NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` text,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `planificador_id` int DEFAULT NULL,
  `guia_id` int DEFAULT NULL,
  `estado` enum('borrador','publicado','en_proceso','finalizado','cancelado') DEFAULT 'borrador',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id`, `codigo`, `titulo`, `descripcion`, `fecha_inicio`, `fecha_fin`, `planificador_id`, `guia_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'FIC-001', 'Tour Lima y Cusco', 'Viaje turístico por Lima y Cusco', '2025-12-10', '2025-12-15', 1, 1, 'publicado', '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia`
--

CREATE TABLE `guia` (
  `id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `certificacion` varchar(200) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `guia`
--

INSERT INTO `guia` (`id`, `usuario_id`, `nombre`, `certificacion`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 4, 'Ana Guía', 'Certificado Turismo 2023', '987654324', '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE `hotel` (
  `id` int NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `categoria` tinyint DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `hotel`
--

INSERT INTO `hotel` (`id`, `nombre`, `direccion`, `telefono`, `categoria`, `created_at`, `updated_at`) VALUES
(1, 'Hotel Sol', 'Av. Siempre Viva 123', '987111222', 4, '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(2, 'Hotel Luna', 'Calle Falsa 456', '987333444', 3, '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id` int NOT NULL,
  `ficha_id` int NOT NULL,
  `turista_id` int NOT NULL,
  `fecha_inscripcion` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('pendiente','confirmado','cancelado','asistio') DEFAULT 'pendiente',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id`, `ficha_id`, `turista_id`, `fecha_inscripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-11-28 16:54:14', 'confirmado', '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(2, 1, 2, '2025-11-28 16:54:14', 'confirmado', '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itinerario`
--

CREATE TABLE `itinerario` (
  `id` int NOT NULL,
  `ficha_id` int NOT NULL,
  `dia` int DEFAULT '1',
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `descripcion` text,
  `hotel_id` int DEFAULT NULL,
  `restaurante_id` int DEFAULT NULL,
  `orden` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `itinerario`
--

INSERT INTO `itinerario` (`id`, `ficha_id`, `dia`, `fecha`, `hora_inicio`, `hora_fin`, `descripcion`, `hotel_id`, `restaurante_id`, `orden`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-12-10', '08:00:00', '12:00:00', 'Visita a la ciudad de Lima', 1, 1, 1, '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(2, 1, 2, '2025-12-11', '09:00:00', '17:00:00', 'Tour a Cusco y Machu Picchu', 2, 2, 2, '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piloto`
--

CREATE TABLE `piloto` (
  `id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `licencia` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `piloto`
--

INSERT INTO `piloto` (`id`, `usuario_id`, `nombre`, `licencia`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 3, 'Carlos Piloto', 'LIC12345', '987654323', '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificador`
--

CREATE TABLE `planificador` (
  `id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `planificador`
--

INSERT INTO `planificador` (`id`, `usuario_id`, `nombre`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 2, 'Juan Planificador', '987654322', '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante`
--

CREATE TABLE `restaurante` (
  `id` int NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `tipo_comida` varchar(100) DEFAULT NULL,
  `capacidad` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `restaurante`
--

INSERT INTO `restaurante` (`id`, `nombre`, `direccion`, `tipo_comida`, `capacidad`, `created_at`, `updated_at`) VALUES
(1, 'Restaurante El Buen Sabor', 'Av. Central 789', 'Mariscos', 50, '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(2, 'Café del Bosque', 'Calle Verde 321', 'Cafetería', 30, '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turista`
--

CREATE TABLE `turista` (
  `id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `nombres` varchar(150) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `documento` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `turista`
--

INSERT INTO `turista` (`id`, `usuario_id`, `nombres`, `apellidos`, `email`, `telefono`, `documento`, `created_at`, `updated_at`) VALUES
(1, 5, 'Luis', 'García', 'luis.turista@viajes.com', '987654325', 'DNI12345678', '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(2, 6, 'María', 'Pérez', 'maria.turista@viajes.com', '987654326', 'DNI87654321', '2025-11-28 16:54:14', '2025-11-28 16:54:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','planificador','piloto','guia','turista') NOT NULL DEFAULT 'turista',
  `telefono` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 'Admin Principal', 'admin@viajes.com', '123456', 'admin', '987654321', '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(2, 'Juan Planificador', 'juan.planificador@viajes.com', '123456', 'planificador', '987654322', '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(3, 'Carlos Piloto', 'carlos.piloto@viajes.com', '123456', 'piloto', '987654323', '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(4, 'Ana Guía', 'ana.guia@viajes.com', '123456', 'guia', '987654324', '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(5, 'Luis Turista', 'luis.turista@viajes.com', '123456', 'turista', '987654325', '2025-11-28 16:54:14', '2025-11-28 16:54:14'),
(6, 'María Turista', 'maria.turista@viajes.com', '123456', 'turista', '987654326', '2025-11-28 16:54:14', '2025-11-28 16:54:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- Indices de la tabla `consolidado_viaje`
--
ALTER TABLE `consolidado_viaje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ficha_id` (`ficha_id`);

--
-- Indices de la tabla `detalle_bus`
--
ALTER TABLE `detalle_bus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ficha_id` (`ficha_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `piloto_id` (`piloto_id`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `planificador_id` (`planificador_id`),
  ADD KEY `guia_id` (`guia_id`);

--
-- Indices de la tabla `guia`
--
ALTER TABLE `guia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ficha_id` (`ficha_id`),
  ADD KEY `turista_id` (`turista_id`);

--
-- Indices de la tabla `itinerario`
--
ALTER TABLE `itinerario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ficha_id` (`ficha_id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `restaurante_id` (`restaurante_id`);

--
-- Indices de la tabla `piloto`
--
ALTER TABLE `piloto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `planificador`
--
ALTER TABLE `planificador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turista`
--
ALTER TABLE `turista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `consolidado_viaje`
--
ALTER TABLE `consolidado_viaje`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_bus`
--
ALTER TABLE `detalle_bus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `guia`
--
ALTER TABLE `guia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `itinerario`
--
ALTER TABLE `itinerario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `piloto`
--
ALTER TABLE `piloto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `planificador`
--
ALTER TABLE `planificador`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `turista`
--
ALTER TABLE `turista`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consolidado_viaje`
--
ALTER TABLE `consolidado_viaje`
  ADD CONSTRAINT `consolidado_viaje_ibfk_1` FOREIGN KEY (`ficha_id`) REFERENCES `ficha` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_bus`
--
ALTER TABLE `detalle_bus`
  ADD CONSTRAINT `detalle_bus_ibfk_1` FOREIGN KEY (`ficha_id`) REFERENCES `ficha` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_bus_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `detalle_bus_ibfk_3` FOREIGN KEY (`piloto_id`) REFERENCES `piloto` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `ficha_ibfk_1` FOREIGN KEY (`planificador_id`) REFERENCES `planificador` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ficha_ibfk_2` FOREIGN KEY (`guia_id`) REFERENCES `guia` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `guia`
--
ALTER TABLE `guia`
  ADD CONSTRAINT `guia_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`ficha_id`) REFERENCES `ficha` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`turista_id`) REFERENCES `turista` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `itinerario`
--
ALTER TABLE `itinerario`
  ADD CONSTRAINT `itinerario_ibfk_1` FOREIGN KEY (`ficha_id`) REFERENCES `ficha` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `itinerario_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `itinerario_ibfk_3` FOREIGN KEY (`restaurante_id`) REFERENCES `restaurante` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `piloto`
--
ALTER TABLE `piloto`
  ADD CONSTRAINT `piloto_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `planificador`
--
ALTER TABLE `planificador`
  ADD CONSTRAINT `planificador_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `turista`
--
ALTER TABLE `turista`
  ADD CONSTRAINT `turista_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
