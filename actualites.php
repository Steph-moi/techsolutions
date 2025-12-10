<?php // Ouverture du tag PHP
require_once 'config/database.php'; // Inclusion du fichier de configuration de la base de données

// Récupération des articles - Commentaire expliquant la requête suivante
$stmt = $pdo->query("SELECT a.*, u.prenom, u.nom FROM articles a 
                     LEFT JOIN users u ON a.auteur_id = u.id 
                     ORDER BY a.created_at DESC"); // Requête SQL pour récupérer tous les articles avec les infos auteur, triés par date décroissante
$articles = $stmt->fetchAll(); // Récupération de tous les résultats dans un tableau
?>
<?php include 'includes/header.php'; ?> <!-- Inclusion de l'en-tête de la page -->

<section class="actualites"> <!-- Section des actualités avec classe CSS -->
    <h1>Actualités</h1> <!-- Titre principal de la page -->
    
    <?php if(empty($articles)): ?> <!-- Vérification si le tableau d'articles est vide -->
        <p>Aucune actualité pour le moment.</p> <!-- Message affiché s'il n'y a pas d'articles -->
    <?php else: ?> <!-- Sinon (s'il y a des articles) -->
        <div class="articles-grid"> <!-- Conteneur en grille pour les articles -->
            <?php foreach($articles as $article): ?> <!-- Boucle pour parcourir chaque article -->
                <article class="article-card"> <!-- Balise article avec classe CSS -->
                    <h2><?= htmlspecialchars($article['titre']) ?></h2> <!-- Titre de l'article sécurisé contre XSS -->
                    <p class="meta"> <!-- Paragraphe pour les métadonnées -->
                        Par <?= htmlspecialchars($article['prenom'] . ' ' . $article['nom']) ?> <!-- Nom de l'auteur sécurisé -->
                        le <?= date('d/m/Y', strtotime($article['created_at'])) ?> <!-- Date formatée en français -->
                    </p> <!-- Fin des métadonnées -->
                    <p><?= nl2br(htmlspecialchars($article['contenu'])) ?></p> <!-- Contenu de l'article avec retours à la ligne et sécurisation -->
                </article> <!-- Fin de l'article -->
            <?php endforeach; ?> <!-- Fin de la boucle -->
        </div> <!-- Fin du conteneur grille -->
    <?php endif; ?> <!-- Fin de la condition -->
</section> <!-- Fin de la section actualités -->

<?php include 'includes/footer.php'; ?>
