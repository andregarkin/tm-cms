-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2015 at 02:39 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `sbtodolist_todo`
--

CREATE TABLE IF NOT EXISTS `sbtodolist_todo` (
`id` int(10) unsigned NOT NULL,
  `priority` int(1) NOT NULL DEFAULT '2',
  `created_on` datetime NOT NULL,
  `due_on` datetime NOT NULL,
  `last_modified_on` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `comment` text,
  `status` enum('PENDING','DONE','VOIDED') NOT NULL DEFAULT 'PENDING',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sbtodolist_todo`
--

INSERT INTO `sbtodolist_todo` (`id`, `priority`, `created_on`, `due_on`, `last_modified_on`, `title`, `description`, `comment`, `status`, `deleted`) VALUES
(1, 2, '2011-10-20 11:00:00', '2011-10-20 11:00:00', '2015-10-20 00:00:00', 'Clean the house', 'Clean the whole house, ideally including garden.', NULL, 'PENDING', 0),
(2, 2, '2011-09-02 18:24:00', '2011-10-07 08:26:49', '2011-10-05 15:00:00', 'Cut the lawn', 'Cut the lawn around the house.', NULL, 'PENDING', 0),
(3, 3, '2011-09-15 09:30:00', '2011-10-19 10:25:00', '2015-04-11 14:55:56', 'Buy a car', 'Choose the best car to buy and simply buy it. 111', 'New BMW bought. 1', 'DONE', 0),
(4, 3, '2011-09-27 17:33:00', '2011-10-11 13:48:00', '2011-11-01 00:00:00', 'Open a new bank account', NULL, 'Not needed.', 'VOIDED', 0),
(5, 1, '2010-08-12 08:17:00', '2011-10-07 08:06:40', '2010-09-01 00:00:00', 'Finish all the exams', NULL, NULL, 'DONE', 0),
(6, 2, '2011-10-02 10:38:36', '2011-10-03 13:26:48', '2011-10-04 12:00:00', 'Send a letter to my sister', 'Send a letter to my sister with important information about what needs to be done.', 'Letter not needed, I called her.', 'VOIDED', 0),
(7, 1, '2010-04-07 17:28:52', '2010-05-12 11:47:00', '2015-04-11 14:37:28', 'Book air tickets', 'Book air tickets to Canary Islands, for 3 people. 111', '', 'PENDING', 0),
(8, 2, '2011-10-07 10:44:47', '2011-10-24 10:46:14', '2011-11-01 00:00:00', 'Pay electricity bills', 'Pay electricity bills for the house.', 'Paid.', 'DONE', 0),
(9, 3, '2015-04-11 14:38:29', '2015-04-12 19:30:00', '2015-04-11 14:46:37', '111', '111', 'grge eg eger eg ege rge erg erg', 'VOIDED', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tmcms_banners_pages`
--

CREATE TABLE IF NOT EXISTS `tmcms_banners_pages` (
  `banner_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Comparison banner ID - with page ID.';

--
-- Dumping data for table `tmcms_banners_pages`
--

INSERT INTO `tmcms_banners_pages` (`banner_id`, `page_id`) VALUES
(16, 1),
(2, 52667),
(23, 5),
(23, 3),
(23, 52666),
(24, 2),
(24, 1),
(25, 1),
(25, 2),
(26, 2),
(26, 1),
(23, 2),
(27, 4),
(27, 2),
(1, 1),
(3, 52667),
(4, 52667),
(5, 52667),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tmcms_tbanners`
--

CREATE TABLE IF NOT EXISTS `tmcms_tbanners` (
`id` int(11) unsigned NOT NULL,
  `title` tinytext NOT NULL,
  `content` text NOT NULL,
  `option_display` tinyint(1) NOT NULL DEFAULT '1',
  `option_startview` int(10) unsigned NOT NULL DEFAULT '0',
  `option_timestart` datetime NOT NULL,
  `option_timeend` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tmcms_tbanners`
--

INSERT INTO `tmcms_tbanners` (`id`, `title`, `content`, `option_display`, `option_startview`, `option_timestart`, `option_timeend`) VALUES
(1, 'Banner First after 75', '<div>On - Home - after 75</div>', 1, 75, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(2, 'On - Product 52667 - after 10', '<div>On - Product 52667 - after 10</div>\r\n<div>Second Lorem ipsum dolor</div>', 1, 10, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(3, 'On - Product 52667 - after 12', '<div>On - Product 52667 - after 12</div>\r\n<div>Second Lorem ipsum dolor</div>', 1, 12, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(4, 'On - Product 52667 - after 0', 'On - Product 52667 - after 0', 1, 0, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(5, 'On - Product 52667 - after 1', '<div>On - Product 52667 - after 1</div>', 1, 1, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(6, 'Banner Second', '<div>Second Lorem ipsum dolor</div>', 0, 0, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(16, 'Banner New 16', 'Lorem ipsum banner 16', 0, 0, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(8, 'Banner Fourth', '<div>Fourth Lorem ipsum dolor</div>', 0, 0, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(17, 'Banner New 17', 'Lorem ipsum banner 17', 0, 0, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(10, 'Banner New', '<div>New Lorem ipsum dolor</div>', 0, 0, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(12, 'Banner New', '<div>New Lorem ipsum dolor</div>', 0, 0, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(14, 'Banner New 1', 'print !empty content:''test''', 0, 0, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(15, 'Banner New 15 Updat', '<?php > 15', 0, 0, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(21, 'Banner New 21', 'Lorem ipsum banner 21', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Banner New 21', 'Lorem ipsum banner 21', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Banner 23 for Products, Product 52666, Search, Contuct Us', 'Content of Banner 23 for Products, Product 52666, Search, Contuct Us.', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Banner for Home, Products', '<div class="bonner" >Content for Banner for Home, Products</div>', 1, 0, '2015-04-25 00:00:00', '2100-01-01 00:00:00'),
(25, 'Banner 2 for Home, Products', '<div class="bonner" >Content for Banner 2 for Home, Products</div>', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Banner 3 for Home, Products', '<div class="bonner" >Content for Banner 3 for Home, Products</div>', 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Start View asap on Prod, Categ', 'Content Start View asap on Prod, Categ', 1, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Banner #28 Test DATETIME', 'Banner #28 Test DATETIME', 1, 0, '2015-04-24 00:00:00', '2100-01-01 00:00:00'),
(29, 'Banner #29 Test DATETIME', 'Banner #29 Test DATETIME', 1, 0, '2015-04-24 00:00:00', '2015-04-25 00:00:00'),
(30, 'Banner #30 Test DATETIME', 'Banner #30 Test DATETIME', 1, 0, '2015-04-25 15:10:00', '2015-04-25 16:20:00'),
(31, 'Banner #31 Test DATETIME', 'Banner #31 Test DATETIME', 1, 0, '2015-04-26 17:01:00', '2015-04-27 18:02:00'),
(32, 'Banner #32 Test DATETIME', 'Banner #32 Test DATETIME', 1, 0, '2015-04-26 17:01:00', '2015-04-27 18:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `tmcms_users`
--

CREATE TABLE IF NOT EXISTS `tmcms_users` (
`user_id` int(11) unsigned NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_email` varchar(32) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tmcms_users`
--

INSERT INTO `tmcms_users` (`user_id`, `user_login`, `user_password`, `user_email`) VALUES
(1, 'mylogin', '202cb962ac59075b964b07152d234b70', 'tm-cms@host.local'),
(2, 'andregarkin', '202cb962ac59075b964b07152d234b70', 'andregarkin@host.local'),
(8, 'bloknot', '202cb962ac59075b964b07152d234b70', ''),
(6, 'magenta', '202cb962ac59075b964b07152d234b70', 'magenta@local'),
(7, 'mariman', '202cb962ac59075b964b07152d234b70', 'andregarkin@gmail.com'),
(9, 'bloknot2', '202cb962ac59075b964b07152d234b70', 'andregarkin@host.local');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sbtodolist_todo`
--
ALTER TABLE `sbtodolist_todo`
 ADD PRIMARY KEY (`id`), ADD KEY `priority` (`priority`), ADD KEY `due_on` (`due_on`), ADD KEY `status` (`status`), ADD KEY `deleted` (`deleted`);

--
-- Indexes for table `tmcms_banners_pages`
--
ALTER TABLE `tmcms_banners_pages`
 ADD KEY `fk_banner` (`banner_id`), ADD KEY `fk_page` (`page_id`);

--
-- Indexes for table `tmcms_tbanners`
--
ALTER TABLE `tmcms_tbanners`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmcms_users`
--
ALTER TABLE `tmcms_users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sbtodolist_todo`
--
ALTER TABLE `sbtodolist_todo`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tmcms_tbanners`
--
ALTER TABLE `tmcms_tbanners`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tmcms_users`
--
ALTER TABLE `tmcms_users`
MODIFY `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
