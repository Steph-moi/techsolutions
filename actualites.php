<?php 
require_once 'config/database.php';

// Récupération des articles
$stmt = $pdo->query("SELECT a.*, u.prenom, u.nom FROM articles a 
                     LEFT JOIN users u ON a.auteur_id = u.id 
                     ORDER BY a.created_at DESC");
$articles = $stmt->fetchAll();
?>
<?php include 'includes/header.php'; ?>

<section class="actualites">
    <h1>Actualités</h1>
    
    <?php if(empty($articles)): ?>
        <p>Aucune actualité pour le moment.</p>
    <?php else: ?>
        <div class="articles-grid">
            <?php foreach($articles as $article): ?>
                <article class="article-card">
                    <h2><?= htmlspecialchars($article['titre']) ?></h2>
                    <p class="meta">
                        Par <?= htmlspecialchars($article['prenom'] . ' ' . $article['nom']) ?> 
                        le <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                    </p>
                    <p><?= nl2br(htmlspecialchars($article['contenu'])) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>
