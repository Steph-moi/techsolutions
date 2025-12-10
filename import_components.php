<?php
/*
 * SCRIPT D'IMPORTATION DES COMPOSANTS DEPUIS LE CATALOGUE
 * 
 * Ce script permet d'importer les composants du catalogue vers la table components de la BDD.
 * Vous devez d'abord exporter votre fichier catalogue.ods en CSV.
 * 
 * Instructions :
 * 1. Ouvrir le fichier catalogue.ods
 * 2. L'exporter en format CSV (séparateur virgule)
 * 3. Placer le fichier CSV dans le même dossier que ce script
 * 4. Modifier le nom du fichier CSV ci-dessous si nécessaire
 * 5. Exécuter ce script via le navigateur
 */

require_once 'config/database.php'; // Inclusion de la configuration de la base de données

// Nom du fichier CSV (à modifier selon votre fichier)
$csvFile = 'catalogue.csv'; // Nom du fichier CSV exporté depuis le catalogue.ods

// Vérification de l'existence du fichier
if (!file_exists($csvFile)) { // Vérifie si le fichier CSV existe
    die("<h1>❌ Erreur</h1><p>Le fichier <strong>$csvFile</strong> n'existe pas.</p>
         <p>Veuillez exporter votre catalogue.ods en CSV et le placer dans ce dossier.</p>");
}

try { // Début du bloc try pour gérer les erreurs
    // Ouverture du fichier CSV
    $handle = fopen($csvFile, 'r'); // Ouvre le fichier CSV en lecture
    
    if ($handle === FALSE) { // Vérifie si l'ouverture a échoué
        throw new Exception("Impossible d'ouvrir le fichier CSV"); // Lance une exception
    }
    
    // Lecture de la première ligne (en-têtes)
    $headers = fgetcsv($handle, 1000, ','); // Lit la première ligne contenant les en-têtes
    
    if ($headers === FALSE) { // Vérifie si la lecture a échoué
        throw new Exception("Impossible de lire les en-têtes du fichier CSV"); // Lance une exception
    }
    
    echo "<h1>📦 Importation des composants</h1>"; // Affiche le titre
    echo "<p><strong>Fichier :</strong> $csvFile</p>"; // Affiche le nom du fichier
    echo "<p><strong>Colonnes détectées :</strong> " . implode(', ', $headers) . "</p>"; // Affiche les colonnes
    
    $imported = 0; // Compteur des composants importés
    $errors = 0; // Compteur des erreurs
    
    // Lecture ligne par ligne
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) { // Lit chaque ligne du CSV
        
        // Vérification que la ligne a le bon nombre de colonnes
        if (count($data) < 2) { // Vérifie qu'il y a au moins 2 colonnes (nom et type minimum)
            $errors++; // Incrémente le compteur d'erreurs
            continue; // Passe à la ligne suivante
        }
        
        // Extraction des données (adapter selon votre structure CSV)
        $nom = trim($data[0]); // Premier champ : nom du composant
        $type = trim($data[1]); // Deuxième champ : type de composant
        $prix = isset($data[2]) ? floatval($data[2]) : 0; // Troisième champ : prix (optionnel)
        $description = isset($data[3]) ? trim($data[3]) : ''; // Quatrième champ : description (optionnel)
        
        // Vérification des données obligatoires
        if (empty($nom) || empty($type)) { // Vérifie que nom et type ne sont pas vides
            $errors++; // Incrémente le compteur d'erreurs
            continue; // Passe à la ligne suivante
        }
        
        try { // Bloc try pour l'insertion
            // Insertion en base de données
            $stmt = $pdo->prepare("INSERT INTO components (nom, type, prix, description) VALUES (?, ?, ?, ?)"); // Prépare la requête d'insertion
            $stmt->execute([$nom, $type, $prix, $description]); // Exécute l'insertion
            $imported++; // Incrémente le compteur d'importations réussies
            
        } catch (PDOException $e) { // Capture les erreurs PDO
            $errors++; // Incrémente le compteur d'erreurs
            echo "<p style='color: red;'>Erreur pour '$nom': " . $e->getMessage() . "</p>"; // Affiche l'erreur
        }
    }
    
    fclose($handle); // Ferme le fichier CSV
    
    // Affichage du résultat
    echo "<h2>✅ Importation terminée</h2>"; // Titre du résultat
    echo "<p><strong>Composants importés :</strong> $imported</p>"; // Nombre d'importations réussies
    echo "<p><strong>Erreurs :</strong> $errors</p>"; // Nombre d'erreurs
    
    if ($imported > 0) { // Si des composants ont été importés
        echo "<p><a href='admin/components.php'>Voir les composants importés</a></p>"; // Lien vers la gestion des composants
    }
    
} catch (Exception $e) { // Capture toutes les autres exceptions
    echo "<h1>❌ Erreur</h1>"; // Titre d'erreur
    echo "<p>" . $e->getMessage() . "</p>"; // Message d'erreur
}
?>

<style>
body { font-family: Arial, sans-serif; margin: 2rem; }
h1 { color: #2c3e50; }
h2 { color: #27ae60; }
p { margin: 0.5rem 0; }
</style>