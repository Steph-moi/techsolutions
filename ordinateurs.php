<?php 
require_once 'config/database.php';

// Récupération des ordinateurs
$stmt = $pdo->query("SELECT * FROM ordinateurs WHERE disponible = 1 ORDER BY prix ASC");
$ordinateurs = $stmt->fetchAll();
?>
<?php include 'includes/header.php'; ?>

<section class="ordinateurs">
    <h1>Nos Ordinateurs</h1>
    <p>Découvrez notre gamme d'ordinateurs adaptés à tous vos besoins</p>
    
    <?php if(empty($ordinateurs)): ?>
        <p>Aucun ordinateur disponible pour le moment.</p>
    <?php else: ?>
        <div class="ordinateurs-grid">
            <?php foreach($ordinateurs as $pc): ?>
                <div class="pc-card">
                    <h3><?= htmlspecialchars($pc['nom']) ?></h3>
                    <div class="prix"><?= number_format($pc['prix'], 2) ?> €</div>
                    
                    <div class="config">
                        <h4>Configuration :</h4>
                        <ul>
                            <li><strong>Processeur :</strong> <?= htmlspecialchars($pc['processeur']) ?></li>
                            <li><strong>RAM :</strong> <?= htmlspecialchars($pc['ram']) ?></li>
                            <li><strong>Stockage :</strong> <?= htmlspecialchars($pc['stockage']) ?></li>
                            <li><strong>Carte graphique :</strong> <?= htmlspecialchars($pc['carte_graphique']) ?></li>
                        </ul>
                    </div>
                    
                    <?php if($pc['description']): ?>
                        <p class="description"><?= htmlspecialchars($pc['description']) ?></p>
                    <?php endif; ?>
                    
                    <div class="actions">
                        <a href="contact.php?produit=<?= urlencode($pc['nom']) ?>" class="btn-contact">
                            Demander un devis
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<style>
.ordinateurs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.pc-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 2rem;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.pc-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.pc-card h3 {
    color: #2c3e50;
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.prix {
    font-size: 2rem;
    font-weight: bold;
    color: #e74c3c;
    margin-bottom: 1.5rem;
}

.config {
    margin-bottom: 1.5rem;
}

.config h4 {
    color: #34495e;
    margin-bottom: 0.5rem;
}

.config ul {
    list-style: none;
    padding: 0;
}

.config li {
    padding: 0.25rem 0;
    border-bottom: 1px solid #ecf0f1;
}

.description {
    color: #7f8c8d;
    font-style: italic;
    margin-bottom: 1.5rem;
}

.btn-contact {
    background: #3498db;
    color: white;
    padding: 0.75rem 1.5rem;
    text-decoration: none;
    border-radius: 4px;
    display: inline-block;
    transition: background 0.3s;
}

.btn-contact:hover {
    background: #2980b9;
}
</style>

<?php include 'includes/footer.php'; ?>