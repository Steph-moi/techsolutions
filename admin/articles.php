<?php // Ouverture du tag PHP
require_once '../includes/auth.php'; // Inclusion du fichier d'authentification
requireAdmin(); // Vérification des droits administrateur

// Suppression - Commentaire expliquant le bloc de suppression
if (isset($_GET['delete'])) { // Vérifie si un ID d'article à supprimer est passé en paramètre GET
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?"); // Prépare la requête de suppression
    $stmt->execute([$_GET['delete']]); // Exécute la suppression avec l'ID en paramètre
    header('Location: articles.php'); // Redirection vers la page de gestion des articles
    exit; // Arrêt de l'exécution du script
}

// Ajout/Modification - Commentaire expliquant le traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si le formulaire a été soumis en méthode POST
    $titre = trim($_POST['titre']); // Récupère et nettoie le titre saisi
    $contenu = trim($_POST['contenu']); // Récupère et nettoie le contenu saisi
    
    if (isset($_POST['id']) && !empty($_POST['id'])) { // Vérifie si un ID est présent (modification)
        $stmt = $pdo->prepare("UPDATE articles SET titre = ?, contenu = ? WHERE id = ?"); // Prépare la requête de modification
        $stmt->execute([$titre, $contenu, $_POST['id']]); // Exécute la modification avec les nouvelles données
    } else { // Sinon (ajout d'un nouvel article)
        $stmt = $pdo->prepare("INSERT INTO articles (titre, contenu, auteur_id) VALUES (?, ?, ?)"); // Prépare la requête d'insertion
        $stmt->execute([$titre, $contenu, $_SESSION['user_id']]); // Exécute l'insertion avec l'ID de l'utilisateur connecté
    }
    header('Location: articles.php'); // Redirection vers la page de gestion
    exit; // Arrêt de l'exécution du script
}

// Édition - Commentaire expliquant la récupération pour édition
$editArticle = null; // Initialise la variable d'article à éditer
if (isset($_GET['edit'])) { // Vérifie si un ID d'article à éditer est passé en paramètre
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?"); // Prépare la requête de sélection
    $stmt->execute([$_GET['edit']]); // Exécute la requête avec l'ID en paramètre
    $editArticle = $stmt->fetch(); // Récupère les données de l'article à éditer
}

// Liste - Commentaire expliquant la récupération de tous les articles
$articles = $pdo->query("SELECT a.*, u.prenom, u.nom FROM articles a 
                         LEFT JOIN users u ON a.auteur_id = u.id 
                         ORDER BY a.created_at DESC")->fetchAll(); // Requête pour récupérer tous les articles avec infos auteur, triés par date
?>
<?php include '../includes/header.php'; ?> <!-- Inclusion de l'en-tête de la page -->

<section class="admin-articles"> <!-- Section de gestion des articles avec classe CSS -->
    <div class="admin-header"> <!-- En-tête de la section admin -->
        <h1>Gestion des Actualités</h1> <!-- Titre principal de la page -->
        <a href="index.php" class="btn-back">← Retour au tableau de bord</a> <!-- Lien de retour vers le tableau de bord -->
    </div> <!-- Fin de l'en-tête -->
    
    <div class="form-container"> <!-- Conteneur du formulaire -->
        <h2><?= $editArticle ? 'Modifier' : 'Nouvel' ?> Article</h2> <!-- Titre dynamique selon le mode (création/modification) -->
        <form method="POST"> <!-- Formulaire avec méthode POST -->
            <?php if($editArticle): ?> <!-- Vérifie si on est en mode édition -->
                <input type="hidden" name="id" value="<?= $editArticle['id'] ?>"> <!-- Champ caché contenant l'ID de l'article à modifier -->
            <?php endif; ?> <!-- Fin de la condition -->
            
            <div class="form-group"> <!-- Groupe de champ titre -->
                <label for="titre">Titre</label> <!-- Étiquette pour le champ titre -->
                <input type="text" id="titre" name="titre" 
                       value="<?= $editArticle ? htmlspecialchars($editArticle['titre']) : '' ?>" required> <!-- Champ de saisie titre avec valeur pré-remplie en mode édition -->
            </div> <!-- Fin du groupe titre -->
            
            <div class="form-group"> <!-- Groupe de champ contenu -->
                <label for="contenu">Contenu</label> <!-- Étiquette pour le champ contenu -->
                <textarea id="contenu" name="contenu" rows="8" required><?= $editArticle ? htmlspecialchars($editArticle['contenu']) : '' ?></textarea> <!-- Zone de texte pour le contenu avec valeur pré-remplie -->
            </div> <!-- Fin du groupe contenu -->
            
            <button type="submit"><?= $editArticle ? 'Modifier' : 'Créer' ?></button> <!-- Bouton de soumission avec texte dynamique -->
            <?php if($editArticle): ?> <!-- Vérifie si on est en mode édition -->
                <a href="articles.php" class="btn-cancel">Annuler</a> <!-- Bouton d'annulation visible seulement en mode édition -->
            <?php endif; ?> <!-- Fin de la condition -->
        </form> <!-- Fin du formulaire -->
    </div> <!-- Fin du conteneur formulaire -->
    
    <div class="articles-list"> <!-- Conteneur de la liste des articles -->
        <h2>Articles existants</h2> <!-- Titre de la section liste -->
        <table> <!-- Tableau des articles -->
            <thead> <!-- En-tête du tableau -->
                <tr> <!-- Ligne d'en-tête -->
                    <th>Titre</th> <!-- Colonne titre -->
                    <th>Auteur</th> <!-- Colonne auteur -->
                    <th>Date</th> <!-- Colonne date -->
                    <th>Actions</th> <!-- Colonne actions -->
                </tr> <!-- Fin de la ligne d'en-tête -->
            </thead> <!-- Fin de l'en-tête -->
            <tbody> <!-- Corps du tableau -->
                <?php foreach($articles as $article): ?> <!-- Boucle pour parcourir chaque article -->
                <tr> <!-- Ligne de données -->
                    <td><?= htmlspecialchars($article['titre']) ?></td> <!-- Cellule titre sécurisée -->
                    <td><?= htmlspecialchars($article['prenom'] . ' ' . $article['nom']) ?></td> <!-- Cellule auteur (prénom + nom) sécurisée -->
                    <td><?= date('d/m/Y', strtotime($article['created_at'])) ?></td> <!-- Cellule date formatée -->
                    <td> <!-- Cellule actions -->
                        <a href="?edit=<?= $article['id'] ?>">Modifier</a> <!-- Lien de modification avec ID en paramètre -->
                        <a href="?delete=<?= $article['id'] ?>" 
                           onclick="return confirm('Supprimer cet article ?')">Supprimer</a> <!-- Lien de suppression avec confirmation JavaScript -->
                    </td> <!-- Fin de la cellule actions -->
                </tr> <!-- Fin de la ligne -->
                <?php endforeach; ?> <!-- Fin de la boucle -->
            </tbody> <!-- Fin du corps du tableau -->
        </table> <!-- Fin du tableau -->
    </div> <!-- Fin du conteneur liste -->
</section> <!-- Fin de la section admin articles -->

<?php include '../includes/footer.php'; ?>
