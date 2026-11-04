-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2026 a las 14:26:05
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `recuerdos_inolvidables`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `icono` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`, `icono`) VALUES
(1, 'Salones y Quintas', 'Espacios e instalaciones para el evento', 'fa-building'),
(2, 'Fotografía y Videos', 'Sesiones de fotos, cobertura y video recuerdos', 'fa-camera'),
(3, 'Catering y Pastelería', 'Banquetes, mesas dulces y pasteles de 15 años', 'fa-utensils'),
(4, 'Vestidos y Calzado', 'Tiendas de vestidos, diseño a medida y accesorios', 'fa-user-nurse'),
(5, 'DJ y Animación', 'Música, iluminación, pantallas y shows en vivo', 'fa-music');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_evento` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_evento` date NOT NULL,
  `presupuesto` decimal(10,2) DEFAULT '0.00',
  `lugar` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` enum('Planificando','Confirmado','Finalizado','Cancelado') COLLATE utf8mb4_unicode_ci DEFAULT 'Planificando',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario`, `nombre_evento`, `fecha_evento`, `presupuesto`, `lugar`, `estado`, `fecha_creacion`) VALUES
(2, 16, '15 Hello Kitty', '2026-10-31', '12000000.00', 'salon magico', 'Planificando', '2026-09-28 13:59:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre_comercial` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `ubicacion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `es_destacado` tinyint(1) DEFAULT '0',
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default-provider.jpg',
  `destacado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `id_usuario`, `id_categoria`, `nombre_comercial`, `descripcion`, `ubicacion`, `telefono`, `email`, `direccion`, `es_destacado`, `imagen`, `destacado`) VALUES
(9, NULL, NULL, 'Catering  & Banquetes Gourmet', 'En Catering & Banquetes Gourmet nos especializamos en transformar tus celebraciones en experiencias inolvidables. Ofrecemos un servicio integral de catering y alta pastelería para bodas, XV años, eventos corporativos y reuniones sociales. Nos distingue la excelente calidad de nuestros ingredientes, una presentación impecable y una atención personalizada que se adapta al estilo y presupuesto de tu evento. Cuidamos cada detalle culinario para que tú solo te preocupes por disfrutar', '', '+57 313 4863299', 'gourmetbanquetes@gmail.com', 'Av. De las Américas # 450, Col. Centro', 0, 'default-provider.jpg', 0),
(10, NULL, NULL, 'Pastelería Fina Sweet Magic', 'En Pastelería Fina Sweet Magic creamos verdaderas obras de arte comestibles para endulzar tus momentos más especiales. Nos especializamos en el diseño de pasteles personalizados, mesas de postres y alta repostería para XV años, bodas y todo tipo de eventos. Cada una de nuestras creaciones se elabora con ingredientes premium y un toque de magia que cautivará tanto a la vista como al paladar de tus invitados. Diseñamos el pastel perfecto que refleje el estilo de tu celebración\r\n', '', '+57 300 5987799', 'sweetmagic@gmail.com', 'Calle de los Dulces #12, Zona Rosa', 0, 'default-provider.jpg', 0),
(11, NULL, NULL, 'Impacto Mix DJ & Iluminación', 'En Impacto Mix DJ & Iluminación llevamos tu evento al siguiente nivel con la mejor producción musical y audiovisual. Nos especializamos en la ambientación de XV años, bodas y eventos sociales, garantizando una pista de baile llena de energía de principio a fin. Contamos con DJs profesionales, un repertorio musical ilimitado y adaptado a tus gustos, así como sistemas de iluminación digital y efectos visuales de última generación que harán de tu celebración una verdadera fiesta inolvidable', '', '+57 319 4277023', 'impactomix@gmail.com', 'Av. Principal # 789, Col. San Ángel', 0, 'default-provider.jpg', 0),
(12, NULL, NULL, 'Animación Estelar Eventos', 'En Animación Estelar Eventos encendemos los motores de tu celebración para garantizar una fiesta inolvidable. Nos especializamos en la animación interactiva de XV años, bodas y eventos sociales, creando dinámicas divertidas que ponen a bailar a todos tus invitados. Contamos con un equipo de animadores profesionales, excelente música y toda la energía necesaria para hacer de tu gran día un momento lleno de risas, baile y pura diversión\r\n', '', '+57 313 2165342', 'animacionestelar@gmail.com', 'Calle Fiesta # 45, Sector Norte', 0, 'default-provider.jpg', 0),
(13, NULL, NULL, 'Destellos Visuales Fotografía', 'En Destellos Visuales Fotografía capturamos los destellos de felicidad y emoción que hacen único tu gran día. Nos especializamos en la cobertura fotográfica de XV años, bodas y eventos sociales, enfocándonos en congelar momentos espontáneos, sonrisas genuinas y cada pequeño gran detalle. Nuestro compromiso es entregarte memorias visuales con un estilo artístico, nítido y profesional que te permita revivir la magia de tu celebración para siempre\r\n', '', '5553456', 'destellosvisuales@gmail.com', 'Av. de la Luz # 210, Col. Obispado', 0, 'default-provider.jpg', 0),
(14, NULL, NULL, 'Épico Studio Films', 'En Épico Studio Films transformamos los momentos más importantes de tu vida en recuerdos eternos. Nos especializamos en la cobertura fotográfica y cinematográfica de XV años, bodas y eventos sociales de alto nivel. Con un estilo narrativo, artístico y moderno, nuestro equipo de profesionales se encarga de capturar cada sonrisa, lágrima y detalle espontáneo, creando imágenes y videos de calidad cinematográfica que te harán revivir tu gran día una y otra vez\r\n', '', '5556543', 'epicostudio@gmail.com', 'Calzada de los Artistas # 55, Local B', 0, 'default-provider.jpg', 0),
(15, NULL, NULL, 'Quinta Los Olivos', 'En Quinta Los Olivos te ofrecemos un espacio único y exclusivo rodeado de naturaleza para celebrar tus momentos más importantes. Nuestras instalaciones combinan la belleza de amplias áreas verdes con la comodidad y elegancia necesarias para tus XV años, bodas o eventos familiares. Un entorno mágico al aire libre, ideal para crear recuerdos inolvidables con un servicio profesional que cuidará cada detalle de tu gran día\r\n', '', '5557890', 'quintalosolivos@gmail.com', 'Carretera Nacional Km 15, Valle Alto', 0, 'default-provider.jpg', 0),
(16, NULL, NULL, 'Salón de Eventos Cristal Palace', 'En Salón de Eventos Cristal Palace te ofrecemos el escenario perfecto para hacer realidad la celebración de tus sueños. Nuestro espacio destaca por su elegancia, amplitud y una infraestructura moderna ideal para XV años, bodas y eventos sociales inolvidables. Contamos con un equipo profesional comprometido en brindarte una atención de primer nivel y servicios integrales para que tú y tus invitados disfruten de una noche mágica, sofisticada y sin preocupaciones', '', '5550987', 'cristalpalace@gmail.com', 'Boulevard Real # 1024, Col. Virreyes', 0, 'default-provider.jpg', 0),
(17, NULL, NULL, 'Quince Bella Donna', 'En Quince Bella Donna sabemos que tu vestido de XV años es el reflejo de tus sueños, por eso te ayudamos a encontrar el diseño perfecto para tu gran noche. Nos especializamos en vestidos exclusivos de alta calidad, diseñados para hacerte lucir y sentir como una verdadera reina. Contamos con una amplia variedad de estilos, desde los más tradicionales hasta las últimas tendencias de moda, además de una línea selecta de calzado y accesorios que complementarán tu look de manera espectacular', '', '5551122', 'belladonna@gmail.com', 'Pasaje Comercial El Ángel, Local 4', 0, 'default-provider.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'Proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `titulo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nombre`, `id_proveedor`, `id_categoria`, `titulo`, `descripcion`, `precio`) VALUES
(13, 'Paquete de Fotografíal fast', NULL, 3, '', 'fotos sencillas', '400000.00'),
(14, 'alquiler trajes y vestidos', NULL, 4, '', 'vestuario para invitados', '80000.00'),
(15, 'decoracion basica', NULL, 1, '', 'fiesta sencilla', '4000000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_contacto`
--

CREATE TABLE `solicitudes_contacto` (
  `id_solicitud` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `nombre_remitente` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_remitente` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mensaje` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_planificador`
--

CREATE TABLE `tareas_planificador` (
  `id_tarea` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completada` tinyint(1) DEFAULT '0',
  `fecha_limite` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password`, `telefono`, `id_rol`, `fecha_registro`, `created_at`) VALUES
(16, 'Marielys Azocar Navarrete', 'marielys@gmail.com', '$2y$10$PWrx9UtIjemOaUG8LrHK9uP7np8EcE.dIZ3E63ADcAvn08XssuPr6', '322 4800189', 1, '2026-09-28 13:44:01', '2026-09-28 13:44:01'),
(17, 'Valentina Forero Chicue', 'Valentina@gmail.com', '$2y$10$z5MJ90.q8.qkCMmp4kreFemc1Ut9b/x2v78AcAQSkUxurEM.7idCa', '313 2165342', 1, '2026-09-28 13:45:13', '2026-09-28 13:45:13'),
(18, 'Cesar Navarrete', 'cesar@gmail.com', '$2y$10$QCPRQmeB5TF1/NKU99zwjeSjYOURjDLhsVJLneyVBSCAYP8kETmJe', '1234567890', 3, '2026-09-28 13:49:10', '2026-09-28 13:49:10'),
(19, 'pepe sanchez', 'psanchez@gmail.com', '$2y$10$G0YdX9WRbUu7fuCU7z8Jb.FWEwmQG030jfHbvyvCAJu94ihnI3gea', '322 4800189', 2, '2026-10-26 13:13:23', '2026-10-26 13:13:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `concepto` varchar(255) NOT NULL,
  `fecha_venta` date NOT NULL,
  `estado` varchar(50) DEFAULT 'Completado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `solicitudes_contacto`
--
ALTER TABLE `solicitudes_contacto`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `tareas_planificador`
--
ALTER TABLE `tareas_planificador`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `solicitudes_contacto`
--
ALTER TABLE `solicitudes_contacto`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tareas_planificador`
--
ALTER TABLE `tareas_planificador`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `proveedores_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitudes_contacto`
--
ALTER TABLE `solicitudes_contacto`
  ADD CONSTRAINT `solicitudes_contacto_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `solicitudes_contacto_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tareas_planificador`
--
ALTER TABLE `tareas_planificador`
  ADD CONSTRAINT `tareas_planificador_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
