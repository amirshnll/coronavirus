-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2020 at 11:23 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coronavirus`
--

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_country`
--

CREATE TABLE `cvdb_country` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `number_of_patients` int(11) NOT NULL,
  `number_of_death` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `cvdb_country`
--

INSERT INTO `cvdb_country` (`id`, `name`, `number_of_patients`, `number_of_death`, `updated_time`) VALUES
(1, 'Afghanistan', 0, 0, 1584825560),
(2, 'Albania', 0, 0, 1584825560),
(3, 'Algeria', 0, 0, 1584825560),
(4, 'American Samoa', 0, 0, 1584825560),
(5, 'Andorra', 0, 0, 1584825560),
(6, 'Angola', 0, 0, 1584825560),
(7, 'Anguilla', 0, 0, 1584825560),
(8, 'Antarctica', 0, 0, 1584825560),
(9, 'Antigua and Barbuda', 0, 0, 1584825560),
(10, 'Argentina', 0, 0, 1584825560),
(11, 'Armenia', 0, 0, 1584825560),
(12, 'Aruba', 0, 0, 1584825560),
(13, 'Australia', 0, 0, 1584825560),
(14, 'Austria', 0, 0, 1584825560),
(15, 'Azerbaijan', 0, 0, 1584825560),
(16, 'Bahamas', 0, 0, 1584825560),
(17, 'Bahrain', 0, 0, 1584825560),
(18, 'Bangladesh', 0, 0, 1584825560),
(19, 'Barbados', 0, 0, 1584825560),
(20, 'Belarus', 0, 0, 1584825560),
(21, 'Belgium', 0, 0, 1584825560),
(22, 'Belize', 0, 0, 1584825560),
(23, 'Benin', 0, 0, 1584825560),
(24, 'Bermuda', 0, 0, 1584825560),
(25, 'Bhutan', 0, 0, 1584825560),
(26, 'Bolivia', 0, 0, 1584825560),
(27, 'Bosnia and Herzegovina', 0, 0, 1584825560),
(28, 'Botswana', 0, 0, 1584825560),
(29, 'Bouvet Island', 0, 0, 1584825560),
(30, 'Brazil', 0, 0, 1584825560),
(31, 'British Indian Ocean Territory', 0, 0, 1584825560),
(32, 'Brunei Darussalam', 0, 0, 1584825560),
(33, 'Bulgaria', 0, 0, 1584825560),
(34, 'Burkina Faso', 0, 0, 1584825560),
(35, 'Burundi', 0, 0, 1584825560),
(36, 'Cambodia', 0, 0, 1584825560),
(37, 'Cameroon', 0, 0, 1584825560),
(38, 'Canada', 0, 0, 1584825560),
(39, 'Cape Verde', 0, 0, 1584825560),
(40, 'Cayman Islands', 0, 0, 1584825560),
(41, 'Central African Republic', 0, 0, 1584825560),
(42, 'Chad', 0, 0, 1584825560),
(43, 'Chile', 0, 0, 1584825560),
(44, 'China', 0, 0, 1584825560),
(45, 'Christmas Island', 0, 0, 1584825560),
(46, 'Cocos (Keeling) Islands', 0, 0, 1584825560),
(47, 'Colombia', 0, 0, 1584825560),
(48, 'Comoros', 0, 0, 1584825560),
(49, 'Democratic Republic of the Congo', 0, 0, 1584825560),
(50, 'Republic of Congo', 0, 0, 1584825560),
(51, 'Cook Islands', 0, 0, 1584825560),
(52, 'Costa Rica', 0, 0, 1584825560),
(53, 'Croatia (Hrvatska)', 0, 0, 1584825560),
(54, 'Cuba', 0, 0, 1584825560),
(55, 'Cyprus', 0, 0, 1584825560),
(56, 'Czech Republic', 0, 0, 1584825560),
(57, 'Denmark', 0, 0, 1584825560),
(58, 'Djibouti', 0, 0, 1584825560),
(59, 'Dominica', 0, 0, 1584825560),
(60, 'Dominican Republic', 0, 0, 1584825560),
(61, 'East Timor', 0, 0, 1584825560),
(62, 'Ecuador', 0, 0, 1584825560),
(63, 'Egypt', 0, 0, 1584825560),
(64, 'El Salvador', 0, 0, 1584825560),
(65, 'Equatorial Guinea', 0, 0, 1584825560),
(66, 'Eritrea', 0, 0, 1584825560),
(67, 'Estonia', 0, 0, 1584825560),
(68, 'Ethiopia', 0, 0, 1584825560),
(69, 'Falkland Islands (Malvinas)', 0, 0, 1584825560),
(70, 'Faroe Islands', 0, 0, 1584825560),
(71, 'Fiji', 0, 0, 1584825560),
(72, 'Finland', 0, 0, 1584825560),
(73, 'France', 0, 0, 1584825560),
(74, 'France, Metropolitan', 0, 0, 1584825560),
(75, 'French Guiana', 0, 0, 1584825560),
(76, 'French Polynesia', 0, 0, 1584825560),
(77, 'French Southern Territories', 0, 0, 1584825560),
(78, 'Gabon', 0, 0, 1584825560),
(79, 'Gambia', 0, 0, 1584825560),
(80, 'Georgia', 0, 0, 1584825560),
(81, 'Germany', 0, 0, 1584825560),
(82, 'Ghana', 0, 0, 1584825560),
(83, 'Gibraltar', 0, 0, 1584825560),
(84, 'Guernsey', 0, 0, 1584825560),
(85, 'Greece', 0, 0, 1584825560),
(86, 'Greenland', 0, 0, 1584825560),
(87, 'Grenada', 0, 0, 1584825560),
(88, 'Guadeloupe', 0, 0, 1584825560),
(89, 'Guam', 0, 0, 1584825560),
(90, 'Guatemala', 0, 0, 1584825560),
(91, 'Guinea', 0, 0, 1584825560),
(92, 'Guinea-Bissau', 0, 0, 1584825560),
(93, 'Guyana', 0, 0, 1584825560),
(94, 'Haiti', 0, 0, 1584825560),
(95, 'Heard and Mc Donald Islands', 0, 0, 1584825560),
(96, 'Honduras', 0, 0, 1584825560),
(97, 'Hong Kong', 0, 0, 1584825560),
(98, 'Hungary', 0, 0, 1584825560),
(99, 'Iceland', 0, 0, 1584825560),
(100, 'India', 0, 0, 1584825560),
(101, 'Isle of Man', 0, 0, 1584825560),
(102, 'Indonesia', 0, 0, 1584825560),
(103, 'Iran (Islamic Republic of)', 0, 0, 1584825560),
(104, 'Iraq', 0, 0, 1584825560),
(105, 'Ireland', 0, 0, 1584825560),
(106, 'Israel', 0, 0, 1584825560),
(107, 'Italy', 0, 0, 1584825560),
(108, 'Ivory Coast', 0, 0, 1584825560),
(109, 'Jersey', 0, 0, 1584825560),
(110, 'Jamaica', 0, 0, 1584825560),
(111, 'Japan', 0, 0, 1584825560),
(112, 'Jordan', 0, 0, 1584825560),
(113, 'Kazakhstan', 0, 0, 1584825560),
(114, 'Kenya', 0, 0, 1584825560),
(115, 'Kiribati', 0, 0, 1584825560),
(116, 'Korea, Democratic People\'s Republic of', 0, 0, 1584825560),
(117, 'Korea, Republic of', 0, 0, 1584825560),
(118, 'Kosovo', 0, 0, 1584825560),
(119, 'Kuwait', 0, 0, 1584825560),
(120, 'Kyrgyzstan', 0, 0, 1584825560),
(121, 'Lao People\'s Democratic Republic', 0, 0, 1584825560),
(122, 'Latvia', 0, 0, 1584825560),
(123, 'Lebanon', 0, 0, 1584825560),
(124, 'Lesotho', 0, 0, 1584825560),
(125, 'Liberia', 0, 0, 1584825560),
(126, 'Libyan Arab Jamahiriya', 0, 0, 1584825560),
(127, 'Liechtenstein', 0, 0, 1584825560),
(128, 'Lithuania', 0, 0, 1584825560),
(129, 'Luxembourg', 0, 0, 1584825560),
(130, 'Macau', 0, 0, 1584825560),
(131, 'North Macedonia', 0, 0, 1584825560),
(132, 'Madagascar', 0, 0, 1584825560),
(133, 'Malawi', 0, 0, 1584825560),
(134, 'Malaysia', 0, 0, 1584825560),
(135, 'Maldives', 0, 0, 1584825560),
(136, 'Mali', 0, 0, 1584825560),
(137, 'Malta', 0, 0, 1584825560),
(138, 'Marshall Islands', 0, 0, 1584825560),
(139, 'Martinique', 0, 0, 1584825560),
(140, 'Mauritania', 0, 0, 1584825560),
(141, 'Mauritius', 0, 0, 1584825560),
(142, 'Mayotte', 0, 0, 1584825560),
(143, 'Mexico', 0, 0, 1584825560),
(144, 'Micronesia, Federated States of', 0, 0, 1584825560),
(145, 'Moldova, Republic of', 0, 0, 1584825560),
(146, 'Monaco', 0, 0, 1584825560),
(147, 'Mongolia', 0, 0, 1584825560),
(148, 'Montenegro', 0, 0, 1584825560),
(149, 'Montserrat', 0, 0, 1584825560),
(150, 'Morocco', 0, 0, 1584825560),
(151, 'Mozambique', 0, 0, 1584825560),
(152, 'Myanmar', 0, 0, 1584825560),
(153, 'Namibia', 0, 0, 1584825560),
(154, 'Nauru', 0, 0, 1584825560),
(155, 'Nepal', 0, 0, 1584825560),
(156, 'Netherlands', 0, 0, 1584825560),
(157, 'Netherlands Antilles', 0, 0, 1584825560),
(158, 'New Caledonia', 0, 0, 1584825560),
(159, 'New Zealand', 0, 0, 1584825560),
(160, 'Nicaragua', 0, 0, 1584825560),
(161, 'Niger', 0, 0, 1584825560),
(162, 'Nigeria', 0, 0, 1584825560),
(163, 'Niue', 0, 0, 1584825560),
(164, 'Norfolk Island', 0, 0, 1584825560),
(165, 'Northern Mariana Islands', 0, 0, 1584825560),
(166, 'Norway', 0, 0, 1584825560),
(167, 'Oman', 0, 0, 1584825560),
(168, 'Pakistan', 0, 0, 1584825560),
(169, 'Palau', 0, 0, 1584825560),
(170, 'Palestine', 0, 0, 1584825560),
(171, 'Panama', 0, 0, 1584825560),
(172, 'Papua New Guinea', 0, 0, 1584825560),
(173, 'Paraguay', 0, 0, 1584825560),
(174, 'Peru', 0, 0, 1584825560),
(175, 'Philippines', 0, 0, 1584825560),
(176, 'Pitcairn', 0, 0, 1584825560),
(177, 'Poland', 0, 0, 1584825560),
(178, 'Portugal', 0, 0, 1584825560),
(179, 'Puerto Rico', 0, 0, 1584825560),
(180, 'Qatar', 0, 0, 1584825560),
(181, 'Reunion', 0, 0, 1584825560),
(182, 'Romania', 0, 0, 1584825560),
(183, 'Russian Federation', 0, 0, 1584825560),
(184, 'Rwanda', 0, 0, 1584825560),
(185, 'Saint Kitts and Nevis', 0, 0, 1584825560),
(186, 'Saint Lucia', 0, 0, 1584825560),
(187, 'Saint Vincent and the Grenadines', 0, 0, 1584825560),
(188, 'Samoa', 0, 0, 1584825560),
(189, 'San Marino', 0, 0, 1584825560),
(190, 'Sao Tome and Principe', 0, 0, 1584825560),
(191, 'Saudi Arabia', 0, 0, 1584825560),
(192, 'Senegal', 0, 0, 1584825560),
(193, 'Serbia', 0, 0, 1584825560),
(194, 'Seychelles', 0, 0, 1584825560),
(195, 'Sierra Leone', 0, 0, 1584825560),
(196, 'Singapore', 0, 0, 1584825560),
(197, 'Slovakia', 0, 0, 1584825560),
(198, 'Slovenia', 0, 0, 1584825560),
(199, 'Solomon Islands', 0, 0, 1584825560),
(200, 'Somalia', 0, 0, 1584825560),
(201, 'South Africa', 0, 0, 1584825560),
(202, 'South Georgia South Sandwich Islands', 0, 0, 1584825560),
(203, 'South Sudan', 0, 0, 1584825560),
(204, 'Spain', 0, 0, 1584825560),
(205, 'Sri Lanka', 0, 0, 1584825560),
(206, 'St. Helena', 0, 0, 1584825560),
(207, 'St. Pierre and Miquelon', 0, 0, 1584825560),
(208, 'Sudan', 0, 0, 1584825560),
(209, 'Suriname', 0, 0, 1584825560),
(210, 'Svalbard and Jan Mayen Islands', 0, 0, 1584825560),
(211, 'Swaziland', 0, 0, 1584825560),
(212, 'Sweden', 0, 0, 1584825560),
(213, 'Switzerland', 0, 0, 1584825560),
(214, 'Syrian Arab Republic', 0, 0, 1584825560),
(215, 'Taiwan', 0, 0, 1584825560),
(216, 'Tajikistan', 0, 0, 1584825560),
(217, 'Tanzania, United Republic of', 0, 0, 1584825560),
(218, 'Thailand', 0, 0, 1584825560),
(219, 'Togo', 0, 0, 1584825560),
(220, 'Tokelau', 0, 0, 1584825560),
(221, 'Tonga', 0, 0, 1584825560),
(222, 'Trinidad and Tobago', 0, 0, 1584825560),
(223, 'Tunisia', 0, 0, 1584825560),
(224, 'Turkey', 0, 0, 1584825560),
(225, 'Turkmenistan', 0, 0, 1584825560),
(226, 'Turks and Caicos Islands', 0, 0, 1584825560),
(227, 'Tuvalu', 0, 0, 1584825560),
(228, 'Uganda', 0, 0, 1584825560),
(229, 'Ukraine', 0, 0, 1584825560),
(230, 'United Arab Emirates', 0, 0, 1584825560),
(231, 'United Kingdom', 0, 0, 1584825560),
(232, 'United States', 0, 0, 1584825560),
(233, 'United States minor outlying islands', 0, 0, 1584825560),
(234, 'Uruguay', 0, 0, 1584825560),
(235, 'Uzbekistan', 0, 0, 1584825560),
(236, 'Vanuatu', 0, 0, 1584825560),
(237, 'Vatican City State', 0, 0, 1584825560),
(238, 'Venezuela', 0, 0, 1584825560),
(239, 'Vietnam', 0, 0, 1584825560),
(240, 'Virgin Islands (British)', 0, 0, 1584825560),
(241, 'Virgin Islands (U.S.)', 0, 0, 1584825560),
(242, 'Wallis and Futuna Islands', 0, 0, 1584825560),
(243, 'Western Sahara', 0, 0, 1584825560),
(244, 'Yemen', 0, 0, 1584825560),
(245, 'Zambia', 0, 0, 1584825560),
(246, 'Zimbabwe', 0, 0, 1584825560);

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_detect`
--

CREATE TABLE `cvdb_detect` (
  `id` int(11) NOT NULL,
  `time` varchar(45) COLLATE utf8_persian_ci NOT NULL COMMENT 'timestamp',
  `user_agent` text COLLATE utf8_persian_ci NOT NULL,
  `ip` int(11) NOT NULL COMMENT 'set for ipv6',
  `content` text COLLATE utf8_persian_ci NOT NULL COMMENT 'detect content',
  `detect_rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_login`
--

CREATE TABLE `cvdb_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` int(11) NOT NULL COMMENT 'timestamp',
  `user_agent` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_symptom`
--

CREATE TABLE `cvdb_symptom` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '[1 : text answer] [2 : yes or no answer]',
  `impact_percentage` int(11) NOT NULL COMMENT 'Percentage of impact this symptom',
  `updated_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `cvdb_symptom`
--

INSERT INTO `cvdb_symptom` (`id`, `title`, `type`, `impact_percentage`, `updated_time`) VALUES
(1, 'Fever', 1, 83, 1584789476),
(2, 'Cough', 2, 76, 1584789476),
(3, 'Fetigue', 2, 38, 1584789476),
(4, 'Coughing up Sputum', 2, 33, 1584789476),
(5, 'Shortness of Breath', 2, 19, 1584789476),
(6, 'Bone or Joint Pain', 2, 15, 1584789476),
(7, 'Headache', 2, 14, 1584789476),
(8, 'Sore throat', 2, 14, 1584789476),
(9, 'Chills', 2, 11, 1584789476),
(10, 'Nausea or Vomiting', 2, 5, 1584789476),
(11, 'Stuffy Nose', 2, 5, 1584789476),
(12, 'Special diseases', 2, 10, 1584789476),
(13, 'Age', 1, 0, 1584789476),
(14, 'Sex', 2, 0, 1584789476),
(15, 'Diarrhea', 2, 5, 1584789476);

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_user`
--

CREATE TABLE `cvdb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_persian_ci NOT NULL COMMENT 'set for sha1 char len size'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `cvdb_user`
--

INSERT INTO `cvdb_user` (`id`, `username`, `password`) VALUES
(1, 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad');

-- --------------------------------------------------------

--
-- Table structure for table `cvdb_view`
--

CREATE TABLE `cvdb_view` (
  `id` bigint(20) NOT NULL,
  `time` int(11) NOT NULL COMMENT 'timestamp',
  `user_agent` text COLLATE utf8_persian_ci NOT NULL,
  `ip` varchar(45) COLLATE utf8_persian_ci NOT NULL COMMENT 'set for ipv6',
  `section` varchar(100) COLLATE utf8_persian_ci NOT NULL COMMENT 'view section'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cvdb_country`
--
ALTER TABLE `cvdb_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvdb_detect`
--
ALTER TABLE `cvdb_detect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvdb_login`
--
ALTER TABLE `cvdb_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cvdb_symptom`
--
ALTER TABLE `cvdb_symptom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvdb_user`
--
ALTER TABLE `cvdb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvdb_view`
--
ALTER TABLE `cvdb_view`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cvdb_country`
--
ALTER TABLE `cvdb_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `cvdb_detect`
--
ALTER TABLE `cvdb_detect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cvdb_login`
--
ALTER TABLE `cvdb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cvdb_symptom`
--
ALTER TABLE `cvdb_symptom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cvdb_user`
--
ALTER TABLE `cvdb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cvdb_view`
--
ALTER TABLE `cvdb_view`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cvdb_login`
--
ALTER TABLE `cvdb_login`
  ADD CONSTRAINT `cvdb_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cvdb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
