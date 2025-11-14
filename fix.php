<?php
echo "<h1>🔧 Réparation TechSolutions</h1>";

try {
    // Connexion MySQL
    $pdo = new PDO("mysql:host=localhost", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ MySQL connecté<br>";
    
    // Supprimer et recréer la base
    $pdo->exec("DROP DATABASE IF EXISTS techsolutions");
    $pdo->exec("CREATE DATABASE techsolutions CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE techsolutions");
    echo "✅ Base de données créée<br>";
    
    // Créer les tables
    $pdo->exec("
        CREATE TABLE users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            email VARCHAR(255) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            nom VARCHAR(100) NOT NULL,
            prenom VARCHAR(100) NOT NULL,
            telephone VARCHAR(20),
            role ENUM('admin', 'client') DEFAULT 'client',
            consent_date DATETIME,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");
    echo "✅ Table users créée<br>";
    
    $pdo->exec("
        CREATE TABLE articles (
            id INT PRIMARY KEY AUTO_INCREMENT,
            titre VARCHAR(255) NOT NULL,
            contenu TEXT NOT NULL,
            auteur_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (auteur_id) REFERENCES users(id) ON DELETE SET NULL
        )
    ");
    echo "✅ Table articles créée<br>";
    
    $pdo->exec("
        CREATE TABLE contacts (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nom VARCHAR(100) NOT NULL,
            email VARCHAR(255) NOT NULL,
            sujet VARCHAR(255) NOT NULL,
            message TEXT NOT NULL,
            consent_rgpd BOOLEAN DEFAULT FALSE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo "✅ Table contacts créée<br>";
    
    $pdo->exec("
        CREATE TABLE gdpr_logs (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT,
            action ENUM('access', 'export', 'delete', 'update') NOT NULL,
            details TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )
    ");
    echo "✅ Table gdpr_logs créée<br>";
    
    // Créer la table ordinateurs
    $pdo->exec("
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
        )
    ");
    echo "✅ Table ordinateurs créée<br>";
    
    // Ajouter des ordinateurs d'exemple
    $stmt = $pdo->query("SELECT COUNT(*) FROM ordinateurs");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("
            INSERT INTO ordinateurs (nom, prix, processeur, ram, stockage, carte_graphique, description) VALUES
            ('PC Gamer Pro', 1299.99, 'Intel Core i7-12700K', '16 GB DDR4', '1 TB SSD', 'NVIDIA RTX 3070', 'PC gaming haute performance'),
            ('PC Bureau Standard', 599.99, 'Intel Core i5-12400', '8 GB DDR4', '512 GB SSD', 'Intel UHD Graphics', 'PC parfait pour le bureau'),
            ('Workstation Pro', 2199.99, 'AMD Ryzen 9 5900X', '32 GB DDR4', '2 TB SSD', 'NVIDIA RTX 3080', 'Station de travail professionnelle')
        ");
        echo "✅ Ordinateurs d'exemple ajoutés<br>";
    }
    
    // Créer l'admin
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    $pdo->exec("INSERT INTO users (email, password, nom, prenom, role) VALUES ('admin@techsolutions.com', '$hash', 'Admin', 'TechSolutions', 'admin')");
    echo "✅ Admin créé<br>";
    
    // Ajouter des articles d'exemple
    $stmt = $pdo->prepare("INSERT INTO articles (titre, contenu, auteur_id) VALUES (?, ?, ?)");
    $stmt->execute(['Bienvenue sur TechSolutions', 'Nous sommes ravis de vous présenter notre entreprise spécialisée dans les solutions technologiques innovantes.', 1]);
    $stmt->execute(['Nos services', 'Découvrez notre gamme complète de services : développement web, applications mobiles et conseil IT.', 1]);
    echo "✅ Articles ajoutés<br>";
    
    echo "<h2>🎉 SITE RÉPARÉ !</h2>";
    echo "<p><strong>Connexion admin :</strong> admin@techsolutions.com / admin123</p>";
    echo "<p><a href='index.php' style='background:#007bff;color:white;padding:10px;text-decoration:none;border-radius:4px;'>ACCÉDER AU SITE</a></p>";
    echo "<p><a href='api/login.php' style='background:#28a745;color:white;padding:10px;text-decoration:none;border-radius:4px;'>SE CONNECTER</a></p>";
    
} catch(PDOException $e) {
    echo "<h2>❌ ERREUR</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p><strong>Vérifiez :</strong></p>";
    echo "<ul><li>XAMPP est démarré</li><li>Apache et MySQL sont actifs</li></ul>";
}
?>