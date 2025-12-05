<?php // Ouverture du tag PHP
require_once '../includes/auth.php'; // Inclusion du fichier d'authentification
requireAdmin(); // Vérification des droits administrateur

// Suppression - Commentaire expliquant le bloc de suppression d'ordinateur
if (isset($_GET['delete'])) { // Vérifie si un ID d'ordinateur à supprimer est passé en paramètre GET
    $stmt = $pdo->prepare("DELETE FROM ordinateurs WHERE id = ?"); // Prépare la requête de suppression
    $stmt->execute([$_GET['delete']]); // Exécute la suppression avec l'ID en paramètre
    header('Location: ordinateurs.php'); // Redirection vers la page de gestion des ordinateurs
    exit; // Arrêt de l'exécution du script
}

// Ajout/Modification - Commentaire expliquant le traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si le formulaire a été soumis en méthode POST
    $nom = trim($_POST['nom']); // Récupère et nettoie le nom du produit saisi
    $prix = floatval($_POST['prix']); // Récupère et convertit le prix en nombre décimal
    $processeur = trim($_POST['processeur']); // Récupère et nettoie le processeur saisi
    $ram = trim($_POST['ram']); // Récupère et nettoie la RAM saisie
    $stockage = trim($_POST['stockage']); // Récupère et nettoie le stockage saisi
    $carte_graphique = trim($_POST['carte_graphique']); // Récupère et nettoie la carte graphique saisie
    $description = trim($_POST['description']); // Récupère et nettoie la description saisie
    $disponible = isset($_POST['disponible']) ? 1 : 0; // Vérifie si la case disponible est cochée (1 si oui, 0 si non)
    
    if (isset($_POST['id']) && !empty($_POST['id'])) { // Vérifie si un ID est présent (modification)
        // Modification - Commentaire indiquant qu'on modifie un ordinateur existant
        $stmt = $pdo->prepare("UPDATE ordinateurs SET nom = ?, prix = ?, processeur = ?, ram = ?, stockage = ?, carte_graphique = ?, description = ?, disponible = ? WHERE id = ?"); // Prépare la requête de modification
        $stmt->execute([$nom, $prix, $processeur, $ram, $stockage, $carte_graphique, $description, $disponible, $_POST['id']]); // Exécute la modification avec toutes les données
    } else { // Sinon (ajout d'un nouvel ordinateur)
        // Ajout - Commentaire indiquant qu'on ajoute un nouvel ordinateur
        $stmt = $pdo->prepare("INSERT INTO ordinateurs (nom, prix, processeur, ram, stockage, carte_graphique, description, disponible) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); // Prépare la requête d'insertion
        $stmt->execute([$nom, $prix, $processeur, $ram, $stockage, $carte_graphique, $description, $disponible]); // Exécute l'insertion avec toutes les données
    }
    header('Location: ordinateurs.php'); // Redirection vers la page de gestion
    exit; // Arrêt de l'exécution du script
}

// Édition - Commentaire expliquant la récupération pour édition
$editPC = null; // Initialise la variable d'ordinateur à éditer
if (isset($_GET['edit'])) { // Vérifie si un ID d'ordinateur à éditer est passé en paramètre
    $stmt = $pdo->prepare("SELECT * FROM ordinateurs WHERE id = ?"); // Prépare la requête de sélection
    $stmt->execute([$_GET['edit']]); // Exécute la requête avec l'ID en paramètre
    $editPC = $stmt->fetch(); // Récupère les données de l'ordinateur à éditer
}

// Liste - Commentaire expliquant la récupération de tous les ordinateurs
$ordinateurs = $pdo->query("SELECT * FROM ordinateurs ORDER BY created_at DESC")->fetchAll(); // Requête pour récupérer tous les ordinateurs triés par date de création décroissante
?>
<?php include '../includes/header.php'; ?>

<section class="admin-ordinateurs">
    <div class="admin-header">
        <h1>Gestion des Ordinateurs</h1>
        <a href="index.php" class="btn-back">← Retour au tableau de bord</a>
    </div>
    
    <div class="form-container">
        <h2><?= $editPC ? 'Modifier' : 'Nouvel' ?> Ordinateur</h2>
        <form method="POST">
            <?php if($editPC): ?>
                <input type="hidden" name="id" value="<?= $editPC['id'] ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom du produit *</label>
                    <input type="text" id="nom" name="nom" 
                           value="<?= $editPC ? htmlspecialchars($editPC['nom']) : '' ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="prix">Prix (€) *</label>
                    <input type="number" step="0.01" id="prix" name="prix" 
                           value="<?= $editPC ? $editPC['prix'] : '' ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="processeur">Processeur *</label>
                    <input type="text" id="processeur" name="processeur" 
                           value="<?= $editPC ? htmlspecialchars($editPC['processeur']) : '' ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="ram">RAM *</label>
                    <input type="text" id="ram" name="ram" 
                           value="<?= $editPC ? htmlspecialchars($editPC['ram']) : '' ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="stockage">Stockage *</label>
                    <input type="text" id="stockage" name="stockage" 
                           value="<?= $editPC ? htmlspecialchars($editPC['stockage']) : '' ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="carte_graphique">Carte graphique *</label>
                    <input type="text" id="carte_graphique" name="carte_graphique" 
                           value="<?= $editPC ? htmlspecialchars($editPC['carte_graphique']) : '' ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"><?= $editPC ? htmlspecialchars($editPC['description']) : '' ?></textarea>
            </div>
            
            <div class="form-group checkbox">
                <input type="checkbox" id="disponible" name="disponible" 
                       <?= (!$editPC || $editPC['disponible']) ? 'checked' : '' ?>>
                <label for="disponible">Disponible à la vente</label>
            </div>
            
            <button type="submit"><?= $editPC ? 'Modifier' : 'Ajouter' ?></button>
            <?php if($editPC): ?>
                <a href="ordinateurs.php" class="btn-cancel">Annuler</a>
            <?php endif; ?>
        </form>
    </div>
    
    <div class="ordinateurs-list">
        <h2>Ordinateurs existants</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Processeur</th>
                    <th>RAM</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ordinateurs as $pc): ?>
                <tr>
                    <td><?= htmlspecialchars($pc['nom']) ?></td>
                    <td><?= number_format($pc['prix'], 2) ?> €</td>
                    <td><?= htmlspecialchars($pc['processeur']) ?></td>
                    <td><?= htmlspecialchars($pc['ram']) ?></td>
                    <td>
                        <span class="status <?= $pc['disponible'] ? 'available' : 'unavailable' ?>">
                            <?= $pc['disponible'] ? 'Disponible' : 'Indisponible' ?>
                        </span>
                    </td>
                    <td>
                        <a href="?edit=<?= $pc['id'] ?>">Modifier</a>
                        <a href="?delete=<?= $pc['id'] ?>" 
                           onclick="return confirm('Supprimer cet ordinateur ?')">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<style>
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.status {
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
    font-weight: bold;
}

.status.available {
    background: #d4edda;
    color: #155724;
}

.status.unavailable {
    background: #f8d7da;
    color: #721c24;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include '../includes/footer.php'; ?>