<?php // Ouverture du tag PHP
require_once 'config/database.php'; // Inclusion du fichier de configuration de la base de données
require_once 'includes/auth.php'; // Inclusion du fichier d'authentification
include 'includes/header.php'; // Inclusion de l'en-tête de la page
?> <!-- Fermeture du tag PHP -->

<section class="hero"> <!-- Section héro avec classe CSS -->
    <h1>Bienvenue chez TechSolutions</h1> <!-- Titre principal de la page -->
    <p>Votre partenaire pour des solutions technologiques innovantes</p> <!-- Sous-titre descriptif -->
    <a href="api/login.php" class="service-link">Se connecter</a> <!-- Lien vers la page de connexion -->
</section> <!-- Fin de la section héro -->

<section class="services"> <!-- Section des services -->
    <h2>Nos Services</h2> <!-- Titre de la section services -->
    <div class="service-grid"> <!-- Conteneur en grille pour les services -->
        <div class="service-card"> <!-- Carte de service 1 -->
            <h3>Applications Mobiles</h3> <!-- Titre du service -->
            <p>Applications iOS et Android sur mesure pour vos besoins</p> <!-- Description du service -->
        </div> <!-- Fin de la carte service 1 -->
        <div class="service-card"> <!-- Carte de service 2 -->
            <h3>Consulting IT</h3> <!-- Titre du service -->
            <p>Conseils stratégiques pour votre transformation digitale</p> <!-- Description du service -->
        </div> <!-- Fin de la carte service 2 -->
        <div class="service-card"> <!-- Carte de service 3 -->
            <h3>Support Technique</h3> <!-- Titre du service -->
            <p>Assistance et maintenance de vos systèmes informatiques</p> <!-- Description du service -->
        </div> <!-- Fin de la carte service 3 -->
    </div> <!-- Fin du conteneur grille -->
</section> <!-- Fin de la section services -->

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
