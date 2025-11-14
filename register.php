<?php
require_once 'config/database.php';

$error = '';
$success = '';

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $telephone = trim($_POST['telephone']);
    
    // Vérification si l'email existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        $error = 'Cet email est déjà utilisé';
    } else {
        // Création du compte
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (email, password, nom, prenom, telephone, consent_date) VALUES (?, ?, ?, ?, ?, NOW())");
        
        if ($stmt->execute([$email, $hashedPassword, $nom, $prenom, $telephone])) {
            $success = 'Compte créé avec succès ! Vous pouvez maintenant vous connecter.';
        } else {
            $error = 'Erreur lors de la création du compte';
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<section class="register">
    <h1>Créer un compte</h1>
    
    <?php if($error): ?>
        <div class="alert error"><?= $error ?></div>
    <?php endif; ?>
    
    <?php if($success): ?>
        <div class="alert success"><?= $success ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="nom">Nom *</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        
        <div class="form-group">
            <label for="prenom">Prénom *</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="tel" id="telephone" name="telephone">
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe *</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group checkbox">
            <input type="checkbox" id="consent" name="consent_rgpd" required>
            <label for="consent">
                J'accepte que mes données personnelles soient collectées et traitées conformément 
                à la <a href="rgpd.php" target="_blank">politique de confidentialité</a> *
            </label>
        </div>
        
        <button type="submit">Créer le compte</button>
    </form>
    
    <p style="text-align: center; margin-top: 2rem;">
        Déjà un compte ? <a href="api/login.php">Se connecter</a>
    </p>
</section>

<?php include 'includes/footer.php'; ?>