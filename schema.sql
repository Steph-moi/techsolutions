-- TechSolutions — Base pédagogique (composants SANS prix, prix sur pcs)
CREATE DATABASE IF NOT EXISTS techsolutions CHARACTER SET utf8mb4;
USE techsolutions;

DROP TABLE IF EXISTS pc_components;
DROP TABLE IF EXISTS components;
DROP TABLE IF EXISTS pcs;

CREATE TABLE components (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT
) ENGINE=InnoDB;

CREATE TABLE pcs (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  image_url VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE pc_components (
  pc_id INT UNSIGNED NOT NULL,
  component_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (pc_id, component_id),
  FOREIGN KEY (pc_id) REFERENCES pcs(id) ON DELETE CASCADE,
  FOREIGN KEY (component_id) REFERENCES components(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Données d'exemple
INSERT INTO components (name, description) VALUES
('Processeur i5', 'CPU 6 cœurs polyvalent'),
('RAM 16 Go', 'DDR4 2×8 Go'),
('SSD 500 Go', 'NVMe rapide'),
('Carte graphique GTX 1660', 'Jeux Full HD'),
('Boîtier + Alim 500W', 'Tour + alimentation');

INSERT INTO pcs (name, image_url, price) VALUES
('TechSolutions Core',    'https://picsum.photos/seed/pc1/400/260', 549.00),
('TechSolutions Gamer',   'https://picsum.photos/seed/pc2/400/260', 779.00),
('TechSolutions Creator', 'https://picsum.photos/seed/pc3/400/260', 999.00);

INSERT INTO pc_components (pc_id, component_id) VALUES
(1,1),(1,2),(1,3),(1,5),
(2,1),(2,2),(2,3),(2,4),(2,5),
(3,1),(3,2),(3,3),(3,4),(3,5);
