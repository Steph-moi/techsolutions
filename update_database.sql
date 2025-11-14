-- Ajout de la table ordinateurs
CREATE TABLE IF NOT EXISTS ordinateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    processeur VARCHAR(255) NOT NULL,
    ram VARCHAR(100) NOT NULL,
    stockage VARCHAR(100) NOT NULL,
    carte_graphique VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    disponible BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insertion d'ordinateurs d'exemple
INSERT INTO ordinateurs (nom, prix, processeur, ram, stockage, carte_graphique, description) VALUES
('PC Gamer Pro', 1299.99, 'Intel Core i7-12700K', '16 GB DDR4', '1 TB SSD', 'NVIDIA RTX 3070', 'PC gaming haute performance pour les jeux les plus exigeants'),
('PC Bureau Standard', 599.99, 'Intel Core i5-12400', '8 GB DDR4', '512 GB SSD', 'Intel UHD Graphics', 'PC parfait pour le travail de bureau et navigation web'),
('Workstation Pro', 2199.99, 'AMD Ryzen 9 5900X', '32 GB DDR4', '2 TB SSD', 'NVIDIA RTX 3080', 'Station de travail pour professionnels créatifs'),
('PC Compact', 399.99, 'AMD Ryzen 5 5600G', '8 GB DDR4', '256 GB SSD', 'AMD Radeon Graphics', 'PC compact et économique pour usage quotidien'),
('Gaming Beast', 3499.99, 'Intel Core i9-12900K', '64 GB DDR5', '4 TB SSD', 'NVIDIA RTX 4090', 'Le summum de la performance gaming');