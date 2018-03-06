-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 26, 2018 at 08:23 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `acme_webshop`
--

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
(5, 'Earpods', 'Join the earpod team if you haven\'t already. You will not regret it!', 'product003.jpg', 150),
(7, 'Smartwatch', 'With a smartwatch you will be able to take your calls, read and answer your texts, have an eye on your time and all your social media, all of this without even taking your phone out of your pocket! What are you waiting for?', 'product004.jpg', 500),
(8, 'Portable Speaker', 'With this portable speaker you carry perfect sound with you, everywhere you go!', 'product005.jpg', 3200),
(9, 'Wireless Keyboard', 'Tired of writing on your iPad? Buy this smart, tiny keyboard and suddenly your iPad feels like a \'real\' computer!', 'product006.jpg', 1450);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
