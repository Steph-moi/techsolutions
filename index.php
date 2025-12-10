<?php
require_once 'config/database.php';
require_once 'includes/auth.php';
include 'includes/header.php';
?>

<section class="hero">
    <h1>Bienvenue chez TechSolutions</h1>
    <p>Votre partenaire pour des solutions technologiques innovantes</p>
    <a href="api/login.php" class="service-link">Se connecter</a>
</section>

<section class="configurations">
    <h2>Nos Configurations PC</h2>
    <div class="service-grid">
        <?php
        try {
            $stmt = $pdo->query("SELECT * FROM ordinateurs WHERE disponible = 1 ORDER BY prix ASC LIMIT 6");
            $ordinateurs = $stmt->fetchAll();
            
            if ($ordinateurs): 
                foreach ($ordinateurs as $pc): ?>
                    <div class="service-card pc-config">
                        <?php if(isset($pc['photo']) && $pc['photo']): ?>
                            <img src="/techsolutions/uploads/<?= htmlspecialchars($pc['photo']) ?>" alt="<?= htmlspecialchars($pc['nom']) ?>" class="pc-image">
                        <?php else: ?>
                            <div class="pc-placeholder">💻</div>
                        <?php endif; ?>
                        <h3><?= htmlspecialchars($pc['nom']) ?></h3>
                        <div class="pc-price"><?= number_format($pc['prix'], 2) ?> €</div>
                        <div class="pc-specs">
                            <p><strong>Processeur:</strong> <?= htmlspecialchars($pc['processeur']) ?></p>
                            <p><strong>RAM:</strong> <?= htmlspecialchars($pc['ram']) ?></p>
                            <p><strong>Stockage:</strong> <?= htmlspecialchars($pc['stockage']) ?></p>
                            <p><strong>GPU:</strong> <?= htmlspecialchars($pc['carte_graphique']) ?></p>
                        </div>
                        <a href="contact.php?produit=<?= urlencode($pc['nom']) ?>" class="service-link">Demander un devis</a>
                    </div>
                <?php endforeach;
            else: ?>
                <p>Aucune configuration disponible pour le moment.</p>
            <?php endif;
        } catch(PDOException $e) {
            echo '<p>Configurations temporairement indisponibles.</p>';
        }
        ?>
    </div>
</section>

<section class="about">
    <h2>À Propos de TechSolutions</h2>
    <p>TechSolutions est une entreprise spécialisée dans les solutions technologiques innovantes. 
    Depuis notre création, nous accompagnons les entreprises dans leur transformation digitale 
    avec expertise et passion.</p>
    
    <h3>Nos Dernières Actualités</h3>
    <div class="articles-grid">
        <?php
        try {
            $stmt = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC LIMIT 3");
            $articles = $stmt->fetchAll();
            
            if ($articles): 
                foreach ($articles as $article): ?>
                    <article class="article-card">
                        <h4><?= htmlspecialchars($article['titre']) ?></h4>
                        <p><?= htmlspecialchars($article['contenu']) ?></p>
                        <small>Publié le <?= date('d/m/Y', strtotime($article['created_at'])) ?></small>
                    </article>
                <?php endforeach;
            else: ?>
                <p>Aucune actualité pour le moment.</p>
            <?php endif;
        } catch(PDOException $e) {
            echo '<p>Actualités temporairement indisponibles.</p>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
