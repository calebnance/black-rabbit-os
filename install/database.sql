-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 31, 2016 at 04:17 AM
-- Server version: 5.5.42
-- PHP Version: 5.5.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blackrabbit_2016`
--

-- --------------------------------------------------------

--
-- Table structure for table `br_admins`
--

CREATE TABLE `br_admins` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `br_allfields`
--

CREATE TABLE `br_allfields` (
  `id` int(11) NOT NULL,
  `version` varchar(256) NOT NULL,
  `jversion` varchar(256) NOT NULL,
  `downloadcount` mediumint(255) NOT NULL,
  `lastdownloaded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `br_components`
--

CREATE TABLE `br_components` (
  `id` mediumint(255) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  `cidparent` mediumint(255) unsigned NOT NULL,
  `c_name` varchar(256) NOT NULL,
  `c_file_name` varchar(256) NOT NULL,
  `version` varchar(256) NOT NULL,
  `jversion` varchar(256) NOT NULL,
  `brversion` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `license` text NOT NULL,
  `copyright` text NOT NULL,
  `author` varchar(256) NOT NULL,
  `a_email` varchar(256) NOT NULL,
  `a_url` varchar(256) NOT NULL,
  `category_view` int(2) NOT NULL,
  `tags_view` int(2) NOT NULL,
  `use_usercreated` int(2) NOT NULL,
  `use_datecreated` int(2) NOT NULL,
  `use_database` int(2) NOT NULL,
  `use_imageupload` int(2) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imagethumbhw` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `filesize` varchar(256) NOT NULL,
  `lines_created` int(11) unsigned NOT NULL,
  `files_created` int(11) unsigned NOT NULL,
  `minutes_saved` int(11) unsigned NOT NULL,
  `downloadcount` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `br_components_views`
--

CREATE TABLE `br_components_views` (
  `id` mediumint(255) unsigned NOT NULL,
  `cid` mediumint(255) unsigned NOT NULL,
  `plural` varchar(256) NOT NULL,
  `singular` varchar(256) NOT NULL,
  `fields` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `br_helloworlds`
--

CREATE TABLE `br_helloworlds` (
  `id` int(11) NOT NULL,
  `version` varchar(256) NOT NULL,
  `jversion` varchar(256) NOT NULL,
  `downloadcount` mediumint(255) NOT NULL,
  `lastdownloaded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `br_modules`
--

CREATE TABLE `br_modules` (
  `id` mediumint(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `midparent` mediumint(255) NOT NULL,
  `m_name` varchar(256) NOT NULL,
  `m_file_name` varchar(256) NOT NULL,
  `version` varchar(256) NOT NULL,
  `jversion` varchar(256) NOT NULL,
  `brversion` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `license` varchar(256) NOT NULL,
  `copyright` varchar(256) NOT NULL,
  `author` varchar(256) NOT NULL,
  `author_email` varchar(256) NOT NULL,
  `author_url` varchar(256) NOT NULL,
  `date_created` datetime NOT NULL,
  `filesize` varchar(256) NOT NULL,
  `lines_created` int(11) NOT NULL,
  `files_created` int(11) NOT NULL,
  `minutes_saved` int(11) NOT NULL,
  `download_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `br_packages`
--

CREATE TABLE `br_packages` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `package` varchar(256) NOT NULL,
  `author` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `website` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `filesize` varchar(256) NOT NULL,
  `version` varchar(256) NOT NULL,
  `jversion` varchar(256) NOT NULL,
  `brversion` varchar(256) NOT NULL,
  `lines_created` int(11) NOT NULL,
  `files_created` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `br_users`
--

CREATE TABLE `br_users` (
  `id` int(11) NOT NULL,
  `fname` varchar(256) NOT NULL,
  `lname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `email_code` varchar(256) NOT NULL,
  `email_validated` int(2) NOT NULL,
  `password` varchar(256) NOT NULL,
  `country` varchar(256) NOT NULL,
  `language` varchar(256) NOT NULL,
  `paypal_payment_status` int(2) NOT NULL,
  `paypal_payment_status_text` varchar(256) NOT NULL,
  `paypal_payer_id` varchar(256) NOT NULL,
  `paypal_payment_type` varchar(256) NOT NULL,
  `paypal_payer_status` varchar(256) NOT NULL,
  `paypal_payer_email` varchar(256) NOT NULL,
  `paypal_payer_fname` varchar(256) NOT NULL,
  `paypal_payer_lname` varchar(256) NOT NULL,
  `paypal_payer_tx_id` varchar(256) NOT NULL,
  `paypal_payer_tx_type` varchar(256) NOT NULL,
  `paypal_payment_amount` varchar(256) NOT NULL,
  `paypal_payment_gross` varchar(256) NOT NULL,
  `paypal_payment_currency` varchar(256) NOT NULL,
  `payment_payer_country` varchar(256) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_validated` datetime NOT NULL,
  `date_paid` datetime NOT NULL,
  `date_logged_in` datetime NOT NULL,
  `date_last_logged_in` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `br_admins`
--
ALTER TABLE `br_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `br_allfields`
--
ALTER TABLE `br_allfields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `br_components`
--
ALTER TABLE `br_components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `br_components_views`
--
ALTER TABLE `br_components_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `br_helloworlds`
--
ALTER TABLE `br_helloworlds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `br_modules`
--
ALTER TABLE `br_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `br_packages`
--
ALTER TABLE `br_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `br_users`
--
ALTER TABLE `br_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `br_admins`
--
ALTER TABLE `br_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `br_allfields`
--
ALTER TABLE `br_allfields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `br_components`
--
ALTER TABLE `br_components`
  MODIFY `id` mediumint(255) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `br_components_views`
--
ALTER TABLE `br_components_views`
  MODIFY `id` mediumint(255) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `br_helloworlds`
--
ALTER TABLE `br_helloworlds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `br_modules`
--
ALTER TABLE `br_modules`
  MODIFY `id` mediumint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `br_packages`
--
ALTER TABLE `br_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `br_users`
--
ALTER TABLE `br_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
