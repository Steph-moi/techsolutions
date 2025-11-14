-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 14 nov. 2025 à 11:09
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `techsolutions`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `auteur_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `auteur_id`, `created_at`, `updated_at`) VALUES
(1, 'Bienvenue sur TechSolutions', 'Nous sommes ravis de vous présenter notre entreprise spécialisée dans les solutions technologiques innovantes.', 1, '2025-11-12 08:18:14', '2025-11-12 08:18:14'),
(2, 'Nos services', 'Découvrez notre gamme complète de services : développement web, applications mobiles et conseil IT.', 1, '2025-11-12 08:18:14', '2025-11-12 08:18:14');

-- --------------------------------------------------------

--
-- Structure de la table `components`
--

CREATE TABLE `components` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `components`
--

INSERT INTO `components` (`id`, `name`, `description`) VALUES
(1, 'Processeur i5', 'CPU 6 cœurs polyvalent'),
(2, 'RAM 16 Go', 'DDR4 2×8 Go'),
(3, 'SSD 500 Go', 'NVMe rapide'),
(4, 'Carte graphique GTX 1660', 'Jeux Full HD'),
(5, 'Boîtier + Alim 500W', 'Tour + alimentation'),
(6, 'Textorm TB1', 'B0001'),
(7, 'Fox spirit AG1 (Noir)', 'B0002'),
(8, 'Textorm TB10', 'B0003'),
(9, 'be quiet! Pure base 600 (Noir)', 'B0004'),
(10, 'ANTEC VSK-4000B-U3/U2', 'B0005'),
(11, 'CORSAIR 3000D Airflow (Noir)', 'B0006'),
(12, 'Fractal Design Pop Silent solid (noir)', 'B0007'),
(13, 'be quiet! Dark Rock 5 ', 'VE01'),
(14, 'be quiet! Pure Wings 3 140mm PWM high-speed', 'VB01'),
(15, 'Intel Core i7-12700KF (3.6 GHz / 5.0 GHz)', 'PR01'),
(16, 'Gigabyte B760M DS3H DDR4', 'CM01'),
(17, 'MSI PRO H610M-E DDR4', 'CM02'),
(18, 'ASUS PRIME Z790-P', 'CM03'),
(19, 'ASRock B450M Pro4 R2.0', 'CM04'),
(20, 'ASUS PRIME B760-PLUS D4', 'CM05'),
(21, 'MSI PRO B760M-P DDR4', 'CM06'),
(22, 'MSI PRO B650-S WIFI', 'CM07'),
(23, 'ASRock A520M-HVS', 'CM08'),
(24, 'Gigabyte GeForce RTX 3060 WINDFORCE OC 12G (LHR)', 'CG01'),
(25, 'Corsair RM850e', 'A01'),
(26, 'G.Skill Aegis 32 Go (2 x 16 Go) DDR4 3200 MHz CL16 ', 'R01'),
(27, 'Samsung SSD 990 PRO M.2 PCIe NVMe 1 To ', 'SS01'),
(28, 'iiyama 27\" LED - G-Master GB2745HSU-B2 Black Hawk ', 'MO01'),
(29, 'INOVU LK120 (AZERTY, Fran?ais)', 'C01'),
(30, 'Speedlink Piavo', 'S01');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `consent_rgpd` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `nom`, `email`, `sujet`, `message`, `consent_rgpd`, `created_at`) VALUES
(1, 'a', 'baldinosteph1123@gmail.com', 'aaaaaaaaaaa', 'aa', 1, '2025-11-12 08:48:50');

-- --------------------------------------------------------

--
-- Structure de la table `gdpr_logs`
--

CREATE TABLE `gdpr_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` enum('access','export','delete','update') NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ordinateurs`
--

CREATE TABLE `ordinateurs` (
  `id` int(11) NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ordinateurs`
--

INSERT INTO `ordinateurs` (`id`, `nom`, `prix`, `processeur`, `ram`, `stockage`, `carte_graphique`, `description`, `image`, `disponible`, `created_at`, `updated_at`) VALUES
(1, 'PC Gamer Pro', 1299.99, 'Intel Core i7-12700K', '16 GB DDR4', '1 TB SSD', 'NVIDIA RTX 3070', 'PC gaming haute performance pour les jeux les plus exigeants', NULL, 1, '2025-11-12 08:46:57', '2025-11-12 08:46:57'),
(2, 'PC Bureau Standard', 599.99, 'Intel Core i5-12400', '8 GB DDR4', '512 GB SSD', 'Intel UHD Graphics', 'PC parfait pour le travail de bureau et navigation web', NULL, 1, '2025-11-12 08:46:57', '2025-11-12 08:46:57'),
(3, 'Workstation Pro', 2199.99, 'AMD Ryzen 9 5900X', '32 GB DDR4', '2 TB SSD', 'NVIDIA RTX 3080', 'Station de travail pour professionnels créatifs', NULL, 1, '2025-11-12 08:46:57', '2025-11-12 08:46:57'),
(4, 'PC Compact', 399.99, 'AMD Ryzen 5 5600G', '8 GB DDR4', '256 GB SSD', 'AMD Radeon Graphics', 'PC compact et économique pour usage quotidien', NULL, 1, '2025-11-12 08:46:57', '2025-11-12 08:46:57'),
(5, 'Gaming Beast', 3499.99, 'Intel Core i9-12900K', '64 GB DDR5', '4 TB SSD', 'NVIDIA RTX 4090', 'Le summum de la performance gaming', NULL, 1, '2025-11-12 08:46:57', '2025-11-12 08:46:57'),
(6, 'PC Gamer Pro', 1299.99, 'Intel Core i7-12700K', '16 GB DDR4', '1 TB SSD', 'NVIDIA RTX 3070', 'PC gaming haute performance pour les jeux les plus exigeants', NULL, 1, '2025-11-12 08:47:08', '2025-11-12 08:47:08'),
(7, 'PC Bureau Standard', 599.99, 'Intel Core i5-12400', '8 GB DDR4', '512 GB SSD', 'Intel UHD Graphics', 'PC parfait pour le travail de bureau et navigation web', NULL, 1, '2025-11-12 08:47:08', '2025-11-12 08:47:08'),
(8, 'Workstation Pro', 2199.99, 'AMD Ryzen 9 5900X', '32 GB DDR4', '2 TB SSD', 'NVIDIA RTX 3080', 'Station de travail pour professionnels créatifs', NULL, 1, '2025-11-12 08:47:08', '2025-11-12 08:47:08'),
(9, 'PC Compact', 399.99, 'AMD Ryzen 5 5600G', '8 GB DDR4', '256 GB SSD', 'AMD Radeon Graphics', 'PC compact et économique pour usage quotidien', NULL, 1, '2025-11-12 08:47:08', '2025-11-12 08:47:08'),
(10, 'Gaming Beast', 3499.99, 'Intel Core i9-12900K', '64 GB DDR5', '4 TB SSD', 'NVIDIA RTX 4090', 'Le summum de la performance gaming', NULL, 1, '2025-11-12 08:47:08', '2025-11-12 08:47:08');

-- --------------------------------------------------------

--
-- Structure de la table `pcs`
--

CREATE TABLE `pcs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pcs`
--

INSERT INTO `pcs` (`id`, `name`, `image_url`, `price`) VALUES
(1, 'TechSolutions Core', 'https://picsum.photos/seed/pc1/400/260', 549.00),
(2, 'TechSolutions Gamer', 'https://picsum.photos/seed/pc2/400/260', 779.00),
(3, 'TechSolutions Creator', 'https://picsum.photos/seed/pc3/400/260', 999.00);

-- --------------------------------------------------------

--
-- Structure de la table `pc_components`
--

CREATE TABLE `pc_components` (
  `pc_id` int(10) UNSIGNED NOT NULL,
  `component_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pc_components`
--

INSERT INTO `pc_components` (`pc_id`, `component_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `role` enum('admin','client') DEFAULT 'client',
  `consent_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nom`, `prenom`, `telephone`, `role`, `consent_date`, `created_at`, `updated_at`) VALUES
(1, 'admin@techsolutions.com', '$2y$10$99v1JFBPGSEk.KPIDNOGpumLdA0TyQwvW32rR3ISDeVKZxGj63QGq', 'Admin', 'TechSolutions', NULL, 'admin', NULL, '2025-11-12 08:18:14', '2025-11-12 08:18:14');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auteur_id` (`auteur_id`);

--
-- Index pour la table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gdpr_logs`
--
ALTER TABLE `gdpr_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `ordinateurs`
--
ALTER TABLE `ordinateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pcs`
--
ALTER TABLE `pcs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pc_components`
--
ALTER TABLE `pc_components`
  ADD PRIMARY KEY (`pc_id`,`component_id`),
  ADD KEY `component_id` (`component_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `components`
--
ALTER TABLE `components`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `gdpr_logs`
--
ALTER TABLE `gdpr_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ordinateurs`
--
ALTER TABLE `ordinateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `pcs`
--
ALTER TABLE `pcs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`auteur_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `gdpr_logs`
--
ALTER TABLE `gdpr_logs`
  ADD CONSTRAINT `gdpr_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pc_components`
--
ALTER TABLE `pc_components`
  ADD CONSTRAINT `pc_components_ibfk_1` FOREIGN KEY (`pc_id`) REFERENCES `pcs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pc_components_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `components` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
