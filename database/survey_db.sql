-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 12:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(30) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `answer` text NOT NULL,
  `question_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `survey_id`, `user_id`, `answer`, `question_id`, `date_created`) VALUES
(20, 7, 5, 'ZOyGN', 17, '2023-04-27 15:25:06'),
(21, 9, 5, '[SzxLX]', 18, '2023-04-27 15:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(30) NOT NULL,
  `question` text NOT NULL,
  `frm_option` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `order_by` int(11) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `frm_option`, `type`, `order_by`, `survey_id`, `date_created`) VALUES
(5, 'test', '{\"NGbgy\":\"1\",\"udcyi\":\"2\"}', 'radio_opt', 0, 3, '2023-04-26 10:46:57'),
(6, 'Таны нас: ', '{\"LOTUn\":\"18-25\",\"UDThZ\":\"25-35\",\"DBrwu\":\"35-45\",\"iYSuR\":\"45-65\",\"LigaF\":\"65-дээш\"}', 'radio_opt', 1, 6, '2023-04-27 12:09:33'),
(15, 'Хүйс:', '{\"hWzbK\":\"Эр\",\"gWPLI\":\"Эм\"}', 'radio_opt', 2, 6, '2023-04-27 13:06:01'),
(16, 'Таны харьяалал аль хэсэгт хамаарах вэ?', '{\"XPdai\":\"Улаанбаатар\",\"taTQc\":\"Хөдөө орон нутаг\"}', 'radio_opt', 3, 6, '2023-04-27 13:06:35'),
(17, 'a', '{\"ZOyGN\":\"a\",\"RJKYr\":\"b\"}', 'radio_opt', 0, 7, '2023-04-27 13:53:36'),
(18, 'a', '{\"soyMS\":\"a\",\"SzxLX\":\"b\"}', 'check_opt', 0, 9, '2023-04-27 14:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `survey_set`
--

CREATE TABLE `survey_set` (
  `id` int(30) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `point` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_set`
--

INSERT INTO `survey_set` (`id`, `title`, `description`, `point`, `user_id`, `start_date`, `end_date`, `date_created`) VALUES
(6, 'Хэрэглэгчийн зан төлөвийн судалгаа', 'Сайн байна уу? Танд энэ өдрийн мэнд хүргэе. Та энэхүү судалгааг үнэн зөв бөглөснөөр бидний ажилд онцгой хувь нэмрээ оруулж байгаа хэрэг төдийгүй таны санал дээр тулгуурлан бид үйл ажиллагаагаа улам сайжруулан ажиллах болно.', 0, 0, '2023-04-27', '2023-04-30', '2023-04-27 12:06:49'),
(7, 't', 't', 5, 0, '2023-04-27', '2023-05-06', '2023-04-27 13:53:25'),
(8, 'b', 'point test', 0, 0, '2023-04-27', '2023-05-05', '2023-04-27 14:16:31'),
(9, 't', 't', 10, 0, '2023-04-27', '2023-05-06', '2023-04-27 14:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `total_point` int(80) UNSIGNED NOT NULL DEFAULT 0,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2 = Staff, 3= Subscriber',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `contact`, `address`, `email`, `password`, `total_point`, `type`, `date_created`) VALUES
(1, 'Altan-Ochir', 'Adiyabat', '', '96588589', 'Mongolia UB BZD 13-xoroolol', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 1, '2020-11-10 08:43:06'),
(5, 'A.', 'Altan-Ochir', '', '96588589', 'Aida 23c', 'a49201602@gmail.com', '202cb962ac59075b964b07152d234b70', 15, 2, '2023-04-25 12:52:17'),
(6, 'tests', 'test', '', '96588589', '.', 'test@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 3, '2023-04-26 18:16:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_set`
--
ALTER TABLE `survey_set`
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
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `survey_set`
--
ALTER TABLE `survey_set`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
