<?php require_once 'config/database.php'; ?>
<?php include 'includes/header.php'; ?>

<section class="hero">
    <h1>Bienvenue chez TechSolutions</h1>
    <p>Votre partenaire pour des solutions technologiques innovantes</p>
    <a href="api/login.php" class="service-link">Se connecter</a>
</section>

<section class="services">
    <h2>Nos Services</h2>
    <div class="service-grid">
        <div class="service-card">
            <h3>Applications Mobiles</h3>
            <p>Applications iOS et Android sur mesure pour vos besoins</p>
        </div>
        <div class="service-card">
            <h3>Consulting IT</h3>
            <p>Conseils stratégiques pour votre transformation digitale</p>
        </div>
        <div class="service-card">
            <h3>Support Technique</h3>
            <p>Assistance et maintenance de vos systèmes informatiques</p>
        </div>
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
