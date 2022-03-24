-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2015 at 04:49 PM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `studykik_studykik`
--

-- --------------------------------------------------------

--
-- Table structure for table `0gf1ba_rewards_details`
--

CREATE TABLE IF NOT EXISTS `0gf1ba_rewards_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `activity_of_points` varchar(255) DEFAULT NULL,
  `rewards_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `credit` bigint(20) NOT NULL DEFAULT '0',
  `debit` bigint(20) NOT NULL DEFAULT '0',
  `balance` bigint(20) NOT NULL DEFAULT '0',
  `is_last` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `0gf1ba_rewards_details`
--

INSERT INTO `0gf1ba_rewards_details` (`id`, `user_id`, `activity_of_points`, `rewards_date_time`, `credit`, `debit`, `balance`, `is_last`) VALUES
(1, 70, 'Renew Study (Diamond)', '2015-09-02 19:51:53', 30, 0, 30, 0),
(2, 70, 'Renew Study (Platinum)', '2015-09-02 19:52:30', 15, 0, 45, 0),
(3, 70, 'Renew Study (Platinum)', '2015-09-02 19:52:36', 15, 0, 60, 0),
(4, 70, 'Renew Study (Gold)', '2015-09-02 19:55:00', 5, 0, 65, 0),
(5, 70, 'Manually input points', '2015-09-02 19:58:04', 0, 65, 0, 0),
(6, 70, 'Manually input points', '2015-09-02 19:59:14', 100, 0, 100, 0),
(7, 303, 'Renew Study (Gold)', '2015-09-02 19:59:34', 5, 0, 5, 1),
(8, 19, 'List a new study (Gold)', '2015-09-02 20:08:25', 5, 0, 5, 1),
(9, 70, 'List a new study (Diamond)', '2015-09-02 20:27:35', 30, 0, 130, 0),
(10, 70, 'List a new study (Diamond)', '2015-09-02 20:35:55', 30, 0, 160, 0),
(11, 239, 'Manually input points', '2015-09-02 20:38:48', 375, 0, 375, 1),
(12, 70, 'Renew Study (Platinum)', '2015-09-02 20:48:42', 15, 0, 175, 0),
(13, 405, 'List a new study (Platinum)', '2015-09-02 21:08:16', 15, 0, 15, 1),
(14, 70, 'Renew Study (Platinum)', '2015-09-02 21:35:21', 15, 0, 190, 0),
(15, 70, 'Renew Study (Diamond)', '2015-09-02 21:39:35', 30, 0, 220, 0),
(16, 70, 'Renew Study (Platinum)', '2015-09-02 21:42:35', 15, 0, 235, 0),
(17, 70, 'Manually input points', '2015-09-02 22:00:39', 0, 235, 0, 0),
(18, 412, 'Fill out enrollment data', '2015-09-03 05:00:02', 150, 0, 150, 1),
(19, 419, 'Fill out enrollment data', '2015-09-03 05:00:03', 150, 0, 150, 1),
(20, 211, 'Fill out enrollment data', '2015-09-03 05:00:03', 50, 0, 50, 1),
(21, 70, 'Fill out enrollment data', '2015-09-03 05:00:03', 150, 0, 150, 0),
(22, 133, 'Fill out enrollment data', '2015-09-03 05:00:03', 150, 0, 150, 1),
(23, 224, 'Fill out enrollment data', '2015-09-03 05:00:03', 50, 0, 50, 1),
(24, 27, 'List a new study (Platinum)', '2015-09-03 14:52:29', 15, 0, 15, 1),
(25, 257, 'Renew Study (Gold)', '2015-09-03 11:17:34', 5, 0, 5, 1),
(26, 70, 'Renew Study (Platinum)', '2015-09-03 11:34:39', 15, 0, 165, 0),
(27, 70, 'List a new study (Diamond)', '2015-09-03 11:52:37', 30, 0, 195, 0),
(28, 70, 'Redeem $25 Starbucks Gift Card', '2015-09-03 11:53:47', 0, 75, 120, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
