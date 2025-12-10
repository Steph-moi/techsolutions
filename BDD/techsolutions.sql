-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: techsolutions
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `auteur_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `auteur_id` (`auteur_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`auteur_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Bienvenue sur TechSolutions','Nous sommes ravis de vous présenter notre entreprise spécialisée dans les solutions technologiques innovantes.',1,'2025-11-12 08:18:14','2025-11-12 08:18:14'),(2,'Nos services','Découvrez notre gamme complète de services : développement web, applications mobiles et conseil IT.',1,'2025-11-12 08:18:14','2025-11-12 08:18:14'),(3,'Plus d\'informations sur nous','Nous sommes une entreprise spécialisé dans les services informatiques.',1,'2025-11-17 16:18:24','2025-11-17 16:18:24');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `components`
--

DROP TABLE IF EXISTS `components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `components` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `components`
--

LOCK TABLES `components` WRITE;
/*!40000 ALTER TABLE `components` DISABLE KEYS */;
INSERT INTO `components` VALUES (1,'Processeur i5','CPU 6 cœurs polyvalent'),(2,'RAM 16 Go','DDR4 2×8 Go'),(3,'SSD 500 Go','NVMe rapide'),(4,'Carte graphique GTX 1660','Jeux Full HD'),(5,'Boîtier + Alim 500W','Tour + alimentation'),(6,'Textorm TB1','B0001'),(7,'Fox spirit AG1 (Noir)','B0002'),(8,'Textorm TB10','B0003'),(9,'be quiet! Pure base 600 (Noir)','B0004'),(10,'ANTEC VSK-4000B-U3/U2','B0005'),(11,'CORSAIR 3000D Airflow (Noir)','B0006'),(12,'Fractal Design Pop Silent solid (noir)','B0007'),(13,'be quiet! Dark Rock 5 ','VE01'),(14,'be quiet! Pure Wings 3 140mm PWM high-speed','VB01'),(15,'Intel Core i7-12700KF (3.6 GHz / 5.0 GHz)','PR01'),(16,'Gigabyte B760M DS3H DDR4','CM01'),(17,'MSI PRO H610M-E DDR4','CM02'),(18,'ASUS PRIME Z790-P','CM03'),(19,'ASRock B450M Pro4 R2.0','CM04'),(20,'ASUS PRIME B760-PLUS D4','CM05'),(21,'MSI PRO B760M-P DDR4','CM06'),(22,'MSI PRO B650-S WIFI','CM07'),(23,'ASRock A520M-HVS','CM08'),(24,'Gigabyte GeForce RTX 3060 WINDFORCE OC 12G (LHR)','CG01'),(25,'Corsair RM850e','A01'),(26,'G.Skill Aegis 32 Go (2 x 16 Go) DDR4 3200 MHz CL16 ','R01'),(27,'Samsung SSD 990 PRO M.2 PCIe NVMe 1 To ','SS01'),(28,'iiyama 27\" LED - G-Master GB2745HSU-B2 Black Hawk ','MO01'),(29,'INOVU LK120 (AZERTY, Fran?ais)','C01'),(30,'Speedlink Piavo','S01');
/*!40000 ALTER TABLE `components` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `consent_rgpd` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'a','baldinosteph1123@gmail.com','aaaaaaaaaaa','aa',1,'2025-11-12 08:48:50');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gdpr_logs`
--

DROP TABLE IF EXISTS `gdpr_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gdpr_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` enum('access','export','delete','update') NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `gdpr_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gdpr_logs`
--

LOCK TABLES `gdpr_logs` WRITE;
/*!40000 ALTER TABLE `gdpr_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `gdpr_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordinateurs`
--

DROP TABLE IF EXISTS `ordinateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordinateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `processeur` varchar(255) NOT NULL,
  `ram` varchar(100) NOT NULL,
  `stockage` varchar(100) NOT NULL,
  `carte_graphique` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordinateurs`
--

LOCK TABLES `ordinateurs` WRITE;
/*!40000 ALTER TABLE `ordinateurs` DISABLE KEYS */;
INSERT INTO `ordinateurs` VALUES (1,'PC Gamer Pro',1299.99,'Intel Core i7-12700K','16 GB DDR4','1 TB SSD','NVIDIA RTX 3070','PC gaming haute performance pour les jeux les plus exigeants',NULL,1,'2025-11-12 08:46:57','2025-11-12 08:46:57'),(7,'PC Bureau Standard',599.99,'Intel Core i5-12400','8 GB DDR4','512 GB SSD','Intel UHD Graphics','PC parfait pour le travail de bureau et navigation web',NULL,1,'2025-11-12 08:47:08','2025-11-12 08:47:08'),(8,'Workstation Pro',2199.99,'AMD Ryzen 9 5900X','32 GB DDR4','2 TB SSD','NVIDIA RTX 3080','Station de travail pour professionnels créatifs',NULL,1,'2025-11-12 08:47:08','2025-11-12 08:47:08'),(9,'PC Compact',399.99,'AMD Ryzen 5 5600G','8 GB DDR4','256 GB SSD','AMD Radeon Graphics','PC compact et économique pour usage quotidien',NULL,1,'2025-11-12 08:47:08','2025-11-12 08:47:08'),(10,'Gaming Beast',3499.99,'Intel Core i9-12900K','64 GB DDR5','4 TB SSD','NVIDIA RTX 4090','Le summum de la performance gaming',NULL,1,'2025-11-12 08:47:08','2025-11-12 08:47:08');
/*!40000 ALTER TABLE `ordinateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_components`
--

DROP TABLE IF EXISTS `pc_components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_components` (
  `pc_id` int(10) unsigned NOT NULL,
  `component_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pc_id`,`component_id`),
  KEY `component_id` (`component_id`),
  CONSTRAINT `pc_components_ibfk_1` FOREIGN KEY (`pc_id`) REFERENCES `pcs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pc_components_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `components` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_components`
--

LOCK TABLES `pc_components` WRITE;
/*!40000 ALTER TABLE `pc_components` DISABLE KEYS */;
INSERT INTO `pc_components` VALUES (1,1),(1,2),(1,3),(1,5),(2,1),(2,2),(2,3),(2,4),(2,5),(3,1),(3,2),(3,3),(3,4),(3,5);
/*!40000 ALTER TABLE `pc_components` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pcs`
--

DROP TABLE IF EXISTS `pcs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pcs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pcs`
--

LOCK TABLES `pcs` WRITE;
/*!40000 ALTER TABLE `pcs` DISABLE KEYS */;
INSERT INTO `pcs` VALUES (1,'TechSolutions Core','https://picsum.photos/seed/pc1/400/260',549.00),(2,'TechSolutions Gamer','https://picsum.photos/seed/pc2/400/260',779.00),(3,'TechSolutions Creator','https://picsum.photos/seed/pc3/400/260',999.00);
/*!40000 ALTER TABLE `pcs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `role` enum('admin','client') DEFAULT 'client',
  `consent_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@techsolutions.com','$2y$10$99v1JFBPGSEk.KPIDNOGpumLdA0TyQwvW32rR3ISDeVKZxGj63QGq','Admin','TechSolutions',NULL,'admin',NULL,'2025-11-12 08:18:14','2025-11-12 08:18:14');
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

-- Dump completed on 2025-12-10 21:26:01
