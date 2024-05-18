-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 05:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `fos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_customer`
--

CREATE TABLE `food_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_customer`
--

INSERT INTO `food_customer` (`id`, `name`, `email`, `password`, `phone`, `address`) VALUES
(1, 'Mark Cooper', 'mcooper@mail.com', '202cb962ac59075b964b07152d234b70', '1234567890', 'A - 1111 Street road, Newyork USA.'),
(2, 'Samantha Miller', 'sam23@mail.com', '45bff2a14658fc9b21c6e5e9bf75186b', '0913245879', 'My Sample Address'),
(3, 'Clairy Blake', 'cblake@mail.com', '4744ddea876b11dcb1d169fadf494418', '09654789123', 'Sample Address 101');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `images` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ENABLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `name`, `price`, `description`, `images`, `status`) VALUES
(1, 'Burger', 75, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim at dolor in posuere. Sed eleifend ipsum in sem placerat, sed semper felis tincidunt.', './images/burger.jfif', 'ENABLE'),
(2, 'Fries', 50, 'Maecenas eleifend sit amet magna et consequat. Nunc a erat non arcu efficitur semper ut et mauris. Aenean sed faucibus purus. Duis hendrerit diam at leo imperdiet, vel placerat dolor porta.', './images/fries.jfif', 'ENABLE'),
(3, 'Nachos', 105, 'Nam sagittis fringilla leo, eget eleifend orci vestibulum sed. Proin a sem eu tortor hendrerit sollicitudin. Vivamus tempus ullamcorper nibh vitae viverra.', './images/nachos.jpg', 'ENABLE'),
(4, 'Pizza', 145, 'Sed sit amet neque fringilla, eleifend libero gravida, tempus nisl.', './images/pizza.jfif', 'ENABLE'),
(5, 'Fried Chicken', 115, 'Cras vitae commodo sem. Nam viverra augue lacus, ut tempus nulla congue accumsan. Ut mattis ipsum ligula, non dignissim ex scelerisque eu.', './images/fried-chicken.png', 'ENABLE'),
(6, 'Grilled Chciken', 135, 'Nulla tincidunt varius accumsan. Vivamus ac nunc nibh. Ut maximus nisi sed consectetur dictum.', './images/grilled-chicken.jpg', 'ENABLE'),
(7, 'Roasted Pork Belly', 475, 'Curabitur bibendum leo sit amet lacinia laoreet. Quisque dapibus rutrum nunc, ac scelerisque elit porta in. Phasellus scelerisque sem in gravida placerat.', './images/roasted-pork-billy.jpg', 'ENABLE');

-- --------------------------------------------------------

--
-- Table structure for table `food_orders`
--

CREATE TABLE `food_orders` (
  `id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `order_date` date NOT NULL,
  `order_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_orders`
--

INSERT INTO `food_orders` (`id`, `item_id`, `name`, `price`, `quantity`, `order_date`, `order_id`) VALUES
(1, 3, 'Nachos', 105, 1, '2022-06-20', '944886993025460519'),
(2, 2, 'Fries', 50, 1, '2022-06-20', '944886993025460519');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_customer`
--
ALTER TABLE `food_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_orders`
--
ALTER TABLE `food_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_customer`
--
ALTER TABLE `food_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `food_orders`
--
ALTER TABLE `food_orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_orders`
--
ALTER TABLE `food_orders`
  ADD CONSTRAINT `item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `food_items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;
