<?php // Ouverture du tag PHP
require_once '../config/database.php'; // Inclusion du fichier de configuration de la base de données

// Déconnexion - Commentaire expliquant le bloc de déconnexion
if (isset($_GET['logout'])) { // Vérifie si le paramètre logout est présent dans l'URL
    session_destroy(); // Détruit toutes les données de session
    header('Location: /techsolutions/index.php'); // Redirection vers la page d'accueil
    exit; // Arrêt de l'exécution du script
}

// Traitement connexion - Commentaire expliquant le traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si le formulaire a été soumis en méthode POST
    $email = trim($_POST['email']); // Récupère et nettoie l'email saisi
    $password = $_POST['password']; // Récupère le mot de passe saisi
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?"); // Prépare une requête pour chercher l'utilisateur par email
    $stmt->execute([$email]); // Exécute la requête avec l'email en paramètre
    $user = $stmt->fetch(); // Récupère les données de l'utilisateur
    
    if ($user && password_verify($password, $user['password'])) { // Vérifie si l'utilisateur existe et si le mot de passe est correct
        $_SESSION['user_id'] = $user['id']; // Stocke l'ID utilisateur en session
        $_SESSION['role'] = $user['role']; // Stocke le rôle utilisateur en session
        $_SESSION['nom'] = $user['nom']; // Stocke le nom en session
        $_SESSION['prenom'] = $user['prenom']; // Stocke le prénom en session
        
        if ($user['role'] === 'admin') { // Vérifie si l'utilisateur est administrateur
            header('Location: /techsolutions/admin/index.php'); // Redirection vers l'interface admin
        } else { // Sinon (utilisateur normal)
            header('Location: /techsolutions/client/profile.php'); // Redirection vers le profil client
        }
        exit; // Arrêt de l'exécution du script
    } else { // Si l'authentification échoue
        $error = "Email ou mot de passe incorrect"; // Définit le message d'erreur
    }
}
?>
<?php include '../includes/header.php'; ?> <!-- Inclusion de l'en-tête de la page -->

<section class="login"> <!-- Section de connexion avec classe CSS -->
    <h1>Connexion</h1> <!-- Titre principal de la page de connexion -->
    
    <?php if(isset($error)): ?> <!-- Vérifie s'il y a un message d'erreur -->
        <div class="alert error"><?= $error ?></div> <!-- Affiche le message d'erreur -->
    <?php endif; ?> <!-- Fin de la condition d'erreur -->
    
    <form method="POST"> <!-- Formulaire de connexion avec méthode POST -->
        <div class="form-group"> <!-- Groupe de champ email -->
            <label for="email">Email</label> <!-- Étiquette pour le champ email -->
            <input type="email" id="email" name="email" required> <!-- Champ de saisie email obligatoire -->
        </div> <!-- Fin du groupe email -->
        
        <div class="form-group"> <!-- Groupe de champ mot de passe -->
            <label for="password">Mot de passe</label> <!-- Étiquette pour le champ mot de passe -->
            <input type="password" id="password" name="password" required> <!-- Champ de saisie mot de passe obligatoire -->
        </div> <!-- Fin du groupe mot de passe -->
        
        <button type="submit">Se connecter</button> <!-- Bouton de soumission du formulaire -->
    </form> <!-- Fin du formulaire -->
</section> <!-- Fin de la section connexion -->

<?php include '../includes/footer.php'; ?>
