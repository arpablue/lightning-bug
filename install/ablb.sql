/*
SQLyog Ultimate v9.02 
MySQL - 5.7.31 : Database - ablb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ablb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ablb`;

/*Table structure for table `prj` */

DROP TABLE IF EXISTS `prj`;

CREATE TABLE `prj` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `acron` varchar(10) NOT NULL,
  `descr` text,
  `active` smallint(1) NOT NULL DEFAULT '1',
  `remove` smallint(6) NOT NULL,
  `icon` text,
  `createdAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `prj` */

LOCK TABLES `prj` WRITE;

UNLOCK TABLES;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `pwd` text NOT NULL,
  `photo` text NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT '1',
  `removed` smallint(1) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `user` */

LOCK TABLES `user` WRITE;

UNLOCK TABLES;

/*Table structure for table `user_prj` */

DROP TABLE IF EXISTS `user_prj`;

CREATE TABLE `user_prj` (
  `userId` bigint(20) unsigned NOT NULL,
  `prjId` bigint(20) unsigned NOT NULL,
  `active` smallint(1) unsigned NOT NULL DEFAULT '1',
  `remove` smallint(1) unsigned NOT NULL DEFAULT '0',
  `createdAt` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `user_prj` */

LOCK TABLES `user_prj` WRITE;

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
