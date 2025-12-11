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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `prix` decimal(10,2) DEFAULT 0.00,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `components`
--

LOCK TABLES `components` WRITE;
/*!40000 ALTER TABLE `components` DISABLE KEYS */;
INSERT INTO `components` VALUES (1,'AMD Ryzen 7 7700X','Processeur',399.95,'8 cœurs/16 threads, 4.5-5.4 GHz, Socket AM5'),(2,'AMD Ryzen 5 7600','Processeur',229.95,'6 cœurs/12 threads, 3.8-5.1 GHz, Socket AM5'),(3,'Intel Core i7-1360P','Processeur',449.95,'12 cœurs (4P+8E), jusqu\'à 5.0 GHz, mobile'),(4,'ASUS TUF B650-PLUS WIFI','Carte mère',199.95,'Chipset B650, ATX, Socket AM5, WiFi 6E'),(5,'MSI B650M GAMING PLUS','Carte mère',149.95,'Chipset B650, Micro-ATX, Socket AM5'),(6,'Corsair Vengeance DDR5 32Go','RAM',189.95,'DDR5-5600, 2x16 Go, profil EXPO'),(7,'Kingston FURY DDR5 16Go','RAM',89.95,'DDR5-5600, 2x8 Go, profil EXPO'),(8,'Samsung 990 Pro 1To','Stockage',149.95,'NVMe PCIe 4.0, 7000/5000 Mo/s'),(9,'Kingston SSD NV3 500Go','Stockage',39.95,'NVMe PCIe 4.0, 3500/2100 Mo/s'),(10,'Samsung T7 1To USB-C','Stockage',129.95,'SSD externe chiffré AES-256'),(11,'RTX 5060 OC 8GB','Carte graphique',329.95,'Ray Tracing, DLSS 3, NVENC'),(12,'RX 6400 Challenger ITX','Carte graphique',159.95,'4 Go GDDR6, 75W TDP, multi-écrans'),(13,'Corsair RM750e 750W','Alimentation',119.95,'80+ Gold modulaire, garantie 10 ans'),(14,'Corsair RM650e 650W','Alimentation',99.95,'80+ Gold modulaire'),(15,'be quiet! Dark Rock 5','Ventirad',79.95,'TDP 200W, Silent Wings 135mm PWM'),(16,'Arctic P12 PWM 120mm','Ventilateur',7.95,'56.3 CFM, 0.3 Sone, PWM'),(17,'Fractal Design North','Boîtier',149.95,'ATX, façade mesh, verre trempé'),(18,'Cooler Master Q300L','Boîtier',49.95,'Micro-ATX compact, design sobre'),(19,'ASUS 27\" QHD XG27ACMG','Écran',299.95,'2560x1440, IPS, USB-C PD 65W'),(20,'BenQ 27\" PD2705Q','Écran',449.95,'2560x1440, 99% Adobe RGB, calibré'),(21,'Acer 24\" VG240YM3','Écran',149.95,'1920x1080 Full HD, IPS, hub USB'),(22,'Logitech MX Keys S','Clavier',99.95,'Filaire USB, rétroéclairage LED'),(23,'Logitech K280e','Clavier',29.95,'Résistant éclaboussures, silencieux'),(24,'Logitech MX Master 3S','Souris',89.95,'8000 DPI, 7 boutons programmables'),(25,'Logitech B100 Optical','Souris',14.95,'800 DPI, USB filaire, ambidextre'),(26,'Logitech H390 USB','Casque',44.95,'USB, microphone antibruit, Teams'),(27,'Wacom Intuos Pro Medium','Tablette graphique',249.95,'8192 niveaux pression, Bluetooth'),(28,'Kensington VeriMark','Sécurité',49.95,'Lecteur empreintes, Windows Hello');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordinateurs`
--

LOCK TABLES `ordinateurs` WRITE;
/*!40000 ALTER TABLE `ordinateurs` DISABLE KEYS */;
INSERT INTO `ordinateurs` VALUES (11,'Configuration Type A - DÉVELOPPEMENT',2899.95,'AMD Ryzen 7 7700X (8 cœurs/16 threads, 4.5-5.4 GHz)','Corsair Vengeance DDR5 32 Go (2x16 Go) 5600 MHz','Samsung 990 Pro 1 To NVMe PCIe 4.0 (7000/5000 Mo/s)','GPU intégré AMD Radeon RDNA 2','Poste haute performance pour développement logiciel. Boîtier Fractal Design North, carte mère ASUS TUF B650-PLUS WIFI, alimentation Corsair RM750e 80+ Gold. Double écran ASUS 27\" QHD. Idéal compilation, VM légères, développement multi-thread.',NULL,1,'2025-12-10 22:29:30','2025-12-10 22:29:30'),(12,'Configuration Type A - INFRASTRUCTURES',3299.95,'AMD Ryzen 7 7700X (8 cœurs/16 threads, 4.5-5.4 GHz)','Corsair Vengeance DDR5 64 Go (2x32 Go) 5600 MHz','Samsung 990 Pro 1 To + Samsung 870 EVO 1 To','ASRock Radeon RX 6400 Challenger ITX 4GB','Configuration renforcée pour administration système. 64 Go RAM pour 10+ VM simultanées, double stockage SSD, GPU dédié pour multi-écrans. Virtualisation, serveurs, infrastructure réseau.',NULL,1,'2025-12-10 22:29:30','2025-12-10 22:29:30'),(13,'Configuration Type B - DESIGN UX/UI',3599.95,'AMD Ryzen 7 7700X (8 cœurs/16 threads, 4.5-5.4 GHz)','Corsair Vengeance DDR5 32 Go (2x16 Go) 5600 MHz','Samsung 990 Pro 1 To NVMe PCIe 4.0','ASUS Dual GeForce RTX 5060 OC 8GB GDDR6','Poste créatif professionnel. RTX 5060 8GB pour Adobe Suite, écran BenQ 27\" calibré (99% Adobe RGB), tablette Wacom Intuos Pro. CUDA, Ray Tracing, NVENC vidéo. Design graphique, UX/UI, vidéo.',NULL,1,'2025-12-10 22:29:30','2025-12-10 22:29:30'),(14,'Configuration Type C - BUREAUTIQUE',1299.95,'AMD Ryzen 5 7600 (6 cœurs/12 threads, 3.8-5.1 GHz)','Kingston FURY Beast DDR5 16 Go (2x8 Go) 5600 MHz','Kingston SSD NV3 500 Go PCIe 4.0 NVMe','GPU intégré AMD Radeon RDNA 2','Poste bureautique moderne. Boîtier compact Micro-ATX, carte mère MSI B650M GAMING PLUS WIFI. Double écran 24\" Full HD. Office, Teams, CRM, navigation web. Silencieux et économe.',NULL,1,'2025-12-10 22:29:30','2025-12-10 22:29:30'),(15,'Configuration Type C - POSTE ADAPTÉ HANDICAP VISUEL',1599.95,'AMD Ryzen 5 7600 (6 cœurs/12 threads, 3.8-5.1 GHz)','Kingston FURY Beast DDR5 16 Go (2x8 Go) 5600 MHz','Kingston SSD NV3 500 Go PCIe 4.0 NVMe','GPU intégré AMD Radeon RDNA 2','Configuration bureautique adaptée malvoyants. Clavier gros caractères contrastés, logiciel NVDA, Windows 11 contraste élevé, loupe 200%. Accessibilité maximale, conformité normes françaises.',NULL,1,'2025-12-10 22:29:30','2025-12-10 22:29:30'),(16,'Configuration Type D - DIRECTION POSTES FIXES',1899.95,'AMD Ryzen 5 7600 (6 cœurs/12 threads, 3.8-5.1 GHz)','Kingston Fury Beast DDR5 16 Go (2x8 Go) 5600 MHz','Kingston SSD NV3 500 Go + Samsung T7 1 To externe chiffré','GPU intégré AMD Radeon RDNA 2','Poste direction sécurisé. SSD externe Samsung T7 chiffré AES-256, lecteur biométrique Kensington VeriMark, casque Logitech H390. Sécurité renforcée, documents confidentiels.',NULL,1,'2025-12-10 22:29:30','2025-12-10 22:29:30'),(17,'Configuration Type E - DIRECTION PORTABLE',1949.95,'Intel Core i7-1360P (12 cœurs 4P+8E, jusqu\'à 5.0 GHz)','32 Go DDR5 5200 MHz (soudée)','1 To SSD NVMe PCIe 4.0','NVIDIA T550 4 Go GDDR6 + Intel Iris Xe','Lenovo ThinkPad P16s Gen 2. Écran 16\" WQXGA (2560x1600), WiFi 6E, lecteur empreintes, TPM 2.0, 86 Wh batterie (10-12h). Nomadisme direction, présentations, sécurité maximale.',NULL,1,'2025-12-10 22:29:30','2025-12-10 22:29:30');
/*!40000 ALTER TABLE `ordinateurs` ENABLE KEYS */;
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

-- Dump completed on 2025-12-11 20:29:22
