-- MySQL dump 10.13  Distrib 5.6.21, for Win32 (x86)
--
-- Host: localhost    Database: pakete
-- ------------------------------------------------------
-- Server version	5.6.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `pakete`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `paketeal_pakete` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `paketeal_pakete`;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_07_30_165011_create_users_table',1),('2014_07_30_223443_create_registers_table',1),('2014_08_23_155540_create_password_reminders_table',1),('2014_10_27_091202_add_lat_long_to_register',1),('2016_07_03_150536_create_password_resets_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reminders`
--

DROP TABLE IF EXISTS `password_reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reminders`
--

LOCK TABLES `password_reminders` WRITE;
/*!40000 ALTER TABLE `password_reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('anap_olavarrieta@hotmail.com','b23fafdb47b1d6eade4186f42e491478c37ce5de4cfb73e04d844e62bf37d07b','2016-07-03 21:15:24'),('anapolavarrieta@gmail.com','c086d4eafe85d6189a93bca00d63bfa88a8de0be2099025160bcea3cc22534f7','2016-07-04 03:23:17');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registers`
--

DROP TABLE IF EXISTS `registers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `latitude` int(11) NOT NULL,
  `longitude` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lat` decimal(11,8) NOT NULL,
  `lon` decimal(11,8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registers_user_id_foreign` (`user_id`),
  CONSTRAINT `registers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registers`
--

LOCK TABLES `registers` WRITE;
/*!40000 ALTER TABLE `registers` DISABLE KEYS */;
INSERT INTO `registers` VALUES (1,0,0,'2015-04-13','21:31:32','error en direccion',1,'2015-04-14 01:31:32','2015-04-14 01:31:32',0.00000000,0.00000000),(2,0,0,'2015-04-13','21:34:08','other_entry',1,'2015-04-14 01:34:08','2015-04-14 01:34:08',40.73127230,-74.05937570),(3,0,0,'2015-04-13','21:34:11','other_exit',1,'2015-04-14 01:34:11','2015-04-14 01:34:11',40.73127230,-74.05937570),(4,0,0,'2015-04-14','21:22:26','other_entry',1,'2015-04-15 01:22:26','2015-04-15 01:22:26',40.73131090,-74.05937570),(5,0,0,'2015-04-14','21:22:29','other_exit',1,'2015-04-15 01:22:29','2015-04-15 01:22:29',40.73131090,-74.05937570),(6,0,0,'2015-07-31','15:30:19','other_entry',1,'2015-07-31 20:30:19','2015-07-31 20:30:19',19.43563380,-99.14951070),(7,0,0,'2015-07-31','15:30:22','other_exit',1,'2015-07-31 20:30:22','2015-07-31 20:30:22',19.43563380,-99.14951070),(8,0,0,'2015-08-04','16:20:10','other_entry',3,'2015-08-04 21:20:10','2015-08-04 21:20:10',19.43563380,-99.14951070),(9,0,0,'2015-08-04','16:20:13','other_exit',3,'2015-08-04 21:20:13','2015-08-04 21:20:13',19.43563380,-99.14951070),(10,0,0,'2015-08-05','11:37:09','other_entry',4,'2015-08-05 16:37:09','2015-08-05 16:37:09',0.00000000,99.15916600),(11,0,0,'2015-08-05','11:37:52','other_entry',4,'2015-08-05 16:37:52','2015-08-05 16:37:52',-19.28756400,99.15916600),(12,0,0,'2015-08-05','11:38:24','entry',4,'2015-08-05 16:38:24','2015-08-05 16:38:24',19.28756400,99.15916600),(13,0,0,'2015-08-05','11:39:49','entry',4,'2015-08-05 16:39:49','2015-08-05 16:39:49',19.28756400,-99.15916600),(14,0,0,'2015-08-05','11:40:46','other_entry',4,'2015-08-05 16:40:46','2015-08-05 16:40:46',19.29922770,-99.10689240);
/*!40000 ALTER TABLE `registers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` tinyint(1) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `university` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `university_id` int(11) NOT NULL,
  `major` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `semester` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'anapolavarrieta@gmail.com',0,'$2y$10$3MkLTSbBuADNnOwzjrOOFOiEhIVCipwdBttQimIRwUFjKwQ9R5t1C','Ana Paula','Olav',56558433,'ibero',4455165,'Ing Negocios',6,1,'2015-04-13 22:57:58','2016-07-04 03:14:53'),(3,'anap@gmail.com',0,'$2y$10$CMiVnuRyovgXPWsOOQ6jjeJ8WWcBKDXV3.9Bj4.L9OTiTARBIdDBG','ana','',0,'ibero',0,'',6,1,'2015-04-13 23:29:10','2016-07-03 18:59:23'),(4,'anapo@gmail.com',0,'$2y$10$8w9EVtLcp/M1tGOpNWIbruorn2gczQzPZ/s9mEkKaKjr/.m8LLNOq','ana','',0,'ibero',0,'',6,0,'2015-04-13 23:29:54','2015-08-05 16:41:13'),(5,'anapol@gmail.com',0,'$2y$10$FhPtjqyBFh5/ffE8WTwnze8zfL0PnDrCEGsRioFZNKJY/f5hzZrr.','ana','',0,'ibero',0,'',6,0,'2015-04-13 23:30:30','2015-04-13 23:30:30'),(6,'anapola@gmail.com',0,'$2y$10$2wQunNs9cwhtOIQ8Dq8eTeStfuzqzmNcMPdzszUiRau8KkipBsoVC','','',0,'ibero',0,'',6,0,'2015-04-13 23:30:55','2015-04-13 23:30:55'),(7,'anapolav@gmail.com',0,'$2y$10$lH3wNHrL29mFZ4t4zAx33uSUddXWNLpp4PkvmkdI1TIPW4iSx/6ni','','',0,'ibero',0,'',6,0,'2015-04-13 23:31:32','2015-04-13 23:39:10'),(8,'anap_olavarrieta@hotmail.com',0,'$2y$10$v2yQLx3ZyCkOmieGyuzSS.Zj2z8vzvWzF20vNjEX7avJ.Ft3.6M9.','Ana ','Olav',2147483647,'ibero',0,'Negocios',6,0,'2016-07-03 19:28:46','2016-07-03 19:28:52');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-09 21:13:31
