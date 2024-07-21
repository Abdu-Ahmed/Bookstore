-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 03:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(255) DEFAULT NULL,
  `book_description` text DEFAULT NULL,
  `book_author` varchar(255) DEFAULT NULL,
  `book_price` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL,
  `book_genre` varchar(255) DEFAULT NULL,
  `book_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_title`, `book_description`, `book_author`, `book_price`, `date`, `status`, `book_genre`, `book_image`) VALUES
(5, 'Normal People', 'The author of conversations with friends comes out with another banger', 'Sally Rooney', 332, '2024-01-13 08:36:57', '', 'Action', 'https://cdn.vox-cdn.com/thumbor/p-gGrwlaU4rLikEAgYhupMUhIJc=/0x0:1650x2475/1200x0/filters:focal(0x0:1650x2475):no_upscale()/cdn.vox-cdn.com/uploads/chorus_asset/file/13757614/817BsplxI9L.jpg'),
(6, 'Harry Potter and the deathly harrows', 'harry potter faces his greatest enemy so far, will he finally defeat him?', 'J.K. Rowling', 243, '2024-07-04 14:39:18', '', 'Fiction', 'https://hips.hearstapps.com/digitalspyuk.cdnds.net/15/50/1449878132-9781781100264.jpg?resize=980:*'),
(7, 'The Right Swipe', 'a modern day romance story, with modern twists', 'Alisha Rai', 123, '2024-01-13 08:40:52', '', 'Romance', 'https://m.media-amazon.com/images/I/71LwgxyLFKL._AC_UF894,1000_QL80_.jpg'),
(8, 'To Kill a Mockingbird', 'A novel about the serious issues of rape and racial inequality.', 'Harper Lee', 11, '2024-06-26 13:04:52', '', 'Fiction', 'https://m.media-amazon.com/images/I/81gepf1eMqL._AC_UF894,1000_QL80_.jpg'),
(9, '1984', 'A dystopian social science fiction novel and cautionary tale about the dangers of totalitarianism.', 'George Orwell', 9, '2024-06-26 13:04:52', '', 'Science Fiction', 'https://m.media-amazon.com/images/I/61ZewDE3beL._AC_UF894,1000_QL80_.jpg'),
(10, 'The Great Gatsby', 'A novel about the American dream and the roaring twenties.', 'F. Scott Fitzgerald', 10, '2024-06-26 13:04:52', '', 'Classic', 'https://m.media-amazon.com/images/I/81QuEGw8VPL._AC_UF894,1000_QL80_.jpg'),
(11, 'The Catcher in the Rye', 'A story about teenage rebellion and angst.', 'J.D. Salinger', 13, '2024-06-26 13:04:52', '', 'Fiction', 'https://m.media-amazon.com/images/I/91fQEUwFMyL._AC_UF894,1000_QL80_.jpg'),
(12, 'The Hobbit', 'A fantasy novel and children\'s book about the adventures of Bilbo Baggins.', 'J.R.R. Tolkien', 15, '2024-06-26 13:04:52', '', 'Fantasy', 'https://m.media-amazon.com/images/I/71k--OLmZKL._AC_UF894,1000_QL80_.jpg'),
(13, 'Pride and Prejudice', 'A romantic novel that also critiques the British landed gentry at the end of the 18th century.', 'Jane Austen', 12, '2024-06-26 13:04:52', '', 'Romance', 'https://m.media-amazon.com/images/I/5176rSnUxfL.jpg'),
(14, 'Harry Potter and the Sorcerer\'s Stone', 'The first book in the Harry Potter series about a young wizard and his adventures at Hogwarts.', 'J.K. Rowling', 14, '2024-06-26 13:04:52', '', 'Fantasy', 'https://m.media-amazon.com/images/I/91wKDODkgWL._AC_UF894,1000_QL80_.jpg'),
(15, 'The Lord of the Rings', 'An epic high-fantasy novel about the quest to destroy the One Ring.', 'J.R.R. Tolkien', 20, '2024-06-26 13:04:52', '', 'Fantasy', 'https://m.media-amazon.com/images/I/81nV6x2ey4L._AC_UF894,1000_QL80_.jpg'),
(16, 'Animal Farm', 'A satirical allegorical novella that reflects events leading up to the Russian Revolution of 1917.', 'George Orwell', 8, '2024-06-26 13:04:52', '', 'Political Satire', 'https://m.media-amazon.com/images/I/91Lbhwt5RzL._AC_UF894,1000_QL80_.jpg'),
(17, 'The Chronicles of Narnia', 'A series of fantasy novels about the adventures in the magical land of Narnia.', 'C.S. Lewis', 16, '2024-06-26 13:04:52', '', 'Fantasy', 'https://m.media-amazon.com/images/I/81RuC2qCSmL._AC_UF894,1000_QL80_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `user_id`, `book_id`, `quantity`, `created_at`) VALUES
(5, 1, 6, 1, '2024-07-14 09:44:43'),
(8, 3, 8, 1, '2024-07-20 14:36:50'),
(9, 3, 9, 1, '2024-07-20 14:36:54'),
(10, 3, 10, 1, '2024-07-20 14:37:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `order_date`, `status`) VALUES
(1, 1, 348.00, '2024-07-10 06:04:08', 'pending'),
(2, 1, 348.00, '2024-07-10 06:08:12', 'pending'),
(3, 1, 332.00, '2024-07-10 06:10:29', 'pending'),
(4, 1, 332.00, '2024-07-10 06:12:23', 'pending'),
(5, 3, 342.00, '2024-07-20 14:36:30', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `book_id`, `quantity`, `price`) VALUES
(1, 4, 5, 1, 332.00),
(2, 5, 5, 1, 332.00),
(3, 5, 10, 1, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `created_at`, `token`, `token_expiration`) VALUES
(1, 'trpni', '$2y$10$69y5zh9861X4br0wO/vW6eaIORX.3c0CDwGk8zBq7x/vXqNTkK3bK', 'mstrtrpni@gmail.com', '2024-06-29 12:08:17', NULL, NULL),
(3, 'abdu-admin', '$2y$10$/PTwHiWuKXsmorSH.or27Ow8V70NQht9b2iONQKruKZ6kdH3rO3uq', 'iamabduahmed@gmail.com', '2024-07-20 14:32:13', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
