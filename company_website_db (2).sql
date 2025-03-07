-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2025 at 10:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_website_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(30) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `file_path` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `company_name`, `description`, `file_path`, `date_created`, `date_updated`) VALUES
(2, 'Digital Nepal', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &quot; open=&quot;&quot; sans&quot;,=&quot;&quot; arial,=&quot;&quot; sans-serif;=&quot;&quot; text-align:=&quot;&quot; justify;&quot;=&quot;&quot;&gt;Nam pulvinar tempus ante sit amet malesuada. Donec quis sem porttitor, varius dolor vel, eleifend enim. Pellentesque vitae elit elementum, tristique nisl vel, varius nisi. Integer massa libero, tincidunt in tincidunt vel, semper ac libero. Suspendisse potenti. Praesent vitae nibh nec nunc sagittis condimentum. Etiam&amp;nbsp;&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/1628739180_logo.jpg', '2021-08-12 11:33:38', '2024-12-19 16:48:02'),
(3, 'ABC ', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &quot; open=&quot;&quot; sans&quot;,=&quot;&quot; arial,=&quot;&quot; sans-serif;=&quot;&quot; text-align:=&quot;&quot; justify;&quot;=&quot;&quot;&gt;Nam pulvinar tempus ante sit amet malesuada. Donec quis sem porttitor, varius dolor vel, eleifend enim. Pellentesque vitae elit elementum, tristique nisl vel, varius nisi. Integer massa libero, tincidunt in tincidunt vel, semper ac libero. Suspendisse potenti. Praesent vitae nibh nec nunc sagittis condimentum. Etiam&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &quot; open=&quot;&quot; sans&quot;,=&quot;&quot; arial,=&quot;&quot; sans-serif;=&quot;&quot; text-align:=&quot;&quot; justify;&quot;=&quot;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;br&gt;&lt;p&gt;&lt;/p&gt;', 'uploads/1734606180_mission.png', '2021-08-12 11:35:57', '2024-12-19 16:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `meta_field` text DEFAULT NULL,
  `meta_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`meta_field`, `meta_value`) VALUES
('mobile', '+977-9767981534'),
('email', 'info@knitbytes.com'),
('facebook', ''),
('twitter', ''),
('linkin', ''),
('address', 'Shankhamul, Prabhu Bank Building, 4th Floor');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(30) NOT NULL,
  `full_name` text NOT NULL,
  `subject` text NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `full_name`, `subject`, `contact`, `email`, `message`, `status`, `date_created`, `date_updated`) VALUES
(5, 'hhrhthh', 'ikhkhk', '9888888888', 'hakimraut407@gmail.com', 'khjkhjkhjk', 1, '2024-12-14 15:28:59', '2024-12-14 15:29:49'),
(6, 'hakim raut', 'English', '9800000000', 'hakimraut407@gmail.com', 'ajaishaus', 0, '2024-12-23 12:00:00', NULL),
(7, 'hakim raut', 'English', '9800000000', 'hakimraut407@gmail.com', 'ajaishaus', 0, '2024-12-23 12:00:01', NULL),
(8, 'Hakim  Raut', 'English', '9800000000', 'hakimraut408@gmail.com', 'hjhghg', 0, '2024-12-23 13:44:24', NULL),
(9, 'testing', 'computer', '9888888888', 'hakimraut408@gmail.com', 'gdfgfgf', 0, '2025-01-01 11:08:03', NULL),
(10, 'shdhd', 'ghhhghh', 'dfdgfgf', 'hakimraut407@gmail.com', 'hfh', 1, '2025-01-01 11:10:52', '2025-01-26 08:11:10'),
(11, 'hakim raut', 'English', 'dfdgfgf', 'teacher@teacher.com', 'ojiih', 0, '2025-02-09 17:12:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `file_path`, `date_created`, `date_updated`) VALUES
(1, 'Web Development', '&lt;h5 style=&quot;text-align: justify; &quot;&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Transform your ideas into reality with our expert web development services, tailored to deliver seamless and innovative digital solutions.&lt;/span&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;﻿&lt;/span&gt;&lt;/h5&gt;&lt;p style=&quot;text-align: justify;&quot;&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/1740989567_web.png', '2021-08-12 10:12:40', '2025-03-03 13:57:47'),
(4, 'Custom Software Development', '&lt;h5 style=&quot;text-align: justify; &quot;&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Unlock your business potential with our custom software development services, designed to create tailored solutions that drive success.&lt;/span&gt;&lt;/h5&gt;&lt;p style=&quot;text-align: justify;&quot;&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/1740989728_software.png', '2021-08-12 10:28:12', '2025-03-03 14:00:28'),
(5, 'Digital Marketing', '&lt;h5 style=&quot;text-align: justify; &quot;&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Boost your online presence and drive growth with our results-driven digital marketing services, tailored to your business needs and solution.&lt;/span&gt;&lt;/h5&gt;&lt;p style=&quot;text-align: justify;&quot;&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/1740989742_digital.png', '2024-12-24 13:00:18', '2025-03-03 14:00:42'),
(6, 'Android Development', '&lt;h5 style=&quot;text-align: justify; &quot;&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Unlock your business potential with our android development services, designed to create tailored solutions that drive success.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&lt;/span&gt;&lt;/h5&gt;&lt;p style=&quot;text-align: justify;&quot;&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/1740989704_android.png', '2025-02-28 14:13:34', '2025-03-03 14:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Knit Bytes'),
(2, 'address', 'Philippines'),
(3, 'contact', '+1234567890'),
(4, 'email', 'info@sample.com'),
(6, 'short_name', 'KB'),
(9, 'logo', 'uploads/1741069320_cropped_logo.png'),
(11, 'welcome_message', 'Welcome to Knit Bytes, where innovation meets excellence. We specialize in delivering cutting-edge IT solutions tailored to your business needs. From software development to digital transformation, our team is dedicated to empowering your success in the digital era.\r\n\r\n'),
(12, 'banner', 'uploads/1740989220_bg2.png');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(30) NOT NULL,
  `message_from` text NOT NULL,
  `message` text NOT NULL,
  `file_path` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `message_from`, `message`, `file_path`, `date_created`, `date_updated`) VALUES
(7, 'Ram Shah -GM, Analysis Company', '&lt;p&gt;&lt;font color=&quot;#00ff00&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Times New Roman&amp;quot;;&quot;&gt;KnitBytes&lt;/span&gt;&lt;/font&gt;&lt;span style=&quot;font-family: &amp;quot;Times New Roman&amp;quot;;&quot;&gt; transformed the way we handle and interpret data. Their innovative solutions have been a game-changer for our analysis workflows.&lt;/span&gt;&lt;/p&gt;', '', '2024-12-24 13:06:56', NULL),
(8, 'Rima Adhikari -Coordinator, ATMV school', '&lt;p&gt;&lt;span style=&quot;font-family: &quot; times=&quot;&quot; new=&quot;&quot; roman&quot;;&quot;=&quot;&quot;&gt;Thanks to&lt;font color=&quot;#000000&quot;&gt; &lt;/font&gt;&lt;/span&gt;&lt;font color=&quot;#00ff00&quot;&gt;KnitBytes&lt;/font&gt;&lt;span style=&quot;font-family: &quot; times=&quot;&quot; new=&quot;&quot; roman&quot;;&quot;=&quot;&quot;&gt;, our school now has a seamless platform for managing schedules, attendance, and academic records. It&rsquo;s been a game-changer for students, teachers, and staff alike.&lt;/span&gt;&lt;/p&gt;', '', '2024-12-24 13:09:04', '2024-12-24 13:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `date_added`, `date_updated`) VALUES
(1, 'Hakim', 'Raut', 'admin', 'dadb7c69edbdb9c8e4d030106ef727b5', 'uploads/1734687360_kb.PNG', NULL, '2024-01-20 14:02:37', '2025-02-24 19:20:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
