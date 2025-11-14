<?php
require_once '../includes/auth.php';
requireAdmin();

// Suppression
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM ordinateurs WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: ordinateurs.php');
    exit;
}

// Ajout/Modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prix = floatval($_POST['prix']);
    $processeur = trim($_POST['processeur']);
    $ram = trim($_POST['ram']);
    $stockage = trim($_POST['stockage']);
    $carte_graphique = trim($_POST['carte_graphique']);
    $description = trim($_POST['description']);
    $disponible = isset($_POST['disponible']) ? 1 : 0;
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Modification
        $stmt = $pdo->prepare("UPDATE ordinateurs SET nom = ?, prix = ?, processeur = ?, ram = ?, stockage = ?, carte_graphique = ?, description = ?, disponible = ? WHERE id = ?");
        $stmt->execute([$nom, $prix, $processeur, $ram, $stockage, $carte_graphique, $description, $disponible, $_POST['id']]);
    } else {
        // Ajout
        $stmt = $pdo->prepare("INSERT INTO ordinateurs (nom, prix, processeur, ram, stockage, carte_graphique, description, disponible) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prix, $processeur, $ram, $stockage, $carte_graphique, $description, $disponible]);
    }
    header('Location: ordinateurs.php');
    exit;
}

// Édition
$editPC = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM ordinateurs WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editPC = $stmt->fetch();
}

// Liste
$ordinateurs = $pdo->query("SELECT * FROM ordinateurs ORDER BY created_at DESC")->fetchAll();
?>
<?php include '../includes/header.php'; ?>

<section class="admin-ordinateurs">
    <h1>Gestion des Ordinateurs</h1>
    
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