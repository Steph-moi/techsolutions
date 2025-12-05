<?php // Ouverture du tag PHP
require_once 'config/database.php'; // Inclusion du fichier de configuration de la base de données

$error = ''; // Variable pour stocker les messages d'erreur
$success = ''; // Variable pour stocker les messages de succès

// Traitement du formulaire d'inscription - Commentaire expliquant le bloc suivant
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si le formulaire a été soumis en méthode POST
    $email = trim($_POST['email']); // Récupère et nettoie l'email saisi
    $password = $_POST['password']; // Récupère le mot de passe saisi
    $nom = trim($_POST['nom']); // Récupère et nettoie le nom saisi
    $prenom = trim($_POST['prenom']); // Récupère et nettoie le prénom saisi
    $telephone = trim($_POST['telephone']); // Récupère et nettoie le téléphone saisi
    
    // Vérification si l'email existe déjà - Commentaire expliquant la vérification
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?"); // Prépare une requête pour chercher l'email
    $stmt->execute([$email]); // Exécute la requête avec l'email en paramètre
    
    if ($stmt->fetch()) { // Si un résultat est trouvé (email existe déjà)
        $error = 'Cet email est déjà utilisé'; // Définit le message d'erreur
    } else { // Sinon (email disponible)
        // Création du compte - Commentaire expliquant la création
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hachage sécurisé du mot de passe
        $stmt = $pdo->prepare("INSERT INTO users (email, password, nom, prenom, telephone, consent_date) VALUES (?, ?, ?, ?, ?, NOW())"); // Prépare l'insertion du nouvel utilisateur
        
        if ($stmt->execute([$email, $hashedPassword, $nom, $prenom, $telephone])) { // Exécute l'insertion avec les données
            $success = 'Compte créé avec succès ! Vous pouvez maintenant vous connecter.'; // Message de succès
        } else { // Si l'insertion échoue
            $error = 'Erreur lors de la création du compte'; // Message d'erreur
        }
    }
}
?> <!-- Fermeture du tag PHP -->
<?php include 'includes/header.php'; ?> <!-- Inclusion de l'en-tête de la page -->

<section class="register"> <!-- Section d'inscription avec classe CSS -->
    <h1>Créer un compte</h1> <!-- Titre principal de la page d'inscription -->
    
    <?php if($error): ?> <!-- Vérifie s'il y a un message d'erreur -->
        <div class="alert error"><?= $error ?></div> <!-- Affiche le message d'erreur -->
    <?php endif; ?> <!-- Fin de la condition d'erreur -->
    
    <?php if($success): ?> <!-- Vérifie s'il y a un message de succès -->
        <div class="alert success"><?= $success ?></div> <!-- Affiche le message de succès -->
    <?php endif; ?> <!-- Fin de la condition de succès -->
    
    <form method="POST"> <!-- Formulaire d'inscription avec méthode POST -->
        <div class="form-group"> <!-- Groupe de champ nom -->
            <label for="nom">Nom *</label> <!-- Étiquette pour le champ nom -->
            <input type="text" id="nom" name="nom" required> <!-- Champ de saisie texte obligatoire pour le nom -->
        </div> <!-- Fin du groupe nom -->
        
        <div class="form-group"> <!-- Groupe de champ prénom -->
            <label for="prenom">Prénom *</label> <!-- Étiquette pour le champ prénom -->
            <input type="text" id="prenom" name="prenom" required> <!-- Champ de saisie texte obligatoire pour le prénom -->
        </div> <!-- Fin du groupe prénom -->
        
        <div class="form-group"> <!-- Groupe de champ email -->
            <label for="email">Email *</label> <!-- Étiquette pour le champ email -->
            <input type="email" id="email" name="email" required> <!-- Champ de saisie email obligatoire -->
        </div> <!-- Fin du groupe email -->
        
        <div class="form-group"> <!-- Groupe de champ téléphone -->
            <label for="telephone">Téléphone</label> <!-- Étiquette pour le champ téléphone -->
            <input type="tel" id="telephone" name="telephone"> <!-- Champ de saisie téléphone optionnel -->
        </div> <!-- Fin du groupe téléphone -->
        
        <div class="form-group"> <!-- Groupe de champ mot de passe -->
            <label for="password">Mot de passe *</label> <!-- Étiquette pour le champ mot de passe -->
            <input type="password" id="password" name="password" required> <!-- Champ de saisie mot de passe obligatoire -->
        </div> <!-- Fin du groupe mot de passe -->
        
        <div class="form-group checkbox"> <!-- Groupe de case à cocher -->
            <input type="checkbox" id="consent" name="consent_rgpd" required> <!-- Case à cocher obligatoire pour le consentement RGPD -->
            <label for="consent"> <!-- Étiquette pour la case à cocher -->
                J'accepte que mes données personnelles soient collectées et traitées conformément 
                à la <a href="rgpd.php" target="_blank">politique de confidentialité</a> * <!-- Texte de consentement avec lien vers RGPD -->
            </label> <!-- Fin de l'étiquette -->
        </div> <!-- Fin du groupe checkbox -->
        
        <button type="submit">Créer le compte</button> <!-- Bouton de soumission du formulaire -->
    </form> <!-- Fin du formulaire -->
    
    <p style="text-align: center; margin-top: 2rem;"> <!-- Paragraphe centré avec marge supérieure -->
        Déjà un compte ? <a href="api/login.php">Se connecter</a> <!-- Lien vers la page de connexion -->
    </p> <!-- Fin du paragraphe -->
</section> <!-- Fin de la section inscription -->

<?php include 'includes/footer.php'; ?>