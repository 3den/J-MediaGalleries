-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2008 at 02:40 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

-- --------------------------------------------------------

--
-- Table structure for table `#__mediagalleries`
--

CREATE TABLE IF NOT EXISTS `#__mediagalleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `url` text COLLATE utf8_general_ci NOT NULL,
  `thumb_url` text COLLATE utf8_general_ci NOT NULL,
  `title` text COLLATE utf8_general_ci NOT NULL,
  `alias` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `description` text COLLATE utf8_general_ci NOT NULL,
  `hits` int(10) unsigned NOT NULL,
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `created_by_alias` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(10) unsigned NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `language` char(7) COLLATE utf8_general_ci NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL,
  `xreference` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `params` text COLLATE utf8_general_ci NOT NULL,
  `access` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_access` (  `access` ),
  INDEX `idx_catid` (`catid` ASC) ,
  INDEX `idx_xreference` (`xreference` ASC) ,
  INDEX `idx_language` (`language` ASC) ,
  INDEX `idx_checked_out` (`checked_out` ASC) ,
  INDEX `idx_alias` (`alias` ASC) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

