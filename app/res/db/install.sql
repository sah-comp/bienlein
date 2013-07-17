-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2013 at 11:32 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bienlein`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) unsigned DEFAULT NULL,
  `person_id` int(11) unsigned DEFAULT NULL,
  `formattedaddress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_address_country` (`country_id`),
  KEY `index_foreignkey_address_person` (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `iso` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(3) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE IF NOT EXISTS `criteria` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `op` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filter_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_criteria_filter` (`filter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `iso` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) unsigned DEFAULT NULL,
  `sign` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fractionalunit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbertobasic` tinyint(3) unsigned DEFAULT NULL,
  `exchangerate` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domain_id` int(11) unsigned DEFAULT NULL,
  `invisible` tinyint(3) unsigned DEFAULT NULL,
  `sequence` int(11) unsigned DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastmodified` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_domain_domain` (`domain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domaini18n`
--

CREATE TABLE IF NOT EXISTS `domaini18n` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domain_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_domaini18n_domain` (`domain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filter`
--

CREATE TABLE IF NOT EXISTS `filter` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `stamp` int(11) unsigned DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_info_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_news`
--

CREATE TABLE IF NOT EXISTS `info_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned DEFAULT NULL,
  `info_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_19d604bee84c5d3e5260e565090ebc1d0a9c823d` (`info_id`,`news_id`),
  KEY `index_for_info_news_news_id` (`news_id`),
  KEY `index_for_info_news_info_id` (`info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_page`
--

CREATE TABLE IF NOT EXISTS `info_page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) unsigned DEFAULT NULL,
  `info_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_ee9052a72f7f9b71215857e78523438616b13827` (`info_id`,`page_id`),
  KEY `index_for_info_page_page_id` (`page_id`),
  KEY `index_for_info_page_info_id` (`info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_person`
--

CREATE TABLE IF NOT EXISTS `info_person` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` int(11) unsigned DEFAULT NULL,
  `info_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_cfade900b733c586de4479cf31d1b7db6bdc0144` (`info_id`,`person_id`),
  KEY `index_for_info_person_person_id` (`person_id`),
  KEY `index_for_info_person_info_id` (`info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_user`
--

CREATE TABLE IF NOT EXISTS `info_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `info_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_ad511fe0d0f74a0dc9127b4a10888eaee07d94f6` (`info_id`,`user_id`),
  KEY `index_for_info_user_user_id` (`user_id`),
  KEY `index_for_info_user_info_id` (`info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `iso` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(3) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `stamp` int(11) unsigned DEFAULT NULL,
  `attempt` tinyint(1) unsigned DEFAULT NULL,
  `ipaddr` int(11) unsigned DEFAULT NULL,
  `uname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_login_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `extension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) unsigned DEFAULT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sanename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) unsigned DEFAULT NULL,
  `backend` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frontend` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pubdatetime` datetime DEFAULT NULL,
  `newscat_id` int(11) unsigned DEFAULT NULL,
  `online` tinyint(3) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teaser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archived` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_news_newscat` (`newscat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newscat`
--

CREATE TABLE IF NOT EXISTS `newscat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastmodified` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newscati18n`
--

CREATE TABLE IF NOT EXISTS `newscati18n` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `newscat_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_newscati18n_newscat` (`newscat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_tag`
--

CREATE TABLE IF NOT EXISTS `news_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned DEFAULT NULL,
  `tag_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_35e8aa9f42c2991cdc24d16100171582774ff982` (`news_id`,`tag_id`),
  KEY `index_for_news_tag_news_id` (`news_id`),
  KEY `index_for_news_tag_tag_id` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stamp` int(11) unsigned DEFAULT NULL,
  `read` tinyint(3) unsigned DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_user`
--

CREATE TABLE IF NOT EXISTS `notification_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `notification_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_b82bd2cd6ab6c3375c726df804fa0c4efb6af4fe` (`notification_id`,`user_id`),
  KEY `index_for_notification_user_user_id` (`user_id`),
  KEY `index_for_notification_user_notification_id` (`notification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domain_id` int(11) unsigned DEFAULT NULL,
  `invisible` tinyint(3) unsigned DEFAULT NULL,
  `template_id` int(11) unsigned DEFAULT NULL,
  `sequence` int(11) unsigned DEFAULT NULL,
  `keywords` text COLLATE utf8_unicode_ci,
  `desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_page_domain` (`domain_id`),
  KEY `index_foreignkey_page_template` (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domain_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_permission_domain` (`domain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned DEFAULT NULL,
  `permission_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_95e80a2c1e59e79fb65e2920266bc06199ea20cb` (`permission_id`,`role_id`),
  KEY `index_for_permission_role_role_id` (`role_id`),
  KEY `index_for_permission_role_permission_id` (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vatid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attention` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suffix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` tinyint(3) unsigned DEFAULT NULL,
  `jobtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneticlastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneticfirstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(3) unsigned DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person_role`
--

CREATE TABLE IF NOT EXISTS `person_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned DEFAULT NULL,
  `person_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_04c1149539014ed74d6c154643c96003907cef67` (`person_id`,`role_id`),
  KEY `index_for_person_role_role_id` (`role_id`),
  KEY `index_for_person_role_person_id` (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person_tag`
--

CREATE TABLE IF NOT EXISTS `person_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` int(11) unsigned DEFAULT NULL,
  `tag_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_4c8eb2828c6510be7bb21d29e01556243dc3b277` (`person_id`,`tag_id`),
  KEY `index_for_person_tag_person_id` (`person_id`),
  KEY `index_for_person_tag_tag_id` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_region_template` (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rolei18n`
--

CREATE TABLE IF NOT EXISTS `rolei18n` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_rolei18n_role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `lastupdate` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `blessedfolder` tinyint(1) unsigned DEFAULT NULL,
  `sitesfolder` tinyint(3) unsigned DEFAULT NULL,
  `basecurrency` tinyint(1) unsigned DEFAULT NULL,
  `installed` tinyint(1) unsigned DEFAULT NULL,
  `fiscalyear` int(11) unsigned DEFAULT NULL,
  `exchangerateservice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exchangeratelastupd` date DEFAULT NULL,
  `homepage` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slice`
--

CREATE TABLE IF NOT EXISTS `slice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `region_id` tinyint(3) unsigned DEFAULT NULL,
  `sequence` tinyint(3) unsigned DEFAULT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_id` int(11) unsigned DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `tag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `css` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_slice_page` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliceoption`
--

CREATE TABLE IF NOT EXISTS `sliceoption` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` tinyint(1) unsigned DEFAULT NULL,
  `slice_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_sliceoption_slice` (`slice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teami18n`
--

CREATE TABLE IF NOT EXISTS `teami18n` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `team_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_teami18n_team` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `html` text COLLATE utf8_unicode_ci,
  `txt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tokeni18n`
--

CREATE TABLE IF NOT EXISTS `tokeni18n` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_tokeni18n_token` (`token_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shortname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pw` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isadmin` tinyint(3) unsigned DEFAULT NULL,
  `isdeleted` tinyint(3) unsigned DEFAULT NULL,
  `isbanned` tinyint(3) unsigned DEFAULT NULL,
  `screenname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `cons_fk_address_country_id_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `cons_fk_address_person_id_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `criteria`
--
ALTER TABLE `criteria`
  ADD CONSTRAINT `cons_fk_criteria_filter_id_id` FOREIGN KEY (`filter_id`) REFERENCES `filter` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `domain`
--
ALTER TABLE `domain`
  ADD CONSTRAINT `cons_fk_domain_domain_id_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `domaini18n`
--
ALTER TABLE `domaini18n`
  ADD CONSTRAINT `cons_fk_domaini18n_domain_id_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `cons_fk_info_user_id_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `info_news`
--
ALTER TABLE `info_news`
  ADD CONSTRAINT `info_news_ibfk_2` FOREIGN KEY (`info_id`) REFERENCES `info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_news_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_page`
--
ALTER TABLE `info_page`
  ADD CONSTRAINT `info_page_ibfk_2` FOREIGN KEY (`info_id`) REFERENCES `info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_page_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_person`
--
ALTER TABLE `info_person`
  ADD CONSTRAINT `info_person_ibfk_2` FOREIGN KEY (`info_id`) REFERENCES `info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_person_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_user`
--
ALTER TABLE `info_user`
  ADD CONSTRAINT `info_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `info_user_ibfk_2` FOREIGN KEY (`info_id`) REFERENCES `info` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `cons_fk_login_user_id_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `cons_fk_news_newscat_id_id` FOREIGN KEY (`newscat_id`) REFERENCES `newscat` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `newscati18n`
--
ALTER TABLE `newscati18n`
  ADD CONSTRAINT `cons_fk_newscati18n_newscat_id_id` FOREIGN KEY (`newscat_id`) REFERENCES `newscat` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `news_tag`
--
ALTER TABLE `news_tag`
  ADD CONSTRAINT `news_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_tag_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_user`
--
ALTER TABLE `notification_user`
  ADD CONSTRAINT `notification_user_ibfk_2` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `cons_fk_page_domain_id_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `cons_fk_page_template_id_id` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `cons_fk_permission_domain_id_id` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `person_role`
--
ALTER TABLE `person_role`
  ADD CONSTRAINT `person_role_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `person_role_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `person_tag`
--
ALTER TABLE `person_tag`
  ADD CONSTRAINT `person_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `person_tag_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `cons_fk_region_template_id_id` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `rolei18n`
--
ALTER TABLE `rolei18n`
  ADD CONSTRAINT `cons_fk_rolei18n_role_id_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `slice`
--
ALTER TABLE `slice`
  ADD CONSTRAINT `cons_fk_slice_page_id_id` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `sliceoption`
--
ALTER TABLE `sliceoption`
  ADD CONSTRAINT `cons_fk_sliceoption_slice_id_id` FOREIGN KEY (`slice_id`) REFERENCES `slice` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `teami18n`
--
ALTER TABLE `teami18n`
  ADD CONSTRAINT `cons_fk_teami18n_team_id_id` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tokeni18n`
--
ALTER TABLE `tokeni18n`
  ADD CONSTRAINT `cons_fk_tokeni18n_token_id_id` FOREIGN KEY (`token_id`) REFERENCES `token` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;




--
-- Add all countries
--
INSERT INTO `country` (`iso`, `name`, `enabled`) VALUES 
('AD', 'Andorra', 1),
('AE', 'United Arab Emirates', 1),
('AF', 'Afghanistan', 1),
('AG', 'Antigua and Barbuda', 1),
('AI', 'Anguilla', 1),
('AL', 'Albania', 1),
('AM', 'Armenia', 1),
('AN', 'Netherlands Antilles', 1),
('AO', 'Angola', 1),
('AQ', 'Antarctica', 1),
('AR', 'Argentina', 1),
('AS', 'American Samoa', 1),
('AT', 'Austria', 1),
('AU', 'Australia', 1),
('AW', 'Aruba', 1),
('AX', 'Aland Islands', 1),
('AZ', 'Azerbaijan', 1),
('BA', 'Bosnia and Herzegovina', 1),
('BB', 'Barbados', 1),
('BD', 'Bangladesh', 1),
('BE', 'Belgium', 1),
('BF', 'Burkina Faso', 1),
('BG', 'Bulgaria', 1),
('BH', 'Bahrain', 1),
('BI', 'Burundi', 1),
('BJ', 'Benin', 1),
('BM', 'Bermuda', 1),
('BN', 'Brunei', 1),
('BO', 'Bolivia', 1),
('BR', 'Brazil', 1),
('BS', 'Bahamas', 1),
('BT', 'Bhutan', 1),
('BV', 'Bouvet Island', 1),
('BW', 'Botswana', 1),
('BY', 'Belarus', 1),
('BZ', 'Belize', 1),
('CA', 'Canada', 1),
('CC', 'Cocos (Keeling) Islands', 1),
('CD', 'Congo (Kinshasa)', 1),
('CF', 'Central African Republic', 1),
('CG', 'Congo (Brazzaville)', 1),
('CH', 'Switzerland', 1),
('CI', 'Ivory Coast', 1),
('CK', 'Cook Islands', 1),
('CL', 'Chile', 1),
('CM', 'Cameroon', 1),
('CN', 'China', 1),
('CO', 'Colombia', 1),
('CR', 'Costa Rica', 1),
('CS', 'Serbia And Montenegro', 1),
('CU', 'Cuba', 1),
('CV', 'Cape Verde', 1),
('CX', 'Christmas Island', 1),
('CY', 'Cyprus', 1),
('CZ', 'Czech Republic', 1),
('DE', 'Germany', 1),
('DJ', 'Djibouti', 1),
('DK', 'Denmark', 1),
('DM', 'Dominica', 1),
('DO', 'Dominican Republic', 1),
('DZ', 'Algeria', 1),
('EC', 'Ecuador', 1),
('EE', 'Estonia', 1),
('EG', 'Egypt', 1),
('EH', 'Western Sahara', 1),
('ER', 'Eritrea', 1),
('ES', 'Spain', 1),
('ET', 'Ethiopia', 1),
('FI', 'Finland', 1),
('FJ', 'Fiji', 1),
('FK', 'Falkland Islands', 1),
('FM', 'Micronesia', 1),
('FO', 'Faroe Islands', 1),
('FR', 'France', 1),
('GA', 'Gabon', 1),
('GB', 'United Kingdom', 1),
('GD', 'Grenada', 1),
('GE', 'Georgia', 1),
('GF', 'French Guiana', 1),
('GG', 'Guernsey', 1),
('GH', 'Ghana', 1),
('GI', 'Gibraltar', 1),
('GL', 'Greenland', 1),
('GM', 'Gambia', 1),
('GN', 'Guinea', 1),
('GP', 'Guadeloupe', 1),
('GQ', 'Equatorial Guinea', 1),
('GR', 'Greece', 1),
('GS', 'South Georgia and the South Sandwich Islands', 1),
('GT', 'Guatemala', 1),
('GU', 'Guam', 1),
('GW', 'Guinea-Bissau', 1),
('GY', 'Guyana', 1),
('HK', 'Hong Kong S.A.R., China', 1),
('HM', 'Heard Island and McDonald Islands', 1),
('HN', 'Honduras', 1),
('HR', 'Croatia', 1),
('HT', 'Haiti', 1),
('HU', 'Hungary', 1),
('ID', 'Indonesia', 1),
('IE', 'Ireland', 1),
('IL', 'Israel', 1),
('IM', 'Isle of Man', 1),
('IN', 'India', 1),
('IO', 'British Indian Ocean Territory', 1),
('IQ', 'Iraq', 1),
('IR', 'Iran', 1),
('IS', 'Iceland', 1),
('IT', 'Italy', 1),
('JE', 'Jersey', 1),
('JM', 'Jamaica', 1),
('JO', 'Jordan', 1),
('JP', 'Japan', 1),
('KE', 'Kenya', 1),
('KG', 'Kyrgyzstan', 1),
('KH', 'Cambodia', 1),
('KI', 'Kiribati', 1),
('KM', 'Comoros', 1),
('KN', 'Saint Kitts and Nevis', 1),
('KP', 'North Korea', 1),
('KR', 'South Korea', 1),
('KW', 'Kuwait', 1),
('KY', 'Cayman Islands', 1),
('KZ', 'Kazakhstan', 1),
('LA', 'Laos', 1),
('LB', 'Lebanon', 1),
('LC', 'Saint Lucia', 1),
('LI', 'Liechtenstein', 1),
('LK', 'Sri Lanka', 1),
('LR', 'Liberia', 1),
('LS', 'Lesotho', 1),
('LT', 'Lithuania', 1),
('LU', 'Luxembourg', 1),
('LV', 'Latvia', 1),
('LY', 'Libya', 1),
('MA', 'Morocco', 1),
('MC', 'Monaco', 1),
('MD', 'Moldova', 1),
('MG', 'Madagascar', 1),
('MH', 'Marshall Islands', 1),
('MK', 'Macedonia', 1),
('ML', 'Mali', 1),
('MM', 'Myanmar', 1),
('MN', 'Mongolia', 1),
('MO', 'Macao S.A.R., China', 1),
('MP', 'Northern Mariana Islands', 1),
('MQ', 'Martinique', 1),
('MR', 'Mauritania', 1),
('MS', 'Montserrat', 1),
('MT', 'Malta', 1),
('MU', 'Mauritius', 1),
('MV', 'Maldives', 1),
('MW', 'Malawi', 1),
('MX', 'Mexico', 1),
('MY', 'Malaysia', 1),
('MZ', 'Mozambique', 1),
('NA', 'Namibia', 1),
('NC', 'New Caledonia', 1),
('NE', 'Niger', 1),
('NF', 'Norfolk Island', 1),
('NG', 'Nigeria', 1),
('NI', 'Nicaragua', 1),
('NL', 'Netherlands', 1),
('NO', 'Norway', 1),
('NP', 'Nepal', 1),
('NR', 'Nauru', 1),
('NU', 'Niue', 1),
('NZ', 'New Zealand', 1),
('OM', 'Oman', 1),
('PA', 'Panama', 1),
('PE', 'Peru', 1),
('PF', 'French Polynesia', 1),
('PG', 'Papua New Guinea', 1),
('PH', 'Philippines', 1),
('PK', 'Pakistan', 1),
('PL', 'Poland', 1),
('PM', 'Saint Pierre and Miquelon', 1),
('PN', 'Pitcairn', 1),
('PR', 'Puerto Rico', 1),
('PS', 'Palestinian Territory', 1),
('PT', 'Portugal', 1),
('PW', 'Palau', 1),
('PY', 'Paraguay', 1),
('QA', 'Qatar', 1),
('RE', 'Reunion', 1),
('RO', 'Romania', 1),
('RU', 'Russia', 1),
('RW', 'Rwanda', 1),
('SA', 'Saudi Arabia', 1),
('SB', 'Solomon Islands', 1),
('SC', 'Seychelles', 1),
('SD', 'Sudan', 1),
('SE', 'Sweden', 1),
('SG', 'Singapore', 1),
('SH', 'Saint Helena', 1),
('SI', 'Slovenia', 1),
('SJ', 'Svalbard and Jan Mayen', 1),
('SK', 'Slovakia', 1),
('SL', 'Sierra Leone', 1),
('SM', 'San Marino', 1),
('SN', 'Senegal', 1),
('SO', 'Somalia', 1),
('SR', 'Suriname', 1),
('ST', 'Sao Tome and Principe', 1),
('SV', 'El Salvador', 1),
('SY', 'Syria', 1),
('SZ', 'Swaziland', 1),
('TC', 'Turks and Caicos Islands', 1),
('TD', 'Chad', 1),
('TF', 'French Southern Territories', 1),
('TG', 'Togo', 1),
('TH', 'Thailand', 1),
('TJ', 'Tajikistan', 1),
('TK', 'Tokelau', 1),
('TL', 'East Timor', 1),
('TM', 'Turkmenistan', 1),
('TN', 'Tunisia', 1),
('TO', 'Tonga', 1),
('TR', 'Turkey', 1),
('TT', 'Trinidad and Tobago', 1),
('TV', 'Tuvalu', 1),
('TW', 'Taiwan', 1),
('TZ', 'Tanzania', 1),
('UA', 'Ukraine', 1),
('UG', 'Uganda', 1),
('UM', 'United States Minor Outlying Islands', 1),
('US', 'United States', 1),
('UY', 'Uruguay', 1),
('UZ', 'Uzbekistan', 1),
('VA', 'Vatican', 1),
('VC', 'Saint Vincent and the Grenadines', 1),
('VE', 'Venezuela', 1),
('VG', 'British Virgin Islands', 1),
('VI', 'U.S. Virgin Islands', 1),
('VN', 'Vietnam', 1),
('VU', 'Vanuatu', 1),
('WF', 'Wallis and Futuna', 1),
('WS', 'Samoa', 1),
('YE', 'Yemen', 1),
('YT', 'Mayotte', 1),
('ZA', 'South Africa', 1),
('ZM', 'Zambia', 1),
('ZW', 'Zimbabwe', 1);
