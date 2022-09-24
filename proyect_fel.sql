-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2022 a las 19:03:07
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Volcado de datos para la tabla `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"relation_lines\":\"true\",\"snap_to_grid\":\"off\",\"angular_direct\":\"direct\",\"full_screen\":\"off\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Volcado de datos para la tabla `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'proyect_fel', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"cliente\",\"empleado\",\"empresa\",\"factura_detalle\",\"factura_encabezado\",\"images\",\"tipo_usuario\",\"usuario\"],\"table_structure[]\":[\"cliente\",\"empleado\",\"empresa\",\"factura_detalle\",\"factura_encabezado\",\"images\",\"tipo_usuario\",\"usuario\"],\"table_data[]\":[\"cliente\",\"empleado\",\"empresa\",\"factura_detalle\",\"factura_encabezado\",\"images\",\"tipo_usuario\",\"usuario\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Estructura de la tabla @TABLE@\",\"latex_structure_continued_caption\":\"Estructura de la tabla @TABLE@ (continúa)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Contenido de la tabla @TABLE@\",\"latex_data_continued_caption\":\"Contenido de la tabla @TABLE@ (continúa)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"csv_columns\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

--
-- Volcado de datos para la tabla `pma__favorite`
--

INSERT INTO `pma__favorite` (`username`, `tables`) VALUES
('root', '[]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"test\",\"table\":\"empresa\"},{\"db\":\"test\",\"table\":\"imagen\"},{\"db\":\"test\",\"table\":\"staff\"},{\"db\":\"test\",\"table\":\"usuario\"},{\"db\":\"test\",\"table\":\"role\"},{\"db\":\"test\",\"table\":\"cliente\"},{\"db\":\"proyect_fell\",\"table\":\"usuario\"},{\"db\":\"test\",\"table\":\"omiso\"},{\"db\":\"test\",\"table\":\"facturas_clientes\"},{\"db\":\"test\",\"table\":\"lineas_factura\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__table_info`
--

INSERT INTO `pma__table_info` (`db_name`, `table_name`, `display_field`) VALUES
('test', 'lineas_factura', 'factura_uuid'),
('test', 'staff', 'codigo'),
('test', 'usuario', 'correo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2022-09-24 14:33:34', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"es\",\"NavigationWidth\":356}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Base de datos: `proyect_fell`
--
CREATE DATABASE IF NOT EXISTS `proyect_fell` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyect_fell`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) UNSIGNED NOT NULL,
  `nit_cliente` varchar(15) NOT NULL,
  `nombre_cliente` varchar(150) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `verificado` tinyint(1) NOT NULL DEFAULT 0,
  `omisos` int(11) UNSIGNED DEFAULT 0,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) UNSIGNED NOT NULL,
  `nit` varchar(15) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `direccion` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `logo_id` int(11) UNSIGNED DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) UNSIGNED NOT NULL,
  `nit` varchar(15) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `descripcion` tinytext DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `no_factura` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `descuento` decimal(10,2) DEFAULT 0.00,
  `total_factura` decimal(10,2) NOT NULL,
  `total_pagar` decimal(10,2) DEFAULT 0.00,
  `estado_id` int(11) UNSIGNED DEFAULT 2,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` int(11) UNSIGNED NOT NULL,
  `logo` longblob NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tamaño` varchar(20) NOT NULL,
  `formato` varchar(20) NOT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_factura`
--

CREATE TABLE `lineas_factura` (
  `id` int(11) UNSIGNED NOT NULL,
  `factura_id` int(11) UNSIGNED DEFAULT NULL,
  `factura_uuid` varchar(255) NOT NULL,
  `no_linea` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `descripcion` tinytext DEFAULT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `omiso`
--

CREATE TABLE `omiso` (
  `id` int(11) UNSIGNED NOT NULL,
  `empresa_id` int(11) UNSIGNED NOT NULL,
  `cliente_id` int(11) UNSIGNED NOT NULL,
  `factura_id` int(11) UNSIGNED NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `omiso` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) UNSIGNED NOT NULL,
  `es_admin` tinyint(1) DEFAULT 0,
  `es_staff` tinyint(1) DEFAULT 0,
  `es_cliente` tinyint(1) DEFAULT 0,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) UNSIGNED NOT NULL,
  `role` varchar(60) NOT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `staff`
--

CREATE TABLE `staff` (
  `id` int(11) UNSIGNED NOT NULL,
  `usuario_id` int(11) UNSIGNED DEFAULT NULL,
  `empresa_id` int(11) UNSIGNED DEFAULT NULL,
  `codigo` varchar(15) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) UNSIGNED NOT NULL,
  `correo` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role_id` int(11) UNSIGNED DEFAULT NULL,
  `permiso_id` int(11) UNSIGNED DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foreign_key_imagen_id` (`logo_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_factura` (`no_factura`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas_factura`
--
ALTER TABLE `lineas_factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foreign_key_factura_id` (`factura_id`);

--
-- Indices de la tabla `omiso`
--
ALTER TABLE `omiso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_omiso_empresa_id` (`empresa_id`),
  ADD KEY `fk_omiso_cliente_id` (`cliente_id`),
  ADD KEY `fk_omiso_factura_id` (`factura_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foreign_key_empresa_id` (`empresa_id`),
  ADD KEY `fk_foreign_key_usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foreign_key_rol_id` (`role_id`),
  ADD KEY `fk_foreign_key_permiso_id` (`permiso_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lineas_factura`
--
ALTER TABLE `lineas_factura`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `omiso`
--
ALTER TABLE `omiso`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_empresa_imagen_imagen_id` FOREIGN KEY (`logo_id`) REFERENCES `imagen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineas_factura`
--
ALTER TABLE `lineas_factura`
  ADD CONSTRAINT `fk_linea_factura_factura_factura_id` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `omiso`
--
ALTER TABLE `omiso`
  ADD CONSTRAINT `fk_omiso_cliente_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_omiso_empresa_empresa_id` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_omiso_factura_factura_id` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk_staff_empresa_empresa_id` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_staff_usuario_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_permiso_permiso_id` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_usuario_role_rol_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
--
-- Base de datos: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) UNSIGNED NOT NULL,
  `nit_cliente` varchar(15) NOT NULL,
  `nombre_cliente` varchar(150) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `verificado` tinyint(1) NOT NULL DEFAULT 0,
  `omisos` int(11) UNSIGNED DEFAULT 0,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) UNSIGNED NOT NULL,
  `nit` varchar(15) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `direccion` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `logo_id` int(11) UNSIGNED DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nit`, `nombre`, `direccion`, `telefono`, `logo_id`, `actualizado`, `creado`) VALUES
(1, '9876543-k', 'DigitSAT', 'Ciudad de Guate', '+502 2523-6997', 1, '2022-09-24 08:35:35', '2022-09-24 07:25:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) UNSIGNED NOT NULL,
  `nit` varchar(15) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `descripcion` tinytext DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `no_factura` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `descuento` decimal(10,2) DEFAULT 0.00,
  `total_factura` decimal(10,2) NOT NULL,
  `total_pagar` decimal(10,2) DEFAULT 0.00,
  `estado_id` int(11) UNSIGNED DEFAULT 2,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` int(11) UNSIGNED NOT NULL,
  `logo` longblob NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tamaño` varchar(20) NOT NULL,
  `formato` varchar(20) NOT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `logo`, `nombre`, `tamaño`, `formato`, `actualizado`, `creado`) VALUES
(1, 0x6956424f5277304b47676f414141414e535568455567414141676b41414146484341594141414172324e39354141414141584e535230494172733463365141414141526e51553142414143786a777638595155414141414a6345685a6377414144734d414141374441636476714751414145774c53555242564868653764313363467a3365653778463731334547447658595755574e523770537a4a7172626c716a68786968336253576238682b4d34316c77376e73524b6e4d52324d693678787047374c617335367232536b69694a46455653464974496b4342426f76634f3350332b734964594c7338754673417569504a38376b556f4c4c61635051766a666336764a7131627436376652436174704d442f547735384a566c2f76333756785639533450636a384173532b4f6f4c664b666645784750516f4b4969496a34436c786969596949694a784d49554645524552384b535349694969494c34554545524552386157514943496949723455456b5245524d5358516f4b4969496a34556b67514552455258776f4a49694969346b736851555245524877704a496949694967766851515245524878705a4167496949697668515352455245784a6443676f694969506853534241524552466643676b6949694c69537946425245524566436b6b6949694969432b46424245524566476c6b43416949694b2b46424a45524554456c304b43694969492b464a49454245524556384b4353496949754a4c49554645524552384b535349694969494c34554545524552386157514943496949723455456b5245524d5358516f4b4969496a34556b67514552455258776f4a49694969346b736851555245524877704a496949694967766851515245524878705a4167496949697668515352455245784a6443676f694969506853534241524552466643676b6949694c69537946425245524566436b6b6949694969432b46424245524566476c6b43416949694b2b46424a45524554456c304b43694969492b464a49454245524556384b4353496949754a4c49554645524552384b535349694969494c34554545524552386157514943496949723455456b5245524d5358516f4b4969496a34556b67514552455258776f4a49694969346b736851555245524877704a496949694967766851515245524878705a416749694969766851535245524578466653756e58722b6f502f4c534b5458464a537632566b3931702b535a63566c6e59482f7557727977704b4139395036374c63776d37723655367932734d5a566e3873302b71714d7478582f64454d6136355073393665704f417a696368556f4a41674969644a532b3850424959756d7a613333655976623745465a7a5335554646546d575748646d6348766e4b73636d2b324e56526e4242386849704f52516f4b4944436b7075642b4668486b726d323342366330326230574c35525631572f3278444475384a39732b324a356e6537666d57564e6465764152496a495a4b435349794c44525262466966594f64666e36647a566e61356b4a455930323637646855614474654b375a443732646258352b364a6b516d4f6f55456b556b6d5062505069736f36724851575977303641392f33426e38796f4c382f795871366b71327a50646d364f6c4c635631747a717455665458666a446f596a493676585a69397443595346656c753875746e79693773437a3574696c587479624873674d4f78354f313964456949546d454b43794153566e4e4a7665594769504774526d38315947506961333262545a6e6345436e57332b396c77636558663270426d522f5a6e3235455073757a495076356c334546735851676c4d7a70733756553174764c634269756331756c756136704e74323276464e6e574630727361455757753031454a673646424a454a6847622b5a577361413166746a545a37635a766c466e5548663549597a48526f4f4a5a684233666c326f48336371336976527972505a495a2f4b6b2f7637424161384b574634707432387646566c4d5a2f6645694d6e346f4a49694d59306e4a5a6b586c48625a6958594d744f6176525a6757434164304a7030704861346f4c444e733346746d6572586e5758422b356c594777634d3647617463566b564d774547615954766e6d4d3657322f6455694e2b6852524d593368515352635367396f38396d4c6d7131565a6655325a4c566a5a5a586e4e67576735466f4f4a5a75327a63563259364e78585a6f5433627731684f6c7066665a3342584e647547486a3972434d35714474356f6472636932462b3662595474654b37422b4458415547626355456b54476b617a63486c644d56313953612f4e5062335a68596278726255713139393873744d31506c627231452f7a515462493645486a4f75717a4769716350644547304e7162617a74654c37665848537a56655157536353706b3161395a64776638576b564d6b4a6258665a6931757461732b55576b5833567a6c42694279573777787336477249396e4e5a6d6975793743366f786e57564a396d5359482f6c3572615a386b707754734f4130466d786f4932573779717958494b657478614354782f4b475938564c677844626e7550744e6d646268754531704c35702f575970324259324b7351312b765768564578684f314a496963596c785a72376d7932733638714e354e49527774706a61794d694b7a45366f505a776243514c6f31316161353659307467617433706a2f3653556e72742b7a636269736f37626169386934726e646e75776b72707a41373366666855796b676f3971382f5073324e572f436255736e3750662b476f363556495458776d75686f5462556472785861706b664b37576946426a614b6a42634b43534b6e53465a656a79316632324472727a316d4d7865324232386450713753435154377475585a7766647a7257702f5a75424b666e6a7248517946712f3779756530444b7936653175796d584f626b3977522f656a4c32654469794c38646566716a6364723565474c783145487445724c716b31733737554c586c4651304749365a63507676626d66622b6d7758425730546b56464a4945446b4679674946392b4b6271327a464f665848723661487777734775392f4f443377566a486d6650674668666941734c4175456e49566e7345537a667773494c516c6258797878347858594a436f557757507032513132305331564e6e336559456871724d367731353873746265664c58586a4855546b3146464945426c445441566b537544617136717462453548384e62597454616c756176737435387273514d3763344f336e6c6f4d536c792b7474475772322b774f557462542b7157594a784278667335397549665a746a6572666e42577766524f6e48317077363564523838684344437a7973506c647668514267536b564e4441786446786b68526561646463757352752b53324b6a6434627a67595638437168552f2f597261392f73513074302f43654f475759643662597a74654b334b4c4c57566d39376f78444d6e426f512b733963413231504e577446707165702f56566d56596438666743456c6144686a484d47314f75317374457253756c41572b4c356e525a5655487371326c496237644a794953473455456b5446514d724d6a45424371374f7772616f4f337849626d2b6933506c3969546758447731724f6c316c5133666f736c4c5159736b4c526e5337355637632b79375077654b796f62374962497a4f6c314c5133545a6e573656527844333474665545425257616356542b397932314b487a3567516b6352545342424a4d4b623558664f705372644d63617a6f693265526f71642f4f647332507a3174516c314a3933516e572f5768724542594b4c4336716e544c4b2b773576686755307a715a2f6c6736733950644a7a776f56483251592f6b6c33565979593241744252535864377177554c6b37313970624652524578704a43676b67434c56725661422f2b7977716276615131654574307a416f342b4636655066367a4f66627148387574735862386443734d4637744c48743658592f75333531745355722b5642494b424e3069543767652f6f45444c4361304d644d3245746b4951476b6f4434654c776e6879314b49694d495955456b51525a644761545858766e49626657514377595a2f446159325832334f396d5471724265753074715735715a7432525150455068494f38344b5a556b5949434f3066792f6377463753654d3357423942645a77324c38397a77555145556b3868515352424a69336f73557576364d79707655502b76764d4b76666b3268502f4f7a44756f4b4e7438685641756944597236466956363562657270736471636c4a51304568664a3537645a344c4f4f45445a3959746247394a63336d4c4775786a4b7a4270616c7059636a4b3633557a48316739556b5153537946424a4d356d4c47793153323437347459504741704c4a4f39366f38674e5444793479332f6667386d454b5a784d33577876546e4e5451444f796574305942415973306f4a51567a577732694b6250725530704c6f5a456e4f57747836664b63472f42615664727474692f343638675274464a474555456b5469694b3446646a794d5a5a4169666575765031356d6a2f33764847734f61573666374c6f37552b7a596f53787262306b4a424b70324678546f67736776376e477444533342705a793548774d3273334a36625072387752595a396f6f6f4b4f6c797930757a51714f494a493543676b6963734b6a514f64636573375658315152766961796d4d744f652b633073322f6849325a54634b746c3150787a4974716161644a757a724e554668634b7954737370364c49444f7766484842436b57474b612f534d596a2b444a79695659394c6878484856564a36376b4b434c786f354167456765734163424b697564655632317051327a7654484638396a637a3764315869344b33544532456f324d4873317758772f79566a44336f746678413457636e796e3376444b374d794d44483374346b6d374f6b7a53336c37474651493673375675374a6352744569556a384b5353496a464a53637238744f4c334a4c7236317967704c6f2b2f6953454234376e637a664463396d717071446d6536734d43797a4b796e5149744d66332b7956653465474b5042744e43326c685158784c6950683555634d375037334542505a6b2b49535077704a49694d30757846625862784c5655324f33436c4777307243723779634c6c74653655346549743436444a67647350633561317578674f724c6a49656757345a644c616c75746143385055546148316773366e6d2b6e53724459514e45596b76685153525557416c77484d32564c7575686d6a59652b47317836665a4730394d433935793671576b704e6a3036644f747057586f5752686a6752445663437a6446703765346d59774a4b66303238483363397a654547416d434b304a383039724f543762415777377a62524b466d3753516b73693861575149444a43584d57754f4c6642316c38626652774352573737706b4c623947695a4737452f6c704b536b6d7a6576486d32657656714f2b6563632b7a7979792b33445273323249632f2f474672626d36325862743257582f2f3445617779594871652f333131317452555a485631396462642f6667594d477877506f4964433073434153426a4f78656132314d633174696738474f5064314a566c6a575a535854423564745a7232463950522b467844553753415358396f71576d53452f4c593439724e76573734392f72505a647251694b33684c596c486f7a7a7a7a5442634d7a6a3333584a737a5a34366c706157356c674f2b384e33766674656566504a4a362b675958413253783931343434333231332f3931396262323275646e5a315755564668547a7a7868473361744d6d7171367544393079736e50787557372b683269362b75636f71574b4c3633746d426f4442773768696f654e616c7458626c4a797050474d5149316c39677234754b4b624465684d68595555754379416755542b2b7763363674746d56726d6f4b332b47506b2f51742f6d4f6d617a524f4a416838492f48623737626662582f7a465839684e4e39316b6139617373646d7a5a3174756271356c5a6d5a61526b614775392b2f2f2f752f322b4f50502b3462454c373478533961666e362b5a57566c756365566c356537352f6e51687a356b697863767472362b50686363456f6e5746685a574967544d573937695a6a6351414e44626b2b77474d6a4a417448545759477343754439724c787a51496b736963614f514944494344464a63653157315a656631426d383557554e316872337835445237393558455458576b4f324856716c563235353133326d632f2b316b373434777a33446944374f78735330395064385866512b7641335866666259382b2b6d6a45674a435864324b423557654543774c442f506e7a37667a7a7a33646446725249374e79354d3369762b434d594d46427835734a576d7a616e493341753036332b364d42364348546645416a6d6e39627364705830304f57546e746c7644566f3751535275516f622f694567735750526e326471474537597a4473642b444658374d2b33397477626e2b386354345744353875583274332f37742f59762f2f49766474313131376c78424c5141684159447a306743516a6a4341712b78644f6c5371367171437436614f4658377339784d6b507a694c6c74785472316c5a6738457375374f5a4b76634f374150524c6a536d653375733245386734694d6e6b4b43794441786147372b69756267642f3559647669646c30726474736678526d482f307a2f39553964747741444534754a693135305153547743676f666e2b75593376326d624e32384f3370493474426a73335a7276466c616174616a4e356934666e49564271304a4673417369564870576e38315a307571364b55526b394251535249614250514f576e4e336f6d73416a595847667656767a624863435768454b436770636b6637454a7a35684a53556c727555676d6e67474242352f31313133325850505057646458594e72466642636439787868357339455738737450543263795857325a70693831633275326d526f447543445a37384e7355714b752b794f557356456b546951574d5352495a682b6f49324f2f76794772665954795248507369784e35347373396f6a385774466f487542475176662b633533334c3944685150454f794238363176667375656666393433494e43796363454646376a62746d33623576364e462f5a7879436e73636274713168374f63474d39304e6558354461475967476d554b6e70665a61556e4754566c5a6c75414b53496a4a7843676b694d574d686e35546b4e74767153757541744a324f56774333506c3967374c3856765655554b4d624d4c7676613172376c4269616d70517938594e4e594267656469734f5470703539757061576c746e486a7875433952712b374b396e3665704f736647363747366a49426c446f616b384a6e49742b46784c3462454b785a484e54625a6f6430726f4a49714f693767615247425755647471737853646574596172727379797656734c67742b4e486f58346b6b737573622f356d37397859772f346669686a485243592b5142614f3368655875507a6e2f2b38757931656171737972435a776268656532527a344441625870576875534c566a4230397573574777342b4a56545659794d334b336b49674d545346424a455a465a643152393264676b4f4c3256777674794166785754534a6f6a7433376c7a37366c652f36745975694d5770436769686146473439645a623763494c4c777a654d6e7173764c6837613536314e366659764257443477316147394b742b70442f2b533659316a586b516c636945703143676b674d57417034345a6d4e6c6c633057437a445656646d324e36514c5935484b79636e787731534c43794d6263664938524151504c774f33534e305038524c6656576d323852702b76773253773875673933636b4f623262476a33325371616353506c6378555352455a444955456b42726d4658565932707a333433636c5937476633327756785738534859767958662f6d58746d544a6b7541743059326e674f4368652b514c582f69435778593648707271306d7a504f336e5732705269786345314b6c6950677245483152556e6e33663231706978734e324e5a5243526b56464945496c42546e36766c63794933497251574a50686c6d434f423472785a7a377a47627668686876636677396c504159454e6f3036634f43412f6568485037496a52343445627830395a6976775654786a384832324e4b5a61545a582f4f6846357856303266623543677368494b5353494449464e6855706e64726a42634836596f6e643462376237476931764a635650662f725434334b61343341437772652f2f573137393931337261656e4a2f695430577470534c664f746c53624d572b77384c633170523566736a6d6375687845526b6368515751494f666b39566879794e58453475686f4f37733578382f5a486935424163576338776c436d576b42415a337579472f744236344533375a453948706a3577414a4c3456795877774b36484162506a346a45546946425a416935526430326258626b4a7576476d6a5137386b4638576846594b476e446867334257794b626141474235324a33796e6a6f6145304a764661536c59577365736d73682f706a2f67736e5a65623257483570354a416e497045704a49674d675a5945396d767777325a446a4c69766938507169685253396d49593636575778794967664f6c4c58334c62574c4e4231476a56564761364c614850754b4132654d764165676e6337696372743964744c53306977366551494249466577586b467653343167512f7259327056686468304e787755456a58726c3172563178785266415766784d31494e78383838337575613636367172675430614f566754476764436934476c72546f73347379516e767a76716a70306945706c43676b675532586b39566c4157756343304e4b613550514a476936344741734a59376559343167484232384b6157527678514e6643775a416c6c316d696d5357782f61526e396c6e4274453733575972493843676b694553526c64746a5259454345306c7a665a6f64725268395345684a53596d36692b4a45447767657568745772566f562f47376b574e3279735362392b4944456e75346b4e3343787138502f5431703258712f6248564a45686b63685153534b724d44565a32474534744c546c57544e64576c75796544526f4b4375576250477973764c67376563614c49454250417a397149594c634a41344c53637341496d585243303750696846614577536f7551695068545342434a49694f7a33374a7a2f5a75704f7a745358557443504a782f2f766d756749616254414542336e48485131643734507733444d356f5948706b6134502f44706d73645a46626f4f34476b6546535342434a676f474c61656e397765394f314e6c4750376a2f744c76686f4844366454564d746f446759514d6f466f7761725937412b572b75477777464857334a455673534d724c364c4b6641662f43706945536d6b434153425345684a5731674d3646776a4b356e50344852594d44692f506e7a54397266594c4947424844667338382b4f2f6a64794e486c304e6273333349516a7059455a6a6d497950416f4a4968456b52494943616b52516b496e492b704832643141534a673362353462754f695a7a414842733372313675422f6a5932553148363351694e685155526970354167456b5730376f61756a7154416c65786763522b703041474c55794567395058313251392b3849506764324e4834784a45686b38685153534b704b522b46785438734e6f692b77614d566c6c5a6d667433736763456e6d76486a68317572595244687734466278303771576d4272777a2f566945523861655149444943624f62456c4c75755146415944626f62706b2b6650695543777336644f2b3275752b36797658763375746145735562595330337a44337769346b386851575145614556672f344452496954516b6a4256416b4a4652555843416b4c6773414a666b554d415030754e3048556b49763455456b5247774957454f48513145424965654f4142425951344747677069507a3862715a4b71726f6252495a444955466b424267746e356f2b756f4a44514367744c62576e6e6e7071796755456e69736530794244755a41517061574143535270366d345147526146424a456f47487651323530552f47345142536b74796c56724c436969783434646d33494267656d65662f64336632644e54553342572b4c447452536f4a55456b72685153524b4a675663585170583839724a3851725344466967474c6e716b53454c37796c612f595a5a64645a6f635048773765476839384a744661437271376b71796a6666546a5345536d456f55456b5368594d436c3036563950636d712f70576645722b6c364d675745393935374c327041324c42686737573374377576654b494c694f5758492b6e70546e61685430526970354167456b564861374c764a6b3444492b583758425032614532326750434e6233776a596b4334377272724c444d7a3032707161747a3934796b727439667953776650525469326b2b3571313538386b6548512f324a4577715146696a394c2b4b4b546e51596a4c4c32636c7445584b4579445258556b706d4a41344c3556565658426e385a485a6e5967494a523042593437536e64445a354a7247524b5232436b6b6949524a43396b4d694c5551476d76396433704d6479466839487342744c5731545a6d4134496e336549544d6e42347243495345614872563353417962416f4a496d457933626243586b7443696a58585a726a2b374842304e3253504d695251594c647332524c384c72724a456843347a367576766872384c6a34496177565275687236656764614555613751716249564b502f785969454357314a5147747a736a56556e3979616b4a375a5a356d6a37473667794459304e46686c5a575877466e2b544a5344776d434e486a726a48785a4e7253596753457472647474372b4c55496945706c43676b6759646e334d7942357349576876547258366f7963586d4b7938486973713677782b4e334955616c5a636a475379424154774f466f52516c3837486e494c65327a61724d48314a734a3174715661553452754978474a544346424a4578766f48356c5a505661796379426f7450576b6d6f4e31526e7576304e6c352f5a5959527843416f587a75656565433335336f736b55454d426a4e322f654850777550764b4b753233362f445a4c69624a476768746255754d2f41465645496c4e4945416e5433704c6d2b7136394b394f572b6a5372506e6879386153376f6269384b3341564f3967314d524955546f727457322b394662786c7747514c434b6976727a2f7066593557586c4758545a385866633046645465496a497843676b695931715a55617739383552554e464838474c645963536265617779635850715a4146675743776d6852754a393838736e6764774d724d553632674d44394e323763614330744c63466234694f336f4d644b5a3056763057465751314f7457684a45686b73685153514d4f7a776d4266365855547939492f447651424e3259303236486436623766343756485a2b6a7857586a37374c67514c4b526b396361524d51574c46774d67554564485a32326f4d50507569654b3135594836467362727356546f763847585231704c694270316f6a5157543446424a45664853324a31747157722f4e57747a6d766d3974534c667151796358302f7a69626975664f33436630577074625856466c4944414749584a464242347a474f50506562326449696e334b49754b782b69713647354c73324f2b58515869636a5146424a4566427974794c4c4b76646c574e6e746758414a39326b632b794c613671684d484d444c4163636243396b42514750302b42425453652b2b3964394946424451334e3976393939392f7772484541394d655a79364d48744a6147744b737869666769636a5146424a45664c5132706c6c335a36724e584e5471466b304354646148647565342f7736565639786c302b66485a374d6957684d6d5730446763593838386f6a7433627333654574385a4f6631324a796c725659616e4955535357745469745657616443697945676f4a49684530466962366759786573335a6455637a624d2f57664774764f584658794868324f59536144414742353248784a466f52517266466a6764614557594d305972413533663051505a4a6e356d4978455968515351436d716d37326c4e73527243566f4c6337795935565a466e46657965324a74446c4d4874706d38316545722b674d426b43416e6a73506666635934634f48517265456a2f354a6430326330483046707932706a537250584c794768636945687546424a454957674d6867656d5079396332574d6e30675362742b714d5a675a43514679682b53653537443650725a79324a3739532b327470617938342b65555a46755045634548372f2b392b37575275687a784d5037506934344c516d39323830724931775a502f51353142452f436b6b69455451335a56737877356d574739506b69303873396e643174475759767433354e6f4832302b3875716670652f477170716854385961446f76726969792b365a76706f786e4e41654f4f4e4e2b776e502f6d4a57785171336b706d644e6a383077632b6b3068616d394a732f2f596371366b632b6e6846784a3943676b67553955637a33566252703533586348787749745070646d7771636b763968697163316858584c6765326b5037786a33397372377a795376435745343358674d427a305172796a2f2f346a32355751377a52657242735465507862714249474768617566666b676159694572755557624e6d335258386278454a5138744266312b537a5633524769682b5a676433356271576865364f5a4d7376376a6c6836694e6a453969532b4f4437755734426e336a674b707939446d624d6d47454c4679344d336a712b41774c5038626e50666334466855526778736e617132737372334477505966724458774f2b37666e327476506c507075387930697356464945426b4371792b577a576d334f55746272505a776c6d745a6147746d663463556d3732347a553346513349674636526e394c757844504873423239766233663748645455314e68353535303362674d436a3333676751666363744c5631645842572b4f4c566f537a4c7132314665736267376634617a6961596474654b72474b514741546b5a46545342415a516e7472617143614a746e694d357347726c4233354c6e626d65334173737a4d3166657766545162503156396b4f3357576f6758576854323764766e766d68524749384234542f2b347a2f7356372f366c5674614f6c46696155564131594563652f7535556d754a343263674d6855704a496a4549436d703336624e366244354b316f4378542f6444595a6a4c34434f6c6c53335854533751587059664b6d394f645571647358334b7261377539734f486a7a6f437674344351673844394d6237373737626a654c67635767456d586137485937373050486246467745476b6b5462587074755746456e76766a634c674c53497955676f4a496a486f37456931314e522b57336c75666541717474737139777773304e4d574341503966636b3265306d725a57514e4646722b7a63727073386271644c6341557a79784942486444754d684944416f6b62306d2f76752f2f397532627433714e6e424b46467073566c39635a2b7575716e48644f7445633370646a627a34317a61317a49534b6a6f35416745674d474c77622b7278565048316a6c72364d39315131695a4c30454e6f504b79652b316d5973475a7a5a51314e4c532b397a6f6567592f786c4e6f555363676650377a6e376462623731317a4149437930592f2f504444396f4d662f4d4365667670704f33723036416d684a52486d4c47757838323834616e6e4630562f48613058592b62706145555469515346424a456130485054324a4e75694d357463574b4167735a7066523275716d77355a4d71505454594e456f48613746675565343766665137785139486674326d5576762f79796d7a4b355973554b46787a386a4459674e44593232725050506d762f39562f2f35665a69714b797364474d6c654e354559736e72433234386167744f473371784b725569694d5358516f4a496a5072376b36796e4b386c7943337473796570475330767674636f397442536b576e4e3957694151704e6d73786132576c5475775230466d647139725955684574304d6f6d766e7067746932625a74722f696330634c572f614e476934443047304658787853392b4d6561415150466e6c674942354c373737724d662f764348626f644b486a385734514335686432323973706157334e6c54664357794e534b49424a2f53657657725576382f394a464a7048354b357674366b3864636d486831542b5732365a4879397a7464432b7376725175384c4f44626f5944714b4f37333836334a2b36644d3259722f32566b5a4c68697a354c4f4b3165757444504f4f4d4f574c3139752f2f5a762f2b5a325976514c434a646565716d31744c5334734f463973543644467a6749496e794e525444774a4b6630322f4a316a58624e707738656236474a5a7538374266626f50624f3177714a4948436b6b6941775434773357583174746c39353278476f4f5a39684c39382b77725338577535396c35765461756d757137636f374b743333364f6c4b7471307646516543776d7a726a505034684b476b70366537723753304e4e646445426f516b704b53624e57715657375752464e546b3273645947774239364856675644417a3034563171573436684f564e6d2f6c304e304d5277396b326650337a6251646d39534b49424a50366d3451476162757a6d52583741744b756d7a75736c597243467a6c4e74637850694854726535584777674f724b4867465465756949764c4f79303172642f326263743374343056696a3074415a4736422b7271366c797241514743365976636a33444159304944785667726e645668353939777a4a61746a62356f4574716155674d6872635465664c6f30384235503348684c52455a484955466b424269733242636f5343796b5644717a3032337756484d34792f574c6433656d324a4550636c795157486a47774a7a2b3150522b64372f6b3144367232446d77474e4e34514967346c574841442b4d51316c3164592b757669573356786b4f37633233546f2b567558496949784a6443677367494d505752466f57632f423433395a452b38364b794c7173366b4f314731744f6977455a514c4e464d6b4b41566758454b5a584d364c4357313379726530334c4266676f44596576436d34363636593678714b374d736f32506c4e6d2b6438613268555a6b716c424945426b6857684f34656d552f4161592f46726d56467a76644e44796177416b4b4e59637a58576959736244646251436c6f42415a352f4469573674733364577874534377375056627a3562593571656d715a74424a454555456b52476f61552b3356716241694667515a766c467652593866524f74365630625657574e64616b4238636f5a41622b4f793151424476636652515554736153793566656674685758314958764357363771346b323757357746352b634c7062486c7445456b4d6851575355366f396d75463068463631716374304b6a452b594d622f4e6d6f4b4447566d4136646a42624c667055314835514c634551634774715a44584d7a43596351706643624e7030315766724278795a3864512b392f4e7432642b4d3873616a6956752f516b525555675169517536486670366b6f3450564d7772367262794f5232757138476274382b6778737139325334596c4d2f74634946697a7049324e304f43767657704f50427534526c4e6476336e4b7477356942584c59542f3732356c3265462f3874754d574558384b43534a78514c63434c51657061583348393342676c503630325a306e424957327072546a717a5179686f485647656d696d4c577750646a794d4457756a416c497939633332725633486771636f34376772554d37656944625872782f7575335a716f474b496d4e424955456b54686a493246696459646e353357374d4151674b302b64334449784e714b4c7249636c4e6a547a346671357256636772376e5968675a61487563746233564c4f4454587037726b6d71387963486c7431535a31642f7448446271426e72476f71732b796c42366262396f3146775674454a4e4555456b5469694248335666747a4c43326a7a77316d424373307a6c2f52624e4e6d64626f75683661364e4c65724a494869774936383436304b544b506b6667744f623747756a6851333171473364334b4e5653696431523449423066732f4f755075656d6a7361717279724258486936334c632b58424738526b6247676b4341535a2b7a38654c5169323632304f487678514642674d615879756530322f3751574e3132506267566146377857685970644f5a61654d54446f7362437379343174594a5a45577942304e46536e752b6559794767394f4f33384f72766d5534647479566c4e626d5a48724a676c73764752636e766a79576e425730526b7243676b694352415232754b47347759476853516e64646a383165327549474c5466587072674453716b414c772b3633432b7a417a6c7a585831387976644f315243773975386c4b5a336134466772474c45784558757642525463646453466f4f426a503864706a5a6262786a2b58425730526b4c436b6b69435249704b44415666533057523232364d776d797976714352544339454149534c572b33695272714d3434486862596169452f554651586e4e346375507075644e305272593370726e424f42497a484f4f75795772644a302b4c567a634e71505143624e6a333179396c75547759524f545555456b51537941734b6d4c47673351554744344d55357935727353566e4e316c574c6d45687a647161423850437273324662704265585657576d7a624a74736d724c71367a6563746233446f4c37633070626a7a44654d4d4d6a336b726d2b3261543158614f52757133514a53773856596a5566766d57743733786b2f2b317949544558614b6c706b444442493737547a36674e4638356a6234644150672f5065657262557472386143415a485435774b795a6747566956637361374274536f776536493945454432624d6d3339393873744150763562677569564f4a634641327439315758314962654b384e72695668754472626b775068714d68652b4d503034394e47526554555555675147534e4a7957617a46376536355963587232344b336e6f79426a567565614845647235575a4e57485469365579636e396c6c2f6162584f577472677646694a697659574b514644594651674d2b33666d577373594c737845474669307574464f447753442b5374614c4432724e2f695434574663426e737876506c4d7166747645546e3146424a4578686a544864646665387a4f76727a4f6a6671506842555933332b72774c61395847494864756134626f6849364b365950712f64696d63796c584c6769396b5331594772385350377375316f5261627277756a70436953564f456a503667753858717672416c6d327474454e72687770426d34653370746a7a393833492f422b74556953794869696b434279436a416559656d614272636c4d6d4d566f6d454449365a4a767664366f5833776271376257664a556f4474683270774f5737616d305a61653365423274715256597a5149517474654c6e59374f55365631535a464a684b46424a4654714878656d3131305535576236706752434135443665704d746d4d56576262766e5879334e444774424e79574b49796c6d4f32364e56707437764a6d46777a534d2f7143507832353375346b74365532437954744449516645526d6646424a45546a466d4b6a4332594e33563157367341717331787171374b396d74746344716a4856562f4a747039636379724c45327a56727155393173435861686a49545a46706b35765a5a623047303567612b386f6c3733622f48304470757a724d584b5a6e64615375726f5130456f4269532b396e695a376468554f47476d6334704d56516f4a49754e45526c61767a567652624f7576716247465a77357656634a49474d66414e4d7957786a5472616b2b786c4c542b51436a70445153523373447239626c414d746f75673167784a6f4a6c6c643935715668644379495468454b4379446a446c6633433035746379384b434d356f7461594a763330424c78375a58697477417a4b723941327447694d6a456f4a41674d6b34785932484261633175665155326661496259434b683232504c3838573266574f783731524f45526e2f46424a4578726d6b704836336e665270357a6259696e507262656243775357657835756572715241494d697962613857326337586936784f33516f694535704367736745516c66456e47584e746d784e6b78752f5544717263387a4746455453315a46733151657a62632f57504e75377463414f37387479417970465a4f4a545342435a6f426a59574654656151744f613746354b3576634e455532675571302f6a357a41794572392b546177563035626a706d3159464d362b756234494d6e524f516b43676b696b775454475a6e4b7950344a6245566448766833327077324b356e5235575a4f44426537554e4969774a34514c48705555356c686833626e3271483363367a32534b6231644373556945783243676b696b3578624379473731334c7975793233734d65793833766376307946374f314a63743046335a3070626c456d2f72756a4c646e616d744c634678737569636a55705a416749694969766e535a4943496949723455456b5245524d5358516f4b4969496a34556b67514552455258776f4a49694969346b736851555245524877704a496949694967766851515245524878705a41674969496976685153524752493565586c64756d6c6c3970353535316e52555646775673487a5a77353079363434414b625033392b384259526d5179304c4c50457a59775a4d2b7971713635796853516a49384f536b794e6e304e6257566e7630305566746b556365436435694e6d33614e4a7333623534564678653759724e6f30534c4c7a733632686f5947323731377437332b2b757532642b3965362b3775446a34694e6f73584c37596262377a52546a2f39394b6a4846456c6e5a36643737662f37762f2b7a6f306550426d2b4e545735757269316274737a4f4f4f4d4d53303950742f666565382b326264746d39665831775875596536386334776366664f4465587a682b647532313131704c533473393974686a37686a5772466c6a7439392b75303266506a3134722b47707136747a352f365a5a35344a336e497950732b4c4c72724976516248745776584c717575726e616658553950542f4265412f693843516f7256717877372f6d6464393578377a58552b76587237667a7a7a37654e477a666161362b394672773150733438383079372f767272336648787667346650687a38536577692f5a37303966565a59324f6a376475337a2f627332574e4e54553375642f44516f5550756466772b693944664765374c377a572f7979556c4a625a6b79524c33665635656e69556c6e62684a566979666938685953706b3161395a6477663857475a5775726934376375534962646d797866304270636773583737634172396a4c674345667645486b6a2b345737647544543761584f4568454641454b5a67484468787766316a5050767473393466343348505074565772566c6c5756705972736d3174626346485274665230574837392b39335259342f2b42546c68517358756a2f713463666c665846387462573139764c4c4c397354547a78686237373570767344337473623232364b632b624d735a747676746b2b39616c5075574f76717171795631353578525662696a33483461476738443142676b4a4b55614859675850346f5139397943362f2f484c3366743939393131587048694f3939392f3335326a2f507838562b416f5047566c5a623776703753303149555543743254547a3570547a2f39744174656e4a747746486e43415957502f333731315666645a33727332444633444b4848377547384542363454327071716c313838635875632b4e3367765047377742462f4c5454546e4f667531385947696e6532355658586d6b624e6d797777734a4339316c585646514566786f376a7647797979367a73383436362f6835354a78787a68392b2b47465839486c75507375616d687072626d353237357666635549636e3446337667734b4374786e79474e352f33786d50495a5177656647385845667a73666375584f505034367778652f706a683037676b636c636d6f704a456a6338416554347355667738724b536863554b4f697a5a382b32744c5330344c3047554269353267774e435479656f744c653375372b41504e486c6a2b6f504263463362734334327156516b2f426f696a35466131514646327542416b6646456276447a54506d5a4b5345727a584946373732576566745a2f3937476675717064437a4f4e6a435167554c4172475a7a377a475866567a48756878595369544948774b374b45493136546745516f6f4a6a5374453967344c6c6f6d534549454a773458785163722f6879626968456e48504f4d3055792f4f713076372f6676666276667663372b2b5576662b6b4b4549574f597774484b4c6a6b6b6b7673316c747664542f6e7170625844413832667667356f59506a496a4251504c6b7970336866666658564c7544785752413434686b532b4c33674e51682b4648562b622f69634f556644515a634b7759627a79446b6b4a5037786a33393035347867517a446c6e504337793566332b37426777514c33576645373565463945736734647a794f592b486338506e7a753854354a777a7733345154506c39656b2f5047597851535a4c7a516d41524a4350346730747a3877677376754b4a4d6f526f75696963466879765a6e2f2f3835375a353832623368355243797058716e2f2f356e377543477672484f5271656a7a2f5962377a78686d764f4a5743456f394278764c5167374e7935302f3052443239616a34546738736c5066744b31486e43465347482b3757392f3677494842536661383142554b427a636c2b506a75613635356870627533617443783652756b6b6f5072775048734f564c6b556f484a384667597957444670364972554730414a4149622f6868687463415354594545416f694d4e424961584950663734342b374b6d32366a705575587567417a6b75366561506a7361594568494244346141466175584b6c4b39796a515768373661575858456a696e41303363417a462b377735522f6666662f2b7775374645786f70436769514d663169353071586f786c706f2f564230336e3737625876777751646434616241305133426c656f6464397868743978796937734b6a4256466a2b50696a33523473655359447834384f4f786a70716e3534782f2f754c75694a6352775a662f5555302b356c676975446d50427352434b65427a4669554c466c58463479344166696779686a4641547a757561344831465179456e494e4256516a68343636323368683051504a784858704d2b65566f4f5276503552384d34434d596a45454241305047366b30614b67455472455a386435387776554d5544775a6e5749774965353971763630666b56464e496b495479756839476579564773654b5036554d5050585338324e47465155476a7a35342b36566862464543545063335334563049584f48782f454d5631464163417930614e4e4e547244685769697a6a47507975374b5078436763442b794b314450696843424d772f454943495957576a4769664165654f706e617579676c6c68435243796d6a776570774867674c4e2f2f4575746c3551704c75426341414346514e66615245684c49774535357867517a424e564c6a7838486b54535069737658456f49754f4a516f496b4641474250344b6a44516e772f6e685451416b666f496d5a71306e3637756b586a6858686745415133673343315a7a583578384c75674b75754f494b4e2b434e516b75526f6b75444751794d7952674a6a6f6d51517063483579373847435068505955584e516f7a4957476f31677861502b67694965547748415364654252316e6f647a4566715a78517566465947474c6f7a51316859472f784563364f59594354352f51684c2f6a67562b312b6961386d765a456a6e564642496b6f536a4538536f343441387059784d6f7746377835437153415932304a6c446f5973457855625134766c41635a336a72516953384c712f487a414f364f796857504a347251726f7a52684f4d65437a392b734d70726a7a47623777423732656f393854564e77506f65452b303046426f3434565744466f554f4365784270355938443735666143676837342f5067632b447a346251747877654a386633546668357a4752614158696435726653354878524346424a68537563686b4d522f3937364239556968727a32356b4a4545753341775741776a4b616f6b567a4e7130492f4f734e794f5034614432684d4934577a3846564f4d553146743537476f6d636e4a7a6a4c53483853352f2b634174734a427758525a66576b6642514e6c6f384a344d797731744b65442f4d67686e754145614f6a3541516a3839764f48684e5a6b4e6f58494b4d4e776f4a4d75457732707a2b3474412b58496f624b7747794a67474c46795561563977305a334f31476e725654556867584541386d7459702b4252424267416d2b67725461304541307944504f65636331333054506e56317042686e515a4e36764e38485854734d5a673176706544394d4661454161584465512b45424149437a7a7557434165386271794458455847696b4b435444673071784d55777674774b517863315450616e616c77696351344342626434576f3774442b63776b354c516d69414751304b4b3033313865375044386437384e3448725349733848505454546535525a58694552516f7567536565463870382f6e7a764b77354542354161424868643245344d7832386c6753612f38635341596650654c534452555869545346424a7152496662694541316f537549704d4a5072766163374f7a4d774d336a4c41472f675972325a31417446594e48397a486b4d4c4f464d7657572f6763352f376e50736136534241447930736a4a644952484f3658387353654138633933434f335276584d644a756d394877666e644f7857754c524b4b5149424d537251686350544b36505252587661796b474c714f667278357979417a4f433630465146633259613262735144563565456f6e672f6279697559726e614432327970386a5370382f79306c2f39366c6674722f377172317a33796b686246706a6d393733766663383262646f557643552b4b4f7745526c6f55516773736e77307450557a72704f566e4b42526f576d315932664a55384c704f6144305347533855456d52436f6a42776452302b545933437744512b5275736e437076305544775a4842654f34347033767a73466e50664b31586969304558434c49487746684336486d69324a78797756504d2f2f4d4d2f32502f37662f2f5037657377334e5961776736465042465443796d776669314c724b5641793149735851363053447a2f2f504d6e62557731566e683956726c6b734b7249654b475149424d577a624e2b6666563041644474454b3942642b456f6d7251692b44302f685a796745452b306c6a44774c393750473472697a664c584241572f47522b735230454c437358327767737674442f356b7a2b78662f716e66374a7666764f6264747474747957386532636f6843694f5054776b45484b3833536d48477166432b5358494a4b4a4c4a426138506f4e653665345147533855456d5443346f38356f3848446d2b457033685478654533684330634c5171523943436977666b56324e4367615449396a55365477377056346f5543784a674d624774475645776b744e637a6d344e79796a444f72544249597676577462376c574271614545714c47476747416e52767049676e487a2b4b786e345049564b535149424d57346342766b42657a484a674f795a5676496c434934726e59304643347571552f6e383279456a6b316a323441586f4e644b32505a63496951524b734e57787a54704d3969566c2f3834686464594341346a48525a354a466749436c426746314877336d7a586b617a6e345049564b575149424d57563967307a345948426135326152373375394b5042774b43587a464349675975386e774568555350664b634668484441726f543333484f5062642b2b50655975447334312f6638733738776545422f37324d667336312f2f757475706337517a492f78512b4e6e536d613450647437383747632f36376f552f44357a6668394775352b447946536c6b434154466757544d51447862743466436f5849727868527a4f6b43696156506d3057662f766d662f396c2b39724f667866543130352f2b314c37383553386e764d687854686e457945365564393939742f33762f2f3676472b3066617a6968494e50645130734f562f594d64767a536c37356b563131316c51735249305834344c33544f73544b6d697a32524a6353737a345954384555534c62435a764369332f52546774316f396e4d516d616f55456d5443346d71656f70476f466f4f52694c556c67565555662f474c58396744447a7a6778687051514a6c57535748312b324b3351775948526d72426943644346774e436d574c362b392f2f337237786a572b34715974735a7a7963465146707a66465777627a7a7a6a767478687476484e463442626f7a43416755656c7150574a61627159724d517544637354736f352f4548502f69426666766233336262624966506f4f42335a4b54374f59684d5a516f4a4d6d4852354d785865456a67717064696c7168523676475977554433415273346363582b6f782f39794256697274726a76516c5372436965582f6a4346397a4151772f6e6b566b56424271326532593241344d54662f4f6233396965505874696e75724a474137474139787979793175572b2f6842675736436768487442707737676b776444507847584d4d42416647616a4467637576577253347776506a696979664e45686a706667346955356c43676b78594e477548723367497275535a425a436f6b45427a646a7857564f51344b5754486a68317a562b324d42626a7676767469476a515962785251436a6e4e2b754534546d2b4e4136376143544e2f2f2f642f37785a59696a5577304b724147494a4c4c3733556452664569754f6869344241454d745379587775744336773367457a516b4a626451695549396e5051575171553069514359766d5a3470626545734334594256362b68625477514b466c657938627a6970356852424e3938383032336d4d356f577970476769742b31685367575434536a6f733143576a795a38614646786a7575757375317972433073696868546b55525a71437a303664736179417950335a51344c754156347a316e4552484f5075336276643770446855305a7078526a756667346955356c43676b78594241532f706d76366f776b4938626a61392b4d3966336a52597441654c52742b725275784948527739557678705a6c2f72424553574d36614d5143784341304d4c372f38736e332f2b392b3372333374613236514a61304c6675656673526345685668436772632f42756543566f7a68494b775174734c58664f413938766f6177436753473455456d5a446f702f5a6247706e435451476e43543952764357417737737a764b6d5866493055685a646a6a365670506436346369636b78464c41773948645145476d4d445059385476662b5937724f676e2f48476a31496467786f4445616a6f58506c3841796b69326d47627477344d414246315a43573258346a49617a6e345049564b655149424d532b7966514642312b3155355841435066475779584b46773955337a6f63676a486c584a75626d377775354878316e2b49314779664b463442355370374a4c4d5134413132354450343161392b5a66666565362b6251756c317a664161424c75687a6847664c657361455068472b6c6d7954444e6a4b4d49586f4f497a696e552f42354770546946424a695261456d694f44683241526c486c617061693472656e513778776c6372564c61304a3456304f684a6277316f3368346a6c5078666f506f48677a734a4131425561443436635634624848486e4d744336484e2f72516d524774746f59687a444c5271554f68482b6c6e536773446a3651344a2f5a783466566f5259746e505157537155306951435965725850594e594f5137563659656d76395a4a5a443538346d2b436963674d4e30756644342b67796b5a7865383353794257394f587a587361364a5146654d7a395838614d746f4951635a6b567332624c464c58626b646338776d444261345a3833623535625734455746626f4d526e4d65474d744146306a3464456a7435794153473455456d584334437152504f5852764267714a31377763506c677445576a4370764452616846366c52724c44494768304470433241696674544657324c787133627031726f6a474135384c437a455271506963434135382b5345417371777a33513130552f44593065427a59715a442b4e6749776c4338396e4d59716d56455a434a54534a414a68615a6f56682b6b4f5a772f394234472b6a333333484f3261644d6d3139513947714774453546513746674d36656d6e6e7a356858514f4b785567482f336b49434454377879736b38483569655538657a69747243624444597a7932674b625a6e35594442682f793333545652417079584e6d7a35444c762f6369524979634d4f68774a50696461452f77474d4d5a7250776543495a2b5a7947536b6b43414a35593064344139705048446c643845464637685237313768343671554b58694568466a37722f6d6a54704e7a2b4b493633423772464561617a5a6d755346447742736435785963514d394c6c66326b6834546d4755396a4273544d65497652782f44657246513533576959686866554d5750786f70494d5951334563464834474e524b752f4b59307374587a756565653638346451533938397368493052704231784344576b4e78767569324968434e4649474b332b337751456459354c7772504d684570354167435555686a7254502f3342785663744751537947347a306666633055617259335a7078417243696d544d4d4c6279626d65526c5045477433416333594c434c30306b73764857394335376b5a654d63492b75486974626d365a666247634e484b77766b4f44776b637a3343337a61626f63513675767670714638704773304968495950506a6e4f39632b644f563744445777676f7472515145524b345036386672795a38586f735146783453654131616648682f49313033675444486577735041787737353379343531316b764646496b49536945504f48654c544c34484a567a723443584e6c366633695a4a766a7373382b36715859556e2b46304d2f44486e57344276354441482f3159757773596a3044664f57734345426134557162343049524e7752744f74344e584b426b504d4e794e6e436973764b62662b674f30436a41594d4e615744596f7155772f3549696a636474747464766e6c6c342f344d2b52384570726f456e72686852666373736d68654e38456f35747575736b566137376e38786c705334776637346f2f484f655a4d524145685a47306d4952755068574b337976436361774c55346d4d56796d7a5a7332364b2f6a66496e484648336d4b43332b4177366346306a2f4e73726c635651364635376e6d6d6d7673686874756346305839444f7a4d7545662f764148743938427a636e443662756d5946353333585632316c6c6e6e6654486e53747669676e64466f79734478385637346567514741684c4441346a2b4a41537743466a695a7a6e696557785944595a4f6d6a482f326f2b356369512b6a6875546b6d5a67725155734a67535970334b416f677253765858332b3965322f6854642f386e414a507177664e2f4a792f634a7a587457765875767579692b4a506676495474366e5461362b39356f364667614955564d59534447646849774c436867306233446e682b51674a6f55736c453244342f626a6a6a6a746355504443455a384c723876726a5859764334376879697576644f6331504f6877626e6c4e41694d2f59787845654974444a46357776666a696939333743472f423454317772766e635473586957434c786f4a4167436345665a71344d36523767616a54304479686943516b554c456259662b49546e33444e336c79565554533459762f3172333974723737367176766a4732734c41736442614c6e31316c746466337434307a7a346e76353769695a5447666d65626f54775051444355517749466751464e6d746947694f50393662595558776942513565622f3336396661786a33334d6a65706e79743576662f746274784152685a57517758766e4f454a44416f2b6a5035326446572b2b2b57625843684565656b426f6f5057464b31366568304446633455756d387a374a5767777150444242783930783843695552526f5a6e4477333777575930496f6f75454c46506e687652504775454a2f346f6b6e334f666c6a526d6877463530305558326b593938784e324863516968347959345a7537443778473345384b383770785938546a57517544336b4547596e4950777a7875384672384c6e422f6548373933744168462b73774a6637515363633476752b77794634444367786c34486e376e4f412b384e6f4752392b3858306b5447713652313639614e2f596f744d696e526e30346f6f4142544750676a7a782f6638435a39634d583938352f2f33473051354b47416353564d337a71505a56415a525a5043522f4769514c494f4167574c78386661656b4278752f48474731327a4d7333784842505036566377505077683534383678596e58652b575656317a426a7557716c69745370684853316344564b2b2b424c61415a74384443506837654c79474977735435346f71546773792b413777757230384c4173394673654e354b6434454939595249465277766e677356374c6856386e68614a576753504863764e59662f2f6848652b615a5a397a5043436b55624d347633546668725157634c79396f5550523444753462506736457a34327777705535434565302b6f51575859366434456377344c4f676d5073565764343751596258346a317633727a5a486e726f6f52504f59546a7673365a3767794c4e37784b664f53315a667138526974666a66664e362f48357872686a76346e337568414e614a5067644a786877506d694669506138336e76672b666a696e504565434d6769453446436773514e7a66513073314f304b4d4452696a4146692b4962326e544f34796c4768416f4b486e2f672b5a6637556d443449307668484f36566d4263364b4254526a696b53586f2f58356c6948303633422b2b43314b65413868316634506278666a736d376771596f635a55652f7634345a733444526339372f785258726c4c392b746c6a516548692f58677441687748525a44586a3959307a72463637346637686f634a6a70506e347269382b3452666b592f6b32436d326e422b4f4f5671727a6d672f36314163662b6a6e7a6e736a6348436568676f63666e675048447650783373526d516755456b5245524d5458384f4f776949694954416b4b4353496949754a4c49554645524552384b535349694969494c34554545524552386157514943496949723455456b5245524d5358516f4b4969496a34556b67514552455258776f4a49694969346b736851555245524878703777615a744e6873696830572b5a664e6b646977682b3247325a4878344d47444a3279564c496e447a7046732b6377475365427a345078585646546f4d78415a357851535a464b615058753232395a3331617056376e74325432527258335967334c68786f2f33796c3739304f2f784a3471316576646f75762f78794f2b757373397a4f6a2b2b2b2b3634392b655354746d584c6c704e326b52535238555864445449707365632f582f763237624e662f65705839734d662f74416565655152563654597070695742526b62684146434159474137624d66662f7878652b757474785151524359416851535a64416f4c433931564b363048447a37346f473365764e6b4f4844686737372f2f7668302b66466864446164416132757239666633753636475134634f3666794c544244716270424a5a2f72303666623172332f64696f714b37442f2f387a2f7437626666747136754c69736f4b4c427a7a7a33584259566475336135376f65564b3165364c676a55317461367139354669786135376771764439314467614d666e624178642b35634e3936422b31525656626b6d394e4172592f72684679396562426b5a4761346f37747935303756674c466d79784c4b7a733450334d6c63732b666e75336274396638357845327232377433722f70752b2f664437654f7272363930564f76646273574b467a5a6f31797a497a4d313178626d74724f783653656e7036676f3859634e70707030563976347a6a344c33796d7458563166624f4f2b2b3441465a5756755a654a7a63333139322f70716247746d3764366e34573776545454376576664f55726c7057565a562f2b38706674794a456a775a384d49746a7832644861304e37653773345a72376c6777514a336249776c345462653337783538397a3535666b34546e3747735845626e326453556c4c77575166772f6a64743275542b395842666e767659735750486e316445547051532b454e79562f432f525361466c705957562b677066685465337435656479564c4564327a5a34387243747857576c70716c3131326d643132323232755146466b4341394c6c793631573236357861363535686f584a436845464a5372723737614658554b4369486877782f2b734e313434343275594f335973634d6147687063516161776665786a48374e5066764b547267685245506676332b384b494d39783838303375364a4c31306367704e75795a637463514b47675833484646536638664f3361746535344f4f6136756a71624f58506d43632b526e4a787378635846376a5943784f7576762b35656b39632b3838777a4c53636e787a334842526463344936446f68386545696a673064357659324f6a4f302b33336e7172437755387a39476a52393241554d5a38664f516a48374531613961343277673766735757514d4578554f7a706275417a436e663232576537383859356f4475497a3470576f527475754d4764613834356759707a785875392b4f4b4c33586c59766e79357535336e765044434339336e5366676a4b4241554c37726f496e65634c372f3838676d762b3947506674512b2f656c5075382b463171625141434569417851535a464b69474843466538595a5a37694263375169634d564a5550434b4a4d5750384543425978446a54333779452f647a436a6f4669613848486e6a41667633725878397643654266667337586a426b7a584e456b6246416747663941556155345539516f6a472b2b2b61626464393939376d716345454c68346e693447762b662f2f6b66642f394c4c37335548657454547a336c576950344f53305448412f33352b6638753333376474657145506f63502f72526a2b7a5a5a353931425a7551777055387238313765756968682b7a6e502f2b35433051634b3166537443547766616968336938466c4d6434562f71456b67382b2b4d42393055707a2f766e6e753242777a7a33337550506e4a356151514d4467334532624e7330644238394e4e7847763537574d454a786f565346413848344a46747a6e64372f376e5473333375664a2b2f7a653937356e547a2f3974417466664f5a7676504747613645413734507a52496a692b626474322b592b483335485247535178695449704d53562f623333336d752f2b6331763346553456386c2f396d642f5a74646666373072686a52704434574352717341525a6b754251592b556f53396267562b52744d366859584352444d335259637256362f4a6e4b747972765a4438545075522b47694334444352744477426c5079633536626e784d2b43424938642b6a7a654d2f427365484646312b303535392f2f6f5372596137434b633455333063666664533946733856795644766c386653306b4a4c786258585875734b7258644d6841686155524b4663306b496f3057413045534c682f66654f662f68723832353859364e6b454d773454783731713966373449565159547a5474446876597649695251535a4e4c6979704b51774258357777382f374d5948304c784d457a55744331365269595372566f6f5377594b515164476879642b37457566784647577571426d44774e55755638493064564f512f61365750525235576738595838447268412b6d35477161356e536d446c4967513475316837427a3358585875533450756947346f75614b2f745658583358487844462f2f4f4d66642b4d4e75464b6d7453526149522f712f564b4d47664e41414b4f6f636d775561322f4d51794a44416f4870705a64656374304b424252656e3144444f655038684c3832725344636a334e4431776c644646344c456d4741466959653938494c4c376751536463554c5171685155784546424a6b6b714b666e654a4149574577346b392f2b6c50584845345841385758666e352b4667304667324c446d41472b614f344f6e54704a4b7746466d575a3830472f50326779454232346a4a5069314a494372384130624e72676d654a724f3654494962515767355941437830424c417364727237336d696c6f6f37734e37354e693877583267692b4d58762f69464b3444382f4c4f662f617a7266782f7150512f3166734578306f33425145474f2f35787a7a6e45466d7176305244665655387a70687541384d44364334347355456a6a76424444474b7a412b4a62516c68747635346a474d576541354346494542594b6b69417853534a424a687a2f387439392b75327557706c6941596b357a5050335a584d46374153496172747a70302f3775643739722f2f71762f2b6f657a3957325632786f3071613767535a72436a3046695374556d755335386d6363416c657466694742592b41347552396a41426876774446364b4d4b7676504b4b75354b6e6350455633764c42592b6833762f76757531306f34503351517347415271366136573468474e484351494468796a70616b2f70513735642f4f5a2f76766665656d31724b61397830303032754141386c556973444c52454549517035744d2b44734d49356f4f76677363636563362f4a4945587638773348414d3376662f2f3739703376664d642b2f4f4d66752f454748442f6e6b4c4556644d587733733437377a7758634c6964774250702b55536d4b6f55456d5853344b6d54304f33334f464530505466686559576541335642587668544230475a306d7269353876634b69566430754d4b6c3559436951394d387a6632305750443866674742353650414d2b6951346b377a665768413448463044547a3333484e7573423364475053684d774450772b7451314c316a343871664c674c4342374d536d4b314155575645503857657132573652446a47534b4b3958322f7342555764393853716c59787a494f6a51315248653468434f734f4d334e5a49722b6a7676764e504e386f6830624c5155384a71384e383433725336306b6843472b45784450324e50365076673934467a77797755576b726f446d4b3635684e505047483333332b2f43326d4d64794134306a7268393377695535566d4e38696b51314d2b302f34596438416666496f5942594357426137324b6442634d59506979776835436972393359794b3537353053664134696732466b43746472707035546f6f36546663384831656b584b56796463336751316f524b4f7a382f4a4a4c4c6e4833352b63554a58374f56544e46696f4a4a537750544362322b63676f555637593065784d414f425a6d46314463364535676e4145466d7974653773506a4b4d37386a4e556c6552384d594b5456674f4a4c55616441636a734447446b75576a3343787a5a7754714b3958316f31434370303456436b43566a6378745536507965674d4d4353344244654a514b4f6a2f735142436a307648634b504d394a454f4659615647686c594e515175466e4441486a4e41683648442f48534a4169625041353866724d324f4463634634594b304541354e78776678415343455a384472772f576778344437776d4959797777657479544479472b394b617766754c4a55534b5441554b43544970555544356f6b41787749392f4b554a4d47325455506b337746486875353671666f6b4f42704f415145726776785968435164476b7744506c6a716d4a46432b4b466c667a33757744696852466e514442397852786969456867507678584c7765415961574235364c35366162776d74466f4b4254714c326638336961317a6b2b696947466b384a487765632b3345365235746834447270534341466364524d4565417a466e7364776643794e54466a7872724139684a5a6f37356377773346524f4c336a59746f6b685a5a5a45487a502b34673065344a415148486d385a783357694e344437774778384a6a57642b42312b4237776766504858724f4346714d3865434c7a34707a77587668653136587a34317a345832652f497a5834545841362f4934377350502b4e7834446a3466623677476e783868687944432b2f4c436d386855706855585a564c6a36707a437742557752594669343433576e79686f687565716d2b495632764977464e343766666355524b2f375130526b4f42515352455245784a63474c6f7149694967766851515245524878705a4167496949697668515352455245784a6443676f694969506853534241524552466643676b6949694c69537946425245524566436b6b6949694969432b46424245524566476c6b43416949694b2b46424a45524554456c304b43694969492b464a49454245524556384b4353496949754a4c49554645524552384b535349694969494c34554545524552386157514943496949723455456b5245524d5358516f4b4969496a34556b67514552455258776f4a49694969346b736851555245524877704a496949694967766851515245524878705a4167496949697668515352455245784a6443676f694969506853534241524552466643676b6949694c69537946425245524566436b6b6949694969432b46424245524566476c6b43416949694b2b46424a45524554456c304b43694969492b464a49454245524556384b4353496949754a4c49554645524552384b535349694969494c34554545524552386157514943496949723455456b5245524d5358516f4b4969496a34556b67514552455258776f4a49694969346b736851555245524877704a496949694967766851515245524878705a4167496949697668515352455245784a6443676f694969506853534241524552466643676b6949694c69537946425245524566436b6b6949694969432b46424245524566476c6b43416949694b2b46424a45524554456c304b43694969492b464a49454245524556384b4353496949754a4c49554645524552384b535349694969494c34554545524552386157514943496949723455456b5245524d53483266384835716531416d315278615941414141415355564f524b35435949493d, 'icon.png', '19574', 'image/png', NULL, '2022-09-24 08:13:37');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_factura`
--

CREATE TABLE `lineas_factura` (
  `id` int(11) UNSIGNED NOT NULL,
  `factura_id` int(11) UNSIGNED DEFAULT NULL,
  `factura_uuid` varchar(255) NOT NULL,
  `no_linea` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `descripcion` tinytext DEFAULT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `omiso`
--

CREATE TABLE `omiso` (
  `id` int(11) UNSIGNED NOT NULL,
  `empresa_id` int(11) UNSIGNED NOT NULL,
  `cliente_id` int(11) UNSIGNED NOT NULL,
  `factura_id` int(11) UNSIGNED NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `omiso` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) UNSIGNED NOT NULL,
  `es_admin` tinyint(1) DEFAULT 0,
  `es_staff` tinyint(1) DEFAULT 0,
  `es_cliente` tinyint(1) DEFAULT 0,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) UNSIGNED NOT NULL,
  `role` varchar(60) NOT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `role`, `actualizado`, `creado`) VALUES
(1, 'SysAdmin', '2022-09-23 16:25:19', '2022-09-23 08:22:33'),
(2, 'Staff', NULL, '2022-09-23 08:22:33'),
(3, 'cliente', NULL, '2022-09-23 08:22:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `staff`
--

CREATE TABLE `staff` (
  `id` int(11) UNSIGNED NOT NULL,
  `usuario_id` int(11) UNSIGNED DEFAULT NULL,
  `empresa_id` int(11) UNSIGNED DEFAULT NULL,
  `codigo` varchar(15) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `staff`
--

INSERT INTO `staff` (`id`, `usuario_id`, `empresa_id`, `codigo`, `nombre`, `direccion`, `telefono`, `actualizado`, `creado`) VALUES
(1, 1, 1, '1234', 'Admin del Sistema', 'ciudad', '5555-5555', '2022-09-24 07:27:01', '2022-09-23 08:22:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) UNSIGNED NOT NULL,
  `correo` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role_id` int(11) UNSIGNED DEFAULT NULL,
  `permiso_id` int(11) UNSIGNED DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `correo`, `password`, `role_id`, `permiso_id`, `actualizado`, `creado`) VALUES
(1, 'admin', '$2y$10$CRWJV05LPXYLnvvPXkG6HeKfxjXxeUmHwiEO2DOn5ChZ9vpTBsUbe', 1, NULL, NULL, '2022-09-23 08:22:33');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foreign_key_imagen_id` (`logo_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_factura` (`no_factura`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas_factura`
--
ALTER TABLE `lineas_factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foreign_key_factura_id` (`factura_id`);

--
-- Indices de la tabla `omiso`
--
ALTER TABLE `omiso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_omiso_empresa_id` (`empresa_id`),
  ADD KEY `fk_omiso_cliente_id` (`cliente_id`),
  ADD KEY `fk_omiso_factura_id` (`factura_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foreign_key_empresa_id` (`empresa_id`),
  ADD KEY `fk_foreign_key_usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foreign_key_rol_id` (`role_id`),
  ADD KEY `fk_foreign_key_permiso_id` (`permiso_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lineas_factura`
--
ALTER TABLE `lineas_factura`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `omiso`
--
ALTER TABLE `omiso`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_foreign_key_imagen_id` FOREIGN KEY (`logo_id`) REFERENCES `imagen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineas_factura`
--
ALTER TABLE `lineas_factura`
  ADD CONSTRAINT `fk_foreign_key_factura_id` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `omiso`
--
ALTER TABLE `omiso`
  ADD CONSTRAINT `fk_omiso_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_omiso_empresa_id` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_omiso_factura_id` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk_foreign_key_empresa_id` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_foreign_key_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_foreign_key_permiso_id` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_foreign_key_rol_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
