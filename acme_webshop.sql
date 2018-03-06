-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2018 at 07:57 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `acme_webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_log`
--

CREATE TABLE `order_log` (
  `order_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `customer_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `customer_mail` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_log`
--

INSERT INTO `order_log` (`order_id`, `product_id`, `customer_name`, `customer_mail`, `customer_phone`, `customer_address`) VALUES
(1, 1, 'Mon Iln', 'asdf@fdsa.com', '0760987654', 'Qwerty 1, 56789 Buc'),
(2, 2, 'Mahmud Al Hakim', 'ceva@ceva.com', '1234567890', 'qwerty 1, 56789 Buc'),
(3, 9, 'Mon Iln', 'asdf@fdsa.com', '0760987654', 'Qwerty 1, 56789 Buc'),
(4, 7, 'Mon Iln', 'asdf@fdsa.com', '0987654321', 'qwerty 1, 56789 Buc'),
(5, 2, 'Mon Iln', 'asdf@fdsa.com', '0760987654', 'Qwerty 1, 56789 Buc'),
(6, 1, 'Miruna', 'ceva@ceva.com', '111133330', 'Altceva'),
(7, 9, 'Jonas E', 'jonas@jonas.com', '1234567899', 'Tomtebobavägen 3A'),
(8, 8, 'Vicky E', 'vicky@jonas.com', '09876543a', 'Tomtebobavägen 3B'),
(9, 7, 'Cornelia', 'cornelia@cornelia.se', '087654321', 'Tomtebobavägen 3C'),
(12, 9, 'Zxcv Bnm', 'lkjhg@lkjhg.com', '089765432234', 'Tomtebobavägen 3D'),
(13, 9, 'Cristina Tudor', 'cristina@cristina.se', '08080808080', 'Tomtebodavägen 3');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(5) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `image`, `price`) VALUES
(1, 'Headphones', 'Probably the most affordable headphones. Amazing design combined with the best sound, this makes them the best headphones on the market. Only on Acme!', 'product001.jpg', 1000),
(2, 'Laptop', 'This laptop is one of the best there is, we offer you a one-of-a-kind deal, exclusively on Acme.', 'product002.jpg', 15000),
(5, 'Earpods', 'Join the earpod team if you haven\'t already. You will not regret it!', 'product003.jpg', 500),
(7, 'Smartwatch', 'With a smartwatch you will be able to take your calls, read and answer your texts, have an eye on your time and all your social media, all of this without even taking your phone out of your pocket! What are you waiting for?', 'product004.jpg', 1500),
(8, 'Portable Speaker', 'With this portable speaker you carry perfect sound with you, everywhere you go!', 'product005.jpg', 1000),
(9, 'Wireless Keyboard', 'Tired of writing on your iPad? Buy this smart, tiny keyboard and suddenly your iPad feels like a \"real\" computer!', 'product006.jpg', 800);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_log`
--
ALTER TABLE `order_log`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_log`
--
ALTER TABLE `order_log`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_log`
--
ALTER TABLE `order_log`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

