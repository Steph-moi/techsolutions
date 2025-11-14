<?php
require_once '../includes/auth.php';
requireAdmin();

// Suppression
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: articles.php');
    exit;
}

// Ajout/Modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre']);
    $contenu = trim($_POST['contenu']);
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $stmt = $pdo->prepare("UPDATE articles SET titre = ?, contenu = ? WHERE id = ?");
        $stmt->execute([$titre, $contenu, $_POST['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO articles (titre, contenu, auteur_id) VALUES (?, ?, ?)");
        $stmt->execute([$titre, $contenu, $_SESSION['user_id']]);
    }
    header('Location: articles.php');
    exit;
}

// Édition
$editArticle = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editArticle = $stmt->fetch();
}

// Liste
$articles = $pdo->query("SELECT a.*, u.prenom, u.nom FROM articles a 
                         LEFT JOIN users u ON a.auteur_id = u.id 
                         ORDER BY a.created_at DESC")->fetchAll();
?>
<?php include '../includes/header.php'; ?>

<section class="admin-articles">
    <h1>Gestion des Actualités</h1>
    
    <div class="form-container">
        <h2><?= $editArticle ? 'Modifier' : 'Nouvel' ?> Article</h2>
        <form method="POST">
            <?php if($editArticle): ?>
                <input type="hidden" name="id" value="<?= $editArticle['id'] ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" 
                       value="<?= $editArticle ? htmlspecialchars($editArticle['titre']) : '' ?>" required>
            </div>
            
            <div class="form-group">
                <label for="contenu">Contenu</label>
                <textarea id="contenu" name="contenu" rows="8" required><?= $editArticle ? htmlspecialchars($editArticle['contenu']) : '' ?></textarea>
            </div>
            
            <button type="submit"><?= $editArticle ? 'Modifier' : 'Créer' ?></button>
            <?php if($editArticle): ?>
                <a href="articles.php" class="btn-cancel">Annuler</a>
            <?php endif; ?>
        </form>
    </div>
    
    <div class="articles-list">
        <h2>Articles existants</h2>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($articles as $article): ?>
                <tr>
                    <td><?= htmlspecialchars($article['titre']) ?></td>
                    <td><?= htmlspecialchars($article['prenom'] . ' ' . $article['nom']) ?></td>
                    <td><?= date('d/m/Y', strtotime($article['created_at'])) ?></td>
                    <td>
                        <a href="?edit=<?= $article['id'] ?>">Modifier</a>
                        <a href="?delete=<?= $article['id'] ?>" 
                           onclick="return confirm('Supprimer cet article ?')">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
