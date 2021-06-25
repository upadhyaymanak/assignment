
-- Database: `demo`

-- Table structure for table `employees`


CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL, UNIQUE,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `skills` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
