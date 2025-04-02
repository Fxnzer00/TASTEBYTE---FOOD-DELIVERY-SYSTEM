-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2024 at 11:26 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taste-byte`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `totalcost` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `restaurant_id`, `item_id`, `quantity`, `totalcost`, `status`) VALUES
(179, 7, 1, 8, 1, '15.00', 'DONE ORDER'),
(180, 7, 1, 9, 1, '27.00', 'DONE ORDER'),
(181, 7, 1, 13, 1, '32.00', 'DONE ORDER'),
(182, 7, 1, 14, 1, '6.00', 'DONE ORDER'),
(190, 7, 1, 8, 1, '15.00', 'DONE ORDER'),
(191, 7, 1, 9, 1, '27.00', 'DONE ORDER'),
(192, 7, 1, 13, 1, '32.00', 'DONE ORDER'),
(215, 7, 1, 14, 1, '6.00', 'DONE ORDER'),
(219, 7, 1, 9, 1, '27.00', 'DONE ORDER'),
(220, 6, 1, 8, 1, '15.00', 'DONE ORDER'),
(221, 7, 1, 8, 3, '45.00', 'DONE ORDER'),
(222, 7, 1, 8, 1, '15.00', 'DONE ORDER'),
(223, 7, 1, 12, 1, '6.00', 'DONE ORDER'),
(224, 7, 1, 8, 1, '15.00', 'DONE ORDER'),
(225, 7, 1, 12, 1, '6.00', 'DONE ORDER'),
(226, 6, 1, 8, 1, '15.00', 'DONE ORDER'),
(227, 6, 1, 9, 1, '27.00', 'DONE ORDER'),
(228, 6, 1, 12, 1, '6.00', 'DONE ORDER'),
(229, 7, 1, 8, 1, '15.00', 'DONE ORDER'),
(230, 7, 1, 9, 1, '27.00', 'DONE ORDER'),
(231, 7, 1, 13, 3, '96.00', 'DONE ORDER'),
(235, 6, 1, 13, 1, '32.00', 'DONE ORDER'),
(239, 6, 1, 9, 1, '27.00', 'DONE ORDER'),
(240, 6, 1, 14, 3, '18.00', 'DONE ORDER'),
(241, 6, 1, 8, 3, '45.00', 'DONE ORDER'),
(242, 6, 1, 9, 3, '81.00', 'DONE ORDER'),
(243, 6, 1, 12, 3, '18.00', 'DONE ORDER'),
(244, 6, 1, 12, 3, '18.00', 'DONE ORDER'),
(245, 6, 1, 13, 3, '96.00', 'DONE ORDER'),
(246, 6, 1, 8, 1, '15.00', 'DONE ORDER'),
(247, 6, 1, 9, 1, '27.00', 'DONE ORDER'),
(248, 6, 1, 13, 15, '480.00', 'DONE ORDER'),
(249, 6, 1, 12, 1, '6.00', 'DONE ORDER'),
(250, 7, 1, 31, 1, '11.00', 'DONE ORDER'),
(251, 7, 1, 8, 1, '15.00', 'DONE ORDER'),
(252, 7, 1, 8, 3, '45.00', 'DONE ORDER'),
(253, 7, 1, 9, 3, '39.00', 'DONE ORDER'),
(255, 7, 1, 12, 1, '14.90', 'DONE ORDER'),
(256, 7, 1, 8, 1, '15.00', 'DONE ORDER'),
(257, 7, 1, 9, 1, '13.00', 'DONE ORDER'),
(258, 7, 1, 13, 1, '13.00', 'DONE ORDER'),
(259, 7, 1, 9, 1, '13.00', 'DONE ORDER'),
(260, 7, 1, 8, 1, '15.00', 'IN CART'),
(261, 7, 1, 12, 1, '14.90', 'IN CART'),
(262, 7, 1, 30, 1, '14.50', 'IN CART'),
(263, 6, 1, 8, 1, '15.00', 'DONE ORDER'),
(264, 6, 11, 4, 3, '51.00', 'IN CART');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `price` float(10,2) NOT NULL,
  `availability_status` varchar(50) NOT NULL,
  `menu_visible` varchar(5) NOT NULL,
  `image_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `restaurant_id`, `name`, `description`, `price`, `availability_status`, `menu_visible`, `image_file`) VALUES
(4, 11, 'Chocolate Chip Walnut cake ', 'Cocoa sponge with layers of chocolate cream filled with Californian walnuts and chocolate chips.', 17.00, 'Available', '1', 'menu-images/choc chip walnut.jpg'),
(8, 1, 'Cheese Crème Strawberry Frappé', 'Get ready for a berry cheesy blast! A playful blend of strawberry, smooth milk, and a sprinkle of that cheesy magic. Its a freezy, fruity fun you wont want to miss! ', 15.00, 'Available', '1', 'menu-images/Cheese-Crème-Strawberry-Frappé1.jpg'),
(9, 1, 'Icy Spanish Latté', 'Combining the rich flavour of Spanish Latté with a refreshing icy twist, its like a cool party in a cup. Say Hola! to the perfect way to refresh!', 13.00, 'Available', '1', 'menu-images/Icy Spanish Latté.jpg'),
(12, 1, 'Japanese Matcha Frappé', 'Cool down with our ice blended Frappé made with premium Japanese Matcha Powder and topped with whipped cream for that decadent touch.', 14.90, 'Low Stock', '1', 'menu-images/jap-matcha-frappe.jpg'),
(13, 1, 'Iced Buttercrème Spanish Latté', 'A touch of Buttercrème adds another a layer of indulgence to everyone favourite Spanish Latté! The perfect coffee choice on any day.', 13.00, 'Available', '1', 'menu-images/Iced-Buttercreme-Spanish-Latte.jpg'),
(14, 1, 'Burnt Cheese Cake', 'Dont be intimidated by its burnt top because its the best part of this dessert! Tastes like caramelised cheesecake with a beautiful burnt exterior and super creamy interior.', 14.00, 'Available', '1', 'menu-images/burnt cheese cake.jpg'),
(15, 1, 'Roti Canai', 'Fluffy Roti Canai ', 2.00, 'Available', '0', 'menu-images/Roti-Canai-3.jpg'),
(16, 13, 'Kennys Quarter Meal', 'Rotisserie-roasted 1/4 Chicken with 3 side dishes & 3 side dishes & 1 Kenny Home-made Muffin.', 27.00, 'Available', '1', 'menu-images/kenny quater meal.jpg'),
(17, 13, 'Kennys Half Meal', 'Rotisserie-roasted 1/2 chicken with 3 side dishes & 1 Kenny Home-made Muffin.', 41.00, 'Available', '1', 'menu-images/kenny half meal.png'),
(18, 13, 'Kenny Chicken & Soup Meal', 'Rotisserie-roasted 1/4 chicken,Aromatic rice,1 Kennys Home-Made Muffin and Kennys Mushroom & Chicken Soup.', 29.00, 'Available', '1', 'menu-images/Kenny Chicken & Soup Meal.png'),
(19, 13, 'Trio Meal', 'Rotisserie-roasted 1/4 chicken,4-pcs of beef meatballs served with Kennys Sighnature Cheese Sauce.2 pcs of Crispy Fish Fillet.', 42.00, 'Available', '1', 'menu-images/Trio Meal.jpg'),
(20, 13, 'kennys Family Meal', 'Rotisserie-roasted whole chicken with 3 bowls of side dishes, 4 Kennys Mushroom & Chicken Soup and soft drinks.', 115.00, 'Available', '1', 'menu-images/kenny family meal.png'),
(21, 13, '2-pcs Kennys Ayam Goreng', 'Tender,juicy chicken cooked to golden perfection.', 17.00, 'Available', '1', 'menu-images/2pcs_kennychicken.jpeg'),
(22, 13, '6-pcs Kennys Ayam Goreng', 'Tender,juicy chicken cooked to golden perfection.', 49.00, 'Available', '1', 'menu-images/6pcs_kennychicken..png'),
(23, 12, 'Bang Bang Chocolate with Brown Sugar Warm Pearls', 'Rich coco served with soft & chewy brown sugar warm pearls.', 8.00, 'Available', '1', 'menu-images/Bang Bang Chocolate with Brown Sugar Warm Pearls.jpg'),
(24, 12, 'Bang Bang Fresh Milk with Brown Sugar Warm Pearls', 'Creamy fresh milk served with soft & chewy brown sugar warm pearls.', 8.00, 'Available', '1', 'menu-images/Bang Bang Fresh Milk with Brown Sugar Warm Pearls.jpg'),
(25, 12, 'Caramel Macchiato', 'Tealive signature blend of 100% premium Arabica coffee.', 10.00, 'Available', '1', 'menu-images/Caramel Macchiato.jpg'),
(26, 12, 'Coco Oreo Smoothie', 'Icy blend of creamy chocolate topped with crunchy Oreo cookie pieces.', 10.00, 'Available', '1', 'menu-images/Coco Oreo Smoothie.jpg'),
(27, 12, 'Bang Bang Nishio Matcha with Brown Sugar Warm Pearls', 'Authentic Japanese green tea imported from Nishio, served with soft & chewy brown sugar warm pearls.', 11.00, 'Available', '1', 'menu-images/Bang Bang Nishio Matcha with Brown Sugar Warm Pearls.jpg'),
(28, 12, 'Belgian Lotus Biscoff Coffee', 'Tealive signature blend of 100% premium Arabica coffee.', 15.00, 'Available', '1', 'menu-images/Belgian Lotus Biscoff Coffee.jpg'),
(29, 12, 'Hazelnut Latte', 'With 100% premium Arabica coffee with a twist of hazelnut.', 9.00, 'Available', '1', 'menu-images/Hazelnut Latte.jpg'),
(30, 1, 'Summer Berries Cheese Cake', 'Want to feel the warmth and sweetness of summer in your mouth?\r\nDelve into our Summer Berries Cheese Cake to pair with your ZUS drinks, its berry good~\r\nIts creamy, with the taste of berries which bring a lot of flavours.\r\n\r\nFeels like a slice of summer in one bite!', 14.50, 'Available', '1', 'menu-images/summerberries-cake.jpg'),
(31, 1, 'ZUS Gula Melaka', 'A beautiful marriage of Espresso, Gula Melaka, Pandan and Coconut Cream. Our ZUS Gula Melaka, Memang Best!\r\n\r\nHandcrafted by our Head Barista, this addictive re-innovation of a Malaysian favourite infused with only the greenest of pandan to bring out the sweet richness that Gula Melaka is known for.', 11.00, 'Available', '1', 'menu-images/zus_gula_melaka.jpg'),
(32, 11, 'Moist Chocolate Cake', 'Moist chocolate cake baked with smooth coffee filling, topped with melted chocolate.', 17.00, 'Available', '1', 'menu-images/Moist cake choc.jpg'),
(33, 11, 'Milo Cheese Cake', 'A tribute to every familys favourite chocolate drink in a delectable dessert form.', 20.00, 'Available', '1', 'menu-images/milo cake.jpg'),
(34, 11, 'Hokkaido Triple Cheese Chocolate Cake', 'A delightful combination of premium chocolate and cheese with layers of different taste and texture.', 25.00, 'Available', '1', 'menu-images/Hokaido triple cheese cake.jpg'),
(35, 11, ' Red Velvet Cake (Whole Cake)', 'Cream Cheese layered between fluffy red velvet sponges and filled with premium apricots bits.', 150.00, 'Available', '1', 'menu-images/red velvet.jpg'),
(36, 11, 'Royal Chocolate (Whole Cake)', 'Mud cake with smooth chocolate ganache, topped with chocolate coating, cocoa crumbles and premium cocoa powder.', 120.00, 'Available', '1', 'menu-images/royal choco.jpg'),
(37, 11, 'Sweet Potato (Whole Cake)', 'Layers of velvety sweet potato and Chantilly cream, topped with Purple Glaze & chocolate coated coconut.', 160.00, 'Available', '1', 'menu-images/sweet potato.jpg'),
(38, 14, 'Creamy Beef Fiesta', 'New creamy white sauce with beef pepperoni & cabanossi meat, only available on the new light & airy Hand Crafted Pizza', 38.00, 'Available', '1', 'menu-images/Creamy Beef Fiesta.png'),
(39, 14, 'Creamy Chicken Fiesta ', 'New creamy white sauce with chicken salami and chicken pepperoni, only available on the new light & airy Hand Crafted Pizza', 38.00, 'Available', '1', 'menu-images/Creamy Chicken Fiesta.png'),
(40, 14, 'Creamy Crispy Chicken ', 'New creamy white sauce topped with crispy chicken pops fried to perfection, only available on the new light & airy Hand Crafted Pizza', 42.00, 'Available', '1', 'menu-images/Creamy Crispy Chicken.png'),
(41, 14, 'Heart Hawaiian Chicken ', 'Heart-shape pizza with tomato sauce, chicken meat, pineapples, mozzarella cheese.', 42.00, 'Available', '1', 'menu-images/Heart Hawaiian Chic.png'),
(42, 14, 'Ong Lit Lit', 'Deliciously ong buttermilk sauce with lit-lit chili and curry leaves, topped with crunchy Popcorn Chicken.​\r\nChinese New Year Event.', 42.00, 'Available', '1', 'menu-images/Ong Lit Lit.png'),
(43, 14, 'Heart Aloha Chicken ', 'Heart-shape pizza with thousand island sauce, chicken rolls, chicken salami, pineapples, mozzarella cheese.', 42.00, 'Available', '1', 'menu-images/Heart Aloha Chic.png'),
(44, 14, 'Wingstreet Party For 2', '12 pcs Wingettes & Drumettes + 1\r\nCrispy Fries or Potato Wedges + 1.5L Coke', 115.00, 'Available', '1', 'menu-images/Wingstreet Party for 2.png');

-- --------------------------------------------------------

--
-- Table structure for table `order_condition`
--

CREATE TABLE `order_condition` (
  `order_condition_id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `details_order` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `sys_visible` varchar(5) NOT NULL,
  `order_accept_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_condition`
--

INSERT INTO `order_condition` (`order_condition_id`, `restaurant_id`, `user_id`, `details_order`, `total_amount`, `status`, `sys_visible`, `order_accept_date`) VALUES
(20, 1, 7, 'Cheese Crème Strawberry Frappé - ×1 - RM 15.00<br>ZUS Gula Melaka - ×1 - RM 11.00', '26.00', 'ACCEPT', '0', '2024-02-06 02:25:00'),
(21, 1, 7, 'Icy Spanish Latté - ×1 - RM 13.00', '13.00', 'ACCEPT', '0', '2024-02-06 05:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_place`
--

CREATE TABLE `order_place` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_place`
--

INSERT INTO `order_place` (`order_id`, `user_id`, `restaurant_id`, `name`, `address`, `email`, `phone`, `item_name`, `quantity`, `price`, `total_price`, `status`, `order_date`) VALUES
(59, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 3, '6.00', '18.00', 'DONE DECIDE', '2024-02-03 16:28:13'),
(60, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Rendang Daging', 1, '32.00', '47.00', 'DONE DECIDE', '2024-02-03 16:31:03'),
(61, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Burger Monster Chicken', 1, '15.00', '47.00', 'DONE DECIDE', '2024-02-03 16:31:03'),
(62, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 1, '6.00', '6.00', 'DONE DECIDE', '2024-02-03 16:44:52'),
(63, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 1, '6.00', '264.00', 'DONE DECIDE', '2024-02-03 18:31:49'),
(64, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Burger Monster Chicken', 3, '15.00', '264.00', 'DONE DECIDE', '2024-02-03 18:31:49'),
(65, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Chicken Spicy', 3, '27.00', '264.00', 'DONE DECIDE', '2024-02-03 18:31:49'),
(66, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 3, '6.00', '264.00', 'DONE DECIDE', '2024-02-03 18:31:49'),
(67, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Rendang Daging', 3, '32.00', '264.00', 'DONE DECIDE', '2024-02-03 18:31:49'),
(68, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Kandar Penang Spicy', 3, '6.00', '264.00', 'DONE DECIDE', '2024-02-03 18:31:49'),
(69, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 1, '6.00', '264.00', 'DONE DECIDE', '2024-02-03 18:47:48'),
(70, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Burger Monster Chicken', 3, '15.00', '264.00', 'DONE DECIDE', '2024-02-03 18:47:48'),
(71, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Chicken Spicy', 3, '27.00', '264.00', 'DONE DECIDE', '2024-02-03 18:47:48'),
(72, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 3, '6.00', '264.00', 'DONE DECIDE', '2024-02-03 18:47:48'),
(73, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Rendang Daging', 3, '32.00', '264.00', 'DONE DECIDE', '2024-02-03 18:47:48'),
(74, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Kandar Penang Spicy', 3, '6.00', '264.00', 'DONE DECIDE', '2024-02-03 18:47:48'),
(75, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 1, '6.00', '264.00', 'DONE DECIDE', '2024-02-04 10:05:20'),
(76, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Burger Monster Chicken', 3, '15.00', '264.00', 'DONE DECIDE', '2024-02-04 10:05:20'),
(77, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Chicken Spicy', 3, '27.00', '264.00', 'DONE DECIDE', '2024-02-04 10:05:20'),
(78, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 3, '6.00', '264.00', 'DONE DECIDE', '2024-02-04 10:05:20'),
(79, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Rendang Daging', 3, '32.00', '264.00', 'DONE DECIDE', '2024-02-04 10:05:20'),
(80, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Kandar Penang Spicy', 3, '6.00', '264.00', 'DONE DECIDE', '2024-02-04 10:05:20'),
(81, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Burger Monster Chicken', 1, '15.00', '80.00', 'DONE DECIDE', '2024-02-04 10:23:32'),
(82, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Chicken Spicy', 1, '27.00', '80.00', 'DONE DECIDE', '2024-02-04 10:23:32'),
(83, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Rendang Daging', 1, '32.00', '80.00', 'DONE DECIDE', '2024-02-04 10:23:32'),
(84, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Kandar Penang Spicy', 1, '6.00', '80.00', 'DONE DECIDE', '2024-02-04 10:23:32'),
(85, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Burger Monster Chicken', 1, '15.00', '74.00', 'DONE DECIDE', '2024-02-04 11:06:54'),
(86, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Chicken Spicy', 1, '27.00', '74.00', 'DONE DECIDE', '2024-02-04 11:06:54'),
(87, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Rendang Daging', 1, '32.00', '74.00', 'DONE DECIDE', '2024-02-04 11:06:54'),
(88, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Kandar Penang Spicy', 1, '6.00', '6.00', 'DONE DECIDE', '2024-02-04 14:30:28'),
(89, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Burger Monster Chicken', 1, '15.00', '63.00', 'DONE DECIDE', '2024-02-04 15:23:03'),
(90, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Burger Monster Chicken', 1, '15.00', '63.00', 'DONE DECIDE', '2024-02-04 15:23:03'),
(91, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Chicken Spicy', 1, '27.00', '63.00', 'DONE DECIDE', '2024-02-04 15:23:03'),
(92, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 1, '6.00', '63.00', 'DONE DECIDE', '2024-02-04 15:23:03'),
(93, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Burger Monster Chicken', 3, '15.00', '114.00', 'DONE DECIDE', '2024-02-04 16:04:11'),
(94, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Burger Monster Chicken', 1, '15.00', '114.00', 'DONE DECIDE', '2024-02-04 16:04:11'),
(95, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Burger Monster Chicken', 1, '15.00', '114.00', 'DONE DECIDE', '2024-02-04 16:04:11'),
(96, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Chicken Spicy', 1, '27.00', '114.00', 'DONE DECIDE', '2024-02-04 16:04:11'),
(97, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 1, '6.00', '114.00', 'DONE DECIDE', '2024-02-04 16:04:11'),
(98, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 1, '6.00', '114.00', 'DONE DECIDE', '2024-02-04 16:04:11'),
(99, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Burger Monster Chicken', 1, '15.00', '42.00', 'DONE DECIDE', '2024-02-04 16:26:31'),
(100, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Chicken Spicy', 1, '27.00', '42.00', 'DONE DECIDE', '2024-02-04 16:26:31'),
(101, 7, 1, 'Irfan', 'Puncak Alam', 'irfan@gmail.com', '1114324687', 'Rendang Daging', 3, '32.00', '96.00', 'DONE DECIDE', '2024-02-04 16:26:49'),
(102, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Rendang Daging', 1, '32.00', '32.00', 'DONE DECIDE', '2024-02-04 18:46:27'),
(103, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Chicken Spicy', 1, '27.00', '27.00', 'DONE DECIDE', '2024-02-04 19:58:43'),
(104, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Burger Monster Chicken', 3, '15.00', '276.00', 'DONE DECIDE', '2024-02-04 21:48:29'),
(105, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Chicken Spicy', 3, '27.00', '276.00', 'DONE DECIDE', '2024-02-04 21:48:29'),
(106, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 3, '6.00', '276.00', 'DONE DECIDE', '2024-02-04 21:48:29'),
(107, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 3, '6.00', '276.00', 'DONE DECIDE', '2024-02-04 21:48:29'),
(108, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Rendang Daging', 3, '32.00', '276.00', 'DONE DECIDE', '2024-02-04 21:48:29'),
(109, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Nasi Kandar Penang Spicy', 3, '6.00', '276.00', 'DONE DECIDE', '2024-02-04 21:48:29'),
(110, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Burger Monster Chicken', 1, '15.00', '15.00', 'DONE DECIDE', '2024-02-04 22:02:32'),
(111, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Chicken Spicy', 1, '27.00', '27.00', 'DONE DECIDE', '2024-02-04 22:05:19'),
(112, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Rendang Daging', 15, '32.00', '480.00', 'DONE DECIDE', '2024-02-05 12:27:17'),
(113, 6, 1, 'Nurun Najihah', 'Jejawi, Kangarr', 'nurunnajihah2311@gmail.com', '1114324687', 'Nasi Goreng Kampung Pedas', 1, '6.00', '6.00', 'DONE DECIDE', '2024-02-05 13:04:27'),
(114, 7, 1, 'Irfan', 'Puncak Alam, Selangor', 'irfan@gmail.com', '1114324687', 'ZUS Gula Melaka', 1, '11.00', '26.00', 'DONE DECIDE', '2024-02-05 18:11:01'),
(115, 7, 1, 'Irfan', 'Puncak Alam, Selangor', 'irfan@gmail.com', '1114324687', 'Cheese Crème Strawberry Frappé', 1, '15.00', '26.00', 'DONE DECIDE', '2024-02-05 18:11:01'),
(116, 7, 1, 'Irfan', 'Puncak Alam, Selangor', 'irfan@gmail.com', '1114324687', 'Cheese Crème Strawberry Frappé', 3, '15.00', '84.00', 'DONE DECIDE', '2024-02-05 18:24:23'),
(117, 7, 1, 'Irfan', 'Puncak Alam, Selangor', 'irfan@gmail.com', '1114324687', 'Icy Spanish Latté', 3, '13.00', '84.00', 'DONE DECIDE', '2024-02-05 18:24:23'),
(118, 7, 1, 'Irfan', 'Puncak Alam, Selangor', 'irfan@gmail.com', '1114324687', 'Japanese Matcha Frappé', 1, '14.90', '55.90', 'DONE DECIDE', '2024-02-05 19:35:58'),
(119, 7, 1, 'Irfan', 'Puncak Alam, Selangor', 'irfan@gmail.com', '1114324687', 'Cheese Crème Strawberry Frappé', 1, '15.00', '55.90', 'DONE DECIDE', '2024-02-05 19:35:58'),
(120, 7, 1, 'Irfan', 'Puncak Alam, Selangor', 'irfan@gmail.com', '1114324687', 'Icy Spanish Latté', 1, '13.00', '55.90', 'DONE DECIDE', '2024-02-05 19:35:58'),
(121, 7, 1, 'Irfan', 'Puncak Alam, Selangor', 'irfan@gmail.com', '1114324687', 'Iced Buttercrème Spanish Latté', 1, '13.00', '55.90', 'DONE DECIDE', '2024-02-05 19:35:58'),
(122, 7, 1, 'Irfan', 'Puncak Alam, Selangor', 'irfan@gmail.com', '1114324687', 'Icy Spanish Latté', 1, '13.00', '13.00', 'DONE DECIDE', '2024-02-05 21:31:15'),
(123, 6, 1, 'Nurun Najihah', 'Jejawi, Perlis', 'nurunnajihah2311@gmail.com', '1114324687', 'Cheese Crème Strawberry Frappé', 1, '15.00', '15.00', 'Pending', '2024-02-05 22:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurant_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `res_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`restaurant_id`, `username`, `password`, `name`, `description`, `address`, `email`, `phone_number`, `res_image`) VALUES
(1, 'John', '$2y$10$SKXLK2b9n3sKCSA8g7CbBesgUcfxi4rTKtFKcPzCneoDF3IRqwxqy', 'Zus Coffee', 'a Necessity not a Luxury', 'Setia City Mall, Selangor', 'zusofficial@gmail.com', '0333933355', 'restaurant-images/zus logo.jpg'),
(11, 'gaza', '$2y$10$2HKLJgISA.uaHjApJEwRs.iXUcIGY4SG79AdOwqn3hRcoc.pkTLxq', 'Secret Recipe', 'Dessert World best', 'Aeon Kinta City ,Ipoh, Perak', 'SecretRecipe@gmail.com', '083453556', 'restaurant-images/secret.png'),
(12, 'Chong', '$2y$10$2HKLJgISA.uaHjApJEwRs.iXUcIGY4SG79AdOwqn3hRcoc.pkTLxq', 'Tealive', ' Always More Than Tea.', 'Setia City Mall, Selangor', 'chong@gmail.com', '037273723823', 'restaurant-images/logo-tealive.jpg'),
(13, 'ahmad', '$2y$10$2HKLJgISA.uaHjApJEwRs.iXUcIGY4SG79AdOwqn3hRcoc.pkTLxq', 'Kenny Rogers Roasters', 'Deliciously Healthy,less fat...less salt...less calories.', 'Aeon Mall Klebang,Ipoh,Perak.', 'ahmad@gmail.com', '0116151353', 'restaurant-images/kenny.png'),
(14, 'Ryan', '$2y$10$2HKLJgISA.uaHjApJEwRs.iXUcIGY4SG79AdOwqn3hRcoc.pkTLxq', 'Pizza Hut', 'No one outpizzas the hut.', 'Aeon Mall Klebang,Ipoh,Perak.', 'PizzaHutofficial@gmail.com', '0145677890', 'restaurant-images/294_pizza_hut_new_logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `img_user` varchar(500) NOT NULL,
  `wallet_balance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`, `address`, `phone_number`, `img_user`, `wallet_balance`) VALUES
(6, 'Jiah', '$2y$10$0IRQ/guAJcEkf9H066N8eejfYz7SZXpWo1sf5DYKk90zd4JGF7Pyq', 'nurunnajihah2311@gmail.com', 'Nurun Najihah', 'Jejawi, Perlis', '01114324687', 'ADMIN/user-images/9131529.png', '1929.44'),
(7, 'Irfan', '$2y$10$zSZW9rdIKu/nZcvI/dhiFO0StBJpvumO4u/rPHM.b8gPUcfsBBD1q', 'irfan@gmail.com', 'Irfan', 'Puncak Alam, Selangor', '01114324687', 'ADMIN/user-images/9131529.png', '417.95');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `order_condition`
--
ALTER TABLE `order_condition`
  ADD PRIMARY KEY (`order_condition_id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_place`
--
ALTER TABLE `order_place`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `order_condition`
--
ALTER TABLE `order_condition`
  MODIFY `order_condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_place`
--
ALTER TABLE `order_place`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`);

--
-- Constraints for table `order_condition`
--
ALTER TABLE `order_condition`
  ADD CONSTRAINT `order_condition_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`),
  ADD CONSTRAINT `order_condition_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_place`
--
ALTER TABLE `order_place`
  ADD CONSTRAINT `order_place_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `order_place_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
