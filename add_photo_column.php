<?php
require_once 'config/database.php';

try {
    // Ajouter la colonne photo à la table ordinateurs
    $pdo->exec("ALTER TABLE ordinateurs ADD COLUMN photo VARCHAR(255) DEFAULT NULL");
    echo "✅ Colonne 'photo' ajoutée avec succès à la table ordinateurs !";
} catch(PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "ℹ️ La colonne 'photo' existe déjà dans la table ordinateurs.";
    } else {
        echo "❌ Erreur : " . $e->getMessage();
    }
}
?>