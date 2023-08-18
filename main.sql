-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307:3307
-- Generation Time: Aug 18, 2023 at 03:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `first`
--
CREATE DATABASE IF NOT EXISTS `first` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `first`;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Dumping data for table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"relation_lines\":\"true\",\"snap_to_grid\":\"off\",\"angular_direct\":\"direct\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"project\",\"table\":\"agents\"},{\"db\":\"project\",\"table\":\"users\"},{\"db\":\"project\",\"table\":\"cart_table\"},{\"db\":\"project\",\"table\":\"roses\"},{\"db\":\"project\",\"table\":\"mixed_roses\"},{\"db\":\"project\",\"table\":\"customer_table\"},{\"db\":\"project\",\"table\":\"seasonal\"},{\"db\":\"products\",\"table\":\"seasonal\"},{\"db\":\"project\",\"table\":\"products\"},{\"db\":\"products\",\"table\":\"products\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'project', 'admin_table', '{\"CREATE_TIME\":\"2023-05-23 14:31:16\"}', '2023-06-27 11:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2023-08-18 13:11:04', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `products`
--
CREATE DATABASE IF NOT EXISTS `products` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `products`;
--
-- Database: `project`
--
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `ADMIN_ID` varchar(255) NOT NULL,
  `ADMIN_NAME` varchar(255) NOT NULL,
  `ROLE_ID` varchar(255) NOT NULL,
  `USER_NAME` varchar(255) NOT NULL,
  `PASS_WORD` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `jobTitle` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phone` int(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `twitterProfile` varchar(255) NOT NULL,
  `instagramProfile` varchar(255) NOT NULL,
  `facebookProfile` varchar(255) NOT NULL,
  `linkedinProfile` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `profilePictureData` longblob NOT NULL,
  `changesMade` tinyint(1) DEFAULT 0,
  `newProducts` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ADMIN_TABLE';

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`ADMIN_ID`, `ADMIN_NAME`, `ROLE_ID`, `USER_NAME`, `PASS_WORD`, `company`, `jobTitle`, `country`, `Address`, `Phone`, `email`, `twitterProfile`, `instagramProfile`, `facebookProfile`, `linkedinProfile`, `about`, `profilePictureData`, `changesMade`, `newProducts`) VALUES
('6492f2bdf2e9f', 'susan mwende', 'R001', 'SUU', '$2y$10$CETlFJpmARuAsPuRnEHfHuAC./qJdWvhHKFFZLhI.4MHhUuhm7wQG', 'COSEKE', 'WEB DESIGNER', 'Kenya', 'Kikuyu', 98324093, 'susanmwende924@gmail.com', 'suzie', 'suzie', 'suzie', 'suzie', 'HAE', 0x70726f66696c652d70696374757265732f6170706c652e6a7067, 1, 0),
('6492f37e7443c', 'susan mwende', 'R001', 'SUU', '$2y$10$CETlFJpmARuAsPuRnEHfHuAC./qJdWvhHKFFZLhI.4MHhUuhm7wQG', 'COSEKE', 'WEB DESIGNER', 'Kenya', 'Kikuyu', 98324093, 'susanmwende924@gmail.com', 'suzie', 'suzie', 'suzie', 'suzie', 'HAE', 0x70726f66696c652d70696374757265732f6170706c652e6a7067, 1, 0),
('64966a37bb633', '', 'R001', 'cyp', '$2y$10$eEk7sWKfIE//tkGGI.pqmOAhTiFYV8MHA/IBO4fZKnT8CPTQ3m8QW', 'COSEKE', '', 'Kenya', '', 0, 'susanmwende924@gmail.com', '', '', '', '', 'HAE', 0x70726f66696c652d70696374757265732f494d475f32303231303232305f3136313930315f3931372e6a7067, 1, 1),
('649acc2c6fdaa', 'susan', 'R002', '', '$2y$10$UUOQ6VQ3ICeTtMSW7ClWl.LrsE6j.wySpqrpKV6vm8GTt0D9MpqQW', 'COSEKE', 'WEB DESIGNER', 'Kenya', 'Kikuyu', 785946784, 'suziemweshn@gmail.com', 'suzie', 'suzie', 'suzie', 'suzie', 'note', 0x70726f66696c652d70696374757265732f646f776e6c6f61642e706e67, 1, 1),
('649acf749ede8', 'susan', 'R003', '', '$2y$10$UUOQ6VQ3ICeTtMSW7ClWl.LrsE6j.wySpqrpKV6vm8GTt0D9MpqQW', 'COSEKE', 'WEB DESIGNER', 'Kenya', 'Kikuyu', 785946784, 'suziemweshn@gmail.com', 'suzie', 'suzie', 'suzie', 'suzie', 'note', 0x70726f66696c652d70696374757265732f646f776e6c6f61642e706e67, 1, 1),
('64be1edd6e868', 'Susan Mwende', 'R002', 'suzie', '$2y$10$naG4GWCCxfGJxQKPbwAF6uHZBuZQET5X.MEb/QQUAbdF7fttsdYJS', 'COSEKE', 'WEB DESIGNER', 'Kenya', 'Nairobi', 711926171, 'susanmwende924@gmail.com', 'suzie', 'suzie', 'suzie', 'suzie', 'good girl', 0x70726f66696c652d70696374757265732f6170706c652e6a7067, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone_number` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Country` set('Kenya','Uganda','Tanzania','Ethiopia','Somalia','Rwanda','Sudan','South sudan') NOT NULL,
  `Region` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carnations`
--

CREATE TABLE `carnations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_table`
--

CREATE TABLE `cart_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` int(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_table`
--

INSERT INTO `customer_table` (`id`, `name`, `email`, `phone_no`, `password`, `username`, `country`, `city`, `location`) VALUES
(64, 'Daisy', 'Daisy@gmail.com', 711926171, '$2y$10$.hL/RJIcSCRKOWE2mKNXNum9RUOMfWCIjil8Xvx8fmsKfZ0Ta9wmi', 'Daisy', 'Kenya', 'Nairobi', 'ANYWHERE'),
(65, 'Susan Mwende', 'susanmwende924@gmail.com', 711926171, '$2y$10$.fY1exDa4T5QOtV0UbbitufqFJ6HzkHdfBQ9llMpCEfrxJbOgAWyK', 'suzie', 'Kenya', 'Nairobi', 'Kikuyu');

-- --------------------------------------------------------

--
-- Table structure for table `lily`
--

CREATE TABLE `lily` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mixed_roses`
--

CREATE TABLE `mixed_roses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mixed_roses`
--

INSERT INTO `mixed_roses` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Andrea Mixed Roses', 'Andrea Mixed Beautiful Flower Roses Bouquet', 34, 0x616e647265612d6d697865642d726f7365732d62656175746966756c2d666c6f7765722d626f75717565742d322e6a706567),
(3, 'Fresh Red and White Roses', 'Mixed Frresh Red and White Roses Bouquet', 36, 0x66726573682d7265642d616e642d77686974652d726f7365732d626f75717565742e6a7067),
(4, 'Lesing Artificial Fake Flower', 'Lesing Artificial Fake Flower with vase silk Artificial Roses Wedding', 60, 0x6c657373696e672061727466696369616c20666c6f776572732e6a7067),
(5, 'Mixed Carnation', 'Exclusive mixed Carnation Bouquet', 23, 0x6d69786564206361726e6174696f6e20626f75717565742e6a7067),
(6, 'Dollar Roses', 'Dollar on Roses Bouquet', 60, 0x646f6c6c617273206f6e20726f7365732e6a7067),
(7, 'Beautifully Mixed Roses', 'Beautifully Mixed Roses', 36, 0x62656175746966756c6c792d6d697865642d726f7365732d363030783533392e6a7067),
(8, 'Mixed 100 Roses', 'Enternal 100 Roses Bouquet , Mixed 100 Roses', 75, 0x6d697865642031303020726f7365732e504e47),
(9, 'Flower Box', 'Romantically Rosa Flower Box ', 57, 0x526f736120666c6f77657220626f782e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`) VALUES
(14, 'apple', '80.00', 'green apple', 0x6170706c652e6a7067),
(15, 'banana', '70.00', 'yelow banana', 0x50554541204c4f474f2e6a7067),
(16, 'fish', '90.00', 'hot fish', 0x536e6170636861742d373534383835393535202832292e6a7067),
(17, 'banana', '60.00', 'yellow banana', 0x4f6c6c696e20736163636f2e6a706567),
(18, 'banana', '70.00', 'yellow banana', 0x436170747572652e504e47),
(19, 'banana', '80.00', 'banana', 0x7375752e6a7067),
(20, 'fish ', '80.00', 'hot fish', 0x736e6170636861742e6a7067),
(21, 'fish', '80.00', 'hot fish', 0x7461626c652e6a7067),
(22, 'fish', '80.00', 'hot fish', 0x536e6170636861742d3639303636323330352e6a7067),
(23, 'white noisete rosse', '50.00', 'white', 0x7768697465206e6f69736574746520726f7365732e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `roses`
--

CREATE TABLE `roses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roses`
--

INSERT INTO `roses` (`id`, `name`, `price`, `description`, `image`) VALUES
(58, 'Pink Roses', 20, 'A bouquet of pink roses : Indulge in the delicate beauty of a bouquet of pink roses, a charming ensemble that radiates grace and tenderness.  Height: 2mtrs', 0x70696e6b20726f7365732e6a706567),
(61, 'Red Roses', 20, 'A bouquet of Red Roses :  we present the epitome of passion and romance through our exquisite collection of red roses.  Height: 2 metres', 0x72656420726f7365732e6a7067),
(62, 'Rambler Roses', 19, 'A bouquet of Rambler Roses : With their vigorous growth and abundant clusters of blossoms, rambler roses are a sight to behold. Height : 2 metres', 0x72616d626c657220726f7365732e6a706567),
(63, 'Bridal Green Tea Rose', 25, 'A bouquet of Bridal Green Tea Rose : With its classic and timeless appeal, the Bridal Green Tea Rose effortlessly evokes a sense of refined elegance. Height : 2 metres', 0x62726964616c20677265656e2074656120726f73652e6a706567),
(64, 'White Noisette Roses', 21, 'White Noisette Roses : Introducing the White Noisette Rose, a captivating and elegant variety that exudes timeless beauty and grace. Height : 2 metres', 0x7768697465206e6f69736574746520726f7365732e6a7067),
(65, 'Fairly Roses', 23, 'A bouquet of Fairly Roses : Fairy Roses are celebrated for their ability to produce an abundance of flowers throughout the blooming season.  Height : 2 metres', 0x666169726c7920726f7365732e6a7067),
(66, 'Bourbon Roses', 24, 'A bouquet of Bourbon Roses  : Bourbon Roses are known for their graceful and opulent blooms. The flowers exhibit a variety of colors, ranging from soft pastels to rich, vibrant hues.  Height : 2 metres', 0x626f7572626f6e20726f73652e6a706567),
(67, 'Hybrid Tea Roses', 25, 'A bouquet of hybrid Tea Roses : Immerse yourself in the refined beauty of a bouquet of Hybrid Tea Roses, a captivating ensemble that combines elegance and sophistication.  Height : 2 metres', 0x6879627269642074656120726f7365732e6a706567);

-- --------------------------------------------------------

--
-- Table structure for table `seasonal`
--

CREATE TABLE `seasonal` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` enum('Admin','User','Guest','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`) VALUES
(0, 'suzie', 'Guest'),
(0, 'Daisy', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carnations`
--
ALTER TABLE `carnations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_table`
--
ALTER TABLE `cart_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lily`
--
ALTER TABLE `lily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mixed_roses`
--
ALTER TABLE `mixed_roses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roses`
--
ALTER TABLE `roses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seasonal`
--
ALTER TABLE `seasonal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carnations`
--
ALTER TABLE `carnations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_table`
--
ALTER TABLE `cart_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `lily`
--
ALTER TABLE `lily`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mixed_roses`
--
ALTER TABLE `mixed_roses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roses`
--
ALTER TABLE `roses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `seasonal`
--
ALTER TABLE `seasonal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Database: `your_database`
--
CREATE DATABASE IF NOT EXISTS `your_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `your_database`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(1, '', ''),
(2, '', ''),
(3, '', ''),
(4, '', ''),
(5, 'SUSAN', 'suziemweshn@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
