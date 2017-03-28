-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2017 a las 10:24:31
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mamayak`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `date_end` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `date_creation` datetime NOT NULL,
  `budget` decimal(9,2) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `projects_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bids`
--

INSERT INTO `bids` (`id`, `date_end`, `status`, `date_creation`, `budget`, `vendor_id`, `projects_id`) VALUES
(1, '2017-04-28', '0', '2017-03-20 09:58:21', '800.00', 1, 1),
(2, '2017-04-28', '1', '2017-03-20 09:59:06', '450.00', 1, 2),
(3, '2017-03-31', '0', '2017-03-20 09:59:36', '100.00', 1, 3),
(4, '2017-05-26', '0', '2017-03-20 10:10:31', '1200.00', 1, 4),
(5, '2017-03-30', '0', '2017-03-20 10:16:38', '1500.00', 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `surname` varchar(80) NOT NULL,
  `linkedin` varchar(200) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_website` varchar(100) NOT NULL,
  `company_location` varchar(50) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `surname`, `linkedin`, `company_name`, `company_website`, `company_location`, `company_address`, `user_id`) VALUES
(1, 'Esteban Marcos', '', '', '', '', '', 1),
(2, 'Hernandez', '', 'Deddian', 'www.deddian.com', 'Almeria', '', 2),
(3, '', '', '', '', '', '', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `developers`
--

CREATE TABLE `developers` (
  `id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `cif` varchar(20) NOT NULL,
  `manager_name` varchar(30) NOT NULL,
  `manager_surname` varchar(60) NOT NULL,
  `manager_phone` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `developers`
--

INSERT INTO `developers` (`id`, `address`, `website`, `cif`, `manager_name`, `manager_surname`, `manager_phone`, `user_id`) VALUES
(1, '', 'https://www.deddian.com/', '', '', '', '', 3),
(2, '', 'www.phpmatica.es', 'b11112221', '', '', '', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `object` int(11) NOT NULL,
  `type` varchar(1) NOT NULL,
  `action` varchar(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications_users`
--

CREATE TABLE `notifications_users` (
  `id` int(11) NOT NULL,
  `notified_user_id` int(11) NOT NULL,
  `recieved_notification_id` int(11) NOT NULL,
  `view` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `date_end` date NOT NULL,
  `observations` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `title`, `date_end`, `observations`, `status`, `date_creation`, `customer_id`) VALUES
(1, 'Crear web corporativa', '2017-04-28', '1. Nombre de tu Proyecto\r\n\r\nEl tÃ­tulo es una de las partes mÃ¡s importantes de cualquier pieza de contenido, ya sea un libro, una pÃ¡gina web, un producto o Tu Proyecto. Es por ello que dar a tu proyecto un nombre claro y atractivo es muy importante. Trata de resumir en pocas palabras el tipo de trabajo de necesitas. Por ejemplo: â€œAplicaciÃ³n para un menÃº de un restaurante de tapasâ€ o â€œTraducciÃ³n del idioma EspaÃ±ol a Chinoâ€ o â€œRediseÃ±o de una PÃ¡gina Webâ€, etcÃ©tera.\r\n2. DescripciÃ³n â€“ Â¿De quÃ© trata tu proyecto?\r\n\r\nEsta secciÃ³n va dedicada a describir cÃ³mo realizar un proyecto, quÃ© es lo que necesitas y el resultado final que deseas obtener. Para una visiÃ³n mÃ¡s clara:\r\n\r\n    Explica lo que necesitas en tus propias palabras. Cuanta mÃ¡s informaciÃ³n proveas, mejor serÃ¡ la calidad de las ofertas enviadas por los proveedores de servicios freelance.\r\n    Detalla el nivel de conocimiento que tienes acerca de los servicios que requieres, de esta forma los proveedores tendrÃ¡n una mejor idea de como dirigirse a tu persona y el tipo de asesorÃ­a que esperas de ellos.\r\n    Si tienes bocetos, ejemplos, especificaciones tÃ©cnicas o requerimientos especÃ­ficos de diseÃ±o que puedan dar una idea mÃ¡s clara del resultado esperado, incluye los archivos.\r\n    Especifica en que etapa se encuentra tu proyecto. Â¿EstÃ¡ en la etapa inicial o se encuentra en producciÃ³n? Sea cual sea el caso, proporciona detalles al respecto.\r\n    Incluye cualquier aspecto particular relacionado con la identidad corporativa de tu empresa o marca, incluye algÃºn documento con las especificaciones, colores, textos etcÃ©tera.\r\n    Puede ser que hayas visto alguna aplicaciÃ³n, sitio web, o diseÃ±o similar al que quieres obtener, si es asÃ­ â€“ adjunta una muestra en tu descripciÃ³n.\r\n    Por supuesto, no olvides dar informaciÃ³n acerca de tu mercado objetivo o la industria a la que se dirige tu producto o servicio, esto puede ser de mucha ayuda.\r\n', 0, '2017-03-20 09:52:42', 1),
(2, 'Proyecto Boqueron', '2017-04-30', 'Necesito una aplicacion que de el valor de una determinada especie de pescado cada dia de subasta en lonja a las 8:00 AM', 2, '2017-03-20 09:54:54', 2),
(3, 'Logo corporativo', '2017-03-31', '1. Nombre de tu Proyecto\r\n\r\nEl tÃ­tulo es una de las partes mÃ¡s importantes de cualquier pieza de contenido, ya sea un libro, una pÃ¡gina web, un producto o Tu Proyecto. Es por ello que dar a tu proyecto un nombre claro y atractivo es muy importante. Trata de resumir en pocas palabras el tipo de trabajo de necesitas. Por ejemplo: â€œAplicaciÃ³n para un menÃº de un restaurante de tapasâ€ o â€œTraducciÃ³n del idioma EspaÃ±ol a Chinoâ€ o â€œRediseÃ±o de una PÃ¡gina Webâ€, etcÃ©tera.\r\n2. DescripciÃ³n â€“ Â¿De quÃ© trata tu proyecto?\r\n\r\nEsta secciÃ³n va dedicada a describir cÃ³mo realizar un proyecto, quÃ© es lo que necesitas y el resultado final que deseas obtener. Para una visiÃ³n mÃ¡s clara:\r\n\r\n    Explica lo que necesitas en tus propias palabras. Cuanta mÃ¡s informaciÃ³n proveas, mejor serÃ¡ la calidad de las ofertas enviadas por los proveedores de servicios freelance.\r\n    Detalla el nivel de conocimiento que tienes acerca de los servicios que requieres, de esta forma los proveedores tendrÃ¡n una mejor idea de como dirigirse a tu persona y el tipo de asesorÃ­a que esperas de ellos.\r\n    Si tienes bocetos, ejemplos, especificaciones tÃ©cnicas o requerimientos especÃ­ficos de diseÃ±o que puedan dar una idea mÃ¡s clara del resultado esperado, incluye los archivos.\r\n    Especifica en que etapa se encuentra tu proyecto. Â¿EstÃ¡ en la etapa inicial o se encuentra en producciÃ³n? Sea cual sea el caso, proporciona detalles al respecto.\r\n    Incluye cualquier aspecto particular relacionado con la identidad corporativa de tu empresa o marca, incluye algÃºn documento con las especificaciones, colores, textos etcÃ©tera.\r\n    Puede ser que hayas visto alguna aplicaciÃ³n, sitio web, o diseÃ±o similar al que quieres obtener, si es asÃ­ â€“ adjunta una muestra en tu descripciÃ³n.\r\n    Por supuesto, no olvides dar informaciÃ³n acerca de tu mercado objetivo o la industria a la que se dirige tu producto o servicio, esto puede ser de mucha ayuda.\r\n', 0, '2017-03-20 09:55:43', 3),
(4, 'Proyecto Mamayak', '2017-05-31', 'Aplicacion que pone en contacto clientes y empresas a la hora de adjudicar un proyecto', 0, '2017-03-20 10:08:59', 2),
(5, 'Tienda online', '2017-04-15', 'Necesito una tienda online de plantas hecha con prestashop', 0, '2017-03-20 10:09:54', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `remember_token` varchar(15) NOT NULL,
  `profile_photo` varchar(60) NOT NULL,
  `city` varchar(50) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_access` datetime NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `salt` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `type`, `name`, `email`, `phone`, `password`, `remember_token`, `profile_photo`, `city`, `date_creation`, `date_access`, `activated`, `salt`) VALUES
(1, 0, 'Iban', 'ibanesteban28@gmail.com', '', '$2y$10$v7nYjK1hz8uqhKtTx0iOSu9m6hA8RE0DnenZVyP11sXTJ6T2yazoa', 'TJ6T2yazoa', 'profile_1499a.jpg', '', '2017-03-20 09:49:22', '0000-00-00 00:00:00', 1, NULL),
(2, 0, 'Antonio', 'deddianweb@gmail.com', '99999999', '$2y$10$8bk4mOyA2kSuSJs83jXOwupHFb.llnkPu6Dz6.XKwjXf7zhes4KV2', 'f7zhes4KV2', 'profile_b1c11.png', 'Almeria', '2017-03-20 09:49:26', '0000-00-00 00:00:00', 1, NULL),
(3, 1, 'Deddian', 'deddian100@deddian.com', '', '$2y$10$zK3.5vao.9ex1KKMTSZUuuEcsEStqTY9yZ26Pax5xB4hNxUfQpvlG', 'hNxUfQpvlG', 'profile_caffb.png', '', '2017-03-20 09:52:24', '0000-00-00 00:00:00', 1, NULL),
(4, 0, 'AHV', 'iban252@hotmail.com', '', '$2y$10$Za7If5C9oYHepq3e49W.N.fj5hih6BH3R.wDYnB/afy5WQ.LYfhKi', '5WQ.LYfhKi', 'profile_842c5.png', '', '2017-03-20 09:53:51', '0000-00-00 00:00:00', 1, NULL),
(5, 1, 'phpmatica', 'phpmatica@phpmatica.es', '', '$2y$10$vc21q8lOpPEvU1s8r.FPOeavSCdQK4bJPV2oOm/mlsdh40/hQkuNe', 'h40/hQkuNe', 'profile.png', '', '2017-03-20 10:15:31', '0000-00-00 00:00:00', 1, 'NULL');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `projects_id` (`projects_id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `notifications_users`
--
ALTER TABLE `notifications_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notified_user_id` (`notified_user_id`),
  ADD KEY `recieved_notification_id` (`recieved_notification_id`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `developers`
--
ALTER TABLE `developers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notifications_users`
--
ALTER TABLE `notifications_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
