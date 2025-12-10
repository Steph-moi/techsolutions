<?php // Ouverture du tag PHP
require_once '../includes/auth.php'; // Inclusion du fichier d'authentification
requireAdmin(); // Vérification des droits administrateur

// Suppression - Commentaire expliquant le bloc de suppression de composant
if (isset($_GET['delete'])) { // Vérifie si un ID de composant à supprimer est passé en paramètre GET
    $stmt = $pdo->prepare("DELETE FROM components WHERE id = ?"); // Prépare la requête de suppression
    $stmt->execute([$_GET['delete']]); // Exécute la suppression avec l'ID en paramètre
    header('Location: components.php'); // Redirection vers la page de gestion des composants
    exit; // Arrêt de l'exécution du script
}

// Ajout/Modification - Commentaire expliquant le traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si le formulaire a été soumis en méthode POST
    $nom = trim($_POST['nom']); // Récupère et nettoie le nom du composant saisi
    $type = trim($_POST['type']); // Récupère et nettoie le type de composant saisi
    $prix = floatval($_POST['prix']); // Récupère et convertit le prix en nombre décimal
    $description = trim($_POST['description']); // Récupère et nettoie la description saisie
    
    if (isset($_POST['id']) && !empty($_POST['id'])) { // Vérifie si un ID est présent (modification)
        // Modification - Commentaire indiquant qu'on modifie un composant existant
        $stmt = $pdo->prepare("UPDATE components SET nom = ?, type = ?, prix = ?, description = ? WHERE id = ?"); // Prépare la requête de modification
        $stmt->execute([$nom, $type, $prix, $description, $_POST['id']]); // Exécute la modification avec toutes les données
    } else { // Sinon (ajout d'un nouveau composant)
        // Ajout - Commentaire indiquant qu'on ajoute un nouveau composant
        $stmt = $pdo->prepare("INSERT INTO components (nom, type, prix, description) VALUES (?, ?, ?, ?)"); // Prépare la requête d'insertion
        $stmt->execute([$nom, $type, $prix, $description]); // Exécute l'insertion avec toutes les données
    }
    header('Location: components.php'); // Redirection vers la page de gestion
    exit; // Arrêt de l'exécution du script
}

// Édition - Commentaire expliquant la récupération pour édition
$editComponent = null; // Initialise la variable de composant à éditer
if (isset($_GET['edit'])) { // Vérifie si un ID de composant à éditer est passé en paramètre
    $stmt = $pdo->prepare("SELECT * FROM components WHERE id = ?"); // Prépare la requête de sélection
    $stmt->execute([$_GET['edit']]); // Exécute la requête avec l'ID en paramètre
    $editComponent = $stmt->fetch(); // Récupère les données du composant à éditer
}

// Liste - Commentaire expliquant la récupération de tous les composants
$components = $pdo->query("SELECT * FROM components ORDER BY type, nom")->fetchAll(); // Requête pour récupérer tous les composants triés par type puis nom
?>
<?php include '../includes/header.php'; ?> <!-- Inclusion de l'en-tête de la page -->

<section class="admin-components"> <!-- Section de gestion des composants avec classe CSS -->
    <div class="admin-header"> <!-- En-tête de la section admin -->
        <h1>Gestion des Composants</h1> <!-- Titre principal de la page -->
        <a href="index.php" class="btn-back">← Retour au tableau de bord</a> <!-- Lien de retour vers le tableau de bord -->
    </div> <!-- Fin de l'en-tête -->
    
    <div class="form-container"> <!-- Conteneur du formulaire -->
        <h2><?= $editComponent ? 'Modifier' : 'Nouveau' ?> Composant</h2> <!-- Titre dynamique selon le mode (création/modification) -->
        <form method="POST"> <!-- Formulaire avec méthode POST -->
            <?php if($editComponent): ?> <!-- Vérifie si on est en mode édition -->
                <input type="hidden" name="id" value="<?= $editComponent['id'] ?>"> <!-- Champ caché contenant l'ID du composant à modifier -->
            <?php endif; ?> <!-- Fin de la condition -->
            
            <div class="form-row"> <!-- Ligne de formulaire avec deux colonnes -->
                <div class="form-group"> <!-- Groupe de champ nom -->
                    <label for="nom">Nom du composant *</label> <!-- Étiquette pour le champ nom -->
                    <input type="text" id="nom" name="nom" 
                           value="<?= $editComponent ? htmlspecialchars($editComponent['nom']) : '' ?>" required> <!-- Champ de saisie nom avec valeur pré-remplie en mode édition -->
                </div> <!-- Fin du groupe nom -->
                
                <div class="form-group"> <!-- Groupe de champ type -->
                    <label for="type">Type *</label> <!-- Étiquette pour le champ type -->
                    <select id="type" name="type" required> <!-- Liste déroulante pour le type -->
                        <option value="">Sélectionner un type</option> <!-- Option par défaut -->
                        <option value="Processeur" <?= $editComponent && $editComponent['type'] === 'Processeur' ? 'selected' : '' ?>>Processeur</option> <!-- Option processeur -->
                        <option value="Carte mère" <?= $editComponent && $editComponent['type'] === 'Carte mère' ? 'selected' : '' ?>>Carte mère</option> <!-- Option carte mère -->
                        <option value="RAM" <?= $editComponent && $editComponent['type'] === 'RAM' ? 'selected' : '' ?>>RAM</option> <!-- Option RAM -->
                        <option value="Stockage" <?= $editComponent && $editComponent['type'] === 'Stockage' ? 'selected' : '' ?>>Stockage</option> <!-- Option stockage -->
                        <option value="Carte graphique" <?= $editComponent && $editComponent['type'] === 'Carte graphique' ? 'selected' : '' ?>>Carte graphique</option> <!-- Option carte graphique -->
                        <option value="Alimentation" <?= $editComponent && $editComponent['type'] === 'Alimentation' ? 'selected' : '' ?>>Alimentation</option> <!-- Option alimentation -->
                        <option value="Boîtier" <?= $editComponent && $editComponent['type'] === 'Boîtier' ? 'selected' : '' ?>>Boîtier</option> <!-- Option boîtier -->
                        <option value="Refroidissement" <?= $editComponent && $editComponent['type'] === 'Refroidissement' ? 'selected' : '' ?>>Refroidissement</option> <!-- Option refroidissement -->
                    </select> <!-- Fin de la liste déroulante -->
                </div> <!-- Fin du groupe type -->
            </div> <!-- Fin de la ligne formulaire -->
            
            <div class="form-group"> <!-- Groupe de champ prix -->
                <label for="prix">Prix (€)</label> <!-- Étiquette pour le champ prix -->
                <input type="number" step="0.01" id="prix" name="prix" 
                       value="<?= $editComponent ? $editComponent['prix'] : '' ?>"> <!-- Champ de saisie prix avec décimales -->
            </div> <!-- Fin du groupe prix -->
            
            <div class="form-group"> <!-- Groupe de champ description -->
                <label for="description">Description</label> <!-- Étiquette pour le champ description -->
                <textarea id="description" name="description" rows="3"><?= $editComponent ? htmlspecialchars($editComponent['description']) : '' ?></textarea> <!-- Zone de texte pour la description -->
            </div> <!-- Fin du groupe description -->
            
            <button type="submit"><?= $editComponent ? 'Modifier' : 'Ajouter' ?></button> <!-- Bouton de soumission avec texte dynamique -->
            <?php if($editComponent): ?> <!-- Vérifie si on est en mode édition -->
                <a href="components.php" class="btn-cancel">Annuler</a> <!-- Bouton d'annulation visible seulement en mode édition -->
            <?php endif; ?> <!-- Fin de la condition -->
        </form> <!-- Fin du formulaire -->
    </div> <!-- Fin du conteneur formulaire -->
    
    <div class="components-list"> <!-- Conteneur de la liste des composants -->
        <h2>Composants existants (<?= count($components) ?>)</h2> <!-- Titre de la section liste avec compteur -->
        
        <?php if (empty($components)): ?> <!-- Vérifie si aucun composant n'existe -->
            <p>Aucun composant dans la base de données.</p> <!-- Message si pas de composants -->
            <p><a href="../import_components.php">Importer depuis le catalogue</a></p> <!-- Lien vers l'importation -->
        <?php else: ?> <!-- Sinon (il y a des composants) -->
            <table> <!-- Tableau des composants -->
                <thead> <!-- En-tête du tableau -->
                    <tr> <!-- Ligne d'en-tête -->
                        <th>Nom</th> <!-- Colonne nom -->
                        <th>Type</th> <!-- Colonne type -->
                        <th>Prix</th> <!-- Colonne prix -->
                        <th>Description</th> <!-- Colonne description -->
                        <th>Actions</th> <!-- Colonne actions -->
                    </tr> <!-- Fin de la ligne d'en-tête -->
                </thead> <!-- Fin de l'en-tête -->
                <tbody> <!-- Corps du tableau -->
                    <?php foreach($components as $component): ?> <!-- Boucle pour parcourir chaque composant -->
                    <tr> <!-- Ligne de données -->
                        <td><?= htmlspecialchars($component['nom']) ?></td> <!-- Cellule nom sécurisée -->
                        <td><span class="component-type"><?= htmlspecialchars($component['type']) ?></span></td> <!-- Cellule type avec classe CSS -->
                        <td><?= $component['prix'] > 0 ? number_format($component['prix'], 2) . ' €' : '-' ?></td> <!-- Cellule prix formatée ou tiret si 0 -->
                        <td><?= htmlspecialchars(substr($component['description'], 0, 50)) ?><?= strlen($component['description']) > 50 ? '...' : '' ?></td> <!-- Cellule description tronquée à 50 caractères -->
                        <td> <!-- Cellule actions -->
                            <a href="?edit=<?= $component['id'] ?>">Modifier</a> <!-- Lien de modification avec ID en paramètre -->
                            <a href="?delete=<?= $component['id'] ?>" 
                               onclick="return confirm('Supprimer ce composant ?')">Supprimer</a> <!-- Lien de suppression avec confirmation JavaScript -->
                        </td> <!-- Fin de la cellule actions -->
                    </tr> <!-- Fin de la ligne -->
                    <?php endforeach; ?> <!-- Fin de la boucle -->
                </tbody> <!-- Fin du corps du tableau -->
            </table> <!-- Fin du tableau -->
        <?php endif; ?> <!-- Fin de la condition -->
    </div> <!-- Fin du conteneur liste -->
</section> <!-- Fin de la section admin composants -->

<style>
.form-row { /* Style des lignes de formulaire */
    display: grid; /* Affichage en grille CSS */
    grid-template-columns: 1fr 1fr; /* Deux colonnes égales */
    gap: 1rem; /* Espacement de 1rem entre les colonnes */
}

.component-type { /* Style des types de composants */
    padding: 0.25rem 0.5rem; /* Espacement interne */
    background: #e9ecef; /* Couleur de fond gris clair */
    border-radius: 4px; /* Coins arrondis */
    font-size: 0.875rem; /* Taille de police réduite */
    font-weight: 500; /* Poids de police semi-gras */
}

select { /* Style des listes déroulantes */
    width: 100%; /* Largeur de 100% du conteneur */
    padding: 0.75rem; /* Espacement interne */
    border: 1px solid #ddd; /* Bordure grise */
    border-radius: 4px; /* Coins arrondis */
    font-size: 1rem; /* Taille de police */
    background: white; /* Couleur de fond blanc */
}

@media (max-width: 768px) { /* Styles pour écrans de 768px et moins (responsive) */
    .form-row { /* Ligne de formulaire en mode mobile */
        grid-template-columns: 1fr; /* Une seule colonne */
    }
}
</style>

<?php include '../includes/footer.php'; ?> <!-- Inclusion du pied de page -->