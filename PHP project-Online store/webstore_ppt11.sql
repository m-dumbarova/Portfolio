-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 08:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webstore_ppt11`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(255) NOT NULL,
  `client_since` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `first_name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `street` text NOT NULL,
  `house_number` varchar(10) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_since`, `first_name`, `surname`, `email`, `phone`, `street`, `house_number`, `post_code`, `city`, `country`) VALUES
(1, '2023-02-27 08:05:48', 'Martina', 'Dumbarova', 'martina@gmail.com', '0888275600', 'Lulin planina', '28', '1336', 'Sofia', 'Bulgaria'),
(2, '2023-02-27 08:06:01', 'Simeon', 'Dumbarov', 'moni@gmail.com', '-', 'Rila planina', '157', '1000', 'Plovdiv', 'Bulgaria'),
(3, '2023-02-27 08:06:11', 'Veselin', 'Dumbarov', 'veso_cool@gmail.com', '+31611945612', 'Luxemburglaan', '94', '5625RT', 'Eindhoven', 'The Netherlands'),
(4, '2023-02-27 08:06:25', 'Tina', 'Stoimenoff', 'rin-tin-tin@yahoo.de', '+49/25 46 854 896', 'Muenchenstrasse', '11', '16874', 'Hamburg', 'Germany'),
(5, '2023-02-27 08:06:37', 'Boris', 'Dumbarov', 'bobi@yahoo.com', '06 87 45 19 62', 'Pirin planina', '7', '8415KB', 'Varna', 'Bulgaria'),
(6, '2023-02-27 08:06:50', 'Joost', 'van Berg', 'joost@abv.bg', '06 123 456 78', 'Parijslaan', '14', '2497TY', 'Tilburg', 'The Netherlands'),
(7, '2023-02-27 14:55:52', 'Polly', 'Papagei', 'polly@abv.bg', '01635435043', 'Rio', '49', '4978TP', 'Den Haag', 'The Netherlands'),
(9, '2023-02-27 15:01:26', 'Rex', 'Policedog', 'rex_911@yahoo.com', '-', 'New York boulevard', '197', '124872', 'New York', 'USA'),
(18, '2023-02-27 16:07:56', 'Mariana', 'Gomez', 'm_gomez@gmai.com', '06187845433', 'Poetlaan', '37', '5637PT', 'Eindhoven', 'The Netherlands');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_num` bigint(100) NOT NULL,
  `clientID` int(255) NOT NULL,
  `date` date NOT NULL,
  `product` text NOT NULL,
  `quantity` int(255) NOT NULL,
  `status` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_num`, `clientID`, `date`, `product`, `quantity`, `status`) VALUES
(1, 20230301215318, 2, '2023-03-01', '3', 6, 1),
(2, 20230301215318, 2, '2023-03-01', '1', 5, 1),
(3, 20230301215318, 2, '2023-03-01', '2', 10, 1),
(4, 20230302085802, 1, '2023-03-02', '2', 1, 1),
(5, 20230302085802, 1, '2023-03-02', '3', 1, 1),
(6, 20230302121551, 2, '2023-03-02', '1', 3, 1),
(7, 20230302123209, 2, '2023-03-02', '1', 3, 1),
(8, 20230302123733, 3, '2023-03-02', '1', 1, 1),
(9, 20230302123733, 3, '2023-03-02', '3', 1, 1),
(10, 20230302210613, 3, '2023-03-02', '1', 2, 1),
(11, 20230302210613, 3, '2023-03-02', '2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(255) NOT NULL,
  `url` text NOT NULL,
  `header` text NOT NULL,
  `content` text NOT NULL,
  `footer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `url`, `price`, `stock`) VALUES
(1, 'Tapas board - \"Waiting for Santa\"', 'https://martinadumbarova.info/educom_pics/Tapas%20board.jpg', '30.00', 5),
(2, 'Jewellery box - \"Roses\"', 'https://martinadumbarova.info/educom_pics/Jewellery%20box.jpg', '35.00', 10),
(3, 'Bookmark - \"Magnolia\"', 'https://martinadumbarova.info/educom_pics/Bookmark.jpg', '15.00', 38),
(4, 'Macrame pacifier cord with name', 'https://martinadumbarova.info/educom_pics/pacifyer-cord.jpg', '10.00', 9),
(5, 'Mommy and baby elephant - Set ', 'https://vanhout.art/wp-content/uploads/2021/09/kraamcadeau-sets-scaled.jpg', '28.00', 4),
(6, 'Keychain - flowers and dragonfly', 'https://vanhout.art/wp-content/uploads/Sleutelhanger-met-bloemen-en-libelle-20211601024800_5.jpg', '12.00', 14),
(7, 'Girls necklace - Libelle', 'https://vanhout.art/wp-content/uploads/2021/09/kindersieraden-scaled.jpg', '13.00', 5),
(8, 'Welcome Santa tray', 'https://vanhout.art/wp-content/uploads/Welcome-Santa-20211012225349-1.-scaled.jpg', '20.00', 3),
(9, 'X-mas is LOVE – Serving board', 'https://vanhout.art/wp-content/uploads/Snijplank-Xmas-is-love-20211411145615-2-web-scaled.jpg', '32.00', 1),
(10, 'Chewable necklace - Sun', 'https://martinadumbarova.info/educom_pics/Chewable-necklace-sun.jpg', '23.00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `client_ID` int(30) NOT NULL,
  `date` datetime NOT NULL,
  `cart_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `client_ID`, `date`, `cart_content`) VALUES
(1, 2, '2023-03-03 11:28:15', 'a:2:{i:7;i:1;i:4;i:2;}'),
(5, 4, '2023-03-02 10:52:59', 'a:2:{i:1;i:3;i:2;i:5;}'),
(7, 3, '2023-03-06 11:27:01', 'a:4:{i:2;i:2;i:7;i:1;i:6;i:1;i:10;i:4;}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `clientID` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `clientID`, `username`, `password`) VALUES
(1, 1, 'martina86', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 2, 'moni', '735735aa594d4a2eda923d866879d5f2'),
(3, 3, 'veso', 'a0b7689da10956dd34b961e688bf2029'),
(4, 4, 'tina92', 'ef2afe0ea76c76b6b4b1ee92864c4d5c'),
(5, 5, 'bobi', '51e4a5611b485ee7d5dcd421c092563b'),
(6, 6, 'joost', 'c37bf859faf392800d739a41fe5af151'),
(20, 7, 'polly', '8ca4245f09e5a6ecf058c15cca9ac9b6'),
(22, 9, 'rex', '6b4023d367b91c97f19597c4069337d3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientID` (`clientID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_ID` (`client_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `clientID` (`clientID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`clientID`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`client_ID`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`clientID`) REFERENCES `clients` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
