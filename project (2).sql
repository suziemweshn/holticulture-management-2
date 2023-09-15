-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307:3307
-- Generation Time: Sep 15, 2023 at 08:10 AM
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
-- Database: `project`
--

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
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `Agent_name` varchar(255) NOT NULL,
  `Agent_Number` varchar(255) NOT NULL,
  `Contact_Number` text NOT NULL,
  `Emergency_Contact` text NOT NULL,
  `Gender` set('Male','Female','Other','') NOT NULL,
  `Email_Address` varchar(255) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Address_name` varchar(255) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`id`, `Agent_name`, `Agent_Number`, `Contact_Number`, `Emergency_Contact`, `Gender`, `Email_Address`, `Date_of_Birth`, `Address_name`, `Country`, `City`, `Location`) VALUES
(27, 'Daisy Makena', 'A002', '56462746', '654398463', 'Female', 'Daisy@gmail.com', '2023-05-09', '452', '6', '40', '12'),
(37, 'Susan Mwende', 'A001', 'susanmwende924@gmail.com', '0711926171', 'Female', 'susanmwende924@gmail.com', '2023-08-29', 'Nairobi', '6', '40', '11');

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

--
-- Dumping data for table `carnations`
--

INSERT INTO `carnations` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'carnation', 'red carnation', 40, 0x726564206361726e6174696f6e2e6a706567);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `price`, `description`, `username`, `quantity`, `image`) VALUES
(6, 'Rambler Roses', 0.00, '19', 'suzie', 1, 'rambler roses.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `delivery_mode` varchar(255) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `agent_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `name`, `phone_no`, `email`, `address`, `country`, `city`, `Location`, `delivery_mode`, `agent_id`, `username`, `agent_name`) VALUES
(1, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '564', '', '', '', 'pickup', NULL, 'suzie', 'Daisy Makena'),
(2, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '564', '', '', '', 'door', NULL, 'suzie', 'select Agent'),
(3, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '453', '', '', '', 'pickup', NULL, 'suzie', 'Susan Mwende'),
(4, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '543', 'Kenya', '', 'Kikuyu', 'pickup', NULL, 'suzie', 'Susan Mwende'),
(5, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '543', 'Kenya', '', 'Kikuyu', 'pickup', NULL, 'suzie', 'Susan Mwende'),
(6, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '543', 'Kenya', 'Nairobi', '', 'door', NULL, 'suzie', 'select Agent'),
(7, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '543', 'Kenya', 'Nairobi', '', 'pickup', NULL, 'suzie', 'Daisy Makena'),
(8, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '231', 'Kenya', 'Nairobi', '', 'pickup', NULL, 'suzie', 'Susan Mwende'),
(9, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '234', 'Kenya', 'Nairobi', '', 'door', NULL, 'suzie', 'select Agent'),
(10, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '234', 'Kenya', 'Nairobi', '', 'pickup', NULL, 'suzie', 'Susan Mwende'),
(11, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '234', 'Kenya', 'Nairobi', '', 'pickup', NULL, 'suzie', 'A002'),
(12, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '456', 'Kenya', 'Nairobi', '', 'pickup', NULL, 'suzie', 'A001'),
(13, 'Susan Mwende', '711926171', 'susanmwende924@gmail.com', '678', 'Kenya', 'Nairobi', '', 'pickup', NULL, 'suzie', 'A002');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `country_id`) VALUES
(40, 'nairobi', 6),
(43, 'Jinja', 9),
(44, 'Khartoum', 10),
(45, 'Dodoma', 8),
(46, 'Mogadishu', 13),
(47, 'Asmara', 12);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(6, 'Kenya'),
(8, 'Tanzania'),
(9, 'Uganda'),
(10, 'Sudan'),
(11, 'South Sudan'),
(12, 'Eritrea'),
(13, 'Somalia'),
(14, 'Djibouti');

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
(66, 'Susan Mwende', 'susanmwende924@gmail.com', 711926171, '$2y$10$Z64vEVIBjOkjgiMpdGfBouVc552X/vToB1XVWdrAg0cNjxwttSiVa', 'suzie', 'Kenya', 'Nairobi', 'Kikuyu');

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

--
-- Dumping data for table `lily`
--

INSERT INTO `lily` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'lily', 'white lilies', 50, 0x63616c616c696c792e6a706567);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `city_id`) VALUES
(11, 'kikuyu', 40),
(12, 'kikuyu', 40);

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
(4, 'Lesing Artificial Fake Flower', 'Lesing Artificial Fake Flower with vase silk Artificial Roses Wedding', 60, 0x6c657373696e672061727466696369616c20666c6f776572732e6a7067),
(5, 'Mixed Carnation', 'Exclusive mixed Carnation Bouquet', 23, 0x6d69786564206361726e6174696f6e20626f75717565742e6a7067),
(6, 'Dollar Roses', 'Dollar on Roses Bouquet', 60, 0x646f6c6c617273206f6e20726f7365732e6a7067),
(8, 'Mixed 100 Roses', 'Enternal 100 Roses Bouquet , Mixed 100 Roses', 75, 0x6d697865642031303020726f7365732e504e47),
(9, 'Flower Box', 'Romantically Rosa Flower Box ', 57, 0x526f736120666c6f77657220626f782e6a7067),
(12, 'sfds', 'dsf', 50, 0x61766f6361646f2e706e67),
(14, 'red carnations', 'red carnations', 40, 0x726564206361726e6174696f6e2e6a706567),
(15, 'red carnations', 'red carnations', 40, 0x726564206361726e6174696f6e2e6a706567),
(16, 'gdsksjaf', 'fyuhejaskn', 40, 0x736561736f6e616c20626f6f75717565742e6a706567);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `checkout_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cart_id`, `checkout_id`, `payment_id`, `username`) VALUES
(1, 6, 1, 1, ''),
(2, 6, 1, 2, ''),
(3, 6, 1, 3, ''),
(4, 6, 2, 1, ''),
(5, 6, 2, 2, ''),
(6, 6, 2, 3, ''),
(7, 6, 3, 1, ''),
(8, 6, 3, 2, ''),
(9, 6, 3, 3, ''),
(10, 6, 4, 1, ''),
(11, 6, 4, 2, ''),
(12, 6, 4, 3, ''),
(13, 6, 5, 1, ''),
(14, 6, 5, 2, ''),
(15, 6, 5, 3, ''),
(16, 6, 6, 1, ''),
(17, 6, 6, 2, ''),
(18, 6, 6, 3, ''),
(19, 6, 7, 1, ''),
(20, 6, 7, 2, ''),
(21, 6, 7, 3, ''),
(22, 6, 8, 1, ''),
(23, 6, 8, 2, ''),
(24, 6, 8, 3, ''),
(25, 6, 9, 1, ''),
(26, 6, 9, 2, ''),
(27, 6, 9, 3, ''),
(28, 6, 10, 1, ''),
(29, 6, 10, 2, ''),
(30, 6, 10, 3, ''),
(31, 6, 11, 1, ''),
(32, 6, 11, 2, ''),
(33, 6, 11, 3, ''),
(34, 6, 12, 1, ''),
(35, 6, 12, 2, ''),
(36, 6, 12, 3, ''),
(37, 6, 13, 1, ''),
(38, 6, 13, 2, ''),
(39, 6, 13, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `Delivery_mode` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `payment_option` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `payment_option`, `username`) VALUES
(1, 'pay_before_delivery', 'suzie'),
(2, 'pay_before_delivery', 'suzie'),
(3, 'pay_before_delivery', 'suzie');

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

--
-- Dumping data for table `seasonal`
--

INSERT INTO `seasonal` (`id`, `name`, `description`, `price`, `image`) VALUES
(2, 'edffdgdfgfdg', 'gdfgh', '20', 0x477265656e73706f6f6e2d5468652d466c6f7765722d466163746f72792d526f7365732e6a7067),
(4, 'fghuijkl', 'drfygjh', '20', 0x737072696e672e6a706567),
(5, 'dtrytkujgh', 'srtyujkyg', '40', 0x66726573682d7265642d616e642d77686974652d726f7365732d626f75717565742e6a7067);

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
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carnations`
--
ALTER TABLE `carnations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_username` (`username`);

--
-- Indexes for table `lily`
--
ALTER TABLE `lily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `mixed_roses`
--
ALTER TABLE `mixed_roses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `checkout_id` (`checkout_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
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
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `carnations`
--
ALTER TABLE `carnations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `lily`
--
ALTER TABLE `lily`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mixed_roses`
--
ALTER TABLE `mixed_roses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer_table` (`username`);

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`checkout_id`) REFERENCES `checkout` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;