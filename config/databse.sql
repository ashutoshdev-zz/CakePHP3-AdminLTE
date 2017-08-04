-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 04, 2017 at 04:49 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rupak_plait`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`rupak`@`localhost` FUNCTION `get_distance_in_miles_between_geo_locations` (`geo1_latitude` DECIMAL(10,6), `geo1_longitude` DECIMAL(10,6), `geo2_latitude` DECIMAL(10,6), `geo2_longitude` DECIMAL(10,6)) RETURNS DECIMAL(10,3) BEGIN
return ((ACOS(SIN(geo1_latitude * PI() / 180) * SIN(geo2_latitude * PI() / 180) + COS(geo1_latitude * PI() / 180) * COS(geo2_latitude * PI() / 180) * COS((geo1_longitude - geo2_longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `addresstype` varchar(200) DEFAULT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address1` text,
  `city` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `zip` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `addresstype`, `first_name`, `last_name`, `email`, `phone`, `address1`, `city`, `state`, `zip`, `country`, `created`, `modified`) VALUES
(108, 135, 'Home', 'Anurag', 'Sharma', 'Anurag@avainfotech.com', '1234567890', 'net smartz house', 'chandigarh', 'chandigarh', '1453435', 'india', '2017-01-30 12:50:39', '2017-01-30 12:50:39'),
(109, 110, 'office', 'anku', 'sharma', 'Anurag@avainfotech.com', '236541789', 'it park', 'cahndigarh', 'chandigarh', '1453435', 'India', '2017-01-30 13:00:45', '2017-01-30 13:00:45'),
(110, 140, 'Home', 'Anu', 'Sh', 'anuragsharma_631@yahoo.in', '123456789', 'It park', 'Chd', '', '', 'South Africa', '2017-02-01 07:37:52', '2017-02-01 07:37:52'),
(111, 140, 'Home', 'Anu', 'G', 'anuragsharma_631@yahoo.in', '12345789', 'Nsn', 'Nens', '', '', 'South Africa', '2017-02-01 07:38:58', '2017-02-01 07:38:58'),
(104, 110, 'Home', 'ashu', 'Kr', 'ashutosh@avainfotech.com', '6464664646', 'mupulanga', 'ZA', 'ZA', '140140', 'South Africa', '2017-01-25 17:45:45', '2017-01-25 17:45:45'),
(112, 142, 'Home', 'Anurag', 'Sharma', 'nehakhanna1910@gmail.com', '1234567890', 'It park', 'Chandigarh', '', '', 'South Africa', '2017-02-02 12:09:39', '2017-02-02 12:09:39'),
(113, 110, 'Home', 'Anu', 'Sh', 'ashutosh@avainfotech.com', '1234567860', 'It', 'Chd', '', '', 'South Africa', '2017-02-02 12:42:40', '2017-02-02 12:42:40'),
(114, 139, 'Home', 'Gundo', 'Nrlw', 'mavelas@live.co.uk', '548464', 'Bdb', 'Cpt', '', '', 'South Africa', '2017-02-03 06:18:18', '2017-02-03 06:18:18'),
(115, 14, 'home', 'ashu', 'kumar', 'itsupport@paygate.co.za', '1111111111', 'dfsdf', 'sdfsdf', 'dfdsf', '160101', 'gd', '2017-02-11 10:13:01', '2017-02-11 10:13:01'),
(116, 145, 'Home', 'Anurag', 'Sharma', 'Anurag@avainfotech.com', '123456789', 'it park chandigarh', 'Chandigarh', 'Chandigarh', '123456', 'India', '2017-02-11 11:47:35', '2017-02-11 11:47:35'),
(117, 147, 'Office', 'Anu', 'Sharma', 'anucreed@gmail.com', '12345678900', 'Net snartz', 'Chd', 'Chd', '123344', 'India', '2017-02-11 12:27:54', '2017-02-11 12:27:54'),
(118, 147, 'Office', 'Anu', 'Sharma', 'anucreed@gmail.com', '12345678900', 'Net snartz', 'Chd', 'Chd', '123344', 'India', '2017-02-11 12:27:54', '2017-02-11 12:27:54'),
(119, 147, 'Office', 'Anks', 'Sharma', 'sharmaanurag118@gmail.com', '12345768900', 'Mohali', 'Punjab', 'Punjab', '1234455', 'India', '2017-02-11 12:30:48', '2017-02-11 12:30:48'),
(120, 147, 'Office', 'Anks', 'Sharma', 'sharmaanurag118@gmail.com', '12345768900', 'Mohali', 'Punjab', 'Punjab', '1234455', 'India', '2017-02-11 12:30:48', '2017-02-11 12:30:48'),
(121, 147, 'Gagaga', 'AgGg', 'Agag', 'agga@gagag.com', '4540875707', 'CGF', 'Vaga', 'Avav616w6', '61616', 'Wy6w', '2017-02-11 12:31:48', '2017-02-11 12:31:48'),
(122, 110, 'Home', 'Anku', 'Sharma', 'ashutosh@avainfotech.com', '1234567890', 'It park', 'Chandigarh', '', '', 'South Africa', '2017-02-11 12:36:39', '2017-02-11 12:36:39'),
(123, 110, 'Gzhhshsjjs', 'Test', 'Kr', 'ashutosh@avainfotech.com', '97976466467', 'Test', 'Test', '', '', 'South Africa', '2017-02-11 12:41:09', '2017-02-11 12:41:09'),
(124, 110, 'Ccccff', 'Fgg', 'Fvvv', 'ashutosh@avainfotech.com', '9999555', 'Vgg', 'Ggg', '', '', 'South Africa', '2017-02-11 12:42:57', '2017-02-11 12:42:57'),
(125, 110, 'cccccvvv', 'gvg', 'ccfg', 'ashutosh@avainfotech.com', '888085255', 'vcccc', 'ccc', '', '', 'South Africa', '2017-02-11 12:50:31', '2017-02-11 12:50:31'),
(126, 110, 'fgfdgdf', 'sdfs', 'dfsd', 'ashutosh@avainfotech.com', '334234234', 'fsdf', 'sdfds', '', '', 'South Africa', '2017-02-11 13:00:46', '2017-02-11 13:00:46'),
(127, 110, 'gfhfg', 'fgh', 'dghdhg', 'ashutosh@avainfotech.com', '54654654', 'hgh', 'ghgh', '', '', 'South Africa', '2017-02-11 13:13:25', '2017-02-11 13:13:25'),
(128, 110, 'fdg', 'dfsd', 'fsdf', 'ashutosh@avainfotech.com', '324234', 'dfsdf', 'sdfsdf', '', '', 'South Africa', '2017-02-11 13:16:32', '2017-02-11 13:16:32'),
(129, 110, 'ZvzgGgz', 'Vzbz', 'Wbhz', 'ashutosh@avainfotech.com', '9497994', 'Ghz', 'Wghz', '', '', 'South Africa', '2017-02-11 13:25:31', '2017-02-11 13:25:31'),
(130, 110, 'vzvvzvgz', 'Vhzhs', 'Aggs', 'ashutosh@avainfotech.com', '979797', 'Gggz', 'VGz', '', '', 'South Africa', '2017-02-11 13:33:37', '2017-02-11 13:33:37'),
(131, 110, 'Zvvz', 'Vsgzh', 'Agg', 'ashutosh@avainfotech.com', '97994', 'Sgg', 'Sggs', '', '', 'South Africa', '2017-02-11 13:34:46', '2017-02-11 13:34:46'),
(132, 110, 'Xccf', 'Fff', 'Dff', 'ashutosh@avainfotech.com', '588888', 'Tff', 'Fff', '', '', 'South Africa', '2017-02-11 13:37:29', '2017-02-11 13:37:29'),
(133, 110, 'Svvz', 'Bshs', 'Svvs', 'ashutosh@avainfotech.com', '94994664', 'Avvs', 'Avvs', '', '', 'South Africa', '2017-02-11 13:51:14', '2017-02-11 13:51:14'),
(134, 110, 'Fdjfdddd', 'Fgh', 'Cfg', 'ashutosh@avainfotech.com', '95658883874', 'Ffg', 'Fff', '', '', 'South Africa', '2017-02-14 12:55:20', '2017-02-14 12:55:20'),
(135, 148, 'home', 'Michael', 'Matoro', 'mulalomatoro@gmail.com', '760366511', 'Obz Square', 'Cape Town', '', '', 'South Africa', '2017-02-23 07:48:11', '2017-03-06 08:31:23'),
(136, 148, 'home', 'Michael', 'Matoro', 'mulalomatoro@gmail.com', '6179445988447', 'Dean St', 'Cape Town', '', '', 'South Africa', '2017-02-23 07:52:58', '2017-02-23 07:53:25'),
(137, 169, 'Home', 'Anu', 'Hsh', 'anurag@avainfotech.com', '12345678900', 'Ssh', 'Chandigarh', '', '', 'South Africa', '2017-03-03 10:34:08', '2017-03-03 10:34:08'),
(138, 170, 'Home', 'Anu', 'Sh', 'anurag@avainfotech.com', '1234679090', 'Boom street', 'Chandigarh', '', '', 'South Africa', '2017-03-03 10:40:41', '2017-03-03 10:40:41'),
(139, 170, 'Home', 'Anu', 'Sjsh', 'anurag@avainfotech.com', '49464948499', 'Zhb', 'Bsb', '', '', 'South Africa', '2017-03-03 10:46:51', '2017-03-03 10:46:51'),
(140, 172, 'Home', 'Abc', 'Abc', 'simerjit@futureworktechnologies.com', '1234567890', 'Abc', 'Abc', '', '', 'South Africa', '2017-03-08 11:52:07', '2017-03-08 11:52:07'),
(141, 186, 'Home', 'Abc', 'Abc', 'anuragsharma_631@yahoo.in', '123467890', 'Abc', 'Abc', '', '', 'South Africa', '2017-03-08 13:45:57', '2017-03-08 13:45:57'),
(142, 181, 'Home', 'A', 'B', 'rakhi@avainfotech.com', '122334555', 'C', 'D', '', '', 'South Africa', '2017-03-08 16:43:24', '2017-03-08 16:43:24'),
(143, 181, 'Home', 'A', 'B', 'rakhi@avainfotech.com', '51622727272772', 'C', 'D', '', '', 'South Africa', '2017-03-08 16:45:01', '2017-03-08 16:45:01'),
(144, 187, 'Home', 'A', 'B', 'samysamhum@gmail.com', '126266272727', 'C', 'D', '', '', 'South Africa', '2017-03-08 16:49:09', '2017-03-08 16:49:09'),
(145, 173, 'Apartment building', 'Gundo', 'Nelwamondo', 'mavelas@live.co.uk', '617198701', '14 cecil road', 'Cape town', '', '', 'South Africa', '2017-04-20 11:06:24', '2017-04-20 11:06:24'),
(146, 189, 'home', 'Mike', 'Matoro', 'mulalomatoro@gmail.com', '760366511', 'Haldane', 'Cape Town', '', '', 'South Africa', '2017-05-03 21:22:35', '2017-05-03 21:22:35'),
(147, 189, 'home', 'Mike', 'Mat', 'mulalomatoro@gmail.com', '760366511', 'Haldane', 'CApe Town', '', '', 'South Africa', '2017-05-03 21:28:20', '2017-05-03 21:28:20'),
(148, NULL, 'Hdbd', 'Hdhd', 'Hdhd', NULL, '617198701', 'Hdbd', 'Hdbd', '', '', 'South Africa', '2017-05-09 16:20:59', '2017-05-09 16:20:59'),
(149, 189, 'Home', 'Mike', 'Matoro', 'mulalomatoro@gmail.com', '760366511', '11 Haldane Street', 'Cape Town', '', '', 'South Africa', '2017-05-30 13:13:18', '2017-05-30 13:13:18'),
(150, 189, 'chill', 'Mike', 'Matoro', 'mulalomatoro@gmail.com', '760366511', '10 Haldane', 'Cape Town', '', '', 'South Africa', '2017-05-30 13:41:47', '2017-05-30 13:41:47'),
(151, 189, 'ggg', 'Zhang', 'egg', 'mulalomatoro@gmail.com', '44412', 'cm vh', 'fgv', '', '', 'South Africa', '2017-05-30 16:16:13', '2017-05-30 16:16:13'),
(152, NULL, 'Home', 'Thibz', 'Netsh', NULL, '83256498526664540', '123 Clifton', 'Cape Town', '', '', 'South Africa', '2017-05-31 11:00:50', '2017-05-31 11:00:50'),
(153, NULL, 'Home', 'Tsedzu', 'Netsh', NULL, '735018810', '123 Clifton cape Town', 'Yes', '', '', 'South Africa', '2017-05-31 11:02:31', '2017-05-31 11:02:31'),
(154, NULL, 'Home', 'Tsedzu', 'Netsh', NULL, '725018810', '123', 'Hahaha', '', '', 'South Africa', '2017-05-31 11:05:44', '2017-05-31 11:05:44'),
(155, 192, 'Hahffkk', 'Tsedzu', 'Netsh', 'tsedzunetsh@gmail.com', '725018810', 'Hshsf', 'Kaksgs', '', '', 'South Africa', '2017-06-13 14:36:46', '2017-06-13 14:36:46'),
(156, 192, 'Ghfsjsh', 'Hahadhs', 'Jsksg', 'tsedzunetsh@gmail.com', '8454646', 'Kajsgd', 'Lajdtsh', '', '', 'South Africa', '2017-06-15 10:56:07', '2017-06-15 10:56:07'),
(157, 189, 'Home', 'mich', 'mess', 'mulalomatoro@gmail.com', '764441174', 'gccsd street', 'Cap town', '', '', 'South Africa', '2017-06-15 10:59:43', '2017-06-15 10:59:43'),
(158, 189, 'test', 'Chris', 'smith', 'mulalomatoro@gmail.com', '779446764', 'Hollywood', 'jozi', '', '', 'South Africa', '2017-06-18 20:58:07', '2017-06-18 20:58:07'),
(159, 192, 'ssmssjf', 'ggghjf', 'vjvv', 'tsedzunetsh@gmail.com', '7603222122', 'testcity', 'test city', '', '', 'South Africa', '2017-06-19 16:28:03', '2017-06-19 16:28:03'),
(160, 192, 'eyman', 'ggghjf', 'vjvv', 'tsedzunetsh@gmail.com', '760322212', 'testcity', 'test city', '', '', 'South Africa', '2017-06-19 16:39:59', '2017-06-19 16:39:59'),
(161, 192, 'kkk', 'dm', 'msias', 'tsedzunetsh@gmail.com', '754444777', 'kik', 'kkkk', '', '', 'South Africa', '2017-06-19 17:03:44', '2017-06-19 17:03:44'),
(162, 189, 'home', 'mince', 'mance', 'mulalomatoro@gmail.com', '760479166', '23 highway', 'test city', '', '', 'South Africa', '2017-06-21 15:39:21', '2017-06-21 15:39:21'),
(163, 189, 'homi', 'Micr', 'Mad', 'mulalomatoro@gmail.com', '763221938', 'asddff', 'sjsjddd sa', '', '', 'South Africa', '2017-06-23 10:47:29', '2017-06-23 10:47:29'),
(164, 189, 'dggcgfg', 'eccs', 'ccf', 'mulalomatoro@gmail.com', '784154485', 'cvvbggf', 'Gregg', '', '', 'South Africa', '2017-06-23 11:11:55', '2017-06-23 11:11:55'),
(165, 189, 'hi', 'Joe', 'Dirt', 'mulalomatoro@gmail.com', '791946434', 'Street', 'Cape town', '', '', 'South Africa', '2017-06-23 11:26:05', '2017-06-23 11:26:05'),
(166, 189, 'joj', 'nate', 'nad', 'mulalomatoro@gmail.com', '956771467', 'make', 'mich', '', '', 'South Africa', '2017-06-23 11:31:58', '2017-06-23 11:31:58'),
(167, 189, 'ggf', 'Chuck :)', 'fhg', 'mulalomatoro@gmail.com', '854447511', 'cff', 'dfcc', '', '', 'South Africa', '2017-06-23 11:44:47', '2017-06-23 11:44:47'),
(168, 189, 'hggfr', 'dgfccf', 'rfgc', 'mulalomatoro@gmail.com', '84422254', 'dcgtg', 'ffc', '', '', 'South Africa', '2017-06-23 14:16:17', '2017-06-23 14:16:17'),
(169, 189, 'ghee', 'sfggt', 'ggccdd', 'mulalomatoro@gmail.com', '75412557', 'fgfdeeew', 'cuefs', '', '', 'South Africa', '2017-06-23 14:47:56', '2017-06-23 14:47:56'),
(170, 192, 'sfgsgsdg', 'dhdf', 'dfgdfg', 'tsedzunetsh@gmail.com', '725018810', 'dfgdffg', 'dgdfg', '', '', 'South Africa', '2017-06-23 16:54:57', '2017-06-23 16:54:57'),
(171, 189, 'home', 'ccddn', 'big sends', 'mulalomatoro@gmail.com', '9646755484', 'fake side', 'fish did', '', '', 'South Africa', '2017-06-25 11:22:45', '2017-06-25 11:22:45'),
(172, 189, 'McKee', 'send', 'send', 'mulalomatoro@gmail.com', '9764646', 'jfjffjkg', 'nifty', '', '', 'South Africa', '2017-06-25 11:52:18', '2017-06-25 11:52:18'),
(173, 189, 'demand', 'Missed', 'mcg', 'mulalomatoro@gmail.com', '797676', 'mcg', 'McCain', '', '', 'South Africa', '2017-06-26 09:36:00', '2017-06-26 09:36:00'),
(174, 192, 'hfghfg', 'nmvv', 'vvn', 'tsedzunetsh@gmail.com', '25866548', 'bnvb', 'nvnv', '', '', 'South Africa', '2017-06-26 10:15:21', '2017-06-26 10:15:21'),
(175, 192, 'hfgghfhg', 'fghgf', 'gfhgf', 'tsedzunetsh@gmail.com', '5698545', 'gfhgf', 'gfhfgh', '', '', 'South Africa', '2017-06-26 11:03:30', '2017-06-26 11:03:30'),
(176, 192, 'dfsfsdf', 'fghfgh', 'sdfsdf', 'tsedzunetsh@gmail.com', '45455454', 'ghhf', 'fgh', '', '', 'South Africa', '2017-06-26 11:04:04', '2017-06-26 11:04:04'),
(177, 192, 'gfdgdfg', 'fgfgf', 'fggf', 'tsedzunetsh@gmail.com', '5656568', 'gfgfg', 'fgfgfg', '', '', 'South Africa', '2017-06-26 11:05:04', '2017-06-26 11:05:04'),
(178, 189, 'this', 'dang', 'Ellen', 'mulalomatoro@gmail.com', '9864646', 'kfb', 'McKee', '', '', 'South Africa', '2017-06-26 11:05:43', '2017-06-26 11:05:43'),
(179, 189, 'kind', 'cnxn', 'nfn', 'mulalomatoro@gmail.com', '797667', 'kn', 'nnxc', '', '', 'South Africa', '2017-06-26 12:24:10', '2017-06-26 12:24:10'),
(180, 189, 'home', 'conch', 'and', 'mulalomatoro@gmail.com', '794646469', 'judge', 'mcg.', '', '', 'South Africa', '2017-06-26 13:35:24', '2017-06-26 13:35:24'),
(181, 189, 'bud', 'nd', 'me', 'mulalomatoro@gmail.com', '49949', 'nd', 'send.', '', '', 'South Africa', '2017-06-26 14:53:29', '2017-06-26 14:53:29'),
(182, 189, 'home', 'mcg.', 'nd', 'mulalomatoro@gmail.com', '7979799', 'munch', 'Judd', '', '', 'South Africa', '2017-06-26 15:06:50', '2017-06-26 15:06:50'),
(183, 192, 'hdjdgsu', 'hhdhs', 'kahdyy', 'tsedzunetsh@gmail.com', '5643256', 'nd gfs ja', 'bdgd', '', '', 'South Africa', '2017-06-27 15:00:15', '2017-06-27 15:00:15'),
(184, 192, 'him', 'Eric.', 'Stev', 'tsedzunetsh@gmail.com', '799797', 'cmccnnd', 'music', '', '', 'South Africa', '2017-06-28 10:34:21', '2017-06-28 10:34:21'),
(185, 189, 'krnefn', 'mg9di', 'bjgdj', 'mulalomatoro@gmail.com', '494944', 'jfjv d', 'fvidf', '', '', 'South Africa', '2017-06-28 10:40:10', '2017-06-28 10:40:10'),
(186, 189, 'bjbbj', 'mich', 'mizl', 'mulalomatoro@gmail.com', '7484993', 'goid', 'loko', '', '', 'South Africa', '2017-06-28 10:54:31', '2017-06-28 10:54:31'),
(187, 189, 'c', 'me f', 'mcg', 'mulalomatoro@gmail.com', '4466760', 'kind', 'McManus.', '', '', 'South Africa', '2017-06-28 11:05:44', '2017-06-28 11:05:44'),
(188, 189, 'mesH', ',send', 'Judd.', 'mulalomatoro@gmail.com', '87970', 'zzz.', 'gnome', '', '', 'South Africa', '2017-06-28 11:11:28', '2017-06-28 11:11:28'),
(189, 189, 'butt', 'big', 'Friedberg', 'mulalomatoro@gmail.com', '8548', 'f2f g', 'bud', '', '', 'South Africa', '2017-06-28 11:35:45', '2017-06-28 11:35:45'),
(190, 189, 'home', 'chat', 'Chung', 'mulalomatoro@gmail.com', '7577', 'avg', 'bud', '', '', 'South Africa', '2017-06-28 12:41:33', '2017-06-28 12:41:33'),
(191, 189, 'Glenn', 'CNN', 'kcjcb', 'mulalomatoro@gmail.com', '7967765', 'worthy', 'with.', '', '', 'South Africa', '2017-06-28 13:05:24', '2017-06-28 13:05:24'),
(192, 189, 'Chung', 'huh', 'argh', 'mulalomatoro@gmail.com', '884425', 'Hutchinson', 'fgfv', '', '', 'South Africa', '2017-06-28 13:23:39', '2017-06-28 13:23:39'),
(193, 189, 'Gregg as', 'mcg', 'f2f', 'mulalomatoro@gmail.com', '89514724', 'but', 'ghee', '', '', 'South Africa', '2017-06-28 15:55:51', '2017-06-28 15:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `alergies`
--

CREATE TABLE `alergies` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `about` text,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alergies`
--

INSERT INTO `alergies` (`id`, `name`, `about`, `created`, `modified`) VALUES
(17, 'Glueten1', 'Gluten is a general name for the proteins found in wheat (wheatberries, durum, emmer, semolina, spelt, farina, farro, graham, KAMUT® khorasan wheat and einkorn), rye, barley and triticale – a cross between wheat and rye. Gluten helps foods maintain their shape, acting as a glue that holds food together.', '2016-12-21 07:04:11', '2017-03-08 09:16:03'),
(18, 'Nuts and Glory', 'A nut is a fruit composed of a hard shell and a seed, which is generally edible.l context, however, a wide variety of dried seeds are called nuts', '2016-12-21 07:04:45', '2017-03-08 13:07:03'),
(19, 'Eggs', 'Eggs are laid by female animals of many different species, including birds, reptiles, amphibians, mammals, and fish, and have been eaten by humans for thousands of years.[1] Bird and reptile eggs consist of a protective eggshell, albumen (egg white), and vitellus (egg yolk), contained within various thin membranes. The most popular choice for egg consumption are chicken eggs. Other popular choices for egg consumption are duck, quail, roe, and caviar.', '2016-12-21 07:05:31', '2016-12-21 07:05:31'),
(20, 'Lactose', 'Lactose is a disaccharide sugar composed of galactose and glucose that is found in milk. Lactose makes up around 2–8% of milk (by weight),[3] although the amount varies among species and individuals, and milk with a reduced amount of lactose also exists. It is extracted from sweet or sour whey. The name comes from lac (gen. lactis), the Latin word for milk, plus the -ose ending used to name sugars.[4] It has a formula of C12H22O11 and the hydrate formula C12H22O11·H2O, making it an isomer of sucrose.', '2016-12-21 07:06:41', '2016-12-21 07:06:41'),
(21, 'Tree nuts', 'Almonds, beechnut, Brazil nut, butternut, cashew, chestnut\r\nChinquapin, coconut, gianduja, ginkgo nut, hazelnut, hickory nut, cashew nut', '2017-01-28 10:53:49', '2017-03-09 22:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `asso_categories`
--

CREATE TABLE `asso_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asso_categories`
--

INSERT INTO `asso_categories` (`id`, `name`, `user_id`, `created`, `modified`) VALUES
(2, 'Spices', 0, '2016-12-30 06:32:05', '2016-12-30 06:32:05'),
(3, 'Meat', 0, '2016-12-30 06:32:46', '2016-12-30 06:32:46'),
(4, 'Rice', 0, '2016-12-30 06:32:55', '2016-12-30 06:32:55'),
(5, 'Sauce', 0, '2017-01-28 10:55:39', '2017-01-28 10:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `asso_products`
--

CREATE TABLE `asso_products` (
  `id` int(11) NOT NULL,
  `asso_category_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asso_products`
--

INSERT INTO `asso_products` (`id`, `asso_category_id`, `name`, `description`, `image`, `user_id`, `created`, `modified`) VALUES
(1, 2, 'Cloves1', 'Cloves are the aromatic flower buds of a tree in the family Myrtaceae.', 'Desert.jpg', 0, '2016-12-30 07:02:28', '2017-03-08 09:15:30'),
(2, 2, 'Black Pepper', 'Black pepper (Piper nigrum) is a flowering vine in the family Piperaceae.', 'pepper.jpg', 0, '2016-12-30 07:03:11', '2016-12-30 07:30:04'),
(3, 2, 'Dal Chinni', 'Benefits of Cinnamon Herb gives a very good taste and flavor to dishes.', 'dalchinni.jpg', 0, '2016-12-30 07:04:17', '2016-12-30 07:30:36'),
(4, 3, 'Ribs', 'ribs', 'ribs.jpg', 0, '2016-12-30 07:06:00', '2016-12-30 07:06:00'),
(5, 3, 'leg piece', 'leg piece', 'leg.jpg', 0, '2016-12-30 07:06:41', '2016-12-30 07:06:41'),
(6, 3, 'Beef', 'beef', 'beef.jpg', 0, '2016-12-30 07:07:00', '2016-12-30 07:07:00'),
(7, 4, 'Peru', 'peru', 'peru.jpg', 0, '2016-12-30 07:07:19', '2016-12-30 07:07:19'),
(8, 4, 'Thai', 'thai', 'thai.jpg', 0, '2016-12-30 07:07:48', '2016-12-30 07:07:48'),
(9, 4, 'indian', 'indian', 'indian.jpg', 0, '2016-12-30 07:08:16', '2016-12-30 07:08:16'),
(10, 5, 'Sauce', 'Almonds, beechnut, Brazil nut, butternut, cashew, chestnut Chinquapin, coconut, gianduja, ginkgo nut, hazelnut, hickory nut', 'images 1.jpg', 0, '2017-01-28 10:56:10', '2017-01-28 10:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `subtotal` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscription_plans_id` int(11) DEFAULT NULL,
  `total` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pcode` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `uid`, `subtotal`, `subscription_plans_id`, `total`, `pcode`, `created`, `modified`) VALUES
(18, 145, '949', 1, '999', 'CHD5', '2017-02-11 10:52:25', '2017-02-11 10:56:58'),
(19, 147, '999', 1, '999', '', '2017-02-11 12:09:00', '2017-02-11 12:09:00'),
(43, 110, '10', 3, '10', '', '2017-02-27 11:56:26', '2017-02-27 11:56:26'),
(44, 156, '9', 3, '10', 'ANU07', '2017-03-02 07:12:29', '2017-03-02 07:25:16'),
(45, 14, '9', 3, '10', 'IND10', '2017-03-02 07:36:38', '2017-03-02 07:37:32'),
(46, 169, '9', 3, '10', 'IND10', '2017-03-03 10:32:11', '2017-03-03 10:33:41'),
(48, 170, '10', 3, '10', NULL, '2017-03-03 10:46:35', '2017-03-03 10:46:35'),
(54, 172, '10', 3, '10', NULL, '2017-03-08 11:51:48', '2017-03-08 11:51:48'),
(55, 186, '10', 3, '10', NULL, '2017-03-08 13:45:38', '2017-03-08 13:45:38'),
(57, 181, '0', 1, '0', NULL, '2017-03-08 16:44:36', '2017-03-08 16:44:36'),
(58, 187, '10', 3, '10', NULL, '2017-03-08 16:48:48', '2017-03-08 16:48:48'),
(60, 5, '10', 3, '10', '', '2017-04-19 10:20:00', '2017-04-19 10:20:00'),
(62, 173, '0', 2, '0', NULL, '2017-04-20 11:08:40', '2017-04-20 11:08:40'),
(68, 191, '0', 2, '0', NULL, '2017-06-13 14:15:52', '2017-06-13 14:15:52'),
(117, 192, '0', 2, '0', NULL, '2017-06-28 10:36:51', '2017-06-28 10:36:51'),
(126, 189, '0', 1, '0', NULL, '2017-06-28 15:55:26', '2017-06-28 15:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_main` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created`, `modified`, `is_main`) VALUES
(8, 'Lunch', 0, '2016-12-21 07:20:49', '2017-01-05 20:13:58', 0),
(9, 'Dinner', 0, '2016-12-21 07:21:11', '2017-01-05 20:14:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Sunday', '2016-12-19 11:19:17', '2016-12-21 06:55:41'),
(2, 'Monday', '2016-12-21 06:56:12', '2016-12-21 06:56:12'),
(3, 'Tuesday', '2016-12-21 06:56:37', '2016-12-21 06:56:37'),
(4, 'Wednesday', '2016-12-21 06:56:58', '2016-12-21 06:56:58'),
(5, 'Thursday', '2016-12-21 06:57:22', '2016-12-21 06:57:22'),
(6, 'Friday', '2016-12-21 06:57:41', '2016-12-21 06:57:41'),
(7, 'Saturday', '2016-12-21 06:58:05', '2016-12-21 06:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `address_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP,
  `delivery_status` int(11) DEFAULT NULL COMMENT '(0=pending,1=confirm,2=cancel)',
  `is_active` int(11) DEFAULT NULL,
  `enddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `ip_address`, `created`, `address_id`, `plan_id`, `modified`, `delivery_status`, `is_active`, `enddate`) VALUES
(49, 110, '122.160.44.93', '2017-01-30 09:59:47', 0, 2, '2017-01-30 09:59:47', 0, 1, '2017-02-06 00:00:00'),
(50, 110, '122.160.44.93', '2017-01-30 10:35:47', 0, 1, '2017-01-30 10:35:47', 0, 1, '2017-02-06 00:00:00'),
(51, 135, '122.160.12.89', '2017-01-30 12:39:54', 0, 2, '2017-01-30 12:39:54', 0, 1, '2017-02-06 00:00:00'),
(52, 135, '122.160.12.89', '2017-01-30 13:22:31', 0, 1, '2017-01-30 13:22:31', 0, 1, '2017-02-06 00:00:00'),
(53, 136, '122.160.12.89', '2017-01-30 13:44:13', 0, 2, '2017-01-30 13:44:13', 0, 1, '2017-02-06 00:00:00'),
(54, 110, '122.160.44.93', '2017-01-31 15:30:56', 0, 2, '2017-01-31 15:30:56', 0, 1, '2017-02-07 00:00:00'),
(55, 140, '122.160.44.93', '2017-02-01 07:41:06', 0, 2, '2017-02-01 07:41:06', 0, 1, '2017-02-08 00:00:00'),
(56, 142, '122.160.44.93', '2017-02-02 12:11:39', 0, 2, '2017-02-02 12:11:39', 0, 1, '2017-02-09 00:00:00'),
(57, 110, '122.160.44.93', '2017-02-02 12:44:50', 0, 1, '2017-02-02 12:44:50', 0, 1, '2017-02-09 00:00:00'),
(58, 139, '105.12.168.246', '2017-02-03 06:21:12', 0, 2, '2017-02-03 06:21:12', 0, 1, '2017-02-10 00:00:00'),
(59, 14, '122.160.12.89', '2017-02-11 10:11:37', 0, 1, '2017-02-11 10:11:37', 0, 1, '2017-02-18 00:00:00'),
(60, 145, '122.160.12.89', '2017-02-11 10:30:55', 0, 2, '2017-02-11 10:30:55', 0, 1, '2017-02-18 00:00:00'),
(61, 145, '122.160.12.89', '2017-02-11 11:43:33', 0, 1, '2017-02-11 11:43:33', 0, 1, '2017-02-18 00:00:00'),
(62, 147, '64.233.173.12', '2017-02-11 12:12:30', 0, 1, '2017-02-11 12:12:30', 0, 1, '2017-02-18 00:00:00'),
(63, 110, '169.149.135.172', '2017-02-11 13:52:48', 0, 2, '2017-02-11 13:52:48', 0, 1, '2017-02-18 00:00:00'),
(64, 110, '122.160.44.93', '2017-02-27 11:58:35', 0, 3, '2017-02-27 11:58:35', 0, 1, '2017-03-06 00:00:00'),
(65, 170, '169.149.130.190', '2017-03-03 10:48:30', 0, 3, '2017-03-03 10:48:30', 0, 1, '2017-03-10 00:00:00'),
(66, 172, '169.149.134.171', '2017-03-08 11:55:22', 0, 3, '2017-03-08 11:55:22', 0, 1, '2017-03-15 00:00:00'),
(67, 184, '122.160.44.93', '2017-03-08 12:36:22', 0, 3, '2017-03-08 12:36:22', 0, 1, '2017-03-15 00:00:00'),
(68, 186, '169.149.133.77', '2017-03-08 13:48:30', 0, 3, '2017-03-08 13:48:30', 0, 1, '2017-03-15 00:00:00'),
(69, 187, '122.160.44.93', '2017-03-08 16:51:09', 0, 3, '2017-03-08 16:51:09', 0, 1, '2017-03-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `dayname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `foodtime` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `alergy_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cfood_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dl_status` int(11) DEFAULT NULL COMMENT '0=pending,1=confirm,2=deliver',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `checksum_id` text,
  `txn_id` varchar(250) DEFAULT NULL COMMENT 'PAY_REQUEST_ID',
  `amt` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_histories`
--

INSERT INTO `payment_histories` (`id`, `cart_id`, `uid`, `checksum_id`, `txn_id`, `amt`, `status`, `created`, `modified`) VALUES
(3, 12, 145, NULL, 'A6B29D82-9ECB-495A-B992-F924CF152A36', '142400', NULL, '2017-02-11 03:24:56', '2017-02-11 03:24:56'),
(2, 11, 14, '9a03b8df29b2a84f2440e50c6b711056', '793D6B66-4A88-4BA1-9E5C-118B958D4509', '99900', 1, '2017-02-11 09:45:39', '2017-02-11 09:45:39'),
(4, 13, 145, '6c54a44b4eecdd4800e218d42f44e6b1', 'B95943DF-896A-4776-BDAF-D0F60D7BEECC', '149900', 1, '2017-02-11 10:26:58', '2017-02-11 10:26:58'),
(5, 18, 145, '0699506d0fd1b0b9a00cdfc733429751', '0ACD711E-5E10-4449-A7C9-89B1EAEA26B8', '94900', 1, '2017-02-11 11:36:35', '2017-02-11 11:36:35'),
(6, 19, 147, 'bf932fd25fab20656054c1df37cd68ba', 'BB4DE27D-B532-4B9D-8A73-98691C325E1D', '99900', 1, '2017-02-11 12:11:48', '2017-02-11 12:11:48'),
(7, 24, 110, NULL, '5748D6CA-8017-43B5-B4FD-4F40A0C33160', '149900', NULL, '2017-02-11 05:59:16', '2017-02-11 05:59:16'),
(8, 28, 110, '06e24f16fedd59a643da2ccbcdb9ef1b', 'F6FE7D41-B4B9-4DFC-A935-0EB7DEF8FA53', '149900', 1, '2017-02-11 13:29:19', '2017-02-11 13:29:19'),
(9, 31, 110, '252e32f9f665985855659e43293b074f', 'FCC0892C-BE03-40B7-9277-598BA1D683F4', '149900', 1, '2017-02-11 13:35:52', '2017-02-11 13:35:52'),
(10, 32, 110, NULL, '9BFCD00F-9125-4F11-B189-E6F3F1576042', '149900', NULL, '2017-02-11 06:37:42', '2017-02-11 06:37:42'),
(11, 34, 110, 'a14598471bc5bdcdf0898438fd98b6d1', '643B01B6-AE82-41AF-926B-DA0C68BBC024', '149900', 1, '2017-02-11 13:52:35', '2017-02-11 13:52:35'),
(12, 40, 110, NULL, '9363B906-B198-4A56-92B9-7559E5CD18C4', '99900', NULL, '2017-02-14 05:55:41', '2017-02-14 05:55:41'),
(13, 43, 110, '4fba9060c9542c72ec78baf133aa2e07', '8F4A73A7-D85E-40B7-B062-B7FC21872709', '1000', 1, '2017-02-27 11:57:52', '2017-02-27 11:57:52'),
(14, 44, 156, NULL, '92E8A649-902F-475D-ABFC-C2251042A223', '900', NULL, '2017-03-02 00:25:47', '2017-03-02 00:25:47'),
(15, 45, 14, NULL, '565A24AB-A3F5-407D-A000-8A770DB0423A', '900', NULL, '2017-03-02 00:37:45', '2017-03-02 00:37:45'),
(16, 46, 169, '0a18887051e0508a740645d0b7916d6b', 'AC97CC2C-60A2-4E7C-9D3B-627BD214EBF5', '900', 1, '2017-03-03 10:36:53', '2017-03-03 10:36:53'),
(17, 47, 170, '8feb0bda195b89ecb60aec4497419968', '759069C9-7266-435B-AC5E-4E837DDC9631', '1000', 1, '2017-03-03 10:41:53', '2017-03-03 10:41:53'),
(18, 48, 170, '4583599334a57ee4f4f8c1ea4021b946', '78682141-70CC-4BE7-85BA-EFAA01B43414', '1000', 1, '2017-03-03 10:48:20', '2017-03-03 10:48:20'),
(19, 54, 172, '94d4900ff55aff993efa0dd54594b951', '73348412-4600-4C34-B9B1-87F24568021F', '1000', 1, '2017-03-08 11:53:31', '2017-03-08 11:53:31'),
(20, 55, 186, '80a745c450026eb0ea2776e40ff95ae3', 'CF33D04A-0B4A-4EE3-8811-248D5FED5FDA', '1000', 1, '2017-03-08 13:48:05', '2017-03-08 13:48:06'),
(21, 58, 187, '7f8bc2add970c0128b477ea1236f36cd', '3808B9C0-3A93-4BDE-95E5-B35BB6942CFA', '1000', 1, '2017-03-08 16:50:51', '2017-03-08 16:50:51'),
(22, 111, 189, 'fc6fd23db980cb9aff871e9720d19bb6', '86B79758-153F-4BBE-A4E1-B874A8027798', '400', 1, '2017-06-26 15:55:00', '2017-06-26 15:55:00'),
(23, 112, 192, 'b65ab070338163cf17c2f14c4a30dca3', '666E91B1-5AE2-4A7D-A350-4C7B8D2823D1', '400', 1, '2017-06-27 15:05:42', '2017-06-27 15:05:42'),
(24, 116, 192, '6992aa8e0eafe8e2afecd4013779c3ef', 'E37C1EF5-F574-4411-8C0E-075EA35C6521', '400', 1, '2017-06-28 10:36:24', '2017-06-28 10:36:24'),
(25, 120, 189, '87d6d074415c4ca9734a2deb8ccdca70', '11C781C7-5EBF-4032-9DCB-FCADFE08490D', '400', 1, '2017-06-28 11:07:28', '2017-06-28 11:07:28'),
(26, 121, 189, '938d639b8d772d6c43f63ba7238ff5a3', '5F8E820E-0312-41BC-BE67-4BB5352E34D1', '400', 1, '2017-06-28 11:12:43', '2017-06-28 11:12:43'),
(27, 122, 189, '6770a55fad9e0beb9a6ba30b093b8a85', '7A450BBA-6F78-4E5F-8286-B86DF6FE2D87', '400', 1, '2017-06-28 11:41:44', '2017-06-28 11:41:44'),
(28, 123, 189, '634df224440169648e9f88dc703ae0c6', '9414E499-36DE-4060-B95C-C60718DBFB05', '650', 1, '2017-06-28 12:43:09', '2017-06-28 12:43:09'),
(29, 124, 189, 'a89f649c157e9acf8d0e2835fddbf39d', '3493C541-148A-4E53-A296-3AB3DE462DE0', '650', 1, '2017-06-28 13:08:32', '2017-06-28 13:08:32'),
(30, 125, 189, '5b29933d3493452b066c59bbf518eee3', '9BFB81A4-14BA-4F22-80C8-A13250BA5C0E', '650', 1, '2017-06-28 13:25:01', '2017-06-28 13:25:01'),
(31, 126, 189, '17ac2abb64e361867a827ccc9cfeec9d', '5EC471F3-A7B0-41A9-9ED9-B84DF4951927', '650', 1, '2017-06-28 16:00:15', '2017-06-28 16:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `image` varchar(250) DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL,
  `subscription_plan_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `alergy_id` text,
  `assopro_id` text,
  `day_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `old_subcategory_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `calorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `available_quantity`, `subscription_plan_id`, `user_id`, `alergy_id`, `assopro_id`, `day_id`, `category_id`, `old_subcategory_id`, `created`, `modified`, `calorie`) VALUES
(2, 'Malva pudding1', 'Malva pudding is a sweet pudding of Cape Dutch origin. It contains apricot jam and has a spongy caramelized texture. A cream sauce is often poured over it while it is hot, and it is usually served hot with custard and/or ice-cream', 'malva_pudding.jpg', 34, 1, 5, 'a:2:{i:0;s:2:\"18\";i:1;s:2:\"19\";}', 'a:3:{i:0;s:1:\"9\";i:1;s:2:\"10\";i:2;s:2:\"11\";}', 4, 9, 2, '2016-12-21 07:23:20', '2017-03-08 13:04:41', 3000),
(3, 'Cape Malay curry', 'This distinctive and tasty authentic curry relies heavily on the special blend of spices, known as Cape Malay curry powder. Cape Malay curries are famous for their fruity and full-bodied flavours, making good use of local colourful vegetables or meat and fish, they are not as hot as the curries used in the Indian kitchen. This \"secret\" recipe hails from one of the steamy kitchens in the vibrant Bo-Kaap area of Cape Town; it was on a recipe sheet given to my mum from a spice shop in that wonderful area, in the 1950\'s. The Bo-Kaap area is a treat; the houses are painted gorgeous bright colours that won\'t fail to make you smile, there are always children playing in the streets and the haunting call of the muezzin will remind you of exotic destinations such as Istanbul and Cairo. And then there\'s the smell of spices that wafts through open doorways and comes rushing out at you as you walk past Atlas Trading, the local spice emporium. You might be just minutes from the centre of elegant and sophisticated Cape Town, but you\'ll feel as though you\'re in a different country. Serve this curry with yellow rice and a variety of sambals and atjars.', 'cape_malay_curry.jpg', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 3, 9, 3, '2016-12-21 07:23:20', '2016-12-30 10:40:27', 400),
(5, 'Cape Malay curry', 'This distinctive and tasty authentic curry relies heavily on the special blend of spices, known as Cape Malay curry powder. Cape Malay curries are famous for their fruity and full-bodied flavours, making good use of local colourful vegetables or meat and fish, they are not as hot as the curries used in the Indian kitchen. This \"secret\" recipe hails from one of the steamy kitchens in the vibrant Bo-Kaap area of Cape Town; it was on a recipe sheet given to my mum from a spice shop in that wonderful area, in the 1950\'s. The Bo-Kaap area is a treat; the houses are painted gorgeous bright colours that won\'t fail to make you smile, there are always children playing in the streets and the haunting call of the muezzin will remind you of exotic destinations such as Istanbul and Cairo. And then there\'s the smell of spices that wafts through open doorways and comes rushing out at you as you walk past Atlas Trading, the local spice emporium. You might be just minutes from the centre of elegant and sophisticated Cape Town, but you\'ll feel as though you\'re in a different country. Serve this curry with yellow rice and a variety of sambals and atjars.', 'cape_malay_curry.jpg', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 5, 9, 3, '2016-12-21 07:23:20', '2016-12-21 07:23:20', 400),
(6, 'Cape Malay curry', 'This distinctive and tasty authentic curry relies heavily on the special blend of spices, known as Cape Malay curry powder. Cape Malay curries are famous for their fruity and full-bodied flavours, making good use of local colourful vegetables or meat and fish, they are not as hot as the curries used in the Indian kitchen. This \"secret\" recipe hails from one of the steamy kitchens in the vibrant Bo-Kaap area of Cape Town; it was on a recipe sheet given to my mum from a spice shop in that wonderful area, in the 1950\'s. The Bo-Kaap area is a treat; the houses are painted gorgeous bright colours that won\'t fail to make you smile, there are always children playing in the streets and the haunting call of the muezzin will remind you of exotic destinations such as Istanbul and Cairo. And then there\'s the smell of spices that wafts through open doorways and comes rushing out at you as you walk past Atlas Trading, the local spice emporium. You might be just minutes from the centre of elegant and sophisticated Cape Town, but you\'ll feel as though you\'re in a different country. Serve this curry with yellow rice and a variety of sambals and atjars.', 'cape_malay_curry.jpg', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 6, 9, 3, '2016-12-21 07:23:20', '2016-12-21 07:23:20', 400),
(17, 'Amarula Don Pedro', 'This cocktail-come-dessert uses South African Amarula, a cream liqueur made from the indigenous marula fruit, blended with ice cream. Find it in every bar or take a bottle of Amarula home from duty-free to make your own!', 'amarula.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 1, 9, 2, '2016-12-21 07:23:20', '2016-12-30 10:44:29', 425),
(18, 'Amarula Don Pedro', 'This cocktail-come-dessert uses South African Amarula, a cream liqueur made from the indigenous marula fruit, blended with ice cream. Find it in every bar or take a bottle of Amarula home from duty-free to make your own!', 'amarula.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 2, 9, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 425),
(19, 'Amarula Don Pedro', 'This cocktail-come-dessert uses South African Amarula, a cream liqueur made from the indigenous marula fruit, blended with ice cream. Find it in every bar or take a bottle of Amarula home from duty-free to make your own!', 'amarula.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 3, 9, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 425),
(20, 'Amarula Don Pedro', 'This cocktail-come-dessert uses South African Amarula, a cream liqueur made from the indigenous marula fruit, blended with ice cream. Find it in every bar or take a bottle of Amarula home from duty-free to make your own!', 'amarula.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 4, 9, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 425),
(21, 'Amarula Don Pedro', 'This cocktail-come-dessert uses South African Amarula, a cream liqueur made from the indigenous marula fruit, blended with ice cream. Find it in every bar or take a bottle of Amarula home from duty-free to make your own!', 'amarula.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 7, 9, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 425),
(25, 'Bobotie', 'Another dish thought to have been brought to South Africa by Asian settlers, bobotie is now the national dish of the country and cooked in many homes and restaurants. Minced meat is simmered with spices, usually curry powder, herbs and dried fruit, then topped with a mixture of egg and milk and baked until set.', 'bobotie.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 1, 9, 2, '2016-12-21 07:23:20', '2016-12-30 10:44:50', 555),
(26, 'Bobotie', 'Another dish thought to have been brought to South Africa by Asian settlers, bobotie is now the national dish of the country and cooked in many homes and restaurants. Minced meat is simmered with spices, usually curry powder, herbs and dried fruit, then topped with a mixture of egg and milk and baked until set.', 'bobotie.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 3, 9, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 555),
(27, 'Bobotie', 'Another dish thought to have been brought to South Africa by Asian settlers, bobotie is now the national dish of the country and cooked in many homes and restaurants. Minced meat is simmered with spices, usually curry powder, herbs and dried fruit, then topped with a mixture of egg and milk and baked until set.', 'bobotie.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 4, 9, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 555),
(29, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 1, 9, 2, '2016-12-21 07:23:20', '2016-12-30 10:45:29', 350),
(30, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 3, 9, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 350),
(31, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 6, 9, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 350),
(32, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 7, 9, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 350),
(36, 'Cape Malay curry', 'This distinctive and tasty authentic curry relies heavily on the special blend of spices, known as Cape Malay curry powder. Cape Malay curries are famous for their fruity and full-bodied flavours, making good use of local colourful vegetables or meat and fish, they are not as hot as the curries used in the Indian kitchen. This \"secret\" recipe hails from one of the steamy kitchens in the vibrant Bo-Kaap area of Cape Town; it was on a recipe sheet given to my mum from a spice shop in that wonderful area, in the 1950\'s. The Bo-Kaap area is a treat; the houses are painted gorgeous bright colours that won\'t fail to make you smile, there are always children playing in the streets and the haunting call of the muezzin will remind you of exotic destinations such as Istanbul and Cairo. And then there\'s the smell of spices that wafts through open doorways and comes rushing out at you as you walk past Atlas Trading, the local spice emporium. You might be just minutes from the centre of elegant and sophisticated Cape Town, but you\'ll feel as though you\'re in a different country. Serve this curry with yellow rice and a variety of sambals and atjars.', 'cape_malay_curry.jpg', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 1, 8, 3, '2016-12-21 07:23:20', '2016-12-21 07:23:20', 400),
(37, 'Malva pudding', 'Malva pudding is a sweet pudding of Cape Dutch origin. It contains apricot jam and has a spongy caramelized texture. A cream sauce is often poured over it while it is hot, and it is usually served hot with custard and/or ice-cream', 'malva_pudding.jpg', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 2, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 300),
(38, 'Cape Malay curry', 'This distinctive and tasty authentic curry relies heavily on the special blend of spices, known as Cape Malay curry powder. Cape Malay curries are famous for their fruity and full-bodied flavours, making good use of local colourful vegetables or meat and fish, they are not as hot as the curries used in the Indian kitchen. This \"secret\" recipe hails from one of the steamy kitchens in the vibrant Bo-Kaap area of Cape Town; it was on a recipe sheet given to my mum from a spice shop in that wonderful area, in the 1950\'s. The Bo-Kaap area is a treat; the houses are painted gorgeous bright colours that won\'t fail to make you smile, there are always children playing in the streets and the haunting call of the muezzin will remind you of exotic destinations such as Istanbul and Cairo. And then there\'s the smell of spices that wafts through open doorways and comes rushing out at you as you walk past Atlas Trading, the local spice emporium. You might be just minutes from the centre of elegant and sophisticated Cape Town, but you\'ll feel as though you\'re in a different country. Serve this curry with yellow rice and a variety of sambals and atjars.', 'cape_malay_curry.jpg', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 3, 8, 3, '2016-12-21 07:23:20', '2016-12-21 07:23:20', 400),
(39, 'Cape Malay curry', 'This distinctive and tasty authentic curry relies heavily on the special blend of spices, known as Cape Malay curry powder. Cape Malay curries are famous for their fruity and full-bodied flavours, making good use of local colourful vegetables or meat and fish, they are not as hot as the curries used in the Indian kitchen. This \"secret\" recipe hails from one of the steamy kitchens in the vibrant Bo-Kaap area of Cape Town; it was on a recipe sheet given to my mum from a spice shop in that wonderful area, in the 1950\'s. The Bo-Kaap area is a treat; the houses are painted gorgeous bright colours that won\'t fail to make you smile, there are always children playing in the streets and the haunting call of the muezzin will remind you of exotic destinations such as Istanbul and Cairo. And then there\'s the smell of spices that wafts through open doorways and comes rushing out at you as you walk past Atlas Trading, the local spice emporium. You might be just minutes from the centre of elegant and sophisticated Cape Town, but you\'ll feel as though you\'re in a different country. Serve this curry with yellow rice and a variety of sambals and atjars.', 'cape_malay_curry.jpg', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 5, 8, 3, '2016-12-21 07:23:20', '2016-12-21 07:23:20', 400),
(40, 'Cape Malay curry', 'This distinctive and tasty authentic curry relies heavily on the special blend of spices, known as Cape Malay curry powder. Cape Malay curries are famous for their fruity and full-bodied flavours, making good use of local colourful vegetables or meat and fish, they are not as hot as the curries used in the Indian kitchen. This \"secret\" recipe hails from one of the steamy kitchens in the vibrant Bo-Kaap area of Cape Town; it was on a recipe sheet given to my mum from a spice shop in that wonderful area, in the 1950\'s. The Bo-Kaap area is a treat; the houses are painted gorgeous bright colours that won\'t fail to make you smile, there are always children playing in the streets and the haunting call of the muezzin will remind you of exotic destinations such as Istanbul and Cairo. And then there\'s the smell of spices that wafts through open doorways and comes rushing out at you as you walk past Atlas Trading, the local spice emporium. You might be just minutes from the centre of elegant and sophisticated Cape Town, but you\'ll feel as though you\'re in a different country. Serve this curry with yellow rice and a variety of sambals and atjars.', 'cape_malay_curry.jpg', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 6, 8, 3, '2016-12-21 07:23:20', '2016-12-21 07:23:20', 400),
(41, 'Cape Malay curry', 'This distinctive and tasty authentic curry relies heavily on the special blend of spices, known as Cape Malay curry powder. Cape Malay curries are famous for their fruity and full-bodied flavours, making good use of local colourful vegetables or meat and fish, they are not as hot as the curries used in the Indian kitchen. This \"secret\" recipe hails from one of the steamy kitchens in the vibrant Bo-Kaap area of Cape Town; it was on a recipe sheet given to my mum from a spice shop in that wonderful area, in the 1950\'s. The Bo-Kaap area is a treat; the houses are painted gorgeous bright colours that won\'t fail to make you smile, there are always children playing in the streets and the haunting call of the muezzin will remind you of exotic destinations such as Istanbul and Cairo. And then there\'s the smell of spices that wafts through open doorways and comes rushing out at you as you walk past Atlas Trading, the local spice emporium. You might be just minutes from the centre of elegant and sophisticated Cape Town, but you\'ll feel as though you\'re in a different country. Serve this curry with yellow rice and a variety of sambals and atjars.', 'cape_malay_curry.jpg', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 7, 9, 4, '2016-12-21 07:23:20', '2016-12-21 07:23:20', 400),
(42, 'Malva pudding', 'Malva pudding is a sweet pudding of Cape Dutch origin. It contains apricot jam and has a spongy caramelized texture. A cream sauce is often poured over it while it is hot, and it is usually served hot with custard and/or ice-cream', 'malva_pudding.jpg', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 1, 9, 4, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 300),
(43, 'Chakalaka & pap', 'Chakalaka is a vegetable dish made of onions, tomatoes, peppers, carrots, beans and spices, and is often served cold. Pap, meaning \'porridge\', is similar to American grits and is a starchy dish made from white corn maize.  Chakalaka and pap are often served together, along with braaied (barbecued) meat, breads, salad and stews.', 'chalaka.jpg', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 1, 9, 4, '2016-12-21 07:23:20', '2016-12-30 10:41:08', 500),
(44, 'Chakalaka & pap', 'Chakalaka is a vegetable dish made of onions, tomatoes, peppers, carrots, beans and spices, and is often served cold. Pap, meaning \'porridge\', is similar to American grits and is a starchy dish made from white corn maize.  Chakalaka and pap are often served together, along with braaied (barbecued) meat, breads, salad and stews.', 'chakalaka.jpg', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 5, 9, 4, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 500),
(45, 'Chakalaka & pap', 'Chakalaka is a vegetable dish made of onions, tomatoes, peppers, carrots, beans and spices, and is often served cold. Pap, meaning \'porridge\', is similar to American grits and is a starchy dish made from white corn maize.  Chakalaka and pap are often served together, along with braaied (barbecued) meat, breads, salad and stews.', 'chakalaka.jpg', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 7, 9, 4, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 500),
(46, 'Braai/Shisa nyama', 'For a real taste of South Africa an authentic braai or shisa nyama (\'burn the meat\' in Zulu) is an eating experience not to be missed. Braais originated in the townships of Johannesburg, with butchers who set up barbecues in front of their shops at weekends to grill their meat and sell it on the street. Nowadays, local communities gather at braais at the weekends to share food. Pop along to soak up the vibrant atmosphere, listen to music and take your pick from the meat on offer, usually comprising of beef, chicken, pork, lamb and vors (sausages) – this is not an outing for vegetarians!', 'shisa.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 4, 9, 5, '2016-12-21 07:23:20', '2016-12-30 10:39:14', 750),
(47, 'Bunny chow', 'This street food of Durban has become popular across South Africa and is now starting to hit our food markets back in London. Hollowed out loaves of bread, stuffed with spicy curry were originally created by the immigrant Indian community in the Natal area of Durban and served to workers for lunch. Try chicken, pork or vegetarian varieties containing lentils and beans.', 'bunny_chow.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 3, 9, 5, '2016-12-21 07:23:20', '2016-12-30 10:39:45', 280),
(48, 'Braai/Shisa nyama', 'For a real taste of South Africa an authentic braai or shisa nyama (\'burn the meat\' in Zulu) is an eating experience not to be missed. Braais originated in the townships of Johannesburg, with butchers who set up barbecues in front of their shops at weekends to grill their meat and sell it on the street. Nowadays, local communities gather at braais at the weekends to share food. Pop along to soak up the vibrant atmosphere, listen to music and take your pick from the meat on offer, usually comprising of beef, chicken, pork, lamb and vors (sausages) – this is not an outing for vegetarians!', 'shisa.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 2, 9, 5, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 750),
(49, 'Bunny chow', 'This street food of Durban has become popular across South Africa and is now starting to hit our food markets back in London. Hollowed out loaves of bread, stuffed with spicy curry were originally created by the immigrant Indian community in the Natal area of Durban and served to workers for lunch. Try chicken, pork or vegetarian varieties containing lentils and beans.', 'bunny_chow.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 6, 9, 5, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 280),
(50, 'Amarula Don Pedro', 'This cocktail-come-dessert uses South African Amarula, a cream liqueur made from the indigenous marula fruit, blended with ice cream. Find it in every bar or take a bottle of Amarula home from duty-free to make your own!', 'amarula.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 1, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 425),
(51, 'Amarula Don Pedro', 'This cocktail-come-dessert uses South African Amarula, a cream liqueur made from the indigenous marula fruit, blended with ice cream. Find it in every bar or take a bottle of Amarula home from duty-free to make your own!', 'amarula.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 2, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 425),
(52, 'Amarula Don Pedro', 'This cocktail-come-dessert uses South African Amarula, a cream liqueur made from the indigenous marula fruit, blended with ice cream. Find it in every bar or take a bottle of Amarula home from duty-free to make your own!', 'amarula.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 3, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 425),
(53, 'Amarula Don Pedro', 'This cocktail-come-dessert uses South African Amarula, a cream liqueur made from the indigenous marula fruit, blended with ice cream. Find it in every bar or take a bottle of Amarula home from duty-free to make your own!', 'amarula.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 4, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 425),
(54, 'Amarula Don Pedro', 'This cocktail-come-dessert uses South African Amarula, a cream liqueur made from the indigenous marula fruit, blended with ice cream. Find it in every bar or take a bottle of Amarula home from duty-free to make your own!', 'amarula.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 7, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 425),
(55, 'Bobotie', 'Another dish thought to have been brought to South Africa by Asian settlers, bobotie is now the national dish of the country and cooked in many homes and restaurants. Minced meat is simmered with spices, usually curry powder, herbs and dried fruit, then topped with a mixture of egg and milk and baked until set.', 'bobotie.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 5, 9, 4, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 555),
(56, 'Bobotie', 'Another dish thought to have been brought to South Africa by Asian settlers, bobotie is now the national dish of the country and cooked in many homes and restaurants. Minced meat is simmered with spices, usually curry powder, herbs and dried fruit, then topped with a mixture of egg and milk and baked until set.', 'Lighthouse.jpg', 34, 2, 5, 'N;', 'N;', 2, 9, 4, '2016-12-21 07:23:20', '2017-01-18 17:45:26', 555),
(57, 'Bobotie', 'Another dish thought to have been brought to South Africa by Asian settlers, bobotie is now the national dish of the country and cooked in many homes and restaurants. Minced meat is simmered with spices, usually curry powder, herbs and dried fruit, then topped with a mixture of egg and milk and baked until set.', 'bobotie.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 7, 9, 4, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 555),
(58, 'Bobotie', 'Another dish thought to have been brought to South Africa by Asian settlers, bobotie is now the national dish of the country and cooked in many homes and restaurants. Minced meat is simmered with spices, usually curry powder, herbs and dried fruit, then topped with a mixture of egg and milk and baked until set.', 'bobotie.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 1, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 555),
(59, 'Bobotie', 'Another dish thought to have been brought to South Africa by Asian settlers, bobotie is now the national dish of the country and cooked in many homes and restaurants. Minced meat is simmered with spices, usually curry powder, herbs and dried fruit, then topped with a mixture of egg and milk and baked until set.', 'bobotie.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 3, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 555),
(60, 'Bobotie', 'Another dish thought to have been brought to South Africa by Asian settlers, bobotie is now the national dish of the country and cooked in many homes and restaurants. Minced meat is simmered with spices, usually curry powder, herbs and dried fruit, then topped with a mixture of egg and milk and baked until set.', 'bobotie.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 4, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 555),
(61, 'Bobotie', 'Another dish thought to have been brought to South Africa by Asian settlers, bobotie is now the national dish of the country and cooked in many homes and restaurants. Minced meat is simmered with spices, usually curry powder, herbs and dried fruit, then topped with a mixture of egg and milk and baked until set.', 'bobotie.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 6, 9, 5, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 555),
(62, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 1, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 350),
(63, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 3, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 350),
(64, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 6, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 350),
(65, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 7, 8, 2, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 350),
(66, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 2, 9, 5, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 350),
(67, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 5, 9, 5, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 350),
(68, 'Melktert', 'Similar to the British custard tart or Portuguese pasteis de nata, melktert consists of a pastry case filled with milk, eggs and sugar, which is usually thickened with flour. The finished tart is traditionally dusted with cinnamon. A real South African comfort food, it is served as a dessert, and also available in many bakeries.', 'melkert.png', 34, 2, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"19\";}', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"9\";}', 4, 9, 5, '2016-12-21 07:23:20', '2016-12-21 07:29:22', 350),
(106, 'Shisa nyama', 'Shisa nyama', 'braai_200.jpg', 10, 2, 5, '', 'a:7:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"8\";i:6;s:1:\"9\";}', 1, 8, 0, '2017-01-28 10:51:53', '2017-01-28 10:51:53', 400),
(109, 'my testa', 'test', 'Penguins.jpg', 100, 3, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"18\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 1, 8, NULL, '2017-02-28 13:19:40', '2017-03-03 11:51:45', 200),
(110, 'Boerewors Roll1', 'Boerewors Roll with red hot sauce', 'download.jpg', 100, 1, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"18\";}', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 1, 8, NULL, '2017-03-02 08:02:20', '2017-03-08 08:58:33', 1450),
(111, 'Boerewors Roll', 'Boerewors Roll with red hot sauce', 'download.jpg', 100, 1, 5, 'a:1:{i:0;s:2:\"20\";}', 'N;', 1, 8, NULL, '2017-03-02 08:04:32', '2017-03-02 08:04:32', 1458),
(112, 'Boerewors roll', 'Boerewors roll', 'download.jpg', 100, 3, 5, 'a:3:{i:0;s:2:\"17\";i:1;s:2:\"18\";i:2;s:2:\"19\";}', 'a:4:{i:0;s:1:\"4\";i:1;s:1:\"5\";i:2;s:1:\"6\";i:3;s:1:\"7\";}', 1, 8, NULL, '2017-03-03 11:33:03', '2017-03-03 11:33:03', 1450),
(113, 'Potjiekos', 'Potjiekos', 'download (1).jpg', 50, 3, 5, 'a:3:{i:0;s:2:\"18\";i:1;s:2:\"19\";i:2;s:2:\"20\";}', 'a:4:{i:0;s:1:\"4\";i:1;s:1:\"5\";i:2;s:1:\"6\";i:3;s:1:\"9\";}', 1, 9, NULL, '2017-03-03 11:36:40', '2017-03-03 11:36:40', 1200),
(114, 'Potjiekos', 'Potjiekos', 'download (1).jpg', NULL, 3, 5, 'a:2:{i:0;s:2:\"17\";i:1;s:2:\"20\";}', 'a:2:{i:0;s:1:\"2\";i:1;s:1:\"5\";}', 2, 8, NULL, '2017-03-03 11:37:24', '2017-03-03 11:37:24', 1002),
(115, 'Boerewors roll', 'Boerewors roll', 'download.jpg', 74, 3, 5, 'a:2:{i:0;s:2:\"18\";i:1;s:2:\"20\";}', 'a:3:{i:0;s:1:\"2\";i:1;s:1:\"3\";i:2;s:1:\"4\";}', 2, 9, NULL, '2017-03-03 11:39:15', '2017-03-03 11:39:15', 120),
(116, 'Vetkoek', 'Vetkoek', 'download (2).jpg', 65, 3, 5, 'a:1:{i:0;s:2:\"19\";}', 'a:4:{i:0;s:1:\"6\";i:1;s:1:\"7\";i:2;s:1:\"8\";i:3;s:1:\"9\";}', 3, 8, NULL, '2017-03-03 11:41:54', '2017-03-03 11:41:54', 1213),
(117, 'Potjiekos', 'Potjiekos', 'download (1).jpg', 78, 3, 5, 'a:1:{i:0;s:2:\"21\";}', 'a:1:{i:0;s:2:\"10\";}', 3, 9, NULL, '2017-03-03 11:42:49', '2017-03-03 11:42:49', 121),
(118, 'Boerewors roll', 'Boerewors roll', 'download.jpg', 95, 3, 5, 'a:2:{i:0;s:2:\"20\";i:1;s:2:\"21\";}', 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"9\";}', 4, 8, NULL, '2017-03-03 11:43:57', '2017-03-03 11:43:57', 1444),
(119, 'Potjiekos', 'Potjiekos', 'download (1).jpg', 65, 3, 5, 'a:1:{i:0;s:2:\"18\";}', 'a:1:{i:0;s:1:\"3\";}', 4, 9, NULL, '2017-03-03 11:45:58', '2017-03-03 11:45:58', 111),
(120, 'Vetkoek', 'Vetkoek', 'download (2).jpg', 78, 3, 5, 'a:1:{i:0;s:2:\"20\";}', 'a:1:{i:0;s:1:\"2\";}', 5, 8, NULL, '2017-03-03 11:46:39', '2017-03-03 11:46:39', 1521),
(121, 'Boerewors roll', 'Boerewors roll', 'download.jpg', 100, 3, 5, 'a:4:{i:0;s:2:\"17\";i:1;s:2:\"18\";i:2;s:2:\"19\";i:3;s:2:\"20\";}', 'a:4:{i:0;s:1:\"7\";i:1;s:1:\"8\";i:2;s:1:\"9\";i:3;s:2:\"10\";}', 5, 9, NULL, '2017-03-03 11:47:32', '2017-03-03 11:47:32', 456);

-- --------------------------------------------------------

--
-- Table structure for table `promocodes`
--

CREATE TABLE `promocodes` (
  `id` int(11) NOT NULL,
  `pcode` varchar(250) DEFAULT NULL,
  `peruser` varchar(250) DEFAULT NULL,
  `totalusage` varchar(250) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promocodes`
--

INSERT INTO `promocodes` (`id`, `pcode`, `peruser`, `totalusage`, `percent`, `status`, `created`, `modified`) VALUES
(1, 'CHD5', '5', '100', 5, 1, '2017-01-01 07:42:11', '2017-01-01 14:00:12'),
(2, 'IND10', '20', '100', 10, 1, '2017-01-01 07:42:32', '2017-01-02 11:32:12'),
(3, 'anu07', '3', '100', 10, 1, '2017-01-28 11:16:15', '2017-01-28 11:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `refferby` varchar(250) DEFAULT NULL,
  `refferto` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `refferby`, `refferto`, `created`, `modified`) VALUES
(4, '100', '150', '2017-01-30 13:33:03', '2017-02-02 06:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) DEFAULT NULL,
  `order_items_id` int(11) DEFAULT NULL,
  `text` text,
  `rate` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staticpages`
--

CREATE TABLE `staticpages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `description` text,
  `status` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staticpages`
--

INSERT INTO `staticpages` (`id`, `user_id`, `position`, `title`, `image`, `description`, `status`, `created`, `modified`) VALUES
(1, 5, 'aboutus', 'About Us', 'aboutus.jpg', 'Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\r\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\r\nclear language\r\ntypography and graphic design\r\nresearch and copywriting\r\nprocess analysis.\r\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\r\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\r\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.', 1, '2016-12-19 12:37:26', '2016-12-19 12:49:29'),
(2, 5, 'contactus', 'Contact Us', 'contactus.jpg', 'Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\r\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\r\nclear language\r\ntypography and graphic design\r\nresearch and copywriting\r\nprocess analysis.\r\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\r\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\r\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.', 1, '2016-12-19 12:38:38', '2016-12-19 12:38:38'),
(3, 5, 'faq', 'FAQ', 'faq.jpg', 'Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\r\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\r\nclear language\r\ntypography and graphic design\r\nresearch and copywriting\r\nprocess analysis.\r\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\r\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\r\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.', 1, '2016-12-19 12:39:11', '2016-12-19 12:39:11'),
(4, 5, 'privacypolicy', 'Privacy Policy', 'pp.jpg', 'Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\nWe use our expText Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\nclear language\ntypography and graphic design\nresearch and copywriting\nprocess analysis.\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\nclear language\ntypography and graphic design\nresearch and copywriting\nprocess analysis.\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\nclear language\ntypography and graphic design\nresearch and copywriting\nprocess analysis.\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\nclear language\ntypography and graphic design\nresearch and copywriting\nprocess analysis.\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\nclear language\ntypography and graphic design\nresearch and copywriting\nprocess analysis.\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\nclear language\ntypography and graphic design\nresearch and copywriting\nprocess analysis.\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\nclear language\ntypography and graphic design\nresearch and copywriting\nprocess analysis.\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\nclear language\ntypography and graphic design\nresearch and copywriting\nprocess analysis.\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.erience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\nclear language\ntypography and graphic design\nresearch and copywriting\nprocess analysis.\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.', 1, '2016-12-19 12:39:57', '2016-12-19 12:39:57'),
(5, 5, 'deliverypolicy', 'Delivery Policy', 'dp.jpg', 'Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\r\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\r\nclear language\r\ntypography and graphic design\r\nresearch and copywriting\r\nprocess analysis.\r\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\r\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\r\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.', 1, '2016-12-19 12:48:56', '2016-12-19 12:48:56'),
(6, 5, 'howitwork', 'How it Work', 'dp.jpg', 'Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\r\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\r\nclear language\r\ntypography and graphic design\r\nresearch and copywriting\r\nprocess analysis.\r\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\r\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\r\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.', 1, '2016-12-19 12:48:56', '2016-12-19 12:48:56'),
(7, 5, 'help', 'Help', 'dp.jpg', 'Text Matters is a UK-based information design consultancy, established in Reading in 1990 by partners Mark Barratt and Sue Walker.\r\nWe use our experience in language, design, systems and process improvement to deal with communication issues in a way that is focused on users. We work in print and electronic media, and specialise in explaining things through:\r\nclear language\r\ntypography and graphic design\r\nresearch and copywriting\r\nprocess analysis.\r\nWe have a core team with skills ranging from copywriting and editing for clear language, to form design for print and screen, to structured documents for parallel publishing.\r\nIn addition we can call on experts and consultants who provide support in specific areas such as database-driven websites, and electronic forms.\r\nWe have contacts in the industry with complementary skills enabling us to further increase our resources on an as-needed basis.', 1, '2016-12-19 12:48:56', '2016-12-19 12:48:56'),
(8, 5, 'homecon', 'Help', 'dp.jpg', '', 1, '2016-12-19 12:48:56', '2016-12-19 12:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_main` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`, `status`, `created`, `modified`, `is_main`) VALUES
(1, 'Cloves', 1, 1, '2016-12-19 11:10:01', '2016-12-19 11:10:01', 1),
(2, 'Veg food', 8, 1, '2016-12-21 07:21:53', '2016-12-21 07:21:53', 1),
(3, 'Non veg food', 8, 1, '2016-12-21 07:22:15', '2016-12-21 07:22:15', 1),
(4, 'Veg food', 9, 1, '2016-12-21 07:22:40', '2016-12-21 07:22:40', 1),
(5, 'Non veg food', 9, 1, '2016-12-21 07:22:54', '2016-12-21 07:22:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description_short` text,
  `image` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `day` bigint(20) DEFAULT NULL,
  `meals` int(11) DEFAULT NULL,
  `subscription_type_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description_long` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `name`, `description_short`, `image`, `price`, `day`, `meals`, `subscription_type_id`, `status`, `created`, `modified`, `description_long`) VALUES
(1, 'Lifestyle', 'Dinner Only', 'r1.jpg', 0, 30, 20, 1, 1, '2016-12-16 13:09:51', '2017-02-23 11:27:29', 'Have your pick from a selection of 4 dinner options'),
(2, 'Lifestyle PLUS', 'Lunch + Dinner', 'r2.jpg', 0, 25, 25, 1, 1, '2016-12-20 15:23:33', '2017-02-23 11:28:02', 'Have your pick from a selection of 4 lunch options and 4 dinneroptions'),
(3, 'Private', 'Lunch + Dinner(custom food)', 'r3.jpg', 10, 25, 25, 1, 1, '2017-02-27 07:55:29', '2017-02-27 11:55:31', 'Have your pick from a selection of 4 lunch options and 4 dinneroptions');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_types`
--

CREATE TABLE `subscription_types` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `status` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_types`
--

INSERT INTO `subscription_types` (`id`, `name`, `description`, `status`, `created`, `modified`) VALUES
(1, 'Food Plans', ' we provide only dinner option in this plan.', 1, '2016-12-16 13:08:48', '2016-12-20 15:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `timeslots`
--

CREATE TABLE `timeslots` (
  `id` int(11) NOT NULL,
  `timeslot` varchar(250) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslots`
--

INSERT INTO `timeslots` (`id`, `timeslot`, `category_id`, `created`, `modified`) VALUES
(1, '1PM-2PM', 8, '2017-01-02 15:02:18', '2017-01-02 15:02:18'),
(2, '3PM-4PM', 8, '2017-01-02 14:38:53', '2017-01-28 11:14:18'),
(3, '4PM-5PM', 8, '2017-01-02 14:39:05', '2017-01-28 11:14:39'),
(4, '7PM-8PM', 9, '2017-01-02 15:04:19', '2017-01-02 15:04:19'),
(5, '8PM-9PM', 9, '2017-01-02 15:03:38', '2017-01-02 15:03:38'),
(6, '9PM-10PM', 9, '2017-01-02 15:04:03', '2017-01-02 15:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `role` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `image` varchar(250) NOT NULL DEFAULT 'noimage.png',
  `email_status` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `tokenhash` text,
  `fb_id` varchar(250) DEFAULT NULL,
  `subscription_plan_id` int(11) DEFAULT '0',
  `is_activeplan` int(11) DEFAULT '0',
  `zip` varchar(250) DEFAULT NULL COMMENT 'address',
  `radius` varchar(250) DEFAULT NULL,
  `use_r_code` varchar(250) DEFAULT NULL,
  `my_r_code` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lat` varchar(250) DEFAULT NULL,
  `long` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`, `fname`, `lname`, `phone`, `image`, `email_status`, `status`, `tokenhash`, `fb_id`, `subscription_plan_id`, `is_activeplan`, `zip`, `radius`, `use_r_code`, `my_r_code`, `created`, `modified`, `lat`, `long`) VALUES
(5, 'akshay@futureworktechnologies.com', '$2y$10$fyKvmDL7pWU3JeKk1iJi/uOnTFHrrB4hpJUH3qTw8hDjHydQT2uy6', 'vendor', 'akshay@futureworktechnologies.com', 'Akshaay', 'Kumar', '9456431950', 'profile1481198351.png', 1, 1, '1b285cee7faae01dc340a60d68f4ba83', '', 0, 0, 'Houtbos, Mpumalanga, South Africa', '15', '', 'AKSHAAY-L8M', '2017-01-20 09:51:16', '2017-03-02 07:49:53', '-26.1991744', '30.9818962'),
(14, 'ashutosh@avainfotech.com', '$2y$10$n/uKZp1ir7UJPtu9QtCcnuAmOWGJHVzZK0dqNlCWla5kuXHFx4wAS', 'admin', 'ashutosh1@avainfotech.com', 'Ashutosh', 'kumar', '789567689467', 'profile1485515339.png', 1, 1, '4d5e88b0d749576aa63837a98f60645cd668921ccff9cfb430b0ffa39ff73c08Y?sT\"?q??8:n?*?[s?:??]???x?y', '', 0, 0, 'Houtbos, Mpumalanga, South Africa', '', 'ASHU-1JR', 'ASHUTOSH-8XK', '2017-02-11 09:45:39', '2017-02-11 09:45:39', '', ''),
(110, 'ashutosh@avainfotech.com1', '$2y$10$n/uKZp1ir7UJPtu9QtCcnuAmOWGJHVzZK0dqNlCWla5kuXHFx4wAS', 'user', 'ashutosh@avainfotech.com', 'ashutosh', 'kr', '1111111111', 'noimage.png', 1, 1, '1e6502855372b9890dd8040a1dc4b2b0', '', 3, 1, 'Houtbos, Mpumalanga, South Africa', '', '', 'ASHU-1JR', '2017-02-27 11:57:52', '2017-06-01 15:43:37', '-26.1991744', '30.9818962'),
(151, 'mtrmul001@myuct.ac.za', '$2y$10$0w23TW48MIuY3LObhiyvh.hBtYZysLALS70KNoof0m3RcClH8fyLi', 'user', 'mtrmul001@myuct.ac.za', 'Cold', 'Play', '760366511', 'noimage.png', 1, 1, 'e094ba83a3a947a2f7c614fe606c934a', NULL, NULL, NULL, '', '', NULL, 'COLD-QT2', '2017-02-23 05:51:57', '2017-02-23 06:08:17', NULL, NULL),
(155, 'mdllacmm@gm.com', '$2y$10$HQx24MJlz720R4Hm8v4IPub3wfSlQVdF6M7CKfwn71ZLOf093upLS', 'user', 'mdllacmm@gm.com', 'chda', 'media', '769847712', 'noimage.png', NULL, NULL, '55833f05ce203077af07f723bcd5f879', NULL, NULL, NULL, NULL, NULL, NULL, 'CHDA-CK8', '2017-02-23 08:49:35', '2017-02-23 08:49:35', NULL, NULL),
(170, 'anurag@avainfotech.com', '$2y$10$hjOZ76rRsbIN1GVQfdJvhe27LFBFl.A3cWUM1ABjmtI3gZoye3x1W', 'user', 'anurag@avainfotech.com', 'Anurag', 'Sh', '12345768900', 'profile1488541835.png', 1, 1, 'f78e75e00ecf52b99211c47784a0778d', NULL, 3, 1, NULL, NULL, NULL, 'ANURAG-8U', '2017-03-03 10:48:20', '2017-03-03 11:50:35', NULL, NULL),
(171, 'neha@avainfotech.com', '$2y$10$/hDNsc3tG1wT10qbeA/yRuJKlWz2IhhBzNkugQ.5lynlUoBNmaeV6', 'user', 'neha@avainfotech.com', 'neha ', 'sh', '48786687676', 'noimage.png', 1, 0, '01f9a51d2d0835bac6f877628b8313cd', NULL, 0, 0, 'Houtbos, Mpumalanga, South Africa', NULL, NULL, NULL, '2017-03-03 11:20:03', '2017-03-03 11:24:48', NULL, NULL),
(172, 'simerjit@futureworktechnologies.com', '$2y$10$Sl/1raAH3ZpGv9JWFKki2u0XmPXv9S5OClhS9Y4hC.1bZaf9wrUcu', 'user', 'simerjit@futureworktechnologies.com', 'Simerjit Kaur', '', NULL, 'noimage.png', 1, 1, NULL, '1770952716566389', 3, 1, NULL, NULL, NULL, 'SIMERJITKAUR-RS', '2017-03-08 11:53:31', '2017-03-08 11:53:31', NULL, NULL),
(173, 'mavelas@live.co.uk', '$2y$10$M0x0M28LfZwJzSczlRU3..Bqn37Msl5Rb19oVBMHqgtjxkGWjVFnm', 'user', 'mavelas@live.co.uk', 'Gundo Marve Nelwamondo', '', NULL, 'noimage.png', 1, 1, NULL, '1291106100963646', 0, 0, NULL, NULL, NULL, '-CE', '2017-03-03 15:22:49', '2017-04-20 11:03:49', NULL, NULL),
(174, 'mansoor512@gmail.com', '$2y$10$060OBPoin1u8wiNFKGiXSeEFgzH8r2Ja.HDxF45m6W/2UsoNB0U56', 'user', 'mansoor512@gmail.com', 'James', 'Jameson', '609753868', 'noimage.png', 1, 0, 'c6ee0cdbf7778b3d644a105838dd2067', NULL, 0, 0, NULL, NULL, NULL, 'JAMES-D3', '2017-03-06 09:24:18', '2017-03-06 09:31:07', NULL, NULL),
(175, 'gundo@plait.co.za', '$2y$10$SbSVAC1fyz7DvCezh3/8L.Abh7TOoiv6Z5HsDO8Mcyk2finkNrSW6', 'user', 'gundo@plait.co.za', 'Gundo', 'Ndjdb', '74738', 'noimage.png', NULL, 0, '199140c7b5132d505ac48a44a56a1ae0', NULL, 0, 0, NULL, NULL, NULL, 'GUNDO-12', '2017-03-06 13:35:26', '2017-03-06 13:35:26', NULL, NULL),
(181, 'rakhi@avainfotech.com', '$2y$10$lOS5DnpYcqcJYbF2d4cnneBOGHf8CLYu..vQyVeYLgW8xyM9SozM2', 'user', 'rakhi@avainfotech.com', 'Rakhi Fwrk', '', NULL, 'noimage.png', 1, 1, NULL, '236483833424172', 0, 0, NULL, NULL, NULL, 'RAKHIFWRK-BW', '2017-03-08 10:27:08', '2017-03-08 16:42:21', NULL, NULL),
(184, 'ashutoshkumarupadhyay@gmail.com', '$2y$10$AXIfxQTklfJSI.sNYOQaXOEinNlZNhilSZzpFq90RMaDZasYXUyWa', 'user', 'ashutoshkumarupadhyay@gmail.com', 'Ashutosh Shandilya', '', '0', 'profile1488965923.png', 1, 1, NULL, '1272468296148292', 3, 1, 'Houtbos, Mpumalanga, South Africa', NULL, NULL, 'ASHUTOSHSHANDILYA-O2', '2017-03-08 11:37:27', '2017-03-08 12:36:29', NULL, NULL),
(185, 'diksha@avainfotech.com', '$2y$10$6govNNH/R12HXC2nRvx7Ne4KKLhryiK8c/XnQfKQQfkIhRrwqG/TG', 'user', 'diksha@avainfotech.com', 'Diksha', 'sharma', '123456798900', 'noimage.png', 1, 0, '2a2ec62e0a69c892e1b1b62945b92a1e', NULL, 0, 0, 'Houtbos, Mpumalanga, South Africa', NULL, NULL, NULL, '2017-03-08 12:53:41', '2017-03-08 13:02:23', NULL, NULL),
(186, 'anuragsharma_631@yahoo.in', '$2y$10$axxEdYZ/2BT69jHpmQfV..u/XIA3TjCwymPhacYN3UN/zqofZZPum', 'user', 'anuragsharma_631@yahoo.in', 'Anurag Sharma', '', NULL, 'noimage.png', 1, 1, NULL, '1311235522259827', 3, 1, NULL, NULL, NULL, 'ANURAGSHARMA-K3', '2017-03-08 13:48:06', '2017-03-08 15:33:20', NULL, NULL),
(187, 'samysamhum@gmail.com', '$2y$10$9XP/qP5EGFXNOeRC8MQXiO9WueuxPAm7dC.4m7WGHyH8NcX.SNxEK', 'user', 'samysamhum@gmail.com', 'Samy Arora', '', NULL, 'noimage.png', 1, 1, NULL, '1410324312375629', 3, 1, NULL, NULL, NULL, 'SAMYARORA-7J', '2017-03-08 16:50:51', '2017-03-08 16:52:49', NULL, NULL),
(189, 'mulalomatoro@gmail.com', '$2y$10$6Ythiamsk2YG.JTTHn1aZOnVk/KW1da9Au17DeildOI3E45.prUMa', 'user', 'mulalomatoro@gmail.com', 'Michael', 'Matoro', '760366511', 'noimage.png', 1, 1, '62e4d41fde59832cf75a398bc3c383f3', NULL, 1, 1, NULL, NULL, NULL, 'MICHAEL-LS', '2017-06-28 16:00:15', '2017-06-28 16:00:15', NULL, NULL),
(190, NULL, '$2y$10$DyjEG0qUmb8By4LLv6Rw/eaMQO4wNa6lxVxOGqK/XrL6xQchUR97q', 'user', NULL, 'Tsedzu Clubnesh Netshimbupfe', '', NULL, 'noimage.png', 1, 1, NULL, '1512722388747335', 0, 0, NULL, NULL, NULL, NULL, '2017-05-04 15:03:36', '2017-05-04 15:03:36', NULL, NULL),
(191, 'clintwhite51@gmail.com', '$2y$10$9CwSQGl4gKTWf2o7aOpM2u4PdhmBoBbgjg2jRI1b2cgbwBBMPnQ1S', 'user', 'clintwhite51@gmail.com', 'Clint White', '', NULL, 'noimage.png', 1, 1, NULL, '10154439927232213', 0, 0, NULL, NULL, NULL, 'CLINTWHITE-KD', '2017-05-15 11:11:42', '2017-05-15 11:11:42', NULL, NULL),
(192, 'tsedzunetsh@gmail.com', '$2y$10$wsrtjbAvpIREVueG3IIqPuSqG.sQ7SWRMH.1Nxwg/gEC/DkbYYEci', 'user', 'tsedzunetsh@gmail.com', 'Tsedzu', 'Netsh', '82645236', 'noimage.png', 1, 1, 'a608e2d9151b5b6e6ac6a3fe559eff1c', NULL, 2, 1, NULL, NULL, NULL, 'TSEDZU-K5', '2017-06-28 10:36:24', '2017-06-28 10:36:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_plans`
--

CREATE TABLE `user_plans` (
  `id` int(11) NOT NULL,
  `subscription_plan_id` int(11) DEFAULT NULL,
  `totalmeal` varchar(200) DEFAULT NULL,
  `used_meal` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expireon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_plans`
--

INSERT INTO `user_plans` (`id`, `subscription_plan_id`, `totalmeal`, `used_meal`, `uid`, `created`, `expireon`, `is_active`) VALUES
(14, 3, '25', 0, 172, '2017-03-08 11:53:31', '2017-04-02 11:53:31', 1),
(12, 3, '25', 0, 169, '2017-03-03 10:36:53', '2017-03-28 10:36:53', 1),
(13, 3, '25', 0, 170, '2017-03-03 10:48:20', '2017-03-28 10:48:20', 1),
(9, 1, '20', 8, 145, '2017-02-11 11:36:35', '2017-03-13 11:36:35', 1),
(10, 1, '20', 0, 147, '2017-02-11 12:11:48', '2017-03-13 12:11:48', 1),
(11, 3, '25', 2, 110, '2017-02-27 11:57:52', '2017-03-24 11:57:52', 1),
(15, 3, '25', 0, 186, '2017-03-08 13:48:06', '2017-04-02 13:48:06', 1),
(16, 3, '25', 0, 187, '2017-03-08 16:50:51', '2017-04-02 16:50:51', 1),
(17, 1, '20', 0, 189, '2017-06-28 16:00:15', '2017-07-28 16:00:15', 1),
(18, 2, '25', 0, 192, '2017-06-28 10:36:24', '2017-07-23 10:36:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `use_promocodes`
--

CREATE TABLE `use_promocodes` (
  `id` int(11) NOT NULL,
  `promocode` varchar(250) DEFAULT NULL,
  `noofuse` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `total` varchar(250) DEFAULT NULL,
  `subtotal` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `use_promocodes`
--

INSERT INTO `use_promocodes` (`id`, `promocode`, `noofuse`, `uid`, `total`, `subtotal`, `created`, `modified`) VALUES
(1, '', 3, 145, '1499', '1499', '2017-02-11 10:26:58', '2017-02-11 10:26:58'),
(2, 'CHD5', 3, 145, '999', '949', '2017-02-11 11:36:35', '2017-02-11 11:36:35'),
(3, '', 3, 147, '999', '999', '2017-02-11 12:11:48', '2017-02-11 12:11:48'),
(4, NULL, 1, 110, '1499', '1499', '2017-02-11 13:29:19', '2017-02-11 13:29:19'),
(5, NULL, 1, 110, '1499', '1499', '2017-02-11 13:35:52', '2017-02-11 13:35:52'),
(6, NULL, 1, 110, '1499', '1499', '2017-02-11 13:52:35', '2017-02-11 13:52:35'),
(7, '', 1, 110, '10', '10', '2017-02-27 11:57:52', '2017-02-27 11:57:52'),
(8, 'IND10', 1, 169, '10', '9', '2017-03-03 10:36:53', '2017-03-03 10:36:53'),
(9, NULL, 1, 170, '10', '10', '2017-03-03 10:41:53', '2017-03-03 10:41:53'),
(10, NULL, 1, 170, '10', '10', '2017-03-03 10:48:20', '2017-03-03 10:48:20'),
(11, NULL, 1, 172, '10', '10', '2017-03-08 11:53:31', '2017-03-08 11:53:31'),
(12, NULL, 1, 186, '10', '10', '2017-03-08 13:48:05', '2017-03-08 13:48:06'),
(13, NULL, 1, 187, '10', '10', '2017-03-08 16:50:51', '2017-03-08 16:50:51'),
(14, NULL, 1, 189, '0', '0', '2017-06-26 15:55:00', '2017-06-26 15:55:00'),
(15, NULL, 1, 192, '0', '0', '2017-06-27 15:05:42', '2017-06-27 15:05:42'),
(16, NULL, 1, 192, '0', '0', '2017-06-28 10:35:57', '2017-06-28 10:35:58'),
(17, NULL, 1, 192, '0', '0', '2017-06-28 10:36:24', '2017-06-28 10:36:24'),
(18, NULL, 1, 189, '0', '0', '2017-06-28 11:07:28', '2017-06-28 11:07:28'),
(19, NULL, 1, 189, '0', '0', '2017-06-28 11:12:43', '2017-06-28 11:12:43'),
(20, NULL, 1, 189, '10', '10', '2017-06-28 11:41:44', '2017-06-28 11:41:44'),
(21, NULL, 1, 189, '0', '0', '2017-06-28 12:43:09', '2017-06-28 12:43:09'),
(22, NULL, 1, 189, '0', '0', '2017-06-28 13:07:06', '2017-06-28 13:07:06'),
(23, NULL, 1, 189, '0', '0', '2017-06-28 13:08:21', '2017-06-28 13:08:21'),
(24, NULL, 1, 189, '0', '0', '2017-06-28 13:08:32', '2017-06-28 13:08:32'),
(25, NULL, 1, 189, '0', '0', '2017-06-28 13:25:01', '2017-06-28 13:25:01'),
(26, NULL, 1, 189, '0', '0', '2017-06-28 16:00:15', '2017-06-28 16:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `points` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `uid`, `points`, `created`, `modified`) VALUES
(2, 137, '35', '2017-01-30 13:44:32', '2017-01-30 13:44:32'),
(3, 136, '30', '2017-01-30 13:45:15', '2017-01-30 13:45:15'),
(4, 145, '250', '2017-02-11 10:25:58', '2017-02-11 10:25:58'),
(5, 110, '200', '2017-02-11 10:26:46', '2017-02-11 10:26:46'),
(6, 147, '150', '2017-02-11 12:10:03', '2017-02-11 12:10:03'),
(7, 156, '150', '2017-03-02 07:25:25', '2017-03-02 07:25:25'),
(8, 14, '150', '2017-03-02 07:37:07', '2017-03-02 07:37:07'),
(9, 169, '150', '2017-03-03 10:33:11', '2017-03-03 10:33:11');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
