-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 26, 2011 at 10:47 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `resy`
--

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE IF NOT EXISTS `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature`, `priority`) VALUES
(1, 'No Minimum Charge', 50),
(2, 'Private Room Available', 20),
(3, 'Outdoor Space', 40),
(4, 'Live Entertainment', 10);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` varchar(32) NOT NULL,
  `table_id` varchar(32) NOT NULL,
  `days_of_week` varchar(7) NOT NULL,
  `start_time` time NOT NULL DEFAULT '17:00:00',
  `end_time` time NOT NULL DEFAULT '22:00:00',
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `restaurant_id`, `table_id`, `days_of_week`, `start_time`, `end_time`, `start_date`, `end_date`) VALUES
(1, 'test1', 'table1', '0123456', '17:00:00', '22:00:00', '0000-00-00', NULL),
(2, 'test1', 'table2', '01234', '17:00:00', '29:00:00', '0000-00-00', NULL),
(3, 'test1', 'table2', '56', '21:00:00', '22:00:00', '0000-00-00', NULL),
(4, 'test2', 'table5', '123', '17:00:00', '22:00:00', '0000-00-00', NULL),
(5, 'test2', 'table5', '123', '17:00:00', '22:00:00', '0000-00-00', NULL),
(6, 'test2', 'table7', '01234', '17:00:00', '22:00:00', '0000-00-00', NULL),
(7, 'test2', 'table8', '1234', '17:00:00', '22:00:00', '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE IF NOT EXISTS `restaurants` (
  `id` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(127) NOT NULL,
  `state` varchar(32) NOT NULL,
  `zip` varchar(16) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `cuisine` varchar(255) NOT NULL,
  `price` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `description`, `address1`, `address2`, `city`, `state`, `zip`, `phone`, `cuisine`, `price`) VALUES
('test1', 'Test Restaurant', 'This is test restaurant number 1', '555 West St', '', 'Fakeville', 'New York', '10012', '555-555-5555', 'American', '$$$'),
('test2', 'Test Restaurant 2', 'This is another test restaurant', '12 Rainbow Road', '', 'New York', 'New York', '10036', '555-123-4567', 'French', '$$$$');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_details`
--

CREATE TABLE IF NOT EXISTS `restaurant_details` (
  `restaurant_id` varchar(32) NOT NULL,
  `details` text NOT NULL,
  `space` text NOT NULL,
  `food` text NOT NULL,
  `groups` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant_details`
--

INSERT INTO `restaurant_details` (`restaurant_id`, `details`, `space`, `food`, `groups`) VALUES
('test1', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatemSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur.\r\n', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia', 'unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia', 'unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia'),
('test2', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatemSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur.\r\n', '', '', 'unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_features`
--

CREATE TABLE IF NOT EXISTS `restaurant_features` (
  `restaurant_id` varchar(32) NOT NULL,
  `feature_id` int(11) NOT NULL,
  PRIMARY KEY (`restaurant_id`,`feature_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant_features`
--

INSERT INTO `restaurant_features` (`restaurant_id`, `feature_id`) VALUES
('test1', 1),
('test1', 2),
('test1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `id` varchar(32) NOT NULL,
  `restaurant_id` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `table_min` int(11) DEFAULT NULL,
  `table_max` int(11) DEFAULT NULL,
  `standing_min` int(11) DEFAULT NULL,
  `standing_max` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`restaurant_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `restaurant_id`, `name`, `table_min`, `table_max`, `standing_min`, `standing_max`) VALUES
('table1', 'test1', 'Private Room', 6, 10, NULL, NULL),
('table2', 'test1', 'Main Room', 10, 16, 20, 40),
('table5', 'test2', 'VIP Room', 6, 8, NULL, NULL),
('table6', 'test2', 'Snack Bar', 6, 8, 6, 12),
('table7', 'test2', 'Library', 12, 20, NULL, NULL),
('table8', 'test2', 'Main Hall', 30, 50, 30, 80);

-- --------------------------------------------------------

--
-- Stand-in structure for view `table_reservations`
--
CREATE TABLE IF NOT EXISTS `table_reservations` (
`reservation_id` int(11)
,`table_id` varchar(32)
,`restaurant_id` varchar(32)
,`table_min` int(11)
,`table_max` int(11)
,`days_of_week` varchar(7)
,`start_time` time
,`end_time` time
,`start_date` date
,`end_date` date
);
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `validated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `fname`, `lname`, `password`, `last_login`, `validated`) VALUES
(7, 'herp@derp.com', 'Herp', 'Derpington', '782f48fe4d5bd4e82cc36bbda0bd331b', '2011-08-01 19:36:18', 0),
(8, 'brian@tablerepublic.com', 'Brian', 'Lee', '333ec104b7665d19766da1140df2c209', '2011-12-11 11:19:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_reservations`
--

CREATE TABLE IF NOT EXISTS `user_reservations` (
  `user_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL DEFAULT '0000-00-00',
  `reservation_time` time NOT NULL,
  `num_people` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`reservation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_reservations`
--


-- --------------------------------------------------------

--
-- Structure for view `table_reservations`
--
DROP TABLE IF EXISTS `table_reservations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `table_reservations` AS select `r`.`id` AS `reservation_id`,`r`.`table_id` AS `table_id`,`r`.`restaurant_id` AS `restaurant_id`,`t`.`table_min` AS `table_min`,`t`.`table_max` AS `table_max`,`r`.`days_of_week` AS `days_of_week`,`r`.`start_time` AS `start_time`,`r`.`end_time` AS `end_time`,`r`.`start_date` AS `start_date`,`r`.`end_date` AS `end_date` from (`reservations` `r` join `tables` `t`) where ((`r`.`table_id` = `t`.`id`) and (`r`.`restaurant_id` = `t`.`restaurant_id`));
